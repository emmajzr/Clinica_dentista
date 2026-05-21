<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use Illuminate\Support\Facades\DB;

class PacientesController extends Controller
{
    public function index(){
        $pacientes = Paciente::with('user')->get();
        return response()->json($pacientes);
    }
}
