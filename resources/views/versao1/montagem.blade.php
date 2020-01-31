@extends('template1')
@section('content')

<div class="block-header">
    <h2>Consolidação de Cargas</h2>
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
                <div class="demo-masked-input">
                    <div class="row clearfix">                    
                        <div class="col-sm-3" style="width:150px" >
                            <b>Data Montagem</b>
                            <div class="input-group" style="width:115px">
                                <span class="input-group-addon">
                                    <i class="material-icons">date_range</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" name="dtinicio" id="dtinicio" class="form-control date" placeholder="Data Inicial">
                                </div>
                            </div>
                        </div> 

                        <div class="col-sm-3" style="width:150px">
                            <b style="visibility:hidden" >a </b>
                            <div class="input-group" style="width:115px">
                                <span class="input-group-addon">
                                    <i class="material-icons">date_range</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control date" name="dtfim"  id ="dtfim" placeholder="Data Final">
                                </div>
                            </div>
                        </div> 
                        <div class="col-sm-4">                            
                            <b>Motorista</b>
                            <select class="form-control show-tick" name="motorista" id="motorista"  tabindex="-98">
                            <option value="0" >TODOS OS MOTORISTAS</option>
                                @foreach($lst_motoristas as $motorista )
                                <option value="{{$motorista->matricula}}" >{{$motorista->matricula." ".$motorista->nome}} </option>

                                @endforeach
                            </select>
                        </div>
                        <button type="button" class="btn bg-cyan waves-effect" onclick='CarregarCarregamentos(0)'>
                        <i class="material-icons">search</i>
                        <span>Pesquisar</span>
                        </button>
                    </div> 
                </div>
                <table width='250' height='250' class="table" >
                <thead>
                    <tr>
                        
                        <th>Núm Car</th>
                        <th>Dt. Saída</th>
                        <th>Destino</th>
                        <th>Motorista</th>
                        <th>Consolidado</th>
                        <th>Qtd. Nfs</th>
                    </tr>
                </thead>
	            <tbody id="myTable"></tbody>
                </table>
            </div>
            <!--#FIM# CORPOCARD-->  


            

        </div>
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
</div>
            <!-- #END# Basic Example | Horizontal Layout -->
@endsection
@push('scripts')
  <!-- Maps API Javascript -->
  <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCC5-US8dhMNUh6yFNd9Sw_4LqnnVT042A"></script>


<script>
$(function () {
 
    //Masked Input ============================================================================================================================
    var $demoMaskedInput = $('.demo-masked-input');

    //Date
    $demoMaskedInput.find('.date').inputmask('dd-mm-yyyy', { placeholder: '__-__-____' });

    //Time
    $demoMaskedInput.find('.time12').inputmask('hh:mm t', { placeholder: '__:__ _m', alias: 'time12', hourFormat: '12' });
    $demoMaskedInput.find('.time24').inputmask('hh:mm', { placeholder: '__:__ _m', alias: 'time24', hourFormat: '24' });

    //Date Time
    $demoMaskedInput.find('.datetime').inputmask('d/m/y h:s', { placeholder: '__/__/____ __:__', alias: "datetime", hourFormat: '24' });

    //Mobile Phone Number
    $demoMaskedInput.find('.mobile-phone-number').inputmask('+99 (999) 999-99-99', { placeholder: '+__ (___) ___-__-__' });
    //Phone Number
    $demoMaskedInput.find('.phone-number').inputmask('+99 (999) 999-99-99', { placeholder: '+__ (___) ___-__-__' });

    //Dollar Money
    $demoMaskedInput.find('.money-dollar').inputmask('99,99 $', { placeholder: '__,__ $' });
    //Euro Money
    $demoMaskedInput.find('.money-euro').inputmask('99,99 €', { placeholder: '__,__ €' });

    //IP Address
    $demoMaskedInput.find('.ip').inputmask('999.999.999.999', { placeholder: '___.___.___.___' });

    //Credit Card
    $demoMaskedInput.find('.credit-card').inputmask('9999 9999 9999 9999', { placeholder: '____ ____ ____ ____' });

    //Email
    $demoMaskedInput.find('.email').inputmask({ alias: "email" });

    //Serial Key
    $demoMaskedInput.find('.key').inputmask('****-****-****-****', { placeholder: '____-____-____-____' });
    //===========================================================================================================================================

    //Range Example

});

