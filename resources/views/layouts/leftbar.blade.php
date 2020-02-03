<div class="leftbar">
    <!-- Start Sidebar -->
    <div class="sidebar">
        <!-- Start Logobar -->
        <div class="logobar">
            <a href="{{url('/')}}" class="logo logo-large"><img src="{{ asset('orbiter/images/logo.svg')}}" class="img-fluid" alt="logo"></a>
            <a href="{{url('/')}}" class="logo logo-small"><img src="{{ asset('orbiter/images/small_logo.svg')}}" class="img-fluid" alt="logo"></a>
        </div>
        <!-- End Logobar -->
        <!-- Start Navigationbar -->
        <div class="navigationbar">
            <ul class="vertical-menu">
                <li>
                    <a href="javaScript:void();" class="active">
                      <img src="{{ asset('orbiter/images/svg-icon/horizontal.svg')}}" class="img-fluid" alt="dashboard"><span>Dashboard</span>
                    </a>                   
                </li>
                <li>
                    <a href="javaScript:void();">
                        <img src="{{ asset('orbiter/images/svg-icon/horizontal.svg')}}" class="img-fluid" alt="layouts"><span>Cadastros</span><i class="feather icon-chevron-right pull-right"></i>
                    </a>
                    <ul class="vertical-submenu">
                        <li>
                            <a href="{{route('usuarios.index')}}">Usuários</a>
                        </li>
                        <li>
                            <a href="{{route('lojas.index')}}">Clientes</a>
                        </li>
                        {{--
                            <li>
                                <a href="#">Roteiro</a>
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
                        --}}
                        <li>
                            <a href="{{route('tipoprodutos.index')}}">Tipo de Produtos</a>
                        </li>
                        <li>
                            <a href="#">Produtos</a>
                        </li>

                        <li>
                            <a href="{{route('tipoderegistros.index')}}">Tipo Registro</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javaScript:void();">
                        <img src="{{ asset('orbiter/images/svg-icon/horizontal.svg')}}" class="img-fluid" alt="layouts"><span>Entregas</span><i class="feather icon-chevron-right pull-right"></i>
                    </a>
                    <ul class="vertical-submenu">
                        <li>
                            <a href="{{route('entregas.dashboard')}}"><span>DASHBOARD</span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="menu-toggle">
                                <span>Manutenções</span><i class="feather icon-chevron-right pull-right"></i>
                            </a>
                            <ul class="vertical-submenu">
                                <li>
                                    <a href="{{ route('montagemcarga')}}">Montagem de cargas</a>
                                </li>
                               
                                <li>
                                    <a href="{{ route('carregamentos.index')}}">Manutenção Carregamentos</a>
                                </li>
                                <li>
                                    <a href="{{ route('carregamentos.index')}}">Informar Saida de Carga</a>
                                </li>
                                <li>
                                    <a href="{{ route('carregamentos.index')}}">Gestão de Pedidos</a>
                                </li>
                                <li>
                                    <a href="{{ route('carregamentos.index')}}">Fechamento de Cargas</a>
                                </li>
                                <li>
                                    <a href="{{ route('carregamentos.index')}}">Consultar Entregas</a>
                                </li>
                                <li>
                                    <a href="{{ route('carregamentos.index')}}">Registro de Ocorrência</a>
                                </li>
                            </ul>    
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="menu-toggle">
                                <span>Relatórios</span><i class="feather icon-chevron-right pull-right"></i>
                            </a>
                            <ul class="vertical-submenu  ">
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
                    <a href="javaScript:void();">
                        <img src="{{ asset('orbiter/images/svg-icon/horizontal.svg')}}" class="img-fluid" alt="layouts"><span>Pedidos</span><i class="feather icon-chevron-right pull-right"></i>
                    </a>
                    <ul class="vertical-submenu">
                        <li>
                            <a href="{{route('usuarios.index')}}">Lançar Pedido</a>
                        </li>
                    </ul>
                    <a href="javaScript:void();">
                        <img src="{{ asset('orbiter/images/svg-icon/horizontal.svg')}}" class="img-fluid" alt="layouts"><span>Pedidos</span><i class="feather icon-chevron-right pull-right"></i>
                    </a>
                    <ul class="vertical-submenu">
                        <li>
                            <a href="{{route('usuarios.index')}}">Lançar Pedido</a>
                        </li>
                    </ul>
                </li>


            </ul>
        </div>
        <!-- End Navigationbar -->
    </div>
    <!-- End Sidebar -->
</div>