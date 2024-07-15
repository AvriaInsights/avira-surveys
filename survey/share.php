<?php 
require_once("classes/cls-survey.php");

$obj_survey = new Survey();
if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}
$userid=$_SESSION['ifg_admin']['client_id'];
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
        $fields_survey = "*";
        $condition_survey = "`tbl_survey`.`survey_id` ='".$surveyid."'";
        $orderby="`tbl_survey`.`survey_id` desc";
        $all_active_surveys=$obj_survey->getSurveyDetail($fields_survey, $condition_survey, $orderby, '','', 0);
        
        
?>
<link rel="icon" href="<?php echo SITEPATHFRONT; ?>images/Avira-Survey-Logo_Favicon.png">
<script src="<?php echo SITEPATH;?>ckeditor/ckeditor.js" ></script>
<link rel="stylesheet" href="<?php echo SITEPATH;?>css/modal-style.css">
<style>
body{
    background-color: #fff!important;
}
.content-wrapper-share {
    background:#fff;
    top: 7rem;
    left: 22.7rem;
    right: 0;
    padding: 12rem 0;
}
.clipboard {
  position: relative;
}
/* You just need to get this field */
.copy-input {
  max-width: 500px;
  width: 100%;
  cursor: pointer;
  /*background-color: #eaeaeb;*/
  border:none;
  color:#6c6c6c;
  font-size: 14px;
  border-radius: 1px;
  padding: 10px 10px 10px 10px;
  border:1px solid #010B44;
  font-family: 'Montserrat', sans-serif;
  /*box-shadow: 0 3px 15px #b8c6db;*/
  /*-moz-box-shadow: 0 3px 15px #b8c6db;*/
  /*-webkit-box-shadow: 0 3px 15px #b8c6db;*/
}
.copy-input:focus {
  outline:none;
}

.copy-btn {
  /*width:40px;*/
  background-color: #010B44;
  font-size: 14px;
  padding: 6px 9px;
  border-radius: 0px;
  border:none;
  color:#fff;
  margin-left:-3px;
  height:43px;
  /*transition: all .4s;*/
}
.copy-btn:hover {
  /*transform: scale(1.3);*/
  color:#fff;
  cursor:pointer;
}

.copy-btn:focus {
  outline:none;
}

.copied {
  font-family: 'Montserrat', sans-serif;
  width: 75px;
  display: none;
  position:fixed;
  top: 199;
  left: 680;
  right: 0;
  margin: auto;
  color:#000;
  padding: 15px 15px;
  background-color: #fff;
  border-radius: 5px;
  box-shadow: 0 3px 15px #b8c6db;
  -moz-box-shadow: 0 3px 15px #b8c6db;
  -webkit-box-shadow: 0 3px 15px #b8c6db;
}
/* You just need to get this field */

