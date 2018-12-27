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
<div class="row" id="executivecallsummary">
        <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="">
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
                                    
                                        <div class='col-sm-4'>
                                                <div class="form-group" style="margin-top: 3.5%;">
                                                        <div class='input-group'>
                                            <button type="submit" id= "submitBtn" class="btn btn-success">Update Graph</button>
                                        </div>
                                    </div> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data <small></h2>
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
                            <div id="loadingadvert"  class="loading" >
                                <img  class="loading-image"  src="{!! asset('images/ajax-loader.gif') !!}"  alt="Loading..." />
                            </div>
                          <canvas id="lineChart"  height="100"></canvas>
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

    $("#executivecallsummary").on( "click", "#submitBtn", function() {
                  var startDate= $("#datepickerVal").val();
                  getAjax("/executive-report",startDate,true)            
      });
});


jQuery(document).ready(function($){

      var myUrl = "/executive-report";
      getAjax(myUrl);


});

function getAjax(url,startDate,flag){

var objData =  flag ? {"startdate":startDate} :'';

$("#loadingbar").show();
$.ajax({
      url: url,  
      type: "post", 
      data:objData,
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
      success: function(result){
    
       $("#loadingbar").hide();
       


  }});
}
$("#executivecallsummary").on( "click", ".tbl_row", function() {

      var var_date = 
      {
           'date':$(this).attr('data-date')
      }
      $(".selectedDate").text($(this).attr('data-date'))
           
             $.ajax({
                  url: '/details-executive-report',
                  data:var_date,
                
                  success: function(response) {
                        var trHTML = '';
                        $('#loadingtable1').hide();
                        $('#loadingadvert').hide();
                        $('#loadingbar').hide();
                        $('#loadingtable').hide();

                        $.each(response.data.get_stations, function(i, item) {
                              
                        trHTML += '<tr><td>' + item.Name  + '</td><td>' + item.Campaign + '</td><td>' + item.Calls+ ' </td><td>' + item.Completed+ ' </td></tr>';
                  });
                  $('#records_table1').append(trHTML);
                    
                  myChart.data.datasets[0].data=response.data.smallbarchart;
                  // re-render the chart
                  myChart2.data.labels=response.data.get_cities.Location;
                  myChart2.data.datasets[0].data=response.data.get_cities.calls;
                  myChart.update();
                  myChart2.update();
                  }
                  });
});
$('.modal-footer .btn-primary').click(function() {
   $('form[name="modalForm"]').submit();
});










function init_recent_table(min, max) {

// logic to get new data
var getDataRecentCalls = function() {
  $.ajax({
    url: '/most-recent-calls',
    success: function(response) {
      $('#loadingtable').hide();
      var trHTML = '';
      $.each(response.data, function(i, item) {
        var strType = item.HangUpCount==1 ? 'No' :'Yes';
        trHTML += '<tr><td>' + item.Name + '</td><td>' + item.CallerID + '</td><td>' + convertTime(item.CallDuration) + '</td><td>' + strType + '</td></tr>';
    });
    $('#records_table').append(trHTML);

    }
  });
};
//getDataRecentCalls();
}


function convertTime(sec) {
    var hours = Math.floor(sec/3600);
    (hours >= 1) ? sec = sec - (hours*3600) : hours = '00';
    var min = Math.floor(sec/60);
    (min >= 1) ? sec = sec - (min*60) : min = '00';
    (sec < 1) ? sec='00' : void 0;

    (min.toString().length == 1) ? min = '0'+min : void 0;
    (sec.toString().length == 1) ? sec = '0'+sec : void 0;

    return hours+':'+min+':'+sec;
}


function init_active_table(min, max) {
  // logic to get new data
  var getDataActiveCalls = function() {
  $.ajax({
    url: '/top-active-numbers',
    success: function(response) {
      var trHTML = '';
      $('#loadingtable1').hide();
      $.each(response.data, function(i, item) {
        trHTML += '<tr><td>' + item.Name  + '</td><td>' + item.Calls + '</td><td>' + item.LastCall+ '</td></tr>';
    });
    $('#records_table1').append(trHTML);

    }
  });
};
//getDataActiveCalls();
}

 var myChart ='';
 var myChart2 ='';
