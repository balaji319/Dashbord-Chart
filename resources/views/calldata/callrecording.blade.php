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
      <div class="x_panel x_panel_custom" style="">
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
      <div class="x_panel" style="    height: 100vh;">
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

        <div class="x_content">


        </div>

        <div class="x_content">
          <div class="row">
            <div class="col-sm-12">
              <div class="card-box table-responsive">
                <p class="text-muted font-13 m-b-30">
                  Click on a record to listen to the call.
                </p>

                <table id="datatable-keytable1" class="table table-striped table-bordered ">
                  <thead>
                    <tr>
                      <th class="column-title">Reference# </th>
                      <th class="column-title"> Caller ID </th>
                      <th class="column-title">Call Date</th>
                      <th class="column-title">Call Time </th>
                      <th class="column-title">Call Duration </th>
                      <th class="column-title">Number Called </th>
                      <th class="column-title">Station</th>

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

          <div class="modal-dialog modal-lg" style=" width: 50%;">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close closeBtn" data-dismiss="modal"> <span aria-hidden="true" class="">×   </span><span class="sr-only">Close</span>

                                    </button>
                <h4 class="modal-title" id="myModalLabel">Detailed Report For : <span class="selectedID"></span> </h4>

              </div>
              <div class="modal-body" style="    min-height: 400px;">

                <div class="">
                  <div class="alert alert-success" id="SuccessDiv" style="display:none">
                    <strong>Success!</strong> Email Send Successfully !!!
                  </div>
                  <div class="alert alert-danger" id="ErrorDiv" style="display:none">
                    <strong>Error!</strong> Somthing Went Wrong !!!
                  </div>
                  <div class="clearfix"></div>
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="x_panel">
                        <div class="x_title">
                          <h2>Audio : <span class="selectedDate"></span><small></small></h2>
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
                          <div class="container">
                            <form class="form-horizontal form-label-left col-md-12 col-sm-12 col-xs-12" id="requestform">
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
                                    <input type="email" class="form-control" id="useremail" placeholder="Enter Your Email Address ">
                                  </div>
                                </center>
                              </div>
                              <div class="row">
                                <center>

                                  <div class="form-group">

                                    <input type="submit" id="sendemailBtn" class="btn btn-info" value="Send">
                                  </div>
                                </center>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>


                  </div>



                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default closeBtn" data-dismiss="modal">Close</button>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('comman.plugins')
  <script src="{!! asset('js/custom/calldata/calldata_recording.js') !!}"></script>
@endsection