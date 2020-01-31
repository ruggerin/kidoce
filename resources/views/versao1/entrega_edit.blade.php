@extends('versao1.template1')
@push('csss')
<link rel="stylesheet" type="text/css" href="{{ asset('ambiente/plugins/datatables/datatables.min.css')}}">
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

{{--Início model atualizar--}}

<div id="modalForm" class="modal fade smallModal modal-dialog-centered">
        <div class="modal-dialog">
            <div class="modal-content">
                <div >
                    <b>Buscando dados do cliente <img src="{{ URL::asset('ambiente/images/loading.gif')}}" width="50" height="50" /></b>
                </div>   
                   
            </div>
        </div>
    </div>
    

{{--Fim model atualizar--}}



{{--Inicio model buscar cliente--}}
<div id="pesquisarCliente" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Pesquisar Cliente</h4>
                
            </div>
    
            <div class="modal-body" id="bodymodal"  >
                <form id="formBuscarLojas" name="formBuscarLojas">
                    <div class="row clearfix">

                        <div class="col-sm-4">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label" for="numped">Código</label>
                                    <input type="text" class="form-control text-uppercase" autocomplete="off" id="codintegracao" name="codintegracao">                                
                                </div>
                            </div>
                        </div>
                   
                        <div class="col-sm-4">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label" for="numped">CNPJ/CPF</label>
                                    <input type="text" class="form-control text-uppercase" autocomplete="off" id="mcnpj" name="mcnpj">                                
                                </div>
                            </div>
                        </div>
                   
                        <div class="col-sm-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label" for="numped">Razao Social</label>
                                    <input type="text" class="form-control text-uppercase" autocomplete="off" id="mrazaosocial" name="mrazaosocial">                                
                                </div>
                            </div>
                        </div>
                   
                        <div class="col-sm-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label" for="numped">Fantasia</label>
                                    <input type="text" class="form-control text-uppercase" autocomplete="off" id="mfantasia" name="mfantasia">                                
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
                                <img  id="animacaobotao" src="{{ URL::asset('ambiente/images/loading.gif')}}" width="50" height="50"  style="visibility:collapse"/>
                                
                            </div>                
                        </div>        

                    </div>    
                </form>

                <div class="table-responsive ">
                    <table  id="tableBusca"  class="table table-bordered table-striped table-hover js-table dataTable" >
                           {{-- <col width="85">
                            <col width="80">
                            <col width="100">
                            <col width="80">
                            <col width="350">
                            <col width="300">
                            <col width="100">
                            <col width="100">--}}
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Razão Social</th>
                                <th>Fantasia</th>
                                <th>Endereço</th>
                                <th>Numero</th>
                                <th>Bairro</th> 
                                <th>Município</th>
                                <th>UF</th> 
                                
                                
                            </tr>
                        </thead>
                        <tbody>
                        
    
                        </tbody>
                    </table>
                </div>    

            </div>   
            
              
            <div class="modal-footer">
             
                           

            </div>
        </div>
    </div>
