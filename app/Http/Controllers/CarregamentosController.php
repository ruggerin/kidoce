<?php

namespace App\Http\Controllers;

use App\Models\Carregamentos;
use Illuminate\Http\Request;
use DB;


class CarregamentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $carregamentos;
    public function __construct(Carregamentos $carregamentos){
        $this->carregamentos = $carregamentos;
        
    }
    public function index(Carregamentos $carregamentos)
    {
        //$carregamentos = $carregamentos->all();
        
        $carregamentos = DB::select("
        select
        numcarreg,
        numcarintegracao,
        destino,
        status,
        (select  users.nome from users where users.id = carregamentos.codmotorista ) motorista
        from
        carregamentos
        where status not in('D','I')
        
        ");
        $title ='Carregamentos';
        return view('versao1.carregamento_index',compact('title','carregamentos'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Carregamentos $carregamentos)
    {
        $carregamento = new Carregamentos();
        $carregamento->numcarreg= 0;
        //$insert=$carregamentos->insert($dataFrom)->numcarreg;
        $carregamento->save();
       // return $carregamento->numcarreg;
        $id = $carregamento->numcarreg;
       // return $this->edit( $id );
      return redirect()->route('carregamentos.edit',$id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Carregamentos $carregamentos)
    {
     

     
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carregamentos  $carregamentos
     * @return \Illuminate\Http\Response
     */
    public function show(Carregamentos $carregamentos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carregamentos  $carregamentos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {      
       $carregamento =  $this->carregamentos->find($id);
       $title ='Manutenção de carregamento';
      // return $carregamento;
      $motoristas= DB::select('select id codmotorista,nome from users ', [1]);
     // return $motoristas;
      return view('versao1.carregamento_edit', compact('carregamento','title','motoristas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Carregamentos  $carregamentos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $dataFrom= $request->except(['_token','_method']);
        $carregamento = $this->carregamentos->find($id);
       
        $dataFrom["status"]="W";
        
        $update= $carregamento->update($dataFrom);

        if($update)
        {
            $mensagem='Inserido com sucesso';
            return redirect()->route('carregamentos.index')->with(['message'=> 'State saved correctly!!!']);
        }
        else
        {
            return "erro";
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carregamentos  $carregamentos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carregamentos $carregamentos)
    {
        //
    }
    public function rlt_carregamentos_index(){
        $motoristas= DB::select('select id codmotorista,nome from users ', [1]);
        $title  = 'Relatório de Carregamentos';
        return view('versao1.rlt_entregas_index', compact('title','motoristas'));
    }

    public function buscarCarregamentos(Request $request){
        //codintegracao=&cnpj=&razaosocial=&fantasia=
        $where=" numcarreg >0  ";
        $dti = $request['dti'];
        $dtf = $request['dtf'];
        
        $where.= " and dtsaida between str_to_date('$dti' , '%d/%m/%Y') and str_to_date('$dtf' , '%d/%m/%Y') "; 
        $where.= $request['codmotorista']!=0? ' and codmotorista='. $request['codmotorista']: '';
        $where.= $request['numcarreg']!=null? ' and numcarreg='. $request['numcarreg']: '';
        
        return response()->json(DB::select("select 
        carregamentos.numcarreg,
        tradedev.carregamentos.codmotorista,
        (select users.nome from users where carregamentos.codmotorista  = users.id) motorista,
        tradedev.carregamentos.destino,
        tradedev.carregamentos.dtsaida,
        tradedev.carregamentos.dtretorno,
        tradedev.carregamentos.valorcarga,
        tradedev.carregamentos.qtentregas
        from
        carregamentos
        where  " .$where));
    }


    public function buscarPosicao(Request $request){
        //codintegracao=&cnpj=&razaosocial=&fantasia=
        $where=" numcarreg >0  ";
        $dti = $request['dti'];
        $dtf = $request['dtf'];
        $entregador = [];
        /*
        $where.= "  "; 
        /*$where.= $request['codmotorista']!=0? ' and codmotorista='. $request['codmotorista']: '';
        $where.= $request['numcarreg']!=null? ' and numcarreg='. $request['numcarreg']: '';
        */
        $entregador["iduser"] =  $request['codmotorista'];
        $defaultColor ="#FF0000";
        $dadosEntregador = DB::select(" select users.nome,coalesce( users.markercolor,'$defaultColor') markercolor from users where users.id = ? ", [ $request['codmotorista']]);
        $entregador["nome"] = $dadosEntregador[0]->nome;
        $entregador["markercolor"] =$dadosEntregador[0]->markercolor;
        $entregador["posicoes"] = DB::select("select 
        
         histlocusers.DTCAPTURA,
         histlocusers.LATITUDE,
         histlocusers.LONGITUDE
         from 
         histlocusers where ID_USER = ".$request['codmotorista']."  and DTCAPTURA between str_to_date('$dti' , '%d/%m/%Y %H:%i') and str_to_date('$dtf' , '%d/%m/%Y  %H:%i') order by DTCAPTURA") ;
         print_r(json_encode( $entregador));
        
    }

    public function imprimirDetalhesCarregamento($numcar){
        $carregamento = (DB::select("select 
        carregamentos.numcarreg,
        tradedev.carregamentos.codmotorista,
        (select users.nome from users where carregamentos.codmotorista  = users.id) motorista,
        coalesce(tradedev.carregamentos.destino,'**') destino,
        tradedev.carregamentos.dtsaida,
        tradedev.carregamentos.dtretorno,
        tradedev.carregamentos.valorcarga,
        tradedev.carregamentos.qtentregas,
        coalesce(carregamentos.observacao,'**') observacao,
        coalesce(kminicial,'**') kminicial,
        coalesce(kmfinal,'**')kmfinal,
        coalesce(kmtotal,'**') kmtotal

        from
        carregamentos where numcarreg = $numcar"));

        $entregas = DB::select(" select coalesce(entregasc.vlrfrete,'0.00') vlrfrete,seqent, numped,numnota, codcliintegrador, ROUND(valor,2) valor,razaosocial,chegada_datahora, saida_datahora from entregasc where numcarreg = $numcar order by seqent");
        return view('versao1.rlt_entregas_analitico', compact('carregamento','entregas'));
        
    }

    function posicaogeograficaPeriodo(){
        $motoristas= DB::select('select id codmotorista,nome from users ', [1]);
        $title  = 'Posição geográfica';
        return view('versao1.rlt_posicaogeografica', compact('motoristas','title'));
    }
   

  
}
