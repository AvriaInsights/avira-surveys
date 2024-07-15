<?php
require_once("classes/cls-career.php");

$obj_page = new Career();
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
if (isset($_GET['career_id']) && $_GET['career_id'] != "") {
    $fields = "`tbl_career`.*";
    $condition = "`career_id` = '" . base64_decode($_GET['career_id']) . "'";
    $page_details = $obj_page->getPageDetails($fields, $condition, '', '', 0);
    $page_detail = end($page_details);    
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
                        <h3 class="page-header text-primary"><i class="fa fa-th-list"></i> View Position</h3>
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li><a href="manage-page.php">Manage Career</a></li>
                            <li class="active">View Career</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Position Details
                            </div>
                            <div class="table-responsive">
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="dataTable_wrapper">
                                        <dl class="dl-horizontal">
                                            
                                            <dt>Position Name</dt>
                                            <dd><?php echo $page_detail['position_name']; ?></dd>
                                            <dt>Experience</dt>
                                            <dd><?php echo $page_detail['experience']; ?></dd>
                                            <dt>Qualification</dt>
                                            <dd><?php echo $page_detail['qualification']; ?></dd>
                                            <dt>Location</dt>
                                            <dd><?php echo $page_detail['location']; ?></dd>
                                            <dt>Rol Category</dt>
                                            <dd><?php echo $page_detail['rol_category']; ?></dd>
                                            <dt>Content (EN)</dt>
                                            <dd><?php echo $page_detail['job_description']; ?></dd>
                                            <dt>Status</dt>
                                            <dd><?php echo $page_detail['status']; ?></dd>
                                            <dt>Updated On</dt>
                                            <dd><?php echo date("F j, Y h:i A", strtotime($page_detail['updated_at'])); ?></dd>
                                            <dt>Created On</dt>
                                            <dd><?php echo date("F j, Y h:i A", strtotime($page_detail['created_at'])); ?></dd>
                                        </dl>
                                        <hr />
                                        <a class="btn btn-sm btn-primary" href="manage-careers.php"><i class="fa fa-chevron-left"></i> Go Back</a>
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
