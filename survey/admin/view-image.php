<?php
require_once("classes/cls-image.php");

$obj_image = new Image();
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
if (isset($_GET['image_id']) && $_GET['image_id'] != "") {
    $condition = "`image_id` = '" . base64_decode($_GET['image_id']) . "'";
    $image_details = $obj_image->getImageDetails('', $condition, '', '', 0);
    $image_detail = end($image_details);    
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
                        <h3 class="page-header text-primary"><i class="fa fa-quote-left"></i> View Image</h3>
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li><a href="manage-image.php">Manage Image</a></li>
                            <li class="active">View Image</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Image Details
                            </div>
                            <div class="table-responsive">
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="dataTable_wrapper">
                                        <dl class="dl-horizontal">
                                            <dd><img height="200" width="200" src="<?php echo ucfirst($image_detail['picture']); ?>" class="img-thumbnail"></dd><br>
                                            <dd><?php echo $image_detail['picture']; ?></dd>
                                        </dl>
                                        
                                            <dt>Image Path</dt>
                                            <dd><?php echo $image_detail['source']; ?></dd>
                                            <dt>Image Name</dt>
                                            <dd><?php echo ucfirst($image_detail['img_name']); ?></dd>
                                        <hr />
                                        <a class="btn btn-sm btn-primary" href="manage-image.php"><i class="fa fa-chevron-left"></i> Go Back</a>
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
