<?php
require_once("classes/cls-user.php");

$obj_user = new User();
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
if (isset($_GET['user_id']) && $_GET['user_id'] != "") {
    $condition = "`user_id` = '" . base64_decode($_GET['user_id']) . "'";
    $user_details = $obj_user->getUserDetails('', $condition, '', '', 0);
    $user_detail = end($user_details);    
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
                    <div class="col-lg-12">
                        <h3 class="page-header text-primary"><i class="fa fa-user"></i> View User</h3>
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li><a href="manage-user.php">Manage User</a></li>
                            <li class="active">View User</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
             <div class="row">
                    <div class="col-lg-12">
                     <div class="panel panel-default">
                            <div class="panel-heading">
                                User Details
                            </div>
                            <div class="table-responsive">
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="dataTable_wrapper">
                                        <dl class="dl-horizontal">
                                            <dt>Full Name</dt>
                                            <dd><?php echo ucfirst($user_detail['fname']) . " " . ucfirst($user_detail['lname']); ?></dd>
                                            <dt>Email</dt>
                                            <dd><?php echo $user_detail['email']; ?></dd>
                                            <dt>Phone</dt>
                                            <dd><?php echo $user_detail['phone']; ?></dd>
                                            <dt>Zipcode</dt>
                                            <dd><?php echo $user_detail['zipcode']; ?></dd>
                                            <dt>Address</dt>
                                            <dd><?php echo $user_detail['address']; ?></dd>
                                            <dt>Status</dt>
                                            <dd><?php echo $user_detail['status']; ?></dd>
                                            <dt>Updated On</dt>
                                            <dd><?php echo date("F j, Y h:i A", strtotime($user_detail['updated_at'])); ?></dd>
                                            <dt>Created On</dt>
                                            <dd><?php echo date("F j, Y h:i A", strtotime($user_detail['created_at'])); ?></dd>
                                        </dl>
                                        <hr />
                                        <a class="btn btn-sm btn-primary" href="manage-user.php"><i class="fa fa-chevron-left"></i> Go Back</a>
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

   