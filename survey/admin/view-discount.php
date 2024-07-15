<?php
require_once("classes/cls-discount.php");

$obj_discount = new Discount();
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
if (isset($_GET['discount_id']) && $_GET['discount_id'] != "") {
    $fields = "`tbl_discount`.*, `tbl_report`.`title`";
    $condition = "`tbl_discount`.`discount_id` = '" . base64_decode($_GET['discount_id']) . "'";
    $discount_details = $obj_discount->getFullDiscountDetails($fields, $condition, '', 1, 0);
    $discount_detail = end($discount_details);
    if(isset($discount_detail) && !empty($discount_detail)) {
        $update_data['status'] = "Seen";
        $update_data['updated_at'] = date("Y-m-d H:i:s");
        
        $obj_discount->updateDiscount($update_data, $condition, 0);
    }
    
} else {
    header("Location:404.php");
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
                        <h3 class="page-header text-primary"><i class="fa fa-gift"></i> View Sample Discount</h3>
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li><a href="manage-discount.php">Manage Discount</a></li>
                            <li class="active">View Discount</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Discount Details
                            </div>
                            <div class="table-responsive">
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="dataTable_wrapper">
                                        <dl class="dl-horizontal">
                                            <dt>Report</dt>
                                            <dd><?php echo $discount_detail['title']; ?></dd>
                                            <dt>Full Name</dt>
                                            <dd><?php echo ucfirst($discount_detail['fname']); ?></dd>
                                            <dt>Email</dt>
                                            <dd><?php echo $discount_detail['email']; ?></dd>
                                            <dt>Phone</dt>
                                            <dd><?php echo $discount_detail['phone']; ?></dd>
                                            <dt>Job Title</dt>
                                            <dd><?php echo $discount_detail['job_title']; ?></dd>
                                            <dt>Company</dt>
                                            <dd><?php echo $discount_detail['company']; ?></dd>
                                            <dt>Comment</dt>
                                            <dd><?php echo $discount_detail['comment']; ?></dd>
                                            <dt>Status</dt>
                                            <dd><?php echo $discount_detail['status']; ?></dd>
                                            <dt>Updated On</dt>
                                            <dd><?php echo date("F j, Y h:i A", strtotime($discount_detail['updated_at'])); ?></dd>
                                            <dt>Created On</dt>
                                            <dd><?php echo date("F j, Y h:i A", strtotime($discount_detail['created_at'])); ?></dd>
                                        </dl>
                                        <hr />
                                        <a class="btn btn-sm btn-primary" href="manage-discount.php"><i class="fa fa-chevron-left"></i> Go Back</a>
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
