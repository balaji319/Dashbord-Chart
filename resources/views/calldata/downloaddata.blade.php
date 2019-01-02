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

        <div class="x_panel " style="">
            <div class="x_title">
              <h2>	PUFC Data Files <small></small></h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
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
                            @foreach($files as $file=>$f)
                            @php($filePath=$files[$file]["dirname"]."\\".$files[$file]["basename"])
                            <tr class="even pointer" colspan="4"><td> <a   title="{{url('/')}}\{{$filePath}}" class="recImg">File {{$files[$file]['basename']}} ( {{$filesize[$file]}} KB )</a></td><td class="downloadCsv" data-name= {{$files[$file]['basename']}}> <i class="fa fa-download" aria-hidden="true"></i></td></tr>
                            @endforeach

                        </tbody>
                      </table>

                </div>
              </div>
            </div>
          </div>
  </div>
</div>
<script src="{!! asset('vendors/jquery/dist/jquery.min.js') !!}"></script>
<script>
jQuery(document).ready(function($){
$("body").on( "click", ".downloadCsv", function() {
var name  =$(this).attr('data-name');
  var myUrl = "/downoad";
  getAjax(myUrl,name);
});
});
function getAjax(url,name){

$("#loadingbar").show();
$.ajax({
      url: url,
      type: "get",
      data:{
        filename:name
      },
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
      success: function(result){
        var pom = document.createElement('a');
        var csvContent=result; //here we load our csv data
        var blob = new Blob([csvContent],{type: 'text/csv;charset=utf-8;'});
        var url = URL.createObjectURL(blob);
        pom.href = url;
        pom.setAttribute('download', name.split('.').slice(0, -1).join('.')+'.csv');
        pom.click();

  }});
}
  </script>
@endsection
