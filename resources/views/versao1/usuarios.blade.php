@extends('versao1.template1')
@push('csss')
 <!-- JQuery DataTable Css -->
 <link href="{{ URL::asset('ambiente/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
 <!-- Sweetalert Css -->
 <link href="{{ URL::asset('ambiente/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
@endpush
@section('content')

<div class="block-header">
    <h2>Cadastro de usuários</h2>
</div>

{{--Comentário teste--}}

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
                    <button type="button" class="btn btn-info waves-effect" onclick="novo()" >
                        <i class="material-icons">add</i>
                        <span>Novo</span>
                    </button>    
                   
                </div>
                <div class="table-responsive ">
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
                                <a href="{{route('usuarios.edit',$user->id)}}" >
                                    <i class="material-icons"  >mode_edit</i>
                                </a>
                                <a href="{{route('usuarios.edit',$user->id)}}" >
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
function novo(){
   window.open("{{ route('usuarios.create')}}","_self");
}

$(function () {
    $('.js-table').DataTable({
        responsive: true
    });

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
<script src="{{ URL::asset('ambiente/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
<script src="{{ URL::asset('ambiente/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>

   <!-- SweetAlert Plugin Js -->
   <script src="{{ URL::asset('ambiente/plugins/sweetalert/sweetalert.min.js')}}"></script>



@endpush


