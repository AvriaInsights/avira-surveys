<?php 
require_once("classes/cls-survey.php");
$obj_survey = new Survey();
$surveyid=$_GET['surveyid'];
if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}
$fields_survey= "*";
$condition_survey = "`tbl_survey`.`survey_id` = '".$surveyid."'";
$all_surveys_details = $obj_survey->getSurveyDetail($fields_survey, $condition_survey, '', '', 0);
//print_r($all_surveys_details);
foreach($all_surveys_details as $all_surveys_detail)
{
   $templateid=$all_surveys_detail['template_id'];
   $category_id=$all_surveys_detail['category_id'];
   $survey_title=$all_surveys_detail['survey_title'];
   $campaign_name = $all_surveys_detail['campaign_name'];
   $survey_purpose = $all_surveys_detail['survey_purpose'];
   $footer_tagline = $all_surveys_detail['footer_tagline'];
   $survey_description=$all_surveys_detail['survey_description'];
   $take_away=$all_surveys_detail['take_away'];
   $user_form_details=$all_surveys_detail['submit_form_position'];
    if($templateid=="")
   {
     $fields_category = "*";
     //$condition_category = "`category_id` = '$category_id'";
     $condition_category="";
     $category_details = $obj_survey->getSurveyCategory($fields_category, $condition_category, '', '', 0);
   }
}
?>
<style>
    .form-lable{
        font-size:1.5rem;
        font-weight:600;
        margin-bottom:0.5rem;
        margin-top:0.9rem;
    }
    .select_dropdown{
        border: 1px solid #004d9b;
        font-size:1.4rem;
        height: 3.2rem;
        width: 100%;
        padding: 0.375rem 0.75rem;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
        background-color: #fff;
        background-clip: padding-box;
        border-radius: 0.25rem;
        transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }
