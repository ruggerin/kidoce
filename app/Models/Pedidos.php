<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    protected $table ='entregasc';
    protected $primaryKey = 'numped';
    protected $guarded = ['numped'];
}
