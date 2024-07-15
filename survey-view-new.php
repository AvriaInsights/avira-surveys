<?php 
require_once("survey/classes/cls-request.php");
require_once("survey/classes/cls-template.php");
require_once("survey/classes/cls-survey.php");

$obj_request = new Request();
$obj_template= new Template();
$obj_survey = new Survey();

/*if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}*/

$surveyid=1;

/**********All Questions***************/
$fields_questions = "*";
$condition_questions = "`tbl_questionBank`.`survey_id` ='".$surveyid."'";
$orderby="`tbl_questionBank`.`sequence` ASC";
$all_questions=$obj_survey->getQuestionBank($fields_questions, $condition_questions, $orderby, '', 0);

/******************Survey Detail**********/
$fields_survey= "*";
$condition_survey = "`tbl_survey`.`survey_id` = '".$surveyid."'";
$all_surveys_details = $obj_survey->getSurveyDetail($fields_survey, $condition_survey, '', '', 0);
foreach($all_surveys_details as $all_surveys_detail)
{
   $templateid=$all_surveys_detail['template_id'];
   $category_id=$all_surveys_detail['category_id'];
   $survey_title=$all_surveys_detail['survey_title'];
   $survey_description=$all_surveys_detail['survey_description'];
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

?>
<?php 
$page = "surveyview";
$page_title = " $survey_title | Avira Surveys - " . SITETITLE;
$meta_description = "Contact Avira Surveys today, we will cheerfully help you with worldwide industry survey, markets trends for future outlook and actionable insights to impact your industry.";
$meta_keywords = "";
include('common-header.php')?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>

<style>
.common-header-main{
display:none;
}
html {
  scroll-behavior: smooth;
}

.thanks-head{
        padding-bottom: 30px;
}
.thanks-head h3{
        color: #fff;
            font-size: 20px;
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
    display: block;
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
    color:#fff;
    padding-top: 10px;
   
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
    min-width: 370px;
    text-align: left;
    border-radius: 4px;
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
}

.disabled {
        opacity: 0.5;
        cursor: not-allowed;
        text-decoration:none!important;
    }
/*==== Rank Order ====*/
.rank_ord{
    margin-top: 23px;
    padding: 10px 0px 6px 0px;
    font-size: 13px;
    width: 100%;
    border-radius: 20px;
    font-weight: 600;
    color:#fff;
    background: #070950;
    border:1px solid #fff;
    text-align:center;
}
.rank_ord::-moz-placeholder{
   font-weight:500;
   font-size:9px;
}
     .rank_label{
    border: 1px solid #ddd;
    padding: 9px 17px;
    border-radius: 5px;
    color: #fff;
    width: 100%;
    margin-top: 20px;
    font-size: 16px;
    justify-content: left;
     }

</style>
<link rel="stylesheet" href="<?php echo SITEPATHFRONT; ?>css/template.css">
<link rel="stylesheet" href="<?php echo SITEPATHFRONT; ?>css/responsive.css">
<script src="<?php echo SITEPATH; ?>bower_components/jquery/dist/jquery.min.js"></script>

<div class="wrapper p-3">
         <input type="hidden" id="all_question_id" name="all_question_id" value="">
         <input type="hidden" id="all_answers" name="all_answers" value="">
         <input type="hidden" id="current_answer" name="current_answer" value="">
         <input type="hidden" name="setqno" id="setqno" value="">
         <input type="hidden" name="qsequence" id="qsequence" value="">
           <section class="space-padding-top">
              <div class="conatiner-fluid pse-2">
                 <div class="row">
                    <div class="col-md-12 temp-img">
                         <div class="br-25 bannar" style="background-image:url('<?php echo SITEPATH; ?><?php echo $template_image;?>')">
                           <div class="row">
                            
                            <div class="col-md-8 que_section offset-md-2" id="divQstn">
                                
                                <input type="hidden" id="progress_count" class="progress_count" value="<?php echo count($all_questions); ?>">
                                
                             <?php $srno=1;foreach ($all_questions as $all_question) { 
                                     /**********All Sub Points Questions***************/
                                    $fields_subpoints = "*";
                                    $condition_subpoints = "`tbl_questionSub`.`question_id` =".$all_question['question_id'];
                                    $all_subpoints=$obj_survey->getSubQuestionPoints($fields_subpoints, $condition_subpoints, '', '', 0);
                                    
                                    $fields_questtype = "quest_type";
                                    $condition_questtype = "`tbl_question_type`.`quest_type_id` =".$all_question['quest_type_id'];
                                    $all_question_types=$obj_survey->getQuestionType($fields_questtype, $condition_questtype, '', '', 0);
                                    foreach($all_question_types as $all_question_type){
                                        $qtypename=$all_question_type['quest_type'];
                                    }
                             ?>
                        
                                   <!--Question Type Boolean-->
                                    <?php if($all_question['quest_type_id'] == "1") {  ?> 
                                    <div id="que_<?php echo $srno;?>" style="display:none" class="que_scroll item mt-4 mb-5"  data-id='<?php echo $srno;?>'  isAttempted="0">
                                     <h1>Question <span id="displayqno_<?php echo $srno;?>"></span></h1>
                                     <div class="toolt">
                                        <p><?php echo $all_question['question_title'];?></p>
                                        <?php if($all_question['tooltip']!=""){
                                        $str_tooltip = ($all_question['tooltip']);
                                        $replace_tooltip = str_replace("'","","$str_tooltip");
                                        ?>
                                         <div class="tooltip"><span data-tooltip='<?php echo $replace_tooltip; ?>' data-tooltip-position="left"><i class="fa fa-info-circle"></i></span></div>
                                        <?php }?>
                                    </div>
                                        <input type="hidden" name="qtypename_<?php echo $srno;?>" id="qtypename_<?php echo $srno;?>" value="<?php echo $qtypename?>">
                                        <input type="hidden" name="qidthis_<?php echo $srno;?>" id="qidthis_<?php echo $srno;?>" value="<?php echo $all_question['question_id'];?>">
                                        <input type="hidden" name="required_<?php echo $srno;?>" id="required_<?php echo $srno;?>" value="<?php echo $all_question['is_required'];?>">
                                        <input type="hidden" name="skip_from_<?php echo $srno;?>" id="skip_from_<?php echo $srno;?>" value="<?php echo $all_question['skip_from_which_question'];?>">
                                          <div class="col-12 pb-5">
                                              <div class="d-flex align-items-center boolean_que_type">
                                                <?php foreach($all_subpoints as $all_subpoint){ ?>  
                                                    <input type="hidden" name="skip_<?php echo $all_subpoint['question_subid'];?>" id="skip_<?php echo $all_subpoint['question_subid'];?>" value="<?php echo $all_subpoint['skip_question'];?>">
                                                    <input class="checkbox-tools" type="radio" name="bool_<?php echo $srno;?>" id="bool_<?php echo $all_subpoint['question_subid'];?>" value="<?php echo $all_subpoint['question_subtitle'];?>" onchange="SetAttempted(this,<?php echo $all_question['sequence'];?>,<?php echo $all_question['question_id'];?>)" onclick="setnext(<?php echo $srno;?>,<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,this.value);">
                            						<label class="for-checkbox-tools boolean_yes_no" for="bool_<?php echo $all_subpoint['question_subid'];?>">
                            							<?php if($all_subpoint['question_subtitle'] == "Yes"){ ?> <i class='fa fa-thumbs-up'></i><?php } ?>
                            							<?php if($all_subpoint['question_subtitle'] == "No"){ ?> <i class='fa fa-thumbs-down'></i><?php } ?>
                            	                      
                            							<p><?php echo $all_subpoint['question_subtitle'];?></p>
                            						</label>
                        				        <?php } ?>	
                    				        </div>
            				        	</div>
    				                </div>
    				            <?php } ?>
    				            
    				            
    				            <!--Question Type Radio-->
                                <?php if($all_question['quest_type_id'] == "2") {  ?> 
                                   <div id="que_<?php echo $srno;?>" style="display:none" class="que_scroll item mt-4 mb-5" data-id='<?php echo $srno;?>' isAttempted="0">
                                   <h1>Question <span id="displayqno_<?php echo $srno;?>"></span></h1>
                                   <div class="toolt">
                                    <p><?php echo $all_question['question_title'];?></p>
                                    <?php if($all_question['tooltip']!=""){?>
                                         <div class="tooltip"><span data-tooltip="<?php echo $all_question['tooltip']; ?>" data-tooltip-position="left"><i class="fa fa-info-circle"></i></span></div>
                                    <?php }?>
                                    </div>
                                    <input type="hidden" name="qtypename_<?php echo $srno;?>" id="qtypename_<?php echo $srno;?>" value="<?php echo $qtypename?>">
                                    <input type="hidden" name="qidthis_<?php echo $srno;?>" id="qidthis_<?php echo $srno;?>" value="<?php echo $all_question['question_id'];?>">
                                    <input type="hidden" name="required_<?php echo $srno;?>" id="required_<?php echo $srno;?>" value="<?php echo $all_question['is_required'];?>">
                                     <input type="hidden" name="skip_from_<?php echo $srno;?>" id="skip_from_<?php echo $srno;?>" value="<?php echo $all_question['skip_from_which_question'];?>">
                                      <div class="col-12 pb-5">
                                        <div class="d-flex align-items-center wrap-content">
                					    <?php foreach($all_subpoints as $all_subpoint){ ?>
                					        <input type="hidden" name="skip_<?php echo $all_subpoint['question_subid'];?>" id="skip_<?php echo $all_subpoint['question_subid'];?>" value="<?php echo $all_subpoint['skip_question'];?>">
                    						<input class="checkbox-tools" type="radio" name="radiotype_<?php echo $srno;?>" id="radiotype_<?php echo $all_subpoint['question_subid'];?>" value="<?php echo $all_subpoint['question_subtitle'];?>" onchange="SetAttempted(this,<?php echo $all_question['sequence'];?>,<?php echo $all_question['question_id'];?>);" <?php if($all_subpoint['question_subtitle']!="Other"){?> onclick="setnext('<?php echo $srno;?>','<?php echo $all_subpoint['question_subid'];?>',<?php echo $all_question['question_id'];?>,this.value);" <?php } else {?> onclick="showradtextbox(<?php echo $all_question['question_id'];?>);" <?php }?>>
                    						<label class="for-checkbox-tools" for="radiotype_<?php echo $all_subpoint['question_subid'];?>">
                    							<p><?php echo $all_subpoint['question_subtitle'];?></p>
                    						</label>
                    					<?php } ?>
                    					</div>
                    						<div class="" style="display:none" id="radio_other_text_field_<?php echo $all_question['question_id'];?>">
                    						<div class="form__group field">
                                                 <input type="text" class="form__field effect-2" placeholder="Please Enter Your Response" name="radio_other_text_<?php echo $all_question['question_id'];?>" id='radio_other_text_<?php echo $all_question['question_id'];?>' value="" onkeyup="activenextbutton(<?php echo $srno;?>,<?php echo $all_question['question_id'];?>)"/>
                                               </div>
                                               <div class="button" id="button" onclick="setnext(<?php echo $srno;?>,<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,'');">
                                                 <div id="slide" class="slide"></div>
                                                  <a href="javascript:void(0);" class="action-btn-disabled" id="btn_next_other_radio_<?php echo $all_question['question_id'];?>">NEXT &nbsp;&nbsp;<i class="fa fa-angle-right"></i></a>
                                               </div>
                                            </div>  
                					    </div>
                					   </div>
                			       <?php  } ?>
                		        
                		        <!--Question Type Checkbox-->
                		        <?php if ($all_question['quest_type_id'] == "3") { ?>
				                 <div id="que_<?php echo $srno;?>" style="display:none" class="que_scroll item mt-1" data-id='<?php echo $srno;?>' isAttempted="0">
                                    <h1>Question <span id="displayqno_<?php echo $srno;?>"></span></h1>
                                    <div class="toolt">
                                    <p><?php echo $all_question['question_title'];?></p>
                                    <?php if($all_question['tooltip']!=""){?>
                                         <div class="tooltip"><span data-tooltip="<?php echo $all_question['tooltip']; ?>" data-tooltip-position="left"><i class="fa fa-info-circle"></i></span></div>
                                    <?php }?>
                                    </div>
                                    <input type="hidden" name="qtypename_<?php echo $srno;?>" id="qtypename_<?php echo $srno;?>" value="<?php echo $qtypename?>">
                                    <input type="hidden" name="qidthis_<?php echo $srno;?>" id="qidthis_<?php echo $srno;?>" value="<?php echo $all_question['question_id'];?>">
                                    <input type="hidden" name="required_<?php echo $srno;?>" id="required_<?php echo $srno;?>" value="<?php echo $all_question['is_required'];?>">
                                    <input type="hidden" name="chkselectedval_<?php echo $all_question['question_id'];?>" id="chkselectedval_<?php echo $all_question['question_id'];?>" value="">  
                                     <input type="hidden" name="skip_from_<?php echo $srno;?>" id="skip_from_<?php echo $srno;?>" value="<?php echo $all_question['skip_from_which_question'];?>">
                                       <div class="chk_class">
            				                     <div class="row pb-5">
            				                        <?php $counter = 0; foreach($all_subpoints as $all_subpoint){ $counter++; ?>
                                                     <div class="col-md-6">
                                                          <input id="chkbox_<?php echo $all_subpoint['question_subid'];?>" type="checkbox" name="chkbox" value="<?php echo $all_subpoint['question_subtitle'];?>" onchange="SetAttempted(this,<?php echo $all_question['sequence'];?>,<?php echo $all_question['question_id'];?>)" <?php if($all_subpoint['question_subtitle']=="Other"){?> onclick="showchktextbox(<?php echo $all_question['question_id'];?>,<?php echo $all_subpoint['question_subid'];?>);setcheckboxquestans(<?php echo $srno;?>,<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,this.value);" <?php } else  {?> onclick="setcheckboxquestans(<?php echo $srno;?>,<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,this.value);" <?php }?>>
                                                            <label for="chkbox_<?php echo $all_subpoint['question_subid'];?>">
                                                                <span class="float-start text-dark span" id="<?php echo $all_subpoint['question_subid'];?>"><?php echo $counter; ?></span> &nbsp; <?php echo $all_subpoint['question_subtitle'];?> 
                                                            </label>
                                                     </div>
                                                     <?php }  ?>
                                                    <div class="" style="display:none" id="check_other_text_field_<?php echo $all_question['question_id'];?>">
                            						   <div class="form__group field">
                                                         <input type="text" class="form__field effect-2" placeholder="Please Enter Your Response" name="check_other_text_<?php echo $all_question['question_id'];?>" id='check_other_text_<?php echo $all_question['question_id'];?>' value="" onkeyup="activenextbutton(<?php echo $srno;?>,<?php echo $all_question['question_id'];?>)"/>
                                                       </div>
                                                       
                                                    </div> 
                                                    <div class="col-md-12 mt-2 mb-4" onclick="setnext(<?php echo $srno;?>,<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,'');">
                                                        <div class="button" id="btn_next_check">
                                                         <div id="slide" class="slide"></div>
                                                          <a href="javascript:void(0);" class="" id="btn_next_other_check_<?php echo $all_question['question_id'];?>">NEXT &nbsp;&nbsp;<i class="fa fa-angle-right"></i></a>
                                                    
                                                        </div>
                                                     </div>
                                                 </div>
                                           </div>
                
                                     </div>
                                <?php } ?>
                		        
                		        <!--Question Type Text-->
                				<?php if($all_question['quest_type_id']=="4") { ?> 
                                    <div id="que_<?php echo $srno;?>" style="display:none" class="item mt-4 mb-5"  data-id='<?php echo $srno;?>'  isAttempted="0">
                                             <h1>Question <span id="displayqno_<?php echo $srno;?>"></span></h1>
                                        <div class="toolt">
                                             <p><?php echo $all_question['question_title'];?></p>
                                        <?php if($all_question['tooltip']!=""){?>
                                         <div class="tooltip"><span data-tooltip="<?php echo $all_question['tooltip']; ?>" data-tooltip-position="left"><i class="fa fa-info-circle"></i></span></div>
                                        <?php }?>
                                        </div>
                                             <input type="hidden" name="qtypename_<?php echo $srno;?>" id="qtypename_<?php echo $srno;?>" value="<?php echo $qtypename?>">
                                             <input type="hidden" name="qidthis_<?php echo $srno;?>" id="qidthis_<?php echo $srno;?>" value="<?php echo $all_question['question_id'];?>">
                                             <input type="hidden" name="required_<?php echo $srno;?>" id="required_<?php echo $srno;?>" value="<?php echo $all_question['is_required'];?>">
                                              <input type="hidden" name="skip_from_<?php echo $srno;?>" id="skip_from_<?php echo $srno;?>" value="<?php echo $all_question['skip_from_which_question'];?>">
                                             <?php foreach($all_subpoints as $all_subpoint){
                                                    $texttype=$all_subpoint['question_subtitle'];
                                                    $pos=stripos($texttype,'-');
                                                    if($pos)
                                                    {
                                                        $fulltexttype=explode("-",$texttype);
                                                        $texttype=$fulltexttype[1];
                                                    }
                                                    
                                             }?>
                                               <div class="form__group field">
                                                 <?php if($texttype=="Text" || $texttype=="text"){?>
                                                 <input type="text" class="form__field effect-2" placeholder="Please Enter Your Response" name="texttype" id='texttype_<?php echo $all_question['question_id'];?>' value="" onkeyup="activenextbutton(<?php echo $srno;?>,<?php echo $all_question['question_id'];?>)" onchange="SetAttempted(this,<?php echo $all_question['sequence'];?>,<?php echo $all_question['question_id'];?>)" onfocusout="setnext(<?php echo $srno;?>,<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,'');"/>
                                                 <?php }?>
                                                 <?php if($texttype=="textarea"){?>
                                                 <textarea class="form__field effect-2" placeholder="Please Enter Your Response" name="texttype" id='texttype_<?php echo $all_question['question_id'];?>' value="" onkeyup="activenextbutton(<?php echo $srno;?>,<?php echo $all_question['question_id'];?>)" onchange="SetAttempted(this,<?php echo $all_question['sequence'];?>,<?php echo $all_question['question_id'];?>)" onfocusout="setnext(<?php echo $srno;?>,<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,'');"></textarea>
                                                 <?php }?>
                                               </div>
                                               
                                                <div class="button action-btn-disabled" id="button_next_<?php echo $all_question['question_id'];?>" onclick="setnext(<?php echo $srno;?>,<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,'');">
                                                 <div id="slide" class="slide"></div>
                                                  <a class="action-btn-disabled" href="javascript:void(0);" id="btn_next_<?php echo $all_question['question_id'];?>">NEXT &nbsp;&nbsp;<i class="fa fa-angle-right"></i></a>
                                                </div>
                                               
                                               
                                               
                                               
                                    </div>
                                    <?php } ?>  
                                    
                                <!--Question Type Rating-->    
                                <?php if ($all_question['quest_type_id'] == "5") {  ?> 
				                 <div id="que_<?php echo $srno;?>" style="display:none" class="item mt-4" data-id='<?php echo $srno;?>' isAttempted="0">
                                         <h1>Question <span id="displayqno_<?php echo $srno;?>"></span></h1>
                                         <div class="toolt">
                                         <p><?php echo $all_question['question_title'];?></p>
                                         <?php if($all_question['tooltip']!=""){?>
                                         <div class="tooltip"><span data-tooltip="<?php echo $all_question['tooltip']; ?>" data-tooltip-position="left"><i class="fa fa-info-circle"></i></span></div>
                                        <?php }?>
                                        </div>
                                         <input type="hidden" name="qtypename_<?php echo $srno;?>" id="qtypename_<?php echo $srno;?>" value="<?php echo $qtypename?>">
                                         <input type="hidden" name="qidthis_<?php echo $srno;?>" id="qidthis_<?php echo $srno;?>" value="<?php echo $all_question['question_id'];?>">
                                         <input type="hidden" name="required_<?php echo $srno;?>" id="required_<?php echo $srno;?>" value="<?php echo $all_question['is_required'];?>">
                                          <input type="hidden" name="skip_from_<?php echo $srno;?>" id="skip_from_<?php echo $srno;?>" value="<?php echo $all_question['skip_from_which_question'];?>">
                                            <?php foreach($all_subpoints as $all_subpoint){ $subratingid=$all_subpoint['question_subid'];}?>
                                            <input type="hidden" name="skip_<?php echo $all_subpoint['question_subid'];?>" id="skip_<?php echo $all_subpoint['question_subid'];?>" value="<?php echo $all_subpoint['skip_question'];?>">
                                            <div class="stars">
                                              <form action="">
                                                <input class="star star-5" onchange="SetAttempted(this,<?php echo $all_question['sequence'];?>,<?php echo $all_question['question_id'];?>)" id="star_<?php echo $subratingid."1";?>" value="5" type="radio" name="star_<?php echo $subratingid;?>" onclick="setnext(<?php echo $srno;?>,<?php echo $subratingid;?>,<?php echo $all_question['question_id'];?>,this.value);"/>
                                                <label class="star star-5" for="star_<?php echo $subratingid."1";?>"></label>
                                                <input class="star star-4" onchange="SetAttempted(this,<?php echo $all_question['sequence'];?>,<?php echo $all_question['question_id'];?>)" id="star_<?php echo $subratingid."2";?>" value="4" type="radio" name="star_<?php echo $subratingid;?>" onclick="setnext(<?php echo $srno;?>,<?php echo $subratingid;?>,<?php echo $all_question['question_id'];?>,this.value);"/>
                                                <label class="star star-4" for="star_<?php echo $subratingid."2";?>"></label>
                                                <input class="star star-3" onchange="SetAttempted(this,<?php echo $all_question['sequence'];?>,<?php echo $all_question['question_id'];?>)" id="star_<?php echo $subratingid."3";?>" value="3" type="radio" name="star_<?php echo $subratingid;?>" onclick="setnext(<?php echo $srno;?>,<?php echo $subratingid;?>,<?php echo $all_question['question_id'];?>,this.value);"/>
                                                <label class="star star-3" for="star_<?php echo $subratingid."3";?>"></label>
                                                <input class="star star-2" onchange="SetAttempted(this,<?php echo $all_question['sequence'];?>,<?php echo $all_question['question_id'];?>)" id="star_<?php echo $subratingid."4";?>" value="2" type="radio" name="star_<?php echo $subratingid;?>" onclick="setnext(<?php echo $srno;?>,<?php echo $subratingid;?>,<?php echo $all_question['question_id'];?>,this.value);"/>
                                                <label class="star star-2" for="star_<?php echo $subratingid."4";?>"></label>
                                                <input class="star star-1" onchange="SetAttempted(this,<?php echo $all_question['sequence'];?>,<?php echo $all_question['question_id'];?>)" id="star_<?php echo $subratingid."5";?>" value="1" type="radio" name="star_<?php echo $subratingid;?>" onclick="setnext(<?php echo $srno;?>,<?php echo $subratingid;?>,<?php echo $all_question['question_id'];?>,this.value);"/>
                                                <label class="star star-1" for="star_<?php echo $subratingid."5";?>"></label>
                                              </form>
                                            </div>
                                     </div>
				                <?php } ?>
				                
				                <!--Question Type Dropdown-->
                			   <?php if ($all_question['quest_type_id'] == "6") { ?> 
                                  <div id="que_<?php echo $srno;?>" style="display:none" class="que_scroll item mt-4" data-id='<?php echo $srno;?>'  isAttempted="0">
                                    <h1>Question <span id="displayqno_<?php echo $srno;?>"></span></h1>
                                    <div class="toolt">
                                    <p><?php echo $all_question['question_title'];?></p>
                                    <?php if($all_question['tooltip']!=""){?>
                                         <div class="tooltip"><span data-tooltip="<?php echo $all_question['tooltip']; ?>" data-tooltip-position="left"><i class="fa fa-info-circle"></i></span></div>
                                    <?php }?>
                                    </div>
                                    <input type="hidden" name="qtypename_<?php echo $srno;?>" id="qtypename_<?php echo $srno;?>" value="<?php echo $qtypename?>">
                                    <input type="hidden" name="qidthis_<?php echo $srno;?>" id="qidthis_<?php echo $srno;?>" value="<?php echo $all_question['question_id'];?>">
                                    <input type="hidden" name="required_<?php echo $srno;?>" id="required_<?php echo $srno;?>" value="<?php echo $all_question['is_required'];?>">
                                     <input type="hidden" name="skip_from_<?php echo $srno;?>" id="skip_from_<?php echo $srno;?>" value="<?php echo $all_question['skip_from_which_question'];?>">
                                      <div class="row pb-5">
                                        <?php $counter = 0; foreach($all_subpoints as $all_subpoint){ $counter++;?>
                                          <div class="col-md-6">
                                             <input class="checkbox-tools1" value="<?php echo $all_subpoint['question_subtitle'];?>" type="radio" name="dropdown_<?php echo $srno;?>" id="dropdown_<?php echo $all_subpoint['question_subid'];?>" onchange="SetAttempted(this,<?php echo $all_question['sequence'];?>,<?php echo $all_question['question_id'];?>)" onclick="setnext(<?php echo $srno;?>,<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,this.value)">
                    						    <label class="for-checkbox-tools float-start" for="dropdown_<?php echo $all_subpoint['question_subid'];?>">
                    						         <span class="float-end text-dark span"><?php echo $counter; ?></span>&nbsp;
                    							     <?php echo $all_subpoint['question_subtitle'];?> 
                						    </label>
                                          </div>
                                         <?php } ?>
                                        
        				        	</div>
				                </div>
				                
				                <?php } ?>
        				        
                                <!--Question Type Opinion Scale-->
                                <?php if ($all_question['quest_type_id'] == "7") { ?>
                                        <div id="que_<?php echo $srno;?>" style="display:none" class="item mt-4" data-id='<?php echo $srno;?>'  isAttempted="0">
                                         <h1>Question <span id="displayqno_<?php echo $srno;?>"></span></h1>
                                         <div class="toolt">
                                         <p><?php echo $all_question['question_title'];?></p>
                                         <?php if($all_question['tooltip']!=""){?>
                                         <div class="tooltip"><span data-tooltip="<?php echo $all_question['tooltip']; ?>" data-tooltip-position="left"><i class="fa fa-info-circle"></i></span></div>
                                        <?php }?>
                                        </div>
                                         <input type="hidden" name="qtypename_<?php echo $srno;?>" id="qtypename_<?php echo $srno;?>" value="<?php echo $qtypename?>">
                                         <input type="hidden" name="qidthis_<?php echo $srno;?>" id="qidthis_<?php echo $srno;?>" value="<?php echo $all_question['question_id'];?>">
                                         <input type="hidden" name="required_<?php echo $srno;?>" id="required_<?php echo $srno;?>" value="<?php echo $all_question['is_required'];?>">
                                          <input type="hidden" name="skip_from_<?php echo $srno;?>" id="skip_from_<?php echo $srno;?>" value="<?php echo $all_question['skip_from_which_question'];?>">
                                              <?php foreach($all_subpoints as $all_subpoint)
                                                    { 
                                                        $scale_str =  $all_subpoint['question_subtitle'];
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
                                               <div class="col-md-12">
                                                <div class="scales d-flex">
                                                     <?php for($sc=0;$sc<=$max;$sc++){ ?>
                                                       
                                                          <?php if($sc==$min){?>
                                                                <div cass="row">
                                                                    <div class="col-md-1">
                                                                        <span class="scale_txt"><?php echo $left_text;?></span> 
                                                                    </div>
                                                                </div>
                                                            <?php }?>
                                                           
                                                           <?php if($sc==$avg){?>
                                                                <div cass="row">
                                                                    <div class="col-md-1">
                                                                         <span class="scale_txt"><?php echo $middle_text;?></span>
                                                                    </div>
                                                                </div>
                                                           <?php }?>
                                                           
                                                           <?php if($sc==$max){?>
                                                               <div cass="row">
                                                                    <div class="col-md-1">
                                                                        <span class="scale_txt float-end"><?php echo $right_text;?></span>
                                                                    </div>
                                                                </div>
                                                           <?php }?>
                                                         <input class="scale" id="scale-<?php echo $all_subpoint['question_subid']."-".$sc;?>" value="<?php echo $sc;?>" type="radio" name="scale_<?php echo $all_subpoint['question_subid'];?>" onchange="SetAttempted(this,<?php echo $all_question['sequence'];?>,<?php echo $all_question['question_id'];?>)" onclick="setnext(<?php echo $srno;?>,<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,this.value)"/>
                                                         <label class="scale" for="scale-<?php echo $all_subpoint['question_subid']."-".$sc;?>"><?php echo $sc;?></label>
                                                     <?php  }  ?>
                                                 </div>
                                            </div>
                                         </div>     
                                        <?php } ?>
                                    <?php } ?>
                                    
                                    <!--**** Rank Order Question **** ---->
                
                                <?php if ($all_question['quest_type_id'] == "8") { ?> 
                                  <div id="que_<?php echo $srno;?>" style="display:none" class="que_scroll item mt-4" data-id='<?php echo $srno;?>'  isAttempted="0">
                                    <h1>Question <?php echo $all_question['sequence'];?></h1>
                                    <div class="toolt">
                                    <p><?php echo $all_question['question_title'];?></p>
                                    <?php if($all_question['tooltip']!=""){?>
                                         <div class="tooltip"><span data-tooltip="<?php echo $all_question['tooltip']; ?>" data-tooltip-position="right"><i class="fa fa-info-circle"></i></span></div>
                                    <?php }?>
                                    </div>
                                    <input type="hidden" name="qtypename_<?php echo $srno;?>" id="qtypename_<?php echo $srno;?>" value="<?php echo $qtypename?>">
                                    <input type="hidden" name="qidthis_<?php echo $srno;?>" id="qidthis_<?php echo $srno;?>" value="<?php echo $all_question['question_id'];?>">
                                    <input type="hidden" name="required_<?php echo $srno;?>" id="required_<?php echo $srno;?>" value="<?php echo $all_question['is_required'];?>">
                                      <div class="row pb-5" id="rank_order_que">
                                        <?php $counter=0; foreach($all_subpoints as $all_subpoint){ $counter++;  
                                        
                                        ?>
                                       
                                          <div class="col-md-6">
                    							  <label class="for-checkbox-tools rank_label float-start" for="order_<?php echo $all_subpoint['question_subid'];?>">
                    							     <span class="float-end text-dark span"><?php echo $all_subpoint['rank_order_sequence']; ?></span>&nbsp;
                    							     <span class="ml-3"><?php echo $all_subpoint['question_subtitle'];?></span>
                    							  </label>
                                          </div>
                                          <div class="col-md-2">
                                              <div class="star mb-2" id="seq_error_message"></div>   
                                                  <select class="rank_ord checkbox-tools1 float-end" id="order_<?php echo $all_subpoint['question_subid'];?>" name="order_<?php echo $all_subpoint['question_subid'];?>" onchange="checksequence(<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>)">
                    							     <option value="">-Select Rank-</option>
                    							     <?php foreach($all_subpoints as $all_subpoint_seq){ ?>
                    							     <option value="<?php echo $all_subpoint_seq['rank_order_sequence']; ?>">
                    							        <?php echo $all_subpoint_seq['rank_order_sequence']; ?>
                    							      </option>
                    							      <?php } ?>
                    							 </select>
                                                
                                          </div>
                                         <?php } ?>
                                        
        				        	</div>
        				        	 <div class="button action-btn-disabled" id="button_next_order_<?php echo $all_question['question_id'];?>" onclick="checksequence(<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>)">
                                         <div id="slide" class="slide"></div>
                                         <a class="action-btn-disabled" href="javascript:void(0);" id="btn_next_<?php echo $all_question['question_id'];?>">NEXT &nbsp;&nbsp;<i class="fa fa-angle-right"></i></a>
                                    </div>
				                </div>
			                     
				                
				                <?php } ?>
                                    
                            
                                   
                                   
                              <?php $srno++;} ?>
                              <div class="col-md-12 item mt-5" id="que_<?php echo $srno;?>" data-id="<?php echo $srno;?>" style="display:none;">
                                            <div class="row pb-5">
                                            <div class="thanks-head">
                                                <h3>Thank you for your response.</h3>
                                            </div>
                                              <div class="col-md-12">
                                                <input type="text" class="form__field effect-2" placeholder="Enter Full Name" name="fname" id='fname' value="" />
                                                <div class="star" id="fname_error_message"></div>
                                            
                                              </div>
                                             <div class="col-md-12">
                                                <div class="mt-5">
                                                    
                                                    <input type="text" class="form__field effect-2" placeholder="Enter Email" name="email" id='email' value="" />
                                                    <div class="star" id="email_error_message"></div>
                                                </div>
                                                
                                              </div>
                                            
            				        	</div>
                                        <div class="button" id="lastsubmit">
                                         <div id="slide" class="slide"></div>
                                         
                                          <a href="javascript:void(0);" id="lastsubmit">SUBMIT &nbsp;&nbsp;<i class="fa fa-angle-right"></i></a>
                                        </div>
                                        <span class="spinner-border spinner-border-md mt-4" role="status" aria-hidden="true" id="span_loader" style="display:none"></span>
                                    </div> 
                                <input type="hidden" name="totalquestion" id="totalquestion" value="<?php echo count($all_questions);?>">
                                </div> 
                            </div>
                            <!--Intro page section-->
                            <div class="row">
                                <div class="col-md-12" data-id='<?php echo $srno+1;?>'>
                                    <div class="end success-content text-center mt-5" >
                                        <p class="mt-10">We really appreciate your time and feedback.</p>
                                        <p><i class="fa fa-smile-o text-amber-200" aria-hidden="true"></i></p>
                                        <p class="mt-5"><img class="logo-dash" src="<?php echo SITEPATHFRONT ?>images/logo-dark.png"></p>
                                    </div>
                                </div>    
                              </div> 
                            <div class="row">
                                    <div class="col-md-12 text-center mt-5 mb-5 p-5" id="temp_section">
                                       <h1 class="text-white mt-5 first_survey_heading"><strong><?php echo $survey_title;?></strong></h1>
                                       <h3 class="text-white survey-ttl-data"><?php echo $survey_description;?></h3>
                                        <div class="button get-started mb-5" id="btn_get_started">
                                            <div id="slide" class="slide"></div>
                                                <a id="btn_get_started">OF COURSE, YES :) &nbsp;&nbsp;<i class="fa fa-angle-right"></i></a>
                                            </div>
                                    </div>
                            </div>
                            <!--End intro page section-->
                            <div id="footerdisplay">
                                 <div class="row">
                                    <div class="row mt-3 btn_slider btn_slider_fixed" id="btn_slider" style="display:none">
                                        <div class="col-md-6">
                                             <div class="progress">
                                            <svg class="progress-circle" width="80px" height="90px" xmlns="http://www.w3.org/2000/svg">
                                        	    <circle class="progress-circle-back" cx="35" cy="35" r="25"></circle>
                                                <circle class="progress-circle-prog" cx="35" cy="35" r="25" style="stroke-dasharray: 232, 999;"></circle>
                                            </svg>
                                    	     <div class="progress-text" data-progress="0">0%</div>
                                         </div>	
                                        </div>
                                         <div class="col-md-6">
                                             <div class="text-right-logo">
                                                 <div class="row d-flex justify-content-end">
                                                     <div class="col-lg-7 col-md-6">
                                                          <div class="text-right cmp_logo_text">
                                                             <i class="text-white">made with</i>
                                                            <p><img class="logo-dash-temp img-fluid" src="<?php echo SITEPATHFRONT; ?>images/logo-dark.png"></p>
                                                         </div>
                                                     </div>
                                                     <div class="col-lg-4 col-md-6">
                                                         <a id="next" class="next btn_slider btn_slider_dir br-25"><i class="fa fa-angle-down"></i></a>
                                                        <a id="prev" class="back btn_slider btn_slider_dir br-25"><i class="fa fa-angle-up"></i></a>
                                                     </div>
                                                 </div>
                                            </div>
                                        </div>
                                    </div>
                                 </div>
                              </div>
                             </div>
                         </div>
                    </div>
                </section>
      <div id="demo3"></div>
      
