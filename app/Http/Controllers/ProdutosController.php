<?php

namespace App\Http\Controllers;

use App\Models\Produtos;
use App\Models\ProdutosCategorias;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProdutosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Produtos $produtos)
    {
        
        $produtos =  $produtos->paginate(10);;
        $title = "Produtos";
        $unidadeMedida = $this->pegarUnidadeMedida();
        $categorias = $this->pegarCategorias();
       // return $produtos;
        return view('versao1.produtos', compact('produtos','title','categorias')); 
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
     * @param  \App\Models\Produtos  $produtos
     * @return \Illuminate\Http\Response
     */
    public function show(Produtos $produtos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produtos  $produtos
     * @return \Illuminate\Http\Response
     */
    public function edit(Produtos $produtos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produtos  $produtos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produtos $produtos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produtos  $produtos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produtos $produtos)
    {
        //
    }

    public function pegarCategorias(){
        $categorias = new ProdutosCategorias();
        return $categorias->all(); 
    }

    public function pegarUnidadeMedida(){
        $unidadeMedida = new \App\Models\UnidadeMedida();
        return $unidadeMedida->all();

    }
}