</div>
{{-- jQuery('#ajax_form').submit(function() --}}
{{--Fim model buscar cliente--}}

<div class="row clearfix">    
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
                <div class="header">
                    @if(isset($loja))
                        <h2>Entrega: {{$loja->lojaid}}</h2>
                    @else
                        <h2>Registrar Nova Entrega</h2>
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
                @if(isset($pedido))
                <form  method="post" action="{{route('entregas.update',$pedido->numped) }}">
                {!! method_field('PUT') !!}   
                @else                
                <form  method="post" action="{{route('entregas.store')}}">
                 @endif   
                    <input type="hidden" name="_token" value ="{{csrf_token()}}">
                    <div class="row clearfix">
                        <div class="col-sm-6">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label" for="numped">Registro de Entrega</label>
                                    <input type="text" class="form-control text-uppercase" autocomplete="off" id="numped" name="numped"   value="{{$pedido->numped or '(Novo)'}}"readonly>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label" for="numped">Carregamento</label>
                                    @if(isset($_GET['numcar']))
                                    <input type="text" class="form-control text-uppercase" autocomplete="off" id="numcarreg" name="numcarreg"   value="{{ $_GET['numcar']}}"readonly>
                                    @else
                                    <input type="text" class="form-control text-uppercase" autocomplete="off" id="numcarreg" name="numcarreg"   value="{{$pedido->numcarreg or 0}}"readonly>            
                                    @endif
                                    
                                </div>
                            </div>
                        </div>    

                        <div class="col-sm-2">
                            <div class="form-group form-float">                                        
                                <div class="form-line ">
                                    <label class="form-label" for="numnota">Nota Fiscal</label>
                                    <input type="text" class="form-control text-uppercase descricao" autocomplete="off" id="numnota"  name="numnota"  value ="{{$pedido->numnota or ''}}" >
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                                <div class="form-group form-float">                                         
                                <div class="form-line">
                                    <label class="form-label">Id Cliente</label>
                                <input type="text" class="form-control text-uppercase " autocomplete="off" id="lojaid"  name="lojaid" value = "{{$pedido->lojaid or '' }}" >
                                </div>
                            </div>
                        </div>                            

                        <div class="col-sm-2">
                            <div class="form-group form-float">                                        
                                <div class="form-line">
                                <input type="text" class="form-control text-uppercase " autocomplete="off" id="codcliintegrador" name="codcliintegrador" value="{{$pedido->codcliintegrador or ''}}" onblur="idCliChange(this)"  >
                                    <label class="form-label">Cód. Cli.</label>                                    
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-sm-1" >
                            <div class="form-group">
                                <button type="button" style="margin-top:10px; margin-left: -20px; height: 28px;" onclick="pesquisarCliente()">
                                        <i class="material-icons">search</i>
                                </button>
                            </div>                            
                        </div>        

                        <div class="col-sm-4">    
                            <div class="form-group form-float ">    
                                <div class="form-line">
                                    <label for="codvendedor">Comissionado</label>
                                    <select class="form-control" required name="codvendedor" id="codvendedor" >                                                                   
                                        
                                        @foreach($vendedores as $vendedor)
                                            @if( isset($pedido) && $pedido->codvendedor == $vendedor->id )
                                                <option value="{{$vendedor->id}}" selected >{{ $vendedor->id.".".$vendedor->nome }}</option>  
                                            @else
                                                <option value="{{$vendedor->id}}" >{{$vendedor->id.".".$vendedor->nome}}</option>  
                                            @endif
                                        @endforeach
                                    </select>
                                </div>    
                            </div>
                        </div>    
                        
                        <div class="col-sm-6">
                            <div class="form-group form-float">                                        
                                <div class="form-line">
                                <input type="text" class="form-control text-uppercase " autocomplete="off" id="razaosocial" name="razaosocial" value="{{$pedido->razaosocial or ''}}"  >
                                    <label class="form-label">Razão Social</label>
                                </div>
                            </div>
                        </div>   

                        <div class="col-sm-6">
                            <div class="form-group form-float">                                        
                                <div class="form-line">
                                <input type="text" class="form-control text-uppercase " autocomplete="off" id="fantasia" name="fantasia"   value="{{$pedido->fantasia or ''}}">
                                    <label class="form-label">Fantasia</label>
                                </div>
                            </div>
                        </div>   

                        <div class="col-sm-6">
                            <div class="form-group form-float">                                        
                                <div class="form-line">
                                <input type="text" class="form-control text-uppercase " autocomplete="off" id="endereco" name="endereco" value="{{$pedido->endereco or ''}}" >
                                    <label class="form-label">Logradouro</label>
                                </div>
                            </div>
                        </div>    

                        <div class="col-sm-2">
                            <div class="form-group form-float">                                        
                                <div class="form-line">
                                <input type="text" class="form-control text-uppercase " autocomplete="off" id="numero" name="numero" value="{{$pedido->numero or ''}}" >
                                    <label class="form-label">Numero</label>
                                </div>
                            </div>
                        </div>    

                        <div class="col-sm-4 ">
                            <div class="form-group form-float">                                        
                                <div class="form-line">
                                <input type="text" class="form-control text-uppercase " autocomplete="off" id="bairro" name="bairro" value="{{$pedido->bairro or ''}}"  >
                                    <label class="form-label">Bairro</label>
                                </div>
                            </div>
                        </div>    

                        <div class="col-sm-4 ">
                            <div class="form-group form-float">                                        
                                <div class="form-line">
                                <input type="text" class="form-control text-uppercase " autocomplete="off" id="pontodereferencia" name="pontodereferencia" value="{{$pedido->pontoreferencia or ''}}" >
                                    <label class="form-label">Ponto de referência</label>
                                </div>
                            </div>
                        </div>    

                        <div class="col-sm-2 ">
                            <div class="form-group form-float">                                        
                                <div class="form-line">
                                    <input type="text" class="form-control text-uppercase " autocomplete="off" id="lat" name="lat" value="{{$pedido->lat or ''}}" >
                                    <label class="form-label">Latitude</label>
                                </div>
                            </div>
                        </div>    
                        
                        <div class="col-sm-2 ">
                            <div class="form-group form-float">                                        
                                <div class="form-line">
                                    <input type="text" class="form-control text-uppercase " autocomplete="off" id="lgn" name="lgn" value="{{$pedido->lgn or ''}}"   >
                                    <label class="form-label">Longitude</label>
                                </div>
                            </div>
                        </div>   
                        <div class="col-sm-1" >
                            <div class="form-group">
                                <button type="button" style="margin-top:10px; margin-left: -20px; height: 28px;">
                                        <i class="material-icons">map</i>
                                </button>
                            </div>                            
                        </div>  
                    
                        <div class="col-sm-4 ">
                            <div class="form-group form-float">                                        
                                <div class="form-line">
                                    <input type="text" class="form-control text-uppercase " autocomplete="off" id="municipio" name="municipio" value="{{$pedido->municipio or ''}}"   >
                                    <label class="form-label">Município</label>
                                </div>
                            </div>
                        </div>  

                        <div class="col-sm-2 ">
                            <div class="form-group form-float">                                        
                                <div class="form-line">
                                    <input type="text" class="form-control text-uppercase " autocomplete="off" id="uf" name="uf" value="{{$pedido->uf or ''}}"   >
                                    <label class="form-label">Uf</label>
                                </div>
                            </div>
                        </div>  
                            
                    </div>

                    <div class="row  clearfix">
                        <div class="col-sm-2 ">
                            <div class="form-group form-float">                                        
                                <div class="form-line">
                                    <input type="text" class="form-control text-uppercase " autocomplete="off" id="valor" name="valor"  value="{{$pedido->valor or '0.0'}}" >
                                    <label class="form-label">Valor</label>
                                </div>
                            </div>
                        </div>   
                        
                        <div class="col-sm-2 ">
                            <div class="form-group form-float">                                        
                                <div class="form-line">
                                    <input type="text" class="form-control text-uppercase " autocomplete="off" id="peso" name="peso" value="{{$pedido->peso or '0.0'}}" >
                                    <label class="form-label">Peso</label>
                                </div>
                            </div>
                        </div>   
                        
                        <div class="col-sm-2 ">
                            <div class="form-group form-float">                                        
                                <div class="form-line">
                                    <input type="text" class="form-control text-uppercase " autocomplete="off" id="volumes" name="volumes" value="{{$pedido->volumes or '0'}}" >
                                    <label class="form-label">Volumes</label>
                                </div>
                            </div>
                        </div>   
                        
                        <div class="col-sm-2 ">
                            <div class="form-group form-float">                                        
                                <div class="form-line">
                                    <input type="text" class="form-control text-uppercase " autocomplete="off" id="vlrfrete" name="vlrfrete" value="{{$pedido->vlrfrete or '0'}}" >
                                    <label class="form-label">Taxa Entrega</label>
                                </div>
                            </div>
                        </div>   
                        

                        <div class="col-sm-12 ">
                            <div class="form-group form-float">                                        
                                <div class="form-line">
                                    <input type="text" class="form-control text-uppercase " autocomplete="off" id="observacao" name="observacao" value="{{$pedido->observacao or ''}}" >
                                    <label class="form-label">Observações</label>
                                </div>
                            </div>
                        </div>   
                           
                        <div class="col-sm-12">        
                            <div class="form-group">  
                                <div class="button-demo">    
                                        <button type="submit" class="btn btn-primary waves-effect">
                                            <i class="material-icons">done</i>
                                            <span>Salvar</span> 
                                        </button> 
                                    
                                        <button type="button" class="btn btn-grey" onclick="showPesquisa()">
                                            <i class="material-icons">reply</i>
                                            <span>Cancelar</span> 
                                        </button>
    
                                    </div>                
                                </div>            
    
                        </div>     
                        
                    </div>
                    
                </form>  
            </div>    
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ URL::asset('ambiente/plugins/datatables/datatables.min.js')}}"></script>

