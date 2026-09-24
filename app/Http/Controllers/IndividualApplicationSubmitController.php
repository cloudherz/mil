<?php

namespace App\Http\Controllers;

use App\Models\Individual;

class IndividualApplicationSubmitController extends ApplicationSubmitController
{
    protected string $modelClass = Individual::class;

    protected function getValidationRules(): array
    {
        return [
            'application_type_individual' => 'required|in:individual',
            'person_name_individual' => [
                'required',
                'string',
                'min:2',
                'max:256',
                'regex:' . self::REGEX_PERSON_NAME,
            ],
            'email_individual' => 'required|email|min:5|max:256|regex:' . self::REGEX_EMAIL,
            'phone_individual' => [
                'required',
                'string',
                'regex:' . self::REGEX_PHONE,
            ],
            'track_individual' => 'required|in:1,2,3,4,5,6,7,8,9,10,11,12,13,14,15',
            'description_individual' => 'required|string|min:1|max:10000',
            'confirmation_individual' => 'required|accepted',
            'files_individual' => 'required|array|min:1|max:1',
            'files_individual.*' => 'required|file|mimes:pptx,pdf|max:32768',
        ];
    }

    protected function saveApplication(array $validated)
    {
        $timestamp = now()->timestamp;

        return new $this->modelClass([
            'person_name' => $validated['person_name_individual'],
            'email' => $validated['email_individual'],
            'phone' => $validated['phone_individual'],
            'track_individual' => $validated['track_individual'],
            'description' => $validated['description_individual'],
            'submit_date' => $timestamp
        ]);
    }
}
