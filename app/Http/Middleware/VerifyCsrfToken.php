<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        "/testecadcli",
        "/subircadprod",
        "/subirdepartamento",
        "/retclientes",
        "/maplinkplanning",
        //Aplicação android temporaria
        "/api/login",
        "/api/romaneio",
        '/api/v1-0/updata/localizacao',
        '/api/v1-0/updata/localizacao/statusentrega',
        '/api/eudireto/v1/atualizacao',
        '/api/eudireto/v1/exceptions',
        '/montagemcarga/t'
    ];
}
