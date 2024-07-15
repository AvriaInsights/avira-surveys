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
                                        <h4 class="fw-bold">Campaign Survey Result By User</h4>
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
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#campaignresult" onclick="blankdatrange();" download><i class="fa fa-download fa-1x"></i> Export User List By Date</a>

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
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/alumuko/vanilla-datetimerange-picker@latest/dist/vanilla-datetimerange-picker.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<!-- Modal -->
<div class="modal fade" id="campaignresult" tabindex="-1" aria-labelledby="resultLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable survey-result-modal">
    <div class="modal-content" style="max-height:80%!important;">
      <div class="modal-header">
        <h5 class="modal-title" id="resultLabel" style="font-size:15px;align-item:center;font-weight:500;">Export User List</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="height:250px;padding-top:50px;">
          <div class="col-md-8 offset-2">
            <input type="text" id="datetimerange-input1" name="fildat" size="24" style="text-align:left" class="form-control" value="" autocomplete="off">
            <span class="error" id="dateval"></span>
            <span class="error" id="dateval1"></span>
          </div>
          
          <div class="col-md-12 text-center" style="padding-top:40px;">
              <a href="javascript:void(0);" id="export-all-filter" class="view-survey-btn" download="" style="font-size:14px;"><i class="fa fa-download fa-1x"></i> Export User List</a>
          </div>
      </div>
      
    </div>
  </div>
</div>
<script>
	$(document).ready(function() {
	
		$.ajax({
				url: "<?php echo SITEPATH; ?>campaign-specificsurvey-result-pagination.php",
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
		
		$("#export-all-filter").click(function(){
            var daterange=$("#datetimerange-input1").val();
            var survid='<?php echo $surveyid;?>';
            
		    //alert(daterange);
		    if(daterange=="")
		    {
		        $("#dateval1").text("Please select date");
		    }
		   
		    
		    var daterror=$("#dateval").text().length;
		    var daterror1=$("#dateval1").text().length;
		    
		    if(daterror == 0 && daterror1 == 0)
		    {
		        window.location="<?php echo SITEPATH;?>export-campaign-result-by-user.php?surveyid="+survid+"&daterange="+daterange;
		    }
		    
        });
        
    
	});
	
    window.addEventListener("load", function (event) {
                new DateRangePicker('datetimerange-input1');
                $("#datetimerange-input1").val("");
                $("#datetimerange-input1").attr("placeholder", "Select Date Range");
                
            });
            //$('#datetimerange-input1').data('daterangepicker').setEndDate();
        window.addEventListener("click", function (event) {
                //new DateRangePicker('datetimerange-input1');
                var today = new Date();
                var dd = today.getDate();
                var mm = today.getMonth()+1; //January is 0!
                var yyyy = today.getFullYear();
                 if(dd<10){
                        dd='0'+dd
                    } 
                    if(mm<10){
                        mm='0'+mm
                    } 
                
                var maxdate = mm+'/'+dd+'/'+yyyy;
                //alert(maxdate);
                
                var seldat=$("#datetimerange-input1").val();
                var fulldat=seldat.split("-");
                var todat12=fulldat[1];
               
                
                var startDay = new Date(maxdate);  
                var endDay = new Date(todat12);  
              
                // Determine the time difference between two dates     
                var millisBetween = startDay.getTime() - endDay.getTime();  
              
                // Determine the number of days between two dates  
                var days = millisBetween / (1000 * 3600 * 24);  
                if(days<0)
                {
                    $("#dateval").text("Please select correct date");
                    //var flag3=1;
                    $("#dateval1").text("");
                }
                else
                {
                    $("#dateval").text("");
                    //$("#dateval1").text("");
                  // var flag3=0;
                }
                //alert(flag3);
            });
            
            function blankdatrange()
            {
                $("#datetimerange-input1").val("");
                $("#datetimerange-input1").attr("placeholder", "Select Date Range"); 
            }
            
            
</script>