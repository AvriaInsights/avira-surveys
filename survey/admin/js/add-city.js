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
            },
            state_id: {
                required: true,
            }
        },
        messages: {
            name: {
                required: "Please enter the City Name",
            },
            country_id: {
                required: "Please select the Country",
            },
            state_id: {
                required: "Please select the State",
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

	

	