<?php 
//print_r($_SERVER);
$scriptname = $_SERVER['SCRIPT_NAME'];
$pageurlall=explode("/",$scriptname);
$pageurl=$pageurlall[2];
include('common-header.php');

if(isset($_GET['surveyid']))
{
$_SESSION['survey_sess_id']=$_GET['surveyid'];
}
$userid=$_SESSION['ifg_admin']['client_id'];
require_once("classes/cls-user.php");

require_once("classes/cls-survey.php");
$obj_survey = new Survey();
$conn = $obj_survey->getConnectionObj();


$obj_user = new User();
$fields_user = "*";
$condition = "`tbl_client_user`.`client_id` = '".$userid."'";
$user_details = $obj_user->getUserclientDetails($fields_user, $condition,'','', 0);
 foreach($user_details as $user){
     $fname = $user['fname'];
     $lname = $user['lname'];
     $profile_img = $user['profile_image'];
 }

?>
<link rel="icon" href="<?php echo SITEPATHFRONT; ?>images/Avira-Survey-Logo_Favicon.png">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>

<style>
    .survtitle{
        font-size: 1.6rem;color: #333e48;font-weight:500;
    }
    [data-tooltip] {
    display: inline-block;
    position: relative;
    cursor: help;
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
    min-width: 100px;
    text-align: center;
    border-radius: 4px;
}
/* Dynamic horizontal centering */
[data-tooltip-position="top"]:before,
[data-tooltip-position="bottom"]:before {
    left: 58%;
    width:115%;
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
}

.disabled {
        opacity: 0.5;
        cursor: not-allowed;
        text-decoration:none!important;
    }
    .h-logo{
        width:3rem;
    }
</style>

  <style>
     /*PRELOADING------------ */
#overlayer_f {
  width:100%;
  height:230%;  
  position:absolute;
  z-index:1;
  background:rgba(3,19,141,.82);
  top: 0;
  display:none;
}
.loader {
  display: inline-block;
  /*width: 60px;*/
  /*height: 60px;*/
  position: absolute;
  z-index:3;
  /*border: 4px solid #Fff;*/
  top: 50%;
  left: 50%;
  /*animation: loader 2s infinite ease;*/
}
.loader img{
    width: 70px;
}

.loader-inner {
  vertical-align: top;
  display: inline-block;
  width: 100%;
  background-color: #fff;
  animation: loader-inner 2s infinite ease-in;
}

@keyframes loader {
  0% {
    transform: rotate(0deg);
  }
  
  25% {
    transform: rotate(180deg);
  }
  
  50% {
    transform: rotate(180deg);
  }
  
  75% {
    transform: rotate(360deg);
  }
  
  100% {
    transform: rotate(360deg);
  }
}

