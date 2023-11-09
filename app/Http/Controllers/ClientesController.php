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

    

    public function Insertar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:50',
            'apellido' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'ci' => 'required|string|max:8|unique:clientes',
            'direccion' => 'required|string|max:50',
            'departamento' => 'required|string|max:50',
            'telefono' => 'required|max:9',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['message' => 'Error de validación', 'errors' => $validator->errors()], 400);
        }
    
        try {
            $cliente = new Clientes;
            $cliente->nombre = $request->input('nombre');
            $cliente->apellido = $request->input('apellido');
            $cliente->email = $request->input('email');
            $cliente->ci = $request->input('ci');
            $cliente->direccion = $request->input('direccion');
            $cliente->departamento = $request->input('departamento');
            $cliente->telefono = $request->input('telefono');
            $cliente->save();
    
            return response()->json(['message' => 'Cliente insertado con éxito'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al insertar cliente', 'error' => $e->getMessage()], 500);
        }

    }
}
