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
                <h3>Home<small></small></h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
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
                                              <div class="form-group" >
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
                    <h2>Hourly Report <small></small></h2>
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


            </div>
            <div class="clearfix"></div>
            <div class="row">

            </div>
            <div class="clearfix"></div>
            <div class="row">
           

              <div class="clearfix"></div>


              <div class="clearfix"></div>

            </div>
          </div>

    <!-- jQuery -->
    <script src="{!! asset('vendors/jquery/dist/jquery.min.js') !!}"></script>
            <script type="text/javascript">

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
getDataRecentCalls();
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
getDataActiveCalls();
}


function init_charts_home(type,data) {
        console.log('run_charts  typeof [' + typeof (Chart) + ']');
        if( typeof (Chart) === 'undefined'){ return; }
         console.log('init_charts');
        Chart.defaults.global.legend = {
          enabled: false
        };
      if(type=='lineChart'){
        var labelArray = [];
              for (var i = 0, l = 24; i < l; i++) {
                labelArray.push(i)
              }
        // Line chart
      if ($('#lineChart').length ){
           var ctx = document.getElementById("lineChart");
            var myChart = new Chart(ctx, {
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
      tempData = [];
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
