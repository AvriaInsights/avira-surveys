<?php
require_once("classes/cls-client-logo.php");

$obj_logo = new Logo();

if (!isset($_SESSION['ifg_admin']) && ($_SESSION['ifg_admin']['role'] != "superadmin" || $_SESSION['ifg_admin']['role'] != "admin")) {
    header("Location:login.php");
}

if (isset($_GET['logo_id']) && $_GET['logo_id'] != "") {
    $condition = "`logo_id` = '" . base64_decode($_GET['logo_id']) . "'";
    $logo_details = $obj_logo->getLogoDetails('', $condition, '', '', 0);
    $logo_detail = end($logo_details);
} 
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
                        <h3 class="page-header text-primary"><i class="fa fa-user"></i> <?php echo (isset($_GET['logo_id'])) ? "Edit" : "Add"; ?> Client Logo</h3>
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li><a href="manage-client-logo.php">Manage Client Logo</a></li>
                            <li class="active"><?php echo (isset($_GET['logo_id'])) ? "Edit" : "Add"; ?> Client Logo</li>
                        </ol>
                        <?php if (isset($_SESSION['success'])) { ?>
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php
                                echo $_SESSION['success'];
                                unset($_SESSION['success']);
                                ?>
                            </div>
                        <?php } elseif (isset($_SESSION['error'])) { ?>
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php
                                echo $_SESSION['error'];
                                unset($_SESSION['error']);
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
                                General Client Logo Form
                            </div>
                            <div class="table-responsive">
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form role="form" method="POST" action="add-client-logo-action.php" enctype="multipart/form-data" name="add-form" id="add-form">
                                                <!-- hidden fields -->
                                                <input type="hidden" name="update_type" id="update_type" value="<?php echo (isset($_GET['logo_id'])) ? "edit" : "add"; ?>">
                                                <input type="hidden" name="logo_id" id="logo_id" value="<?php echo (isset($_GET['logo_id'])) ? $_GET['logo_id'] : ""; ?>">
                                                <!-- / hidden fields -->	
                                                <div class="form-group">
                                                    <label>Add Client Logo</label>
                                                    <input type="file" accept="image/*" name="logo" id="logo">
                                                </div>
												
                                                <div class="form-group">
                                                    <label>Client Name <span class="error">*</span></label>
                                                    <input type="text" class="form-control" name="client_name" id="client_name" placeholder="Client Name" value="<?php echo (isset($logo_detail['client_name'])) ? $logo_detail['client_name'] : ""; ?>">
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
    <script src="js/add-client-logo.js"></script>

</body>

</html>
