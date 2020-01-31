@extends('versao1.template1')
@section('content')
<div class="block-header">
    <h2>Progresso de Entregas</h2>
    <div class="row clearfix">
        <div class="col-sm-3" style="width:150px;" >
       
            <div class="input-group" style="width:120px">
                <span class="input-group-addon">
                    <i class="material-icons">date_range</i>
                </span>
                <div class="form-line">
                    <input type="text" class="form-control datepicker" name="dtfim"  id ="dtfim" value="{{date('d/m/Y')}}" placeholder="Data Final" style="background:transparent" >
                </div>            
            </div>
        </div>
        <div class="col-sm-3">
            <button type="button" onClick="recarregar()" class="btn bg-purple btn-circle waves-effect waves-circle waves-float">
                <i class="material-icons">search</i>
            </button>
        </div>
    </div>    
 <!-- Widgets -->
 <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">send</i>
                        </div>
                        <div class="content">
                            <div class="text">ENTREGAS EFETUADAS</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" id="qtentegas" data-fresh-interval="20">-</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">local_shipping</i>
                        </div>
                        <div class="content">
                            <div class="text">VEÍCULOS MONITORADOS</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" id="qtVeiculos" data-fresh-interval="20">-</div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">timeline</i>
                        </div>
                        <div class="content" style="width:100%">
                            <div class="text">PROGRESSO DE ENTREGAS</div>
                           <!-- <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"></div>-->
                           <div class="progress"   >
                                <div class="progress-bar modal-pb-separacao progress-bar-striped active" role="progressbar" id="modal-pb-separacao" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                                    0%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-red hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">thumb_down</i>
                        </div>
                        <div class="content">
                            <div class="text">DEVOLUÇÕES</div>
                            <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20">-</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->

<div class="row clearfix">    
    <!-- Task Info -->
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Informação de Tarefas</h2>
                <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">cached</i>Atualizar</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">play_arrow</i>Ativar AutoRefresh</a></li>
                           
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-hover dashboard-task-infos" id="tbl_motoristas" >
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Motorista</th>                               
                                <th>Última Entrega</th>
                                <th>Cli. Atend.</th>
                                <th>Qtd. Dev.</th>
                                <th>Progresso Rota</th>
                            </tr>
                        </thead>
                        <tbody id="tbl-motoristas-body">
 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Task Info -->    
</div>
<!-- #END# row clearfix -->


    <div class="card">
        <div class="header">
            <h2>
                DISTRIBUIÇÃO GEOGRÁFICA MOTORISTAS
            </h2>
            <ul class="header-dropdown m-r--5">
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">more_vert</i>
                    </a>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Action</a></li>
                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Another action</a></li>
                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Something else here</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="body">
            <div id="map" name="map" class="gmap" style="position: relative; overflow: hidden;">
        </div>
    </div>

</div>
@endsection

@push('scripts')
<!-- GoogleMaps API Javascript -->
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCC5-US8dhMNUh6yFNd9Sw_4LqnnVT042A"></script>

<script>
var map;

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
function atualizarUltimaPosicao(){
    $.ajax({
        url: "{{ route('ultimaposicao') }}",
        dataType: 'json',   
        method:'get',
        success: function(response) {
            startMapa();
            $.each(response['data'], function(index, ponto) {
            var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(ponto.lat, ponto.lgn),
                    title: ponto.nome,
                    map: map,
                    icon : pinSymbol(ponto.markercolor),
                    
                });
            
            
                //InfoBox Ponto
                var infowindow = new google.maps.InfoWindow(), marker;
    
                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        var iwContent = 
                            '<div style="font-size: 16px;font-weight: bold;">'+ponto.codmotorista+"-"+ ponto.nome + '</div>' +
                            '<div style="	padding: 15px 15px 15px 0;">' +
                            'Hora Últ. Posi.: <b>' +ponto.dthora + '</b><br>'+
                            '</div>'
                        ;

                        infowindow.setContent( iwContent);
                        infowindow.open(map, marker);
                    }
                })(marker));
            
            

            });    
        // carregarHistLoc(); 

            

        },
        error:function(request, status, error) {
            console.log("ajax call went wrong:" + request.responseText);
        }
    });
}
function pinSymbol(color) {
    return {
        path: 'M 0,0 C -2,-20 -10,-22 -10,-30 A 10,10 0 1,1 10,-30 C 10,-22 2,-20 0,0 z',
        fillColor: color,
        fillOpacity: 1,
        strokeColor: '#000',
        strokeWeight: 2,
        scale: 1,
   };
}

