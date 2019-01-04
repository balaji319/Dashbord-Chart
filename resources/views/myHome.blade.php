@extends('theme.default')
@section('title', 'Call-Q Reporting Service')
@section('content')
<?php
date_default_timezone_set('America/Los_Angeles');
$unixTime = time();
$var_date = date("D - M. d , Y", $unixTime);  ?>
      <div class="">

            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Advert Spikes Past Hour /  <?php echo $var_date ?><small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>

                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div id="loadingadvert"  class="loading" >
                          <img  class="loading-image"  src="{!! asset('images/ajax-loader.gif') !!}"  alt="Loading..." />
                      </div>
                    <canvas id="lineChart"></canvas>
                  </div>
                </div>
              </div>

              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Hourly Calls / <?php echo $var_date ?><small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      {{-- <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li> --}}
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div  class="loading" id="loadingbar" >
                          <img   class="loading-image"  src="{!! asset('images/ajax-loader.gif') !!}"  alt="Loading..." />
                      </div>
                    <canvas id="mybarChart"></canvas>
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
                    <h2>Most Recent Calls <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>

                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="min-height: 450px">
                    <table class="table table-hover" id="records_table">
                      <thead>
                        <tr>
                          <th>Station</th>
                          <th>	Caller ID</th>
                          <th>Duration</th>
                          <th>Complete?</th>
                        </tr>
                      </thead>
                      <tbody >
                          <div  class="loading" id="loadingtable" >
                              <img   class="loading-image"  src="{!! asset('images/ajax-loader.gif') !!}"  alt="Loading..." />
                          </div>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

     <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Top Active Numbers / <?php echo $var_date?> <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>

                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="min-height: 450px">
                    <table class="table table-hover" id="records_table1">
                      <thead>
                        <tr>
                          <th>Station</th>
                          <th>Calls</th>
                          <th>Last Call</th>
                        </tr>
                      </thead>
                      <tbody>
                          <div  class="loading" id="loadingtable1" >
                              <img   class="loading-image"  src="{!! asset('images/ajax-loader.gif') !!}"  alt="Loading..." />
                          </div>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>

            </div>
          </div>

<!-- jQuery -->
<script src="{!! asset('vendors/jquery/dist/jquery.min.js') !!}"></script>
<script src="{!! asset('js/custom/custom_home.js') !!}"></script>
 @endsection
