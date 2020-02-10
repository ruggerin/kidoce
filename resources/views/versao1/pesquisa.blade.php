
@extends('layouts.main')
@section('style')

@endsection 
@section('rightbar-content')
<!-- Start Breadcrumbbar --> 


{{-- Formulário de Inclusão/Alteração--}}
<div id="modalForm" class="modal fade smallModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Cadastro de Tipo de Produto</h4>
                
            </div>
    
            <div class="modal-body" id="bodymodal"  style="visibility:hidden">
                <form  method="post" action="{{route('pesquisa.store',0)}}">
                        <input type="hidden" name="_token" value ="{{csrf_token()}}">
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control text-uppercase" autocomplete="off" id="clienteid" name="clienteid"  value ="0" readonly>
                                        <label class="form-label">Cliente</label>
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
{{--Fim Modal--}}
<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">Usuários</h4>
           
        </div>
        <div class="col-md-4 col-lg-4">
            <div class="widgetbar">
                <button class="btn btn-primary-rgba" onclick="novo()"><i class="feather icon-plus mr-2"></i>Novo Cadastro</button>
            </div>                        
        </div>
    </div>          
</div>
<!-- End Breadcrumbbar -->
<!-- Start Contentbar -->    
<div class="contentbar">                
    <!-- Start row -->
    <div class="row">
        <!-- Start col -->
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="card-title">Registros</h5>
                </div>
                <div class="card-body">
                    
                    <div class="table-responsive">
                        <table class="table table-hover js-table dataTable">
                            <col width="10">
                            <col width="400">
                            <col width="400">
                            
                            <thead>
                                <tr>
                                    <th>Código</th>                                
                                    <th>Nome</th>  
                                    <th>E-mail</th>                                    
                                    <th>Perfil de Acesso</th>
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
    </div>
</div>        
<!-- End Contentbar -->
@endsection 
@section('script')


<script>
    
    function novo(){
       window.open("{{ route('usuarios.create')}}","_self");
    }

    function editarUsuario(id){
        
        window.location.href='usuarios/'+id+'/edit'
    }
    
    $(function () {
       
        @if(session('message')=='CONTAMASTER' )
     
        swal("Operação não autorizada", "Não é possivel editar usuários da administração do sistema");
        @endif
         //Tooltip
         $('[data-toggle="tooltip"]').tooltip({
            container: 'body'
        });
    
        //Popover
        $('[data-toggle="popover"]').popover();
    
    })
</script>
@endsection 