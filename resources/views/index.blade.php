 <!DOCTYPE html>
 <html lang="es">

 <head>

     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>AdminLTE 3 | Dashboard</title>

     <!-- Google Font: Source Sans Pro -->
     <link rel="stylesheet"
         href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
     <!-- Font Awesome -->
     <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
     <!-- Ionicons -->
     <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
     <!-- Tempusdominus Bootstrap 4 -->
     <link rel="stylesheet"
         href="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
     <!-- iCheck -->
     <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
     <!-- JQVMap -->
     <link rel="stylesheet" href="{{ asset('adminlte/plugins/jqvmap/jqvmap.min.css') }}">
     <!-- Theme style -->
     <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
     <!-- overlayScrollbars -->
     <link rel="stylesheet" href="{{ asset('adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
     <!-- Daterange picker -->
     <link rel="stylesheet" href="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.css') }}">
     <!-- summernote -->
     <link rel="stylesheet" href="{{ asset('adminlte/plugins/summernote/summernote-bs4.min.css') }}">


     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <meta name="description" content="Sistema Terminal">
     <meta name="author" content="">
     <meta name="keyword" content="Sistema Terminal, Sistema Terminal">
     {{-- <link rel="shortcut icon" href="img/auto.jpg"> --}}
     <meta name="userId" content="{{ Auth::check() ? Auth::user()->id : '' }}">
     {{-- <title>Sistema Terminal</title> --}}
     <meta name="csrf-token" content="{{ csrf_token() }}">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js">
     <!-- Icons -->
     <link href="css/plantilla.css" rel="stylesheet">
 </head>
 {{-- <body class="hold-transition sidebar-mini layout-fixed"> --}}

 <body class="app header-fixed sidebar-fixed  sidebar-mini">
     <div id="app">
         <header class="app-header navbar">
             <div class="preloader flex-column justify-content-center align-items-center">
                 <img class="animation__shake" src="{{ asset('adminlte/dist/img/asd.svg') }}" alt="BolivarLogo"
                     height="200" width="200">
             </div>

             <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
                 <span class="navbar-toggler-icon"></span>
             </button>
             <a href="index3.html" class="brand-link">
                 <img src="{{ asset('adminlte/dist/img/auto.jpg') }}" alt="AdminLTE Logo"
                     class="brand-image img-circle elevation-3" style="opacity: .8">
                 <span class="brand-text font-weight-light">Bolivar</span>
             </a>

             <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
                 <span class="navbar-toggler-icon"></span>
             </button>


             <ul class="nav navbar-nav d-md-down-none">
                 <li class="nav-item px-3">
                     <a class="nav-link" href="#">Dashboard</a>
                 </li>
             </ul>


             <ul class="nav navbar-nav ml-auto">
                 <notification :notifications="notifications"></notification>
                 <li class="nav-item dropdown user-menu">
                     <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                         <img src="{{ asset('adminlte/dist/img/user1-128x128.jpg') }}"
                             class="user-image img-circle elevation-2" alt="User Image">
                         <span class="d-md-down-none">{{ Auth::user()->usuario }}</span>
                     </a>
                     <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                         <!-- User image -->
                         <li class="user-header bg-primary">
                             <img src="{{ asset('adminlte/dist/img/user1-128x128.jpg') }}"
                                 class="img-circle elevation-2" alt="User Image">

                             <p>
                                 <b> <span class="d-md-down-none d-md-inline">{{ Auth::user()->usuario }}</span></b>
                             </p>
                         </li>
                         <!-- Menu Footer-->
                         <li class="user-footer">
                             <a href="#" class="btn btn-info btn-flat">Profile</a>
                             <a class="btn btn-danger btn-flat float-right" href="{{ route('logout') }}"
                                 onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                 Cerrar sesión</a>

                             <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                 style="display: none;">
                                 {{ csrf_field() }}
                             </form>
                         </li>
                     </ul>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                         <i class="fas fa-expand-arrows-alt"></i>
                     </a>
                 </li>

             </ul>
         </header>
         <section class="content">

             @yield('content')
         </section>


         <div class="app-body">

             @if (Auth::check())
                 @if (Auth::user()->idrol == 1)
                     @include('plantilla.sidebaradministrador')
                 @elseif (Auth::user()->idrol == 2)
                     @include('plantilla.sidebarvendedor')

                 @else

                 @endif

             @endif
             <!-- Contenido Principal -->
             @yield('contenido')
             <!-- /Fin del contenido principal -->
         </div>
     </div>
     <footer class="app-footer">
         <span><a target="_blank"></a> &copy; 2020</span>
         <span class="ml-auto">Hecho Por Alvaro</span>
     </footer>


     <script src="js/app.js"></script>
     <script src="js/plantilla.js"></script>

     <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
     <!-- jQuery UI 1.11.4 -->
     <script src="{{ asset('adminlte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
     <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
     <script>
         $.widget.bridge('uibutton', $.ui.button)
     </script>
     <!-- Bootstrap 4 -->
     <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
     <!-- ChartJS -->
     <script src="{{ asset('adminlte/plugins/chart.js/Chart.min.js') }}"></script>
     <!-- Sparkline -->
     <script src="{{ asset('adminlte/plugins/sparklines/sparkline.js') }}"></script>
     <!-- JQVMap -->
     <script src="{{ asset('adminlte/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
     <script src="{{ asset('adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
     <!-- jQuery Knob Chart -->
     <script src="{{ asset('adminlte/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
     <!-- daterangepicker -->
     <script src="{{ asset('adminlte/plugins/moment/moment.min.js') }}"></script>
     <script src="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>
     <!-- Tempusdominus Bootstrap 4 -->
     <script src="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
     <!-- Summernote -->
     <script src="{{ asset('adminlte/plugins/summernote/summernote-bs4.min.js') }}"></script>
     <!-- overlayScrollbars -->
     <script src="{{ asset('adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
     <!-- AdminLTE App -->
     <script src="{{ asset('adminlte/dist/js/adminlte.js') }}"></script>
     <!-- AdminLTE for demo purposes -->
     <script src="{{ asset('adminlte/dist/js/demo.js') }}"></script>
     <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
     <script src="{{ asset('adminlet/dist/js/pages/dashboard.js') }}"></script>
 </body>

 </html>
