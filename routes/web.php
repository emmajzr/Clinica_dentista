<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PacientesController; // Asegúrate de importar el controlador PacientesController
use App\Http\Controllers\DentistasController; // Asegúrate de importar el controlador DentistasController
use App\Http\Controllers\AdminController; // Asegúrate de importar el controlador AdminController
use App\Http\Controllers\DashboardController; // Asegúrate de importar el controlador DashboardController
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
 
Route::middleware('auth', 'paciente')->group(function () {
    Route::get('/paciente/register',[PacientesController::class, 'registro_informacion'])->name('paciente.register');
    Route::post('/paciente/register', [PacientesController::class, 'guardarRegistro'])->name('paciente.register.store');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth', 'dentista')->group(function () {
    // Rutas para dentistas
    Route::get('/dentista/dashboard', [DentistasController::class, 'dashboard'])->name('dentista.dashboard');
    
    // Ruta para ver la lista de pacientes
    Route::get('/dentista/pacientes',
    [DentistasController::class, 'pacientes'])->name('dentista.pacientes');

    // Ruta para crear un nuevo paciente
    Route::get('dentista/pacientes/crear',
    [DentistasController::class, 'crearPaciente'])->name('dentista.pacientes.crear');
    
    // Ruta para guardar paciente
    Route::post('/dentista/pacientes',
    [DentistasController::class, 'guardarPaciente'])->name('dentista.guardarPaciente');
});

Route::middleware('auth', 'admin')->group(function () {

    // Rutas para administradores
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Ruta para ver la lista de dentistas
    Route::get('/admin/dentistas', function () {
        // Aquí puedes obtener la lista de dentistas desde la base de datos y pasarlos a la vista
        return view('admin.dentistas');
    })->name('admin.dentistas');

    // Ruta para crear un nuevo dentista
    Route::get('/admin/dentistas/crear', function () {
        return view('admin.crear_dentista');
    })->name('admin.dentistas.crear');
    
    // Ruta para guardar dentista
    Route::post('/admin/dentistas', function (Request $request) {
        // Aquí puedes validar y guardar el nuevo dentista en la base de datos
        // Luego redirige a la lista de dentistas o a otra página según sea necesario
        return redirect()->route('admin.dentistas');
    })->name('admin.guardarDentista');

});
require __DIR__.'/auth.php';
