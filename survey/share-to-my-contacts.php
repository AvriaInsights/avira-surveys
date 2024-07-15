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
?>

<?php 
            $survey_url = strtolower($survey_title);
                  $survey_url = str_replace(' ', '-', $survey_url); 
            ?>
<script src="<?php echo SITEPATH;?>ckeditor/ckeditor.js" ></script>

<style>
.content-wrapper-share {
    background:#fff;
    top: 7rem;
    left: 22.7rem;
    right: 0;
    padding: 12rem 0;
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
/*****************/
.form-wizard {
  color: #888888;
  padding: 30px;
}
.form-wizard .wizard-form-radio {
  display: inline-block;
  margin-left: 5px;
  position: relative;
}
.form-wizard .wizard-form-radio input[type="radio"] {
  -webkit-appearance: none;
  -moz-appearance: none;
  -ms-appearance: none;
  -o-appearance: none;
  appearance: none;
  background-color: #dddddd;
  height: 25px;
  width: 25px;
  display: inline-block;
  vertical-align: middle;
  border-radius: 50%;
  position: relative;
  cursor: pointer;
}
.form-wizard .wizard-form-radio input[type="radio"]:focus {
  outline: 0;
}
.form-wizard .wizard-form-radio input[type="radio"]:checked {
  background-color: #fb1647;
}
.form-wizard .wizard-form-radio input[type="radio"]:checked::before {
  content: "";
  position: absolute;
  width: 10px;
  height: 10px;
  display: inline-block;
  background-color: #ffffff;
  border-radius: 50%;
  left: 1px;
  right: 0;
  margin: 0 auto;
  top: 8px;
}
.form-wizard .wizard-form-radio input[type="radio"]:checked::after {
  content: "";
  display: inline-block;
  webkit-animation: click-radio-wave 0.65s;
  -moz-animation: click-radio-wave 0.65s;
  animation: click-radio-wave 0.65s;
  background: #000000;
  content: '';
  display: block;
  position: relative;
  z-index: 100;
  border-radius: 50%;
}
.form-wizard .wizard-form-radio input[type="radio"] ~ label {
  padding-left: 10px;
  cursor: pointer;
}
.form-wizard .form-wizard-header {
  text-align: center;
}
.form-wizard .form-wizard-next-btn, .form-wizard .form-wizard-previous-btn, .form-wizard .form-wizard-submit {
  /*background-color: #d65470;*/
  color: #ffffff;
  display: inline-block;
  min-width: 100px;
  min-width: 120px;
  padding: 10px;
  text-align: center;
  font-size:16px;
  background: #00cfff;
  background: -moz-linear-gradient(45deg, #00cfff 1%, #029bff 100%);
  background: -webkit-linear-gradient(45deg, #00cfff 1%,#029bff 100%);
  background: linear-gradient(45deg, #00cfff 1%,#029bff 100%);
}
.form-wizard .form-wizard-next-btn:hover, .form-wizard .form-wizard-next-btn:focus, .form-wizard .form-wizard-previous-btn:hover, .form-wizard .form-wizard-previous-btn:focus, .form-wizard .form-wizard-submit:hover, .form-wizard .form-wizard-submit:focus {
  color: #ffffff;
  opacity: 0.6;
  text-decoration: none;
}
.form-wizard .wizard-fieldset {
  display: none;
}
.form-wizard .wizard-fieldset.show {
  display: block;
}
.form-wizard .wizard-form-error {
  display: none;
  background-color: #d70b0b;
  position: absolute;
  left: 0;
  right: 0;
  bottom: 0;
  height: 2px;
  width: 100%;
}
.form-wizard .form-wizard-previous-btn {
  background-color: #fb1647;
}
.form-wizard .form-control {
  font-weight: 300;
  height: auto !important;
  padding: 15px;
  color: #888888;
  background-color: #f1f1f1;
  border: none;
}
.form-wizard .form-control:focus {
  box-shadow: none;
}
.form-wizard .form-group {
  position: relative;
  margin: 25px 0 0;
}
.form-wizard .wizard-form-text-label {
  position: absolute;
  left: 10px;
  top: 16px;
  transition: 0.2s linear all;
}
.form-wizard .focus-input .wizard-form-text-label {
  color: #d65470;
  top: -18px;
  transition: 0.2s linear all;
  font-size: 12px;
}
.form-wizard .form-wizard-steps {
  margin: 30px 0;
}
.form-wizard .form-wizard-steps li {
  width: 25%;
  float: left;
  position: relative;
}
.form-wizard .form-wizard-steps li::after {
  background-color: #f3f3f3;
  content: "";
  height: 5px;
  left: 0;
  position: absolute;
  right: 0;
  /*top: 50%;*/
  top: 35%;
  transform: translateY(-50%);
  width: 100%;
  border-bottom: 1px solid #dddddd;
  border-top: 1px solid #dddddd;
}
.form-wizard .form-wizard-steps li span {
  background-color: #dddddd;
  border-radius: 50%;
  display: inline-block;
  height: 40px;
  line-height: 40px;
  position: relative;
  text-align: center;
  width: 40px;
  z-index: 1;
  font-size:14px!important;
}
.form-wizard .form-wizard-steps li:last-child::after {
  width: 50%;
}
.form-wizard .form-wizard-steps li.active span, .form-wizard .form-wizard-steps li.activated span {
    background: #00cfff;
    background: -moz-linear-gradient(45deg, #00cfff 1%, #029bff 100%);
    background: -webkit-linear-gradient(45deg, #00cfff 1%,#029bff 100%);
    background: linear-gradient(45deg, #00cfff 1%,#029bff 100%);
    color: #ffffff;
    font-size:14px;
}
.form-wizard .form-wizard-steps li.active::after, .form-wizard .form-wizard-steps li.activated::after {
    background: #00cfff;
    background: -moz-linear-gradient(45deg, #00cfff 1%, #029bff 100%);
    background: -webkit-linear-gradient(45deg, #00cfff 1%,#029bff 100%);
    background: linear-gradient(45deg, #00cfff 1%,#029bff 100%);
    left: 50%;
    width: 50%;
    border-color: #01adff;
}
.form-wizard .form-wizard-steps li.activated::after {
    width: 100%;
    border-color: #02076d;
    background: #02076d;
}
.form-wizard .form-wizard-steps li:last-child::after {
  left: 0;
}
.form-wizard .wizard-password-eye {
  position: absolute;
  right: 32px;
  top: 50%;
  transform: translateY(-50%);
  cursor: pointer;
}
@keyframes click-radio-wave {
  0% {
    width: 25px;
    height: 25px;
    opacity: 0.35;
    position: relative;
  }
  100% {
    width: 60px;
    height: 60px;
    margin-left: -15px;
    margin-top: -15px;
    opacity: 0.0;
  }
}
@media screen and (max-width: 767px) {
  .wizard-content-left {
    height: auto;
  }
}
.ftsize{
    font-size:14px;
}
.wizard-fieldset{
    margin: 0 12rem;
}
.form-wizard .form-wizard-steps li.activated span{
    background: #02076d;
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
  width: 75px;
    display: none;
    position: fixed;
    top: 300px;
    left: 340px;
    right: 0;
    margin: auto;
    color: #000;
    padding: 15px 15px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 3px 15px #b8c6db;
    -moz-box-shadow: 0 3px 15px #b8c6db;
    -webkit-box-shadow: 0 3px 15px #b8c6db;
    text-align: center;
}

/* You just need to get this field */
</style>
<link rel="icon" href="<?php echo SITEPATHFRONT; ?>images/Avira-Survey-Logo_Favicon.png">
<script src="https://kit.fontawesome.com/d97b87339f.js" crossorigin="anonymous"></script>
<div class="wrapper">
   <?php //include("sidebarmenu.php")?>
        <?php include("header.php")?>
        <section class="content-wrapper-share">
        <div class="Container-fluid">
            <div class="sm-menu-question">
                    <div class="row">
                        <div class="col-sm-12 mt-5">
                            <h3 class="sm-menu-question-header">
                                <strong>Share To My Contacts</strong>
                            </h3>
                        </div>

                        <div class="col-sm-12">
                            <section class="wizard-section">
                            <div class="row no-gutters">
                                <div class="col-md-10 offset-md-1">
                                     <?php if (isset($_SESSION['error'])) { ?>
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <?php
                                            echo $_SESSION['error'];
                                            unset($_SESSION['error']);
                                            ?>
                                        </div>
                                <?php } ?>
                                </div>
                            	<div class="col-lg-12 col-md-12">
                            		<div class="form-wizard">
                            			<form action="share-to-my-contacts-action.php" name="myForm" id="myForm" method="post" role="form" enctype="multipart/form-data">
                            				<input type="hidden" name="userid" id="userid" value="<?php echo $userid;?>">
                                            <input type="hidden" name="surveyid" id="surveyid" value="<?php echo $surveyid;?>">
                                            <input type="hidden" name="shareurl" id="shareurl" value="<?php echo SITEPATHFRONT ?>survey-view/<?php echo $surveyid;?>/<?php echo $survey_url; ?>">
                            				<div class="form-wizard-header">
                            					<ul class="list-unstyled form-wizard-steps clearfix">
                            						<li class="active"><span>1</span><div class="ftsize">SENDER</div></li>
                            						<li><span>2</span><div class="ftsize">CONTENT</div></li>
                            						<li><span>3</span><div class="ftsize">RECIPIENTS</div></li>
                            						<li><span>4</span><div class="ftsize">SCHEDULE</div></li>
                            					</ul>
                            				</div>
                            				<fieldset class="wizard-fieldset show">
                            					<!--<h5>Personal Information</h5>-->
                            					<div class="form-group">
                            						<input type="text" class="form-control wizard-required" id="fname" name="fname">
                            						<label for="fname" class="wizard-form-text-label">Sender's Name*</label>
                            						<div class="wizard-form-error"></div>
                            					</div>
                            					<div class="form-group">
                            						<input type="text" class="form-control wizard-required" id="fromname" name="fromname">
                            						<label for="fromname" class="wizard-form-text-label">Company/Business Unit*</label>
                            						<div class="wizard-form-error"></div>
                            					</div>
                            					
                            					<div class="form-group clearfix">
                            						<a href="javascript:;" class="form-wizard-next-btn float-right">Next</a>
                            					</div>
                            				</fieldset>	
                            				<fieldset class="wizard-fieldset">
                            					<!--<h5>Account Information</h5>-->
                            					<div class="form-group">
                            						<input type="text" class="form-control wizard-required" id="subject" name="subject">
                            						<label for="subject" class="wizard-form-text-label">Email Subject*</label>
                            						<div class="wizard-form-error"></div>
                            					</div>
                            					<div class="form-group">
                            						<textarea class="form-control wizard-required-textarea" name="content" id="content"></textarea>
                            						<label for="content" class="wizard-form-text-label" style="left: 9px;top: -18px;color: #d65470;">Email Content*</label>
                            						<div class="wizard-form-error"></div>
                            					</div>
                            					<div class="clipboard mt-4">
                                					<input onclick="copy()" class="copy-input" value="<?php echo SITEPATHFRONT ?>survey-view/<?php echo $surveyid;?>/<?php echo $survey_url; ?>" id="copyClipboard" readonly>
                                                    <a class="copy-btn" id="copyButton" onclick="copy()">Copy URL <i class="far fa-copy"></i></a>
                                                    <div id="copied-success" class="copied">
                                                        <span>Copied!</span>
                                                    </div>
                            					</div>
                            					
                            					<div class="form-group clearfix">
                            						<a href="javascript:;" class="form-wizard-previous-btn float-left">Previous</a>
                            						<a href="javascript:;" class="form-wizard-next-btn float-right">Next</a>
                            					</div>
                            					
                            				</fieldset>
                            				
                            				<fieldset class="wizard-fieldset">
                            					<!--<h5>Bank Information</h5>-->
                            					<div class="form-group">
                            						<textarea class="form-control wizard-required-contact" id="contact" name="contact" onchange="chekemailvalidation1()"></textarea>
                            						<label for="contact" class="wizard-form-text-label">Copy or Type Email ids with comma separation</label>
                            						<div class="star" id="contact_err_massage" style="display:none">Invalid Email Id</div>
                            						<div class="wizard-form-error"></div>
                            					</div>
                            					<div class="form-group" style="text-align:center;">
                            							<span class="text-or fw-bold text-dark">OR</span>
                            					</div>
                            					<div class="row">
                            					     <div class="col-md-6">
                            					         <div class="form-group">
                                    						<input type="file" class="form-control" id="contactcsv" name="contactcsv">
                                    						<label for="contactcsv" class="wizard-form-text-label"></label>
                                    						<span class="error">Note : Upload Only CSV File</span>
                            						        <div class="wizard-form-error"></div>
                            				        	</div>
                            					     </div>
                            					    <div class="col-md-6">
                                                        <div class="main-holder">
                                                           <div class="form-group">
                                                                <a href="<?php echo SITEPATH;?>excelsheet/sharecontactsamplesheet.csv"
                                                                style="font-size:16px;"><i class="fa fa-download"></i>&nbsp;Download Sample CSV File</a>
                                                           </div>
                                                        </div>
                            					    </div>
                            					</div>
                            					<div class="form-group clearfix">
                            						<a href="javascript:;" class="form-wizard-previous-btn float-left">Previous</a>
                            						<a href="javascript:;" class="form-wizard-next-btn float-right">Next</a>
                            					</div>
                            				</fieldset>	
                            				<fieldset class="wizard-fieldset">
                            					<!--<h5>Payment Information</h5>-->
                            					
                            					
                            					<div class="row">
                            						<div class="col-12"></div>
                            						    <div class="col-lg-12 col-md-12 col-sm-12">
                                							<div class="form-group">
                                								<select class="form-control wizard-required-schedule form-select w-50" id="scheduleday" name="scheduleday">
                                									<option value="">--Schedule--</option>
                                									<option value="Send Now">Send Now</option>
                                									<option value="Schedule Later">Schedule Later</option>
                                									
                                								</select>
                                								<div class="wizard-form-error"></div>
                                							</div>
                            						    </div>
                            					</div>
                            					<div class="row align-items-baseline date-picker-holder wizard-required-schedule" id="datetimepickerlater" style="display:none;">
                        					    	<div class="col-md-1"><p>Date Time</p></div>
                            					    <div class="col-md-4">
                                					  <div class="col-lg-12 col-md-12 col-sm-12">
                            							<div class="form-group">
                            							    <input type="datetime-local" value="" id="latertime" name="latertime" class="form-control" style="width:20rem;">
                            							    <div class="wizard-form-error"></div>
                            							</div>
                                                      </div>          
                                					</div>
                                					<div class="col-md-7"></div>
                            					</div>
                            					
                            					<div class="form-group clearfix">
                            						<a href="javascript:;" class="form-wizard-previous-btn float-left">Previous</a>
                            						<a href="javascript:;" class="form-wizard-submit float-right">Submit</a>
                            					</div>
                            				</fieldset>	
                            			</form>
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
<?php include("footer.php")?>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>-->
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.css">-->

<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>-->

<script type="text/javascript">
    function copy() {
      var copyText = document.getElementById("copyClipboard");
      copyText.select();
      copyText.setSelectionRange(0, 99999);
      document.execCommand("copy");
      
      $('#copied-success').fadeIn(800);
    //   $('#copied-success').fadeOut(800);
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
<script>
// $(function () {
		
// 		$('#datetimepicker2').datepicker({
// 			format: 'DD-MM-YYYY'
// 		});
// 		$('#datetimepicker3').datepicker({
// 			format: 'LT'
// 		});
// 		$('#datetimepicker3').datepicker({
// 			format: 'LT'
// 		});
// 	});
    $(document).ready(function () {
        $("#datetimepickerlater").hide();
        CKEDITOR.replace('content', {
        filebrowserUploadUrl: '<?php echo SITEPATH;?>ckeditor/ck_upload.php',
        filebrowserUploadMethod: 'form'
        });
        
        $("#scheduleday").change(function () { 
            var scheduleday=$("#scheduleday").val();
           //alert(scheduleday);
            if(scheduleday=="Schedule Later")
            {
                $("#datetimepickerlater").show();
            }
            if(scheduleday=="Send Now")
            {
                $("#datetimepickerlater").hide();
            }
        });
    });
    
    jQuery(document).ready(function() {
	// click on next button
	 
	jQuery('.form-wizard-next-btn').click(function() {
		var parentFieldset = jQuery(this).parents('.wizard-fieldset');
		var currentActiveStep = jQuery(this).parents('.form-wizard').find('.form-wizard-steps .active');
		var next = jQuery(this);
		//alert(next);
		var nextWizardStep = true;
		parentFieldset.find('.wizard-required').each(function(){
			var thisValue = jQuery(this).val();
		   //alert(email_id);
			//var emailcont = CKEDITOR.instances['emailbody'].getData();
            //alert(thisValue);
            //alert(emailcont);
			if( thisValue == "") {
				jQuery(this).siblings(".wizard-form-error").slideDown();
				nextWizardStep = false;
			}
			else {
			    
				jQuery(this).siblings(".wizard-form-error").slideUp();
			}
		});
		parentFieldset.find('.wizard-required-textarea').each(function(){
			var emailcont = CKEDITOR.instances.content.getData();
            //alert(emailcont);
			if( emailcont == "") {
				jQuery(this).siblings(".wizard-form-error").slideDown();
				nextWizardStep = false;
			}
			else {
				jQuery(this).siblings(".wizard-form-error").slideUp();
			}
		});
		parentFieldset.find('.wizard-required-contact').each(function(){
			var contact1 = jQuery("#contact").val();
			var contactcsv1 = jQuery("#contactcsv").val();
            //alert(contact1);
            //alert(contactcsv1);
			if( contact1 == "" && contactcsv1 =="") {
				jQuery(this).siblings(".wizard-form-error").slideDown();
				nextWizardStep = false;
			}
		    if(contact1 != ""){
                    var emails = $('#contact').val();
                    emails = emails.split(",");
                
                    var valid = true;
                    var regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                    
                    var invalidEmails = [];
                    
                    for (var i = 0; i < emails.length; i++) {
                        emails[i] = emails[i].trim();
                        if( emails[i] == "" || ! regex.test(emails[i])){
                            invalidEmails.push(emails[i]);
                        }
                    }
                    if(invalidEmails != 0) {
                    	jQuery(this).siblings(".wizard-form-error").slideDown();
				        nextWizardStep = false;
                      $('#contact_err_massage').show();
                    }
                    else
                    {
                         $('#contact_err_massage').hide();
                         jQuery(this).siblings(".wizard-form-error").slideUp();
                    }
			}
			else {
				jQuery(this).siblings(".wizard-form-error").slideUp();
			}
		});
		parentFieldset.find('.wizard-required-schedule').each(function(){
			var scheduleday = jQuery("#scheduleday").val(); 
			var dattime = jQuery("#latertime").val();
            //alert(scheduleday);
            //alert(dattime);
			if(scheduleday == "") {
				jQuery(this).siblings(".wizard-form-error").slideDown();
				nextWizardStep = false;
			}
			else if(scheduleday == "Schedule Later") {
			    if(dattime == "")
			    {
				    jQuery(this).siblings(".wizard-form-error").slideDown();
				    nextWizardStep = false;
			    }
			}
		});
		if( nextWizardStep) {
			next.parents('.wizard-fieldset').removeClass("show","400");
			currentActiveStep.removeClass('active').addClass('activated').next().addClass('active',"400");
			next.parents('.wizard-fieldset').next('.wizard-fieldset').addClass("show","400");
			jQuery(document).find('.wizard-fieldset').each(function(){
				if(jQuery(this).hasClass('show')){
					var formAtrr = jQuery(this).attr('data-tab-content');
					jQuery(document).find('.form-wizard-steps .form-wizard-step-item').each(function(){
						if(jQuery(this).attr('data-attr') == formAtrr){
							jQuery(this).addClass('active');
							var innerWidth = jQuery(this).innerWidth();
							var position = jQuery(this).position();
							jQuery(document).find('.form-wizard-step-move').css({"left": position.left, "width": innerWidth});
						}else{
							jQuery(this).removeClass('active');
						}
					});
				}
			});
		}
	});
	//click on previous button
	jQuery('.form-wizard-previous-btn').click(function() {
		var counter = parseInt(jQuery(".wizard-counter").text());;
		var prev =jQuery(this);
		var currentActiveStep = jQuery(this).parents('.form-wizard').find('.form-wizard-steps .active');
		prev.parents('.wizard-fieldset').removeClass("show","400");
		prev.parents('.wizard-fieldset').prev('.wizard-fieldset').addClass("show","400");
		currentActiveStep.removeClass('active').prev().removeClass('activated').addClass('active',"400");
		jQuery(document).find('.wizard-fieldset').each(function(){
			if(jQuery(this).hasClass('show')){
				var formAtrr = jQuery(this).attr('data-tab-content');
				jQuery(document).find('.form-wizard-steps .form-wizard-step-item').each(function(){
					if(jQuery(this).attr('data-attr') == formAtrr){
						jQuery(this).addClass('active');
						var innerWidth = jQuery(this).innerWidth();
						var position = jQuery(this).position();
						jQuery(document).find('.form-wizard-step-move').css({"left": position.left, "width": innerWidth});
					}else{
						jQuery(this).removeClass('active');
					}
				});
			}
		});
	});
	//click on form submit button
	jQuery(document).on("click",".form-wizard .form-wizard-submit" , function(){
	   
		var parentFieldset = jQuery(this).parents('.wizard-fieldset');
		var currentActiveStep = jQuery(this).parents('.form-wizard').find('.form-wizard-steps .active');
		parentFieldset.find('.wizard-required').each(function() {
			var thisValue = jQuery(this).val();
			//alert(thisValue);
			if( thisValue == "" ) {
				jQuery(this).siblings(".wizard-form-error").slideDown();
			}
			else {
				jQuery(this).siblings(".wizard-form-error").slideUp();
			}
		});

        // 	var fname=jQuery("#fname").val();
        //  var fromname=jQuery("#fromname").val();
        //  var subject=jQuery("#subject").val();
        //  var content=CKEDITOR.instances.content.getData();
        //  var contact=jQuery("#contact").val();
            var scheduleday=jQuery("#scheduleday").val();
            var dattime = jQuery("#latertime").val();
            
            if(scheduleday=="Send Now")
            {
                $("#myForm").submit(); 
            }
            if(scheduleday=="Schedule Later" && dattime!="")
            {
                $("#myForm").submit(); 
            }
            //wizard-required
            
	});
	// focus on input field check empty or not
	jQuery(".form-control").on('focus', function(){
		var tmpThis = jQuery(this).val();
		if(tmpThis == '' ) {
			jQuery(this).parent().addClass("focus-input");
		}
		else if(tmpThis !='' ){
			jQuery(this).parent().addClass("focus-input");
		}
	}).on('blur', function(){
		var tmpThis = jQuery(this).val();
		if(tmpThis == '' ) {
			jQuery(this).parent().removeClass("focus-input");
			jQuery(this).siblings('.wizard-form-error').slideDown("3000");
		}
		else if(tmpThis !='' ){
			jQuery(this).parent().addClass("focus-input");
			jQuery(this).siblings('.wizard-form-error').slideUp("3000");
		}
	});
});

function chekemailvalidation(){
    var nextWizardStep = true;
    
    var emails = $('#contact').val();
    emails = emails.split(",");

    var valid = true;
    var regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    
    var invalidEmails = [];
    
    for (var i = 0; i < emails.length; i++) {
        emails[i] = emails[i].trim();
        if( emails[i] == "" || ! regex.test(emails[i])){
            invalidEmails.push(emails[i]);
        }
    }
    if(invalidEmails != 0) {
      jQuery("#contact").siblings(".wizard-form-error").slideDown();
      $('#contact').css('border', '2px solid red');
      $('#contact_err_massage').show();
      nextWizardStep = false;
    }
    else
    {
         $('#contact_err_massage').hide();
    }
}
			
</script>