<?php

namespace App\Http\Controllers\Api;

use App\Models\Api\Departamento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartamentoController extends Controller
{

    private $departamento;

    public function __construct(Departamento $departamento){
        $this->departamento = $departamento;


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
     * @param  \App\Models\Api\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function show(Departamento $departamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Api\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function edit(Departamento $departamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Api\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Departamento $departamento)
    {
        $dataFrom= $request->all();
        $codepto = $request->input('codepto');

      // 
        $qtprod = $this->departamento->where("codepto",$codepto )->count();
  
        
       if($qtprod >0){
            
            $insert = $this->departamento->where("codepto",$codepto )->update( $dataFrom);
        }  
        else{
            $insert=  $this->departamento->insert( $dataFrom);
        }  

     
      
    if($insert )
        return ['satus'=>'1', 'mensagem'=>'sucesso ao alterar ou inserir'];
    else
        return ['satus'=>'2', 'mensagem'=>'Erro ao inserir'];
      

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Api\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departamento $departamento)
    {
        //
    }
}
