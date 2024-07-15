<?php
require_once("classes/cls-report.php");

$obj_report = new Report();
if (!isset($_SESSION['ifg_admin']) && ($_SESSION['ifg_admin']['role'] != "superadmin" || $_SESSION['ifg_admin']['role'] != "admin")) {
    header("Location:login.php");
}
if (isset($_GET['report_id']) && $_GET['report_id'] != "") {
    $fields = "`tbl_report`.*, `tbl_category`.`title` AS category, `tbl_author`.`fullname`as author";
    $condition = "`tbl_report`.`report_id` = '" . base64_decode($_GET['report_id']) . "'";
    $report_details = $obj_report->getFullReportDetails($fields, $condition, '', '', 0);
    $report_detail = end($report_details);    
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
                        <h3 class="page-header text-primary"><i class="fa fa-edit"></i> View Report</h3>
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li><a href="manage-report.php">Manage Report</a></li>
                            <li class="active">View Report</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Report Details
                            </div>
                            <div class="table-responsive">
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="dataTable_wrapper">
                                        <dl class="dl-horizontal">
                                            <dt>Profile Image</dt>
                                            <?php if($obj_report->checkURL($report_detail['picture'])) { ?>
                                                <dd><img height="256" width="256" src="<?php echo $report_detail['picture']; ?>" class="img-thumbnail img-rounded"></dd>
                                            <?php } else { ?>
                                                <dd>No Image Found</dd>
                                            <?php } ?>
                                            <dt>Sample Report</dt>
                                            <?php if($obj_report->checkURL($report_detail['sample'])) { ?>
                                                <dd><a class="btn btn-xs btn-default" href="<?php echo $report_detail['sample']; ?>" target="_blank"><i class="fa fa-file-pdf-o"></i> View</a></dd>
                                            <?php } else { ?>
                                                <dd>No Report Uploaded</dd>
                                            <?php } ?>
                                            <dt>SKU</dt>
                                            <dd><?php echo ucfirst($report_detail['sku']); ?></dd>
                                            <dt>Title</dt>
                                            <dd><?php echo ucfirst($report_detail['title']); ?></dd>
                                            <dt>URL Keywords</dt>
                                            <dd><?php echo ucfirst($report_detail['url_keywords']); ?></dd>
                                            <dt>Description</dt>
                                            <dd><?php echo $report_detail['description']; ?></dd>
                                            <dt>Table of Contents</dt>
                                            <dd><?php echo $report_detail['toc']; ?></dd>
                                            <dt>Tables and Figures</dt>
                                            <dd><?php echo $report_detail['tnf']; ?></dd>
                                            <dt>Single User Price</dt>
                                            <dd>$<?php echo $report_detail['price']; ?></dd>
                                            <dt>Enterprise User Price</dt>
                                            <dd>$<?php echo $report_detail['eprice']; ?></dd>
                                            <dt>Author</dt>
                                            <dd><?php echo isset($report_detail['author'])?$report_detail['author']:"Not Available"; ?></dd>
                                            <dt>Published Date</dt>
                                            <dd><?php echo date("F j, Y", strtotime($report_detail['published_date'])); ?></dd>
                                            <dt>Pages</dt>
                                            <dd><?php echo $report_detail['pages']; ?></dd>
                                            <dt>Ebook Link</dt>
                                            <dd><?php echo $report_detail['report_link']; ?></dd>
                                            <dt>Available Copies</dt>
                                            <dd><?php echo $report_detail['copies']; ?></dd>
                                            <dt>Category</dt>
                                            <dd><?php echo isset($report_detail['category'])?$report_detail['category']:"Not Available"; ?></dd>
                                            <dt>Meta Title</dt>
                                            <dd><?php echo $report_detail['meta_title']; ?></dd> 
                                            <dt>Meta Keyword</dt>
                                            <dd><?php echo $report_detail['meta_keyword']; ?></dd> 
                                            <dt>Meta Description</dt>
                                            <dd><?php echo $report_detail['meta_description']; ?></dd>  
                                            <dt>Status</dt>
                                            <dd><?php echo $report_detail['status']; ?></dd>
                                            <dt>Updated On</dt>
                                            <dd><?php echo date("F j, Y h:i A", strtotime($report_detail['updated_at'])); ?></dd>
                                            <dt>Created On</dt>
                                            <dd><?php echo date("F j, Y h:i A", strtotime($report_detail['created_at'])); ?></dd>
                                        </dl>
                                        <hr />
                                        <a class="btn btn-sm btn-primary" href="manage-report.php"><i class="fa fa-chevron-left"></i> Go Back</a>
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
