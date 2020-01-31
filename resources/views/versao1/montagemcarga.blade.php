@extends('versao1.template1')

@push('csss')
<link rel="stylesheet" type="text/css" href="{{ asset('ambiente/plugins/datatables/datatables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('ambiente/plugins/datatables/RowReorder-1.2.4/css/rowReorder.bootstrap.min.css')}}">
@endpush
@section('content')


<div class="row clearfix">    
    <!-- #END# Task Info -->    
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
                <form id="formBuscarEntregas" name="formBuscarEntregas">
                    
                    <div class="row clearfix">
                        <div class="col-sm-4">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label" for="dti">Data Inicial</label>
                                    <input type="text" class="form-control text-uppercase datepicker" autocomplete="off" value="{{date('01/m/Y')}}" id="dti" name="dti">                                
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label" for="dtf">Data Final</label>
                                    <input type="text" class="form-control text-uppercase datepicker" autocomplete="off" value="{{date('d/m/Y')}}" id="dtf" name="dtf">                                
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label" for="numped">Código</label>
                                    <input type="text" class="form-control text-uppercase" autocomplete="off" id="codintegracao" name="codintegracao">                                
                                </div>
                            </div>
                        </div>
                    </div>  

                    <div class="row clearfix">        
                        <div class="form-group">  
                            <div class="button-demo">    
                                <button type="submit" id="btn-submit-formsearch" class="btn  btn-grey waves-effect">
                                    <span>Buscar...</span>
                                </button> 
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
                <h2>Pedidos Liberados</h2>
                
            </div>
            <div class="body">                
                <div id="map" name="map" class="gmap" style="position: relative; overflow: hidden; ">
            </div>
        </div>
    </div>
    </div>
    <!-- #END# Task Info -->    
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Pedidos Selecionados</h2>
                
            </div>
            <div class="body">                
                <div class="table-responsive ">
                    <table  id="tablepedidos" width="300%" class="table table-bordered table-striped table-hover js-table dataTable" >
                            <col width="85">
                            <col width="80">
                            <col width="100">
                            <col width="80">
                            <col width="350">
                            <col width="300">
                            <col width="100">
                            <col width="100">
                        <thead>
                            <tr>
                                <th>Seqência</th>
                                <th>Id</th>
                                <th>Nota Fiscal</th>
                                <th>Codigo</th>
                                <th>Razão Social</th>
                                <th>Bairro</th> 
                                <th>Valor</th>
                                <th>Peso [kg]</th> 
                                <th>Ações</th> 
                               
                            </tr>
                        </thead>
                        <tbody>
                       
 
                        </tbody>
                    </table>
                </div>
                <div class="button-demo">                    
                    <button type="button" class="btn btn-info waves-effect" onclick="openWindowWithPost('montagemcarga/t','a')" >
                        <i class="material-icons">check</i>
                        <span>Gerar Carregamentos</span>
                    </button>  
                </div>        

            </div>
        </div>
    </div>
  
</div>


@endsection
@push('scripts')
<script src="{{ URL::asset('ambiente/plugins/datatables/datatables.min.js')}}"></script>
<!-- Maps API Javascript -->
<script src="http://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyCC5-US8dhMNUh6yFNd9Sw_4LqnnVT042A&libraries=drawing"></script>

<script>

    var table = null;
    var map;
    var pontosDraw =[];
    var pontos=[];
    var markers = [];
    
    $(function() {
        $('.datepicker').bootstrapMaterialDatePicker({
            format: 'DD/MM/YYYY',
            clearButton: true,
            time: false,
            weekStart: 1
        });

        table = $('#tablepedidos').DataTable( {
                rowReorder: {
				selector: 'tr'
			},
            "autoWidth": false,
			
            "columnDefs": [ {
                "targets": -1,
                "data": null,
                "defaultContent": ["<a id='editar' style='cursor:pointer;' onclick=''> <i class='material-icons'>create</i> </a> <a id='deletar' style='cursor:pointer;'> <i class='material-icons col-red'>clear</i> </a> "]
            } ],
            
			columns:[
			{data:'seqent' , className: 'reorder' },
			{data:'numped'},
            {data:'numnota'},
			{data:'codcliintegrador'},
			{data:'razaosocial', 'width': '300px'},
			{data:'bairro'},
			{data:'valor', render: function (data, type, row) {              
                 
                   return 'R$ '+ parseFloat(data).toFixed(2);;
            }},
			{data:'peso'} ,
            {data:null}           
            ],

            rowReorder: {
                dataSrc: 'seqent'
            },
            "initComplete": function(){
              
            }
            
        } );


        $('#formBuscarEntregas').submit(function(){            
            var dados = jQuery( this ).serialize();
            //collapse
            //document.getElementById('btnsubmit').disabled =true;
            //document.getElementById('animacaobotao').style.display = 'inline-block';

            jQuery.ajax({
                type: "POST",
                url: "montagemcarga/pedidos",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: dados,
                success: function( data )
                {  
                    console.log(data);
                   
                    var ultposicao =  data.length-1 ;
                    console.log(data.length  );
                  
                    if(data.length >0){
                        startMapa();    
                        pontos  = data;           
                        for(var x = 0 ;x<=ultposicao; x++  ){                               

                            var marker = new google.maps.Marker({
                            position: new google.maps.LatLng(data[x].lat, data[x].lgn),
                            map: map,
                            title: data[x].numped.toString()   ,
                            animation: google.maps.Animation.DROP,             
                            });
                            markers[x] = marker ;
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
                    }    

                    else{
                        alert("Nem uma posição para exibir com os parâmetros informados!");
                    }
                    return  0 ;
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

        var drawingManager = new google.maps.drawing.DrawingManager({
            drawingMode: google.maps.drawing.OverlayType.POLYGON,
            drawingControl: true,
            
            drawingControlOptions: {
                position: google.maps.ControlPosition.TOP_CENTER,
                drawingModes: ['polygon', 'rectangle'],
            
        },
        markerOptions: {icon: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png'},
        circleOptions: {
        fillColor: '#ffff00',
        fillOpacity: 1,
        strokeWeight: 5,
        clickable: false,
        editable: true,
        zIndex: 1,
          
      },
      
    });
    drawingManager.setMap(map);

    google.maps.event.addListener(drawingManager, 'overlaycomplete', function (OverlayCompleteEvent) {
    var bounds = OverlayCompleteEvent.overlay.getPath();
      
    for (var i =0; i < bounds.getLength(); i++) {
          var ponto = bounds.getAt(i);
        //    console.log( xy.lat() + ',' +xy.lng());
        pontosDraw.push({'lat':ponto.lat(),'lgn':ponto.lng() });

    }
    //console.log(bounds);
    console.log({"pvendas":pontos, 'pDraw': pontosDraw});
    jQuery.ajax({
        type: "POST",
        url:'montagemcarga/selecionados',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {"pvendas":pontos, 'pDraw': pontosDraw},
        success: function( data ){
           
            console.log(data);
            table.clear();
            table.rows.add(data);
            table.draw();
        }
    });
			

    });

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

    function pularMarcador(pedido){
        var filtered = markers.filter( function(obj){
            return obj.title == "52";
        });
        filtered[0].animating  = true;
        filtered[0].setAnimation(google.maps.Animation.BOUNCE);
      
        return filtered[0];

    }

    function pesquisarCliente(){
        $("#pesquisarCliente").modal({
            backdrop: 'static',
            keyboard: false
        }); 
    }    

    pesquisarCliente();
</script>
@endpush

