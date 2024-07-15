$(document).ready(function () {
    //form validation rules
    jQuery.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-zA-Z ]+$/.test(value);
    });
    // validate signup form on keyup and submit
    $("#add-form").validate({
        rules: {
            title: {
                required: true,
                remote: {
                    url: "check-category-info.php",
                    type: "post",
                    data: {
                        'title': function () {
                            return $("#title").val();
                        },
                        'old_title': function () {
                            return $("#old_title").val()
                        }
                    }
                }
            },
            shortcode: {
                required: true,
                remote: {
                    url: "check-category-info.php",
                    type: "post",
                    data: {
                        'shortcode': function () {
                            return $("#shortcode").val();
                        },
                        'old_shortcode': function () {
                            return $("#old_shortcode").val()
                        }
                    }
                }
            },
            status: {
                required: true
            }
        },
        messages: {
            title: {
                required: "Please enter the Title",
                remote: "Title is already exists"
            },
            shortcode: {
                required: "Please select the Short Code",
                remote: "Short Code is already exists"
            },
            status: {
                required: "Please select the status"
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


$(document).ready(function () {
    $("#import-form").validate({
        rules: {
            csv_file: {
                required: true,
                accept: "csv"
            }
        },
        messages: {
            csv_file: {
                required: "Please select CSV file",
                accept: "Please select valid CSV file"
            }
        },
        errorElement: "span"
    });
});

	

	

	