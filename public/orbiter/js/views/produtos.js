$(document).ready(function() {
    $('#precocusto').inputmask('decimal', {
        'alias': 'numeric',
        
        'autoGroup': true,
        'digits': 3,
        'radixPoint': ",",
        'digitsOptional': false,
        'allowMinus': false,
        /*'prefix': 'R$ ',*/
        'placeholder': ''
    });
   
});

$(function() {
  
    $('#formModal').submit(function(){     
        alert('teste');
        return null;
        
        var dados = jQuery( this ).serialize();
        //collapse
        /*document.getElementById('btnsubmit').disabled =true;
        document.getElementById('animacaobotao').style.display = 'inline-block';*/
        dados+='&numprojeto='+numprojeto;
        //console.log(dados);
        jQuery.ajax({
            type: "POST",
            url: 'tarefas/update',      
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: dados,
            success: function( data )
            {
                console.log(data) ; 
                recarregarTasks();                   
               
            }
        });
        $("#modalTask").modal('hide');
        return false;
    });

});




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
                console.log(data);
                document.getElementById("produtoid").value=data.produto.produtoid;
                document.getElementById("produto").value=data.produto.produto;
                document.getElementById("pontoconvreceita").value=data.produto.pontoconvreceita;
                document.getElementById("precocusto").value=data.produto.precocusto;
                document.getElementById("qtest").value=data.produto.qtest;
                document.getElementById("categoria_id").value = data.produto.categoria_id;
                document.getElementById("unidmedestid").value = data.produto.unidmedestid;

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

