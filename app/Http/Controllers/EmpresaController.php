<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\Empresa;
use Illuminate\Support\Facades\DB;

class EmpresaController extends Controller
{


    


    public function Listar()
    {
        $empresas = Empresa::all();        
        return response()->json($empresas);
    }
    
    


}