<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacientesController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pacientes',[PacientesController::class, 'index'])->name('pacientes.index');
