<?php 
//session_start();
require_once("classes/cls-admin.php");
$obj_admin = new Admin();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="icon" href="images/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo SITEPATH; ?>css/login/style.css">
    <link rel="stylesheet" href="<?php echo SITEPATH; ?>css/login/responsive.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Login</title>
    <style>
  .field-icon {
    float: right;
    margin-left: -25px;
    margin-top: -35px;
    position: relative;
    z-index: 2;
    margin-right: 0.5rem;
    font-size: 2rem;
    cursor: pointer;
}
    </style>
  </head>
  <body>
  <div class="d-lg-flex half">
      <div class="bg" style="background-image:url('../ABMi-miniCRM/images/login_page_bg.svg')">
          <img src="<?php echo SITEPATH; ?>images/Login_Infographic.png" class="img-fluid login-info">
        <!--<h2 class="img-heading">Welcome Back!</h2>   -->
      </div>
      <div class="contents order-2 order-md-1">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-7">
                    <div class="login-form text-center">
                        <h2 class="login-heading">Avira Lead Management Tool (ABMi)</h2>
                        <h4 class="pb-5">Sign in to continue</h4>
                         <?php if (isset($_SESSION['success'])) { ?>
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <?php
                                echo $_SESSION['success'];
                                unset($_SESSION['success']);
                                ?>
                                <button type="button" class="close float-end border-0" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                        <?php } elseif (isset($_SESSION['error'])) { ?>
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <?php
                                echo $_SESSION['error'];
                                unset($_SESSION['error']);
                                ?>
                                <button type="button" class="close float-end border-0" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                 </button>
                            </div>
                        <?php } ?>
                        <form role="form" autocomplete="off" method="POST" action="login-action.php" id="login-form" name="login-form">
                            <div class="form-group mb-3">
                                <input class="form-control valid" placeholder="User Id" name="uname" id="uname" type="text" value="" aria-describedby="" aria-required="true" aria-invalid="false" autofocus>
                                <span class="form-icon">
                                   <i class="fa fa-envelope"></i>
                                </span>
                            </div>
                            <div class="form-group">
                                <input class="form-control valid" placeholder="Password" name="password" id="password" type="password" value="" aria-describedby="" aria-required="true" aria-invalid="false">
                                <i toggle="#password-field" class="fa fa-fw fa-eye-slash field-icon toggle-password" id="eye"></i>
                                <span class="form-icon">
                                   <i class="fa fa-lock"></i>
                                </span>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" class="checkbx mt-1" name="remember" checked="checked">
                                <label for="check1" class="checkbx"><span class="ms-2"> Keep me sign in</span></label>
                            </div>
                            <!--<a class="acc-link" href="#">Already have a Account</a>-->
                            <button type="submit" class="btn subscribe-btn shadow w-100" name="btn_submit" value="Login">Login</button>
                        
                        </form>
                  </div>
                </div>
            </div>
        </div>
      </div>
  </div>
   <?php include("footer.php"); ?>
<script src="<?php echo SITEPATH; ?>bower_components/jquery-validation/jquery.validate.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script>
$(function(){
  $('#eye').click(function(){
      
        if($(this).hasClass('fa-eye')){
           
          $(this).removeClass('fa-eye');
          
          $(this).addClass('fa-eye-slash');
          
          $('#password').attr('type','password');
            
        }else{
         
          $(this).removeClass('fa-eye-slash');
          
          $(this).addClass('fa-eye');  
          
          $('#password').attr('type','text');
        }
    });
 });
$(document).ready(function () {
    // validate signup form on keyup and submit 

    $("#login-form").validate({
        rules: {
            uname: {
                required: true,
            },
            
            password: {
                required: true,
            },
        },
        messages: {
            uname: {
                required: "Enter User Id",
            },
            
            password: {
                required: "Enter Password", 
            },
            
        },
        errorElement: "span",
        errorPlacement : function(error, element) { 
            if (element.attr('name') == 'status') {
                error.insertAfter('#status-div');
            } else {
                error.insertAfter(element);
            }
        },
    });
});
</script>