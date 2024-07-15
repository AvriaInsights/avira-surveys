$(document).ready(function () {
    jQuery.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-zA-Z ]+$/.test(value);
    });
    
    jQuery.validator.addMethod('customphone', function (value, element){
        return this.optional(element) || /^[0-9 +-]+$/.test(value);
    });
    var sitepath = $("#site-path").val();

    $("#request-form").validate({
        ignore: ":hidden",
        rules: {
           surveytitle: {
               required: {
                    depends:function(){
                        var txtval=$(this).val().trim();
                                if(txtval==="")
                                {
                                    $(this).val($.trim($(this).val()));
                                    return true;
                                }
                    }
                    }
            },
            category:{
                required: true
            }
        
        },
        messages: {
            surveytitle: {
                required: "Survey Title is required"
            },
            category: {
                required: "Please select category"
            }
        },
        errorElement: "p"

    });

});