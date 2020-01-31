<!DOCTYPE html>
<html>
    <head>

    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Favicon-->
        <link rel="apple-touch-icon" sizes="57x57" href="{{ URL::asset('favicon/apple-icon-57x57.png')}}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ URL::asset('favicon/apple-icon-60x60.png')}}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ URL::asset('favicon/apple-icon-72x72.png')}}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ URL::asset('favicon/apple-icon-76x76.png')}}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ URL::asset('favicon/apple-icon-114x114.png')}}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ URL::asset('favicon/apple-icon-120x120.png')}}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ URL::asset('favicon/apple-icon-144x144.png')}}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ URL::asset('favicon/apple-icon-152x152.png')}}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ URL::asset('favicon/apple-icon-180x180.png')}}">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{ URL::asset('favicon/android-icon-192x192.png')}}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ URL::asset('favicon/favicon-32x32.png')}}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ URL::asset('favicon/favicon-96x96.png')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('favicon/favicon-16x16.png')}}">
        <link rel="manifest" href="{{ URL::asset('favicon/manifest.json')}}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{ URL::asset('favicon/ms-icon-144x144.png')}}">
        <meta name="theme-color" content="#ffffff">
        <!-- <link rel="manifest" href="/site.webmanifest"> -->
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

        <!-- Bootstrap Core Css -->
        <link href="{{ asset('ambiente/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">
        
        <!-- Custom Css -->
        <link href="{{ asset('ambiente/css/style.css')}}" rel="stylesheet">
    </head>
    <style>
        .box {
            border:1px  solid;  border-radius: 5px; border-color:lightgrey
        }
        @media print{@page {size: landscape}}
    </style>    
    
    <body style="background-color: white;">
  
        <div class="container-fluid">
            <div class="row clearfix">               
                <div class="col-sm-12">                    
                    <h2><img  style="margin-top:-3px; margin-right:10px" src="{{ asset('ambiente/images/logo.png')}}" width="100"/>Relatório de Entregas Analítico</h2>    
                </div>    
            </div>
        
            <div class="row clearfix"  >               
                <div class="col-sm-2 box"  >
                    <label class="form-label">Carregamento</label>
                    <p>{{$carregamento[0]->numcarreg}}</p>    
                </div> 
                
                <div class="col-sm-3 box"  >
                    <label class="form-label">Destino</label>
                    <p> {{$carregamento[0]->destino}}</p>    
                </div> 
                
                <div class="col-sm-4 box"  >
                    <label class="form-label">Observações</label>
                    <p> {{$carregamento[0]->observacao}}</p>    
                </div> 
                
                <div class="col-sm-3 box"  >
                    <label class="form-label">Entregador</label>
                    <p> {{$carregamento[0]->codmotorista.' '.$carregamento[0]->motorista}} </p>    
                </div> 
                
                <div class="col-sm-2 box"  >
                    <label class="frm-label">Valor Carga</label>
                    <p> {{'R$'.$carregamento[0]->valorcarga}} </p>    
                </div> 
                <div class="col-sm-2 box"  >
                    <label class="form-label">Qtd Entregas</label>
                    <p> {{$carregamento[0]->qtentregas}} </p>     
                </div> 
                <div class="col-sm-2 box"  >
                    <label class="form-label">Km. Inicial</label>
                    <p> {{$carregamento[0]->kminicial}} </p>  
                </div> 
                <div class="col-sm-2 box"  >
                    <label class="form-label">Km. Final</label>
                    <p> {{$carregamento[0]->kmfinal}} </p>       
                </div> 
                <div class="col-sm-2 box"  >
                    <label class="form-label">Km. Percorrida</label>
                    <p> {{$carregamento[0]->kmtotal}} </p>    
                </div> 
                <div class="col-sm-2 box"  >
                    <label class="form-label">Taxa Entrega</label>
                    <p> 0.00 </p>    
                </div> 
                
            </div>
            <div class="row clearfix" style="margin-top:15px">
                <div class="col-sm-12">
                    <table class="table">
                        <thead>
                            <th>Seq</th>
                            <th>O.E.</th>
                            <th>N.Ped/NF</th>
                            <th>Cód. Cli</th>
                            <th>Razão Social</th>
                            <th>Valor</th>
                            <th>Checkin</th>
                            <th>Checkout</th> 
                            <th>Taxa</th> 
                        <thead>
                        <tbody>
                            @foreach($entregas as $entrega)
                            <tr>
                                <td>{{$entrega->seqent}}</td>
                                <td>{{$entrega->numped}}</td>
                                <td>{{$entrega->numnota}}</td>
                                <td>{{$entrega->codcliintegrador}}</td>
                                <td>{{$entrega->razaosocial}}</td>
                                <td>{{$entrega->valor}}</td>
                                <td>{{$entrega->chegada_datahora}}</td>
                                <td>{{$entrega->saida_datahora}}</td>
                                <td>{{$entrega->vlrfrete}}</td>
                            </tr>    
                            @endforeach
                        </tbody>            
                    </table>        
                </div>
            </div> 
            <div class="row clearfix" style="margin-top:15px">
                <div class="col-sm-12">
                        
                </div>
            </div>   
            
        </div>            
    </body>
    <script>
        window.print();
        </script>

</html>  
