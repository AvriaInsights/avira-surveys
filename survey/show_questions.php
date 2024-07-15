<?php 
require_once("classes/cls-survey.php");
require_once("classes/cls-template.php");
$obj_survey = new Survey();
$obj_template = new Template();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}

/*****Survey Title Detail************/
if(isset($_SESSION['survey_id']))
{
    $surveyid=$_SESSION['survey_id'];
    
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
    /***************template section***/
    $condition = "`survey_id` = '" .$_SESSION['survey_id']. "'";
     $get_survey_details =  $obj_survey->getSurveyDetail('',$condition,'','',0);
     $get_qs_bank = $obj_survey->getQuestionBank('',$condition,'','',0);
     $get_survey_detail =end($get_survey_details);
     $condition = "`template_id` = '" . $get_survey_detail['template_id'] . "'";
     $template_details = $obj_template->getTemplateDetail('', $condition, '', '', 0);
     $template_detail = end($template_details);
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

if(isset($_GET['template_id']) && $_GET['template_id'] != "") {
    $condition = "`template_id` = '" . base64_decode($_GET['template_id']) . "'";
    $template_details = $obj_template->getTemplateDetail('', $condition, '', '', 0);
    $template_detail = end($template_details);} 
?>
<link rel="stylesheet" href="<?php echo SITEPATH;?>css/survey.css">
<link rel="stylesheet" href="<?php echo SITEPATH;?>css/modal-style.css">
<style>
    .modal-backdrop.show{
            opacity: .7;
    }
    .modal-title{
            font-size: 15px;
             color: #f30505;
    }
    .create-survey-modal .form-control{
        display: block;
    width: 100%;
     height: calc(3rem + .75rem + 2px); 
    padding: 0.8rem 1rem;
    font-size: 1.4rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #c5c5c5;
    border-radius: 0.25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }
    .column1{
        border-right: 1px solid #c5c5c5;
    }
    .table-bordered>:not(caption)>* {
border-width: 0px 0px 0px 0px!important;
}
</style>
<div class="wrapper">
   <?php include("sidebarmenu.php")?>
        <?php include("header.php")?>
        <section class="content-wrapper" style="padding:0;">
                <div class="row">
                      <div class="column1 colpad">
                           <?php if(isset($_SESSION['surveyid'])){?><h2 class="card-title cardt"><?php echo $survey_title;?></h2><?php }?>
                            <div class="row leftsubbox">
                                <div class="col-md-12">
                                    <div class="icon-wrapper" style="cursor:pointer;" id="">
                                        <i class="fa fa-picture-o add-icon-plus" aria-hidden="true" style="cursor:pointer;" id=""></i>
                                        <span class="padquesttext1 backgroundtheme">Template Theme</span>
                                    </div><p></p>
                                </div>
                            </div>
                            <div id="allquestionlist"></div>
                            <input type="hidden" name="frmaction" id="frmaction" value="Insert">
                            <div class="row leftsubbox">
                                <div class="col-md-12">
                                    <div class="icon-wrapper" style="cursor:pointer;" id="addnewquestion"><i class="fa fa-plus add-icon-plus" aria-hidden="true" style="cursor:pointer;" id="addnewquestion"></i><span class="padquesttext1">Add Question</span></div><p></p>
                                </div>
                            </div>
                      </div>
                      <div class="column2 colpad">
                              <div class="background-img" id="img-bg">
                                  <img src="<?php echo SITEPATH; ?><?php echo $template_detail['image_url']?>" alt="...">
                              </div>
                           <div id="allquestiontype">
                                <h2 class="cardt">Choose Question Type</h2>
                                
                                <div class="row choose-q-type">
                                <?php $allquestiontype="";foreach($question_type_list as $question_type_lists){?>
                                      <div class="col-md-4 paddqtype1" style="cursor:pointer;" onclick="fetchquesttype('<?php echo $question_type_lists['quest_type'];?>','<?php echo $question_type_lists['quest_type_id'];?>')">
                                        <span class="questyp" id="questyp<?php echo $question_type_lists['quest_type_id'];?>"><?php echo $question_type_lists['quest_type'];?></span>
                                        
                                      </div>
                                <?php $allquestiontype.= $question_type_lists['quest_type'].",";}?>
                                <input type="hidden" name="qtypearray" id="qtypearray" value="<?php echo trim($allquestiontype,",");?>">
                                </div>
                                
                            </div>
                            <!--Question Form Start-->
                            <div id="questionform" style="display:none;">
                                <h2 class="card-title cardt">Edit</h2>
                                    <div class="row">
                                
                                      <div class="col-md-12 paddqtype">
                                        <form class="row">
                                                    <div class="questionbox">
                                                       <div class="col-md-12">
                                                              <div class="main-holder">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control formsize" name="questiontitle" id="questiontitle" placeholder="Start Typing Question" value="">
                                                                    </div>
                                                              </div>
                                                        </div>
                                                        <div id="fetcheditoptions"></div>
                                                        
                                                        <div id="showcheckboxquestionoptions"></div>
                                                        <div id="showquestionoptions"></div>
                                                        <div id="showdropdwnquestionoptions">
                                                            
                                                            <div class="col-md-12" name="txxdropdwn" id="txxdropdwn">
                                                                <div class="row"><div class="col-md-12"><div class="main-holder" style="font-size:17px;">
                                                                    <select class="form-select" id="dropdwnrep">
                                                                        
                                                                    </select>
                                                                    </div>
                                                                </div>
                                                            </div></div>
                                                        </div>
                                                        
                                                        <input type="hidden" name="singleqtype" id="singleqtype" value="">
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
                                                                </div></div>
                                                                
                                                                
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
                                                                               <div class="row" style="text-align:center;">
                                                                               <div class="col-md-2 skipfont">Yes</div><div class="col-md-3">skip to</div>
                                                                               <div class="col-md-7">
                                                                               <select name="yesskip" id="yesskip" class="form-select">
                                                                                  <option value="">Select Question</option>
                                                                                  <?php foreach($question_bank_lists as $question_bank_list){?>
                                                                                   <option value="<?php echo $question_bank_list['question_id'];?>"><?php echo $question_bank_list['question_title'];?></option>
                                                                                   <?php }?>
                                                                                </select>
                                                                                </div>
                                                                               </div> 
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                           <div class="main-holder">
                                                                           <div class="row" style="text-align:center;">
                                                                           <div class="col-md-2 skipfont">No</div><div class="col-md-3">skip to</div>
                                                                           <div class="col-md-7"> 
                                                                           <select name="noskip" id="noskip" class="form-select">
                                                                               <option value="">Select Question</option>
                                                                               <?php foreach($question_bank_lists as $question_bank_list){?>
                                                                               <option value="<?php echo $question_bank_list['question_id'];?>"><?php echo $question_bank_list['question_title'];?></option>
                                                                               <?php }?>
                                                                            </select>
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
                                                                </div></div>
                                                                
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                       <div class="main-holder">
                                                                       <?php for($k=0;$k<5;$k++){?>
                                                                       <i class="fa fa-star-o"></i>
                                                                       <?php }?>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </div>
                                                                <div class="row"><div class="col-md-12"><hr></div></div>
                                                                
                                                                </section>
                                                                
                                                                
                                                                <section id="logic" class="tab-panel">
                                                                  
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
                                                                </div></div>
                                                                
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
                                                                    <div class="col-md-4">
                                                                      <div class="main-holder">
                                                                            <div class="form-group reqflt">
                                                                               <input type="checkbox" class="largerCheckbox" name="isrequired-checkbox" id="isrequired-checkbox">
                                                                               <label class="form-label checklabel">Required</label>
                                                                            </div>
                                                                    </div>
                                                                </div></div>
                                                                
                                                                
                                                                <form name="add_chk_name" id="add_chk_name">
                                                                <div class="table-responsive">  
                                                                    <table class="table table-bordered" id="dynamic_field">  
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
                                                                    <div class="col-md-4">
                                                            
                                                                      <div class="main-holder">
                                                                            <div class="form-group reqflt">
                                                                               <input type="checkbox" class="largerCheckbox" name="isrequired-radio" id="isrequired-radio">
                                                                               <label class="form-label checklabel">Required</label>
                                                                            </div>
                                                                            <div class="form-group reqflt">
                                                                               <input type="checkbox" class="largerCheckbox" name="isrequired-other" id="isrequired-other">
                                                                               <label class="form-label checklabel">Others</label>
                                                                            </div>
                                                                    </div>
                                                                </div></div>
                                                                
                                                                
                                                                <form name="add_rad_name" id="add_rad_name">
                                                                <div class="table-responsive">  
                                                                    <table class="table table-bordered" id="dynamic_field_rad">  
                                                                        <tr>  
                                                                            <td><input type="text" name="radname[]" id="radname1" placeholder="Enter Choice" class="form-control name_list chkboxtxt" onkeyup="showradoption('1')" /></td>  
                                                                            <td><button type="button" name="addrad" id="addrad" class="btn add-icon-plus-options">+</button></td>  
                                                                        </tr>  
                                                                    </table>  
                                                                </div>
                                                                </form>
                                                                
                                                                <div class="row"><div class="col-md-12"><hr></div></div>
                                                                
                                                                </section>
                                                                
                                                                
                                                                <section id="logic" class="tab-panel">
                                                                  
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
                                                                    <table class="table table-bordered" id="dynamic_field_dropdwn">  
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
                                                            <div class="row">
                                                              <div class="col-md-6">
                                                                  <div class="main-holder">
                                                                    <button type="button" class="btn btn-submit formsize" id="editcurrentquestion">Update Question</button>
                                                                    <button type="button" class="btn btn-submit formsize" id="addnewquestionbutton">Add Next Question</button>
                                                                    </div>
                                                                    
                                                              </div>
                                                              <div class="col-md-6">
                                                                  <div class="main-holder qidflt">
                                                                    <label class="form-label checklabel">Question ID : <span id="insertedqid"> </span></label>
                                                                    </div>
                                                              </div>
                                                              <input type="hidden" name="currquestionid" id="currquestionid" value="">
                                                              <input type="hidden" name="textrequired" id="textrequired" value="">
                                                              <input type="hidden" name="textothers" id="textothers" value="Others">
                                                            </div>
                                                      </div>
                                                    </form>
                                                </section>
                                    </div>
                                </div>
                            </div>
                            <!--End Boolean Section-->
                            
                            
                            
                          
                    </div> 
                    
            
            
       </section>
</div>


<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">CREATE A NEW SURVEY</h5>
            </div>
            <div class="modal-body">
				
                <form id="request-form" action="<?php echo SITEPATH; ?>add-survey-title-action.php" method="post">
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
                    <div class="row popbtncent"><div class="col-md-12"><button type="submit" class="btn btn-primary formsize popupmarbutton">Create Survey</button></div></div>
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
</style>
<?php include("footer.php")?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script type="text/javascript">
	 $(document).ready(function () {
	    var survid = "<?php echo $surveyid;?>";
	    $("#frmaction").val("Insert");
	    if(survid=="")
	    {
		  $("#myModal").modal('show');
		  $("#allquestionlist").hide();
	    }
	    
        $.ajax({
              url : "view-questions.php",
              type : "POST",
              data : {surveyid:survid},
              success: function(dataquestion){
                 // alert(dataquestion);
                    $("#allquestionlist").html(dataquestion);
              }
        });
	        $("#img-bg").hide();
    	     $(document).on('click','.backgroundtheme',function(){
                $('.background-img').show();
            });
        
        $("#isrequired-other").change(function(){
            if($(this).is(":checked")) {
            $(this).attr("checked");
            $('#showcheckboxquestionoptions').val("Others");
            if($('#dynamic_field_rad').find('.radio_others_exist').length > 0){
                
            }else{
            var row_count = ($('#dynamic_field_rad tr').length) + 1;
            $('#dynamic_field_rad').append('<tr id="row'+row_count+'" class="dynamic-addedrad radio_others_exist"><td><input type="text" id="radname'+row_count+'" value="Others" name="radname[]" placeholder="Enter Choice" class="form-control name_list chkboxtxt " disabled onkeyup="showradoption('+row_count+')" /></td><td><button type="button" name="remove" id="'+row_count+'" class="btn btn-danger btn_remove_rad">X</button></td></tr>');  
            $("#showcheckboxquestionoptions").append('<div class="col-md-12 radio_others_exist" name="txxrad'+row_count+'" id="txxrad'+row_count+'"><div class="row"><div class="col-md-12"><div class="main-holder" style="font-size:17px;"><input type="radio" id="radiotype'+row_count+'"disabled><span style="padding-left:10px;" id="radiorep'+row_count+'">Others</span></div></div></div></div>');
            $("#showcheckboxquestionoptions").show();
           
            }
         
            
        }
        // $('').val($(this).is(':checked'));        
            });
          
	    $("#allquestiontype").hide();
	    $("#showquestionoptions").hide();
	    $("#showcheckboxquestionoptions").hide();
	    $("#showdropdwnquestionoptions").hide();
	    $("#img-bg").hide();
	    
	    // Click + icon to show question type
	    $("#addnewquestion").click(function(){
          $("#allquestiontype").show();
          $("#questionform").hide();
          $("#img-bg").hide();
          $("#frmaction").val("Insert");
        });
        
        $("#addnewquestionbutton").click(function(){
          $("#allquestiontype").show();
          $("#questionform").hide();
          $("#img-bg").hide();
          $("#frmaction").val("Insert");
        });
        
        // Edit question and show question type
        $("#editcurrentquestion").click(function(){
            //Insert question code
            var frmaction = $("#frmaction").val();
            var currentqtype1 = $("#singleqtype").val();
            var currentqtype = currentqtype1.toLowerCase();
            var questiontitle = $("#questiontitle").val();
            var questiontooltip = $("#questiontooltip-"+currentqtype).val();
            if ($("#isrequired-"+currentqtype).is(":checked") == true) {
                    $('#textrequired').val('Yes');
            } else {
                    $('#textrequired').val('No');
            }
            var isrequired = $('#textrequired').val();
            var updquestid = $("#currquestionid").val();
            var singleqtype = $("#singleqtype").val();
            var texttype = $("#texttype").val();
            var radioother = $("#textothers").val();
            var checkboxoptions = $("input[name='chkname[]']").map(function(){return $(this).val();}).get();
            var radoptions = $("input[name='radname[]']").map(function(){return $(this).val();}).get();
            var dropdownval = $("input[name='dropdwnname[]']").map(function(){return $(this).val();}).get();
            //alert(radoptions);
             if(frmaction=="Insert")
             {
                if(radoptions==""){ radoptions="";}
                if(checkboxoptions==""){ checkboxoptions="";}
                if(dropdownval==""){ dropdownval="";}
                var currurl = "update-question.php";
             }
             else
             {
                if(radoptions==""){ radoptions="";}
                if(checkboxoptions==""){ checkboxoptions="";}
                if(dropdownval==""){ dropdownval="";}
                var currurl = "update-question-data.php"; 
             }
            $.ajax({
                 
                  url : currurl,
                  type : "POST",
                  data : {questiontitle:questiontitle,questiontooltip:questiontooltip,isrequired:isrequired,updquestid:updquestid,singleqtype:singleqtype,texttype:texttype,checkboxoptions:checkboxoptions,radoptions:radoptions,dropdownval:dropdownval},
                  success: function(dataquestion){
                      //alert(dataquestion);
                        $("#questiontitle").val("");
                        $("#questiontooltip").val("");
                        $('#isrequired').prop('checked', false);
                        //$('#isrequired').prop('checked', false);
                        //$("#showdropdwnquestionoptions").html("");
                        $("#showcheckboxquestionoptions").html(""); 
                        $("#showquestionoptions").html("");
                        $("input[name='chkname[]']").val("");
                        $("input[name='radname[]']").val("");
                        $("input[name='dropdwnname[]']").val("");
                        $.ajax({
                          url : "view-questions.php",
                          type : "POST",
                          data : {surveyid:survid},
                          success: function(dataquestion){
                                $("#allquestionlist").html(dataquestion);
                                $("#"+currentqtype).hide();
                                $("#img-bg").hide();
                                $("#questionform").hide();
                                $("#allquestiontype").show();
                               
                          }
                      });
                  }
              });
       });
       
              //Skip question for boolean Yes
              $("#yesskip").change(function(){ 
                  var skipqid=$(this).val();
                  var skiptype="Yes";
                  var updquestid = $("#currquestionid").val();
                  $.ajax({
                          url : "skipsurvey.php",
                          type : "POST",
                          data : {updquestid:updquestid,skipqid:skipqid,skiptype:skiptype},
                          success: function(skipqt){
                            // alert(skipqt);
                          }
                    });
              });
              
              //Skip question for boolean No
              $("#noskip").change(function(){
                 var skipqid=$(this).val();
                 var skiptype="No";
                 var updquestid = $("#currquestionid").val();
                 $.ajax({
                          url : "skipsurvey.php",
                          type : "POST",
                          data : {updquestid:updquestid,skipqid:skipqid,skiptype:skiptype},
                          success: function(skipqt){
                            // alert(skipqt);
                          }
                    });
              });
       
        //Add options for checkbox
       
        $('#add').click(function(){
           var i=1;
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
           var i=1;
           i++;  
           
           $('#dynamic_field_rad').append('<tr id="row'+i+'" class="dynamic-addedrad"><td><input type="text" id="radname'+i+'" name="radname[]" placeholder="Enter Choice" class="form-control name_list chkboxtxt" onkeyup="showradoption('+i+')" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove_rad">X</button></td></tr>');  
        });
        
        $(document).on('click', '.btn_remove_rad', function(){
            
           var button_id = $(this).attr("id"); 
           $('#row'+button_id+'').remove(); 
           $("#txxrad" + button_id).remove();
        }); 
        
        //Add options for Radio
        $('#adddropdwn').click(function(){
           var i=1;
           i++;  
           
           $('#dynamic_field_dropdwn').append('<tr id="row'+i+'" class="dynamic-addeddropdwn"><td><input type="text" id="dropdwnname'+i+'" name="dropdwnname[]" placeholder="Enter Choice" class="form-control name_list chkboxtxt" onkeyup="showdropdwnoption('+i+')" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove_dropdwn">X</button></td></tr>');  
        });
        
        $(document).on('click', '.btn_remove_dropdwn', function(){
            
           var button_id = $(this).attr("id"); 
           $('#row'+button_id+'').remove(); 
           $("#txxdropdwn" + button_id).remove();
        });
	});
	
	
	function fetchquesttype(qtype12,qtypeid)
	{ 
	    var survid = "<?php echo $surveyid;?>";
	    $("#frmaction").val("Insert");
	    $("#allquestiontype").hide();
	    $("#img-bg").hide();
	    $("#questionform").show();
	    var qt = qtype12.toLowerCase();
	    var allquestiontype=$("#qtypearray").val();
	    var valNew=allquestiontype.split(',');

        for(var i=0;i<valNew.length;i++)
        {
           var singleqtype=valNew[i];
           var singleone=singleqtype.toLowerCase();
           $("#"+singleone).hide();
           
        }
         $("#fetcheditoptions").html("");
         $("#fetcheditoptions").hide();
    	   $("#"+qt).show();
    	   $("#singleqtype").val(qtype12);
    	   var singleqtype = $("#singleqtype").val();
    	   $.ajax({
                  url : "insert-questions.php",
                  type : "POST",
                  data : {qtypeid:qtypeid,survid:survid,singleqtype:singleqtype},
                  success: function(dataquestionid){
                       $("#insertedqid").text(dataquestionid);
                       $("#currquestionid").val(dataquestionid);
                        $.ajax({
                              url : "view-questions.php",
                              type : "POST",
                              data : {surveyid:survid},
                              success: function(dataquestion){
                                    $("#allquestionlist").html(dataquestion);
                              }
                           });
                  }
          });
          $("#showquestionoptions").show();
          if(qtype12=="Boolean")
          {
            $("#showquestionoptions").html('<div class="row justify-content-center"><div class="col-2 yesno_box__icon-wrap"><i class="fa fa-thumbs-up" style="font-size:100px;"></i></div><div class="col-2 yesno_box__icon-wrap" style="margin-left:10px;"><i class="fa fa-thumbs-down" style="font-size:100px;"></i></div></div><div class="row justify-content-center"><div class="col-2 bollab"><label>YES</label></div><div class="col-2 bollab" style="margin-left:10px;"><label>NO</label></div></div>');
            $("#questiontitle").val("");
            $("#questiontooltip-"+qt).val("");
            $('#isrequired-'+qt).prop('checked', false);
            
          }
          if(qtype12=="Text")
          {
            $("#showquestionoptions").html('<div class="col-md-12"><div class="row"><div class="col-md-12"><div class="main-holder"><div class="textinput-box active"><input disabled="" placeholder="Text Input" class="disabltext"></div></div></div></div></div>');
            $("#questiontitle").val("");
            $("#questiontooltip-"+qt).val("");
            $('#isrequired-'+qt).prop('checked', false);
            $('#texttype').val("");
           
          }
          if(qtype12=="Rating")
          {
            $("#showquestionoptions").html('<div class="row justify-content-center"><div class="col-md-12 text-center star-size"><i class="fa fa-star-o"></i><i class="fa fa-star-o starpad"></i><i class="fa fa-star-o starpad"></i><i class="fa fa-star-o starpad"></i><i class="fa fa-star-o starpad"></i></div></div>');
            $("#questiontitle").val("");
            $("#questiontooltip-"+qt).val("");
            $('#isrequired-'+qt).prop('checked', false);
            
          }
          if(qtype12=="Checkbox" || qtype12=="Radio")
          {
               $("#showquestionoptions").hide();
               $("#showdropdwnquestionoptions").hide();
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
              $("#showdropdwnquestionoptions").show();
              $("#questiontitle").val("");
              $("#questiontooltip-"+qt).val("");
              $('#isrequired-'+qt).prop('checked', false);
              $('.dynamic-addeddropdwn').remove();
              $('#add_dropdwn_name')[0].reset();
              $('#dropdwnrep').empty();
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
        var radioothers=$("Others").val();
        var myDiv1 = $('#txxrad'+optrad);
        
        
        if(myDiv1.length)
        {
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
</script>

<script>
    $(document).ready(function(){
       $('.wrapper').addClass("toggled"); 
    });
</script>
<script src="https://www.software-intent.com/js/jquery.validate.js"></script>
<script src="https://www.software-intent.com/js/requestpopup.js"></script>
