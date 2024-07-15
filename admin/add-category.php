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
    $category_detail['status'] = "";
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
                        <h3 class="page-header text-primary"><i class="fa fa-th-list"></i> <?php echo (isset($_GET['category_id'])) ? "Edit" : "Add"; ?> Category</h3>
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li><a href="manage-category.php">Manage Category</a></li>
                            <li class="active"><?php echo (isset($_GET['category_id'])) ? "Edit" : "Add"; ?> Category</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                General Category Form
                            </div>
                            <div class="table-responsive">
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form role="form" method="POST" action="add-category-action.php" enctype="multipart/form-data" name="add-form" id="add-form">
                                                <!-- hidden fields -->
                                                <input type="hidden" name="update_type" id="update_type" value="<?php echo (isset($_GET['category_id'])) ? "edit" : "add"; ?>">
                                                <input type="hidden" name="category_id" id="category_id" value="<?php echo (isset($_GET['category_id'])) ? $_GET['category_id'] : ""; ?>">
                                                <!-- / hidden fields -->
                                                <div class="form-group">
                                                    <label>Title <span class="error">*</span></label>
                                                    <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="<?php echo (isset($category_detail['title'])) ? $category_detail['title'] : ""; ?>">
                                                </div>
                                                <?php if (isset($_GET['category_id'])) { ?>
                                                    <input type="hidden" class="form-control" name="old_title" id="old_title" value="<?php echo (isset($category_detail['title'])) ? $category_detail['title'] : ""; ?>">
                                                <?php } ?>
                                                    
                                                <div class="form-group">
                                                    <label>Short Code <span class="error">*</span></label>
                                                    <input type="text" class="form-control" name="shortcode" id="shortcode" placeholder="Short Code" value="<?php echo (isset($category_detail['shortcode'])) ? $category_detail['shortcode'] : ""; ?>">
                                                </div>
                                                <?php if (isset($_GET['category_id'])) { ?>
                                                    <input type="hidden" class="form-control" name="old_shortcode" id="old_shortcode" value="<?php echo (isset($category_detail['shortcode'])) ? $category_detail['shortcode'] : ""; ?>">
                                                <?php } ?>

                                                <div class="form-group">
                                                    <label>Featured</label>
                                                    <div class="radio">
                                                        <label class="padding-0">
                                                            <input type="radio" name="featured" id="featured1" value="Yes" <?php echo (isset($category_detail['featured']) && $category_detail['featured'] == 'Yes') ? "checked" : ""; ?>>
                                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                            Yes
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label class="padding-0">
                                                            <input type="radio" name="featured" id="featured2" value="No" <?php echo (isset($category_detail['featured']) && $category_detail['featured'] == 'No') ? "checked" : ""; ?>>
                                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                            No
                                                        </label>
                                                    </div>
                                                    <div id="featured-div"></div>
                                                </div>	

                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <div class="radio">
                                                        <label class="padding-0">
                                                            <input type="radio" name="status" id="status1" value="Active" <?php echo (isset($category_detail['status']) && $category_detail['status'] == 'Active'|| $category_detail['status'] == '' ) ? "checked" : ""; ?>>
                                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                            Active
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label class="padding-0">
                                                            <input type="radio" name="status" id="status2" value="Inactive" <?php echo (isset($category_detail['status']) && $category_detail['status'] == 'Inactive') ? "checked" : ""; ?>>
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
    <script src="js/add-category.js"></script>

</body>

</html>
