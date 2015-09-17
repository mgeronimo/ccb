<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>@yield('title')</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.4 -->
        <link rel="stylesheet" href='{{ url("assets/bootstrap/css/bootstrap.min.css") }}'>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Ionicons 2.0.0 -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href='{{ url("assets/dist/css/AdminLTE.min.css") }}'>
        <!-- AdminLTE Skins -->
        <link rel="stylesheet" href='{{ url("assets/dist/css/skins/_all-skins.min.css") }}'>
        <!-- Custom Styles -->
        <link rel="stylesheet" href='{{ url("assets/css/custom.css") }}'>
        @yield('heads')
    </head>
    <body class="skin-blue fixed sidebar-mini">
        <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="/" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <!--<span class="logo-mini"><b>A</b>LT</span>-->
                <!--<img src="assets/img/logo/logo-small.png" class="img-responsive  logi-mini">-->
                <!-- logo for regular state and mobile devices -->
                <img src='{{ url("assets/img/logo/logo-white-with-icon-small.png") }}' class="img-responsive smlogo logi-lg">
            </a>

            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <!--<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>-->
                <!-- Header -->

                @include('template.dropdown-menu')

            </nav>
        </header>

        <!-- Side Menu -->
        @include('template.side-menu')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    @yield('page-title')
                    <small>@yield('page-desc')</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                    @yield('breadcrumb')
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                @yield('content')
            </section>
        </div>

        <!-- Footer -->
        @include('template.footer')

        <!-- jQuery 2.1.4 -->
        <script src='{{ url("assets/plugins/jQuery/jQuery-2.1.4.min.js") }}'></script>
        <!-- jQuery UI 1.11.4 -->
        <script src='{{url("assets/jquery/dist/jquery.min.js")}}'></script>
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
          $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.4 -->
        <script src='{{ url("assets/bootstrap/js/bootstrap.min.js") }}'></script>
        <!-- Sparkline -->
        <script src='{{ url("assets/plugins/sparkline/jquery.sparkline.min.js") }}'></script>
        <!-- AdminLTE App -->
        <script src='{{ url("assets/dist/js/app.min.js") }}'></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src='{{ url("assets/dist/js/pages/dashboard.js") }}'></script>
        <!-- AdminLTE for demo purposes -->
        <script src='{{ url("assets/dist/js/demo.js") }}'></script>
        <!-- Bootbox -->
                <script src='{{url("assets/js/jquery.easing-82496a9/jquery.easing.1.3.js")}}'></script>

        <script src='{{ url("assets/js/bootbox.min.js") }}'></script>
        <!-- Custom JS -->
        <script src='{{ url("assets/js/scripts.js") }}'></script>
        @yield('scripts')
    </body>
</html>