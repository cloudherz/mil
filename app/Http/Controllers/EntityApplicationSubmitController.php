<?php

namespace App\Http\Controllers;

use App\Models\Entity;

class EntityApplicationSubmitController extends ApplicationSubmitController
{
    protected string $modelClass = Entity::class;

    protected function getValidationRules(): array
    {
        return [
            'application_type_entity' => 'required|in:entity',
            'organization_name' => [
                'required',
                'string',
                'min:2',
                'max:512',
                'regex:' . self::REGEX_ORGANIZATION_NAME,
            ],
            'organization_tin' => 'required|digits_between:1,12',
            'organization_representative' => [
                'required',
                'string',
                'min:2',
                'max:256',
                'regex:' . self::REGEX_PERSON_NAME,
            ],
            'email_entity' => 'required|email|min:5|max:256|regex:' . self::REGEX_EMAIL,
            'phone_entity' => [
                'required',
                'string',
                'regex:' . self::REGEX_PHONE,
            ],
            'track_1' => 'nullable|required_without_all:track_2,track_3|in:1,2,3,4,5',
            'track_2' => 'nullable|required_without_all:track_1,track_3|in:1,2,3,4,5',
            'track_3' => 'nullable|required_without_all:track_1,track_2|in:1,2,3,4,5',
            'description_entity' => 'required|string|min:1|max:10000',
            'confirmation_entity' => 'required|accepted',
            'files_entity' => 'required|array|min:1|max:3',
            'files_entity.*' => 'required|file|mimes:pptx,pdf|max:32768',
        ];
    }

    protected function saveApplication(array $validated)
    {
        $timestamp = now()->timestamp;

        return new $this->modelClass([
            'organization_name' => $validated['organization_name'],
            'organization_tin' => $validated['organization_tin'],
            'organization_representative' => $validated['organization_representative'],
            'email' => $validated['email_entity'],
            'phone' => $validated['phone_entity'],
            'track_1' => $validated['track_1'] ?? null,
            'track_2' => $validated['track_2'] ?? null,
            'track_3' => $validated['track_3'] ?? null,
            'description' => $validated['description_entity'],
            'submit_date' => $timestamp
        ]);
    }
}
