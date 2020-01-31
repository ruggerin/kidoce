@extends('versao1.template1')
@section('content')

<div class="row clearfix">    
    <!-- Task Info -->
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
                            <li><a href="javascript:void(0);"><i class="material-icons">cached</i>Atualizar</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">play_arrow</i>Ativar AutoRefresh</a></li>
                           
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body">
                <form id="frm1" name="frm1">
                    <div class="row clearfix">
                        <div class="col-sm-4">    
                            <div class="form-group">    
                                
                                <label for="codmotorista">Entregador</label>
                                <select class="form-control" required name="codmotorista" id="codmotorista" >                                                                   
                                    <option value="">-- Selecione o Usuário--</option> 
                                    @foreach($motoristas as $motorista)                                         
                                        <option value="{{$motorista->codmotorista}}" >{{$motorista->codmotorista.". ".$motorista->nome}}</option>  
                                    @endforeach
                                </select>
                                
                            </div>
                        </div> 
                    

                        <div class="col-sm-2">   
                            <div class="form-group">    
                                <div class="form-line">
                                    <label for="datasaida">Período Posição</label>
                                    <input type="text" class="form-control datetimepicker" autocomplete="off" id="dti" value="{{date('01/m/Y').' 00:00'}}"  name="dti">
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-2">   
                            <div class="form-group">    
                                <div class="form-line">
                                    <label for="datasaida" style="visibility:hidden">Período de Movimentação</label>
                                    <input type="text" class="form-control datetimepicker" autocomplete="off" id="dtf" value="{{date('d/m/Y').' 23:59'}}"  name="dtf">
                                    
                                </div>
                            </div>
                        </div>  
                        
                        <div class="col-sm-2">   
                            <div class="form-group">  
                                    <label for="datasaida" style="visibility:hidden">Período de Movimentação</label>
                                <div class="button-demo">    
                                    <button type="submit" id="btnsubmit" class="btn waves-effect">
                                        {{--<i class="material-icons">done</i>--}}                                       
                                        <span>Buscar</span> 
                                        <img src="{{ URL::asset('ambiente/images/loading.gif')}}" id="animacaobotao" style="display: none" width="50" height="30" />
                                    </button> 
                                </div>    
                            </div>
                        </div>        

                    </div>  
                </form>    
            </div>
        </div>
    </div>
    <!-- #END# Task Info -->    
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Carregamentos</h2>
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
                <div id="map" name="map" class="gmap" style="position: relative; overflow: hidden; ">
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCC5-US8dhMNUh6yFNd9Sw_4LqnnVT042A"></script>

<script>
    var map;
    
    $(function() {
        $('.datetimepicker').bootstrapMaterialDatePicker({
            format: 'DD/MM/YYYY HH:mm',
            clearButton: true,
            weekStart: 1
        });


        $('#frm1').submit(function(){            
            var dados = jQuery( this ).serialize();
            //collapse
            document.getElementById('btnsubmit').disabled =true;
            document.getElementById('animacaobotao').style.display = 'inline-block';
            jQuery.ajax({
                type: "POST",
                url: "posicaogeografica/carregardados",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: dados,
                success: function( data )
                {  
                    console.log(data);
                    var ultposicao =  data.posicoes.length-1 ;
                    if(data.posicoes.length >0){
                        startMapa();
                        console.log(data.posicoes[ultposicao]);
                        var marker = new google.maps.Marker({
                            position: new google.maps.LatLng(data.posicoes[ultposicao].LATITUDE, data.posicoes[ultposicao].LONGITUDE),
                            title: data.nome,
                            map: map,
                            icon : pinSymbol(data.markercolor),
                        
                        });

                

                        var infowindow = new google.maps.InfoWindow(), marker;
    
                        google.maps.event.addListener(marker, 'click', (function(marker, i) {
                            return function() {
                                var iwContent = 
                                    '<div style="font-size: 16px;font-weight: bold;">'+data.iduser+"-"+ data.nome + '</div>' +
                                    '<div style="	padding: 15px 15px 15px 0;">' +
                                    'Hora Últ. Posi.: <b>' +data.posicoes[ultposicao].DTCAPTURA + '</b><br>'+
                                    '</div>'
                                ;

                                infowindow.setContent( iwContent);
                                infowindow.open(map, marker);
                            }
                        })(marker));                    
            
                        var trip=new Array();
                        for(var x = 0 ;x<=ultposicao; x++  ){
                            trip[x] =  (new google.maps.LatLng(data.posicoes[x]['LATITUDE'], data.posicoes[x].LONGITUDE));

                            var marker = new google.maps.Marker({
                            position: trip[x],
                            title: data.posicoes[x].DTCAPTURA,
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
                      
                    
                    
                    var flightPath = new google.maps.Polyline({
                        path: trip,
                        geodesic: true,
                        strokeColor: data.markercolor,
                        strokeOpacity: 1.0,
                        strokeWeight: 2
                    });
                    flightPath.setMap(map);
                }}else{
                    alert("Nem uma posição para exibir com os parâmetros informados!");
                }
                    document.getElementById('animacaobotao').style.display = 'none';
                    document.getElementById('btnsubmit').disabled =false;
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                    document.getElementById('animacaobotao').style.display = 'none';
                    document.getElementById('btnsubmit').disabled =false;
                }
            });
            
            return false;
        });

    });

    function startMapa(){
       
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
   };
}
    
</script>
@endpush

