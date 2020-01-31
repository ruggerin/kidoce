<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    @if(isset($title))
    <title>{{$title}}</title>
    @else
    <title>{{'Auslog-Promotor' }}</title>
    @endif
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

    <!-- Bootstrap Tagsinput Css -->
    <link href="{{ asset('ambiente/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('ambiente/plugins/node-waves/waves.css')}}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('ambiente/plugins/animate-css/animate.css')}}" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="{{ asset('ambiente/plugins/morrisjs/morris.css')}}" rel="stylesheet">

    <!-- Custom Css -->
    <link href="{{ asset('ambiente/css/style.css')}}" rel="stylesheet">


    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="{{ asset('ambiente/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}" rel="stylesheet" />

    <link href="{{ asset('ambiente/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet">
    <link href="{{ asset('ambiente/plugins/multi-select/css/multi-select.css')}}" rel="stylesheet">
    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{ asset('ambiente/css/themes/all-themes.css')}}" rel="stylesheet">

    <!-- Dropzone Css -->
    <link href="{{ asset('ambiente/plugins/dropzone/dropzone.css')}}" rel="stylesheet">

    <!--Sass especificos -->
    @stack('csss')

</head>
<!--<body class="theme-nailly">-->
<body class="theme-nailly">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Iniciando...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="Carregando pagina...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                
             <a class="navbar-brand" href="#">WebAdmin | Auslog DeliveryForce</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">

                    <!-- Notifications -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">notifications</i>
                            <span class="label-count">1</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">NOTIFICATIONS</li>
                            <li class="body">
                                <ul class="menu">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">person_add</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>Usuário inserido ao sistema</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> A menos de 7 dias.
                                                </p>
                                            </div>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                            <li class="footer">
                                <a href="javascript:void(0);">Ver todas as Notificações</a>
                            </li>
                        </ul>
                    </li>
                    <!-- #END# Notifications -->

                    <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
                <div class="image">
                    <img src="{{ route('fotoperfil') }}" width="48" height="48" />
                    {{--@if( Storage::exists('users/'.auth()->user()->id.'.jpg'))
                    <img src="{{ asset('storage/users/'.auth()->user()->id.'.jpg') }}" width="48" height="48" />
                    @else
                    <img src="{{ asset('ambiente/images/defaultuser.png') }}" width="48" height="48" />
                    @endif--}}
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{auth()->user()->nome}}</div>
                    <div class="email">{{auth()->user()->email}}</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Meu Perfil</a></li>
                            <li role="seperator" class="divider"></li>         
 
                            <li> <a class=" waves-effect waves-block" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Alternar Menu') }}
                            </a>></li>
                            <li> <a class="waves-effect waves-block" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Sair') }}
                            </a>></li>
                          
                        </ul>
                    </div>
                </div>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
            </form>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">DASHBOARD</li>
                    <li class="active">
                        <a href="{{route('home')}}">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                                      
                   
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">archive</i>
                            <span>Param</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{route('usuarios.index')}}">Usuários</a>
                            </li>
                            <li>
                                <a href="{{route('lojas.index')}}">Lojas</a>
                            </li>
                            <li>
                                <a href="#">Roteiro</a>
                            </li>
                            <li>
                                <a href="{{route('tipoprodutos.index')}}">Tipo de Produtos</a>
                            </li>
                            <li>
                                <a href="#">Produtos</a>
                            </li>
                            <li>
                                <a href="#">Fornecedores</a>
                            </li>
                            <li>
                                <a href="#">Pesquisa</a>
                            </li>
                            <li>
                                <a href="#">Perguntas</a>
                            </li>
                            <li>
                                <a href="{{route('tipoderegistros.index')}}">Tipo Registro</a>
                            </li>
                            
                        </ul>
                    </li>
                    
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">local_shipping</i>
                            <span>Entregas</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{route('entregas.dashboard')}}"><span>DASHBOARD</span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Manutenções</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="{{ route('montagemcarga')}}">Montagem de cargas</a>
                                    </li>
                                   
                                    <li>
                                    <a href="{{ route('carregamentos.index')}}">Manutenção Carregamentos</a>
                                    </li>
                                    <li>
                                        <a href="#">Informar Saida de Carga</a>
                                    </li>
                                    <li>
                                        <a href="#">Gestão de Pedidos</a>
                                    </li>
                                    <li>
                                        <a href="#">Fechamento de Cargas</a>
                                    </li>
                                    <li>
                                        <a href="#">Consultar Entregas</a>
                                    </li>
                                    <li>
                                        <a href="#">Registro de Ocorrência</a>
                                    </li>
                                </ul>    
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Relatórios</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="{{ route('rlt_carregamentos_index')}}">Resumo de Entregas</a>
                                    </li>
                                    <li>
                                        <a href="posicaogeografica/">Posição Geografica Entregadores</a>
                                    </li>
                                </ul>
                            </li>       
                            
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">monetization_on</i>
                            <span>Relatórios</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="#">Indicadores</a>
                            </li>
                            <li>
                                <a href="#">Registro Spc</a>
                            </li>
                            
                        </ul>
                    </li>
					<li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">pie_chart</i>
                            <span>Suporte</span>
                        </a>
                        <ul class="ml-menu">
                          
                            <li>
                                <a href="/testeview">Gestão de Chamados</a>
                            </li>
                          
                            
                        </ul>
                    </li>					
                </ul>
            </div>
            <!-- #Menu -->
                       <!-- Footer -->
                       <div class="legal">
                <div class="copyright">
                    &copy; 2019 <a href="javascript:void(0);">Auslog Desenvolvimentos</a>.
                </div>
                <div class="version"  onClick="window.open('https://www.linkedin.com/in/ruggeri-nascimento-001b8161','_blank');" style="cursor: pointer;" >
                    <b>Dev:</b><a>Ruggeri Barbosa</a>
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
      
    </section>

    <section class="content">
        <div class="container-fluid">
            @yield('content')
        </div>
    </section>

<!-- Jquery Core Js -->
<script src="{{ URL::asset('ambiente/plugins/jquery/jquery.min.js')}}"></script>

<!-- Bootstrap Core Js -->
<script src="{{ URL::asset('ambiente/plugins/bootstrap/js/bootstrap.js')}}"></script>

<!-- Select Plugin Js -->
<script src="{{ URL::asset('ambiente/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>

<!-- Slimscroll Plugin Js -->
<script src="{{ URL::asset('ambiente/plugins/jquery-slimscroll/jquery.slimscroll.js')}}"></script>

<!-- Waves Effect Plugin Js -->
<script src="{{ URL::asset('ambiente/plugins/node-waves/waves.js')}}"></script>

<!-- Custom Js -->
<script src="{{URL::asset('ambiente/js/admin.js')}}"></script>

<!-- Demo Js -->
<script src="{{ URL::asset('ambiente/js/demo.js')}}"></script>
<!-- Js Específicas -->
<!-- Moment Plugin Js -->
<script src="{{URL::asset('ambiente/plugins/momentjs/moment.js')}}"></script>


<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src={{URL::asset('ambiente/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}></script>

@stack('scripts')


</body>

</html>