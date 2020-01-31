<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\histlocuser;
use App\Models\Pedidos;

class AppClientBeta extends Controller
{
    function LoginApp(Request $request){
        $tabela =  DB::select(" 
        SELECT COUNT(*) autenticado
        FROM 
        users 
        WHERE 
        usuarioapp ='".$request->input('usuarioapp')."' 
        and senhaapp ='".$request->input('senhaapp')."' 
        ");

        /* $request->input('CODCLI');*/
        /* return $tabela;*/
        $dados_usuario = null;

        if( $tabela[0]->autenticado ==1){
            $dados_usuario =  DB::select(" 
            select 
                users.nome,
                users.id
            
            from  
                users
            
            WHERE
                USUARIOAPP ='".$request->input('usuarioapp')."' 
                and SENHAAPP ='".$request->input('senhaapp')."' 
            ");
    
        }
      


        return response()->json(['validacao'=> $tabela, 'dados'=>$dados_usuario]);
       
    }

    public function Romaneio(Request $request){
        $codmot = $request['codmot'];
       $tabela =  DB::select("
        select
        entregasc.seqent sequencia,
        coalesce(entregasc.codcliintegrador,0) codcli,
        entregasc.razaosocial,
        entregasc.fantasia,
        entregasc.endereco,
        entregasc.numero,
        entregasc.bairro,
        0 cep,
        entregasc.municipio,
        entregasc.uf,
        entregasc.pontodereferencia,
        entregasc.codvendedor rca,
        (select users.nome from users where users.id = entregasc.codvendedor) vendedor,
        coalesce(entregasc.lat,0) latitude,
        coalesce(entregasc.lgn,0) longitude,
        entregasc.telefonecli telefone,
        entregasc.numcarreg numcar,
        entregasc.valor vlrentrega,
        entregasc.numnota,
        entregasc.numped,
        entregasc.chegada_datahora,
        entregasc.saida_datahora,
        entregasc.updated_at
        from
        entregasc ,carregamentos
        where entregasc.numcarreg = carregamentos.numcarreg
        and carregamentos.codmotorista =  $codmot " );
        return response()->json(['status'=>true,'message'=>'Dados Consolidados com sucesso','data'=> $tabela]);;
    }

    function receive_gps_usuario_v2(Request $request, histlocuser $histlocuser){
        $dataUltima ="";
        $lat="";
        $lgn ="";
        $id_user ="";

        $coordenadasArray =  $request->json()->all();
        
        foreach($coordenadasArray as $reg):
            $contReg=  DB::select("select count(*) cont from histlocusers where ID_USER = ".$reg["ID_USER"]." AND DTCAPTURA = '". $reg["DTCAPTURA"]."'" );
            if($contReg[0]->cont==0){
                $insert= $histlocuser->insert($reg);
            }
           // return $reg;
          
            if(strlen($dataUltima)>0){
                if( $dataUltima < $reg["DTCAPTURA"] ){
                    $dataUltima =  $reg["DTCAPTURA"];
                    $lat = $reg["LATITUDE"];
                    $lgn = $reg["LONGITUDE"];
                    $id_user = $reg["ID_USER"];
                   
                }
            }
            else{
                $dataUltima =  $reg["DTCAPTURA"];
                $lat = $reg["LATITUDE"];
                $lgn = $reg["LONGITUDE"];
                $id_user = $reg["ID_USER"];
            }



        endforeach; 
         DB::update("update users set ultpos_lat = ".$lat.", ultpos_lgn= ".$lgn.", ultpos_hora ='".$dataUltima."' where id = ".$id_user);
        

        return  response()->json(['data'=> array(['status'=>'1', 'mensagem'=>'sucesso na alteração'])]);
       


    }
    function UltimaLocalizacaoMotoristas(){
       
        $query = "SELECT id codmotorista, 
             nome,
            ultpos_lat lat,
            ultpos_lgn lgn,

            ultpos_hora dthora,
            markercolor markercolor
            FROM users 
            WHERE markercolor is not null"
        ;

        $tbl = DB::select($query);
        return response()->json(['data'=>$tbl]);

    }
    
    public function AtualizarStatusEntrega(Request $request, Pedidos $df_entregas){

        $dataFrom= $request->all();
        $numped = $request->input('numped');

      
        $entregas =$df_entregas->where("numped",$numped )->count();
        
        if( $entregas >0){                
            $insert = $df_entregas->where("numped",$numped )->update( $dataFrom);
        }  
        else{
            $insert= $df_entregas->insert( $dataFrom);
        }          
     
        if($insert )
            return  response()->json(['data'=> array(['status'=>'1', 'mensagem'=>'sucesso na alteração'])]);
        else
            return  response()->json(['data'=>array(['status'=>'2', 'mensagem'=>'Erro ao inserir'])]);
    }
  

}
