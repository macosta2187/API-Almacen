<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Producto;
use App\Models\Almacen;
use App\Models\Lote;
use App\Models\Clientes;
use App\Models\Lotes;
use App\Models\Paquete;
use App\Models\Empleado;
use App\Models\LotePaquete;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Factories\Factory;



class ExampleTest extends TestCase
{
   

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

    public function test_listarAlmacen()
    {

        $response = $this->get('http://127.0.0.1:8003/api/Almacen');
        $response->assertStatus(200);
    }
    
    public function test_listarClientes()
    {

        $response = $this->get('http://127.0.0.1:8003/api/clienteci');
        $response->assertStatus(200);
    }
    

       public function test_listarEmpresas()
    {

        $response = $this->get('http://127.0.0.1:8003/api/empresa');
        $response->assertStatus(200);
    }

    public function testListarPaquetes()
    {
        $response = $this->get('http://127.0.0.1:8003/api/Paquete'); 
        $response->assertStatus(200);
    }

    public function testListarEmpleado()
    {
        $response = $this->get('http://127.0.0.1:8003/api/empleado'); 
        $response->assertStatus(200);
    }


    public function testInsertarAlmacen()
    {
        
        $data = [
            'nombre' => 'Prueba',
            'calle' => 'Prueba',
            'numero' => '123',
            'localidad' => 'Prueba',
            'departamento' => 'Prueba',
            'telefono' => '123456759',
            'latitud' => '12.3456',
            'longitud' => '-78.9012',
        ];

       
        $response = $this->json('POST', 'http://127.0.0.1:8003/api/Almacen', $data);      
        $response->assertStatus(200);
        
        $response->assertJson([
            'message' => 'Almacén creado exitosamente',
        ]);        
        $this->assertDatabaseHas('almacen_es', ['nombre' => $data['nombre']]);
    }


  


    public function testInsertarClienteValido()
    {
        $data = [
            'nombre' => 'Prueba',
            'apellido' => 'Prueba',
            'email' => 'prueba@prueba.com',
            'ci' => '14802303',
            'direccion' => 'Prueba',
            'departamento' => 'Prueba',
            'telefono' => '123456789',
        ];
    
       
        $response = $this->json('POST', 'http://127.0.0.1:8003/api/cliente', $data);
    
       
        $response->assertStatus(200);  
        $response->assertJson(['message' => 'Cliente insertado con éxito']);   
       
        $this->assertDatabaseHas('clientes', ['ci' => $data['ci']]);
    }




    public function testListarChoferes()
    {
      
    $response = $this->get('http://127.0.0.1:8003/api/choferes');   
    $response->assertStatus(200);   
    $response->assertHeader('Content-Type', 'application/json');

    }

    public function testInsertarEmpresa()
{
    
    $data = [
        'RUT' => '123456789010',
        'nombre' => 'Empresa de Prueba',
        'calle' => 'Calle de Prueba',
        'numero' => 123,
        'localidad' => 'Localidad de Prueba',
        'departamento' => 'Departamento de Prueba',
        'telefono' => '9876543210',
    ];

    
    $response = $this->json('POST', 'http://127.0.0.1:8003/api/empresaInsertar', $data); 

    
    $response->assertStatus(200);
    
    $response->assertHeader('Content-Type', 'application/json');    
    $response->assertJson(['message' => 'Empresa insertada con éxito']);    
    $this->assertDatabaseHas('empresas', ['RUT' => $data['RUT']]);

    
}



}
