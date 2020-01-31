@extends('template1')
@push('csss')
<link href="{{ asset('ambiente/plugins/multi-select/css/multi-select.css')}}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('ambiente/plugins/datatables/dataTables.min.css')}}">
<link rel="stylesheet" type="text/css"href="{{ asset('ambiente/plugins/datatables/RowReorder-1.2.4/css/rowReorder.bootstrap.min.css')}}">

@endpush

@section('content')


<div class="block-header">
    <h2>Carregamento:<b> {{$numcar}}</b></h2>
</div>

<!-- Basic Example | Horizontal Layout -->
<div class="row clearfix ">
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Estimativas</h2>
                <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);">Action</a></li>
                            <li><a href="javascript:void(0);">Another action</a></li>
                            <li><a href="javascript:void(0);">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!--#INÍCIO CORPOCARD-->
            <div class="body" style =" max-height:440px;  overflow:auto;" >    
                <div class="row">
                    <div class="col-sm-4 col-md-4 col-lg-4" style="margin-bottom: 0px" >
                        Data Entrega
                        <p><b>1500</b></p>                      
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4" style="margin-bottom: 0px" >
                        Valor Carga
                        <p><b>1500</b></p>                      
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4" style="margin-bottom: 0px">
                       Peso
                        <p><b>1500kg</b></p>                      
                    </div>

                    <div class="col-sm-4 col-md-4 col-lg-4" style="margin-bottom: 0px">
                      Qtd Entregas
                        <p><b>1500</b></p>                      
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4" style="margin-bottom: 0px">
                        Vrl Lucro
                        <p><b>1500</b></p>                      
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4" style="margin-bottom: 0px">
                        Despesas
                        <p><b>1500</b></p>                      
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4" style="margin-bottom: 0px">
                        Perc. Prev.
                        <p><b>1500</b></p>                      
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4" style="margin-bottom: 0px">
                        Comb. Prev.
                        <p><b>50.56 lt</b></p>                      
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4" style="margin-bottom: 0px">
                        T. Desl. Prev.
                        <p><b>50.56 lt</b></p>                      
                    </div>
                </div>
                
   
            </div>
            <!--#FIM# CORPOCARD-->  

        </div>
    </div>



<!-- Basic Example | Horizontal Layout -->


<div id="div-mapa"  class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
        <div class="card">
            <div class="header">
                <h2>
                    DISTRIBUIÇÃO GEOGRÁFICA
                </h2>
                <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:mapamaximizar('div-mapa');" class=" waves-effect waves-block">Maximizar</a></li>
                            <li><a href="javascript:minimizar('div-mapa');" class=" waves-effect waves-block">Another action</a></li>
                            <li><a href="javascript:void(0);" class=" waves-effect waves-block">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body">
                <div id="map" name="map" class="gmap" style="position: relative; overflow: hidden;"> </div>
        
            </div>


        </div>
    </div>


    <div id="div-tab-pedidos" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Filtros</h2>
                <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:mapamaximizar('div-tab-pedidos');">Action</a></li>
                            <li><a href="javascript:minimizar('div-tab-pedidos');">Another action</a></li>
                            <li><a href="javascript:void(0);">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!--#INÍCIO CORPOCARD-->
            <div class="body">    
                <div class="demo-masked-input">
                    <div class="row clearfix">
                        <div class="col-sm-4 col-md-4 col-lg-4">                    
                            <button type="button" class="btn bg-cyan waves-effect" data-toggle="tooltip" data-placement="top"  data-original-title="Calcular melhor sequencia" onclick='solicitarSequenciamento(0)'>
                                <i class="material-icons">map</i>
                                <span>Auto-Sequenciar</span>
                            </button>
                        </div>    
                    </div> 
                </div>
                <div class="table-responsive">               
                    <table  id="tablepedidos" width="300%" class="table" >
                    <thead>
                        <tr>                            
                            <th>Seq</th>
							<th>Num. Ped</th>
							<th>Cod. Cli.</th>							
							<th>Cliente</th>
							<th>Fantasia</th>
							<th>Endereço</th>
							<th>Número</th>
							<th>Bairro</th>
							<th>Valor Pedido</th>
							<th>Data Pedido</th>
							<th>Vendedor</th>
                        </tr>
                    </thead>
                   
                    </table>
                </div>    
            </div>

</div>
</div>







            <!-- #END# Basic Example | Horizontal Layout -->
@endsection
@push('scripts')
  <!-- Maps API Javascript -->
    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCC5-US8dhMNUh6yFNd9Sw_4LqnnVT042A"></script>
    
    <script src="{{ URL::asset('ambiente/js/pages/ui/tooltips-popovers.js')}}"></script>

    <script src="{{ URL::asset('ambiente/plugins/datatables/datatables.min.js')}}"></script>
	
    <script src="{{ URL::asset('ambiente/plugins/datatables/RowReorder-1.2.4/js/dataTables.rowReorder.min.js')}}"></script>

<script>
var realtime = 'off';
function updateRealTime() {
      
        var timeout;
        if (realtime == 'on') {
            //alert("arra");
            return 0;
            timeout = setTimeout(updateRealTime, 320);

            
        } else {
            clearTimeout(timeout);
        }
    }

    updateRealTime();
