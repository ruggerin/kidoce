@extends('template1')
@section('content')

<div class="col-sm-3" style="  position: absolute;    right:0px; z-index:5"  >
    <button type="button" onClick="recarregar()" id="btn-pesquisar" class="btn bg-indigo  btn-circle waves-effect waves-circle waves-float">
        <i class="material-icons">search</i>
    </button>
    <div class="preloader pl-size-xs" id="progresso" style="visibility:hidden" >
        <div class="spinner-layer pl-red-grey">
            <div class="circle-clipper left">
                <div class="circle"></div>
            </div>
            <div class="circle-clipper right">
                <div class="circle"></div>
            </div>
        </div>
    </div>
</div>
<div class="block-header">
    <h2>Resumo de vendas</h2>
    <div class="row clearfix">
       
        <div class="row clearfix">
            <div class="col-sm-3" style="width:150px" >
            
        
                <div class="input-group" style="width:120px">
                    <span class="input-group-addon">
                        <i class="material-icons">date_range</i>
                    </span>
                    <div class="form-line">
                        <input type="text" class="form-control datepicker" name="dti"  id ="dti" value="@php echo(date('d/m/Y'));@endphp" placeholder="Data Final" style="background:transparent" >
                    </div>            
                </div>
            </div>
            <div class="col-sm-3" style="width:150px;" >
        
                <div class="input-group" style="width:120px">
                    <span class="input-group-addon">
                        <i class="material-icons">date_range</i>
                    </span>
                    <div class="form-line">
                        <input type="text" class="form-control datepicker" name="dtf"  id ="dtf" value="@php echo(date('d/m/Y'));@endphp" placeholder="Data Final" style="background:transparent" >
                    </div>            
                </div>
            </div>
        </div>
       
    </div>    
 <!-- Widgets -->
 <div class="row clearfix">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-green hover-expand-effect">
            <div class="icon">
                <i class="material-icons">attach_money</i>
            </div>
            <div class="content">
                <div class="text">VALOR</div>
                <div class="number count-to" data-from="0" data-to="125" data-speed="15" id="vlrtotal" data-fresh-interval="20">-</div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-cyan hover-expand-effect">
            <div class="icon">
                <i class="material-icons">supervisor_account</i>
            </div>
            <div class="content">
                <div class="text">COBERTURA</div>
                <div class="number count-to" data-from="0" data-to="257" data-speed="1000" id="clicob" data-fresh-interval="20">-</div>
                
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-purple hover-expand-effect">
            <div class="icon">
                <i class="material-icons">trending_up</i>
            </div>
            <div class="content">
                <div class="text">MARGEM</div>
                <div class="number count-to" data-from="0" data-to="257" data-speed="1000" id="margem" data-fresh-interval="20">-</div>
                
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-orange hover-expand-effect">
            <div class="icon">
                <i class="material-icons">next_week</i>
            </div>
            <div class="content">
                <div class="text">META</div>
                <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" id="meta"data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Widgets -->

 <!-- Tabela venda por departamento -->
 <div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    VENDAS POR DEPARTAMENTO
                </h2>
                <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);">Action</a></li>

                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Departamento</th>
                                <th>Meta[R$]</th>
                                <th>Cobertura</th>
                                <th>Vlr.Venda</th>
                                <th>Realizado</th>
                                <th>Lucro</th>
                            </tr>
                        </thead>
                       
                        <tbody id="tbody-departamentos" >
                        
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
<script>
$(function () {
   /* $('.js-basic-example').DataTable({
        responsive: true
    });*/
    

    $('.datepicker').bootstrapMaterialDatePicker({ 
    weekStart : 0, 
    time: false, 
    format:'DD/MM/YYYY',  
    cancelText: "Cancelar"  

 });

});

