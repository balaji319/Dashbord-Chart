@extends('theme.default')

@section('title', 'Call-Q Reporting Service')
@section('content')
<?php
date_default_timezone_set('America/Los_Angeles');
$unixTime = time();
$var_date = date("D - M. d Y", $unixTime);  ?>
      <div class="">
            {{-- <div class="page-title">
              <div class="title_left">
                <h3>LOG Min <small></small></h3>
              </div>
            </div> --}}
        <div class="clearfix"></div>
    <div class="row">

        <div class="x_panel x_panel_custom" style="">
            <div class="x_title">
              <h2>	PUFC Data Files <small></small></h2>
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
            <div class="x_content" style="    height: 100vh;">
              <div class="container">
                <div class="row">

                    <table class="table table-striped jambo_table bulk_action" id="today_records_table">
                        <thead>
                          <tr class="headings">

                            <th class="column-title" colspan="2">	File Name
                              </th>

                          </tr>
                        </thead>
                        <tbody id="today_records_table_tr">
                            @foreach($manuals as $file=>$f)
                            @php($filePath=$manuals[$file]["dirname"]."\\".$manuals[$file]["basename"])
                            <tr class="even pointer" colspan="4"><td> <a  href="data:text/csv;charset=utf-8,'+escape({{$filePath}})+'" download="filename.csv"  title="{{url('/')}}\{{$filePath}}" class="recImg">File {{$manuals[$file]['basename']}} ( {{$manuals1[$file]}} KB )</a></td><td> <i class="fa fa-download" aria-hidden="true"></i></td></tr>
                            @endforeach

                        </tbody>
                      </table>

                </div>
              </div>
            </div>
          </div>




  </div>
</div>

@endsection
