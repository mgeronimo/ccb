<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>@yield('title')</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.4 -->
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Ionicons 2.0.0 -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
         <link rel="stylesheet" href="assets/css/styleadmin.css">
        <!-- AdminLTE Skins -->
        <link rel="stylesheet" href="assets/dist/css/skins/_all-skins.min.css">
        @yield('heads')
    </head>
    <body class="skin-blue sidebar-mini">
        <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="index2.html" class="logo">
                <center>
                <img src="assets/img/logo/logo.png" class="img-responsive smlogo" width="50px" height="50px">
            </center>
                <!--
                <!-- mini logo for sidebar mini 50x50 pixels
                <span class="logo-mini"><b>A</b>LT</span>
                <!-- logo for regular state and mobile devices
                <span class="logo-lg"><b>Admin</b>LTE</span> -->
            </a>

            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Header -->

                @include('template.dropdown-menu')

            </nav>
        </header>

        <!-- Side Menu -->
        @include('template.side-menu')
        

        <!-- Content -->
        @yield('content')

        <!-- Footer -->
        @include('template.footer')

        <!-- jQuery 2.1.4 -->
       <!-- <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        
            <script src="assets/js/jquery-1.11.1.min.js"></script>
       <!--  <script src="assets/bower_components/jquery-validation-1.14.0/dist/jquery.validate.min.js"></script>-->
        <script src="assets/jquery/dist/jquery.min.js"></script>

      

        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
      <!--  <script>
          $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.4 -->
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <!-- Sparkline -->
        
        <!-- AdminLTE for demo purposes -->
        <script src="assets/dist/js/demo.js"></script>
        <script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="assets/bower_components/jquery.steps/build/jquery.steps.min.js"></script>
        <script src="assets/js/jquery.easing-82496a9/jquery.easing.1.3.js"></script>
         <script src="assets/jquery-validation-1.14.0/dist/jquery.validate.js"></script>

        <script src="assets/plugins/sparkline/jquery.sparkline.min.js"></script>
        <!-- AdminLTE App -->
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="assets/dist/js/pages/dashboard.js"></script>
           <script src="assets/dist/js/app.min.js"></script>
        <!--    <script src="assets/js/formadd.js"></script>       --> 
        @yield('scripts')

    </body>
</html>