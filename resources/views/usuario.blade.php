@extends('ambiente')
@section('content')

    @if(  count(  $errors) )

         
<div class="alert alert-danger" role="alert">
    @foreach($errors->all() as $error )
        <p>{{$error}} </p>
    @endforeach
</div>

@endif    

  <!-- page content -->
  <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Registro Rca</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Cadastro de Vendedores/Edição de Cadastro <small>Informações Básicas</small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    @if( isset($rca_atual) && $rca_atual->codrca >0 )
                      <form id="demo-form2" class="form" method="post" action="{{ route('rca.update',$rca_atual->codrca) }}" class="form-horizontal form-label-left">   
                    {!! method_field('PUT') !!}
                    @else
                      <form id="demo-form2" class="form" method="post" action="{{ route('rca.update',$rca_atual->codrca) }}" class="form-horizontal form-label-left">   
                    @endif
                     {{ csrf_field() }}
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="first-name">Código <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="codrca" required="required" name="codigo" disabled="disabled" class="form-control col-md-7 col-xs-12" value="{{$rca_atual->codrca}}">
                        </div>
                      </div>

                      

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nome <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="nome" required="required" name="nome" class="form-control col-md-7 col-xs-12" value="{{$rca_atual->nome}}">
                        </div>
                      </div>

                     

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Nome de Guerra(Usuário) <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="nomedeguerra" required="required"  name ="nomedeguerra"class="form-control col-md-7 col-xs-12" value="{{$rca_atual->nomedeguerra}}">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Senha <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="password" id="senha" required="required" name="senha"  class="form-control col-md-7 col-xs-12" value="{{$rca_atual->senha}}">
                        </div>
                      </div>

                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" step=".01" for="last-name">Percentual de Comissão(%) <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="comissao" name="comissao"  step="any"  class="form-control col-md-7 col-xs-12" value="{{$rca_atual->comissao}}">
                                         
                       </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Telefone 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="tel" id="tel_cel"  name="tel_cel"  class="form-control col-md-7 col-xs-12" value="{{$rca_atual->tel_cel}}">
                                            
                       </div>
                      </div>

                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="endereco">Endereço 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="endereco"  name="endereco"  class="form-control col-md-7 col-xs-12" value="{{$rca_atual->endereco}}">
                                            
                       </div>
                      </div>

                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="numero">Número 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="numero"  name="numero"  class="form-control col-md-7 col-xs-12" value="{{$rca_atual->numero}}">
                                            
                       </div>
                      </div>

                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bairro">Bairro 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="bairro"  name="bairro"  class="form-control col-md-7 col-xs-12" value="{{$rca_atual->bairro}}">
                                            
                       </div>
                      </div>
                     
                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cep">Cep 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="cep"  name="cep"  class="form-control col-md-7 col-xs-12" value="{{$rca_atual->cep}}">
                                            
                       </div>
                      </div>

                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cidade">Município 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="cidade"  name="cidade"  class="form-control col-md-7 col-xs-12" value="{{$rca_atual->cidade}}">
                                            
                       </div>
                      </div> 

                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cidade">Uf 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="uf"  name="uf"  class="form-control col-md-7 col-xs-12" value="{{$rca_atual->uf}}">
                                            
                       </div>
                      </div> 
                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="latitude">Latitude 
                        </label>
                        <div class="col-md-2 col-sm-6 col-xs-12">
                          <input type="text" id="latitude"  name="latitude"  class="form-control col-md-7 col-xs-12" value="{{$rca_atual->latitude}}">
                                            
                       </div>

                       <label class="control-label col-md-1 col-sm-3 col-xs-12" for="longitude">Longitude 
                        </label>
                        <div class="col-md-2 col-sm-6 col-xs-12">
                          <input type="text" id="longitude"  name="longitude"  class="form-control col-md-7 col-xs-12" value="{{$rca_atual->longitude}}">
                                            
                       </div>
                      </div> 


                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cidade">Ativo  </label>
                       
                      
                            <label class="">
                              <div class="icheckbox_flat-green checked" style="position: relative;">
                                <input type="checkbox" id="ativo" name="ativo" class="flat" value="1"   @if(isset ($rca_atual) && $rca_atual->ativo =='1' ) checked  @endif style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 
                            </label>
                  
                        
                      </div> 
        





                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success">Salvar</button>
                          <a href="{{ route('listarcas') }}" class="btn btn-default">Cancelar Edição</a>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

          

@endsection

@push('scripts')
    <script src="{{ URL::asset('/frame/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ URL::asset('/frame/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{ URL::asset('/frame/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ URL::asset('/frame/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
    <script src="{{ URL::asset('/frame/vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
    <script src="{{ URL::asset('/frame/vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{ URL::asset('/frame/vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{ URL::asset('/frame/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{ URL::asset('/frame/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
    <script src="{{ URL::asset('/frame/vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ URL::asset('/frame/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
    <script src="{{ URL::asset('/frame/vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
    <script src="{{ URL::asset('/frame/vendors/jszip/dist/jszip.min.js')}}"></script>
    <script src="{{ URL::asset('/frame/vendors/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{ URL::asset('/frame/vendors/pdfmake/build/vfs_fonts.js')}}"></script>

@endpush