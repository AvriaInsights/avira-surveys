<?php
require_once("classes/cls-page.php");

$obj_page = new Page();

if (!isset($_SESSION['ifg_admin']) && ($_SESSION['ifg_admin']['role'] != "superadmin" || $_SESSION['ifg_admin']['role'] != "admin")) {
    header("Location:login.php");
}
if (isset($_GET['page_id']) && $_GET['page_id'] != "") {
    $condition = "`page_id` = '" . base64_decode($_GET['page_id']) . "'";
    $page_details = $obj_page->getPageDetails('', $condition, '', '', 0);
    $page_detail = end($page_details);
} else {
    $page_detail['status'] = "Active";
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
                        <h3 class="page-header text-primary"><i class="fa fa-user"></i> <?php echo (isset($_GET['page_id'])) ? "Edit" : "Add"; ?> Page</h3>
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li><a href="manage-page.php">Manage Page</a></li>
                            <li class="active"><?php echo (isset($_GET['page_id'])) ? "Edit" : "Add"; ?> Page</li>
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
                                General Page Form
                            </div>
                            <div class="table-responsive">
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form role="form" method="POST" action="add-page-action.php" enctype="multipart/form-data" name="add-form" id="add-form">
                                                <!-- hidden fields -->
                                                <input type="hidden" name="update_type" id="update_type" value="<?php echo (isset($_GET['page_id'])) ? "edit" : "add"; ?>">
                                                <input type="hidden" name="page_id" id="page_id" value="<?php echo (isset($_GET['page_id'])) ? $_GET['page_id'] : ""; ?>">
                                                <input type="hidden" name="old_slug" id="old_slug" value="<?php echo (isset($page_detail['slug'])) ? $page_detail['slug'] : ""; ?>">
                                                <!-- / hidden fields -->	
                                                
                                                <div class="form-group">
                                                    <label>Title (EN) <span class="error">*</span></label>
                                                    <input type="text" class="form-control" name="title" id="title" placeholder="Title (EN)" value="<?php echo (isset($page_detail['title'])) ? $page_detail['title'] : ""; ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label>Content (EN) <span class="error">*</span></label>
                                                    <textarea class="form-control tinymce" name="content" id="content" placeholder="Content"><?php echo (isset($page_detail['content'])) ? $page_detail['content'] : ""; ?></textarea>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <div class="radio">
                                                        <label class="padding-0">
                                                            <input type="radio" name="status" id="status1" value="Active" <?php echo (isset($page_detail['status']) && $page_detail['status'] == 'Active') ? "checked" : ""; ?>>
                                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                            Active
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label class="padding-0">
                                                            <input type="radio" name="status" id="status2" value="Inactive" <?php echo (isset($page_detail['status']) && $page_detail['status'] == 'Inactive') ? "checked" : ""; ?>>
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
    <script src="js/add-page.js"></script>

</body>

</html>
