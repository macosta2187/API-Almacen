<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Producto;
use App\Models\Almacen;
use App\Models\Lote;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Testing\WithFaker;

class ExampleTest extends TestCase
{
    public function test_listarAlmacen()
    {

        
        $response = $this->get('http://127.0.0.1:8003/api/Almacen');
        $response->assertStatus(200);

        $logData = [
            'ruta' => 'http://127.0.0.1:8003/api/Almacen',
            'calle' => $response->getStatusCode(),
            'numero' => $response->getContent(),
            'localidad' => $response->getContent(),
            'departamento' => $response->getContent(),
            'telefono' => $response->getContent(),
           
        ];

        Log::info('Almacenes Lista', $logData);
    }

    public function test_InsertaAlmacen()
    {
        $check = true;

        $almacen = [

            'nombre' => 'TEST',
            'calle' => 'TEST',
            'numero' => '1234',
            'localidad' => '1234',
            'ciudad' => 'TEST',
            'departamento' => 'TEST',
            'telefono' => '1234',

        ];

        $response = $this->post('http://127.0.0.1:8003/api/Almacen', $almacen);
        $response->assertStatus(200);

        $logData = [
            'ruta' => 'http://127.0.0.1:8003/api/Almacen',
            'nombre' => $response->getStatusCode(),
            'calle' => $response->getStatusCode(),
            'numero' => $response->getContent(),
            'localidad' => $response->getContent(),
            'ciudad' => $response->getContent(),
            'departamento' => $response->getContent(),
            'telefono' => $almacen,
        ];

        Log::info('Almacen insertado', $logData);
    }


    public function test_InsertaPaquete()
    {
        $check = true;

        $paquete = [

            'descripcion' => 'TEST',
            'calle' => 'TEST',
            'numero' => '1234',
            'localidad' => 'TEST',
            'departamento' => 'TEST',
            'telefono' => '1234',
            'estatus' => 'Ingresado',
            'tamaño' => 'Grande',
            'peso' => '5',
            'fecha' => '20141231',
            'hora' => '23:59:59',

        ];

        $response = $this->post('http://127.0.0.1:8003/api/Paquete', $paquete);
        $response->assertStatus(200);

        $logData = [
            'ruta' => 'http://127.0.0.1:8003/api/Almacen',
            'descripcion' => $response->getStatusCode(),
            'calle' => $response->getStatusCode(),
            'numero' => $response->getContent(),
            'localidad' => $response->getContent(),
            'departamento' => $response->getContent(),
            'telefono' => $response->getContent(),
            'departamento' => $response->getContent(),
            'estatus' => $response->getContent(),
            'tamaño' => $response->getContent(),
            'peso' => $response->getContent(),
            'fecha' => $response->getContent(),
            'hora' => $paquete,
        ];

        Log::info('Paquete insertado', $logData);
    }

    public function test_ListarPaquetes()
    {
        $response = $this->get('http://127.0.0.1:8003/api/Paquete');
        $response->assertStatus(200);

        $logData = [
            'ruta' => 'http://127.0.0.1:8003/api/Paquete',
            'descripcion' => $response->getStatusCode(),
            'calle' => $response->getContent(),
            'numero' => $response->getContent(),
            'calle' => $response->getContent(),
            'localidad' => $response->getContent(),
            'departamento' => $response->getContent(),
            'telefono' => $response->getContent(),
            'estatus' => $response->getContent(),
            'tamaño' => $response->getContent(),
            'peso' => $response->getContent(),
            'fecha' => $response->getContent(),
            'hora' => $response->getContent(),
            

        ];

        Log::info('Listado de Paquetes', $logData);
    }


    public function test_listarLote()
    {
        $response = $this->get('http://127.0.0.1:8003/api/Lote');
        $response->assertStatus(200);

        $logData = [
            'ruta' => 'http://127.0.0.1:8002/api/Lote',
            'lote' => $response->getStatusCode(),
            'estatus' => $response->getContent(),
            'paqueteId' => $response->getContent(),
            'camionId' => $response->getContent(),
        ];

        Log::info('Istado de Lotes', $logData);
    }

    

}
