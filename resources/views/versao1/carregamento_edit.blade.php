@extends('versao1.template1')
@push('csss')
<link href="{{ asset('ambiente/plugins/multi-select/css/multi-select.css')}}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('ambiente/plugins/datatables/datatables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('ambiente/plugins/datatables/RowReorder-1.2.4/css/rowReorder.bootstrap.min.css')}}">
<!-- Sweetalert Css -->
<link  href="{{ asset('ambiente/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" />
@endpush
@section('content')
@if(isset($errors) && count($errors)>0)
        @foreach($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible" role="alert">
	        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
	       {{$error}}
        </div>
        @endforeach

@endif

{{--Início model BuscarCliente--}}

<div id="modalReprocessarSequencia" class="modal fade smallModal modal-dialog-centered">
        <div class="modal-dialog">
            <div class="modal-content">
                <div >
                    <b>Salvando nova sequencia... <img src="{{ URL::asset('ambiente/images/loading.gif')}}" width="50" height="50" /></b>
                </div>   
                   
            </div>
        </div>
    </div>
    

{{--Fim model BuscarCliente--}}

{{--Início model deletar registro--}}

<div id="modalForm" class="modal fade smallModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Cadastro de Tipo de Produto</h4>
                    
                </div>
        
                <div class="modal-body" id="bodymodal" >
          
                </div>   
                  
                <div class="modal-footer">
                 
                               
    
                </div>
            </div>
        </div>
    </div>
    

{{--Fim model deletar Registro--}}

<div id="modalSearch" class="modal fade smallModal" data-target="#smallModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Cadastro de Tipo de Produto</h4>                
            </div>
    
            <div class="modal-body" id="bodymodal" >
                <form  method="post" action="{{route('tipoprodutos.update',0)}}">
                        <input type="hidden" name="_token" value ="{{csrf_token()}}">
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control text-uppercase" autocomplete="off" id="tipoprodid" name="tipoprodid"  value ="0" readonly>
                                        <label class="form-label">Código Interno</label>
                                    </div>
                                </div>
                            </div>    

                            <div class="col-sm-12">
                                <div class="form-group form-float">                                        
                                    <div class="form-line">
                                        <input type="text" class="form-control text-uppercase descricao" autocomplete="off" id="descricao" value ="0" name="descricao"  >
                                        <label class="form-label">Descrição</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">        
                            <div class="form-group">  
                                <div class="button-demo">    
                                    <button type="submit" class="btn btn-primary waves-effect">
                                        <i class="material-icons">done</i>
                                        <span>Salvar</span> 
                                    </button> 
                                
                                    <button type="button" class="btn btn-grey" data-dismiss="modalForm" >
                                        <i class="material-icons">reply</i>
                                        <span>Cancelar</span> 
                                    </button>
                                                                
                                </div>                
                            </div>        

                        </div>    
                </form>  
                <div class="demo-preloader" id="demo-preloader"  >
                        <img src="{{ URL::asset('ambiente/images/loading.gif')}}" width="50" height="50" />
                </div>         
            </div>   
              
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

{{--Fim Model de cadastro de nova entrega--}}


<div class="block-header">
    <h2>Manutenção de Carregamento:<b> {{$carregamento->numcarreg}}</b></h2>
    
</div>

<div class="row clearfix">    
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
                <div class="header">
                    @if(isset($carregamento))
                        <h2>Cabeçalho</h2>
                    @else
                        <h2>Manutenção de Carregmanto</h2>
                    @endif
                
                   
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
                <form  method="post"  action="{{route('carregamentos.update', $carregamento->numcarreg ) }}">                 
                    <input type="hidden" name="_token" value ="{{csrf_token()}}" > 
                    {!! method_field('PUT') !!}  
                    <div class="row clearfix">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="numcarintegracao">Código Integração</label>
                                    <input type="text" class="form-control text-uppercase" autocomplete="off" id="numcarintegracao" name="numcarintegracao" value="{{$carregamento->numcarintegracao or old('numcarintegracao')}}" >
                                </div>
                            </div>
                        </div>                         
                        <div class="col-sm-10">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Destino</label>
                                    <input type="text" class="form-control text-uppercase" required autocomplete="off" id="destino" name="destino" value="{{$carregamento->destino or old('destino')}}" >
                                </div>
                            </div>
                        </div> 
                        <div class="col-sm-12">   
                            <div class="form-group">    
                                <div class="form-line">
                                    <label for="observacao">Observação</label>
                                    <input type="text" class="form-control text-uppercase" autocomplete="off" id="observacao" value="{{$carregamento->observacao or old('observacao')}}" name="observacao">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">    
                            <div class="form-group">    
                              
                                    <label for="codmotorista">Entregador</label>
                                    <select class="form-control" required name="codmotorista" id="codmotorista" >                                                                   
                                        
                                        @foreach($motoristas as $motorista)
                                            @if($carregamento->codmotorista ==$motorista->codmotorista )
                                                <option value="{{$motorista->codmotorista}}" selected >{{$motorista->codmotorista.".".$motorista->nome}}</option>  
                                            @else
                                                <option value="{{$motorista->codmotorista}}" >{{$motorista->codmotorista.".".$motorista->nome}}</option>  
                                            @endif
                                        @endforeach
                                    </select>
                              
                            </div>
                        </div>    

                        <div class="col-sm-4">   
                            <div class="form-group">    
                                <div class="form-line">
                                    <label for="datasaida">Data de Saída</label>
                                    <input type="text" class="form-control datetimepicker" autocomplete="off" id="dtsaida" value="{{$carregamento->dtsaida or old('dtsaida')}}" name="dtsaida">
                                    
                                </div>
                            </div>
                        </div>    
                       
                        
                    </div>
                        
                    <div class="form-group">  
                        <div class="button-demo">    
                            <button type="submit" class="btn btn-primary waves-effect">
                                <i class="material-icons">done</i>
                                <span>Salvar</span> 
                            </button> 
                        
                            <button type="button" class="btn btn-grey" onclick="canceledit()" >
                                <i class="material-icons">reply</i>
                                <span>Cancelar</span> 
                            </button>
                                                     
                        </div>                
                    </div>                       

                </form>    
            </div>    
        </div>
    </div>
</div>




<div class="row clearfix">    
    <!-- Task Info -->
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Entregas do Carregamento</h2>
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
                <div class="button-demo">                    
                    <button type="button" class="btn btn-info waves-effect" onclick="novaLojas()" >
                        <i class="material-icons">list</i>
                        <span>Pedido Livres</span>
                    </button>  
                    <button type="button" class="btn btn-info waves-effect" onclick="showNovoPedido()" >
                        <i class="material-icons">add</i>
                        <span>Novo Pedido</span>
                    </button>  

                    <button type="button" class="btn bg-deep-purple  waves-effect" onclick="autoSequenciar(0)">
                        <i class="material-icons">filter_list</i>
                        <span>Processar Sequencia</span>
                    </button>

                    <button type="button" class="btn btn-grey  waves-effect" onclick=" table.ajax.reload();">
                        <i class="material-icons">find_replace</i>
                        <span>Atualizar Tabela</span>
                    </button>  
                    
                    <button type="button" class="btn btn-grey  waves-effect">
                        <i class="material-icons">file_upload</i>
                        <span>Importar</span>
                    </button> 
                </div>
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
            </div>
        </div>
    </div>
    
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
                        @php
                        $source = array(',', '.');
                        $replace = array(' ', ',');
                        $valor = str_replace($source, $replace,number_format($carregamento->valorcarga,2)); 
                        @endphp
                        <div class="col-sm-4 col-md-4 col-lg-4" style="margin-bottom: 0px" >    
                            <div class="form-group">   
                                <label for="codmotorista">Valor Total</label>
                                <input readonly class="form-control" value="{{'R$'. $valor}}" id="dtsaidaveiculo" onchange="atualizarInfoIndividual(this)">
                            </div> 
                        </div>  
                        <div class="col-sm-4 col-md-4 col-lg-4" style="margin-bottom: 0px" >    
                            <div class="form-group">   
                                <label for="codmotorista">Peso Total</label>
                                <input readonly class="form-control" value="{{ $carregamento->pesocarga }}" id="dtsaidaveiculo" onchange="atualizarInfoIndividual(this)">
                            </div> 
                        </div> 
    
                        <div class="col-sm-4 col-md-4 col-lg-4" style="margin-bottom: 0px" >    
                            <div class="form-group">   
                                <label for="codmotorista">Qtd Entregas</label>
                                <input readonly  class="form-control" value="{{$carregamento->qtentregas}}" id="dtsaidaveiculo" onchange="atualizarInfoIndividual(this)">
                            </div> 
                        </div>   
    
                        <div class="col-sm-4 col-md-4 col-lg-4" style="margin-bottom: 0px" >    
                            <div class="form-group">   
                                <label for="codmotorista">Perc Previsto</label>
                                <input readonly class="form-control" value="{{ $carregamento->kmtotalprev}}" id="dtsaidaveiculo" onchange="atualizarInfoIndividual(this)">
                            </div> 
                        </div> 
                        <div class="col-sm-4 col-md-4 col-lg-4" style="margin-bottom: 0px" >    
                            <div class="form-group">   
                                <label for="codmotorista">Comb Prev</label>
                                <input readonly class="form-control" value="{{0}}" id="dtsaidaveiculo" onchange="atualizarInfoIndividual(this)">
                            </div> 
                        </div>      
                      
                        <div class="col-sm-4 col-md-4 col-lg-4" style="margin-bottom: 0px" >    
                            <div class="form-group">   
                                <label for="codmotorista">Vlr Comb. Prev</label>
                                <input readonly class="form-control" value="{{'R$0' }}" id="dtsaidaveiculo" onchange="atualizarInfoIndividual(this)">
                            </div> 
                        </div>  
                        <div class="col-sm-6 col-md-6 col-lg-6" style="margin-bottom: 0px" >    
                            <div class="form-group">   
                                <label for="codmotorista">Horario Retorno Meta</label>
                                <input readonly class="form-control" value="{{$carregamento->dtretornometa }}" id="dtsaidaveiculo" onchange="atualizarInfoIndividual(this)">
                            </div> 
                        </div>                        
                
                    </div>
                    
       
                </div>
                <!--#FIM# CORPOCARD-->  
    
            </div>
        </div>
    
    <!-- Basic Example | Horizontal Layout -->
</div>

    <!-- #END# Task Info -->    


@endsection
@push('scripts')
<script src="{{ URL::asset('ambiente/plugins/datatables/datatables.min.js')}}"></script>
<!-- Maps API Javascript -->
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCC5-US8dhMNUh6yFNd9Sw_4LqnnVT042A"></script>
<!-- SweetAlert Plugin Js -->
<script src="{{ URL::asset('ambiente/plugins/sweetalert/sweetalert.min.js')}}"></script>

<script src="{{ URL::asset('ambiente/plugins/datatables/RowReorder-1.2.4/js/dataTables.rowReorder.min.js')}}"></script>


<script src="{{ URL::asset('ambiente/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>
<script>
    var map;
    var pontos;
    
    function startMapa(){
 
        var options = {
            zoom: 12,
            center: new google.maps.LatLng(-3.1349,-60.008),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("map"), options);

    }
    startMapa();

    var table = null;
    $(function() {
        carregarEntregas();
        $('input').keyup(function() {
            this.value = this.value.toLocaleUpperCase();
        });
        //Datetimepicker plugin
        $('.datetimepicker').bootstrapMaterialDatePicker({
            format: 'YYYY/MM/DD HH:mm',
            clearButton: true,
            weekStart: 1
        });

    });

    function showNovoPedido(){
        newwindow=window.open(" {{route('entregas.create').'?numcar='.$carregamento->numcarreg }}",'windowName','height=800,width=1500');
      // return ;
        newwindow.onbeforeunload = function(){ 
         
            table.ajax.reload();
        }
    }
    function showPesquisa(){
        $(document).ready(function(){
            $("#modalSearch").modal('show');
        });
    }

    function autoSequenciar(){
        $.ajax({
            url: "{{route('envplannning',$carregamento->numcarreg)}}",
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

    function canceledit(){
        window.open("{{ url()->previous() }}","_self");

    }
    function carregarEntregas(){
    
            table = $('#tablepedidos').DataTable( {
                rowReorder: {
				selector: 'tr'
			},
            "autoWidth": false,
			ajax: {
                url:"{{ route('entregas.listar').'/'.$carregamento->numcarreg}}"
                ,dataSrc:""
            },
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
               recarregarPontos();
            }
            
        } );
        table.on( 'click', 'a', function () {
           
            var data = table.row( $(this).parents('tr') ).data();

           // alert( 'Nota Fiscal: '+ data['numnota']+'\n'+this.id );

           if(this.id=='deletar'){
            showAjaxLoaderMessage(data['numped']);
            }else if(this.id=='editar'){
                newwindow=window.open(" ../../entregas/"+data['numped']+"/edit?numcar={{$carregamento->numcarreg}}",'windowName','height=800,width=1500');
            }
        } );
        table.on( 'row-reorder', function ( e, diff, edit ) {
            var pedidosReodernados =[];	

            for ( var i=0, ien=diff.length ; i<ien ; i++ ) {
                var rowData = table.row( diff[i].node ).data();
                pedidosReodernados[i] = {sequence :  diff[i].newData, numped: rowData['numped']};
            }
            if(pedidosReodernados.length >0){
                $("#modalReprocessarSequencia").modal({
                    backdrop: 'static',
                    keyboard: false
                });

            $.ajax({
                url: '{{route('sequenciaarrastada')}}',
                /* dataType: 'body',*/
                data: JSON.stringify(pedidosReodernados) ,  
                method:'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                
                success: function(response) {
                    
                    table.ajax.reload();
                    //recarregarPontos();
                    $("#modalReprocessarSequencia").modal('hide');
                
                },
                error: function (request, status, erro) {
                    table.ajax.reload();
                    $("#modalReprocessarSequencia").modal('hide');
                  //  recarregarPontos();
                    //alert("Problema ocorrido: " + status + "\nDescição: " + erro);
                    //alert("Informações da requisição: \n" + request.getAllResponseHeaders());
                }

                
            });               
            //table.ajax.reload();
            }
            
        });
        
        
    }

    function showAjaxLoaderMessage(numordem) {
        swal({
            title: "Excluir registro",
            text: "Deseja realemente excluir do carregamento a ordem de entrega nº" +numordem,
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            }, function () {
            /*setTimeout(function () {
                swal("Pedido retirado com sucesso!");
            }, 2000);*/
                $.ajax({
                    url: "{{route('alterarposicaopedido')}}",
                    /* dataType: 'body',*/
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {'numped':numordem,'satus':'L','numcarreg':0 } ,  
                    
                    method:'post',
                    
                    success: function(response) {
                        table.ajax.reload();
                        swal("Pedido retirado com sucesso!");                    
                    },
                    error: function (request, status, erro) {
                        table.ajax.reload();
                        //recarregarPontos();
                        alert("Problema ocorrido: " + status + "\nDescição: " + erro);
                        alert("Informações da requisição: \n" + request.getAllResponseHeaders());
                    }

                    
                });
            
            }
        );
    }

function recarregarPontos(){
  pontos =   table.rows().data();

  startMapa();

   $.each(pontos, function(index, ponto) {
       if(ponto.lat == null|| ponto.lgn ==null){
           console.log("Ordem de entrega sem coordenadas cadastradas "+ponto.numped);
       }
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(ponto.lat, ponto.lgn),
            title: ponto.numped.toString(),    
            label: ponto.seqent.toString(),      
            map: map
        });
        var infowindow = new google.maps.InfoWindow(), marker;
 
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                var iwContent = 
                    '<div style="font-size: 16px;font-weight: bold;">'+ponto.codcliintegrador+"-"+ ponto.razaosocial + '</div>' +
                    '<div style="	padding: 15px 15px 15px 0;">' + 
                    ponto.fantasia  + '<br>' +
                    ponto.endereco  + '<br>'+
                    ponto.bairro	+ '<br>'+
                    'Valor: ' + ponto.valor+'<br>'+
                    'Observações: '+ ponto.observacao
                    +'</div>'  
                ;

                infowindow.setContent( iwContent);
                infowindow.open(map, marker);
            }
        })(marker))
    });

}

function abrirInfoBox(id, marker) {
	if (typeof(idInfoBoxAberto) == 'number' && typeof(infoBox[idInfoBoxAberto]) == 'object') {
		infoBox[idInfoBoxAberto].close();
	}

	infoBox[id].open(map, marker);
	idInfoBoxAberto = id;
}

</script>
@endpush