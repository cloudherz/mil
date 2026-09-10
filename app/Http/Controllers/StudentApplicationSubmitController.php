<?php

namespace App\Http\Controllers;

use App\Models\Student;

class StudentApplicationSubmitController extends ApplicationSubmitController
{
    protected string $modelClass = Student::class;

    protected function getValidationRules(): array
    {
        return [
            'application_type' => 'required',
            'person_name' => 'required',
            'organization_name' => 'prohibited',
            'organization_tin' => 'prohibited',
            'organization_representative' => 'prohibited',
            'email' => 'required|email',
            'phone' => 'required',
            'track_student' => 'required',
            'track_individual' => 'prohibited',
            'track_1' => 'prohibited',
            'track_2' => 'prohibited',
            'track_3' => 'prohibited',
            'description' => 'required',
            'files_student' => 'required|array|min:1|max:1',
            'files_student.*' => 'required|file|max:204800',
        ];
    }

    protected function saveApplication(array $validated)
    {
        $timestamp = now()->timestamp;

        return new $this->modelClass([
            'person_name' => $validated['person_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'track_student' => $validated['track_student'],
            'description' => $validated['description'],
            'submit_date' => $timestamp
        ]);
    }
}
