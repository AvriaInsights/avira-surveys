<?php 
require_once("classes/cls-admin.php");
$obj_admin = new Admin();

if (isset($_SESSION['ifg_admin']['admin_id']) && $_SESSION['ifg_admin']['admin_id'] != "") {
    $condition = "`admin_id` = '" . $_SESSION['ifg_admin']['admin_id'] . "'";
    $admin_details = $obj_admin->getAdminDetails('', $condition, '', '', 0);
    $admin_detail = end($admin_details);
} 
else {
    header("Location:login");
}

?>
             
                    <div class="home-content">
                        <div class="click-icon">
                            <i class="fa fa-bars"></i>
                            <span class="text-white text"></span>
                        </div>
                        <div class=" navbar-collapse d-nav-menu">
                        <ul class="list-unstyled ms-auto d-flex align-items-center mb-0 top-header-user-info" id="header-log">
                                                 
                            <!--<li class="nav-item">
                            <!-- <i class="fa fa-cog setting"></i>-->
                            <!--</li>-->
                            <li>
                                <div class="user-info">
                                    <span><h6><?php echo isset($admin_detail['f_name'])?$admin_detail['f_name']:""; ?> <?php echo isset($admin_detail['lname'])?$admin_detail['lname']:""; ?></h6></span>
                                    <span><p class="mb-0 fw-light"><?php echo isset($admin_detail['role'])?ucfirst($admin_detail['role']):""; ?></p></span>
                                </div>
                            </li>
                            <div class="header-rigth ps-2">
                                <ul class="list-unstyled right-nav-menu">
                                    <li class="dropdown">
                                        <div class="user-profile">
                                            
                                            <a href="#" class="dropdown-toggle p-0 text-white" id="vnn-click"> 
                                                <img src="<?php echo $admin_detail['profile_image']; ?>" class="img-fluid rounded-circle"></img>
                                            </a>
                                            <ul class="dropdown-menu user-profile-dropdown" aria-labelledby="dropdownMenuButton2" id="vnn-info">
                                                <li>
                                                    <a class="dropdown-item" href="<?php echo SITEADMIN; ?>update-user-profile">
                                                       <i class="fa fa-user text-dark"></i> Profile</a>
                                                    </li>
                                                <li>
                                                    <a class="dropdown-item" href="<?php echo SITEADMIN; ?>logout">
                                                        <i class="fa fa-sign-out text-dark"></i>
                                                        Logout
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </ul>
                    </div>
                    </div>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
                    <?php include('footer.php')?>
    <script>
     $(document).ready(function(){
        /*$("#vn-info").hide();*/
            $("#vnn-click").click(function(){
                $("#vnn-info").slideToggle(300);
            });
            
            $(".click-icon").click(function(){
                var sideclass = $('#sidebar_set').attr('class');
                if(sideclass=="sidebar")
                {
                    //alert("d");top-header-user-info
                    $("#header-log").addClass("top-header-user-info");
                    $("#header-log").removeClass("top-header-user-info-close");
                }
                if(sideclass=="sidebar close")
                {
                    //alert("c");
                    $("#header-log").addClass("top-header-user-info-close");
                    $("#header-log").removeClass("top-header-user-info");
                }
            });
            
        });
        
       
       
  </script>