<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdutosCategorias extends Model
{
    protected $table ='produto_categoria';
    protected $primaryKey = 'categid';
    protected $guarded = ['categid'];
}
