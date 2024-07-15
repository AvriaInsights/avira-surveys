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
           fname: {
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
            email:{
                required: true,
                email: true,
            }
        
        },
        messages: {
            fname: {
                required: "Please enter name"
            },
            email: {
                required: "Please enter email",
                email: "Enter the valid email id",
            }
        },
        errorElement: "p"

    });

});