<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Bootstrap -->
    <link href="{!! asset('vendors/bootstrap/dist/css/bootstrap.min.css') !!}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{!! asset('vendors/font-awesome/css/font-awesome.min.css') !!}" rel="stylesheet">
    <!-- NProgress -->
     <link href="{!! asset('vendors/nprogress/nprogress.css') !!}" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
     <link href="{!! asset('vendors/bootstrap-daterangepicker/daterangepicker.css') !!}" rel="stylesheet">
     <!-- bootstrap-datetimepicker -->
      <link href="{!! asset('vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css') !!}" rel="stylesheet">
    <!-- Custom Theme Style -->
  
   <!-- Datatables -->

   <link href="{!! asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') !!}" rel="stylesheet">
   <!-- NProgress -->
    <link href="{!! asset('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') !!}" rel="stylesheet">
   <!-- bootstrap-daterangepicker -->
    <link href="{!! asset('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') !!}" rel="stylesheet">
    <!-- bootstrap-datetimepicker -->
    <link href="{!! asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') !!}" rel="stylesheet">
    <!-- bootstrap-datetimepicker -->
    <link href="{!! asset('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') !!}" rel="stylesheet">
 
   


    <link href="{!! asset('build/css/custom.min.css') !!}" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">

                    @include('theme.header')

                    @include('theme.sidebar')

        <!-- page content -->
        <div class="right_col" role="main">
             @yield('content')
             <div id="app">
  <router-view></router-view>
 </div>
        </div>
        <!-- page content -->

        <!-- footer content -->
        @include('theme.footer')
      </div>
    </div>

    <!-- jQuery -->
    <script src="{!! asset('vendors/jquery/dist/jquery.min.js') !!}"></script>
    <!-- Bootstrap -->
        <script src="{!! asset('vendors/bootstrap/dist/js/bootstrap.min.js') !!}"></script>
    <!-- FastClick -->
    <script src="{!! asset('vendors/fastclick/lib/fastclick.js') !!}"></script>
    <!-- NProgress -->
    <script src="{!! asset('vendors/nprogress/nprogress.js') !!}"></script>


      <!-- bootstrap-daterangepicker -->
  <script src="{!! asset('vendors/moment/min/moment.min.js') !!}"></script>

  <!-- bootstrap-datetimepicker -->
  <script src="{!! asset('vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') !!}"></script>
  <script src="{!! asset('vendors/datatables.net/js/jquery.dataTables.min.js') !!}"></script>
    <script src="{!! asset('vendors/datatables.net-buttons/js/buttons.print.min.js') !!}"></script>
    <script src="{!! asset('vendors/datatables.net-buttons/js/dataTables.buttons.min.js') !!}"></script>
  
    <script src="{!! asset('vendors/datatables.net-buttons/js/buttons.flash.min.js') !!}"></script>
    <script src="{!! asset('vendors/datatables.net-buttons/js/buttons.html5.min.js') !!}"></script>
    <script src="{!! asset('vendors/datatables.net-buttons/js/buttons.print.min.js') !!}"></script>
    <script src="{!! asset('vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') !!}"></script>
  
    <script src="{!! asset('vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') !!}"></script>
    <script src="{!! asset('vendors/datatables.net-responsive/js/dataTables.responsive.min.js') !!}"></script>
    <script src="{!! asset('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') !!}"></script>
    <script src="{!! asset('vendors/datatables.net-scroller/js/dataTables.scroller.min.js') !!}"></script>
  
    <!-- Chart.js -->
    <script src="{!! asset('vendors/Chart.js/dist/Chart.min.js') !!}"></script>

    <!-- Custom Theme Scripts -->
     <script src="{!! asset('build/js/custom.js') !!}"></script>
     <script src="/js/app.js"></script>
  </body>
</html>