function CarregarCarregamentos(){

 var dti = document.getElementById('dtinicio').value;
 var dtf = document.getElementById('dtfim').value;
 var table = document.getElementById("myTable");
 table.innerHTML = "";
 var select = document.getElementById('motorista');
 var motora = select.options[select.selectedIndex].value;	 

    $.getJSON("{{route('lista_carregs1')}}/"+dti+"/"+dtf+"/"+motora, function(pontos) 
    {
        console.log("{{route('lista_carregs1')}}/"+dti+"/"+dtf+"/"+motora);
        $.each(pontos, function(index, ponto) {

            var row = table.insertRow(0);

            // Insert new cells (<td> elements) at the 1s   t and 2nd position of the "new" <tr> element:
            var numcar = row.insertCell(0);
            var cell_dtmontagem = row.insertCell(1);
            var cell2 = row.insertCell(2);            
            var cell3 = row.insertCell(3);
            var cell4 = row.insertCell(4);
            var qtentregas = row.insertCell(5);
            var mapa = row.insertCell(6); 


            var iconemapa = document.createElement('a');   
            var linkmapa= "{{route('consoligarnumcar')}}/"+ponto.numcar;
            iconemapa.href = linkmapa;
            iconemapa.innerHTML= '<b class="material-icons">map</b>';
            var elLink = document.createElement('a');
            var href= "{{route('consoligarnumcar')}}/"+ponto.numcar;
            elLink.href = href;
            elLink.innerHTML = ponto.numcar;
            iconemapa.target = "_blank";

            // Add some text to the new cells:
            numcar.appendChild(elLink);
            cell_dtmontagem.innerHTML = ponto.dtsaida;
            cell2.innerHTML = ponto.destino;
            cell3.innerHTML = ponto.motorista;    
            cell4.innerHTML = "Não";
            mapa.appendChild(iconemapa);
            qtentregas.innerHTML = ponto.numnotas;

        });
    });

carregarPontos();
}
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

function carregarPontos() {
    startMapa();
        //InfoBox Ponto
        var infowindow = new google.maps.InfoWindow(), marker;

        if( (navigator.platform.indexOf("iPhone") != -1) 
    || (navigator.platform.indexOf("iPod") != -1)
    || (navigator.platform.indexOf("iPad") != -1))
    gambi= "maps:";
        else
    gambi= "http:";
		semcoord="";

	// alert(document.getElementById("numcar").value);
	// var value= document.getElementById("data").value;
    var dti = document.getElementById('dtinicio').value;
    var dtf = document.getElementById('dtfim').value;
    

   // $.getJSON('js/pontos.php?data='+document.getElementById("data").value , function(pontos) {
 	$.getJSON('geocarregamentos/js/pontos.php?dti='+dti+'&dtf='+dtf, function(pontos) {
        $.each(pontos, function(index, ponto) {
			
			if(ponto.Latitude==null) {
				semcoord = semcoord+"," +ponto.Id;
				console.log('Cliente sem coordenada:'+ponto.Id+'('+ponto.VENDEDOR+')');
			}

            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(ponto.Latitude, ponto.Longitude),
                title: ponto.nome,
                map: map,
                icon: pinSymbol(ponto.cor)
            });


            //InfoBox Ponto
            var infowindow = new google.maps.InfoWindow(), marker;
 
				google.maps.event.addListener(marker, 'click', (function(marker, i) {
				    return function() {
				    	      var iwContent = 
									        '<div style="font-size: 16px;font-weight: bold;">'+ ponto.nome + '</div>' +
									        '<div style="	padding: 15px 15px 15px 0;">' + 
									        ponto.fantasia  + '<br>' +
									        ponto.endereco  + '<br>'+
									        ponto.bairro	+ '<br>'+
											'Valor:' + ponto.VLTOTAL+'<br>'+											 
									        'Motorista:'+ponto.motorista + '<br>'+
											'Carregamento: '+ ponto.NUMCAR + '<br>'+
                                            '<br><a href="'+gambi+'//maps.google.com/maps?daddr='+ponto.Latitude+','+ponto.Longitude+'&amp;ll=teste">Ir até lá (google Maps)</a>'+'</div>'  
									          ;

				        infowindow.setContent( iwContent);
				        infowindow.open(map, marker);
				    }
				})(marker))
         });
	//alert("Clientes sem coordenadas no sistema:\n"+semcoord);

 
    });
	
}
function pinSymbol(color) {
    return {
        path: 'M 0,0 C -2,-20 -10,-22 -10,-30 A 10,10 0 1,1 10,-30 C 10,-22 2,-20 0,0 z M -2,-30 a 2,2 0 1,1 4,0 2,2 0 1,1 -4,0',
        fillColor: color,
        fillOpacity: 1,
        strokeColor: '#000',
        strokeWeight: 2,
        scale: 1,
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



<!--JS MASK INPUT-->
<script src="{{ URL::asset('ambiente/plugins/jquery-inputmask/jquery.inputmask.bundle.js')}}"></script>
@endpush