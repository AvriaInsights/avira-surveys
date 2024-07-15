<?php 
require_once("classes/cls-survey.php");

$obj_survey = new Survey();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}

/*****Survey Title Detail************/
if(isset($_GET['surveyid']))
{
    $surveyid=$_GET['surveyid'];
    $_SESSION['survey_sess_id']=$surveyid;
    $fields_survey = "*";
    $condition_survey = "`tbl_survey`.`survey_id` =".$surveyid;
    $survey_list=$obj_survey->getSurveyDetail($fields_survey, $condition_survey, '', '', 0);
    foreach($survey_list as $survey_lists)
    {
        $survey_title=$survey_lists['survey_title'];
    }
    
    /**********Question Bank All***************/
    $fields_quest_bank = "*";
    $condition_quest_bank = "`tbl_questionBank`.`status` = 'Active' and `tbl_questionBank`.`survey_id`=".$surveyid;
    $question_bank_lists=$obj_survey->getQuestionBank($fields_quest_bank, $condition_quest_bank, '', '', 0);
}
else
{
   $surveyid=""; 
}

/***********Category Detail*************/
$fields_cat = "*";
$condition_cat = "`tbl_category`.`status` = 'Active'";
$cat_list=$obj_survey->getSurveyCategory($fields_cat, $condition_cat, '', '', 0);

/**********Question Type***************/
$fields_quest_type = "*";
$condition_quest_type = "`tbl_question_type`.`status` = 'Active'";
$question_type_list=$obj_survey->getQuestionType($fields_quest_type, $condition_quest_type, '', '', 0);

if(isset($_GET['templateid']))
{
    $tempid=$_GET['templateid'];
}
else
{
    $tempid="";
}

