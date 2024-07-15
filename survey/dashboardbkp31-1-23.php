<?php 
require_once("classes/cls-survey.php");

$obj_survey = new Survey();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}
$userid=$_SESSION['ifg_admin']['client_id'];
$limit = "6";
/**********All Active Survey***************/
$fields_survey = "*";
$condition_survey = "`tbl_survey`.`status` = 'Active' and `tbl_survey`.`user_id` ='".$userid."'";
$orderby="`tbl_survey`.`created_at` DESC";
$all_active_surveys=$obj_survey->getSurveyDetail($fields_survey, $condition_survey, $orderby, '', 0);
$total_records = count($all_active_surveys);  
$total_pages = ceil($total_records / $limit);

/**********All Active Survey***************/
$condition_survey_inactive = "`tbl_survey`.`status` = 'Inactive' and `tbl_survey`.`user_id` ='".$userid."'";
$all_inactive_surveys=$obj_survey->getSurveyDetail($fields_survey, $condition_survey_inactive, $orderby,'', 0);
$total_records1 = count($all_inactive_surveys);  
$total_pages1 = ceil($total_records1 / $limit);

/*****************Fetch Analyst Count************************/
$fields_analyst = "*";
$condition_analyst = "`tbl_buildAnalyst`.`status` = 'Active' and `tbl_buildAnalyst`.`user_id` ='".$userid."'";
$all_analyst=$obj_survey->getAnalystDetail($fields_analyst, $condition_analyst, '','', 0);
$total_records_analyst = count($all_analyst);  
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
                                <div class="col-md-3">
                                    <div class="sm-menu-question-sub-header1">
                                        <h4 class="fw-bold">Surveys</h4>
                                    </div>
                                </div>
                                 <div class="col-md-5">
                                    <div class="sm-menu-question-sub-header1" style="float:left;width:100%;">
                                        <!--<h4 class="fw-bold"><a href="<?php echo SITEPATH; ?>view-survey-result-by-user.php">Result By User</a></h4>-->
                                        <form class="d-flex">
                                          <input class="form-control text-dark" type="search" placeholder="Search" aria-label="Search" id="search-holder">
                                          <a class="btn common-btn search-btn" id="header-search" href="javascript:void(0);" onclick="search_button();" style="background: linear-gradient(135deg, #029bff 0%,#00cfff 100%);">
                                            <img src="<?php echo SITEPATH;?>images/search-icon.png" alt="search-icon" class="img-fluid" width="16" height="16">
                                          </a>
                                        </form>
                                    </div>
                                    
                                </div>
                                <div class="col-md-4">
                                    <div class="sm-menu-question-sub-header1 d-flex justify-content-end">
                                        Status :  
                                        <ul class="nav nav-tabs status-menu border-0">
                                			<li class="active">
                                                <a href="#tab1" data-toggle="tab">Active</a>
                                			</li>
                                			<li><a href="#tab2" data-toggle="tab" class="close-link">Closed</a>
                                			
                                			</li>
                                		</ul>
                                    </div>
                                </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                 <div class="text-center">
                                            <img class="survey-loader" id="survey-loader" style="width:8rem !important;" src="<?php echo SITEPATH; ?>images/loading-survey.gif">
                                       </div>
                                <div class="tab-content">
                                    
            			            <div class="tab-pane active" id="tab1">
            			               
            			                <div id="target-content"></div>
                                            
            				        </div>
            				        <div class="tab-pane" id="tab2">
                				       
                				        <div id="target-content-inactive"></div>
                                	</div>
    		                    </div>
                            </div>
                        </div> 
                    </div>
                    
                    <div id="analyst">
                        <div class="row d-flex align-items-center">
                                <div class="col-md-6">
                                    <div class="sm-menu-question-sub-header1">
                                        <h4 class="fw-bold">Surveys</h4>
                                    </div>
                                </div>
                                
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                
            			        <!--<div class="col-md-12" style="text-align:center;" id="loader3"><img src="images/spin.gif" height="200" width="200"></div>-->
            			        <div id="target-analyst-content"></div>
                            
                            </div>
                        </div>   
                    </div>
                </div>
                
                     
           </section>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
document.getElementById("search-holder")
    .addEventListener("keyup", function(event) {
    window.stop();
    if (event.keyCode === 13) {
        //alert("dd");
       search_button();
    }
});
	$(document).ready(function() {
		//$("#target-content").load("survey-pagination.php?page=1");
		$("#analyst").hide();
		$("#search-holder").val("");
		$.ajax({
				url: "<?php echo SITEPATH; ?>survey-pagination.php",
				type: "GET",
				data: {
					page : "1"
				},
				cache: false,
			    beforeSend: function(){
                    // Show image container
                    // $("#loader1").show();
                    // $("#loader2").hide();
                    // $("#loader3").hide();
                    $("#survey-loader").show();
                },
				success: function(dataResult){
				    //alert(dataResult);
				    //$("#loader1").hide();
				    $("#survey-loader").hide();
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
                    // $("#loader2").show();
                    // $("#loader1").hide();
                    // $("#loader3").hide();
                    $("#survey-loader").show();
                },
				success: function(dataResult){
				    //alert(dataResult);
				    //$("#loader2").hide();
				    $("#survey-loader").hide();
					$("#target-content-inactive").html(dataResult);
					$(".pageitem1").removeClass("active2");
					$("#close-1").addClass("active2");
					
				}
			});
			
		$.ajax({
				url: "<?php echo SITEPATH; ?>survey-analyst-pagination.php",
				type: "GET",
				data: {
					page : "1"
				},
				cache: false,
				beforeSend: function(){
                    // Show image container
                    // $("#loader3").show();
                    // $("#loader1").hide();
                    // $("#loader2").hide();
                    $("#survey-loader").show();
                },
				success: function(dataResult){
				    //alert(dataResult);
				    //$("#loader3").hide();
				    $("#survey-loader").hide();
					$("#target-analyst-content").html(dataResult);
					$(".pageitem2").removeClass("active");
					$("#analyst-1").addClass("active");
					
				}
			});
    });
function search_button()
{
        var searchval = $("#search-holder").val();
        if(searchval!="")
        {
    		$.ajax({
    				url: "<?php echo SITEPATH; ?>survey-pagination.php",
    				type: "GET",
    				data: {
    					page : "1",searchval:searchval
    				},
    				beforeSend: function() {
                        $(".survey-loader").show();
                        $("#target-content").html("");
                    },
    				cache: false,
    			    success: function(dataResult){
    			        $(".survey-loader").hide();
    				    $("#target-content").html(dataResult);
    					$(".pageitem").removeClass("active");
    					$("#1").addClass("active");
    				}
    		});
    		
    		$.ajax({
    				url: "<?php echo SITEPATH; ?>survey-pagination-close.php",
    				type: "GET",
    				data: {
    					page : "1",searchval:searchval
    				},
    				beforeSend: function() {
                        $(".survey-loader").show();
                        $("#target-content-inactive").html("");
                    },
    				cache: false,
    			    success: function(dataResult){
    			        $("#survey-loader").hide();
    					$("#target-content-inactive").html(dataResult);
    					$(".pageitem1").removeClass("active2");
    					$("#close-1").addClass("active2");
    				}
    		});
        }
        else
        {
            swal("Search!", "Please enter text to search!", "info");
        }
}
</script> 