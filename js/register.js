 $(document).ready(function () {
    //form validation rules
    jQuery.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-zA-Z ]+$/.test(value);
    });

    var sitepathfront = $("#websitepath").val();
    // validate signup form on keyup and submit 

    $("#registerForm").validate({
        rules: {
            fname: {
                required: 
                {
                    depends:function(){
                        $(this).val($.trim($(this).val()));
                        return true;
                    }
                 },
                lettersonly: true
            },
            lname: {
                required: {
                depends:function(){
                $(this).val($.trim($(this).val()));
                return true;
             }
             },
                lettersonly: true
            },
            
           
            email: {
                required: true,
                email: true,
                remote: {
                    url: "check-user-info.php",
                    type: "GET",
                    data: {
                        'email': function () {
                            return $("#regemail").val();
                        }
                    }
                }
            },
             /*username: {
                required: true,
                remote: {
                    url: "check-user-info.php",
                    type: "GET",
                    data: {
                        'username': function () {
                            return $("#username").val();
                        }
                    }
                }
            },*/
             country:{
                required: true
            },
            phone: {
                required: true,
                number: true,
                rangelength: [10,12]
            },
            password: {required: true, minlength: 6},
            cpassword: {
                required: true,
                minlength: 6,
                equalTo: "#regpassword"
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
                remote: "Email id already Registered"
            },
           /* username : {
                required: "Username is required",
                remote: "Username already Used",
            },*/
            phone: {
                required: "Phone number is required",
                number: "Enter the valid Phone number",
                rangelength:"Enter the valid Phone number"
            },
            country:{
                required: "Please select the Country"
            },
            password: {
                required: "Password is required", 
                minlength: "Enter atleast 6 Characters"
            },
            cpassword: {
                required: "Confirm Password is required",
                minlength: "Enter atleast 6 Characters",
                equalTo: "Enter correct Confirm Password"
            }
        },
        errorElement: "span",
        submitHandler: function(form) {
                var formData = new FormData(form);
                saveFormDatas(form);
        }
        
       /* errorElement: "span",
        errorPlacement : function(error, element) { 
            if (element.attr('name') == 'status') {
                error.insertAfter('#status-div');
            } else {
                error.insertAfter(element);
            }
        }*/
    });
    	
    	
   // e.preventDefault();
	function saveFormDatas(form) {
        $('#span_loader').show();
        var fname = $("#fname").val();
        var lname = $("#lname").val();
        var phone = $("#phone").val();
        var email = $("#regemail").val();
        var company = $('#company').val();
        var country = $('#country').val();
        var password =$('#regpassword').val();
        var sitepathfront = $("#websitepath").val();
        //var username = $('#username').val();
        
        var sitepath = sitepathfront+"survey/login";
     
        $.ajax({
            type : 'GET',
            data : {fname:fname,lname:lname,phone:phone,email:email,company:company,country:country,password:password},
            url  : 'register-action.php',
            datatype:'json',
            cache:false,
            success: function(response){
               // alert(response);
                 $('#span_loader').hide();
                 swal({
                    text: "Please click on the activation link sent to your registered email-id for accessing the tool. Please also check your Spam / Junk folder for the email. If you did not receive the email, please write to contactus@avirasurveys.com",
                    icon: "success",
                    showConfirmButton: true,
                    confirmButtonColor: '#04AA26',
                    position: "center",
                }).then(function() {
                    window.location = sitepath;
                });
            },
             error: function (textStatus, errorThrown) {
        }
        });
        
    	}
    	
});    	