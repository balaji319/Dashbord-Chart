@extends('theme.default')

@section('title', 'Call-Q Reporting Service')
@section('content')
<?php
date_default_timezone_set('America/Los_Angeles');
$unixTime = time();
$var_date = date("D - M. d Y", $unixTime);  ?>
      <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Top Cities <small></small></h3>
              </div>
            </div>
        <div class="clearfix"></div>
    <div class="row"> 
  </div>
</div>

@endsection
