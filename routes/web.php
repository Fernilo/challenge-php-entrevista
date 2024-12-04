<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropiedadesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/admin.php';
require __DIR__.'/auth.php';