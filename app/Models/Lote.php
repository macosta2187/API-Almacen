<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Controllers\LoteController;

class Lote extends Model
{
    protected $table = 'lotes';    
    protected $fillable = ['paqueteId', 'lote', 'estatus','camionId'];
    use SoftDeletes;
    use HasFactory;

   
}


