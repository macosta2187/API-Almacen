<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Producto;
use App\Models\Almacen;
use App\Models\Lote;
use Illuminate\Foundation\Testing\WithFaker;

class ExampleTest extends TestCase
{
    public function test_listarAlmacen()
    {
        $response = $this->get('http://127.0.0.1:8003/api/Almacen');
        $response->assertStatus(200);   
  
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
    
      
    }


    public function test_InsertaPaquete()
    {            
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
    

    }
    

    public function test_ListarPaquetes()
    {
        $response = $this->get('http://127.0.0.1:8003/api/Paquete');
        $response->assertStatus(200);
    
       
    }   


    public function test_listarLote()
    {
        $response = $this->get('http://127.0.0.1:8003/api/Lote');
        $response->assertStatus(200);
    
        
    }
    

    

}
