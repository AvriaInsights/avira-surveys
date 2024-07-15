<?php
require_once("classes/cls-user.php");
require_once("classes/cls-country.php");
require_once("classes/cls-state.php");
require_once("classes/cls-city.php");

$obj_user = new User();
$obj_country = new Country();
$obj_state = new State();
$obj_city = new City();

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
if (isset($_GET['user_id']) && $_GET['user_id'] != "") {
    $condition = "`user_id` = '" . base64_decode($_GET['user_id']) . "'";
    $user_details = $obj_user->getUserDetails('', $condition, '', '', 0);
    $user_detail = end($user_details);

    $condition = "`state_id` = '" . $user_detail['state_id'] . "'";
    $state_details = $obj_state->getStateDetails('', $condition, '', '', 0);
    $state_detail = end($state_details);

    $condition = "`city_id` = '" . $user_detail['city_id'] . "'";
    $city_details = $obj_city->getCityDetails('', $condition, '', '', 0);
    $city_detail = end($city_details);
}
$condition = "";
$country_details = $obj_country->getCountryDetails('', $condition, '', '', 0);

?>
<style>
    .leads-count1{
        padding: 0.1rem;
    border-radius: 0.5rem;
    color: #fff;
    }
    .row1{
        margin-left:-10px;
        margin-right:-10px;
    }
    .marq{
        margin:10px;
    }

</style>
<link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
        select.input-sm {
    height: 30px;
    line-height: 22px;
    }
    div.dataTables_length label
    {
        font-size: 13px;
    }
    div.dataTables_filter label{
        font-size: 14px;
    }
    .table>:not(:first-child){
        font-size: 14px;
    }
</style>
<div class="wrapper">
   <?php include("sidebarmenu.php")?>
        <?php include("header.php")?>
        <section class="content-wrapper">
            <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
             <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header text-primary"><i class="fa fa-user"></i> <?php echo (isset($_GET['user_id'])) ? "Edit" : "Add"; ?> User</h3>
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li><a href="manage-user.php">Manage User</a></li>
                            <li class="active"><?php echo (isset($_GET['user_id'])) ? "Edit" : "Add"; ?> User</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
             <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                General User Form
                            </div>
                            <div class="table-responsive">
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form role="form" method="POST" action="add-user-action.php" enctype="multipart/form-data" name="add-form" id="add-form">
                                                <!-- hidden fields -->
                                                <input type="hidden" name="update_type" id="update_type" value="<?php echo (isset($_GET['user_id'])) ? "edit" : "add"; ?>">
                                                <input type="hidden" name="user_id" id="user_id" value="<?php echo (isset($_GET['user_id'])) ? $_GET['user_id'] : ""; ?>">
                                                <!-- / hidden fields -->
                                                <div class="form-group">
                                                    <label>First Name <span class="error">*</span></label>
                                                    <input type="text" class="form-control" name="fname" id="fname" placeholder="First Name" value="<?php echo (isset($user_detail['fname'])) ? $user_detail['fname'] : ""; ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label>Last Name <span class="error">*</span></label>
                                                    <input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name" value="<?php echo (isset($user_detail['lname'])) ? $user_detail['lname'] : ""; ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label>Email Id <span class="error">*</span></label>
                                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email Id" value="<?php echo (isset($user_detail['email'])) ? $user_detail['email'] : ""; ?>">
                                                </div>
                                                <?php if (isset($_GET['user_id'])) { ?>
                                                    <input type="hidden" class="form-control" name="old_email" id="old_email" value="<?php echo (isset($user_detail['email'])) ? $user_detail['email'] : ""; ?>">
                                                <?php } ?>

                                                <div class="form-group">
                                                    <label>Phone <span class="error">*</span></label>
                                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" value="<?php echo (isset($user_detail['phone'])) ? $user_detail['phone'] : ""; ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label>Address <span class="error">*</span></label>
                                                    <textarea class="form-control" name="address" id="address" placeholder="Address"></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label>Country <span class="error">*</span></label>
                                                    <select class="form-control" id="country_id" name="country_id">
                                                        <?php if (isset($country_details) && !empty($country_details)) { ?>
                                                            <?php foreach ($country_details as $country_detail) { ?>
                                                                <option value="<?php echo $country_detail['country_id'] ?>" <?php if (isset($user_detail['country_id']) && $user_detail['country_id'] == $country_detail['country_id']) { ?> selected="selected" <?php } ?>><?php echo $country_detail['name'] ?></option>
                                                            <?php } ?>
                                                        <?php } else { ?>
                                                            <option value="">No Results Found</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>State <span class="error">*</span></label>
                                                    <select class="form-control" id="state_id" name="state_id">
                                                        <?php if (isset($state_detail) && !empty($state_detail)) { ?>
                                                            <option value="<?php echo $state_detail['state_id'] ?>" <?php if (isset($user_detail['state_id']) && $user_detail['state_id'] == $state_detail['state_id']) { ?> selected="selected" <?php } ?>><?php echo $state_detail['name'] ?></option>
                                                        <?php } else { ?>
                                                            <option value="">Select State</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>



                                                <div class="form-group">
                                                    <label>City <span class="error">*</span></label>
                                                    <select class="form-control" id="city_id" name="city_id">
                                                        <?php if (isset($city_detail) && !empty($city_detail)) { ?>
                                                            <option value="<?php echo $city_detail['city_id'] ?>" <?php if (isset($user_detail['city_id']) && $user_detail['city_id'] == $city_detail['city_id']) { ?> selected="selected" <?php } ?>><?php echo $city_detail['name'] ?></option>
                                                        <?php } else { ?>
                                                            <option value="">Select State</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Zipcode <span class="error">*</span></label>
                                                    <input type="text" class="form-control" name="zipcode" id="zipcode" placeholder="Zipcode" value="<?php echo (isset($user_detail['zipcode'])) ? $user_detail['zipcode'] : ""; ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label>Password <span class="error">*</span></label>
                                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo (isset($user_detail['password'])) ? base64_decode($user_detail['password']) : ""; ?>">
                                                </div>	

                                                <div class="form-group">
                                                    <label>Confirm Password <span class="error">*</span></label>
                                                    <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Confirm Password" value="<?php echo (isset($user_detail['password'])) ? base64_decode($user_detail['password']) : ""; ?>">
                                                </div>	

                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <div class="radio">
                                                        <label class="padding-0">
                                                            <input type="radio" name="status" id="status1" value="Active" <?php echo (isset($user_detail['status']) && $user_detail['status'] == 'Active') ? "checked" : ""; ?>>
                                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                            Active
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label class="padding-0">
                                                            <input type="radio" name="status" id="status2" value="Inactive" <?php echo (isset($user_detail['status']) && $user_detail['status'] == 'Inactive') ? "checked" : ""; ?>>
                                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                            Inactive
                                                        </label>
                                                    </div>
                                                    <div id="status-div"></div>
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
            </div></div>
       </section>
       
       
      
   </div>


 <?php include("footer.php"); ?>

   <script src="bower_components/jquery-validation/jquery.validate.js"></script>
    <script src="js/add-user.js"></script>
    
    </body>

</html>
