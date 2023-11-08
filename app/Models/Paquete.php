<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paquete extends Model
{
    use HasFactory;
    protected $table = 'paquetes';
    use SoftDeletes;
   



    public function lotes()
    {
        return $this->belongsToMany(Lote::class, 'lote_paquetes', 'paquete_id', 'lote_id');
    }

    public function empleados()
    {
        return $this->belongsToMany(Empleado::class, 'crea_s', 'id_paquete', 'id_func');
    }



    public function almacenes()
{
    return $this->belongsToMany(Almacen::class, 'almacena_s', 'id_paquete', 'id_almacen');
}

public function cliente()
{
    return $this->belongsTo(Clientes::class, 'cliente_ci', 'ci');
}


}