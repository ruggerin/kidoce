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
    public function store(Request $request,Produtos $produtos)
    {

        $dataFrom= $request->except(['_token','0']);
        $id = $request->input('produtoid');
        $dataFrom['precocusto']= str_replace($dataFrom['precocusto'], "," , "." );
        
        return $dataFrom['precocusto'];
       

        if($id !=0 ){
            $produto =    $produtos->find($id);
            $insert  = $produto->update( $dataFrom); 
        }else{
            $insert = $produtos->insert($dataFrom);
        }

        if($insert ){
           
            return redirect()->route('produtos.index')->with(['message'=> 'State saved correctly!!!']); 
        }    

        else
            return ['satus'=>'2', 'mensagem'=>'Erro ao inserir'];
      



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
    public function edit(Produtos $produtos, $id)
    {
        $produto = $produtos->find($id);
        $unidadeMedida = $this->pegarUnidadeMedida();
        $datareponse=['produto'=>$produto,'unidademedida' =>$unidadeMedida];
        return  $datareponse;
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
