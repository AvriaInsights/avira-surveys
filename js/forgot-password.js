$(document).ready(function(){
      
     $("#forgotpassForm").validate({
         rule:{
             email: {
               required: true,
                email: true,
                /*remote: {
                    url: "check-user-email.php",
                    type: "POST",
                    data: {
                        'email': function () {
                            return $("#regemail").val();
                        }
                    }
                }*/
            },
            number_addition: {
              required:true,
            }
         },
         messages: {
             email: {
                required: "Email Id is required",
                email: "Please enter the valid email id",
                //remote: "Email id already Registered"
            },
            number_addition:{
                required : "Please Enter Addition of Numbers",
            }
         },
         errorElement: "span",
         submitHandler: function() {
                saveFormDatas();
        }
         
     });
     
     
     function saveFormDatas(form) {
      /*  $('#span_loader').show();*/
        var email = $("#regemail").val();
        $.ajax({
            type : 'POST',
            data : {email:email},
            url  : 'forgot-password-action.php',
            datatype:'json',
            cache:false,
            success: function(response){
                 alert(response);
                /* $('#span_loader').hide();*/
                 swal({
                    text: "Password will be send on mail id Please check your Registerd Mail",
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
	
    
});





