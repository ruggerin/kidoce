@extends('template1')
@section('content')
@php
date_default_timezone_set('America/Manaus');
@endphp
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Title</h4>
            </div>
            <div class="modal-body">
                <!-- Example Tab -->

            <div class="body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs tab-nav-right" role="tablist">
                    <li role="presentation" class="active"><a href="#home" data-toggle="tab">INFORMAÇÕES</a></li>
                    <li role="presentation"><a href="#profile" data-toggle="tab">PRÉ-CORTES</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="home">
                        <b>Informações Gerais da Carga</b>
                        <table  class="table table-striped" >
                            <tr> 
                                <td>Nome Motorista</td>
                                <td class="modal-motorista">a</td>                                
                            </tr>
                           
                            <tr> 
                                <td>Observação</td>
                                <td class="modal-observacaodestino">a</td>                                
                            </tr>

                            <tr>
                                <td>Progresso Separação</td>
                                <td>
                                    <div class="progress"  >
                                        <div class="progress-bar modal-pb-separacao" role="progressbar" id="modal-pb-separacao" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%; ">
                                            75%
                                        </div>
                                    </div>

                                </td>
                            </tr>
                            <tr> 
                                <td>Total Notas</td>
                                <td class="modal-numnotas">a</td>                                
                            </tr>
                            <tr> 
                                <td>Valor Total</td>
                                <td class="modal-vlrtotal">a</td>                                
                            </tr>
                            <tr> 
                                <td>Funcionario Separação</td>
                                <td class="modal-funcsep">a</td>                                
                            </tr>
                            <tr> 
                                <td>Progresso Separação</td>
                                <td class="modal-progsep">a</td> 
                                                               
                            </tr>
                            <tr> 
                                <td>Início Conferencia</td>
                                <td class="modal-iniconf">a</td>                                
                            </tr>
                            <tr> 
                                <td>Fim Conferencia</td>
                                <td class="modal-fimconf">a</td>                                
                            </tr>
                            <tr> 
                                <td>Conferente</td>
                                <td id="modal-conferente">a</td>                                
                            </tr>
                        </table>
                    </div>
                    
                    <div role="tabpanel" class="tab-pane fade" id="profile">
                        <div class="body table-responsive">
                            <table  class="table table-striped"  >
                                <thead>
                                    <tr>                                        
                                        <th>Código</th>
                                        <th>Descrição</th>
                                        <th>Qtd. Corte</th>
                                        <th>Motivo</th>
                                    </tr>
                                </thead>
                                <tbody id="tblPrecortes"></tbody>
                            </table>
                        </div> 
                    </div>
                    

                </div>
            </div>

            <!-- #END# Example Tab -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>

            </div>
        </div>
    </div>
</div>

<div class="block-header">
    <h2>Consolidação de Cargas</h2>
</div>

