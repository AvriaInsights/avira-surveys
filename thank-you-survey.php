<?php
require_once("survey/classes/cls-survey.php");
$obj_survey = new Survey();
$_SESSION['response_user_id']="";
$_SESSION['half_mail']="";
$_SESSION['last_form_user_response_id']="";
$_SESSION['first_form_fname']="";
$_SESSION['first_form_email']="";
unset($_SESSION['response_user_id']);
unset($_SESSION['half_mail']);
unset($_SESSION['last_form_user_response_id']);
unset($_SESSION['first_form_fname']);
unset($_SESSION['first_form_email']);
$page = "home";
$page_title = "Global Market Surveys | Thank You - " . SITETITLE;
$meta_description = "The insights that help you with worldwide industry survey, markets trends for future outlook and actionable insights to impact your industry.";
$meta_keywords = "";
include('common-header.php');

$surveyid=$_GET['surveyid'];
$fields_survey= "*";
$condition_survey = "`tbl_survey`.`survey_id` = '".$surveyid."'";
$all_surveys_details = $obj_survey->getSurveyDetail($fields_survey, $condition_survey, '', '', 0);
foreach($all_surveys_details as $all_surveys_detail)
{
$footer_tagline=$all_surveys_detail['footer_tagline'];
}
?>
<style>
    .custom-radio [type="radio"]:checked,
    .custom-radio [type="radio"]:not(:checked) {
        position: absolute;
        left: -9999px;
    }
    .custom-radio [type="radio"]:checked + label,
    .custom-radio [type="radio"]:not(:checked) + label
    {
        position: relative;
        padding-left: 28px;
        cursor: pointer;
        line-height: 20px;
        display: inline-block;
        color: #000;
    }
    .custom-radio [type="radio"]:checked + label:before,
    .custom-radio [type="radio"]:not(:checked) + label:before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 18px;
        height: 18px;
        border: 1px solid #000;
        border-radius: 100%;
        background: #fff;
    }
    .custom-radio [type="radio"]:checked + label:after,
    .custom-radio [type="radio"]:not(:checked) + label:after {
        content: '';
        width: 12px;
        height: 12px;
        background: #00c6ff;
        position: absolute;
        top: 3px;
        left: 3.4px;
        border-radius: 100%;
        -webkit-transition: all 0.2s ease;
        transition: all 0.2s ease;
    }
    .custom-radio [type="radio"]:not(:checked) + label:after {
        opacity: 0;
        -webkit-transform: scale(0);
        transform: scale(0);
    }
    .custom-radio [type="radio"]:checked + label:after {
        opacity: 1;
        -webkit-transform: scale(1);
        transform: scale(1);
    }
    .tick-icon{
        display:block;
        margin:0 auto;
        padding-bottom:3rem;
    }
    .custom-radio{
        display:flex;
        align-items:center;
        justify-content:center;
    }
    .fpassword-content p{
        font-size:1.5rem;
    }
    .fpassword-content h4{
        font-size:1.8rem;
    }
