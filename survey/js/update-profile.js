   $(document).ready(function () {
        
    $.validator.addMethod("requiredIfChecked", function (val, ele, arg) {
    if ($("#chk-1").is(":checked") && ($.trim(val) == '')) { return false; }
    return true;
}, "Password is Required");
        
    jQuery("#profile-form").validate({
        rules: {
            fname: {
                required: true
               
            },
            lname: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                number: true,
                rangelength: [10,12]
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
                required: "First Name is required"
            },
            lname: {
                required: "Last Name is required"
            },
            email: {
                required: "Email Id is required",
                email: "Please enter the valid email id"
            },
            phone: {
                required: "Phone number is required",
                number: "Please enter the valid Phone number",
                rangelength:"Please enter the valid Phone number"
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
       errorElement: "span"
    });
});
/*	function saveFormDatas(form)
	{
        var fname = $("#fname").val();
        var lname = $("#lname").val();
        var phone = $("#phone").val();
        var email = $("#email").val();
        var company = $('#company').val();
        var password =$('#password').val();
        var username = $('#username').val();
        var client_id = $('#client_id').val();
        
        
           $.ajax({
            type : 'POST',
            data : {fname:fname,lname:lname,phone:phone,email:email,company:company,password:password,username:username,client_id:client_id},
            url  : 'update-profile-action.php',
            datatype:'json',
            cache:false,
            success: function(response){
                 swal({
                    text: "Profile Update Successfully",
                    icon: "success",
                    showConfirmButton: true,
                    confirmButtonColor: '#04AA26',
                    position: "center",
                }).then(function() {
                    window.location = "https://www.software-intent.com/";
                });
            },
             error: function (textStatus, errorThrown) {
                 alert("error");
        }
        });
	}*/

	