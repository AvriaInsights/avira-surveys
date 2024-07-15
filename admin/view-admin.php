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
    header("Location:404.php");
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
    .ft-size{
        font-size: 15px;
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
             <div class="row">
                    <div class="col-lg-12 ft-size">
                        <h3 class="page-header text-primary"><i class="fa fa-user"></i> View Admin</h3>
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li><a href="manage-admin.php">Manage Admin</a></li>
                            <li class="active">View Admin</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
             <div class="row">
                    <div class="col-lg-12 ft-size">
                     <div class="panel panel-default">
                            <div class="panel-heading">
                                User Details
                            </div>
                            <div class="table-responsive">
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="dataTable_wrapper">
                                        <dl class="dl-horizontal">
                                            <dt>Profile Image</dt>
                                            <dd><img height="200" width="200" src="<?php echo $admin_detail['profile_image']; ?>" class="img-thumbnail img-circle"></dd>
                                            <dt>Full Name</dt>
                                            <dd><?php echo ucfirst($admin_detail['f_name']) . " " . ucfirst($admin_detail['lname']); ?></dd>
                                            <dt>Email</dt>
                                            <dd><?php echo $admin_detail['email_id']; ?></dd>
                                            <dt>Role</dt>
                                            <dd><?php echo $admin_detail['role']; ?></dd>
                                            <dt>Username</dt>
                                            <dd><?php echo $admin_detail['uname']; ?></dd>
                                            <dt>Status</dt>
                                            <dd><?php echo $admin_detail['status']; ?></dd>
                                            <dt>Updated On</dt>
                                            <dd><?php echo date("j M Y h:i A", strtotime($admin_detail['updated_at'])); ?></dd>
                                            <dt>Created On</dt>
                                            <dd><?php echo date("j M Y h:i A", strtotime($admin_detail['created_at'])); ?></dd>
                                        </dl>
                                        <hr />
                                        <a class="btn btn-sm btn-primary" href="manage-admin.php"><i class="fa fa-chevron-left"></i> Go Back</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
            </div>
       </section>
       
       
      
   </div>


 <?php include("footer.php"); ?>

   