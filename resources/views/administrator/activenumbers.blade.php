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
      <div class="x_panel">
        <div class="x_title">
          <h2>Filter <small></small></h2>
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
        </div>
      </div>
      <div class="x_panel" style="min-height: 100vh;">
        <div class="x_title">
          <h2>Active Phone Numbers <small></small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>

            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>

        <div class="x_content">


        </div>

        <div class="x_content">
          <div class="row">
            <div class="col-sm-12">
              <div class="card-box table-responsive">


                <table id="datatable-keytable1" class="table table-striped table-bordered jambo_table  ">
                  <thead>
                    <tr>
                      <th class="column-title">StationID </th>
                      <th class="column-title"> Network </th>
                      <th class="column-title">Calls (Date Range)</th>
                      <th class="column-title">Country </th>
                      <th class="column-title">Number To Air </th>
                      <th class="column-title">Last Updated </th>
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
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="x_panel">
                        <div class="x_title">
                          <h2>Audio : <span class="selectedDate"></span><small></small></h2>
                          <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                              <ul class="dropdown-menu" role="menu">
                                {{--
                                <li><a href="#" class="lineStatus" data-time='1'>Live </a>
                                </li> --}}
                                <li><a href="#" class="lineStatus " data-time='5'>5 Second</a>
                                </li>
                                <li><a href="#" class="lineStatus active_tab" data-time='15'>15 Second </a>
                                </li>
                                <li><a href="#" class="lineStatus" data-time='30'>30 Second</a>
                                </li>
                                <li><a href="#" class="lineStatus" data-time='60'>1 min</a>
                                </li>
                                <li><a href="#" class="lineStatus" data-time='360'>5 min</a>
                                </li>
                              </ul>
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
                          <div class="container">
                            <div class="row">
                              <center>
                                <audio controls id="player">
                                                        <source src="http://wav10.f9group.com/18122808/FULL-70c58249-3bd3-46aa-89a0-377cdf724275.mp3" id="audio_ogg" type="audio/ogg">
                                                        <source src="http://wav10.f9group.com/18122808/FULL-70c58249-3bd3-46aa-89a0-377cdf724275.mp3" id="audio_mp3" type="audio/mpeg">
                                                      Your browser does not support the audio element.
                                                      </audio>
                              </center>
                            </div>
                            <div class="row">
                              <center>
                                <h3>To email this audio to someone else, please enter in an email address below, seperate multiple
                                  emails with a semi colon ;</h3>
                                <div class="form-group">
                                  <br>
                                  <input type="text" class="form-control" id="usr" placeholder="Enter Your Email Address ">
                                </div>
                              </center>
                            </div>
                            <div class="row">
                              <center>

                                <div class="form-group">

                                  <input type="submit" class="btn btn-info" value="Send">
                                </div>
                              </center>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>


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
  <script src="{!! asset('js/custom/administrator/administrator_activenumber.js') !!}"></script>


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