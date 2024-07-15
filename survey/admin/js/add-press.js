$(document).ready(function () {
    $("#title").keyup(function () {
        var slug = '';
        var trimmed = $("#title").val();
        slug = trimmed.replace(/[^a-z0-9-]/gi, '-').replace(/-+/g, '-').replace(/^-|-$/g, '').toLowerCase();
        
        $("#slug").val(slug);
    });
});
$(document).ready(function () {
    $("#add-form").validate({
        rules: {
            title: {
                required: true,
            },
            slug: {
                required: true,
                remote: {
                    url: "check-press-info.php",
                    type: "post",
                    data: {
                        'slug': function () {
                            return $("#slug").val();
                        },
                        'old_slug': function () {
                            return $("#old_slug").val()
                        }
                    }
                }
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
            slug: {
                required: "Please enter the Slug",
                remote: "Slug already exists"
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
