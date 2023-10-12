<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lote;
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
        
        $request = $request->json()->all();

        if (!is_array($request) || empty($request)) {
            return response()->json(['message' => 'Error en el formato de datos'], 400);
        }     

        $paquetesAConsolidar = $request['Paquetes'];

        foreach ($paquetesAConsolidar as $paquete) {
        $lote = new Lote();
        $lote->lote = $paquete['lote'];
        $lote->estatus = $paquete['estatus'];
        $lote->paqueteId = $paquete['paqueteId'];
        $lote->camionId = $paquete['camionId'];        
        $lote->save();
        Paquete::where('id', $paquete['paqueteId'])->delete();
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

        $lote = Lote::all();
        return response()->json($lote);

    }

    public function Actualizar(Request $request, $loteId)
    {
        
        $nuevoEstatus = $request->input('estatus');
    
        try {
        
            $lote = Lote::findOrFail($loteId);   
            $lote->estatus = $nuevoEstatus;  
            $lote->save();
    
            

            return response()->json($lote);
        } catch (\Exception $e) {
           
            return response()->json(['error' => 'Error al actualizar el estatus del lote.'], 500);
        }
       
    }
    
    


    private function cumpleRequisitos($paquete)
{
 
    if ($paquete->departamento != $paquete->lote->departamento) {
        return false;
    }

    return true;
}

}