?>
<link rel="stylesheet" href="<?php echo SITEPATH;?>css/survey.css">
<link rel="stylesheet" href="<?php echo SITEPATH;?>css/modal-style.css">
<div class="wrapper">
   <?php include("sidebarmenu.php")?>
        <?php include("header.php")?>
        <section class="space-padding-top">
            <div class="container-fluid pse-2">
                <div class="row">
                    <div class="col-md-4">
                        <div class="bg-white p-4 ht-8 ht-7  box-shadow">
                            <?php //if(isset($_GET['surveyid'])){?><!--<h2 class="card-title cardt"><?php //echo $survey_title;?></h2>--><?php //}?>
                            
                            <div id="allquestionlist"></div>
                            <input type="hidden" name="frmaction" id="frmaction" value="Insert">
                            <div class="row leftsubbox">
                                <div class="col-md-12">
                                    <div class="icon-wrapper" style="cursor:pointer;" id="addnewquestion">
                                        <i class="fa fa-plus add-icon-plus" aria-hidden="true" style="cursor:pointer;" id="addnewquestion"></i>
                                        <span class="padquesttext1">Add New Question</span>
                                    </div>
                                    <p></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="bg-white p-4 ht-8 box-shadow">
                             <div id="allquestiontype">
                                    <h2 class="cardt">Choose Question Type</h2>
                                    
                                    <div class="row choose-q-type">
                                    <?php $allquestiontype="";foreach($question_type_list as $question_type_lists){ ?>
                                         
                                          <div class="col-md-4 paddqtype1" style="cursor:pointer;" onclick="fetchquesttype('<?php echo $question_type_lists['quest_type'];?>','<?php echo $question_type_lists['quest_type_id'];?>')">
                                            <img class="qtype_icon" src="<?php echo SITEPATH; ?>images/qtype_icon/<?php echo $question_type_lists['quest_type']; ?>.png"> <span class="questyp" id="questyp<?php echo $question_type_lists['quest_type_id'];?>"><?php if($question_type_lists['quest_type'] == "Order"){ echo "Rank Order";} else { echo $question_type_lists['quest_type']; } ?></span>
                                            
                                          </div>
                                         
                                        <?php $allquestiontype.= $question_type_lists['quest_type'].",";
                                    
                                    }?>
                                    <input type="hidden" name="qtypearray" id="qtypearray" value="<?php echo trim($allquestiontype,",");?>">
                                    </div>
                                    
                                </div>
                                <!--Question Form Start-->
                             <div id="questionform" style="display:none;">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h2 class="card-title cardt">Edit</h2>
                                        </div>
                                        <!--<div class="col-md-6">-->
                                        <!--    <h2 class="card-title cardt"><img class="qtype_icon" src="<?php echo SITEPATH; ?>images/qtype_icon/<?php echo $question_type_lists['quest_type']; ?>.png"> <?php echo $allquestiontype; ?></h2>-->
                                        <!--</div>-->
                                    </div>
                                    <div class="row">
                                          <div class="col-md-12 paddqtype">
                                            <form class="row">
                                                <div class="questionbox">
                                                   <div class="col-md-12">
                                                      <div class="main-holder">
                                                        <div class="form-group">
                                                            <!--<input type="text" name="quid" id="quid">-->
                                                            <input type="text" class="form-control formsize" name="questiontitle" id="questiontitle"
                                                            placeholder="Start Typing Question" value="">
                                                            <div class="star" id="questiontitle_error_message"></div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div id="fetcheditoptions"></div>
                                                    <div id="showcheckboxquestionoptions"></div>
                                                    <div id="showquestionoptions"></div>
                                                    <div id="showrankorderquestionoptions"></div>
                                                    
                                                    
                                                    <div id="showopinionscalequestionoptions">
                                                         <div class="row justify-content-center">
                                                             
                                                           <?php for($t=0;$t<=10;$t++){?>
                                                          
                                                               <div class="col-md-1 opcol">
                                                                   
                                                                   <div class="col-md-12"><span class="opiniscal"><?php echo $t;?></span></div>
                                                                   <?php if($t==0){?>
                                                                   <div class="col-md-12"><span class="form-label checklabel"><div id="minlabel" class="m-3"></div></span></div>
                                                                   <?php }?>
                                                                   <?php if($t==5){?>
                                                                   <div class="col-md-12"><span class="form-label checklabel"><div id="midlabel" class="m-3"></div></span></div>
                                                                   <?php }?>
                                                                   <?php if($t==10){?>
                                                                   <div class="col-md-12"><span class="form-label checklabel"><div id="highlabel" class="m-3"></div></span></div>
                                                                   <?php }?>
                                                                </div>
                                                               
                                                           <?php }?>
                                                                  
                                                          </div>
                                                          
                                                    </div>
                                                    <div id="showdropdwnquestionoptions">
                                                        <div class="col-md-12" name="txxdropdwn" id="txxdropdwn">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="main-holder radio-que-align" style="font-size:17px;">
                                                                        
                                                                        <select class="form-select" id="dropdwnrep"></select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="singleqtype" id="singleqtype" value="">
                                                    <input type="hidden" name="seti" id="seti" value="">
                                                </div>
                                                <div class="tabbox">
                                              	    <div class="tabset">
                                                          <!-- Tab 1 -->
                                                          <input type="radio" name="tabset" id="tab1" aria-controls="options" checked>
                                                          <label for="tab1">Options</label>
                                                          <!-- Tab 2 -->
                                                          <input type="radio" name="tabset" id="tab2" aria-controls="logic">
                                                          <label for="tab2">Logic</label>
                                                          <!--Boolean section-->
                                                          <div class="tab-panels" style="display:none;" id="boolean">
                                                            <section id="options" class="tab-panel">
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                      <div class="main-holder">
                                                                            <div class="form-group">
                                                                               <input type="text" class="form-control formsize" name="questiontooltip-boolean" id="questiontooltip-boolean" placeholder="Tooltip">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                      <div class="main-holder">
                                                                        <div class="form-group reqflt">
                                                                           <input type="checkbox" class="largerCheckbox" name="isrequired-boolean" id="isrequired-boolean">
                                                                           <label class="form-label checklabel">Required</label>
                                                                        </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                       <div class="main-holder">
                                                                           <i class="fa fa-thumbs-up"></i>
                                                                           <i class="fa fa-thumbs-down"></i>
                                                                        </div>
                                                                     </div>
                                                                </div>
                                                                <div class="row"><div class="col-md-12"><hr></div></div>
                                                            </section>
                                                            <section id="logic" class="tab-panel">
                                                                   <div class="row">
                                                                        <div class="col-md-12">
                                                                           <div class="main-holder">
                                                                               <div class="row" style="text-align:center;" id="logicquestions-boolean">
                                                                                    
                                                                               </div> 
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                            </section>
                                                          </div>
                                                          <!--Rating section-->
                                                          <div class="tab-panels" id="rating" style="display:none;">
                                                            <section id="options" class="tab-panel">
                                                            
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <div class="main-holder">
                                                                            <div class="form-group">
                                                                               <input type="text" class="form-control formsize" name="questiontooltip-rating" id="questiontooltip-rating" placeholder="Tooltip">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                      <div class="main-holder">
                                                                        <div class="form-group reqflt">
                                                                               <input type="checkbox" class="largerCheckbox" name="isrequired-rating" id="isrequired-rating">
                                                                               <label class="form-label checklabel">Required</label>
                                                                            </div>
                                                                      </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                       <div class="main-holder">
                                                                           <?php for($k=0;$k<5;$k++){?>
                                                                           <i class="fa fa-star-o"></i>
                                                                           <?php }?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="col-md-12"><hr></div>
                                                                </div>
                                                                
                                                            </section>
                                                            
                                                            
                                                            <section id="logic" class="tab-panel">
                                                                   <div class="row">
                                                                        <div class="col-md-12">
                                                                           <div class="main-holder">
                                                                               <div class="row" style="text-align:center;" id="logicquestions-rating">
                                                                                    
                                                                               </div> 
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                            </section>
                                                            
                                                          </div>
                                                          <!--Text Section-->
                                                          <div class="tab-panels" id="text" style="display:none;">
                                                            <section id="options" class="tab-panel">
                                                                <div class="row">
                                                                        <div class="col-md-8">
                                                                          <div class="main-holder">
                                                                                <div class="form-group">
                                                                                   <input type="text" class="form-control formsize" name="questiontooltip-text" id="questiontooltip-text" placeholder="Tooltip">
                                                                                </div>
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="main-holder">
                                                                                <div class="form-group reqflt">
                                                                                   <input type="checkbox" class="largerCheckbox" name="isrequired-text" id="isrequired-text">
                                                                                   <label class="form-label checklabel">Required</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                <div class="row">
                                                                        <div class="col-md-4">
                                                                           <div class="main-holder">
                                                                           <label class="form-label">Type</label>
                                                                           <select class="form-select txttype" id="texttype" name="texttype">
                                                                               <option value="">Select Type</option>
                                                                               <option value="text">Single Line</option>
                                                                               <option value="textarea">Multiple Line</option>
                                                                           </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                <div class="row"><div class="col-md-12"><hr></div></div>
                                                                    
                                                            </section>
                                                                
                                                            <section id="logic" class="tab-panel">
                                                                      
                                                                    </section>
                                                                    
                                                          </div>
                                                                
                                                                
                                                                <!--Checkbox Section-->
                                                                  
                                                           <div class="tab-panels" id="checkbox" style="display:none;">
                                                                    <section id="options" class="tab-panel">
                                                                    
                                                                    <div class="row">
                                                                        <div class="col-md-8">
                                                                          <div class="main-holder">
                                                                                <div class="form-group">
                                                                                   <input type="text" class="form-control formsize" name="questiontooltip-checkbox" id="questiontooltip-checkbox" placeholder="Tooltip">
                                                                                </div>
                                                                        </div>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                          <div class="main-holder">
                                                                                <div class="form-group reqflt">
                                                                                   <input type="checkbox" class="largerCheckbox" name="other-checkbox" id="other-checkbox">
                                                                                   <label class="form-label checklabel">Other</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                          <div class="main-holder">
                                                                                <div class="form-group reqflt">
                                                                                   <input type="checkbox" class="largerCheckbox" name="isrequired-checkbox" id="isrequired-checkbox">
                                                                                   <label class="form-label checklabel">Required</label>
                                                                                </div>
                                                                        </div>
                                                                    </div></div>
                                                                    
                                                                    
                                                                    <form name="add_chk_name" id="add_chk_name">
                                                                    <div class="table-responsive">  
                                                                        <table class="table table-bordered table-qtype" id="dynamic_field">  
                                                                            <tr>  
                                                                                <td><input type="text" name="chkname[]" id="chkname1" placeholder="Enter Choice" class="form-control name_list chkboxtxt" onkeyup="showcheckoption('1')" /></td>  
                                                                                <td><button type="button" name="add" id="add" class="btn add-icon-plus-options">+</button></td>  
                                                                            </tr> 
                                                                        </table>  
                                                                    </div>
                                                                    </form>
                                                                    
                                                                    <div class="row"><div class="col-md-12"><hr></div></div>
                                                                    
                                                                    </section>
                                                                    
                                                                    
                                                                    <section id="logic" class="tab-panel">
                                                                      
                                                                    </section>
                                                                    
                                                                  </div>
                                                                  
                                                                <!--Multiple Radio Button-->
                                                                 <div class="tab-panels" id="radio" style="display:none;">
                                                                    <section id="options" class="tab-panel">
                                                                    
                                                                    <div class="row">
                                                                        <div class="col-md-8">
                                                                          <div class="main-holder">
                                                                                <div class="form-group">
                                                                                   <input type="text" class="form-control formsize" name="questiontooltip-radio" id="questiontooltip-radio" placeholder="Tooltip">
                                                                                </div>
                                                                        </div>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                          <div class="main-holder">
                                                                                <div class="form-group reqflt">
                                                                                   <input type="checkbox" class="largerCheckbox" name="other-radio" id="other-radio">
                                                                                   <label class="form-label checklabel">Other</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                          <div class="main-holder">
                                                                                <div class="form-group reqflt">
                                                                                   <input type="checkbox" class="largerCheckbox" name="isrequired-radio" id="isrequired-radio">
                                                                                   <label class="form-label checklabel">Required</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    
                                                                    <form name="add_rad_name" id="add_rad_name">
                                                                    <div class="table-responsive">  
                                                                        <table class="table table-bordered table-qtype" id="dynamic_field_rad">  
                                                                            <tr>  
                                                                                <td><input type="text" name="radname[]" id="radname1" placeholder="Enter Choice" class="form-control name_list chkboxtxt" onkeyup="showradoption('1')" onfocusout="addradoptiontable('1')"/></td>  
                                                                                <td><button type="button" name="addrad" id="addrad" class="btn add-icon-plus-options">+</button></td>  
                                                                                
                                                                            </tr> 
                                                                             <!--<tr>
                                                                                <td>
                                                                                    <div class="star" id="questionsubtitle_error_message"></div>
                                                                                </td>
                                                                            </tr>-->
                                                                        </table>  
                                                                    </div>
                                                                    </form>
                                                                    
                                                                    <div class="row"><div class="col-md-12"><hr></div></div>
                                                                    
                                                                    </section>
                                                                    
                                                                    
                                                                    <section id="logic" class="tab-panel">
                                                                           <div class="row">
                                                                                <div class="col-md-12">
                                                                                   <div class="main-holder">
                                                                                       <div class="row" style="text-align:center;" id="logicquestions-radio">
                                                                                            
                                                                                       </div> 
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                    </section>
                                                                    
                                                                  </div>
                                                                <!--Dropdown Button-->
                                                                 <div class="tab-panels" id="dropdown" style="display:none;">
                                                                    <section id="options" class="tab-panel">
                                                                    
                                                                    <div class="row">
                                                                        <div class="col-md-8">
                                                                          <div class="main-holder">
                                                                                <div class="form-group">
                                                                                   <input type="text" class="form-control formsize" name="questiontooltip-dropdown" id="questiontooltip-dropdown" placeholder="Tooltip">
                                                                                </div>
                                                                        </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                          <div class="main-holder">
                                                                                <div class="form-group reqflt">
                                                                                   <input type="checkbox" class="largerCheckbox" name="isrequired-dropdown" id="isrequired-dropdown">
                                                                                   <label class="form-label checklabel">Required</label>
                                                                                </div>
                                                                        </div>
                                                                    </div></div>
                                                                    
                                                                    
                                                                    <form name="add_dropdwn_name" id="add_dropdwn_name">
                                                                    <div class="table-responsive">  
                                                                        <table class="table table-bordered table-qtype" id="dynamic_field_dropdwn">  
                                                                            <tr>  
                                                                                <td><input type="text" name="dropdwnname[]" id="dropdwnname1" placeholder="Enter Choice" class="form-control name_list chkboxtxt" onkeyup="showdropdwnoption('1')" /></td>  
                                                                                <td><button type="button" name="adddropdwn" id="adddropdwn" class="btn add-icon-plus-options">+</button></td>  
                                                                            </tr> 
                                                                        </table>  
                                                                    </div>
                                                                    </form>
                                                                    
                                                                    <div class="row"><div class="col-md-12"><hr></div></div>
                                                                    
                                                                    </section>
                                                                    
                                                                    
                                                                    <section id="logic" class="tab-panel">
                                                                      
                                                                    </section>
                                                                    
                                                                  </div>
                                                                  
                                                                  
                                                                <!--Opinion Scale section-->
                                                          <div class="tab-panels" id="opinion-scale" style="display:none;">
                                                            <section id="options" class="tab-panel">
                                                            
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <div class="main-holder">
                                                                            <div class="form-group">
                                                                               <input type="text" class="form-control formsize" name="questiontooltip-opinion-scale" id="questiontooltip-opinion-scale" placeholder="Tooltip">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                      <div class="main-holder">
                                                                        <div class="form-group reqflt">
                                                                               <input type="checkbox" class="largerCheckbox" name="isrequired-opinion-scale" id="isrequired-opinion-scale">
                                                                               <label class="form-label checklabel">Required</label>
                                                                            </div>
                                                                      </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                       <div class="main-holder">
                                                                           <label class="form-label checklabel">Steps</label>
                                                                           <div class="row"><div class="col-md-12">
                                                                               0 to 10
                                                                           </div></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                       <div class="main-holder">
                                                                           <label class="form-label checklabel">Left Label</label>
                                                                           <div class="row"><div class="col-md-12">
                                                                               <input type="text" name="leftlabel" id="leftlabel" class="form-control" onkeyup="showscaletext();" maxlength = "25">
                                                                               <span class="error" id="leftmaxerror"></span>
                                                                           </div></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                       <div class="main-holder">
                                                                           <label class="form-label checklabel">Middle Label</label>
                                                                           <div class="row"><div class="col-md-12">
                                                                               <input type="text" name="middlelabel" id="middlelabel" class="form-control" onkeyup="showscaletext();" maxlength = "25">
                                                                               <span class="error" id="middlemaxerror"></span>
                                                                           </div></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                       <div class="main-holder">
                                                                          <label class="form-label checklabel">Right Label</label>
                                                                          <div class="row"><div class="col-md-12">
                                                                               <input type="text" name="rightlabel" id="rightlabel" class="form-control" onkeyup="showscaletext();" maxlength = "25">
                                                                               <span class="error" id="rightmaxerror"></span>
                                                                           </div></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="col-md-12"><hr></div>
                                                                </div>
                                                                
                                                            </section>
                                                            
                                                            
                                                            <section id="logic" class="tab-panel">
                                                                   <div class="row">
                                                                        <div class="col-md-12">
                                                                           <div class="main-holder">
                                                                               <div class="row" style="text-align:center;" id="logicquestions-opinion-scale">
                                                                                    
                                                                               </div> 
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                            </section>
                                                            
                                                          </div>
                                                          
                                                          <!--Rank Order Button-->
                                                                 <div class="tab-panels" id="order" style="display:none;">
                                                                    <section id="options" class="tab-panel">
                                                                    
                                                                    <div class="row">
                                                                        <div class="col-md-10">
                                                                          <div class="main-holder">
                                                                                <div class="form-group">
                                                                                   <input type="text" class="form-control formsize" name="questiontooltip-order" id="questiontooltip-order" placeholder="Tooltip">
                                                                                </div>
                                                                        </div>
                                                                        </div>
                                                                       <!-- <div class="col-md-2">
                                                                          <div class="main-holder">
                                                                                <div class="form-group reqflt">
                                                                                   <input type="checkbox" class="largerCheckbox" name="other-rankorder" id="other-rankorder">
                                                                                   <label class="form-label checklabel">Other</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>-->
                                                                        <div class="col-md-2">
                                                                          <div class="main-holder">
                                                                                <div class="form-group reqflt">
                                                                                   <input type="checkbox" class="largerCheckbox" name="isrequired-order" id="isrequired-order">
                                                                                   <label class="form-label checklabel">Required</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    
                                                                <form name="add_rank_name" id="add_rank_name">
                                                                    <div class="table-responsive">  
                                                                        <table class="table table-bordered table-qtype" id="dynamic_field_rank">  
                                                                            <tr>  
                                                                                <td><input type="text" name="rankname[]" id="rankname1" placeholder="Enter Choice" class="form-control name_list chkboxtxt" onkeyup="showrankoption('1')" /></td>  
                                                                                <td><button type="button" name="addrank" id="addrank" class="btn add-icon-plus-options">+</button></td>  
                                                                            </tr>  
                                                                        </table>  
                                                                    </div>
                                                                    </form>
                                                                    
                                                                    <div class="row"><div class="col-md-12"><hr></div></div>
                                                                    
                                                                    </section>
                                                                    
                                                                    
                                                                    <section id="logic" class="tab-panel">
                                                                      
                                                                    </section>
                                                                    
                                                                  </div>
                                                          
                                                          
                                                                <div class="row mt-5">
                                                                  <div class="col-md-6">
                                                                      <div class="main-holder">
                                                                        <button type="button" class="btn survey-btn formsize text-white" id="editcurrentquestion" onclick="subtitlevalidation();">Save</button>
                                                                        <!--<button type="button" class="btn btn-submit formsize" id="addnewquestionbutton">Add Next Question</button>-->
                                                                        </div>
                                                                        
                                                                  </div>
                                                                  <div class="col-md-6">
                                                                      <div class="main-holder qidflt">
                                                                        <label class="form-label checklabel">Question ID : <span id="insertedqid"> </span></label>
                                                                        </div>
                                                                  </div>
                                                                  <input type="hidden" name="currquestionid" id="currquestionid" value="">
                                                                  <input type="hidden" name="textrequired" id="textrequired" value="">
                                                                  <input type="hidden" name="textother" id="textother" value="">
                                                                  <input type="hidden" name="radiosubquest" id="radiosubquest" value="">
                                                                </div> 
                                                          </div>
                                                </div>
                                            </form>
                                       
                                        
                                          </div>
                                        </div>
                                <!--End Boolean Section-->
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
</div>


