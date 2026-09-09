<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
            $e->validator->errors()->add('gentle_wish', 'Хей! Пожалуйста, не пытайтесь ломать наш сайт, это неприлично!');
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
            'description.alpha_dash' => 'Описание может содержать только буквы, цифры, дефисы и подчеркивания',
        ];
    }

    public function applicationSubmit(Request $request): RedirectResponse
    {
        $validated = $this->validateRequest($request);
        $application_type = $validated['application_type'];

        if ($application_type === 'student') {
            $validated = array_intersect_key($validated, array_flip([
                'application_type',
                'person_name',
                'email',
                'phone',
                'track_student',
                'description',
                'confirmation'
            ]));
        } elseif ($application_type === 'individual') {
            $validated = array_intersect_key($validated, array_flip([
                'application_type',
                'person_name',
                'email',
                'phone',
                'track_individual',
                'description',
                'confirmation'
            ]));
        } elseif ($application_type === 'entity') {
            $validated = array_intersect_key($validated, array_flip([
                'application_type',
                'organization_name',
                'organization_tin',
                'organization_representative',
                'email',
                'phone',
                'track_1',
                'track_2',
                'track_3',
                'description',
                'confirmation'
            ]));
        }

        $application = $this->saveApplication($validated);
        $application->save();

        session()->flash('application', $validated);

        return redirect("/");
    }
}
