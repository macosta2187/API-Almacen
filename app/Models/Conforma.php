<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conforma extends Model
{
    //protected $table = 'conformas';
    protected $fillable = ['lote', 'descripcion', 'telefono', 'paqueteid'];
    use SoftDeletes;
    use HasFactory;
}