<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered create-survey-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark">CREATE A NEW SURVEY</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-modal">
          <span aria-hidden="true">&times;</span>
        </button>
            </div>
            <div class="modal-body">
				
                <form id="request-form" class="create-survey-module" action="<?php echo SITEPATH; ?>add-survey-title-action.php" method="post">
                    <input type="hidden" name="filledby" value="Manual">
                    <input type="hidden" name="templateid" value="<?php echo $tempid?>">
                    <div class="form-group">
                        <input type="text" class="form-control formsize" name="surveytitle" id="surveytitle" placeholder="Survey Title">
                    </div>
                    <div class="form-group popupmar">
                        <select name="category" id="category" class="form-select formsize">
                            <option value="">Select Category</option>
                            <?php foreach($cat_list as $cat_lists){?>
                            <option value="<?php echo $cat_lists['category_id'];?>"><?php echo $cat_lists['title'];?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="form-group popupmar">
                        <textarea class="form-control formsize message-box-ht" id="description" name="description" placeholder="Survey Description" style="height:83px;"></textarea>
                    </div>
                    <div class="form-group popupmar">
                        <textarea class="form-control formsize message-box-ht" id="take_away" name="take_away" placeholder="Survey Take away" style="height:70px;"></textarea>
                    </div>
                    <div class="form-group popupmar" style="display:none">
                        <label><h5>Want to Publish your Survey</h5></label>
                         <fieldset id="group1">
                            <input type="radio" value="Published" name="is_publish" id="is_publish_yes" class="formsize message-box-ht">
                            <label for="is_publish_yes" class="rdo_label">Yes</label>&nbsp;
                            <input type="radio" value="Unpublished" name="is_publish" id="is_publish_no" class="formsize message-box-ht" checked="checked">
                            <label for="is_publish_no" class="rdo_label">No</label>
                          </fieldset>
                    </div>
                    <div class="row popbtncent"><div class="col-md-12 text-center"><button type="submit" class="btn btn-primary formsize popupmarbutton">Create Survey</button></div></div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.modal{
    pointer-events: none;
}

.modal-dialog{
    pointer-events: all;
 }
 .main-canvas {
    
    position: relative;
}

.box{
    
    cursor: move;
}
.rdo_label{
    font-size:13px;
    margin-right:10px;
    
}
.star{
    color: red;
    font-size: 14px;
    font-weight: 500;
}
.close{
    color: red!important;
    font-size: 23px!important;
    font-weight: bold!important;
}
</style>
<?php include("footer.php")?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">

 $(document).ready(function () {
     
        //  $('#myModal').on('hidden.bs.modal', function(e) {
        //     window.location.href = '<?php //echo SITEPATH?>dashboard';
        //   });
          
          $('#close-modal').click(function(){
            window.location.href = '<?php echo SITEPATH?>dashboard';
          });
          
        $("#questiontitle_error_message").hide();
        var questiontitle_error_message = false;
         $("#questionsubtitle_error_message").hide();
        var questionsubtitle_error_message = false;
        
        function check_questiontitle()
        {
            
            var qtitle= $("#questiontitle").val();
            if(qtitle == '')
            {
                $("#questiontitle_error_message").show();
                $("#questiontitle_error_message").html("Please enter question title");
                questiontitle_error_message = true;
            }
            else
            {
                $("#questiontitle_error_message").hide();
                questiontitle_error_message = false;
            } 
            
        }
        
        $("#questiontitle").keyup(function(){
           var qtitle= $("#questiontitle").val();
            if(qtitle == '')
            {
                $("#questiontitle_error_message").show();
                $("#questiontitle_error_message").html("Please enter question title");
                questiontitle_error_message = true;
            }
            else
            {
                $("#questiontitle_error_message").hide();
                questiontitle_error_message = false;
            } 
        });
        
        function check_questionsubtitle1()
        {
            var qradsubtitle= $("#radname1").val();
            if(qradsubtitle == '')
            {
                $("#questionsubtitle_error_message").show();
                $("#questionsubtitle_error_message").html("Please enter question Subtitle");
                questionsubtitle_error_message = true;
            }
            else
            {
                $("#questionsubtitle_error_message").hide();
                questionsubtitle_error_message = false;
            } 
            
           /* if(chksubtitle == '')
            {
                $("#questionsubtitle_error_message_chk").show();
                $("#questionsubtitle_error_message_chk").html("Please enter question Subtitle");
                questionsubtitle_error_message_chk = true;
            }
            else
            {
                $("#questionsubtitle_error_message_chk").hide();
                questionsubtitle_error_message_chk = false;
            } */
            
        }
        
        $("#radname1").keyup(function(){
           var qtitle= $("#radname1").val();
            if(qtitle == '')
            {
                  $("#questionsubtitle_error_message").show();
                $("#questionsubtitle_error_message").html("Please enter question Subtitle");
                questionsubtitle_error_message = true;
            }
            else
            {
                $("#questionsubtitle_error_message").hide();
                questionsubtitle_error_message = false;
            } 
        });
        
	    var survid = "<?php echo $surveyid;?>";
	    $("#frmaction").val("Insert");
	    if(survid=="")
	    {
		  $("#myModal").modal('show');
		  $("#allquestionlist").hide();
	    }
	    
        $.ajax({
              url : "<?php echo SITEPATH;?>view-questions.php",
              type : "POST",
              data : {surveyid:survid},
              success: function(dataquestion){
                 // alert(dataquestion);
                    $("#allquestionlist").html(dataquestion);
              }
        });
	    
	   
	    $("#allquestiontype").hide();
	    $("#showquestionoptions").hide();
	    $("#showcheckboxquestionoptions").hide();
	    $("#showdropdwnquestionoptions").hide();
	    $("#showrankorderquestionoptions").hide();
	    
	    
	    // Click + icon to show question type
	    $("#addnewquestion").click(function(){
          $("#allquestiontype").show();
          $("#questionform").hide();
          $("#frmaction").val("Insert");
          $(window).scrollTop(0);
        });
        
        $("#addnewquestionbutton").click(function(){
          $("#allquestiontype").show();
          $("#questionform").hide();
          $("#frmaction").val("Insert");
          $(window).scrollTop(0);
        });
        
        // Edit question and show question type
        $("#editcurrentquestion").click(function(){
            //Insert question code
            questiontitle_error_message = false;
            questionsubtitle_error_message = false;
            check_questiontitle();
            
            subtitlevalidation();
           /* check_questionsubtitle();*/
            if(questiontitle_error_message === false)
            {
                var i=1;
                var updquestid = $("#currquestionid").val();
                var frmaction = $("#frmaction").val();
                var currentqtype1 = $("#singleqtype").val();
                var currentqtype = currentqtype1.toLowerCase();
                if(currentqtype=="opinion scale")
                {
                    currentqtype="opinion-scale";
                }
                
                var questiontitle = $("#questiontitle").val();
                var questiontooltip = $("#questiontooltip-"+currentqtype).val();
                if ($("#isrequired-"+currentqtype).is(":checked") == true) {
                        $('#textrequired').val('Yes');
                } else {
                        $('#textrequired').val('No');
                }
                var isrequired = $('#textrequired').val();
                
                var singleqtype = $("#singleqtype").val();
                var texttype = $("#texttype").val();
                var checkboxoptions = $("input[name='chkname[]']").map(function(){return $(this).val();}).get();
                var radoptions = $("input[name='radname[]']").map(function(){return $(this).val();}).get();
                var dropdownval = $("input[name='dropdwnname[]']").map(function(){return $(this).val();}).get();
                var rankoptions = $("input[name='rankname[]']").map(function(){return $(this).val();}).get();
                
                var mintext=$("#leftlabel").val();
                var midtext=$("#middlelabel").val();
                var maxtext=$("#rightlabel").val();
                //alert(radoptions);
                 if(frmaction=="Insert")
                 {
                    if(radoptions==""){ radoptions="";}
                    if(checkboxoptions==""){ checkboxoptions="";}
                    if(dropdownval==""){ dropdownval="";}
                    if(rankoptions==""){rankoptions="";}
                    var currurl = "update-question.php";
                 }
                 else
                 {
                    if(radoptions==""){ radoptions="";}
                    if(checkboxoptions==""){ checkboxoptions="";}
                    if(dropdownval==""){ dropdownval="";}
                    if(rankoptions==""){rankoptions="";}
                    var currurl = "update-question-data.php"; 
                 }
                 var other = $("#textother").val();
                 
                $.ajax({
                     
                      url : currurl,
                      type : "POST",
                      data : {questiontitle:questiontitle,questiontooltip:questiontooltip,isrequired:isrequired,updquestid:updquestid,singleqtype:singleqtype,texttype:texttype,checkboxoptions:checkboxoptions,radoptions:radoptions,dropdownval:dropdownval,other:other,mintext:mintext,midtext:midtext,maxtext:maxtext,rankoptions:rankoptions},
                      success: function(dataquestion){
                          //alert(dataquestion);
                           
                            $("#questiontitle").val("");
                            $("#questiontooltip-"+currentqtype).val("");
                            $('#isrequired-'+currentqtype).prop('checked', false);
                            //$('#isrequired').prop('checked', false);
                            //$("#showdropdwnquestionoptions").html("");
                            $("#showcheckboxquestionoptions").html(""); 
                            $("#showquestionoptions").html("");
                            $("input[name='chkname[]']").val("");
                            $("input[name='radname[]']").val("");
                            $("input[name='dropdwnname[]']").val("");
                            $("input[name='rankname[]']").val("");
                            $("#textother").val("");
                            $("#leftlabel").val("");
                            $("#middlelabel").val("");
                            $("#rightlabel").val("");
                            $("#other-"+currentqtype).prop('checked', false);
                            $.ajax({
                              url : "<?php echo SITEPATH;?>view-questions.php",
                              type : "POST",
                              data : {surveyid:survid},
                              success: function(dataquestion){
                                    $("#allquestionlist").html(dataquestion);
                                    $("#"+currentqtype).hide();
                                    $("#questionform").hide();
                                    $("#allquestiontype").show();
                                    $("#share_survey").removeClass("disabled");
                                    $("#share_survey").attr("href", "share?surveyid="+survid);
                                   
                              }
                          });
                      }
                  });
            }
            else
            {
                return false;
            }
       });
       
            
        //Add options for checkbox
       var i=1;
        $('#add').click(function(){
           //var i=1;
           
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-addedchk"><td><input type="text" id="chkname'+i+'" name="chkname[]" placeholder="Enter Choice" class="form-control name_list chkboxtxt" onkeyup="showcheckoption('+i+')" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
        });
        
        $(document).on('click', '.btn_remove', function(){
            
           var button_id = $(this).attr("id"); 
           $('#row'+button_id+'').remove(); 
           $("#txx" + button_id).remove();
        }); 
        
         //Add options for Radio
        $('#addrad').click(function(){
           var i = $("#seti").val();
           i=parseInt(i)+parseInt(1);  
           
           //alert(i);
           $('#dynamic_field_rad').append('<tr id="row'+i+'" class="dynamic-addedrad"><td><input type="text" id="radname'+i+'" name="radname[]" placeholder="Enter Choice" class="form-control name_list chkboxtxt" onkeyup="showradoption('+i+')" onfocusout="addradoptiontable('+i+')" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove_rad">X</button></td></tr>');  
           $("#seti").val(i);
        });
        
        $(document).on('click', '.btn_remove_rad', function(){
            
           var button_id = $(this).attr("id"); 
           $('#row'+button_id+'').remove(); 
           $("#txxrad" + button_id).remove();
           $("#raddrop"+button_id).remove();
        }); 
        
        //Add options for Radio
        $('#adddropdwn').click(function(){
           //var i=1;
           i++;  
           
           $('#dynamic_field_dropdwn').append('<tr id="row'+i+'" class="dynamic-addeddropdwn"><td><input type="text" id="dropdwnname'+i+'" name="dropdwnname[]" placeholder="Enter Choice" class="form-control name_list chkboxtxt" onkeyup="showdropdwnoption('+i+')" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove_dropdwn">X</button></td></tr>');  
        });
        
        $(document).on('click', '.btn_remove_dropdwn', function(){
            
           var button_id = $(this).attr("id"); 
           $('#row'+button_id+'').remove(); 
           $("#dropdwnrep option[id='"+button_id+"']").remove();
           //$("#dropdwnrep" + button_id).remove();
        });
        
        $("#other-radio").click(function () {
            
            $("#showcheckboxquestionoptions").show();
            
    	    if ($("#other-radio").is(":checked") == true)
    	    {
                $('#textother').val('Other');
                var optrad = $("#textother").val();
                var radiooptions = $("#textother").val();
                
                $("#showcheckboxquestionoptions").append('<div class="col-md-12" name="txxrad'+optrad+'" id="txxrad'+optrad+'"><div class="row"><div class="col-md-12"><div class="main-holder" style="font-size:17px;"><input type="radio" id="radiotype'+optrad+'"disabled><span style="padding-left:10px;" id="radiorep'+optrad+'">'+radiooptions+'</span></div></div></div></div>');
                
            } else {
                // $('#textrequired').val('No');
                $("#textother").val('');
                $("#txxradOther").remove();
            }
        });
        
         //Add options for Rank
        $('#addrank').click(function(){
           i++;  
           //alert(i);
           $('#dynamic_field_rank').append('<tr id="row'+i+'" class="dynamic-addedrank"><td><input type="text" id="rankname'+i+'" name="rankname[]" placeholder="Enter Choice" class="form-control name_list chkboxtxt" onkeyup="showrankoption('+i+')" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove_rank">X</button></td></tr>');  
        });
        
        $(document).on('click', '.btn_remove_rank', function(){
            
           var button_id = $(this).attr("id"); 
           $('#row'+button_id+'').remove(); 
           $("#txxrank" + button_id).remove();
        }); 
        
        $("#other-checkbox").click(function () {
            
            $("#showcheckboxquestionoptions").show();
            
    	    if ($("#other-checkbox").is(":checked") == true)
    	    {
                $('#textother').val('Other');
                var optcnt = $("#textother").val();
                var checkboxoptions = $("#textother").val();
                
                $("#showcheckboxquestionoptions").append('<div class="col-md-12" name="txx'+optcnt+'" id="txx'+optcnt+'"><div class="row"><div class="col-md-12"><div class="main-holder" style="font-size:17px;"><input type="checkbox" id="checktype'+optcnt+'"disabled><span style="padding-left:10px;" id="ckrep'+optcnt+'">'+checkboxoptions+'</span></div></div></div></div>');
                
            } else {
                // $('#textrequired').val('No');
                $("#textother").val('');
                $("#txxOther").remove();
            }
        });
	});
	
	
	function fetchquesttype(qtype12,qtypeid)
	{   var i=1;
	    var survid = "<?php echo $surveyid;?>";
	    $("#frmaction").val("Insert");
	    $("#allquestiontype").hide();
	    $("#questionform").show();
	    var qt = qtype12.toLowerCase();
	    var allquestiontype=$("#qtypearray").val();
	    var valNew=allquestiontype.split(',');

        for(var jj=0;jj<valNew.length;jj++)
        {
           var singleqtype=valNew[jj];
           var singleone=singleqtype.toLowerCase();
           if(singleone=="opinion scale")
           {
               singleone="opinion-scale"; 
           }
           $("#"+singleone).hide();
           
        }
         $("#fetcheditoptions").html("");
         $("#fetcheditoptions").hide();
          $("#showrankorderquestionoptions").html("");
         if(qt=="opinion scale")
         {
           qt="opinion-scale";
    	   $("#"+qt).show();
         }
         else
         {
            $("#"+qt).show(); 
         }
    	   $("#singleqtype").val(qtype12);
    	   var singleqtype = $("#singleqtype").val();
    	   $.ajax({
                  url : "insert-questions.php",
                  type : "POST",
                  data : {qtypeid:qtypeid,survid:survid,singleqtype:singleqtype},
                  success: function(dataquestionid){
                       $("#insertedqid").text(dataquestionid);
                       $("#currquestionid").val(dataquestionid);
                       $("#radiosubquest").val("");
                       $("#seti").val("1");
                      // $("#isrequired-"+qt).attr('checked', false);
                       var i=1;
                       //$("#quid").val(dataquestionid);
                        $.ajax({
                              url : "<?php echo SITEPATH;?>view-questions.php",
                              type : "POST",
                              data : {surveyid:survid},
                              success: function(dataquestion){
                                    $("#allquestionlist").html(dataquestion);
                              }
                           });
                        if(qtype12=="Opinion Scale")
                        {  //alert(dataquestionid);
                        //alert(qtype12);
                            $.ajax({
                                    url : "<?php echo SITEPATH;?>fetch-edit-data.php",
                                    type : "POST",
                                    dataType: "json",
                                    data : {editqid:dataquestionid,qtype:qtype12},
                                    success: function(data2){//{"qtitle":"what is your favourate game.?","qtooltip":"","qrequired":"No"}
                                        //alert(data2.qsubtitle);
                                            var subtitle = data2.qsubtitle;
                                            var allscalevalue = subtitle.split(",");
                                            $("#leftlabel").val(allscalevalue[0]);
                                            $("#middlelabel").val(allscalevalue[1]);
                                            $("#rightlabel").val(allscalevalue[2]);
                                            $("#minlabel").text(allscalevalue[0]);
                                            $("#midlabel").text(allscalevalue[1]);
                                            $("#highlabel").text(allscalevalue[2]);
                                    }
                                });
                        }
                       
                        $.ajax({
                              url : "<?php echo SITEPATH;?>logic.php",
                              type : "POST",
                              data : {surveyid:survid,editqid:dataquestionid,qtype:qtype12},
                              beforeSend: function(){
                                        // Show image container
                                        $('#span_loader1').show();
                              },
                              success: function(logicquestion){
                                     $('#span_loader1').hide();
                                     //alert(logicquestion);
                                     $("#logicquestions-"+qt).html(logicquestion);
                                     
                              }
                           });
                  }
          });
          $("#showquestionoptions").show();
          if(qtype12=="Boolean")
          {
            $("#showopinionscalequestionoptions").hide();
            $("#showquestionoptions").html('<div class="row justify-content-center"><div class="col-2 yesno_box__icon-wrap"><i class="fa fa-thumbs-up" style="font-size:100px;"></i></div><div class="col-2 yesno_box__icon-wrap" style="margin-left:10px;"><i class="fa fa-thumbs-down" style="font-size:100px;"></i></div></div><div class="row justify-content-center"><div class="col-2 bollab"><label>YES</label></div><div class="col-2 bollab" style="margin-left:10px;"><label>NO</label></div></div>');
            $("#questiontitle").val("");
            $("#questiontooltip-"+qt).val("");
            $('#isrequired-'+qt).prop('checked', false);
            
          }
          if(qtype12=="Text")
          {
            $("#showopinionscalequestionoptions").hide();
            $("#showquestionoptions").html('<div class="col-md-12"><div class="row"><div class="col-md-12"><div class="main-holder"><div class="textinput-box active"><input disabled="" placeholder="Text Input" class="disabltext"></div></div></div></div></div>');
            $("#questiontitle").val("");
            $("#questiontooltip-"+qt).val("");
            $('#isrequired-'+qt).prop('checked', false);
            $('#texttype').val("");
           
          }
          if(qtype12=="Rating")
          {
            $("#showopinionscalequestionoptions").hide();
            $("#showquestionoptions").html('<div class="row justify-content-center"><div class="col-md-12 text-center star-size"><i class="fa fa-star-o"></i><i class="fa fa-star-o starpad"></i><i class="fa fa-star-o starpad"></i><i class="fa fa-star-o starpad"></i><i class="fa fa-star-o starpad"></i></div></div>');
            $("#questiontitle").val("");
            $("#questiontooltip-"+qt).val("");
            $('#isrequired-'+qt).prop('checked', false);
            
          }
          if(qtype12=="Checkbox" || qtype12=="Radio")
          {
               $("#showquestionoptions").hide();
               $("#showdropdwnquestionoptions").hide();
               $("#showopinionscalequestionoptions").hide();
                $("#showrankorderquestionoptions").hide();
               $("#questiontitle").val("");
               $("#questiontooltip-"+qt).val("");
               $('#isrequired-'+qt).prop('checked', false);
               $("#showcheckboxquestionoptions").text("");
               if(qtype12=="Checkbox")
               {
                   $('.dynamic-addedchk').remove();
                   $('#add_chk_name')[0].reset();
               }
               if(qtype12=="Radio")
               {
                   $('.dynamic-addedrad').remove();
                   $('#add_rad_name')[0].reset();
                  
               }
               
          }
          if(qtype12=="Dropdown")
          {
              $("#showquestionoptions").hide();
              $("#showcheckboxquestionoptions").hide();
              $("#showopinionscalequestionoptions").hide();
              $("#showdropdwnquestionoptions").show();
               $("#showrankorderquestionoptions").hide();
              $("#questiontitle").val("");
              $("#questiontooltip-"+qt).val("");
              $('#isrequired-'+qt).prop('checked', false);
              $('.dynamic-addeddropdwn').remove();
              $('#add_dropdwn_name')[0].reset();
              $('#dropdwnrep').empty();
          }
          if(qtype12=="Opinion Scale")
          {
              $("#showquestionoptions").hide();
              $("#showcheckboxquestionoptions").hide();
              $("#showdropdwnquestionoptions").hide();
              $("#showopinionscalequestionoptions").show();
               $("#showrankorderquestionoptions").hide();
              $("#questiontitle").val("");
              $("#questiontooltip-"+qt).val("");
              $('#isrequired-'+qt).prop('checked', false);
          }
          
           if(qtype12=="Order"){
              $("#showopinionscalequestionoptions").hide();
               $("#showquestionoptions").hide();
               $("#showdropdwnquestionoptions").hide();
               $("#questiontitle").val("");
               $("#questiontooltip-"+qt).val("");
               $('#isrequired-'+qt).prop('checked', false);
               $("#showcheckboxquestionoptions").text("");
              if(qtype12=="Order")
               {
                   $('.dynamic-addedrank').remove();
                   $('#add_rank_name')[0].reset();
                  
               }
             
          }
	}
	
	function showcheckoption(optcnt)
	{  
	    $("#showcheckboxquestionoptions").show();
        var checkboxoptions = $("#chkname"+optcnt).val();
        
        var myDiv = $('#txx'+optcnt);

        if(myDiv.length)
        {
	        $("#ckrep"+optcnt).text(checkboxoptions);
	        if($("#ckrep"+optcnt).text()=="")
	        {
	            
	            $("#checktype"+optcnt).hide();
	        }
	        else
	        {
	            $("#checktype"+optcnt).show();
	        }
        }
        else
        {
            $("#showcheckboxquestionoptions").append('<div class="col-md-12" name="txx'+optcnt+'" id="txx'+optcnt+'"><div class="row"><div class="col-md-12"><div class="main-holder" style="font-size:17px;"><input type="checkbox" id="checktype'+optcnt+'"disabled><span style="padding-left:10px;" id="ckrep'+optcnt+'">'+checkboxoptions+'</span></div></div></div></div>');
        }
        
    }
    
    function showradoption(optrad)
	{  
	    $("#showcheckboxquestionoptions").show();
	    var radiooptions = $("#radname"+optrad).val();
	    //alert(optrad);
        var curqtype = $("#singleqtype").val();
        var myDiv1 = $('#txxrad'+optrad);
       
        if(myDiv1.length)
        { 
            $("#raddrop"+optrad).val(radiooptions);
	        $("#raddrop"+optrad).text(radiooptions);
	        $("#radiorep"+optrad).text(radiooptions);
	        if($("#radiorep"+optrad).text()=="")
	        {
	            
	            $("#radiotype"+optrad).hide();
	        }
	        else
	        {
	            $("#radiotype"+optrad).show();
	            
	        }
        }
        else
        {
            $("#showcheckboxquestionoptions").append('<div class="col-md-12" name="txxrad'+optrad+'" id="txxrad'+optrad+'"><div class="row"><div class="col-md-12"><div class="main-holder" style="font-size:17px;"><input type="radio" id="radiotype'+optrad+'"disabled><span style="padding-left:10px;" id="radiorep'+optrad+'">'+radiooptions+'</span></div></div></div></div>');
            $("#subidval-"+curqtype).append('<option value='+radiooptions+' id=raddrop'+optrad+'>'+radiooptions+'</option>');
        }
        
        //alert(radiooptions);
                          
        
        
    }
    
    function addradoptiontable(optrad)
    {
        var updquestid = $("#currquestionid").val();
	    var radiooptions = $("#radname"+optrad).val();
	    //alert(optrad);
	    //alert(i);
	    //var optraddd="";
	    var myDiv1 = $('#txxrad'+optrad);
        var subid ="";
        
        if(myDiv1.length)
        {   //alert(optrad);
            var setquestion = $("#radiosubquest").val();
            //alert(setquestion);
            if(setquestion=="")
            {
               subid = "";
            }
            else
            {
              var setquestionarray = setquestion.split(";");
              //alert(setquestionarray);
              var optraddd = optrad-1;
              //alert(optraddd);
              //alert(setquestionarray[optraddd]);
              subid = setquestionarray[optraddd];
            }
            //alert(subid);
            if(subid=="")
            {
                var opttype = "optinsert";
                var subid="";
                   $.ajax({
                       url : "<?php echo SITEPATH;?>add-radio-options.php",
                       type : "POST",
                       data : {updquestid:updquestid,radoptions:radiooptions,opttype:opttype,subid:subid},
                       success: function(lastid){
                           //alert(lastid);
                                var setquestion = $("#radiosubquest").val();
                                if(setquestion!="")
                                {
                                    var setquestionarray = setquestion.split(";");
                                    var nqid = lastid+'';
                                    var posq = setquestionarray.indexOf(nqid);
                                    if(posq=="-1")
                                    {
                                        $("#radiosubquest").val(setquestion+lastid+";");
                                    }
                                }
                                else
                                {
                                    $("#radiosubquest").val(lastid+";");
                                }
                        }
                   });
            }
            else
            {
              var opttype = "optupdate";
              $.ajax({
                  url : "<?php echo SITEPATH;?>add-radio-options.php",
                  type : "POST",
                  data : {updquestid:updquestid,radoptions:radiooptions,opttype:opttype,subid:subid},
                  beforeSend: function(){
                            // Show image container
                            $('#span_loader1').show();
                  },
                  success: function(logicquestion){
                         $('#span_loader1').hide();
                         
                  }
              });
            }
        }
       
         
    }
    
    
    function showdropdwnoption(optdropdwn)
	{  
	    $("#showdropdwmquestionoptions").show();
        var dropdwnoptions = $("#dropdwnname"+optdropdwn).val();
        
        //var myDiv2 = $('#'+optdropdwn).val();
        var myDiv2 = $('#dropdwnrep option[id='+optdropdwn+']').length;
 
        if(myDiv2)
        {
	        $("#"+optdropdwn).val(dropdwnoptions);
	        $("#"+optdropdwn).text(dropdwnoptions);
        }
        else
        {
            $("#dropdwnrep").append('<option value='+dropdwnoptions+' id='+optdropdwn+'>'+dropdwnoptions+'</option>');
        }
        
    }
    
    function showscaletext()
    {  
        var mintext=$("#leftlabel").val();
        $("#minlabel").text(mintext);
        //alert(mintext.length);
        if(mintext.length==25){
            $("#leftmaxerror").text("Length Exceeded");
        }
        else{
            $("#leftmaxerror").text("");
        }
        
        
        var midtext=$("#middlelabel").val();
        $("#midlabel").text(midtext);
        if(midtext.length==25){
            $("#middlemaxerror").text("Length Exceeded");
        }
        else{
            $("#middlemaxerror").text("");
        }
        
        var maxtext=$("#rightlabel").val();
        $("#highlabel").text(maxtext);
        if(maxtext.length==25){
            $("#rightmaxerror").text("Length Exceeded");
        }
        else{
            $("#rightmaxerror").text("");
        }
    }
    
     function showrankoption(optrank)
	{  
	    $("#showrankorderquestionoptions").show();
	    var rankoptions = $("#rankname"+optrank).val();
        
        var myDiv3 = $('#txxrank'+optrank);
       
        if(myDiv3.length)
        {
	        $("#rankrep"+optrank).text(rankoptions);
	        if($("#rankrep"+optrank).text()=="")
	        {
	            
	            $("#ranktype"+optrank).hide();
	        }
	        else
	        {
	            $("#ranktype"+optrank).show();
	        }
        }
        else
        {
           
            $("#showrankorderquestionoptions").append('<div class="col-md-12" name="txxrank'+optrank+'" id="txxrank'+optrank+'"><div class="row"><div class="col-md-12"><div class="main-holder" style="font-size:17px;"><input type="radio" id="ranktype'+optrank+'"disabled><span style="padding-left:10px;" id="rankrep'+optrank+'">'+rankoptions+'</span></div></div></div></div>');
        }
        
    }
</script>

<script>
    function subtitlevalidation(){
      var currentqtype1 = $("#singleqtype").val();
      var currentqtype = currentqtype1.toLowerCase();
        if(currentqtype=="opinion scale")
        {
            currentqtype="opinion-scale";
        }
        var checkboxoptions = $("input[name='chkname[]']").map(function(){return $(this).val();}).get();
        var radoptions = $("input[name='radname[]']").map(function(){return $(this).val();}).get();
        var dropdownval = $("input[name='dropdwnname[]']").map(function(){return $(this).val();}).get();
        var rankoptions = $("input[name='rankname[]']").map(function(){return $(this).val();}).get();
        alert(radoptions);
    }
</script>

<script>
    $(document).ready(function(){
       $('.wrapper').addClass("toggled"); 
    });
</script>


<script src="<?php echo SITEPATHFRONT; ?>js/jquery.validate.js"></script>
<script src="<?php echo SITEPATHFRONT; ?>js/requestpopup.js"></script>
<script>
  $(document).ready(function(){
$(".title-tip").hover(function(){
$(this).removeAttr("title");
}, function(){
$(this).removeAttr("tooltip-data");
});
});
</script>