function init_charts_home(type,data) {
        console.log('run_charts  typeof [' + typeof (Chart) + ']');
        if( typeof (Chart) === 'undefined'){ return; }
         console.log('init_charts');
        Chart.defaults.global.legend = {
          enabled: false
        };
      if(type=='lineChart'){
        // Line chart
        if ($('#lineChart').length ){
          var labelArray = [];
              for (var i = 0, l = 24; i < l; i++) {
                labelArray.push(i)
              }
           var ctx = document.getElementById("lineChart");
             myChart = new Chart(ctx, {
              type: 'line',
              data: {
                labels: labelArray,
                datasets:  [{
                      label: "My First dataset",
                      borderColor: "rgba(38, 185, 154, 0.7)",
                      pointBorderColor: "rgba(38, 185, 154, 0.7)",
                      pointHoverBackgroundColor: "#fff",
                      pointHoverBorderColor: "rgba(220,220,220,1)",
                      pointBorderWidth: 1,
                      data: ["13","21","9","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0"]
                      }, {
                      label: "My Second dataset",
                      borderColor: "rgba(3, 88, 106, 0.70)",
                      pointBorderColor: "rgba(3, 88, 106, 0.70)",
                      pointHoverBackgroundColor: "#fff",
                      pointHoverBorderColor: "rgba(151,187,205,1)",
                      pointBorderWidth: 1,
                      data: ["31","11","19","10","0","20","70","10","10","10","50","20","10","30","01","0","0","0","0","50","06","70","0","40"]
                      },
                      {
                      label: "My Third dataset",
                      borderColor: "rgba(03, 80, 16, 0.70)",
                      pointBorderColor: "rgba(03, 88, 106, 0.70)",
                      pointHoverBackgroundColor: "#fff",
                      pointHoverBorderColor: "rgba(51,187,05,1)",
                      pointBorderWidth: 1,
                      data: ["17","18","19","10","8","5","6","10","10","10","2","0","17","33","01","88","44","033","55","50","06","70","0","40"]
                      }]

              },
              options: {
                bezierCurve : true,
                responsive: true,
                title: {
                  display: false,
                  text: "Dynamically Update Chart Via Ajax Requests",
                },
                legend: {
                  display: false
                },
                scales: {
                  yAxes: [{
                    ticks: {
                              min:0
                            
                          }
                  }]
                }
              }
            });
            function getRandomIntInclusive(min, max) {
            var arr = [];
            for (var i = 0, l = 20; i < l; i++) {
                arr.push(Math.random() * (max - min + 1))
            }
            return arr;
            }

            function getRandomIntInclusiveArray(len) {
              var arr = [];
            for (var i = 0, l = len; i < l; i++) {
                arr.push(Math.round(Math.random() * l))
            }
            return arr;
            }
            postId =0;
            // logic to get new data
            var getDataline = function() {
              $.ajax({
                url: '/advert-spikes-past-hour',
                success: function(data) {
                  $('#loadingadvert').hide();
                  myChart.data.labels=data.data.min;
                  myChart.data.datasets[1].data=data.data.count_arr;
                  // re-render the chart
                  myChart.update();
                }
              });
            };

           //getDataline();
            // // get new data every 3 seconds
            // var getDataInterval = setInterval(getDataline, 15000);
            // $("body").on( "click", ".lineStatus", function() {
            //   clearInterval(getDataInterval);
            //   var link_name = $(this).attr('data-time')
            //   $( ".lineStatus" ).removeClass( "active_tab" );
            //   $(this).addClass( "active_tab" );
            //   getDataInterval = setInterval(getDataline,link_name*1000);
            // });
      }
      }
}
jQuery(document).ready(function($){
      var tempData='';
         init_charts_home('lineChart',tempData);
  
    
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