@extends('versao1.template1')
@push('csss')
 <!-- JQuery DataTable Css -->
 <link href="{{ URL::asset('ambiente/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
 <!-- Sweetalert Css -->
 <link href="{{ URL::asset('ambiente/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
@endpush
@section('content')

{{-- Formulário de Inclusão/Alteração--}}
<div id="modalForm" class="modal smallModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Cadastro de Tipo de Registros</h4>
                
            </div>
    
            <div class="modal-body" id="bodymodal"  style="visibility:hidden">
                <form  method="post" id="formModal" action="{{route('tipoderegistros.store')}}">
                        <input type="hidden" name="_token" value ="{{csrf_token()}}">
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control text-uppercase" autocomplete="off" id="tiporegid" name="tiporegid"  value ="0" readonly>
                                        <label class="form-label">Código Interno</label>
                                    </div>
                                </div>
                            </div>    

                            <div class="col-sm-12">
                                <div class="form-group ">                                        
                                    <div class="form-line">
                                        <input placeholder="Descrição" type="text" class="form-control text-uppercase descricao" autocomplete="off" id="descricao" value ="0" name="descricao"  >
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row clearfix">
                            <div class="col-sm-12">
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
                        </div>    
                </form>  
                    <div class="demo-preloader" id="demo-preloader"  >
                            <img src="{{ URL::asset('ambiente/images/loading.gif')}}" width="50" height="50" />
                    </div>         
            </div>   
 
        </div>
    </div>
</div>


<div class="block-header">
    <h2>Cadastro de Tipo de Registro</h2>
   
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
                        <span>Novo</span>
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
                                <th>Descrição</th>                               
                                <th>Ações</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($tiporegistros as $tiporegistro)
                        <tr>
                            {{-- <td><a href="{{route('rca.edit', $rca->codrca)}}">{{$rca->codrca}}</a></td>--}}
                            <td>{{$tiporegistro->tiporegid}}</td>
                            <td>{{$tiporegistro->descricao}}</td>
                            <td>
                                <b style="cursor:pointer;" onclick="showFormEditar({{ $tiporegistro->tiporegid}})" >
                                    <i class="material-icons">mode_edit</i>
                                </b>
                                <a href="{{route('lojas.edit', $tiporegistro->tiporegid)}}" >
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
    function showFormEditar(id){
        document.getElementById("demo-preloader").style.visibility='visible';
        document.getElementById("bodymodal").style.visibility='collapse';              
        $(document).ready(function(){
            $("#modalForm").modal({
                backdrop: 'static',
                keyboard: false
            });
        });

        if(id!=0){
           // document.getElementById("formModal").action='#';
            $.ajax({
                url: 'tipoderegistros/'+id+'/edit',
                dataType: 'json',
                
                success: function(data) {
                
                    document.getElementById("tiporegid").value=data.tiporegid;
                    document.getElementById("descricao").value=data.descricao;
                    document.getElementById("demo-preloader").style.visibility='collapse';
                    document.getElementById("bodymodal").style.visibility='visible';
                        
                },
                error:function(request, status, error) {
                    console.log("ajax call went wrong:" + request.responseText);
                    document.getElementById("demo-preloader").style.visibility='collapse';
                    document.getElementById("bodymodal").style.visibility='visible';
                }            
            });
        }else{
            document.getElementById("demo-preloader").style.visibility='collapse';
            document.getElementById("bodymodal").style.visibility='visible';
            document.getElementById("descricao").value='';
        }    

    
}

function novaLojas(){
    showFormEditar(0);
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

    $('input').keyup(function() {
        this.value = this.value.toLocaleUpperCase();
    });


})
</script>
<script src="{{ URL::asset('ambiente/js/pages/ui/animations.js')}}"></script>
<script src="{{ URL::asset('ambiente/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
<script src="{{ URL::asset('ambiente/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>

   <!-- SweetAlert Plugin Js -->
   <script src="{{ URL::asset('ambiente/plugins/sweetalert/sweetalert.min.js')}}"></script>



@endpush


