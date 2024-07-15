<?php
require_once("classes/cls-press.php");
require_once("classes/cls-category.php");

$obj_press = new Press();
$obj_category = new Category();

if (!isset($_SESSION['ifg_admin']) && ($_SESSION['ifg_admin']['role'] != "superadmin" || $_SESSION['ifg_admin']['role'] != "admin")) {
    header("Location:login.php");
}
if (isset($_GET['press_id']) && $_GET['press_id'] != "") {
    $condition = "`press_id` = '" . base64_decode($_GET['press_id']) . "'";
    $press_details = $obj_press->getPressDetails('', $condition, '', '', 0);
    $press_detail = end($press_details);
} else {
    $press_detail['status'] = "Active";
}

$condition = "";
$category_details = $obj_category->getCategoryDetails('', $condition, '', '', 0);
include("header.php");
?>
<script src="//cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>

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
                        <h3 class="page-header text-primary"><i class="fa fa-user"></i> <?php echo (isset($_GET['press_id'])) ? "Edit" : "Add"; ?> Press Release</h3>
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li><a href="manage-press.php">Manage Press Release</a></li>
                            <li class="active"><?php echo (isset($_GET['press_id'])) ? "Edit" : "Add"; ?> Press Release</li>
                        </ol>
                        <?php if (isset($_SESSION['success'])) { ?>
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php
                                echo $_SESSION['success'];
                                unset($_SESSION['success']);
                                ?>
                            </div>
                        <?php } elseif (isset($_SESSION['error'])) { ?>
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php
                                echo $_SESSION['error'];
                                unset($_SESSION['error']);
                                ?>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                General Press Form
                            </div>
                            <div class="table-responsive">
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form role="form" method="POST" action="add-press-action.php" enctype="multipart/form-data" name="add-form" id="add-form">
                                                <!-- hidden fields -->
                                                <input type="hidden" name="update_type" id="update_type" value="<?php echo (isset($_GET['press_id'])) ? "edit" : "add"; ?>">
                                                <input type="hidden" name="press_id" id="press_id" value="<?php echo (isset($_GET['press_id'])) ? $_GET['press_id'] : ""; ?>">
                                                <input type="hidden" name="old_slug" id="old_slug" value="<?php echo (isset($press_detail['slug'])) ? $press_detail['slug'] : ""; ?>">
                                                <!-- / hidden fields -->	
                                                
                                                <div class="form-group">
                                                    <label>Title <span class="error">*</span></label>
                                                    <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="<?php echo (isset($press_detail['title'])) ? $press_detail['title'] : ""; ?>">
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Slug <span class="error">*</span></label>
                                                    <input type="text" class="form-control" name="slug" id="slug" placeholder="Slug" value="<?php echo (isset($press_detail['slug'])) ? $press_detail['slug'] : ""; ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label>Description </label>
                                                    <textarea class="form-control" name="description" id="description" placeholder="Description"><?php echo (isset($press_detail['description'])) ? $press_detail['description'] : ""; ?></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label>Category <span class="error">*</span></label>
                                                    <select class="form-control" id="category_id" name="category_id">
                                                        <?php if (isset($category_details) && !empty($category_details)) { ?>
                                                            <?php foreach ($category_details as $category_detail) { ?>
                                                                <option value="<?php echo $category_detail['category_id'] ?>" <?php if (isset($press_detail['category_id']) && $press_detail['category_id'] == $category_detail['category_id']) { ?> selected="selected" <?php } ?>><?php echo $category_detail['title'] ?></option>
                                                            <?php } ?>
                                                        <?php } else { ?>
                                                            <option value="">No Results Found</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Meta Title </label>
                                                    <input type="text" class="form-control" name="meta_title" id="meta_title" placeholder="Meta Title" value="<?php echo (isset($press_detail['meta_title'])) ? $press_detail['meta_title'] : ""; ?>">
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Meta Keyword </label>
                                                    <input type="text" class="form-control" name="meta_keyword" id="meta_keyword" placeholder="Meta Keyword" value="<?php echo (isset($press_detail['meta_keyword'])) ? $press_detail['meta_keyword'] : ""; ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label>Meta Description </label>
                                                    <textarea class="form-control" name="meta_description" id="meta_description" placeholder="Meta Description"><?php echo (isset($press_detail['meta_description'])) ? $press_detail['meta_description'] : ""; ?></textarea>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <div class="radio">
                                                        <label class="padding-0">
                                                            <input type="radio" name="status" id="status1" value="Active" <?php echo (isset($press_detail['status']) && $press_detail['status'] == 'Active') ? "checked" : ""; ?>>
                                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                            Active
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label class="padding-0">
                                                            <input type="radio" name="status" id="status2" value="Inactive" <?php echo (isset($press_detail['status']) && $press_detail['status'] == 'Inactive') ? "checked" : ""; ?>>
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
    <script src="bower_components/jquery-validation/additional-methods.js"></script>
    <script src="js/add-press.js"></script>
<script>
        CKEDITOR.replace( 'description' );
</script>
</body>

</html>
