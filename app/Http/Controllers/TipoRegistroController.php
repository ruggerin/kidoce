<?php

namespace App\Http\Controllers;

use App\Models\TipoRegistro;
use Illuminate\Http\Request;

class TipoRegistroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TipoRegistro $tipoRegistro)
    {
        $title = 'Tipo de Registros';
        $tiporegistros =  $tipoRegistro->all();
        //return $tiporegistros;
        return view('versao1.vwtiporegistros', compact('tiporegistros','title')); 
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
    public function store(Request $request,TipoRegistro $tipoRegistro)
    {
        $dataFrom= $request->except(['_token']);
        $id = $request->input('tiporegid');

      // 
        $users =  $tipoRegistro->where("tiporegid",$id )->count();
     
        
       if($users >0){
            
            $insert =  $tipoRegistro->where("tiporegid",$id )->update( $dataFrom);
        }  
        else{
            $insert=   $tipoRegistro->insert( $dataFrom);
        }  

     
      
        if($insert ){
            $tiporegistros =$tipoRegistro->all();
            return redirect()->route('tipoderegistros.index')->with(['message'=> 'State saved correctly!!!']); 
        }    

        else
            return ['satus'=>'2', 'mensagem'=>'Erro ao inserir'];
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoRegistro  $tipoRegistro
     * @return \Illuminate\Http\Response
     */
    public function show(TipoRegistro $tipoRegistro)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoRegistro  $tipoRegistro
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoRegistro $tipoRegistro,$id)
    {
        $tipoproduto = $tipoRegistro->find($id);
        return $tipoproduto;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoRegistro  $tipoRegistro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoRegistro $tipoRegistro)
    {
        return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoRegistro  $tipoRegistro
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoRegistro $tipoRegistro)
    {
        //
    }
}
