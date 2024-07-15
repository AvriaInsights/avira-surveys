$(document).ready(function () {
    $("#add-form").validate({
        rules: {
            title: {
                required: true,
            },
            price: {
                required: true,
                number: true
            },
            status: {
                required: true
            }
        },
        messages: {
            title: {
                required: "Please enter the Title",
            },
            price: {
                required: "Please enter the Price",
                number: "Please enter the valid Price"
            },
            status: {
                required: "Please select the Status"
            }
        },
        errorElement: "span",
        errorPlacement: function (error, element) {
            if (element.attr('name') == 'status') {
                error.insertAfter('#status-div');
            } else {
                error.insertAfter(element);
            }
        }
    });
});
