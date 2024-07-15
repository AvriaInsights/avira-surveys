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
                                  Result Dashboard
                              </h3>
                          </div>
                        </div>
                    <div id="mine">
                        <div class="row d-flex align-items-center">
                                <div class="col-md-6">
                                    <div class="sm-menu-question-sub-header1">
                                        <h4 class="fw-bold">Email Campaign Survey List</h4>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="sm-menu-question-sub-header1" style="float:right;">
                                        <!--<h4 class="fw-bold"><a href="<?php echo SITEPATH; ?>view-survey-result-by-user.php">Result By User</a></h4>-->
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
				url: "<?php echo SITEPATH; ?>campaign-allsurvey-result-pagination.php",
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