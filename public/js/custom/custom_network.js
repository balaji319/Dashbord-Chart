$(document).ready(function () {
    var dateNow = new Date();
    $('#myDatepicker2').datetimepicker({
        format: 'MM/DD/YYYY ',
        defaultDate: dateNow
    });
    $('#myDatepicker').datetimepicker({
        format: 'MM/DD/YYYY ',
        defaultDate: dateNow
    });

    $("#networkcallsummary").on("click", "#submitBtn", function () {

        var gMonth2 = $("#gMonth2").val();
        var gtYear2 = $("#gtYear2").val();
        var gtCampaign2 = $("#gtCampaign2").val();
        $("#selectedMonth").html($("#gMonth2 option:selected").text())
        getAjax("/network-reports", gMonth2, gtYear2, gtCampaign2, true)
    });
});


jQuery(document).ready(function ($) {

    var myUrl = "/campaign-list";
    getAjaxCampaignList(myUrl);


});

function getAjaxCampaignList(url) {

    $.ajax({
        url: url,
        success: function (response) {

            var trHTML = "";
            $("#loadingbar").hide();
            $.each(response.data, function (i, item) {
                trHTML += "<option value = '" + item.CampaignID + " '>" + item.Name + " </option>";
            });
            $('#gtCampaign2').append(trHTML);

        }
    });
};

function getAjax(url, report_month, report_year, campaign_number, flag) {

    var objData = flag ? {
        "report_month": report_month,
        "report_year": report_year,
        "campaign_number": campaign_number
    } : '';
    // $('#datatable-keytable1').dataTable().fnClearTable();
    // $('#datatable-keytable1').dataTable().fnDestroy();
    $("#loadingbar").show();
    $('#datatable-keytable_t').html("");
    $("#datatable-keytable1 > tbody").empty();
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
            var int_completed = 0;
            var int_total_calls = 0;
            $.each(result.data, function (i, item) {
                int_total_calls = parseInt(int_total_calls) + parseInt(item.total);
                int_completed = parseInt(int_completed) + parseInt(item.completed);
                trHTML1 += '<tr  data-date="' + item.DayDate + '" ><td>' + item.day + '</td><td>' + item.total + '</td><td>' + item.completed + '</td></tr>';
            });
            trHTML1 += '<tr ><td>Total </td><td>' + int_total_calls + '</td><td>' + int_completed + '</td></tr>';
            $('#datatable-keytable1').append(trHTML1);

        }
    });
}
$("#executivecallsummary").on("click", ".tbl_row", function () {
    var var_date = $(this).attr('data-date');
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