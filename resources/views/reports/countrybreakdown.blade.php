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
<div class="row" id="websitecallsummary">
        <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="">
                        <div class="x_title">
                            <h2>Country Station Breakdown <small> </small></h2>
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

                                    <div class='col-sm-3'>

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Month</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                              <select class="form-control" id='gMonth2'>
                                                  <option selected value='1'>Janaury</option>
                                                  <option value='2'>February</option>
                                                  <option value='3'>March</option>
                                                  <option value='4'>April</option>
                                                  <option value='5'>May</option>
                                                  <option value='6'>June</option>
                                                  <option value='7'>July</option>
                                                  <option value='8'>August</option>
                                                  <option value='9'>September</option>
                                                  <option value='10'>October</option>
                                                  <option value='11'>November</option>
                                                  <option value='12' selected>December</option>
                                              </select>
                                            </div>
                                          </div>
                                    </div>
                                    <div class='col-sm-3'>

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Year</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                              <select class="form-control" id='gtYear2' >
                                                  <option selected value='2004'>2004</option>
                                                  <option value='2005'>2005</option>
                                                  <option value='2006'>2006</option>
                                                  <option value='2007'>2007</option>
                                                  <option value='2008'>2008</option>
                                                  <option value='2009'>2009</option>
                                                  <option value='2010'>2010</option>
                                                  <option value='2011'>2011</option>
                                                  <option value='2012'>2012</option>
                                                  <option value='2013'>2013</option>
                                                  <option value='2014'>2014</option>
                                                  <option value='2015'>2015</option>
                                                  <option value='2016'>2016</option>
                                                  <option value='2017'>2017</option>
                                                  <option value='2018' selected>2018</option>
                                                  <option value='2019'>2019</option>
                                              </select>
                                            </div>
                                          </div>
                                        </div>

                                  <div class='col-sm-3'>
                                      <div class="form-group" >
                                              <div class='input-group'>
                                       <button type="submit" id= "submitBtn" class="btn btn-success">Filter</button>
                                   </div>
                              </div>
                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="x_panel"  style="min-height: 100vh;">
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
                           <th class="column-title" colspan="9"> <center> <span id="selectedMonth"></span>Country Station Breakdown </center></th>
                          </tr>
                        </thead>
                      </table>

                    </div>
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                          <p class="text-muted font-13 m-b-30">

                          </p>

                          <table id="datatable-keytable1" class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                    <th class="column-title">Date </th>
                                    <th class="column-title"> 	Total Posts</th>
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

    $("#websitecallsummary").on( "click", "#submitBtn", function() {

                  var gMonth2= $("#gMonth2").val();
                  var gtYear2= $("#gtYear2").val();

                  getAjax("/country-mtd",gMonth2,gtYear2,true)
      });
});


function getAjax(url,report_month,report_year,flag){

var objData =  flag ? {"month":report_month,"year":report_year} :'';
// $('#datatable-keytable1').dataTable().fnClearTable();
// $('#datatable-keytable1').dataTable().fnDestroy();
$("#loadingbar").show();
$('#datatable-keytable_t').html("");
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
      //  var item = result.data.today_array;
      //   trHTML += '<tr><td>' + item.Web  + '</td><td>' + item.date + '</td><td>' + item.total_calls+ '</td><td>' + item.completed  + '</td><td>' + item.incomplete + '</td><td>' + item.per_comp+ '</td><td>' + item.per_incomp  + '</td><td>' + item.file_1 + '</td><td>' + item.file_2+ '</td><td>' + item.file_2 + '</td><td>' + item.Web+ '</td></tr>';
      //  var total_report = result.data.total_report[0];
      //  trHTML+= '<tr><td></td><td>' + total_report.totalcalls + '</td><td></td><td></td><td></td><td>' + total_report.PercentComplete+ '</td><td>' + total_report.PercentIncomplete  + '</td><td></td><td></td><td></td><td></td></tr>';
      //  $('#today_records_table_tr').html(trHTML);

       $.each(result.data, function(i, item) {
        trHTML1 += '<tr    data-Tracking_ID="'+item.Name+'" ><td>' + item.Name + '</td><td>' + item.Calls + '</td></tr>';
    });

    $('#datatable-keytable1').append(trHTML1);


    $('#datatable-keytable1').DataTable({
      dom: 'Blfrtip',
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        buttons: [
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],

    });

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