@extends('theme.default')

@section('title', 'Call-Q Reporting Service')
@section('content')
<?php
date_default_timezone_set('America/Los_Angeles');
$unixTime = time();
$var_date = date("D - M. d Y", $unixTime);  ?>
      <div class="">
            <div class="page-title">
            </div>
        <div class="clearfix"></div>
    <div class="row">
  </div>
  <div class="x_panel" style="">
      <div class="x_title">
          <h2>Map Reports <small> </small></h2>
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
              <form action="LoadReport2.cfm" method="post" target="_blank">
                  <table width="400" border="1" align="center" cellpadding="2" class="table table-striped table-bordered" cellspacing="0" bordercolor="#c0c0c0">
                      <tbody><tr>
                          <td colspan="2" style="background: #1a1051"><div align="CENTER" class="Bold11FontWhite" style="color:white">Call Map Generation</div></td>
                      </tr>
                      <tr>
                          <td class="Bold11Font"><div align="RIGHT" class="control-label">I would like to map:</div></td>
                          <td><label>
                              <select name="DataType" class="form-control" id="DataType" onchange="getAppHour()">
                                  <option value="1">Partner Phone Numbers</option>
                                  <option value="2">Partner Download Addresses</option>
                              </select>
                          </label></td>
                      </tr>
                      <tr>
                          <td class="Bold11Font"><div align="RIGHT" >Within the past:</div></td>
                          <td><select name="AppHour" class="form-control" id="AppHour" style="vertical-align:top;">
                                  <option value="1" selected="">1 Hour</option>
                                  <option value="2" selected="">2 Hours</option>
                                  <option value="6" selected="">6 Hours</option>
                                  <option value="12" selected="">12 Hours</option>
                                  <option value="24" selected="">24 Hours</option>
                                  </select></td>
                      </tr>
                      <tr>
                          <td colspan="2" class="Bold11Font">&nbsp;</td>
                      </tr>
                      <tr>
                          <td colspan="2" class="Bold11Font" style="text-align: center;"><label>
                              <center> <div align="CENTER">
                                  <button type="submit" id= "submitBtn" class="btn btn-success">Genrate Map </button>
                              </div></center>
                          </label></td>
                      </tr>
                  </tbody></table>
                  </form>
                </div>
      </div>
  </div>
</div>

@endsection
