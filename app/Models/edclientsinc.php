<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class edclientsinc extends Model
{
    protected $table ='edclientsinc';
    protected $primaryKey = 'clientid';
    protected $guarded = ['clientid'];
}