@keyframes loader-inner {
  0% {
    height: 0%;
  }
  
  25% {
    height: 0%;
  }
  
  50% {
    height: 100%;
  }
  
  75% {
    height: 100%;
  }
  
  100% {
    height: 0%;
  }
}
</style>
<!--<div id="overlayer_f"></div>-->
<!--<span class="loader">-->
<!-- <img src="<?php echo SITEPATH; ?>images/page-loading.gif">-->
<!--</span> -->
       <div class="navbar-wrapper d-none">
            <nav class="navbar navbar-inverse">
              <div class="container-fluid">
                <div class="navbar-header d-flex">
                    <a href="#" class="navbar-brand" id="sidebar-toggle"><i class="fa fa-bars"></i></a>
                </div>
                <!--<div class="header-rigth">-->
                <!--    <ul class="list-unstyled right-nav-menu">-->
                <!--        <li class="dropdown" style="float:right;">-->
                <!--            <div class="user-profile">-->
                <!--                <a href="" data-bs-toggle="dropdown" aria-expanded="false" class="dropdown-toggle p-0" id="dropdownMenuButton2">-->
                <!--                    <img src="images/1.png" alt="user-pic" class="img-fluid">-->
                <!--                </a>-->
                <!--                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">-->
                <!--                    <li><a class="dropdown-item" href="#">Edit</a></li>-->
                <!--                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>-->
                <!--                </ul>-->
                <!--            </div>-->
                <!--        </li>-->
                <!--    </ul>-->
                <!--</div>-->
              </div>
            </nav>
        </div>
        
        <div class="top-header">
            <div class="container-fluid">
                <div class="row d-flex align-items-center">
                    <div class="col-md-3">
                        <div class="left-top-icon">
                           <a href="<?php echo SITEPATH;?>dashboard"><img src="<?php echo SITEPATHFRONT; ?>images/avira_short_logo.png" alt="Avira Surveys" class="h-logo"></a>
                           <i class="fa fa-angle-double-right fa-sm"></i>
                           <?php if(isset($_GET['surveyid'])){?><span class="survtitle" data-tooltip='<?php echo str_replace("'",'"',$survey_title);?>' data-tooltip-position="bottom"><?php if(strlen($survey_title)>23) { echo substr($survey_title, 0, 23)."..."; } else { echo $survey_title; } ?></span><?php }?>
                           
                           
                        </div>
                    </div>
                    <div class="col-md-6">
                       <ul class="tab-menu-bar list-unstyled mb-0">
                           <li>
                               <?php if($pageurl=="bulk-survey.php" || $pageurl=="copy-paste-survey.php" || $pageurl=="import-contacts.php" || $pageurl=="thank-you.php" || $pageurl=="share-to-my-contacts.php"){?>
                               <a href="javascript:void(0);" class="disabled">Build
                               <i class="fa fa-angle-double-right"></i>
                               </a>
                               <?php } else {?>
                               <a href="<?php echo SITEPATH;?>add-survey?surveyid=<?php echo $_SESSION['survey_sess_id'];?>" 
                               <?php if($pageurl=="add-survey.php"){?> class="active-menu" <?php } else {?> class="" <?php }?>>Build
                               <i class="fa fa-angle-double-right"></i>
                               </a>
                               <?php }?>
                           </li>
                           <li>
                               <?php 
                                $fields_questions3 = "*";
                                $condition_questions3 = "`tbl_questionBank`.`survey_id` ='".$_SESSION['survey_sess_id']."'";
                                $orderby3="`tbl_questionBank`.`question_id` asc";
                                $all_questions3=$obj_survey->getQuestionBank($fields_questions3, $condition_questions3, $orderby3, '', 0);
                                $cnt_que = count($all_questions3);
                               ?>
                               <?php if($pageurl=="bulk-survey.php" || $pageurl=="copy-paste-survey.php" || $pageurl=="import-contacts.php" || $pageurl=="thank-you.php" || $pageurl=="share-to-my-contacts.php"){?>
                               <a href="javascript:void(0);" class="disabled">Share 
                               <i class="fa fa-angle-double-right"></i>
                               </a>
                               <?php } else {?>
                               <a
                               <?php if($pageurl=="share.php" ){?> class="active-menu" href="<?php echo SITEPATH;?>share?surveyid=<?php echo $_SESSION['survey_sess_id'];?>" <?php } else if($cnt_que == "0") {?>class="disabled" href="javascript:void(0);" <?php } else {?>class="" href="<?php echo SITEPATH;?>share?surveyid=<?php echo $_SESSION['survey_sess_id'];?>" <?php } ?> id="share_survey">Share
                                 <i class="fa fa-angle-double-right"></i>
                               </a>
                               <?php }?>
                           </li>
                           <li>
                               <?php
                                /*********Response count**************/
                                  $condition_response = "`tbl_response_user`.`survey_id` = '".$_SESSION['survey_sess_id']."'";
                                  $all_related_survey_response=$obj_survey->getSurveyUser('', $condition_response, '', '', 0);
                                  $cnt_que_res_survey = count($all_related_survey_response);
                               ?>
                               <?php if($pageurl=="bulk-survey.php" || $pageurl=="copy-paste-survey.php" || $pageurl=="import-contacts.php" || $pageurl=="thank-you.php" || $pageurl=="share-to-my-contacts.php"){?>
                               <a href="<?php echo SITEPATH;?>view-survey-result/<?php echo $_SESSION['survey_sess_id'];?>/" class="disabled">Result
                               <i class="fa fa-angle-double-right"></i>
                               </a>
                               <?php } else if($cnt_que_res_survey == 0) {?>
                               <a href="javascript:void(0);" class="disabled">Result
                                <i class="fa fa-angle-double-right"></i>
                               </a>
                               <?php } else { ?>
                                <a href="<?php echo SITEPATH;?>view-survey-results/<?php echo $_SESSION['survey_sess_id'];?>/">Result
                                <i class="fa fa-angle-double-right"></i>
                               </a>
                               <?php } ?>
                           </li>
                       </ul>
                    </div>
                    <div class="col-md-3">
                        <ul class="list-unstyled right-user-menu mb-0">
                            <!--<li>-->
                            <!--    <a href="#">-->
                            <!--       <i class="fa fa-save"></i>-->
                            <!--        Save-->
                            <!--    </a>-->
                            <!--</li>-->
                            <!--<li>-->
                            <!--    <a href="#" class="border">Preview</a>-->
                            <!--</li>-->
                            <li>
                                 <div class="header-rigth">
                                    <ul class="list-unstyled right-nav-menu">
                                        <li class="dropdown" style="float:right;">
                                            <div class="user-profile">
                                                <a href="" data-bs-toggle="dropdown" aria-expanded="false" class="dropdown-toggle p-0" id="dropdownMenuButton2">
                                                   <?php if ($profile_img == ""){ ?>
                                                            <img src="<?php echo SITEPATH; ?>upload/default.png" class="img-fluid"></img>
                                                            <?php } else { ?>
                                                            <img src="<?php echo $profile_img; ?>" class="img-fluid"></img>
                                                            <?php } ?>
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                                    <li><a class="dropdown-item" href="<?php echo SITEPATH; ?>user-profile">Edit</a></li>
                                                    <li><a class="dropdown-item" href="<?php echo SITEPATH; ?>logout">Logout</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                 </div>
                            </li>
                        </ul>
                       
                    </div>
                </div>
            </div>
        </div>
        
<?php include('footer.php'); ?>