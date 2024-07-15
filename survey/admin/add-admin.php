<?php
require_once("classes/cls-admin.php");
$obj_admin = new Admin();
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
if (isset($_GET['admin_id']) && $_GET['admin_id'] != "") {
    $condition = "`admin_id` = '" . base64_decode($_GET['admin_id']) . "'";
    $admin_details = $obj_admin->getAdminDetails('', $condition, '', '', 0);
    $admin_detail = end($admin_details);
} else {
    $admin_detail['status'] = "";
}

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
    .ft-size{
        font-size: 15px;
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
                    <div class="col-lg-12 ft-size">
                        <h3 class="page-header text-primary"><i class="fa fa-user"></i> <?php echo (isset($_GET['admin_id'])) ? "Edit" : "Add"; ?> Admin</h3>
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li><a href="manage-admin.php">Manage Admin</a></li>
                            <li class="active"><?php echo (isset($_GET['admin_id'])) ? "Edit" : "Add"; ?> Admin</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
             <div class="row">
                    <div class="col-lg-12 ft-size">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                General Admin Form
                            </div>
                            <div class="table-responsive">
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form role="form" method="POST" action="add-admin-action.php" enctype="multipart/form-data" name="add-form" id="add-form">
                                                <!-- hidden fields -->
                                                <input type="hidden" name="update_type" id="update_type" value="<?php echo (isset($_GET['admin_id'])) ? "edit" : "add"; ?>">
                                                <input type="hidden" name="admin_id" id="admin_id" value="<?php echo (isset($_GET['admin_id'])) ? $_GET['admin_id'] : ""; ?>">
                                                <!-- / hidden fields -->
                                                <div class="form-group">
                                                    <label>First Name <span class="error">*</span></label>
                                                    <input type="text" class="form-control" name="fname" id="fname" placeholder="First Name" value="<?php echo (isset($admin_detail['f_name'])) ? $admin_detail['f_name'] : ""; ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label>Last Name <span class="error">*</span></label>
                                                    <input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name" value="<?php echo (isset($admin_detail['lname'])) ? $admin_detail['lname'] : ""; ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label>Email Id <span class="error">*</span></label>
                                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email Id" value="<?php echo (isset($admin_detail['email_id'])) ? $admin_detail['email_id'] : ""; ?>">
                                                </div>
                                                <?php if (isset($_GET['admin_id'])) { ?>
                                                    <input type="hidden" class="form-control" name="old_email" id="old_email" value="<?php echo (isset($admin_detail['email_id'])) ? $admin_detail['email_id'] : ""; ?>">
                                                <?php } ?>

                                                <div class="form-group">
                                                    <label>Username <span class="error">*</span></label>
                                                    <input type="text" class="form-control" name="uname" id="uname" placeholder="Username" value="<?php echo (isset($admin_detail['uname'])) ? $admin_detail['uname'] : ""; ?>">
                                                </div>
                                                <?php if (isset($_GET['admin_id'])) { ?>
                                                    <input type="hidden" class="form-control" name="old_uname" id="old_uname" value="<?php echo (isset($admin_detail['uname'])) ? $admin_detail['uname'] : ""; ?>">
                                                <?php } ?>

                                                <div class="form-group">
                                                    <label>Password <span class="error">*</span></label>
                                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo (isset($admin_detail['password'])) ? base64_decode($admin_detail['password']) : ""; ?>">
                                                </div>	

                                                <div class="form-group">
                                                    <label>Confirm Password <span class="error">*</span></label>
                                                    <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Confirm Password" value="<?php echo (isset($admin_detail['password'])) ? base64_decode($admin_detail['password']) : ""; ?>">
                                                </div>
                                                
                                                 <div class="form-group">
                                                    <label>Role <span class="error">*</span></label>
                                                    <select name="role" id="role" class="form-control">
                                                        <option value="">Select Role</option>
                                                        <option value="admin" <?php if(isset($admin_detail['role'])){if($admin_detail['role']=="admin"){?> selected <?php } }?>>Admin</option>
                                                        <option value="research" <?php if(isset($admin_detail['role'])){if($admin_detail['role']=="research"){?> selected <?php } }?>>Research</option>
                                                        <option value="sales" <?php if(isset($admin_detail['role'])){if($admin_detail['role']=="sales"){?> selected <?php } }?>>Sales</option>
                                                        <option value="marketing" <?php if(isset($admin_detail['role'])){if($admin_detail['role']=="marketing"){?> selected <?php } }?>>Marketing</option>
                                                    </select>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <div class="radio">
                                                        <label class="padding-0">
                                                            <input type="radio" name="status" id="status1" value="Active" <?php echo (isset($admin_detail['status']) && $admin_detail['status'] == 'Active'|| $admin_detail['status'] == '' ) ? "checked" : ""; ?>>
                                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                            Active
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label class="padding-0">
                                                            <input type="radio" name="status" id="status2" value="Inactive" <?php echo (isset($admin_detail['status']) && $admin_detail['status'] == 'Inactive') ? "checked" : ""; ?>>
                                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                            Inactive
                                                        </label>
                                                    </div>
                                                    <div id="status-div"></div>
                                                </div>	
                                                <hr>
                                                <button type="submit" class="btn-default">Submit</button>
                                                <button type="reset" class="btn-default">Reset</button>
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
            </div></div>
       </section>
       
       
      
   </div>


 <?php include("footer.php"); ?>

   <script src="bower_components/jquery-validation/jquery.validate.js"></script>
    <script src="js/add-admin.js"></script>
    
    </body>

</html>
