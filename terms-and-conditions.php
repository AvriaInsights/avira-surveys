<?php 
require_once("survey/classes/cls-survey.php");
$obj_survey = new Survey();
$page = "home";
$page_title = "Global Market Surveys | Terms & Conditions - " . SITETITLE;
$meta_description = "The insights that help you with worldwide industry survey, markets trends for future outlook and actionable insights to impact your industry.";
$meta_keywords = "";
include('common-header.php')?>
<section class="bg-img">
    <div class="container">
        <div class="row pt-5">
            <div class="card-back shadow-lg col-md-10 col-xl-10 offset-md-1 offset-xl-1">
                <div class="ScrollStyle mt-3" id="style-5">
                    <div class="force-overflow">
                        <div class="container">
                             <div class="row d-flex text-center">
                       <!-- <div class="col-md-2">
                            <img src="images/logo-light.png" class="company_logo" >
                        </div>-->
                                 <div class="col-md-8 offset-md-2 text-center">
                                    <h1 class="privacy-text pt-5 mb-5">Terms & Conditions</h1>
                                 </div>
                             </div>
                        </div>
                            <div class="col-md-12 card-text">
                                <h2 class="fw-bold">Third-Party Websites</h2>
                                <p class="fs-4">We do not sell, trade, or otherwise, transfer to outside parties your Personally Identifiable Information. This does not 
                                    include website or service hosting partners and other parties who assist us in operating our website or services, 
                                    conducting our business, or serving our users, so long as those parties agree to keep this information confidential. 
                                    We may also release information when its release is appropriate to comply with the law, enforce our site policies, or 
                                    protect ours or others’ rights, property or safety.</p>
                            </div>  
                            
                            <div class="col-md-12 card-text">
                                <h2 class="fw-bold ">Third-party links</h2>
                                <p class="fs-4">Occasionally, at our discretion, we may include or offer third-party products or services on our website. These 
                                    third-party sites have separate and independent privacy policies. We, therefore, have no responsibility or liability for 
                                    the content and activities of these linked sites. Nonetheless, we seek to protect the integrity of our site and welcome 
                                    any feedback about these sites.</p>
                            </div>
                            
                            <div class="col-md-12 card-text">
                                <h2 class="fw-bold">Your Rights</h2>
                                <p class="fs-4">Customers that fall under the EU-US Privacy Shield have certain legal rights to obtain information about how we 
                                    handle your personal data. Some of these rights may be confined to some exceptions or special scenarios. However, at any point in time, you can raise your concern to we will ensure to write back to you within a maximum of 15 
                                    business days</p>
                            </div>
                            
                            <div class="col-md-12 card-text mb-2">
                                <h2 class="fw-bold">How To Contact Us?</h2>
                                <p class="fs-4">If you have any question regarding our privacy policy, privacy@avirasurveys.com. We will revert to you within a
                                    maximum of 15 business days.</p>
                            </div>
                    </div>
              </div>
                            <div class="row d-flex text-center justify-content:center">
                                <div class=" col-md-12  mb-4 mt-5">
                                  <h2 class="h2-text">Feel free to send us an email at</h2>
                                  <a href="mailto:<?php echo SITEEMAIL; ?>" class="mail-btn mb-4"><?php echo SITEEMAIL; ?></a>
                                </div> 
                            </div>
            </div>  
        </div>
    </div>
</section>
<?php include('footer.php')?>