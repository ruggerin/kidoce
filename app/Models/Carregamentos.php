<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carregamentos extends Model
{
    //    
    
    protected $table ='carregamentos';
    protected $primaryKey = 'numcarreg';
    protected $guarded = ['numcarintegracao'];


}
