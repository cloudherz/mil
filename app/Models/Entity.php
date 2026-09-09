<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    protected $table = 'entities';
    protected $primaryKey = 'entity_id';
    public $timestamps = false;

    protected $fillable = [
        'organization_name',
        'organization_tin',
        'organization_representative',
        'email',
        'phone',
        'track_1',
        'track_2',
        'track_3',
        'description',
        'submit_date',
    ];
}
