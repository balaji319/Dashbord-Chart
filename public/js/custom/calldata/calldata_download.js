jQuery(document).ready(function ($) {
    $("body").on("click", ".downloadCsv", function () {
        var name = $(this).attr('data-name');
        var myUrl = "/downoad";
        getAjax(myUrl, name);
    });
});

function getAjax(url, name) {

    $("#loadingbar").show();
    $.ajax({
        url: url,
        type: "get",
        data: {
            filename: name
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (result) {
            var pom = document.createElement('a');
            var csvContent = result; //here we load our csv data
            var blob = new Blob([csvContent], {
                type: 'text/csv;charset=utf-8;'
            });
            var url = URL.createObjectURL(blob);
            pom.href = url;
            pom.setAttribute('download', name.split('.').slice(0, -1).join('.') + '.csv');
            pom.click();

        }
    });
}