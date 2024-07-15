<?php
require_once("classes/cls-blog.php");

$obj_blog = new Blog();
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
if (isset($_GET['blog_id']) && $_GET['blog_id'] != "") {
    $fields = "`tbl_blog`.*, `tbl_category`.`title` AS category";
    $condition = "`tbl_blog`.`blog_id` = '" . base64_decode($_GET['blog_id']) . "'";
    $blog_details = $obj_blog->getCategoryBlogDetails($fields, $condition, '', '', 0);
    $blog_detail = end($blog_details);    
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
                        <h3 class="page-header text-primary"><i class="fa fa-th-list"></i> View Blog</h3>
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li><a href="manage-blog.php">Manage Blog</a></li>
                            <li class="active">View Blog</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Blog Details
                            </div>
                            <div class="table-responsive">
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="dataTable_wrapper">
                                        <dl class="dl-horizontal">
                                            <dt>Slug</dt>
                                            <dd><?php echo $blog_detail['slug']; ?></dd>
                                            <dt>Title</dt>
                                            <dd><?php echo $blog_detail['title']; ?></dd>
                                            <dt>Description</dt>
                                            <dd><?php echo $blog_detail['description']; ?></dd>
                                            <dt>Category</dt>
                                            <dd><?php echo $blog_detail['category']; ?></dd>
                                            <dt>Status</dt>
                                            <dd><?php echo $blog_detail['status']; ?></dd>
                                            <dt>Updated On</dt>
                                            <dd><?php echo date("F j, Y h:i A", strtotime($blog_detail['updated_at'])); ?></dd>
                                            <dt>Created On</dt>
                                            <dd><?php echo date("F j, Y h:i A", strtotime($blog_detail['created_at'])); ?></dd>
                                        </dl>
                                        <hr />
                                        <a class="btn btn-sm btn-primary" href="manage-blog.php"><i class="fa fa-chevron-left"></i> Go Back</a>
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
