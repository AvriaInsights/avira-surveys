<?php
require_once("classes/cls-admin.php");
if (!isset($_SESSION['ifg_admin']) && ($_SESSION['ifg_admin']['role'] != "superadmin" || $_SESSION['ifg_admin']['role'] != "admin")) {
    header("Location:login.php");
}
$obj_admin = new Admin();
/*if (isset($_SESSION['ifg_admin']['client_id']) && $_SESSION['ifg_admin']['client_id'] != "") {
    $condition = "`client_id` = '" . $_SESSION['ifg_admin']['client_id'] . "'";
    $admin_details = $obj_admin->getAdminDetails('', $condition, '', '', 0);
    $admin_detail = end($admin_details);
} else {
    header("Location:404.php");
}*/
include("header.php");
?>

<body>

    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <?php include("top-bar.php"); ?>
            <!-- /.navbar-top-links -->

            <?php include("side-bar.php"); ?>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header text-primary"><i class="fa fa-edit"></i> Update Profile</h3>
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li class="active">Update Profile</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Account Details
                            </div>
                            <div class="table-responsive">
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form role="form" method="POST" action="update-profile-action.php" enctype="multipart/form-data" name="add-form" id="add-form">
                                                <!-- hidden fields -->
                                                <input type="hidden" name="admin_id" id="admin_id" value="<?php echo isset($admin_detail['admin_id'])?base64_encode($admin_detail['admin_id']):""; ?>">
                                                <!-- / hidden fields -->
                                                <div class="form-group">
                                                    <label>First Name <span class="error">*</span></label>
                                                    <input type="text" class="form-control" name="fname" id="fname" placeholder="First Name" value="<?php echo isset($admin_detail['fname'])?$admin_detail['fname']:""; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Last Name <span class="error">*</span></label>
                                                    <input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name" value="<?php echo isset($admin_detail['lname'])?$admin_detail['lname']:""; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Username <span class="error">*</span></label>
                                                    <input type="text" class="form-control" name="uname" id="uname" placeholder="Username" value="<?php echo isset($admin_detail['uname'])?$admin_detail['uname']:""; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Email Id <span class="error">*</span></label>
                                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email Id" value="<?php echo isset($admin_detail['email'])?$admin_detail['email']:""; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Password <span class="error">*</span></label>
                                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo isset($admin_detail['password'])?base64_decode($admin_detail['password']):""; ?>">
                                                </div>				
                                                <div class="form-group">
                                                    <label>Confirm Password <span class="error">*</span></label>
                                                    <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Confirm Password" value="<?php echo isset($admin_detail['password'])?base64_decode($admin_detail['password']):""; ?>">
                                                </div>		
                                                <div class="form-group">
                                                    <label>Profile Picture</label>
                                                    <input type="file" accept="image/*" name="picture" id="picture">
                                                </div>
                                                <hr>
                                                <button type="submit" class="btn btn-default">Submit</button>
                                                <button type="reset" class="btn btn-default">Reset</button>
                                            </form>
                                        </div>
                                        <!-- /.col-lg-6 (nested) -->
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <?php include("footer.php"); ?>
    <script src="bower_components/jquery-validation/jquery.validate.js"></script>
    <script src="bower_components/jquery-validation/additional-methods.js"></script>
    <script src="js/update-profile.js"></script>
</body>

</html>
