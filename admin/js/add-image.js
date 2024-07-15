
$(document).ready(function () {
    $("#add-form").validate({
        rules: {
           
            picture: {
                accept: "png|jpg|jpeg"
            }
        },
        messages: {
            picture: {
                required: "Please enter the Image",
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
