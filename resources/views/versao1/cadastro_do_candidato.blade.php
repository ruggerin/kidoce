@extends('painel.template1')
@section('content')
 <!-- Page Loader -->
 <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Carregando...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->

<!-- Basic Examples -->
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                TABELA DE USUÁRIOS
                            </h2>
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
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th style="width: 100px">Ações </th>
                                            <th>Nome</th>
                                            <th>Sexo</th>
                                            <th>E-Mail</th>
                                            <th>CPF</th>
                                            <th>Ativo</th>
                                            <th>Cadastro</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>  
                                                <a href="#" title="Editar Cadastro"><i class="material-icons">mode_edit</i></a> 
                                                <a href="#" title="Imprimir Currículo Virtual"><i class="material-icons">print</i></a> 
                                            </td>
                                            <td>{{$user->nome}}</td>
                                            <td>{{$user->sexo}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->cpf}}</td>
                                            <td>{{$user->ativo}}</td>
                                            <td>{{$user->created_at}}</td>
                                        </tr>
                                    @endforeach    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->
@endsection

@push('scripts')
    <script src="../ambiente/js/pages/tables/jquery-datatable.js"></script>
    <script src="../ambiente/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="../ambiente/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="../ambiente/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="../ambiente/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="../ambiente/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="../ambiente/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="../ambiente/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="../ambiente/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="../ambiente/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
@endpush