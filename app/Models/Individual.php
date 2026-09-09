<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Individual extends Model
{
    protected $table = 'individuals';
    protected $primaryKey = 'individual_id';
    public $timestamps = false;

    protected $fillable = [
        'person_name',
        'email',
        'phone',
        'track_individual',
        'description',
        'submit_date',
    ];
}
