<?php

namespace App\Http\Controllers\Eudireto;

use App\Models\edclientsinc;
use App\Models\edexception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Sincronizacao extends Controller
{
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
     * @param  \App\Models\edclientsinc  $edclientsinc
     * @return \Illuminate\Http\Response
     */
    public function show(edclientsinc $edclientsinc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\edclientsinc  $edclientsinc
     * @return \Illuminate\Http\Response
     */
    public function edit(edclientsinc $edclientsinc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\edclientsinc  $edclientsinc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, edclientsinc $edclientsinc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\edclientsinc  $edclientsinc
     * @return \Illuminate\Http\Response
     */
    public function destroy(edclientsinc $edclientsinc)
    {
        //
    }

    public function validaSinc(Request $request){
        $edclientsinc = new edclientsinc();
        $cliente =  $edclientsinc->where('token',$request->token_account)->first();
        $cliente['ultsinc'] = date('Y-m-d H:i:s');
        $cliente->save();
        return  response()->json($cliente);


    }
    public function exceptions(Request $request){
        $edclientsinc = new edclientsinc();
        $cliente =  $edclientsinc->where('token',$request->token_account)->first();
        $edexception = new edexception();
        $edexception->descricao = $request->descricao;
       
        $edexception->clientid = $cliente->clientid ;
       if( $edexception->save()){
           return "sucesso";
       }else{
           return "erro";
       }


    }
}
