<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'student_id';
    public $timestamps = false;

    protected $fillable = [
        'person_name',
        'email',
        'phone',
        'track_student',
        'description',
        'submit_date',
    ];
}
