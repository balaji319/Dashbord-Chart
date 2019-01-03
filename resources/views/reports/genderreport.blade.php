@extends('theme.default')

@section('title', 'Call-Q Reporting Service')
@section('content')
<div class="row">
        {{-- <h1 class="page-header">Home</h1> --}}
</div>
<?php
date_default_timezone_set('America/Los_Angeles');
$unixTime = time();
$var_date = date("D - M. d Y", $unixTime);  ?>

<!-- /.row -->
<div class="row" id="networkcallsummary">
        <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="">
                        <div class="x_title">
                            <h2>Gender Breakdown Reports <small> </small></h2>
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

                                    <div class='col-sm-3'>

                                        From :
                                        <div class="form-group">
                                          <div class='input-group date' id='myDatepicker'>
                                            <input type='text' class="form-control" id="datepickerVal" />
                                            <span class="input-group-addon">
                                                                           <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                          </div>
                                        </div>

                                </div>
                                <div class='col-sm-3'>
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
                                  <div class='col-sm-3'>

                                      Campaign :
                                      <div class="form-group">
                                        <div class='input-group date' id='myDatepicker'>
                                            <select class="form-control"  id='gtCampaign2' >

                                              </select>

                                        </div>
                                      </div>

                              </div>
                              <div class='col-sm-3'>

                                  Filter :
                                  <div class="form-group">
                                    <div class='input-group date' >
                                        <button type="submit" id= "submitBtn" class="btn btn-success">Filter</button>

                                    </div>
                                  </div>

                                </div>



                                </div>
                            </div>
                        </div>
                    </div>
                <div class="x_panel" style="height: 100vh;">
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
                           <th class="column-title" colspan="9"> <center> <span id="selectedMonth"></span>- Gender Report </center></th>
                          </tr>
                        </thead>
                      </table>
                    </div>
                  </div>

                  <div class="x_content">
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                              <p class="text-muted font-13 m-b-30">

                              </p>

                              <div id="echart_line1" style="height:450px;"></div>
                            </div>
                            <div  class="loading" id="loadingbar" >
                                    <img   class="loading-image"  src="{!! asset('images/ajax-loader.gif') !!}"  alt="Loading..." />
                               </div>
                          </div>
                        </div>
                      </div>

                </div>
              </div>
</div>

  <!-- Datatables -->
  <script src="{!! asset('vendors/jquery/dist/jquery.min.js') !!}"></script>
  <script src="{!! asset('vendors/datatables.net/js/jquery.dataTables.min.js') !!}"></script>
  <script src="{!! asset('vendors/datatables.net-buttons/js/buttons.print.min.js') !!}"></script>
  <script src="{!! asset('vendors/datatables.net-buttons/js/dataTables.buttons.min.js') !!}"></script>

  <script src="{!! asset('vendors/datatables.net-buttons/js/buttons.flash.min.js') !!}"></script>
  <script src="{!! asset('vendors/datatables.net-buttons/js/buttons.html5.min.js') !!}"></script>
  <script src="{!! asset('vendors/datatables.net-buttons/js/buttons.print.min.js') !!}"></script>
  <script src="{!! asset('vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') !!}"></script>

  <script src="{!! asset('vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') !!}"></script>
  <script src="{!! asset('vendors/datatables.net-responsive/js/dataTables.responsive.min.js') !!}"></script>
  <script src="{!! asset('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') !!}"></script>
  <script src="{!! asset('vendors/datatables.net-scroller/js/dataTables.scroller.min.js') !!}"></script>


  <script src="{!! asset('vendors/jszip/dist/jszip.min.js') !!}"></script>
  <script src="{!! asset('vendors/pdfmake/build/pdfmake.min.js') !!}"></script>
  <script src="{!! asset('vendors/pdfmake/build/vfs_fonts.js') !!}"></script>

  <script>

    $(document).ready(function() {
      var dateNow = new Date();
      $('#myDatepicker2').datetimepicker({
        format: 'MM/DD/YYYY ',
        defaultDate:dateNow
      });
      $('#myDatepicker').datetimepicker({
        format: 'MM/DD/YYYY ',
        defaultDate:dateNow
    });

    $("#networkcallsummary").on( "click", "#submitBtn", function() {

                  var startDate= $("#datepickerVal").val();
                  var endDate= $("#datepickerVal1").val();
                  var gtCampaign2= $("#gtCampaign2").val();
                  $("#selectedMonth").html($("#gMonth2 option:selected").text())
                  getAjax("/gender-report",startDate,endDate,gtCampaign2,true)
      });
});


jQuery(document).ready(function($){

      var myUrl = "/campaign-list";
     getAjaxCampaignList(myUrl);


});

function getAjaxCampaignList(url){

$.ajax({
      url: url,
      success: function(response){

          var trHTML = "";
          $("#loadingbar").hide();
                    $.each(response.data, function(i, item) {
                        trHTML +="<option value = '" + item.CampaignID + " '>" + item.Name + " </option>";
                    });
                    $('#gtCampaign2').append(trHTML);

  }});
};

function getAjax(url,startDate,endDate,campaign_number,flag){

var objData =  flag ? {"startdate":startDate,"enddate":endDate,"campaign_number":campaign_number} :'';
// $('#datatable-keytable1').dataTable().fnClearTable();
// $('#datatable-keytable1').dataTable().fnDestroy();
$("#loadingbar").show();
$('#datatable-keytable_t').html("");
$("#datatable-keytable1 > tbody").empty();
$.ajax({
      url: url,
      type: "get",
      data:objData,
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
      success: function(result){
       var trHTML ='';
       var trHTML1='';
       $("#loadingbar").hide();
       var int_completed=0;
       var int_total_calls=0;


        var myChart11 = echarts.init(document.getElementById('echart_line1'));
// use the chart-------------------
var option =


{
title: {
  text: 'Minute Reports',
  subtext: ''
},
tooltip: {
  trigger: 'axis'
},
legend: {
  x: 420,
  y: 20,
  data: result.data.Gender
},
toolbox: {
  show: true,
  feature: {

  restore: {
    show: true,
    title: "Restore"
  },
  saveAsImage: {
    show: true,
    title: "Save Image"
  }
  }
},

xAxis: [{
  type: 'category',
  data: []
}],
yAxis: [{
  type: 'value'
}],
series: [{
  name: 'UNKNOWN',
  type: 'pie',
  itemStyle: dataStyle,
  data: result.data.Calls
}, {
  name:  'MALE',
  type: 'pie',
  itemStyle: dataStyle,
  data: result.data.Calls
},
{
  name:  'FEMALE',
  type: 'pie',
  itemStyle: dataStyle,
  data: result.data.Calls
},
{
  name:  'BOTH',
  type: 'pie',
  itemStyle: dataStyle,
  data:result.data.Calls
}]
}
var dataStyle = {
				normal: {
				  label: {
					show: false
				  },
				  labelLine: {
					show: false
				  }
				}
			  };

			  var placeHolderStyle = {
				normal: {
				  color: 'rgba(0,0,0,0)',
				  label: {
					show: false
				  },
				  labelLine: {
					show: false
				  }
				},
				emphasis: {
				  color: 'rgba(0,0,0,0)'
				}
			  };
myChart11.setOption(option);

  }});
}
$("#executivecallsummary").on( "click", ".tbl_row", function() {

      var var_date = $(this).attr('data-date')

             $.ajax({
                  url: '/details-executive-report',
                  dara:var_date,
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







      </script>

<style>
      .active_tab{
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