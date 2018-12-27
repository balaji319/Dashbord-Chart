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
                                                    <input type='text' class="form-control" id="datepickerVal1"/>
                                                    <span class="input-group-addon">
                                                       <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='col-sm-4'>
                                                <div class="form-group" style="margin-top: 3.5%;">
                                                        <div class='input-group'>
                                            <button type="submit" id= "submitBtn" class="btn btn-success">Submit</button>
                                        </div>
                                    </div> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="x_panel">
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

                    <p> <code></code>Total does not include todays callst</p>

                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action" id="today_records_table">
                        <thead>
                          <tr class="headings">

                            <th class="column-title">Day </th>
                            <th class="column-title"> Date </th>
                            <th class="column-title">Total Calls </th>
                            <th class="column-title">Complete </th>
                            <th class="column-title">Incomplete </th>
                            <th class="column-title">% Complete </th>
                            <th class="column-title">% Incomplete </th>
                            <th class="column-title">File 1 </th>
                            <th class="column-title">File 2 </th>
                            <th class="column-title">File 3 </th>
                            <th class="column-title">Web </th>

                          </tr>
                        </thead>

                        <tbody id="today_records_table_tr">
                          <tr class="even pointer">

                         

                          </tr>

                        </tbody>
                      </table>
                    </div>


                  </div>

                  <div class="x_content">
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                              <p class="text-muted font-13 m-b-30">
                                    Click on a data row to view details about that day..
                              </p>

                              <table id="datatable-keytable1" class="table table-striped table-bordered">
                                <thead>
                                  <tr>
                                        <th class="column-title">Day </th>
                                        <th class="column-title"> Date </th>
                                        <th class="column-title">Total Calls </th>
                                        <th class="column-title">Complete </th>
                                        <th class="column-title">Incomplete </th>
                                        <th class="column-title">% Complete </th>
                                        <th class="column-title">% Incomplete </th>
                                        <th class="column-title">File 1 </th>
                                        <th class="column-title">File 2 </th>
                                        <th class="column-title">File 3 </th>
                                        <th class="column-title">Web </th>
                                  </tr>
                                </thead>


                                <tbody id="datatable-keytable_tr">
                                        
                                         
                                </tbody>
                                
                              </table>
                            </div>
                            <div  class="loading" id="loadingbar" >
                                    <img   class="loading-image"  src="{!! asset('images/ajax-loader.gif') !!}"  alt="Loading..." />
                               </div>
                          </div>
                        </div>
                      </div>
                     
                      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content"></div>
                        </div>
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content"></div>
                        </div>
                        <div class="modal-dialog modal-lg" style=" width: 70%;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"> <span aria-hidden="true" class="">×   </span><span class="sr-only">Close</span>
                    
                                    </button>
                                     <h4 class="modal-title" id="myModalLabel">Report</h4>
                    
                                </div>
                                <div class="modal-body" style="    min-height: 500px;">
                              
                                    <div class="">
                                          
                                          <div class="clearfix"></div>
                                          <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                              <div class="x_panel">
                                                <div class="x_title">
                                                  <h2>Hourly Call Breakdown for :  <span class="selectedDate"></span><small></small></h2>
                                                  <ul class="nav navbar-right panel_toolbox">
                                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                    </li>
                                                    <li class="dropdown">
                                                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                                      <ul class="dropdown-menu" role="menu">
                                                        {{-- <li><a href="#" class="lineStatus" data-time='1' >Live </a>
                                                        </li> --}}
                                                        <li><a href="#"  class="lineStatus " data-time='5' >5 Second</a>
                                                        </li>
                                                        <li><a href="#"  class="lineStatus active_tab" data-time='15'>15 Second </a>
                                                        </li>
                                                        <li><a href="#"  class="lineStatus" data-time='30'>30 Second</a>
                                                        </li>
                                                        <li><a href="#"  class="lineStatus" data-time='60'>1 min</a>
                                                        </li>
                                                         <li><a href="#"  class="lineStatus" data-time='360'>5 min</a>
                                                        </li>
                                                      </ul>
                                                    </li>
                                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                    </li>
                                                  </ul>
                                                  <div class="clearfix"></div>
                                                </div>
                                                <div class="x_content">
                                                    <div id="loadingadvert"  class="loading" >
                                                        <img  class="loading-image"  src="{!! asset('images/ajax-loader.gif') !!}"  alt="Loading..." />
                                                    </div>
                                                  <canvas id="lineChart"></canvas>
                                                </div>
                                              </div>
                                            </div>
                              
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                              <div class="x_panel">
                                                <div class="x_title">
                                                  <h2>Calls by station for:  <span class="selectedDate"></span><small></small></h2>
                                                  <ul class="nav navbar-right panel_toolbox">
                                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                    </li>
                                                    {{-- <li class="dropdown">
                                                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                                      <ul class="dropdown-menu" role="menu">
                                                        <li><a href="#">Settings 1</a>
                                                        </li>
                                                        <li><a href="#">Settings 2</a>
                                                        </li>
                                                      </ul>
                                                    </li> --}}
                                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                    </li>
                                                  </ul>
                                                  <div class="clearfix"></div>
                                                </div>
                                                
                                                <div class="x_content" style="overflow-y: scroll;height: 300px;">
                                                          
                                                            <table class="table table-hover" id="records_table1">
                                                                        <thead>
                                                                          <tr>
                                                                            <th>Station</th>
                                                                            <th>Number</th>
                                                                            <th> Calls</th>
                                                                            <th> Completed</th>
                                                                          </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <div  class="loading" id="loadingtable1" >
                                                                                <img   class="loading-image"  src="{!! asset('images/ajax-loader.gif') !!}"  alt="Loading..." />
                                                                            </div>
                                                  
                                                                        </tbody>
                                                                      </table>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="clearfix"></div>
                                          <div class="row">
                              
                                          </div>
                                          <div class="clearfix"></div>
                                          <div class="row">
                                         
                              
                                            <div class="clearfix"></div>
                              
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                              <div class="x_panel">
                                                <div class="x_title">
                                                  <h2>Most Recent Calls <small></small></h2>
                                                  <ul class="nav navbar-right panel_toolbox">
                                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                    </li>
                              
                                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                    </li>
                                                  </ul>
                                                  <div class="clearfix"></div>
                                                </div>
                                                <div class="x_content">
                                                            <div  class="loading" id="loadingbar" >
                                                                <img   class="loading-image"  src="{!! asset('images/ajax-loader.gif') !!}"  alt="Loading..." />
                                                            </div>
                                                        
                                                          <canvas id="mybarChart1"></canvas>
                                                        </div>
                                              </div>

                                            </div>
                              
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                              <div class="x_panel">
                                                <div class="x_title">
                                                  <h2>Top Active Numbers / <?php echo $var_date?> <small></small></h2>
                                                  <ul class="nav navbar-right panel_toolbox">
                                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                    </li>
                              
                                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                    </li>
                                                  </ul>
                                                  <div class="clearfix"></div>
                                                </div>
                                                <div class="x_content" style="min-height: 450px">
                                                            <canvas id="mybarChart"></canvas>
                                                            <div  class="loading" id="loadingtable" >
                                                                <img   class="loading-image"  src="{!! asset('images/ajax-loader.gif') !!}"  alt="Loading..." />
                                                            </div>

                                                </div>
                                              </div>
                                            </div>
                              
                                            <div class="clearfix"></div>
                              
                                          </div>
                                        </div>
    
                              </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    
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

    $("#executivecallsummary").on( "click", "#submitBtn", function() {
                  var startDate= $("#datepickerVal").val();
                  var endDate= $("#datepickerVal1").val();

                  getAjax("/executive-report",startDate,endDate,true)            
      });
});


