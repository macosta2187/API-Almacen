<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paquete;
use App\Models\Lote;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaqueteController extends Controller
{



    public function Insertar(Request $request){        

    $paquete = new Paquete;
    $paquete->descripcion = $request->input('descripcion');
    $paquete->calle = $request->input('calle');
    $paquete->numero = $request->input('numero');    
    $paquete->localidad = $request->input('localidad'); 
    $paquete->departamento = $request->input('departamento');
    $paquete->telefono = $request->input('telefono');
    $paquete->estatus = $request->input('estatus');
    $paquete->tamaño = $request->input('tamaño');
    $paquete->peso = $request->input('peso');  
    $paquete->fecha = $request->input('fecha');  
    $paquete->hora = $request->input('hora');      

    $paquete->save();
    return response()->json($paquete);

   
}



public function Listar(Request $request)
{

    $paquete = Paquete::all();
    return response()->json($paquete);
}





}