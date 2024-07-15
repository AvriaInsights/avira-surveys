<?php
require_once("classes/cls-survey.php");

$obj_survey = new Survey();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}
$userid=$_SESSION['ifg_admin']['client_id'];

/**********All Active Survey***************/
$fields_survey = "*";
$condition_survey = "`tbl_survey`.`status` = 'Active' and `tbl_survey`.`user_id` ='".$userid."'";
$orderby="`tbl_survey`.`survey_id` desc";
$all_active_surveys=$obj_survey->getSurveyDetail($fields_survey, $condition_survey, $orderby, '', 0);

/*****************Fetch Analyst Count************************/
$fields_analyst = "*";
$condition_analyst = "`tbl_buildAnalyst`.`status` = 'Active' and `tbl_buildAnalyst`.`user_id` ='".$userid."'";
$all_analyst=$obj_survey->getAnalystDetail($fields_analyst, $condition_analyst, '','', 0);
$total_records_analyst = count($all_analyst);  

/*********Result Count*********************/
//$fields_survey_result = "`tbl_response_user`.*,`tbl_survey`.*";
//$condition_survey_result = "`tbl_response_user`.`status` = 'Active' and `tbl_survey`.`user_id` = '".$userid."'";
//$orderby="`tbl_response_user`.`response_user_id` desc";
$fields_survey_result = " DISTINCT `tbl_response_user`.survey_id,`tbl_survey`.*";
$condition_survey_result = "`tbl_response_user`.`user_id` = '".$userid."'";
$all_result_surveys_cnt=$obj_survey->getFullSurveyUser($fields_survey_result, $condition_survey_result, '', '', 0);

$scriptname = $_SERVER['SCRIPT_NAME'];
$pageurlall=explode("/",$scriptname);
print_r($pageurlall);
$pageurl=$pageurlall[2];
?>
<div class="d-sidebar-menu border-end">
    <ul class="list-unstyled">
        <li>Canvass
            <ul class="list-unstyled submenu-list">
                <li>
                    <?php if($pageurl=="survey-result.php"){?>
                    <a href="<?php echo SITEPATH;?>dashboard/"><?php } else {?> <a href="<?php echo SITEPATH;?>dashboard/" onclick="showactivesurvey();"> <?php }?>All Surveys 
                        <span>(<?php echo count($all_active_surveys);?>)</span>
                    </a>
                   
                </li>
                <!--<li>-->
                <!--    <a href="#">Created-->
                <!--        <span>(2)</span>-->
                <!--    </a>-->
                <!--</li>-->
                <!--<li>-->
                <!--    <?php if($pageurl=="survey-result.php"){?>-->
                <!--    <a href="<?php echo SITEPATH;?>dashboard/"><?php } else {?>-->
                <!--    <a href="<?php echo SITEPATH;?>dashboard/" onclick="showanalystsurvey();"><?php }?>Analyst Assisted-->
                <!--        <span>(<?php echo $total_records_analyst;?>)</span>-->
                <!--    </a>-->
                <!--</li>-->
                <li>
                    <a href="<?php echo SITEPATH;?>survey-result/">Survey Result
                        <span>(<?php echo count($all_result_surveys_cnt);?>)</span>
                    </a>
                </li>
                 <li>
                    <a href="<?php echo SITEPATH;?>campaign-allsurvey-result.php">Email Campaign Result
                        
                    </a>
                </li>
                
            </ul>
        </li>
        <!--<li>-->
        <!--    <a href="#">-->
        <!--        <i class="fa fa-plus"></i> Create New -->
        <!--    </a>-->
        <!--</li>-->
        <li class="pt-4">Other
            <ul class="list-unstyled submenu-list">
                <!--<li>-->
                <!--    <a href="<?php echo SITEPATH; ?>dashboard">-->
                <!--        Import Contacts-->
                <!--    </a>-->
                <!--</li>-->
               <!-- <li>
                    <a href="#">Survey Themes</a>
                </li>-->
                <!--<li>
                    <a href="#">What's New?</a>
                </li>-->
                <li>
                    <a href="<?php echo SITEPATHFRONT; ?>contact-us" target="_blank">Need More Help?</a>
                </li>
            </ul>
        </li>
        <li></li>
    </ul>
</div>
<script>
    function showactivesurvey()
    {
        $("#analyst").hide();
        $("#mine").show();
        $.ajax({
				url: "<?php echo SITEPATH; ?>survey-pagination.php",
				type: "GET",
				data: {
					page : "1"
				},
				cache: false,
			    beforeSend: function(){
                    // Show image container
                    $("#loader1").show();
                    $("#loader2").hide();
                    $("#loader3").hide();
                    $("#target-content").html("");
                },
				success: function(dataResult){
				    //alert(dataResult);
				    $("#loader1").hide();
					$("#target-content").html(dataResult);
					$(".pageitem").removeClass("active");
					$("#1").addClass("active");
					
				}
			});
		
		$.ajax({
				url: "<?php echo SITEPATH; ?>survey-pagination-close.php",
				type: "GET",
				data: {
					page : "1"
				},
				cache: false,
				beforeSend: function(){
                    // Show image container
                    $("#loader2").show();
                    $("#loader1").hide();
                    $("#loader3").hide();
                },
				success: function(dataResult1){
				    //alert(dataResult);
				    $("#loader2").hide();
					$("#target-content-inactive").html(dataResult1);
					$(".pageitem1").removeClass("active2");
					$("#1").addClass("active2");
					
				}
			});
    }
    
    function showanalystsurvey()
    {
        $("#analyst").show();
        $("#mine").hide();
    }
</script>