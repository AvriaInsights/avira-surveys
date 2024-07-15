<?php 
require_once("classes/cls-survey.php");

$obj_survey = new Survey();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login");
}

$userid=$_SESSION['ifg_admin']['client_id'];

if(isset($_GET['surveyid']))
{
    $surveyid=$_GET['surveyid'];
}
else
{
    $surveyid="";
}

/**********All Questions***************/
$fields_questions = "*";
$condition_questions = "`tbl_questionBank`.`survey_id` ='".$surveyid."'";
$orderby="`tbl_questionBank`.`sequence` ASC";
$all_questions=$obj_survey->getQuestionBank($fields_questions, $condition_questions, $orderby, '', 0);

?>
<?php include('dashboard-header-menu.php')?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <?php include('dashboard-side-menubar.php')?>
        </div>
        <div class="col-md-9">
            <section class="content-wrapper">
                <div class="container" style="height:100vh;">
                    <div class="row">
                          <div class="col-md-12">
                              <h3 class="sm-menu-question-header1">
                                  Dashboard
                              </h3>
                          </div>
                        </div>
                    <div id="mine">
                        <div class="row d-flex align-items-center">
                                <div class="col-md-6">
                                    <div class="sm-menu-question-sub-header1">
                                        <h4 class="fw-bold">Survey Result</h4>
                                    </div>
                                </div>
                                
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <?php $srno=1;if(isset($all_questions) && !empty($all_questions)){
                                              foreach($all_questions as $all_question){
                                                  $fields_type = "*";
                                                  $condition_type = "`tbl_question_type`.`quest_type_id` =".$all_question['quest_type_id'];
                                                  $all_type=$obj_survey->getQuestionType($fields_type, $condition_type, '', '', 0);
                                                  foreach($all_type as $all_types){ $questiontype=$all_types['quest_type'];}
                                ?>
                                <div class="row listingbox d-flex align-items-center">
                                    <div class="col-md-12">
                                        
                                        <div class="row">
                                            
                                            <div class="col-md-12" style="padding:11px;">
                                                <div class="row">
                                                    <div class="col-md-12 txtbold">
                                                        
                                                            <?php echo "Q".$all_question['sequence']."-".$all_question['question_title']; ?> 
                                                        </div>
                                                    </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="padding:11px;">
                                        <div class="row"><div class="col-md-12 txtbold">dsdfsdfs</div></div>
                                        
                                    </div>
                                    
                                </div>
                                <?php $srno++;} }?>
                            </div>
                        </div> 
                    </div>
                </div>
                
                     
           </section>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
<script>
	$(document).ready(function() {
	
		$.ajax({
				url: "<?php echo SITEPATH; ?>survey-result-pagination.php",
				type: "GET",
				data: {
					page : "1",surveyid:'<?php echo $surveyid;?>'
				},
				cache: false,
			    success: function(dataResult){
			        
				    $("#target-content").html(dataResult);
					$(".pageitem").removeClass("active");
					$("#1").addClass("active");
				}
		});
	});

</script>