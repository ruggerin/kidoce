@extends('layouts.main')
@section('style')

@endsection 
@section('rightbar-content')
{{-- Formulário de Inclusão/Alteração--}}
<div id="modalForm" class="modal fade bd-example-modal-lg">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Cadastro de Produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form  method="post"  id="formModal" action="{{route('produtos.store',0)}}">
                <div class="modal-body" id="bodymodal"  style="visibility:hidden">
                    
                        <input type="hidden" name="_token" value ="{{csrf_token()}}">
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label class="form-label">Código Interno</label>
                                        <input type="text" class="form-control text-uppercase" autocomplete="off" id="produtoid" name="produtoid"  value ="0" readonly>
                                    </div>
                                </div>
                            </div>    

                            <div class="col-sm-12">
                                <div class="form-group">                                        
                                    <div class="form-line">
                                        <label class="form-label">Descrição</label>
                                        <input type="text" class="form-control text-uppercase " autocomplete="off" id="produto" value ="0" name="produto"  >
                                </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                <label>Categoria de Produtos</label>
                                <select class="form-control" name="categoria_id" id="categoria_id" >                                                                   
                                    <option>--Selecione--</option>
                                    @foreach($categorias as $categoria)      
                                        <option value="{{$categoria->categid}}" >{{$categoria->descricao}}</option>                                 
                                    @endforeach
                                </select>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">                                        
                                    <div class="form-line">
                                        <label class="form-label">Valor de Conversão (Receitas)</label>
                                        <input type="number" class="form-control" autocomplete="off" id="pontoconvreceita" value ="0" name="pontoconvreceita"  >
                                </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">                                        
                                    <div class="form-line">
                                        <label class="form-label">Unidade Medida</label>
                                        <input type="number" class="form-control" autocomplete="off" id="unidmedid" value ="0" name="unidmedid"  >
                                </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">                                        
                                    <div class="form-line">
                                        <label class="form-label">Preço de Custo</label>
                                        <input type="number" class="form-control" autocomplete="off" id="precocusto" value ="0" name="precocusto"  >
                                </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">                                        
                                    <div class="form-line">
                                        <label class="form-label">Qtd. Estoque(QCR)</label>
                                        <input type="number" class="form-control" autocomplete="off" id="qtest" value ="0" name="qtest"  >
                                </div>
                                </div>
                            </div>
                        
                        </div>
                            
                    
                    <div class="demo-preloader" id="demo-preloader"  >
                            <img src="{{ URL::asset('ambiente/images/loading.gif')}}" width="50" height="50" />
                    </div>         
                </div>   
              
                <div class="modal-footer">
                
                    <button type="submit" class="btn btn-primary waves-effect">
                        Salvar
                    </button> 
                
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

                </div>
            </form>
        </div>
        
    </div>
</div>



<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">Produtos</h4>
            <form>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                        <label>Categoria de Produtos</label>
                        <select class="form-control" name="categoria" id="categoria" >                                                                   
                            <option value="" >--Todos--</option> 
                            @foreach($categorias as $categoria)      
                                <option value="{{$categoria->categid}}" {{ isset($_GET['categoria']) && $_GET['categoria']== $categoria->categid? 'selected' :'' }} >{{$categoria->descricao}}</option>                                 
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="search" class="form-control" placeholder="Buscar" aria-label="Search" name="descricao" id="searchdescricao" >                            
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
                <button class="btn btn-primary-rgba" onclick="showFormEditar(0)"><i class="feather icon-plus mr-2"></i>Novo Cadastro</button>
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
                            <col width="300">
                            <col width="200">
                    
                            
                            <thead>
                                <tr>
                                    <th>Código</th>                                
                                    <th>Descricao</th>  
                                    <th>Categoria</th>  
                                    <th>Unidade Medida</th>                                    
                                    <th>Estoque</th>
                                    <th>Preço</th>
                                    <th>Ações</th>
                                
                                </tr>
                            </thead>
                            <tbody>
                               
                            @foreach($produtos as $prod)
                            <tr>                            
                                <td>{{$prod->produtoid}}</td>
                                <td>{{$prod->produto}}</td>
                                <td>{{$prod->categoriaid}}</td>
                                <td>{{$prod->unidmedid}}</td>
                                <td>{{$prod->qtest}}</td>
                                <td>{{number_format( $prod->precovenda,4 , ',', ' ')}}</td>
                                <td>
                                    <div class="btn-group btn-group-sm" style="float: none;">     
                                                                        
                                        <button type="button" class="tabledit-edit-button btn btn-sm btn-info"  onclick="showFormEditar({{$prod->produtoid}})" style="float: none; margin: 5px;">
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
                        {!! $produtos->links() !!}
                          
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
     function showFormEditar(id){
        document.getElementById("demo-preloader").style.visibility='visible';
        document.getElementById("bodymodal").style.visibility='collapse';              
        $(document).ready(function(){
            $("#modalForm").modal({
                backdrop: 'static',
                keyboard: false
            });
        });

        if(id!=0){
           // document.getElementById("formModal").action='#';
            $.ajax({
                url: 'produtos/'+id+'/edit',
                dataType: 'json',
                
                success: function(data) {
                
                    document.getElementById("produtoid").value=data.produtoid;
                    document.getElementById("produto").value=data.produto;
                    document.getElementById("pontoconvreceita").value=data.pontoconvreceita;
                    document.getElementById("precocusto").value=data.precocusto;
                    document.getElementById("qtest").value=data.qtest;
                    document.getElementById("categoria_id").value = data.categoria_id;

                    document.getElementById("demo-preloader").style.visibility='collapse';
                    document.getElementById("bodymodal").style.visibility='visible';
                        
                },
                error:function(request, status, error) {
                    console.log("ajax call went wrong:" + request);
                    document.getElementById("demo-preloader").style.visibility='collapse';
                    document.getElementById("bodymodal").style.visibility='visible';
                }            
            });
        }else{
            document.getElementById("demo-preloader").style.visibility='collapse';
            document.getElementById("bodymodal").style.visibility='visible';
            document.getElementById("produto").value='';
        }  
    
    }
function novaLojas(){
    window.open("{{ route('lojas.create')}}","_self");
}


$(function () {
   
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
<script src="{{ URL::asset('ambiente/js/pages/ui/animations.js')}}"></script>
<script src="{{ URL::asset('ambiente/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
<script src="{{ URL::asset('ambiente/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>

   <!-- SweetAlert Plugin Js -->
   <script src="{{ URL::asset('ambiente/plugins/sweetalert/sweetalert.min.js')}}"></script>



@endsection


