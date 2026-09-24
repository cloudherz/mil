<?php

namespace App\Http\Controllers;

use App\Models\Student;

class StudentApplicationSubmitController extends ApplicationSubmitController
{
    protected string $modelClass = Student::class;

    protected function getValidationRules(): array
    {
        return [
            'application_type_student' => 'required|in:student',
            'person_name_student' => [
                'required',
                'string',
                'min:2',
                'max:256',
                'regex:' . self::REGEX_PERSON_NAME,
            ],
            'email_student' => 'required|email|min:5|max:256|regex:' . self::REGEX_EMAIL,
            'phone_student' => [
                'required',
                'string',
                'regex:' . self::REGEX_PHONE,
            ],
            'track_student' => 'required|in:1,2,3,4,5,6,7,8,9,10,11,12,13,14,15',
            'description_student' => 'required|string|min:1|max:10000',
            'confirmation_student' => 'required|accepted',
            'files_student' => 'required|array|min:1|max:1',
            'files_student.*' => 'required|file|mimes:pptx,pdf|max:32768',
        ];
    }

    protected function saveApplication(array $validated)
    {
        $timestamp = now()->timestamp;

        return new $this->modelClass([
            'person_name' => $validated['person_name_student'],
            'email' => $validated['email_student'],
            'phone' => $validated['phone_student'],
            'track_student' => $validated['track_student'],
            'description' => $validated['description_student'],
            'submit_date' => $timestamp
        ]);
    }
}
