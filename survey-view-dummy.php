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

$surveyid=$_GET['surveyid'];

/**********All Questions***************/
$fields_questions = "*";
$condition_questions = "`tbl_questionBank`.`survey_id` =".$surveyid;
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
<?php include('common-header.php')?>
<style>
.common-header-main{
display:none;
}
html {
  scroll-behavior: smooth;
}

</style>
<link rel="stylesheet" href="<?php echo SITEPATHFRONT; ?>css/template.css">
<script src="<?php echo SITEPATH; ?>bower_components/jquery/dist/jquery.min.js"></script>

<div class="wrapper p-3">
         <input type="hidden" id="all_question_id" name="all_question_id" value="">
         <input type="hidden" id="all_answers" name="all_answers" value="">
         <input type="hidden" id="current_answer" name="current_answer" value="">
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
                        
                                    <?php if($all_question['quest_type_id'] == "1") {  ?> 
                                    <div id="que_<?php echo $srno;?>" style="display:none" class="que_scroll item mt-4 mb-5"  data-id='<?php echo $srno;?>'  isAttempted="0">
                                     <h1>Question <?php echo $all_question['sequence'];?></h1>
                                        <p><?php echo $all_question['question_title'];?></p>
                                        <input type="hidden" name="qtypename_<?php echo $srno;?>" id="qtypename_<?php echo $srno;?>" value="<?php echo $qtypename?>">
                                        <input type="hidden" name="qidthis_<?php echo $srno;?>" id="qidthis_<?php echo $srno;?>" value="<?php echo $all_question['question_id'];?>">
                                          <div class="col-12 pb-5">
                                            <?php foreach($all_subpoints as $all_subpoint){ ?>    
                                                <input class="checkbox-tools" type="radio" name="bool" id="bool_<?php echo $all_subpoint['question_subid'];?>" value="<?php echo $all_subpoint['question_subtitle'];?>" onchange="SetAttempted(this)" onclick="setnext(<?php echo $srno;?>,<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,this.value);">
                        						<label class="for-checkbox-tools" for="bool_<?php echo $all_subpoint['question_subid'];?>">
                        							<?php if($all_subpoint['question_subtitle'] == "Yes"){ ?> <i class='fa fa-thumbs-up'></i><?php } ?>
                        							<?php if($all_subpoint['question_subtitle'] == "No"){ ?> <i class='fa fa-thumbs-down'></i><?php } ?>
                        	                      
                        							<p><?php echo $all_subpoint['question_subtitle'];?></p>
                        						</label>
                    				        <?php } ?>	
            				        	</div>
    				                </div>
    				            <?php } ?>
    				            
    				            
    				            
                                <?php if($all_question['quest_type_id'] == "2") {  ?> 
                                   <div id="que_<?php echo $srno;?>" style="display:none" class="que_scroll item mt-4 mb-5" data-id='<?php echo $srno;?>' isAttempted="0">
                                   <h1>Question <?php echo $all_question['sequence'];?></h1>
                                    <p><?php echo $all_question['question_title'];?></p>
                                    <input type="hidden" name="qtypename_<?php echo $srno;?>" id="qtypename_<?php echo $srno;?>" value="<?php echo $qtypename?>">
                                    <input type="hidden" name="qidthis_<?php echo $srno;?>" id="qidthis_<?php echo $srno;?>" value="<?php echo $all_question['question_id'];?>">
                                      <div class="col-12 pb-5">
                					    <?php foreach($all_subpoints as $all_subpoint){ ?>
                    						<input class="checkbox-tools" type="radio" name="radiotype" id="radiotype_<?php echo $all_subpoint['question_subid'];?>" value="<?php echo $all_subpoint['question_subtitle'];?>" onchange="SetAttempted(this);" <?php if($all_subpoint['question_subtitle']!="Other"){?> onclick="setnext('<?php echo $srno;?>','<?php echo $all_subpoint['question_subid'];?>',<?php echo $all_question['question_id'];?>,this.value);" <?php } else {?> onclick="showradtextbox(<?php echo $all_question['question_id'];?>);" <?php }?>>
                    						<label class="for-checkbox-tools" for="radiotype_<?php echo $all_subpoint['question_subid'];?>">
                    							<i class='fa fa-briefcase'></i>
                    							<p><?php echo $all_subpoint['question_subtitle'];?></p>
                    						</label>
                    					<?php } ?>
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
                		        
                		        <?php if ($all_question['quest_type_id'] == "3") { ?>
				                 <div id="que_<?php echo $srno;?>" style="display:none" class="que_scroll item mt-1" data-id='<?php echo $srno;?>' isAttempted="0">
                                    <h1>Question <?php echo $all_question['sequence'];?></h1>
                                    <p><?php echo $all_question['question_title'];?></p>
                                    <input type="hidden" name="qtypename_<?php echo $srno;?>" id="qtypename_<?php echo $srno;?>" value="<?php echo $qtypename?>">
                                    <input type="hidden" name="qidthis_<?php echo $srno;?>" id="qidthis_<?php echo $srno;?>" value="<?php echo $all_question['question_id'];?>">
                                    <input type="hidden" name="chkselectedval_<?php echo $all_question['question_id'];?>" id="chkselectedval_<?php echo $all_question['question_id'];?>" value="">   
                                       <div class="chk_class">
            				                     <div class="row pb-5">
            				                        <?php $counter = 0; foreach($all_subpoints as $all_subpoint){ $counter++; ?>
                                                     <div class="col-md-6">
                                                          <input id="chkbox_<?php echo $all_subpoint['question_subid'];?>" type="checkbox" name="chkbox" value="<?php echo $all_subpoint['question_subtitle'];?>" onchange="SetAttempted(this)" <?php if($all_subpoint['question_subtitle']=="Other"){?> onclick="showchktextbox(<?php echo $all_question['question_id'];?>,<?php echo $all_subpoint['question_subid'];?>);setcheckboxquestans(<?php echo $srno;?>,<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,this.value);" <?php } else  {?> onclick="setcheckboxquestans(<?php echo $srno;?>,<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,this.value);" <?php }?>>
                                                            <label for="chkbox_<?php echo $all_subpoint['question_subid'];?>"><?php echo $all_subpoint['question_subtitle'];?> <span class="float-end text-dark span" id="<?php echo $all_subpoint['question_subid'];?>">
                                                              <?php echo $counter; ?></span>
                                                            </label>
                                                     </div>
                                                     <?php }  ?>
                                                    <div class="" style="display:none" id="check_other_text_field_<?php echo $all_question['question_id'];?>">
                            						   <div class="form__group field">
                                                         <input type="text" class="form__field effect-2" placeholder="Please Enter Your Response" name="check_other_text_<?php echo $all_question['question_id'];?>" id='check_other_text_<?php echo $all_question['question_id'];?>' value="" onkeyup="activenextbutton(<?php echo $srno;?>,<?php echo $all_question['question_id'];?>)"/>
                                                       </div>
                                                       
                                                    </div> 
                                                    <div class="col-md-12 mt-5" onclick="setnext(<?php echo $srno;?>,<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,'');">
                                                        <div class="button" id="btn_next_check">
                                                         <div id="slide" class="slide"></div>
                                                          <a href="javascript:void(0);" class="" id="btn_next_other_check_<?php echo $all_question['question_id'];?>">NEXT &nbsp;&nbsp;<i class="fa fa-angle-right"></i></a>
                                                    
                                                        </div>
                                                     </div>
                                                 </div>
                                           </div>
                
                                     </div>
                                <?php } ?>
                		        
                				<?php if($all_question['quest_type_id']=="4") { ?> 
                                    <div id="que_<?php echo $srno;?>" style="display:none" class="item mt-4 mb-5"  data-id='<?php echo $srno;?>'  isAttempted="0">
                                             <h1>Question <?php echo $all_question['sequence'];?></h1>
                                             <p><?php echo $all_question['question_title'];?></p>
                                             <input type="hidden" name="qtypename_<?php echo $srno;?>" id="qtypename_<?php echo $srno;?>" value="<?php echo $qtypename?>">
                                             <input type="hidden" name="qidthis_<?php echo $srno;?>" id="qidthis_<?php echo $srno;?>" value="<?php echo $all_question['question_id'];?>">
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
                                                 <input type="text" class="form__field effect-2" placeholder="Please Enter Your Response" name="texttype" id='texttype_<?php echo $all_question['question_id'];?>' value="" onchange="SetAttempted(this)" onkeyup="activenextbutton(<?php echo $srno;?>,<?php echo $all_question['question_id'];?>)"/>
                                                 <?php }?>
                                                 <?php if($texttype=="textarea"){?>
                                                 <textarea class="form__field effect-2" placeholder="Please Enter Your Response" name="texttype" id='texttype_<?php echo $all_question['question_id'];?>' value="" onchange="SetAttempted(this)" onkeyup="activenextbutton(<?php echo $srno;?>,<?php echo $all_question['question_id'];?>)"></textarea>
                                                 <?php }?>
                                               </div>
                                               <div class="button action-btn-disabled" id="button_next_<?php echo $all_question['question_id'];?>" onclick="setnext(<?php echo $srno;?>,<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,'');">
                                                 <div id="slide" class="slide"></div>
                                                  <a class="action-btn-disabled" href="javascript:void(0);" id="btn_next_<?php echo $all_question['question_id'];?>">NEXT &nbsp;&nbsp;<i class="fa fa-angle-right"></i></a>
                                               </div>
                                    </div>
                                    <?php } ?>  
                                    
                                <?php if ($all_question['quest_type_id'] == "5") {  ?> 
				                 <div id="que_<?php echo $srno;?>" style="display:none" class="item mt-4" data-id='<?php echo $srno;?>' isAttempted="0">
                                         <h1>Question <?php echo $all_question['sequence'];?></h1>
                                         <p><?php echo $all_question['question_title'];?></p>
                                         <input type="hidden" name="qtypename_<?php echo $srno;?>" id="qtypename_<?php echo $srno;?>" value="<?php echo $qtypename?>">
                                         <input type="hidden" name="qidthis_<?php echo $srno;?>" id="qidthis_<?php echo $srno;?>" value="<?php echo $all_question['question_id'];?>">
                                            <div class="stars">
                                              <form action="">
                                                <input class="star star-5" onchange="SetAttempted(this)" id="star-5" value="5" type="radio" name="star_<?php echo $all_subpoint['question_subid'];?>" <?php if(count($all_questions)!=$srno){?> onclick="setnext(<?php echo $srno;?>,<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,this.value);" <?php }?>/>
                                                <label class="star star-5" for="star-5"></label>
                                                <input class="star star-4" onchange="SetAttempted(this)" id="star-4" value="4" type="radio" name="star_<?php echo $all_subpoint['question_subid'];?>" <?php if(count($all_questions)!=$srno){?> onclick="setnext(<?php echo $srno;?>,<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,this.value);" <?php }?>/>
                                                <label class="star star-4" for="star-4"></label>
                                                <input class="star star-3" onchange="SetAttempted(this)" id="star-3" value="3" type="radio" name="star_<?php echo $all_subpoint['question_subid'];?>" <?php if(count($all_questions)!=$srno){?> onclick="setnext(<?php echo $srno;?>,<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,this.value);" <?php }?>/>
                                                <label class="star star-3" for="star-3"></label>
                                                <input class="star star-2" onchange="SetAttempted(this)" id="star-2" value="2" type="radio" name="star_<?php echo $all_subpoint['question_subid'];?>" <?php if(count($all_questions)!=$srno){?> onclick="setnext(<?php echo $srno;?>,<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,this.value);" <?php }?>/>
                                                <label class="star star-2" for="star-2"></label>
                                                <input class="star star-1" onchange="SetAttempted(this)" id="star-1" value="1" type="radio" name="star_<?php echo $all_subpoint['question_subid'];?>" <?php if(count($all_questions)!=$srno){?> onclick="setnext(<?php echo $srno;?>,<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,this.value);" <?php }?>/>
                                                <label class="star star-1" for="star-1"></label>
                                              </form>
                                            </div>
                                     </div>
				                <?php } ?>
				                
                			   <?php if ($all_question['quest_type_id'] == "6") { ?> 
                                  <div id="que_<?php echo $srno;?>" style="display:none" class="que_scroll item mt-4" data-id='<?php echo $srno;?>'  isAttempted="0">
                                    <h1>Question <?php echo $all_question['sequence'];?></h1>
                                    <p><?php echo $all_question['question_title'];?></p>
                                    <input type="hidden" name="qtypename_<?php echo $srno;?>" id="qtypename_<?php echo $srno;?>" value="<?php echo $qtypename?>">
                                    <input type="hidden" name="qidthis_<?php echo $srno;?>" id="qidthis_<?php echo $srno;?>" value="<?php echo $all_question['question_id'];?>">
                                      <div class="row pb-5">
                                        <?php $counter = 0; foreach($all_subpoints as $all_subpoint){ $counter++;?>
                                          <div class="col-md-6">
                                             <input class="checkbox-tools1" value="<?php echo $all_subpoint['question_subtitle'];?>" type="radio" name="dropdown_<?php echo $all_subpoint['question_subid'];?>" id="dropdown_<?php echo $all_subpoint['question_subid'];?>" value="" onchange="SetAttempted(this)" onclick="setnext(<?php echo $srno;?>,<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,this.value)">
                    						    <label class="for-checkbox-tools" for="dropdown_<?php echo $all_subpoint['question_subid'];?>">
                    							<?php echo $all_subpoint['question_subtitle'];?> 
                    							<span class="float-end text-dark span"><?php echo $counter; ?></span>
                						    </label>
                                          </div>
                                         <?php } ?>
                                        
        				        	</div>
				                </div>
				                
				                <?php } ?>
        				        
                                
                                <?php if ($all_question['quest_type_id'] == "7") { ?>
                                        <div id="que_<?php echo $srno;?>" style="display:none" class="item mt-4" data-id='<?php echo $srno;?>'  isAttempted="0">
                                         <h1>Question <?php echo $all_question['sequence'];?></h1>
                                         <p><?php echo $all_question['question_title'];?></p>
                                         <input type="hidden" name="qtypename_<?php echo $srno;?>" id="qtypename_<?php echo $srno;?>" value="<?php echo $qtypename?>">
                                         <input type="hidden" name="qidthis_<?php echo $srno;?>" id="qidthis_<?php echo $srno;?>" value="<?php echo $all_question['question_id'];?>">
                                              <?php foreach($all_subpoints as $all_subpoint)
                                                    { 
                                                        $scale_str =  $all_subpoint['question_subtitle'];
                                                        $scale_str_exp = explode("-",$scale_str); 
                                                        $min = $scale_str_exp[0]; 
                                                        $max=$scale_str_exp[1];  
                                                        $avg = intval(($min+$max)/2);   
                                                        $opinion_scale= $all_subpoint['opinion_scale_text'];
                                                        $opinion_scale_text = explode(",",$opinion_scale); 
                                                        
                                                        $left_text = $opinion_scale_text[0];
                                                        $middle_text = $opinion_scale_text[1];
                                                        $right_text = $opinion_scale_text[2];
                                                            
                                                        
                                               ?>
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
                                                         <input class="scale" id="scale-<?php echo $sc;?>" value="<?php echo $sc;?>" type="radio" name="scale_<?php echo $all_subpoint['question_subid'];?>" onchange="SetAttempted(this)" onclick="setnext(<?php echo $srno;?>,<?php echo $all_subpoint['question_subid'];?>,<?php echo $all_question['question_id'];?>,this.value)"/>
                                                         <label class="scale" for="scale-<?php echo $sc;?>"><?php echo $sc;?></label>
                                                     <?php  }  ?>
                                                 </div>
                                            </div>
                                         </div>     
                                        <?php } ?>
                                    <?php } ?>
                                   
                                   
                              <?php $srno++;} ?>
                              <div class="col-md-12 item mt-5" id="que_<?php echo $srno;?>" data-id="<?php echo $srno;?>" style="display:none;">
                                            <div class="row pb-5">
                                            
                                              <div class="col-md-12">
                                                <input type="text" class="form__field effect-2" placeholder="Enter Full Name" name="fname" id='fname' value="" />
                                                <div class="star" id="fname_error_message"></div>
                                            
                                              </div>
                                             <div class="col-md-12" style="padding-top:78px;">
                                                
                                                <input type="text" class="form__field effect-2" placeholder="Enter Email" name="email" id='email' value="" />
                                                <div class="star" id="email_error_message"></div>
                                              </div>
                                            
            				        	</div>
                                        <div class="button" id="button">
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
                                        <p class="mt-5"><img class="logo-dash" src="/survey/images/dash-logo.png"></p>
                                    </div>
                                </div>    
                              </div> 
                            <div class="row" id="btn_get_started">
                                    <div class="col-md-12 text-center mt-5 mb-5 p-5" id="temp_section">
                                       <h1 class="text-white mt-5"><strong><?php echo $survey_title;?></strong></h1>
                                       <h3 class="text-white"><i><?php echo $survey_description;?></i></h3>
                                        <div class="button get-started mb-5" id="button">
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
                                            <svg class="progress-circle" width="200px" height="200px" xmlns="http://www.w3.org/2000/svg">
                                        	    <circle class="progress-circle-back"
                                        		        cx="80" cy="80" r="74"></circle>
                                                <circle class="progress-circle-prog"
                                                        cx="80" cy="80" r="74"></circle>
                                            </svg>
                                    	     <div class="progress-text" data-progress="0">0%</div>
                                         </div>	
                                        </div>
                                         <div class="col-md-6">
                                            <div class="col-md-12">
                                             <a id="next" class="next btn_slider btn_slider_dir br-25"><i class="fa fa-angle-down"></i></a>
                                             <a id="prev" class="back btn_slider btn_slider_dir br-25"><i class="fa fa-angle-up"></i></a>
                                            </div>
                                             <div class="text-right cmp_logo_text">
                                                 <i class="text-white">made with</i>
                                                <p><img class="logo-dash-temp img-fluid" src="/survey/images/dash-logo.png"></p>
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
   $(document).ready(function(){
       
            $('.wrapper').addClass("toggled"); 
            
            //Instead of show() you can use slideDown(200); for hide you can use slideUp(200);
        
            $("#btn_get_started").click(function(){
                var currqid="1";
                $('#temp_section').slideUp(200);
                $('#que_'+currqid).slideDown(200);
                $("#btn_slider").slideDown(200);
                
               if(currqid == 1){
                $('.back').hide();
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
        				url: "survey-view-action.php",
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
        				    $('#span_loader').hide();
        					$('.que_section').hide();
                            $("#footerdisplay").hide();
    		                $('.end').slideDown(200);
        				}
        			});
                }
                
            });
            
            
            
    });

