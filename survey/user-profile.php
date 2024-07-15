<?php 
require_once("classes/cls-survey.php");
require_once("classes/cls-user.php");
$obj_user = new User();
$obj_survey = new Survey();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}
$userid=$_SESSION['ifg_admin']['client_id'];
$limit = "6";


/*************** Get User Details **************************/
$fields_user = "*";
$condition = "`tbl_client_user`.`client_id` = '".$userid."'";
$user_details = $obj_user->getUserclientDetails($fields_user, $condition,'','', 0);
 foreach($user_details as $user){
     $fname = $user['fname'];
     $lname = $user['lname'];
     $profile_img = $user['profile_image'];
     $username = $user['uname'];
     $email = $user['email'];
     $phone = $user['phone'];
     $company = $user['company'];
     $pass = $user['password'];
 }
?>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo SITEPATH; ?>css/style.css">
<?php include('dashboard-header-menu.php')?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <?php include('dashboard-side-menubar.php')?>
        </div>
        <div class="col-md-9">
            <section class="content-wrapper">
                <div class="container">
                        <div class="row">
                          <div class="col-md-12">
                              <h3 class="sm-menu-question-header1 mb-0">
                                 User Profile
                              </h3>
                          </div>
                        </div>
                        
                      
                            <div class="table-responsive">
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                        <div class="col-lg-12">
                                            <div class="box-shadow p-5">
                                             <form role="form" method="POST" enctype="multipart/form-data" name="profile-form" id="profile-form" action="update-profile-action.php"> 
                                                <!-- hidden fields -->
                                                 <input type="hidden" name="client_id" id="client_id" value="<?php echo $userid!=""?$userid:""; ?>">
                                                 <input type="hidden" name="client_pass" id="client_pass" value="<?php echo $pass; ?>">
                                                <!-- / hidden fields -->
                                                <div class="row">
                                                    
                                                <div class="col-md-6 offset-md-3 mt-5">
                                                    <div class="img-card bg-white">
                                                       <div class="row">
                                                            <?php if ($profile_img == ""){ ?>
                                                            <img src="<?php echo SITEPATH; ?>upload/default.png" class="profile_img"></img>
                                                            <?php } else { ?>
                                                            <img src="<?php echo $profile_img; ?>" class="profile_img"></img>
                                                            <?php } ?>
                                                        </div>
                                                     
                                                     <div class="row">
                                                          <?php if (isset($_SESSION['success'])) { ?>
                                                          <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                                <?php
                                                                echo $_SESSION['success'];
                                                                unset($_SESSION['success']);
                                                                ?>
                                                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                 </button>
                                                          </div>
                                                         <?php } ?>
                                                         <?php if (isset($_SESSION['error'])) { ?>
                                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                            <?php
                                                            echo $_SESSION['error'];
                                                            unset($_SESSION['error']);
                                                            ?>
                                                             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                             </button>
                                                        </div>
                                                        <?php } ?>
                                                     </div>
                                                    
                                                   
                                                        <div class="col-md-12 header-title">
                                                            <h3 class="mb-0">Personal Information</h3>
                                                        </div>
                                                   
                                                    
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label">First Name <span class="error">*</span></label>
                                                            <input type="text" class="form-control" name="fname" id="fname" placeholder="First Name" value="<?php echo $fname != ""?$fname:""; ?>">
                                                        </div>
                                                    </div>
                                                     <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Last Name <span class="error">*</span></label>
                                                            <input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name" value="<?php echo $lname != "" ? $lname:""; ?>">
                                                        </div>
                                                    </div>
                                                     <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Phone</label>
                                                            <input type="number" class="form-control" name="phone" id="phone" placeholder="Phone Number" value="<?php echo $phone != "" ? $phone:""; ?>">
                                                        </div>
                                                    </div>
                                                     <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Company</label>
                                                            <input type="text" class="form-control" name="company" id="company" placeholder="Company Name" value="<?php echo $company != "" ? $company:""; ?>">
                                                        </div>
                                                    </div>
                                                        
                                                   
                                                        <div class="col-md-12 header-title mt-4">
                                                            <h3 class="mb-0">Account Information</h3>
                                                        </div>
                                                 
                                                    <!-- <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Username <span class="error">*</span></label>
                                                            <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username != "" ? $username:""; ?>" readonly>
                                                        </div>
                                                    </div>-->
                                                     <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Email Id</label>
                                                            <input type="email" class="form-control" name="email" id="email" placeholder="Email Id" value="<?php echo $email != "" ? $email:""; ?>" readonly>
                                                        </div>
                                                    </div>
                                               
                                                    <div class="col-md-12">
                                                          <div class="form-group upload-btn-wrapper">
                                                                <label class="form-label">Change Profile Picture</label>
                                                                <!--<label class="form-label">Change Profile Image</label>-->
                                                                <input type="file" accept="image/*" name="picture" id="picture">
                                                          </div>
                                                    </div>
                                               
                                                   <label class="form-label">Want to Change Password?</label>
                                                        <div class="selectBoxGroup">
                                                          <div class="selectBox">
                                                            <input type="checkbox" name="chk" id="chk-1" class="mt-2" value="Yes">
                                                            <label for="chk-1">
                                                              <strong>Yes</strong>
                                                            </label>  
                                                          </div>
                                                        </div>
                                               
                                                <div class="row" id="pwd_section" style="display:none">
                                                 <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Old Password <span class="error">*</span></label>
                                                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="" onchange="check_password();">
                                                        <div id="old_error" class="error"></div>
                                                    </div>
                                                </div>
                                                 <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label">New Password <span class="error">*</span></label>
                                                        <input type="password" class="form-control" name="npassword" id="npassword" placeholder="Password" value="" onchange="check_password();">
                                                        <div id="new_error" class="error"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Confirm Password <span class="error">*</span></label>
                                                        <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Confirm Password" value="">
                                                    </div>
                                                </div>
                                                </div>
                                                <hr>
                                                <div class="text-center">
                                                    <button type="submit" class="survey-btn">Update</button>
                                                </div>
                                                <!--<button type="reset" class="survey-btn">Reset</button>-->
                                                </div>
                                                </div>
                                                </div>
                                            </form>
                                       
                                        <!-- /.col-lg-6 (nested) -->
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                   
                    <!-- /.col-lg-12 -->
            </div>
       </section>
  </div>
