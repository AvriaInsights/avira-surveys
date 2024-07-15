$(document).ready(function () {
    $("#country_id").change(function () {
        var country_id = $(this).val();
        var dataString = 'country_id=' + country_id;
        $("#state_id").html('<i class="fa fa-spinner fa-spin"></i>');
        $.ajax({
            type: "POST",
            url: "get-state-list.php",
            data: dataString,
            cache: false,
            success: function (html){
                $("#city_id").html("<option value=''>Select City</option>");
                $("#state_id").html(html);
            }
        });
    });
});

$(document).ready(function () {
    $("#state_id").change(function () {
        var state_id = $(this).val();
        var dataString = 'state_id=' + state_id;
        $("#city_id").html('<i class="fa fa-spinner fa-spin"></i>');
        $.ajax({
            type: "POST",
            url: "get-city-list.php",
            data: dataString,
            cache: false,
            success: function (html){
                $("#city_id").html(html);
            }
        });
    });
});

$(document).ready(function () {
    //form validation rules
    jQuery.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-zA-Z ]+$/.test(value);
    });

    // validate signup form on keyup and submit 

    $("#add-form").validate({
        rules: {
            fname: {
                required: true,
                lettersonly: true
            },
            lname: {
                required: true,
                lettersonly: true
            },
            country_id: {
                required: true
            },
            state_id: {
                required: true
            },
            city_id: {
                required: true
            },
            zipcode: {
                required: true,
                number: true
            },
            email: {
                required: true,
                email: true,
                remote: {
                    url: "check-user-info.php",
                    type: "post",
                    data: {
                        'email': function () {
                            return $("#email").val();
                        },
                        'old_email': function () {
                            return $("#old_email").val()
                        }
                    }
                }
            },
            phone: {
                required: true,
                number: true
            },
            status: {
                required: true
            },
            password: {required: true, minlength: 6},
            cpassword: {
                required: true,
                minlength: 6,
                equalTo: "#password"
            }

        },
        messages: {
            fname: {
                required: "First Name is required",
                lettersonly: "Please enter Valid First Name"
            },
            lname: {
                required: "Last Name is required",
                lettersonly: "Please enter Valid Last Name"
            },
            country_id: {
                required: "Please select the Country"
            },
            state_id: {
                required: "Please select the State"
            },
            zipcode: {
                required: "Please enter the Zipcode",
                number: "Please enter the valid Zipcode",
            },
            city_id: {
                required: "Please select the City"
            },
            email: {
                required: "Email Id is required",
                email: "Please enter the valid email id",
                remote: "Email id already Registered"
            },
            phone: {
                required: "Phone number is required",
                number: "Please enter the valid Phone number"
            },
            status: {
                required: "Please select the Status"
            },
            password: {required: "Password is required", minlength: "Please enter atleast 6 Characters"},
            cpassword: {
                required: "Confirm Password is required",
                minlength: "Please enter atleast 6 Characters",
                equalTo: "Please enter correct Confirm Password"
            }
        },
        errorElement: "span",
        errorPlacement : function(error, element) { 
            if (element.attr('name') == 'status') {
                error.insertAfter('#status-div');
            } else {
                error.insertAfter(element);
            }
        }
    });
});

	