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

              </div>
            </div> --}}
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel"style="min-height: 100vh;">
                  <div class="x_title">
                    <h2>Statistical Report <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>

                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      {{-- <div id="loadingadvert"  class="loading" >
                          <img  class="loading-image"  src="{!! asset('images/ajax-loader.gif') !!}"  alt="Loading..." />
                      </div> --}}
                    {{-- <canvas id="lineChart"></canvas> --}}

                    <div id="echart_line1" style="height:450px;"></div>
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

  var myChart ='';
  var echartLine ='';
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
        var theme = {
				  color: [
					  '#26B99A', '#34495E', '#BDC3C7', '#3498DB',
					  '#9B59B6', '#8abb6f', '#759c6a', '#bfd3b7'
				  ],

				  title: {
					  itemGap: 8,
					  textStyle: {
						  fontWeight: 'normal',
						  color: '#408829'
					  }
				  },

				  dataRange: {
					  color: ['#1f610a', '#97b58d']
				  },

				  toolbox: {
					  color: ['#408829', '#408829', '#408829', '#408829']
				  },

				  tooltip: {
					  backgroundColor: 'rgba(0,0,0,0.5)',
					  axisPointer: {
						  type: 'line',
						  lineStyle: {
							  color: '#408829',
							  type: 'dashed'
						  },
						  crossStyle: {
							  color: '#408829'
						  },
						  shadowStyle: {
							  color: 'rgba(200,200,200,0.3)'
						  }
					  }
				  },

				  dataZoom: {
					  dataBackgroundColor: '#eee',
					  fillerColor: 'rgba(64,136,41,0.2)',
					  handleColor: '#408829'
				  },
				  grid: {
					  borderWidth: 0
				  },

				  categoryAxis: {
					  axisLine: {
						  lineStyle: {
							  color: '#408829'
						  }
					  },
					  splitLine: {
						  lineStyle: {
							  color: ['#eee']
						  }
					  }
				  },

				  valueAxis: {
					  axisLine: {
						  lineStyle: {
							  color: '#408829'
						  }
					  },
					  splitArea: {
						  show: true,
						  areaStyle: {
							  color: ['rgba(250,250,250,0.1)', 'rgba(200,200,200,0.1)']
						  }
					  },
					  splitLine: {
						  lineStyle: {
							  color: ['#eee']
						  }
					  }
				  },
				  timeline: {
					  lineStyle: {
						  color: '#408829'
					  },
					  controlStyle: {
						  normal: {color: '#408829'},
						  emphasis: {color: '#408829'}
					  }
				  },

				  k: {
					  itemStyle: {
						  normal: {
							  color: '#68a54a',
							  color0: '#a9cba2',
							  lineStyle: {
								  width: 1,
								  color: '#408829',
								  color0: '#86b379'
							  }
						  }
					  }
				  },
				  map: {
					  itemStyle: {
						  normal: {
							  areaStyle: {
								  color: '#ddd'
							  },
							  label: {
								  textStyle: {
									  color: '#c12e34'
								  }
							  }
						  },
						  emphasis: {
							  areaStyle: {
								  color: '#99d2dd'
							  },
							  label: {
								  textStyle: {
									  color: '#c12e34'
								  }
							  }
						  }
					  }
				  },
				  force: {
					  itemStyle: {
						  normal: {
							  linkStyle: {
								  strokeColor: '#408829'
							  }
						  }
					  }
				  },
				  chord: {
					  padding: 4,
					  itemStyle: {
						  normal: {
							  lineStyle: {
								  width: 1,
								  color: 'rgba(128, 128, 128, 0.5)'
							  },
							  chordStyle: {
								  lineStyle: {
									  width: 1,
									  color: 'rgba(128, 128, 128, 0.5)'
								  }
							  }
						  },
						  emphasis: {
							  lineStyle: {
								  width: 1,
								  color: 'rgba(128, 128, 128, 0.5)'
							  },
							  chordStyle: {
								  lineStyle: {
									  width: 1,
									  color: 'rgba(128, 128, 128, 0.5)'
								  }
							  }
						  }
					  }
				  },
				  gauge: {
					  startAngle: 225,
					  endAngle: -45,
					  axisLine: {
						  show: true,
						  lineStyle: {
							  color: [[0.2, '#86b379'], [0.8, '#68a54a'], [1, '#408829']],
							  width: 8
						  }
					  },
					  axisTick: {
						  splitNumber: 10,
						  length: 12,
						  lineStyle: {
							  color: 'auto'
						  }
					  },
					  axisLabel: {
						  textStyle: {
							  color: 'auto'
						  }
					  },
					  splitLine: {
						  length: 18,
						  lineStyle: {
							  color: 'auto'
						  }
					  },
					  pointer: {
						  length: '90%',
						  color: 'auto'
					  },
					  title: {
						  textStyle: {
							  color: '#333'
						  }
					  },
					  detail: {
						  textStyle: {
							  color: 'auto'
						  }
					  }
				  },
				  textStyle: {
					  fontFamily: 'Arial, Verdana, sans-serif'
				  }
			  };
 echartLine = echarts.init(document.getElementById('echart_line'), theme);

