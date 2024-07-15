$(document).ready(function () {
    //form validation rules
    jQuery.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-zA-Z ]+$/.test(value);
    });
    // validate signup form on keyup and submit
    $("#add-form").validate({
        rules: {
            name: {
                required: true,
            },
            shortname: {
                required: true,
            },
            phonecode: {
                required: true,
            }
        },
        messages: {
            name: {
                required: "Please enter the Country Name",
            },
            shortname: {
                required: "Please enter the Short Code",
            },
            phonecode: {
                required: "Please enter the Phone Code",
            }
        },
        errorElement: "span",
        errorPlacement: function(error, element) { 
            if (element.attr('name') == 'status') {
                alert();
                error.insertAfter('#status-div');
            } else {
                error.insertAfter(element);
            }
        }
    });
});

	

	