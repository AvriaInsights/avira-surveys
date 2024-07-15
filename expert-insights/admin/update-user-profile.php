<?php
require_once("classes/cls-admin.php");
$obj_admin = new Admin();
$conn = $obj_admin->getConnectionObj();
if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}
if (isset($_SESSION['ifg_admin']['admin_id']) && $_SESSION['ifg_admin']['admin_id'] != "") {
    $condition = "`admin_id` = '" . $_SESSION['ifg_admin']['admin_id'] . "'";
    $admin_details = $obj_admin->getAdminDetails('', $condition, '', '', 0);
    $admin_detail = end($admin_details);
} 
else {
    header("Location:404.php");
}
?>
<style>
     .field-icon {
  float: right;
  margin-left: -25px;
  margin-top: -25px;
  position: relative;
  z-index: 2;
  margin-right: 0.5rem;
}
</style>
<?php include('header.php')?>
<?php include('sidebar-menu.php')?>

<div class="home-section">
    <?php include("top-bar.php"); ?>
    <section class="common-space pt-0">
        <div class="container">
            <div class="row">
                <div class="col-md-6 p-0">
                    <div class="support-img pt-10">
                        <img src="images/Support-Page-Infographic.svg" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-6 ">
                    <div class="support-box-form">

                        <h4 class="page-header s_ttl">Update Profile</h4>
                        
                        <form role="form" method="POST" action="" class="lead-info-form" enctype="multipart/form-data" name="profile-update-form" id="profile-update-form">
                            <input type=hidden id="user_id" name="user_id" value="<?php echo $admin_detail['admin_id']; ?>">
                            <input type="hidden" name="client_pass" id="client_pass" value="<?php echo $admin_detail['password'];?>">
                            <input type="hidden" name="siteurl" id="siteurl" value="<?php echo SITEPATH;?>">
                            <div class="row mt-2">
                                <div class="col-lg-12">
                                     
                                    <div class="form-group">
                                        <label>First Name<span class="error">*</span></label>
                                        <input type="text" class="form-control" name="fname" id="fname" placeholder="" value="<?php echo isset($admin_detail['f_name'])?$admin_detail['f_name']:""; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Last Name<span class="error">*</span></label>
                                            <input type="text" class="form-control" name="lname" id="lname" placeholder="" value="<?php echo isset($admin_detail['lname'])?$admin_detail['lname']:""; ?>">
                                        </div>
                                </div>
                                <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Email Id <span class="error">*</span></label>
                                            <input type="email" class="form-control bg-light" name="email" id="email" placeholder="" value="<?php echo isset($admin_detail['email_id'])?$admin_detail['email_id']:""; ?>" disabled>
                                        </div>
                                </div>
                                <?php
                                if ((isset($_SESSION['ifg_admin']['admin_id']) && $_SESSION['ifg_admin']['admin_id'] != "") && ($_SESSION['ifg_admin']['role'] == "superadmin")) {
                                ?>
                                 <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Want to Change Password?</label>
                                            <input type="checkbox" name="chk" id="chk-1" class="mt-2 ml-2" value="Yes">
                                            <label for="chk-1">
                                              <strong>Yes</strong>
                                            </label>
                                        </div>
                                </div>
                                <div class="container-fluid" id="pwd_section" style="display:none">
                                <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Old Password<span class="error">*</span></label>
                                            <input type="password" class="form-control" name="password" id="password" placeholder="" value="">
                                        </div>
                                </div>
                                <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>New Password<span class="error">*</span></label>
                                            <input type="password" class="form-control" name="npassword" id="npassword" placeholder="" value="">
                                            <span toggle="#password-field" class="fa fa-fw fa-eye-slash field-icon toggle-password" id="eye"></span>
                                        </div>
                                </div>
                                <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Confirm Password <span class="error">*</span></label>
                                            <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="" value="">
                                        </div>
                                </div>
                                </div>
                                <?php } ?>
                               <!--<div class="col-lg-12">
                                       <label class="form-label">Profile Image</label>
                                       <input type="file" accept="image/*" name="picture" id="picture">
                                </div>-->
            
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <div class="text-center">
                                            <button type="submit" class="btn s-btn" id="btn_update_profile" name="btn_update_profile">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
   
</div>

 <?php include("footer.php"); ?>   
<script src="bower_components/jquery-validation/jquery.validate.js"></script>
<script src="js/user-profile.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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

$(document).ready(function(){
    $('#chk-1').click(function(){
        if ($('#chk-1').is(":checked"))
        {
            $('#pwd_section').show();
        }
        else
        {
            $('#pwd_section').hide();
        }
    });
    
$(function(){
  $('#eye').click(function(){
      
        if($(this).hasClass('fa-eye')){
           
          $(this).removeClass('fa-eye');
          
          $(this).addClass('fa-eye-slash');
          
          $('#npassword').attr('type','password');
            
        }else{
         
          $(this).removeClass('fa-eye-slash');
          
          $(this).addClass('fa-eye');  
          
          $('#npassword').attr('type','text');
        }
    });
});
});

</script>    
 