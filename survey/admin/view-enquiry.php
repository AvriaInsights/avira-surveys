<?php
require_once("classes/cls-enquiry.php");

$obj_enquiry = new Enquiry();
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
if (isset($_GET['enquiry_id']) && $_GET['enquiry_id'] != "") {
    $fields = "`tbl_enquiry`.*, `tbl_report`.`title`";
    $condition = "`tbl_enquiry`.`enquiry_id` = '" . base64_decode($_GET['enquiry_id']) . "'";
    $enquiry_details = $obj_enquiry->getFullEnquiryDetails($fields, $condition, '', 1, 0);
    $enquiry_detail = end($enquiry_details);
    if(isset($enquiry_detail) && !empty($enquiry_detail)) {
        $update_data['status'] = "Seen";
        $update_data['updated_at'] = date("Y-m-d H:i:s");
        
        $obj_enquiry->updateEnquiry($update_data, $condition, 0);
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
                        <h3 class="page-header text-primary"><i class="fa fa-question"></i> View Question</h3>
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li><a href="manage-enquiry.php">Manage Question</a></li>
                            <li class="active">View Question</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Enquiry Details
                            </div>
                            <div class="table-responsive">
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="dataTable_wrapper">
                                        <dl class="dl-horizontal">
                                            <dt>Report</dt>
                                            <dd><?php echo $enquiry_detail['title']; ?></dd>
                                            <dt>Full Name</dt>
                                            <dd><?php echo ucfirst($enquiry_detail['fname']); ?></dd>
                                            <dt>Email</dt>
                                            <dd><?php echo $enquiry_detail['email']; ?></dd>
                                            <dt>Phone</dt>
                                            <dd><?php echo $enquiry_detail['phone']; ?></dd>
                                            <dt>Job Title</dt>
                                            <dd><?php echo $enquiry_detail['job_title']; ?></dd>
                                            <dt>Company</dt>
                                            <dd><?php echo $enquiry_detail['company']; ?></dd>
                                            <dt>Comment</dt>
                                            <dd><?php echo $enquiry_detail['comment']; ?></dd>
                                            <dt>Status</dt>
                                            <dd><?php echo $enquiry_detail['status']; ?></dd>
                                            <dt>Updated On</dt>
                                            <dd><?php echo date("F j, Y h:i A", strtotime($enquiry_detail['updated_at'])); ?></dd>
                                            <dt>Created On</dt>
                                            <dd><?php echo date("F j, Y h:i A", strtotime($enquiry_detail['created_at'])); ?></dd>
                                        </dl>
                                        <hr />
                                        <a class="btn btn-sm btn-primary" href="manage-enquiry.php"><i class="fa fa-chevron-left"></i> Go Back</a>
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
