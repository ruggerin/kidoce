<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

//CLASSE PASSPORT
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    /*anterior a utilização do Passport*/
    //use Notifiable;
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['lojaid'];
    /*protected $fillable = [
        'name', 'email', 'password',
    ];
    //*
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
