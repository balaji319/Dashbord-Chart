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

    $("#executivecallsummary").on("click", "#submitBtn", function () {
        var startDate = $("#datepickerVal").val();
        getAjax("/call/comparison", startDate, true)
    });
});


jQuery(document).ready(function ($) {

    var myUrl = "/call/comparison";
    getAjax(myUrl);


});

function getAjax(url, startDate, flag) {

    var objData = flag ? {
        "start_date": startDate
    } : '';
    var myChart1 = echarts.init(document.getElementById('lineChart'));

    $("#loadingadvert").show();

    $.ajax({
        url: url,
        type: "get",
        data: objData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            var trHTML = '';
            var trHTML1 = '';
            $("#loadingadvert").hide();
            var labelArray = [];
            for (var i = 0, l = 25; i < l; i++) {
                labelArray.push(i)
            }
            // myChart.data.labels=labelArray;
            // myChart.data.datasets[0].data=response.data.todays.data;
            // myChart.data.datasets[1].data=response.data.before_seven_days.data;
            // myChart.data.datasets[2].data=response.data.before_fourteen_days.data;
            // myChart.update();






            var first_day = response.data.todays.data;
            var befor_seven_days = response.data.before_seven_days.data;
            var befor_forteen_days = response.data.before_fourteen_days.data;

            var lableArraydata = [response.data.todays.date, response.data.before_seven_days.date, response.data.before_fourteen_days.date];


            // ajax callback
            // myChart1.hideLoading();
            var labelArray = [];
            for (var i = 0, l = 24; i < l; i++) {
                labelArray.push(i)
            }

            // use the chart-------------------
            var option =



                {
                    title: {
                        text: '7 Day Call Comparision Report ',
                        subtext: ''
                    },
                    tooltip: {
                        trigger: 'axis'
                    },
                    legend: {
                        x: 420,
                        y: 20,
                        data: lableArraydata
                    },
                    toolbox: {
                        show: true,
                        feature: {
                            magicType: {
                                show: true,
                                title: {
                                    line: 'Line',
                                    bar: 'Bar',
                                    stack: 'Stack',
                                    tiled: 'Tiled'
                                },
                                type: ['line', 'bar', 'stack', 'tiled']
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

                    xAxis: [{
                        type: 'category',
                        data: labelArray
                    }],
                    yAxis: [{
                        type: 'value'
                    }],
                    series: [{
                        name: response.data.todays.date,
                        type: 'line',
                        itemStyle: {
                            normal: {
                                areaStyle: {
                                    type: 'default'
                                }
                            }
                        },
                        data: first_day
                    }, {
                        name: response.data.before_seven_days.date,
                        type: 'line',
                        itemStyle: {
                            normal: {
                                areaStyle: {
                                    type: 'default'
                                }
                            }
                        },
                        data: befor_seven_days
                    }, {
                        name: response.data.before_fourteen_days.date,
                        type: 'line',
                        itemStyle: {
                            normal: {
                                areaStyle: {
                                    type: 'default'
                                }
                            }
                        },
                        data: befor_forteen_days
                    }]
                }

            myChart1.setOption(option);

        }
    });
}

$('.modal-footer .btn-primary').click(function () {
    $('form[name="modalForm"]').submit();
});



function init_recent_table(min, max) {

    // logic to get new data
    var getDataRecentCalls = function () {
        $.ajax({
            url: '/most-recent-calls',
            success: function (response) {
                $('#loadingtable').hide();
                var trHTML = '';
                $.each(response.data, function (i, item) {
                    var strType = item.HangUpCount == 1 ? 'No' : 'Yes';
                    trHTML += '<tr><td>' + item.Name + '</td><td>' + item.CallerID + '</td><td>' + convertTime(item.CallDuration) + '</td><td>' + strType + '</td></tr>';
                });
                $('#records_table').append(trHTML);

            }
        });
    };
    //getDataRecentCalls();
}


function convertTime(sec) {
    var hours = Math.floor(sec / 3600);
    (hours >= 1) ? sec = sec - (hours * 3600): hours = '00';
    var min = Math.floor(sec / 60);
    (min >= 1) ? sec = sec - (min * 60): min = '00';
    (sec < 1) ? sec = '00': void 0;

    (min.toString().length == 1) ? min = '0' + min: void 0;
    (sec.toString().length == 1) ? sec = '0' + sec: void 0;

    return hours + ':' + min + ':' + sec;
}


function init_active_table(min, max) {
    // logic to get new data
    var getDataActiveCalls = function () {
        $.ajax({
            url: '/top-active-numbers',
            success: function (response) {
                var trHTML = '';
                $('#loadingtable1').hide();
                $.each(response.data, function (i, item) {
                    trHTML += '<tr><td>' + item.Name + '</td><td>' + item.Calls + '</td><td>' + item.LastCall + '</td></tr>';
                });
                $('#records_table1').append(trHTML);

            }
        });
    };
    //getDataActiveCalls();
}

var myChart = '';
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
    if (type == 'lineChart') {
        // Line chart
        if ($('#lineChart').length) {

            var ctx = document.getElementById("lineChart");
            myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [],
                    datasets: [{
                            label: "My First dataset",
                            borderColor: "rgba(38, 185, 154, 0.7)",
                            pointBorderColor: "rgba(38, 185, 154, 0.7)",
                            pointHoverBackgroundColor: "#fff",
                            pointHoverBorderColor: "rgba(220,220,220,1)",
                            pointBorderWidth: 1,
                            data: []
                        }, {
                            label: "My Second dataset",
                            borderColor: "rgba(3, 88, 106, 0.70)",
                            pointBorderColor: "rgba(3, 88, 106, 0.70)",
                            pointHoverBackgroundColor: "#fff",
                            pointHoverBorderColor: "rgba(151,187,205,1)",
                            pointBorderWidth: 1,
                            data: []
                        },
                        {
                            label: "My Third dataset",
                            borderColor: "rgba(03, 80, 16, 0.70)",
                            pointBorderColor: "rgba(03, 88, 106, 0.70)",
                            pointHoverBackgroundColor: "#fff",
                            pointHoverBorderColor: "rgba(51,187,05,1)",
                            pointBorderWidth: 1,
                            data: []
                        }
                    ]

                },
                options: {
                    bezierCurve: true,
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
                        }],
                        xAxes: [{
                            ticks: {
                                beginAtZero: 0,
                                offset: true

                            }
                        }]
                    }
                }
            });
        }
    }
}
jQuery(document).ready(function ($) {
    var tempData = '';
    init_charts_home('lineChart', tempData);


});