function recarregar(){

    document.getElementById('progresso').style.visibility = "visible";
    document.getElementById('btn-pesquisar').style.visibility = "hidden";

    var dti = document.getElementById('dti').value;
    var dtf = document.getElementById('dtf').value;
    $.ajax({
        url: '/vendas/api/resumodevendas',
        dataType: 'json',
        data: { dti: dti, dtf : dtf} ,  
        method:'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            console.log(response);

        document.getElementById('vlrtotal').innerHTML  = parseFloat( response['total'][0]['vlrvenda']).toLocaleString('pt-BR',{minimumFractionDigits: 2, maximumFractionDigits: 2});
        document.getElementById('clicob').innerHTML  =  parseInt(response['total'][0]['qtclipos']).toLocaleString('pt-br');
        document.getElementById('margem').innerHTML  = ((parseFloat(response['total'][0]['lucro']) / parseFloat( response['total'][0]['vlrvenda'])) *100).toLocaleString('pt-BR',{minimumFractionDigits: 2, maximumFractionDigits: 2})+"%";
        document.getElementById('meta').innerHTML  = parseFloat( response['total'][0]['meta']).toLocaleString('pt-BR',{minimumFractionDigits: 2, maximumFractionDigits: 2});
        
        var tbl_departamentos = document.getElementById("tbody-departamentos");
        tbl_departamentos.innerHTML = "";        
        $.each(response['departamentos'], function(index, item){
            var row = tbl_departamentos.insertRow(-1);

            var codepto = row.insertCell(0);
            var departamento = row.insertCell(1);
            var meta = row.insertCell(2);
            var cobertura = row.insertCell(3);
            var vlrvenda = row.insertCell(4);
            var realizado = row.insertCell(5);
            var perclucro = row.insertCell(6);
            
            codepto.innerHTML = item.codepto;
            departamento.innerHTML = item.descricao;
            meta.innerHTML = parseFloat(item.meta).toLocaleString('pt-BR',{minimumFractionDigits: 2, maximumFractionDigits: 2});
            cobertura.innerHTML = parseInt(item.qtclipos).toLocaleString('pt-BR',{minimumFractionDigits: 0, maximumFractionDigits: 0});
            vlrvenda.innerHTML =parseFloat(item.vlrvenda).toLocaleString('pt-BR',{minimumFractionDigits: 2, maximumFractionDigits: 2});
            var realizadoperc = ((parseFloat(item.vlrvenda)/parseFloat(item.meta))*100).toLocaleString('pt-BR',{minimumFractionDigits: 2, maximumFractionDigits: 2})+"%";
            var realpercEn = (parseFloat(item.vlrvenda)/parseFloat(item.meta))*100;
            realizado.innerHTML =  
                '<div class="progress"  style="height:15px">'+
                        '<div class="progress-bar bg-green" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: '+realpercEn+'%"><span style="font-size:11px; height:100%;text-align: center; color:black; vertical-align: top;  ">'+realizadoperc+'</span></div>'+
        
                '</div>'
            perclucro.innerHTML =  ((parseFloat(item.lucro)/  parseFloat(item.vlrvenda))*100).toLocaleString('pt-BR',{minimumFractionDigits: 2, maximumFractionDigits: 2})+"%";

        })
        

        document.getElementById('progresso').style.visibility = "hidden";
        document.getElementById('btn-pesquisar').style.visibility = "visible";
        }, 
        error:function(request, status, error) {
            console.log("ajax call went wrong:" + request.responseText);
        document.getElementById('progresso').style.visibility = "hidden";
        document.getElementById('btn-pesquisar').style.visibility = "visible";
        }
    });

    
}
</script>
<script src="{{ URL::asset('ambiente/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
<script src="{{ URL::asset('ambiente/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
<script src="{{ URL::asset('ambiente/plugins/jquery-steps/jquery.steps.js')}}"></script>

<!-- Moment Plugin Js -->
<script src="{{ URL::asset('ambiente/plugins/momentjs/moment.js')}}"></script>

<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="{{ URL::asset('ambiente/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>

<!--JS MASK INPUT-->
<script src="{{ URL::asset('ambiente/plugins/jquery-inputmask/jquery.inputmask.bundle.js')}}"></script>


@endpush

