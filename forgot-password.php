<?php
$page_title = "Avira Surveys - Forgot Password";
include('common-header.php');

?>
<style>
    .error{color:red;}
    .close{
    border: none !important;
    font-size: 17px;
    background: transparent;
    float: right;
    padding: 0px;
    margin: -4px;
}
</style>
<section class="d-flex align-items-center justify-content-center ptb-5 position-relative">
    <div class="container">
        <div class="row d-flex align-items-center">
           <!-- <div class="col-md-12">
                <img src="images/logo-light.png" class="img-fluid reg-logo pt-5">
            </div>-->
            <div class="col-md-12">
                <div class="text-end">
                    <img src="../images/pattern-top.png" class="img-fluid pattern-img-right">
                </div>
            </div>
            <div class="col-md-12 mb-5">
                <div class="pt-5">
                <div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3">
                    <div class="card-password">
                     <h1 class="fw-bold mb-0">Forgot Password</h1>
                 </div>
                    <div class="reg-form-password bg-white box-shadow">
                        <div class="col-md-12">
                       <!-- <h3 class="page-header text-center">Admin Panel</h3>-->
                        <?php if (isset($_SESSION['error_pass'])) { ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <?php
                            echo $_SESSION['error_pass'];
                            unset($_SESSION['error_pass']);
                            ?>
                             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                             </button>
                        </div>
                        <?php } ?>
                        
                         <?php if (isset($_SESSION['success'])) { ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php
                            echo $_SESSION['success_pass'];
                            unset($_SESSION['success_pass']);
                            ?>
                             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                             </button>
                        </div>
                        <?php } ?>
                    </div>
                    <form role="form" id="forgotpassForm" name="forgotpassForm" method="POST" action="forgot-password-action.php">
                           <!--<div>
                                <h4 class="text-center fw-bold">Enter Your Email Id And We’ll Send You OTP to Reset Your Password</h4>
                           </div>-->
                        <div class="reg-form" style="padding: 0rem !important">
                            <div class="col-md-12">   
                                <div class="form-group">
                                    <label class="form-password-label">Email</label>
                                    <input type="email" class="form-control email-box" name="email" id="regemail" value="">
                                    <span class="email-icon">
                                        <i class="fa fa-envelope mt-2"></i>
                                    </span>
                                </div>
                            </div>
                            
                            
                            <!--<div style="display:flex" class="mt-4">
                            <div class="form-group col-md-4">
                                <div class="contact-input">
                                    <div class="bg-light border border-dark p-1 input-char">
                                        <span id="num_1" style="font-size:18px;margin-left:3px;"><?php echo rand(1,10); ?>
                                        </span>
                                        <span class="plus-sign">+</span>
                                        <span id="num_2" style="font-size:18px;margin-left:3px;"><?php echo rand(1,10); ?></span> 
                                    </div>
                                </div>
                            </div>
                            <span class="p-2 me-0 fs-2 col-md-1">= </span>
                            <div class="form-group col-md-7">
                                <div class="contact-input1">
                                    <input type="text" class="form-control captcha-box" id="number_addition" name="number_addition" value="">
                                </div>
                            </div>
                         </div>-->
                    
                            <div class="col-md-12 col-lg-12 d-flex">
                                <div class="captcha-box form-group">
                                    <div class="border border-secondary captcha-text">
                                        <span class="input-char" id="num_1"><?php echo rand(1,10); ?>
                                        </span>
                                        <span class="plus-sign">+</span>
                                        <span id="num_2" class="input-char"><?php echo rand(1,10); ?></span> 
                                    </div>
                                </div>
                                <div class="text-center p-3">
                                    <span class="fs-2">=</span>
                                </div>
                                <div class="fp-answer">
                                    <input type="text" class="form-control" id="number_addition" name="number_addition" value="">
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                    <input type="submit" class="col-12 btn btn-lg cta-btn s-button mt-4 shadow-md " value="Continue">
                            </div>
                        </div>
                    </form>
                    </div>
                <div class="text-center pt-4">
                    <a href="<?php echo SITEPATHFRONT ?>privacy-policy.php" class="text-dark regpr border-end pe-3">Privacy Policy</a>
                    <a href="<?php echo SITEPATHFRONT ?>terms-and-conditions.php" class="text-dark regpr ps-3">Terms & Conditions</a>
                </div>
        </div>
    </div>
    </div>
            <div class="col-md-12">
                <div class="">
                    <img src="../images/pattern-top.png" class="img-fluid pattern-bottom-img contact-bottom-bg">
                </div>
            </div>
        </div>
    </div>
</section><?php include('footer.php'); ?>

        <script src="<?php echo SITEPATH; ?>bower_components/jquery/dist/jquery.min.js"></script>
        <script src="<?php echo SITEPATH; ?>bower_components/jquery-validation/jquery.validate.js"></script>
        <script src="<?php echo SITEPATH; ?>dist/js/sb-admin-2.js"></script>
        <script src="<?php echo SITEPATHFRONT ?>js/jquery.validate.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
         <script>
            $(document).ready(function () {
                  var num_1 = $("#num_1").text(); 
                    var num_2 = $("#num_2").text(); 
                    var num_sum = parseInt(num_1 )+ parseInt(num_2);
                    $("#number_addition").on('change',function(){
                      var total_sum = $(this).val();
                      if(num_sum != total_sum){
                       $(this).css("border", "1px solid red");
                       $("#number_addition").val('');
                       $("#number_addition").focus();
                      }
                      else{
                          $(this).css("border", "1px solid green");
                      }
                  });
                // validate signup form on keyup and submit
                $("#forgotpassForm").validate({
                    rules: {
                        email: {
                            required: true,
                            email: true
                        },
                        number_addition:{
                            required:true,
                        }

                    },
                    
                    messages: {
                        email: {
                            required: "Please enter the Email Id",
                            email: "Please enter the valid Email Id"
                            
                        },
                        number_addition :{
                            required:"Enter Addition of Number",
                        }
                    },
                    errorElement: "span",
                    /*submitHandler: function(form) {
                       saveFormDatas(form);
                     }*/
                });
                
                
                /* function saveFormDatas(form) {
                        var email = $("#regemail").val();
                        $.ajax({
                            type : 'POST',
                            data : {email:email},
                            url  : 'forgot-password-action.php',
                            datatype:'json',
                            cache:false,
                            success: function(response){
                                window.location.href = 'https://www.software-intent.com/forgot-password-success.php';
                            },
                             error: function (textStatus, errorThrown) {
                                 alert("Somthing Went Wrong, Please Try Again.");
                        }
                        });
                    }*/
                  $('.close').click(function(){
                   $('.alert').hide();
                 });
            });
            
          
        </script>
        