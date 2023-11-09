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
    

    
    public function Insertar(Request $request)
{
    $rules = [
        'RUT' => 'required|string|max:12|unique:empresas',
        'nombre' => 'required|string|max:25',
        'calle' => 'required|string|max:50',
        'numero' => 'required|integer',
        'localidad' => 'required|string|max:25',
        'departamento' => 'required|string|max:25',
        'telefono' => 'required|string|max:12',
    ];

    $messages = [
        'RUT.size' => 'El RUT debe tener una longitud de 12 caracteres.',
    ];

    $request->validate($rules, $messages);

    $empresa = new Empresa;
    $empresa->RUT = $request->input('RUT');
    $empresa->nombre = $request->input('nombre');
    $empresa->calle = $request->input('calle');
    $empresa->numero = $request->input('numero');
    $empresa->localidad = $request->input('localidad');
    $empresa->departamento = $request->input('departamento');
    $empresa->telefono = $request->input('telefono');
    $empresa->save();

    
    return response()->json(['message' => 'Empresa insertada con éxito'], 200);
}

    


}