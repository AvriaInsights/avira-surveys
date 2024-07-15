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
    
    $fields_survey = "*";
    $condition_survey = "`tbl_survey`.`survey_id` ='".$surveyid."'";
    $survey_list=$obj_survey->getSurveyDetail($fields_survey, $condition_survey, '', '', 0);
    foreach($survey_list as $survey_lists)
    {
        $survey_title=$survey_lists['survey_title'];
    }
}
else
{
   $surveyid=""; 
}
/***********Category Detail*************/
$fields_cat = "*";
$condition_cat = "`tbl_category`.`status` = 'Active'";
$cat_list=$obj_survey->getSurveyCategory($fields_cat, $condition_cat, '', '', 0);

?>
<script src="<?php echo SITEPATH;?>ckeditor/ckeditor.js" ></script>
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
        
        <section class="space-padding-top">
            <div class="container-fluid pse-2">
                <div class="row">
                     <div class="col-md-5">
                        <img src="images/analyst.png" alt="" class="img-fluid">
                    </div>
                   
                    <div class="col-md-7">
                        <?php if(isset($_GET['surveyid'])){?><h2 class="card-title cardt"><?php echo $survey_title;?></h2><?php }?>
                            <div class="row leftsubbox">
                                <div class="col-md-12"></div>
                            </div>
                        <div class="bg-white p-4">
                            <div id="allquestiontype">
                                <h2 class="card-title cardt">Add Survey Content</h2>
                                <div class="row">
                                    <div class="col-md-12 paddqtype">
                                    <?php if(isset($_SESSION['msg'])){?> 
                                        <div class="col-md-12">
                                        <div class="main-holder">
                                            <div class="form-group">
                                                <label class="form-label" style="font-size:16px;"><?php echo $_SESSION['msg'];?></label>
                                            </div>
                                        </div>
                                    </div> 
                                    <?php }?>
                                    <form class="row" action="copy-paste-action.php" method="post">
                                        <div class="questionbox">
                                            <div class="row">
                                               <div class="col-md-12">
                                                 <div class="main-holder">
                                                    <div class="form-group">
                                                        <label class="form-label" style="font-size:16px;">Add Question Detail</label>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                               <div class="col-md-12">
                                                 <div class="main-holder">
                                                    <div class="form-group">
                                                        <textarea class="form-control" name="surveycontent" id="surveycontent" placeholder="">
                                                        </textarea>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                   <div class="main-holder">
                                                       <div class="form-group">
                                                         <input type="submit" class="btn btn-submit formsize" name="add" value="Submit"
                                                         style="width: 18%; padding: 8px;">
                                                       </div>
                                                   </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="surveyid" value="<?php echo $surveyid;?>">
                                        </div>
                                    </form>
                                </div>
                                 </div>
                            </div> 
                        </div>
                    </div>
                </div>
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
                    <input type="hidden" name="filledby" value="CopyPaste">
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
	    
	    if(survid=="")
	    {
		  $("#myModal").modal('show');
		  
	    }
	    
        
    });
	    
	  

</script>

<script>
    $(document).ready(function(){
       $('.wrapper').addClass("toggled"); 
    });
    
    CKEDITOR.replace('surveycontent', {
        filebrowserUploadUrl: '<?php echo SITEPATH;?>ckeditor/ck_upload.php',
        filebrowserUploadMethod: 'form'
    });
</script>
<script src="https://www.software-intent.com/js/jquery.validate.js"></script>
<script src="https://www.software-intent.com/js/requestpopup.js"></script>
