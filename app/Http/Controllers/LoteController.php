<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lote;
use App\Models\LotePaquete;
use App\Models\Conforma;
use App\Models\Paquete;


use Illuminate\Http\Request;

class LoteController extends Controller
{
    public function Insertar(Request $request)
    { 
        $lote = Lote::create($data);
        return response()->json(['message' => 'Lote creado con éxito', 'data' => $lote], 201);
    }
           


    public function crearLotes(Request $request)
    {
        $requestData = $request->json()->all();
    
        if (!is_array($requestData) || empty($requestData)) {
            return response()->json(['message' => 'Error en el formato de datos'], 400);
        }
    
        $estado = "Consolidado";
        $paquetesSeleccionados = json_decode($requestData['selectedPackages'], true)['Paquetes'];
    
        if (isset($requestData['selectedCamion'])) {
            $camionId = $requestData['selectedCamion'];
        } else {           
            return response()->json(['message' => 'Camión no seleccionado'], 400);
        }
    
        foreach ($paquetesSeleccionados as $paquete) {
            $lote = new Lote(); 
            $lote->camionId = $camionId;     
            $lote->estado = $estado;  
            $lote->save();
    
            $lote->paquetes()->attach($paquetesSeleccionados);
            Paquete::whereIn('id', $paquetesSeleccionados)->delete();
        }
    
        return response()->json(['message' => 'Lotes guardados exitosamente'], 200);
    }
    
    


    public function Eliminar(Request $request, $id)
    {

        $lote = Lote::find($id);

        if ($lote) {
            $lote->delete();
            return response()->json(['error' => 'El Lote esta borrado'], 200);
        }

        return response()->json(['error' => 'El Lote no existe'], 404);
    }


    public function Listar()
    {
        $lotes = Lote::leftJoin('lote_paquetes', 'lotes.id', '=', 'lote_paquetes.lote_id')
            ->select('lotes.id', 'lotes.camionId', 'lotes.estado', 'lote_paquetes.paquete_id')
            ->get();
    
        return response()->json($lotes);
    }
    

    public function Actualizar(Request $request, $loteId)
    {
        
        $nuevoEstatus = $request->input('estatus');
    
        try {
        
            $lote = Lote::findOrFail($loteId);   
            $lote->estado = $nuevoEstatus;  
            $lote->save();
    
            

            return response()->json($lote);
        } catch (\Exception $e) {
           
            return response()->json(['error' => 'Error al actualizar el estatus del lote.'], 500);
        }
      
       
        
    }
    
    public function ActualizarEstado(Request $request, $paqueteId)
    {
        
        $nuevoEstatus = $request->input('estado');    
        try {
        
            $paquete = Paquete::findOrFail($paqueteId);   
            $paquete->estado = $nuevoEstatus;  
            $paquete->save();    
            

            return response()->json($paquete);
        } catch (\Exception $e) {
           
            return response()->json(['error' => 'Error al actualizar el estatus del paquete.'], 500);
        }
    

    }
    





}
