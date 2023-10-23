<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Controllers\LoteController;

class Lote extends Model
{
   // protected $table = 'lotes';    
    use SoftDeletes;
    use HasFactory;

    protected $table = 'lotes'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'id'; // Nombre de la clave primaria

    public function paquetes()
    {
        return $this->belongsToMany(Paquete::class, 'lote_paquete', 'lote_id', 'paquete_id');
    }
    public function camion()
    {
        return $this->belongsTo(Camion::class, 'camionId');
    }

}


