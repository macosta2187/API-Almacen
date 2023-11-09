<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Chofer;
use App\Models\funcionario;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rule;

class EmpleadoController extends Controller
{


    public function Listar()
    {
        $empleados = Empleado::all();    
        return response()->json($empleados);
    }
    

    public function listarChoferes()
    {
        $choferes = Empleado::where('op_chofer', true)->get();
    
        return response()->json($choferes);
    }

}
