$(document).ready(function () {
    $('#e_fromdate').datepicker({
        dateFormat: 'yy-mm-dd'
    });

    $('#e_todate').datepicker({
        dateFormat: 'yy-mm-dd'
    });
});

$(document).ready(function () {
    $("#export-request-form").validate({
        rules: {
            e_fromdate: {
                required: true,
            },
            e_todate: {
              required: true,
            },
            "e_headerCheck_list[]" : {
                required: true
            }
           
        },
        messages: {
            e_fromdate: {
                required: "Please select from date"
            },
            e_todate: {
                required: "Please select to date"
            },
            "e_headerCheck_list[]": {
                required: "Please select at least one Header."
            }
           
        },
        errorElement: "span",
        errorPlacement: function(error, element) { 
            if (element.attr('name') == 'e_headerCheck_list[]') {
                error.insertAfter('#status-div');
            } else {
                error.insertAfter(element);
            }
        }
    });
});