<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Controllers\AlmacenController;

class Empleado extends Model
{
    protected $table = 'empleados';
    use SoftDeletes;
    use HasFactory;
}
