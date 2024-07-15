$(document).ready(function () {
    //form validation rules
    jQuery.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-zA-Z ]+$/.test(value);
    });
    
     $.validator.addMethod("requiredIfChecked", function (val, ele, arg) {
    if ($("#chk-1").is(":checked") && ($.trim(val) === '')) { return false; }
    return true;
    }, "Password is Required");
    
    // validate signup form on keyup and submit 

    $("#profile-update-form").validate({
        rules: {
            fname: {
                required: true,
                lettersonly: true
            },
            lname: {
                required: true,
            },
            email: {
                required: true,
                email: true,
            },
            password: {
                 requiredIfChecked: true  
    		},
    		 npassword: {
                 requiredIfChecked: true  
    		},
    		cpassword: {
                required: true,
                equalTo: "#npassword"
            },
            
        },
        messages: {
            fname: {
                required: "First name is required",
                lettersonly: "Please enter Valid First Name"
            },
            lname: {
                required: "Last name is required",
            },
            email: {
                required: "Email Id is required",
                email: "Please enter the valid email id",
            },
            password: {
                    requiredIfChecked: "Old Password is required"
                },
            npassword:{
                requiredIfChecked: "Please Enter New Password"
            },
            cpassword: {
            required: "Confirm Password is required",
            equalTo: "Please enter correct Confirm Password"
            },
            
        },
        errorElement: "span",
        submitHandler: function(form) {
                var formData = new FormData(form);
                saveFormDatas(form);
        }
    });
});
function saveFormDatas(form) {
        /*var fname = $("#fname").val();
        var lname = $("#lname").val();
        var email = $("#email").val();
        var picture = $("#picture").val();
        var password = $("#password").val();
        var npassword = $("#npassword").val();
        var client_pass = $("#client_pass").val();
        var user_id = $("#user_id").val();*/
        var siteurl = $("#siteurl").val();
        $.ajax({
         url: siteurl+'update-user-profile-action.php',
          type: "POST",
          data: $('#profile-update-form').serialize(),
          //data :{fname:fname,lname:lname,email:email,picture:picture,password:password,npassword:npassword,client_pass:client_pass,user_id:user_id},
          success: function(data) {
              if(data == 1){
                  swal({title: "Error", text: "Old Password Wrong", type: 
                "error",icon: "error"});
              }
              else
              {
                 swal({title: "Success", text: "Profile Update Successfully", type: 
                    "success",icon: "success"}).then(function(){ 
                       location.reload();
                       }
                    );
              }
          }
        });
    }
	