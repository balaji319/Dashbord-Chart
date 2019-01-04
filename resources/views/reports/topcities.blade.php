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
      <div class="x_panel" style="height: 100vh;">
        <div class="x_title">
          <h2>Top Cities </h2>
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
                    <center> <span id="selectedMonth"></span>PUFC Top 25 Cities Report Graph <span id="selectDate"></span> </center>
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
        </div>
      </div>
    </div>
  </div>
  </div>
  @include('comman.plugins')
  <script src="{!! asset('js/custom/custom_city.js') !!}"></script>
@endsection