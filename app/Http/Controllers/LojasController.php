<?php

namespace App\Http\Controllers;
use App\Models\lojas;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class LojasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(lojas $lojas)
    {
        $title = 'Cadastro de Lojas';
        $lojas =  $lojas->all();
        return view('versao1.lojas', compact('lojas','title')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Nova Loja';
        return view('versao1.lojaedit', compact('title')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,lojas $lojas )
    {
        $dataFrom= $request->except(['_token']);
        $messages = [

            'razaosocial.required' => 'Por favor informe a razão social'
    
        ];
        $validatedData = $request->validate([
            'razaosocial' => 'required|max:150'
        ],$messages);
       
    
        $insert=$lojas->insert($dataFrom);
        if($insert)
        {
            $mensagem='Inserido com sucesso';
            echo($mensagem);
            return redirect()->route('lojas.index');
        }
        else
        {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, lojas $lojas)
    {
        $loja = $lojas->find($id);
        $title = "Edição de Lojas $id";
        
        return view('versao1.lojaedit', compact('title','loja')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, lojas $lojas)
    {
        $dataFrom= $request->except(['_token','_method']);
        $loja = $lojas->find($id);
       
        $mensagem = 'sucesso';
        $update = $loja->update( $dataFrom);
        //print_r( $update);
        if($update)
        {
            $mensagem='Inserido com sucesso';
            return redirect()->route('lojas.index')->with(['message'=> 'State saved correctly!!!']);
        }
        else
        {
            return "erro";
        }
      
    }
    public function infoloja($id,lojas $lojas){

        $loja = $lojas->where("codintegracao",$id)->get(['lojaid',
        'razaosocial','fantasia','endereco','numero',
        'bairro','pontoreferencia','lat','lgn']);

        return $loja; 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function buscarLoja(Request $request){
        //codintegracao=&cnpj=&razaosocial=&fantasia=
        $where=" lojaid >0 and excluido = 0 ";
        $where.= $request['codintegracao']!=null? ' and codintegracao='. $request['codintegracao']: '';
        $where.= $request['mcnpj']!=null? ' and cnpj='. $request['mcnpj']."'": '';
        $where.=   $request['mrazaosocial']!=null? " and razaosocial like('".$request['mrazaosocial']."%')": '';
        $where.=   $request['mfantasia']!=null? " and fantasia like('". $request['mfantasia']."%')": '';
        
         return response()->json(DB::select("select * 
         from lojas 
         where  " .$where));
    }
}
