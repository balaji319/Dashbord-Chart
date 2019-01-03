$(document).ready(function () {
    $("#loadingbar").hide();
    var dateNow = new Date();
    $('#myDatepicker2').datetimepicker({
        format: 'MM/DD/YYYY ',
        defaultDate: dateNow
    });
    $('#myDatepicker').datetimepicker({
        format: 'MM/DD/YYYY ',
        defaultDate: dateNow
    });

    $("#websitecallsummary").on("click", "#submitBtn", function () {

        var gMonth2 = $("#gMonth2").val();
        var gtYear2 = $("#gtYear2").val();

        getAjax("/country-mtd", gMonth2, gtYear2, true)
    });
});


function getAjax(url, report_month, report_year, flag) {

    var objData = flag ? {
        "month": report_month,
        "year": report_year
    } : '';
    // $('#datatable-keytable1').dataTable().fnClearTable();
    // $('#datatable-keytable1').dataTable().fnDestroy();
    $("#loadingbar").show();
    $('#datatable-keytable_t').html("");
    $.ajax({
        url: url,
        type: "get",
        data: objData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (result) {

            var trHTML = '';
            var trHTML1 = '';
            $("#loadingbar").hide();
            //  var item = result.data.today_array;
            //   trHTML += '<tr><td>' + item.Web  + '</td><td>' + item.date + '</td><td>' + item.total_calls+ '</td><td>' + item.completed  + '</td><td>' + item.incomplete + '</td><td>' + item.per_comp+ '</td><td>' + item.per_incomp  + '</td><td>' + item.file_1 + '</td><td>' + item.file_2+ '</td><td>' + item.file_2 + '</td><td>' + item.Web+ '</td></tr>';
            //  var total_report = result.data.total_report[0];
            //  trHTML+= '<tr><td></td><td>' + total_report.totalcalls + '</td><td></td><td></td><td></td><td>' + total_report.PercentComplete+ '</td><td>' + total_report.PercentIncomplete  + '</td><td></td><td></td><td></td><td></td></tr>';
            //  $('#today_records_table_tr').html(trHTML);

            $.each(result.data, function (i, item) {
                trHTML1 += '<tr    data-Tracking_ID="' + item.Name + '" ><td>' + item.Name + '</td><td>' + item.Calls + '</td></tr>';
            });

            $('#datatable-keytable1').append(trHTML1);


            $('#datatable-keytable1').DataTable({
                dom: 'Blfrtip',
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                buttons: [
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ],

            });

        }
    });
}