</style>
<section class="part-2 d-flex align-items-center justify-content-center thank-you-banner">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-md-12">
                <div class="text-end">
                    <img src="<?php echo SITEPATHFRONT?>images/pattern-top.png" class="img-fluid pattern-img-right">
                </div>
            </div>
            <div class="container">
                <div class="row d-flex">
                    <div class="col-md-3">
                        <div class="t-you-img">
                            <img src="<?php echo SITEPATHFRONT?>/images/thank-you-character.png" class="img-fluid fpassword-image">
                        </div>
                    </div>
                    <div class="col-md-9 fpassword-content t-content">
                        
                            <img src="<?php echo SITEPATHFRONT?>images/verified.svg" class="img-fluid tick-icon">
                      
                        <h1 class="succes-msg text-center">Thank you for your Valuable Response!</h1>
                        <!--<h3>Use this password to login to you app or continue to your web dashboard</h3>-->
                        <?php if(isset($footer_tagline) && !empty($footer_tagline)){
                                 if($surveyid=="74d5313c-41e6-4119-9d36-072c8cd2fec9" || $surveyid=="5ca9f3aa-8940-414c-a495-a0967257067c" || $surveyid=="aad4cddc-2b03-4945-8b7a-9501ce47fede" || $surveyid=="4077f44b-b12f-40c3-810b-7452339f62b9" || $surveyid=="9cf679b9-764c-478d-a4b0-6bf92adb4a17" || $surveyid=="df5aa94e-1cc4-43a6-8407-d7f092e6b7f9" || $surveyid=="f154a4db-2e92-482e-8e5c-ef998668a328" || $surveyid=="fcca2f85-bca3-4fe6-9fcb-f7ea18f33641")
                                 {
                        ?>
                            <h4 class="text-center pb-4 mb-0">Appreciate your inputs!</h4>
                            <p class="text-center">Please let us know which of the below studies you would like to download</p>
                            <div class="custom-radio">
                                <form action="#" method="POST" id="report_mail">
                                    <input type="hidden" name="fname" id="fname" value="<?php echo $_GET['fname']; ?>">
                                    <input type="hidden" name="email" id="email" value="<?php echo $_GET['email']; ?>">
                                  <p>
                                    <input type="radio" id="test1" name="radio-group" class="report_val" value="Medical Equipment Global Market Competitor Briefing">
                                    <label for="test1">Medical Equipment Global Market Competitor Briefing</label>
                                   </p>
                                   <p>
                                        <input type="radio" id="test2" name="radio-group" class="report_val" value="2022 Global_ Medical Imaging Workstations">
                                        <label for="test2">2022 Global_ Medical Imaging Workstations</label>
                                    </p>
                                    <p>
                                        <input type="radio" id="test3" name="radio-group" class="report_val" value="Medical Equipment Market Global Briefing 2021-In-Vitro Diagnostic">
                                        <label for="test3">Medical Equipment Market Global Briefing 2021-In-Vitro Diagnostic</label>
                                    </p>
                                    <!--<p>-->
                                    <!--    <input type="radio" id="test3" name="radio-group" class="report_val" value="Global Packaged AI-Based Medical Imaging Market">-->
                                    <!--    <label for="test3">Global Packaged AI-Based Medical Imaging Market</label>-->
                                    <!--</p>-->
                                    <!--<p>-->
                                    <!--    <input type="radio" id="test4" name="radio-group" class="report_val" value="Medical And Diagnostic Laboratory Services Market.">-->
                                    <!--    <label for="test4">Medical And Diagnostic Laboratory Services Market.</label>-->
                                    <!--</p>-->
                                    <div class="text-center mt-4">
                                     <input type="submit" class="btn cta-btn mt-4 shadow-md" id="report_submit" value="Download">
                                    </div>
                                </form>
                            </div>
                        <?php } }else {?>
                        <?php if($surveyid=="160de9a7-bf5b-4f3b-8dd3-d3d2de7976f1"){ ?> 
                           
                            <p class="text-center mt-3">Click here to download our recently published e-book on "Critical capabilities for choosing an SMS API provider"</p>
                            <div class="custom-radio">
                                <form action="#" method="POST" id="report_mail">
                                    <input type="hidden" name="fname" id="fname" value="<?php echo $_GET['fname']; ?>">
                                    <input type="hidden" name="email" id="email" value="<?php echo $_GET['email']; ?>">
                                  <p class="d-none">
                                    <input type="radio" id="test10" name="radio-group" class="report_val" value="Analyzing the ins and outs of SMS API's" checked="checked">
                                    <label for="test110">Analyzing the ins and outs of SMS API's</label>
                                   </p>
                                    <div class="text-center mt-1">
                                     <input type="submit" class="btn cta-btn mt-4 shadow-md" id="report_submit" value="Download">
                                    </div>
                                    <div class="text-center mt-4">
                                    <p>One of our experts from Twilio will get in touch to take quick feedback.</p>
                                    </div>
                                </form>
                            </div>
                        
                        <?php } ?>
                        <?php if($surveyid=="79fc442d-01ff-4cd2-b018-e7de078bdf26"){ ?> 
                           
                            <p class="text-center mt-3">Click here to download our recently published e-book on "SMS API'S: Measuring the integration across different industries."</p>
                            <div class="custom-radio">
                                <form action="#" method="POST" id="report_mail">
                                    <input type="hidden" name="fname" id="fname" value="<?php echo $_GET['fname']; ?>">
                                    <input type="hidden" name="email" id="email" value="<?php echo $_GET['email']; ?>">
                                  <p class="d-none">
                                    <input type="radio" id="test10" name="radio-group" class="report_val" value="SMS API'S: Measuring the integration across different industries." checked="checked">
                                    <label for="test110">SMS API'S: Measuring the integration across different industries.</label>
                                   </p>
                                    <div class="text-center mt-1">
                                     <input type="submit" class="btn cta-btn mt-4 shadow-md" id="report_submit" value="Download">
                                    </div>
                                    <div class="text-center mt-4">
                                    <p>One of our experts from Twilio will get in touch to take quick feedback.</p>
                                    </div>
                                </form>
                            </div>
                        
                        <?php } ?>
                        
                        <!----------------------------------------Twilio Flex--------------------------------------------->
                        <?php if($surveyid=="dfce8e45-bebd-451e-b299-e93c899bf1aa"){ ?> 
                           
                            <p class="text-center mt-3">Click here to download our recently published e-book on "The Most Flexible Cloud Contact Center."</p>
                            <div class="custom-radio">
                                <form action="#" method="POST" id="report_mail">
                                    <input type="hidden" name="fname" id="fname" value="<?php echo $_GET['fname']; ?>">
                                    <input type="hidden" name="email" id="email" value="<?php echo $_GET['email']; ?>">
                                  <p class="d-none">
                                    <input type="radio" id="test10" name="radio-group" class="report_val" value="Survey on- Understanding the contact center ecosystem." checked="checked">
                                    <label for="test110">Survey on- Understanding the contact center ecosystem.</label>
                                   </p>
                                    <div class="text-center mt-1">
                                     <input type="submit" class="btn cta-btn mt-4 shadow-md" id="report_submit" value="Download">
                                    </div>
                                    <div class="text-center mt-4">
                                    <p>One of our experts from Twilio Flex will get in touch to take quick feedback.</p>
                                    </div>
                                </form>
                            </div>
                        
                        <?php } ?>
                        <?php if($surveyid=="21277bce-097f-46e8-a382-e7ea5a508647"){ ?> 
                           
                            <p class="text-center mt-3">Click here to download our recently published e-book on "The Most Flexible Cloud Contact Center."</p>
                            <div class="custom-radio">
                                <form action="#" method="POST" id="report_mail">
                                    <input type="hidden" name="fname" id="fname" value="<?php echo $_GET['fname']; ?>">
                                    <input type="hidden" name="email" id="email" value="<?php echo $_GET['email']; ?>">
                                  <p class="d-none">
                                    <input type="radio" id="test10" name="radio-group" class="report_val" value="A survey to analyze the trends in contact center solution." checked="checked">
                                    <label for="test110">A survey to analyze the trends in contact center solution.</label>
                                   </p>
                                    <div class="text-center mt-1">
                                     <input type="submit" class="btn cta-btn mt-4 shadow-md" id="report_submit" value="Download">
                                    </div>
                                    <div class="text-center mt-4">
                                    <p>One of our experts from Twilio Flex will get in touch to take quick feedback.</p>
                                    </div>
                                </form>
                            </div>
                        
                        <?php } ?>
                        <?php if($surveyid=="1cbdf1c5-d893-41bf-8d21-20c082ea191e"){ ?> 
                           
                            <p class="text-center mt-3">Click here to download our recently published e-book on "The Most Flexible Cloud Contact Center."</p>
                            <div class="custom-radio">
                                <form action="#" method="POST" id="report_mail">
                                    <input type="hidden" name="fname" id="fname" value="<?php echo $_GET['fname']; ?>">
                                    <input type="hidden" name="email" id="email" value="<?php echo $_GET['email']; ?>">
                                  <p class="d-none">
                                    <input type="radio" id="test10" name="radio-group" class="report_val" value="Survey for in-depth analysis on technological solutions in contact center system." checked="checked">
                                    <label for="test110">Survey for in-depth analysis on technological solutions in contact center system.</label>
                                   </p>
                                    <div class="text-center mt-1">
                                     <input type="submit" class="btn cta-btn mt-4 shadow-md" id="report_submit" value="Download">
                                    </div>
                                    <div class="text-center mt-4">
                                    <p>One of our experts from Twilio Flex will get in touch to take quick feedback.</p>
                                    </div>
                                </form>
                            </div>
                        
                        <?php } ?>
                        <?php if($surveyid=="ac75792b-d88a-4b1c-805f-12952dd0182e"){ ?> 
                           
                            <p class="text-center mt-3">Click here to download our recently published e-book on "The Most Flexible Cloud Contact Center."</p>
                            <div class="custom-radio">
                                <form action="#" method="POST" id="report_mail">
                                    <input type="hidden" name="fname" id="fname" value="<?php echo $_GET['fname']; ?>">
                                    <input type="hidden" name="email" id="email" value="<?php echo $_GET['email']; ?>">
                                  <p class="d-none">
                                    <input type="radio" id="test10" name="radio-group" class="report_val" value="Analyzing primary channel check list for omnichannel solutions(Contact Center, BPO)" checked="checked">
                                    <label for="test110">Analyzing primary channel check list for omnichannel solutions(Contact Center, BPO)</label>
                                   </p>
                                    <div class="text-center mt-1">
                                     <input type="submit" class="btn cta-btn mt-4 shadow-md" id="report_submit" value="Download">
                                    </div>
                                    <div class="text-center mt-4">
                                    <p>One of our experts from Twilio Flex will get in touch to take quick feedback.</p>
                                    </div>
                                </form>
                            </div>
                        
                        <?php } ?>
                        <?php if($surveyid=="8353fad2-f374-4c81-b8e4-1dcb237b58f8"){ ?> 
                           
                            <p class="text-center mt-3">Click here to download our recently published e-book on "The Most Flexible Cloud Contact Center."</p>
                            <div class="custom-radio">
                                <form action="#" method="POST" id="report_mail">
                                    <input type="hidden" name="fname" id="fname" value="<?php echo $_GET['fname']; ?>">
                                    <input type="hidden" name="email" id="email" value="<?php echo $_GET['email']; ?>">
                                  <p class="d-none">
                                    <input type="radio" id="test10" name="radio-group" class="report_val" value="Conducting a survey to understand challenges faced using omnichannel solutions." checked="checked">
                                    <label for="test110">Conducting a survey to understand challenges faced using omnichannel solutions.</label>
                                   </p>
                                    <div class="text-center mt-1">
                                     <input type="submit" class="btn cta-btn mt-4 shadow-md" id="report_submit" value="Download">
                                    </div>
                                    <div class="text-center mt-4">
                                    <p>One of our experts from Twilio Flex will get in touch to take quick feedback.</p>
                                    </div>
                                </form>
                            </div>
                        
                        <?php } ?>
                        <?php if($surveyid=="b5d257b1-86c8-489b-af6c-c3a1ca195cbb"){ ?> 
                           
                            <p class="text-center mt-3">Click here to download our recently published e-book on "The Most Flexible Cloud Contact Center."</p>
                            <div class="custom-radio">
                                <form action="#" method="POST" id="report_mail">
                                    <input type="hidden" name="fname" id="fname" value="<?php echo $_GET['fname']; ?>">
                                    <input type="hidden" name="email" id="email" value="<?php echo $_GET['email']; ?>">
                                  <p class="d-none">
                                    <input type="radio" id="test10" name="radio-group" class="report_val" value="Surveying the key attributes of a contact center solutions." checked="checked">
                                    <label for="test110">Surveying the key attributes of a contact center solutions.</label>
                                   </p>
                                    <div class="text-center mt-1">
                                     <input type="submit" class="btn cta-btn mt-4 shadow-md" id="report_submit" value="Download">
                                    </div>
                                    <div class="text-center mt-4">
                                    <p>One of our experts from Twilio Flex will get in touch to take quick feedback.</p>
                                    </div>
                                </form>
                            </div>
                        
                        <?php } ?>
                        <?php if($surveyid=="98349e04-cfa1-43da-bcaf-3a34e8abede7"){ ?> 
                           
                            <p class="text-center mt-3">Click here to download our recently published e-book on "The Most Flexible Cloud Contact Center."</p>
                            <div class="custom-radio">
                                <form action="#" method="POST" id="report_mail">
                                    <input type="hidden" name="fname" id="fname" value="<?php echo $_GET['fname']; ?>">
                                    <input type="hidden" name="email" id="email" value="<?php echo $_GET['email']; ?>">
                                  <p class="d-none">
                                    <input type="radio" id="test10" name="radio-group" class="report_val" value="Survey-on-understanding-contact-center-cx-programs." checked="checked">
                                    <label for="test110">Survey-on-understanding-contact-center-cx-programs.</label>
                                   </p>
                                    <div class="text-center mt-1">
                                     <input type="submit" class="btn cta-btn mt-4 shadow-md" id="report_submit" value="Download">
                                    </div>
                                    <div class="text-center mt-4">
                                    <p>One of our experts from Twilio Flex will get in touch to take quick feedback.</p>
                                    </div>
                                </form>
                            </div>
                        
                        <?php } ?>
                        
                        
                        <!----------------------Imocha----------------------------->
                        <?php if($surveyid=="f5d5d471-af84-4cd3-8971-281c462c018c" || $surveyid=="3069d974-8d02-42c1-a0e3-8ea80f8cd966" || $surveyid=="d6b8d0f7-1b43-4911-8956-810097c7b5d9" || $surveyid=="90f35c85-3ae7-4609-9279-10b426473d3e" || $surveyid=="99cb3fa9-2d8d-4d01-9963-5d7c82d0d810" || $surveyid=="57019294-7e40-493d-bde8-a1c0c3affabb" || $surveyid=="cb7c2488-4cd7-4fa1-889c-5e904988cc18"){ ?>
                                <p class="text-center mt-3">We will send you the report soon.</p>
                        <?php }?>
                        <?php //if($surveyid=="f5d5d471-af84-4cd3-8971-281c462c018c"){ ?> 
                           
                            <!--<p class="text-center mt-3">Click here to download our recently published blog on "Why we need Skills Intelligence as a core of talent transformation."</p>-->
                            <!--<div class="custom-radio">-->
                            <!--    <form action="#" method="POST" id="report_mail">-->
                            <!--        <input type="hidden" name="fname" id="fname" value="<?php echo $_GET['fname']; ?>">-->
                            <!--        <input type="hidden" name="email" id="email" value="<?php echo $_GET['email']; ?>">-->
                            <!--      <p class="d-none">-->
                            <!--        <input type="radio" id="test10" name="radio-group" class="report_val" value="Survey on-How Talent heads have scaled up their Hiring and Acquisition Game." checked="checked">-->
                            <!--        <label for="test110">Survey on-How Talent heads have scaled up their Hiring and Acquisition Game.</label>-->
                            <!--       </p>-->
                            <!--        <div class="text-center mt-1">-->
                            <!--         <input type="submit" class="btn cta-btn mt-4 shadow-md" id="report_submit" value="E-book">-->
                            <!--        </div>-->
                            <!--        <div class="text-center mt-4">-->
                            <!--        <p>One of our experts from iMocha will get in touch to take quick feedback.</p>-->
                            <!--        </div>-->
                            <!--    </form>-->
                            <!--</div>-->
                        
                        <?php //} ?>
                        <?php //if($surveyid=="3069d974-8d02-42c1-a0e3-8ea80f8cd966"){ ?> 
                           
                            <!--<p class="text-center mt-3">Click here to download our recently published blog on "Why we need Skills Intelligence as a core of talent transformation."</p>-->
                            <!--<div class="custom-radio">-->
                            <!--    <form action="#" method="POST" id="report_mail">-->
                            <!--        <input type="hidden" name="fname" id="fname" value="<?php echo $_GET['fname']; ?>">-->
                            <!--        <input type="hidden" name="email" id="email" value="<?php echo $_GET['email']; ?>">-->
                            <!--      <p class="d-none">-->
                            <!--        <input type="radio" id="test10" name="radio-group" class="report_val" value="SME's perspective to understand the greatest need for skills assessment among employees." checked="checked">-->
                            <!--        <label for="test110">SME's perspective to understand the greatest need for skills assessment among employees.</label>-->
                            <!--       </p>-->
                            <!--        <div class="text-center mt-1">-->
                            <!--         <input type="submit" class="btn cta-btn mt-4 shadow-md" id="report_submit" value="E-book">-->
                            <!--        </div>-->
                            <!--        <div class="text-center mt-4">-->
                            <!--        <p>One of our experts from iMocha will get in touch to take quick feedback.</p>-->
                            <!--        </div>-->
                            <!--    </form>-->
                            <!--</div>-->
                        
                        <?php //} ?>
                        <?php //if($surveyid=="d6b8d0f7-1b43-4911-8956-810097c7b5d9"){ ?> 
                           
                            <!--<p class="text-center mt-3">Click here to download our recently published blog on "Why we need Skills Intelligence as a core of talent transformation."</p>-->
                            <!--<div class="custom-radio">-->
                            <!--    <form action="#" method="POST" id="report_mail">-->
                            <!--        <input type="hidden" name="fname" id="fname" value="<?php echo $_GET['fname']; ?>">-->
                            <!--        <input type="hidden" name="email" id="email" value="<?php echo $_GET['email']; ?>">-->
                            <!--      <p class="d-none">-->
                            <!--        <input type="radio" id="test10" name="radio-group" class="report_val" value="To understand perspectives of industry-leaders on investing in 3rd party Skill development." checked="checked">-->
                            <!--        <label for="test110">To understand perspectives of industry-leaders on investing in 3rd party Skill development.</label>-->
                            <!--       </p>-->
                            <!--        <div class="text-center mt-1">-->
                            <!--         <input type="submit" class="btn cta-btn mt-4 shadow-md" id="report_submit" value="E-book">-->
                            <!--        </div>-->
                            <!--        <div class="text-center mt-4">-->
                            <!--        <p>One of our experts from iMocha will get in touch to take quick feedback.</p>-->
                            <!--        </div>-->
                            <!--    </form>-->
                            <!--</div>-->
                        
                        <?php //} ?>
                        <?php //if($surveyid=="90f35c85-3ae7-4609-9279-10b426473d3e"){ ?> 
                           
                            <!--<p class="text-center mt-3">Click here to download our recently published blog on "Why we need Skills Intelligence as a core of talent transformation."</p>-->
                            <!--<div class="custom-radio">-->
                            <!--    <form action="#" method="POST" id="report_mail">-->
                            <!--        <input type="hidden" name="fname" id="fname" value="<?php echo $_GET['fname']; ?>">-->
                            <!--        <input type="hidden" name="email" id="email" value="<?php echo $_GET['email']; ?>">-->
                            <!--      <p class="d-none">-->
                            <!--        <input type="radio" id="test10" name="radio-group" class="report_val" value="To ascertain upskilling areas among employees with 3rd party vendor." checked="checked">-->
                            <!--        <label for="test110">To ascertain upskilling areas among employees with 3rd party vendor.</label>-->
                            <!--       </p>-->
                            <!--        <div class="text-center mt-1">-->
                            <!--         <input type="submit" class="btn cta-btn mt-4 shadow-md" id="report_submit" value="E-book">-->
                            <!--        </div>-->
                            <!--        <div class="text-center mt-4">-->
                            <!--        <p>One of our experts from iMocha will get in touch to take quick feedback.</p>-->
                            <!--        </div>-->
                            <!--    </form>-->
                            <!--</div>-->
                        
                        <?php //} ?>
                        <?php //if($surveyid=="99cb3fa9-2d8d-4d01-9963-5d7c82d0d810"){ ?> 
                           
                            <!--<p class="text-center mt-3">Click here to download our recently published blog on "Why we need Skills Intelligence as a core of talent transformation."</p>-->
                            <!--<div class="custom-radio">-->
                            <!--    <form action="#" method="POST" id="report_mail">-->
                            <!--        <input type="hidden" name="fname" id="fname" value="<?php echo $_GET['fname']; ?>">-->
                            <!--        <input type="hidden" name="email" id="email" value="<?php echo $_GET['email']; ?>">-->
                            <!--      <p class="d-none">-->
                            <!--        <input type="radio" id="test10" name="radio-group" class="report_val" value="A survey on-Pre-Employment skill testing within organizations." checked="checked">-->
                            <!--        <label for="test110">A survey on-Pre-Employment skill testing within organizations.</label>-->
                            <!--       </p>-->
                            <!--        <div class="text-center mt-1">-->
                            <!--         <input type="submit" class="btn cta-btn mt-4 shadow-md" id="report_submit" value="E-book">-->
                            <!--        </div>-->
                            <!--        <div class="text-center mt-4">-->
                            <!--        <p>One of our experts from iMocha will get in touch to take quick feedback.</p>-->
                            <!--        </div>-->
                            <!--    </form>-->
                            <!--</div>-->
                        
                        <?php //} ?>
                        <?php //if($surveyid=="57019294-7e40-493d-bde8-a1c0c3affabb"){ ?> 
                           
                            <!--<p class="text-center mt-3">Click here to download our recently published blog on "Why we need Skills Intelligence as a core of talent transformation."</p>-->
                            <!--<div class="custom-radio">-->
                            <!--    <form action="#" method="POST" id="report_mail">-->
                            <!--        <input type="hidden" name="fname" id="fname" value="<?php echo $_GET['fname']; ?>">-->
                            <!--        <input type="hidden" name="email" id="email" value="<?php echo $_GET['email']; ?>">-->
                            <!--      <p class="d-none">-->
                            <!--        <input type="radio" id="test10" name="radio-group" class="report_val" value="To cope with the rapidly changing skill requirement of the workforce." checked="checked">-->
                            <!--        <label for="test110">To cope with the rapidly changing skill requirement of the workforce.</label>-->
                            <!--       </p>-->
                            <!--        <div class="text-center mt-1">-->
                            <!--         <input type="submit" class="btn cta-btn mt-4 shadow-md" id="report_submit" value="E-book">-->
                            <!--        </div>-->
                            <!--        <div class="text-center mt-4">-->
                            <!--        <p>One of our experts from iMocha will get in touch to take quick feedback.</p>-->
                            <!--        </div>-->
                            <!--    </form>-->
                            <!--</div>-->
                        
                        <?php //} ?>
                        <?php //if($surveyid=="cb7c2488-4cd7-4fa1-889c-5e904988cc18"){ ?> 
                           
                            <!--<p class="text-center mt-3">Click here to download our recently published blog on "Why we need Skills Intelligence as a core of talent transformation."</p>-->
                            <!--<div class="custom-radio">-->
                            <!--    <form action="#" method="POST" id="report_mail">-->
                            <!--        <input type="hidden" name="fname" id="fname" value="<?php echo $_GET['fname']; ?>">-->
                            <!--        <input type="hidden" name="email" id="email" value="<?php echo $_GET['email']; ?>">-->
                            <!--      <p class="d-none">-->
                            <!--        <input type="radio" id="test10" name="radio-group" class="report_val" value="Survey on- Skill Assessment Platform." checked="checked">-->
                            <!--        <label for="test110">Survey on- Skill Assessment Platform.</label>-->
                            <!--       </p>-->
                            <!--        <div class="text-center mt-1">-->
                            <!--         <input type="submit" class="btn cta-btn mt-4 shadow-md" id="report_submit" value="E-book">-->
                            <!--        </div>-->
                            <!--        <div class="text-center mt-4">-->
                            <!--        <p>One of our experts from iMocha will get in touch to take quick feedback.</p>-->
                            <!--        </div>-->
                            <!--    </form>-->
                            <!--</div>-->
                        
                        <?php //} ?>
                        
                        <!-----------------------------------Account Security--------------------------------------->
                        <?php if($surveyid=="924c9661-38a2-477e-8926-579726c67026" || $surveyid=="eefac4e6-aacf-46c7-9b43-356942446f6a" || $surveyid=="7ee76033-63c2-437a-974d-db620a51d467" || $surveyid=="7d92385a-99f1-47a3-bdf7-025158d73e66" || $surveyid=="a374e0fa-997d-4452-806b-560e66edd36e"){ ?>
                                <p class="text-center mt-3">We will send you the report soon.</p>
                        <?php }?>
                        <?php //if($surveyid=="924c9661-38a2-477e-8926-579726c67026"){ ?> 
                           
                            <!--<p class="text-center mt-3">Click here to download our recently published e-book on "5 Best Practices for Seamless & Secure User Onboarding."</p>-->
                            <!--<div class="custom-radio">-->
                            <!--    <form action="#" method="POST" id="report_mail">-->
                            <!--        <input type="hidden" name="fname" id="fname" value="<?php echo $_GET['fname']; ?>">-->
                            <!--        <input type="hidden" name="email" id="email" value="<?php echo $_GET['email']; ?>">-->
                            <!--      <p class="d-none">-->
                            <!--        <input type="radio" id="test10" name="radio-group" class="report_val" value="Surveying the key attributes of account security." checked="checked">-->
                            <!--        <label for="test110">Surveying the key attributes of account security.</label>-->
                            <!--       </p>-->
                            <!--        <div class="text-center mt-1">-->
                            <!--         <input type="submit" class="btn cta-btn mt-4 shadow-md" id="report_submit" value="E-book">-->
                            <!--        </div>-->
                            <!--        <div class="text-center mt-4">-->
                            <!--        <p>One of our experts from Twilio - Account Security will get in touch to take quick feedback.</p>-->
                            <!--        </div>-->
                            <!--    </form>-->
                            <!--</div>-->
                        
                        <?php //} ?>
                        
                        <?php //if($surveyid=="eefac4e6-aacf-46c7-9b43-356942446f6a"){ ?> 
                           
                            <!--<p class="text-center mt-3">Click here to download our recently published e-book on "5 Best Practices for Seamless & Secure User Onboarding."</p>-->
                            <!--<div class="custom-radio">-->
                            <!--    <form action="#" method="POST" id="report_mail">-->
                            <!--        <input type="hidden" name="fname" id="fname" value="<?php echo $_GET['fname']; ?>">-->
                            <!--        <input type="hidden" name="email" id="email" value="<?php echo $_GET['email']; ?>">-->
                            <!--      <p class="d-none">-->
                            <!--        <input type="radio" id="test10" name="radio-group" class="report_val" value="Surveying-the-impact-of-account-security-for-business." checked="checked">-->
                            <!--        <label for="test110">Surveying-the-impact-of-account-security-for-business.</label>-->
                            <!--       </p>-->
                            <!--        <div class="text-center mt-1">-->
                            <!--         <input type="submit" class="btn cta-btn mt-4 shadow-md" id="report_submit" value="E-book">-->
                            <!--        </div>-->
                            <!--        <div class="text-center mt-4">-->
                            <!--        <p>One of our experts from Twilio - Account Security will get in touch to take quick feedback.</p>-->
                            <!--        </div>-->
                            <!--    </form>-->
                            <!--</div>-->
                        
                        <?php //} ?>
                        <?php //if($surveyid=="7ee76033-63c2-437a-974d-db620a51d467"){ ?> 
                           
                            <!--<p class="text-center mt-3">Click here to download our recently published e-book on "5 Best Practices for Seamless & Secure User Onboarding."</p>-->
                            <!--<div class="custom-radio">-->
                            <!--    <form action="#" method="POST" id="report_mail">-->
                            <!--        <input type="hidden" name="fname" id="fname" value="<?php echo $_GET['fname']; ?>">-->
                            <!--        <input type="hidden" name="email" id="email" value="<?php echo $_GET['email']; ?>">-->
                            <!--      <p class="d-none">-->
                            <!--        <input type="radio" id="test10" name="radio-group" class="report_val" value="Analyzing-various-facets-of-identity-verification." checked="checked">-->
                            <!--        <label for="test110">Analyzing-various-facets-of-identity-verification.</label>-->
                            <!--       </p>-->
                            <!--        <div class="text-center mt-1">-->
                            <!--         <input type="submit" class="btn cta-btn mt-4 shadow-md" id="report_submit" value="E-book">-->
                            <!--        </div>-->
                            <!--        <div class="text-center mt-4">-->
                            <!--        <p>One of our experts from Twilio - Account Security will get in touch to take quick feedback.</p>-->
                            <!--        </div>-->
                            <!--    </form>-->
                            <!--</div>-->
                        
                        <?php //} ?>
                        <?php //if($surveyid=="7d92385a-99f1-47a3-bdf7-025158d73e66"){ ?> 
                           
                            <!--<p class="text-center mt-3">Click here to download our recently published e-book on "5 Best Practices for Seamless & Secure User Onboarding."</p>-->
                            <!--<div class="custom-radio">-->
                            <!--    <form action="#" method="POST" id="report_mail">-->
                            <!--        <input type="hidden" name="fname" id="fname" value="<?php echo $_GET['fname']; ?>">-->
                            <!--        <input type="hidden" name="email" id="email" value="<?php echo $_GET['email']; ?>">-->
                            <!--      <p class="d-none">-->
                            <!--        <input type="radio" id="test10" name="radio-group" class="report_val" value="Surveying-to-understand-challenges-faced-by-organization-in-implementing-2fa." checked="checked">-->
                            <!--        <label for="test110">Surveying-to-understand-challenges-faced-by-organization-in-implementing-2fa.</label>-->
                            <!--       </p>-->
                            <!--        <div class="text-center mt-1">-->
                            <!--         <input type="submit" class="btn cta-btn mt-4 shadow-md" id="report_submit" value="E-book">-->
                            <!--        </div>-->
                            <!--        <div class="text-center mt-4">-->
                            <!--        <p>One of our experts from Twilio - Account Security will get in touch to take quick feedback.</p>-->
                            <!--        </div>-->
                            <!--    </form>-->
                            <!--</div>-->
                        
                        <?php //} ?>
                        <?php //if($surveyid=="a374e0fa-997d-4452-806b-560e66edd36e"){ ?> 
                           
                            <!--<p class="text-center mt-3">Click here to download our recently published e-book on "5 Best Practices for Seamless & Secure User Onboarding."</p>-->
                            <!--<div class="custom-radio">-->
                            <!--    <form action="#" method="POST" id="report_mail">-->
                            <!--        <input type="hidden" name="fname" id="fname" value="<?php echo $_GET['fname']; ?>">-->
                            <!--        <input type="hidden" name="email" id="email" value="<?php echo $_GET['email']; ?>">-->
                            <!--      <p class="d-none">-->
                            <!--        <input type="radio" id="test10" name="radio-group" class="report_val" value="Survey-to-understand-how-sms-is-used-in-conjunction-with-the-authy-2fa-apps." checked="checked">-->
                            <!--        <label for="test110">Survey-to-understand-how-sms-is-used-in-conjunction-with-the-authy-2fa-apps.</label>-->
                            <!--       </p>-->
                            <!--        <div class="text-center mt-1">-->
                            <!--         <input type="submit" class="btn cta-btn mt-4 shadow-md" id="report_submit" value="E-book">-->
                            <!--        </div>-->
                            <!--        <div class="text-center mt-4">-->
                            <!--        <p>One of our experts from Twilio - Account Security will get in touch to take quick feedback.</p>-->
                            <!--        </div>-->
                            <!--    </form>-->
                            <!--</div>-->
                        
                        <?php //} ?>
                        
                        <?php }  ?>
                        
                        <!--<div class="text-center pt-4">-->
                        <!--    <a href="<?php echo SITEPATHFRONT ?>privacy-policy" class="text-dark regpr border-end pe-3">Privacy Policy</a>-->
                        <!--    <a href="<?php echo SITEPATHFRONT ?>terms-and-conditions" class="text-dark regpr ps-3">Terms & Conditions</a>-->
                        <!--</div>-->
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="">
                    <img src="<?php echo SITEPATHFRONT?>images/pattern-bottom.png" class="img-fluid pattern-bottom-img">
                </div>
            </div>
        </div>
    </div>
