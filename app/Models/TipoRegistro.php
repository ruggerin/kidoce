<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoRegistro extends Model
{
    protected $table ='tiporegistro';
    protected $primaryKey = 'tiporegid';
    protected $guarded = ['tiporegid'];

}
