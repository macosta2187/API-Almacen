<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paquete;
use App\Models\Lote;
use App\Models\Creas;
use App\Http\Controllers\TrackingController;
use App\Models\Empleado;
use App\Models\Almacena;
use App\Models\Clientes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;


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
        
        
        
    }


    public function ValidarInsertar(Request $request)
    {
        return $request->validate([
            'descripcion' => 'required|max:50',
            'calle' => 'required|max:50',
            'numero' => 'required|integer|max:99999',
            'localidad' => 'required|max:25',
            'departamento' => 'required|max:25',
            'telefono' => 'required|max:9',
            'empresa' => 'required',
            'cliente_ci' => 'required|exists:clientes,ci', 
        ]);
    }


    public function Insertar(Request $request)
    {
        $this->ValidarInsertar($request);
    
        $cliente = Clientes::where('ci', $request->input('cliente_ci'))->first();
    
        if (!$cliente) {            
            return response()->json(['message' => 'Cliente no encontrado']);
        }
    
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
        $paquete->empresa = $request->input('empresa');
        $paquete->cliente_ci = $request->input('cliente_ci');
        $email = $cliente->email;
       
    
        $identificadorUnico = $request->input('identificadorUnico');
        $codigoDeSeguimiento = $this->obtenerTracking($identificadorUnico);
        $paquete->codigo_seguimiento = $codigoDeSeguimiento;
        $paquete->save();
        
    
        if ($paquete->estado === 'En almacén destino') {
            $almacen = Almacen::where('departamento', $paquete->departamento)->first();
    
            if (!$almacen) {
                
                return response()->json(['message' => 'No se encontró un almacén para el departamento del paquete']);
            }
    
            $almacena = new Almacena;
            $almacena->id_paquete = $paquete->id;
            $almacena->id_almacen = $almacen->id;
            $almacena->save();
        }
    
        $resultado = $this->enviarCorreo( $email, $paquete->descripcion, $paquete->codigo_seguimiento, $paquete->estado);
    
        return response()->json(['message' => 'Paquete insertado con éxito'], 200);
    }

    public function enviarCorreo($correoDestino, $paquetedes, $paqueteTracking, $estado) {
        $nombreDestino = '';
        
        $datos = [
            'mensaje' => 'Su paquete ' . $paquetedes . ' se encuentra ' . '  ' . $estado . '  ' . $paqueteTracking . ' Agradecemos su preferencia.',
        ];
        
        if (!empty($correoDestino)) {
            Mail::send('correo.mensaje', $datos, function($message) use ($correoDestino, $nombreDestino) {
                $message->to($correoDestino, $nombreDestino)
                        ->subject('Información de Sistema Automática');
            });
    
            return response()->json(['message' => "Correo enviado a $correoDestino"]);
        } else {
            return response()->json(['error' => "No se pudo enviar el correo"], 400);
        }
    }
    
    public function paquetesEnAlmacenDestino()
    {
        $paquetes = Paquete::where('estado', 'En almacén destino')->get();
        
        return response()->json(['paquetes' => $paquetes]);
    }
    

public function Listar()
{
    $paquetes = Paquete::all();
    return response()->json($paquetes);
}

public function guardarRelacion($id_empleado, $id_paquete)
{
    $creas = new Creas();
    $creas->id_func = $id_empleado;
    $creas->id_paquete = $id_paquete;
    $creas->save();

    if ($creas) {
        return response()->json(['message' => 'Relación guardada con éxito']);
    } else {
        return response()->json(['error' => 'No se pudo guardar la relación'], 500);
    }
}








}