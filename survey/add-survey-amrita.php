<?php 
require_once("classes/cls-survey.php");

$obj_survey = new Survey();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}
if(isset($_GET['surveyid']))
{
    $surveyid=$_GET['surveyid'];
    $userid=$_SESSION['ifg_admin']['client_id'];
    $fields_survey_list = "*";
    $condition_survey_list = "`tbl_survey`.`survey_id` ='".$surveyid."' and `tbl_survey`.`user_id`=".$userid;
    $survey_list_details=$obj_survey->getSurveyDetail($fields_survey_list, $condition_survey_list, '', '', 0);
    foreach($survey_list_details as $survey_list_detail)
    {
        $survey_list=$survey_list_detail['survey_id'];
    } 
    // if($survey_list == "")
    // {
    //      header("Location:login.php");
    // }
}

$_SESSION['survey_sess_id']="";
/*****Survey Title Detail************/
if(isset($_GET['surveyid']))
{
    $surveyid=$_GET['surveyid'];
    $_SESSION['survey_sess_id']=$surveyid;
    $fields_survey = "*";
    $condition_survey = "`tbl_survey`.`survey_id` ='".$surveyid."'";
    $survey_list=$obj_survey->getSurveyDetail($fields_survey, $condition_survey, '', '', 0);
    foreach($survey_list as $survey_lists)
    {
        $survey_title=$survey_lists['survey_title'];
       
    }
    
    /**********Question Bank All***************/
    $fields_quest_bank = "*";
    $condition_quest_bank = "`tbl_questionBank`.`status` = 'Active' and `tbl_questionBank`.`survey_id`='".$surveyid."'";
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
<style>
    .dropbtn {
  /*background-color: #3498DB;*/
  color: #3498DB;
  /*padding: 16px;*/
  font-size: 16px;
  border: none;
  cursor: pointer;
  font-weight:500;
}

.dropbtn:hover, .dropbtn:focus {
  /*background-color: #2980B9;*/
  color: #2980B9!important;
}

 .dropbtn1 {
  /*background-color: #3498DB;*/
  color: #3498DB;
  /*padding: 16px;*/
  font-size: 16px;
  border: none;
  cursor: pointer;
  font-weight:500;
}

.dropbtn1:hover, .dropbtn1:focus {
  /*background-color: #2980B9;*/
  color: #2980B9!important;
}

.dropdown1 {
  /*position: relative;*/
  /*display: inline-block;*/
  float: right;
  padding-right: 11px;

}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  overflow: auto;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
  right:24px;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  font-size: 13px;
}

.dropdown-content1 {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  overflow: auto;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
  right:75px;
}

