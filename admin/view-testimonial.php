<?php
require_once("classes/cls-testimonial.php");

$obj_testimonial = new Testimonial();
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
if (isset($_GET['testimonial_id']) && $_GET['testimonial_id'] != "") {
    $condition = "`testimonial_id` = '" . base64_decode($_GET['testimonial_id']) . "'";
    $testimonial_details = $obj_testimonial->getTestimonialDetails('', $condition, '', '', 0);
    $testimonial_detail = end($testimonial_details);    
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
                        <h3 class="page-header text-primary"><i class="fa fa-quote-left"></i> View Testimonial</h3>
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li><a href="manage-testimonial.php">Manage Testimonial</a></li>
                            <li class="active">View Testimonial</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Testimonial Details
                            </div>
                            <div class="table-responsive">
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="dataTable_wrapper">
                                        <dl class="dl-horizontal">
                                           <dt>Photo</dt>
											<dd><img height="200" width="200" src="<?php echo ucfirst($testimonial_detail['picture']); ?>" class="img-thumbnail img-circle"></dd>
                                            <dt>Full Name</dt>
                                            <dd><?php echo ucfirst($testimonial_detail['name']); ?></dd>
                                            <dt>Content</dt>
                                            <dd><?php echo $testimonial_detail['content']; ?></dd>
                                            <dt>Place</dt>
                                            <dd><?php echo $testimonial_detail['place']; ?></dd>
                                            <dt>Status</dt>
                                            <dd><?php echo $testimonial_detail['status']; ?></dd>
                                            <dt>Updated On</dt>
                                            <dd><?php echo date("F j, Y h:i A", strtotime($testimonial_detail['updated_at'])); ?></dd>
                                            <dt>Created On</dt>
                                            <dd><?php echo date("F j, Y h:i A", strtotime($testimonial_detail['created_at'])); ?></dd>
                                        </dl>
                                        <hr />
                                        <a class="btn btn-sm btn-primary" href="manage-testimonial.php"><i class="fa fa-chevron-left"></i> Go Back</a>
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
