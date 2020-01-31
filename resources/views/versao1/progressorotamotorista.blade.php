@extends('template1')
@section('content')


<div class="block-header">
    <h2>Informação de Produtividade</h2>
</div>

<!-- Basic Example | Horizontal Layout -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Filtros</h2>
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
            <div class="body">    
                <div class="table-responsive">               
                    <table width='250' height='250' class="table" >
                    <thead>
                        <tr>
                            <th width="10px" >Sequencia</th>
                            <th width="10px">Código</th>
                            <th>Cliente</th>
                            <th>Fantasia</th>
                            <th>Valor</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="myTable"></tbody>
                    </table>
                </div>    
            </div>
            <!--#FIM# CORPOCARD-->  

</div>


<!-- #END# Basic Example | Horizontal Layout -->
@endsection
@push('scripts')
  <!-- Maps API Javascript -->
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCC5-US8dhMNUh6yFNd9Sw_4LqnnVT042A"></script>


<script>

var map;

function carregarHistLoc(){
    var myTrip=new Array();
    var teste;
    var select = document.getElementById('motorista');
    var motora = select.options[select.selectedIndex].value;
    var data = document.getElementById('dtfim').value;
    console.log(data);
    
 

    $.ajax({
	url: '/entregas/rastromotorista',
    dataType: 'json',
    data: { codmotorista: motora, dtref : data} ,  
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
                    strokeColor: '#000'
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
        console.log( myTrip);
        var flightPath = new google.maps.Polyline({
            path: myTrip,
            geodesic: true,
            strokeColor: '#FF0000',
            strokeOpacity: 1.0,
            strokeWeight: 2
        });
        
        flightPath.setMap(map);

    },
	error:function(request, status, error) {
		console.log("ajax call went wrong:" + request.responseText);
	}
});

    //var flightPlanCoordinates=arraytemp;


}

function CarregarCarregamentos(){

 //var dti = document.getElementById('dtinicio').value;
 var dtf = document.getElementById('dtfim').value;
 var table = document.getElementById("myTable");
 table.innerHTML = "";
 var select = document.getElementById('motorista');
 var motora = select.options[select.selectedIndex].value;	 
 startMapa();
 carregarHistLoc();
 $.ajax({
	url: '/api/df/progressoentregasitens',
    dataType: 'json',
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data: { codmot: motora, dtsaida : dtf} ,  
    method:'post',
	success: function(pontos) {
         console.log(pontos);
        $.each(pontos['data'], function(index, ponto) {

            var row = table.insertRow(0);

            // Insert new cells (<td> elements) at the 1s   t and 2nd position of the "new" <tr> element:
            var sequencia = row.insertCell(0);
            var codcli = row.insertCell(1);
            var cliente = row.insertCell(2);            
            var fantasia = row.insertCell(3);
            var valor = row.insertCell(4);
            var status = row.insertCell(5);
            var colorMarker= "#dddddd"; 

            sequencia.innerHTML = ponto.numseqmontagem;
            codcli.innerHTML = ponto.codcli;
            cliente.innerHTML = ponto.cliente;
            fantasia.innerHTML = ponto.fantasia;
            valor.innerHTML = ponto.vlrentrega;
            if (ponto.saida_datahora!=null && ponto.chegada_datahora!=null){
               status.innerHTML= '<b onclick="infoentrega('+ponto.numped+')" class="material-icons" style="color:green" >fiber_manual_record</b>'; 
               colorMarker = "#00cc00"; 
            }
           else if(ponto.chegada_datahora==null){
               status.innerHTML= '<b onclick="infoentrega('+ponto.numped+')"class="material-icons" style="color:grey" >fiber_manual_record</b>';
               colorMarker = "#a3a1a1";  
            }
            else if(ponto.chegada_datahora!=null){
               status.innerHTML= '<b onclick="infoentrega('+ponto.numped+')"class="material-icons" style="color:orange" >fiber_manual_record</b>';
                colorMarker ="#cc6600";
            }else{
                colorMarker =" #f4efef";
            }

            if(ponto.latitude==0) {
				
				console.log('Cliente sem coordenada:'+ponto.codcli+'('+ponto.vendedor+')');
			}
            
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(ponto.latitude, ponto.longitude),
                title: ponto.cliente,
                map: map,
                label: {
                    text: ponto.numseqmontagem,                   
                    fontSize: '15px',
                    color: "white"
                   
                },
                
                icon: pinSymbol(colorMarker),
                labelsize:18
            });
        /**/

            //InfoBox Ponto
            var infowindow = new google.maps.InfoWindow(), marker;
 
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    var iwContent = 
                        '<div style="font-size: 16px;font-weight: bold;">'+ponto.codcli+"-"+ ponto.cliente + '</div>' +
                        '<div style="	padding: 15px 15px 15px 0;">' + 
                        ponto.fantasia  + '<br>' +
                        ponto.enderent  + '<br>'+
                        ponto.bairroent	+ '<br>'+
                        'Valor:' + ponto.vlrentrega+'<br>'+		
                        'Hora Checkin: <b>' +ponto.chegada_datahora + '</b><br>'+
                        'Hora Checkin: <b>' +ponto.saida_datahora + '</b><br>'+	
                        'Carregamento: '+ ponto.NUMCAR + '<br>'+
                        '<br></div>'  
                    ;

                    infowindow.setContent( iwContent);
                    infowindow.open(map, marker);
                }
            })(marker))
         });

        
     
        },
	error:function(request, status, error) {
		console.log("ajax call went wrong:" + request.responseText);
	}});


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

function infoentrega(numero){
    alert(numero);
}

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

function abrirInfoBox(id, marker) {
	if (typeof(idInfoBoxAberto) == 'number' && typeof(infoBox[idInfoBoxAberto]) == 'object') {
		infoBox[idInfoBoxAberto].close();
	}

	infoBox[id].open(map, marker);
	idInfoBoxAberto = id;
}


</script>

<script src="{{ URL::asset('ambiente/plugins/jquery-steps/jquery.steps.js')}}"></script>

<!-- Moment Plugin Js -->
<script src="{{ URL::asset('ambiente/plugins/momentjs/moment.js')}}"></script>

<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="{{ URL::asset('ambiente/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>

<!--JS MASK INPUT-->
<script src="{{ URL::asset('ambiente/plugins/jquery-inputmask/jquery.inputmask.bundle.js')}}"></script>
@endpush