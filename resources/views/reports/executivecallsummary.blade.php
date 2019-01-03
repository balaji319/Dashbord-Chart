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
      <div class="x_panel" style="">
        <div class="x_title">
          <h2>Filter <small></small></h2>
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
        </div>
      </div>
      <div class="x_panel" style="min-height: 100vh;">
        <div class="x_title">
          <h2>Data <small>Todays call volume is still in process and dynamically changing.</small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>

            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>

        <div class="x_content" >

          <p> <code></code>Total does not include todays calls</p>

          <div class="table-responsive">
            <table class="table table-striped jambo_table bulk_action" id="today_records_table">
              <thead>
                <tr class="headings">

                  <th class="column-title">Day </th>
                  <th class="column-title"> Date </th>
                  <th class="column-title">Total Calls </th>
                  <th class="column-title">Complete </th>
                  <th class="column-title">Incomplete </th>
                  <th class="column-title">% Complete </th>
                  <th class="column-title">% Incomplete </th>
                  <th class="column-title">File 1 </th>
                  <th class="column-title">File 2 </th>
                  <th class="column-title">File 3 </th>
                  <th class="column-title">Web </th>
                </tr>
              </thead>
              <tbody id="today_records_table_tr">
                <tr class="even pointer">
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="x_content">
          <div class="row">
            <div class="col-sm-12">
              <div class="card-box table-responsive">
                <p class="text-muted font-13 m-b-30">
                  Click on a data row to view details about that day..
                </p>
                <table id="datatable-keytable1" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th class="column-title">Day </th>
                      <th class="column-title"> Date </th>
                      <th class="column-title">Total Calls </th>
                      <th class="column-title">Complete </th>
                      <th class="column-title">Incomplete </th>
                      <th class="column-title">% Complete </th>
                      <th class="column-title">% Incomplete </th>
                      <th class="column-title">File 1 </th>
                      <th class="column-title">File 2 </th>
                      <th class="column-title">File 3 </th>
                      <th class="column-title">Web </th>
                    </tr>
                  </thead>
                  <tbody id="datatable-keytable_tr">
                  </tbody>
                </table>
              </div>
              <div class="loading" id="loadingbar">
                <img class="loading-image" src="{!! asset('images/ajax-loader.gif') !!}" alt="Loading..." />
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" style=" width: 80%;">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"> <span aria-hidden="true" class="">×   </span><span class="sr-only">Close</span>

                                    </button>
                <h4 class="modal-title" id="myModalLabel">Detailed Report For : <span class="selectedDate"></span> </h4>

              </div>
              <div class="modal-body" style="    min-height: 400px;">

                <div class="">

                  <div class="clearfix"></div>
                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="x_panel">
                        <div class="x_title">
                          <h2>Hourly Call Breakdown for : <span class="selectedDate"></span><small></small></h2>
                          <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>

                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                          </ul>
                          <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                          <div id="loadingadvert" class="loading">
                            <img class="loading-image" src="{!! asset('images/ajax-loader.gif') !!}" alt="Loading..." />
                          </div>
                          <canvas id="lineChart"></canvas>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="x_panel">
                        <div class="x_title">
                          <h2>Calls by station for: <span class="selectedDate"></span><small></small></h2>
                          <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                       
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                          </ul>
                          <div class="clearfix"></div>
                        </div>

                        <div class="x_content" style="overflow-y: scroll;height:300px">

                          <table class="table table-hover" id="records_table1">
                            <thead>
                              <tr>
                                <th>Station</th>
                                <th>Number</th>
                                <th> Calls</th>
                                <th> Completed</th>
                              </tr>
                            </thead>
                            <tbody>
                              <div class="loading" id="loadingtable1">
                                <img class="loading-image" src="{!! asset('images/ajax-loader.gif') !!}" alt="Loading..." />
                              </div>

                            </tbody>
                          </table>
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

                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="x_panel">
                        <div class="x_title">
                          
                          <h2>Country Wise Breakdown <small></small></h2>
                          <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>

                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                          </ul>
                          <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                          <div class="loading" id="loadingmybarChart1">
                            <img class="loading-image" src="{!! asset('images/ajax-loader.gif') !!}" alt="Loading..." />
                          </div>

                          <canvas id="mybarChart1"></canvas>
                        </div>
                      </div>

                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="x_panel">
                        <div class="x_title">
                           <h2>Country Wise Breakdown <small></small></h2>
                          <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>

                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                          </ul>
                          <div class="clearfix"></div>
                        </div>
                        <div class="x_content" style="min-height: 250px">
                          <canvas id="mybarChart"></canvas>
                          <div class="loading" id="loadingtable">
                            <img class="loading-image" src="{!! asset('images/ajax-loader.gif') !!}" alt="Loading..." />
                          </div>

                        </div>
                      </div>
                    </div>

                    <div class="clearfix"></div>

                  </div>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@include('comman.plugins')
<script src="{!! asset('js/custom/custom_executive.js') !!}"></script>

@endsection