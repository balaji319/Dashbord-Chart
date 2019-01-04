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

    $("#Countriessummary").on("click", "#submitBtn", function () {

        var startDate = $("#datepickerVal").val();
        var endDate = $("#datepickerVal1").val();
        getAjax("/top-cities", startDate, endDate, true)
        $("#selectDate").html("(" + startDate + " to  " + endDate + ")")
    });

    var myUrl = "/top-cities";
    getAjax(myUrl);
});


function getAjax(url, startDate, endDate, flag) {

    var objData = flag ? {
        "startdate": startDate,
        "enddate": endDate
    } : '';
    // $('#datatable-keytable1').dataTable().fnClearTable();
    // $('#datatable-keytable1').dataTable().fnDestroy();
    $("#loadingbar").show();

    $.ajax({
        url: url,
        type: "get",
        data: objData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {

            $("#loadingbar").hide();
            $("#selectDate").html("(" + $("#datepickerVal").val() + " to  " + $("#datepickerVal1").val() + ")")

            myChart2.data.labels = response.data.City;
            myChart2.data.datasets[0].data = response.data.CallCount;
            //myChart2.options.title.text="aaaaaaaaaa";
            myChart2.update();


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

var myChart2 = '';

function init_charts_home(type, data) {
    console.log('run_charts  typeof [' + typeof (Chart) + ']');
    if (typeof (Chart) === 'undefined') {
        return;
    }
    console.log('init_charts');
    Chart.defaults.global.legend = {
        enabled: false
    };
    if (type == 'CountriesbarChart') {
        // Bar chart
        if ($('#CountriesbarChart').length) {

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
                        text: "Top 25 Cities For  ",
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
jQuery(document).ready(function ($) {
    var tempData = '';
    init_charts_home('CountriesbarChart');
});