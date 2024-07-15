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
     $testimonial_detail['status'] = "Active";
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
                        <h3 class="page-header text-primary"><i class="fa fa-quote-left"></i> <?php echo (isset($_GET['testimonial_id'])) ? "Edit" : "Add"; ?> Testimonial</h3>
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li><a href="manage-testimonial.php">Manage Testimonial</a></li>
                            <li class="active"><?php echo (isset($_GET['testimonial_id'])) ? "Edit" : "Add"; ?> Testimonial</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                General Testimonial Form
                            </div>
                            <div class="table-responsive">
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form role="form" method="POST" action="add-testimonial-action.php" enctype="multipart/form-data" name="add-form" id="add-form">
                                                <!-- hidden fields -->
                                                <input type="hidden" name="update_type" id="update_type" value="<?php echo (isset($_GET['testimonial_id'])) ? "edit" : "add"; ?>">
                                                <input type="hidden" name="testimonial_id" id="testimonial_id" value="<?php echo (isset($_GET['testimonial_id'])) ? $_GET['testimonial_id'] : ""; ?>">
                                                <!-- / hidden fields -->
                                                
												<div class="form-group">
                                                    <label>Add Image</label>
                                                    <input type="file" accept="image/*" name="picture" id="picture">
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Content <span class="error">*</span></label>
                                                    <textarea class="form-control" rows="4" name="content" id="content" placeholder="Content"><?php echo (isset($testimonial_detail['content'])) ? $testimonial_detail['content'] : ""; ?></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label>Name <span class="error">*</span></label>
                                                    <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo (isset($testimonial_detail['name'])) ? $testimonial_detail['name'] : ""; ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label>Place <span class="error">*</span></label>
                                                    <input type="text" class="form-control" name="place" id="place" placeholder="Place" value="<?php echo (isset($testimonial_detail['place'])) ? $testimonial_detail['place'] : ""; ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <div class="radio">
                                                        <label class="padding-0">
                                                            <input type="radio" name="status" id="status1" value="Active" <?php echo (isset($testimonial_detail['status']) && $testimonial_detail['status'] == 'Active') ? "checked" : ""; ?>>
                                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                            Active
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label class="padding-0">
                                                            <input type="radio" name="status" id="status2" value="Inactive" <?php echo (isset($testimonial_detail['status']) && $testimonial_detail['status'] == 'Inactive') ? "checked" : ""; ?>>
                                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                            Inactive
                                                        </label>
                                                    </div>
                                                    <div id="status-div"></div>
                                                </div>	
                                                <hr>
                                                <button type="submit" class="btn btn-default">Submit</button>
                                                <button type="reset" class="btn btn-default">Reset</button>
                                            </form>
                                        </div>
                                        <!-- /.col-lg-6 (nested) -->
                                    </div>
                                    <!-- /.table-responsive -->
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
    <script src="bower_components/jquery-validation/jquery.validate.js"></script>
    <script src="js/add-testimonial.js"></script>

</body>

</html>
