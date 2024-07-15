<?php
require_once("classes/cls-category.php");

$obj_category = new Category();
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
if (isset($_GET['category_id']) && $_GET['category_id'] != "") {
    $condition = "`category_id` = '" . base64_decode($_GET['category_id']) . "'";
    $category_details = $obj_category->getCategoryDetails('', $condition, '', '', 0);
    $category_detail = end($category_details);    
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
                        <h3 class="page-header text-primary"><i class="fa fa-th-list"></i> View Category</h3>
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li><a href="manage-category.php">Manage Category</a></li>
                            <li class="active">View Category</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Category Details
                            </div>
                            <div class="table-responsive">
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="dataTable_wrapper">
                                        <dl class="dl-horizontal">
                                            <dt>Short Code</dt>
                                            <dd><?php echo $category_detail['shortcode']; ?></dd>
                                            <dt>Title</dt>
                                            <dd><?php echo $category_detail['title']; ?></dd>
                                            <dt>Featured</dt>
                                            <dd><?php echo $category_detail['featured']; ?></dd>
                                            <dt>Status</dt>
                                            <dd><?php echo $category_detail['status']; ?></dd>
                                            <dt>Updated On</dt>
                                            <dd><?php echo date("F j, Y h:i A", strtotime($category_detail['updated_at'])); ?></dd>
                                            <dt>Created On</dt>
                                            <dd><?php echo date("F j, Y h:i A", strtotime($category_detail['created_at'])); ?></dd>
                                        </dl>
                                        <hr />
                                        <a class="btn btn-sm btn-primary" href="manage-category.php"><i class="fa fa-chevron-left"></i> Go Back</a>
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
