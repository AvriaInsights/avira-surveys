$(document).ready(function () {
    // validate signup form on keyup and submit
    $("#signinForm").validate({
        rules: {
            uname: {
                required: true
            },
            password: {
                required: true
            }

        },
        messages: {
            uname: {
                required: "Username is required"
            },
            password: {
                required: "Password is required"
            }
        },
        errorElement: "span",
    });
});