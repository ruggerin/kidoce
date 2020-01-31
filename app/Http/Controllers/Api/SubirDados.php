<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\clientes;




class SubirDados extends Controller
{
    private $cliente;

    public function __construct(Clientes $cliente){
        $this->cliente = $cliente;
  

    }
    public function Cadcli(Request $request){


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
}
