<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class LotePaquete extends Model
{
    use HasFactory;
    protected $table = 'lote_paquetes';
    use SoftDeletes;
}
