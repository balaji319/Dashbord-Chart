@extends('theme.default')

@section('title', 'Call-Q Reporting Service')
@section('content')
<div class="row">
        {{-- <h1 class="page-header">Home</h1> --}}
</div>

<!-- /.row -->
<div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="">
                        <div class="x_title">
                            <h2>Date Pickers <small> Available with multiple designs</small></h2>
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
                                        Only Date Picker
                                        <div class="form-group">
                                            <div class='input-group date' id='myDatepicker'>
                                                <input type='text' class="form-control" />
                                                <span class="input-group-addon">
                                                   <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='col-sm-4'>
                                            Only Date Picker
                                            <div class="form-group">
                                                <div class='input-group date' id='myDatepicker2'>
                                                    <input type='text' class="form-control" />
                                                    <span class="input-group-addon">
                                                       <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='col-sm-4'>
                                                <div class="form-group" style="margin-top: 3.5%;">
                                                        <div class='input-group'>
                                            <button type="submit" class="btn btn-success">Submit</button>
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
                      <table class="table table-striped jambo_table bulk_action">
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

                        <tbody>
                          <tr class="even pointer">

                            <td class=" ">Tue</td>
                            <td class=" ">Today</td>
                            <td class=" ">1411 </td>
                            <td class=" ">827</td>
                            <td class=" ">584</td>
                            <td >58.61%</td>
                            <td class=" ">41.39%</td>
                            <td class=" ">In Process </td>
                            <td class=" ">In Process</td>
                            <td class=" ">n Process</td>
                            <td >	In Process</td>

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

                              <table id="datatable-keytable" class="table table-striped table-bordered">
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


                                <tbody>
                                        <tr>
                                                <td class=" ">Tue</td>
                                                <td class=" ">Today</td>
                                                <td class=" ">1411 </td>
                                                <td class=" ">827</td>
                                                <td class=" ">584</td>
                                                <td >58.61%</td>
                                                <td class=" ">41.39%</td>
                                                <td class=" ">In Process </td>
                                                <td class=" ">In Process</td>
                                                <td class=" ">n Process</td>
                                                <td >	In Process</td>
                                          </tr>
                                          <tr>
                                                <td class=" ">Tue</td>
                                                <td class=" ">Today</td>
                                                <td class=" ">1411 </td>
                                                <td class=" ">827</td>
                                                <td class=" ">584</td>
                                                <td >58.61%</td>
                                                <td class=" ">41.39%</td>
                                                <td class=" ">In Process </td>
                                                <td class=" ">In Process</td>
                                                <td class=" ">n Process</td>
                                                <td >	In Process</td>
                                          </tr>
                                          <tr>
                                                <td class=" ">Tue</td>
                                                <td class=" ">Today</td>
                                                <td class=" ">1411 </td>
                                                <td class=" ">827</td>
                                                <td class=" ">584</td>
                                                <td >58.61%</td>
                                                <td class=" ">41.39%</td>
                                                <td class=" ">In Process </td>
                                                <td class=" ">In Process</td>
                                                <td class=" ">n Process</td>
                                                <td >	In Process</td>
                                          </tr>
                                          <tr>
                                                <td class=" ">Tue</td>
                                                <td class=" ">Today</td>
                                                <td class=" ">1411 </td>
                                                <td class=" ">827</td>
                                                <td class=" ">584</td>
                                                <td >58.61%</td>
                                                <td class=" ">41.39%</td>
                                                <td class=" ">In Process </td>
                                                <td class=" ">In Process</td>
                                                <td class=" ">n Process</td>
                                                <td >	In Process</td>
                                          </tr>
                                          <tr>
                                                <td class=" ">Tue</td>
                                                <td class=" ">Today</td>
                                                <td class=" ">1411 </td>
                                                <td class=" ">827</td>
                                                <td class=" ">584</td>
                                                <td >58.61%</td>
                                                <td class=" ">41.39%</td>
                                                <td class=" ">In Process </td>
                                                <td class=" ">In Process</td>
                                                <td class=" ">n Process</td>
                                                <td >	In Process</td>
                                          </tr>
                                          <tr>
                                                <td class=" ">Tue</td>
                                                <td class=" ">Today</td>
                                                <td class=" ">1411 </td>
                                                <td class=" ">827</td>
                                                <td class=" ">584</td>
                                                <td >58.61%</td>
                                                <td class=" ">41.39%</td>
                                                <td class=" ">In Process </td>
                                                <td class=" ">In Process</td>
                                                <td class=" ">n Process</td>
                                                <td >	In Process</td>
                                          </tr>
                                          <tr>
                                                <td class=" ">Tue</td>
                                                <td class=" ">Today</td>
                                                <td class=" ">1411 </td>
                                                <td class=" ">827</td>
                                                <td class=" ">584</td>
                                                <td >58.61%</td>
                                                <td class=" ">41.39%</td>
                                                <td class=" ">In Process </td>
                                                <td class=" ">In Process</td>
                                                <td class=" ">n Process</td>
                                                <td >	In Process</td>
                                          </tr>
                                          <tr>
                                                <td class=" ">Tue</td>
                                                <td class=" ">Today</td>
                                                <td class=" ">1411 </td>
                                                <td class=" ">827</td>
                                                <td class=" ">584</td>
                                                <td >58.61%</td>
                                                <td class=" ">41.39%</td>
                                                <td class=" ">In Process </td>
                                                <td class=" ">In Process</td>
                                                <td class=" ">n Process</td>
                                                <td >	In Process</td>
                                          </tr>
                                          <tr>
                                                <td class=" ">Tue</td>
                                                <td class=" ">Today</td>
                                                <td class=" ">1411 </td>
                                                <td class=" ">827</td>
                                                <td class=" ">584</td>
                                                <td >58.61%</td>
                                                <td class=" ">41.39%</td>
                                                <td class=" ">In Process </td>
                                                <td class=" ">In Process</td>
                                                <td class=" ">n Process</td>
                                                <td >	In Process</td>
                                          </tr>
                                          <tr>
                                                <td class=" ">Tue</td>
                                                <td class=" ">Today</td>
                                                <td class=" ">1411 </td>
                                                <td class=" ">827</td>
                                                <td class=" ">584</td>
                                                <td >58.61%</td>
                                                <td class=" ">41.39%</td>
                                                <td class=" ">In Process </td>
                                                <td class=" ">In Process</td>
                                                <td class=" ">n Process</td>
                                                <td >	In Process</td>
                                          </tr>
                                          <tr>
                                                <td class=" ">Tue</td>
                                                <td class=" ">Today</td>
                                                <td class=" ">1411 </td>
                                                <td class=" ">827</td>
                                                <td class=" ">584</td>
                                                <td >58.61%</td>
                                                <td class=" ">41.39%</td>
                                                <td class=" ">In Process </td>
                                                <td class=" ">In Process</td>
                                                <td class=" ">n Process</td>
                                                <td >	In Process</td>
                                          </tr>
                                          <tr>
                                                <td class=" ">Tue</td>
                                                <td class=" ">Today</td>
                                                <td class=" ">1411 </td>
                                                <td class=" ">827</td>
                                                <td class=" ">584</td>
                                                <td >58.61%</td>
                                                <td class=" ">41.39%</td>
                                                <td class=" ">In Process </td>
                                                <td class=" ">In Process</td>
                                                <td class=" ">n Process</td>
                                                <td >	In Process</td>
                                          </tr>
                                          <tr>
                                                <td class=" ">Tue</td>
                                                <td class=" ">Today</td>
                                                <td class=" ">1411 </td>
                                                <td class=" ">827</td>
                                                <td class=" ">584</td>
                                                <td >58.61%</td>
                                                <td class=" ">41.39%</td>
                                                <td class=" ">In Process </td>
                                                <td class=" ">In Process</td>
                                                <td class=" ">n Process</td>
                                                <td >	In Process</td>
                                          </tr>
                                          <tr>
                                                <td class=" ">Tue</td>
                                                <td class=" ">Today</td>
                                                <td class=" ">1411 </td>
                                                <td class=" ">827</td>
                                                <td class=" ">584</td>
                                                <td >58.61%</td>
                                                <td class=" ">41.39%</td>
                                                <td class=" ">In Process </td>
                                                <td class=" ">In Process</td>
                                                <td class=" ">n Process</td>
                                                <td >	In Process</td>
                                          </tr>
                                          <tr>
                                                <td class=" ">Tue</td>
                                                <td class=" ">Today</td>
                                                <td class=" ">1411 </td>
                                                <td class=" ">827</td>
                                                <td class=" ">584</td>
                                                <td >58.61%</td>
                                                <td class=" ">41.39%</td>
                                                <td class=" ">In Process </td>
                                                <td class=" ">In Process</td>
                                                <td class=" ">n Process</td>
                                                <td >	In Process</td>
                                          </tr>
                                          <tr>
                                                <td class=" ">Tue</td>
                                                <td class=" ">Today</td>
                                                <td class=" ">1411 </td>
                                                <td class=" ">827</td>
                                                <td class=" ">584</td>
                                                <td >58.61%</td>
                                                <td class=" ">41.39%</td>
                                                <td class=" ">In Process </td>
                                                <td class=" ">In Process</td>
                                                <td class=" ">n Process</td>
                                                <td >	In Process</td>
                                          </tr>
                                  <tr>
                                        <td class=" ">Tue</td>
                                        <td class=" ">Today</td>
                                        <td class=" ">1411 </td>
                                        <td class=" ">827</td>
                                        <td class=" ">584</td>
                                        <td >58.61%</td>
                                        <td class=" ">41.39%</td>
                                        <td class=" ">In Process </td>
                                        <td class=" ">In Process</td>
                                        <td class=" ">n Process</td>
                                        <td >	In Process</td>
                                  </tr>
                                  <tr>
                                        <td class=" ">Tue</td>
                                        <td class=" ">Today</td>
                                        <td class=" ">1411 </td>
                                        <td class=" ">827</td>
                                        <td class=" ">584</td>
                                        <td >58.61%</td>
                                        <td class=" ">41.39%</td>
                                        <td class=" ">In Process </td>
                                        <td class=" ">In Process</td>
                                        <td class=" ">n Process</td>
                                        <td >	In Process</td>
                                  </tr>
                                  <tr>
                                        <td class=" ">Tue</td>
                                        <td class=" ">Today</td>
                                        <td class=" ">1411 </td>
                                        <td class=" ">827</td>
                                        <td class=" ">584</td>
                                        <td >58.61%</td>
                                        <td class=" ">41.39%</td>
                                        <td class=" ">In Process </td>
                                        <td class=" ">In Process</td>
                                        <td class=" ">n Process</td>
                                        <td >	In Process</td>
                                  </tr>
                                  <tr>
                                        <td class=" ">Tue</td>
                                        <td class=" ">Today</td>
                                        <td class=" ">1411 </td>
                                        <td class=" ">827</td>
                                        <td class=" ">584</td>
                                        <td >58.61%</td>
                                        <td class=" ">41.39%</td>
                                        <td class=" ">In Process </td>
                                        <td class=" ">In Process</td>
                                        <td class=" ">n Process</td>
                                        <td >	In Process</td>
                                  </tr>
                                </tbody>
                              </table>
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
      $('#myDatepicker2').datetimepicker({
        format: 'DD.MM.YYYY'
      });
      $('#myDatepicker').datetimepicker({
        format: 'DD.MM.YYYY'
    });
});


jQuery(document).ready(function($){


      var myUrl = "/executive-report";
      getAjax(myUrl);


});

function getAjax(url){

$.ajax({url: url, success: function(result){
 

  //init_charts_home('mybarChart',result);
    console.log(result.data)
    // myChart.data.labels.push("Post " + postId++);
    // myChart.data.datasets[0].data.push(getRandomIntInclusive(1, 25));

    // // re-render the chart
    // myChart.update();

  }});
}

      </script>



@endsection