</style>
                <?php include('dashboard-header-menu.php')?>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-3">
                                <?php include('dashboard-side-menubar.php')?>
                            </div>
                            <div class="col-md-9">
                                <section class="content-wrapper">
                                    <div class="container">
                                        <div class="row">
                                              <div class="col-md-12">
                                                  <h3 class="sm-menu-question-header1">
                                                     Update Survey Details
                                                  </h3>
                                              </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-10 offset-md-1">
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                			            <form id="update_survey_form" class="create-survey-module" action="" method="post">
                
                                                        <input type="hidden" name="surveyid" value="<?php echo $surveyid?>">
                                                        <div class="form-group">
                                                            <label class="form-lable">Survey Title</label>
                                                            <input type="text" class="form-control" name="surveytitle" id="surveytitle" value="<?php echo $survey_title;?>">
                                                        </div>
                                                        <br>
                                                        <!--<div class="form-group">-->
                                                        <!--    <label class="form-lable">Survey Purpose</label>-->
                                                        <!--    <select name="survey_purpose" id="survey_purpose" class="form-control formsize">-->
                                                        <!--        <option value="<?php echo $survey_purpose;?>"><?php echo $survey_purpose;?></option>-->
                                                        <!--        <?php if($survey_purpose!="RQL"){ ?> <option value="RQL">RQL</option><?php } ?>-->
                                                        <!--        <?php if($survey_purpose!="HQL"){ ?> <option value="HQL">HQL</option> <?php } ?>-->
                                                        <!--        <?php if($survey_purpose!="MQL"){ ?> <option value="MQL">MQL</option> <?php } ?>-->
                                                        <!--        <?php if($survey_purpose!="Intent/Information"){ ?> <option value="Intent/Information">Intent/Information</option> <?php } ?>-->
                                                        <!--    </select>-->
                                                        <!--</div>-->
                                                        <div class="form-group">
                                                            <label class="form-lable">Survey Objective</label>
                                                            <input type="text" class="form-control" name="survey_purpose" placeholder="Survey Objective" id="survey_purpose" value="<?php echo $survey_purpose;?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="form-lable">Campaign Name</label>
                                                            <input type="text" class="form-control" name="campaign_name" placeholder="Campaign name" id="campaign_name" value="<?php echo $campaign_name;?>">
                                                        </div>
                                                        <div class="form-group">
                                                             <label class="form-lable">Survey Category</label>
                                                            <select name="category" id="category" class="select_dropdown">
                                                                <option value="">Select Category</option>
                                                                <?php foreach($category_details as $cat_lists){?>
                                                                <option value="<?php echo $cat_lists['category_id'];?>" <?php if(isset($cat_lists['category_id'])){if($cat_lists['category_id']=="$category_id"){?> selected <?php } }?>><?php echo $cat_lists['title'];?></option>
                                                                <?php }?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                             <label class="form-lable">Survey Description</label>
                                                            <textarea class="form-control" id="description" name="description" style="height:83px;" value="<?php echo $survey_description; ?>"><?php echo $survey_description; ?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                             <label class="form-lable">Survey Take Away</label>
                                                            <textarea class="form-control formsize message-box-ht" id="take_away" name="take_away" style="height:70px;" value="<?php echo $take_away; ?>"><?php echo $take_away; ?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="form-lable">Survey Bottom Tag Line</label>
                                                            <input type="text" class="form-control" name="footer_tagline" id="footer_tagline" value="<?php echo $footer_tagline;?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="form-lable">Position of User Deatil Form</label>
                                                             <fieldset id="group1">
                                                                <input type="radio" value="First" name="user_form_position" id="user_form_position_first" class="formsize message-box-ht" <?php echo ($user_form_details=='First') ? "checked" : "";?>>
                                                                <label for="user_form_position_first" class="rdo_label">Starting of Survey</label>&nbsp;
                                                                <input type="radio" value="Last" name="user_form_position" id="user_form_position_last" class="formsize message-box-ht" <?php echo ($user_form_details=='Last') ? "checked" : "";?>>
                                                                <label for="user_form_position_last" class="rdo_label">Ending of Survey</label>
                                                              </fieldset>
                                                        </div>
                                                        <div class="form-group" style="display:none">
                                                            <label><h5>Want to Publish your Survey</h5></label>
                                                             <fieldset id="group1">
                                                                <input type="radio" value="Published" name="is_publish" id="is_publish_yes" class="formsize message-box-ht">
                                                                <label for="is_publish_yes" class="rdo_label">Yes</label>&nbsp;
                                                                <input type="radio" value="Unpublished" name="is_publish" id="is_publish_no" class="formsize message-box-ht" checked="checked">
                                                                <label for="is_publish_no" class="rdo_label">No</label>
                                                              </fieldset>
                                                        </div>
                                                        <div class="row popbtncent"><div class="col-md-12 text-center"><button type="submit" class="survey-btn mt-5 fs-2 p-1 col-2">Update</button></div></div>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>   
                                        </div>
                                    </div>
                                    
                                         
                               </section>
                            </div>
                        </div>
                    </div>
                    <?php include('footer.php'); ?>
                   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
                   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    
<script>
$(document).ready(function () {
    $("#update_survey_form").validate({
        rules: {
            surveytitle: {
                required: true
               
            },
            category: {
                required: true
            }
            // description: {
            //     required: true,
            // },
        },
        messages: {
            surveytitle: {
                required: "Survey Title is required"
            },
            category: {
                required: "Select Survey Category"
            }
            // description: {
            //     required: "Description is required",
            // },
                
        },
       errorElement: "span",
       submitHandler: function(form) {
                var formData = new FormData(form);
                saveFormDatas(form);
              }
    });
});
function saveFormDatas(form) {
        $.ajax({
            type : 'POST',
            data : $('#update_survey_form').serialize(),
            url  : '<?php echo SITEPATH; ?>update-survey-title-action.php',
            success: function(response){
                 $('#span_loader').hide();
                 //alert(response);
                 swal({
                    text: "Survey Details Update Successfully.",
                    icon: "success",
                    showConfirmButton: true,
                    confirmButtonColor: '#04AA26',
                    position: "center",
                }).then(function() {
                    window.location='<?php echo SITEPATH; ?>dashboard';
                });
            }
        });
}

</script>
                