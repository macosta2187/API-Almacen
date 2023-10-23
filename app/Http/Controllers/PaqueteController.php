<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paquete;
use App\Models\Lote;
use App\Models\Creas;
use App\Models\Empleado;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PaqueteController extends Controller
{



    public function obtenerTracking($identificadorUnico) {
        $fechaHoraActual = now();
        $año = $fechaHoraActual->year;
        $mes = str_pad($fechaHoraActual->month, 2, '0', STR_PAD_LEFT);
        $dia = str_pad($fechaHoraActual->day, 2, '0', STR_PAD_LEFT);
        $hora = str_pad($fechaHoraActual->hour, 2, '0', STR_PAD_LEFT);
        $minutos = str_pad($fechaHoraActual->minute, 2, '0', STR_PAD_LEFT);
        $segundos = str_pad($fechaHoraActual->second, 2, '0', STR_PAD_LEFT);
    
        
        $codigoDeSeguimiento = "TRACK_ADN2018" . $año . $mes . $dia . $hora . $minutos . $segundos . $identificadorUnico;
    
        return $codigoDeSeguimiento;
        //return response()->json($codigoDeSeguimiento);
    }


   use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

public function Insertar(Request $request)
{
           
        $paquete = new Paquete;
        $paquete->descripcion = $request->input('descripcion');
        $paquete->calle = $request->input('calle');
        $paquete->numero = $request->input('numero');
        $paquete->localidad = $request->input('localidad');
        $paquete->departamento = $request->input('departamento');
        $paquete->telefono = $request->input('telefono');
        $paquete->estado = $request->input('estado');
        $paquete->tamaño = $request->input('tamaño');
        $paquete->peso = $request->input('peso');
        $paquete->fecha_creacion = $request->input('fecha_creacion');
        $paquete->hora_creacion = $request->input('hora_creacion');
        $paquete->codigo_seguimiento = $this->obtenerTracking($request->input('identificadorUnico'));
        $paquete->save();

        return response()->json($paquete);

    
}


public function Listar()
{
    $paquetes = Paquete::all();
    return response()->json($paquetes);
}








}