<?php 
require_once("classes/cls-surveyclient.php");
$obj_survey_client = new Surveyclient();
if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}
$limitcond = "10";
$userid=$_SESSION['ifg_admin']['client_id'];
$page = $_GET['page'];
if($page=="1")
{
   $nextoffset="0";
}
else
{
   $nextoffset=($page-1) * $limitcond;  
}
/**********All Active Clients***************/
$fields_survey_client = "*";
$condition_user_active = "`tbl_client_user`.`status` = 'Active'";
$orderby="`tbl_client_user`.`client_id` desc";
$limit ="$nextoffset,$limitcond";
$all_active_users=$obj_survey_client->getSurveyUserDetail($fields_survey_client, $condition_user_active, $orderby, $limit,'', 0);
$all_active_users_cnt=$obj_survey_client->getSurveyUserDetail($fields_survey_client, $condition_user_active, $orderby, '', 0);
$total_records = count($all_active_users_cnt);  
$total_pages = ceil($total_records / $limitcond);
?>
<style>
.responsive-table li {
	 border-radius: 3px;
	 padding: 25px 30px;
	 display: flex;
	 justify-content: space-between;
	 margin-bottom: 20px;
	 text-align:center;
}
 .responsive-table .table-header {
	font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.03em;
    background: linear-gradient(to right,#02076d, #000, #02076d);
    color: #fff;
    font-weight: 700;
    text-align:center;
}
 .responsive-table .table-row {
	 background-color: #fff;
	 box-shadow: 0px 0px 9px 0px rgba(0, 0, 0, 0.1);
}
.responsive-table .table-row:hover {
	 background-color: #ddd;
	 box-shadow: 1px 1px 10px 0px rgba(0, 0, 0, 0.2);
}
 .responsive-table .col-1 {
	 flex-basis: 15%;
}
 .responsive-table .col-2 {
	 flex-basis: 25%;
}
 .responsive-table .col-3 {
	 flex-basis: 10%;
}
 .responsive-table .col-4 {
	 flex-basis: 15%;
}
.responsive-table .col-5 {
	 flex-basis: 15%;
}
.responsive-table .col-6 {
	 flex-basis: 15%;
}
.responsive-table .col-7 {
	 flex-basis: 5%;
}
 @media all and (max-width: 767px) {
	 .responsive-table .table-header {
		 display: none;
	}
	 .responsive-table li {
		 display: block;
	}
	 .responsive-table .col {
		 flex-basis: 100%;
	}
	 .responsive-table .col {
		 display: flex;
		 padding: 10px 0;
	}
	 .responsive-table .col:before {
		 color: #6c7a89;
		 padding-right: 10px;
		 content: attr(data-label);
		 flex-basis: 50%;
		 text-align: right;
	}
}
 
</style>
 <div class="row listingbox d-flex align-items-center">
    <div class="col-md-12">
        <div class="container">
             <ul class="responsive-table">
                 <li class="table-header">
                  <div class="col col-1">Name</div>
                  <div class="col col-2">Email</div>
                  <div class="col col-3">phone</div>
                  <div class="col col-4">Company</div>
                  <div class="col col-5">Country</div>
                  <div class="col col-6">Created At</div>
                  <div class="col col-7">Action</div>
                </li>
                 <?php 
                    if(isset($all_active_users))
                    {
                        foreach($all_active_users as $all_active_user){
                    ?>
                        <li class="table-row sign_table_row">
                          <div class="col col-1 sign_username" data-label="Name"><?php echo $all_active_user['fname']; ?> <?php echo $all_active_user['lname']; ?></div>
                          <div class="col col-2 sign_email" data-label="Email"><?php echo $all_active_user['email']; ?></div>
                          <div class="col col-3" data-label="Phone"><?php echo $all_active_user['phone']; ?></div>
                          <div class="col col-4" data-label="Company"><?php echo $all_active_user['company']; ?></div>
                          <div class="col col-5" data-label="Country"><?php echo $all_active_user['country_id']; ?></div>
                          <div class="col col-6" data-label="Created At"><?php echo $all_active_user['created_at']; ?></div>
                          <div class="col col-7 text-center" data-label="Action">
                              <a class="btn btn-outline-success" data-toggle="tooltip" data-placement="top" title="Deativate User" onclick="action(<?php echo $all_active_user['client_id'];?>);">Deactive</a>
                          </div>
                        </li>
                         <?php } ?>
             </ul>  
        </div>
    </div>
<?php  }?>
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
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$(".page-link").click(function(){
			var id = $(this).attr("data-id");
			$.ajax({
				url: "survey-client-pegination.php",
				type: "GET",
				data: {
					page : id
				},
				cache: false,
				success: function(dataResult){
					$("#target-content").html(dataResult);
					$(".pageitem").removeClass("active");
					$(window).scrollTop(0);
				}
			});
		});
	});
	function action(suserid)
    {
    //alert(userid);exit;
    
        $.ajax({
              url : "update-surveyuser-status.php",
              type : "POST",
              data : {suserid:suserid},
              success: function(){
                    //$("#allquestionlist").html(dataquestion);
                    swal("User Deactivated..!", "", "success");
                    $.ajax({
            				url: "survey-client-pegination.php",
            				type: "GET",
            				data: {
            					page : "1"
            				},
            				cache: false,
            				success: function(dataResult){
            				    //alert("dataResult");
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
	
    

</script>