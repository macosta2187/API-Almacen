<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Controllers\LoteController;

class Lote extends Model
{
  
    use SoftDeletes;
    use HasFactory;

    protected $table = 'lotes'; 
    protected $primaryKey = 'id'; 

    public function paquetes()
    {
        return $this->belongsToMany(Paquete::class, 'lote_paquetes', 'lote_id', 'paquete_id');
    }
    public function camion()
    {
        return $this->belongsTo(Camion::class, 'camionId');
    }

}


