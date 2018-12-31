$("input").keyup(function () {
    var email = $('#email').val();
    var password = $('#Password').val();

    if (email != 0) {
        if (isValidEmailAddress(email)) {
            $(".error1").html("");
        } else {
            $(".error1").html("Please enter valid email address.");
        }
    } else {
        $(".error1").html("Please enter your email.");
    }

    if (password != '') {
        if (password.length < 8) {
            $(".error2").html("The password must be at least 8 characters.");
        } else {
            $(".error2").html("");
        }

    }

});

function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
}