echartLine.setOption({
title: {
  text: 'Statistical Report',
  subtext: ''
},
tooltip: {
  trigger: 'axis'
},
legend: {
  x: 220,
  y: 40,
  data: ['Intent', 'Pre-order', 'Deal']
},
toolbox: {
  show: true,
  feature: {
  magicType: {
    show: true,
    title: {
    line: 'Line',
    bar: 'Bar',
    stack: 'Stack',
    tiled: 'Tiled'
    },
    type: ['line', 'bar', 'stack', 'tiled']
  },
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
calculable: true,
xAxis: [{
  type: 'category',
  boundaryGap: false,
  data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
}],
yAxis: [{
  type: 'value'
}],
series: [{
  name: 'Deal',
  type: 'line',
  smooth: true,
  itemStyle: {
  normal: {
    areaStyle: {
    type: 'default'
    }
  }
  },
  data: [10, 12, 21, 54, 260, 830, 710]
}, {
  name: 'Pre-order',
  type: 'line',
  smooth: true,
  itemStyle: {
  normal: {
    areaStyle: {
    type: 'default'
    }
  }
  },
  data: [30, 182, 434, 791, 390, 30, 10]
}, {
  name: 'Intent',
  type: 'line',
  smooth: true,
  itemStyle: {
  normal: {
    areaStyle: {
    type: 'default'
    }
  }
  },
  data: [1320, 1132, 601, 234, 120, 90, 20]
}]
});




           var ctx = document.getElementById("lineChart");
             myChart = new Chart(ctx, {
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
                      },{
                      label: "My dataset",
                      backgroundColor: "rgba(30, 8, 06, 0.5)",
                      borderColor: "rgba(30, 8, 16, 0.70)",
                      pointBorderColor: "rgba(30, 18, 16, 0.70)",
                      pointBackgroundColor: "rgba(13, 98, 06, 0.70)",
                      pointHoverBackgroundColor: "#fff",
                      pointHoverBorderColor: "rgba(51,17,25,1)",
                      pointBorderWidth: 1,
                      data: []
                      }]

              },
              options: {
                responsive: true,
                title: {
                  display: true,
                  text: "Statistical Comparison History",
                },
                legend: {
                  display: false
                },
                scales: {
                  yAxes: [{
                    ticks: {
                              min:0

                          }
                  }],
                  xAxes: [{
                    ticks: {
                      beginAtZero:true,
                      ticks: {
                            autoSkip: false
                          }
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




      }

      }
}
jQuery(document).ready(function($){

    var myUrl = "/statistics";
      getAjax(myUrl);
      tempData = [];

         init_charts_home('lineChart',tempData);



});

function getAjax(url){
  var myChart1 = echarts.init(document.getElementById('echart_line1'));

// loading---------------------
myChart1.showLoading({
    text: "please wait!!!... ",
});

  $.ajax({url: url, success: function(result){
    //init_charts_home('mybarChart',result);
     // $("#loadingadvert").hide();
      var arrayData = result.data.days_array;
      arrayData.unshift(arrayData[arrayData.length -1]);
      arrayData.pop();
     // myChart.data.labels= arrayData;
      var arrayData1 = result.data.fourteen_array;
      arrayData1.unshift(arrayData1[arrayData1.length -1]);
      arrayData1.pop();
    //  myChart.data.datasets[0].data=arrayData1;
         var arrayData2 = result.data.twenty_one_array;
      arrayData2.unshift(arrayData2[arrayData2.length -1]);
      arrayData2.pop();
     // myChart.data.datasets[1].data=arrayData2;
      var arrayData3 = result.data.week_array;
      arrayData3.unshift(arrayData3[arrayData3.length -1]);
      arrayData3.pop();
     // myChart.data.datasets[1].data=arrayData3;


    // //               // re-render the chart
    //   myChart.update();

// ajax getting data...............

// ajax callback
myChart1.hideLoading();


// use the chart-------------------
var option =



{
title: {
  text: 'Statistical Report',
  subtext: ''
},
tooltip: {
  trigger: 'axis'
},
legend: {
  x: 420,
  y: 20,
  data: ['0-7 Days', '07-14 Days','14-21 Days']
},
toolbox: {
  show: true,
  feature: {
  magicType: {
    show: true,
    title: {
    line: 'Line',
    bar: 'Bar',
    stack: 'Stack',
    tiled: 'Tiled'
    },
    type: ['line', 'bar', 'stack', 'tiled']
  },
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
  data: arrayData
}],
yAxis: [{
  type: 'value'
}],
series: [{
  name: '0-7 Days',
  type: 'line',
  itemStyle: {
  normal: {
    areaStyle: {
    type: 'default'
    }
  }
  },
  data: arrayData1
}, {
  name: '07-14 Days',
  type: 'line',
  itemStyle: {
  normal: {
    areaStyle: {
    type: 'default'
    }
  }
  },
  data: arrayData2
}, {
  name: '14-21 Days',
  type: 'line',
  itemStyle: {
  normal: {
    areaStyle: {
    type: 'default'
    }
  }
  },
  data: arrayData3
}]
}

myChart1.setOption(option);

}});
}

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
