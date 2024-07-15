<?php
require_once("classes/cls-country.php");
require_once("classes/cls-state.php");
$obj_country = new Country();
$obj_state = new State();

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
if (isset($_GET['state_id']) && $_GET['state_id'] != "") {
    $condition = "`state_id` = '" . base64_decode($_GET['state_id']) . "'";
    $state_details = $obj_state->getStateDetails('', $condition, '', '', 0);
    $state_detail = end($state_details);
} else {
    $state_detail['status'] = "";
    $state_detail['country_id'] = "";
}
$condition = "";
$country_details = $obj_country->getCountryDetails('', $condition, '', '', 0);
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
                        <h3 class="page-header text-primary"><i class="fa fa-th-list"></i> <?php echo (isset($_GET['state_id'])) ? "Edit" : "Add"; ?> State</h3>
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li><a href="manage-state.php">Manage State</a></li>
                            <li class="active"><?php echo (isset($_GET['state_id'])) ? "Edit" : "Add"; ?> State</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                General State Form
                            </div>
                            <div class="table-responsive">
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <form role="form" method="POST" action="add-state-action.php" enctype="multipart/form-data" name="add-form" id="add-form">
                                                <!-- hidden fields -->
                                                <input type="hidden" name="update_type" id="update_type" value="<?php echo (isset($_GET['state_id'])) ? "edit" : "add"; ?>">
                                                <input type="hidden" name="state_id" id="state_id" value="<?php echo (isset($_GET['state_id'])) ? $_GET['state_id'] : ""; ?>">
                                                <!-- / hidden fields -->
                                                <div class="form-group">
                                                    <label>Country Name <span class="error">*</span></label>
                                                    <select class="form-control" id="country_id" name="country_id">
                                                        <?php if(isset($country_details) && !empty($country_details)) { ?>
                                                            <?php foreach ($country_details as $country_detail) { ?>
                                                                <option <?php if($country_detail['country_id'] == $state_detail['country_id']) { echo "selected"; } ?> value="<?php echo $country_detail['country_id']; ?>"><?php echo $country_detail['name']; ?></option>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>State Name <span class="error">*</span></label>
                                                    <input type="text" class="form-control" name="name" id="name" placeholder="State Name" value="<?php echo (isset($state_detail['name'])) ? $state_detail['name'] : ""; ?>">
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
    <script src="js/add-state.js"></script>

</body>

</html>