<script>
    var tableClientes

    tableClientes = $('#tableBusca').DataTable( {
                rowReorder: {
				selector: 'tr'
			},
            "autoWidth": false,
            "paging": false,
			responsive: false,
            
			columns:[
			
			{data:'codintegracao'},
            {data:'razaosocial', 'width': '300px'},
            {data:'fantasia', 'width': '300px'},
            {data:'endereco', 'width': '300px'},
            {data:'numero', 'width': '300px'},
			{data:'bairro'},
            {data:'municipio'},
            {data:'uf'},
                
            ],

            rowReorder: {
                dataSrc: 'seqent'
            },
            "initComplete": function(){
               //recarregarPontos();
            }
            
        } );
        tableClientes.on( 'click','td',  function () {
           
            var dataResponse = tableClientes.row( $(this).parents('tr') ).data();

           // alert( 'Nota Fiscal: '+ dataResponse['codintegracao'] );
           document.getElementById('codcliintegrador').value = dataResponse['codintegracao'];
           document.getElementById('codcliintegrador').parentElement.classList.add('focused');
           idCliChange(document.getElementById('codcliintegrador'));
           $("#pesquisarCliente").modal('hide'); 
        } );



    $('#formid').on('keyup keypress', function(e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) { 
            e.preventDefault();
            return false;
        }
    });
