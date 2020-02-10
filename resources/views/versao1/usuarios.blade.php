
@extends('layouts.main')
@section('style')

@endsection 
@section('rightbar-content')
<!-- Start Breadcrumbbar -->                    
<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">Usuários</h4>
            <form>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                        <label>Perfil Usuário</label>
                        <select class="form-control" name="perfilacesso" id="perfilacesso" >                                                                   
                            <option value="" >--Todos--</option> 
                            @foreach($perfisAcesso as $pAcesso)      
                                <option value="{{$pAcesso}}" {{ isset($_GET['perfilacesso']) && $_GET['perfilacesso']== $pAcesso? 'selected' :'' }} >{{$pAcesso}}</option>                                 
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="search" class="form-control" placeholder="Buscar" aria-label="Search" name="nome" id="nome" >                            
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">  
                            <div class="button-demo">    
                                <button type="submit" class="btn btn-primary waves-effect">
                                    <i class="dripicons-search"></i>
                                    <span>Pesquisar</span> 
                                </button>                         
                                <button type="button" class="btn btn-light" onclick="canceledit()" >
                                    <i class="dripicons-backspace"></i>
                                    <span>Cancelar</span> 
                                </button>
                                                        
                            </div>                
                        </div>   
                    </div>

                </div>
            </form>

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
                            @foreach($users as $user)
                            <tr>                            
                                <td>{{$user->id}}</td>
                                <td>{{$user->nome}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->perfilacesso}}</td>
                                <td>
                                    <div class="btn-group btn-group-sm" style="float: none;">     
                                                                        
                                        <button type="button" class="tabledit-edit-button btn btn-sm btn-info"  onclick="editarUsuario({{$user->id}})" style="float: none; margin: 5px;">
                                            <span class="ti-pencil"></span>
                                        </button>
                                
                                        
                                        <button type="button" class="tabledit-delete-button btn btn-sm btn-info" style="float: none; margin: 5px;">
                                            <span class="ti-trash"></span>
                                        </button>
                                    </div>                                   
                                
                                </td>        
                            </tr>
                            @endforeach
    
                            </tbody>
                        </table>
                        {!! $users->links() !!}
                          
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