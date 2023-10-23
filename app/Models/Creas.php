<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;

class Creas extends Model
{
    use HasFactory;
    protected $table = 'crea_s';
    use SoftDeletes;



}

