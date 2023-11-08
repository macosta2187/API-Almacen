<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ClientesController extends Controller
{
    
    public function Listar()
    {
        $clientes = Clientes::all();        
        return response()->json($clientes);
    }

}
