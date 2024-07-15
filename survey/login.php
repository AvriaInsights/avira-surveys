<?php
$page = "Login";
$page_title = "Avira Survey ";
$meta_description = "";
$meta_keywords = "";
include('admin-common-header.php');
?>
<style>
.close{
    border: none !important;
    font-size: 17px;
    background: transparent;
    float: right;
    padding: 0px;
    margin: -4px;
}
</style>
<section class="">
    <div class="container-fluid">
        <div class="row d-flex align-items-center">
            <div class="col-lg-6 login-bg">
                <div class="c-txt">
                    <!--<img src="images/bg-pattern-login.jpg" class="img-fluid pattern-bottom-img ">-->
                    <img src="../images/logo-light.png" class="img-fluid login-c-logo pt-5">
                    <img src="../images/Flying-lady.png" alt="login-img" class="img-fluid w-40 pb-5 pt-5 login-img">
                    <h1 class="mb-0 login-txt">We are listening!
                        <!--span class="d-block"></span>predict trends!-->
                    </h1>
                    <p class="login-p">Login for our surveys and unlock features that fit your needs</p>
                </div>
            </div>
            <div class="col-lg-4 offset-lg-1">
                <div class="login-form">
                    
                    <div class="col-md-12 col-md-offset-4">
                       <!-- <h3 class="page-header text-center">Admin Panel</h3>-->
                        <?php if (isset($_SESSION['error'])) { ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <?php
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                            ?>
                        </div>
                        <?php } ?>
                        
                         <?php if (isset($_SESSION['success'])) { ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php
                            echo $_SESSION['success'];
                            unset($_SESSION['success']);
                            ?>
                             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                             </button>
                        </div>
                        <?php } ?>
                    </div>
                    
                    <h2 class="ttl fw-bold pb-4">Welcome to Avira Survey</h2>
                     <form role="form" id="signinForm" autocomplete="off" method="POST" action="<?php echo SITEPATH; ?>login-action.php">
                          <div class="col-md-12">
                              <div class="form-group">
                                <label class="form-label">Email</label>
                                <input class="form-control" placeholder="Email" name="uname" type="text" autofocus value="<?php echo isset($_COOKIE['alxa_uname']) ? trim($_COOKIE['alxa_uname']) : ""; ?>" aria-describedby="">
                                <span class="form-icon">
                                    <i class="fa fa-envelope"></i>
                                </span>
                               </div>
                            </div>
                            <div class="col-md-12">
                               <div class="form-group">
                                 <label class="form-label">Password</label>
                                <input class="form-control" placeholder="Password" name="password" type="password" value="<?php echo isset($_COOKIE['alxa_password']) ? trim($_COOKIE['alxa_password']) : ""; ?>" aria-describedby="">
                                <span class="form-icon">
                                    <i class="fa fa-lock"></i>
                                </span>
                             </div>
                            </div>
                        <a class="" href="<?php echo SITEPATHFRONT ?>forgot-password.php">Forgot Password</a>
                         <div class="checkbox mt-4 mb-4">
                            <label class="">
                                <input name="remember" type="checkbox" checked="checked">
                                Remember Me 
                            </label>
                         </div>
                         
                        <input type="submit" class="btn cta-btn m-0 w-100" name="btn_submit" class="btn btn-success btn-block" value="Login">
                        <!--<p class="text-center mb-0">Or</p>
                        <a href="" class="btn text-center w-100 blue-gradient-border">
                            Login with Google
                        </a>
                        <span class="form-icon">
                            <img src="../images/google.svg" alt="google-icon" class="img-fluid g-icon">
                        </span> -->
                        <h5 class="text-center fw-normal pt-3 pb-0">New to Avirasurveys? <a href="<?php echo SITEPATHFRONT; ?>register">Sign up</a></h5>
                      </div>
                    </form>
                     <div class="text-center pt-4">
                    <a href="<?php echo SITEPATHFRONT; ?>privacy-policy" class="text-dark border-end pe-3 regpr">Privacy Policy</a>
                    <a href="<?php echo SITEPATHFRONT; ?>terms-and-conditions" class="text-dark ps-3 regpr">Terms & Conditions</a>
                </div>
                </div>
               
                
            </div>
        </div>
    </div>
</section>
<?php // include('footer.php')?>
  <!-- jQuery -->
        <script src="<?php echo SITEPATH; ?>bower_components/jquery/dist/jquery.min.js"></script>
        <script src="<?php echo SITEPATH; ?>bower_components/jquery-validation/jquery.validate.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <!-- Metis Menu Plugin JavaScript -->
        <!-- Custom Theme JavaScript -->
        <script src="<?php echo SITEPATH; ?>dist/js/sb-admin-2.js"></script>
        <script src="<?php echo SITEPATHFRONT ?>js/jquery.validate.js"></script>
        <script src="<?php echo SITEPATH; ?>js/login.js"></script>