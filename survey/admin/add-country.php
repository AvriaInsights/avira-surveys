<?php
require_once("classes/cls-country.php");
$obj_country = new Country();
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
if (isset($_GET['country_id']) && $_GET['country_id'] != "") {
    $condition = "`country_id` = '" . base64_decode($_GET['country_id']) . "'";
    $country_details = $obj_country->getCountryDetails('', $condition, '', '', 0);
    $country_detail = end($country_details);
} else {
    $country_detail['status'] = "";
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
                        <h3 class="page-header text-primary"><i class="fa fa-th-list"></i> <?php echo (isset($_GET['country_id'])) ? "Edit" : "Add"; ?> Country</h3>
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li><a href="manage-country.php">Manage Country</a></li>
                            <li class="active"><?php echo (isset($_GET['country_id'])) ? "Edit" : "Add"; ?> Country</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                General Country Form
                            </div>
                            <div class="table-responsive">
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <form role="form" method="POST" action="add-country-action.php" enctype="multipart/form-data" name="add-form" id="add-form">
                                                <!-- hidden fields -->
                                                <input type="hidden" name="update_type" id="update_type" value="<?php echo (isset($_GET['country_id'])) ? "edit" : "add"; ?>">
                                                <input type="hidden" name="country_id" id="country_id" value="<?php echo (isset($_GET['country_id'])) ? $_GET['country_id'] : ""; ?>">
                                                <!-- / hidden fields -->
                                                <div class="form-group">
                                                    <label>Short Code <span class="error">*</span></label>
                                                    <input type="text" class="form-control" name="shortname" id="shortname" placeholder="Country" value="<?php echo (isset($country_detail['shortname'])) ? $country_detail['shortname'] : ""; ?>">
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Country <span class="error">*</span></label>
                                                    <input type="text" class="form-control" name="name" id="name" placeholder="Country" value="<?php echo (isset($country_detail['name'])) ? $country_detail['name'] : ""; ?>">
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Phone Code <span class="error">*</span></label>
                                                    <input type="text" class="form-control" name="phonecode" id="phonecode" placeholder="Country" value="<?php echo (isset($country_detail['phonecode'])) ? $country_detail['phonecode'] : ""; ?>">
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
    <script src="js/add-country.js"></script>

</body>

</html>
