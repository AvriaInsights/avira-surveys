$(document).ready(function () {
    //form validation rules
    jQuery.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-zA-Z ]+$/.test(value);
    });
    
    jQuery.validator.addMethod("emailvalidation", function (value, element) {
        return this.optional(element) || /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test(value);
    });

    $("#role").change(function () {
        var rr=$("#role").val();
        
         if(rr=="")
         {
            $("#role-error").show();
         }
         else
         {
            $("#role-error").hide(); 
         }
     })
     
     
    // validate signup form on keyup and submit 

    $("#add-form").validate({
        rules: {
            fname: {
                required: true,
                lettersonly: true
            },
            lname: {
                required: true,
                lettersonly: true
            },
            role: {
                required: true,
            },
            uname: {
                required: true,
                remote: {
                    url: "check-admin-info.php",
                    type: "post",
                    data: {
                        'uname': function () {
                            return $("#uname").val();
                        },
                        'old_uname': function () {
                            return $("#old_uname").val()
                        }
                    }
                }
            },
            email: {
                required: true,
                email: true,
                emailvalidation:true,
                remote: {
                    url: "check-admin-info.php",
                    type: "post",
                    data: {
                        'email': function () {
                            return $("#email").val();
                        },
                        'old_email': function () {
                            return $("#old_email").val()
                        }
                    }
                }
            },
            phone: {
                required: true,
                number: true
            },
            status: {
                required: true
            },
            password: {required: true, minlength: 6},
            cpassword: {
                required: true,
                minlength: 6,
                equalTo: "#password"
            },
            menu_list:{
                 required: true
            }

        },
        messages: {
            fname: {
                required: "First Name is required",
                lettersonly: "Please enter Valid First Name"
            },
            lname: {
                required: "Last Name is required",
                lettersonly: "Please enter Valid Last Name"
            },
            role: {
                required: "Please select the Role"
            },
            uname: {
                required: "Please enter the Username",
                remote: "Username is already Registered"
            },
            email: {
                required: "Email Id is required",
                email: "Please enter the valid email id",
                emailvalidation:"Please enter the valid email id",
                remote: "Email id already Registered"
            },
            phone: {
                required: "Phone number is required",
                number: "Please enter the valid Phone number"
            },
            status: {
                required: "Please select the Status"
            },
            password: {required: "Password is required", minlength: "Please enter atleast 6 Characters"},
            cpassword: {
                required: "Confirm Password is required",
                minlength: "Please enter atleast 6 Characters",
                equalTo: "Please enter correct Confirm Password"
            },
            menu_list:{
                required: "Please select menu"
            }
            
            
        },
        errorElement: "span",
        submitHandler: function(form) {
                var formData = new FormData(form);
                saveFormDatas(formData);
        }
    });
});

function saveFormDatas(form) {
        var menuval=$("#menu_list").val();
        //alert(menuval);
        if(menuval==null || menuval=='') 
        {
            //$("#menu-error").show();
              swal({title: "Error", text: "Please select menu", type: 
                "error",icon: "error"});
        }
        else
        {
         // $("#menu-error").hide(); 
            $.ajax({
              url: 'https://www.researchandtrends.com/ABMi-miniCRM/add-admin-action.php',
              type: "POST",
              data: $('#add-form').serialize(),
              //data :{fname:fname,lname:lname,email:email,picture:picture,password:password,npassword:npassword,client_pass:client_pass,user_id:user_id},
              success: function(data) {
                  window.location.href = "https://www.researchandtrends.com/ABMi-miniCRM/manage-user";
              }
            });
        }
        
       
    }