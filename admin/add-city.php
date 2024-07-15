<?php
require_once("classes/cls-country.php");
require_once("classes/cls-state.php");
require_once("classes/cls-city.php");

$obj_country = new Country();
$obj_state = new State();
$obj_city = new City();

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
if (isset($_GET['city_id']) && $_GET['city_id'] != "") {
    $condition = "`city_id` = '" . base64_decode($_GET['city_id']) . "'";
    $city_details = $obj_city->getCityDetails('', $condition, '', '', 0);
    $city_detail = end($city_details);
    
    $condition = "`state_id` = '".$city_detail['state_id']."'";
    $state_info = $obj_state->getSingleStateDetail('', $condition, '', '', 0);
    
} else {
    $city_detail['status'] = "";
    $state_info['country_id'] = "";
    $city_detail['state_id'] = "";
}
$condition = "";
$country_details = $obj_country->getCountryDetails('', $condition, '', '', 0);

$condition = "";
$state_details = $obj_state->getStateDetails('', $condition, '', '', 0);
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
                        <h3 class="page-header text-primary"><i class="fa fa-th-list"></i> <?php echo (isset($_GET['city_id'])) ? "Edit" : "Add"; ?> City</h3>
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li><a href="manage-city.php">Manage City</a></li>
                            <li class="active"><?php echo (isset($_GET['city_id'])) ? "Edit" : "Add"; ?> City</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                General City Form
                            </div>
                            <div class="table-responsive">
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <form role="form" method="POST" action="add-city-action.php" enctype="multipart/form-data" name="add-form" id="add-form">
                                                <!-- hidden fields -->
                                                <input type="hidden" name="update_type" id="update_type" value="<?php echo (isset($_GET['city_id'])) ? "edit" : "add"; ?>">
                                                <input type="hidden" name="city_id" id="city_id" value="<?php echo (isset($_GET['city_id'])) ? $_GET['city_id'] : ""; ?>">
                                                <!-- / hidden fields -->
                                                <div class="form-group">
                                                    <label>Country Name <span class="error">*</span></label>
                                                    <select class="form-control" id="country_id" name="country_id">
                                                        <option value="">Select Country</option>
                                                        <?php if(isset($country_details) && !empty($country_details)) { ?>
                                                            <?php foreach ($country_details as $country_detail) { ?>
                                                                <option <?php if($state_info['country_id'] == $country_detail['country_id']) { echo "selected"; } ?> value="<?php echo $country_detail['country_id']; ?>"><?php echo $country_detail['name']; ?></option>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>State Name <span class="error">*</span></label>
                                                    <select class="form-control" id="state_id" name="state_id">
                                                        <?php if(isset($state_details) && !empty($state_details) && isset($city_detail['state_id']) && $city_detail['state_id'] != "") { ?>
                                                            <?php foreach ($state_details as $state_detail) { ?>
                                                                <option <?php if($state_detail['state_id'] == $city_detail['state_id']) { echo "selected"; } ?> value="<?php echo $state_detail['state_id']; ?>"><?php echo $state_detail['name']; ?></option>
                                                            <?php } ?>
                                                        <?php } else { ?>
                                                                <option value="">Select State</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>City Name <span class="error">*</span></label>
                                                    <input type="text" class="form-control" name="name" id="name" placeholder="City Name" value="<?php echo (isset($city_detail['name'])) ? $city_detail['name'] : ""; ?>">
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
    <script src="js/add-city.js"></script>

</body>

</html>