.dropdown-content1 a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  font-size: 13px;
}
.dropdown1 a:hover {background-color: #ddd;}

.showins {display: block;}

.container1 {
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  /*margin-top: 100px;*/
}

.container1 > div{
  margin-right: 50px;
}

.flipspinner {
  height: 36px;
  width: 36px;
  background-color: cadetblue;
  animation: flip 1s linear infinite;
}

@keyframes flip {
  50% { 
    transform: rotateX(180deg); 
      background-color: var(--spinner-color-2);
  }
  100% { 
    transform: rotateX(180deg) rotateY(180deg); 
  }
}
</style>
<link rel="icon" href="<?php echo SITEPATHFRONT; ?>images/Avira-Survey-Logo_Favicon.png">
<link rel="stylesheet" href="<?php echo SITEPATH;?>css/survey.css">
<link rel="stylesheet" href="<?php echo SITEPATH;?>css/modal-style.css">
<div class="wrapper">
   <?php include("sidebarmenu.php")?>
        <?php include("header.php")?>
        <section class="space-padding-top">
            <div class="container-fluid pse-2">
                <div class="row">
                    <div class="col-md-4">
                        <div class="bg-white p-4 ht-8 ht-7 br-5  box-shadow">
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
                        <div class="bg-white p-4 ht-8 br-5 box-shadow">
                            <div id="ques_img" class="survey_img_empty">
                                <img src="https://www.software-intent.com/survey/images/Manual.png" class="img-fluid">
                            </div>
                             <div id="allquestiontype">
                                    <h2 class="cardt">Choose Question Type</h2>
                                    
                                    <div class="row choose-q-type">
                                    <?php $allquestiontype="";foreach($question_type_list as $question_type_lists){ 
                                      if( $question_type_lists['quest_type'] != "Dropdown" && $question_type_lists['quest_type'] != "Mrating") {
                                    ?>
                                          <div class="col-md-4 paddqtype1" style="cursor:pointer;" onclick="fetchquesttype('<?php echo $question_type_lists['quest_type'];?>','<?php echo $question_type_lists['quest_type_id'];?>')">
                                            <img class="qtype_icon" src="<?php echo SITEPATH; ?>images/qtype_icon/<?php echo $question_type_lists['quest_type']; ?>.png"> <span class="questyp" id="questyp<?php echo $question_type_lists['quest_type_id'];?>"><?php if($question_type_lists['quest_type'] == "Order"){ echo "Rank Order";} else { echo $question_type_lists['quest_type']; } ?></span>
                                            
                                          </div>
                                         
                                        <?php $allquestiontype.= $question_type_lists['quest_type'].",";
                                    
                                  }  }?>
                                    <input type="hidden" name="qtypearray" id="qtypearray" value="<?php echo trim($allquestiontype,",");?>">
                                    </div>
                                    
                                </div>
                                <!--Question Form Start-->
                             <div id="questionform" style="display:none;">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h2 class="card-title cardt">Edit :</h2>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="q-type-icon float-end">
                                                <img class="qtype_icon" src="" id="qtype_icon_quest" > <h3 id="quest_type" class="float-end"></h3>
                                           </div>
                                        </div>
                                        <!--<div class="col-md-1">-->
                                        <!--    <img class="qtype_icon float-end" src="" id="qtype_icon_quest" >-->
                                        <!--</div>-->
                                        
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
                                                            <div class="d-flex que_title_count">
                                                            <span id="que_seq"></span><input type="text" class="form-control formsize" name="questiontitle" id="questiontitle"
                                                            placeholder="Start Typing Question" value="">
                                                            </div>
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
                                                    <div id="showmatrixtable">
                                                        <div class="col-md-12">
                                                            
                                                                    <div class="dropdown1">
                                                                          <a href="javascript:void(0);" onclick="mattoggleinsert()" class="dropbtn">Insert</a>
                                                                          <div id="myDropdowninsert" class="dropdown-content">
                                                                            <a href="#row" onclick="insertrowcol('row')">Insert Row</a>
                                                                            <a href="#col" onclick="insertrowcol('column')">Insert Column</a>
                                                                          <div>
                                                                          </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="dropdown1">
                                                                          <a href="javascript:void(0);" onclick="mattoggleremove()" class="dropbtn1">Remove</a>
                                                                          <div id="myDropdownremove" class="dropdown-content1">
                                                                            <a href="#row" onclick="removerowcol('row')">Remove Row</a>
                                                                            <a href="#col" onclick="removerowcol('column')">Remove Column</a>
                                                                          <div>
                                                                          </div>
                                                                          </div>
                                                                    </div>
                                                        </div>
                                                        <div class="container1">
                                                            <div id="matrix_loader" class="flipspinner"></div></div>
                                                        <div id="matrixtable">
                                                            
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
                                                                <div class="container">
                                                                   <div class="row">
                                                                        <div class="col-md-12">
                                                                           <div class="main-holder">
                                                                               <div class="row" style="text-align:center;" id="logicquestions-boolean">
                                                                                    
                                                                               </div> 
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
                                                                <div class="container">
                                                                   <div class="row">
                                                                        <div class="col-md-12">
                                                                           <div class="main-holder">
                                                                               <div class="row" style="text-align:center;" id="logicquestions-rating">
                                                                                    
                                                                               </div> 
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
                                                                 <div class="container">
                                                                 <div class="row">
                                                                    <div class="col-md-12">
                                                                       <div class="main-holder">
                                                                           <div class="row" style="text-align:center;" id="logicquestions-text">
                                                                           </div> 
                                                                        </div>
                                                                    </div>
                                                                 </div>
                                                                </div>
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
                                                                                <div class="star" id="questionsubtitle_error_message_chk"></div>
                                                                    </div>
                                                                    </form>
                                                                    
                                                                    <div class="row"><div class="col-md-12"><hr></div></div>
                                                                    
                                                                    </section>
                                                                    
                                                                    
                                                                    <section id="logic" class="tab-panel">
                                                                       <div class="container">
                                                                             <div class="row">
                                                                                <div class="col-md-12">
                                                                                   <div class="main-holder">
                                                                                       <div class="row" style="text-align:center;" id="logicquestions-checkbox">
                                                                                       </div> 
                                                                                    </div>
                                                                                </div>
                                                                             </div>
                                                                        </div>
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
                                                                        </table> 
                                                                        <div class="star" id="questionsubtitle_error_message"></div>
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
                                                                        <div class="star" id="questionsubtitle_error_message_drp"></div>
                                                                    </div>
                                                                    </form>
                                                                    
                                                                    <div class="row"><div class="col-md-12"><hr></div></div>
                                                                    
                                                                    </section>
                                                                    
                                                                    
                                                                    <section id="logic" class="tab-panel">
                                                                       <div class="container">
                                                                             <div class="row">
                                                                                <div class="col-md-12">
                                                                                   <div class="main-holder">
                                                                                       <div class="row" style="text-align:center;" id="logicquestions-dropdown">
                                                                                       </div> 
                                                                                    </div>
                                                                                </div>
                                                                             </div>
                                                                        </div>
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
                                                                <div class="container">
                                                                   <div class="row">
                                                                        <div class="col-md-12">
                                                                           <div class="main-holder">
                                                                               <div class="row" style="text-align:center;" id="logicquestions-opinion-scale">
                                                                                    
                                                                               </div> 
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
                                                                        <div class="star" id="questionsubtitle_error_message_rank"></div>
                                                                    </div>
                                                                    </form>
                                                                    
                                                                    <div class="row"><div class="col-md-12"><hr></div></div>
                                                                    
                                                                    </section>
                                                                    
                                                                    
                                                                    <section id="logic" class="tab-panel">
                                                                      <div class="container">
                                                                             <div class="row">
                                                                                <div class="col-md-12">
                                                                                   <div class="main-holder">
                                                                                       <div class="row" style="text-align:center;" id="logicquestions-order">
                                                                                       </div> 
                                                                                    </div>
                                                                                </div>
                                                                             </div>
                                                                        </div>
                                                                    </section>
                                                                    
                                                                  </div>
                                                          
                                                                <!--Matrix section-->
                                                          <div class="tab-panels" id="matrix" style="display:none;">
                                                            <section id="options" class="tab-panel">
                                                            
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <div class="main-holder">
                                                                            <div class="form-group">
                                                                               <input type="text" class="form-control formsize" name="questiontooltip-matrix" id="questiontooltip-matrix" placeholder="Tooltip">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                      <div class="main-holder">
                                                                        <div class="form-group reqflt">
                                                                               <input type="checkbox" class="largerCheckbox" name="isrequired-matrix" id="isrequired-matrix">
                                                                               <label class="form-label checklabel">Required</label>
                                                                            </div>
                                                                      </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="col-md-5">
                                                                       <div class="main-holder">
                                                                           <label class="form-label checklabel">Matrix Type</label>
                                                                           <div class="row"><div class="col-md-12">
                                                                               <select class="form-select txttype" name="mattype" id="mattype" onchange="setmattype();">
                                                                                   <option value="">Select Matrix Type</option>
                                                                                   <option value="checkbox">Checkbox</option>
                                                                                   <option value="radio">Radio</option>
                                                                               </select>
                                                                               <div class="star" id="matrix_error_message"></div>
                                                                           </div></div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="col-md-12"><hr></div>
                                                                </div>
                                                                
                                                            </section>
                                                            
                                                            
                                                            <section id="logic" class="tab-panel">
                                                                <div class="container">
                                                                   <div class="row">
                                                                        <div class="col-md-12">
                                                                           <div class="main-holder">
                                                                               <div class="row" style="text-align:center;" id="logicquestions-opinion-scale">
                                                                                    
                                                                               </div> 
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </section>
                                                            
                                                          </div>
                                                                <div class="row mt-5">
                                                                  <div class="col-md-6">
                                                                      <!--<input type="text" id="subtitlevalidation" name="subtitlevalidation" value="0">-->
                                                                      <div class="main-holder">
                                                                        <button type="button" class="btn survey-btn formsize text-white" id="editcurrentquestion">Save</button>
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
                                                                  <input type="hidden" name="matrixtype" id="matrixtype" value="">
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
				
                <form id="request-form" class="create-survey-module" action="<?php echo SITEPATH; ?>add-survey-title-action-test1.php" method="post">
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

<!--<div class="overlay">
	<div class="overlayDoor"></div>
	<div class="overlayContent">
		<div class="loader">
			<div class="inner"></div>
		</div>
	</div>
</div>-->

<?php include("footer.php")?>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">

/*$(document).ready(function() {
    
	// Will wait for everything on the page to load.
	$(window).bind('load', function() {
		$('.overlay, body').addClass('loaded');
		setTimeout(function() {
			$('.overlay').css({'display':'none'})
		}, 500)
	});
	
	// Will remove overlay after 1min for users cannnot load properly.
	setTimeout(function() {
		$('.overlay, body').addClass('loaded');
	}, 500);
});*/

 $(document).ready(function () {
     // ==== loader ======//
     
          $('#close-modal').click(function(){
            window.location.href = '<?php echo SITEPATH?>dashboard';
          });
          
        $("#questiontitle_error_message").hide();
        var questiontitle_error_message = false;
        var matrix_error_message = false;
        
        function check_matrixtype()
        {
            var mattype1= $("#mattype").val();
            
            if(mattype1 == '')
            {
                $("#matrix_error_message").show();
                $("#matrix_error_message").html("Please select matrix type");
                matrix_error_message = true;
            }
            else
            {
                $("#matrix_error_message").hide();
                matrix_error_message = false;
            } 
        }
        
        function check_questiontitle()
        {
            var qtitle= $("#questiontitle").val();
            var qtitle = qtitle.trim();
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
           var qtitle = qtitle.trim();
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
        
        $("#chkname1").keyup(function(){
           var qsubtitle= $("#chkname1").val();
           var qsubtitle = qsubtitle.trim();
            if(qsubtitle == '')
            {
                $("#questionsubtitle_error_message_chk").show();
                $("#questionsubtitle_error_message_chk").html("Please enter Checkbox Options");
                questionsubtitle_error_message = true;
            }
            else
            {
                $("#questionsubtitle_error_message_chk").hide();
                questionsubtitle_error_message = false;
            } 
        });
        
        $("#radname1").keyup(function(){
           var qsubtitle= $("#radname1").val();
           var qsubtitle = qsubtitle.trim();
            if(qsubtitle == '')
            {
                $("#questionsubtitle_error_message").show();
                $("#questionsubtitle_error_message").html("Please enter Radio Options");
                questionsubtitle_error_message = true;
            }
            else
            {
                $("#questionsubtitle_error_message").hide();
                questionsubtitle_error_message = false;
            } 
        });
        
        $("#dropdwnname1").keyup(function(){
           var qsubtitle= $("#dropdwnname1").val();
           var qsubtitle = qsubtitle.trim();
            if(qsubtitle == '')
            {
                $("#questionsubtitle_error_message_drp").show();
                $("#questionsubtitle_error_message_drp").html("Please enter Dropdown Options");
                questionsubtitle_error_message = true;
            }
            else
            {
                $("#questionsubtitle_error_message_drp").hide();
                questionsubtitle_error_message = false;
            } 
        });
        
        $("#rankname1").keyup(function(){
           var qsubtitle= $("#rankname1").val();
           var qsubtitle = qsubtitle.trim();
            if(qsubtitle == '')
            {
                $("#questionsubtitle_error_message_rank").show();
                $("#questionsubtitle_error_message_rank").html("Please enter Rank Order Options");
                questionsubtitle_error_message = true;
            }
            else
            {
                $("#questionsubtitle_error_message_rank").hide();
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
	    $("#ques_img").show();
	    
	    // Click + icon to show question type
	    $("#addnewquestion").click(function(){
          $("#allquestiontype").show();
          $("#ques_img").hide();
          $("#questionform").hide();
          $("#quest_type").hide();
          $("#qtype_icon_quest").hide();
          $("#questiontitle").val("");
          $("#frmaction").val("Insert");
          $(window).scrollTop(0);
        });
        
        $("#addnewquestionbutton").click(function(){
          $("#allquestiontype").show();
          $("#ques_img").hide();
          $("#questionform").hide();
          $("#frmaction").val("Insert");
          $(window).scrollTop(0);
        });
        
        // Edit question and show question type
        $("#editcurrentquestion").click(function(){
            //Insert question code
            questiontitle_error_message = false;
            matrix_error_message = false;
            check_questiontitle();
            var editnumItems = "";
            var addnumItems = ""
            questionsubtitle_error_message = false;
             var currentqtypesubval = $("#singleqtype").val();
             if(currentqtypesubval=="Matrix")
             {
                 check_matrixtype();
             }
             var currentqtypecheck = currentqtypesubval.toLowerCase();
             if(currentqtypecheck == "radio")
             {
                  var editnumItems = $('#fetcheditoptions').children('div').length;
                  var addnumItems = $("#showcheckboxquestionoptions").children('div').length;
                   if(editnumItems != 0 || addnumItems != 0)
                      {
                        $('#questionsubtitle_error_message').html(" ");
                        questionsubtitle_error_message = false;
                        
                      }
                      else
                      {
                        $('#questionsubtitle_error_message').html("Please Enter Radio Options");
                        questionsubtitle_error_message = true;
                      }
             }
             if(currentqtypecheck == "checkbox")
             {
                  var editnumItems = $('#fetcheditoptions').children('div').length;
                  var addnumItems = $("#showcheckboxquestionoptions").children('div').length;
                   if(editnumItems != 0 || addnumItems != 0)
                      {
                         $('#questionsubtitle_error_message_chk').html(" ");
                         questionsubtitle_error_message = false;
                         
                      }
                      else
                      {
                        $('#questionsubtitle_error_message_chk').html("Please Enter Checkbox Options");
                        questionsubtitle_error_message = true;
                      }
             }
             if(currentqtypecheck == "order")
             {
                 var editnumItems = $('#fetcheditoptions').children('div').length;
                 var addnumItems = $("#showrankorderquestionoptions").children('div').length;
                 if(editnumItems != 0 || addnumItems != 0)
                      {
                         $('#questionsubtitle_error_message_rank').html(" ");
                         questionsubtitle_error_message = false;
                      }
                      else
                      {
                          $('#questionsubtitle_error_message_rank').html("Please Enter Rank Options");
                          questionsubtitle_error_message = true;
                         
                      }
             }
             if(currentqtypecheck == "dropdown")
             {
                 var editnumItems = $('#fetcheditoptions').children('div').length;
                 var addnumItems = $('#dropdwnrep option').length;
              
                   if(editnumItems != 0 || addnumItems != 0)
                      {
                          $('#questionsubtitle_error_message_drp').html(" ");
                         questionsubtitle_error_message = false;
                      }
                      else
                      {
                           $('#questionsubtitle_error_message_drp').html("Please Enter Dropdown Options");
                          questionsubtitle_error_message = true;
                        
                      }
             }
            /*alert(editnumItems);
            alert(addnumItems);
            alert(questionsubtitle_error_message);*/
            if(questiontitle_error_message === false && questionsubtitle_error_message === false && matrix_error_message === false)
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
                var checkboxoptions = $("input[name='chkname[]']").map(function(){return $(this).val().trim();}).get();
                var radoptions = $("input[name='radname[]']").map(function(){return $(this).val().trim();}).get();
                var dropdownval = $("input[name='dropdwnname[]']").map(function(){return $(this).val().trim();}).get();
                var rankoptions = $("input[name='rankname[]']").map(function(){return $(this).val().trim();}).get();
                var mattype=$("#mattype").val();
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
                                    $("#ques_img").hide();
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
        
        $('#matrixtable').DataTable( {
                 "scrollX": true
        } );
	});
	
	var matrowarray=[];
	var matcolarray=[];
	function fetchquesttype(qtype12,qtypeid)
	{   var i=1;
	    var survid = "<?php echo $surveyid;?>";
	    $("#frmaction").val("Insert");
	    $("#allquestiontype").hide();
	    $("#ques_img").hide();
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
    	    var img_path = "images/qtype_icon/"+qtype12+".png";
            $('#qtype_icon_quest').prop('src',img_path);
    	   $("#qtype_icon_quest").show();
	       $("#quest_type").html(qtype12);
	       $("#quest_type").show();
	       var qtitle= $("#questiontitle").val();
	       //alert (qtitle);
	      
        	   $.ajax({
                      url : "insert-questions.php",
                      type : "POST",
                      data : {qtypeid:qtypeid,survid:survid,singleqtype:singleqtype},
                      success: function(dataquestionid){
                          //alert(dataquestionid);
                            var que_seq=dataquestionid.split('*');
                            var data_quest_id = que_seq[0];
                           $("#insertedqid").text(data_quest_id);
                           $("#currquestionid").val(data_quest_id);
                           $("#radiosubquest").val("");
                           $("#que_seq").html("Q."+que_seq[1]+":");
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
                            {  
                                $.ajax({
                                        url : "<?php echo SITEPATH;?>fetch-edit-data.php",
                                        type : "POST",
                                        dataType: "json",
                                        data : {editqid:data_quest_id,qtype:qtype12},
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
                                                 $("#ques_img").hide();
                                        }
                                    });
                            }
                            if(qtype12=="Matrix")
                            {   var resultstring="";
                                $.ajax({
                                        url : "<?php echo SITEPATH;?>fetch-matrix-data.php",
                                        type : "POST",
                                        dataType: "json",
                                        data : {editqid:data_quest_id,qtype:qtype12},
                                        beforeSend: function(){
                                            // Show image container
                                            $('#matrix_loader').show();
                                        },
                                        success: function(data32){//{"qtitle":"what is your favourate game.?","qtooltip":"","qrequired":"No"}
                                        //alert("hkeel");
                                           // alert(data32.qsubtitle);
                                                matrowarray=[];
                            	                matcolarray=[];
                                                $("#matrixtable").html("");
                                                $('#matrix_loader').hide();
                                                var allmatrixvalue = data32.qsubtitle;
                                                var allmatsplit1 = allmatrixvalue.split("*");
                                                var resultstring='<table style="border: 0px solid #DCDCDC;width:98%;" class="matrixtable1">';
                                                if(allmatsplit1.length > 0)
                                                {
                                                    for(var iii = 0; iii < allmatsplit1.length; iii++) 
                                                    { 
                                                        var matval = allmatsplit1[iii].split(":");
                                                        var matrix_type=matval[3];
                                                        var matrix_title=matval[0];
                                                        var subid=matval[1];
                                                        var conmattitlesubid = matrix_title+"*"+subid;
                                                        
                                                        if(matrix_type=="column")
                                                        {
                                                          matcolarray.push(conmattitlesubid);
                                                        }
                                                        if(matrix_type=="row")
                                                        {
                                                          matrowarray.push(conmattitlesubid);
                                                        }
                                                        
                                                         
                                                    }
                                                }
                                                 resultstring+= '<tr style="border: 1px solid #DCDCDC;">';
                                                 resultstring+= '<td style="border: 1px solid #DCDCDC;background-color:#F5F5F5;"></td>';
                                                 for(var y=0;y<matcolarray.length;y++)
                                                 {
                                                     var matcol = matcolarray[y].split("*");
                                                     resultstring+= '<td style="border: 1px solid #DCDCDC;text-align:center;"><input class="form-control formsize" placeholder="' + matcol[0] + '" type="text" value="" name="" id="rowcol'+matcol[1]+'" style="text-align:center;background-color:#F5F5F5;" onkeyup="changematname('+matcol[1]+')"></td>';
                                                    
                                                 }
                                                 resultstring+= '</tr>';
                                                for(var x=0;x<matrowarray.length;x++)
                                                {  
                                                    var matrow = matrowarray[x].split("*");
                                                    resultstring+= '<tr style="border: 1px solid #DCDCDC;">';
                                                    resultstring+= '<td style="border: 1px solid #DCDCDC;text-align:center;"><input class="form-control formsize" type="text" placeholder="' + matrow[0] + '" value="" name="" id="rowcol'+matcol[1]+'" style="text-align:center;" onkeyup="changematname('+matcol[1]+')"></td>';
                                                    for(var y=0;y<matcolarray.length;y++)
                                                    {
                                                        resultstring+= '<td style="border: 1px solid #DCDCDC;text-align:center;"><div id="setmatrixtype'+x+y+'"></div></td>';
                                                    }
                                                    resultstring+= '</tr>';
                                                }
                                                
                                                resultstring+='</table>';
                                                $('#matrixtable').html(resultstring);
                                                $("#ques_img").hide();
                                        }
                                    });
                            }
                           
                            $.ajax({
                                  url : "<?php echo SITEPATH;?>logic.php",
                                  type : "POST",
                                  data : {surveyid:survid,editqid:data_quest_id,qtype:qtype12},
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
            $("#ques_img").hide();
            $("#showmatrixtable").hide();
            $("#showopinionscalequestionoptions").hide();
            $("#showquestionoptions").html('<div class="row justify-content-center"><div class="col-2 yesno_box__icon-wrap"><i class="fa fa-thumbs-up" style="font-size:100px;"></i></div><div class="col-2 yesno_box__icon-wrap" style="margin-left:10px;"><i class="fa fa-thumbs-down" style="font-size:100px;"></i></div></div><div class="row justify-content-center"><div class="col-2 bollab"><label>YES</label></div><div class="col-2 bollab" style="margin-left:10px;"><label>NO</label></div></div>');
            $("#questiontitle").val("");
            $("#questiontooltip-"+qt).val("");
            $('#isrequired-'+qt).prop('checked', false);
            
          }
          if(qtype12=="Text")
          {
            $("#ques_img").hide();
            $("#showmatrixtable").hide();
            $("#showopinionscalequestionoptions").hide();
            $("#showquestionoptions").html('<div class="col-md-12"><div class="row"><div class="col-md-12"><div class="main-holder"><div class="textinput-box active"><input disabled="" placeholder="Text Input" class="disabltext"></div></div></div></div></div>');
            $("#questiontitle").val("");
            $("#questiontooltip-"+qt).val("");
            $('#isrequired-'+qt).prop('checked', false);
            $('#texttype').val("");
           
          }
          if(qtype12=="Rating")
          {
             $("#ques_img").hide();
             $("#showmatrixtable").hide();
            $("#showopinionscalequestionoptions").hide();
            $("#showquestionoptions").html('<div class="row justify-content-center"><div class="col-md-12 text-center star-size"><i class="fa fa-star-o"></i><i class="fa fa-star-o starpad"></i><i class="fa fa-star-o starpad"></i><i class="fa fa-star-o starpad"></i><i class="fa fa-star-o starpad"></i></div></div>');
            $("#questiontitle").val("");
            $("#questiontooltip-"+qt).val("");
            $('#isrequired-'+qt).prop('checked', false);
            
          }
          if(qtype12=="Checkbox" || qtype12=="Radio")
          {
               $("#ques_img").hide();
               $("#showmatrixtable").hide();
               $("#showquestionoptions").hide();
               $("#showdropdwnquestionoptions").hide();
               $("#showopinionscalequestionoptions").hide();
                $("#showrankorderquestionoptions").hide();
               $("#questiontitle").val("");
               $("#questiontooltip-"+qt).val("");
               $('#isrequired-'+qt).prop('checked', false);
               $("#other-"+qt).prop('checked', false);
               $("#other-"+qt).prop('disabled', false);
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
              $("#ques_img").hide();
              $("#showmatrixtable").hide();
              $("#showquestionoptions").hide();
              $("#showcheckboxquestionoptions").hide();
              $("#showopinionscalequestionoptions").hide();
              $("#showdropdwnquestionoptions").show();
              $("#showrankorderquestionoptions").hide();
              $("#questiontitle").val("");
              $("#questiontooltip-"+qt).val("");
              $('#isrequired-'+qt).prop('checked', false);
              $("#other-"+qt).prop('disabled', false);
              $("#other-"+qt).prop('checked', false);
              $('.dynamic-addeddropdwn').remove();
              $('#add_dropdwn_name')[0].reset();
              $('#dropdwnrep').empty();
          }
          if(qtype12=="Opinion Scale")
          {
              $("#ques_img").hide();
              $("#showmatrixtable").hide();
              $("#showquestionoptions").hide();
              $("#showcheckboxquestionoptions").hide();
              $("#showdropdwnquestionoptions").hide();
              $("#showopinionscalequestionoptions").show();
              $("#showrankorderquestionoptions").hide();
              $("#questiontitle").val("");
              $("#questiontooltip-"+qt).val("");
              $('#isrequired-'+qt).prop('checked', false);
          }
          
           if(qtype12=="Order")
           {
               $("#ques_img").hide();
               $("#showmatrixtable").hide();
               $("#showopinionscalequestionoptions").hide();
               $("#showquestionoptions").hide();
               $("#showdropdwnquestionoptions").hide();
               $("#questiontitle").val("");
               $("#questiontooltip-"+qt).val("");
               $('#isrequired-'+qt).prop('checked', false);
               $("#other-"+qt).prop('checked', false);
               $("#other-"+qt).prop('disabled', false);
               $("#showcheckboxquestionoptions").text("");
              if(qtype12=="Order")
               {
                   $('.dynamic-addedrank').remove();
                   $('#add_rank_name')[0].reset();
               }
             
          }
          
          if(qtype12=="Matrix")
          {
              $("#ques_img").hide();
              $("#showquestionoptions").hide();
              $("#showcheckboxquestionoptions").hide();
              $("#showdropdwnquestionoptions").hide();
              $("#showopinionscalequestionoptions").hide();
              $("#showrankorderquestionoptions").hide();
              $("#showmatrixtable").show();
              $("#questiontitle").val("");
              $("#questiontooltip-"+qt).val("");
              $('#isrequired-'+qt).prop('checked', false);
              
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
	    var radiooptions = $("#radname"+optrad).val().trim();

	    questionsubtitle_error_message = false;
	    if(radiooptions == "")
	     {
	         $('#questionsubtitle_error_message').html("Please Enter Radio Options");
             questionsubtitle_error_message = true;
          }
          else
          {
             $('#questionsubtitle_error_message').html(" ");
             questionsubtitle_error_message = false;
          }
	    //alert(optrad);
	    //alert(i);
	    //var optraddd="";
	    var myDiv1 = $('#txxrad'+optrad);
        var subid ="";
        
        if(myDiv1.length)
        {   //alert(optrad);
            var setquestion = $("#radiosubquest").val();
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
    
    
    
    function changematname(subid)
    {  
    //alert(subid);
    var submattitle=$("#rowcol"+subid).val();
    //alert(submattitle);
        $.ajax({
              url : "<?php echo SITEPATH;?>setmatrixrowcolval.php",
              type : "POST",
              data : {subid:subid,submattitle:submattitle},
              beforeSend: function(){
                        // Show image container
                        $('#span_loader1').show();
              },
              success: function(logicquestion){
                     $('#span_loader1').hide();
                     
              }
           });
    }
    
    function insertrowcol(inserttype)
    {
        var curquestid = $("#currquestionid").val();
        var qtype12=$("#singleqtype").val();
        matrowarray=[];
	    matcolarray=[];
        $("#matrixtable").html("");
        $.ajax({
              url : "<?php echo SITEPATH;?>insertmatrixrowcolval.php",
              type : "POST",
              data : {qid:curquestid,inserttype:inserttype},
              beforeSend: function(){
                        // Show image container
                        $('#matrix_loader').show();
              },
              success: function(rowcol){
                  //alert(rowcol);
                     //$('#matrix_loader').hide();
                     var resultstring="";
                     
                     $('#matrix_loader').show();
                     //$("#matrixtable").closest(".matrixtable1").remove();
                     //$('#matrixtable tbody').empty();
                     //$("#matrixtable").closest("tbody").remove();
                     $.ajax({
                                        url : "<?php echo SITEPATH;?>fetch-edit-data.php",
                                        type : "POST",
                                        dataType: "json",
                                        data : {editqid:curquestid,qtype:qtype12},
                                        beforeSend: function(){
                                            // Show image container
                                            $('#matrix_loader').show();
                                        },
                                        success: function(data32){//{"qtitle":"what is your favourate game.?","qtooltip":"","qrequired":"No"}
                                        //alert("hkeel");
                                           // alert(data32.qsubtitle);
                                                $('#matrix_loader').hide();
                                                var allmatrixvalue = data32.qsubtitle;
                                                var allmatsplit1 = allmatrixvalue.split("*");
                                                var resultstring='<table style="border: 0px solid #DCDCDC;width:98%;" class="matrixtable1">';
                                                if(allmatsplit1.length > 0)
                                                {
                                                    for(var iii = 0; iii < allmatsplit1.length; iii++) 
                                                    { 
                                                        var matval = allmatsplit1[iii].split(":");
                                                        var matrix_type=matval[3];
                                                        var matrix_title=matval[0];
                                                        var subid=matval[1];
                                                        var conmattitlesubid = matrix_title+"*"+subid;
                                                        
                                                        if(matrix_type=="column")
                                                        {
                                                          matcolarray.push(conmattitlesubid);
                                                        }
                                                        if(matrix_type=="row")
                                                        {
                                                          matrowarray.push(conmattitlesubid);
                                                        }
                                                        
                                                         
                                                    }
                                                }
                                                
                                                 resultstring+= '<tr style="border: 1px solid #DCDCDC;">';
                                                 resultstring+= '<td style="border: 1px solid #DCDCDC;background-color:#F5F5F5;"></td>';
                                                 for(var y=0;y<matcolarray.length;y++)
                                                 {
                                                     var matcol = matcolarray[y].split("*");
                                                     resultstring+= '<td style="border: 1px solid #DCDCDC;text-align:center;"><input class="form-control formsize" type="text" value="' + matcol[0] + '" name="" id="rowcol'+matcol[1]+'" style="text-align:center;background-color:#F5F5F5;" onkeyup="changematname('+matcol[1]+')"></td>';
                                                    
                                                 }
                                                 resultstring+= '</tr>';
                                                for(var x=0;x<matrowarray.length;x++)
                                                {  
                                                    var matrow = matrowarray[x].split("*");
                                                    resultstring+= '<tr style="border: 1px solid #DCDCDC;">';
                                                    resultstring+= '<td style="border: 1px solid #DCDCDC;text-align:center;"><input class="form-control formsize" type="text" value="' + matrow[0] + '" name="" id="rowcol'+matcol[1]+'" style="text-align:center;" onkeyup="changematname('+matcol[1]+')"></td>';
                                                    for(var y=0;y<matcolarray.length;y++)
                                                    {
                                                        resultstring+= '<td style="border: 1px solid #DCDCDC;text-align:center;"><div id="setmatrixtype'+x+y+'"></div></td>';
                                                    }
                                                    resultstring+= '</tr>';
                                                }
                                                
                                                resultstring+='</table>';
                                                $('#matrixtable').html(resultstring);
                                                $("#ques_img").hide();
                                        }
                     });
              }
           });
          
    }
    
    function removerowcol(inserttype)
    {  //alert("ddd");
        var curquestid = $("#currquestionid").val();
        var qtype12=$("#singleqtype").val();
        matrowarray=[];
	    matcolarray=[];
        $("#matrixtable").html("");
        $.ajax({
              url : "<?php echo SITEPATH;?>removematrixrowcolval.php",
              type : "POST",
              data : {qid:curquestid,inserttype:inserttype},
              beforeSend: function(){
                        // Show image container
                        $('#matrix_loader').show();
              },
              success: function(rowcol){
                  //alert(rowcol);
                     //$('#matrix_loader').hide();
                     var resultstring="";
                     $('#matrix_loader').show();
                     //$("#matrixtable").closest(".matrixtable1").remove();
                     //$('#matrixtable tbody').empty();
                     //$("#matrixtable").closest("tbody").remove();
                     $.ajax({
                                        url : "<?php echo SITEPATH;?>fetch-edit-data.php",
                                        type : "POST",
                                        dataType: "json",
                                        data : {editqid:curquestid,qtype:qtype12},
                                        beforeSend: function(){
                                            // Show image container
                                            $('#matrix_loader').show();
                                        },
                                        success: function(data32){//{"qtitle":"what is your favourate game.?","qtooltip":"","qrequired":"No"}
                                        //alert("hkeel");
                                           // alert(data32.qsubtitle);
                                                $('#matrix_loader').hide();
                                                var allmatrixvalue = data32.qsubtitle;
                                                var allmatsplit1 = allmatrixvalue.split("*");
                                                var resultstring='<table style="border: 0px solid #DCDCDC;width:98%;" class="matrixtable1">';
                                                if(allmatsplit1.length > 0)
                                                {
                                                    for(var iii = 0; iii < allmatsplit1.length; iii++) 
                                                    { 
                                                        var matval = allmatsplit1[iii].split(":");
                                                        var matrix_type=matval[3];
                                                        var matrix_title=matval[0];
                                                        var subid=matval[1];
                                                        var conmattitlesubid = matrix_title+"*"+subid;
                                                        
                                                        if(matrix_type=="column")
                                                        {
                                                          matcolarray.push(conmattitlesubid);
                                                        }
                                                        if(matrix_type=="row")
                                                        {
                                                          matrowarray.push(conmattitlesubid);
                                                        }
                                                        
                                                         
                                                    }
                                                }
                                                 resultstring+= '<tr style="border: 1px solid #DCDCDC;">';
                                                 resultstring+= '<td style="border: 1px solid #DCDCDC;background-color:#F5F5F5;"></td>';
                                                 for(var y=0;y<matcolarray.length;y++)
                                                 {
                                                     var matcol = matcolarray[y].split("*");
                                                     resultstring+= '<td style="border: 1px solid #DCDCDC;text-align:center;"><input class="form-control formsize" type="text" value="' + matcol[0] + '" name="" id="rowcol'+matcol[1]+'" style="text-align:center;background-color:#F5F5F5;" onkeyup="changematname('+matcol[1]+')"></td>';
                                                    
                                                 }
                                                 resultstring+= '</tr>';
                                                for(var x=0;x<matrowarray.length;x++)
                                                {  
                                                    var matrow = matrowarray[x].split("*");
                                                    resultstring+= '<tr style="border: 1px solid #DCDCDC;">';
                                                    resultstring+= '<td style="border: 1px solid #DCDCDC;text-align:center;"><input class="form-control formsize" type="text" value="' + matrow[0] + '" name="" id="rowcol'+matcol[1]+'" style="text-align:center;" onkeyup="changematname('+matcol[1]+')"></td>';
                                                    for(var y=0;y<matcolarray.length;y++)
                                                    {
                                                        resultstring+= '<td style="border: 1px solid #DCDCDC;text-align:center;"><div id="setmatrixtype'+x+y+'"></div></td>';
                                                    }
                                                    resultstring+= '</tr>';
                                                }
                                                
                                                resultstring+='</table>';
                                                $('#matrixtable').html(resultstring);
                                                $("#ques_img").hide();
                                        }
                     });
              }
           });
           
    }
    
    function setmattype()
    { 
        var mattype=$("#mattype").val();
        
        if(mattype=="")
        {
            
            for(var x=0;x<matrowarray.length;x++)
            {
                
                for(var y=0;y<matcolarray.length;y++)
                {
                    
                    $("#setmatrixtype"+x+y).html("");
                }
                
            }
            $("#matrixtype").val("");
        }
        if(mattype=="checkbox")
        {
            for(var x=0;x<matrowarray.length;x++)
            {
                
                for(var y=0;y<matcolarray.length;y++)
                {
                    
                    $("#setmatrixtype"+x+y).html("<input type='checkbox' disabled>");
                }
                
            }
            $("#matrixtype").val("checkbox");
            
        }
        if(mattype=="radio")
        {
            for(var x=0;x<matrowarray.length;x++)
            {
                
                for(var y=0;y<matcolarray.length;y++)
                {
                    
                    $("#setmatrixtype"+x+y).html("<input type='radio' disabled>");
                }
                
            }
            $("#matrixtype").val("radio");
        }
        var curquestid = $("#currquestionid").val();
        $.ajax({
              url : "<?php echo SITEPATH;?>setmatrixinputtype.php",
              type : "POST",
              data : {qid:curquestid,mattype:mattype},
              beforeSend: function(){
                        // Show image container
                        $('#span_loader1').show();
              },
              success: function(matt){
                  //alert(matt);
                     $('#span_loader1').hide();
                     
              }
           });
    }
</script>

<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function mattoggleinsert() {
  document.getElementById("myDropdowninsert").classList.toggle("showins");
}
function mattoggleremove() {
  document.getElementById("myDropdownremove").classList.toggle("showins");
}
// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('showins')) {
        openDropdown.classList.remove('showins');
      }
    }
  }
  if (!event.target.matches('.dropbtn1')) {
    var dropdowns = document.getElementsByClassName("dropdown-content1");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('showins')) {
        openDropdown.classList.remove('showins');
      }
    }
  }
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