function carregarHistLoc(){
    var myTrip=new Array();
    var teste;
    //var select = document.getElementById('motorista');
    //var motora = select.options[select.selectedIndex].value;
    var data = document.getElementById('dtfim').value;  
    
 

    $.ajax({
	url: '/entregas/rastromotorista',
    dataType: 'json',
    data: { codmotorista: 1509, dtref : '23/01/2019'} ,  
    method:'post',
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
	success: function(response) {
        //console.log(response['data']);
        for(var j = 0; j < response['data'].length;j++){   
            myTrip[j] = (new google.maps.LatLng(parseFloat(response['data'][j]['latitude']), parseFloat(response['data'][j]['longitude'])));
            
            var marker = new google.maps.Marker({
                position: myTrip[j],
                title: response['data'][j]['dtcaptura'],
                map: map,
                icon: {
                    path: google.maps.SymbolPath.CIRCLE,
                    scale: 1,
                    fillColor: '#000',
                    fillOpacity: 1,
                    strokeColor:  response['data'][j]['markercolor']
                },
            });
          
            var infowindow = new google.maps.InfoWindow(), marker;
          
            google.maps.event.addListener(marker, 'click', (function(marker) {
                return function() {
                    var iwContent = 
                        '<div style="font-size: 16px;font-weight: bold;">'+marker.title+ '</div>' +
                        '<div style="	padding: 15px 15px 15px 0;">' +                         
                        '<br></div>'  
                    ;

                    infowindow.setContent( iwContent);
                    infowindow.open(map, marker);
                }
            })(marker));
           
        }
      
        var flightPath = new google.maps.Polyline({
            path: myTrip,
            geodesic: true,
            strokeColor: response['data'][0]['markercolor'],
            strokeOpacity: 1.0,
            strokeWeight: 2
        });
        
        flightPath.setMap(map);

    },
	error:function(request, status, error) {
		console.log("ajax call went wrong:" + request.responseText);
	}
    });
}

function AtualizarPaineis(){
   // console.log('AtualizarPaineis()');
    var dataInfo = document.getElementById('dtfim').value;
    $.ajax({
        url: 'api/infoprogressorota',
        dataType: 'json',
        data: {datasaida: dataInfo},
        method: 'post',
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
          
            var totalMotoristas  = 0;
            var totalEntregas = 0;
            var totalDevolucoes  = 0;
            var entregasEfetuadas  = 0;
            var tbl_motoristas = document.getElementById("tbl-motoristas-body");
            tbl_motoristas.innerHTML = "";
            $.each(response['data'], function(index, item){
                totalMotoristas++;
                totalEntregas = totalEntregas+ parseInt(item.entregas_emitidas);
                totalDevolucoes = totalDevolucoes + parseInt(item.qtd_devol);
                entregasEfetuadas =  entregasEfetuadas+  parseInt(item.clientes_atendidos);

                var row = tbl_motoristas.insertRow(-1);
              
                var rowId = row.insertCell(0);
                var motorista = row.insertCell(1);
                var ultimaentrega = row.insertCell(2);
                var qtdcliatend = row.insertCell(3);
                var qtdevol = row.insertCell(4);
                var progressorota = row.insertCell(5);
                

                rowId.innerHTML = totalMotoristas;
                motorista.innerHTML =  '<a onclick="abrirDados('+item.codmotorista+')" style="cursor:pointer;">'+item.codmotorista+"-"+item.motorista+'</a>';
                ultimaentrega.innerHTML = item.horario_ult_cliente;
                qtdcliatend.innerHTML = item.clientes_atendidos+'/'+item.entregas_emitidas;
                qtdevol.innerHTML = '0';
                var percentualentregas = parseFloat((item.clientes_atendidos/item.entregas_emitidas)*100).toFixed(2);
                progressorota.innerHTML = 
                    '<div class="progress"  style="height:15px">'+
                        '<div class="progress-bar bg-green" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: '+percentualentregas+'%"><span style="font-size:13px; color:black; vertical-align: middle; ">'+percentualentregas+'%</span></div>'+
                    '</div>'
                ;          

            });

            document.getElementById('qtentegas').innerHTML  =entregasEfetuadas+'/'+ totalEntregas;
            document.getElementById('qtVeiculos').innerHTML = totalMotoristas;
            var progressoTotalEntregas =  parseFloat((parseInt(entregasEfetuadas)/parseInt(totalEntregas) )*100).toFixed(2)+"%";
          
           // console.log(progressoTotalEntregas);
            document.getElementById("modal-pb-separacao").style.width=progressoTotalEntregas;

            
            document.getElementById("modal-pb-separacao").textContent= progressoTotalEntregas;    

        },
        error:function(request, status, error) {
		console.log("ajax call went wrong:" + request.responseText);
	    }

    });


}
function abrirDados(codmotorista){
    alert(codmotorista);
}


function recarregar(){
    atualizarUltimaPosicao();
 //   AtualizarPaineis();

}
</script>
@endpush