jQuery(document).ready(function($){

      var myUrl = "/executive-report";
      getAjax(myUrl);


});

function getAjax(url,startDate,endDate,flag){

var objData =  flag ? {"startdate":startDate,"enddate":endDate} :'';
$('#datatable-keytable1').dataTable().fnClearTable();
$('#datatable-keytable1').dataTable().fnDestroy();
$("#loadingbar").show();
$.ajax({
      url: url,  
      type: "post", 
      data:objData,
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
      success: function(result){
       var trHTML ='';
       var trHTML1='';
       $("#loadingbar").hide();
       var item = result.data.today_array;
        trHTML += '<tr><td>' + item.Web  + '</td><td>' + item.date + '</td><td>' + item.total_calls+ '</td><td>' + item.completed  + '</td><td>' + item.incomplete + '</td><td>' + item.per_comp+ '</td><td>' + item.per_incomp  + '</td><td>' + item.file_1 + '</td><td>' + item.file_2+ '</td><td>' + item.file_2 + '</td><td>' + item.Web+ '</td></tr>';
       var total_report = result.data.total_report[0];
       trHTML+= '<tr><td></td><td>' + total_report.totalcalls + '</td><td></td><td></td><td></td><td>' + total_report.PercentComplete+ '</td><td>' + total_report.PercentIncomplete  + '</td><td></td><td></td><td></td><td></td></tr>';
       $('#today_records_table_tr').html(trHTML);

       $.each(result.data.days_report, function(i, item) {
        trHTML1 += '<tr  data-toggle="modal" class="tbl_row" data-target="#myModal" data-date="'+item.DayDate+'" ><td>' + item.dayname + '</td><td>' + item.DayDate + '</td><td>' + item.TotalCalls+ '</td><td>' + item.CompletedCalls + '</td><td>' + item.Hangups + '</td><td>' + item.PercentComplete + '</td><td>' + item.PercentIncomplete+ '</td><td>' + item.File1+ '</td><td>' + item.File2 + '</td><td>' + item.File3 + '</td><td>' + item.Web+ '</td></tr>';
    });
    $('#datatable-keytable1').append(trHTML1);
 
    $('#datatable-keytable1').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "sDom": 'lfrtip'
    });

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
           var ctx = document.getElementById("lineChart");
              function getRandomIntInclusiveArray(len) {
                var arr = [];
              for (var i = 0, l = len; i < l; i++) {
                  arr.push(Math.round(Math.random() * l))
              }
              return arr;
              }

              var labelArray = [];
              for (var i = 0, l = 24; i < l; i++) {
                labelArray.push(i)
              }
               myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                  labels: labelArray,
                  datasets: [{
                        label: '# of Votes',
                        backgroundColor: "#b5ced3",
                        data: []
                        }]
                },
                options: {
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
                                min: 0
                        
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
          

         
      }

      }else if(type=='mybarChart'){
        // Bar chart
         if ($('#mybarChart').length ){

              function getRandomIntInclusiveArray(len) {
                var arr = [];
              for (var i = 0, l = len; i < l; i++) {
                  arr.push(Math.round(Math.random() * l))
              }
              return arr;
              }
              // create initial empty chart
              var ctx_live = document.getElementById("mybarChart");
              var labelArray = [];
              for (var i = 0, l = 24; i < l; i++) {
                labelArray.push(i)
              }
               myChart2 = new Chart(ctx_live, {
                type: 'bar',
                data: {
                  labels: [],
                  datasets: [{
                        label: '# of Votes',
                        backgroundColor: "#b5ced3",
                        data: []
                        }]
                },
                options: {
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
                                min: 0,
                                stepSize: 10,
                            }
                    }]
                  }

                }
              });

          
      //  getData();
      // get new data every 3 seconds
      //setInterval(getData,10000);
    }
   }
