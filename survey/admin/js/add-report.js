$(document).ready(function () {
    $('#published_date').datepicker({
        dateFormat: 'yy-mm-dd'
    });
});

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
    $("#add-form").validate({
        rules: {
            title: {
                required: true,
            },
            published_date: {
                required: true,
            },
            price: {
                required: true,
                number: true
            },
            picture: {
                accept: "png|jpg|jpeg"
            },
            ebook: {
                url : true
            },
            status: {
                required: true
            }
        },
        messages: {
            title: {
                required: "Please enter the Title",
            },
            published_date: {
                required: "Please select the Published date",
            },
            price: {
                required: "Please enter the Price",
                number: "Please enter the valid Price"
            },
            picture: {
                accept: "Please select valid Image File"
            },
            ebook: {
                url : "Please enter the valid Ebook Link"
            },
            status: {
                required: "Please select the Status"
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


$(document).ready(function () {
    $("#import-form").validate({
        rules: {
            csv_file: {
                required: true,
                extension: "csv"
            }
        },
        messages: {
            csv_file: {
                required: "Please select CSV file",
                extension: "Please select valid CSV file"
            }
        },
        errorElement: "span"
    });
});
