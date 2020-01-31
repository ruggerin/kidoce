<?php

namespace App\Http\Controllers;

use App\rca;
use Illuminate\Http\Request;

class RcasController extends Controller
{
    private $rca;

    public function __construct(rca $rca){
        $this->rca = $rca;


    }
    public function index()
    {
        $title = 'Cadastro de Vendedores';
        $rcas =   $this->rca->orderBy('ativo','DESC')->get()->all();
         
       return view('usuarios', compact('rcas','title'));
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
     * @param  \App\rca  $rca
     * @return \Illuminate\Http\Response
     */
    public function show(rca $rca)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\rca  $rca
     * @return \Illuminate\Http\Response
     */
    public function edit($codrca)
    {
        
        $rca_atual= $this->rca->find($codrca);    
        $title="RCA|Edição Cadastro";    
        return view('usuario',compact('title','rca_atual'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\rca  $rca
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, rca $rca)
    {
        //return $request;

        $dataFrom= $request->except(['_token','_method']);
    
        $update=$this->rca->where("codrca",$rca->codrca )->update( $dataFrom);
        if($update)
        {
              $mensagem='Inserido com sucesso';
              return redirect()->route('listarcas','mensagem=1');
        }
        else
        {
              return redirect()->back();

        }
        //return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\rca  $rca
     * @return \Illuminate\Http\Response
     */
    public function destroy(rca $rca)
    {
        //
    }
}