</div>

<?php //include('footer.php')?>
<style>
    .common-footer-main{display:none !important;}
    .star{color:red;font-size:15px;}
</style>
<script>
var nextids=[];
   $(document).ready(function(){
       
            $('.wrapper').addClass("toggled"); 
            
            //Instead of show() you can use slideDown(200); for hide you can use slideUp(200);
        
            $("#btn_get_started").click(function(){
                var currqid="1";
                $('#temp_section').slideUp(200);
                $('#que_'+currqid).slideDown(200);
                $("#btn_slider").slideDown(200);
                $("#displayqno_"+currqid).text(currqid);
                $("#setqno").val(currqid);
                //$("#qsequence").val(currqid);
                nextids.push(currqid);
               if(currqid == 1){
                $('.back').hide();
               }
                
                var required = $("#required_"+currqid).val();
                
                if(required=="Yes")
                {
                    $(".next").addClass("disabled");
                }
                
                //setup(); 
            });
            
            
            $("#fname_error_message").hide();
            $("#email_error_message").hide();
            
            var fname_error_message = false;
            var email_error_message = false;
            
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
            
            function check_fname(){
                var fname= $("#fname").val();
                if(fname == '')
                {
                    $("#fname_error_message").show();
                    $("#fname_error_message").html("Please enter fullname");
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
                    $("#email_error_message").html("Please enter email");
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
            $("#lastsubmit").click(function(){
                //all_question_id all_answers
                check_fname();
                check_email();
                
                var allquestionids =$("#all_question_id").val();
                var allanswers = $("#all_answers").val();
                var fname = $("#fname").val();
                var email = $("#email").val();
               
                if(fname_error_message === false && email_error_message === false)
                {
                    $.ajax({
        				url: "<?php echo SITEPATHFRONT; ?>survey-view-action.php",
        				type: "POST",
        				data: {
        					allquestionids:allquestionids,allanswers:allanswers,fname:fname,email:email,surveyid:<?php echo $surveyid?>
        				},
        				cache: false,
        				beforeSend: function(){
                            // Show image container
                            $('#span_loader').show();
                        },
        				success: function(dataResult){
        				    //alert(dataResult);
        				    //$('#span_loader').hide();
        				    //$('.que_section').hide();
                           // $("#footerdisplay").hide();
    		               //$('.end').slideDown(200);
    		               window.location = '<?php echo SITEPATHFRONT;?>thank-you-survey';
        				}
        			});
                }
                
            });
            
            
            
    });
//++++++++++++++++++Body onload code+++++++++++++


//====== Next & Prev Button Click =======
$('body').on('click', '.next', function() { 
    var id = $('.item:visible').data('id');
    var nextId = $('.item:visible').data('id')+1;
    var required = $("#required_"+id).val();
    var nextrequired = $("#required_"+nextId).val();
    if(nextids.length === 0)
    {
        nextids.push(1);
    }
    //alert(required);
    //alert(nextrequired);
    var totalquest=$("#totalquestion").val();
    /////////////Code for question number////
    var nowqno = $("#setqno").val();
    var nowqno1 = parseInt(nowqno)+parseInt(1);
    $("#setqno").val(nowqno1);
    
    ///////////////////////////////////////////
    
    /////////////////////////////
    
    var qid22 = $("#qidthis_"+id).val();
    var setquestion12 = $("#all_question_id").val();
    var setquestionarray12 = setquestion12.split(";");
   
    var nqid12 = qid22+'';
    var posq12 = setquestionarray12.indexOf(nqid12);
    if(posq12=="-1")
    {
       if(required=="No")
       {
            $(".next").removeClass("disabled");
            $('#que_'+id).slideUp(200);
            $('#que_'+nextId).slideDown(200);
            if(nextId<=totalquest)
            {
              nextids.push(nextId);
            }
            $("#displayqno_"+nextId).text(nowqno1);
            
            var totalquest=$("#totalquestion").val();
            var submitcnt = parseInt(totalquest)+parseInt(1);
            if(nextId > 1){
                $('.back').show();
            }
            if(nextId == submitcnt){
                $('.next').hide();
            }
        }
        else
        {
           $(".next").addClass("disabled");
        }
    }
    else
    {
        
        $(".next").removeClass("disabled");
        $('#que_'+id).slideUp(200);
        $('#que_'+nextId).slideDown(200);
        if(nextId<=totalquest)
        {
          nextids.push(nextId);
        }
        $("#displayqno_"+nextId).text(nowqno1);
        
        var totalquest=$("#totalquestion").val();
        var submitcnt = parseInt(totalquest)+parseInt(1);
        if(nextId > 1){
            $('.back').show();
        }
        if(nextId == submitcnt){
            $('.next').hide();
        }
    
    }
    //alert(nextids);
    if(required=="No")
    {
        if(nextrequired=="Yes")
        {
            $(".next").addClass("disabled");
        }
        else
        {
            $(".next").removeClass("disabled");
        }
    }
    
});

$('body').on('click', '.back', function() { 
    var id = $('.item:visible').data('id');
    var prevId = $('.item:visible').data('id')-1;
    alert(id);
    //alert(prevId);8
   
   var totalquest=$("#totalquestion").val();
   alert(nextids);
   var qval=$("#setqno").val();
   if(prevId==totalquest)
   {
      //var popval=nextids.pop();
      var qval12=parseInt(qval)-parseInt(1);
      $("#setqno").val(qval12);
      $('#que_'+id).slideUp(200);
      $('#que_'+prevId).slideDown(200); 
   }
   else
   {
     //   var cids = id+'';
     //   var poseq = nextids.indexOf(cids);
     //   alert(poseq);
     //   var nextidval = nextids[poseq];
     //   alert(nextidval);
     
      var nt = nextids.length-1;
      var newnextid = nextids.slice(0,nt);
      alert(newnextid);
      nextids = newnextid;
      var popval=newnextid.pop();
      var qval12=parseInt(qval)-parseInt(1);
      $("#setqno").val(qval12);
      $('#que_'+id).slideUp(200);
      $('#que_'+popval).slideDown(200); 
      //nextids = newnextid;
   }
   
   
    var submitcnt = parseInt(totalquest)+parseInt(1);
    
    if(id == totalquest){
        $('.next').hide();
    }
    if(prevId < submitcnt){
        $('.next').show();
    }
    if(prevId == 1){
        $('.back').hide();
    }
    

});

//other filed show
function activenextbutton(curqno,qid)
{
    var qtypename=$("#qtypename_"+curqno).val();
    if(qtypename=="Text")
    {
        if($('#texttype_'+qid).val() != '')
        {
          $('#button_next_'+qid).removeClass("action-btn-disabled");
          $('#btn_next_'+qid).removeClass("action-btn-disabled");
        }
    }
    if(qtypename=="Radio")
    {
        if($('#radio_other_text_'+qid).val() != '')
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
{  //alert(curqno);

    //alert(ans);
    //alert(currqid);
    if(nextids.length === 0)
    {
        nextids.push(1);
    }
    nextprev();
    var nextqid=parseInt(curqno)+parseInt(1);
   
    /////////////Code for question number////
    var nowqno = $("#setqno").val();
    var nowqno1 = parseInt(nowqno)+parseInt(1);
    $("#setqno").val(nowqno1);
    
    ///////////////////////////////////////////
    
    var totalquest=$("#totalquestion").val();
    var qtypename=$("#qtypename_"+curqno).val();
    //alert(qtypename);
    //all_question_id all_answers current_answer
    ///Add question id
    if($("#all_question_id").val()=="")
    {
         $("#all_question_id").val(qid);
         var posq="-1";
    }
    else
    {
        var setquestion = $("#all_question_id").val();
        var setquestionarray = setquestion.split(";");
       
        var nqid = qid+'';
        var posq = setquestionarray.indexOf(nqid);
        if(posq=="-1")
        {
            $("#all_question_id").val(setquestion+";"+qid);
        }
        else
        {
            answerposition=posq;
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
               var rad_other_value = $("#radio_other_text_"+qid).val();
               $("#current_answer").val(radioValue+"("+rad_other_value+")");
               if($('#radio_other_text_'+qid).val() != '')
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
                        $("#all_answers").val(prevans+";"+currentans);
                     }
                 }
                 else
                 {
                       var currentans=$("#current_answer").val();
                       var allans = $("#all_answers").val();
                       var ansarray = allans.split(";");
                       ansarray[posq]=currentans;
                       var fetchans = ansarray+'';
                       var testt21 = fetchans.replace(/,/g,";");
                       $("#all_answers").val(testt21);
                 }
                 $("#current_answer").val("");
                 /**********skip code**********/
                 //var skipqtval = parseInt(curqno)*parseInt(200);
                 if(skipval=="")
                 {
                     
                     $('#que_'+curqno).slideUp(200);
                     $('#que_'+nextqid).slideDown(200);
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
                    $('#que_'+curqno).slideUp(200);
                    $('#que_'+skipval).slideDown(200);
                    $("#displayqno_"+skipval).text(nowqno1);
                    if(skipval<=totalquest)
                    {
                     //$("#qsequence").val(qseq+";"+skipval);
                     nextids.push(skipval);
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
                      $("#all_answers").val(prevans+";"+currentans);
                   }
               }
               else
               {
                   var currentans=$("#current_answer").val();
                   var allans = $("#all_answers").val();
                   var ansarray = allans.split(";");
                   ansarray[posq]=currentans;
                  // alert(ansarray);
                   var fetchans = ansarray+'';
                   var testt21 = fetchans.replace(/,/g,";");
                   $("#all_answers").val(testt21);
                   
               }
               $("#current_answer").val("");
               /********* skip code***********/
                 //var skipqtval = parseInt(curqno)*parseInt(200);
                 if(skipval=="")
                 {
                     
                     $('#que_'+curqno).slideUp(200);
                     $('#que_'+nextqid).slideDown(200);
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
                    $('#que_'+curqno).slideUp(200);
                    $('#que_'+skipval).slideDown(200);
                    $("#displayqno_"+skipval).text(nowqno1);
                    if(skipval<=totalquest)
                    {
                     //$("#qsequence").val(qseq+";"+skipval);
                     nextids.push(skipval);
                    }
                 }
                 /********************/
            }
        }
        else if(qtypename=="Checkbox")
        {
            
            var selval=$("#chkselectedval_"+qid).val();
            $("#current_answer").val(selval);
            var checkValue = $("#current_answer").val();
            //alert(checkValue);
            var allvaluesset = checkValue.split("*");
            
            if(allvaluesset.length > 0)
            {
                for(var iii = 0; iii < allvaluesset.length; iii++) 
                { 
                    if(allvaluesset[iii]=="Other")
                    {
                        
                        var check_other_value = $("#check_other_text_"+qid).val();
                        var chkotherval=allvaluesset[iii]+"("+check_other_value+")";
                        allvaluesset.splice(iii, 1,chkotherval);
                    }
                }
            }
            var allvaluestarrep = allvaluesset+'';
            var test32 = allvaluestarrep.replace(/,/g,"*");
            
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
                    $("#all_answers").val(prevans+";"+currentans);
                    $("#chkselectedval_"+qid).val(currentans);
                 }
             }
             else
             {
                 var currentans=$("#current_answer").val();
                 var allans = $("#all_answers").val();
                 var ansarray = allans.split(";");
                 ansarray[posq]=currentans;
                  // alert(ansarray);
                 var fetchans = ansarray+'';
                 var testt21 = fetchans.replace(/,/g,";");
                 $("#all_answers").val(testt21);
             }
             $("#current_answer").val("");
             $('#que_'+curqno).slideUp(200);
             $('#que_'+nextqid).slideDown(200);
             $("#displayqno_"+nextqid).text(nowqno1);
             if(nextqid<=totalquest)
             {
               //$("#qsequence").val(qseq+";"+nextqid);
               nextids.push(nextqid);
             }
        }
        else if(qtypename=="Text")
        {  
            var textvalue = $("#texttype_"+qid).val();
            
            $("#current_answer").val(textvalue);
            if($('#texttype_'+qid).val() != '')
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
                       $("#all_answers").val(prevans+";"+currentans);
                   }
                   else
                   {
                       var currentans=$("#current_answer").val();
                       var allans = $("#all_answers").val();
                       var ansarray = allans.split(";");
                       ansarray[posq]=currentans;
                       var fetchans = ansarray+'';
                       var testt21 = fetchans.replace(/,/g,";");
                       $("#all_answers").val(testt21);
                   }
                }
                //alert(nextqid);
                $("#current_answer").val("");
                $('#que_'+curqno).slideUp(200);
                $('#que_'+nextqid).slideDown(200);
                $("#displayqno_"+nextqid).text(nowqno1);
                if(nextqid<=totalquest)
                { 
                    //$("#qsequence").val(qseq+";"+nextqid);
                    nextids.push(nextqid);
                }
            }
        }
        else
        {
            var othervalue = ans;
            
            
            $("#current_answer").val(othervalue);
            
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
                   $("#all_answers").val(prevans+";"+currentans);
               }
               else
               {   
                   var currentans=$("#current_answer").val();
                   var allans = $("#all_answers").val();
                   var ansarray = allans.split(";");
                   ansarray[posq]=currentans;
                   var fetchans = ansarray+'';
                   var testt21 = fetchans.replace(/,/g,";");
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
                     
                     $('#que_'+curqno).slideUp(200);
                     $('#que_'+nextqid).slideDown(200);
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
                    $('#que_'+curqno).slideUp(200);
                    $('#que_'+skipval).slideDown(200);
                    $("#displayqno_"+skipval).text(nowqno1);
                    if(skipval<=totalquest)
                    {
                     //$("#qsequence").val(qseq+";"+skipval);
                     nextids.push(skipval);
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
                {
                    $('#que_'+curqno).slideUp(200);
                    $('#que_'+nextqid).slideDown(200);
                    $("#displayqno_"+nextqid).text(nowqno1);
                    if(nextqid<=totalquest)
                    {
                     //$("#qsequence").val(qseq+";"+nextqid);
                     nextids.push(nextqid);
                    }
                }
                else
                {
                    //nextqid = skipos;   
                    $('#que_'+curqno).slideUp(200);
                    $('#que_'+skipos).slideDown(200);
                    $("#displayqno_"+skipos).text(nowqno1);
                    if(skipos<=totalquest)
                    {
                      // $("#qsequence").val(qseq+";"+skipos);
                       nextids.push(skipos);
                    }
                }
                
            }
            else if(qtypename=="Opinion Scale")
            {
                //0,0,5,0,0,0,0,0,0,0,0
                var skipval = $("#skip_"+subid).val();
                //alert(skipval);
                //$("#qsequence").val(qseq+";"+skipval);
                var skipvalarray = skipval.split(",");
                var skipos=skipvalarray[othervalue];
                if(skipos=="0")
                {
                    $('#que_'+curqno).slideUp(200);
                    $('#que_'+nextqid).slideDown(200);
                    $("#displayqno_"+nextqid).text(nowqno1);
                    if(nextqid<=totalquest)
                    {
                      //$("#qsequence").val(qseq+";"+nextqid);
                      nextids.push(nextqid);
                    }
                    
                }
                else
                {
                    //nextqid = skipos;
                    $('#que_'+curqno).slideUp(200);
                    $('#que_'+skipos).slideDown(200);
                    $("#displayqno_"+skipos).text(nowqno1);
                    if(skipos<=totalquest)
                    {
                       //$("#qsequence").val(qseq+";"+skipos);
                       nextids.push(skipos);
                    }
                    
                }
            }
            else
            {
                $('#que_'+curqno).slideUp(200);
                $('#que_'+nextqid).slideDown(200);
                $("#displayqno_"+nextqid).text(nowqno1);
                if(nextqid<=totalquest)
                {
                  //$("#qsequence").val(qseq+";"+nextqid);
                  nextids.push(nextqid);
                }
            }
        }
   //alert(nextids);
}

