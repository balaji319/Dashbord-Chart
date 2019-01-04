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
  <div class="row" id="websitecallsummary">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel" style="">
        <div class="x_title">
          <h2>Country Station Breakdown <small> </small></h2>
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

              <div class='col-sm-3'>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Month</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <select class="form-control" id='gMonth2'>
                                                  <option selected value='1'>Janaury</option>
                                                  <option value='2'>February</option>
                                                  <option value='3'>March</option>
                                                  <option value='4'>April</option>
                                                  <option value='5'>May</option>
                                                  <option value='6'>June</option>
                                                  <option value='7'>July</option>
                                                  <option value='8'>August</option>
                                                  <option value='9'>September</option>
                                                  <option value='10'>October</option>
                                                  <option value='11'>November</option>
                                                  <option value='12' selected>December</option>
                                              </select>
                  </div>
                </div>
              </div>
              <div class='col-sm-3'>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Year</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <select class="form-control" id='gtYear2'>
                                                  <option selected value='2004'>2004</option>
                                                  <option value='2005'>2005</option>
                                                  <option value='2006'>2006</option>
                                                  <option value='2007'>2007</option>
                                                  <option value='2008'>2008</option>
                                                  <option value='2009'>2009</option>
                                                  <option value='2010'>2010</option>
                                                  <option value='2011'>2011</option>
                                                  <option value='2012'>2012</option>
                                                  <option value='2013'>2013</option>
                                                  <option value='2014'>2014</option>
                                                  <option value='2015'>2015</option>
                                                  <option value='2016'>2016</option>
                                                  <option value='2017'>2017</option>
                                                  <option value='2018' selected>2018</option>
                                                  <option value='2019'>2019</option>
                                              </select>
                  </div>
                </div>
              </div>

              <div class='col-sm-3'>
                <div class="form-group">
                  <div class='input-group'>
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
                    <center> <span id="selectedMonth"></span>Country Station Breakdown </center>
                  </th>
                </tr>
              </thead>
            </table>

          </div>
          <div class="col-sm-12">
            <div class="card-box table-responsive">
              <p class="text-muted font-13 m-b-30">
              </p>
              <table id="datatable-keytable1" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th class="column-title">Date </th>
                    <th class="column-title"> Total Posts</th>
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
    </div>
  </div>
  @include('comman.plugins')
  <script src="{!! asset('js/custom/custom_country.js') !!}"></script>
@endsection