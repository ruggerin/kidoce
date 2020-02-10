<?php

namespace App\Http\Controllers;

use App\Models\teste_cego;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Pesquisa extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('versao1.pesquisa');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\teste_cego  $teste_cego
     * @return \Illuminate\Http\Response
     */
    public function show(teste_cego $teste_cego)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\teste_cego  $teste_cego
     * @return \Illuminate\Http\Response
     */
    public function edit(teste_cego $teste_cego)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\teste_cego  $teste_cego
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, teste_cego $teste_cego)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\teste_cego  $teste_cego
     * @return \Illuminate\Http\Response
     */
    public function destroy(teste_cego $teste_cego)
    {
        //
    }
}