function nextprev()
{
    //////////////////////Next Prev Code For Change//////////////////////////
    var id = $('.item:visible').data('id');
    var prevId = $('.item:visible').data('id')-1;
    var nextId = $('.item:visible').data('id')+1;
    var totalquest=$("#totalquestion").val();
    var submitcnt = parseInt(totalquest)+parseInt(1);
    
    if(id == totalquest){
        $('.next').hide();
    }
    if(prevId < totalquest){
        $('.next').show();
    }
    if(prevId == 1){
        $('.back').hide();
    }
    
    if(nextId > 1){
        $('.back').show();
    }
    if(nextId == submitcnt){
        $('.next').hide();
    }
    // if(id<totalquest)
    // {
    //      $("#lastsubmit").hide();
    // }
    
    
    ///////////////////////////////////////////////
    var required = $("#required_"+id).val();
    var nextrequired = $("#required_"+nextId).val();
    
    if(nextrequired=="Yes")
    {
        $(".next").addClass("disabled");
    }
    else
    {
        $(".next").removeClass("disabled");
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

function setcheckboxquestans(curqno,subid,qid,ans)
{
    
    var checkValue = ans;
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
          var chkt=chkvalcurrent.split("*");
          var checkValue22 = checkValue+'';
          var poschk = chkt.indexOf(checkValue22);
          if(poschk!="-1")
          {
              chkt.splice(poschk, 1);
              var chktans = chkt+'';
              var test221 = chktans.replace(/,/g,"*");
              $("#chkselectedval_"+qid).val(test221);
          }
          
       }
       
    }
    else
    {
       
       if(ischecked==true)
       {
          var prevans = $("#chkselectedval_"+qid).val();
          $("#chkselectedval_"+qid).val(prevans+"*"+checkValue);
       }
       else
       {
          var chkvalcurrent=$("#chkselectedval_"+qid).val();
          //alert(chkvalcurrent);
          var chkt=chkvalcurrent.split("*");
          var checkValue22 = checkValue+'';
          var poschk = chkt.indexOf(checkValue22);
          if(poschk!="-1")
          {
              chkt.splice(poschk, 1);
              var chktans = chkt+'';
              var test221 = chktans.replace(/,/g,"*");
              $("#chkselectedval_"+qid).val(test221);
          }
          
       }
       
    }
}


