@section('title') 

@endsection 
@extends('layouts.main')
@section('style')

<link href="{{asset('orbiter/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet" type="text/css">
@endsection 
@section('rightbar-content')

@if(isset($errors) && count($errors)>0)
        @foreach($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible" role="alert">
	        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
	       {{$error}}
        </div>
        @endforeach

@endif

<!-- Start Breadcrumbbar -->                    
<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">{{  isset($usuario)? 'Edição : '. $usuario->id : 'Cadastro de Usuário'  }}</h4>
           
        </div>
       
    </div>          
</div>
<!-- End Breadcrumbbar -->
<!-- Start Contentbar -->    
<div class="contentbar">                
    <!-- Start row -->
    <div class="row">
        <!-- Start col -->
        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="card-title">Edição</h5>
                </div>
                <div class="card-body">
                    @if(isset($usuario))
                    <form  method="post" enctype="multipart/form-data" action="{{ route('usuarios.update', $usuario->id) }}">
                    {!! method_field('PUT') !!}   
                    @else                
                    <form  method="post" enctype="multipart/form-data" action="{{route('usuarios.store') }}">
                    @endif    
                        <input type="hidden" name="_token" value ="{{csrf_token()}}" > 
                        <input type="file" id="imgUpload1"  onchange="readURL(this);" style="display: none" name="imgUpload1"  accept="image/png, image/jpeg,image/jpg"/>
                        <div class="row ">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group form-float">                                    
                                            <div class="waves-effect" style=" width:280px; height:280px" onclick="changePorfileImage(0);"   >
                                                <i class="material-icons center"  style="
                                                position: absolute;
                                                margin-left: auto;
                                                margin-right: auto;
                                                text-align:center;
                                                ">photo_camera</i>
                                            <a href="#"  data-toggle="tooltip" title="Editar Foto Perfil">
                                                @if(isset($usuario))
                                                        <img  id="fotoPerfil"  class="image-preview-input" src="{{ url('fotousuario/'.$usuario->id) }}" style=" width:100%; height:100%;"/>
                                                @else
                                                        <img  id="fotoPerfil"  class="image-preview-input" src="{{ url('fotousuario/novo') }}" style=" width:100%; height:100%;"/>
                                                @endif 
                                            </a>     
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row"> 
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <label class="form-label">Nome</label>
                                                    <input type="text" class="form-control text-uppercase" required autocomplete="off" id="nome" name="nome" value="{{$usuario->nome or old('nome')}}" >
                                                </div>
                                            </div>
                                        </div> 
            
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group form-float">    
                                                <div class="form-line">
                                                    <label class="form-label">E-mail/Login</label>
                                                    <input type="text" class="form-control text-lowercase" required autocomplete="off" id="email" value="{{$usuario->email or old('email')}}" name="email">
                                                </div>
                                            </div>
                                            <label class="form-label">Relacionamento/Conquista</label>
                                        </div>
                                                                                
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            
                                            
                                            <div class="bootstrap-tagsinput">
                                                <div class="card-body"  >
                                                    <input type="text" class="form-control" id="relacionamento" value="{{$usuario->relacionamento or old('relacionamento')}}" name="relacionamento" data-role="tagsinput" />
                                                </div>
                                                {{-- <input type="text" class="form-control text-uppercase"  autocomplete="off" id="relacionamento" value="{{$usuario->relacionamento or old('relacionamento')}}" name="relacionamento">--}}
                                            </div>    
                                         
                                        </div>
                                        
        
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group form-float">                                 
                                                <div class="form-line">
                                                    <label class="form-label">Senha</label>
                                                    <input type="password" class="form-control" autocomplete="off" id="password"  name="password">
                                                </div>                                
                                            </div>   
                                        </div>
                                    </div>       
                                </div>
    
                            </div>
                            
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                                                        
                                        <h4 class="card-inside-title">Perfil de acesso</h4>  
                                    </div>
                                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">   
                                        <div class="form-group">
                                            <div class="form-line">
                                                <select class="form-control" required name="perfilacesso" id="perfilacesso" >                                                                   
                                                    
                                                    @foreach($perfisAcesso as $pAcesso)
                                                        @if(isset($usuario) &&$pAcesso ==$usuario->perfilacesso )
                                                            <option value="{{$pAcesso}}" selected >{{$pAcesso}}</option>  
                                                        @else
                                                            <option value="{{$pAcesso}}" >{{$pAcesso}}</option>  
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-sm-4 col-xs-4">
                                        <div class="form-group">                                 
                                            <div class="demo-checkbox">
                                            @if( !isset($usuario->ativo) || $usuario->ativo==true)    
                                                <input type="checkbox" id="ativo" name ="ativo" value="on" checked>
                                            @else 
                                                <input type="checkbox" id="ativo" value="0" unchecked name ="ativo">
                                            @endif
                                            <label for="ativo">Usuário Habilitado</label>                                    
                                            </div>                              
                                        </div>   
                                    </div>
    
                                    <div class="col-sm-4 col-xs-4">
                                        <div class="form-group">                                 
                                            <div class="demo-checkbox">
                                            @if(isset($usuario))
                                                @if($usuario->administrador==true)    
                                                    <input type="checkbox" id="administrador" name ="administrador" value="on" checked>
                                                    
                                                @endif 
                                                @else
                                                    <input type="checkbox" id="administrador" value="0" unchecked name ="administrador">
                                            @endif
                                            <label for="administrador">Acesso Web Admin</label>                                    
                                            </div>                              
                                        </div>   
                                    </div>
                                                                                     
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <h4 class="card-inside-title">Localização</h4>   
                                    </div>                                           

    
                                    <div class="col-lg-6 col-md-6  col-sm-12 col-xs-12">
                                        <div class="form-group form-float">                                 
                                            <div class="form-line">
                                                <label class="form-label">Endereço</label>
                                                <input type="text" class="form-control text-uppercase" autocomplete="off" id="endereco" value="{{$usuario->endereco or old('endereco')}}" name="endereco">
                                            </div>
                                            
                                        </div>   
                                    </div>
        
                                    <div class="col-lg-2 col-md-2  col-sm-12 col-xs-12">
                                        <div class="form-group form-float">                                 
                                            <div class="form-line">
                                                <label class="form-label">Número</label>
                                                <input type="text" class="form-control text-uppercase" autocomplete="off" id="numero" value="{{$usuario->numero or old('numero')}}" name="numero">
                                            </div>
                                            
                                        </div>   
                                    </div>
                                    <div class="col-lg-2 col-md-2  col-sm-12 col-xs-12">
                                        <div class="form-group form-float">                                 
                                            <div class="form-line">
                                                <label class="form-label">Cep</label>
                                                <input type="text" class="form-control text-uppercase" autocomplete="off" id="cep" value="{{$usuario->cep or old('cep')}}" name="cep">
                                            </div>
                                            
                                        </div>   
                                    </div>
                                    <div class="col-lg-6 col-md-6  col-sm-12 col-xs-12">
                                        <div class="form-group form-float">                                 
                                            <div class="form-line">
                                                <label class="form-label">Bairro</label>
                                                <input type="text" class="form-control text-uppercase" autocomplete="off" id="bairro" value="{{$usuario->bairro or old('bairro')}}" name="bairro">
                                            </div>
                                            
                                        </div>   
                                    </div>
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="form-group form-float">                                 
                                            <div class="form-line">
                                                <label class="form-label">Município</label>
                                                <input type="text" class="form-control text-uppercase" autocomplete="off" id="municipio" value="{{$usuario->municipio or old('municipio')}}" name="municipio">
                                             </div>
                                            
                                        </div>   
                                    </div>
        
                                    <div class="col-sm-2 col-xs-12">
                                        <div class="form-group form-float">                                 
                                            <div class="form-line">
                                                <label class="form-label">UF</label>
                                                <input type="text" class="form-control text-uppercase" autocomplete="off" id="uf" value="{{$usuario->uf or old('uf')}}" name="uf">
                                            </div>                                
                                        </div>   
                                    </div>

                                    <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <label class="form-label">Ponto de Referências</label>
                                                <input type="text" class="form-control text-uppercase" autocomplete="off" id="pontoreferencia" name="pontoreferencia" value="{{$usuario->pontoreferencia or old('pontoreferencia')}}" >
                                            </div>
                                        </div>                                                
                                    </div>

                                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <label class="form-label">Longitude</label>
                                                <input type="text" class="form-control text-uppercase" autocomplete="off" id="lat" name="lat" value="{{$usuario->lat or old('lat')}}" >
                                            </div>
                                        </div>                                                
                                    </div>
    
                                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">                                                
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <label class="form-label">Longitude</label>
                                                <input type="text" class="form-control text-uppercase" autocomplete="off" id="lgn" name="lgn" value="{{$usuario->lgn or old('lgn')}}" >
                                            </div>
                                        </div>
                                    </div>  
                                    <div class="row icon-box-list" style=" cursor: pointer;     margin-top: auto;">
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                            <p><i class="feather icon-map-pin"></i></p>
                                        </div>  
                                    </div>
        
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="form-group form-float">                                 
                                            <div class="form-line">
                                                <label class="form-label">Telefone</label>
                                                <input type="text" class="form-control text-uppercase" autocomplete="off" id="telefone" value="{{$usuario->telefone or old('telefone')}}" name="telefone">
                                            </div>                                
                                        </div>   
                                    </div>    
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="form-group form-float">                                 
                                            <div class="form-line">
                                                <label class="form-label">Celular</label>
                                                <input type="text" class="form-control inputmask-phone" autocomplete="off" id="celular" value="{{$usuario->celular or old('celular')}}" name="celular">
                                            </div>                                
                                        </div>   
                                    </div>
                                </div>       
                            </div>        
    
                        </div>   
                            
                        <div class="form-group">  
                            <div class="button-demo">    
                                <button type="submit" class="btn btn-primary waves-effect">
                                    <i class="feather icon-check"></i>
                                    <span>Salvar</span> 
                                </button> 
                            
                                <button type="button" class="btn btn-light" onclick="canceledit()" >
                                    <i class="dripicons-backspace"></i>
                                    <span>Cancelar</span> 
                                </button>
                                                         
                            </div>                
                        </div>                       
    
                    </form> 
                </div>
            </div>
        </div>
        <!-- End col -->
    </div>
    <!-- End row -->
</div>
<!-- End Contentbar -->
@endsection 
@section('script')
<script src="{{asset('orbiter/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>
<script src="{{asset('orbiter/plugins/bootstrap-inputmask/jquery.inputmask.bundle.min.js')}}"></script>
<script src="{{asset('orbiter/plugins/bootstrap-tagsinput/typeahead.bundle.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#celular').inputmask("(99) 99999-9999");
            $('#telefone').inputmask("(99) 9999-99999");
        });
        $(function() {
           
            $('input').keyup(function() {
            if(this.name!='password' && this.name!='email' ){
                this.value = this.value.toLocaleUpperCase();
            }
            }); 
        
        
        });
        
        
        //Tooltip
        $('[data-toggle="tooltip"]').tooltip({
                container: 'body'
            });
        
            //Popover
        $('[data-toggle="popover"]').popover();
        
        
        function changePorfileImage(){
        //  $('#myModal').modal('show');
        $('#imgUpload1').trigger('click');
        
        
        }
        function canceledit(){
            window.open("{{route('usuarios.index') }}","_self");
            
        }
        
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#fotoPerfil')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection 