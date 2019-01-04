jQuery(document).ready(function ($) {

    $("body").on("submit", "#requestform", function (event) {
        event.preventDefault();
        $('#SuccessDiv').hide();
        $('#ErrorDiv').hide();
        $.ajax({
            url: '/request-number',
            data: $('#requestform').serialize(),
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
                $('#SuccessDiv').show();

            },
            error: function (xhr) {
                $('#ErrorDiv').show();
            }
        });
    });

});