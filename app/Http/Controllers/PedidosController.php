<?php

namespace App\Http\Controllers;

use App\Models\Pedidos;
use App\Models\Carregamentos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidosController extends Controller
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
        $title = 'Registar Entrega';
        $vendedores= DB::select('select id ,nome from users ', [1]);
        return view('versao1.entrega_edit', compact('title','vendedores')); 
    }
    
    public function recalcurarCarregamento($numcarreg){
        $carregamentos = new Carregamentos(); 
        $qy_updatecarreg= DB::select("
        select 
            sum(entregasc.valor) valorcarga,
            sum(entregasc.volumes) volumes,
            sum(entregasc.peso) pesocarga,
            count(entregasc.numped) qtentregas
        from
            entregasc
        where
            numcarreg = $numcarreg 
        ");
        $carregamento               = $carregamentos->find($numcarreg);
        $carregamento->valorcarga   = $qy_updatecarreg[0]->valorcarga;
        $carregamento->volumes      = $qy_updatecarreg[0]->volumes;
        $carregamento->pesocarga    = $qy_updatecarreg[0]->pesocarga;
        $carregamento->qtentregas   = $qy_updatecarreg[0]->qtentregas;
        $carregamento->save();
        return true;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Pedidos $lojas )
    {
        
        $dataFrom= $request->except(['_token']);
        $dataFrom['numped']=0;

        $qry_seq = DB::select('select count(*)+1 contagem  from entregasc where numcarreg= ?', [$dataFrom['numcarreg']]);
        $dataFrom['seqent'] = $qry_seq[0]->contagem ;

        $numcarreg = $dataFrom['numcarreg'];
        $insert=$lojas->insert($dataFrom);
        if($insert)
        {
            $mensagem='Inserido com sucesso';
            if($dataFrom["numcarreg"]!='0' ){
                $this->recalcurarCarregamento($numcarreg);
                return '<script>window.close();</script>';
            }
            else {
                return redirect()->back();
            }     
        }
        else
        {
            return redirect()->back();
        }
    }
    public function listar($carregamento, Pedidos $pedidos){
        //return $carregamento;
        return $pedidos->where('NUMCARREG',$carregamento )->get([
        'seqent',
        'numped',
        'numnota',
        'codcliintegrador',
        'razaosocial',
        'bairro',
        'valor',
        'peso' ,
        'lat',
        'lgn' ,
        'codvendedor'  
       ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pedidos  $pedidos
     * @return \Illuminate\Http\Response
     */
    public function show(Pedidos $pedidos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pedidos  $pedidos
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Pedidos $pedidos)
    {
        $pedido = $pedidos->find($id);
        $title = "Edição de pedido $id";
        $vendedores= DB::select('select id ,nome from users ', [1]);
        return view('versao1.entrega_edit', compact('title','pedido','vendedores')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pedidos  $pedidos
     * @return \Illuminate\Http\Response
     */
    public function alterarposicaopedido(Request $request, Pedidos $pedidos){
        $dataFrom= $request->except(['_token','_method']);
        $pedido = $pedidos->find($dataFrom['numped']);
       // $pedidos =$dataFrom['numped'];
        $numcarreg = $pedido->numcarreg;
       
        $update =  $pedido->update($dataFrom);

        if($update)
        {
            $this->recalcurarCarregamento($numcarreg);
        return "Alterado com sucesso";   
        }
        else
        {
            return "erro";
        }
    }
    public function update($id,Request $request, Pedidos $pedidos)
    {
     
        $dataFrom= $request->except(['_token','_method']);
        $pedido = $pedidos->find($id);
       
        $mensagem = 'sucesso';
        $update = $pedido->update( $dataFrom);
        $numcarreg = $pedido->numcarreg;
        $this->recalcurarCarregamento($numcarreg);
        //print_r( $update);
        if($update)
        {
            if($dataFrom["numcarreg"]!='0' )
            return '<script>window.close();</script>';
        else {
            return redirect()->back();
        }    
        }
        else
        {
            return "erro";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pedidos  $pedidos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedidos $pedidos)
    {
        //
    }

    public function processarSequencia(Request $request){
        $pedidos =  $request->json()->all();
        
        foreach($pedidos as $reg):
            DB::update("update entregasc set seqent = " . $reg["sequence"] ." where numped  =".$reg["numped"] );
           // echo "update pcpedc set numseqmontagem = '" + $reg["sequence"] + "' where numped  ='" + $reg["numped"]+"'";
        endforeach;




    }
}
