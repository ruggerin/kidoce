<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    protected $table ='produtos';
    protected $primaryKey = 'produtoid';
    protected $guarded = ['produtoid'];
}
