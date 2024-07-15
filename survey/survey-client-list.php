<?php 
require_once("classes/cls-surveyclient.php");

$obj_survey_client = new Surveyclient();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}
$userid=$_SESSION['ifg_admin']['client_id'];
$limit = "6";

/**********All Active Client List***************/
$fields_survey_client = "*";
$condition_user_active = "`tbl_client_user`.`status` = 'Active'";
$orderby="`tbl_client_user`.`client_id` desc";
$all_active_users=$obj_survey_client->getSurveyUserDetail($fields_survey_client, $condition_user_active, $orderby, '', 0);
$total_records = count($all_active_users);  
$total_pages = ceil($total_records / $limit);

/**********All InActive Client***************/
$condition_user_inactive = "`tbl_client_user`.`status` = 'Inactive'";
$all_inactive_users=$obj_survey_client->getSurveyUserDetail($fields_survey_client, $condition_user_inactive, $orderby,'', 0);
$total_records1 = count($all_inactive_users);  
$total_pages1 = ceil($total_records1 / $limit);

?>
<?php include('dashboard-header-menu.php')?>

<div class="container-fluid">
    <div class="row">
    <!--    <div class="col-md-3">-->
            <?php /* include('dashboard-side-menubar.php') */?>
       <!-- </div>-->
        <div class="col-md-12">
            <section class="mt-5">
                <div class="container">
                    <div class="row">
                          <div class="col-md-12 mt-5">
                              <h3 class="sm-menu-question-header1 mt-5">
                                 Avira Survey Users
                              </h3>
                          </div>
                        </div>
                    <div id="mine">
                        <div class="row d-flex align-items-center">
                                <div class="col-md-6">
                                   <!-- <div class="sm-menu-question-sub-header1">
                                        <h4 class="fw-bold">Surveys User List of </h4>
                                    </div>-->
                                </div>
                                <div class="col-md-6">
                                    <div class="sm-menu-question-sub-header1 d-flex justify-content-end">
                                        Status :  
                                        <ul class="nav nav-tabs status-menu border-0">
                                			<li class="active">
                                                <a href="#tab1" data-toggle="tab">Active</a>
                                			</li>
                                			<li>
                                			    <a href="#tab2" data-toggle="tab" class="close-link">Inactive</a>
                                			</li>
                                		</ul>
                                    </div>
                                </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="tab-content">
            			            <div class="tab-pane active" id="tab1">
            			                <div class="col-md-12" style="text-align:center;" id="loader1"><img src="images/spin.gif" height="200" width="200"></div>
            			                <div id="target-content"></div>
            				        </div>
            				        <div class="tab-pane" id="tab2">
                				        <div class="col-md-12" style="text-align:center;" id="loader2"><img src="images/spin.gif" height="200" width="200"></div>
                				        <div id="target-content-inactive"></div>
                                	</div>
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

<script>
	$(document).ready(function() {
		//$("#target-content").load("survey-pagination.php?page=1");
		$.ajax({
				url: "survey-client-pegination.php",
				type: "GET",
				data: {
					page : "1"
				},
				cache: false,
			    beforeSend: function(){
                    // Show image container
                    $("#loader1").show();
                    $("#loader2").hide();
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
				url: "survey-inactiveclient-pegination.php",
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
					$(".pageitem1").removeClass("active");
					$("#1").addClass("active");
					
				}
			});
			
    });
</script> 