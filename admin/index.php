<?php 
require_once("classes/cls-request.php");
$obj_request = new Request();
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
//if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}
//echo $_SESSION['ifg_admin']['role'];
$fields = "*";
$condition = "";
$request_details = $obj_request->getRequestDetails($fields, $condition, '', '', 0);

$fields_high="`tbl_request`.`request_id`";
$condition_high="`tbl_request`.`priority_wise`='High'";
$request_high=$obj_request->getRequestDetails($fields_high, $condition_high, '', '', 0);

$fields_mid="`tbl_request`.`request_id`";
$condition_mid="`tbl_request`.`priority_wise`='Mid'";
$request_mid=$obj_request->getRequestDetails($fields_mid, $condition_mid, '', '', 0);

$fields_low="`tbl_request`.`request_id`";
$condition_low="`tbl_request`.`priority_wise`='Low'";
$request_low=$obj_request->getRequestDetails($fields_low, $condition_low, '', '', 0);

$fields_junk="`tbl_request`.`request_id`";
$condition_junk="`tbl_request`.`priority_wise`='Junk'";
$request_junk=$obj_request->getRequestDetails($fields_junk, $condition_junk, '', '', 0);
?>
<?php
 
$dataPoints = array( 
	array("label"=>"High Priority Leads", "y"=>count($request_high)),
	array("label"=>"Mid Priority Leads", "y"=>count($request_mid)),
	array("label"=>"Low Priority Leads", "y"=>count($request_low))
)
?>
<script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light1",
	title: {
		text: "Leads Graph"
	},
	data: [{
		type: "pyramid",
		indexLabel: "{label} - {y}",
		reversed: true,
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
}
</script>
<div class="wrapper">
   <?php include("sidebarmenu.php")?>
        <?php include("header.php")?>
        <section class="content-wrapper">
            <div class="container">
              <div class="row mb-5">
                  <div class="col">
                  <div class="leads-count bg-5">
                      <h4>All Leads</h4>
                      <p><?php echo count($request_details);?></p>
                      
                  </div>
                </div>
                <div class="col">
                  <div class="leads-count bg-1">
                      <h4>High Priority Leads</h4>
                      <p><?php echo count($request_high);?></p>
                  </div>
                </div>
                <div class="col">
                  <div class="leads-count bg-2">
                      <h4>Mid Priority Leads</h4>
                      <p><?php echo count($request_mid);?></p>
                  </div>
                </div>
                <div class="col">
                  <div class="leads-count bg-3">
                      <h4>Low Priority Leads</h4>
                      <p><?php echo count($request_low);?></p>
                  </div>
                </div>
                <div class="col">
                  <div class="leads-count bg-4">
                      <h4>Junk Leads</h4>
                     <p><?php echo count($request_junk);?></p>
                      
                  </div>
                </div>
                
              </div>
              <div class="row">
                  <div class="col-md-6">
                      <!--<div id="chartContainer" class="chart-tt" style="height: 370px; width: 100%;"></div>-->
                      <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                  </div>
                  <div class="col-md-6"></div>
              </div>
            </div>
       </section>
       
       
       <section class="form-wrapper-main" id="mySidepanel">
          <div class="text-end">
            <i class="fa fa-times"onclick="closeNav()"></i>
          </div>
           <div class="container">
               <div class="row">
                   <div class="col-md-12">
                       <h2>Leads Info</h2>
                   </div>
               </div>
               <div class="row">
                   <div class="col-md-4">
                       <div class="user-info mb-3">
                           <div class="user-pic">
                             <img src="images/default-avatar.png" alt="user-pic" class="img-fluid">
                           </div>
                           <div class="users-details">
                               <h3>ADITYA SATYAM</h3>
                               <h4 class="fw-bold">ID:LD2696811</h4>
                           </div>
                       </div>
                       <div class="all-user-data">
                           <div class="mb-4">
                               <p>Mobile</p>
                               <span>9809876541</span>
                           </div>
                           <div class="mb-4">
                               <p>Email</p>
                               <span>abc@gmail.com</span>
                           </div>
                           <div class="mb-4">
                               <p>Leads Score</p>
                               <span>2</span>
                           </div>
                           <div class="mb-4">
                               <p>Leads Assigned By:<span>John</span></p>
                           </div>
                          <div class="mb-4">
                              <p>Lead Referred By:Abc<p>
                          </div> 
                           
                       </div>
                   </div>
                   <div class="col-md-8">
                       <div class="user-form-details">
                           <h2>Info</h2>
                           
                           <form class="row">
                               <div class="col-md-12">
                                   <div class="main-holder">
                                        <label class="form-label">Business Email</label>
                                        <input type="email" class="form-control">
                                    </div>
                                </div>
                              <div class="col-md-6">
                                  <div class="main-holder">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control">
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="main-holder">
                                    <label  class="form-label">Company</label>
                                    <input type="text" class="form-control">
                                   </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="main-holder">
                                    <label  class="form-label">Phone Number</label>
                                    <input type="number" class="form-control">
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="main-holder">
                                    <label class="form-label">Designation</label>
                                    <input type="text" class="form-control">
                                   </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="main-holder">
                                    <label class="form-label">Message</label>
                                    <textarea row="9" cols="20" class="form-control" id="inputCity"></textarea>
                                  </div>
                              </div>
                              <!--<div class="col-md-12">-->
                              <!--    <div class="text-center">-->
                              <!--       <button type="submit" class="btn btn-primary">Submit</button>-->
                              <!--     </div>-->
                              <!--</div>-->
                            </form>
                       </div>
                   </div>
               </div>
           </div>
       </section>
   </div>
   
 




<?php include("footer.php")?>

  
