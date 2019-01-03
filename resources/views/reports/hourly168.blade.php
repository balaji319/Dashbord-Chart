@extends('theme.default')
@section('title', 'Call-Q Reporting Service')
@section('content')
<div class="row">
  {{--
  <h1 class="page-header">Home</h1> --}}
</div>
<?php
date_default_timezone_set('America/Los_Angeles');
$unixTime = time();
$var_date = date("D - M. d Y", $unixTime);  ?>
  <!-- /.row -->
  <div class="row" id="executivecallsummary">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel" style="min-height: 100vh;">
        <div class="x_title">
          <h2>Minute Wise Report <small></small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Settings 1</a>
                </li>
                <li><a href="#">Settings 2</a>
                </li>
              </ul>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <div class="container">
            <div class="row">

              <div class='col-sm-4'>
                From :
                <div class="form-group">
                  <div class='input-group date' id='myDatepicker'>
                    <input type='text' class="form-control" id="datepickerVal" />
                    <span class="input-group-addon">
                                                   <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                  </div>
                </div>
              </div>

              <div class='col-sm-4'>
                <div class="form-group" style="margin-top: 3.5%;">
                  <div class='input-group'>
                    <button type="submit" id="submitBtn" class="btn btn-success">Update Graph</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div id="loadingadvert" class="loading">
              <img class="loading-image" src="{!! asset('images/ajax-loader.gif') !!}" alt="Loading..." />
            </div>
            <!--  <canvas id=""  height="100px"></canvas> -->
            <div id="lineChart" style="height:450px;     position: inherit !important;;
"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('comman.plugins')
  <script src="{!! asset('js/custom/custom_houlrly168.js') !!}"></script>
@endsection