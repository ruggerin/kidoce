@extends('template1')
@section('content')

<div class="block-header">
    <h2>Editar minhas informações</h2>
</div>

 <!-- Input -->
 <div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    INFORMAÇÕES DO USUARIO
                    <small>Informações básicas para acesso na aplicação.</small>
                </h2>
               
            </div>
            <div class="body">
                
                <div class="row clearfix">
                    <div class="col-sm-12" >
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control" placeholder="Usuário" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="password" class="form-control" placeholder="Senha" />
                            </div>
                        </div>
                    </div>
                </div>
               
                
            </div>
        </div>
    </div>
</div>
<!-- #END# Input -->
@endsection

@push('scripts')

@endpush
