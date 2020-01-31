<?php

namespace App\Http\Controllers\Api;

use App\Models\Api\Produto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProdutosController extends Controller
{

    private $produto;

    public function __construct(Produto $produto){
        $this->produto = $produto;
  

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\Api\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Api\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Api\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       
        $dataFrom= $request->all();
        $codprod = $request->input('codprod');

      // 
        $qtprod = $this->produto->where("codprod",$codprod )->count();
        
       if($qtprod >0){
            
            $insert = $this->produto->where("codprod",$codprod )->update( $dataFrom);
        }  
        else{
            $insert=  $this->produto->insert( $dataFrom);
        }  

     
      
    if($insert )
        return ['satus'=>'1', 'mensagem'=>'sucesso ao alterar ou inserir'];
    else
        return ['satus'=>'2', 'mensagem'=>'Erro ao inserir'];
      

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Api\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        //
    }
}
