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
            country_id: {
                required: true,
            }
        },
        messages: {
            name: {
                required: "Please enter the State Name",
            },
            country_id: {
                required: "Please select the Country",
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

	

	