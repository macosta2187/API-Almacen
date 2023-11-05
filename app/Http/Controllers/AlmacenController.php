<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use Illuminate\Http\Request;

class AlmacenController extends Controller
{

    public function Insertar(Request $request)
    {

       
        $almacen = new Almacen;
        $almacen->nombre = $request->input('nombre');
        $almacen->calle = $request->input('calle');
        $almacen->numero = $request->input('numero');
        $almacen->localidad = $request->input('localidad');
        $almacen->departamento = $request->input('departamento');
        $almacen->telefono = $request->input('telefono');
        $almacen->latitud = $request->input('latitud');
        $almacen->longitud = $request->input('longitud');
        $almacen->save();
        return response()->json(['message' => 'Almacén creado exitosamente'], 200);

    }

    public function Eliminar(Request $request, $id)
    {

        $almacen = Almacen::find($id);

        if ($almacen) {
            $almacen->delete();
            return response()->json(['error' => 'El almacén esta borrado'], 200);
        }

        return response(['error' => 'El almacén no existe'], 404);
    }

    public function Listar(Request $request)
    {

        $almacen = Almacen::all();
        return response()->json($almacen);
    }

    public function Actualizar(Request $request, $idalmacen)
    {

        $almacen = Almacen::findOrFail($idalmacen);       
        $almacen->nombre = $request->input('nombre');
        $almacen->calle = $request->input('calle');
        $almacen->numero = $request->input('numero');
        $almacen->localidad = $request->input('localidad');
        $almacen->departamento = $request->input('departamento');
        $almacen->telefono = $request->input('telefono');
        $almacen->latitud = $request->input('latitud');
        $almacen->longitud = $request->input('longitud');

        $almacen->save();   
        
        return response()->json($almacen);

    }

    public function edit(Almacen $almacen)
    {
        return view('Editar', compact('almacen'));
    }
}