else if(type=='mybarChart1'){
        // Bar chart
         if ($('#mybarChart1').length ){

              function getRandomIntInclusiveArray(len) {
                var arr = [];
              for (var i = 0, l = len; i < l; i++) {
                  arr.push(Math.round(Math.random() * l))
              }
              return arr;
              }
              // create initial empty chart
              var ctx_live1 = document.getElementById("mybarChart1");
              var labelArray = [];
              for (var i = 0, l = 24; i < l; i++) {
                labelArray.push(i)
              }
              var oilData = {
                        labels: [
                              "Saudi Arabia",
                              "Russia",
                              "Iraq",
                              "United Arab Emirates",
                              "Canada"
                        ],
                        datasets: [
                              {
                                    data: [133.3, 86.2, 52.2, 51.2, 50.2],
                                    backgroundColor: [
                                    "#FF6384",
                                    "#63FF84",
                                    "#84FF63",
                                    "#8463FF",
                                    "#6384FF"
                                    ]
                              }]
                        };


              var myChart1 = new Chart(ctx_live1, {
                type: 'pie',
                data: oilData
              });

          
      //  getData();
      // get new data every 3 seconds
      //setInterval(getData,10000);
    }
   }

   
}
jQuery(document).ready(function($){
      var tempData='';

         init_charts_home('mybarChart',tempData);
         init_charts_home('lineChart',tempData);
         init_charts_home('mybarChart1',tempData);
         init_active_table();
         

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