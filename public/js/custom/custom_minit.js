$(document).ready(function () {
    $("#loadingtable").hide();
    var dateNow = new Date();
    $('#myDatepicker2').datetimepicker({
        format: 'MM/DD/YYYY ',
        defaultDate: dateNow
    });
    $('#myDatepicker').datetimepicker({
        format: 'MM/DD/YYYY ',
        defaultDate: dateNow
    });

    $("body").on("click", "#submitBtn", function () {
        getAjax("/minute/log", $("#datepickerVal").val(), $("#gtpsthour").val(), $("#gtCampaign2").val(), true);
    });
});


jQuery(document).ready(function ($) {
    $("#loadingtable").show();
    getAjaxCampaignList('/campaign-list');
    init_charts_home('HourlChart');
    gtpsthour();

});

function gtpsthour() {
    var trHTML = "";
    for (var i = 0; i < 24; i++) {
        trHTML += "<option value = '" + i + " '>" + i + ":00 PST </option>";
    }
    $('#gtpsthour').append(trHTML);
}

function getAjaxCampaignList(url) {

    $.ajax({
        url: url,
        success: function (response) {

            var trHTML = "";
            $("#loadingbar").hide();
            $('#gtCampaign2').append('<option value = "all">ALL</option>');
            $.each(response.data, function (i, item) {
                trHTML += "<option value = '" + item.CampaignID + " '>" + item.Name + " </option>";
            });
            $('#gtCampaign2').append(trHTML);
            var startDate = $("#datepickerVal").val();
            var gtCampaign2 = $("#gtCampaign2").val();
            $("#loadingtable").hide();
            /// getAjax("/hourly/log",startDate,gtCampaign2,true);
        }
    });
};

function getAjax(url, startDate, time, campaign_id, flag) {

    var objData = {
        "start_date": startDate,
        "start_time": time,
        "campaign_id": campaign_id
    };
    // $('#datatable-keytable1').dataTable().fnClearTable();
    // $('#datatable-keytable1').dataTable().fnDestroy();
    var myChart1 = echarts.init(document.getElementById('echart_line1'));

    // loading---------------------
    // myChart1.showLoading({
    //     text: "please wait!!!... ",
    // });
    $("#loadingtable").show();

    $.ajax({
        url: url,
        type: "get",
        data: objData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            //myChart2.data.labels=response.data.City ;
            // myChart2.data.datasets[0].data=response.data.befor_forteen_days.data;
            $("#loadingtable").hide();
            // myChart2.update();

            var first_day = response.data.first_day.data;
            var befor_forteen_days = response.data.befor_forteen_days.data;
            var befor_twenty_one_days = response.data.befor_twenty_one_days.data;
            var befor_seven_days = response.data.befor_seven_days.data;

            var lableArraydata = [response.data.first_day.date, response.data.befor_forteen_days.date, response.data.befor_twenty_one_days.date, response.data.befor_seven_days.date];


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
                        text: 'Minute Reports',
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
                        name: response.data.first_day.date,
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
                        name: response.data.befor_forteen_days.date,
                        type: 'line',
                        itemStyle: {
                            normal: {
                                areaStyle: {
                                    type: 'default'
                                }
                            }
                        },
                        data: befor_forteen_days
                    }, {
                        name: response.data.befor_twenty_one_days.date,
                        type: 'line',
                        itemStyle: {
                            normal: {
                                areaStyle: {
                                    type: 'default'
                                }
                            }
                        },
                        data: befor_twenty_one_days
                    }, {
                        name: response.data.befor_seven_days.date,
                        type: 'line',
                        itemStyle: {
                            normal: {
                                areaStyle: {
                                    type: 'default'
                                }
                            }
                        },
                        data: befor_seven_days
                    }]
                }

            myChart1.setOption(option);




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
    if (type == 'HourlChart') {
        // Bar chart
        if ($('#HourlChart').length) {

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
                type: 'bar',
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