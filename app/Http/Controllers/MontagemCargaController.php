<?php

namespace App\Http\Controllers;

use App\Models\Carregamentos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class MontagemCargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('versao1.montagemcarga');
    }

    public function RelacaoPedidos(Request $request){
       //    return $request;

       $dti = $request['dti'];
       $dtf = $request['dtf'];

       $pedidos = DB::select("select  numped, lat, lgn 
       from entregasc where status = 'P' 
       and 
       DATE_FORMAT(created_at,'%d/%m/%Y') between '$dti' and '$dtf'  and numcarreg is null");

       return response()->json($pedidos);
    }

    function pedidosSelecionados(Request $request){
        $pedidosin ="0";
        $pvendas =  $request['pvendas'];
        $psDraw = $request['pDraw'];
        //print_r($pvendas);
       // return $psDraw;
        $vertices_x =[];
        $vertices_y = [];
        foreach($psDraw as $pDraw):
            array_push($vertices_x,$pDraw["lat"]);
            array_push($vertices_y,$pDraw["lgn"]);
            //echo $pDraw["lat"];

            arsort($vertices_x);
            arsort($vertices_y);

        endforeach;


       // echo "Pontos que estão no quadradinho:\n";
        foreach($pvendas as $pvenda):
        $points_polygon = count($vertices_x) - 1;  // number vertices - zero-based array
        $longitude_x = $pvenda["lat"] ; // x-coordinate of the point to test
        $latitude_y =$pvenda["lgn"] ;  // y-coordinate of the point to test


        if (self::is_in_polygon($points_polygon, $vertices_x, $vertices_y, $longitude_x, $latitude_y)){
            $pedidosin .=','.$pvenda["numped"];
        }
        
        endforeach;

        $pedidosConsolidados = DB::select("select seqent ,
        numped ,
        numnota ,
        codcliintegrador ,
        razaosocial ,
        bairro ,
        valor ,
        peso  ,
        lat ,
        lgn  ,
        codvendedor   from entregasc where numped in ($pedidosin)");
        return response()->json($pedidosConsolidados);
        
    }



    function is_in_polygon($points_polygon, $vertices_x, $vertices_y, $longitude_x, $latitude_y) {
        $i = $j = $c = 0;
        for ($i = 0, $j = $points_polygon ; $i < $points_polygon; $j = $i++) {
            if ( (($vertices_y[$i]  >  $latitude_y != ($vertices_y[$j] > $latitude_y)) &&
            ($longitude_x < ($vertices_x[$j] - $vertices_x[$i]) * ($latitude_y - $vertices_y[$i]) / ($vertices_y[$j] - $vertices_y[$i]) + $vertices_x[$i]) ) )
            $c = !$c;
        }
        return $c;
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
    public function edit(Carregamentos $carregamentos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Carregamentos  $carregamentos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Carregamentos $carregamentos)
    {
        //
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
}
