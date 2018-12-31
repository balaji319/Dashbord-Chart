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
                        <form class="form-horizontal form-label-left" id="requestform">

                          <div class="form-group  col-md-6 col-sm-6 col-xs-12">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Your Name:</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" class="form-control" name="name" placeholder="Enter Your Name">
                            </div>
                          </div>
                          <div class="form-group col-md-6 col-sm-6 col-xs-12 ">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Your Email:                                </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" class="form-control" name="email" placeholder="Enter Your Name">
                            </div>
                          </div>
                          <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Station Name:</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" class="form-control" name="sname" placeholder="Enter Station Name">
                            </div>
                          </div>
                          <div class="form-group col-md-6 col-sm-6 col-xs-12" style="margin-top: -5px;">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Is This Urgent ?</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">

                                              <div class="container" style="    display: inline-flex;">
                                                  <div class="radio">
                                                    <input id="isUrgent-1" name="isUrgent" type="radio" checked value="1">
                                                    <label for="isUrgent-1" class="radio-label">Yes</label>
                                                  </div>

                                                  <div class="radio">
                                                    <input id="isUrgent-2" name="isUrgent" type="radio" value="0">
                                                    <label  for="isUrgent-2" class="radio-label">No</label>
                                                  </div>

                                                </div>

                                    </div>


                          </div>

                          <div class="form-group col-md-6 col-sm-6 col-xs-12 ">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Country:</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <select class="form-control" name="country" >
                                <option>Choose option</option>
                                <option>Option one</option>
                                <option>Option two</option>
                                <option>Option three</option>
                                <option>Option four</option>
                              </select>
                            </div>
                          </div>



                          <div class="form-group  col-md-6 col-sm-6 col-xs-12">
                            <label class="col-md-3 col-sm-3 col-xs-12 control-label">Number Type:


                            </label>

                            <div class="col-md-9 col-sm-9 col-xs-12" style="margin-top: -5px;">
                                <div class="container" style="    display: inline-flex;">
                                    <div class="radio">
                                      <input id="numType-1" name="numType" type="radio" value="0" checked>
                                      <label for="numType-1" class="radio-label" >Local DID</label>
                                    </div>

                                    <div class="radio">
                                      <input id="numType-2" name="numType" type="radio" value="1">
                                      <label  for="numType-2" class="radio-label">Toll Free</label>
                                    </div>

                                    <div class="radio">
                                      <input id="numType-3" name="numType" type="radio"  value="2">
                                      <label for="numType-3" class="radio-label">Both (extra cost may apply)</label>
                                    </div>
                                  </div>

                            </div>
                          </div>

                          <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">

                              <button type="submit" class="btn btn-success" id="sendRequest">Send Request </button>
                            </div>
                          </div>

                        </form>
                      </div>
                    </div>
                  </div>
  </div>
</div>
<script src="{!! asset('vendors/jquery/dist/jquery.min.js') !!}"></script>
<script>
jQuery(document).ready(function($){

$("body").on( "submit", "#requestform", function(event) {
  event.preventDefault();


       $.ajax({
            url: '/details-executive-report',
            data: $('#requestform').serialize(),
            headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                  var trHTML = '';
                  $('#loadingtable1').hide();
                  $.each(response.data, function(i, item) {
                  trHTML += '<tr><td>' + item.Name  + '</td><td>' + item.Calls + '</td><td>' + item.LastCall+ '</td></tr>';
            });
            $('#records_table1').append(trHTML);

            }
            });
});

});

  </script>
<style>

.radio {
  margin: 0.5rem;
}
.radio input[type="radio"] {
  position: absolute;
  opacity: 0;
}
.radio input[type="radio"] + .radio-label:before {
  content: '';
  background: #f4f4f4;
  border-radius: 100%;
  border: 1px solid #b4b4b4;
  display: inline-block;
  width: 1.4em;
  height: 1.4em;
  position: relative;
  top: -0.2em;
  margin-right: 1em;
  vertical-align: top;
  cursor: pointer;
  text-align: center;
  transition: all 250ms ease;
}
.radio input[type="radio"]:checked + .radio-label:before {
  background-color: #3197ee;
  box-shadow: inset 0 0 0 4px #f4f4f4;
}
.radio input[type="radio"]:focus + .radio-label:before {
  outline: none;
  border-color: #3197ee;
}
.radio input[type="radio"]:disabled + .radio-label:before {
  box-shadow: inset 0 0 0 4px #f4f4f4;
  border-color: #b4b4b4;
  background: #b4b4b4;
}
.radio input[type="radio"] + .radio-label:empty:before {
  margin-right: 0;
}

  </style>
@endsection