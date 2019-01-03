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
  <div class="row" id="networkcallsummary">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel" style="">
        <div class="x_title">
          <h2>Gender Breakdown Reports <small> </small></h2>
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
              <div class='col-sm-3'>
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
              <div class='col-sm-3'>
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
              <div class='col-sm-3'>

                Campaign :
                <div class="form-group">
                  <div class='input-group date' id='myDatepicker'>
                    <select class="form-control" id='gtCampaign2'>
                     </select>
                  </div>
                </div>

              </div>
              <div class='col-sm-3'>
                Filter :
                <div class="form-group">
                  <div class='input-group date'>
                    <button type="submit" id="submitBtn" class="btn btn-success">Filter</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="x_panel" style="min-height: 100vh;">
        <div class="x_title">

          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>

            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>

        <div class="x_content">
          <div class="table-responsive">
            <table class="table table-striped jambo_table bulk_action" id="today_records_table">
              <thead>
                <tr class="headings">
                  <th class="column-title" colspan="9">
                    <center> <span id="selectedMonth"></span> Gender Report </center>
                  </th>
                </tr>
              </thead>
            </table>
          </div>
        </div>

        <div class="x_content">
          <div class="row">
            <div class="col-sm-12">
              <div class="card-box table-responsive">
                <p class="text-muted font-13 m-b-30">

                </p>

                <div id="echart_line1" style="height:450px;"></div>
              </div>
              <div class="loading" id="loadingbar">
                <img class="loading-image" src="{!! asset('images/ajax-loader.gif') !!}" alt="Loading..." />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('comman.plugins')
  <script src="{!! asset('js/custom/custom_gender.js') !!}"></script>
@endsection