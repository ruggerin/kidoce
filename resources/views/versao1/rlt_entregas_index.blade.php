@extends('versao1.template1')
@section('content')

<div class="row clearfix">    
    <!-- Task Info -->
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Filtros</h2>
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
                <form id="frm1" name="frm1">
                    <div class="row clearfix">
                        <div class="col-sm-4">    
                            <div class="form-group">    
                                
                                <label for="codmotorista">Entregador</label>
                                <select class="form-control" required name="codmotorista" id="codmotorista" >                                                                   
                                        <option value="0" >Todos</option> 
                                    @foreach($motoristas as $motorista)                                         
                                        <option value="{{$motorista->codmotorista}}" >{{$motorista->codmotorista.". ".$motorista->nome}}</option>  
                                    @endforeach
                                </select>
                                
                            </div>
                        </div> 
                    

                        <div class="col-sm-2">   
                            <div class="form-group">    
                                <div class="form-line">
                                    <label for="datasaida">Período de Movimentação</label>
                                    <input type="text" class="form-control datetimepicker" autocomplete="off" id="dti" value="{{date('01/m/Y')}}"  name="dti">
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-2">   
                            <div class="form-group">    
                                <div class="form-line">
                                    <label for="datasaida" style="visibility:hidden">Período de Movimentação</label>
                                    <input type="text" class="form-control datetimepicker" autocomplete="off" id="dtf" value="{{date('d/m/Y')}}"  name="dtf">
                                    
                                </div>
                            </div>
                        </div>  
                        
                        
                        
                        <div class="col-sm-2">   
                            <div class="form-group">    
                                <div class="form-line">
                                    <label for="numcarreg">Carregamento</label>
                                    <input type="text" class="form-control" autocomplete="off" id="numcarreg" name="numcarreg"   >
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">   
                            <div class="form-group">  
                                    <label for="datasaida" style="visibility:hidden">Período de Movimentação</label>
                                <div class="button-demo">    
                                    <button type="submit" id="btnsubmit" class="btn waves-effect">
                                        {{--<i class="material-icons">done</i>--}}                                       
                                        <span>Buscar</span> 
                                        <img src="{{ URL::asset('ambiente/images/loading.gif')}}" id="animacaobotao" style="display: none" width="50" height="30" />
                                    </button> 
                                </div>    
                            </div>
                        </div>        

                    </div>  
                </form>    
            </div>
        </div>
    </div>
    <!-- #END# Task Info -->    
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Carregamentos</h2>
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
                <div class="table-responsive ">
                    <table  id="tableBusca" width="300%" class="table table-bordered table-striped table-hover js-table dataTable" >
                           
                        <thead>
                            <tr>
                                <th>Carregamento</th>
                                <th>Destino</th>
                                <th>Cod. Mot.</th>
                                <th>Motorista</th>
                                <th>Saída</th>
                                <th>Retorno</th> 
                                <th>Valor Carga</th>
                                <th>Qtd. Ent.</th> 
                                <th>Ações</th> 
                                
                            </tr>
                        </thead>
                        <tbody>
                        
    
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ URL::asset('ambiente/plugins/datatables/datatables.min.js')}}"></script>
<script>
    var tblCarregamentos;

    tblCarregamentos = $('#tableBusca').DataTable( {
            rowReorder: {
            selector: 'tr'
        },
        "autoWidth": false,
        "paging": false,
        responsive: false,
        "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": ["<a id='imprimir' style='cursor:pointer;' onclick=''> <i class='material-icons'>print</i> </a>"]
        } ],
        
        columns:[
        
        {data:'numcarreg','width': '80px'},
        {data:'destino', 'width': '300px'},
        {data:'codmotorista', 'width': '80px'},
        {data:'motorista', 'width': '300px'},
        {data:'dtsaida', 'width': '200px'},
        {data:'dtretorno', 'width': '200px'},
        {data:'valorcarga'},       
        {data:'qtentregas'},
        {data:null}
            
        ],

        rowReorder: {
            dataSrc: 'seqent'
        },
        "initComplete": function(){
            //recarregarPontos();
        }
        
    } );
    tblCarregamentos.on( 'click','a',  function () {
        
        var dataResponse = tblCarregamentos.row( $(this).parents('tr') ).data();      
        window.open('rltcarregamentos/analitico/'+ dataResponse['numcarreg']) ;
    } );

    $(function() {
        
        $('input').keyup(function() {
            this.value = this.value.toLocaleUpperCase();
        });
        //Datetimepicker plugin
        $('.datetimepicker').bootstrapMaterialDatePicker({
            format: 'DD/MM/YYYY',
            clearButton: true,
            time: false,
            weekStart: 1
        });

        $('#frm1').submit(function(){            
            var dados = jQuery( this ).serialize();
            //collapse
            document.getElementById('btnsubmit').disabled =true;
            document.getElementById('animacaobotao').style.display = 'inline-block';
            jQuery.ajax({
                type: "POST",
                url: "{{route('buscarCarregamentos')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: dados,
                success: function( data )
                {
                    console.log( data) ;
                    
                    tblCarregamentos.clear();
                    tblCarregamentos.rows.add(data);
                    tblCarregamentos.draw();
                    
                    document.getElementById('animacaobotao').style.display = 'none';
                    document.getElementById('btnsubmit').disabled =false;
                }
            });
            
            return false;
        });

    });
</script>
@endpush

