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
     var is_zero = total_report.totalcalls==null ? '0':total_report.totalcalls;
     var is_CompletedCalls = total_report.CompletedCalls==null ? '':total_report.CompletedCalls;
     var is_Hangups = total_report.Hangups==null ? '':total_report.Hangups;
     var is_File1 = total_report.file1==null ? '':total_report.file1;
     var is_File2 = total_report.File2==null ? '':total_report.File2;
     var is_File3 = total_report.File3==null ? '':total_report.File3;
     var is_Web = total_report.web==null ? '':total_report.web;
     trHTML+= '<tr><td></td><td>	Totals</td><td>' + is_zero  + '</td><td>' + is_CompletedCalls + '</td><td>' + is_Hangups + '</td><td>' + total_report.PercentComplete+ '</td><td>' + total_report.PercentIncomplete  + '</td><td>' + is_File1 + '</td><td>' + is_File2 + '</td><td>' + is_File3 + '</td><td>' + is_Web+ '</td></tr>';
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

                $('#loadingtable1').show();
                $('#loadingadvert').show();
                $('#loadingmybarChart1').show();
                $('#loadingtable').show();
                myChart.data.datasets[0].data=[];
                // re-render the chart
                myChart2.data.datasets[0].data=[];
                myChart1.data.labels=[];
                myChart1.data.datasets[0].data=[];
                myChart1.data.datasets.backgroundColor= [];

                myChart.update();
                myChart2.update();
                myChart1.update();
    $(".selectedDate").text($(this).attr('data-date'))
           $.ajax({
                url: '/details-executive-report',
                data:var_date,
                success: function(response) {
                      var trHTML = '';
                      $('#loadingtable1').hide();
                      $('#loadingadvert').hide();
                      $('#loadingmybarChart1').hide();
                      $('#loadingtable').hide();

                      $.each(response.data.get_stations, function(i, item) {

                      trHTML += '<tr><td>' + item.Name  + '</td><td>' + item.Campaign + '</td><td>' + item.Calls+ ' </td><td>' + item.Completed+ ' </td></tr>';
                });
                $('#records_table1').append(trHTML);

                myChart.data.datasets[0].data=response.data.smallbarchart;
                // re-render the chart
                myChart2.data.labels=response.data.get_cities.Location;
                myChart2.data.datasets[0].data=response.data.get_cities.calls;
                myChart1.data.labels=response.data.get_countries.Geography;
                myChart1.data.datasets[0].data=response.data.get_countries.calls;
                myChart1.data.datasets.backgroundColor= getRandomColor(3);

                myChart.update();
                myChart2.update();
                myChart1.update();
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
var myChart1='';
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
                      labels: [],
                      datasets: [
                            {
                                  data: [],
                                  backgroundColor:[]
                            }]
                      };
             myChart1 = new Chart(ctx_live1, {
              type: 'pie',
              data: oilData
            });
    //  getData();
    // get new data every 3 seconds
    //setInterval(getData,10000);
  }
 }


}
function getRandomColor(len) {
          var arr = [];
          for (var i = 0; i < len; i++) {

              arr.push('rgb(' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ')')
          }
          return arr;
          }
jQuery(document).ready(function($){
    var tempData='';

       init_charts_home('mybarChart',tempData);
       init_charts_home('lineChart',tempData);
       init_charts_home('mybarChart1',tempData);
       init_active_table();


});