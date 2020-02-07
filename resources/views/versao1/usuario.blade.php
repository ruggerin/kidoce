@section('title') 

@endsection 
@extends('layouts.main')
@section('style')


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
                                    <div class="col-lg-4 col-md4 col-sm-12 col-xs-12">
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
                                            @if( !isset($usuario->administrador) || $usuario->administrador==true)    
                                                <input type="checkbox" id="administrador" name ="administrador" value="on" checked>
                                            @else 
                                                <input type="checkbox" id="administrador" value="0" unchecked name ="administrador">
                                            @endif
                                            <label for="administrador">Acesso Web Admin</label>                                    
                                            </div>                              
                                        </div>   
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="row">                                                          
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <h4 class="card-inside-title">Localização</h4>   
                                            </div>

                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Longitude</label>
                                                        <input type="text" class="form-control text-uppercase" autocomplete="off" id="lat" name="lat" value="{{$usuario->lat or old('lat')}}" >
                                                    </div>
                                                </div>                                                
                                            </div>
            
                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">                                                
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Longitude</label>
                                                        <input type="text" class="form-control text-uppercase" autocomplete="off" id="lgn" name="lgn" value="{{$usuario->lgn or old('lgn')}}" >
                                                      
                                                    </div>
                                                </div>
                                            </div>  
                                            <div class="row icon-box-list" style=" cursor: pointer;">
                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                    <p><i class="feather icon-map-pin"></i></p>
                                                </div>  
                                            </div>

                                        </div>
                                    </div>   
                                   
    
                                    <div class="col-lg-6 col-md-6  col-sm-12 col-xs-12">
                                        <div class="form-group form-float">                                 
                                            <div class="form-line">
                                                <label class="form-label">Endereço</label>
                                                <input type="text" class="form-control text-uppercase" autocomplete="off" id="endereco" value="{{$usuario->endereco or old('endereco')}}" name="endereco">
                                            </div>
                                            
                                        </div>   
                                    </div>
        
                                    <div class="col-lg-6 col-md-6  col-sm-12 col-xs-12">
                                        <div class="form-group form-float">                                 
                                            <div class="form-line">
                                                <label class="form-label">Número</label>
                                                <input type="text" class="form-control text-uppercase" autocomplete="off" id="numero" value="{{$usuario->numero or old('numero')}}" name="numero">
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
        
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="form-group form-float">                                 
                                            <div class="form-line">
                                                <input type="text" class="form-control text-uppercase" autocomplete="off" id="telefone" value="{{$usuario->telefone or old('telefone')}}" name="telefone">
                                                <label class="form-label">Telefone</label>
                                            </div>                                
                                        </div>   
                                    </div>    
                                  
                                </div>   
                                
    
                            </div>        
    
                        </div>   
                            
                        <div class="form-group">  
                            <div class="button-demo">    
                                <button type="submit" class="btn btn-primary waves-effect">
                                    <i class="material-icons">save</i>
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
        <!-- End col -->
    </div>
    <!-- End row -->
</div>
<!-- End Contentbar -->
@endsection 
@section('script')

    <script>
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