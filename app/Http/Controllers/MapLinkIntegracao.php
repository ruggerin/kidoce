<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedidos;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

class MapLinkIntegracao extends Controller
{
    function chaveMaplink(){
        //Gera a chave de acesso
       $url = "https://lbslocal-prod.apigee.net/oauth/client_credential/accesstoken?grant_type=client_credentials";
       $data = "client_id=ZHc3pTsaqLvAlKVu7cRkxGNzNbi4PO5Q&client_secret=VVk229beVUcZvWoZ";

       // 
       $options = array(
           'http' => array(
               'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
               'method'  => 'POST',
               'content' => ($data)
           )
       );
       $context  = stream_context_create($options);
       $result = file_get_contents($url, false, $context);
       if ($result === FALSE) {  }
       $resposta = json_decode($result,true);
      return $resposta["access_token"];
    }

    function processplanningmaplink(Request $request){
        //return phpinfo();
        self::teste_receive_maplink($request);
        $info = $request->json()->all();
        $problemId = $info[0]["id"];
        if($info[0]["description"] ==  "TERMINATE"||$info[0]["description"] ==  "SOLVED" ){
            $jobId = $info[0]["jobId"];
           
            DB::update("update carregamentos set  job_id ='$problemId' where planing_id= '$jobId' ");
            self::deserializeSolutionPlanning($jobId);        }
      
    }
    function teste_receive_maplink(Request $request){
         $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
        $myfile = fopen("testfile.txt", "w");
        $txt = $request;
        fwrite($myfile, $txt);
        fclose($myfile);
        
        DB::insert("insert into teste(detalhe) values ('$request')");

    }
    function deserializeSolutionPlanning($jobId){
        $token =  self::chaveMaplink();
        $curl = curl_init();
 
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://lbslocal-prod.apigee.net/planning/v1/solutions/$jobId",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS =>  "",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $token",
                "Content-Type: application/json",
 
                "cache-control: no-cache"
              ),
        ));
 
        $response = curl_exec($curl);
        $err = curl_error($curl);
 
        curl_close($curl);
  
        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            //echo $response;
       
        }
 
        $response = json_decode($response,true);
      
        $objetos = $response;
        $objetos =  $objetos["vehicleRoutes"][0]["routes"][0]["activities"] ;
        $rejeicoes =  $response["rejectOperations"] ;
        $kmprev =(int) $response["indicators"]["totalDistance"];
        $kmprev =   $kmprev/1000;
        $kmmeta =  $kmprev * 1.20 ;
        $ltporKm = 5;
        $combprev =  $kmmeta/$ltporKm;
        $precocobustivel = 3.655;
        $vlcomvprev = $combprev*$precocobustivel;
        $totaltime = (int) $response["indicators"]["totalTime"];
      
        
        DB::update("update carregamentos set kmtotalprev = $kmprev  where planing_id= '$jobId'");
       // DB::update("update df_carreg set LTCOBPREV = $combprev  where planing_id= '$jobId'");
       // DB::update("update df_carreg set VLCOBPREV = $vlcomvprev  where planing_id= '$jobId'");
        DB::update("update carregamentos set kmtotalmeta =  $kmmeta  where planing_id= '$jobId'");
        DB::update("update carregamentos set tempopercursoprev =  $totaltime  where planing_id= '$jobId'");
 
        $seq = 1;
        foreach ($objetos as $atividade):
         if($atividade["activity"]=="DELIVERY"){
             $numped = $atividade["site"];
             DB::update("update entregasc set seqent = $seq where numped = $numped ");
             $seq++;
          
 
         }
         
        endforeach ;
         
         foreach($rejeicoes as $numpedreject):
              $cliinfo = DB::select("select codcliintegrador from pcpedc where numped =".$numpedreject );
 
              DB::update("update entregasc set seqent = $seq where numped = $numpedreject ");
              $seq++;
 
              DB::insert("insert into erromaplink(jobid,numped,codcliintegrador) values( '".$jobId. "',". $numpedreject. ",".$cliinfo[0]->codcli." )");
         endforeach;    
         $totalsegundosmeta =  ($totaltime +  $seq*30); 
         //90 minutos de almoço  = 9000 segundos
         //25 minutos por ponto de venda = 1500; 
        // DB::update("update carregamentos set dtretornometa =  dtsaida + DATE_ADD(  $totalsegundosmeta,'second')  where PLANING_ID= '$jobId'");
         DB::update("update carregamentos set dtretornometa =   DATE_ADD( dtsaida,interval   $totalsegundosmeta SECOND)  where planing_id= '$jobId'");
       // return $objetos;
 
     }

     function sendMapLink($numcar,Pedidos $pedidos){
             
        // $numcar = "90873";
         $idJob= "default";
         
         //Serialização a partir do modelo
         $myfile = fopen("maplinkjsonstruture.json", "r");
         $fsize = filesize("maplinkjsonstruture.json");       
         $valoresArquivo = json_decode( fread($myfile, $fsize),true);
       
         fclose($myfile);
         $pedidosArray = $pedidos->where('NUMCARREG',$numcar )->get([
            'seqent',
            'numped',
            'numnota',
            'codcliintegrador',
            'razaosocial',
            'bairro',
            'valor',
            'peso',
            'lat',
            'lgn'
           ]);
   
         $sites = [];
         $operations = [];
        // return $pedidosArray;
         foreach($pedidosArray as $pedido):
             $site = [
                 'name'=> $pedido->numped,
                 'coordinates'=>  ['latitude'=>  (float)$pedido->lat, 'longitude'=> (float)$pedido->lgn ],
                 'logisticConstraints'=>"DEFAULT"    
             ];
             array_push($sites,$site);
           
             $operation = [
                 "id"=>$pedido->numped,
                 "priority"=> 0, //Prioridade, quanto maior o número, maior a prioridade
                 "weight" => 1, //peso em kg
                 "volume"=> 1,
                 "product"=>"DEFAULT",
                 "type"=> "DELIVERY",
                 "depotSite"=> "CD",
                 "customerSite"=> $pedido->numped,
                 "customerTimeWindows"=>[],
                 "preAllocatedVehicleName"=> null
                 
             ];
             $customerTimeWindows = ["start"=> 1513756800000,"end"=>1513771200000 ];
             array_push($operation["customerTimeWindows"], $customerTimeWindows);
             array_push($operations, $operation);
         endforeach;    
         $valoresArquivo["sites"]= $sites;
         $valoresArquivo["operations"]= $operations;
 
         //return  $valoresArquivo;
         
         $token = self::chaveMaplink();
 
         //return json_encode($valoresArquivo, true);
 
         $curl = curl_init();
         curl_setopt_array($curl, array(
             CURLOPT_URL => "https://lbslocal-prod.apigee.net/planning/v1/problems",
             CURLOPT_RETURNTRANSFER => true,
             CURLOPT_ENCODING => "",
             CURLOPT_MAXREDIRS => 10,
             CURLOPT_TIMEOUT => 30,
             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
             CURLOPT_CUSTOMREQUEST => "POST",
             CURLOPT_POSTFIELDS =>   json_encode($valoresArquivo, true),
             CURLOPT_HTTPHEADER => array(
                 "Authorization: Bearer $token",
                 "Content-Type: application/json",
                 "Postman-Token: c15530e8-fa7a-482d-9024-069ef1f66774",
                 "cache-control: no-cache"
               ),
         ));
 
         $response = curl_exec($curl);
         $err = curl_error($curl);
 
         curl_close($curl);
   
         if ($err) {
             echo "cURL Error #:" . $err;
         } else {
             echo $response;
             $idJob = json_decode($response, true)["id"];
            DB::update('update carregamentos set planing_id = ? where numcarreg = ?', [ $idJob,$numcar]);
         }
 
        
    } 
}