.modal-backdrop.show{
            opacity: .7;
    }
    .modal-title{
            font-size: 15px;
             color: #000;
             font-weight:600;
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
    .popupmarbutton{
        font-size:18px;
    }
        label {
        display: inline-block;
        max-width: 100%;
        margin-bottom: 5px;
        font-weight: 700;
        font-size:13px;
        }
        .error {
        color: #FF0000;
        }
        input[type="checkbox"] {
    	 height: 0;
    	 width: 0;
    	 visibility: hidden;
    }
     label {
    	 cursor: pointer;
    	 text-indent: -9999px;
    	 width: 55px;
    	 height: 25px;
    	 background: #f81708;
    	 display: block;
    	 border-radius: 100px;
    	 position: relative;
    	 content: "No";
    	 color:#fff;
    	 margin-top: -11px;
    }
     label:after {
    	 content: "No";
    	 position: absolute;
    	 top: 3px;
    	 left: 5px;
    	 width: 18px;
    	 height: 18px;
    	 background: #fff;
    	 border-radius: 90px;
    	 transition: 0.3s;
    }
     input:checked + label {
    	 background: #34a615;
    	  
    }
     input:checked + label:after {
    	 left: calc(100% - 5px);
    	 transform: translateX(-100%);
    }
     label:active:after {
    	 width: 130px;
    }
    .share_publich_button{
        display:none;
    }
</style>
<script src="https://kit.fontawesome.com/d97b87339f.js" crossorigin="anonymous"></script>
<div class="wrapper">
   <?php //include("sidebarmenu.php")?>
        <?php include("header.php")?>
        <section class="content-wrapper-share">
            <?php 
            $survey_url = strtolower($survey_title);
                  $survey_url = str_replace(array(' ','/'), '-', $survey_url); 
            ?>
            
       <div class="Container-fluid">
        <div class="sm-menu-question">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="sm-menu-question-sub-header">
                        <strong>How would you like to get started ?</strong>
                    </h3>
                </div>
            </div>
            <div class="row sub-question-button">
                        <div class="col-md-12 mb-3">
                            <h4 class="fs-5 text-center mb-4">
                                <strong>Publish Your Survey</strong>
                            </h4>
                             <div class="col-md-12 text-center">
                                 <?php
                                 foreach($all_active_surveys as $all_active_survey){
                                   $survey_status = $all_active_survey['survey_status']; 
                                 ?>
                                <input type="checkbox" name="switch_published" id="switch<?php echo $surveyid;?>" onclick="action_published('<?php echo $surveyid;?>');" <?php echo $survey_status == "Published" ? "checked" : "unchecked" ?> value="<?php echo $all_active_survey['survey_status']; ?>"/>
                                <label for="switch<?php echo $surveyid; ?>">Toggle</label>
                                <?php } ?>
                             </div>
                        </div>
                   
                <div class="col-md-12" style="text-align:center;">
                    <div class="clipboard">
                        <input onclick="copy()" class="copy-input" value="<?php echo SITEPATHFRONT ?>survey-view/<?php echo $surveyid;?>/<?php echo $survey_url; ?>" id="copyClipboard" readonly>
                        <button class="copy-btn" id="copyButton" onclick="copy()">Copy URL <i class="far fa-copy"></i></button>
                        <div id="copied-success" class="copied">
                            <span>Copied!</span>
                        </div>
                    </div>
                
                </div>
               
            </div>
            
            
            <div class="row">
                <div class="col-md-12" style="text-align:center;">
                     <!--<img src="images/19291.jpg" class="img-fluid">-->
                     <section class="pt-5">
                          <div class="Container-fluid pse-2">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h3 class="sm-menu-question-header">
                                            <strong>Share your Survey</strong>
                                        </h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h3 class="sm-menu-question-sub-header">
                                            <strong>How would you like to share survey ?</strong>
                                        </h3>
                                    </div>
                                </div>
                                <div class="row sub-question-button">
                                    <div class="col-md-4">
                                        <a href="javascript:void(0);" type="button" class="sm-menu-question__button-card" id="sharemodal">
                                            <div class="card">
                                                <div class="row sm-menu-question__button-contents"> 
                                                    <div class="col-md-3 sub-question-icon">
                                                        <img src="<?php echo SITEPATH; ?>images/share-for-me.png" class="card-img" alt="...">
                                                    </div>
                                                    <div class="col-md-9 px-4">
                                                        <div class="card-body">
                                                            <h5 class="card-title m-ttl">Create Email format and content</h5>
                                                            <p class="card-text"><small class="text-muted">Tell us your goals we'll share a survey for you.</small></p>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="share-to-my-contacts?surveyid=<?php echo $surveyid;?>" type="button" class="sm-menu-question__button-card">
                                            <div class="card">
                                            <div class="row sm-menu-question__button-contents"> 
                                                <div class="col-md-3 sub-question-icon">
                                                    <img src="<?php echo SITEPATH; ?>images/share-to-my-contacts.png" class="card-img" alt="...">
                                                </div>
                                                <div class="col-md-9 px-4">
                                                    <div class="card-body">
                                                        <h5 class="card-title m-ttl">Share To My Contacts!</h5>
                                                        <p class="card-text"><small class="text-muted">Share survey for your contacts.</small></p>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="<?php echo SITEPATH;?>preview-survey/<?php echo $surveyid;?>/<?php echo $survey_url; ?>" target="_blank" type="button" class="sm-menu-question__button-card">
                                            <div class="card">
                                                <div class="row sm-menu-question__button-contents"> 
                                                    <div class="col-md-3 sub-question-icon">
                                                        <img src="<?php echo SITEPATH; ?>images/view-demo.png" class="card-img" alt="...">
                                                    </div>
                                                    <div class="col-md-9 px-4">
                                                        <div class="card-body">
                                                            <h5 class="card-title m-ttl">Preview Survey</h5>
                                                            <p class="card-text"><small class="text-muted">View your survey on website.</small></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>

                    </section>
                  </div>
                  
                </div>
            </div>
        </div>
      </section>
   </div>
    <div id="myModal-share" class="modal fade">
    <div class="modal-dialog modal-dialog-centered new-survey-popup">
        <div class="modal-content">
            <div class="modal-header modal-c-btn">
                <h5 class="modal-title">SHARE SURVEY FOR ME</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
				
                <form id="myForm" action="<?php echo SITEPATH;?>share-for-me-action.php" method="post">
                    <input type="hidden" name="userid" id="userid" value="<?php echo $userid;?>">
                    <input type="hidden" name="surveyid" id="surveyid" value="<?php echo $surveyid;?>">
                    <input type="hidden" name="shareurl" id="shareurl" value="https://www.software-intent.com/<?php echo $surveyid;?>">
                    <div class="form-group" style="margin-bottom:20px;">
                        <strong>Email Subject<span class="error">*</span></strong>
                        <input type="text" class="form-control formsize" name="emailsubject" id="emailsubject" placeholder="Email Subject">
                    </div>
                    <div class="form-group popupmar">
                        <div class="row">
                           <div class="col-md-12">
                             <div class="main-holder">
                                <div class="form-group">
                                    <strong>Email Content<span class="error">*</span></strong>
                                    <textarea class="form-control" name="editor1" id="editor1" placeholder="Email Content">
                                    </textarea>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row popbtncent" style="text-align:center;">
                        <div class="col-md-12">
                            <button type="submit" class="btn start-survey-btn formsize popupmarbutton">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 
<?php include("footer.php")?>
<script>
    $(document).ready(function() {
        $('.share_publich_button').show();
  //  $(".contentPost").delay(2000).fadeIn(500);
  //alert();
});
</script>
<script type="text/javascript">
    function copy() {
      var copyText = document.getElementById("copyClipboard");
      copyText.select();
      copyText.setSelectionRange(0, 99999);
      document.execCommand("copy");
      
      $('#copied-success').fadeIn(800);
      $('#copied-success').fadeOut(800);
    }
    $(document).ready(function () {
        $("#sharemodal").click(function(){
            $("#myModal-share").modal('show');
        });
        
        CKEDITOR.replace('editor1', {
        filebrowserUploadUrl: '<?php echo SITEPATH;?>ckeditor/ck_upload.php',
        filebrowserUploadMethod: 'form'
        });
    });
</script>
<script src="../js/jquery.validate.js"></script>
<script src="../js/share-for-me.js"></script>
<script>
function action_published(survid)
{
    var survid =(survid);
    var chk_publish =  $('#switch'+survid).val();
        $.ajax({
              url : "<?php echo SITEPATH; ?>update-survey-status-published.php",
              type : "POST",
              data : {surveyid:survid,chk_publish:chk_publish},
              success: function(dataquestion){
                    if(dataquestion !="1")
                    {
                       swal("Oops...Empty Survey!!!","Please Add Questions.", "error");
                    }
                    location.reload();
                    //$("#allquestionlist").html(dataquestion);
                  }
              
        });
    }
</script>