</div>

<?php include('footer.php');?>
  <!-- jQuery -->
        <script src="<?php echo SITEPATHFRONT ?>js/jquery.validate.js"></script>
       
        <script src="<?php echo SITEPATH; ?>bower_components/jquery/dist/jquery.min.js"></script>
        <script src="<?php echo SITEPATH; ?>bower_components/jquery-validation/jquery.validate.js"></script>
         <script src="<?php echo SITEPATH;?>bower_components/chosen/chosen.jquery.js" type="text/javascript"></script>
         <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
         <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
         <script src="<?php echo SITEPATH;?>js/custom.js"></script>
        <script>
        $(document).ready(function(){
            $('#chk-1').click(function(){
                if ($('#chk-1').is(":checked"))
                {
                    $('#pwd_section').show();
                    check_password();
                    
                }
                else
                {
                    $('#pwd_section').hide();
                }
            });
      
        });
        
           $(document).ready(function () {
        
    $.validator.addMethod("requiredIfChecked", function (val, ele, arg) {
    if ($("#chk-1").is(":checked") && ($.trim(val) == '')) { return false; }
    return true;
}, "Password is Required");
        
    jQuery("#profile-form").validate({
        rules: {
            fname: {
                required: true
               
            },
            lname: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                number: true,
                rangelength: [10,12]
            },
            password: {
                 requiredIfChecked: true  
    		},
    		 npassword: {
                 requiredIfChecked: true  
    		},
    		cpassword: {
                required: true,
                equalTo: "#npassword"
            },
           
        },
        messages: {
            fname: {
                required: "First Name is required"
            },
            lname: {
                required: "Last Name is required"
            },
            email: {
                required: "Email Id is required",
                email: "Please enter the valid email id"
            },
            phone: {
                required: "Phone number is required",
                number: "Please enter the valid Phone number",
                rangelength:"Please enter the valid Phone number"
            },
            password: {
                    requiredIfChecked: "Old Password is required"
                },
            npassword:{
                requiredIfChecked: "Please Enter New Password"
            },
            cpassword: {
            required: "Confirm Password is required",
            equalTo: "Please enter correct Confirm Password"
            },
                
        },
       errorElement: "span"
    });
});
        
 

    </script>