<!-- Basic Example | Horizontal Layout -->
<div class="row clearfix">
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
                            <li><a href="javascript:void(0);">Action</a></li>
                            <li><a href="javascript:void(0);">Another action</a></li>
                            <li><a href="javascript:void(0);">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!--#INÍCIO CORPOCARD-->
            <div class="body">    
                <div class="demo-masked-input">
                    <div class="row clearfix">                    
                        <div class="col-sm-3" style="width:150px" >
                            <b>Data Montagem</b>
                            <div class="input-group" style="width:120px">
                                <span class="input-group-addon">
                                    <i class="material-icons">date_range</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" name="dtinicio" id="dtinicio" class="form-control datepicker" value="@php echo(date('d-m-Y'));@endphp" placeholder="Data Inicial">
                                </div>
                            </div>
                        </div> 

                        <div class="col-sm-3" style="width:150px">
                            <b style="visibility:hidden" >a </b>
                            <div class="input-group" style="width:120px">
                                <span class="input-group-addon">
                                    <i class="material-icons">date_range</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control datepicker" name="dtfim"  id ="dtfim" value="@php echo(date('d-m-Y'));@endphp" placeholder="Data Final">
                                </div>
                            </div>
                        </div> 
                        <div class="col-sm-4">                            
                            <b>Motorista</b>
                            <select class="form-control show-tick" name="motorista" id="motorista"  tabindex="-98">
                            <option value="0" >TODOS OS MOTORISTAS</option>
                                @foreach($lst_motoristas as $motorista )
                                <option value="{{$motorista->matricula}}" >{{$motorista->matricula." ".$motorista->nome}} </option>

                                @endforeach
                            </select>
                        </div>
                        <button type="button" class="btn bg-cyan waves-effect" onclick="CarregarCarregamentos()">
                        <i class="material-icons">search</i>
                        <span>Pesquisar</span>
                        </button>
  
                    </div> 
                </div>

            </div>
            <!--#FIM# CORPOCARD-->
            <div class="body table-responsive">
                <table  class="table table-striped" >
                    <thead>
                        <tr>                                        
                            <th>Núm Car</th>
                            <th>Dt. Conf.</th>
                            <th>Destino</th>
                            <th>Motorista</th>
                            <th>Prog. Sep</th>
                            <th>Prog. Sep</th>
                        </tr>
                    </thead>
                    <tbody id="myTable"></tbody>
                </table>
            </div> 
        </div>      

    </div>
</div>
            <!-- #END# Basic Example | Horizontal Layout -->
@endsection
@push('scripts')
  <!-- Maps API Javascript -->
  <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCC5-US8dhMNUh6yFNd9Sw_4LqnnVT042A"></script>
 
<script>
$(function () {

    $('.datepicker').bootstrapMaterialDatePicker({ 
    weekStart : 0, 
    time: false, 
    format:'DD-MM-YYYY',  
    cancelText: "Cancelar"  

 });



});

function testemodal(numcar){
    $(document).ready(function(){
		$("#myModal").modal('show');
	});



}



function CarregarCarregamentos(){

 var dti = document.getElementById('dtinicio').value;
 var dtf = document.getElementById('dtfim').value;
 var table = document.getElementById("myTable");
 table.innerHTML = "";
 var select = document.getElementById('motorista');
 var motora = select.options[select.selectedIndex].value;	 

    $.getJSON("{{route('consulta_carregamento')}}/"+dti+"/"+dtf+"/"+motora, function(pontos) 
    {
       
        $.each(pontos, function(index, ponto) {

            var row = table.insertRow(0);

            // Insert new cells (<td> elements) at the 1s   t and 2nd position of the "new" <tr> element:
            var numcar = row.insertCell(0);
            var cell_dtmontagem = row.insertCell(1);
            var cell2 = row.insertCell(2);            
            var cell3 = row.insertCell(3);
            var cell4 = row.insertCell(4);
            var qtentregas = row.insertCell(5);
            var mapa = row.insertCell(6); 

            //  infocarreg(numcar)


            var iconemapa = document.createElement('a');   
            var linkmapa= "{{route('consoligarnumcar')}}/"+ponto.numcar;
            iconemapa.href = linkmapa;
            if(ponto.dtfat==null){
                iconemapa.innerHTML= '<b class="material-icons">fiber_manual_record</b>';
            }
            else{
                iconemapa.innerHTML= '<b class="material-icons" style="color:green" >fiber_manual_record</b>';
            }
            
            var elLink = document.createElement('a');
            var href= "{{route('consoligarnumcar')}}/"+ponto.numcar;
            elLink.href = href;
            elLink.innerHTML = ponto.numcar;
            iconemapa.target = "_blank";

            // Add some text to the new cells:
            /*numcar.appendChild(elLink);*/
            numcar.innerHTML ='<a onclick="infocarreg('+ponto.numcar+')" style="cursor:pointer;">'+ponto.numcar+'</a>';
            cell_dtmontagem.innerHTML = ponto.dataconf;
            cell2.innerHTML = ponto.destino;
            cell3.innerHTML = ponto.motorista;   
            if(ponto.progresso>=100){
                cell4.innerHTML = 100+"%";
                qtentregas.innerHTML= '<b class="material-icons" style="color:green" >fiber_manual_record</b>';
               
            } else{
                cell4.innerHTML =ponto.progresso+"%";
                qtentregas.innerHTML= '<b class="material-icons" style="color:red" >fiber_manual_record</b>';
            }
            
            mapa.appendChild(iconemapa);
           

        });
    });

}



