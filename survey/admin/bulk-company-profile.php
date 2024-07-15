<?php
require_once("classes/cls-company.php");
require_once("classes/cls-category.php");
require_once("classes/cls-author.php");

$obj_company = new Company();
$obj_category = new Category();
$obj_author = new Author();

if (!isset($_SESSION['ifg_admin']) && ($_SESSION['ifg_admin']['role'] != "superadmin" || $_SESSION['ifg_admin']['role'] != "admin")) {
    header("Location:login.php");
}
if (isset($_GET['cmp_id']) && $_GET['cmp_id'] != "") {
    $condition = "`cmp_id` = '" . base64_decode($_GET['cmp_id']) . "'";
    $report_details = $obj_company->getReportDetails('', $condition, '', '', 0);
    $report_detail = end($report_details);
}
$condition = "";

$category_details = $obj_category->getCategoryDetails('', $condition, '', '', 0);

$author_details = $obj_author->getAuthorDetails('', $condition, '', '', 0);

include("header.php");
?>
<!-- <script src="//cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script> -->
<script src="ckeditor/ckeditor.js" ></script>

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
                        <h3 class="page-header text-primary"><i class="fa fa-user"></i> <?php echo (isset($_GET['cmp_id'])) ? "Edit" : "Add"; ?> Company Profile</h3>
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li><a href="#">Manage Company Profile</a></li>
                            <li class="active"><?php echo (isset($_GET['cmp_id'])) ? "Edit" : "Add"; ?> Company Profile</li>
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
                                General Company Form
                            </div>
                            <div class="table-responsive">
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form role="form" action="<?php echo SITEPATH;?>admin/import-company-profile.php" method="post" enctype="multipart/form-data">
                                              
                                                <div class="form-group">
                                                    <label>CSV file</label>
                                                   <input type="file" name="file" />
                                                </div>
                                                
                                               
                                                <hr>
                                                <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
                                                
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
    <script src="js/add-report.js"></script>
<script>
        //CKEDITOR.replace( 'description' );
          //CKEDITOR.replace( 'toc' );
            //CKEDITOR.replace( 'tnf' );
             CKEDITOR.replace('description', {
        filebrowserUploadUrl: 'ckeditor/ck_upload.php',
        filebrowserUploadMethod: 'form'
    });
    CKEDITOR.replace('toc', {
        filebrowserUploadUrl: 'ckeditor/ck_upload.php',
        filebrowserUploadMethod: 'form'
    });
    CKEDITOR.replace('tnf', {
        filebrowserUploadUrl: 'ckeditor/ck_upload.php',
        filebrowserUploadMethod: 'form'
    });
</script>
</body>

</html>
