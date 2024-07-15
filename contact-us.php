<?php
require_once("survey/classes/cls-survey.php");
$obj_survey = new Survey();
$page = "contactus";
$page_title = "Avira Surveys - Contact | Avira Surveys - " . SITETITLE;
$meta_description = "Contact Avira Surveys today, we will cheerfully help you with worldwide industry survey, markets trends for future outlook and actionable insights to impact your industry.";
$meta_keywords = "";
include('common-header.php');
?>
<style>
</style>
<section class="d-flex align-items-center justify-content-center ptb-5 position-relative">
    <div class="container">
        <div class="d-flex align-items-center con-row">
           <!-- <div class="col-md-12">
                <img src="images/logo-light.png" class="img-fluid reg-logo pt-5">
            </div>-->
            <div class="con-back-upper">
                <div class="text-end">
                    <img src="../images/pattern-top.png" class="img-fluid pattern-img-right">
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-3 mt-5">
                    <img src="<?php echo SITEPATHFRONT?>images/contact-us-character.png" alt="second-img" class="img-fluid woman-img mt-5">
                </div>
                <div class="col-md-3">
                    <div class="para1">
                        <h1 class="heading-1">Let's Connect</h1>
                        <p class="paragraph">Wish to talk to us? Some quick details, and let’s get in touch, now. We’d love to hear from you, be it anything.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="reg-data pt-5">
                          <div class="col-md-12 col-md-offset-1">
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
                          </div>
                          <div class="reg-form bg-white box-shadow mt-5 contact-us-page">
                            <form role="form" id="contactForm" name="contactForm" method="POST" action="">
                               <input type="hidden" value="<?php echo SITEPATH; ?>" id="websitepath">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Full Name<span class="v-color">*</span></label>
                                            <input type="text" class="form-control" name="fname" id="fname">
                                            <span class="form-icon">
                                                <i class="fa fa-user"></i>
                                            </span>
                                        </div>
                                    </div>
                                   
                                     <div class="col-md-6">
                                         <div class="form-group">
                                            <label class="form-label">Contact No<span class="v-color">*</span></label>
                                            <input type="number" class="form-control" name="phone" id="phone">
                                            <span class="form-icon">
                                                <i class="fa fa-phone"></i>
                                            </span>
                                        </div>
                                    </div>
                                    
                                      
                                      <div class="col-md-6">
                                          <div class="form-group">
                                                <label class="form-label">Email<span class="v-color">*</span></label>
                                                <input type="email" class="form-control"  name="email" id="regemail">
                                                <span class="form-icon">
                                                    <i class="fa fa-envelope"></i>
                                                </span>
                                            </div>
                                        </div>
                                     
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Message <span class="v-color">*</span></label>
                                            <textarea class="form-control" name="txt_message" id="txt_message" row="3"></textarea>
                                            <span class="form-icon message-text">
                                               <i class="fa fa-edit"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                         <input type="submit" class="btn cta-btn s-button m-0 shadow-sm " value="Submit">
                                    </div>
                                </div>
                          </form>
                          </div>
                    </div>
                    <div class="card-end mb-5">
                        <div class="p-4">
                            <div class="addresss-menu">
                                <div class="icon-menu"><i class="fa fa-map-marker text-info fs-2"></i></div>
                                <div class="address-dt">
                                    <span>201 Shreeleela Plaza, Baner Road, Pune, 411045, Maharashtra</span>
                                </div>
                            </div>
                            <div class="add-mail-common">
                                <div class="addresss-menu">
                                    <div class="icon-menu"><i class="fa fa-phone text-info fs-2"></i></div>
                                    <div class="address-dt">
                                        <a href="tel:+1 (407) 768-2028" class="">+1 (407) 768-2028</a>
                                    </div>
                                </div>
                                <div class="addresss-menu">
                                    <div class="icon-menu"><i class="fa fa-envelope text-info fs-2"></i></div>
                                    <div class="address-dt">
                                        <a href="mailto:contactus@avirasurveys.com">contactus@avirasurveys.com</a><span class="d-block"></span>
                                        <!--<a href="mailto:sales@avirasurveys.com">sales@avirasurveys.com</a>-->
                                    </div>
                                </div>
                            <div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <img src="../images/pattern-top.png" class="img-fluid pattern-bottom-img contact-bottom-bg">
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</section>
<?php include('footer.php'); ?>
<script>
//     $(document).ready(function() {
//   $('.select').material_select();
// });
</script>

<script>
    MakeMenuActive("contact-us");
</script>
<script>
    window.onscroll = function () {
    changeHeader();
    };

    var header = document.getElementById("myHeader");
    var sticky = header.offsetTop;
    
    function changeHeader() {
        if (window.pageYOffset > sticky) {
            header.classList.add("sticky");
        } else {
            header.classList.remove("sticky");
        }
    }
</script>
<!-- jQuery -->
    <script src="<?php echo SITEPATH;?>bower_components/jquery/dist/jquery.min.js"></script>
    <!--<script src="<?php echo SITEPATH;?>js/custom.js"></script>-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="js/contact.js"></script>
    <script src="js/jquery.validate.js"></script>