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

  $("body").on( "click", "#submitBtn", function() {

                  getAjax("/hourly/log",$("#datepickerVal").val(),$("#gtCampaign2").val(),true);
    });
});


jQuery(document).ready(function($){
$("#loadingtable").show();
   getAjaxCampaignList('/campaign-list');
   init_charts_home('HourlChart');

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
                  var startDate= $("#datepickerVal").val();
                  var gtCampaign2= $("#gtCampaign2").val();
                  getAjax("/hourly/log",startDate,gtCampaign2,true);
}});
};

function getAjax(url,startDate,campaign_id,flag){

var objData =  {"start_date":startDate,"campaign_id":campaign_id} ;
// $('#datatable-keytable1').dataTable().fnClearTable();
// $('#datatable-keytable1').dataTable().fnDestroy();
$("#loadingtable").show();

$.ajax({
    url: url,
    type: "get",
    data:objData,
    headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
    success: function(response){
                //myChart2.data.labels=response.data.City ;
                myChart2.data.datasets[0].data=response.data.hangups_data;
        $("#loadingtable").hide();
                myChart2.update();
                myChart2.options.title.text='Top 25 Cities For 12/01/2018 - 12/27/2018';
                myChart2.update();

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



var myChart2 ='';
function init_charts_home(type,data) {
      console.log('run_charts  typeof [' + typeof (Chart) + ']');
      if( typeof (Chart) === 'undefined'){ return; }
       console.log('init_charts');
      Chart.defaults.global.legend = {
        enabled: false
      };
    if(type=='HourlChart'){
      // Bar chart
       if ($('#HourlChart').length ){

            function getRandomIntInclusiveArray(len) {
              var arr = [];
            for (var i = 0, l = len; i < l; i++) {
                arr.push(Math.round(Math.random() * l))
            }
            return arr;
            }
            // create initial empty chart
            var ctx_live = document.getElementById("HourlChart");
            var labelArray = [];
            for (var i = 0, l = 24; i < l; i++) {
              labelArray.push(i)
            }
             myChart2 = new Chart(ctx_live, {
              type: 'line',
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
                  display: true,
                  text: "Top Hourly Records  ",
                },
                legend: {
                  display: false
                },
                scales: {
                  yAxes: [{


                  }]
                }

              }
            });

  }
 }


}