//percentage

function progressBar(progressVal,totalPercentageVal = 100) {
    var strokeVal = (1.90 * 100) /  totalPercentageVal;
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

function SetAttempted(div,seq,qid) {
    //alert(seq);
$(div).parent().parent().attr("isAttempted", "1");
checkAttempt(seq,qid);
}

function checkAttempt(seq,qid){
    //alert(seq);
    var attemptedCount = seq;
    $('#divQstn div').each(function (i, ele) {
        // var qId = $(this).attr("qId");
         var isAttempted = $(this).attr("isAttempted");
         //alert(isAttempted);
         var c = 1;
         
         if(isAttempted=="1"){
            //attemptedCount ++;
            attemptedCount=seq;
            // var setquestion = $("#all_question_id").val();
            // var setquestionarray = setquestion.split(";");
           
            // var nqid = qid+'';
            // //alert(nqid);
            // var posq = setquestionarray.indexOf(nqid);
            // //alert(posq);
            // if(posq=="-1")
            // {
            //     attemptedCount=seq;
            // }
            // else
            // {
            //     attemptedCount=seq;
            // }
            
            
         }
    });
    // var totalquest=$("#totalquestion").val();
    // // alert(totalquest);
    // // alert(attemptedCount);
    // if(totalquest==attemptedCount)
    // {
    //      $("#lastsubmit").show();
    // }
          var average1 = 100/total_ques;
          //var average1 = Math.round(average1);
           //var average1 = average1.toFixed(0);
            //alert(attemptedCount);
            if(average1*attemptedCount>=100){
              progressBar(100,100);
              //$("#lastsubmitform").show();
              //$("#footerdisplay").hide();
              }else{
                  progressBar(parseInt(average1*attemptedCount),100);
              }
}


function rank_order_sequence1(subqueid,queid){
    var subqueid = subqueid;
    var queid = queid;
    var entseq = $('#order_'+subqueid).val();
    checksequence(subqueid);
    
    if(seq_error_message === false)
    $.ajax({
            url : "<?php echo SITEPATHFRONT; ?>check_rank_order_sequence_duplication.php",
            type : "POST",
            data : {subqueid:subqueid,queid:queid,entseq:entseq},
            success: function(dataseq){
                alert(dataseq);
                //$("#rank_seq_error").html(dataseq);
                 /*$.ajax({
                        url : "<?php  echo SITEPATHFRONT; ?>rank_order_sequence_action.php",
                        type : "POST",
                        data : {subqueid:subqueid,queid:queid,entseq:entseq},
                        success: function(dataquestion){
                          $("#rank_order_que").html(dataquestion);
                        }
                   });*/
               }
              
            }); 
    
}


   $('select[name*="order_"]').change(function() {
    var selectedOptions = $('select option:selected');
    $('select option').removeAttr('disabled');
    selectedOptions.each(function() {        
        var value = this.value;
        if (value !== ''){           
        var id = $(this).parent('select[name*="order_"]').attr('id');
        var options = $('select:not(#' + id + ') option[value=' + value + ']');
        options.attr('disabled', 'true');
        }
    });
});	


function checksequence(subqueid,qid){
     var seq = $('#order_'+subqueid).val();
        if(seq == '')
        {
            $('#seq_error_message').show();
            $('#seq_error_message').html("Select all Orders");
        }
        else
        {
            $('#seq_error_message').hide();
        } 
}
</script>