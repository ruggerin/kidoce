<?php

namespace App\Http\Controllers\Api;

use App\clientes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
{

    public function __construct(Clientes $cliente){
        $this->cliente = $cliente;
        //$this->middleware('auth');

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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function show(/*Request $request*/)
    {
     
        $objeto =  DB::select("
        select 
        *
        from 
        lojas 
       
        ");
       ;
        return response()->json(['status'=>true,'data'=> $objeto]);
        


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function edit(clientes $clientes)
    {
       
        $dataFrom= $request->all();
        $codcli = $request->input('CODCLI');

      // 
        $users = $this->cliente->where("CODCLI",$codcli )->count();
     
        
       if($users >0){
            
            $insert = $this->cliente->where("CODCLI",$codcli )->update( $dataFrom);
        }  
        else{
            $insert=  $this->cliente->insert( $dataFrom);
        }  

     
      
    if($insert )
        return ['satus'=>'1', 'mensagem'=>'sucesso na alteração'];
    else
        return ['satus'=>'2', 'mensagem'=>'Erro ao inserir'];
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, clientes $clientes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function destroy(clientes $clientes)
    {
        //
    }
}
