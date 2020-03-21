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