/*
    $('#realtime').on('change', function () {
        realtime = this.checked ? 'on' : 'off';
        updateRealTime();
    });

*/
var map;
var table;
var pontos;

function solicitarSequenciamento(){
    $.ajax({
        url: '/maplinksequencia/consolidar/{{$numcar}}',
        /* dataType: 'body',*/
        method:'get',
        success: function(response) {
            console.log(response);
            table.ajax.reload();
            recarregarPontos();
        
        },
        error: function (request, status, erro) {
            table.ajax.reload();
            recarregarPontos();
            //alert("Problema ocorrido: " + status + "\nDescição: " + erro);
            //alert("Informações da requisição: \n" + request.getAllResponseHeaders());
        }
               
    });      
}

function recarregarPontos(){
  pontos =   table.rows().data();

  startMapa();

   $.each(pontos, function(index, ponto) {
       if(ponto.latitude == null){
           console.log("Cliente sem coordenadas cadastradas:"+ponto.codcli);
       }
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(ponto.latitude, ponto.longitude),
            title: ponto.seq,
            label: ponto.seq,
            map: map
        });
        var infowindow = new google.maps.InfoWindow(), marker;
 
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                var iwContent = 
                    '<div style="font-size: 16px;font-weight: bold;">'+ponto.codcli+"-"+ ponto.cliente + '</div>' +
                    '<div style="	padding: 15px 15px 15px 0;">' + 
                    ponto.fantasia  + '<br>' +
                    ponto.enderent  + '<br>'+
                    ponto.bairroent	+ '<br>'+
                    'Valor:' + ponto.vltotal+'<br>'+
                    'Observações: '+ ponto.obs
                    +'</div>'  
                ;

                infowindow.setContent( iwContent);
                infowindow.open(map, marker);
            }
        })(marker))
    });

}

function startMapa(){
var latlng = new google.maps.LatLng(-18.8800397, -47.05878999999999);
    var options = {
        zoom: 12,
		center: new google.maps.LatLng(-3.1349,-60.008),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("map"), options);

}
startMapa();



function pinSymbol(color) {
    return {
        path: 'M 0,0 C -2,-20 -10,-22 -10,-30 A 10,10 0 1,1 10,-30 C 10,-22 2,-20 0,0 z',
        fillColor: color,
        fillOpacity: 1,
        strokeColor: '#000',
        strokeWeight: 2,
        scale: 1,
        labelOrigin: new google.maps.Point(0,-30)
        
    };
}
function mapamaximizar(div){
    document.getElementById(div).className = "col-lg-12 col-md-12 col-sm-12 col-xs-12";

}
function minimizar(div){
    document.getElementById(div).className = "col-xs-12 col-sm-12 col-md-6 col-lg-6";   
}
function abrirInfoBox(id, marker) {
	if (typeof(idInfoBoxAberto) == 'number' && typeof(infoBox[idInfoBoxAberto]) == 'object') {
		infoBox[idInfoBoxAberto].close();
	}

	infoBox[id].open(map, marker);
	idInfoBoxAberto = id;
}
$(document).ready(function() {
		 table = $('#tablepedidos').DataTable( {
			rowReorder: {
				selector: 'tr'
			},
			ajax: {
                url:'/consolidar/lstpedidos/{{$numcar}}',
            },
			columns:[
			{data:'seq' , className: 'reorder' },
			{data:'numped'},
			{data:'codcli'},
			{data:'cliente', 'width': '300px'},
			{data:'fantasia'},
			{data:'enderent'},
			{data:'numeroent'},
			{data:'bairroent'},
			{data:'vltotal'},
			{data:'data'},
			{data:'vendedor'}
			
			
			],
			rowReorder: {
				dataSrc: 'seq'
			},
            "initComplete": function(){
                recarregarPontos();
            }

			
			
		} );
		
		table.on( 'row-reorder', function ( e, diff, edit ) {
		    var pedidosReodernados =[];	
	
            for ( var i=0, ien=diff.length ; i<ien ; i++ ) {
                var rowData = table.row( diff[i].node ).data();
                pedidosReodernados[i] = {sequence :  diff[i].newData, numped: rowData['numped']};
            }
            if(pedidosReodernados.length >0){
           

            $.ajax({
                url: 'processarsequenciapedidos',
               /* dataType: 'body',*/
                data: JSON.stringify(pedidosReodernados) ,  
                method:'post',
               
                success: function(response) {
                   
                    table.ajax.reload();
                    recarregarPontos();
                
                },
                error: function (request, status, erro) {
                    table.ajax.reload();
                    recarregarPontos();
                    //alert("Problema ocorrido: " + status + "\nDescição: " + erro);
                    //alert("Informações da requisição: \n" + request.getAllResponseHeaders());
                }

                
            });               
            //table.ajax.reload();
            }
           
        });
        
	} );


</script>

<script src="{{ URL::asset('ambiente/plugins/jquery-steps/jquery.steps.js')}}"></script>

<!-- Moment Plugin Js -->
<script src="{{ URL::asset('ambiente/plugins/momentjs/moment.js')}}"></script>

<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="{{ URL::asset('ambiente/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>

<!--JS MASK INPUT-->
<script src="{{ URL::asset('ambiente/plugins/jquery-inputmask/jquery.inputmask.bundle.js')}}"></script>
@endpush