$(function() {
    $('input').keyup(function() {
        this.value = this.value.toLocaleUpperCase();
    });


    $('#formBuscarLojas').submit(function(){
            
			var dados = jQuery( this ).serialize();
            //collapse
            document.getElementById('animacaobotao').style.visibility = 'visible';
			jQuery.ajax({
				type: "POST",
                url: "{{route('entregas.buscarLoja')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
				data: dados,
				success: function( data )
				{
                    //console.log( data) ;
                    
                    tableClientes.clear();
                    tableClientes.rows.add(data);
                    tableClientes.draw();
                    document.getElementById('animacaobotao').style.visibility = 'collapse';
				}
			});
			
			return false;
		});
  
});

function pesquisarCliente(){
    $("#pesquisarCliente").modal({
        backdrop: 'static',
        keyboard: false
    }); 
}



function idCliChange(campo){
    if(campo.value!=''){
        $("#modalForm").modal({
            backdrop: 'static',
            keyboard: false
        });
        $.ajax({
            url: "{{route('infoloja')}}"+'/'+campo.value,
            /* dataType: 'body',*/
            method:'get',
            
            success: function(response) {
               console.log(response);
                if(response.length>0){
                    for (const [key, vvalue] of Object.entries(response[0])) {
                       // console.log(key, vvalue);
                        if(vvalue!=null){
                        document.getElementById(key).value = vvalue;
                        document.getElementById(key).parentElement.classList.add('focused');
                        }
                    }
                }
         
                $("#modalForm").modal('hide');

                
            },
            error: function (request, status, erro) {
                $("#modalForm").modal('hide'); 
                //alert("Problema ocorrido: " + status + "\nDescição: " + erro);
                //alert("Informações da requisição: \n" + request.getAllResponseHeaders());
            }

            
        });   
    }
}



function canceledit(){
    window.open("{{ url()->previous() }}","_self");
    


}
</script>
@endpush