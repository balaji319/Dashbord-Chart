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

        getAjax("/website-summery", gMonth2, gtYear2, true)
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

            $("#loadingbar").hide();
            $("#total_value").text(result.data[0].Completed);


        }
    });
}
$("#executivecallsummary").on("click", ".tbl_row", function () {
    var var_date = $(this).attr('data-date')
    $.ajax({
        url: '/details-executive-report',
        dara: var_date,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            var trHTML = '';
            $('#loadingtable1').hide();
            $.each(response.data, function (i, item) {
                trHTML += '<tr><td>' + item.Name + '</td><td>' + item.Calls + '</td><td>' + item.LastCall + '</td></tr>';
            });
            $('#records_table1').append(trHTML);

        }
    });
});