<?php
$page_title = "Avira Surveys | Forgot Password";
$meta_description = "The insights that help you with worldwide industry survey, markets trends for future outlook and actionable insights to impact your industry.";
$meta_keywords = "";
include('common-header.php');
?>
<style>
    .error{color:red;}
</style>
<section class="d-flex align-items-center justify-content-center ptb-5 position-relative">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-md-12">
                <div class="text-end">
                    <img src="../images/pattern-top.png" class="img-fluid pattern-img-right">
                </div>
            </div>
                <div class="row d-flex">
                    <div class="col-md-3 offset-md-1">
                        <img src="<?php echo SITEPATHFRONT?>/images/Character-for-reset-password.png" class="img-fluid fpassword-image">
                    </div>
                    <div class="col-md-7 text-center fpassword-content">
                        <img src="/images/verified.svg" class="img-fluid tick-icon">
                        <h1 class="succes-msg">Info! Email send successfully.</h1>
                        <div class="text-center mt-4">
                            <a class=" btn flogin-btn cta-btn mt-4 shadow-md" href="<?php echo SITEPATH ?>login.php">Login</a>
                        </div>
                        <div class="text-center pt-4">
                            <a href="<?php echo SITEPATHFRONT ?>privacy-policy" class="text-dark regpr border-end pe-3">Privacy Policy</a>
                            <a href="<?php echo SITEPATHFRONT ?>terms-and-conditions" class="text-dark regpr ps-3">Terms & Conditions</a>
                        </div>
                    </div>
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
     <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script type="text/javascript" src="<?php echo SITEPATH;?>bower_components/confirmation/bootstrap-confirmation.js"></script>
    <script src="<?php echo SITEPATH;?>tinymce/js/tinymce/tinymce.min.js"></script>
    <script src="<?php echo SITEPATH;?>dist/js/sb-admin-2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo SITEPATH;?>survey/js/canvasjs.min.js"></script>
