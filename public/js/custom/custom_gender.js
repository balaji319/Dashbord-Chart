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

        var startDate = $("#datepickerVal").val();
        var endDate = $("#datepickerVal1").val();
        var gtCampaign2 = $("#gtCampaign2").val();
        $("#selectedMonth").html($("#gMonth2 option:selected").text())
        getAjax("/gender-report", startDate, endDate, gtCampaign2, true)
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

function getAjax(url, startDate, endDate, campaign_number, flag) {

    var objData = flag ? {
        "startdate": startDate,
        "enddate": endDate,
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
            var myChart11 = echarts.init(document.getElementById('echart_line1'));
            // use the chart-------------------
            var voption = ({
                tooltip: {
                    trigger: 'item',
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },
                legend: {
                    x: 'center',
                    y: 'bottom',
                    data: ['Direct Access', 'E-mail Marketing', 'Union Ad', 'Video Ads']
                },
                toolbox: {
                    show: true,
                    feature: {
                        magicType: {
                            show: true,
                            type: ['pie', 'funnel'],
                            option: {
                                funnel: {
                                    x: '25%',
                                    width: '50%',
                                    funnelAlign: 'left',
                                    max: 1548
                                }
                            }
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
                series: [{
                    name: '访问来源',
                    type: 'pie',
                    radius: '55%',
                    center: ['50%', '48%'],
                    data: [{
                        value: result.data.Calls[0],
                        name: result.data.Gender[0]
                    }, {
                        value: result.data.Calls[1],
                        name: result.data.Gender[1]
                    }, {
                        value: result.data.Calls[2],
                        name: result.data.Gender[2]
                    }, {
                        value: result.data.Calls[3],
                        name: result.data.Gender[3]
                    }]
                }]
            });


            var dataStyle = {
                normal: {
                    label: {
                        show: false
                    },
                    labelLine: {
                        show: false
                    }
                }
            };

            var placeHolderStyle = {
                normal: {
                    color: 'rgba(0,0,0,0)',
                    label: {
                        show: false
                    },
                    labelLine: {
                        show: false
                    }
                },
                emphasis: {
                    color: 'rgba(0,0,0,0)'
                }
            };
            myChart11.setOption(voption);

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