//====== Next & Prev Button Click =======
$('body').on('click', '.next', function() { 
    var id = $('.item:visible').data('id');
    var nextId = $('.item:visible').data('id')+1;
    // alert(id);
    // alert(nextId);
    $('#que_'+id).slideUp(200);
    $('#que_'+nextId).slideDown(200);
    var totalquest=$("#totalquestion").val();
    var submitcnt = parseInt(totalquest)+parseInt(1);
    if(nextId > 1){
        $('.back').show();
    }
    if(nextId == submitcnt){
        $('.next').hide();
    }
   
});

$('body').on('click', '.back', function() { 
    var id = $('.item:visible').data('id');
    var prevId = $('.item:visible').data('id')-1;
    
    $('#que_'+id).slideUp(200);
    $('#que_'+prevId).slideDown(200);
    var totalquest=$("#totalquestion").val();
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
{ 
    //alert(ans);
    nextprev();
    var nextqid=parseInt(curqno)+parseInt(1);
    
    var totalquest=$("#totalquestion").val();
    var qtypename=$("#qtypename_"+curqno).val();
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
    
        if(qtypename=="Radio")
        {
            var radioValue = ans;
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
                 $('#que_'+curqno).slideUp(200);
                 $('#que_'+nextqid).slideDown(200);
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
               $('#que_'+curqno).slideUp(200);
               $('#que_'+nextqid).slideDown(200); 
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
                $("#current_answer").val("");
                $('#que_'+curqno).slideUp(200);
                $('#que_'+nextqid).slideDown(200);
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
            $('#que_'+curqno).slideUp(200);
            $('#que_'+nextqid).slideDown(200);
        }
   
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
    var strokeVal = (4.64 * 100) /  totalPercentageVal;
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
	    el.innerHTML = progressVal / totalPercentageVal * 100 + '%';
	    if (progress < 1) setTimeout(arguments.callee, 10);
	}, 10);

}

progressBar(0,100);

var total_ques = $('#progress_count').val();

function SetAttempted(div) {
$(div).parent().parent().attr("isAttempted", "1");
checkAttempt();
}

function checkAttempt(){
    
    var attemptedCount = 0;
    $('#divQstn div').each(function (i, ele) {
        // var qId = $(this).attr("qId");
         var isAttempted = $(this).attr("isAttempted");
         //alert(i);
         var c = 1;
         
         if(isAttempted=="1"){
            attemptedCount ++;
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
           // alert(average1);
            if(average1*attemptedCount>=100){
              progressBar(100,100);
              //$("#lastsubmitform").show();
              //$("#footerdisplay").hide();
              }else{
                  progressBar(parseInt(average1*attemptedCount),100);
              }
}

</script>