function pinSymbol(color) {
    return {
        path: 'M 0,0 C -2,-20 -10,-22 -10,-30 A 10,10 0 1,1 10,-30 C 10,-22 2,-20 0,0 z M -2,-30 a 2,2 0 1,1 4,0 2,2 0 1,1 -4,0',
        fillColor: color,
        fillOpacity: 1,
        strokeColor: '#000',
        strokeWeight: 2,
        scale: 1,
   };
}
 

function abrirInfoBox(id, marker) {
	if (typeof(idInfoBoxAberto) == 'number' && typeof(infoBox[idInfoBoxAberto]) == 'object') {
		infoBox[idInfoBoxAberto].close();
	}

	infoBox[id].open(map, marker);
	idInfoBoxAberto = id;
}


function infocarreg(numcar){

var url = "carregamentos/modals/infocarregamento?numcar="+numcar;
    $.ajax({
        url: url,
        dataType: 'json',
        success: function(data) {
        
            //Atualiza os campos da modal
            $('.modal-title').text(data['infogeral'][0].numcar+'-'+data['infogeral'][0].destino);
            $('.modal-motorista').text(data['infogeral'][0].motorista);
            $('.modal-observacaodestino').text(data['infogeral'][0].obsdestino);
            $('.modal-numnotas').text(data['infogeral'][0].numnotas);
            $('.modal-vlrtotal').text(data['infogeral'][0].vltotal);

            $('.modal-funcsep').text(data['infogeral'][0].func_sep+'-'+data['infogeral'][0].separador);
            $('.modal-progsep').text(data['infogeral'][0].progresso_separacao+'%');
            $('.modal-iniconf').text(data['infogeral'][0].dtiniciocheckout);
            $('.modal-fimconf').text(data['infogeral'][0].dtfimcheckout);
            var percentual_sep = "0%"
            if( data['infogeral'][0].progresso_separacao !=0 ){
                percentual_sep =  data['infogeral'][0].progresso_separacao+'%' 
            }

            document.getElementById("modal-pb-separacao").textContent= percentual_sep;    
            document.getElementById("modal-conferente").textContent= data['infogeral'][0].codconferente +'-'+data['infogeral'][0].nomeconferente; 
            document.getElementById("modal-pb-separacao").style.width=percentual_sep;
            // show modal
            $('#myModal').modal('show');
            
            var tbl_precortes = document.getElementById("tblPrecortes");
            tbl_precortes.innerHTML = "";

            $.each(data['precortes'], function(index, item) {
                var row = tbl_precortes.insertRow(0);
                // Insert new cells (<td> elements) at the 1s   t and 2nd position of the "new" <tr> element:
                var codprod = row.insertCell(0);
                var descricao = row.insertCell(1);
                var qtcorte = row.insertCell(2);
                var motivo = row.insertCell(3);

                codprod.innerHTML = item.codprod;
                descricao.innerHTML = item.descricao;
                qtcorte.innerHTML = item.qtcorte;
                motivo.innerHTML = item.codmotivo+  "-"+ item.motivo;

            });

        },
        error:function(request, status, error) {
            console.log("ajax call went wrong:" + request.responseText);
        }
    });

}

</script>

<script src="{{ URL::asset('ambiente/plugins/jquery-steps/jquery.steps.js')}}"></script>


<!--JS MASK INPUT-->
<script src="{{ URL::asset('ambiente/plugins/jquery-inputmask/jquery.inputmask.bundle.js')}}"></script>

<!-- Moment Plugin Js -->
<script src="{{ URL::asset('ambiente/plugins/momentjs/moment.js')}}"></script>

<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="{{ URL::asset('ambiente/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>

@endpush