<?php 
require_once("classes/cls-survey.php");

$obj_survey = new Survey();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login");
}
$limitcond = "10";
$userid=$_SESSION['ifg_admin']['client_id'];
$page = $_GET['page'];
//echo $page; exit;
if($page=="1")
{
   $nextoffset="0";
}
else
{
   $nextoffset=($page-1) * $limitcond;  
}
/**********All Active Survey***************/
$fields_survey = "*";
$condition_survey = "`tbl_survey`.`status` = 'Active' and `tbl_survey`.`user_id` ='".$userid."'";
$orderby="`tbl_survey`.`survey_id` desc";
$limit ="$nextoffset,$limitcond";
$all_active_surveys=$obj_survey->getSurveyDetail($fields_survey, $condition_survey, $orderby, $limit,'', 0);

$all_active_surveys_cnt=$obj_survey->getSurveyDetail($fields_survey, $condition_survey, $orderby, '', 0);
$total_records = count($all_active_surveys_cnt);  
$total_pages = ceil($total_records / $limitcond);
?>


<?php 
if(isset($all_active_surveys))
{
foreach($all_active_surveys as $all_active_survey){
      /**********All Active Survey***************/
        $fields_questions = "*";
        $condition_questions = "`tbl_questionBank`.`survey_id` = '".$all_active_survey['survey_id']."'";
        $all_related_survey_questions=$obj_survey->getQuestionBank($fields_questions, $condition_questions, '', '', 0);
        
      /*********Response count**************/
      $condition_response = "`tbl_response_user`.`survey_id` = '".$all_active_survey['survey_id']."'";
      $all_related_survey_response=$obj_survey->getSurveyUser('', $condition_response, '', '', 0);
        
?>
 <div class="row listingbox d-flex align-items-center">
    <div class="col-md-4">
        
        <div class="row">
            <div class="col-md-6 listinginnerbox">
                <div class="">
                    <a href="<?php echo SITEPATH;?>add-survey?surveyid=<?php echo $all_active_survey['survey_id'];?>">
                        <?php echo $all_active_survey['filled_by'];?> Form
                    </a>
                </div>
            </div>
            <div class="col-md-9" style="padding:11px;">
                <div class="row">
                    <div class="col-md-12 txtbold">
                        <a href="<?php echo SITEPATH;?>add-survey?surveyid=<?php echo $all_active_survey['survey_id'];?>">
                            <?php echo $all_active_survey['survey_title'];?></a>
                        </div>
                    </div>
                <div class="row"><div class="col-md-12">Last Modified: <?php echo $all_active_survey['updated_at'];?></div></div>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="row"><div class="col-md-12 txtbold"><?php echo count($all_related_survey_questions);?></div></div>
        <div class="row"><div class="col-md-12">Questions</div></div>
    </div>
    <div class="col-md-2">
        <div class="row"><div class="col-md-12 txtbold"><?php echo count($all_related_survey_response);?></div></div>
        <div class="row"><div class="col-md-12">Responses</div></div>
    </div>
    <div class="col-md-2">
        <div class="row"><div class="col-md-12">Wants to Published Survey</div></div>
        <div class="row">
            <div class="col-md-12">
             <div class="toggle-button-cover">
                  <div class="button-cover">
                    <div class="button r" id="button-1">
                      <input type="checkbox" class="checkbox" Value="Published"/>
                    </div>
                  </div>
            </div>
        </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="row"><div class="col-md-12">
            <select name="action<?php echo $all_active_survey['survey_id'];?>" id="action<?php echo $all_active_survey['survey_id'];?>" class="form-select" style="font-size:13px;" onchange="action(<?php echo $all_active_survey['survey_id'];?>);">
                <option value="">Action</option>
                <option value="edit">Edit Survey</option>
                <option value="share">Share Survey</option>
                <option value="view">View Result</option>
                <option value="close">Close</option>
            </select>
        </div></div>
    </div>
</div>
<?php } }?>
<div class="clearfix">
       <ul class="pagination d-flex justify-content-end mb-0">
    <?php 
	if(!empty($total_pages)){
		for($i=1; $i<=$total_pages; $i++){
				if($i == 1){
					?>
				<li class="pageitem active" id="<?php echo $i;?>"><a href="JavaScript:Void(0);" data-id="<?php echo $i;?>" class="page-link active" ><?php echo $i;?></a></li>
											
				<?php 
				}
				else{
					?>
				<li class="pageitem" id="<?php echo $i;?>"><a href="JavaScript:Void(0);" class="page-link" data-id="<?php echo $i;?>"><?php echo $i;?></a></li>
				<?php
				}
		}
	}
				?>
	</ul>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$(".page-link").click(function(){
			var id = $(this).attr("data-id");
			var select_id = $(this).parent().attr("id");
			
			$.ajax({
				url: "<?php echo SITEPATH; ?>survey-pagination.php",
				type: "GET",
				data: {
					page : id
				},
				cache: false,
				success: function(dataResult){
					$("#target-content").html(dataResult);
					$(".pageitem").removeClass("active");
					$("#"+select_id).addClass("active");
					$(window).scrollTop(0);
				}
			});
		});
	});

function action(survid)
{
    //alert(survid);
    var actionstat = $("#action"+survid).val();
    if(actionstat=="edit")
    {
        window.location.href = "<?php echo SITEPATH;?>add-survey?surveyid="+survid;
    }
    if(actionstat=="share")
    {
        window.location.href = "<?php echo SITEPATH;?>share?surveyid="+survid;
    }
    if(actionstat=="view")
    {
        window.location.href = "<?php echo SITEPATH;?>survey-result/?surveyid="+survid;
    }
    if(actionstat=="close")
    {
        $.ajax({
              url : "<?php echo SITEPATH; ?>update-suvery-status.php",
              type : "POST",
              data : {surveyid:survid},
              success: function(dataquestion){
                
                    //$("#allquestionlist").html(dataquestion);
                    swal("Survey Closed!", "", "success");
                    $.ajax({
            				url: "<?php echo SITEPATH; ?>survey-pagination.php",
            				type: "GET",
            				data: {
            					page : "1"
            				},
            				cache: false,
            				success: function(dataResult){
            				    //alert(dataResult);
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
            				success: function(dataResult){
            				    //alert(dataResult);
            					$("#target-content-inactive").html(dataResult);
            					$(".pageitem1").removeClass("active");
            					$("#1").addClass("active");
            					
            				}
            			});
              }
        });
    }
    
}



</script>