<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class lojas extends Model
{
    protected $table ='lojas';
    protected $primaryKey = 'lojaid';
    protected $guarded = ['lojaid'];

    /*
    public $rules=[
        'razaosocial'=>'required'
    ];
    */
}
