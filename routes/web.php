<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.generic.landing');
})->name('landing');
