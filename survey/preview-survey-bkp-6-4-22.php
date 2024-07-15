<?php 
require_once("../survey/classes/cls-request.php");
require_once("../survey/classes/cls-template.php");
require_once("../survey/classes/cls-survey.php");

$obj_request = new Request();
$obj_template= new Template();
$obj_survey = new Survey();

/*if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}*/

$surveyid=$_GET['surveyid'];

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
   $user_id=$all_surveys_detail['user_id'];
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
include('admin-common-header.php')?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>

<style>
.common-header-main{
display:none;
}
html {
  scroll-behavior: smooth;
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
/*==== Rank Order ====*/
.rank_ord{
    margin-top: 24px;
    padding: 7px 0px 7px 0px;
    font-size: 13px;
    width: 100%;
    border-radius: 5px;
    font-weight: 600;
    color:#000;
    background: #ffffff;
    border:1px solid #fff;
    text-align:center;
}
.rank_ord::-moz-placeholder{
   font-weight:500;
   font-size:9px;
}
 .rank_label{
    border: 1px solid #ddd;
    padding: 7px 17px;
    border-radius: 5px;
    color: #fff;
    width: 100%;
    margin-top: 24px;
    font-size: 13px;
    justify-content: left;
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
}
.disabled {
    opacity: 0.5;
    cursor: not-allowed;
    text-decoration:none!important;
    pointer-events: none;
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
                            
                            <div class="col-lg-8 offset-lg-2 col-md-10 que_section offset-md-1" id="divQstn">
                                
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
                             ?>
                        
                                   <!--Question Type Boolean-->
                                    <?php if($all_question['quest_type_id'] == "1") {  ?> 
                                    <div id="que_<?php echo $srno;?>" style="display:none" class="que_scroll item mt-4 mb-5 boolean-que-type"  data-id='<?php echo $srno;?>'  isAttempted="0">
                                     <div class="align-txt">
                                         <h4>Question <span id="displayqno_<?php echo $srno;?>"></span></h4>
                                         <?php if($all_question['tooltip']!=""){
                                            $str_tooltip = ($all_question['tooltip']);
                                            $replace_tooltip = str_replace("'","","$str_tooltip");
                                            ?>
                                             <div class="tooltip"><span data-tooltip='<?php echo $replace_tooltip; ?>' data-tooltip-position="left">
                                                 <i class="fa fa-info-circle"></i></span>
                                             </div>
                                            <?php }?>
                                    </div>
                                     <div class="toolt">
                                        <p><?php echo stripslashes($all_question['question_title']);?></p>
                                        
                                    </div>
                                        <input type="hidden" name="qtypename_<?php echo $srno;?>" id="qtypename_<?php echo $srno;?>" value="<?php echo $qtypename?>">
                                        <input type="hidden" name="qidthis_<?php echo $srno;?>" id="qidthis_<?php echo $srno;?>" value="<?php echo $all_question['question_id'];?>">
                                        <input type="hidden" name="required_<?php echo $srno;?>" id="required_<?php echo $srno;?>" value="<?php echo $all_question['is_required'];?>">
                                        <input type="hidden" name="skip_from_<?php echo $srno;?>" id="skip_from_<?php echo $srno;?>" value="<?php echo $all_question['skip_from_which_question'];?>">
                                          <div class="col-12 pb-5">
                                              <div class="d-flex align-items-center boolean_que_type">
                                                <?php foreach($all_subpoints as $all_subpoint){ ?>  
                                                    <input type="hidden" name="skip_<?php echo $all_subpoint['question_subid'];?>" id="skip_<?php echo $all_subpoint['question_subid'];?>" value="<?php echo $all_subpoint['skip_question'];?>">
                                                    <input class="checkbox-tools" type="radio" name="bool_<?php echo $srno;?>" id="bool_<?php echo $all_subpoint['question_subid'];?>" value="<?php echo stripslashes($all_subpoint['question_subtitle']);?>" onchange="SetAttempted(this,<?php echo $all_question['sequence'];?>,<?php echo $all_question['question_id'];?>)" onclick="setnext(<?php echo $srno;?>,<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,this.value);">
                            						<label class="for-checkbox-tools boolean_yes_no" for="bool_<?php echo $all_subpoint['question_subid'];?>">
                            							<?php if($all_subpoint['question_subtitle'] == "Yes"){ ?> <i class='fa fa-thumbs-up'></i><?php } ?>
                            							<?php if($all_subpoint['question_subtitle'] == "No"){ ?> <i class='fa fa-thumbs-down'></i><?php } ?>
                            	                      
                            							<p><?php echo stripslashes($all_subpoint['question_subtitle']);?></p>
                            						</label>
                        				        <?php } ?>	
                    				        </div>
            				        	</div>
    				                </div>
    				            <?php } ?>
    				            
    				            
    				            <!--Question Type Radio-->
                                <?php if($all_question['quest_type_id'] == "2") {  ?> 
                                   <div id="que_<?php echo $srno;?>" style="display:none" class="que_scroll item mt-4 mb-5 radio-scroll-vt" data-id='<?php echo $srno;?>' isAttempted="0">
                                   <div class="align-txt">
                                       <h4>Question <span id="displayqno_<?php echo $srno;?>"></span></h4>
                                        <?php if($all_question['tooltip']!=""){?>
                                             <div class="tooltip"><span data-tooltip="<?php echo $all_question['tooltip']; ?>" data-tooltip-position="left">
                                                 <i class="fa fa-info-circle"></i>
                                                 </span>
                                             </div>
                                        <?php }?>
                                   </div>
                                   <div class="toolt">
                                        <p><?php echo stripslashes($all_question['question_title']);?></p>
                                   
                                    </div>
                                  
                                    <input type="hidden" name="qtypename_<?php echo $srno;?>" id="qtypename_<?php echo $srno;?>" value="<?php echo $qtypename?>">
                                    <input type="hidden" name="qidthis_<?php echo $srno;?>" id="qidthis_<?php echo $srno;?>" value="<?php echo $all_question['question_id'];?>">
                                    <input type="hidden" name="required_<?php echo $srno;?>" id="required_<?php echo $srno;?>" value="<?php echo $all_question['is_required'];?>">
                                     <input type="hidden" name="skip_from_<?php echo $srno;?>" id="skip_from_<?php echo $srno;?>" value="<?php echo $all_question['skip_from_which_question'];?>">
                                      
                                        <?php if(count($all_subpoints)>=7){ ?>
                                        <div class="col-md-12 pb-5 sub_points_down scroll-css" id="sub_scrollbar_diff">
                                        <?php }else{ ?>
                                        <div class="col-md-12 pb-5 sub_points_down" id="sub_scrollbar_diff">
                                        <?php }?>
                                        
                                    <div class="d-flex align-items-center wrap-content row">
                					       
                					            <?php $counter = 0; foreach($all_subpoints as $all_subpoint){ $counter++; ?> 
                					       
                					        <div class="col-md-6">
                        					        <input type="hidden" name="skip_<?php echo $all_subpoint['question_subid'];?>" id="skip_<?php echo $all_subpoint['question_subid'];?>" value="<?php echo $all_subpoint['skip_question'];?>">
                            						<input class="checkbox-tools" type="radio" name="radiotype_<?php echo $srno;?>" id="radiotype_<?php echo $all_subpoint['question_subid'];?>" onchange="SetAttempted(this,<?php echo $all_question['sequence'];?>,<?php echo $all_question['question_id'];?>);" value='<?php echo stripslashes(str_replace("'", '"', $all_subpoint['question_subtitle'])) ;?>' <?php if($all_subpoint['question_subtitle']!="Other"){?> onclick="setnext('<?php echo $srno;?>','<?php echo $all_subpoint['question_subid'];?>',<?php echo $all_question['question_id'];?>,this.value);" <?php } else {?> onclick="showradtextbox(<?php echo $all_question['question_id'];?>);" <?php }?>>
                            						<label class="for-checkbox-tools radio-check-box for_radio_label_charcount" for="radiotype_<?php echo $all_subpoint['question_subid'];?>">
                            							<p class="survey-txt"><?php echo stripslashes($all_subpoint['question_subtitle']);?></p>
                            						</label>
                        							    <input type="hidden" value="<?php echo strlen(stripslashes($all_subpoint['question_subtitle']));?>" id="rdo_sub_char_count_<?php echo $counter; ?>" name="rdo_sub_char_count">
                        					   </div>
                    					            <?php } ?>
                    					            <input type="hidden" value="<?php echo count($all_subpoints); ?>" id="arr_count_rdo" name="arr_count_rdo">
                    					        
                    				    	    
                    					</div>
                    						<input type="hidden" value="<?php echo $counter;?>" id="rdo_sub_count" name="rdo_sub_count">
                    						<div class="" style="display:none" id="radio_other_text_field_<?php echo $all_question['question_id'];?>">
                    						<div class="form__group field">
                                                 <input type="text" class="form__field effect-2" autocomplete = "off" placeholder="Please Enter Your Response" name="radio_other_text_<?php echo $all_question['question_id'];?>" id='radio_other_text_<?php echo $all_question['question_id'];?>' value="" onkeyup="activenextbutton(<?php echo $srno;?>,<?php echo $all_question['question_id'];?>)"/>
                                               </div>
                                               <div class="button" id="button" onclick="setnext(<?php echo $srno;?>,<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,'');">
                                                 <div id="slide" class="slide"></div>
                                                  <a href="javascript:void(0);" class="action-btn-disabled save-next-btn" id="btn_next_other_radio_<?php echo $all_question['question_id'];?>">Save & Next &nbsp;&nbsp;<i class="fa fa-angle-right"></i></a>
                                               </div>
                                            </div>  
                					    </div>
                					   </div>
                			       <?php  } ?>
                		        
                		        <!--Question Type Checkbox-->
                		        <?php if ($all_question['quest_type_id'] == "3") { ?>
				                 <div id="que_<?php echo $srno;?>" style="display:none" class="que_scroll item mt-1 checkbox-scroll-vt" data-id='<?php echo $srno;?>' isAttempted="0">
                                   <div class="align-txt">
                                        <h4>Question <span id="displayqno_<?php echo $srno;?>"></span></h4>
                                         <?php if($all_question['tooltip']!=""){?>
                                                 <div class="tooltip"><span data-tooltip="<?php echo $all_question['tooltip']; ?>" data-tooltip-position="left">
                                                     <i class="fa fa-info-circle"></i></span>
                                                 </div>
                                            <?php }?>
                                    </div>
                                    <div class="toolt">
                                        <p><?php echo stripslashes($all_question['question_title']);?></p>
                                    </div>
                                    
                                    <input type="hidden" name="qtypename_<?php echo $srno;?>" id="qtypename_<?php echo $srno;?>" value="<?php echo $qtypename?>">
                                    <input type="hidden" name="qidthis_<?php echo $srno;?>" id="qidthis_<?php echo $srno;?>" value="<?php echo $all_question['question_id'];?>">
                                    <input type="hidden" name="required_<?php echo $srno;?>" id="required_<?php echo $srno;?>" value="<?php echo $all_question['is_required'];?>">
                                    <input type="hidden" name="chkselectedval_<?php echo $all_question['question_id'];?>" id="chkselectedval_<?php echo $all_question['question_id'];?>" value="">  
                                     <input type="hidden" name="skip_from_<?php echo $srno;?>" id="skip_from_<?php echo $srno;?>" value="<?php echo $all_question['skip_from_which_question'];?>">
                                       <div class="chk_class">
            				                     
            				                         
            				             <?php if(count($all_subpoints)>=7){ ?>
                                            <div class="row pb-4 sub_points_down_chk scroll-css" id="sub_scrollbar_diff">
                                        <?php }else{ ?>
                                        <div class="row pb-4 sub_points_down_chk" id="sub_scrollbar_diff">
                                        <?php }?>
            				                         
            				                        <?php $counter = 0; foreach($all_subpoints as $all_subpoint){ $counter++; ?>
                                                     <div class="col-md-6">
                                                          <input id="chkbox_<?php echo $all_subpoint['question_subid'];?>" type="checkbox" name="chkbox" value='<?php echo stripslashes(str_replace("'", '"', $all_subpoint['question_subtitle']));?>' onchange="SetAttempted(this,<?php echo $all_question['sequence'];?>,<?php echo $all_question['question_id'];?>)" <?php if($all_subpoint['question_subtitle']=="Other"){?> onclick="showchktextbox(<?php echo $all_question['question_id'];?>,<?php echo $all_subpoint['question_subid'];?>);setcheckboxquestans(<?php echo $srno;?>,<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,this.value);" <?php } else  {?> onclick="setcheckboxquestans(<?php echo $srno;?>,<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,this.value);" <?php }?>>
                                                            <label for="chkbox_<?php echo $all_subpoint['question_subid'];?>">
                                                                <span class="float-start text-dark span" id="<?php echo $all_subpoint['question_subid'];?>"><?php echo $counter; ?></span> &nbsp; 
                                                                <p class="survey-txt"><?php echo stripslashes($all_subpoint['question_subtitle']);?></p>
                                                            </label>
                                                     </div>
                                                     <?php }  ?>
                                                     <input type="hidden" value="<?php echo count($all_subpoints);?>" id="chk_sub_count" name="chk_sub_count">
                                                    <div class="" style="display:none" id="check_other_text_field_<?php echo $all_question['question_id'];?>">
                            						   <div class="form__group field">
                                                         <input type="text" class="form__field effect-2" autocomplete = "off" placeholder="Please Enter Your Response" name="check_other_text_<?php echo $all_question['question_id'];?>" id='check_other_text_<?php echo $all_question['question_id'];?>' value="" onkeyup="activenextbutton(<?php echo $srno;?>,<?php echo $all_question['question_id'];?>)"/>
                                                       </div>
                                                       
                                                    </div> 
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 mt-2 mb-4">
                                                            <div class="button next-btn-q" id="btn_next_check" onclick="setnext(<?php echo $srno;?>,<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,'');">
                                                             <div id="slide" class="slide"></div>
                                                              <a href="javascript:void(0);" class="action-btn-disabled save-next-btn" id="btn_next_other_check_<?php echo $all_question['question_id'];?>">Save & Next &nbsp;&nbsp;<i class="fa fa-angle-right"></i></a>
                                                        
                                                            </div>
                                                         </div>
                                                     </div>
                                                 </div>
                                           </div>
                
                                     <!--</div>-->
                                <?php } ?>
                		        
                		        <!--Question Type Text-->
                				<?php if($all_question['quest_type_id']=="4") { ?> 
                                    <div id="que_<?php echo $srno;?>" style="display:none" class="item mt-4 mb-5 que-type-txt"  data-id='<?php echo $srno;?>'  isAttempted="0">
                                        <div class="align-txt">
                                             <h4>Question <span id="displayqno_<?php echo $srno;?>"></span></h4>
                                             <?php if($all_question['tooltip']!=""){?>
                                                 <div class="tooltip"><span data-tooltip="<?php echo $all_question['tooltip']; ?>" data-tooltip-position="left">
                                                     <i class="fa fa-info-circle"></i></span>
                                                 </div>
                                            <?php }?>
                                        </div>
                                        <div class="toolt">
                                             <p><?php echo stripslashes($all_question['question_title']);?></p>
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
                                                 <input type="text" autocomplete = "off" class="form__field effect-2" placeholder="Please Enter Your Response" name="texttype" id='texttype_<?php echo $all_question['question_id'];?>' value="" onkeyup="activenextbutton(<?php echo $srno;?>,<?php echo $all_question['question_id'];?>)" onchange="SetAttempted(this,<?php echo $all_question['sequence'];?>,<?php echo $all_question['question_id'];?>)"/>
                                                 <?php }?>
                                                 <?php if($texttype=="textarea"){?>
                                                 <textarea class="form__field effect-2" placeholder="Please Enter Your Response" name="texttype" id='texttype_<?php echo $all_question['question_id'];?>' value="" onkeyup="activenextbutton(<?php echo $srno;?>,<?php echo $all_question['question_id'];?>)" onchange="SetAttempted(this,<?php echo $all_question['sequence'];?>,<?php echo $all_question['question_id'];?>)"></textarea>
                                                 <?php }?>
                                               </div>
                                               
                                                <div class="button action-btn-disabled" id="button_next_<?php echo $all_question['question_id'];?>" onclick="setnext(<?php echo $srno;?>,<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,'');">
                                                 <div id="slide" class="slide"></div>
                                                  <a class="action-btn-disabled save-next-btn" href="javascript:void(0);" id="btn_next_<?php echo $all_question['question_id'];?>">Save & Next &nbsp;&nbsp;<i class="fa fa-angle-right"></i></a>
                                                </div>
                                               
                                               
                                               
                                               
                                    </div>
                                    <?php } ?>  
                                    
                                <!--Question Type Rating-->    
                                <?php if ($all_question['quest_type_id'] == "5") {  ?> 
				                 <div id="que_<?php echo $srno;?>" style="display:none" class="item mt-4" data-id='<?php echo $srno;?>' isAttempted="0">
                                         <div class="align-txt">
                                            <h4>Question <span id="displayqno_<?php echo $srno;?>"></span></h4>
                                            <?php if($all_question['tooltip']!=""){?>
                                             <div class="tooltip"><span data-tooltip="<?php echo $all_question['tooltip']; ?>" data-tooltip-position="left"><i class="fa fa-info-circle"></i></span></div>
                                            <?php }?>
                                         </div>
                                        <div class="toolt">
                                            <p><?php echo stripslashes($all_question['question_title']);?></p>
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
                                    <div class="align-txt">
                                        <h4>Question <span id="displayqno_<?php echo $srno;?>"></span></h4>
                                        <?php if($all_question['tooltip']!=""){?>
                                             <div class="tooltip"><span data-tooltip="<?php echo $all_question['tooltip']; ?>" data-tooltip-position="left"><i class="fa fa-info-circle"></i></span></div>
                                        <?php }?>
                                    </div>
                                    <div class="toolt">
                                        <p><?php echo stripslashes($all_question['question_title']);?></p>
                                    </div>
                                    <input type="hidden" name="qtypename_<?php echo $srno;?>" id="qtypename_<?php echo $srno;?>" value="<?php echo $qtypename?>">
                                    <input type="hidden" name="qidthis_<?php echo $srno;?>" id="qidthis_<?php echo $srno;?>" value="<?php echo $all_question['question_id'];?>">
                                    <input type="hidden" name="required_<?php echo $srno;?>" id="required_<?php echo $srno;?>" value="<?php echo $all_question['is_required'];?>">
                                     <input type="hidden" name="skip_from_<?php echo $srno;?>" id="skip_from_<?php echo $srno;?>" value="<?php echo $all_question['skip_from_which_question'];?>">
                                      <div class="row pb-4 dropdown-list">
                                      
                                      <?php if(count($all_subpoints)>=7){ ?>
                                                <div class="row pb-4 dropdown-list scroll-css">
                                        <?php }else{ ?>
                                                <div class="row pb-4 dropdown-list">
                                        <?php }?>
                                      
                                        <?php $counter = 0; foreach($all_subpoints as $all_subpoint){ $counter++;?>
                                          <div class="col-md-6">
                                             <input class="checkbox-tools1" value='<?php echo stripslashes(str_replace("'", '"', $all_subpoint['question_subtitle']));?>' type="radio" name="dropdown_<?php echo $srno;?>" id="dropdown_<?php echo $all_subpoint['question_subid'];?>" onchange="SetAttempted(this,<?php echo $all_question['sequence'];?>,<?php echo $all_question['question_id'];?>)" onclick="setnext(<?php echo $srno;?>,<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,this.value)">
                    						    <label class="for-checkbox-tools float-start" for="dropdown_<?php echo $all_subpoint['question_subid'];?>">
                    						         <span class="float-end text-dark span"><?php echo $counter; ?></span>&nbsp;
                    							     <P class="survey-txt"><?php echo stripslashes($all_subpoint['question_subtitle']);?></P>
                						    </label>
                                          </div>
                                         <?php } ?>
                                        <input type="hidden" name="dropdown-count" id="dropdown-count" value="<?php echo count($all_subpoints); ?>">
        				        	</div>
				                </div>
				                
				                <?php } ?>
        				        
                                <!--Question Type Opinion Scale-->
                                <?php if ($all_question['quest_type_id'] == "7") { ?>
                                        <div id="que_<?php echo $srno;?>" style="display:none" class="item mt-4" data-id='<?php echo $srno;?>'  isAttempted="0">
                                        <div class="align-txt">
                                             <h4>Question <span id="displayqno_<?php echo $srno;?>"></span></h4>
                                             <?php if($all_question['tooltip']!=""){?>
                                             <div class="tooltip"><span data-tooltip="<?php echo $all_question['tooltip']; ?>" data-tooltip-position="left"><i class="fa fa-info-circle"></i></span></div>
                                            <?php }?>
                                        </div>
                                        <div class="toolt">
                                            <p><?php echo stripslashes($all_question['question_title']);?></p>
                                        </div>
                                         <input type="hidden" name="qtypename_<?php echo $srno;?>" id="qtypename_<?php echo $srno;?>" value="<?php echo $qtypename?>">
                                         <input type="hidden" name="qidthis_<?php echo $srno;?>" id="qidthis_<?php echo $srno;?>" value="<?php echo $all_question['question_id'];?>">
                                         <input type="hidden" name="required_<?php echo $srno;?>" id="required_<?php echo $srno;?>" value="<?php echo $all_question['is_required'];?>">
                                          <input type="hidden" name="skip_from_<?php echo $srno;?>" id="skip_from_<?php echo $srno;?>" value="<?php echo $all_question['skip_from_which_question'];?>">
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
                
                                <?php if ($all_question['quest_type_id'] == "8") { $spqstsubids=""; $spqstsubval="";?> 
                                  <div id="que_<?php echo $srno;?>" style="display:none" class="que_scroll item mt-1 mb-3" 
                                    data-id='<?php echo $srno;?>'  isAttempted="0">
                                      <div class="align-txt">
                                        <h4>Question <?php echo $all_question['sequence'];?></h4>
                                         <?php if($all_question['tooltip']!=""){?>
                                             <div class="tooltip"><span data-tooltip="<?php echo $all_question['tooltip']; ?>" data-tooltip-position="left">
                                                 <i class="fa fa-info-circle"></i></span>
                                             </div>
                                        <?php }?>
                                    </div>
                                    <div class="toolt">
                                        <p><?php echo stripslashes($all_question['question_title']);?> (Rank your options by drag & drop)</p>
                                    </div>
                                    <input type="hidden" name="qtypename_<?php echo $srno;?>" id="qtypename_<?php echo $srno;?>" value="<?php echo $qtypename?>">
                                    <input type="hidden" name="qidthis_<?php echo $srno;?>" id="qidthis_<?php echo $srno;?>" value="<?php echo $all_question['question_id'];?>">
                                    <input type="hidden" name="required_<?php echo $srno;?>" id="required_<?php echo $srno;?>" value="<?php echo $all_question['is_required'];?>">
                                    <input type="hidden" name="orderselectedval_<?php echo $all_question['question_id'];?>" id="orderselectedval_<?php echo $all_question['question_id'];?>" value="">  
                                    <input type="hidden" name="orderselectedid_<?php echo $all_question['question_id'];?>" id="orderselectedid_<?php echo $all_question['question_id'];?>" value="">  
                                    <input type="hidden" name="rank_cnt_<?php echo $all_question['question_id'];?>" id="rank_cnt_<?php echo $all_question['question_id'];?>" value="<?php echo count($all_subpoints);?>">
                                    <div class="row">
                                        <div class="col-md-8"></div>
                                        <div class="col-md-4">
                                            <div class="star" id="seq_error_message_<?php echo $all_question['question_id'];?>"></div> 
                                        </div>
                                    </div>
                                    <div class="row" id="rank_order_que">
                                        <?php if(count($all_subpoints)>=7){ ?>
                                                    <div class="row pb-5 sub_points_rank scroll-css" id="sub_scrollbar_diff">
                                        <?php }else{ ?>
                                                <div class="row pb-5 sub_points_rank" id="sub_scrollbar_diff">
                                        <?php }?>
                                         
                                          <div class="col-md-2">
                                              <?php $ranksrno=1; foreach($all_subpoints as $all_subpoint){ //$counter++;
                                                  $spqstsubids.=$all_subpoint['question_subid'].",";
                                                  $spqstsubval.=$all_subpoint['question_subtitle']."::".$all_subpoint['rank_order_sequence']."*";
                                              ?>
                    							  <div class="rank_ord checkbox-tools1 float-end">
                    							    <span>
                                                        <?php echo $ranksrno; ?> 
                                                    </span> 
                                                  </div>
                    							   <?php $ranksrno++;} ?>
                                          </div>
                                          
                                          <div class="col-md-10" id="list_<?php echo $all_question['question_id'];?>">
                                                 <?php $counter=0; foreach($all_subpoints as $all_subpoint_seq){ $counter++?>
                                                 
                                                    
                                                    <label class="for-checkbox-tools rank_label float-start" for="order_<?php echo $all_subpoint_seq['question_subid'];?>" id="order_<?php echo $all_subpoint_seq['question_subid'];?>" name="order_<?php echo $all_subpoint_seq['question_subid'];?>" style="cursor:move;">
                    							     <!--<span class="float-end text-dark span" id="seqord_<?php echo $all_subpoint_seq['question_subid'];?>"><?php echo $all_subpoint_seq['rank_order_sequence']; ?></span>&nbsp;-->
                    							     <span class="ml-3"><?php echo stripslashes($all_subpoint_seq['question_subtitle']);?></span>
                    							    </label>
                                                 
                                                 <?php }?>
                        							 <input type="hidden" id="sub_qst_id_<?php echo $srno;?>" name="sub_qst_id_<?php echo $srno;?>" value="<?php echo $all_subpoint_seq['question_id'];?>">
                                                    <input type="hidden" id="rank_order_count" name="rank_order_count" value="<?php echo count($all_subpoints); ?>">
                                          </div>
                                         
                                        
                                          <input type="hidden" value="<?php echo $counter;?>" id="rank_sub_count" name="rank_sub_count">
                                          <input type="hidden" value="<?php echo trim($spqstsubval,"*");?>" id="allsubval_<?php echo $all_question['question_id'];?>" name="allsubval_<?php echo $all_question['question_id'];?>">
                                          <input type="hidden" value="<?php echo trim($spqstsubids,",");?>" id="allsubid_<?php echo $all_question['question_id'];?>" name="allsubid_<?php echo $all_question['question_id'];?>">
        				                </div>
        				        	</div>
        				        	 <div class="col-md-12 mt-2 mb-4">
            				        	 <div class="button next-btn-rank" id="button_next_order_<?php echo $all_question['question_id'];?>" onclick="SetAttempted(this,<?php echo $all_question['sequence'];?>,<?php echo $all_question['question_id'];?>);setnext(<?php echo $srno;?>,<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,'');">
                                             <div id="slide" class="slide"></div>
                                             <a class="save-next-btn" href="javascript:void(0);" id="button_next_order_<?php echo $all_question['question_id'];?>">Save & Next &nbsp;&nbsp;<i class="fa fa-angle-right"></i></a>
                                        </div>
                                    </div>
				                </div>
				                <?php } ?>
                                   
                                   
                              <?php $srno++;} ?>
                                <div class="col-md-12 item mt-5" id="que_<?php echo $srno;?>" data-id="<?php echo $srno;?>" style="display:none;">
                                    <div class="col-md-12">
                                        <div class="success-content text-center mt-5" >
                                            <h1 class="text-white first_survey_heading"><strong class="mt-10">We really appreciate your time and feedback.</strong></h1>
                                            <h1 class="first_survey_heading"><i class="fa fa-smile-o text-amber-200" aria-hidden="true"></i></h1>
                                            <p class="mt-1"><img class="logo-dash-temp" src="<?php echo SITEPATH; ?>images/logo-dark.png"></p>
                                        </div>
                                    </div>  
                                </div> 
                                <input type="hidden" name="totalquestion" id="totalquestion" value="<?php echo count($all_questions);?>">
                                </div> 
                            </div>
                            <!--Intro page section-->
                        
                            <div class="row">
                                    <div class="col-md-12 text-center mt-5 mb-5 p-3" id="temp_section">
                                       <h1 class="text-white first_survey_heading"><strong><?php echo $survey_title;?></strong></h1>
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
                                                 <div class="progress no-mob-progress-bar">
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
                                                         <div class="col-lg-8 col-md-6">
                                                              <div class="text-right cmp_logo_text">
                                                                 <i class="text-white">made with</i>
                                                                <p><img class="logo-dash-temp img-fluid" src="<?php echo SITEPATHFRONT; ?>images/logo-dark.png"></p>
                                                              </div>
                                                         </div>
                                                         <div class="col-lg-4 col-md-6">
                                                             <a id="next" class="next btn_slider btn_slider_dir rounded-circle"><i class="fa fa-angle-down"></i></a>
                                                            <a id="prev" class="back btn_slider btn_slider_dir rounded-circle"><i class="fa fa-angle-up"></i></a>
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
   <!-- Mobile progress bar -->
    <div class="row">  
      <div class="col-md-12">
        <div class="scrollBar1"></div>
      </div>    
    </div>
    <!-- End Mobile Progress bar -->
                </section>
      <div id="demo3"></div>
    

<!--<div class="scrollBar2"><span></span></div> -->

</div>

<?php //include('footer.php')?>
<style>
    .common-footer-main{display:none !important;}
    .star{color:red;font-size:15px;}
</style>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script>
//$(document).ready(function(){

  //  $(document).scroll(function (e) {
//   var scrollAmount = $(window).scrollTop();
//   var documentHeight = $(document).height();
//   var windowHeight = $(window).height();
//   var scrollPercent = (scrollAmount / (documentHeight - windowHeight)) * 100;
//   var roundScroll = Math.round(scrollPercent);
  
//   // For scrollbar 1
//   $(".scrollBar1").css("width", scrollPercent + "%");
//   $(".scrollBar1 span").text(roundScroll);
  
//   // For scrollbar 2
//   $(".scrollBar2").css("height", scrollPercent + "%");
//   $(".scrollBar2 span").text(roundScroll);
//});

//});

</script>

<script>

var nextids=[];
var orderids=[];
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
                 //$('.back').hide();
                 $(".back").addClass("disabled");
               }
                
                var required = $("#required_"+currqid).val();
                
                if(required=="Yes")
                {
                    $(".next").addClass("disabled");
                }
                
                
                var qtypename=$("#qtypename_"+currqid).val();
                if(qtypename=="Order")
                {
                  setorderval(currqid);
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
            $("#lastsubmit").click(function(){
                //all_question_id all_answers
                check_fname();
                check_email();
                
                var allquestionids =$("#all_question_id").val();
                var allanswers = $("#all_answers").val();
                var fname = $("#fname").val().trim();
                var email = $("#email").val();
                
                if(fname_error_message === false && email_error_message === false)
                {
                    $.ajax({
        				url: "<?php echo SITEPATHFRONT; ?>survey-view-action.php",
        				type: "POST",
        				data: {allquestionids:allquestionids,allanswers:allanswers,fname:fname,email:email,surveyid:"<?php echo $surveyid?>",userid:<?php echo $user_id?>},
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
    var setquestionarray12 = setquestion12.split(";");
   
    var nqid12 = qid22+'';
    var posq12 = setquestionarray12.indexOf(nqid12);
    //alert(posq12);
    if(posq12=="-1")
    {//alert(required);
       if(required=="No" || required=="")
       {
            $(".next").removeClass("disabled");
            $('#que_'+id).slideUp(200);
            $('#que_'+nextId).slideDown(200);
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
            if(nextId > 1){
                //$('.back').show();
                $(".back").removeClass("disabled");
            }
            //alert(nextId);
        //alert(submitcnt);
            if(nextId == submitcnt){
               // alert("hello");
                $(".next").addClass("disabled");
               // $('.next').hide();
            }
        }
        else
        { 
           $(".next").addClass("disabled");
           $('#que_'+id).slideUp(200);
            $('#que_'+nextId).slideDown(200);
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
            if(nextId > 1){
                //$('.back').show();
                $(".back").removeClass("disabled");
            }
            //alert(nextId);
        //alert(submitcnt);
            if(nextId == submitcnt){
               // alert("hello");
                $(".next").addClass("disabled");
               // $('.next').hide();
            }
        }
    }
    else
    {
        //alert("dd");
        $(".next").removeClass("disabled");
        $('#que_'+id).slideUp(200);
        $('#que_'+nextId).slideDown(200);
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
    
    var qtypename=$("#qtypename_"+nextId).val();
    if(qtypename=="Order")
    { //alert(nextId);
      setorderval(nextId);
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
      var qval12=parseInt(qval)-parseInt(1);
      $("#setqno").val(qval12);
      $('#que_'+id).slideUp(200);
      $('#que_'+prevId).slideDown(200); 
   }
   else
   {  //alert(nextids);
      var nt = nextids.length-1;
      var newnextid = nextids.slice(0,nt);
      //alert(newnextid);
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
    
    //alert(currqid);
    if(nextids.length === 0)
    {
        nextids.push(1);
    }
    
    var nextqid=parseInt(curqno)+parseInt(1);
   
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
                     nextprev();
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
                    nextprev();
                    if(skipval!=curqno)
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
                     nextprev();
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
                    nextprev();
                    if(skipval!=curqno)
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
                 var fetchans = ansarray+'';
                 var testt21 = fetchans.replace(/,/g,";");
                 $("#all_answers").val(testt21);
             }
             
            if(selval!="")
            {    nextprev();
                 $("#current_answer").val("");
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
        else if(qtypename=="Text")
        {  
            var textvalue = $("#texttype_"+qid).val();
            
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
                nextprev();
                $("#current_answer").val("");
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
                     nextprev();
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
                    nextprev();
                    if(skipval!=curqno)
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
                {nextprev();
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
                {nextprev();
                    //nextqid = skipos; 
                    if(skipos!=curqno)
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
            else if(qtypename=="Opinion Scale")
            {
                //0,0,5,0,0,0,0,0,0,0,0
                var skipval = $("#skip_"+subid).val();
                //alert(skipval);
                //$("#qsequence").val(qseq+";"+skipval);
                var skipvalarray = skipval.split(",");
                var skipos=skipvalarray[othervalue];
                if(skipos=="0")
                {nextprev();
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
                {nextprev();
                    //nextqid = skipos;
                    if(skipos!=curqno)
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
            else if(qtypename=="Order")
            {
               //$("#allsubval_"+qstid).val(
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
                       var ansarray = allans.split(";");
                       ansarray[posq]=currentans;
                       var fetchans = ansarray+'';
                       var testt212 = fetchans.replace(/,/g,";");
                       $("#all_answers").val(testt212);
                   }
                }
                nextprev();
                     $("#current_answer").val("");
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
                      //orderids=[];
                     
                     }
                
            }
            else
            {nextprev();
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
  // alert(nextids);
}

function nextprev()
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
    var setquestionarray12 = setquestion12.split(";");
   
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
           $(".next").addClass("disabled"); 
           
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
    var chkselval=$("#chkselectedval_"+qid).val();
    if(chkselval!="")
    {
        $('#btn_next_other_check_'+qid).removeClass("action-btn-disabled");
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
    //alert(div);
$(div).parent().parent().attr('isAttempted', '1');
checkAttempt(seq,qid);
}

function checkAttempt(seq,qid){
    //alert(seq);
    var attemptedCount = 0;
    $('#divQstn div').each(function (i, ele) {
        // var qId = $(this).attr("qId");
         var isAttempted = $(this).attr("isAttempted");
         //alert(isAttempted);
         var c = 1;
         
         if(isAttempted=="1"){
            attemptedCount ++;
            //attemptedCount=seq;
            
         }
    });
    // var totalquest=$("#totalquestion").val();
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
            
         //Horizal Progree Bar
              var scrollPercent = average1*attemptedCount;
              var roundScroll = Math.round(scrollPercent);
              
              // For scrollbar 1
              $(".scrollBar1").css("width", scrollPercent + "%");
              $(".scrollBar1 span").text(roundScroll);
        // End Horizantal Progress        
            
            if(average1*attemptedCount>=100){
              progressBar(100,100);
              //$("#lastsubmitform").show();
              //$("#footerdisplay").hide();
              }else{
                  
                  progressBar(parseInt(average1*attemptedCount),100);
              }
}



            function setorderval(currsrno)
            {
                  //alert(currsrno);
                  var lstqstid=$("#sub_qst_id_"+currsrno).val();
                  $("#list_"+lstqstid).sortable({ opacity: 0.8, cursor: 'move',animation: 150, update: function() {
                    var qstid=$("#sub_qst_id_"+currsrno).val();
                    var order = $(this).sortable("serialize") + '&update=update&qstid='+qstid;
                    //alert(order);
                    
                    $.post("<?php echo SITEPATHFRONT;?>update-subquestion-sequence.php", order, function(theResponse){
                            //alert(theResponse);
                            $("#allsubval_"+qstid).val(theResponse);
                            //allsubval_
                            //allsubid_
                      });  
                      
                    }         
                });
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
                }
                
                // if($(window).width() <=360 || $(window).width() <=380)
                // {
                //     $('.sub_points_rank').attr('style', 'height: 250px !important');
                //     $('.radio-scroll-vt').css( 'height','50rem');
                // }
            }
            
   
});

</script>
