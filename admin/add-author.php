<?php
require_once("classes/cls-author.php");
$obj_author = new Author();
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
if (isset($_GET['author_id']) && $_GET['author_id'] != "") {
    $condition = "`author_id` = '" . base64_decode($_GET['author_id']) . "'";
    $author_details = $obj_author->getAuthorDetails('', $condition, '', '', 0);
    $author_detail = end($author_details);
} else {
    $author_detail['status'] = "";
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
                        <h3 class="page-header text-primary"><i class="fa fa-th-list"></i> <?php echo (isset($_GET['author_id'])) ? "Edit" : "Add"; ?> Author</h3>
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li><a href="manage-author.php">Manage Author</a></li>
                            <li class="active"><?php echo (isset($_GET['author_id'])) ? "Edit" : "Add"; ?> Author</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                General Author Form
                            </div>
                            <div class="table-responsive">
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-lg-offset-1">
                                            <form role="form" method="POST" action="add-author-action.php" enctype="multipart/form-data" name="add-form" id="add-form">
                                                <!-- hidden fields -->
                                                <input type="hidden" name="update_type" id="update_type" value="<?php echo (isset($_GET['author_id'])) ? "edit" : "add"; ?>">
                                                <input type="hidden" name="author_id" id="author_id" value="<?php echo (isset($_GET['author_id'])) ? $_GET['author_id'] : ""; ?>">
                                                <!-- / hidden fields -->
                                                <div class="form-group">
                                                    <label>Full Name <span class="error">*</span></label>
                                                    <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Full Name" value="<?php echo (isset($author_detail['fullname'])) ? $author_detail['fullname'] : ""; ?>">
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
    <script src="js/add-author.js"></script>

</body>

</html>
