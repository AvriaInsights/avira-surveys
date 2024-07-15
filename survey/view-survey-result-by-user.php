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
    $fields_survey_result1 = "*";
    $condition_survey_result1 = "`tbl_survey`.`survey_id` = '".$surveyid."'";
    $all_result_surveys=$obj_survey->getSurveyDetail($fields_survey_result1, $condition_survey_result1, '', '', 0);
    foreach($all_result_surveys as $all_result_survey)
    {
        $surveytitle=$all_result_survey['survey_title'];
    }
}
else
{
    $surveyid="";
}

?>
<?php include('dashboard-header-menu.php')?>
<style>
    .exportlink{
        font-size:1.5rem;
        font-weight:bold;
    }
</style>
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
                                  Result Dashboard
                              </h3>
                          </div>
                        </div>
                    <div id="mine">
                        <div class="row d-flex align-items-center">
                                <div class="col-md-4">
                                    <div class="sm-menu-question-sub-header1">
                                        <h4 class="fw-bold">Survey Result By User</h4>
                                    </div>
                                </div>
                                <?php if(isset($_GET['surveyid'])){?>
                                <div class="col-md-6">
                                    <div class="sm-menu-question-sub-header1">
                                        <h4 class="fw-bold">Survey Title: <?php echo $surveytitle;?></h4>
                                    </div>
                                </div>
                                <?php }?>
                                <div class="col-md-2">
                                    <div class="sm-menu-question-sub-header1">
                                        <a href="<?php echo SITEPATH ?>export-result-by-user.php?surveyid=<?php echo $surveyid;?>"  class="exportlink" download><i class="fa fa-download fa-1x"></i> Export User Result</a>
                                    </div>
                                </div>
                                <!--<div class="col-md-6">-->
                                <!--    <div class="sm-menu-question-sub-header1 d-flex justify-content-end">-->
                                <!--        Status :  -->
                                <!--        <ul class="nav nav-tabs status-menu border-0">-->
                                <!--			<li class="active">-->
                                <!--                <a href="#tab1" data-toggle="tab">Active</a>-->
                                <!--			</li>-->
                                <!--			<li><a href="#tab2" data-toggle="tab" class="close-link">Closed</a>-->
                                			
                                <!--			</li>-->
                                <!--		</ul>-->
                                <!--    </div>-->
                                <!--</div>-->
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                               <div id="target-content"></div>
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
				url: "<?php echo SITEPATH; ?>survey-result-by-user-pagination.php",
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