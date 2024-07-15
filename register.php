<?php
require_once("survey/classes/cls-survey.php");
$obj_survey = new Survey();
$page = "home";
$page_title = "Global Market Surveys | Register - " . SITETITLE;
$meta_description = "The insights that help you with worldwide industry survey, markets trends for future outlook and actionable insights to impact your industry.";
$meta_keywords = "";

include('common-header.php');
require_once("survey/classes/cls-country.php");
$obj_country = new Country();
$condition1 = "";
$country_details = $obj_country->getCountryDetails('', $condition1, '', '', 0);
?>
<style>
    .error{color:red;}
</style>
<section class="d-flex align-items-center justify-content-center ptb-5 position-relative">
    <div class="container">
        <div class="row row d-flex align-items-center">
           <!-- <div class="col-md-12">
                <img src="images/logo-light.png" class="img-fluid reg-logo pt-5">
            </div>-->
            <div class="col-md-12">
                <div class="text-end">
                    <img src="../images/pattern-top.png" class="img-fluid pattern-img-right">
                </div>
            </div>
            
            <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 mt-5 mb-5">
                
                <div class="reg-data">
                    <h1 class="text-center">Register Now</h1>
                    <div class="reg-form bg-white box-shadow">
                      <form role="form" id="registerForm" name="registerForm" method="GET" action="">
                           <input type="hidden" value="<?php echo SITEPATHFRONT; ?>" id="websitepath" name="websitepath">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">First Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="fname" id="fname">
                                        <span class="form-icon">
                                            <i class="fa fa-user"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Last Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="lname" id="lname">
                                        <span class="form-icon">
                                            <i class="fa fa-user"></i>
                                        </span>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                     <div class="form-group">
                                        <label class="form-label">Phone<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="phone" id="phone">
                                        <span class="form-icon">
                                            <i class="fa fa-phone"></i>
                                        </span>
                                    </div>
                                </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                        <label class="form-label">Email<span class="text-danger">*</span></label>
                                        <input type="email" class="form-control"  name="email" id="regemail">
                                        <span class="form-icon">
                                            <i class="fa fa-envelope"></i>
                                        </span>
                                     </div>
                                </div>
                                 <div class="col-md-6">
                                    <label class="form-label">Country<span class="text-danger">*</span></label>
                                    <select class="form-control form-select" id="country" name="country">
                                    <?php if (isset($country_details) && !empty($country_details)) { ?>
                                    <option value="" select>Select Country*</option>
                                        <?php foreach ($country_details as $country_detail) { ?>
                                        
                                            <option value="<?php echo $country_detail['name'] ?>"><?php echo $country_detail['name'] ?></option>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <option value="">No Results Found</option>
                                    <?php } ?>
                              </select>
                              <span class="form-icon">
                                  <i class="fa fa-flag"></i>
                              </span>
                                </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                        <label class="form-label">Company<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="company" id="company">
                                        <span class="form-icon">
                                            <i class="fa fa-building-o"></i>
                                        </span>
                                    </div>
                                </div>
                                
                                <!--  <div class="col-md-6">
                                      <div class="form-group">
                                        <label class="form-label">Username<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control"  name="username" id="username">
                                        <span class="form-icon">
                                            <i class="fa fa-user"></i>
                                        </span>
                                     </div>
                                </div>-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Password <span class="text-danger">*</span></label>
                                        <input type="password"  class="form-control" name="password" id="regpassword">
                                        <span class="form-icon">
                                           <i class="fa fa-lock"></i>
                                        </span>
                                    </div>
                                </div>
                                   <div class="col-md-6">
                                   <div class="form-group">
                                        <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                        <input type="password"  class="form-control" name="cpassword" id="regcpassword">
                                        <span class="form-icon">
                                           <i class="fa fa-lock"></i>
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <input type="submit" class="btn cta-btn m-0 w-100" value="Register Now">
                                    <span class="spinner-border spinner-border-md mt-4" role="status" aria-hidden="true" id="span_loader" style="display:none"></span>
                                     <h5 class="text-center fw-normal pt-3 pb-0">Already have an account? <a href="<?php echo SITEPATH; ?>login">Sign In</a></h5>
                                    <!--<p class="text-center mb-0">Or</p>
                                    <a href="" class="btn text-center w-100 blue-gradient-border">
                                        Login with Google
                                    </a>-->
                                    <!--<span class="form-icon">
                                        <img src="images/google.svg" alt="google-icon" class="img-fluid g-icon">
                                    </span>-->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--<div class="text-center pt-4">
                    <a href="<?php echo SITEPATHFRONT ?>privacy-policy" class="text-dark regpr border-end pe-3">Privacy Policy</a>
                    <a href="<?php echo SITEPATHFRONT ?>terms-and-conditions" class="text-dark regpr ps-3">Terms & Conditions</a>
                </div>-->
            </div>
            
            <div class="col-md-12">
                <div class="">
                    <img src="../images/pattern-bottom.png" class="img-fluid pattern-bottom-img">
                </div>
            </div>
        </div>
    </div>
</section>
<?php include('footer.php'); ?>
 <!-- jQuery -->
    <script src="<?php echo SITEPATH;?>bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo SITEPATH;?>bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="<?php echo SITEPATH;?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo SITEPATH;?>bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo SITEPATH;?>bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo SITEPATH;?>bower_components/chosen/chosen.jquery.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script type="text/javascript" src="<?php echo SITEPATH;?>bower_components/confirmation/bootstrap-confirmation.js"></script>
    <script src="<?php echo SITEPATH;?>tinymce/js/tinymce/tinymce.min.js"></script>
    <script src="<?php echo SITEPATH;?>dist/js/sb-admin-2.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo SITEPATH;?>survey/js/canvasjs.min.js"></script>
        <script src="<?php echo SITEPATH;?>js/custom.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="<?php echo SITEPATHFRONT ?>js/register.js"></script>
        <script src="<?php echo SITEPATHFRONT ?>js/jquery.validate.js"></script>