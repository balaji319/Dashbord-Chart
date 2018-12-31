@extends('theme.default')

@section('title', 'Call-Q Reporting Service')
@section('content')
<?php
date_default_timezone_set('America/Los_Angeles');
$unixTime = time();
$var_date = date("D - M. d , Y", $unixTime);  ?>
      <div class="">
            {{-- <div class="page-title">
              <div class="title_left">
                <h3>Home<small></small></h3>
              </div>
            </div> --}}
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Advert Spikes Past Hour /  <?php echo $var_date ?><small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
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
                    <h2>Hourly Calls / <?php echo $var_date ?><small></small></h2>
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
                  <div class="x_content">
                      <div  class="loading" id="loadingbar" >
                          <img   class="loading-image"  src="{!! asset('images/ajax-loader.gif') !!}"  alt="Loading..." />
                      </div>
                    <canvas id="mybarChart"></canvas>
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
                  <div class="x_content" style="min-height: 450px">
                    <table class="table table-hover" id="records_table">
                      <thead>
                        <tr>
                          <th>Station</th>
                          <th>	Caller ID</th>
                          <th>Duration</th>
                          <th>Complete?</th>
                        </tr>
                      </thead>
                      <tbody >
                          <div  class="loading" id="loadingtable" >
                              <img   class="loading-image"  src="{!! asset('images/ajax-loader.gif') !!}"  alt="Loading..." />
                          </div>
                      </tbody>
                    </table>
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
                    <table class="table table-hover" id="records_table1">
                      <thead>
                        <tr>
                          <th>Station</th>
                          <th>Calls</th>
                          <th>Last Call</th>
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
        // Line chart
      if ($('#lineChart').length ){
           var ctx = document.getElementById("lineChart");
            var myChart = new Chart(ctx, {
              type: 'line',
              data: {
                labels: [],
                datasets:  [{
                      label: "My First dataset",
                      backgroundColor: "rgba(38, 185, 154, 0.31)",
                      borderColor: "rgba(38, 185, 154, 0.7)",
                      pointBorderColor: "rgba(38, 185, 154, 0.7)",
                      pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
                      pointHoverBackgroundColor: "#fff",
                      pointHoverBorderColor: "rgba(220,220,220,1)",
                      pointBorderWidth: 1,
                      data: []
                      }, {
                      label: "My Second dataset",
                      backgroundColor: "rgba(3, 88, 106, 0.3)",
                      borderColor: "rgba(3, 88, 106, 0.70)",
                      pointBorderColor: "rgba(3, 88, 106, 0.70)",
                      pointBackgroundColor: "rgba(3, 88, 106, 0.70)",
                      pointHoverBackgroundColor: "#fff",
                      pointHoverBorderColor: "rgba(151,187,205,1)",
                      pointBorderWidth: 1,
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

            getDataline();
            // get new data every 3 seconds
            var getDataInterval = setInterval(getDataline, 15000);
            $("body").on( "click", ".lineStatus", function() {
              clearInterval(getDataInterval);
              var link_name = $(this).attr('data-time')
              $( ".lineStatus" ).removeClass( "active_tab" );
              $(this).addClass( "active_tab" );
              getDataInterval = setInterval(getDataline,link_name*1000);
            });
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
              var myChart = new Chart(ctx_live, {
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

            // logic to get new data
            var getData = function() {
              $.ajax({
                url: '/hourly-calls',
                success: function(data) {
                  $('#loadingbar').hide();
                  myChart.data.labels==data.data.hrs_calls;
                  myChart.data.datasets[0].data=data.data.count_arr;
                  // re-render the chart
                  myChart.update();
                }
              });
            };

        getData();
      // get new data every 3 seconds
      setInterval(getData,10000);
    }
   }
}
jQuery(document).ready(function($){


      tempData = [];
         init_charts_home('mybarChart',tempData);
         init_charts_home('lineChart',tempData);
         init_recent_table('mybarChart');
         init_active_table('lineChart');


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
