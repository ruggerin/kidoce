@extends('versao1.template1')
@push('csss')
 <!-- JQuery DataTable Css -->
 <link href="{{ URL::asset('ambiente/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
 <!-- Sweetalert Css -->
 <link href="{{ URL::asset('ambiente/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
@endpush
@section('content')

<div class="block-header">
    <h2>Cadastro de lojas</h2>
   
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
                                <th>Código</th>
                                <th>Razão Social</th>                               
                                <th>Fantasia</th>
                                <th>Bairro</th>
                                <th>Promotor</th>
                                <th>Ações</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($lojas as $loja)
                        <tr>
                            {{-- <td><a href="{{route('rca.edit', $rca->codrca)}}">{{$rca->codrca}}</a></td>--}}
                            <td>{{$loja->lojaid}}</td>
                            <td>{{$loja->razaosocial}}</td>
                            <td>{{$loja->fantasia}}</td>
                            <td>{{$loja->bairro}}</td>
                            <td>                                
                                <div>
                                    <a href="#"  data-toggle="tooltip" title="Ruggeri Barbosa">
                                    <img src="{{ asset('ambiente/images/users/'.auth()->user()->id.'.jpg') }}" width="30" height="30" class="img-circle" >
                                    </a>    
                                </div>
                            </td>    
                            <td>
                                <a href="{{route('lojas.edit',$loja->lojaid)}}" >
                                    <i class="material-icons">mode_edit</i>
                                </a>
                                <a href="{{route('lojas.edit',$loja->lojaid)}}" >
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
function novaLojas(){
    window.open("{{ route('lojas.create')}}","_self");
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
<script src="{{ URL::asset('ambiente/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
<script src="{{ URL::asset('ambiente/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>

   <!-- SweetAlert Plugin Js -->
   <script src="{{ URL::asset('ambiente/plugins/sweetalert/sweetalert.min.js')}}"></script>



@endpush


