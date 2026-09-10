<?php

namespace App\Http\Controllers;

use App\Mail\ApplicationMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

abstract class ApplicationSubmitController
{
    protected string $modelClass;

    abstract protected function getValidationRules(): array;

    abstract protected function saveApplication(array $validated);

    protected function validateRequest(Request $request): array
    {
        try {
            return $request->validate(
                $this->getValidationRules(),
                $this->getValidationMessages()
            );
        } catch (ValidationException $e) {
            $e->validator->errors()->add(
                'gentle_wish',
                'Хей! Пожалуйста, не пытайтесь ломать наш сайт, это неприлично!'
            );
            throw $e;
        }
    }

    protected function getValidationMessages(): array
    {
        return [
            'description.required' => 'Поле описания обязательно для заполнения',
            'description.string' => 'Недопустимый тип ввода описания',
            'description.min' => 'Описание должно быть не менее 1 символов',
            'description.max' => 'Описание должно быть не более 8192 символов',

            // Файлы: обязательность
            'files_student.required' => 'Прикрепите файл презентации',
            'files_individual.required' => 'Прикрепите файл презентации',
            'files_entity.required' => 'Прикрепите хотя бы один файл презентации',

            // Файлы: минимум
            'files_student.min' => 'Прикрепите файл презентации',
            'files_individual.min' => 'Прикрепите файл презентации',
            'files_entity.min' => 'Прикрепите хотя бы один файл презентации',

            // Файлы: максимум
            'files_student.max' => 'Можно загрузить только :max файл',
            'files_individual.max' => 'Можно загрузить только :max файл',
            'files_entity.max' => 'Можно загрузить максимум :max файла',

            // Формат
            'files_student.*.mimes' => 'Файл должен быть в формате .pptx',
            'files_individual.*.mimes' => 'Файл должен быть в формате .pptx',
            'files_entity.*.mimes' => 'Файл должен быть в формате .pptx',

            // Размер
            'files_student.*.max' => 'Размер файла не должен превышать 200MB',
            'files_individual.*.max' => 'Размер файла не должен превышать 200MB',
            'files_entity.*.max' => 'Размер файла не должен превышать 200MB',

            // Валидность
            'files_student.*.file' => 'Загруженный файл поврежден или не является файлом',
            'files_individual.*.file' => 'Загруженный файл поврежден или не является файлом',
            'files_entity.*.file' => 'Загруженный файл поврежден или не является файлом',

            // Обязательность каждого файла в массиве
            'files_student.*.required' => 'Файл не был загружен',
            'files_individual.*.required' => 'Файл не был загружен',
            'files_entity.*.required' => 'Файл не был загружен',
        ];
    }

    /**
     * Обработка загрузки файлов.
     * Файлы сохраняются в постоянное место (storage/app/applications/...),
     * чтобы гарантированно существовать к моменту отправки письма
     * (в том числе асинхронной через очередь).
     */
    protected function handleFileUploads(Request $request, string $applicationType): array
    {
        $fieldName = match ($applicationType) {
            'student' => 'files_student',
            'individual' => 'files_individual',
            'entity' => 'files_entity',
            default => 'files',
        };

        $uploadedFiles = [];

        if (!$request->hasFile($fieldName)) {
            return $uploadedFiles;
        }

        $folder = 'applications/' . now()->format('Y/m/d');

        foreach ($request->file($fieldName) as $file) {
            if (!$file->isValid()) {
                throw ValidationException::withMessages([
                    $fieldName . '.*' => 'Ошибка загрузки файла: ' . $file->getErrorMessage(),
                ]);
            }

            $extension = strtolower($file->getClientOriginalExtension());
            if (!in_array($extension, ['pptx', 'ppt'], true)) {
                throw ValidationException::withMessages([
                    $fieldName . '.*' => 'Файл должен быть в формате .pptx',
                ]);
            }

            $diskPath = $file->store($folder, 'local');

            $uploadedFiles[] = [
                'name' => $file->getClientOriginalName(),
                'disk_path' => $diskPath, // ← ТОЛЬКО disk_path, никакого path
                'mime' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            ];
        }

        return $uploadedFiles;
    }

    /**
     * Сохранение заявки + файлов + отправка письма (всё в транзакции).
     */
    public function applicationSubmit(Request $request): RedirectResponse
    {
        $validated = $this->validateRequest($request);
        $applicationType = $validated['application_type'];

        // 1. Файлы сохраняем ДО транзакции, чтобы если что — можно было их откатить
        $files = $this->handleFileUploads($request, $applicationType);

        try {
            DB::beginTransaction();

            // 2. Оставляем только нужные поля
            $filtered = $this->filterValidated($validated, $applicationType);

            // 3. Создаём и сохраняем модель
            $application = $this->saveApplication($filtered);
            $application->save();

            // 4. Отправляем письмо (синхронно, в рамках транзакции).
            //    Если что-то падает — транзакция откатится, но файлы удалим в catch.
            $this->sendApplicationEmail($application, $filtered, $applicationType, $files);

            DB::commit();

            Log::info("Application #{$this->getApplicationId($application)} ({$applicationType}) submitted successfully");

        } catch (\Throwable $e) {
            DB::rollBack();

            // Удаляем файлы, если транзакция упала
            $this->deleteFiles($files);

            Log::error('Application submit failed', [
                'type' => $applicationType,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            throw $e;
        }

        session()->flash('application', $filtered);

        return redirect('/');
    }

    /**
     * Оставить только нужные поля для конкретного типа заявки.
     */
    protected function filterValidated(array $validated, string $applicationType): array
    {
        $fields = match ($applicationType) {
            'student' => [
                'application_type', 'person_name', 'email', 'phone',
                'track_student', 'description', 'confirmation',
            ],
            'individual' => [
                'application_type', 'person_name', 'email', 'phone',
                'track_individual', 'description', 'confirmation',
            ],
            'entity' => [
                'application_type', 'organization_name', 'organization_tin',
                'organization_representative', 'email', 'phone',
                'track_1', 'track_2', 'track_3', 'description', 'confirmation',
            ],
            default => [],
        };

        return array_intersect_key($validated, array_flip($fields));
    }

    /**
     * Отправка письма. Файлы НЕ удаляются здесь.
     * Удаление файлов повесим на событие MessageSending / MessageSent,
     * либо на успешный commit транзакции (см. ниже).
     */
    protected function sendApplicationEmail(
        $application,
        array $validated,
        string $applicationType,
        array $files = []
    ): void {
        $adminEmail = config('mail.application_recipient');

        $id = $this->getApplicationId($application);
        $name = $this->getApplicationName($validated, $applicationType);

        Mail::to($adminEmail)->send(
            new ApplicationMail($validated, $applicationType, $id, $name, $files)
        );

        Log::info("Email sent for {$applicationType} application #{$id}");
    }

    /**
     * Удаление файлов с диска (безопасное).
     */
    protected function deleteFiles(array $files): void
    {
        foreach ($files as $file) {
            $diskPath = $file['disk_path'] ?? null;
            if ($diskPath && \Storage::disk('local')->exists($diskPath)) {
                \Storage::disk('local')->delete($diskPath);
            }
        }
    }

    protected function getApplicationId($application): int
    {
        $primaryKey = $application->getKeyName();
        return $application->$primaryKey;
    }

    protected function getApplicationName(array $validated, string $applicationType): string
    {
        if (in_array($applicationType, ['student', 'individual'], true)) {
            return $validated['person_name'] ?? 'Без имени';
        }

        if ($applicationType === 'entity') {
            return $validated['organization_name'] ?? 'Без названия';
        }

        return 'Без имени';
    }
}
