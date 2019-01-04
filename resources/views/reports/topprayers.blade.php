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
  <div class="row" id="Countriessummary">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel" style="min-height: 100vh;">
        <div class="x_title">
          <h2>Top Prayers <small> </small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
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
                From ::
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
                To :
                <div class="form-group">
                  <div class='input-group date' id='myDatepicker2'>
                    <input type='text' class="form-control" id="datepickerVal1" />
                    <span class="input-group-addon">
                                                       <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                  </div>
                </div>
              </div>
              <div class='col-sm-4'>
                <div class="form-group" style="margin-top: 3.5%;">
                  <div class='input-group'>
                    <button type="submit" id="submitBtn" class="btn btn-success">Submit</button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="table-responsive">
            <table class="table table-striped jambo_table bulk_action" id="today_records_table">
              <thead>
                <tr class="headings">
                  <th class="column-title" colspan="9">
                    <center> <span id="selectedMonth"></span>PUFC Top 25 Prayers Report Graph </center>
                  </th>
                </tr>
              </thead>
            </table>

          </div>
          <div class="col-sm-12">
            <div class="loading" id="loadingbar">
              <img class="loading-image" src="{!! asset('images/ajax-loader.gif') !!}" alt="Loading..." />
            </div>

            <canvas id="CountriesbarChart" height="100px"></canvas>
          </div>
          <div class="col-sm-12">
            <div class="loading" id="loadingbar1">
              <img class="loading-image" src="{!! asset('images/ajax-loader.gif') !!}" alt="Loading..." />
            </div>

            <canvas id="CountriesbarChart1" height="100px"></canvas>
          </div>
        </div>
      </div>
    </div>

  </div>
  </div>
  @include('comman.plugins')
  <script src="{!! asset('js/custom/custom_pay.js') !!}"></script>

  <style>
    .active_tab {
      color: #00afaa !important;
    }

    .loading {
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      display: block;
      opacity: 0.7;
      background-color: #fff;
      z-index: 99;
      text-align: center;
    }

    .loading-image {
      position: absolute;
      top: 40%;
      z-index: 100;
    }
  </style>
@endsection