</section>
<?php include('footer.php')?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).ready(function(){
        $("#report_mail").submit(function(e){
            e.preventDefault();
           var report_title = $(".report_val:checked").val();
           var fname= $("#fname").val();
           var email = $("#email").val();
           
          $.ajax({
                url: "<?php echo SITEPATHFRONT; ?>survey-report-action.php",
				type: "POST",
				data: {report_title:report_title, fname:fname, email:email},
				cache: false,
				success: function(dataResult){
                        if(report_title=="Medical Equipment Global Market Competitor Briefing"){
                            //window.location.href = "";
                            window.open("<?php echo SITEPATHFRONT; ?>reports/Medical Equipment Global Market Competitor Briefing 2021.pdf", "_blank");
                    swal({
                      title: "Success..!",
                      icon: "success",
                      button: "OK",
                    }).then(function(){
                        window.location = "<?php echo SITEPATHFRONT; ?>";
                    });
                        }else if(report_title=="2022 Global_ Medical Imaging Workstations"){
                             window.open("<?php echo SITEPATHFRONT; ?>reports/2022 Global_ Medical Imaging Workstations - Innovative Markets Forecast (2028) report (1).pdf", "_blank");
                             swal({
                              title: "Success..!",
                              icon: "success",
                              button: "OK",
                            }).then(function(){
                                window.location = "<?php echo SITEPATHFRONT; ?>";
                            });
                    
                        }else if(report_title=="Medical Equipment Market Global Briefing 2021-In-Vitro Diagnostic"){
                            window.open("<?php echo SITEPATHFRONT; ?>reports/Medical Equipment Market Global Briefing 2021 Including_ In-Vitro Diagnostic.pdf", "_blank");
                                    swal({
                              title: "Success..!",
                              icon: "success",
                              button: "OK",
                            }).then(function(){
                                window.location = "<?php echo SITEPATHFRONT; ?>";
                            });
                        }else if(report_title=="Analyzing the ins and outs of SMS API's"){
                            window.open("<?php echo SITEPATHFRONT; ?>reports/Twilio_-_Critical_capabilities_for_choosing_an_SMS_API_provider (1).pdf", "_blank");
                                    swal({
                              title: "Success..!",
                              icon: "success",
                              button: "OK",
                            }).then(function(){
                                window.location = "<?php echo SITEPATHFRONT; ?>";
                            });
                        }else if(report_title=="SMS API'S: Measuring the integration across different industries."){
                            window.open("<?php echo SITEPATHFRONT; ?>reports/Twilio_-_Critical_capabilities_for_choosing_an_SMS_API_provider (2).pdf", "_blank");
                                    swal({
                              title: "Success..!",
                              icon: "success",
                              button: "OK",
                            }).then(function(){
                                window.location = "<?php echo SITEPATHFRONT; ?>";
                            });
                        }else if(report_title=="Survey on- Understanding the contact center ecosystem."){
                            window.open("<?php echo SITEPATHFRONT; ?>reports/Flex-Whitepaper.pdf", "_blank");
                                    swal({
                              title: "Success..!",
                              icon: "success",
                              button: "OK",
                            }).then(function(){
                                window.location = "<?php echo SITEPATHFRONT; ?>";
                            });
                        }else if(report_title=="A survey to analyze the trends in contact center solution."){
                            window.open("<?php echo SITEPATHFRONT; ?>reports/Flex-Whitepaper.pdf", "_blank");
                                    swal({
                              title: "Success..!",
                              icon: "success",
                              button: "OK",
                            }).then(function(){
                                window.location = "<?php echo SITEPATHFRONT; ?>";
                            });
                        }else if(report_title=="Survey for in-depth analysis on technological solutions in contact center system."){
                            window.open("<?php echo SITEPATHFRONT; ?>reports/Flex-Whitepaper.pdf", "_blank");
                                    swal({
                              title: "Success..!",
                              icon: "success",
                              button: "OK",
                            }).then(function(){
                                window.location = "<?php echo SITEPATHFRONT; ?>";
                            });
                        }else if(report_title=="Analyzing primary channel check list for omnichannel solutions(Contact Center, BPO)"){
                            window.open("<?php echo SITEPATHFRONT; ?>reports/Flex-Whitepaper.pdf", "_blank");
                                    swal({
                              title: "Success..!",
                              icon: "success",
                              button: "OK",
                            }).then(function(){
                                window.location = "<?php echo SITEPATHFRONT; ?>";
                            });
                        }else if(report_title=="Conducting a survey to understand challenges faced using omnichannel solutions."){
                            window.open("<?php echo SITEPATHFRONT; ?>reports/Flex-Whitepaper.pdf", "_blank");
                                    swal({
                              title: "Success..!",
                              icon: "success",
                              button: "OK",
                            }).then(function(){
                                window.location = "<?php echo SITEPATHFRONT; ?>";
                            });
                        }else if(report_title=="Surveying the key attributes of a contact center solutions."){
                            window.open("<?php echo SITEPATHFRONT; ?>reports/Flex-Whitepaper.pdf", "_blank");
                                    swal({
                              title: "Success..!",
                              icon: "success",
                              button: "OK",
                            }).then(function(){
                                window.location = "<?php echo SITEPATHFRONT; ?>";
                            });
                        }else if(report_title=="Survey-on-understanding-contact-center-cx-programs."){
                            window.open("<?php echo SITEPATHFRONT; ?>reports/Flex-Whitepaper.pdf", "_blank");
                                    swal({
                              title: "Success..!",
                              icon: "success",
                              button: "OK",
                            }).then(function(){
                                window.location = "<?php echo SITEPATHFRONT; ?>";
                            });
                        }
                        // }else if(report_title=="Survey on-How Talent heads have scaled up their Hiring and Acquisition Game."){
                        //     window.open("https://blog.imocha.io/why-skills-intelligence-as-a-core-of-talent-transformation", "_blank");
                        //             swal({
                        //       title: "Success..!",
                        //       icon: "success",
                        //       button: "OK",
                        //     }).then(function(){
                        //         window.location = "<?php echo SITEPATHFRONT; ?>";
                        //     });
                        // }else if(report_title=="SME's perspective to understand the greatest need for skills assessment among employees."){
                        //     window.open("https://blog.imocha.io/why-skills-intelligence-as-a-core-of-talent-transformation", "_blank");
                        //             swal({
                        //       title: "Success..!",
                        //       icon: "success",
                        //       button: "OK",
                        //     }).then(function(){
                        //         window.location = "<?php echo SITEPATHFRONT; ?>";
                        //     });
                        // }else if(report_title=="To understand perspectives of industry-leaders on investing in 3rd party Skill development."){
                        //     window.open("https://blog.imocha.io/why-skills-intelligence-as-a-core-of-talent-transformation", "_blank");
                        //             swal({
                        //       title: "Success..!",
                        //       icon: "success",
                        //       button: "OK",
                        //     }).then(function(){
                        //         window.location = "<?php echo SITEPATHFRONT; ?>";
                        //     });
                        // }else if(report_title=="To ascertain upskilling areas among employees with 3rd party vendor."){
                        //     window.open("https://blog.imocha.io/why-skills-intelligence-as-a-core-of-talent-transformation", "_blank");
                        //             swal({
                        //       title: "Success..!",
                        //       icon: "success",
                        //       button: "OK",
                        //     }).then(function(){
                        //         window.location = "<?php echo SITEPATHFRONT; ?>";
                        //     });
                        // }else if(report_title=="A survey on-Pre-Employment skill testing within organizations."){
                        //     window.open("https://blog.imocha.io/why-skills-intelligence-as-a-core-of-talent-transformation", "_blank");
                        //             swal({
                        //       title: "Success..!",
                        //       icon: "success",
                        //       button: "OK",
                        //     }).then(function(){
                        //         window.location = "<?php echo SITEPATHFRONT; ?>";
                        //     });
                        // }else if(report_title=="To cope with the rapidly changing skill requirement of the workforce."){
                        //     window.open("https://blog.imocha.io/why-skills-intelligence-as-a-core-of-talent-transformation", "_blank");
                        //             swal({
                        //       title: "Success..!",
                        //       icon: "success",
                        //       button: "OK",
                        //     }).then(function(){
                        //         window.location = "<?php echo SITEPATHFRONT; ?>";
                        //     });
                        // }else if(report_title=="Survey on- Skill Assessment Platform."){
                        //     window.open("https://blog.imocha.io/why-skills-intelligence-as-a-core-of-talent-transformation", "_blank");
                        //             swal({
                        //       title: "Success..!",
                        //       icon: "success",
                        //       button: "OK",
                        //     }).then(function(){
                        //         window.location = "<?php echo SITEPATHFRONT; ?>";
                        //     });
                        // }else if(report_title=="Surveying the key attributes of account security."){
                        //     window.open("https://interactive.twilio.com/acc-sec-5-best-practices-for-seamless-secure-onboarding-ebook-1/thank-you-1642G-803O7.html", "_blank");
                        //             swal({
                        //       title: "Success..!",
                        //       icon: "success",
                        //       button: "OK",
                        //     }).then(function(){
                        //         window.location = "<?php echo SITEPATHFRONT; ?>";
                        //     });
                        // }else if(report_title=="Surveying-the-impact-of-account-security-for-business."){
                        //     window.open("https://interactive.twilio.com/acc-sec-5-best-practices-for-seamless-secure-onboarding-ebook-1/thank-you-1642G-803O7.html", "_blank");
                        //             swal({
                        //       title: "Success..!",
                        //       icon: "success",
                        //       button: "OK",
                        //     }).then(function(){
                        //         window.location = "<?php echo SITEPATHFRONT; ?>";
                        //     });
                        // }else if(report_title=="Analyzing-various-facets-of-identity-verification."){
                        //     window.open("https://interactive.twilio.com/acc-sec-5-best-practices-for-seamless-secure-onboarding-ebook-1/thank-you-1642G-803O7.html", "_blank");
                        //             swal({
                        //       title: "Success..!",
                        //       icon: "success",
                        //       button: "OK",
                        //     }).then(function(){
                        //         window.location = "<?php echo SITEPATHFRONT; ?>";
                        //     });
                        // }else if(report_title=="Surveying-to-understand-challenges-faced-by-organization-in-implementing-2fa."){
                        //     window.open("https://interactive.twilio.com/acc-sec-5-best-practices-for-seamless-secure-onboarding-ebook-1/thank-you-1642G-803O7.html", "_blank");
                        //             swal({
                        //       title: "Success..!",
                        //       icon: "success",
                        //       button: "OK",
                        //     }).then(function(){
                        //         window.location = "<?php echo SITEPATHFRONT; ?>";
                        //     });
                        // }else if(report_title=="Survey-to-understand-how-sms-is-used-in-conjunction-with-the-authy-2fa-apps."){
                        //     window.open("https://interactive.twilio.com/acc-sec-5-best-practices-for-seamless-secure-onboarding-ebook-1/thank-you-1642G-803O7.html", "_blank");
                        //             swal({
                        //       title: "Success..!",
                        //       icon: "success",
                        //       button: "OK",
                        //     }).then(function(){
                        //         window.location = "<?php echo SITEPATHFRONT; ?>";
                        //     });
                        // }
     
            }
        });
    });
});    
</script>