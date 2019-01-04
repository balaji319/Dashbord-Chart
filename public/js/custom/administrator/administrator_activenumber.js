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
        var endDate = $("#datepickerVal1").val();

        getAjax("/call-recording", startDate, endDate, true)
    });
});


jQuery(document).ready(function ($) {

    var myUrl = "/active-numbers";
    getAjax(myUrl);


});

function getAjax(url, startDate, endDate, flag) {

    var objData = flag ? {
        "startdate": startDate,
        "enddate": endDate
    } : '';
    $('#datatable-keytable1').dataTable().fnClearTable();
    $('#datatable-keytable1').dataTable().fnDestroy();
    $("#loadingbar").show();
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

                var isUK = item.Geography == 'United Kingdom' ? 'style="background: rgb(255, 255, 153)"' : "";
                var isLeast = result.min_value == item.last_updated ? 'style="background:red;color:white"' : "";
                trHTML1 += '<tr  data-Tracking_ID="' + item.station_id + '"  ' + isUK + ' ><td>' + item.station_id + '</td><td>' + item.Name + '</td><td>' + item.count + '</td><td>' + item.Geography + '</td><td>' + item.Campaign + '</td><td ' + isLeast + '>' + item.last_updated + '</td></tr>';
            });

            $('#datatable-keytable1').append(trHTML1);


            $('#datatable-keytable1').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "sDom": 'lfrtip',
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ]
            });

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
var myChart1 = '';

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

            function getRandomIntInclusiveArray(len) {
                var arr = [];
                for (var i = 0, l = len; i < l; i++) {
                    arr.push(Math.round(Math.random() * l))
                }
                return arr;
            }

            var labelArray = [];
            for (var i = 0, l = 24; i < l; i++) {
                labelArray.push(i)
            }
            myChart = new Chart(ctx, {
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
                        }]
                    }

                }
            });



            function getRandomIntInclusive(min, max) {
                var arr = [];
                for (var i = 0, l = 20; i < l; i++) {
                    arr.push(Math.random() * (max - min + 1))
                }
                return arr;
            }

            function getRandomIntInclusiveArray(len) {
                var arr = [];
                for (var i = 0, l = len; i < l; i++) {
                    arr.push(Math.round(Math.random() * l))
                }
                return arr;
            }



        }

    } else if (type == 'mybarChart') {
        // Bar chart
        if ($('#mybarChart').length) {

            function getRandomIntInclusiveArray(len) {
                var arr = [];
                for (var i = 0, l = len; i < l; i++) {
                    arr.push(Math.round(Math.random() * l))
                }
                return arr;
            }
            // create initial empty chart
            var ctx_live = document.getElementById("mybarChart");
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
                        text: "Dynamically Update Chart Via Ajax Requests",
                    },
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{

                            ticks: {
                                min: 0,
                                stepSize: 10,
                            }
                        }]
                    }

                }
            });


            //  getData();
            // get new data every 3 seconds
            //setInterval(getData,10000);
        }
    } else if (type == 'mybarChart1') {
        // Bar chart
        if ($('#mybarChart1').length) {

            function getRandomIntInclusiveArray(len) {
                var arr = [];
                for (var i = 0, l = len; i < l; i++) {
                    arr.push(Math.round(Math.random() * l))
                }
                return arr;
            }
            // create initial empty chart
            var ctx_live1 = document.getElementById("mybarChart1");
            var labelArray = [];
            for (var i = 0, l = 24; i < l; i++) {
                labelArray.push(i)
            }
            var oilData = {
                labels: [],
                datasets: [{
                    data: [],
                    backgroundColor: []
                }]
            };


            myChart1 = new Chart(ctx_live1, {
                type: 'pie',
                data: oilData
            });


            //  getData();
            // get new data every 3 seconds
            //setInterval(getData,10000);
        }
    }


}

function getRandomColor(len) {
    var arr = [];
    for (var i = 0; i < len; i++) {

        arr.push('rgb(' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ')')
    }
    return arr;
}
jQuery(document).ready(function ($) {
    var tempData = '';

    init_charts_home('mybarChart', tempData);
    init_charts_home('lineChart', tempData);
    init_charts_home('mybarChart1', tempData);
    init_active_table();


});