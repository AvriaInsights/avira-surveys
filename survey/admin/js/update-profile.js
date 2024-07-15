$(document).ready(function () {
    // validate signup form on keyup and submit
    $("#add-form").validate({
        rules: {
            fname: {
                required: true
            },
            lname: {
                required: true
            },
            uname: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            password: {required: true},
            cpassword: {
                required: true,
                equalTo: "#password"
            },
            picture : {
                accept : "jpg|jpeg|png|gif"
            }

        },
        messages: {
            fname: {
                required: "First Name is required"
            },
            lname: {
                required: "Last Name is required"
            },
            uname: {
                required: "Username is required"
            },
            email: {
                required: "Email Id is required",
                email: "Please enter the valid email id"
            },
            password: {required: "Password is required"},
            cpassword: {
                required: "Confirm Password is required",
                equalTo: "Please enter correct Confirm Password"
            },
            picture : {
                accept : "Please select the valid Image File"
            }
        },
        errorElement: "span"
    });
});

	