@extends('versao1.template1')
@push('csss')
 <!-- JQuery DataTable Css -->
 <link href="{{ URL::asset('ambiente/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
 <!-- Sweetalert Css -->
 <link href="{{ URL::asset('ambiente/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
@endpush
@section('content')

{{-- Formulário de Inclusão/Alteração--}}
<div id="modalForm" class="modal fade smallModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Cadastro de Tipo de Produto</h4>
                
            </div>
    
            <div class="modal-body" id="bodymodal"  style="visibility:hidden">
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
                                <div class="form-group from-float">                                        
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


<div class="block-header">
    <h2>Cadastro de Tipo de Produtos para Auditoria</h2>
   
</div>

<div class="row clearfix">    
    <!-- Task Info -->
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Tabela de Informações</h2>
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
                        <i class="material-icons">add</i>
                        <span>Nova</span>
                    </button>    
                    
                    <button type="button" class="btn btn-grey  waves-effect">
                        <i class="material-icons">file_upload</i>
                        <span>Importar</span>
                    </button> 
                </div>
                <div class="table-responsive ">
                    <table class="table table-bordered table-striped table-hover js-table dataTable">
                            <col width="10">
                            <col width="400">
                            <col width="400">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Numcar</th>
                                <th>Descrição</th>
                                <th>Entregador</th>         
                                <th>Status</th>                          
                                <th>Ações</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($carregamentos as $carregamento)
                        <tr>
                            {{-- <td><a href="{{route('rca.edit', $rca->codrca)}}">{{$rca->codrca}}</a></td>--}}
                            <td>{{$carregamento->numcarreg}}</td>
                            <td>{{$carregamento->numcarintegracao}}
                            <td>{{$carregamento->destino}}</td>
                            <td>{{$carregamento->motorista}}</td>
                            <td>{{$carregamento->status}}</td>
                            <td>
                                <a href="{{route('carregamentos.edit',$carregamento->numcarreg)}}" >
                                    <i class="material-icons">mode_edit</i>
                                </a>
                                <a href="#delete" >
                                    <i class="material-icons col-red">delete</i>
                                </a>
                            </td>        
                        </tr>
                        @endforeach
 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Task Info -->    
</div>
@endsection

@push('scripts')

<script>
    function showFormEditar(idTipo){
        document.getElementById("demo-preloader").style.visibility='visible';
        document.getElementById("bodymodal").style.visibility='collapse';              
        $(document).ready(function(){
            $("#modalForm").modal('show');
        });


        $.ajax({
            url: 'tipoprodutos/'+idTipo+'/edit',
            dataType: 'json',
            success: function(data) {
             
                document.getElementById("tipoprodid").value=data.tipoprodid;
                document.getElementById("descricao").value=data.descricao;
                document.getElementById("demo-preloader").style.visibility='collapse';
                document.getElementById("bodymodal").style.visibility='visible';
                    
            },
            error:function(request, status, error) {
                console.log("ajax call went wrong:" + request.responseText);
            }

            
     });

    
}

function novaLojas(){
    window.open("{{ route('carregamentos.create')}}","_self");
}


$(function () {
    $('.js-table').DataTable({
        responsive: true
    });
    @if(session('message'))
    swal("Sucesso", "As alterações do cadastro foram executadas com sucesso", "success");
    @endif
     //Tooltip
     $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });

    //Popover
    $('[data-toggle="popover"]').popover();

})


</script>
<script src="{{ URL::asset('ambiente/js/pages/ui/animations.js')}}"></script>
<script src="{{ URL::asset('ambiente/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
<script src="{{ URL::asset('ambiente/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>

<!-- SweetAlert Plugin Js -->
<script src="{{ URL::asset('ambiente/plugins/sweetalert/sweetalert.min.js')}}"></script>



@endpush


