@extends('versao1.template1')
@section('content')
@if(isset($errors) && count($errors)>0)
        @foreach($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible" role="alert">
	        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
	       {{$error}}
        </div>
        @endforeach

@endif

<div class="row clearfix">    
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
                <div class="header">
                    @if(isset($loja))
                        <h2>Código: {{$loja->lojaid}}</h2>
                    @else
                        <h2>Cadastrar Nova Loja</h2>
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
                @if(isset($loja))
                <form  method="post" action="{{route('lojas.update',$loja->lojaid) }}">
                {!! method_field('PUT') !!}   
                @else                
                <form  method="post" action="{{route('lojas.store') }}">
                @endif    
                    <input type="hidden" name="_token" value ="{{csrf_token()}}" > 
                    <div class="row clearfix">
                        <div class="col-sm-2">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control text-uppercase" autocomplete="off" id="codintegracao" name="codintegracao" value="{{$loja->codintegracao or old('codintegracao')}}" >
                                    <label class="form-label">Código Interno</label>
                                </div>
                            </div>
                        </div>                         
                        <div class="col-sm-10">
                            <div class="form-group form-float">
                                <div class="form-line">
                                   <input type="text" class="form-control text-uppercase" required autocomplete="off" id="razaosocial" name="razaosocial" value="{{$loja->razaosocial or old('razaosocial')}}" >
                                   <label class="form-label">Razão Social</label>
                                </div>
                            </div>
                        </div> 
                        <div class="col-sm-8">   
                            <div class="form-group form-float">    
                                <div class="form-line">
                                    <input type="text" class="form-control text-uppercase" autocomplete="off" id="fantasia" value="{{$loja->fantasia or old('fantasia')}}" name="fantasia">
                                    <label class="form-label">Fantasia</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">    
                            <div class="form-group form-float">    
                                <div class="form-line">
                                    <input type="text" class="form-control text-uppercase" autocomplete="off" id="adcionalfantasia" value="{{$loja->adcionalfantasia or old('adcionalfantasia')}}" name="adcionalfantasia">
                                    <label class="form-label">Adcional Fantasia</label>
                                </div>
                            </div>
                        </div>    

                        <div class="col-sm-2">
                            <div class="form-group form-float">    
                                <div class="form-line">
                                    <input type="text" class="form-control text-uppercase" autocomplete="off" id="tipofj" value="{{$loja->tipofj or old('tipofj')}}" name="tipofj">
                                    <label class="form-label">Tipo F/J</label>
                                </div>
                            </div> 
                        </div>    
                        
                        <div class="col-sm-6">
                            <div class="form-group form-float">    
                                <div class="form-line">
                                    <input type="text" class="form-control text-uppercase" autocomplete="off" id="cnpj" value="{{$loja->cnpj or old('cnpj')}}" name="cnpj">
                                    <label class="form-label">CNPJ/CPF</label>
                                </div>
                            </div>
                        </div>    
                        <div class="col-sm-4">
                            <div class="form-group form-float">                                 
                                <div class="form-line">
                                    <input type="text" class="form-control text-uppercase" autocomplete="off" id="cep" value="{{$loja->cep or old('cep')}}" name="cep">
                                    <label class="form-label">Cep</label>
                                </div>
                                
                            </div>   
                        </div>                        

                        <div class="col-sm-6">
                            <div class="form-group form-float">                                 
                                <div class="form-line">
                                    <input type="text" class="form-control text-uppercase" autocomplete="off" id="endereco" value="{{$loja->endereco or old('endereco')}}" name="endereco">
                                    <label class="form-label">Endereço</label>
                                </div>
                                
                            </div>   
                        </div>

                        <div class="col-sm-1">
                            <div class="form-group form-float">                                 
                                <div class="form-line">
                                    <input type="text" class="form-control text-uppercase" autocomplete="off" id="numero" value="{{$loja->numero or old('numero')}}" name="numero">
                                    <label class="form-label">Número</label>
                                </div>
                                
                            </div>   
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group form-float">                                 
                                <div class="form-line">
                                    <input type="text" class="form-control text-uppercase" autocomplete="off" id="complemento" value="{{$loja->complemento or old('complemento')}}" name="complemento">
                                    <label class="form-label">Complemento</label>
                                </div>
                                
                            </div>   
                        </div>
                        <div class="col-sm-3">
                                <div class="form-group form-float">                                 
                                    <div class="form-line">
                                        <input type="text" class="form-control text-uppercase" autocomplete="off" id="bairro" value="{{$loja->bairro or old('bairro')}}" name="bairro">
                                        <label class="form-label">Bairro</label>
                                    </div>
                                    
                                </div>   
                            </div>
                        <div class="col-sm-4">
                            <div class="form-group form-float">                                 
                                <div class="form-line">
                                    <input type="text" class="form-control text-uppercase" autocomplete="off" id="municipio" value="{{$loja->municipio or old('municipio')}}" name="municipio">
                                    <label class="form-label">Município</label>
                                </div>
                                
                            </div>   
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group form-float">                                 
                                <div class="form-line">
                                    <input type="text" class="form-control text-uppercase" autocomplete="off" id="uf" value="{{$loja->uf or old('uf')}}" name="uf">
                                    <label class="form-label">UF</label>
                                </div>                                
                            </div>   
                        </div>
                        
                        <div class="col-sm-2">
                            <div class="form-group form-float">                                 
                                <div class="form-line">
                                    <input type="text" class="form-control text-uppercase" autocomplete="off" id="lat" value="{{$loja->lat or old('lat')}}" name="lat">
                                    <label class="form-label">Latitude</label>
                                </div>                                
                            </div>   
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group form-float">                                 
                                <div class="form-line">
                                    <input type="text" class="form-control text-uppercase" autocomplete="off" id="lgn" value="{{$loja->lgn or old('lgn')}}" name="lgn">
                                    <label class="form-label">Longitude</label>
                                </div>                                
                            </div>   
                        </div>
  
                        <div class="col-sm-2">
                            <div class="form-group form-float">  
                                <button type="button" class="btn btn-grey" onclick="" >
                                    <i class="material-icons">gps_fixed</i>
                                    <span>Localização</span> 
                                </button>  
                            </div>    
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group form-float">                                 
                                <div class="form-line">
                                    <input type="text" class="form-control text-uppercase" autocomplete="off" id="telefone" value="{{$loja->telefone or old('telefone')}}" name="telefone">
                                    <label class="form-label">Telefone</label>
                                </div>                                
                            </div>   
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group form-float">                                 
                                <div class="form-line">
                                    <input type="text" class="form-control text-uppercase" autocomplete="off" id="celular" value="{{$loja->celular or old('celular')}}" name="celular">
                                    <label class="form-label">Telefone Celular</label>
                                </div>                                
                            </div>   
                        </div>

                        <div class="col-sm-8">
                            <div class="form-group form-float">                                 
                                <div class="form-line">
                                    <input type="text" class="form-control text-uppercase" autocomplete="off" id="email" value="{{$loja->email or old('email')}}" name="email">
                                    <label class="form-label">E-Mail</label>
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
@endsection
@push('scripts')


<script>
$(function() {
    $('input').keyup(function() {
        this.value = this.value.toLocaleUpperCase();
    });
  
});

function canceledit(){
    window.open("{{ url()->previous() }}","_self");
    


}
</script>
@endpush