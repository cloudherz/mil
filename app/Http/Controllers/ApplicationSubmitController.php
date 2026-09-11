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

    protected const REGEX_PERSON_NAME = '/^[А-Яа-яЁё\s\-.,\'’]+$/u';
    protected const REGEX_ORGANIZATION_NAME = '/^[А-Яа-яЁёA-Za-z0-9\s\-.,"\'’()«»№\/\\\\&%$@#!?:;_*+]+$/u';
    protected const REGEX_EMAIL = '/^[A-Za-z0-9._%+\-]+@[A-Za-z0-9.\-]+\.[A-Za-z]{2,}$/';
    protected const REGEX_PHONE = '/^\+?7\d{10}$/';

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
            // ── Description ──────────────────────────
            'description_student.required' => 'Поле описания обязательно для заполнения',
            'description_student.string' => 'Недопустимый тип ввода описания',
            'description_student.min' => 'Описание должно быть не менее 1 символа',
            'description_student.max' => 'Описание должно быть не более 10 000 символов',

            'description_individual.required' => 'Поле описания обязательно для заполнения',
            'description_individual.string' => 'Недопустимый тип ввода описания',
            'description_individual.min' => 'Описание должно быть не менее 1 символа',
            'description_individual.max' => 'Описание должно быть не более 10 000 символов',

            'description_entity.required' => 'Поле описания обязательно для заполнения',
            'description_entity.string' => 'Недопустимый тип ввода описания',
            'description_entity.min' => 'Описание должно быть не менее 1 символа',
            'description_entity.max' => 'Описание должно быть не более 10 000 символов',

            // ── Person name ──────────────────────────
            'person_name_student.required' => 'Поле ФИО обязательно для заполнения',
            'person_name_student.min' => 'ФИО должно быть не короче 2 символов',
            'person_name_student.max' => 'ФИО должно быть не длиннее 256 символов',
            'person_name_student.regex' => 'ФИО может содержать только кириллицу, пробел, дефис, точку, запятую и апостроф',

            'person_name_individual.required' => 'Поле ФИО обязательно для заполнения',
            'person_name_individual.min' => 'ФИО должно быть не короче 2 символов',
            'person_name_individual.max' => 'ФИО должно быть не длиннее 256 символов',
            'person_name_individual.regex' => 'ФИО может содержать только кириллицу, пробел, дефис, точку, запятую и апостроф',

            'organization_representative.required' => 'Поле ФИО представителя обязательно для заполнения',
            'organization_representative.min' => 'ФИО представителя должно быть не короче 2 символов',
            'organization_representative.max' => 'ФИО представителя должно быть не длиннее 256 символов',
            'organization_representative.regex' => 'ФИО представителя может содержать только кириллицу, пробел, дефис, точку, запятую и апостроф',

            // ── Organization ─────────────────────────
            'organization_name.required' => 'Поле названия организации обязательно для заполнения',
            'organization_name.min' => 'Название организации должно быть не короче 2 символов',
            'organization_name.max' => 'Название организации должно быть не длиннее 512 символов',
            'organization_name.regex' => 'Название организации содержит недопустимые символы',

            'organization_tin.required' => 'Поле ИНН обязательно для заполнения',
            'organization_tin.digits_between' => 'ИНН должен содержать от 1 до 12 цифр',

            // ── Email ────────────────────────────────
            'email_student.required' => 'Поле почты обязательно для заполнения',
            'email_student.email' => 'Введите корректный email',
            'email_student.min' => 'Email слишком короткий',
            'email_student.max' => 'Email слишком длинный (макс. 256 символов)',
            'email_student.regex' => 'Введите корректный email',

            'email_individual.required' => 'Поле почты обязательно для заполнения',
            'email_individual.email' => 'Введите корректный email',
            'email_individual.min' => 'Email слишком короткий',
            'email_individual.max' => 'Email слишком длинный (макс. 256 символов)',
            'email_individual.regex' => 'Введите корректный email',

            'email_entity.required' => 'Поле почты обязательно для заполнения',
            'email_entity.email' => 'Введите корректный email',
            'email_entity.min' => 'Email слишком короткий',
            'email_entity.max' => 'Email слишком длинный (макс. 256 символов)',
            'email_entity.regex' => 'Введите корректный email',

            // ── Phone ────────────────────────────────
            'phone_student.required' => 'Поле телефона обязательно для заполнения',
            'phone_student.regex' => 'Введите телефон в формате +7 XXXXXXXXXX',
            'phone_individual.required' => 'Поле телефона обязательно для заполнения',
            'phone_individual.regex' => 'Введите телефон в формате +7 XXXXXXXXXX',
            'phone_entity.required' => 'Поле телефона обязательно для заполнения',
            'phone_entity.regex' => 'Введите телефон в формате +7 XXXXXXXXXX',

            // ── Track ────────────────────────────────
            'track_student.required' => 'Выберите номинацию',
            'track_student.in' => 'Некорректная номинация',
            'track_individual.required' => 'Выберите номинацию',
            'track_individual.in' => 'Некорректная номинация',
            'track_1.in' => 'Некорректная номинация',
            'track_2.in' => 'Некорректная номинация',
            'track_3.in' => 'Некорректная номинация',

            // ── Confirmation ─────────────────────────
            'confirmation_student.required' => 'Необходимо согласие на обработку персональных данных',
            'confirmation_student.accepted' => 'Необходимо согласие на обработку персональных данных',
            'confirmation_individual.required' => 'Необходимо согласие на обработку персональных данных',
            'confirmation_individual.accepted' => 'Необходимо согласие на обработку персональных данных',
            'confirmation_entity.required' => 'Необходимо согласие на обработку персональных данных',
            'confirmation_entity.accepted' => 'Необходимо согласие на обработку персональных данных',

            // ── Файлы: обязательность ────────────────
            'files_student.required' => 'Прикрепите файл презентации',
            'files_individual.required' => 'Прикрепите файл презентации',
            'files_entity.required' => 'Прикрепите хотя бы один файл презентации',

            // ── Файлы: минимум ───────────────────────
            'files_student.min' => 'Прикрепите файл презентации',
            'files_individual.min' => 'Прикрепите файл презентации',
            'files_entity.min' => 'Прикрепите хотя бы один файл презентации',

            // ── Файлы: максимум ──────────────────────
            'files_student.max' => 'Можно загрузить только :max файл',
            'files_individual.max' => 'Можно загрузить только :max файл',
            'files_entity.max' => 'Можно загрузить максимум :max файла',

            // ── Файлы: формат ────────────────────────
            'files_student.*.mimes' => 'Файл должен быть в формате .pptx или .pdf',
            'files_individual.*.mimes' => 'Файл должен быть в формате .pptx или .pdf',
            'files_entity.*.mimes' => 'Файл должен быть в формате .pptx или .pdf',

            // ── Файлы: размер ────────────────────────
            'files_student.*.max' => 'Размер файла не должен превышать 32MB',
            'files_individual.*.max' => 'Размер файла не должен превышать 32MB',
            'files_entity.*.max' => 'Размер файла не должен превышать 32MB',

            // ── Файлы: валидность ────────────────────
            'files_student.*.file' => 'Загруженный файл поврежден или не является файлом',
            'files_individual.*.file' => 'Загруженный файл поврежден или не является файлом',
            'files_entity.*.file' => 'Загруженный файл поврежден или не является файлом',

            // ── Файлы: обязательность каждого ────────
            'files_student.*.required' => 'Файл не был загружен',
            'files_individual.*.required' => 'Файл не был загружен',
            'files_entity.*.required' => 'Файл не был загружен',
        ];
    }

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

        // ⬇⬇⬇ НОВОЕ: суммарный размер
        $totalSize = 0;
        $maxTotalSize = 32 * 1024 * 1024; // 32 MB в байтах

        foreach ($request->file($fieldName) as $file) {
            if (!$file->isValid()) {
                throw ValidationException::withMessages([
                    $fieldName . '.*' => 'Ошибка загрузки файла: ' . $file->getErrorMessage(),
                ]);
            }

            $extension = strtolower($file->getClientOriginalExtension());
            if (!in_array($extension, ['pptx', 'pdf'], true)) {
                throw ValidationException::withMessages([
                    $fieldName . '.*' => 'Файл должен быть в формате .pptx или .pdf',
                ]);
            }

            // ⬇⬇⬇ НОВОЕ: копим размер
            $totalSize += $file->getSize();
            // ⬆⬆⬆

            $diskPath = $file->store($folder, 'local');

            $uploadedFiles[] = [
                'name' => $file->getClientOriginalName(),
                'disk_path' => $diskPath,
                'mime' => $file->getClientMimeType() ?: 'application/octet-stream',
            ];
        }

        // ⬇⬇⬇ НОВОЕ: проверка суммы
        if ($totalSize > $maxTotalSize) {
            // Удаляем уже загруженные файлы, чтобы не мусорить
            $this->deleteFiles($uploadedFiles);

            $totalMb = round($totalSize / 1024 / 1024, 2);
            throw ValidationException::withMessages([
                $fieldName . '.*' => "Суммарный размер файлов не должен превышать 32 MB (Текущий: {$totalMb} MB)",
            ]);
        }
        // ⬆⬆⬆

        return $uploadedFiles;
    }

    public function applicationSubmit(Request $request): RedirectResponse
    {
        $applicationType = null;

        foreach (['student', 'individual', 'entity'] as $type) {
            if ($request->input("application_type_{$type}") === $type) {
                $applicationType = $type;
                break;
            }
        }

        if (!$applicationType) {
            throw ValidationException::withMessages([
                'application_type' => 'Не удалось определить тип заявки',
            ]);
        }

        $this->normalizePhones($request);

        $validated = $this->validateRequest($request);

        $files = $this->handleFileUploads($request, $applicationType);

        try {
            DB::beginTransaction();

            $filtered = $this->filterValidated($validated, $applicationType);

            $application = $this->saveApplication($filtered);
            $application->save();

            $this->sendApplicationEmail($application, $filtered, $applicationType, $files);

            DB::commit();

            Log::info("Application #{$this->getApplicationId($application)} ({$applicationType}) submitted successfully");

        } catch (\Throwable $e) {
            DB::rollBack();

            $this->deleteFiles($files);

            Log::error('Application submit failed', [
                'type' => $applicationType,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            throw $e;
        }

        session()->flash('application_success', true);

        return redirect('/');
    }

    /**
     * Оставить только нужные поля для конкретного типа заявки.
     */
    protected function filterValidated(array $validated, string $applicationType): array
    {
        $fields = match ($applicationType) {
            'student' => [
                'application_type_student',
                'person_name_student',
                'email_student',
                'phone_student',
                'track_student',
                'description_student',
                'confirmation_student',
            ],
            'individual' => [
                'application_type_individual',
                'person_name_individual',
                'email_individual',
                'phone_individual',
                'track_individual',
                'description_individual',
                'confirmation_individual',
            ],
            'entity' => [
                'application_type_entity',
                'organization_name',
                'organization_tin',
                'organization_representative',
                'email_entity',
                'phone_entity',
                'track_1', 'track_2', 'track_3',
                'description_entity',
                'confirmation_entity',
            ],
            default => [],
        };

        $filtered = array_intersect_key($validated, array_flip($fields));

        // ⬇⬇⬇ НОВОЕ: форматируем телефон один раз — и в БД, и в письмо
        $phoneKey = match ($applicationType) {
            'student' => 'phone_student',
            'individual' => 'phone_individual',
            'entity' => 'phone_entity',
            default => null,
        };

        if ($phoneKey && !empty($filtered[$phoneKey])) {
            $filtered[$phoneKey] = $this->formatPhone($filtered[$phoneKey]);
        }
        // ⬆⬆⬆

        return $filtered;
    }


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
        if ($applicationType === 'student') {
            return $validated['person_name_student'] ?? 'Без имени';
        }

        if ($applicationType === 'individual') {
            return $validated['person_name_individual'] ?? 'Без имени';
        }

        if ($applicationType === 'entity') {
            return $validated['organization_name'] ?? 'Без названия';
        }

        return 'Без имени';
    }

    /**
     * Приводит телефоны к виду +7XXXXXXXXXX до валидации.
     * Иначе regex /^\+?7\d{10}$/ не сработает на «+7 333 333-33-33».
     */
    protected function normalizePhones(Request $request): void
    {
        foreach (['phone_student', 'phone_individual', 'phone_entity'] as $field) {
            if (!$request->has($field)) {
                continue;
            }

            $value = (string) $request->input($field);
            $digits = preg_replace('/\D/', '', $value);

            if ($digits === '' || strlen($digits) < 11) {
                // оставляем как есть — валидатор вернёт ошибку
                continue;
            }

            // берём последние 11 цифр и нормализуем первый символ к 7
            $digits = substr($digits, -11);
            $digits = '7' . substr($digits, 1);

            $request->merge([$field => '+' . $digits]);
        }
    }

    /**
     * Приводит нормализованный телефон +7XXXXXXXXXX к виду +7 XXX XXX-XX-XX.
     * Используется при сохранении в БД и в письме.
     */
    protected function formatPhone(string $phone): string
    {
        $digits = preg_replace('/\D/', '', $phone);
        $digits = substr($digits, -10); // последние 10 цифр (без ведущей 7)

        return '+7 '
            . substr($digits, 0, 3) . ' '
            . substr($digits, 3, 3) . '-'
            . substr($digits, 6, 2) . '-'
            . substr($digits, 8, 2);
    }
}
