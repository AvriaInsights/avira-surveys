<?php 
require_once("survey/classes/cls-request.php");
require_once("survey/classes/cls-template.php");
require_once("survey/classes/cls-survey.php");

$obj_request = new Request();
$obj_template= new Template();
$obj_survey = new Survey();
$_SESSION['campaign_user_id']="";
$conn = $obj_survey->getConnectionObj();
$url=$_SERVER['SCRIPT_URI'];
/*if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}*/
if(!isset($_SESSION['response_user_id']))
{
    $_SESSION['response_user_id']="";
}
if(!isset($_SESSION['half_mail']))
{
    $_SESSION['half_mail']="";
}
if(!isset($_SESSION['last_form_user_response_id']))
{
    $_SESSION['last_form_user_response_id']="";
}

//echo "jjjjjjj".$_SESSION['response_user_id'];
$surveyid=$_GET['surveyid'];

/**********All Questions***************/
$fields_questions = "*";
$condition_questions = "`tbl_questionBank`.`survey_id` ='".$surveyid."'";
$orderby="`tbl_questionBank`.`sequence` ASC";
$all_questions=$obj_survey->getQuestionBank($fields_questions, $condition_questions, $orderby, '', 0);
$totalquest=count($all_questions);
/******************Survey Detail**********/
$fields_survey= "*";
$condition_survey = "`tbl_survey`.`survey_id` = '".$surveyid."'";
$all_surveys_details = $obj_survey->getSurveyDetail($fields_survey, $condition_survey, '', '', 0);
foreach($all_surveys_details as $all_surveys_detail)
{
   $templateid=$all_surveys_detail['template_id'];
   $category_id=$all_surveys_detail['category_id'];
   $survey_title=$all_surveys_detail['survey_title'];
   $footer_tagline=$all_surveys_detail['footer_tagline'];
   $user_id=$all_surveys_detail['user_id'];
   $survey_description=$all_surveys_detail['survey_description'];
   $submit_form_position=$all_surveys_detail['submit_form_position'];
   
   if($templateid=="")
   {
     $fields_category = "*";
     $condition_category = "`category_id` = '$category_id'";
     $category_details = $obj_survey->getSurveyCategory($fields_category, $condition_category, '', '', 0);
     foreach($category_details as $category_detail)
     {
         $template_image="images/template/".$category_detail['shortcode'].".jpg";
     }
   }
   else
   {
     $fields_template = "*";
     $condition_template = "`template_id` = '$templateid'";
     $template_details = $obj_template->getTemplateDetail($fields_template, $condition_template, '', '', 0);
     foreach($template_details as $template_detail)
     {
         $template_image=$template_detail['image_url'];
     }
   }
}
//$_SESSION['test']="";
if(isset($_GET['name']) || isset($_GET['email']) || isset($_GET['company']))
{
       
        if(isset($_GET['name']))
        {
            $fname1	= $_GET['name'];
        }
        else
        {
           $fname1=""; 
        }
        //$email1=$_GET['email'];
        if(isset($_GET['email']))
        {
            $email1	= $_GET['email'];
        }
        else
        {
           $email1=""; 
        }
        //$company = $_GET['company'];
        if(isset($_GET['company']))
        {
            $company	= $_GET['company'];
        }
        else
        {
           $company=""; 
        }
        if(isset($_GET['source']))
        {
            $url_source	= $_GET['source'];
        }
        else
        {
           $url_source=""; 
        }
        if(isset($_GET['designation']))
        {
            $url_designation	= $_GET['designation'];
        }
        else
        {
           $url_designation=""; 
        }
        $ipaddress1=$_SERVER["REMOTE_ADDR"];
        
        // $update_data['survey_fill_at'] = date("Y-m-d h:i:s");
        // $condition = "`tbl_survey`.`survey_id` = '" . $surveyid . "'";
        // $lastupdateidsurvey = $obj_survey->updateSurvey($update_data,$condition, 0);
        
        $insert_data22['survey_id'] = mysqli_real_escape_string($conn, $surveyid);
        $insert_data22['user_id'] = mysqli_real_escape_string($conn, $user_id);
        $insert_data22['user_fullname'] = mysqli_real_escape_string($conn, $fname1);
        $insert_data22['user_email'] = mysqli_real_escape_string($conn, $email1);
        $insert_data22['user_company'] = mysqli_real_escape_string($conn, $company);
        $insert_data22['user_designation'] = mysqli_real_escape_string($conn, $url_designation);
        $insert_data22['ip_address'] = mysqli_real_escape_string($conn, $ipaddress1);
        $insert_data22['url_source'] = mysqli_real_escape_string($conn, $url_source);
        $insert_data22['status'] = "Active";
        $insert_data22['domain'] = "Avira";
        $insert_data22['created_at'] = date("Y-m-d h:i:s");
        $insert_data22['updated_at'] = date("Y-m-d h:i:s");
        $lastinsertid22 = $obj_survey->insertResponseUser($insert_data22, 0);
        $_SESSION['campaign_user_id']=$lastinsertid22;
        $insert_data222['camp_response_user_id'] = mysqli_real_escape_string($conn, $lastinsertid22);
        $insert_data222['q_count'] = "0";
        $insert_data222['q_last_attempt_qno'] = "0";
        $obj_survey->insertCampaignSurvey($insert_data222, 0);
    
}
$fields_fedbk="*";
$condition_fedbk="`tbl_feedback`.`status`='Active'";
$feedbacks=$obj_survey->getFeedbackDetails($fields_fedbk, $condition_fedbk, '', '', 0);
?>
<?php 
$page = "surveyview";
$page_title = " $survey_title | Avira Surveys - " . SITETITLE;
$meta_description = "Contact Avira Surveys today, we will cheerfully help you with worldwide industry survey, markets trends for future outlook and actionable insights to impact your industry.";
$meta_keywords = "";
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <title><?php echo $page_title;?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="title" content="<?php echo $page_title;?>">
    <meta name="description" content="<?php echo $meta_description;?>">
    <meta name="keywords" content="<?php echo $meta_keywords;?>">
    <!-- Bootstrap CSS -->
    <link rel="icon" href="<?php echo SITEPATHFRONT;?>images/Avira-Survey-Logo_Favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Hotjar Tracking Code for https://www.avirasurveys.com/ --><script>    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:3143783,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');</script>
  </head>
   <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-222738156-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
        
          gtag('config', 'UA-222738156-1');
        </script>
    <style>
    @font-face {
      font-family: 'icomoon';
      src:  url('/font/icomoon.eot?wcb8qp');
      src:  url('/font/icomoon.eot?wcb8qp#iefix') format('embedded-opentype'),
        url('/font/icomoon.ttf?wcb8qp') format('truetype'),
        url('/font/icomoon.woff?wcb8qp') format('woff'),
        url('/font/icomoon.svg?wcb8qp#icomoon') format('svg');
      font-weight: normal;
      font-style: normal;
      font-display: block;
    }

    [class^="icon-"], [class*=" icon-"] {
      /* use !important to prevent issues with browser extensions that change fonts */
      font-family: 'icomoon' !important;
      speak: never;
      font-style: normal;
      font-weight: normal;
      font-variant: normal;
      text-transform: none;
      line-height: 1;
    
      /* Better Font Rendering =========== */
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }
    .icon-Yes:before {
      content: "\e900";
    }
    .icon-No:before {
      content: "\e901";
    }
    body{
        background:#f1f1f1;
    }
     body::-webkit-scrollbar {
      width:12px;  
      background-color: #fff;
    }
    body::-webkit-scrollbar-track {
       -webkit-box-shadow: inset 0 0 6px rgb(0 0 0 / 30%);
        background-color: #fff;       
    }
    body::-webkit-scrollbar-thumb {
      -webkit-box-shadow: inset 0 0 6px rgb(0 0 0 / 30%);
        background-color:#03128d;
    }
    html{
     font-size:10px;    
    }
    .main-que-ttl{
       font-size:3.5rem;
       padding:3rem 0 2rem;
       color:#02118d;
    }
    .common-que-header{
      background:#b9ebf5;
      padding: 1.2rem;
      /*border-radius: 0.5rem 0.5rem 0 0;*/
    }
      .common-que-header h5{
        font-size: 1.3rem;
        padding-bottom: 0.5rem;
        font-weight: 400;
        color:#03128b;
      }
      .common-que-header h3{
          font-size:1.9rem;
          padding-top:.5rem;
          line-height:1.3;
          color:#000;
      } 
      .boolean-item {
        margin-right:1.5rem;
      }
      .boolean-item [type=radio],.boolean-item [type=checkbox],.r-item [type=radio],.r-item [type=checkbox],.scale-type [type=radio]{
        position: absolute; 
        opacity: 0; 
        width: 0; 
        height: 0; 
     }
    .label-icon {
        margin-bottom: 0;
        padding:2rem 4rem;
        justify-content: center;
        display: flex;
        flex-direction: column;
        font-size:1.8rem;
        align-items: center;
        border: .1rem solid #ced4da;
        border-radius: .5rem;
        cursor:pointer;
    }
    .label-icon-rank {
        margin-bottom: 0;
        padding:0.5rem 2rem;
        justify-content: space-between;
        display: flex;
        font-size:1.4rem;
        align-items: center;
        border: .1rem solid #ced4da;
        border-radius: .5rem;
        cursor:pointer;
    }
    [type=radio]:checked + .label-icon,[type=checkbox]:checked + .label-icon {
        color: #fff;
        background: #00cfff;
        background: -moz-linear-gradient(45deg, #029bff 1%, #00cfff 100%);
        background: -webkit-linear-gradient(45deg, #029bff 1%, #00cfff 100%);
        background: linear-gradient(45deg, #029bff 1%, #00cfff 100%);
        border:1px solid #00cfff;
    }
    .boolean-type{
        display: flex;
        flex-direction: row;
        align-items: center;
    }
    .label-icon i{
        font-size:5rem;
        padding-bottom: 0.7rem;
    }
    .save-nxt-btn{
        border: 0.1rem solid #000;
        padding: 1rem 2.3rem;;
        font-size: 1.4rem;
        border-radius: 50px;
        font-weight: 500;
    }
    .r-item .label-icon{
        padding: 1.1rem 1rem;
        font-size:1.6rem;
        align-items: flex-start;
    }
    .r-item{
        margin-bottom:2.5rem;
    }
    .label-icon .num-holder{
        margin-right: 1rem;
        font-size: 1.5rem;
        font-weight:700;
        padding-top:1px;
    }
    .checkbox-item .label-icon {
        flex-direction: row;
        justify-content: flex-start;
    }
    .pt-6{
        padding-top:2.5rem;
    }
    .skip-txt{
        font-size: 1.4rem;
        padding-left: 2rem;
        cursor:pointer;
    }
    .text-type .form-control{
        font-weight: 400;
        padding: 1rem 2rem;
        font-size: 1.4rem;
        color: #000;
    }
    .text-type textarea{
        height:15rem;
    }
    .star-rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: flex-end;
    }
    .star-rating input {
        display: none;
    }
    .star-rating label {
        color:#ccc;
        cursor:pointer;
        font-size: 5rem;
        margin: 1rem;
    }
     label.star:before {
        content: '\f006';
        font-family: FontAwesome;
    }
    .star-rating input:checked ~ label.star:before {
        content: '\f005';
        color: #8d8d8d;
        transition: all .25s;
    }
    .m-rating-type .form-select,.m-rating-type .form-control{
        font-size: 1.2rem;
        padding: 0.85rem;
        border-radius: 0.5rem;
        margin-bottom:1rem;
    }
    .number-holder{
         border: 0.1rem solid #ced4da;
        padding: 0.8rem;
        text-align: center;
        font-size: 1.2rem;
        font-weight: 600;
        border-radius: 0.5rem;
    }
    .order-type .label-icon{
        align-items:center; 
        justify-content:space-between;
    }
    .move-icon{
        font-size:1.6rem;
        font-weight:600;
    }
    .number-holder{
        margin-bottom:1.5rem;
    }
    .matrix-que .table{
        text-align:center;
        font-size: 1.6rem;
    }
    .scale-type{
        display:flex;
    }
    .scale-type .label-icon{
        padding:1rem 2.2rem;
        font-weight:600;
        border-radius:0;
    }
    .space-all{
        padding:2rem;
    }
    .bg-shadow{
        background: #fff;
        -webkit-box-shadow: 0 .7rem 1.2rem rgb(0 0 0 / 35%);
        box-shadow: 0 .7rem 1.2rem rgb(0 0 0 / 35%);
    }
    .thank-you-ttl{
        font-size: 2rem;
        padding-bottom: 1.4rem;
    }
    .end-feedback-form label{
        font-size: 1.4rem;
        padding-bottom: 0.7rem;
    }
    .end-feedback-form .form-control{
        padding: 0.7rem;
        font-size: 1.4rem;
    }
    .submit-btn{
        background: #00d8ff;
        border: 1px solid #00d8ff;
        padding: 1rem 3.5rem;
        font-size:1.4rem;
        border-radius:50px;
        color:#fff;
        position: relative;
        overflow: hidden;
        cursor: pointer;
        /*z-index:9999;*/
    }
    .slide {
        width: 100%;
        height: 100%;
        left: -200px;
        background: #fff;
        position: absolute;
        transition: all .35s ease-Out;
        bottom: 0;
        font-weight: 700;
        z-index:-1;
    }
    .submit-btn:hover .slide{
        left: 0;
        border: 1px solid #fff;
    }
    .submit-btn:hover{
         color:#fff;
    }
    .s-icon span{
        font-size:3rem;
    }
    .para{
        font-size:1.6rem;
        padding-bottom:2rem;
    }
    .r-tem label
    .front-ttl{
        font-size:2.4rem;
        font-weight:700;
        padding-bottom:1rem;
    }
    .close-btn{
        display:flex;
        justify-content:end;
        font-size:1.4rem;
        padding: 1.7rem 2rem 0;
    }
    .close-btn i{
        border: 0.1rem solid #000;
        border-radius: 50%;
        width: 3rem;
        height: 3rem;
        text-align: center;
        line-height:2;
        cursor:pointer;
    }
    .neutral-point{
        padding-right:6rem;
    }
    .score-pt span{
        font-size: 1.1rem;
        font-weight: 600;
        padding-top: 1rem;
    }
    .opinionscalelabel{
        margin-left:-10px;
    }
    .order-type .col-md-2{
        width:16.66%;
    }
    .order-type .col-md-10{
        width:83.33%;
    }
    /*-------footer-design--------------*/
    .footer-bottom-fixed {
        position: fixed;
        bottom:0rem;
        width: 100%;
        -webkit-box-shadow: 0 -1px 25px -5px rgb(141 141 141 / 49%);
            box-shadow: 0 -1px 25px -5px rgb(141 141 141 / 49%);
    }
    .right-div {
        position: relative;
        right: -10.2rem;
    }
    .progress-circle {
        transform: rotate(-90deg);
        margin-top: -5px;
        position: absolute;
    }
    .progress-text {
        position: relative;
        top: 3.5rem;
        font-size: 1.2em;
        left:2.2rem;
        color: #000;
    }
    .arrow-status {
        padding-top: 1rem;
    }
    .survey-logo {
        width: 13.5rem;
        padding-bottom: 0.5rem;
    }
    .arrow-status a {
        display: inline-block;
        margin: 0 2% 0 0;
        border-radius: 50%;
        border: 2px solid #999;
        padding: 10px;
        width: 45px;
        height: 45px;
        font-size: 30px;
        color: #fff;
        position: relative;
        transition: all 0.1s;
        transition: all 0.1s;
        right:0rem;
    }
    .arrow-status a i {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #000;
        font-size: 2rem;
    }
    .progress-circle-back {
        fill: none;
        stroke: #9586865e;
        stroke-width: 5px;
    }
    .progress-circle-prog {
        fill: none;
        stroke: #fff;
        stroke-width:5px;
        stroke-dasharray: 0 999;
        stroke-dashoffset:0px;
        transition: stroke-dasharray 0.7s linear 0s;
    }
    .progress-circle-prog {
        fill: none;
        stroke: #02118d;
    }
    .mob-tooltip{
        display:none!important;    
    }
    .footer-bottom-fixed p.para{
        font-size:1.3rem;
    }
    .modal{
        z-index:9999;
    }
    .action-btn-disabled {
        cursor: not-allowed !important;
    }
    .disabled {
        opacity: 0.5;
        cursor: not-allowed;
        text-decoration:none!important;
        pointer-events: none;
    }
    .align-txt {
        display: flex;
        justify-content: space-between;
        align-items: center;
        /*padding-bottom: 1rem;*/
    }
    .tooltip {
        position: relative;
        display: inline-block;
        opacity: 1 !important;
        margin-top: 15px;
    }
    .tooltip {
        position: relative;
        z-index: 1070;
        /*display: block;*/
        margin: 0;
        font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
        font-style: normal;
        font-weight: 400;
        line-height: 1.5;
        text-align: left;
        text-align: start;
        text-decoration: none;
        text-shadow: none;
        text-transform: none;
        letter-spacing: normal;
        word-break: normal;
        word-spacing: normal;
        white-space: normal;
        line-break: auto;
        font-size: .875rem;
        word-wrap: break-word;
        opacity: 0;
        color:#000;
    }
    .tooltip .fa {
        font-size: 18px;
    }
    .fa {
        display: inline-block;
        font: normal normal normal 14px/1 FontAwesome;
        font-size: inherit;
        text-rendering: auto;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
    .tooltip .tooltiptext {
        visibility: hidden;
        width: 254px;
        background-color: black;
        color: #fff;
        text-align: center;
        padding: 5px 8px;
        border-radius: 6px;
        position: absolute;
        z-index: 1;
        margin-left: 6px;
        position: absolute;
        z-index: 1;
    }
    .toolt {
        display: flex;
    }
    [data-tooltip] {
        display: inline-block;
        position: relative;
        cursor: pointer;
        padding: 4px;
    }
/* Tooltip styling */
    [data-tooltip]:before {
        content: attr(data-tooltip);
        display: none;
        position: absolute;
        background: #000;
        color: #fff;
        padding: 4px 8px;
        font-size: 14px;
        line-height: 1.4;
        min-width: auto;
        text-align: left;
        border-radius: 4px;
        width:auto;
        white-space:nowrap;
    }
    /* Dynamic horizontal centering */
    [data-tooltip-position="top"]:before,
    [data-tooltip-position="bottom"]:before {
        left: 50%;
        -ms-transform: translateX(-50%);
        -moz-transform: translateX(-50%);
        -webkit-transform: translateX(-50%);
        transform: translateX(-50%);
    }
    /* Dynamic vertical centering */
    [data-tooltip-position="right"]:before,
    [data-tooltip-position="left"]:before {
        top: 50%;
        -ms-transform: translateY(-50%);
        -moz-transform: translateY(-50%);
        -webkit-transform: translateY(-50%);
        transform: translateY(-50%);
    }
    [data-tooltip-position="top"]:before {
        bottom: 100%;
        margin-bottom: 6px;
    }
    [data-tooltip-position="right"]:before {
        left: 100%;
        margin-left: 6px;
    }
    [data-tooltip-position="bottom"]:before {
        top: 100%;
        margin-top: 6px;
    }
    [data-tooltip-position="left"]:before {
        right: 100%;
        margin-right: 6px;
    }
    
    /* Tooltip arrow styling/placement */
    [data-tooltip]:after {
        content: '';
        display: none;
        position: absolute;
        width: 0;
        height: 0;
        border-color: transparent;
        border-style: solid;
    }
    /* Dynamic horizontal centering for the tooltip */
    [data-tooltip-position="top"]:after,
    [data-tooltip-position="bottom"]:after {
        left: 50%;
        margin-left: -6px;
    }
    /* Dynamic vertical centering for the tooltip */
    [data-tooltip-position="right"]:after,
    [data-tooltip-position="left"]:after {
        top: 50%;
        margin-top: -6px;
    }
    [data-tooltip-position="top"]:after {
        bottom: 100%;
        border-width: 6px 6px 0;
        border-top-color: #000;
    }
    [data-tooltip-position="right"]:after {
        left: 100%;
        border-width: 6px 6px 6px 0;
        border-right-color: #000;
    }
    [data-tooltip-position="bottom"]:after {
        top: 100%;
        border-width: 0 6px 6px;
        border-bottom-color: #000;
    }
    [data-tooltip-position="left"]:after {
        right: 100%;
        border-width: 6px 0 6px 6px;
        border-left-color: #000;
    }
    /* Show the tooltip when hovering */
    [data-tooltip]:hover:before,
    [data-tooltip]:hover:after {
        display: block;
        z-index: 50;
        white-space: normal;
        width: 200px;
        word-wrap: break-word;
    }
    .scale_txt{
        position: absolute;
        margin-top: 50px;
        font-weight: 600;
        text-align: left;
        font-size: 10px;
    }
    .end-feedback-form .form-group{
        margin-bottom:1.5rem;
    }
    .sub_points_down{
        height: 175px;
        overflow-y: scroll;
        overflow-x:hidden;
    }
    #sub_scrollbar_diff::-webkit-scrollbar-thumb {
        -webkit-box-shadow: inset 0 0 6px rgb(0 0 0 / 30%);
        background-color:#03128d;
        border-radius: 0.5rem;
    }
    #sub_scrollbar_diff::-webkit-scrollbar {
        width:1.3rem;
        background-color: #fff;
        border-radius:.5rem;
    }
    #sub_scrollbar_diff::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgb(0 0 0 / 30%);
        background-color: #fff;
        border-radius:.5rem;
    }
    .scroll-css {
        height: 18rem;
        overflow-y: scroll;
        overflow-x: hidden;
    }
    .cta-btn {
        display: inline-block;
        background: #00cfff;
        background: -moz-linear-gradient(45deg, #00cfff 1%, #029bff 100%);
        background: -webkit-linear-gradient(45deg, #00cfff 1%,#029bff 100%);
        background: linear-gradient(45deg, #00cfff 1%,#029bff 100%);
        color: #fff;
        padding: 0.5rem 2.5rem;
        font-size: 1.4rem;
        border-radius:5px;
    }
    .helpcursor{
        cursor: help;
    }
    .web-tooltip [data-tooltip]:hover:before,.web-tooltip [data-tooltip]:hover:after {
        display: block;
        z-index: 50;
        white-space: normal;
        width: 320px;
        word-wrap: break-word;
    }
    .sub-web-tooltip [data-tooltip]:hover:before,.sub-web-tooltip [data-tooltip]:hover:after {
        display: block;
        z-index: 50;
        white-space: normal;
        width: 460px;
        word-wrap: break-word;
    }
    .scrollBar1 {
        position: fixed;
        top: 0vh;
        margin-top: 1px;
        height: 8px;
        width: 0%;
        background: #009b40;
        transition: width 200ms var(--timing);
        text-align: right;
        color: #fff;
        transition: 0.6s;
        margin-left: -5px;
    }
    .scrollBar1 {
        display:none;
    }
    .number-holder{
        display:block!important;
    }
    .align-middle-content{
        align-items:center;
        justify-content:center;
        display:flex;
        flex-direction:column;
        height:100vh;
    }
    .align-middle-content-1{
        align-items:center;
        justify-content:center;
        display:flex;
        flex-direction:column;
    }
    .option-holder{
        width: -webkit-fill-available;
        width:-moz-fill-available;
        width:-ms-fill-available;
        width: 100%;
    }
    .common-que-header h5 span{
        padding-left:.3rem;
    }
    .label-icon i{
        background: -webkit-linear-gradient(#00cfff, #029bff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .boolean-item [type=radio]:checked + .label-icon i,.boolean-item [type=checkbox]:checked + .label-icon i{
       -webkit-text-fill-color:#fff;
    }
    .left-side-pattern,
    .right-side-pattern{
        position:fixed;
    }
    .right-side-pattern{
        right:0;
        bottom:9rem;
    }
    .r-item label:hover{
         background: #fff;
        -webkit-box-shadow: 0 0 12px -2px rgb(0 186 255 / 41%);
        box-shadow:0 0 12px -2px rgb(0 186 255 / 41%);
        transition: 0.2s cubic-bezier(0.4, 0, 1, 1);
        border:1px solid transparent;
    }
    .boolean-item label:hover{
         background: #fff;
        -webkit-box-shadow: 0 0 10px 1px rgb(0 186 255 / 50%);
        box-shadow:0 0 10px 1px rgb(0 186 255 / 50%);
        transition: 0.2s cubic-bezier(0.4, 0, 1, 1);
        border:1px solid transparent;
    }
    .boolean-item label:hover i{
        -webkit-transform: scale(1.08);
        transform: scale(1.08);
        transition: 0.2s cubic-bezier(0.4, 0, 1, 1);
    }
    /*.footer-align{*/
    /*    display:flex;*/
    /*    justify-content:space-between;*/
    /*    padding:0 2rem;*/
    /*    position: fixed;*/
    /*    width: 100%;*/
    /*    bottom: 1.2rem;*/
    /*    z-index:-1; */
    /*}*/
    .note-txt{
        font-size: 1.2rem;
        /*color: #3c50fc;*/
        color:#000;
        margin-bottom:0;
    }
    .rank-order-num{
        background: #031186;
        padding: 0.4rem .9rem;
        border-radius: 50%;
        color: #fff;
        margin-right:1rem;
    }
    .left-float{
        float: left;
        position: fixed;
        bottom: 6.2rem;
        padding-left: 1rem;
    }
    .arrow-status{
        overflow: auto;
        position: fixed;
        right: 0;
        bottom: 1.2rem;
        padding-right: 1rem;
    }
    
    @media  screen and (max-width: 1440px) {
        .height-overflow-auto {
            height:62rem;
            overflow: auto;
        }
        .mid-align{
            flex-direction: column;
            display: flex;
            justify-content: center;
            height: calc(100vh - 17rem);
        }
    }
    @media only screen and (min-device-width: 1600px) and (max-device-width: 2048px){
        .main-que-ttl {
            font-size: 3rem;
        }
        .common-que-header h3 {
            font-size: 1.6rem;
        }
        .common-que-header h5 {
            font-size:1.4rem;
        }
        .right-div {
            position: relative;
            right: -22.2rem;
        }
        .footer-bottom-fixed p.para {
            font-size: 1.6rem;
        }
        .para {
            font-size: 2rem;
            padding-bottom: 2rem;
        }
    }
    @media screen and (min-device-width: 1200px) and (max-device-width: 1366px) and (-webkit-min-device-pixel-ratio: 1) {
        .height-overflow-auto{
            height:40rem;
            overflow:auto;
        }
    }
    @media screen and (min-device-width: 1200px) and (max-device-width: 1600px) and (-webkit-min-device-pixel-ratio: 1) { 
        .right-div {
            position: relative!important;
            right: -10.2rem!important;
        }
        .mob-tooltip{
            display:none!important;
        }
        .off-txt{
            display:block;
        }
    }
    @media only screen and (min-device-width: 1024px) and (max-device-width: 1199px) and (-webkit-min-device-pixel-ratio: 2) {
    }
    @media only screen and (min-device-width:590px) and (min-device-height: 915px) and (-webkit-min-device-pixel-ratio:2) {
        .right-div {
            position: relative;
            right:-10rem;
        }
        .mob-tooltip{
            display:none!important;
        }
        .off-txt{
            display:block;
        }
        .mid-align {
            flex-direction: column;
            display: flex;
            justify-content: center;
            height: calc(100vh - 17rem);
        }
        .height-overflow-auto {
            height: 130rem;
            overflow: auto;
        }
    }
    @media only screen and (min-device-width:599px) and (max-device-height: 767px) and (-webkit-min-device-pixel-ratio:2) {
        
        .right-div {
            position: relative;
            right: -7.2rem;
        }
        .scale-type .label-icon {
            padding: 1rem 1.8rem;
        }
        .scale-type-txt{
            display:none!important;
        }
    }
    @media only screen and (min-device-width: 480px) and (max-device-width: 550px)and (-webkit-min-device-pixel-ratio: 2) {
        .scrollBar1{
            display:block;
        }
        .scale-type .label-icon{
            padding: 1rem 1.2rem;
            font-weight: 600;
            border-radius: 0;
        }
        .off-txt{
            display:none;
        }
        .mob-tooltip{
            display: block!important;
            position: absolute!important;
            bottom:1rem;
        }
        .right-div {
            position: relative;
            right: -39rem;
        }
        [data-tooltip]:hover:before, [data-tooltip]:hover:after {
            display: block;
            z-index: 50;
            white-space: normal;
            width: 330px;
            word-wrap: break-word;
        }
        .front-ttl {
            padding-top: 2rem;
            font-size: 1.6rem;
        }
        .main-que-ttl {
            font-size: 1.4rem;
            padding:1rem 0;
        }
        .score-pt{
            display:none!important;
        }
        .opinionscalelabel{
            display:none!important;
        }
        .scale-type-txt{
            display:none!important;
        }
        .left-side-pattern,
        .right-side-pattern{
            display:none;
        }
    }
    @media only screen and (min-device-width: 320px) and (max-device-width: 480px)and (-webkit-min-device-pixel-ratio: 2) {
        .scrollBar1{
            display:block;
        }
        .scale-type .label-icon {
            padding: 1rem .8rem;
            font-weight: 600;
            border-radius: 0;
        }
        .right-div {
            position: relative;
            right: -25.2rem;
        }
        .mob-tooltip{
            display: block!important;
            position: absolute!important;
            bottom:1.5rem;
        }
        .off-txt{
            display:none;
        }
        .space-all {
            padding: 1rem;
        }
        .score-pt{
            display:none!important;
        }
        .main-que-ttl {
            font-size: 1.4rem;
            padding:1rem 0;
        }
        .front-ttl {
            padding-top: 2rem;
            font-size: 1.6rem;
        }
        .common-que-header h3 {
            font-size: 1.3rem;
        }
        .opinionscalelabel{
            display:none!important;
        }
        .scale-type-txt{
            display:none!important;
        }
        .web-tooltip [data-tooltip]:hover:before,.web-tooltip [data-tooltip]:hover:after {
            display: block;
            z-index: 50;
            white-space: normal;
            width: 200px;
            word-wrap: break-word;
        }
        .web-tooltip [data-tooltip-position="right"]:before {
            left:-420%;
            margin-left: 6px;
        }
        .web-tooltip [data-tooltip-position="right"]:before,.web-tooltip [data-tooltip-position="left"]:before {
            top: 537%;
        }
        .web-tooltip [data-tooltip-position="right"]:after {
            display:none!important;
        }
        .sub-web-tooltip [data-tooltip]:hover:before,.sub-web-tooltip [data-tooltip]:hover:after {
            display: block;
            z-index: 50;
            white-space: normal;
            width:247px;
            word-wrap: break-word;
        }
        .sub-web-tooltip [data-tooltip-position="right"]:before,
        .sub-web-tooltip [data-tooltip-position="left"]:before {
            top: 445%;
        }
        .sub-web-tooltip [data-tooltip-position="right"]:after {
            display:none!important;
        }
        .sub-web-tooltip [data-tooltip-position="right"]:before {
            left: -648%;
        }
        .height-overflow-auto {
            height: 46rem;
            overflow: auto;
        }
        .progress-circle,.progress-text{
            display:none;
        }
        .left-side-pattern,
        .right-side-pattern{
            display:none!important;
        }
        .survey-logo {
            width:10rem;
            padding-bottom: 0.5rem;
        }
        .arrow-status a{
            width:35px;
            height:35px;
        }
        .arrow-status a i{
            font-size:2rem;
        }
        .save-nxt-btn{
            padding: 0.6rem 1.3rem;
            font-size: 1rem;
        }
        .r-item .label-icon {
            padding: 0.5rem 1rem;
            font-size: 1.4rem;
            align-items: flex-start;
        }
        .note-txt{
            font-size:1.2rem;
        }
    }
     @media screen and (min-width: 320px) and (max-width: 480px){
        .left-float{
            display:none;
        }
         .main-que-ttl{
            padding:2rem 2rem;
            font-size:1.6rem;
        }
        .common-que-header h3{
            font-size:1.3rem;
        }
        .left-side-pattern img{
            display:none;
        }
        .scrollBar1{
            display:block;
        }
    }
    @media only screen and (min-device-width: 380px) and (max-device-width: 420px)and (-webkit-min-device-pixel-ratio: 2) {
        .height-overflow-auto {
            height:57rem;
            overflow: auto;
        } 
        .progress-circle,.progress-text{
            display:none;
        }
        .left-side-pattern,
        .right-side-pattern{
            display:none!important;
        }
         .arrow-status a{
            width:35px;
            height:35px;
        }
        .arrow-status a i{
            font-size:2rem;
        }
        .save-nxt-btn{
            padding: 0.6rem 1.3rem;
            font-size: 1rem;
        }
        .r-item .label-icon {
            padding: 0.5rem 1rem;
            font-size: 1.4rem;
            align-items: flex-start;
        }
        .survey-logo {
            width:10rem;
            padding-bottom: 0.5rem;
        }
        .note-txt{
            font-size:1.2rem;
        }
     }
    @media only screen and (min-device-width: 260px) and (max-device-width: 319px) and (-webkit-min-device-pixel-ratio: 2) {
      .scrollBar1{
        display:block;
      }
      .boolean-type{
        flex-direction:column;   
      }
      .boolean-item{
          margin-bottom:1.5rem;
          margin-right:0;
      }
      .star-rating label {
        color: #ccc;
        cursor: pointer;
        font-size: 3rem;
        margin: 1rem;
     }
     .space-all {
        padding:1.5rem;
     }
     .scale-type .label-icon {
        padding: .7rem .6rem;
        font-weight: 600;
        border-radius: 0;
    }
    .main-que-ttl {
        font-size: 1.4rem;
        padding:1rem 0 1rem;
    }
    .mob-tooltip{
        display: block!important;
        position: absolute!important;
        bottom:1.5rem;
    }
    .off-txt{
        display:none;
    }
    .right-div {
        position: relative;
        right: -15.2rem;
    }
    .front-ttl{
        padding-top:2rem;
        font-size:1.4rem;
    }
    .scale-type .label-icon{
        padding:.7rem .45rem;
    }
    .score-pt{
        display:none!important;
    }
    .scale-type-txt{
        display:none!important;
    }
    .text-type textarea {
        height: 10rem;
    }
    .web-tooltip [data-tooltip]:hover:before, .web-tooltip [data-tooltip]:hover:after {
        display: block;
        z-index: 50;
        white-space: normal;
        width: 192px;
        word-wrap: break-word;
    }
    .sub-web-tooltip [data-tooltip]:hover:before{
        display: block;
        z-index: 50;
        white-space: normal;
        width: 260px;
        word-wrap: break-word;
    }
    .sub-web-tooltip [data-tooltip]:hover:after{
        display:none;
    } 
    .sub-web-tooltip [data-tooltip-position="right"]:before {
        left: -240%;
        margin-left: 6px;
    }
    .progress-circle,.progress-text{
        display:none;
    }
    .height-overflow-auto {
        height: 43rem;
        overflow: auto;
    }
    .left-side-pattern,
    .right-side-pattern{
        display:none;
    }
    .note-txt{
        font-size:1.2rem;
    }
}
@media only screen and (min-device-width:320px) and (max-device-width:350px) and (-webkit-min-device-pixel-ratio: 2) {
    .survey-logo {
        width: 7rem;
        padding-bottom: 0.5rem;
    }
    .arrow-status a{
        width:20px;
        height:20px;
    }
    .arrow-status a i{
        font-size:1.6rem;
    }
    .save-nxt-btn{
        padding: 0.6rem 1.3rem;
        font-size: 1rem;
    }
    .r-item .label-icon {
        padding: 0.5rem 1rem;
        font-size: 1.2rem;
        align-items: flex-start;
    }
    .note-txt{
        font-size:1.2rem;
    }
}
@media screen and (min-width:280px) and (max-width:320px){
    .main-que-ttl{
        padding:1rem 0rem;
        font-size:1.4rem;
    }
    .common-que-header h3{
        font-size:1.2rem;
    }
    .left-side-pattern img{
        display:none;
    }
    .left-float{
        display:none;
    }
    .survey-logo{
        width:10.5rem;
    }
    .arrow-status a{
        width:30px;
        height:30px;
    }
    .scrollBar1{
        display:block;
    }
}
.save-nxt-btn:hover{
    -webkit-box-shadow: 0 0 10px 1px rgb(84 84 84 / 50%);
    box-shadow:0 0 10px 1px rgb(84 84 84 / 50%);
    transition: 0.2s cubic-bezier(0.4, 0, 1, 1);
}
.save-nxt-btn:hover i{
    padding-left:5px;
}
/*----new-css-23-2-23------*/
.main-que-ttl {
    font-size: 2.4rem;
    padding: 3rem 0 2rem;
    color:#02118e;
}
/*.common-que-header {*/
/*    background: #02118e;*/
/*}*/
.common-que-header h3 {
    font-size: 1.8rem;
    /*color:#fff;*/
}
.common-que-header h5 {
    font-size: 1.3rem;
    padding-bottom: 0.5rem;
    font-weight: 400;
    color:#031081;
}
.note-txt {
    font-size: 1.2rem;
    color:#000;
    margin-bottom: 0;
}
[type=radio]:checked + .label-icon, [type=checkbox]:checked + .label-icon {
    background:#08b8d7;
}
.left-float {
    float: left;
    position: fixed;
    bottom: 6.2rem;
    padding-left: 1rem;
    left:12rem;
}
.arrow-status{
    right:6rem;
}
.top-right-pattern{
    position:fixed;
    right:0;
    top:0;
    width:30%;
    z-index:-1;
}
.left-bottom-pattern{
    position:fixed;
    left:0;
    bottom:-10rem;
    z-index:-1;
    width:17%;
    transform:rotate(90deg);
}
.r-item .label-icon {
    padding: 0.9rem 1rem;
    font-size: 1.4rem;
    align-items: flex-start;
}
.save-nxt-btn {
    border: 0.1rem solid #02118e;
    padding: 1rem 2.3rem;
    font-size: 1.4rem;
    border-radius: 50px;
    font-weight: 500;
    background: #02118e;
    color: #fff;
}
.save-nxt-btn:hover{
    color:#fff;
}
.save-nxt-btn i{
    transform: translateY(0%) translateX(0);
    transition: transform .1125s cubic-bezier(.785,.135,.15,.86);
}
.save-nxt-btn:hover i{
    transform: translateY(0%) translateX(4px);
    transition: transform .1125s cubic-bezier(.785,.135,.15,.86);
}
@media screen and (min-width: 320px) and (max-width: 480px){
    .main-que-ttl {
        font-size: 1.5rem;
        padding: 1rem 0 1rem;
    }
    .common-que-header h3 {
        font-size: 1.4rem;
    }
    .arrow-status {
        right: 0rem;
    }
    .label-icon .num-holder {
        margin-right: 1rem;
        font-size: 1.3rem;
        font-weight: 700;
        padding-top: 0px;
    }
    .r-item .label-icon {
        padding: 0.6rem 1rem;
        font-size: 1.3rem;
        align-items: flex-start;
    }
    .sn-btn.text-center{
        text-align:left!important;
    }
    .note-txt {
        font-size: 1rem;
    }
    .r-item {
        margin-bottom: 1.3rem;
    }
    .label-icon {
       padding: 2rem 3rem; 
    }
    .save-nxt-btn {
        padding: 0.6rem 1.3rem;
        font-size: 1rem;
    }
    .thank-you-ttl {
        font-size: 1.4rem;
        padding-bottom: 1.4rem;
        font-weight: 700;
    }
    .common-que-header {
        padding:1rem;
    }
    .submit-btn {
        padding: 0.6rem 2.2rem;
        font-size: 1.2rem;
    }
    .top-right-pattern{
        display:none;
    }
    .tooltip .fa {
        font-size: 14px;
    }
}
</style>
<script src="<?php echo SITEPATH; ?>bower_components/jquery/dist/jquery.min.js"></script>
<body>
    <!--Data for question-->
    <input type="hidden" id="all_question_id" name="all_question_id" value="">
    <input type="hidden" id="all_answers" name="all_answers" value="">
    <input type="hidden" id="current_answer" name="current_answer" value="">
    <input type="hidden" name="setqno" id="setqno" value="">
    <input type="hidden" name="qsequence" id="qsequence" value="">
    <input type="hidden" name="sessipaddrlastform" id="sessipaddrlastform" value="">
    <input type="hidden" name="footer_tagline" id="footer_tagline" value="<?php echo $footer_tagline; ?>">
     <input type="hidden" name="aqcnt" id="aqcnt" value="<?php echo $totalquest+1; ?>">
    <!--End Data for question-->
    
    <!-- Mobile progress bar -->
    <div class="row">  
      <div class="col-md-12">
        <div class="scrollBar1"></div>
      </div>    
    </div>
    <!-- End Mobile Progress bar -->
    
    <!---left-pattern-start-->
        <div class="top-right-pattern">
            <img src="<?php echo SITEPATHFRONT;?>images/pattern-top.png" class="img-fluid" alt="left-side-pattern">
        </div>
    <!--left-pattern-end-->
    
    
    <!--Cross button section-->
    <div class="close-btn" aria-label="Close alert" id="close_button" href="javascript:void(0);" onclick="close_survey();" title="Close Survey">
        <i class="fa fa-times"></i>
    </div>  
    <!--<div class="close-btn" style="float:left;">-->
    <!--    <h4 class="first_survey_heading main-que-ttl mb-0" style="display:none;" id="sqtitle">-->
    <!--    <?php echo $survey_title;?>-->
    <!--    </h4>-->
    <!--</div>  -->
    <!--End Cross button section-->
    
    <div class="container-fluid pb-5">
        <!--Intro page section-->
        <?php //if($surveyid!="f956f508-2b89-4f19-93ea-e343a8531938"){?>
        <!--<div class="row front-ttl-align">-->
        <!--    <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 text-center align-middle-content" id="temp_section">-->
        <!--        <h1 class="front-ttl mb-0"><?php echo $survey_title;?></h1>-->
        <!--        <p class="mb-0 para"><?php echo $survey_description;?></p>-->
        <!--        <a class="btn submit-btn" id="btn_get_started">-->
        <!--            <div id="" class="slide"></div>-->
        <!--           OF COURSE, YES :)-->
        <!--        </a>-->
        <!--    </div>-->
        <!--</div>-->
        <?php //}?>
        <!--End Intro page section-->
        
        <div class="row">
            <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 align-items-start">
                <div>
                    <h4 class="note-txt text-center">Your data and responses are safe with us. Privacy is our business!</h4>
                </div>
                
                <h4 class="first_survey_heading main-que-ttl mb-0" style="display:none;" id="sqtitle">
                 Title:
                 <?php //if(isset($_GET['name']) && isset($_GET['email'])){?>
                    <?php //if(strlen($survey_title)>150){?>
                    <!--<span><?php echo substr($survey_title,0,150)."...";?>-->
                    <!--    <div class="tooltip web-tooltip">-->
                    <!--        <span data-tooltip="<?php echo $survey_title; ?>" data-tooltip-position="right">-->
                    <!--            <i class="fa fa-info-circle text-white text-white"></i>-->
                    <!--        </span>-->
                    <!--    </div>-->
                    <!--</span>-->
                    <?php //}else { ?>
                    <!--<span><?php //echo $survey_title;?></span>-->
                    <?php //}?>
                    <?php //} else {?>
                    <?php echo $survey_title;?>
                    <?php //}?>
                </h4>
                    
                
            </div>
        </div>
        <!--Question with thankyou and survey submit section-->
        <div class="row" id="sub_scrollbar_diff">
            <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 align-middle-content-1">
                <h4 class="first_survey_heading main-que-ttl mb-0" style="display:none;" id="sqtitle">
                    <?php //if(isset($_GET['name']) && isset($_GET['email'])){?>
                    <?php //if(strlen($survey_title)>150){?>
                    <!--<span><?php echo substr($survey_title,0,150)."...";?>-->
                    <!--    <div class="tooltip web-tooltip">-->
                    <!--        <span data-tooltip="<?php echo $survey_title; ?>" data-tooltip-position="right">-->
                    <!--            <i class="fa fa-info-circle text-white text-white"></i>-->
                    <!--        </span>-->
                    <!--    </div>-->
                    <!--</span>-->
                    <?php //}else { ?>
                    <!--<span><?php //echo $survey_title;?></span>-->
                    <?php //}?>
                    <?php //} else {?>
                    <?php echo $survey_title;?>
                    <?php //}?>
                </h4>
                
                <div class="option-holder que_section" id="divQstn">
                    <input type="hidden" id="progress_count" class="progress_count" value="<?php echo count($all_questions); ?>">
                    <?php $srno=1;foreach ($all_questions as $all_question) { 
                         /**********All Sub Points Questions***************/
                        $fields_subpoints = "*";
                        $condition_subpoints = "`tbl_questionSub`.`question_id` =".$all_question['question_id'];
                        if($all_question['quest_type_id'] == "8")
                        {
                            $orderbysub="`tbl_questionSub`.`rank_order_sequence` asc ";
                            $all_subpoints=$obj_survey->getSubQuestionPoints($fields_subpoints, $condition_subpoints, $orderbysub, '', 0);
                        }
                        else
                        {
                           $all_subpoints=$obj_survey->getSubQuestionPoints($fields_subpoints, $condition_subpoints, '', '', 0); 
                        }
                        
                        $fields_questtype = "quest_type";
                        $condition_questtype = "`tbl_question_type`.`quest_type_id` =".$all_question['quest_type_id'];
                        $all_question_types=$obj_survey->getQuestionType($fields_questtype, $condition_questtype, '', '', 0);
                        foreach($all_question_types as $all_question_type){
                            $qtypename=$all_question_type['quest_type'];
                        }
                        //echo $all_question['quest_type_id'];
                    ?>
                    <?php if($all_question['quest_type_id'] == "1") { ?> 
                    <!-------boolean-type---------->
                    <div id="que_<?php echo $srno;?>" style="display:none"  class="que_scroll item" data-id='<?php echo $srno;?>'  isAttempted="0">
                        <div class="common-que-header">
                            <div class="align-txt">
                                <h5 class="mb-0">Question<span id="displayqno_<?php echo $srno;?>"></span> <sup id="star_<?php echo $srno;?>" class="text-danger" style="display:none;" >*</sup></h5>
                                <?php if($all_question['tooltip']!=""){
                                    $str_tooltip = ($all_question['tooltip']);
                                    $replace_tooltip = str_replace("'","","$str_tooltip");
                                ?>
                                <div class="tooltip"><span data-tooltip="<?php echo $replace_tooltip; ?>" data-tooltip-position="left">
                                     <i class="fa fa-info-circle text-white"></i></span>
                                </div>
                                <?php }?>
                            </div>
                            <h3 class="mb-0">
                                <?php //if(strlen($all_question['question_title'])>180){?>
                                <!--<span><?php //echo substr(stripslashes($all_question['question_title']),0,180)."...";?>-->
                                <!--    <div class="tooltip sub-web-tooltip">-->
                                <!--        <span data-tooltip="<?php echo stripslashes($all_question['question_title']); ?>" data-tooltip-position="right">-->
                                <!--            <i class="fa fa-info-circle text-white text-white text-white"></i>-->
                                <!--        </span>-->
                                <!--    </div>-->
                                <!--</span>-->
                                <?php //}else {?>
                                <span><?php echo stripslashes($all_question['question_title']);?></span>
                                <?php //}?>
                            </h3>

                        </div>
                        <input type="hidden" name="qtypename_<?php echo $srno;?>" id="qtypename_<?php echo $srno;?>" value="<?php echo $qtypename?>">
                        <input type="hidden" name="qidthis_<?php echo $srno;?>" id="qidthis_<?php echo $srno;?>" value="<?php echo $all_question['question_id'];?>">
                        <input type="hidden" name="required_<?php echo $srno;?>" id="required_<?php echo $srno;?>" value="<?php echo $all_question['is_required'];?>">
                        <input type="hidden" name="skip_from_<?php echo $srno;?>" id="skip_from_<?php echo $srno;?>" value="<?php echo $all_question['skip_from_which_question'];?>">
                        <input type="hidden" name="skip_to_<?php echo $all_question['question_id'];?>" id="skip_to_<?php echo $all_question['question_id'];?>" value="<?php echo $all_question['skip_question_where_to'];?>">
    
                        <!-------boolean-type options---------->
                        <div class="bg-shadow" id="sub_scrollbar_diff">
                            <div class="boolean-type space-all">
                                <?php foreach($all_subpoints as $all_subpoint){ ?>
                                <input type="hidden" name="skip_<?php echo $all_subpoint['question_subid'];?>" id="skip_<?php echo $all_subpoint['question_subid'];?>" value="<?php echo $all_subpoint['skip_question'];?>">
                                <div class="boolean-item">
                                    <input class="checkbox-tools" type="radio" name="bool_<?php echo $srno;?>" id="bool_<?php echo $all_subpoint['question_subid'];?>" value="<?php echo stripslashes($all_subpoint['question_subtitle']);?>" onchange="SetAttempted(this,<?php echo $all_question['sequence'];?>,<?php echo $all_question['question_id'];?>,<?php echo $srno;?>)" onclick="setnext(<?php echo $srno;?>,<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,<?php echo $all_subpoint['question_subid'];?>);">
                                    <label class="label-icon option1" for="bool_<?php echo $all_subpoint['question_subid'];?>">
                                        <?php if($all_subpoint['question_subtitle'] == "Yes"){ ?> <i class='icon-Yes'></i><?php echo stripslashes($all_subpoint['question_subtitle']);?><?php } ?>
                            			<?php if($all_subpoint['question_subtitle'] == "No"){ ?> <i class='icon-No'></i><?php echo stripslashes($all_subpoint['question_subtitle']);?><?php } ?>
                                    </label>
                                </div>
                                
                                <?php }?>
                            </div>
                        </div>
                    <?php if($all_question['is_required']=="Yes") { ?>    
                        <div class="row pt-6 d-none">
                            <div class="col-md-12">
                               <a id="next" class="next btn_skip skip-txt disabled" title="Skip">Skip</a>
                            </div>
                        </div>
                        <?php }else{ ?>
                        <div class="row pt-6">
                            <div class="col-md-12">
                               <a id="next" class="next btn_skip skip-txt enabled" title="Skip">Skip</a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <!-------End boolean-type---------->
                    <?php }?>
                    
                    <?php if ($all_question['quest_type_id'] == "7") { //echo $all_question['quest_type_id'];?>
                    <!----------opinion scale-type---------->
                    <div id="que_<?php echo $srno;?>" style="display:none;" class="que_scroll item" data-id='<?php echo $srno;?>'  isAttempted="0">
                        <div class="common-que-header">
                            <div class="align-txt">
                                <h5 class="mb-0">Question<span id="displayqno_<?php echo $srno;?>"></span> <sup id="star_<?php echo $srno;?>" class="text-danger" style="display:none;" >*</sup></h5>
                                <?php if($all_question['tooltip']!=""){
                                    $str_tooltip = ($all_question['tooltip']);
                                    $replace_tooltip = str_replace("'","","$str_tooltip");
                                ?>
                                <div class="tooltip"><span data-tooltip="<?php echo $replace_tooltip; ?>" data-tooltip-position="left">
                                     <i class="fa fa-info-circle text-white"></i></span>
                                </div>
                                <?php }?>
                            </div>
                            <h3 class="mb-0">
                                <?php //if(strlen($all_question['question_title'])>180){?>
                                <!--<span><?php echo substr(stripslashes($all_question['question_title']),0,180)."...";?>-->
                                <!--    <div class="tooltip sub-web-tooltip">-->
                                <!--        <span data-tooltip="<?php echo stripslashes($all_question['question_title']); ?>" data-tooltip-position="right">-->
                                <!--            <i class="fa fa-info-circle text-white text-white"></i>-->
                                <!--        </span>-->
                                <!--    </div>-->
                                <!--</span>-->
                                <?php //}else {?>
                                <span><?php echo stripslashes($all_question['question_title']);?></span>
                                <?php //}?>
                            </h3>
                        </div>
                        <input type="hidden" name="qtypename_<?php echo $srno;?>" id="qtypename_<?php echo $srno;?>" value="<?php echo $qtypename?>">
                        <input type="hidden" name="qidthis_<?php echo $srno;?>" id="qidthis_<?php echo $srno;?>" value="<?php echo $all_question['question_id'];?>">
                        <input type="hidden" name="required_<?php echo $srno;?>" id="required_<?php echo $srno;?>" value="<?php echo $all_question['is_required'];?>">
                        <input type="hidden" name="skip_from_<?php echo $srno;?>" id="skip_from_<?php echo $srno;?>" value="<?php echo $all_question['skip_from_which_question'];?>">
                        <input type="hidden" name="skip_to_<?php echo $all_question['question_id'];?>" id="skip_to_<?php echo $all_question['question_id'];?>" value="<?php echo $all_question['skip_question_where_to'];?>">
                        <?php foreach($all_subpoints as $all_subpoint)
                              { 
                                $scale_str =  stripslashes($all_subpoint['question_subtitle']);
                                $scale_str_exp = explode(",",$scale_str); 
                                $min = "0"; 
                                $max="10";  
                                $avg = intval(($min+$max)/2);   
                                $opinion_scale= $all_subpoint['opinion_scale_text'];
                                $opinion_scale_text = explode(",",$opinion_scale); 
                                
                                $left_text = $opinion_scale_text[0];
                                $middle_text = $opinion_scale_text[1];
                                $right_text = $opinion_scale_text[2];
                        ?>
                        <input type="hidden" name="skip_<?php echo $all_subpoint['question_subid'];?>" id="skip_<?php echo $all_subpoint['question_subid'];?>" value="<?php echo $all_subpoint['skip_question'];?>">

                        <!----------scale-type option---------->
                        <div class="bg-shadow ht-auto">
                            <div class="row space-all">
                                <div class="col-md-12">
                                    <div class="scale-type">
                                        <?php for($sc=0;$sc<=$max;$sc++){ ?>
                                        <div>
                                            <input type="radio" class="scale" id="scale-<?php echo $all_subpoint['question_subid']."-".$sc;?>" value="<?php echo $sc;?>" name="scale_<?php echo $all_subpoint['question_subid'];?>" onchange="SetAttempted(this,<?php echo $all_question['sequence'];?>,<?php echo $all_question['question_id'];?>,<?php echo $srno;?>)" onclick="setnext(<?php echo $srno;?>,<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,this.value)"/>
                                            <label class="label-icon" for="scale-<?php echo $all_subpoint['question_subid']."-".$sc;?>"><?php echo $sc;?></label>
                                        </div>
                                        <?php }?>
                                    </div>
                                </div>
                                <div class="col-md-11">
                                    <div class="scale-type scale-type-txt">
                                        <?php for($sc=0;$sc<=$max;$sc++){ ?>
                                            <?php if($sc==$min){?>
                                            <div class="col-md-1"><?php echo $left_text;?></div>
                                            <?php } elseif($sc==$avg){?>
                                            <div class="neutral-point col-md-1"><?php echo $middle_text;?></div>
                                            <?php } elseif($sc==$max){?>
                                            <div class="col-md-1"><?php echo $right_text;?></div>
                                            <?php } else {?>
                                            <div class="col-md-1 opinionscalelabel">&nbsp;</div>
                                            <?php }?>
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php  }  ?>
                        <?php if($all_question['is_required']=="Yes") { ?>    
                        <div class="row pt-6 d-none">
                            <div class="col-md-12">
                               <a id="next" class="next btn_skip skip-txt disabled" title="Skip">Skip</a>
                            </div>
                        </div>
                        <?php }else{ ?>
                        <div class="row pt-6">
                            <div class="col-md-12">
                               <a id="next" class="next btn_skip skip-txt enabled" title="Skip">Skip</a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <!----------End opinion scale-type---------->
                    <?php }?>
                    
                    <?php if ($all_question['quest_type_id'] == "5") {  ?>
                    <!-------star rating-type------------>
                    <div id="que_<?php echo $srno;?>" style="display:none;" class="que_scroll item" data-id='<?php echo $srno;?>'  isAttempted="0">
                        <div class="common-que-header">
                            <div class="align-txt">
                                <h5 class="mb-0">Question<span id="displayqno_<?php echo $srno;?>"></span> <sup id="star_<?php echo $srno;?>" class="text-danger" style="display:none;" >*</sup></h5>
                                <?php if($all_question['tooltip']!=""){
                                    $str_tooltip = ($all_question['tooltip']);
                                    $replace_tooltip = str_replace("'","","$str_tooltip");
                                ?>
                                <div class="tooltip"><span data-tooltip="<?php echo $replace_tooltip; ?>" data-tooltip-position="left">
                                     <i class="fa fa-info-circle  text-white"></i></span>
                                </div>
                                <?php }?>
                            </div>
                            <h3 class="mb-0">
                                <?php //if(strlen($all_question['question_title'])>180){?>
                                <!--<span><?php echo substr(stripslashes($all_question['question_title']),0,180)."...";?>-->
                                <!--    <div class="tooltip sub-web-tooltip">-->
                                <!--        <span data-tooltip="<?php echo stripslashes($all_question['question_title']); ?>" data-tooltip-position="right">-->
                                <!--            <i class="fa fa-info-circle text-white text-white"></i>-->
                                <!--        </span>-->
                                <!--    </div>-->
                                <!--</span>-->
                                <?php //}else {?>
                                <span><?php echo stripslashes($all_question['question_title']);?></span>
                                <?php //}?>
                            </h3>
                        </div>
                        <input type="hidden" name="qtypename_<?php echo $srno;?>" id="qtypename_<?php echo $srno;?>" value="<?php echo $qtypename?>">
                        <input type="hidden" name="qidthis_<?php echo $srno;?>" id="qidthis_<?php echo $srno;?>" value="<?php echo $all_question['question_id'];?>">
                        <input type="hidden" name="required_<?php echo $srno;?>" id="required_<?php echo $srno;?>" value="<?php echo $all_question['is_required'];?>">
                        <input type="hidden" name="skip_from_<?php echo $srno;?>" id="skip_from_<?php echo $srno;?>" value="<?php echo $all_question['skip_from_which_question'];?>">
                        <input type="hidden" name="skip_to_<?php echo $all_question['question_id'];?>" id="skip_to_<?php echo $all_question['question_id'];?>" value="<?php echo $all_question['skip_question_where_to'];?>">

                         <!-------rating-type option------------>
                        <?php foreach($all_subpoints as $all_subpoint){ $subratingid=$all_subpoint['question_subid'];}?>
                        <input type="hidden" name="skip_<?php echo $all_subpoint['question_subid'];?>" id="skip_<?php echo $all_subpoint['question_subid'];?>" value="<?php echo $all_subpoint['skip_question'];?>">

                        <div class="bg-shadow ht-auto">
                            <div class="row space-all">
                                <div class="col-md-12">
                                    <div class="star-rating">
                                        <input class="star star-5" onchange="SetAttempted(this,<?php echo $all_question['sequence'];?>,<?php echo $all_question['question_id'];?>,<?php echo $srno;?>)" id="star_<?php echo $subratingid."1";?>" value="5" type="radio" name="star_<?php echo $subratingid;?>" onclick="setnext(<?php echo $srno;?>,<?php echo $subratingid;?>,<?php echo $all_question['question_id'];?>,this.value);"/>
                                        <label class="star star-5" for="star_<?php echo $subratingid."1";?>"></label>
                                        <input class="star star-4" onchange="SetAttempted(this,<?php echo $all_question['sequence'];?>,<?php echo $all_question['question_id'];?>,<?php echo $srno;?>)" id="star_<?php echo $subratingid."2";?>" value="4" type="radio" name="star_<?php echo $subratingid;?>" onclick="setnext(<?php echo $srno;?>,<?php echo $subratingid;?>,<?php echo $all_question['question_id'];?>,this.value);"/>
                                        <label class="star star-4" for="star_<?php echo $subratingid."2";?>"></label>
                                        <input class="star star-3" onchange="SetAttempted(this,<?php echo $all_question['sequence'];?>,<?php echo $all_question['question_id'];?>,<?php echo $srno;?>)" id="star_<?php echo $subratingid."3";?>" value="3" type="radio" name="star_<?php echo $subratingid;?>" onclick="setnext(<?php echo $srno;?>,<?php echo $subratingid;?>,<?php echo $all_question['question_id'];?>,this.value);"/>
                                        <label class="star star-3" for="star_<?php echo $subratingid."3";?>"></label>
                                        <input class="star star-2" onchange="SetAttempted(this,<?php echo $all_question['sequence'];?>,<?php echo $all_question['question_id'];?>,<?php echo $srno;?>)" id="star_<?php echo $subratingid."4";?>" value="2" type="radio" name="star_<?php echo $subratingid;?>" onclick="setnext(<?php echo $srno;?>,<?php echo $subratingid;?>,<?php echo $all_question['question_id'];?>,this.value);"/>
                                        <label class="star star-2" for="star_<?php echo $subratingid."4";?>"></label>
                                        <input class="star star-1" onchange="SetAttempted(this,<?php echo $all_question['sequence'];?>,<?php echo $all_question['question_id'];?>,<?php echo $srno;?>)" id="star_<?php echo $subratingid."5";?>" value="1" type="radio" name="star_<?php echo $subratingid;?>" onclick="setnext(<?php echo $srno;?>,<?php echo $subratingid;?>,<?php echo $all_question['question_id'];?>,this.value);"/>
                                        <label class="star star-1" for="star_<?php echo $subratingid."5";?>"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if($all_question['is_required']=="Yes") { ?>    
                        <div class="row pt-6 d-none">
                            <div class="col-md-12">
                               <a id="next" class="next btn_skip skip-txt disabled" title="Skip">Skip</a>
                            </div>
                        </div>
                        <?php }else{ ?>
                        <div class="row pt-6">
                            <div class="col-md-12">
                               <a id="next" class="next btn_skip skip-txt enabled" title="Skip">Skip</a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <!-------End star rating-type------------>
                    <?php }?>
                   
                   
                    <?php if($all_question['quest_type_id']=="4") { ?> 
                    <!-------text-type-------------->
                    <div id="que_<?php echo $srno;?>" style="display:none;" class="que_scroll item" data-id='<?php echo $srno;?>'  isAttempted="0">
                        <div class="common-que-header">
                            <div class="align-txt">
                                <h5 class="mb-0">Question<span id="displayqno_<?php echo $srno;?>"></span> <sup id="star_<?php echo $srno;?>" class="text-danger" style="display:none;" >*</sup></h5>
                                <?php if($all_question['tooltip']!=""){
                                    $str_tooltip = ($all_question['tooltip']);
                                    $replace_tooltip = str_replace("'","","$str_tooltip");
                                ?>
                                <div class="tooltip"><span data-tooltip="<?php echo $replace_tooltip; ?>" data-tooltip-position="left">
                                     <i class="fa fa-info-circle  text-white"></i></span>
                                </div>
                                <?php }?>
                            </div>
                            <h3 class="mb-0">
                                <?php //if(strlen($all_question['question_title'])>180){?>
                                <!--<span>--><?php //echo substr(stripslashes($all_question['question_title']),0,180)."...";?>
                                <!--    <div class="tooltip sub-web-tooltip">-->
                                <!--        <span data-tooltip="<?php echo stripslashes($all_question['question_title']); ?>" data-tooltip-position="right">-->
                                <!--            <i class="fa fa-info-circle text-white text-white"></i>-->
                                <!--        </span>-->
                                <!--    </div>-->
                                <!--</span>-->
                                <?php //}else {?>
                                <span><?php echo stripslashes($all_question['question_title']);?></span>
                                <?php //}?>
                            </h3>
                        </div>
                         <input type="hidden" name="qtypename_<?php echo $srno;?>" id="qtypename_<?php echo $srno;?>" value="<?php echo $qtypename?>">
                         <input type="hidden" name="qidthis_<?php echo $srno;?>" id="qidthis_<?php echo $srno;?>" value="<?php echo $all_question['question_id'];?>">
                         <input type="hidden" name="required_<?php echo $srno;?>" id="required_<?php echo $srno;?>" value="<?php echo $all_question['is_required'];?>">
                         <input type="hidden" name="skip_from_<?php echo $srno;?>" id="skip_from_<?php echo $srno;?>" value="<?php echo $all_question['skip_from_which_question'];?>">
                         <input type="hidden" name="skip_to_<?php echo $all_question['question_id'];?>" id="skip_to_<?php echo $all_question['question_id'];?>" value="<?php echo $all_question['skip_question_where_to'];?>">
                        
                        <!-------text-type option-------------->
                        <?php foreach($all_subpoints as $all_subpoint)
                              {
                                $texttype=$all_subpoint['question_subtitle'];
                                $pos=stripos($texttype,'-');
                                if($pos)
                                {
                                    $fulltexttype=explode("-",$texttype);
                                    $texttype=$fulltexttype[1];
                                }
                              }
                        ?>
                        <div class="bg-shadow ht-auto">
                            <div class="row space-all">
                                <div class="col-md-12">
                                    <div class="text-type">
                                        <?php if($texttype=="Text" || $texttype=="text"){?>
                                        <input type="text" autocomplete = "off" placeholder="Please Enter Your Response" class="form-control" name="texttype" id='texttype_<?php echo $all_question['question_id'];?>' value="" onkeyup="activenextbutton(<?php echo $srno;?>,<?php echo $all_question['question_id'];?>)" onchange="SetAttempted(this,<?php echo $all_question['sequence'];?>,<?php echo $all_question['question_id'];?>,<?php echo $srno;?>)"/>
                                        <?php }?>
                                        <?php if($texttype=="textarea"){?>
                                        <textarea row="5" col="10" placeholder="Please Enter Your Response" class="form-control" name="texttype" id='texttype_<?php echo $all_question['question_id'];?>' value="" onkeyup="activenextbutton(<?php echo $srno;?>,<?php echo $all_question['question_id'];?>)" onchange="SetAttempted(this,<?php echo $all_question['sequence'];?>,<?php echo $all_question['question_id'];?>,<?php echo $srno;?>)"></textarea>
                                        <?php }?>
                                    </div> 
                                </div>
                            </div>
                        </div>
                        <div class="row pt-6">
                            <div class="col-md-12 text-center sn-btn">
                                <a class="btn save-nxt-btn action-btn-disabled" id="button_next_<?php echo $all_question['question_id'];?>" onclick="setnext(<?php echo $srno;?>,<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,'');">Save & Next
                                    <i class="fa fa-arrow-right ps-3"></i>
                                </a> 
                             <?php if($all_question['is_required']=="Yes") { ?>
                                <a id="next" class="next btn_skip skip-txt d-none" title="Skip">Skip</a>
                             <?php }else{ ?>
                                <a id="next" class="next btn_skip skip-txt" title="Skip">Skip</a>
                             <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!-------End text-type-------------->
                    <?php }?>
                    
                    <?php if($all_question['quest_type_id']=="2") { ?>
                    <!-------radio-type------------>
                    <div id="que_<?php echo $srno;?>" style="display:none;" class="que_scroll item" data-id='<?php echo $srno;?>'  isAttempted="0">
                        <div class="common-que-header">
                            <div class="align-txt">
                                <h5 class="mb-0">Question<span id="displayqno_<?php echo $srno;?>"></span> <sup id="star_<?php echo $srno;?>" class="text-danger" style="display:none;" >*</sup></h5>
                                <?php if($all_question['tooltip']!=""){
                                    $str_tooltip = ($all_question['tooltip']);
                                    $replace_tooltip = str_replace("'","","$str_tooltip");
                                ?>
                                <div class="tooltip"><span data-tooltip="<?php echo $replace_tooltip; ?>" data-tooltip-position="left">
                                     <i class="fa fa-info-circle text-white"></i></span>
                                </div>
                                <?php }?>
                            </div>
                            <h3 class="mb-0">
                                <?php //if(strlen($all_question['question_title'])>180){?>
                                <!--<span><?php //echo substr(stripslashes($all_question['question_title']),0,180)."...";?>-->
                                <!--    <div class="tooltip sub-web-tooltip">-->
                                <!--        <span data-tooltip="<?php echo stripslashes($all_question['question_title']); ?>" data-tooltip-position="right">-->
                                <!--            <i class="fa fa-info-circle text-white text-white"></i>-->
                                <!--        </span>-->
                                <!--    </div>-->
                                <!--</span>-->
                                <?php //}else {?>
                                <span><?php echo stripslashes($all_question['question_title']);?></span>
                                <?php //}?>
                            </h3>
                        </div>
                        <input type="hidden" name="qtypename_<?php echo $srno;?>" id="qtypename_<?php echo $srno;?>" value="<?php echo $qtypename?>">
                        <input type="hidden" name="qidthis_<?php echo $srno;?>" id="qidthis_<?php echo $srno;?>" value="<?php echo $all_question['question_id'];?>">
                        <input type="hidden" name="required_<?php echo $srno;?>" id="required_<?php echo $srno;?>" value="<?php echo $all_question['is_required'];?>">
                        <input type="hidden" name="skip_from_<?php echo $srno;?>" id="skip_from_<?php echo $srno;?>" value="<?php echo $all_question['skip_from_which_question'];?>">
                        <input type="hidden" name="skip_to_<?php echo $all_question['question_id'];?>" id="skip_to_<?php echo $all_question['question_id'];?>" value="<?php echo $all_question['skip_question_where_to'];?>">

                        <!-------radio-type-options------------>
                        <div class="bg-shadow" id="sub_scrollbar_diff">
                            
                                <div class="row space-all">
                                    <?php $counter = 0; foreach($all_subpoints as $all_subpoint){ $counter++; ?> 
                                    <div class="col-md-6">
                                        <div class="r-item">
                                            <input type="hidden" name="skip_<?php echo $all_subpoint['question_subid'];?>" id="skip_<?php echo $all_subpoint['question_subid'];?>" value="<?php echo $all_subpoint['skip_question'];?>">
                                            <input type="radio" name="radiotype_<?php echo $srno;?>" id="radiotype_<?php echo $all_subpoint['question_subid'];?>" onchange="SetAttempted(this,<?php echo $all_question['sequence'];?>,<?php echo $all_question['question_id'];?>,<?php echo $srno;?>);" value='<?php echo stripslashes(str_replace("'", '"', $all_subpoint['question_subtitle'])) ;?>' <?php if($all_subpoint['question_subtitle']!="Other"){?> onclick="setnext('<?php echo $srno;?>','<?php echo $all_subpoint['question_subid'];?>',<?php echo $all_question['question_id'];?>,<?php echo $all_subpoint['question_subid'];?>);" <?php } else {?> onclick="showradtextbox(<?php echo $all_question['question_id'];?>);" <?php }?>>
                                            <label class="label-icon" for="radiotype_<?php echo $all_subpoint['question_subid'];?>">
                                                <?php echo stripslashes($all_subpoint['question_subtitle']);?>
                                            </label>
                                            <input type="hidden" value="<?php echo strlen(stripslashes($all_subpoint['question_subtitle']));?>" id="rdo_sub_char_count_<?php echo $counter; ?>" name="rdo_sub_char_count">
                                        </div>
                                </div>
                                    <?php }?>
                                    <input type="hidden" value="<?php echo count($all_subpoints); ?>" id="arr_count_rdo" name="arr_count_rdo">
                                    <input type="hidden" value="<?php echo $counter;?>" id="rdo_sub_count" name="rdo_sub_count">
                                    <div style="display:none" id="radio_other_text_field_<?php echo $all_question['question_id'];?>">
                                        <div class="row">
                                            <div class="col-md-12 end-feedback-form text-center sn-btn">
                                    			<div class="form-group">
                                                   <input type="text" class="form-control" autocomplete = "off" placeholder="Please Enter Your Response" name="radio_other_text_<?php echo $all_question['question_id'];?>" id='radio_other_text_<?php echo $all_question['question_id'];?>' value="" onkeyup="activenextbutton(<?php echo $srno;?>,<?php echo $all_question['question_id'];?>)"/>
                                                </div>
                                                <a class="btn save-nxt-btn action-btn-disabled" id="btn_next_other_radio_<?php echo $all_question['question_id'];?>" onclick="setnext(<?php echo $srno;?>,<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,'');">Save & Next
                                                        <i class="fa fa-arrow-right ps-3"></i>
                                                </a> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                        </div>
                        <?php if($all_question['is_required']=="Yes") { ?>    
                        <div class="row pt-6 d-none">
                            <div class="col-md-12">
                               <a id="next" class="next btn_skip skip-txt disabled" title="Skip">Skip</a>
                            </div>
                        </div>
                        <?php }else{ ?>
                        <div class="row pt-6">
                            <div class="col-md-12">
                               <a id="next" class="next btn_skip skip-txt enabled" title="Skip">Skip</a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <!-------End radio-type------------>
                    <?php }?>
                    
                    <?php if($all_question['quest_type_id']=="3") { ?>
                    <!--------checkbox-type--------->
                    <div id="que_<?php echo $srno;?>" style="display:none;" class="que_scroll item" data-id='<?php echo $srno;?>'  isAttempted="0">
                        <div class="common-que-header">
                            <div class="align-txt">
                                <h5 class="mb-0">Question<span id="displayqno_<?php echo $srno;?>"></span> <sup id="star_<?php echo $srno;?>" class="text-danger" style="display:none;" >*</sup></h5>
                                <?php if($all_question['tooltip']!=""){
                                    $str_tooltip = ($all_question['tooltip']);
                                    $replace_tooltip = str_replace("'","","$str_tooltip");
                                ?>
                                <div class="tooltip"><span data-tooltip="<?php echo $replace_tooltip; ?>" data-tooltip-position="left">
                                     <i class="fa fa-info-circle text-white"></i></span>
                                </div>
                                <?php }else{?>
                                <div class="tooltip"><span data-tooltip="This is a multi select question, select one or more option to proceed. " data-tooltip-position="left">
                                     <i class="fa fa-info-circle text-white"></i></span>
                                </div>
                                <?php } ?>
                            </div>
                            <h3 class="mb-0">
                                <?php //if(strlen($all_question['question_title'])>180){?>
                                <!--<span><?php //echo substr(stripslashes($all_question['question_title']),0,180)."...";?>-->
                                <!--    <div class="tooltip sub-web-tooltip">-->
                                <!--        <span data-tooltip="<?php echo stripslashes($all_question['question_title']); ?>" data-tooltip-position="right">-->
                                <!--            <i class="fa fa-info-circle text-white text-white"></i>-->
                                <!--        </span>-->
                                <!--    </div>-->
                                <!--</span>-->
                                <?php //}else {?>
                                <span><?php echo stripslashes($all_question['question_title']);?></span>
                                <?php //}?>
                            </h3>
                        </div>
                        <input type="hidden" name="qtypename_<?php echo $srno;?>" id="qtypename_<?php echo $srno;?>" value="<?php echo $qtypename?>">
                        <input type="hidden" name="qidthis_<?php echo $srno;?>" id="qidthis_<?php echo $srno;?>" value="<?php echo $all_question['question_id'];?>">
                        <input type="hidden" name="required_<?php echo $srno;?>" id="required_<?php echo $srno;?>" value="<?php echo $all_question['is_required'];?>">
                        <input type="hidden" name="chkselectedval_<?php echo $all_question['question_id'];?>" id="chkselectedval_<?php echo $all_question['question_id'];?>" value="">
                        <input type="hidden" name="chkselectedid_<?php echo $all_question['question_id'];?>" id="chkselectedid_<?php echo $all_question['question_id'];?>" value="">
                        <input type="hidden" name="skip_from_<?php echo $srno;?>" id="skip_from_<?php echo $srno;?>" value="<?php echo $all_question['skip_from_which_question'];?>">
                        <input type="hidden" name="skip_to_<?php echo $all_question['question_id'];?>" id="skip_to_<?php echo $all_question['question_id'];?>" value="<?php echo $all_question['skip_question_where_to'];?>">
                        <input type="hidden" name="chkflag_<?php echo $all_question['question_id'];?>" id="chkflag_<?php echo $all_question['question_id'];?>" value="0">

                        <!--------checkbox-type-option--------->
                        <div class="bg-shadow" id="sub_scrollbar_diff">   
                            <div class="row space-all">
                                <?php $counter = 0; foreach($all_subpoints as $all_subpoint){ $counter++; ?>
                                <div class="col-md-6">
                                    <div class="r-item checkbox-item">
                                        <input type="checkbox" id="chkbox_<?php echo $all_subpoint['question_subid'];?>" name="chkbox" value='<?php echo stripslashes(str_replace("'", '"', $all_subpoint['question_subtitle']));?>' onchange="SetAttempted(this,<?php echo $all_question['sequence'];?>,<?php echo $all_question['question_id'];?>,<?php echo $srno;?>)" <?php if($all_subpoint['question_subtitle']=="Other"){?> onclick="showchktextbox(<?php echo $all_question['question_id'];?>,<?php echo $all_subpoint['question_subid'];?>);setcheckboxquestans(<?php echo $srno;?>,<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,<?php echo $all_subpoint['question_subid'];?>,this.value);" <?php } else  {?> onclick="setcheckboxquestans(<?php echo $srno;?>,<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,<?php echo $all_subpoint['question_subid'];?>,this.value);" <?php }?>>
                                        <label class="label-icon" for="chkbox_<?php echo $all_subpoint['question_subid'];?>">
                                            <span class="num-holder" id="<?php echo $all_subpoint['question_subid'];?>"><?php echo $counter; ?>.</span>
                                            <span><?php echo stripslashes($all_subpoint['question_subtitle']);?></span>
                                        </label>
                                    </div>
                                </div>
                                <?php }?>
                                <input type="hidden" value="<?php echo count($all_subpoints);?>" id="chk_sub_count" name="chk_sub_count">
                                <div style="display:none" id="check_other_text_field_<?php echo $all_question['question_id'];?>">
                                    <div class="row">
                                        <div class="col-md-12 end-feedback-form">
                                			<div class="form-group">
                                               <input type="text" class="form-control" autocomplete = "off" placeholder="Please Enter Your Response" name="check_other_text_<?php echo $all_question['question_id'];?>" id='check_other_text_<?php echo $all_question['question_id'];?>' value="" onkeyup="activenextbutton(<?php echo $srno;?>,<?php echo $all_question['question_id'];?>)"/>
                                            </div>
                                             
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-6">
                            <div class="col-md-12 text-center sn-btn">
                                <a class="btn save-nxt-btn action-btn-disabled" id="btn_next_other_check_<?php echo $all_question['question_id'];?>" onclick="setnext(<?php echo $srno;?>,<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,'');">Save & Next
                                    <i class="fa fa-arrow-right ps-3"></i>
                                </a>
                                <?php if($all_question['is_required']=="Yes") { ?>
                                <a id="next" class="next btn_skip skip-txt d-none" title="Skip">Skip</a>
                                <?php }else{ ?>
                                <a id="next" class="next btn_skip skip-txt" title="Skip">Skip</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!--------End checkbox-type--------->
                    <?php }?>
                    
                    <?php if($all_question['quest_type_id']=="8") { $spqstsubids=""; $spqstsubvalids=""; ?>
                    <!-----------rank-order-type--------->
                    <div id="que_<?php echo $srno;?>" style="display:none;" class="que_scroll item" data-id='<?php echo $srno;?>'  isAttempted="0">
                        <div class="common-que-header">
                            <div class="align-txt">
                                <h5 class="mb-0">Question<span id="displayqno_<?php echo $srno;?>"></span> <sup id="star_<?php echo $srno;?>" class="text-danger" style="display:none;" >*</sup></h5>
                                <?php if($all_question['tooltip']!=""){
                                    $str_tooltip = ($all_question['tooltip']);
                                    $replace_tooltip = str_replace("'","","$str_tooltip");
                                ?>
                                <div class="tooltip"><span data-tooltip="<?php echo $replace_tooltip; ?>" data-tooltip-position="left">
                                     <i class="fa fa-info-circle text-white"></i></span>
                                </div>
                                <?php }?>
                            </div>
                            <h3 class="mb-0">
                                <?php //if(strlen($all_question['question_title'])>180){?>
                                <!--<span><?php //echo substr(stripslashes($all_question['question_title']),0,180)."...";?>-->
                                <!--    <div class="tooltip sub-web-tooltip">-->
                                <!--        <span data-tooltip="<?php echo stripslashes($all_question['question_title']); ?>" data-tooltip-position="right">-->
                                <!--            <i class="fa fa-info-circle text-white text-white"></i>-->
                                <!--        </span>-->
                                <!--    </div>-->
                                <!--</span>-->
                                <?php //}else {?>
                                <span><?php echo stripslashes($all_question['question_title']);?></span>
                                <?php //}?>
                            </h3>
                        </div>
                        <input type="hidden" name="qtypename_<?php echo $srno;?>" id="qtypename_<?php echo $srno;?>" value="<?php echo $qtypename?>">
                        <input type="hidden" name="qidthis_<?php echo $srno;?>" id="qidthis_<?php echo $srno;?>" value="<?php echo $all_question['question_id'];?>">
                        <input type="hidden" name="required_<?php echo $srno;?>" id="required_<?php echo $srno;?>" value="<?php echo $all_question['is_required'];?>">
                        <input type="hidden" name="orderselectedval_<?php echo $all_question['question_id'];?>" id="orderselectedval_<?php echo $all_question['question_id'];?>" value="">  
                        <input type="hidden" name="orderselectedid_<?php echo $all_question['question_id'];?>" id="orderselectedid_<?php echo $all_question['question_id'];?>" value="">  
                        <input type="hidden" name="rank_cnt_<?php echo $all_question['question_id'];?>" id="rank_cnt_<?php echo $all_question['question_id'];?>" value="<?php echo count($all_subpoints);?>">
                        <input type="hidden" name="skip_to_<?php echo $all_question['question_id'];?>" id="skip_to_<?php echo $all_question['question_id'];?>" value="<?php echo $all_question['skip_question_where_to'];?>">
                        
                        <!-----------rank-order-type-options--------->
                        <div class="bg-shadow" id="sub_scrollbar_diff">
                            <div class="row space-all">
                                <div class="col-md-12">
                                    <p class="note-txt"><strong>Note:</strong> Hold and drag to move up or down the rank.</p>
                                    <?php $ranksrno=1; 
                                                  foreach($all_subpoints as $all_subpoint)
                                                  { //$counter++;
                                                      $spqstsubids.=$all_subpoint['question_subid'].",";
                                                      $spqstsubvalids.=$all_subpoint['question_subid']."◘".$all_subpoint['rank_order_sequence']."♦";
                                                  }
                                            ?>
                                    <div class="row order-type">
                                       
                                        
                                            <div class="col-md-12" id="list_<?php echo $all_question['question_id'];?>">
                                                <?php $counter=0; foreach($all_subpoints as $all_subpoint_seq){ $counter++?>
                                                <label class="r-item checkbox-item label-icon-rank" for="order_<?php echo $all_subpoint_seq['question_subid'];?>" id="order_<?php echo $all_subpoint_seq['question_subid'];?>" name="order_<?php echo $all_subpoint_seq['question_subid'];?>" style="cursor:move;">
                                                    <div>
                                                        <span class="rank-order-num" id="num_<?php echo $all_subpoint_seq['question_subid'];?>"><?php echo $ranksrno;?></span>
                                                        <span> <?php echo stripslashes($all_subpoint_seq['question_subtitle']);?></span>
                                                    </div>
                                                    <span class="move-icon">:::</span>
                                                </label>
                                                <?php $ranksrno++;}?>
                                            </div>
                                            
                                            <input type="hidden" id="sub_qst_id_<?php echo $srno;?>" name="sub_qst_id_<?php echo $srno;?>" value="<?php echo $all_subpoint_seq['question_id'];?>">
                                            <input type="hidden" id="rank_order_count" name="rank_order_count" value="<?php echo count($all_subpoints); ?>">
                                            <input type="hidden" value="<?php echo $counter;?>" id="rank_sub_count" name="rank_sub_count">
                                            <input type="hidden" value="<?php echo trim($spqstsubvalids,"♦");?>" id="allsubval_<?php echo $all_question['question_id'];?>" name="allsubval_<?php echo $all_question['question_id'];?>">
                                            <input type="hidden" value="<?php echo trim($spqstsubids,",");?>" id="allsubid_<?php echo $all_question['question_id'];?>" name="allsubid_<?php echo $all_question['question_id'];?>">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-6">
                            <div class="col-md-12 text-center sn-btn">
                                <a class="btn save-nxt-btn" id="button_next_order_<?php echo $all_question['question_id'];?>" onclick="SetAttempted(this,<?php echo $all_question['sequence'];?>,<?php echo $all_question['question_id'];?>,<?php echo $srno;?>);setnext(<?php echo $srno;?>,<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,'');">Save & Next
                                       <i class="fa fa-arrow-right ps-3"></i>
                                </a>
                                <?php if($all_question['is_required']=="Yes") { ?>
                                <a id="next" class="next btn_skip skip-txt d-none" title="Skip">Skip</a>
                                <?php }else{ ?>
                                <a id="next" class="next btn_skip skip-txt" title="Skip">Skip</a>
                                <?php } ?>
                            </div>
                        </div>
                    
                    </div>
                    <!-----------End rank-order-type--------->
                    <?php }?>
                    
                    <?php if ($all_question['quest_type_id'] == "9") { $spqstsubids=""; ?>
                    <!--------m-rating-type--------->
                    <div id="que_<?php echo $srno;?>" style="display:none;" class="que_scroll item" data-id='<?php echo $srno;?>'  isAttempted="0">
                        <div class="common-que-header">
                            <div class="align-txt">
                                <h5 class="mb-0">Question<span id="displayqno_<?php echo $srno;?>"></span> <sup id="star_<?php echo $srno;?>" class="text-danger" style="display:none;" >*</sup></h5>
                                <?php if($all_question['tooltip']!=""){
                                    $str_tooltip = ($all_question['tooltip']);
                                    $replace_tooltip = str_replace("'","","$str_tooltip");
                                ?>
                                <div class="tooltip"><span data-tooltip="<?php echo $replace_tooltip; ?>" data-tooltip-position="left">
                                     <i class="fa fa-info-circle text-white"></i></span>
                                </div>
                                <?php }?>
                            </div>
                            <h3 class="mb-0">
                                <?php //if(strlen($all_question['question_title'])>180){?>
                                <!--<span><?php echo substr(stripslashes($all_question['question_title']),0,180)."...";?>-->
                                <!--    <div class="tooltip sub-web-tooltip">-->
                                <!--        <span data-tooltip="<?php echo stripslashes($all_question['question_title']); ?>" data-tooltip-position="right">-->
                                <!--            <i class="fa fa-info-circle text-white text-white"></i>-->
                                <!--        </span>-->
                                <!--    </div>-->
                                <!--</span>-->
                                <?php //}else {?>
                                <span><?php echo stripslashes($all_question['question_title']);?></span>
                                <?php //}?>
                            </h3>
                        </div>
                        <input type="hidden" name="mratingoptiontype_<?php echo $srno;?>" id="mratingoptiontype_<?php echo $srno;?>" value="<?php echo $all_question['mrating_option_type'];?>">
                        <input type="hidden" name="mratingrange_<?php echo $srno;?>" id="mratingrange_<?php echo $srno;?>" value="<?php echo $all_question['mrating_range'];?>?>">
                        <input type="hidden" name="qtypename_<?php echo $srno;?>" id="qtypename_<?php echo $srno;?>" value="<?php echo $qtypename?>">
                        <input type="hidden" name="qidthis_<?php echo $srno;?>" id="qidthis_<?php echo $srno;?>" value="<?php echo $all_question['question_id'];?>">
                        <input type="hidden" name="required_<?php echo $srno;?>" id="required_<?php echo $srno;?>" value="<?php echo $all_question['is_required'];?>">
                        <input type="hidden" name="mratingselectedval_<?php echo $all_question['question_id'];?>" id="mratingselectedval_<?php echo $all_question['question_id'];?>" value="">
                        <input type="hidden" name="mratingselectedsubid_<?php echo $all_question['question_id'];?>" id="mratingselectedsubid_<?php echo $all_question['question_id'];?>" value="">
                        <input type="hidden" name="mratingselectedsubidvalue_<?php echo $all_question['question_id'];?>" id="mratingselectedsubidvalue_<?php echo $all_question['question_id'];?>" value="">
                        <input type="hidden" name="skip_from_<?php echo $srno;?>" id="skip_from_<?php echo $srno;?>" value="<?php echo $all_question['skip_from_which_question'];?>">
                        <input type="hidden" name="skip_to_<?php echo $all_question['question_id'];?>" id="skip_to_<?php echo $all_question['question_id'];?>" value="<?php echo $all_question['skip_question_where_to'];?>">
                        <input type="hidden" name="mrating_cnt_<?php echo $all_question['question_id'];?>" id="mrating_cnt_<?php echo $all_question['question_id'];?>" value="<?php echo count($all_subpoints);?>">
                        <input type="hidden" name="flag_<?php echo $all_question['question_id'];?>" id="flag_<?php echo $all_question['question_id'];?>" value="">
                        <!--------m-rating-error-message--------->
                        <div class="row" style="padding-right:9.6rem;">
                            <div class="col-md-10"></div>
                            <div class="col-md-2">
                                 <div class="star fs-5" id="rating_error_message_<?php echo $all_question['question_id'];?>"></div>
                            </div>
                        </div>
                        <!--------End m-rating-error-message--------->
                        
                        <!--------m-rating-options--------->
                        <div class="bg-shadow" id="sub_scrollbar_diff">
                        <div class="row space-all">
                            <div class="col-md-12">
                                <div class="row m-rating-type">
                                    <?php $counter = 0; 
                                              foreach($all_subpoints as $all_subpoint){ $counter++; 
            				                  $spqstsubids.=$all_subpoint['question_subid'].",";
            				        ?>
                                    <div class="col-md-9">
                                        <div class="r-item checkbox-item">
                                            <label for="mrating<?php echo $all_subpoint['question_subid'];?>" class="label-icon">
                                                <span class="num-holder" id="<?php echo $all_subpoint['question_subid'];?>"><?php echo $counter; ?>.</span>
                                                <span><?php echo stripslashes($all_subpoint['question_subtitle']);?></span>
                                            </label>
                                        </div>
                                        
                                    </div>
                                    <?php $mratingtype=$all_question['mrating_option_type'];?>
                                    <div class="col-md-3">
                                        <?php if($mratingtype!="textbox"){
                                               $mrange = explode("_",$all_question['mrating_range']);
                                               $startPoint = $mrange[0];
                                               $endPoint = $mrange[2];
                                        ?>
                                        <select class="form-select" id="mrating_<?php echo $all_subpoint['question_subid'];?>" name="mrating_<?php echo $all_subpoint['question_subid'];?>" onchange="checksequence(<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,this.value,<?php echo $srno;?>);setmultipleratingquestans('<?php echo $all_subpoint['question_subid'];?>',<?php echo $srno;?>,<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,this.value);">
                                            <option value="">-Select rating-</option>
                                            <?php
                                                if($mratingtype=="scale")
                                                {
                                                    for($j=$startPoint; $j<=$endPoint; $j++)
                                                    {
                                                    echo "<option value=".$j.">".$j."</option>";
                                                    }
                                                }
                                                else if($mratingtype=="range")
                                                {
                                                    $rangestartpoint=$startPoint;
                                                    $rangeendpoint=$endPoint;
                                                    while($rangeendpoint<=100)
                                                    {
                                                        $rangeoptval=$rangestartpoint."-".$rangeendpoint;
                                                        $rangeopt=$rangestartpoint." - ".$rangeendpoint;
                                                        echo "<option value=".$rangeoptval.">".$rangeopt."</option>";
                                                        
                                                        $rangestartpoint=$rangeendpoint+1;
                                                        $rangeendpoint=$rangeendpoint+$endPoint;
                                                    }
                                                   
                                                }
                                                else if($mratingtype=="percentage")
                                                {
                                                    $percentstartpoint=0;
                                                    $percentendpoint=$endPoint;
                                                    while($percentendpoint<=100)
                                                    {
                                                        $percentopt=$percentstartpoint."% - ".$percentendpoint."%";
                                                        $percentoptval=$percentstartpoint."%-".$percentendpoint."%";
                                                        echo "<option value=".$percentoptval.">".$percentopt."</option>";
                                                        
                                                        $percentstartpoint=$percentendpoint+1;
                                                        $percentendpoint=$percentendpoint+$endPoint;
                                                    }
                                                }
                                            ?> 
                                        </select>
                                        <?php } else {?>
                                        <input type="text" autocomplete = "off" class="form-control" id="mrating_<?php echo $all_subpoint['question_subid'];?>" name="mrating_<?php echo $all_subpoint['question_subid'];?>" placeholder="Enter Number" onkeypress='return restrictAlphabets(event)' onkeyup="checksequence(<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,this.value,<?php echo $srno;?>);setmultipleratingquestans('<?php echo $all_subpoint['question_subid'];?>',<?php echo $srno;?>,<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,this.value);"/>
                                        <?php }?>
                                    </div>
                                    <?php }?>
                                </div>
                            
                                <input type="hidden" value="<?php echo count($all_subpoints);?>" id="mrating_sub_count" name="mrating_sub_count">
                                <input type="hidden" value="<?php echo trim($spqstsubids,",");?>" id="allsubid_<?php echo $all_question['question_id'];?>" name="allsubid_<?php echo $all_question['question_id'];?>">
  
                                </div>
                            </div>
                        </div>
                        <div class="row pt-6">
                            <div class="col-md-12 text-center sn-btn">
                                <a class="btn save-nxt-btn action-btn-disabled" id="btn_next_other_mrating_<?php echo $all_question['question_id'];?>" onclick="SetAttempted(this,<?php echo $all_question['sequence'];?>,<?php echo $all_question['question_id'];?>,<?php echo $srno;?>);checksequence(<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,'',<?php echo $srno;?>);setnext(<?php echo $srno;?>,<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,'');">Save & Next
                                       <i class="fa fa-arrow-right ps-3"></i>
                                </a>
                               <?php if($all_question['is_required']=="Yes") { ?>
                                <a id="next" class="next btn_skip skip-txt d-none" title="Skip">Skip</a>
                                <?php }else{ ?>
                                <a id="next" class="next btn_skip skip-txt" title="Skip">Skip</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                     <!--------end-m-rating-type--------->
                    <?php }?>
                    
                    <?php if($all_question['quest_type_id']=="10") { ?> 
                    <!----------matrix-type--------->
                    <div id="que_<?php echo $srno;?>" style="display:none;" class="que_scroll item" data-id='<?php echo $srno;?>'  isAttempted="0">
                        <div class="common-que-header">
                            <div class="align-txt">
                                <h5 class="mb-0">Question<span id="displayqno_<?php echo $srno;?>"></span> <sup id="star_<?php echo $srno;?>" class="text-danger" style="display:none;" >*</sup></h5>
                                <?php if($all_question['tooltip']!=""){
                                    $str_tooltip = ($all_question['tooltip']);
                                    $replace_tooltip = str_replace("'","","$str_tooltip");
                                ?>
                                <div class="tooltip"><span data-tooltip="<?php echo $replace_tooltip; ?>" data-tooltip-position="left">
                                     <i class="fa fa-info-circle text-white"></i></span>
                                </div>
                                <?php }?>
                            </div>
                            <h3 class="mb-0">
                                <?php //if(strlen($all_question['question_title'])>180){?>
                                <!--<span><?php echo substr(stripslashes($all_question['question_title']),0,180)."...";?>-->
                                <!--    <div class="tooltip sub-web-tooltip">-->
                                <!--        <span data-tooltip="<?php echo stripslashes($all_question['question_title']); ?>" data-tooltip-position="right">-->
                                <!--            <i class="fa fa-info-circle text-white text-white"></i>-->
                                <!--        </span>-->
                                <!--    </div>-->
                                <!--</span>-->
                                <?php //}else {?>
                                <span><?php echo stripslashes($all_question['question_title']);?></span>
                                <?php //}?>
                            </h3>
                        </div>
                        <input type="hidden" name="qtypename_<?php echo $srno;?>" id="qtypename_<?php echo $srno;?>" value="<?php echo $qtypename?>">
                        <input type="hidden" name="qidthis_<?php echo $srno;?>" id="qidthis_<?php echo $srno;?>" value="<?php echo $all_question['question_id'];?>">
                        <input type="hidden" name="required_<?php echo $srno;?>" id="required_<?php echo $srno;?>" value="<?php echo $all_question['is_required'];?>">
                        <input type="hidden" name="matrixselectedval_<?php echo $all_question['question_id'];?>" id="matrixselectedval_<?php echo $all_question['question_id'];?>" value="">
                        <input type="hidden" name="matrixselectedsubid_<?php echo $all_question['question_id'];?>" id="matrixselectedsubid_<?php echo $all_question['question_id'];?>" value="">
                        <input type="hidden" name="skip_from_<?php echo $srno;?>" id="skip_from_<?php echo $srno;?>" value="<?php echo $all_question['skip_from_which_question'];?>">
                        <input type="hidden" name="skip_to_<?php echo $all_question['question_id'];?>" id="skip_to_<?php echo $all_question['question_id'];?>" value="<?php echo $all_question['skip_question_where_to'];?>">
                        <input type="hidden" name="matrix_cnt_<?php echo $all_question['question_id'];?>" id="matrix_cnt_<?php echo $all_question['question_id'];?>" value="<?php echo count($all_subpoints);?>">
                        <input type="hidden" name="matrixselectedradioid_<?php echo $all_question['question_id'];?>" id="matrixselectedradioid_<?php echo $all_question['question_id'];?>" value="">
                        <?php 
                              $fields_subpoints_count12 = "*";
                              $condition_subpoints_count12 = "`tbl_questionSub`.`question_id` ='".$all_question['question_id']."' and `tbl_questionSub`.`matrix_type` ='row'";
                              $all_subpoints_matrixs_rows=$obj_survey->getSubQuestionPoints($fields_subpoints_count12, $condition_subpoints_count12, '', '', 0);
                        ?>
                        <!----------matrix-type-option--------->
                        <div class="bg-shadow" id="sub_scrollbar_diff">
                            <div class="row space-all">
                                <div class="col-md-12">
                                <div class="matrix-que">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                 <?php  
                                                        $matcounter="1";
                                                        $arr=array();
                                                        $fields_subpoints_count = "*";
                                                        $condition_subpoints_count = "`tbl_questionSub`.`question_id` =".$all_question['question_id'];
                                                        $all_subpoints_matrixs=$obj_survey->getSubQuestionPoints($fields_subpoints_count, $condition_subpoints_count, '', '', 0); 
                                                        ?>
                                                <tr>
                                                    <td scope="col"></td>
                                                    <?php
                                                       foreach($all_subpoints_matrixs as $all_subpoints_matrix){
                                                         if($all_subpoints_matrix['matrix_type']=="column"){
                                                             //$count_coulmn++;
                                                             $col_id=$all_subpoints_matrix['question_subid'];
                                                             array_push($arr,$col_id);
                                                    ?>
                                                    <td scope="col"><?php echo $all_subpoints_matrix['question_subtitle']; ?></td>
                                                    <?php } }?>
                                                </tr>
                                                <?php foreach($all_subpoints_matrixs as $all_subpoints_matrix){ if($all_subpoints_matrix['matrix_type']=="row"){ $matcounter++;?>
                                                <tr class="table-checkbox-type table-radio-type">
                                                    <td scope="col"><?php echo $all_subpoints_matrix['question_subtitle'];  ?></td>
                                                    <?php for($j=0;$j<count($arr);$j++) { ?>
                                        			    <td><input type="<?php echo $all_question['matrix_input_type'];?>" name="matrixchk_<?php echo $all_subpoints_matrix['question_subid']; ?>" id="matrixchk_<?php echo $all_subpoints_matrix['question_subid'].$arr[$j]; ?>" value="<?php echo $all_subpoints_matrix['question_subid']."¶".$arr[$j]; ?>" onclick="setmatrixquestans(<?php echo $srno;?>,<?php echo $all_question['question_id'];?>,<?php echo $all_subpoints_matrix['question_subid'].$arr[$j]; ?>,this.value,'<?php echo $all_question['matrix_input_type'];?>',<?php echo $all_subpoints_matrix['question_subid']?>)"></td>
                                        			<?php } } ?>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <input type="hidden" name="matrix_count" id="matrix_count" value="<?php echo $matcounter;?>">
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="row pt-6">
                            <div class="col-md-12 text-center sn-btn">
                                <a class="btn save-nxt-btn action-btn-disabled" id="btn_next_other_matrix_<?php echo $all_question['question_id'];?>" onclick="SetAttempted(this,<?php echo $all_question['sequence'];?>,<?php echo $all_question['question_id'];?>,<?php echo $srno;?>);setnext(<?php echo $srno;?>,'',<?php echo $all_question['question_id'];?>,'');">Save & Next
                                       <i class="fa fa-arrow-right ps-3"></i>
                                </a>
                                <?php if($all_question['is_required']=="Yes") { ?>
                                <a id="next" class="next btn_skip skip-txt d-none" title="Skip">Skip</a>
                                <?php }else{ ?>
                                <a id="next" class="next btn_skip skip-txt" title="Skip">Skip</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!----------end-matrix-type--------->
                    <?php }?>
                    
                    
                    <?php $srno++;}?><!-------Main Form section Ending------------>
                    
                    <!-------Last Form section------------>
                    <div class="item lform" id="que_<?php echo $srno;?>" data-id="<?php echo $srno;?>" style="display:none;">
                        <?php if(isset($_GET['name']) && isset($_GET['email']) || isset($_GET['uid'])){?>
                        <!-------thank-you-form----------->
                        <div class="bg-shadow space-all text-center">
                            <input type="hidden" name="fname" id="fname" value="<?php if(isset($_GET['name'])){  echo $_GET['name']; }?>">
                            <input type="hidden" name="url_company" id="url_company" value="<?php if(isset($_GET['company'])){ echo $_GET['company']; }?>">
                            <input type="hidden" name="url_designation" id="url_designation" value="<?php if(isset($_GET['url_designation'])){ echo $_GET['url_designation'];} ?>">
                             <input type="hidden" name="url_source" id="url_source" value="<?php if(isset($_GET['source'])){ echo $_GET['source']; } ?>">
                            <input type="hidden" name="email" id="email" value="<?php if(isset($_GET['email'])){ echo $_GET['email']; }?>">
                            <input type="hidden" name="uid" id="uid" value="<?php if(isset($_GET['uid'])){ echo $_GET['uid']; } ?>">
                            <h4 class="thank-you-ttl mb-0">Thank you for your valuable response.</h4>
                            <div class="s-icon pb-4">
                                <span>&#x1F604;</span>
                                <span>&#x1F604;</span>
                                <span>&#x1F604;</span>
                            </div>
                            <button type="submit" class="btn submit-btn campsubbutton" id="lastsubmit">
                                <div id="" class="slide"></div>
                                Submit <i class="fa fa-arrow-right"></i>
                            </button>
                            <span class="spinner-border spinner-border-md mt-4" role="status" aria-hidden="true" id="span_loader" style="display:none"></span>
                        </div>
                        <!-------End thank-you-form----------->
                        <?php } else {?>
                        <?php if($_SESSION['response_user_id']==""){?>
                        <!----------feedback-form---------->
                        <div class="end-feedback-form bg-shadow space-all">
                            <h4 class="thank-you-ttl mb-0">Thank you for your response, Please Submit your Survey.</h4>
                            <input type="hidden" name="url_source" id="url_source" value="<?php if(isset($_GET['source'])){ echo $_GET['source']; } ?>">
                             <input type="hidden" name="uid" id="uid" value="">
                            <?php if(!isset($_GET['name']) && empty($_GET['name'])){?>
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" class="form-control" autocomplete="off" placeholder="Enter Full Name" name="fname" id='fname' value="<?php if(isset($_GET['name'])){ echo $_GET['name']; } ?>">
                                <div class="star" id="fname_error_message"></div>
                            </div>
                            <?php } else {?>
                            <input type="hidden" class="form-control" autocomplete="off" placeholder="Enter Full Name" name="fname" id='fname' value="<?php if(isset($_GET['name'])){ echo $_GET['name']; } ?>">
                            <?php }?>
                            <?php if(!isset($_GET['email']) && empty($_GET['email'])){?>
                            <div class="form-group">
                                <label>Email Id</label>
                                <input type="email" class="form-control" autocomplete="off" placeholder="Enter Email" name="email" id='email' value="<?php if(isset($_GET['email'])){ echo $_GET['email']; } ?>">
                                <div class="star" id="email_error_message"></div>
                            </div>
                            <?php } else {?>
                                <input type="hidden" class="form-control" autocomplete="off" placeholder="Enter Email" name="email" id='email' value="<?php if(isset($_GET['email'])){ echo $_GET['email']; } ?>">
                            <?php }?>
                            
                            <?php if($url=="https://www.avirasurveys.com/survey-view/d2706c17-422a-4521-9d02-a642e01a83ac/survey-to-analyze-the-needs-and-requirements-of-an-organization-looking-for-cloud-communication-platform." || $url=="https://www.avirasurveys.com/survey-view/e0c0fb50-fa99-4858-9f07-397c9d35b21b/sme's-perspective--to-understand-the-usage-trend-of-services-like-internet,-data-,voice-,cloud,-and-cybersecurity." || $url=="https://www.avirasurveys.com/survey-view/79f4d606-c1de-4441-aab0-979270360e1c/a-survey-on-criteria's-to-consider-while-vendor-selection-for-cloud-communication-platform."){?>
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="email" class="form-control" autocomplete="off" placeholder="Enter Phone Number" name="phone" id='phone' value="">
                                <div class="star" id="phone_error_message"></div>
                            </div>
                            <?php }?>
                            
                            <button type="submit" class="btn submit-btn" id="lastsubmit">
                                <div id="" class="slide"></div>
                                Submit <i class="fa fa-arrow-right"></i>
                            </button>
                            <span class="spinner-border spinner-border-md mt-4" role="status" aria-hidden="true" id="span_loader" style="display:none"></span>
                        </div>
                        <!----------End feedback-form---------->
                        <?php } else {?>
                        <!-------thank-you-form----------->
                        <div class="bg-shadow space-all text-center">
                            <h4 class="thank-you-ttl mb-0">Thank you for your response, Please Submit your Survey.</h4>
                            <div class="s-icon pb-4">
                                <span>&#x1F604;</span>
                                <span>&#x1F604;</span>
                                <span>&#x1F604;</span>
                            </div>
                            <input type="hidden" name="url_source" id="url_source" value="<?php if(isset($_GET['source'])) { echo $_GET['source']; } ?>">
                            <input type="hidden" name="uid" id="uid" value="">
                            <button type="submit" class="btn submit-btn" id="lastsubmit">
                                <div id="" class="slide"></div>
                                Submit <i class="fa fa-arrow-right"></i>
                            </button>
                            <span class="spinner-border spinner-border-md mt-4" role="status" aria-hidden="true" id="span_loader" style="display:none"></span>
                        </div>
                        <!-------End thank-you-form----------->
                        <?php } }?>
                    </div>
                    <!-------Last Form section end------------>
                    
                    <input type="hidden" name="totalquestion" id="totalquestion" value="<?php echo count($all_questions);?>">
                    
                </div>
            </div>
        </div>
        <!--End Question with thankyou and survey submit section-->
    </div>
    <!----new-footer-design-start----->
        <div class="footer-align">
            <div class="left-float">
                <svg class="progress-circle" width="80px" height="90px" xmlns="http://www.w3.org/2000/svg">
            	    <circle class="progress-circle-back" cx="35" cy="35" r="25"></circle>
                    <circle class="progress-circle-prog" cx="35" cy="35" r="25" style="stroke-dasharray: 0, 999;"></circle>
                 </svg>
	            <span class="progress-text" data-progress="0">0%</span> 
            </div>
            <div class="arrow-status">
                <div>
                    <img class="img-fluid d-block survey-logo" src="<?php echo SITEPATHFRONT;?>images/logo-light.png">
                </div>
                <a id="prev" class="back btn_slider btn_slider_dir rounded-circle disabled" title="Previous">
                    <i class="fa fa-angle-up"></i>
                </a>
                <a id="next" class="next btn_slider btn_slider_dir rounded-circle" title="Next">
                    <i class="fa fa-angle-down"></i>
                </a>
            </div>
        </div>
    <!----new-footer-design-end------->
    
    <div class="left-bottom-pattern">
        <img src="<?php echo SITEPATHFRONT;?>images/pattern-right.png" alt="right-side-pattern" class="img-fluid">
    </div>
    
    <!--<div class="right-side-pattern">-->
    <!--    <img src="<?php echo SITEPATHFRONT;?>images/right-pattern-all.png" alt="right-side-pattern" class="img-fluid">-->
    <!--</div>-->
    
    <!--------footer-new section------------>
    <!--<div class="container-fluid">-->
    <!--    <div class="row">-->
    <!--        <div class="col-md-12">-->
    <!--            <div class="row footer-bottom-fixed pt-3" id="footerdisplay">-->
    <!--                <div class="col-md-12">-->
    <!--                    <div class="row align-items-center justify-content-center" id="btn_slider" style="display:none;">-->
    <!--                        <div class="col-lg-7 col-md-5">-->
    <!--                            <?php if(isset($footer_tagline) && !empty($footer_tagline)){ ?>-->
    <!--                            <p class="para mb-0 off-txt" title="<?php echo "Complete the survey to download $4000 worth of ".$footer_tagline; ?>">  Complete the survey to download $4000 worth of <?php if(strlen($footer_tagline)>=95){echo substr($footer_tagline,0,95)."..."; } else { echo $footer_tagline;} ?> </p>-->
    <!--                            <div class="tooltip mob-tooltip"><span data-tooltip="<?php echo "Complete the survey to download $4000 worth of ".$footer_tagline; ?>"-->
    <!--                            data-tooltip-position="right">-->
    <!--                                 <i class="fa fa-info-circle text-white text-white"></i></span>-->
    <!--                            </div>-->
    <!--                            <?php }?>-->
    <!--                        </div>-->
    <!--                        <div class="col-lg-5 col-md-7 d-flex flex-column right-div">-->
    <!--                            <div class="row d-flex justify-content-center">-->
    <!--                                <div class="col-md-6 d-flex justify-content-end">-->
    <!--                                    <svg class="progress-circle" width="80px" height="90px" xmlns="http://www.w3.org/2000/svg">-->
    <!--                                	    <circle class="progress-circle-back" cx="35" cy="35" r="25"></circle>-->
    <!--                                        <circle class="progress-circle-prog" cx="35" cy="35" r="25" style="stroke-dasharray: 0, 999;"></circle>-->
    <!--                                     </svg>-->
    <!--                    	            <div class="progress-text" data-progress="0">0%</div>-->
    <!--                                </div>-->
    <!--                                <div class="col-md-6 arrow-status">-->
    <!--                                    <div>-->
    <!--                                        <img class="img-fluid d-block survey-logo" src="<?php echo SITEPATHFRONT;?>images/logo-light.png">-->
    <!--                                    </div>-->
    <!--                                    <a id="prev" class="back btn_slider btn_slider_dir rounded-circle disabled" title="Previous">-->
    <!--                                        <i class="fa fa-angle-up"></i>-->
    <!--                                    </a>-->
    <!--                                    <a id="next" class="next btn_slider btn_slider_dir rounded-circle" title="Next">-->
    <!--                                        <i class="fa fa-angle-down"></i>-->
    <!--                                    </a>-->
                                        
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
    <!------------End footer-new------------>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  
  </body>
</html>
<!--Modal Popup Front Form-->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered feedback-modal" role="document">
    <div class="modal-content" style="border-radius:0.9rem;">
        <div class="modal-header">
            <h5 class="modal-title">Fill Your Details</h5>
        </div>
        <div class="modal-body">
          
          <form id="request-form" class="create-survey-module" action="<?php echo SITEPATHFRONT; ?>add-user-action.php" method="post">
              <input type="hidden" name="userid" value="<?php echo $user_id;?>">
              <input type="hidden" name="surveyid" value="<?php echo $surveyid;?>">
                <div class="col-md-12 item wrapper1 end-feedback-form">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text"  autocomplete = "off" class="form-control" placeholder="Enter Full Name" name="fname" id='fname' value="" />
                        <div class="star" id="fname_error_message"></div>
                    </div>
                    
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" autocomplete = "off" class="form-control" placeholder="Enter Email" name="email" id='email' value="" />
                        <div class="star" id="email_error_message"></div>
                    </div>
                    
                    <?php if($url=="https://www.avirasurveys.com/survey-view/d2706c17-422a-4521-9d02-a642e01a83ac/survey-to-analyze-the-needs-and-requirements-of-an-organization-looking-for-cloud-communication-platform." || $url=="https://www.avirasurveys.com/survey-view/e0c0fb50-fa99-4858-9f07-397c9d35b21b/sme's-perspective--to-understand-the-usage-trend-of-services-like-internet,-data-,voice-,cloud,-and-cybersecurity." || $url=="https://www.avirasurveys.com/survey-view/79f4d606-c1de-4441-aab0-979270360e1c/a-survey-on-criteria's-to-consider-while-vendor-selection-for-cloud-communication-platform."){?>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" autocomplete = "off" class="form-control" placeholder="Enter Phone Number" name="phone" id='phone' value="" />
                        <div class="star" id="phone_error_message"></div>
                    </div>
                    <?php }?>
                    <div class="col-md-12 text-center">
                        <div class="btn submit-btn" id="firstsubmit">
                            <div class="slide1"></div>
                             <button type="submit" class="bg-transparent border-0 text-white fs-5" id="">Submit</button>
                        </div>
                    </div>
                   
                </div>
            </form>
         
          </form>
        </div>
      
    </div>
  </div>
</div>

<!--Modal Popup Survey Feedback-->
<div class="modal fade" id="closefeedback" tabindex="-1" role="dialog" aria-labelledby="closefeedbackTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered feedback-modal" role="document">
    <div class="modal-content" style="border-radius:0.9rem;">
     <div class="modal-header">
        <h5 class="modal-title">Survey Feedback</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <!--<h5 class="thanks-head feedbackh5 fs-2 p-3" id="exampleModalLongTitle"></h5>-->
          <form class="create-survey-module" action="<?php echo SITEPATHFRONT; ?>survey-close-feedback.php" method="post">
              <input type="hidden" name="userid" value="<?php echo $user_id;?>">
              <input type="hidden" name="surveyid" value="<?php echo $surveyid;?>">
              <input type="hidden" name="firstform" value="<?php echo $_SESSION['response_user_id'];?>">
              <input type="hidden" name="campaignform" value="<?php echo $_SESSION['campaign_user_id'];?>">
              <div class="col-md-12 item wrapper1">
                
                  <?php $i=1;foreach($feedbacks as $feedback){?>
                  <p>
                    <input type="radio" id="optionfed-<?php echo $i;?>" name="fedradio" value="<?php echo $feedback['feed_id'];?>" class="" <?php if($feedback['feed_id']==1){?> checked <?php }?>>
                    <label class="optionfed optionfed-<?php echo $feedback['feed_id'];?>" for="optionfed-<?php echo $i;?>">
                        <span><?php echo $feedback['feed_data'];?></span>
                    </label>
                  </p>
                  <?php $i++;}?>
                <div class="button sub-btn mt-0 text-center" id="closefeedbacksubmit" style="width:100%;">
                    <button type="submit" class="cta-btn btn m-0" id="">Submit</button>
                </div>
            </form>
        </div> 
          </form>
      </div>
      
    </div>
  </div>
</div>
<style>
.feedback-modal .modal-header{
    background: #00c2ff;
    border-radius: 0.9rem 0.9rem 0 0;
    justify-content:center;
}
.feedback-modal .btn-close{
    position: absolute;
    right:1rem;
    top: 0.9rem;
}
.feedback-modal .modal-header .modal-title{
    font-size:1.5rem;
    color:#fff;
}

.feedback-modal [type="radio"]:checked,
.feedback-modal [type="radio"]:not(:checked) {
    position: absolute;
    left: -9999px;
}
.feedback-modal [type="radio"]:checked + label,
.feedback-modal [type="radio"]:not(:checked) + label
{
    position: relative;
    padding-left: 28px;
    cursor: pointer;
    line-height: 20px;
    display: inline-block;
    color: #666;
}
.feedback-modal [type="radio"]:checked + label:before,
.feedback-modal [type="radio"]:not(:checked) + label:before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    width: 18px;
    height: 18px;
    border: 1px solid #ddd;
    border-radius: 100%;
    background: #fff;
}
.feedback-modal [type="radio"]:checked + label:after,
.feedback-modal [type="radio"]:not(:checked) + label:after {
    content: '';
    width: 10px;
    height: 10px;
    background: #01a4ff;
    position: absolute;
    top: 4px;
    left: 4px;
    border-radius: 100%;
    -webkit-transition: all 0.2s ease;
    transition: all 0.2s ease;
}
.feedback-modal [type="radio"]:not(:checked) + label:after {
    opacity: 0;
    -webkit-transform: scale(0);
    transform: scale(0);
}
.feedback-modal [type="radio"]:checked + label:after {
    opacity: 1;
    -webkit-transform: scale(1);
    transform: scale(1);
}
.optionfed span{
    font-size:1.4rem;
}
.modal-dialog.feedback-modal{
    max-width:550px;
}
.modal-content{
    border:none;
}
</style>

<!--Modal Popup Survey Completion Form On Cross button-->
<div class="modal fade" id="closemessageoncross" tabindex="-1" role="dialog" aria-labelledby="closemessageoncrossTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered feedback-modal" role="document">
    <div class="modal-content" style="border-radius:0.9rem;">
     <div class="modal-header">
        <h5 class="modal-title">MESSAGE</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <!--<h5 class="thanks-head feedbackh5 fs-2 p-3" id="exampleModalLongTitle"></h5>-->
         
              <div class="col-md-12 item wrapper1" style="font-size:18px;">
                
                 <div id="closetext"></div>
                    <div class="button sub-btn mt-0 text-center" id="intermediatecont" style="width:100%;padding-top:20px;display:none;">
                        <button type="button" class="cta-btn btn m-0" data-bs-dismiss="modal" aria-label="Close">Continue</button>
                        <!--<button type="button" class="cta-btn btn m-0" id="closesurveyoncrossfeedback">Close</button>-->
                    </div>
                    <div class="button sub-btn mt-0 text-center" id="lastcont" style="width:100%;padding-top:20px;display:none;">
                        <button type="button" class="cta-btn btn m-0">Submit</button>
                         <span class="spinner-border spinner-border-md" role="status" aria-hidden="true" id="span_loader1" style="display:none"></span>
                        <!--<button type="button" class="cta-btn btn m-0" id="closesurveyoncrossfeedback">Close</button>-->
                    </div>
            
        </div> 
         
      </div>
      
    </div>
  </div>
</div>

<script src="<?php echo SITEPATHFRONT; ?>js/jquery.validate.js"></script>
<script src="<?php echo SITEPATHFRONT; ?>js/user-form.js"></script>

<style>
    .common-footer-main{display:none !important;}
    .star{color:red;font-size:15px;}
    .error{color:red;font-size:15px;}
</style>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
        var totalquest=$("#totalquestion").val();
        var count_no=totalquest;
           $(".btn_skip").click(function(){
               count_no--;
               // var remaining_attempt = (total_ques-attemptedCount)-count;
               // alert(count_no);
           //alert(remaining_attempt);
           
           $("#total_que_to_go").text(count_no);
           //exit;
           });
</script>

<script>

var nextids=[];
var orderids=[];
   $(document).ready(function(){
       
           $("#closesurveyoncrossfeedback").click(function(){
               window.location = '<?php echo SITEPATHFRONT;?>survey-list';
           })
           /****************************/
           <?php //if(isset($_GET['name']) && isset($_GET['email'])){ ?>
                  var currqid="1";
                $('#sqtitle').show();
                $('#temp_section').slideUp(400);
                $('#que_'+currqid).slideDown(400);
                $("#btn_slider").slideDown(400);
                $("#displayqno_"+currqid).text(currqid);
                $("#setqno").val(currqid);
                //$("#qsequence").val(currqid);
                nextids.push(currqid);
               if(currqid == 1){
                 //$('.back').hide();
                 $(".back").addClass("disabled");
               }
                
                var required = $("#required_"+currqid).val();
                
                if(required=="Yes")
                {
                    $(".next").addClass("disabled");
                    $("#star_"+currqid).show();
                }
                
                
                var qtypename=$("#qtypename_"+currqid).val();
                if(qtypename=="Order")
                {
                  setorderval(currqid);
                }
            <?php //}?>
           /*************************/
           <?php //if($submit_form_position=="First" && $_SESSION['response_user_id']==""){?> 
            // $("#btn_get_started").hide();
            
            // $("#exampleModalCenter").modal({
            //             backdrop: 'static',
            //             keyboard: false, 
            //             show: false
            //     }); 
            // $("#exampleModalCenter").modal("show");
            <?php //}?>
            //$('.wrapper').addClass("toggled"); 
            <?php //if($submit_form_position=="First" && $_SESSION['response_user_id']!=""){?> 
            $("#btn_get_started").show();
            <?php //}?>
            
            
            //Instead of show() you can use slideDown(200); for hide you can use slideUp(200);
        
            $("#btn_get_started").click(function(){
                var currqid="1";
                $('#temp_section').slideUp(400);
                $('#que_'+currqid).slideDown(400);
                $("#btn_slider").slideDown(400);
                $("#displayqno_"+currqid).text(currqid);
                $("#setqno").val(currqid);
                //$("#qsequence").val(currqid);
                nextids.push(currqid);
               if(currqid == 1){
                 //$('.back').hide();
                 $(".back").addClass("disabled");
               }
                
                var required = $("#required_"+currqid).val();
                
                if(required=="Yes")
                {
                    $(".next").addClass("disabled");
                    $("#star_"+currqid).show();
                }
                
                
                var qtypename=$("#qtypename_"+currqid).val();
                if(qtypename=="Order")
                {
                  setorderval(currqid);
                }
                
                //setup(); 
                
                <?php //if($submit_form_position=="Last"){?> 
                //     $.ajax({
            				// url: "<?php //echo SITEPATHFRONT;?>last-form-half-action.php",
            				// type: "POST",
            				// data: {surveyid:"<?php //echo $surveyid?>",userid:"<?php //echo $user_id;?>"},
            				// cache: false,
            				// success: function(dataResult123){
            				//     //responseuserid=dataResult123;
            				//     //alert(responseuserid);
            				//     $("#sessipaddrlastform").val(dataResult123);
            				//     //var sessipaddrlastform = $("#sessipaddrlastform").val();
            				//  }
                //     	});
                <?php //}?>
            });
            
            
            $("#fname_error_message").hide();
            $("#email_error_message").hide();
            $("#phone_error_message").hide();
            
            var fname_error_message = false;
            var email_error_message = false;
            var phone_error_message = false;
            
            $("#fname").keypress(function(){
               check_fname(); 
            });
            
            $("#fname").focusout(function(){
               check_fname(); 
            });
            
            $("#email").keypress(function(){
               check_email(); 
            });
            
            $("#email").focusout(function(){
               check_email(); 
            });
            
            $("#phone").keypress(function(){
               check_phone(); 
            });
            
            $("#phone").focusout(function(){
               check_phone(); 
            });
            
            function check_fname(){
                var fname= $("#fname").val().trim();
                
                if(fname == '')
                {
                    $("#fname_error_message").show();
                    $("#fname_error_message").html("Please Enter Fullname");
                    $("#fname").css("border","2px solid #F90A0A");
                    fname_error_message = true;
                }
                else
                {
                    $("#fname_error_message").hide();
                    $("#fname").css("border","2px solid #34F458");
                    fname_error_message = false;
                } 
                
            }
            
            function check_email(){
                var pattern = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                var email= $("#email").val();
                if(email == '')
                {
                    $("#email_error_message").show();
                    $("#email_error_message").html("Please Enter Email");
                    $("#email").css("border","2px solid #F90A0A");
                    email_error_message = true;
                }
                else
                {
                    if(pattern.test(email))
                    {
                        $("#email_error_message").hide();
                        $("#email").css("border","2px solid #34F458");
                        email_error_message = false;
                        
                    } else {
                        $("#email_error_message").show();
                        $("#email_error_message").html("Invalid Email");
                        $("#email").css("border","2px solid #F90A0A");
                        email_error_message = true;
                    }
                }    
                
            }
            
             function check_phone(){
                //var phonepattern = /^\+?([0-9]{1,2})\)?[-. ]?([0-9]{4,5})[-. ]?([0-9]{4,5})$/;
                var phonepattern = /^[0-9-+() ]*$/;
                var phone= $("#phone").val();
                if(phone == '')
                {
                    $("#phone_error_message").show();
                    $("#phone_error_message").html("Please Enter Phone Number");
                    $("#phone").css("border","2px solid #F90A0A");
                    phone_error_message = true;
                }
                else
                {
                    if(phonepattern.test(phone))
                    {
                        $("#phone_error_message").hide();
                        $("#phone").css("border","2px solid #34F458");
                        phone_error_message = false;
                        
                    } else {
                        $("#phone_error_message").show();
                        $("#phone_error_message").html("Invalid Phone Number");
                        $("#phone").css("border","2px solid #F90A0A");
                        phone_error_message = true;
                    }
                }    
                
            }
            
            
            $("input[name=fname]").keypress(function(event){
                    var keycode = (event.keyCode ? event.keyCode : event.which);
                    var pattern = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                    if(keycode == '13')
                    {
                        check_fname();
                        check_email();
                        <?php if($url=="https://www.avirasurveys.com/survey-view/d2706c17-422a-4521-9d02-a642e01a83ac/survey-to-analyze-the-needs-and-requirements-of-an-organization-looking-for-cloud-communication-platform." || $url=="https://www.avirasurveys.com/survey-view/e0c0fb50-fa99-4858-9f07-397c9d35b21b/sme's-perspective--to-understand-the-usage-trend-of-services-like-internet,-data-,voice-,cloud,-and-cybersecurity." || $url=="https://www.avirasurveys.com/survey-view/79f4d606-c1de-4441-aab0-979270360e1c/a-survey-on-criteria's-to-consider-while-vendor-selection-for-cloud-communication-platform."){?>
                        check_phone();
                        var phoneno = $("#phone").val();
                        <?php } else {?>
                         var phoneno = "";
                        <?php }?>
                        var allquestionids =$("#all_question_id").val();
                        var allanswers = $("#all_answers").val();
                        var fname = $("#fname").val().trim();
                        var email = $("#email").val();
                        var url_source = $("#url_source").val();
                        var uid = $("#uid").val();
                        var sessipaddrlastform = $("#sessipaddrlastform").val();
                        if(fname_error_message === false && email_error_message === false && phone_error_message === false)
                        {
                            $.ajax({
                				url: "<?php echo SITEPATHFRONT; ?>survey-view-action.php",
                				type: "POST",
                				data: {uid:uid,url_source:url_source,phone:phoneno,allquestionids:allquestionids,allanswers:allanswers,fname:fname,email:email,surveyid:"<?php echo $surveyid?>",userid:<?php echo $user_id?>,sessipaddrlastform:sessipaddrlastform},
                				cache: false,
                				beforeSend: function(){
                                    // Show image container
                                    $('#span_loader').show();
                                    $("#lastsubmit").css({"pointer-events":"none","opacity":"0.4"});
                                },
                				success: function(dataResult){
                				    
                				    //$('.que_section').hide();
                                   // $("#footerdisplay").hide();
            		               //$('.end').slideDown(200);
            		               //$("#thankyoustopunload").val("Full");
            		               window.location = '<?php echo SITEPATHFRONT;?>thank-you-survey/<?php echo $surveyid?>/'+email+'/'+fname+'';
                				}
                			});
                        }
                    }
            });
            
             $("input[name=email]").keypress(function(event){
                    var keycode = (event.keyCode ? event.keyCode : event.which);
                    var pattern = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                    if(keycode == '13')
                    {
                        check_fname();
                        check_email();
                         <?php if($url=="https://www.avirasurveys.com/survey-view/d2706c17-422a-4521-9d02-a642e01a83ac/survey-to-analyze-the-needs-and-requirements-of-an-organization-looking-for-cloud-communication-platform." || $url=="https://www.avirasurveys.com/survey-view/e0c0fb50-fa99-4858-9f07-397c9d35b21b/sme's-perspective--to-understand-the-usage-trend-of-services-like-internet,-data-,voice-,cloud,-and-cybersecurity." || $url=="https://www.avirasurveys.com/survey-view/79f4d606-c1de-4441-aab0-979270360e1c/a-survey-on-criteria's-to-consider-while-vendor-selection-for-cloud-communication-platform."){?>
                         check_phone();
                         var phoneno = $("#phone").val();
                        <?php } else {?>
                         var phoneno = "";
                        <?php }?>
                        var allquestionids =$("#all_question_id").val();
                        var allanswers = $("#all_answers").val();
                        var fname = $("#fname").val().trim();
                        var email = $("#email").val();
                        var url_source = $("#url_source").val();
                        var uid = $("#uid").val();
                         var sessipaddrlastform = $("#sessipaddrlastform").val();
                        if(fname_error_message === false && email_error_message === false && phone_error_message === false)
                        {
                            $.ajax({
                				url: "<?php echo SITEPATHFRONT; ?>survey-view-action.php",
                				type: "POST",
                				data: {uid:uid,url_source:url_source,phone:phoneno,allquestionids:allquestionids,allanswers:allanswers,fname:fname,email:email,surveyid:"<?php echo $surveyid?>",userid:<?php echo $user_id?>,sessipaddrlastform:sessipaddrlastform},
                				cache: false,
                				beforeSend: function(){
                                    // Show image container
                                    $('#span_loader').show();
                                    $("#lastsubmit").css({"pointer-events":"none","opacity":"0.4"});
                                },
                				success: function(dataResult){
                				    //alert(dataResult);
                				    //$('#span_loader').hide();
                				    //$('.que_section').hide();
                                   // $("#footerdisplay").hide();
            		               //$('.end').slideDown(200);
            		               //$("#thankyoustopunload").val("Full");
            		               window.location = '<?php echo SITEPATHFRONT;?>thank-you-survey/<?php echo $surveyid?>/'+email+'/'+fname+'';
                				}
                			});
                        }
                    }
            });
                
                
            
            $("#lastsubmit").click(function(){
                //all_question_id all_answers
                check_fname();
                check_email();
                
                <?php if($url=="https://www.avirasurveys.com/survey-view/d2706c17-422a-4521-9d02-a642e01a83ac/survey-to-analyze-the-needs-and-requirements-of-an-organization-looking-for-cloud-communication-platform." || $url=="https://www.avirasurveys.com/survey-view/e0c0fb50-fa99-4858-9f07-397c9d35b21b/sme's-perspective--to-understand-the-usage-trend-of-services-like-internet,-data-,voice-,cloud,-and-cybersecurity." || $url=="https://www.avirasurveys.com/survey-view/79f4d606-c1de-4441-aab0-979270360e1c/a-survey-on-criteria's-to-consider-while-vendor-selection-for-cloud-communication-platform."){?>
                    check_phone();
                var phoneno = $("#phone").val();
                <?php } else {?>
                 var phoneno = "";
                <?php }?>
                var allquestionids =$("#all_question_id").val();
                var allanswers = $("#all_answers").val();
                var fname = $("#fname").val().trim();
                var email = $("#email").val();
                var url_fname = $("#fname").val().trim();
                var url_email = $("#email").val();
                var url_company = $("#url_company").val();
                var url_designation = $("#url_designation").val();
                var url_source = $("#url_source").val();
                var uid = $("#uid").val();
                var sessipaddrlastform = $("#sessipaddrlastform").val();
               
                <?php if(isset($_GET['name']) || isset($_GET['email']) || isset($_GET['uid'])){?>
               
                      if(fname_error_message === false && email_error_message === false)
                      {
                        //alert(fname);
               //alert(email);
                        $.ajax({
                				url: "<?php echo SITEPATHFRONT; ?>survey-view-action.php",
                				type: "POST",
                				data: {uid:uid,url_source:url_source,allquestionids:allquestionids,allanswers:allanswers,fname:fname,email:email,surveyid:"<?php echo $surveyid?>",userid:<?php echo $user_id?>,sessipaddrlastform:sessipaddrlastform,sessfirstform:'<?php echo $_SESSION['campaign_user_id'];?>'},
                				cache: false,
                				beforeSend: function(){
                                    // Show image container
                                    $('#span_loader').show();
                                    $("#lastsubmit").css({"pointer-events":"none","opacity":"0.4"});
                                },
                				success: function(dataResult){
                				   // alert(dataResult);
                				   //alert('<?php echo SITEPATHFRONT;?>thank-you-survey/<?php echo $surveyid?>/'+url_email+'/'+url_fname+'');
//**Comment by vinod on 19/01/23	//   if(uid!="")
                				//   {
                				//       var userdetail=dataResult.split("*");
                				//       var url_email=userdetail[0];
                				//       var url_fname=userdetail[1];
                				//   }
                				    //$('#span_loader').hide();
                				    //alert(dataResult);
                				    //$('#span_loader').hide();
                				    //$('.que_section').hide();
                                   // $("#footerdisplay").hide();
            		               //$('.end').slideDown(200);
            		               //$("#thankyoustopunload").val("Full");
            		               var url_fname = $("#fname").val();
                                   var url_email = $("#email").val();
                                   //alert(url_email);
            		              // alert(url_fname);
            		               <?php if(isset($_GET['name']) && isset($_GET['email'])){?>
            		                   //alert("url");
            		                    if(url_fname=="")
                                        {
                                            var url_fname="test";
                                        }
                                        if(url_email=="")
                                        {
                                            var url_email="test@gmail.com";
                                        }
            		               window.location = '<?php echo SITEPATHFRONT;?>thank-you-survey/<?php echo $surveyid?>/'+url_email+'/'+url_fname+'';
            		               <?php } else {?>
            		                   //alert("empty");
            		                     window.location = '<?php echo SITEPATHFRONT;?>thank-you-survey/<?php echo $surveyid?>/'+email+'/'+fname+'';
            		                   
            		               <?php }?>
            		               
                				}
                			}); 
                      }
                <?php } else {?>
                    <?php if($_SESSION['response_user_id']==""){?>
                    
                        if(fname_error_message === false && email_error_message === false && phone_error_message === false)
                        {
                            $.ajax({
                				url: "<?php echo SITEPATHFRONT; ?>survey-view-action.php",
                				type: "POST",
                				data: {uid:uid,url_source:url_source,phone:phoneno,allquestionids:allquestionids,allanswers:allanswers,fname:fname,email:email,surveyid:"<?php echo $surveyid?>",userid:<?php echo $user_id?>,sessipaddrlastform:sessipaddrlastform,sessfirstform:'<?php echo $_SESSION['response_user_id'];?>'},
                				cache: false,
                				beforeSend: function(){
                                    // Show image container
                                    $('#span_loader').show();
                                    $("#lastsubmit").css({"pointer-events":"none","opacity":"0.4"});
                                },
                				success: function(dataResult){
                				   // alert(dataResult);
                				    //$('#span_loader').hide();
                				    //$('.que_section').hide();
                                   // $("#footerdisplay").hide();
            		               //$('.end').slideDown(200);
            		               //$("#thankyoustopunload").val("Full");
            		               window.location = '<?php echo SITEPATHFRONT;?>thank-you-survey/<?php echo $surveyid?>/'+email+'/'+fname+'';
                				}
                			});
                        }
                    <?php }else {?>
                    
                    if(fname=="" && email=="")
                    {
                        var fname = "<?php echo $_SESSION['first_form_fname'];?>";
                        var email = "<?php echo $_SESSION['first_form_email'];?>";
                    }
                    
                       $.ajax({
                				url: "<?php echo SITEPATHFRONT; ?>survey-view-action.php",
                				type: "POST",
                				data: {uid:uid,url_source:url_source,allquestionids:allquestionids,allanswers:allanswers,fname:fname,email:email,surveyid:"<?php echo $surveyid?>",userid:<?php echo $user_id?>,sessipaddrlastform:sessipaddrlastform,sessfirstform:'<?php echo $_SESSION['response_user_id'];?>'},
                				cache: false,
                				beforeSend: function(){
                                    // Show image container
                                    $('#span_loader').show();
                                    $("#lastsubmit").css({"pointer-events":"none","opacity":"0.4"});
                                },
                				success: function(dataResult){
                				    //alert(dataResult);
                				    //$('#span_loader').hide();
                				    //$('.que_section').hide();
                                   // $("#footerdisplay").hide();
            		               //$('.end').slideDown(200);
            		               //$("#thankyoustopunload").val("Full");
            		               window.location = '<?php echo SITEPATHFRONT;?>thank-you-survey/<?php echo $surveyid?>/'+email+'/'+fname+'';
                				}
                			}); 
                    <?php }?>
                <?php }?>
            });
            
            
            
    });
//++++++++++++++++++Body onload code+++++++++++++


//====== Next & Prev Button Click =======
$('body').on('click', '.next', function() { 
    var id = $('.item:visible').data('id');
    var nextId = $('.item:visible').data('id')+1;
    //alert(nextId);
    var required = $("#required_"+nextId).val();
    var nextrequired = $("#required_"+nextId).val();
    //alert(required);
    //alert(nextrequired);
    if(nextids.length === 0)
    {
        nextids.push(1);
    }
    //alert(required);
    //alert(nextrequired);
    var totalquest=$("#totalquestion").val();
    if(nextId>totalquest)
    {
        $("#setqno").val(nextId);
    }
    
    /////////////////////////////
    
    var qid22 = $("#qidthis_"+nextId).val();
    var setquestion12 = $("#all_question_id").val();
    var setquestionarray12 = setquestion12.split("♣");
   
    var nqid12 = qid22+'';
    var posq12 = setquestionarray12.indexOf(nqid12);
    //alert(posq12);
    if(posq12=="-1")
    { //alert(required);
       if(required=="No" || required=="")
       {
            $(".next").removeClass("disabled");
            $("#star_"+nextId).hide();
            if(nextId<=totalquest)
            {
              nextids.push(nextId);
              /////////////Code for question number////
                var nowqno = $("#setqno").val();
                var nowqno1 = parseInt(nowqno)+parseInt(1);
                $("#setqno").val(nowqno1);
                
                ///////////////////////////////////////////
            }
            $("#displayqno_"+nextId).text(nowqno1);
            //alert(nextId);
            var totalquest=$("#totalquestion").val();
            var submitcnt = parseInt(totalquest)+parseInt(1);
            if(nextId > 1){
                //$('.back').show();
                $(".back").removeClass("disabled");
            }
            //
        //alert(submitcnt);
            if(nextId == submitcnt){
               // alert("hello");
                $(".next").addClass("disabled");
               // $('.next').hide();
            }
            $('#que_'+id).slideUp(200);
            $('#que_'+nextId).slideDown(200);
            
        }
        else
        { 
           $("#star_"+nextId).show();
           $(".next").addClass("disabled");
           
            
            if(nextId<=totalquest)
            {
              nextids.push(nextId);
              /////////////Code for question number////
                var nowqno = $("#setqno").val();
                var nowqno1 = parseInt(nowqno)+parseInt(1);
                $("#setqno").val(nowqno1);
                
                ///////////////////////////////////////////
            }
            $("#displayqno_"+nextId).text(nowqno1);
            //alert(nextId);
            var totalquest=$("#totalquestion").val();
            var submitcnt = parseInt(totalquest)+parseInt(1);
            if(nextId > 1){
                //$('.back').show();
                $(".back").removeClass("disabled");
            }
            
        //alert(submitcnt);
            if(nextId == submitcnt){
               // alert("hello");
                $(".next").addClass("disabled");
               // $('.next').hide();
            }
            $('#que_'+id).slideUp(200);
            $('#que_'+nextId).slideDown(200);
        }
    }
    else
    {
        
        //alert("dd");
        $(".next").removeClass("disabled");
        
        if(nextId<=totalquest)
        {
          nextids.push(nextId);
          /////////////Code for question number////
            var nowqno = $("#setqno").val();
            var nowqno1 = parseInt(nowqno)+parseInt(1);
            $("#setqno").val(nowqno1);
            
            ///////////////////////////////////////////
        }
        $("#displayqno_"+nextId).text(nowqno1);
        
        var totalquest=$("#totalquestion").val();
        var submitcnt = parseInt(totalquest)+parseInt(1);
        //alert(nextId);
        //alert(submitcnt);
        if(nextId > 1){
            //$('.back').show();
            $(".back").removeClass("disabled");
        }
        if(nextId == submitcnt){
            //alert("jekjlk");
            $('.next').addClass("disabled");
            //$('.next').hide();
        }
        $('#que_'+id).slideUp(200);
        $('#que_'+nextId).slideDown(200);
    
    }
    //alert(nextids);
    
    // if(required=="No" || required=="")
    // {
    //     if(nextrequired=="Yes")
    //     {
    //         $(".next").addClass("disabled");
    //     }
        // else
        // {
        //     $(".next").removeClass("disabled");
        // }
    //}
    //alert(id);
    // if(id==totalquest)
    // {
    //   progressBar(100,100);  
    // }
    var qtypename=$("#qtypename_"+nextId).val();
    if(qtypename=="Order")
    { //alert(nextId);
      setorderval(nextId);
    }
    if(qtypename=="Mrating")
    { //alert(nextId);
      orderids=[];
      mratingcounter=0;
    }
});

$('body').on('click', '.back', function() { 
    var id = $('.item:visible').data('id');
    var prevId = $('.item:visible').data('id')-1;
    //alert(id);
    //alert(prevId);
   
   var totalquest=$("#totalquestion").val();
   //alert(nextids);
   var qval=$("#setqno").val();
   //alert(qval);
  if(prevId==totalquest)
  {
      //var popval=nextids.pop();
      var newnextid=nextids;
      if(newnextid!="")
      {
          nextids = newnextid;
          var popval=newnextid.pop();
          nextids.push(popval);
      }
      else
      {
          var popval=1;
      }
      //alert(popval);
      var qval12=parseInt(qval)-parseInt(1);
      $("#setqno").val(qval12);
      $('#que_'+id).slideUp(200);
      $('#que_'+popval).slideDown(200);
  }
  else
  {  
      //alert(nextids);
      var nt = nextids.length-1;
      var newnextid = nextids.slice(0,nt);
      //alert(newnextid);
      //var newnextid=nextids;
      if(newnextid!="")
      {
          nextids = newnextid;
          var popval=newnextid.pop();
          nextids.push(popval);
      }
      else
      {
          var popval=1;
      }
      //alert(popval);
      var qval12=parseInt(qval)-parseInt(1);
      $("#setqno").val(qval12);
      $('#que_'+id).slideUp(200);
      $('#que_'+popval).slideDown(200); 
      //nextids = newnextid;
   }
   
   
    var submitcnt = parseInt(totalquest)+parseInt(1);
    
    if(id == totalquest){
        //$('.next').hide();
        $(".next").addClass("disabled");
    }
    if(prevId < submitcnt){
        //$('.next').show();
        $(".next").removeClass("disabled");
    }
    if(prevId==1 || qval12==1){
        //$('.back').hide();
        $(".back").addClass("disabled");
    }
    
    var qtypename=$("#qtypename_"+prevId).val();
    if(qtypename=="Order")
    { //alert(nextId);
      setorderval(prevId);
    }
    if(qtypename=="Mrating")
    { //alert(nextId);
      orderids=[];
      mratingcounter=0;
    }
});

//other filed show
function activenextbutton(curqno,qid)
{
    var qtypename=$("#qtypename_"+curqno).val();
    if(qtypename=="Text")
    {
        if($('#texttype_'+qid).val() != '' && $('#texttype_'+qid).val().trim().length != 0)
        {
          $('#button_next_'+qid).removeClass("action-btn-disabled");
          $('#btn_next_'+qid).removeClass("action-btn-disabled");
        }
        else
        {
          $('#button_next_'+qid).addClass("action-btn-disabled");
          $('#btn_next_'+qid).addClass("action-btn-disabled");
        }
    }
    if(qtypename=="Radio")
    {
        
        if($('#radio_other_text_'+qid).val().trim() != '')
        {
          $('#btn_next_other_radio_'+qid).removeClass("action-btn-disabled");
        }
    }
    if(qtypename=="Checkbox")
    {
        if($('#check_other_text_'+qid).val() != '')
        {
          $('#btn_next_other_check_'+qid).removeClass("action-btn-disabled");
        }
    }
    
}

function setnext(curqno,subid,qid,ans)
{    //alert(curqno);
    //alert(currqid);
     var sess = '<?php echo $_SESSION['response_user_id'];?>';
           //alert(sess);
     //Code for 4 multiple mail and data as per half survey
    var qno12=$("#setqno").val();
    var threemultiplemail = qno12 % 3;
    //alert(fourmultiplemail);
    
    if(nextids.length === 0)
    {
        nextids.push(1);
    }
    
    var nextqid=parseInt(curqno)+parseInt(1);
   //alert(nextqid);
    var totalquest=$("#totalquestion").val();
    var qtypename=$("#qtypename_"+curqno).val();
    var lastformnumber = parseInt(totalquest)+parseInt(1);
    //alert(lastformnumber);
    //alert(qtypename);
    //all_question_id all_answers current_answer
    ///Add question id
    if($("#all_question_id").val()=="")
    {
         if(qtypename=="Matrix")
         {
             var selval12=$("#matrixselectedval_"+qid).val();
             if(selval12!="")
             {
                 $("#all_question_id").val(qid);
                 var posq="-1"; 
             }
         }
         else
         {
            $("#all_question_id").val(qid);
            var posq="-1";
         }
    }
    else
    {
        if(qtypename=="Matrix")
        {
             var selval12=$("#matrixselectedval_"+qid).val();
             if(selval12!="")
             {
                var setquestion = $("#all_question_id").val();
                var setquestionarray = setquestion.split("♣");
               
                var nqid = qid+'';
                var posq = setquestionarray.indexOf(nqid);
                if(posq=="-1")
                {
                    $("#all_question_id").val(setquestion+"♣"+qid);
                }
                else
                {
                    answerposition=posq;
                }
            }
        }
        else
        {
            var setquestion = $("#all_question_id").val();
            var setquestionarray = setquestion.split("♣");
           
            var nqid = qid+'';
            var posq = setquestionarray.indexOf(nqid);
            if(posq=="-1")
            {
                $("#all_question_id").val(setquestion+"♣"+qid);
            }
            else
            {
                answerposition=posq;
            }
        }
    }
    ////End question id
    //alert(qtypename);
   // alert(nextqid);
   //var qseq=$("#qsequence").val();
        if(qtypename=="Radio")
        {
            var radioValue = ans;
            var skipval = $("#skip_"+subid).val();
               //alert(skipval);
            //$("#qsequence").val(qseq+";"+skipval);
            if(radioValue == '')
            {  
               radioValue = $("#radiotype_"+subid).val();
               var rad_other_value = $("#radio_other_text_"+qid).val().trim();
              // var rad_other_value = rad_other_value1.replace(",","");
               $("#current_answer").val(radioValue+"☼"+rad_other_value);
               if($('#radio_other_text_'+qid).val().trim() != '')
               {
                 if(posq=="-1")
                 {
                     if($("#all_answers").val()=="")
                     {
                        var currentans=$("#current_answer").val();
                        $("#all_answers").val(currentans);
                     }
                     else
                     {
                        
                        var prevans = $("#all_answers").val();
                        var currentans=$("#current_answer").val();
                        $("#all_answers").val(prevans+"♣"+currentans);
                     }
                 }
                 else
                 {
                       var currentans=$("#current_answer").val();
                       var allans = $("#all_answers").val();
                       var ansarray = allans.split("♣");
                       ansarray[posq]=currentans;
                       var fetchans = ansarray+'';
                       var testt21 = fetchans.replace(/,/g,"♣");
                       $("#all_answers").val(testt21);
                 }
                 $("#current_answer").val("");
                 /**********skip code**********/
                 //var skipqtval = parseInt(curqno)*parseInt(200);
                 if(skipval=="")
                 {
                     nextprev(skipval);
                     $('#que_'+curqno).slideUp(200);
                     $('#que_'+nextqid).slideDown(200);
                      /////////////Code for question number////
                        var nowqno = $("#setqno").val();
                        var nowqno1 = parseInt(nowqno)+parseInt(1);
                        $("#setqno").val(nowqno1);
                        
                        ///////////////////////////////////////////
                     $("#displayqno_"+nextqid).text(nowqno1);
                     if(nextqid<=totalquest)
                     {
                      //$("#qsequence").val(qseq+";"+nextqid);
                      nextids.push(nextqid);
                     }
                       
                 }
                 else
                 {
                    //nextqid = skipval; 
                    nextprev(skipval);
                    if(skipval!=curqno)
                    {
                        if(skipval=="End")
                        {
                           // alert(curqno);
                            var totalquestchk=$("#totalquestion").val();
                            var submitform = parseInt(totalquestchk)+parseInt(1);
                            $('#que_'+curqno).slideUp(200);
                            $('#que_'+submitform).slideDown(200);
                             /////////////Code for question number////
                                var nowqno = $("#setqno").val();
                                var nowqno1 = parseInt(nowqno)+parseInt(1);
                                $("#setqno").val(nowqno1);
                                    
                             ///////////////////////////////////////////
                             $("#displayqno_"+submitform).text(nowqno1);
                             if(submitform<=totalquest)
                             {
                               //$("#qsequence").val(qseq+";"+nextqid);
                              // nextids.push(submitform);
                              
                             }
                        }
                        else
                        {
                            $('#que_'+curqno).slideUp(200);
                            $('#que_'+skipval).slideDown(200);
                             /////////////Code for question number////
                                var nowqno = $("#setqno").val();
                                var nowqno1 = parseInt(nowqno)+parseInt(1);
                                $("#setqno").val(nowqno1);
                                
                                ///////////////////////////////////////////
                            $("#displayqno_"+skipval).text(nowqno1);
                            if(skipval<=totalquest)
                            {
                             //$("#qsequence").val(qseq+";"+skipval);
                             nextids.push(skipval);
                            
                            }
                        }
                    }
                 }
                 /********************/
               }
            }
            else
            {  
               $("#radio_other_text_field_"+qid).hide();
               $("#current_answer").val(radioValue);
               //alert(posq);
               if(posq=="-1")
               {
                   if($("#all_answers").val()=="")
                   {
                      var currentans=$("#current_answer").val();
                      $("#all_answers").val(currentans);
                   }
                   else
                   {
                      var prevans = $("#all_answers").val();
                      var currentans=$("#current_answer").val();
                      $("#all_answers").val(prevans+"♣"+currentans);
                   }
               }
               else
               {
                   var currentans=$("#current_answer").val();
                   var allans = $("#all_answers").val();
                   var ansarray = allans.split("♣");
                   ansarray[posq]=currentans;
                  // alert(ansarray);
                   var fetchans = ansarray+'';
                   var testt21 = fetchans.replace(/,/g,"♣");
                   $("#all_answers").val(testt21);
                   
               }
               $("#current_answer").val("");
               /********* skip code***********/
                 //var skipqtval = parseInt(curqno)*parseInt(200);
                 if(skipval=="")
                 {
                     nextprev(skipval);
                     $('#que_'+curqno).slideUp(200);
                     $('#que_'+nextqid).slideDown(200);
                      /////////////Code for question number////
                        var nowqno = $("#setqno").val();
                        var nowqno1 = parseInt(nowqno)+parseInt(1);
                        $("#setqno").val(nowqno1);
                        
                        ///////////////////////////////////////////
                     $("#displayqno_"+nextqid).text(nowqno1);
                     if(nextqid<=totalquest)
                     {
                      //$("#qsequence").val(qseq+";"+nextqid);
                      nextids.push(nextqid);
                      
                     }
                 }
                 else
                 {
                    //nextqid = skipval;
                    nextprev(skipval);
                    if(skipval!=curqno)
                    {
                        if(skipval=="End")
                        {
                            var totalquestchk=$("#totalquestion").val();
                            var submitform = parseInt(totalquestchk)+parseInt(1);
                            $('#que_'+curqno).slideUp(200);
                            $('#que_'+submitform).slideDown(200);
                             /////////////Code for question number////
                                var nowqno = $("#setqno").val();
                                var nowqno1 = parseInt(nowqno)+parseInt(1);
                                $("#setqno").val(nowqno1);
                                    
                             ///////////////////////////////////////////
                             $("#displayqno_"+submitform).text(nowqno1);
                             if(submitform<=totalquest)
                             {
                               //$("#qsequence").val(qseq+";"+nextqid);
                              // nextids.push(submitform);
                              
                             }
                        }
                        else
                        {
                            $('#que_'+curqno).slideUp(200);
                            $('#que_'+skipval).slideDown(200);
                             /////////////Code for question number////
                                var nowqno = $("#setqno").val();
                                var nowqno1 = parseInt(nowqno)+parseInt(1);
                                $("#setqno").val(nowqno1);
                                
                                ///////////////////////////////////////////
                            $("#displayqno_"+skipval).text(nowqno1);
                            if(skipval<=totalquest)
                            {
                             //$("#qsequence").val(qseq+";"+skipval);
                             nextids.push(skipval);
                             
                            }
                        }
                    }
                 }
                 /********************/
            }
        }
        else if(qtypename=="Checkbox")
        {   
            var skipval=$("#skip_to_"+qid).val();
            var selval=$("#chkselectedval_"+qid).val();
            $("#current_answer").val(selval);
            var checkValue = $("#current_answer").val();
            //alert(checkValue);
            var chkotherval="";
            
            var allvaluesset = checkValue.split("♦");
            
            if(allvaluesset.length > 0)
            {
                for(var iii = 0; iii < allvaluesset.length; iii++) 
                { 
                    if(allvaluesset[iii].includes("Other"))
                    {
                        var oth=allvaluesset[iii].split("☼");
                        
                        var check_other_value1 = $("#check_other_text_"+qid).val();
                        var check_other_value = check_other_value1.replaceAll(/,/g,"");
                        // alert(check_other_value);
                        var chkotherval=oth[0]+"☼"+check_other_value;
                        //alert(chkotherval);
                        allvaluesset.splice(iii, 1,chkotherval);
                    }
                    
                }
            }
            var allvaluestarrep = allvaluesset+'';
            var test32 = allvaluestarrep.replace(/,/g,"♦");
            
             $("#current_answer").val(test32);
             if(posq=="-1")
             {
                 if($("#all_answers").val()=="")
                 {
                    var currentans=$("#current_answer").val();
                    $("#all_answers").val(currentans);
                    $("#chkselectedval_"+qid).val(currentans);
                 }
                 else
                 {
                    var prevans = $("#all_answers").val();
                    var currentans=$("#current_answer").val();
                    $("#all_answers").val(prevans+"♣"+currentans);
                    $("#chkselectedval_"+qid).val(currentans);
                 }
             }
             else
             {
                 var currentans=$("#current_answer").val();
                 var allans = $("#all_answers").val();
                 var ansarray = allans.split("♣");
                 ansarray[posq]=currentans;
                 var fetchans = ansarray+'';
                 var testt21 = fetchans.replace(/,/g,"♣");
                 $("#all_answers").val(testt21);
             }
             
            if(selval!="")
            {    nextprev(skipval);
                 $("#current_answer").val("");
                 if(skipval=="")
                 {
                    $('#que_'+curqno).slideUp(200);
                    $('#que_'+nextqid).slideDown(200);
                     /////////////Code for question number////
                    var nowqno = $("#setqno").val();
                    var nowqno1 = parseInt(nowqno)+parseInt(1);
                    $("#setqno").val(nowqno1);
                        
                     ///////////////////////////////////////////
                     $("#displayqno_"+nextqid).text(nowqno1);
                     if(nextqid<=totalquest)
                     {
                       //$("#qsequence").val(qseq+";"+nextqid);
                       nextids.push(nextqid);
                      
                     }
                 }
                 else
                 {
                    if(skipval=="End")
                    {
                        var totalquestchk=$("#totalquestion").val();
                        var submitform = parseInt(totalquestchk)+parseInt(1);
                        $('#que_'+curqno).slideUp(200);
                        $('#que_'+submitform).slideDown(200);
                         /////////////Code for question number////
                            var nowqno = $("#setqno").val();
                            var nowqno1 = parseInt(nowqno)+parseInt(1);
                            $("#setqno").val(nowqno1);
                                
                         ///////////////////////////////////////////
                         $("#displayqno_"+submitform).text(nowqno1);
                         if(submitform<=totalquest)
                         {
                           //$("#qsequence").val(qseq+";"+nextqid);
                          // nextids.push(submitform);
                          
                         }
                    }
                    else
                    {
                        $('#que_'+curqno).slideUp(200);
                        $('#que_'+skipval).slideDown(200);
                         /////////////Code for question number////
                            var nowqno = $("#setqno").val();
                            var nowqno1 = parseInt(nowqno)+parseInt(1);
                            $("#setqno").val(nowqno1);
                                
                         ///////////////////////////////////////////
                         $("#displayqno_"+skipval).text(nowqno1);
                         if(skipval<=totalquest)
                         {
                           //$("#qsequence").val(qseq+";"+nextqid);
                           nextids.push(skipval);
                          
                         }
                    }
                 }
                 
            }
        }
        else if(qtypename=="Text")
        {  
            var textvalue = $("#texttype_"+qid).val()+"◘"+qtypename;
            var skipval=$("#skip_to_"+qid).val();
            $("#current_answer").val(textvalue);
            if($('#texttype_'+qid).val() != '' && $('#texttype_'+qid).val().trim().length != 0)
            {
                if($("#all_answers").val()=="")
                {
                   var currentans=$("#current_answer").val();
                   $("#all_answers").val(currentans);
                }
                else
                {
                   if(posq=="-1")
                   {
                       var prevans = $("#all_answers").val();
                       var currentans=$("#current_answer").val();
                       $("#all_answers").val(prevans+"♣"+currentans);
                   }
                   else
                   {
                       var currentans=$("#current_answer").val();
                       var allans = $("#all_answers").val();
                       var ansarray = allans.split("♣");
                       ansarray[posq]=currentans;
                       var fetchans = ansarray+'';
                       var testt21 = fetchans.replace(/,/g,"♣");
                       $("#all_answers").val(testt21);
                   }
                }
                //alert(nextqid);
                nextprev(skipval);
                $("#current_answer").val("");
                if(skipval=="")
                 {
                    $('#que_'+curqno).slideUp(200);
                    $('#que_'+nextqid).slideDown(200);
                     /////////////Code for question number////
                    var nowqno = $("#setqno").val();
                    var nowqno1 = parseInt(nowqno)+parseInt(1);
                    $("#setqno").val(nowqno1);
                        
                     ///////////////////////////////////////////
                     $("#displayqno_"+nextqid).text(nowqno1);
                     if(nextqid<=totalquest)
                     {
                       //$("#qsequence").val(qseq+";"+nextqid);
                       nextids.push(nextqid);
                      
                     }
                 }
                 else
                 {
                    if(skipval=="End")
                    {
                        var totalquestchk=$("#totalquestion").val();
                        var submitform = parseInt(totalquestchk)+parseInt(1);
                        $('#que_'+curqno).slideUp(200);
                        $('#que_'+submitform).slideDown(200);
                         /////////////Code for question number////
                            var nowqno = $("#setqno").val();
                            var nowqno1 = parseInt(nowqno)+parseInt(1);
                            $("#setqno").val(nowqno1);
                                
                         ///////////////////////////////////////////
                         $("#displayqno_"+submitform).text(nowqno1);
                         if(submitform<=totalquest)
                         {
                           //$("#qsequence").val(qseq+";"+nextqid);
                          // nextids.push(submitform);
                          
                         }
                    }
                    else
                    {
                        $('#que_'+curqno).slideUp(200);
                        $('#que_'+skipval).slideDown(200);
                         /////////////Code for question number////
                            var nowqno = $("#setqno").val();
                            var nowqno1 = parseInt(nowqno)+parseInt(1);
                            $("#setqno").val(nowqno1);
                                
                         ///////////////////////////////////////////
                         $("#displayqno_"+skipval).text(nowqno1);
                         if(skipval<=totalquest)
                         {
                           //$("#qsequence").val(qseq+";"+nextqid);
                           nextids.push(skipval);
                          
                         }
                    }
                 }
            }
        }
        else
        {
            var othervalue = ans;
            //alert(qtypename);
             //alert(othervalue);
            if(qtypename=="Opinion Scale" || qtypename=="Rating")
            {
                $("#current_answer").val(othervalue+"◘"+qtypename);
            }
            else
            {
                $("#current_answer").val(othervalue);
            }
            
            if($("#all_answers").val()=="")
            {
               var currentans=$("#current_answer").val();
               $("#all_answers").val(currentans);
               
            }
            else
            {
               if(posq=="-1")
               {
                   var prevans = $("#all_answers").val();
                   var currentans=$("#current_answer").val();
                   $("#all_answers").val(prevans+"♣"+currentans);
               }
               else
               {   
                   var currentans=$("#current_answer").val();
                   var allans = $("#all_answers").val();
                   var ansarray = allans.split("♣");
                   ansarray[posq]=currentans;
                   var fetchans = ansarray+'';
                   var testt21 = fetchans.replace(/,/g,"♣");
                   $("#all_answers").val(testt21);
               }
            }
            $("#current_answer").val("");
            if(qtypename=="Boolean")
            {
                var skipval = $("#skip_"+subid).val();
                //alert(skipval);
                
                /**********skip code**********/
                 //var skipqtval = parseInt(curqno)*parseInt(200);
                 if(skipval=="")
                 {
                     nextprev(skipval);
                     $('#que_'+curqno).slideUp(200);
                     $('#que_'+nextqid).slideDown(200);
                      /////////////Code for question number////
                        var nowqno = $("#setqno").val();
                        var nowqno1 = parseInt(nowqno)+parseInt(1);
                        $("#setqno").val(nowqno1);
                        
                        ///////////////////////////////////////////
                     $("#displayqno_"+nextqid).text(nowqno1);
                     if(nextqid<=totalquest)
                     {
                      //$("#qsequence").val(qseq+";"+nextqid);
                      nextids.push(nextqid);
                      
                     }
                 }
                 else
                 {
                    //nextqid = skipval; 
                    nextprev(skipval);
                    if(skipval!=curqno)
                    {
                        if(skipval=="End")
                        {
                            var totalquestchk=$("#totalquestion").val();
                            var submitform = parseInt(totalquestchk)+parseInt(1);
                            $('#que_'+curqno).slideUp(200);
                            $('#que_'+submitform).slideDown(200);
                             /////////////Code for question number////
                                var nowqno = $("#setqno").val();
                                var nowqno1 = parseInt(nowqno)+parseInt(1);
                                $("#setqno").val(nowqno1);
                                    
                             ///////////////////////////////////////////
                             $("#displayqno_"+submitform).text(nowqno1);
                             if(submitform<=totalquest)
                             {
                               //$("#qsequence").val(qseq+";"+nextqid);
                              // nextids.push(submitform);
                              
                             }
                        }
                        else
                        {
                            $('#que_'+curqno).slideUp(200);
                            $('#que_'+skipval).slideDown(200);
                             /////////////Code for question number////
                                var nowqno = $("#setqno").val();
                                var nowqno1 = parseInt(nowqno)+parseInt(1);
                                $("#setqno").val(nowqno1);
                                
                                ///////////////////////////////////////////
                            $("#displayqno_"+skipval).text(nowqno1);
                            if(skipval<=totalquest)
                            {
                             //$("#qsequence").val(qseq+";"+skipval);
                             nextids.push(skipval);
                             
                            }
                        }
                    }
                 }
                 /********************/
            }
            else if(qtypename=="Rating")
            {
                
                //0,0,3,0,5
                //othervalue="4";
                var skipval = $("#skip_"+subid).val();
                //alert(skipval);
                
                var skipvalarray = skipval.split(",");
                //alert(othervalue);
                var othervalue12 = parseInt(othervalue)-parseInt(1);
                var skipos=skipvalarray[othervalue12];
                
                //alert(skipos);
                if(skipos=="0")
                {nextprev(skipval);
                    $('#que_'+curqno).slideUp(200);
                    $('#que_'+nextqid).slideDown(200);
                     /////////////Code for question number////
                        var nowqno = $("#setqno").val();
                        var nowqno1 = parseInt(nowqno)+parseInt(1);
                        $("#setqno").val(nowqno1);
                        
                        ///////////////////////////////////////////
                    $("#displayqno_"+nextqid).text(nowqno1);
                    if(nextqid<=totalquest)
                    {
                     //$("#qsequence").val(qseq+";"+nextqid);
                     nextids.push(nextqid);
                    
                    }
                }
                else
                {nextprev(skipval);
                    //nextqid = skipos; 
                    
                        if(skipos!=curqno)
                        {
                            if(skipos=="End")
                            {
                                var totalquestchk=$("#totalquestion").val();
                                var submitform = parseInt(totalquestchk)+parseInt(1);
                                $('#que_'+curqno).slideUp(200);
                                $('#que_'+submitform).slideDown(200);
                                 /////////////Code for question number////
                                    var nowqno = $("#setqno").val();
                                    var nowqno1 = parseInt(nowqno)+parseInt(1);
                                    $("#setqno").val(nowqno1);
                                        
                                 ///////////////////////////////////////////
                                 $("#displayqno_"+submitform).text(nowqno1);
                                 if(submitform<=totalquest)
                                 {
                                   //$("#qsequence").val(qseq+";"+nextqid);
                                  // nextids.push(submitform);
                                  
                                 }
                            }
                            else
                            {
                                $('#que_'+curqno).slideUp(200);
                                $('#que_'+skipos).slideDown(200);
                                 /////////////Code for question number////
                                    var nowqno = $("#setqno").val();
                                    var nowqno1 = parseInt(nowqno)+parseInt(1);
                                    $("#setqno").val(nowqno1);
                                    
                                    ///////////////////////////////////////////
                                $("#displayqno_"+skipos).text(nowqno1);
                                if(skipos<=totalquest)
                                {
                                  // $("#qsequence").val(qseq+";"+skipos);
                                   nextids.push(skipos);
                                   
                                }
                            }
                       }
                    
                }
                
            }
            else if(qtypename=="Opinion Scale")
            {
                //0,0,5,0,0,0,0,0,0,0,0
                var skipval = $("#skip_"+subid).val();
                //alert(skipval);
                 //alert(othervalue);
                //$("#qsequence").val(qseq+";"+skipval);
                var skipvalarray = skipval.split(",");
                var skipos=skipvalarray[othervalue];
                if(skipos=="0")
                {nextprev(skipval);
                    $('#que_'+curqno).slideUp(200);
                    $('#que_'+nextqid).slideDown(200);
                     /////////////Code for question number////
                        var nowqno = $("#setqno").val();
                        var nowqno1 = parseInt(nowqno)+parseInt(1);
                        $("#setqno").val(nowqno1);
                        
                        ///////////////////////////////////////////
                        //alert(nowqno1);
                    $("#displayqno_"+nextqid).text(nowqno1);
                    if(nextqid<=totalquest)
                    {
                      //$("#qsequence").val(qseq+";"+nextqid);
                      nextids.push(nextqid);
                      
                    }
                    
                }
                else
                {nextprev(skipval);
                    //nextqid = skipos;
                    if(skipos!=curqno)
                    {   
                        if(skipos=="End")
                        {
                            var totalquestchk=$("#totalquestion").val();
                            var submitform = parseInt(totalquestchk)+parseInt(1);
                            $('#que_'+curqno).slideUp(200);
                            $('#que_'+submitform).slideDown(200);
                             /////////////Code for question number////
                                var nowqno = $("#setqno").val();
                                var nowqno1 = parseInt(nowqno)+parseInt(1);
                                $("#setqno").val(nowqno1);
                                    
                             ///////////////////////////////////////////
                             $("#displayqno_"+submitform).text(nowqno1);
                             if(submitform<=totalquest)
                             {
                               //$("#qsequence").val(qseq+";"+nextqid);
                              // nextids.push(submitform);
                              
                             }
                        }
                        else
                        {
                            $('#que_'+curqno).slideUp(200);
                            $('#que_'+skipos).slideDown(200);
                             /////////////Code for question number////
                                var nowqno = $("#setqno").val();
                                var nowqno1 = parseInt(nowqno)+parseInt(1);
                                $("#setqno").val(nowqno1);
                                
                                ///////////////////////////////////////////
                            $("#displayqno_"+skipos).text(nowqno1);
                            if(skipos<=totalquest)
                            {
                               //$("#qsequence").val(qseq+";"+skipos);
                               nextids.push(skipos);
                               
                            }
                        }
                    }
                    
                }
            }
            else if(qtypename=="Order")
            {
               //$("#allsubval_"+qstid).val(
               var skipval=$("#skip_to_"+qid).val();
                var selval=$("#allsubval_"+qid).val();
                $("#current_answer").val(selval);
            
                if($("#all_answers").val()=="")
                {
                   var currentans=$("#current_answer").val();
                   $("#all_answers").val(currentans);
                }
                else
                { //alert(posq);
                   if(posq=="-1")
                   {
                       var prevans = $("#all_answers").val();
                       var currentans=$("#current_answer").val();
                       $("#all_answers").val(prevans+currentans);
                   }
                   else
                   {   
                       var currentans=$("#current_answer").val();
                       var allans = $("#all_answers").val();
                       var ansarray = allans.split("♣");
                       ansarray[posq]=currentans;
                       var fetchans = ansarray+'';
                       var testt212 = fetchans.replace(/,/g,"♣");
                       $("#all_answers").val(testt212);
                   }
                }
                     nextprev(skipval);
                     $("#current_answer").val("");
                     if(skipval=="")
                     {
                        $('#que_'+curqno).slideUp(200);
                        $('#que_'+nextqid).slideDown(200);
                         /////////////Code for question number////
                        var nowqno = $("#setqno").val();
                        var nowqno1 = parseInt(nowqno)+parseInt(1);
                        $("#setqno").val(nowqno1);
                            
                         ///////////////////////////////////////////
                         $("#displayqno_"+nextqid).text(nowqno1);
                         if(nextqid<=totalquest)
                         {
                           //$("#qsequence").val(qseq+";"+nextqid);
                           nextids.push(nextqid);
                          
                         }
                     }
                     else
                     {
                        if(skipval=="End")
                        {
                            var totalquestchk=$("#totalquestion").val();
                            var submitform = parseInt(totalquestchk)+parseInt(1);
                            $('#que_'+curqno).slideUp(200);
                            $('#que_'+submitform).slideDown(200);
                             /////////////Code for question number////
                                var nowqno = $("#setqno").val();
                                var nowqno1 = parseInt(nowqno)+parseInt(1);
                                $("#setqno").val(nowqno1);
                                    
                             ///////////////////////////////////////////
                             $("#displayqno_"+submitform).text(nowqno1);
                             if(submitform<=totalquest)
                             {
                               //$("#qsequence").val(qseq+";"+nextqid);
                              // nextids.push(submitform);
                              
                             }
                        }
                        else
                        {
                            $('#que_'+curqno).slideUp(200);
                            $('#que_'+skipval).slideDown(200);
                             /////////////Code for question number////
                                var nowqno = $("#setqno").val();
                                var nowqno1 = parseInt(nowqno)+parseInt(1);
                                $("#setqno").val(nowqno1);
                                    
                             ///////////////////////////////////////////
                             $("#displayqno_"+skipval).text(nowqno1);
                             if(skipval<=totalquest)
                             {
                               //$("#qsequence").val(qseq+";"+nextqid);
                               nextids.push(skipval);
                              
                             }
                        }
                    }
                
            }
            else if(qtypename=="Mrating")
            {
                var skipval=$("#skip_to_"+qid).val();
                var mratingcnt=$("#mrating_cnt_"+qid).val();
                var orderarraylength = orderids.length;
                
                
                
                var selval=$("#mratingselectedval_"+qid).val();
                var splitratval = selval.split("♦");
                $("#current_answer").val(selval);
            
                if($("#all_answers").val()=="")
                {
                   var currentans=$("#current_answer").val();
                   $("#all_answers").val(currentans);
                }
                else
                { //alert(posq);
                   if(posq=="-1")
                   {
                       var prevans = $("#all_answers").val();
                       var currentans=$("#current_answer").val();
                       $("#all_answers").val(prevans+currentans);
                   }
                   else
                   {   
                       var currentans=$("#current_answer").val();
                       var allans = $("#all_answers").val();
                       var ansarray = allans.split("♣");
                       ansarray[posq]=currentans;
                       var fetchans = ansarray+'';
                       var testt212 = fetchans.replace(/,/g,"♣");
                       $("#all_answers").val(testt212);
                   }
                }
                //if(mratingcnt==splitratval.length)
                if(selval!="")
                {
                     nextprev(skipval);
                     $("#current_answer").val("");
                     if(skipval=="")
                     {
                        $('#que_'+curqno).slideUp(200);
                        $('#que_'+nextqid).slideDown(200);
                        $("#flag_"+qid).val("SET");
                         /////////////Code for question number////
                        var nowqno = $("#setqno").val();
                        var nowqno1 = parseInt(nowqno)+parseInt(1);
                        $("#setqno").val(nowqno1);
                            
                         ///////////////////////////////////////////
                         $("#displayqno_"+nextqid).text(nowqno1);
                         if(nextqid<=totalquest)
                         {
                           //$("#qsequence").val(qseq+";"+nextqid);
                           nextids.push(nextqid);
                           orderids=[];
                           mratingcounter=0;
                           
                         }
                     }
                     else
                     {
                         if(skipval=="End")
                         {
                            var totalquestchk=$("#totalquestion").val();
                            var submitform = parseInt(totalquestchk)+parseInt(1);
                            $('#que_'+curqno).slideUp(200);
                            $('#que_'+submitform).slideDown(200);
                            $("#flag_"+qid).val("SET");
                             /////////////Code for question number////
                                var nowqno = $("#setqno").val();
                                var nowqno1 = parseInt(nowqno)+parseInt(1);
                                $("#setqno").val(nowqno1);
                                    
                             ///////////////////////////////////////////
                             $("#displayqno_"+submitform).text(nowqno1);
                             if(submitform<=totalquest)
                             {
                               //$("#qsequence").val(qseq+";"+nextqid);
                              // nextids.push(submitform);
                                orderids=[];
                                mratingcounter=0;
                             }
                         }
                         else
                         {
                            $('#que_'+curqno).slideUp(200);
                            $('#que_'+skipval).slideDown(200);
                            $("#flag_"+qid).val("SET");
                             /////////////Code for question number////
                                var nowqno = $("#setqno").val();
                                var nowqno1 = parseInt(nowqno)+parseInt(1);
                                $("#setqno").val(nowqno1);
                                    
                             ///////////////////////////////////////////
                             $("#displayqno_"+skipval).text(nowqno1);
                             if(skipval<=totalquest)
                             {
                               //$("#qsequence").val(qseq+";"+nextqid);
                               nextids.push(skipval);
                               orderids=[];
                               mratingcounter=0;
                             }
                         }
                     }
                }
            }
            else if(qtypename=="Matrix")
            {   //alert("ggg");
                var skipval=$("#skip_to_"+qid).val();
                var selval=$("#matrixselectedval_"+qid).val();
                $("#current_answer").val(selval);
                //alert(selval);
                
                 if(posq=="-1")
                 {
                     if($("#all_answers").val()=="")
                     {
                        var currentans=$("#current_answer").val();
                        $("#all_answers").val(currentans);
                        $("#chkselectedval_"+qid).val(currentans);
                     }
                     else
                     {
                        var prevans = $("#all_answers").val();
                        var currentans=$("#current_answer").val();
                        //alert(prevans);
                        //alert(currentans);
                        $("#all_answers").val(prevans+currentans);
                        $("#chkselectedval_"+qid).val(currentans);
                     }
                 }
                 else
                 {
                     var currentans=$("#current_answer").val();
                     var allans = $("#all_answers").val();
                     var ansarray = allans.split("♣");
                     ansarray[posq]=currentans;
                     var fetchans = ansarray+'';
                     var testt21 = fetchans.replace(/,/g,"♣");
                     $("#all_answers").val(testt21);
                 }
                if(selval!="")
                {    nextprev(skipval);
                     $("#current_answer").val("");
                     if(skipval=="")
                     {
                        $('#que_'+curqno).slideUp(200);
                        $('#que_'+nextqid).slideDown(200);
                        /////////////Code for question number////
                        var nowqno = $("#setqno").val();
                        var nowqno1 = parseInt(nowqno)+parseInt(1);
                        $("#setqno").val(nowqno1);
                            
                        ///////////////////////////////////////////
                        $("#displayqno_"+nextqid).text(nowqno1);
                        if(nextqid<=totalquest)
                        {
                          //$("#qsequence").val(qseq+";"+nextqid);
                          nextids.push(nextqid);
                        }
                     }
                     else
                     {
                        if(skipval=="End")
                        {
                            var totalquestchk=$("#totalquestion").val();
                            var submitform = parseInt(totalquestchk)+parseInt(1);
                            $('#que_'+curqno).slideUp(200);
                            $('#que_'+submitform).slideDown(200);
                             /////////////Code for question number////
                                var nowqno = $("#setqno").val();
                                var nowqno1 = parseInt(nowqno)+parseInt(1);
                                $("#setqno").val(nowqno1);
                                    
                             ///////////////////////////////////////////
                             $("#displayqno_"+submitform).text(nowqno1);
                             if(submitform<=totalquest)
                             {
                               //$("#qsequence").val(qseq+";"+nextqid);
                              // nextids.push(submitform);
                              
                             }
                        }
                        else
                        {
                            $('#que_'+curqno).slideUp(200);
                            $('#que_'+skipval).slideDown(200);
                             /////////////Code for question number////
                                var nowqno = $("#setqno").val();
                                var nowqno1 = parseInt(nowqno)+parseInt(1);
                                $("#setqno").val(nowqno1);
                                    
                             ///////////////////////////////////////////
                             $("#displayqno_"+skipval).text(nowqno1);
                             if(skipval<=totalquest)
                             {
                               //$("#qsequence").val(qseq+";"+nextqid);
                               nextids.push(skipval);
                              
                             }
                        }
                     }
                     
                }
            }
            else
            {   nextprev(skipval);
                $('#que_'+curqno).slideUp(200);
                $('#que_'+nextqid).slideDown(200);
                 /////////////Code for question number////
                        var nowqno = $("#setqno").val();
                        var nowqno1 = parseInt(nowqno)+parseInt(1);
                        $("#setqno").val(nowqno1);
                        
                        ///////////////////////////////////////////
                $("#displayqno_"+nextqid).text(nowqno1);
                if(nextqid<=totalquest)
                {
                  //$("#qsequence").val(qseq+";"+nextqid);
                  nextids.push(nextqid);
                  
                }
            }
        }
   //alert(qid);
  //alert(curqno);
  /****************Campaign*******************/
  <?php if($_SESSION['response_user_id']!=""){?>
  $.ajax({
			url: "<?php echo SITEPATHFRONT; ?>survey-view-update-campaign.php",
			type: "POST",
			data: {campaign_user_id:"<?php echo $_SESSION['response_user_id']?>",campqid:qid,campqcnt:curqno},
			cache: false,
			success: function(dataResult){
			  
			}
		});
  <?php }?>
  <?php if($_SESSION['campaign_user_id']!=""){?>
  $.ajax({
			url: "<?php echo SITEPATHFRONT; ?>survey-view-update-campaign.php",
			type: "POST",
			data: {campaign_user_id:"<?php echo $_SESSION['campaign_user_id']?>",campqid:qid,campqcnt:curqno},
			cache: false,
			success: function(dataResult){
			  
			}
		});
  <?php }?>
  /********************************************/
  var allquestionids =$("#all_question_id").val();
  var allanswers = $("#all_answers").val();
    
        if(allquestionids!="" || allanswers!="")
        {
         <?php if($_SESSION['response_user_id']!=""){?>
                if(threemultiplemail=="0")
                {       
                        $.ajax({
                				url: "<?php echo SITEPATHFRONT; ?>survey-view-action-half.php",
                				type: "POST",
                				data: {allquestionids:allquestionids,allanswers:allanswers,surveyid:"<?php echo $surveyid?>",responseuserid:"<?php echo $_SESSION['response_user_id']?>"},
                				cache: false,
                				success: function(dataResult){
                				  
                				}
                			});
                }  
            <?php  }?>
            <?php if(isset($_GET['name']) || isset($_GET['email'])){?>
                if(threemultiplemail=="0")
                {       
                        $.ajax({
                				url: "<?php echo SITEPATHFRONT; ?>survey-view-action-half.php",
                				type: "POST",
                				data: {allquestionids:allquestionids,allanswers:allanswers,surveyid:"<?php echo $surveyid?>",responseuserid:"<?php echo $_SESSION['campaign_user_id']?>"},
                				cache: false,
                				success: function(dataResult){
                				  
                				}
                			});
                }  
            <?php  }?>
                <?php  //} else { ?>
            //         if(threemultiplemail=="0")
            //         {
                          
    				    // var sessipaddrlastform = $("#sessipaddrlastform").val();
    				    // //alert(sessipaddrlastform)
    				    //  $.ajax({
            // 				url: "<?php //echo SITEPATHFRONT; ?>survey-view-action-half.php",
            // 				type: "POST",
            // 				data: {allquestionids:allquestionids,allanswers:allanswers,surveyid:"<?php echo $surveyid?>",responseuserid:sessipaddrlastform},
            // 				cache: false,
            // 				success: function(dataResult11){ 
            				  
            // 				}
            // 			});
                				
            //         }      
                        
                    <?php  //}?>    
        }
    /************************Auto submit code of form on both name and email id********************************/
    <?php if(isset($_GET['name']) && isset($_GET['email'])){?>
        $(".campsubbutton").hide();
        
        if($(".lform").css('display')=='block')
        {
        //  alert("hello");
        // }
        // if(lastformnumber==nextqid)
        // {
            check_fname();
            check_email();
            var allquestionids =$("#all_question_id").val();
            var allanswers = $("#all_answers").val();
            var fname = $("#fname").val().trim();
            var email = $("#email").val();
            var url_fname = $("#fname").val().trim();
            var url_email = $("#email").val();
            var url_company = $("#url_company").val();
            var url_designation = $("#url_designation").val();
            var url_source = $("#url_source").val();
            var uid = $("#uid").val();
            var sessipaddrlastform = $("#sessipaddrlastform").val();
            if(fname_error_message === false && email_error_message === false)
            {
                setTimeout(function() {
                
                // if(url_fname=="")
                // {
                //     var url_fname="test";
                // }
                // if(url_email=="")
                // {
                //     var url_email="test@gmail.com";
                // }
                
                    $.ajax({
            				url: "<?php echo SITEPATHFRONT; ?>survey-view-action.php",
            				type: "POST",
            				data: {url_source:url_source,allquestionids:allquestionids,allanswers:allanswers,fname:url_fname,email:url_email,surveyid:"<?php echo $surveyid?>",userid:<?php echo $user_id?>,sessipaddrlastform:sessipaddrlastform,sessfirstform:'<?php echo $_SESSION['campaign_user_id'];?>'},
            				cache: false,
            				success: function(dataResult){
            				   //alert(dataResult);
        		                window.location = '<?php echo SITEPATHFRONT;?>thank-you-survey/<?php echo $surveyid?>/'+url_email+'/'+url_fname+'';
        		             }
                	}); 
                
                }, 2000);
            }
            else
            {
                //alert(fname_error_message);
                //alert(email_error_message);
                if(fname_error_message==true || email_error_message==true)
                {
                    swal({
                      title: "Error..!",
                      icon: "error",
                      text: 'Invalid Email ID/Name',
                    }).then(function(){
                        window.location = "<?php echo SITEPATHFRONT."survey-list"; ?>";
                    });
                }
            }
            
        }
        
    <?php }?>
}

            
function nextprev(skipval)
{
    //////////////////////Next Prev Code For Change//////////////////////////
    var id = $('.item:visible').data('id');
    var prevId = $('.item:visible').data('id')-1;
    var nextId = $('.item:visible').data('id')+1;
    var totalquest=$("#totalquestion").val();
    var submitcnt = parseInt(totalquest)+parseInt(1);
    //alert(nextId);
    
    //////////////////////////////Required Code//////////////////////////////////////////
    var required = $("#required_"+nextId).val();
    if(required == null)
    {
        required="";
    }
    var qid22 = $("#qidthis_"+nextId).val();
    var setquestion12 = $("#all_question_id").val();
    var setquestionarray12 = setquestion12.split("♣");
   
    var nqid12 = qid22+'';
    var posq12 = setquestionarray12.indexOf(nqid12);
    
    if(posq12=="-1")
    {
        if(required=="No" || required=="")
        {
            $(".next").removeClass("disabled");
            if(id == totalquest){
                //$('.next').hide();
                $(".next").addClass("disabled");
            }
            if(prevId < totalquest){
                //$('.next').show();
                $(".next").removeClass("disabled");
            }
            if(prevId == 1 || prevId == 0){
                //$('.back').hide();
                $(".back").addClass("disabled");
            }
            
            if(nextId > 1){
                //$('.back').show();
                $(".back").removeClass("disabled");
            }
            if(nextId == submitcnt){
                //$('.next').hide();
                $(".next").addClass("disabled");
            }
        }
        else
        {
           $("#star_"+nextId).show();
           $(".next").addClass("disabled"); 
           if(nextId > 1){
                //$('.back').show();
                $(".back").removeClass("disabled");
            }
        }
    }
    else
    {
        $(".next").removeClass("disabled");
        if(id == totalquest){
                //$('.next').hide();
                $(".next").addClass("disabled");
            }
            if(prevId < totalquest){
                //$('.next').show();
                $(".next").removeClass("disabled");
            }
            if(prevId == 1 || prevId == 0){
                //$('.back').hide();
                $(".back").addClass("disabled");
            }
            
            if(nextId > 1){
                //$('.back').show();
                $(".back").removeClass("disabled");
            }
            if(nextId == submitcnt){
                //$('.next').hide();
                $(".next").addClass("disabled");
            }
    }
    
    
    
    ////////////////////////////////////////////////////////////////////////
    
    
    
    // if(id<totalquest)
    // {
    //      $("#lastsubmit").hide();
    // }
    //alert(nextids);
    var qtypename=$("#qtypename_"+nextId).val();
    if(qtypename=="Order")
    { //alert(nextId);
      setorderval(nextId);
    }
    ///////////////////////////////////////////////
    var required = $("#required_"+id).val();
    var nextrequired = $("#required_"+nextId).val();
    
    // if(nextrequired=="Yes")
    // {
    //     $(".next").addClass("disabled");
    // }
    // else
    // {
    //     $(".next").removeClass("disabled");
    // }
    //alert(nextId);
    // if(id==totalquest)
    // {
    //   progressBar(100,100);  
    // }
    if(skipval=="End")
    {
      progressBar(100,100);
       $(".scrollBar1").css("width", 100 + "%");
       //$(".scrollBar1 span").text(roundScroll);
    }
}  

function showchktextbox(qid,subid)
{
    var ischecked = $('#chkbox_'+subid).prop('checked');
    var chkotherval = $('#chkbox_'+subid).val();
    if(chkotherval=="Other" && ischecked==true)
    {
      $("#check_other_text_field_"+qid).show();
    }
    else
    {
        $("#check_other_text_field_"+qid).hide();
    }
    
}

function showradtextbox(qid)
{
    $("#radio_other_text_field_"+qid).show();
}

function setcheckboxquestans(curqno,subid,qid,ans,thisval)
{ 
    //alert(thisval);
    if(thisval=="Other")
    {
      var checkValue = thisval;
    }
    else
    {
       var checkValue = ans; 
    }
    var ischecked = $('#chkbox_'+subid).prop('checked');
    
    if($("#chkselectedval_"+qid).val()=="")
    {
       if(ischecked==true)
       {
          $("#chkselectedval_"+qid).val(checkValue);
       }
       else
       {
          var chkvalcurrent=$("#chkselectedval_"+qid).val();
          var chkt=chkvalcurrent.split("♦");
          var checkValue22 = checkValue+'';
          var poschk = chkt.indexOf(checkValue22);
          if(poschk!="-1")
          {
              chkt.splice(poschk, 1);
              var chktans = chkt+'';
              var test221 = chktans.replace(/,/g,"♦");
              $("#chkselectedval_"+qid).val(test221);
          }
          
       }
       
    }
    else
    {
       
       if(ischecked==true)
       {
          var prevans = $("#chkselectedval_"+qid).val();
          $("#chkselectedval_"+qid).val(prevans+"♦"+checkValue);
       }
       else
       {
          var chkvalcurrent=$("#chkselectedval_"+qid).val();
          //alert(chkvalcurrent);
          var chkt=chkvalcurrent.split("♦");
          var checkValue22 = checkValue+'';
          var poschk = chkt.indexOf(checkValue22);
          if(poschk!="-1")
          {
              chkt.splice(poschk, 1);
              var chktans = chkt+'';
              var test221 = chktans.replace(/,/g,"♦");
              $("#chkselectedval_"+qid).val(test221);
          }
          
       }
       
    }
    var chkselval=$("#chkselectedval_"+qid).val();
    if(chkselval!="")
    {
        $('#btn_next_other_check_'+qid).removeClass("action-btn-disabled");
    }
    else
    {
        $('#btn_next_other_check_'+qid).addClass("action-btn-disabled");
    }
}


//percentage

function progressBar(progressVal,totalPercentageVal = 100) {
    var strokeVal = (1.60 * 100) /  totalPercentageVal;
	var x = document.querySelector('.progress-circle-prog');
    x.style.strokeDasharray = progressVal * (strokeVal) + ' 999';
	var el = document.querySelector('.progress-text'); 
	var from = $('.progress-text').data('progress');
	//alert(progressVal);
	$('.progress-text').data('progress', Math.round(progressVal));
	var start = new Date().getTime();
  
	setTimeout(function() {
	    var now = (new Date().getTime()) - start;
	    var progress = now / 700;
	    var progress_round = Math.round(progressVal / totalPercentageVal * 100);
	    el.innerHTML = progress_round + '%';
	    if (progress < 1) setTimeout(arguments.callee, 10);
	}, 10);

}

progressBar(0,100);

var total_ques = $('#progress_count').val();

function SetAttempted(div,seq,qid,curqno) {
    //alert(div);
    var fflag=0;
var qtypename=$("#qtypename_"+curqno).val();
    
    if(qtypename=="Checkbox")
    {
        var chkval=$("#chkselectedval_"+qid).val();
        //alert(chkval);
        
        if(chkval=="")
         {
            $(div).parent().parent().attr('isAttempted', '0');
            fflag=0;
            $("#chkflag_"+qid).val("0");
         }
         else
         {
            var splitchkval = chkval.split("♦");
            var chkf = $("#chkflag_"+qid).val();
            //alert(splitchkval.length);
            //alert(fflag);
            if(splitchkval.length==1 && fflag==0 && chkf==0)
            {
                $(div).parent().parent().attr('isAttempted', '1');
                fflag=1;
                $("#chkflag_"+qid).val("1");
            }
         }
         
         checkAttempt(seq,qid,curqno);
    }
    else if(qtypename=="Mrating")
    {
        var mratingcnt=$("#mrating_cnt_"+qid).val();
        var prevans1 = $("#mratingselectedval_"+qid).val();
        var splitratval = prevans1.split("♦");
        //if(mratingcnt==splitratval.length)
        if(prevans1!="")
        {
          $(div).parent().parent().attr('isAttempted', '1');
          checkAttempt(seq,qid,curqno);
            
        }
    }
    else if(qtypename=="Matrix")
    {
         var selval123=$("#matrixselectedval_"+qid).val();
         //alert(selval123);
         if(selval123=="")
         {
            // alert("fdf0");
            $(div).parent().parent().attr('isAttempted', '0'); 
         }
         else
         {
            $(div).parent().parent().attr('isAttempted', '1');
         }
         checkAttempt(seq,qid,curqno);
         
    }
    else
    {
        $(div).parent().parent().attr('isAttempted', '1');
        checkAttempt(seq,qid,curqno);
    }

}

var chkcount;
function checkAttempt(seq,qid,curqno){
    //alert(seq);
    
    var attemptedCount = 0;
    
    $('#divQstn div').each(function (i, ele) {
        // var qId = $(this).attr("qId");
         var isAttempted = $(this).attr("isAttempted");
        // alert(isAttempted);
         var c = 1;
            if(isAttempted=="1")
            {
                attemptedCount ++;
                //attemptedCount=seq;
            }
            

    });
    var totalquest=$("#totalquestion").val();
    
    var footer_tagline = $("#footer_tagline").val();
     
     if(curqno==totalquest)
     {
        //$(".offer-txt").hide(); 
         if(footer_tagline!=""){
            $(".offer-txt").text("This information will be used to send you "+footer_tagline+" Report");
           
        }
       progressBar(100,100);  
       $(".scrollBar1").css("width", 100 + "%");
     }
     else
     {
    // // alert(totalquest);
    // // alert(attemptedCount);
    // if(totalquest==attemptedCount)
    // {
    //      $("#lastsubmit").show();
    // }
   // alert(attemptedCount);
    
          var average1 = 100/total_ques;
          
          //var average1 = Math.round(average1);
           //var average1 = average1.toFixed(0);
            //alert(attemptedCount);
           
           //Footer tag line counts
           var remaining_attempt = total_ques-attemptedCount;
           if(remaining_attempt==1){
               //$(".offer-txt").hide(); 
               if(footer_tagline!=""){
                    $(".offer-txt").text("Almost there to download $4000 worth of "+footer_tagline+" Report");
                //    exit;
               }
           }else{
                $("#total_que_to_go").text(remaining_attempt);
           }
         //Horizal Progree Bar
              var scrollPercent = average1*attemptedCount;
              var roundScroll = Math.round(scrollPercent);
              //alert(roundScroll);
              // For scrollbar 1
              $(".scrollBar1").css("width", scrollPercent + "%");
              $(".scrollBar1 span").text(roundScroll);
        // End Horizantal Progress        
            
            if(average1*attemptedCount>=100){
              progressBar(100,100);
              $(".scrollBar1").css("width", 100 + "%");
              //$("#lastsubmitform").show();
              //$("#footerdisplay").hide();
              }else{
                  
                  progressBar(parseInt(average1*attemptedCount),100);
              }
     }        
              
}

var mratingcounter=0;
function setmultipleratingquestans(title,curqno,subid,qid,ans)
{
    //alert(ans);
    //alert($("#mrating_"+subid).val());
    //alert(orderids);
    var opttype1 = $("#mratingoptiontype_"+curqno).val();
    var mratingcnt=$("#mrating_cnt_"+qid).val();
    var mratingValue = title+"◘"+ans;
    //alert(orderids);
    
    if(ans!="")
    {
        if($("#mratingselectedsubid_"+qid).val()=="")
        {
            $("#mratingselectedsubidvalue_"+qid).val(ans);
            $("#mratingselectedsubid_"+qid).val(subid);
        }
        else
        {
           var prevans1 = $("#mratingselectedsubidvalue_"+qid).val();
           var presubid1 = $("#mratingselectedsubid_"+qid).val();
           var splitsubid33 = presubid1.split(",");
           var subid33 = subid+'';
           var poschk33 = splitsubid33.indexOf(subid33);
           
           if(poschk33=="-1")
           {
               $("#mratingselectedsubidvalue_"+qid).val(prevans1+","+ans);
               $("#mratingselectedsubid_"+qid).val(presubid1+","+subid);
           }
           else
           {
              var splitsubidval33 = prevans1.split(",");
              splitsubidval33.splice(poschk33, 1,ans);
              var newval1 = splitsubidval33;
              $("#mratingselectedsubidvalue_"+qid).val(newval1);
              
              var splitsubid333 = presubid1.split(",");
              splitsubid333.splice(poschk33, 1,subid);
              var newval = splitsubid333;
              $("#mratingselectedsubid_"+qid).val(newval);
           }
           
        }
    }
    else
    {
        if($("#mratingselectedsubid_"+qid).val()!="")
        { 
           var prevans12 = $("#mratingselectedsubidvalue_"+qid).val();
           var presubid12 = $("#mratingselectedsubid_"+qid).val();
           var splitsubid332 = presubid12.split(",");
           var subid332 = subid+'';
           var poschk332 = splitsubid332.indexOf(subid332);
           
           if(poschk33!="-1")
           {
              var splitsubidval332 = prevans12.split(",");
              splitsubidval332.splice(poschk332, 1);
              var newval12 = splitsubidval332;
              $("#mratingselectedsubidvalue_"+qid).val(newval12);
              
              var splitsubid3332 = presubid12.split(",");
              splitsubid3332.splice(poschk332, 1);
              var newval22 = splitsubid3332;
              $("#mratingselectedsubid_"+qid).val(newval22);
                
           }
        }
    }
    //splice(index,how many elements to remove)
    //alert(orderids);
    //var mratingarraylength = orderids.length;
    
    
    //if(mratingcnt==mratingarraylength)
    // if(mratingarraylength>=1)
    // {
    //   $('#btn_next_other_mrating_'+qid).removeClass("action-btn-disabled");
    // }
    
    if($("#mratingselectedsubid_"+qid).val()!="")
    {
        var mratprevans = $("#mratingselectedsubidvalue_"+qid).val();
        var mratpresubid = $("#mratingselectedsubid_"+qid).val();
        var splitmratsubid = mratpresubid.split(",");
        var splitmratsubidvalue = mratprevans.split(",");
        var fullval="";
        if(splitmratsubid.length>0)
        {
            for($kt=0;$kt<splitmratsubid.length;$kt++)
            {
                fullval+=splitmratsubid[$kt]+"◘"+splitmratsubidvalue[$kt]+"♦";
            }
        }
        
        //stval=fullval.trim("♦");
        var stval=fullval.substring(0, fullval.length - 1);
        $("#mratingselectedval_"+qid).val(stval);
        $('#rating_error_message_'+qid).hide();
        $('#rating_error_message_'+qid).html("");
        $('#btn_next_other_mrating_'+qid).removeClass("action-btn-disabled");
        
    }
    else
    {
        $("#mratingselectedval_"+qid).val("");
        $('#rating_error_message_'+qid).show();
        if(opttype1!="textbox")
        {
            $('#rating_error_message_'+qid).html("Select Rating Options");
        }
        else
        {
            $('#rating_error_message_'+qid).html("Enter Rating Options");
        }
        $('#btn_next_other_mrating_'+qid).addClass("action-btn-disabled");
    } 
    
}

function checksequence(subqueid,qid,curval,srno)
{
    var seq = $('#mrating_'+subqueid).val();
    var opttype = $("#mratingoptiontype_"+srno).val();
    var presubid12 = $("#mratingselectedsubid_"+qid).val();
    //var splitsubid332 = presubid12.split(",");
    //if(seq == '')
    //var prevans1 = $("#mratingselectedval_"+qid).val();
     //var orderarraylength = orderids.length;
     //alert(orderarraylength);
     //alert(seq);
     //alert(prevans1);
    // alert(ratcounter);
    if(seq == '' && presubid12 == '')
    {
        $('#rating_error_message_'+qid).show();
        if(opttype!="textbox")
        {
            $('#rating_error_message_'+qid).html("Select Rating Options");
        }
        else
        {
            $('#rating_error_message_'+qid).html("Enter Rating Options");
        }
        $('#btn_next_other_mrating_'+qid).addClass("action-btn-disabled");
    
    }
    else
    {
        //alert("dd");
        $('#rating_error_message_'+qid).hide();
        $('#rating_error_message_'+qid).html("");
        $('#btn_next_other_mrating_'+qid).removeClass("action-btn-disabled");
    } 
                
} 


function setorderval(currsrno)
{
      //alert(currsrno);
      var lstqstid=$("#sub_qst_id_"+currsrno).val();
      $("#list_"+lstqstid).sortable({ opacity: 0.8, cursor: 'move',animation: 150, update: function() {
        var qstid=$("#sub_qst_id_"+currsrno).val();
        //alert(qstid);
        var order = $(this).sortable("serialize") + '&update=update&qstid='+qstid;
        //alert(order);
        
        $.post("<?php echo SITEPATHFRONT;?>update-subquestion-sequence.php", order, function(theResponse){
               // alert(theResponse);
                $("#allsubval_"+qstid).val(theResponse);
                var subidwithrankallval=theResponse.split("♦");
                for(var i=0;i<subidwithrankallval.length;i++)
                {
                    var singlewithrank=subidwithrankallval[i].split("◘");
                    //alert(singlewithrank[0]);
                    $("#num_"+singlewithrank[0]).text(singlewithrank[1]);
                }
                //num_  3218◘1♦3219◘2♦3220◘3♦3221◘4♦3222◘5♦3223◘6
                //allsubval_
                //allsubid_
          });  
          
        }         
    });
}
    

function setmatrixquestans(curqno,qid,chkid,thisval,matinputtype,subid)
{
    //alert(chkid);
    var matrixValue = thisval; 
    if(matinputtype=="checkbox")
    {
        var ischecked = $('#matrixchk_'+chkid).prop('checked');
        
        if($("#matrixselectedval_"+qid).val()=="")
        {
           if(ischecked==true)
           {
              $("#matrixselectedval_"+qid).val(matrixValue);
              
           }
           else
           {
              var chkvalcurrent=$("#matrixselectedval_"+qid).val();
              var chkt=chkvalcurrent.split("♦");
              var checkValue22 = matrixValue+'';
              var poschk = chkt.indexOf(checkValue22);
              if(poschk!="-1")
              {
                  chkt.splice(poschk, 1);
                  var chktans = chkt+'';
                  var test221 = chktans.replace(/,/g,"♦");
                  $("#matrixselectedval_"+qid).val(test221);
              }
              
           }
           
        }
        else
        {
           
           if(ischecked==true)
           {
              var prevans = $("#matrixselectedval_"+qid).val();
              $("#matrixselectedval_"+qid).val(prevans+"♦"+matrixValue);
           }
           else
           {
              var chkvalcurrent=$("#matrixselectedval_"+qid).val();
              //alert(chkvalcurrent);
              var chkt=chkvalcurrent.split("♦");
              var checkValue22 = matrixValue+'';
              var poschk = chkt.indexOf(checkValue22);
              if(poschk!="-1")
              {
                  chkt.splice(poschk, 1);
                  var chktans = chkt+'';
                  var test221 = chktans.replace(/,/g,"♦");
                  $("#matrixselectedval_"+qid).val(test221);
              }
              
           }
           
        }
    }
    
    if(matinputtype=="radio")
    {
        var ischecked = $('#matrixchk_'+chkid).prop('checked');
        var matval=$("#matrixselectedval_"+qid).val();
        //alert(ischecked);
        if($("#matrixselectedval_"+qid).val()=="")
        {
          $("#matrixselectedval_"+qid).val(matrixValue);
          $("#matrixselectedradioid_"+qid).val(subid);
        }
        else
        {
           var radpost=matval.search(subid);
           //alert(radpost);
           if(radpost=="-1")
           {
              var prevans = $("#matrixselectedval_"+qid).val();
              var prevsubid = $("#matrixselectedradioid_"+qid).val();
              $("#matrixselectedval_"+qid).val(prevans+"♦"+matrixValue);
              $("#matrixselectedradioid_"+qid).val(prevsubid+"♦"+subid);
           }
           else
           {
              var chkvalid=$("#matrixselectedradioid_"+qid).val();
              var chktid=chkvalid.split("♦");
              var checkValue222 = subid+'';
              var poschk22 = chktid.indexOf(checkValue222);
              
              var chkvalcurrent=$("#matrixselectedval_"+qid).val();
              //alert(chkvalcurrent);
              var chkt=chkvalcurrent.split("♦");
              var checkValue22 = matrixValue+'';
              var poschk = chkt.indexOf(checkValue22);
              //alert(poschk22);
              if(poschk22!="-1")
              {
                  chkt.splice(poschk22, 1,matrixValue);
                  var chktans = chkt+'';
                  var test221 = chktans.replace(/,/g,"♦");
                  $("#matrixselectedval_"+qid).val(test221);
              }
           }
        }
    }
    
    var matselval=$("#matrixselectedval_"+qid).val();
    //alert(matselval);
    if(matselval!="")
    {
        $('#btn_next_other_matrix_'+qid).removeClass("action-btn-disabled");
    }
    else
    {
        $('#btn_next_other_matrix_'+qid).addClass("action-btn-disabled");
    }
}



</script>
<script type="text/javascript"> 
$(document).ready(function()
{
    var mobile = (/iphone|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));  
    if (mobile) { 
        $('input[type="text"], textarea').focusin(function()
        {
           $('#footerdisplay').hide();
        });
        $('input[type="text"], textarea').focusout(function(){
            $('#footerdisplay').show();
        });
         
    } 
    else 
    { 
       $('#footerdisplay').show();
    }
});
</script> 

<script>
    // Scroll bar for multiple options

$(document).ready(function(){
    
          //  Radio Questions Type
            radio_scroll = [];
            $("input[name='arr_count_rdo']").each(function() {
                radio_scroll.push($(this).val());
            });
    
            var radio_scroll=  Math.max.apply(Math,radio_scroll);
        
         // Checkbox Questions Type
            checkbox_scroll = [];
            $("input[name='chk_sub_count']").each(function() {
                checkbox_scroll.push($(this).val());
            });
            var checkbox_scroll=  Math.max.apply(Math,checkbox_scroll);
           // alert(checkbox_scroll);
            // if(checkbox_scroll >= 11)
            // {
            //     $('.sub_points_down_chk').css('height','280px');
            //     $('.sub_points_down_chk').css('overflow-y','scroll');
            // }
        
        // Ranking Questions Type
            ranking_scroll = [];
            $("input[name='rank_order_count']").each(function() {
                ranking_scroll.push($(this).val());
            });
            var ranking_scroll=  Math.max.apply(Math,ranking_scroll);
            
          
        // Dropdown Questions Type
            dropdown_scroll = [];
            $("input[name='dropdown-count']").each(function() {
                dropdown_scroll.push($(this).val());
            });
            var dropdown_scroll=  Math.max.apply(Math,dropdown_scroll);    
            
            
               
        // Matrix Questions Type
            matrix_scroll = [];
            $("input[name='matrix_count']").each(function() {
                matrix_scroll.push($(this).val());
            });
            var matrix_scroll=  Math.max.apply(Math,matrix_scroll);  
            
        // mobile view scroll
        
        $(document).load($(window).bind("resize", checkPosition()));
            function checkPosition()
            {
                if($(window).width() <=350 || $(window).width() <=630)
                {
                   if(radio_scroll >= 5)
                    {
                        $('.sub_points_down').attr('style', 'height: 330px !important; overflow-y: scroll');
                    }
                    if(checkbox_scroll >= 5)
                    {
                    // alert(checkbox_scroll);   
                        $('.sub_points_down_chk').attr('style', 'height: 330px !important; overflow-y: scroll');
                    }
                    if(ranking_scroll >= 5)
                    {
                        $('.sub_points_down').attr('style', 'height: 260px !important; overflow-y: scroll');
                    }
                    if(dropdown_scroll >= 5)
                    {
                        $('.sub_points_down').attr('style', 'height: 260px !important; overflow-y: scroll');
                    }
                    
                    if(matrix_scroll >= 6)
                    {
                        $('.sub_points_down').attr('style', 'height: 260px !important; overflow-y: scroll');
                    }
                }
                
                if($(window).width() <=280){
                    if(radio_scroll >= 5)
                    {
                        $('.sub_points_down').attr('style', 'height: 270px !important; overflow-y: scroll');
                    }
                    if(checkbox_scroll >= 5)
                    {
                    // alert(checkbox_scroll);   
                        $('.sub_points_down_chk').attr('style', 'height: 260px !important; overflow-y: scroll');
                    }
                    if(ranking_scroll >= 5)
                    {
                        $('.sub_points_down').attr('style', 'height: 260px !important; overflow-y: scroll');
                    }
                    if(dropdown_scroll >= 5)
                    {
                        $('.sub_points_down').attr('style', 'height: 260px !important; overflow-y: scroll');
                    }
                    if(matrix_scroll >= 6)
                    {
                        $('.sub_points_down').attr('style', 'height: 260px !important; overflow-y: scroll');
                    }
                }
                if($(window).width()==320){
                    if(radio_scroll >= 5)
                    {
                        $('.sub_points_down').attr('style', 'height: 250px !important; overflow-y: scroll');
                    }
                    if(checkbox_scroll >= 5)
                    {
                    // alert(checkbox_scroll);   
                        $('.sub_points_down_chk').attr('style', 'height: 250px !important; overflow-y: scroll');
                    }
                    if(ranking_scroll >= 5)
                    {
                        $('.sub_points_down').attr('style', 'height: 250px !important; overflow-y: scroll');
                    }
                    if(dropdown_scroll >= 5)
                    {
                        $('.sub_points_down').attr('style', 'height: 250px !important; overflow-y: scroll');
                    }
                    if(matrix_scroll >= 6)
                    {
                        $('.sub_points_down').attr('style', 'height: 260px !important; overflow-y: scroll');
                    }
                }
                
                // if($(window).width() <=360 || $(window).width() <=380)
                // {
                //     $('.sub_points_rank').attr('style', 'height: 250px !important');
                //     $('.radio-scroll-vt').css( 'height','50rem');
                // }
            }
            
            
            
            
   
});

function close_survey()
{
    // code for close modal popup message
           var qids=$("#all_question_id").val();
           var setqnos=$("#setqno").val();
           var aqcnt=$("#aqcnt").val();
           if(qids=="" && setqnos<="3")
           {
               $("#closetext").text("We understand that your time is valuable. That's why we've kept the survey short and sweet, with only 80 seconds to complete it. Can we help you with anything?");
           
               $("#intermediatecont").show();
               $("#lastcont").hide();
           }
           if(qids!="" && setqnos>="4" && setqnos<aqcnt)
           {
               $("#closetext").text("The survey is nearing completion. Your every input will be valuable in shaping the outcomes involving the market dynamics. Click continue to finish the survey.");
           
               $("#intermediatecont").show();
               $("#lastcont").hide();
           }
           if(qids!="" && setqnos==aqcnt)
           {
                //$("#closetext").text("We value your time & effort and respect your decision to be anonymous. Thank you for your support!!");
                $("#closetext").text("The survey is nearing completion. Your every input will be valuable in shaping the outcomes involving the market dynamics. Click continue to finish the survey.");
           
                $("#intermediatecont").show();
                $("#lastcont").hide();
                //$(".btn-close").hide();
           }
           if(qids!="" && setqnos<="3")
           {
               $("#closetext").text("We understand that your time is valuable. That's why we've kept the survey short and sweet, with only 80 seconds to complete it. Can we help you with anything?");
           
               $("#intermediatecont").show();
               $("#lastcont").hide();
           }
    // end code for close modal popup message
        //  var allquestionids =$("#all_question_id").val();
        //  var allanswers = $("#all_answers").val();
        //  if(allquestionids!="" || allanswers!="")
        //  {
        //  <?php //if($_SESSION['response_user_id']!=""){?>
                   
        //             $.ajax({
        //     				url: "<?php //echo SITEPATHFRONT; ?>survey-view-action-half.php",
        //     				type: "POST",
        //     				data: {allquestionids:allquestionids,allanswers:allanswers,surveyid:"<?php echo $surveyid?>",responseuserid:"<?php echo $_SESSION['response_user_id']?>"},
        //     				cache: false,
        //     				beforeSend: function(){
        //                             // Show image container
        //                             $('#span_loader1').show();
        //                     },
        //     				success: function(dataResult){
        //     				    $("#closefeedback").modal({
        //                                     backdrop: 'static',
        //                                     keyboard: false, 
        //                                     show: false
        //                             }); 
        //                         $("#closefeedback").modal("show");
        //     				  //window.location = '<?php //echo SITEPATHFRONT;?>survey-list';
        //     				}
        //     			});
        //      <?php // }?>
        //      <?php //if(isset($_GET['name']) && isset($_GET['email'])){?>
                   
        //             $.ajax({
        //     				url: "<?php //echo SITEPATHFRONT; ?>survey-view-action-half.php",
        //     				type: "POST",
        //     				data: {allquestionids:allquestionids,allanswers:allanswers,surveyid:"<?php //echo $surveyid?>",responseuserid:"<?php //echo $_SESSION['campaign_user_id']?>"},
        //     				cache: false,
        //     				beforeSend: function(){
        //                             // Show image container
        //                             $('#span_loader1').show();
        //                     },
        //     				success: function(dataResult){
        //     				    $("#closefeedback").modal({
        //                                     backdrop: 'static',
        //                                     keyboard: false, 
        //                                     show: false
        //                             }); 
        //                         $("#closefeedback").modal("show");
        //     				  //window.location = '<?php //echo SITEPATHFRONT;?>survey-list';
        //     				}
        //     			});
        //      <?php // }?>
        //     <?php // } else { ?>
                
        //             //var allquestionids =$("#all_question_id").val();
        //             //var allanswers = $("#all_answers").val();
                       
        //     				    // var sessipaddrlastform = $("#sessipaddrlastform").val();
        //     				    //  $.ajax({
        //             // 				url: "<?php //echo SITEPATHFRONT; ?>survey-view-action-half.php",
        //             // 				type: "POST",
        //             // 				data: {allquestionids:allquestionids,allanswers:allanswers,surveyid:"<?php echo $surveyid?>",responseuserid:sessipaddrlastform},
        //             // 				cache: false,
        //             // 				beforeSend: function(){
        //             //                 // Show image container
        //             //                 $('#span_loader1').show();
        //             //                 },
        //             // 				success: function(dataResult11){
        //             // 				  window.location = '<?php //echo SITEPATHFRONT;?>survey-list';
        //             // 				}
        //             // 			});
            			
        //     <?php // }?>
        //  }
        //  else
        //  {
           <?php //if($_SESSION['response_user_id']!="" || $_SESSION['campaign_user_id']!=""){?>
            //  $("#closefeedback").modal({
            //             backdrop: 'static',
            //             keyboard: false, 
            //             show: false
            //     }); 
            // $("#closefeedback").modal("show");
            <?php //} else {?>
            
            $("#closemessageoncross").modal({
                        backdrop: 'static',
                        keyboard: false, 
                        show: false
                }); 
            $("#closemessageoncross").modal("show");
            //window.location = '<?php //echo SITEPATHFRONT;?>survey-list';
            <?php //}?>
        //      //window.location = '<?php //echo SITEPATHFRONT;?>survey-list';
        //  }
}

function restrictAlphabets(e) 
{
     var x = e.which || e.keycode;
     if ((x >= 48 && x <= 57))
         return true;
     else
         return false;
}

</script>
<script>
    $(document).ready(function(){ 
       
                var width = screen.width;
                
                if(width>=1201)
                { 
                    $('.scrllcss').css({"height": "152px", "overflow-y": "scroll", "overflow-x": "hidden"});
                }
                if(width<=1200 && width>=1025)
                {
                     $('.scrllcss').css({"height": "30px", "overflow-y": "scroll", "overflow-x": "hidden"});
                }
                if(width<=1024 && width>=769)
                {
                     $('.scrllcss').css({"height": "200px", "overflow-y": "scroll", "overflow-x": "hidden"});
                }
                if(width>=481 && width<=768)
                {
                     $('.scrllcss').css({"height": "216px", "overflow-y": "scroll", "overflow-x": "hidden"});
                }
                if(width>=320 && width<=480)
                {
                    $('.scrllcss').css({"height": "180px", "overflow-y": "scroll", "overflow-x": "hidden"});
                }
                if(width>=260 && width<=319)
                {
                    $('.scrllcss').css({"height": "160px", "overflow-y": "scroll", "overflow-x": "hidden"});
                    $('.scrllcssboolean').css({"height": "143px", "overflow-y": "scroll", "overflow-x": "hidden"});
                }
                if(width==320)
                {
                     $('.scrllcssboolean').css({"height": "143px", "overflow-y": "scroll", "overflow-x": "hidden"});
                }
});
</script>
<script>
 $(document).ready(function(){    
    $("#lastcont").click(function(){
                //all_question_id all_answers
                //check_fname();
                //check_email();
                <?php if($url=="https://www.avirasurveys.com/survey-view/d2706c17-422a-4521-9d02-a642e01a83ac/survey-to-analyze-the-needs-and-requirements-of-an-organization-looking-for-cloud-communication-platform." || $url=="https://www.avirasurveys.com/survey-view/e0c0fb50-fa99-4858-9f07-397c9d35b21b/sme's-perspective--to-understand-the-usage-trend-of-services-like-internet,-data-,voice-,cloud,-and-cybersecurity." || $url=="https://www.avirasurveys.com/survey-view/79f4d606-c1de-4441-aab0-979270360e1c/a-survey-on-criteria's-to-consider-while-vendor-selection-for-cloud-communication-platform."){?>
                    check_phone();
                var phoneno = $("#phone").val();
                <?php } else {?>
                 var phoneno = "";
                <?php }?>
                var allquestionids =$("#all_question_id").val();
                var allanswers = $("#all_answers").val();
                var fname = $("#fname").val().trim();
                var email = $("#email").val();
                var url_fname = $("#url_fname").val();
                var url_email = $("#url_email").val();
                var url_company = $("#url_company").val();
                var url_designation = $("#url_designation").val();
                var url_source = $("#url_source").val();
                var uid = $("#uid").val();
                var sessipaddrlastform = $("#sessipaddrlastform").val();
                <?php if(isset($_GET['name']) || isset($_GET['email']) || isset($_GET['uid'])){?>
                    if(fname=="")
                    {
                        var fname="test";
                    }
                    if(email=="")
                    {
                        var email="test@gmail.com";
                    }
                      $.ajax({
                				url: "<?php echo SITEPATHFRONT; ?>survey-view-action.php",
                				type: "POST",
                				data: {uid:uid,url_source:url_source,allquestionids:allquestionids,allanswers:allanswers,fname:fname,email:email,surveyid:"<?php echo $surveyid?>",userid:<?php echo $user_id?>,sessipaddrlastform:sessipaddrlastform,sessfirstform:'<?php echo $_SESSION['campaign_user_id'];?>'},
                				cache: false,
                				beforeSend: function(){
                                    // Show image container
                                    $('#span_loader1').show();
                                    $("#lastcont").css({"pointer-events":"none","opacity":"0.4"});
                                },
                				success: function(dataResult){
                				   // alert(dataResult);
                				   //alert('<?php echo SITEPATHFRONT;?>thank-you-survey/<?php echo $surveyid?>/'+url_email+'/'+url_fname+'');
//**Comment by vinod on 19/01/23	
                                //   if(uid!="")
                				//   {
                				//       var userdetail=dataResult.split("*");
                				//       var url_email=userdetail[0];
                				//       var url_fname=userdetail[1];
                				//   }
                				    //$('#span_loader').hide();
                				    //alert(dataResult);
                				    //$('#span_loader').hide();
                				    //$('.que_section').hide();
                                   // $("#footerdisplay").hide();
            		               //$('.end').slideDown(200);
            		               //$("#thankyoustopunload").val("Full");
            		               //alert(url_email);
            		               //alert(url_fname);
            		               <?php if(isset($_GET['name']) && isset($_GET['email'])){?>
            		                   //alert("url");
            		               window.location = '<?php echo SITEPATHFRONT;?>thank-you-survey/<?php echo $surveyid?>/'+url_email+'/'+url_fname+'';
            		               <?php }else  {?>
            		                   
            		                     window.location = '<?php echo SITEPATHFRONT;?>thank-you-survey/<?php echo $surveyid?>/'+email+'/'+fname+'';
            		                   
            		               <?php }?>
                				}
                			}); 
                    
                <?php } else {?>
                    <?php if($_SESSION['response_user_id']==""){?>
                            if(fname=="")
                            {
                                var fname="test";
                            }
                            if(email=="")
                            {
                                var email="test@gmail.com";
                            }
                        
                            $.ajax({
                				url: "<?php echo SITEPATHFRONT; ?>survey-view-action.php",
                				type: "POST",
                				data: {uid:uid,url_source:url_source,phone:phoneno,allquestionids:allquestionids,allanswers:allanswers,fname:fname,email:email,surveyid:"<?php echo $surveyid?>",userid:<?php echo $user_id?>,sessipaddrlastform:sessipaddrlastform,sessfirstform:'<?php echo $_SESSION['response_user_id'];?>'},
                				cache: false,
                				beforeSend: function(){
                                    // Show image container
                                    $('#span_loader1').show();
                                    $("#lastcont").css({"pointer-events":"none","opacity":"0.4"});
                                },
                				success: function(dataResult){
                				   // alert(dataResult);
                				    //$('#span_loader').hide();
                				    //$('.que_section').hide();
                                   // $("#footerdisplay").hide();
            		               //$('.end').slideDown(200);
            		               //$("#thankyoustopunload").val("Full");
            		               window.location = '<?php echo SITEPATHFRONT;?>thank-you-survey/<?php echo $surveyid?>/'+email+'/'+fname+'';
                				}
                			});
                        
                    <?php }else {?>
                    
                    if(fname=="" && email=="")
                    {
                        var fname = "<?php echo $_SESSION['first_form_fname'];?>";
                        var email = "<?php echo $_SESSION['first_form_email'];?>";
                    }
                    
                       $.ajax({
                				url: "<?php echo SITEPATHFRONT; ?>survey-view-action.php",
                				type: "POST",
                				data: {uid:uid,url_source:url_source,allquestionids:allquestionids,allanswers:allanswers,fname:fname,email:email,surveyid:"<?php echo $surveyid?>",userid:<?php echo $user_id?>,sessipaddrlastform:sessipaddrlastform,sessfirstform:'<?php echo $_SESSION['response_user_id'];?>'},
                				cache: false,
                				beforeSend: function(){
                                    // Show image container
                                    $('#span_loader1').show();
                                    $("#lastcont").css({"pointer-events":"none","opacity":"0.4"});
                                },
                				success: function(dataResult){
                				    //alert(dataResult);
                				    //$('#span_loader').hide();
                				    //$('.que_section').hide();
                                   // $("#footerdisplay").hide();
            		               //$('.end').slideDown(200);
            		               //$("#thankyoustopunload").val("Full");
            		               window.location = '<?php echo SITEPATHFRONT;?>thank-you-survey/<?php echo $surveyid?>/'+email+'/'+fname+'';
                				}
                			}); 
                    <?php }?>
                <?php }?>
            });
    });
    
    
    function check_fname(){
                var fname= $("#fname").val().trim();
                
                if(fname == '')
                {
                    $("#fname_error_message").show();
                    $("#fname_error_message").html("Please Enter Fullname");
                    $("#fname").css("border","2px solid #F90A0A");
                    fname_error_message = true;
                }
                else
                {
                    $("#fname_error_message").hide();
                    $("#fname").css("border","2px solid #34F458");
                    fname_error_message = false;
                } 
                
            }
            
            function check_email(){
                var pattern = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                var email= $("#email").val();
                if(email == '')
                {
                    $("#email_error_message").show();
                    $("#email_error_message").html("Please Enter Email");
                    $("#email").css("border","2px solid #F90A0A");
                    email_error_message = true;
                }
                else
                {
                    if(pattern.test(email))
                    {
                        $("#email_error_message").hide();
                        $("#email").css("border","2px solid #34F458");
                        email_error_message = false;
                        
                    } else {
                        $("#email_error_message").show();
                        $("#email_error_message").html("Invalid Email");
                        $("#email").css("border","2px solid #F90A0A");
                        email_error_message = true;
                    }
                }    
                
            }
</script>