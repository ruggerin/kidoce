<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Orbiter is a bootstrap minimal & clean admin template">
    <meta name="keywords" content="admin, admin panel, admin template, admin dashboard, responsive, bootstrap 4, ui kits, ecommerce, web app, crm, cms, html, sass support, scss">
    <meta name="author" content="Themesbox">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Orbiter - Login</title>
    <!-- Fevicon -->
    <link rel="shortcut icon" href="{{ asset('orbiter/images/favicon.ico') }}">
    <!-- Start CSS -->
    <link href="{{ asset('orbiter/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('orbiter/css/icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('orbiter/css/flag-icon.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('orbiter/css/style.css') }}" rel="stylesheet" type="text/css">

    <!-- Waves Effect Css -->
    <link href="{{  asset('/ambiente/plugins/node-waves/waves.css') }}" rel="stylesheet">

    <!-- End CSS -->
</head>
<body class="vertical-layout">
   
    <!-- Start Containerbar -->
    <div id="containerbar" class="containerbar authenticate-bg">
        <!-- Start Container -->
        <div class="container">
            <div class="auth-box login-box">
                <!-- Start row -->
                <div class="row no-gutters align-items-center justify-content-center">
                    <!-- Start col -->
                    <div class="col-md-6 col-lg-5">
                        <!-- Start Auth Box -->
                        <div class="auth-box-right">
                            <div class="card">
                                <div class="card-body">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-head">
                                            <a href="{{url('/')}}" class="logo"><img src="{{ asset('orbiter/images/logo.svg')}}" class="img-fluid" alt="logo"></a>
                                        </div>                                        
                                        <h4 class="text-primary my-4">Administração</h4>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="email" placeholder="E-mail" required autofocus>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="password" placeholder="Senha" required>
                                        </div>
                                        <div class="form-row mb-3">
                                         
                                            <div class="col-sm-6">
                                                 {{--  
                                                <div class="custom-control custom-checkbox text-left">
                                                  <input type="checkbox" class="custom-control-input" id="rememberme">
                                                  <label class="custom-control-label font-14" for="rememberme">Lembrar dos dados</label>
                                                </div>  
                                                 --}}                                 
                                            </div>
                                            
                                            <div class="col-sm-6">
                                              <div class="forgot-psw"> 
                                                <a id="forgot-psw" href="{{url('/user-forgotpsw')}}" class="font-14">Esqueceu sua senha?</a>
                                              </div>
                                            </div>
                                        </div>
                                                              
                                      <button type="submit" class="btn btn-success btn-lg btn-block font-18">Entrar</button>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- End Auth Box -->
                    </div>
                    <!-- End col -->
                </div>
                <!-- End row -->
            </div>
        </div>
        <!-- End Container -->
    </div>
    <!-- End Containerbar -->
    <!-- Start JS -->        
    <script src="{{ asset('orbiter/js/jquery.min.js') }}"></script>
    <script src="{{ asset('orbiter/js/popper.min.js') }}"></script>
    <script src="{{ asset('orbiter/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('orbiter/js/modernizr.min.js') }}"></script>
    <script src="{{ asset('orbiter/js/detect.js') }}"></script>
    <script src="{{ asset('orbiter/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('orbiter/js/custom/custom-toasts.js') }}"></script>
    <script src="{{ URL::asset('ambiente/plugins/bootstrap-notify/bootstrap-notify.js')}}"></script>

    <script>
        $(function () {
            $('.jsdemo-notification-button button').on('click', function () {
                var placementFrom = $(this).data('placement-from');
                var placementAlign = $(this).data('placement-align');
                var animateEnter = $(this).data('animate-enter');
                var animateExit = $(this).data('animate-exit');
                var colorName = $(this).data('color-name');
        
                showNotification(colorName, null, placementFrom, placementAlign, animateEnter, animateExit);
            }); 
            @if ($errors->has('email'))
                showNotification('alert-danger','Usuário ou senha incorretas','bottom','right','','');                        
            @endif
            
        });
  
        function showNotification(colorName, text, placementFrom, placementAlign, animateEnter, animateExit) {
            if (colorName === null || colorName === '') { colorName = 'bg-black'; }
            if (text === null || text === '') { text = 'Turning standard Bootstrap alerts'; }
            if (animateEnter === null || animateEnter === '') { animateEnter = 'animated fadeInDown'; }
            if (animateExit === null || animateExit === '') { animateExit = 'animated fadeOutUp'; }
            var allowDismiss = true;
        
            $.notify({
                message: text
            },
                {
                    type: colorName,
                    allow_dismiss: allowDismiss,
                    newest_on_top: true,
                    timer: 2000,
                    placement: {
                        from: placementFrom,
                        align: placementAlign
                    },
                    animate: {
                        enter: animateEnter,
                        exit: animateExit
                    },
                    template: '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible {0} ' + (allowDismiss ? "p-r-35" : "") + '" role="alert">' +
                        '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">x</button>' +
                        '<span data-notify="icon"></span> ' +
                        '<span data-notify="title">{1}</span> ' +
                        '<span data-notify="message">{2}</span>' +
                        '<div class="progress" data-notify="progressbar">' +
                        '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                        '</div>' +
                        '<a href="{3}" target="{4}" data-notify="url"></a>' +
                    '</div>'
            });
        }
  
    </script>        
    <!-- End js -->

   

  
</body>
</html>