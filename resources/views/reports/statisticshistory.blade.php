@extends('theme.default')
@section('title', 'Call-Q Reporting Service')
@section('content')
<?php
date_default_timezone_set('America/Los_Angeles');
$unixTime = time();
$var_date = date("D - M. d Y", $unixTime);  ?>
  <div class="">
    {{--
    <div class="page-title">
      <div class="title_left">

      </div>
    </div> --}}
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel" style="min-height: 100vh;">
          <div class="x_title">
            <h2>Statistical Report <small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>

              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            {{--
            <div id="loadingadvert" class="loading">
              <img class="loading-image" src="{!! asset('images/ajax-loader.gif') !!}" alt="Loading..." />
            </div> --}} {{-- <canvas id="lineChart"></canvas> --}}
            <div class="loading" id="loadingbar">
              <img class="loading-image" src="{!! asset('images/ajax-loader.gif') !!}" alt="Loading..." />
            </div>
            <div id="echart_line1" style="height:450px;"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="clearfix"></div>
      <div class="clearfix"></div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="{!! asset('vendors/jquery/dist/jquery.min.js') !!}"></script>
  <script src="{!! asset('js/custom/custom_stat.js') !!}"></script>
@endsection