<?php

namespace App\Http\Controllers;

use App\Models\tipoprodutos;
use Illuminate\Http\Request;

class TipoProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(tipoprodutos $tipoprodutos)
    {
        $title = 'Cadastro de Tipo de Produtos';
        $tipoprodutos =  $tipoprodutos->paginate(10);;
        return view('versao1.tipoprodutos', compact('tipoprodutos','title')); 
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
     * @param  \App\Models\tipoprodutos  $tipoprodutos
     * @return \Illuminate\Http\Response
     */
    public function show(tipoprodutos $tipoprodutos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tipoprodutos  $tipoprodutos
     * @return \Illuminate\Http\Response
     */
    public function edit($id,tipoprodutos $tipoprodutos)
    {
        $tipoproduto = $tipoprodutos->find($id);
        return $tipoproduto;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tipoprodutos  $tipoprodutos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $gabi, tipoprodutos $tipoprodutos)
    {
        return $request;
        $dataFrom= $request->except(['_token','_method']);
        $id = $request->input('tipoprodid');
        $tipoproduto = $tipoprodutos->find($id);
        $update = $tipoproduto->update($dataFrom);
        return $dataFrom;
        if($update){
            $mensagem='Inserido com sucesso';
            return redirect()->route('tipoprodutos.index')->with(['message'=> 'State saved correctly!!!']);
        }
        else{
            return "erro";
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tipoprodutos  $tipoprodutos
     * @return \Illuminate\Http\Response
     */
    public function destroy(tipoprodutos $tipoprodutos)
    {
        //
    }
}
