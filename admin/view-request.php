<?php
require_once("classes/cls-request.php");

$obj_request = new Request();
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
if (isset($_GET['request_id']) && $_GET['request_id'] != "") {
    $fields = "`tbl_request`.*, `tbl_report`.`title`";
    $condition = "`tbl_request`.`request_id` = '" . base64_decode($_GET['request_id']) . "'";
    $request_details = $obj_request->getFullRequestDetails($fields, $condition, '', 1, 0);
    $request_detail = end($request_details);
    if(isset($request_detail) && !empty($request_detail)) {
        $update_data['status'] = "Seen";
        $update_data['updated_at'] = date("Y-m-d H:i:s");
        
        $obj_request->updateRequest($update_data, $condition, 0);
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
                        <h3 class="page-header text-primary"><i class="fa fa-envelope"></i> View Sample Request</h3>
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li><a href="manage-request.php">Manage Sample Request</a></li>
                            <li class="active">View Sample Request</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Request Details
                            </div>
                            <div class="table-responsive">
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="dataTable_wrapper">
                                        <dl class="dl-horizontal">
                                            <dt>Report</dt>
                                            <dd><?php echo $request_detail['title']; ?></dd>
                                            <dt>Full Name</dt>
                                            <dd><?php echo ucfirst($request_detail['fname']); ?></dd>
                                            <dt>Email</dt>
                                            <dd><?php echo $request_detail['email']; ?></dd>
                                            <dt>Phone</dt>
                                            <dd><?php echo $request_detail['phone']; ?></dd>
                                            <dt>Job Title</dt>
                                            <dd><?php echo $request_detail['job_title']; ?></dd>
                                            <dt>Company</dt>
                                            <dd><?php echo $request_detail['company']; ?></dd>
                                            <dt>Comment</dt>
                                            <dd><?php echo $request_detail['comment']; ?></dd>
                                            <dt>Status</dt>
                                            <dd><?php echo $request_detail['status']; ?></dd>
                                            <dt>Updated On</dt>
                                            <dd><?php echo date("F j, Y h:i A", strtotime($request_detail['updated_at'])); ?></dd>
                                            <dt>Created On</dt>
                                            <dd><?php echo date("F j, Y h:i A", strtotime($request_detail['created_at'])); ?></dd>
                                        </dl>
                                        <hr />
                                        <a class="btn btn-sm btn-primary" href="manage-request.php"><i class="fa fa-chevron-left"></i> Go Back</a>
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
