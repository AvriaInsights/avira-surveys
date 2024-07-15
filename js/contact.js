$(document).ready(function(){
     //form validation rules
    jQuery.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-zA-Z ]+$/.test(value);
    });

    var sitepath = $("#site-path").val();
    // validate signup form on keyup and submit 

    $("#contactForm").validate({
        rules: {
            fname: 
            {
                required: 
                {
                    depends:function(){
                    $(this).val($.trim($(this).val()));
                    return true;
                }
            },
                lettersonly: true
            },
            
            email: 
            {
                required: true,
                email: true,
            },
             
            phone:
            {
                required: true,
                number: true,
                rangelength: [10,15],
            },
            txt_message:
            {
                required:true,
                rangelength: [2,999],
                
                
            }
        },
        messages: {
            fname: {
                required: "First Name is required",
                lettersonly: "Enter Valid First Name"
            },
            lname: {
                required: "Last Name is required",
                lettersonly: "Enter Valid Last Name"
            },
            email: {
                required: "Email Id is required",
                email: "Enter the valid email id",
                /*remote: "Email id already Registered"*/
            },
            phone:
            {
                required: "Number Required",
                number: "Enter valid number",
                rangelength:"Enter valid number"
            },
            txt_message:
            {
                required:"Your Message Required",
                rangelength: "Message Length Exceed",
            },
            
            
        },
         errorElement: "span",
        submitHandler: function(form) {
                var formData = new FormData(form);
                saveFormDatas(form);
        }
    });
    	   
});


 // e.preventDefault();
	function saveFormDatas(form) {
      /*  $('#span_loader').show();*/
        var fname = $("#fname").val();
        var phone = $("#phone").val();
        var email = $("#regemail").val();
        var txt_message = $('#txt_message').val();
     
        $.ajax({
            type : 'POST',
            data : {fname:fname,phone:phone,email:email,txt_message:txt_message},
            url  : '../contact-action.php',
            datatype:'json',
            cache:false,
            success: function(response){
                /* $('#span_loader').hide();*/
                 swal({
                    text: "Thank you for Contact us, Our Team will contact you soon.",
                    icon: "success",
                    showConfirmButton: true,
                    confirmButtonColor: '#04AA26',
                    position: "center",
                }).then(function() {
                    $("#contactForm")[0].reset();
                });
            },
             error: function (textStatus, errorThrown) {
                 alert("Somthing Went Wrong, Please Try Again.");
        }
        });
    }
	