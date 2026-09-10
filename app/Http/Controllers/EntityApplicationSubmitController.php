<?php

namespace App\Http\Controllers;

use App\Models\Entity;

class EntityApplicationSubmitController extends ApplicationSubmitController
{
    protected string $modelClass = Entity::class;

    protected function getValidationRules(): array
    {
        return [
            'application_type' => 'required',
            'person_name' => 'prohibited',
            'organization_name' => 'required',
            'organization_tin' => 'required',
            'organization_representative' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'track_student' => 'prohibited',
            'track_individual' => 'prohibited',
            'track_1' => 'required_without_all:track_2,track_3',
            'track_2' => 'required_without_all:track_1,track_3',
            'track_3' => 'required_without_all:track_1,track_2',
            'description' => 'required',
            'files_entity' => 'required|array|min:1|max:3',
            'files_entity.*' => 'required|file|max:204800',
        ];
    }

    protected function saveApplication(array $validated)
    {
        $timestamp = now()->timestamp;

        return new $this->modelClass([
            'organization_name' => $validated['organization_name'],
            'organization_tin' => $validated['organization_tin'],
            'organization_representative' => $validated['organization_representative'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'track_1' => $validated['track_1'],
            'track_2' => $validated['track_2'],
            'track_3' => $validated['track_3'],
            'description' => $validated['description'],
            'submit_date' => $timestamp
        ]);
    }
}
