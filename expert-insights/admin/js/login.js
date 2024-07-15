$(document).ready(function () {
    //alert("hello");
    // validate signup form on keyup and submit 

    $("#login-form").validate({
        rules: {
            uname: {
                required: true,
            },
            
            password: {
                required: true,
            },
        },
        messages: {
            uname: {
                required: "Please enter the Username",
            },
            
            password: {
                required: "Password is required", 
            },
            
        },
        errorElement: "span",
        errorPlacement : function(error, element) { 
            if (element.attr('name') == 'status') {
                error.insertAfter('#status-div');
            } else {
                error.insertAfter(element);
            }
        },
    });
});

	