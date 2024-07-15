<?php
require_once("classes/cls-admin.php");
include("header.php");
if (!isset($_SESSION['ifg_admin']) && ($_SESSION['ifg_admin']['role'] != "superadmin" || $_SESSION['ifg_admin']['role'] != "admin")) {
    header("Location:login.php");
}

$obj_admin = new Admin();
if (isset($_SESSION['ifg_admin']['admin_id']) && $_SESSION['ifg_admin']['admin_id'] != "") {
    $condition = "`admin_id` = '" . $_SESSION['ifg_admin']['admin_id'] . "'";
    $admin_details = $obj_admin->getAdminDetails('', $condition, '', '', 0);
    $admin_detail = end($admin_details);
} else {
    header("Location:404.php");
}
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
                        <h3 class="page-header text-primary"><i class="fa fa-user"></i> View Profile</h3>
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li class="active">View Profile</li>
                        </ol>
                        <?php if (isset($_SESSION['success'])) { ?>
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php
                                echo $_SESSION['success'];
                                unset($_SESSION['success']);
                                ?>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Profile Details
                            </div>
                            <div class="table-responsive">
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="dataTable_wrapper">
                                        <dl class="dl-horizontal">
                                            <dt>Profile Image</dt>
                                            <dd><img height="200" width="200" src="<?php echo $admin_detail['profile_image']; ?>" class="img-thumbnail img-circle"></dd>
                                            <dt>First Name</dt>
                                            <dd><?php echo $admin_detail['fname']; ?></dd>
                                            <dt>Last Name</dt>
                                            <dd><?php echo $admin_detail['lname']; ?></dd>
                                            <dt>Username</dt>
                                            <dd><?php echo $admin_detail['uname']; ?></dd>
                                            <dt>Email Address</dt>
                                            <dd><?php echo $admin_detail['email']; ?></dd>
                                            <dt>Created At</dt>
                                            <dd><?php echo date("F j, Y h:i A", strtotime($admin_detail['created_at'])); ?></dd>
                                            <dt>Updated At</dt>
                                            <dd><?php echo date("F j, Y h:i A", strtotime($admin_detail['updated_at'])); ?></dd>
                                        </dl>
                                        <hr />
                                        <a class="btn btn-sm btn-primary" href="update-profile.php"><i class="fa fa-edit"></i> Edit</a>
                                    </div>
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

</body>

</html>
