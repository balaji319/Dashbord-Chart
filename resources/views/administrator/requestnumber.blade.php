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
                <h3>Map Calls <small></small></h3>
            </div>
        </div> --}}
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="x_panel" style="height: 100vh;">
                    <div class="x_title">

                        <h2>Request A New Number - <small>Please fill out all fields</small></h2>
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
                        <div>
                            <div class="starrr stars"></div>
                            <center><span>Lead Times (in business days) <br><br> Allow for additional lead time if custom programming is needed <br><br></center>

                                    <ul style="list-style: none;    margin-left: 23%;">

                                    <li><span style=" color: black; font-weight: 800;">7 Days:</span><strong style="color: black;">        United States TFN or Local DID </strong><span style="color: red;">(average 3 days)<span></span></span></li>
                                    <li><span style=" color: black; font-weight: 800;">7 Days:</span><strong style="color: black;">        Canada TFN DID  </strong><span style="color: red;">(average 3 days)<span></span></span></li>
                                    <li><span style=" color: black; font-weight: 800;">30 Days:</span><strong style="color: black;">       UK TFN or Local London DDI</strong><span style="color: red;">(average 7 days)<span></span></span></li>
                                    <li><span style=" color: black; font-weight: 800;">30 Days:</span><strong style="color: black;">       Australia TFN or Local DID </strong><span style="color: red;">(average 20 days)<span></span></span></li>

                                     <ul>




                          </div>
                        <br />
                        <form class="form-horizontal form-label-left">

                          <div class="form-group  col-md-6 col-sm-6 col-xs-12">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Your Name:</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" class="form-control" placeholder="Default Input">
                            </div>
                          </div>
                          <div class="form-group col-md-6 col-sm-6 col-xs-12 ">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Your Email:                                </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" class="form-control"  placeholder="Disabled Input">
                            </div>
                          </div>
                          <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Station Name:</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" class="form-control"  placeholder="Read-Only Input">
                            </div>
                          </div>
                          <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Is This Urgent ?</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                        <div class="checkbox">
                                                <label>
                                                  <input type="checkbox" value=""> Yes
                                                </label>
                                              </div>
                                              <div class="checkbox">
                                                <label>
                                                  <input type="checkbox" value="">  No
                                                </label>
                                              </div>
                                    </div>


                          </div>

                          <div class="form-group col-md-6 col-sm-6 col-xs-12 ">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Country:</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <select class="form-control">
                                <option>Choose option</option>
                                <option>Option one</option>
                                <option>Option two</option>
                                <option>Option three</option>
                                <option>Option four</option>
                              </select>
                            </div>
                          </div>



                          <div class="form-group  col-md-6 col-sm-6 col-xs-12">
                            <label class="col-md-3 col-sm-3 col-xs-12 control-label">Checkboxes and radios
                              <br>
                              <small class="text-navy">Number Type:</small>
                            </label>

                            <div class="col-md-9 col-sm-9 col-xs-12">
                                    <div class="checkbox">
                                            <label>
                                              <input type="checkbox" value="">  Local DID
                                            </label>
                                          </div>
                                          <div class="checkbox">
                                            <label>
                                              <input type="checkbox" value="">   Toll Free
                                            </label>
                                          </div>
                                          <div class="checkbox">
                                                <label>
                                                  <input type="checkbox" value="">Both (extra cost may apply)
                                                </label>
                                              </div>
                            </div>
                          </div>







                          <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                              <button type="button" class="btn btn-primary">Cancel</button>
                              <button type="reset" class="btn btn-primary">Reset</button>
                              <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                          </div>

                        </form>
                      </div>
                    </div>
                  </div>
  </div>
</div>
@endsection