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
                                        <h4 class="fw-bold">Survey Result</h4>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="sm-menu-question-sub-header1" style="float:right;width:100%;">
                                        <!--<h4 class="fw-bold"><a href="<?php echo SITEPATH; ?>view-survey-result-by-user.php">Result By User</a></h4>-->
                                        <form class="d-flex">
                                          <input class="form-control text-dark" type="search" placeholder="Search" aria-label="Search" id="search-holder">
                                          <a class="btn common-btn search-btn" id="header-search" href="javascript:void(0);" onclick="search_button();" style="background: linear-gradient(135deg, #029bff 0%,#00cfff 100%);">
                                            <img src="<?php echo SITEPATH;?>images/search-icon.png" alt="search-icon" class="img-fluid" width="16" height="16">
                                          </a>
                                        </form>
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
                               <div id="target-content">
                                   
                               </div>
                               <div class="text-center">
                                        <img class="survey-loader" style="width:8rem !important;" src="<?php echo SITEPATH; ?>images/loading-survey.gif">
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
	            $(".survey-loader").show();
		$.ajax({
				url: "<?php echo SITEPATH; ?>survey-result-pagination.php",
				type: "GET",
				data: {
					page : "1",surveyid:'<?php echo $surveyid;?>'
				},
				cache: false,
			    success: function(dataResult){
			        $(".survey-loader").hide();
				    $("#target-content").html(dataResult);
					$(".pageitem").removeClass("active");
					$("#1").addClass("active");
				}
		});
	});

function search_button()
{
    
        var searchval = $("#search-holder").val();
        if(searchval!="")
        {
    		$.ajax({
    				url: "<?php echo SITEPATH; ?>survey-result-pagination.php",
    				type: "GET",
    				data: {
    					page : "1",surveyid:'<?php echo $surveyid;?>',searchval:searchval
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
        }
        else
        {
            swal("Search!", "Please enter text to search!", "info");
        }
}
</script>