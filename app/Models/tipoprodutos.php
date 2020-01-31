<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tipoprodutos extends Model
{
    protected $table ='tipoproduto';
    protected $primaryKey = 'tipoprodid';
    protected $guarded = ['tipoprodid'];

}
