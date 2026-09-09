<?php

use App\Http\Controllers\EntityApplicationSubmitController;
use App\Http\Controllers\IndividualApplicationSubmitController;
use App\Http\Controllers\StudentApplicationSubmitController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.generic.landing');
})->name('landing');

Route::post('/application_submit_student', [StudentApplicationSubmitController::class, 'applicationSubmit'])->name('application_submit_student');
Route::post('/application_submit_individual', [IndividualApplicationSubmitController::class, 'applicationSubmit'])->name('application_submit_individual');
Route::post('/application_submit_entity', [EntityApplicationSubmitController::class, 'applicationSubmit'])->name('application_submit_entity');
