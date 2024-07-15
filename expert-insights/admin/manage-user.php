<?php
require_once("classes/cls-admin.php");
require_once('classes/cls-pagination.php');
$obj_admin = new Admin();
$obj_pagination = new Pagination();

//if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}
//print_r($_SESSION['ifg_admin']);
$fields = "*";
$condition = "`tbl_admin`.`admin_id` = '".$_SESSION['ifg_admin']['admin_id']."'";
$admin_details = $obj_admin->getAdminDetails($fields, $condition, '', '', 0);
foreach($admin_details as $admin_detail)
{
    $usercnt=$admin_detail['user_cnt'];
    $paymentstatus=$admin_detail['payment_status']; 
}
?>
<style>
input[type="checkbox"] {
	 height: 0;
	 width: 0;
	 visibility: hidden;
}
 .toglabel {
	 cursor: pointer;
	 text-indent: -9999px;
	 width: 44px;
	 height: 25px;
	 background: #f81708;
	 display: block;
	 border-radius: 100px;
	 position: relative;
	 content: "No";
	 color:#fff;
	 margin-top: -11px;
	 overflow:hidden;
}
 .toglabel:after {
	 content: "No";
	 position: absolute;
	 top: 3px;
	 left: 5px;
	 width: 18px;
	 height: 18px;
	 background: #fff;
	 border-radius: 90px;
	 transition: 0.3s;
}
 input:checked + .toglabel {
	 background: #34a615;
	  
}
 input:checked + .toglabel:after {
	 left: calc(100% - 5px);
	 transform: translateX(-100%);
}
 .toglabel:active:after {
	 width: 130px;
}
</style>
<?php include('header.php')?>
<?php include('sidebar-menu.php')?>
    <div class="home-section">
        <?php include("top-bar.php"); ?>
        <section class="common-space pt-3_7">
        <div class="container">
            <div class="row d-flex align-items-center pb-3 light-bg">
                <div class="col-md-3">
                    <h5 class="page-header"><i class="fa fa-user"></i> Manage User List</h5>
                    <!--<ol class="breadcrumb">
                        <li><a href="index.php">Dashboard</a></li>
                        <li class="active">Manage User</li>
                    </ol>-->
                    <?php if (isset($_SESSION['success'])) { ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <?php
                            echo $_SESSION['success'];
                            unset($_SESSION['success']);
                            ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    <?php } elseif (isset($_SESSION['error'])) { ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <?php
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                            ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    <?php } ?>
                </div>
                <div class="col-md-9">
                    <?php if($paymentstatus=="Unpaid"){?>
                    <?php if($usercnt>=3){?>
                    <a href="javascript:void(0);" class="btn s-btn float-end" onclick="payalert();"><i class="fa fa-plus-circle"></i> Add New User</a>
                    <?php } else {?>
                    <a href="<?php echo SITEADMIN; ?>add-user" class="btn s-btn float-end"><i class="fa fa-plus-circle"></i> Add New User</a>
                    <?php } }?>
                    <?php if($paymentstatus=="Paid"){?>
                    <a href="<?php echo SITEADMIN; ?>add-user" class="btn s-btn float-end"><i class="fa fa-plus-circle"></i> Add New User</a>
                    <?php }?>
                </div>
                    <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="table-responsive bg-white position-relative" id="target-content">
                       
                    </div>
                </div>
            </div>
        </div>
   </section>
    </div>
<?php include('footer.php') ?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   <script type="text/javascript">
        $(document).ready(function () {
         $.ajax({
				url: "<?php echo SITEADMIN; ?>user-listing-pegination.php",
				type: "GET",
				data: {
					page : "1"
				},
				cache: false,
			    beforeSend: function(){
                },
				success: function(dataResult){
				    //alert(dataResult);
				   // $("#loader1").hide();
					$("#target-content").html(dataResult);
					$(".pageitem").removeClass("active");
					$("#1").addClass("active");
				}
			});
        });
        function action_published(adminid)
            {
                alert();
            $.ajax({
                  url : "update-admin-status-published.php",
                  type : "POST",
                  data : {adminid:adminid},
                  success: function(data){
                  }
            });
            }
    </script>
<script>
  let arrow = document.querySelectorAll(".arrow");
for (var i = 0; i < arrow.length; i++) {
  arrow[i].addEventListener("click", (e)=>{
 let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
 arrowParent.classList.toggle("showMenu");
  });
}
let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".fa-bars");
sidebarBtn.addEventListener("click",()=>{
  sidebar.classList.toggle("close");
});
function payalert()
{
    swal("Oops!", "You can not add user as your limit of 3 users is done!", "error");  
    //  swal({
//                 text: "Thank you for Contact us, Our Team will contact you soon.",
//                 icon: "success",
//                 showConfirmButton: true,
//                 confirmButtonColor: '#04AA26',
//                 position: "center",
//             })
}
</script>