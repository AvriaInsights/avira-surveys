<?php 
require_once("classes/cls-request.php");
require_once("classes/cls-template.php");
require_once("classes/cls-survey.php");

$obj_request = new Request();
$obj_template= new Template(); 
$obj_survey= new Survey(); 

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}
//**********************Question table*********************************************//
if(!isset($_GET['id'])){
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
/***********Category Detail*************/
$fields_cat = "*";
$condition_cat = "`tbl_category`.`status` = 'Active'";
$cat_list=$obj_survey->getSurveyCategory($fields_cat, $condition_cat, '', '', 0);


?>
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
</style>
<!-- modal form -->
<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">CREATE A NEW SURVEY</h5>
            </div>
            <div class="modal-body create-survey-modal">
				<!-- <?php //echo SITEPATH; ?> -->
                <form id="request-form" action="template_survey_store.php" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" name="survey-title" id="survey-title" placeholder="Survey Title">
                        <input type="hidden" name="template_id" value="<?php echo $_GET['id']?>" />
                    </div>
                    <div class="form-group popupmar">
                        <select name="category" id="survey-category" class="form-select form-control">
                            <option value="">Select Category</option>
                            <?php foreach($cat_list as $cat_lists){?>
                            <option value="<?php echo $cat_lists['category_id'];?>"><?php echo $cat_lists['title'];?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="form-group popupmar">
                        <textarea class="form-control message-box-ht" id="survey-description" name="survey-description" placeholder="Survey Description" style="height:83px;"></textarea>
                    </div>
                    <div class="row popbtncent"><div class="col-md-12"><button type="submit" class="btn btn-primary formsize popupmarbutton">Create Survey</button></div></div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- modal form end -->
<!--<link rel="stylesheet" href="css/survey.css">-->
<div class="wrapper">
    <?php include("sidebarmenu.php")?>
    <?php include("header.php")?>
    <section class="content-wrapper" style="padding:0;">
    
        <!-- <div class="row">
            <div class="column1 colpad">
                <h2>Survey Details</h2>
                <div id="allquestionlist sidenav"></div>
                    <div class="row leftsubsidenav">
                        <div class="col-md-12">
                                <?php foreach($get_qs_bank as $gqb){?>
                                    <div class="icon-wrapper sidequestion">
                                        <span class="padquesttext1"><?php echo $gqb['question_title']; ?> </span>
                                        <i class="fa fa-wrong" aria-hidden="true" style="cursor:pointer; float:right" id="addnewquestion">
                                        <button id='add' class=" remove-side-qs btn btn-danger col-sm-12" data-question-id="<?php echo $gqb['question_id']; ?>" > x </button>
                                        </i>
                                    </div> <p></p>  
                                <?php } ?>  
                                    <p></p>
                                    <div class="icon-wrapper">
                                            <i class="fa fa-plus" aria-hidden="true" style="cursor:pointer;" id="addnewquestion"></i>
                                            <span class="padquesttext1">Add Question</span>
                                    </div>             
                        </div>
                    </div>
            </div>
            <div class="column2 colpad">
                <div class="questionbox">
                    <div class="col-md-12">
                        <div class="main-holder">
                                <div class="form-group">
                                    <input type="text" class="form-control formsize" name="questiontitle" id="questiontitle" placeholder="Start Typing Question">
                                </div>
                        </div>

                        <div id="showcheckboxquestionoptions"></div>
                        <div id="showquestionoptions"></div>
                        <div id="showdropdwnquestionoptions">
                        <div class="col-md-12" name="txxdropdwn" id="txxdropdwn">
                            <div class="row"><div class="col-md-12">
                                <div class="main-holder" style="font-size:17px;">
                                    <select class="form-select" id="dropdwnrep">
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <div class="tabbox">
                        <div class="tabset">
                        Tab 1
                            <input type="radio" name="tabset" id="tab1" aria-controls="options" checked>
                            <label for="tab1">Options</label>
                         Tab 2 
                            <input type="radio" name="tabset" id="tab2" aria-controls="logic">
                            <label for="tab2">Logic</label>
                            
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
                            Rating section
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
                                            <?php// for($k=0;$k<5;$k++){?>
                                            <i class="fa fa-star-o"></i>
                                            <?php //}?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row"><div class="col-md-12"><hr></div></div>    
                                    </section>
                                                        
                                    <section id="logic" class="tab-panel">
                                    
                                    </section>
                                    
                                </div>
                            <!--Text Section
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
                            Checkbox Section
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
                                            </div>
                                        </div>
                                        <form name="add_chk_name" id="add_chk_name">
                                            <div class="table-responsive">  
                                                <table class="table table-bordered" id="dynamic_field">  
                                                    <tr>  
                                                        <td><input type="text" name="chkname[]" id="chkname1" placeholder="Enter Choice" class="form-control name_list chkboxtxt" onkeyup="showcheckoption('1')" /></td>  
                                                        <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>  
                                                    </tr>  
                                                </table>  
                                            </div>
                                        </form>
                                        <div class="row"><div class="col-md-12"><hr></div></div>
                                        
                                    </section>
                                    <section id="logic" class="tab-panel">
                                    
                                    </section>
                                </div>
                            <!--Multiple Radio Button
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
                                                </div>
                                            </div>
                                        </div>
                                        <form name="add_rad_name" id="add_rad_name">
                                            <div class="table-responsive">  
                                                <table class="table table-bordered" id="dynamic_field_rad">  
                                                    <tr>  
                                                        <td><input type="text" name="radname[]" id="radname1" placeholder="Enter Choice" class="form-control name_list chkboxtxt" onkeyup="showradoption('1')" /></td>  
                                                        <td><button type="button" name="addrad" id="addrad" class="btn btn-success">Add More</button></td>  
                                                    </tr>  
                                                </table>  
                                            </div>
                                        </form>
                                        <div class="row"><div class="col-md-12"><hr></div></div>
                                    
                                    </section>
                                    <section id="logic" class="tab-panel"></section>
                                </div>
                            <!--Dropdown Button
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
                                            </div>
                                        </div>
                                        <form name="add_dropdwn_name" id="add_dropdwn_name">
                                            <div class="table-responsive">  
                                                <table class="table table-bordered" id="dynamic_field_dropdwn">  
                                                    <tr>  
                                                        <td><input type="text" name="dropdwnname[]" id="dropdwnname1" placeholder="Enter Choice" class="form-control name_list chkboxtxt" onkeyup="showdropdwnoption('1')" /></td>  
                                                        <td><button type="button" name="adddropdwn" id="adddropdwn" class="btn btn-success">Add More</button></td>  
                                                    </tr>  
                                                </table>  
                                            </div>
                                        </form>
                                        <div class="row"><div class="col-md-12"><hr></div></div>  
                                    </section>
                                    <section id="logic" class="tab-panel"></section>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </section>
</div>
<?php include("footer.php")?>
<style>
    .modal{
    pointer-events: none;
}

.modal-dialog{
    pointer-events: all;
 }
</style>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
 <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> 
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    $("#addnewquestion").click(function(){
          $("#allquestiontype").show();
          $("#questionform").hide();
    });
     
    $("#addnewquestionbutton").click(function(){
        $("#allquestiontype").show();
        $("#questionform").hide();
    });

    $(document).on('click','.remove-side-qs',function(){
     
      var deleteid = $(this).attr('data-question-id');
      var confirmalert = confirm("Do you want to delete the question");
      var button_obj = $(this); 
      if (confirmalert == true) {
      // AJAX Request
      $.ajax({
        url: 'remove-template.php',
        type: 'POST',
        data: {question_id:deleteid },
        success: function(response){
        //alert(response);
          if(response == 1){
	        alert('Question removed sucessfully');
            $(button_obj).closest('.sideQuestion').remove(); //ye vala logic tune sahi lagaya tha par function galat hua
	        }else{
	         alert('Cannot remove Question');
          }

        }
        //$( "div" ).remove( ".sidequestion" );
        
      });
     // $("sidequestion").remove();
      }
  });
});
</script>
<?php
if(isset($_GET['id'])){
    $condition = "`template_id` = '" . base64_decode($_GET['id']) . "'";
    // create a survey with template heading and data
    $template_data = $obj_template->getTemplateDetail('',$condition,'','');
    foreach($template_data as $tmp_data){
        $survey_title = $tmp_data['template_name']; 
        $survey_category = $tmp_data['category_id']; 
        
    }
    
?>
<script>
    $(document).ready(function(){
          $("#survey-title").val('<?php echo $survey_title;?>');
          $("#survey-category").val("<?php echo $survey_category;?>").trigger('change');
          $("#myModal").modal('show');
          $("#allquestionlist").hide();
    });

    // $('#myModal').on('hidden.bs.modal', function () {
    // // do something…
    //     var url_redirect = "preview-template.php?id=".$_GET['id'];
    //     window.location = url_redirect;
    // });
</script>


<?php }?>
