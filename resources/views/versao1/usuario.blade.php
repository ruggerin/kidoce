@extends('versao1.template1')
@section('content')
{{--
    Modal em Branco
<div id="myModal" class="modal fade smallModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Alterar Foto de Perfil</h4>
            </div>
            <div class="modal-body">

            </div>   
                
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>

            </div>
        </div>
    </div>
</div>
--}}

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
                    @if(isset($usuario))
                        <h2>Código: {{$usuario->id}}</h2>
                    @else
                        <h2>Cadastrar Novo Usuário</h2>
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
                @if(isset($usuario))
                <form  method="post" enctype="multipart/form-data" action="{{ route('usuarios.update', $usuario->id) }}">
                {!! method_field('PUT') !!}   
                @else                
                <form  method="post" enctype="multipart/form-data" action="{{route('usuarios.store') }}">
                @endif    
                    <input type="hidden" name="_token" value ="{{csrf_token()}}" > 
                    <input type="file" id="imgUpload1"  onchange="readURL(this);" style="display: none" name="imgUpload1"  accept="image/png, image/jpeg,image/jpg"/>
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="col-lg-3 col-md-4 col-sm-3 col-xs-3">
                                <div class="form-group form-float">                                    
                                    <div class="waves-effect" style=" width:150px; height:150px" onclick="changePorfileImage(0);"   >
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

                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control text-uppercase" required autocomplete="off" id="nome" name="nome" value="{{$usuario->nome or old('nome')}}" >
                                        <label class="form-label">Nome</label>
                                    </div>
                                </div>
                            </div> 

                            <div class="col-lg-8 col-md-8  col-sm-8 col-xs-12"> 
                                <div class="form-group form-float">    
                                    <div class="form-line">
                                        <input type="text" class="form-control text-lowercase" required autocomplete="off" id="email" value="{{$usuario->email or old('email')}}" name="email">
                                        <label class="form-label">E-mail/Login</label>
                                    </div>
                                </div>
                            </div>
                        

                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                <div class="form-group form-float">                                 
                                    <div class="form-line">
                                        <input type="password" class="form-control" autocomplete="off" id="password"  name="password">
                                        <label class="form-label">Senha</label>
                                    </div>                                
                                </div>   
                            </div>

                        </div>
                        
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                             
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">                            
                                <h4 class="card-inside-title">Perfil de acesso</h4>  
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

                            
                                                      
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <h4 class="card-inside-title">Localização</h4>    
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control text-uppercase" autocomplete="off" id="lat" name="lat" value="{{$usuario->lat or old('lat')}}" >
                                        <label class="form-label">Longitude</label>
                                    </div>
                                </div>
                                
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <h4 class="card-inside-title"> -</h4>  
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control text-uppercase" autocomplete="off" id="lgn" name="lgn" value="{{$usuario->lgn or old('lgn')}}" >
                                        <label class="form-label">Longitude</label>
                                    </div>
                                </div>
                            </div> 
                                                        

                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <div class="form-group">                                 
                                    <button type="button" class="btn btn-grey" onclick="" >
                                        <i class="material-icons">gps_fixed</i>
                                         
                                    </button>                                      
                                </div>    
                            </div>

                            <div class="col-lg-6 col-md-6  col-sm-6 col-xs-12">
                                <div class="form-group form-float">                                 
                                    <div class="form-line">
                                        <input type="text" class="form-control text-uppercase" autocomplete="off" id="endereco" value="{{$usuario->endereco or old('endereco')}}" name="endereco">
                                        <label class="form-label">Endereço</label>
                                    </div>
                                    
                                </div>   
                            </div>
    
                            <div class="col-sm-2 col-xs-12">
                                <div class="form-group form-float">                                 
                                    <div class="form-line">
                                        <input type="text" class="form-control text-uppercase" autocomplete="off" id="numero" value="{{$usuario->numero or old('numero')}}" name="numero">
                                        <label class="form-label">Número</label>
                                    </div>
                                    
                                </div>   
                            </div>
                            <div class="col-sm-3 col-xs-12">
                                    <div class="form-group form-float">                                 
                                        <div class="form-line">
                                            <input type="text" class="form-control text-uppercase" autocomplete="off" id="bairro" value="{{$usuario->bairro or old('bairro')}}" name="bairro">
                                            <label class="form-label">Bairro</label>
                                        </div>
                                        
                                    </div>   
                                </div>
                            <div class="col-sm-4 col-xs-12">
                                <div class="form-group form-float">                                 
                                    <div class="form-line">
                                        <input type="text" class="form-control text-uppercase" autocomplete="off" id="municipio" value="{{$usuario->municipio or old('municipio')}}" name="municipio">
                                        <label class="form-label">Município</label>
                                    </div>
                                    
                                </div>   
                            </div>
    
                            <div class="col-sm-2 col-xs-12">
                                <div class="form-group form-float">                                 
                                    <div class="form-line">
                                        <input type="text" class="form-control text-uppercase" autocomplete="off" id="uf" value="{{$usuario->uf or old('uf')}}" name="uf">
                                        <label class="form-label">UF</label>
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
    
</div>

 

@endsection
@push('scripts')


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
@endpush