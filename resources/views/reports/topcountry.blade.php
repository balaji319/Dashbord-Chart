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
<div class="row" id="Countriessummary">
        <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel"  style="height: 100vh;">
                        <div class="x_title">
                            <h2>Top Countries <small> </small></h2>
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

                      <div class="table-responsive">
                          <table class="table table-striped jambo_table bulk_action" id="today_records_table">
                            <thead>
                              <tr class="headings">
                              <th class="column-title" colspan="9"> <center> <span id="selectedMonth"></span>PUFC Top 25 Countries Report Graph  <span id="selectDate"></span> </center></th>
                              </tr>
                            </thead>
                          </table>

                        </div>
                        <div class="col-sm-12">
                            <div  class="loading" id="loadingbar" >
                                <img   class="loading-image"  src="{!! asset('images/ajax-loader.gif') !!}"  alt="Loading..." />
                            </div>

                          <canvas id="CountriesbarChart" height="100px"></canvas>
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
      $("#loadingbar").hide();
      var dateNow = new Date();
      $('#myDatepicker2').datetimepicker({
        format: 'MM/DD/YYYY ',
        defaultDate:dateNow
      });
      $('#myDatepicker').datetimepicker({
        format: 'MM/DD/YYYY ',
        defaultDate:dateNow
    });

    $("#Countriessummary").on( "click", "#submitBtn", function() {

                  var startDate= $("#datepickerVal").val();
                  var endDate= $("#datepickerVal1").val();
                  getAjax("/top-countries",startDate,endDate,true)
      });

      var myUrl = "/top-countries";
        getAjax(myUrl);
        });


function getAjax(url,startDate,endDate,flag){

var objData =  flag ? {"startdate":startDate,"enddate":endDate} :'';
// $('#datatable-keytable1').dataTable().fnClearTable();
// $('#datatable-keytable1').dataTable().fnDestroy();
$("#loadingbar").show();

$.ajax({
      url: url,
      type: "get",
      data:objData,
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
      success: function(response){

       $("#loadingbar").hide();
                  myChart2.data.labels=response.data.City ;
                  myChart2.data.datasets[0].data=response.data.CallCount;
                   $("#selectDate").html("("+$("#datepickerVal").val()+" to  "+$("#datepickerVal1").val()+")")  
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
      if(type=='CountriesbarChart'){
        // Bar chart
         if ($('#CountriesbarChart').length ){

              function getRandomIntInclusiveArray(len) {
                var arr = [];
              for (var i = 0, l = len; i < l; i++) {
                  arr.push(Math.round(Math.random() * l))
              }
              return arr;
              }
              // create initial empty chart
              var ctx_live = document.getElementById("CountriesbarChart");
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
                    text: "Top 25 Countries (Web Requests Included) ",
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
jQuery(document).ready(function($){
      var tempData='';

         init_charts_home('CountriesbarChart');



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