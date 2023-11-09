<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Controllers\AlmacenController;

class Almacen extends Model
{
    protected $table = 'almacen_es';
    use SoftDeletes;
    use HasFactory;
}
