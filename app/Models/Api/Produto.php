<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table ='produtos';
    protected $primaryKey = 'codprod';
}
