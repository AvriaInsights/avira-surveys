<?php
require_once("classes/cls-report.php");
require_once("classes/cls-category.php");
require_once("classes/cls-author.php");

$obj_report = new Report();
$obj_category = new Category();
$obj_author = new Author();

if (!isset($_SESSION['ifg_admin']) && ($_SESSION['ifg_admin']['role'] != "superadmin" || $_SESSION['ifg_admin']['role'] != "admin")) {
    header("Location:login.php");
}
if (isset($_GET['report_id']) && $_GET['report_id'] != "") {
    $condition = "`report_id` = '" . base64_decode($_GET['report_id']) . "'";
    $report_details = $obj_report->getReportDetails('', $condition, '', '', 0);
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
                        <h3 class="page-header text-primary"><i class="fa fa-user"></i> <?php echo (isset($_GET['report_id'])) ? "Edit" : "Add"; ?> Report</h3>
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li><a href="manage-report.php">Manage Report</a></li>
                            <li class="active"><?php echo (isset($_GET['report_id'])) ? "Edit" : "Add"; ?> Report</li>
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
                                General Report Form
                            </div>
                            <div class="table-responsive">
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form role="form" method="POST" action="add-report-action.php" enctype="multipart/form-data" name="add-form" id="add-form">
                                                <!-- hidden fields -->
                                                <input type="hidden" name="update_type" id="update_type" value="<?php echo (isset($_GET['report_id'])) ? "edit" : "add"; ?>">
                                                <input type="hidden" name="report_id" id="report_id" value="<?php echo (isset($_GET['report_id'])) ? $_GET['report_id'] : ""; ?>">
                                                <!-- / hidden fields -->	
                                                <div class="form-group">
                                                    <label>Profile Picture</label>
                                                    <input type="file" accept="image/*" name="picture" id="picture">
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Title <span class="error">*</span></label>
                                                    <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="<?php echo (isset($report_detail['title'])) ? $report_detail['title'] : ""; ?>">
                                                </div>
												
												<div class="form-group">
                                                    <label>URL Keywords <span class="error">*</span></label>
                                                    <input type="text" class="form-control" name="url_keywords" id="url_keywords" placeholder="URL Keywords" value="<?php echo (isset($report_detail['url_keywords'])) ? $report_detail['url_keywords'] : ""; ?>">
                                                </div>
                                                
                                               <!-- <div class="form-group">
                                                    <label>Keywords <span class="error">*</span></label>
                                                    <input type="text" class="form-control" name="keywords" id="keywords" placeholder="Keywords" value="<?php echo (isset($report_detail['keywords'])) ? $report_detail['keywords'] : ""; ?>">
                                                   </div>
                                                -->

                                                <div class="form-group">
                                                    <label>Description </label>
                                                    <textarea class="form-control" name="description" id="description" placeholder="Description"><?php echo (isset($report_detail['description'])) ? $report_detail['description'] : ""; ?></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label>Table of Content </label>
                                                    <textarea class="form-control" name="toc" id="toc" placeholder="Table of Content"><?php echo (isset($report_detail['toc'])) ? $report_detail['toc'] : ""; ?></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label>Tables and Figures </label>
                                                    <textarea class="form-control" name="tnf" id="tnf" placeholder="Table of Content"><?php echo (isset($report_detail['tnf'])) ? $report_detail['tnf'] : ""; ?></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label>Single User Price <span class="error">*</span></label>
                                                    <input type="text" class="form-control" name="price" id="price" placeholder="Single User Price" value="<?php echo (isset($report_detail['price'])) ? $report_detail['price'] : ""; ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label>Enterprise User Price <span class="error">*</span></label>
                                                    <input type="text" class="form-control" name="eprice" id="eprice" placeholder="Enterprise User Price" value="<?php echo (isset($report_detail['eprice'])) ? $report_detail['eprice'] : ""; ?>">
                                                </div>

                                                <div class="form-group" hidden>
                                                    <label>Author <span class="error">*</span></label>
                                                    <select class="form-control" id="author_id" name="author_id">
                                                        
                                                        <?php if (isset($author_details) && !empty($author_details)) { ?>
                                                            <?php foreach ($author_details as $author_detail) { ?>
                                                                <option value="<?php echo $author_detail['author_id'] ?>" <?php if (isset($report_detail['author_id']) && $report_detail['author_id'] == $author_detail['author_id']) { ?> selected="selected" <?php } ?>><?php echo $author_detail['fullname'] ?></option>
                                                            <?php } ?>
                                                        <?php } else { ?>
                                                            <option value="">No Results Found</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Copies Available </label>
                                                    <input type="text" class="form-control" name="copies" id="copies" placeholder="Copies Available" value="<?php echo (isset($report_detail['copies'])) ? $report_detail['copies'] : 0; ?>">
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Category <span class="error">*</span></label>
                                                    <select class="form-control" id="category_id" name="category_id">
                                                        <?php if (isset($category_details) && !empty($category_details)) { ?>
                                                            <?php foreach ($category_details as $category_detail) { ?>
                                                                <option value="<?php echo $category_detail['category_id'] ?>" <?php if (isset($report_detail['category_id']) && $report_detail['category_id'] == $category_detail['category_id']) { ?> selected="selected" <?php } ?>><?php echo $category_detail['title'] ?></option>
                                                            <?php } ?>
                                                        <?php } else { ?>
                                                            <option value="">No Results Found</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Published Date <span class="error">*</span></label>
                                                    <input type="text" class="form-control" name="published_date" id="published_date" placeholder="Published Date" value="<?php echo (isset($report_detail['published_date'])) ? ($report_detail['published_date']) : ""; ?>">
                                                </div>	

                                                <div class="form-group">
                                                    <label>Pages </label>
                                                    <input type="text" class="form-control" name="pages" id="pages" placeholder="Pages" value="<?php echo (isset($report_detail['pages'])) ? ($report_detail['pages']) : 0; ?>">
                                                </div>		
                                                <div class="form-group">
                                                    <label>Sample Report</label>
                                                    <input type="file" accept="application/pdf" name="sample" id="sample">
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Meta Title </label>
                                                    <input type="text" class="form-control" name="meta_title" id="meta_title" placeholder="Meta Title" value="<?php echo (isset($report_detail['meta_title'])) ? $report_detail['meta_title'] : ""; ?>">
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Meta Keyword </label>
                                                    <input type="text" class="form-control" name="meta_keyword" id="meta_keyword" placeholder="Meta Keyword" value="<?php echo (isset($report_detail['meta_keyword'])) ? $report_detail['meta_keyword'] : ""; ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label>Meta Description </label>
                                                    <textarea class="form-control" name="meta_description" id="meta_description" placeholder="Meta Description"><?php echo (isset($report_detail['meta_description'])) ? $report_detail['meta_description'] : ""; ?></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label>Featured</label>
                                                    <div class="radio">
                                                        <label class="padding-0">
                                                            <input type="radio" name="featured" id="featured1" value="Yes" <?php echo (isset($report_detail['featured']) && $report_detail['featured'] == 'Yes') ? "checked" : ""; ?>>
                                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                            Yes
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label class="padding-0">
                                                            <input type="radio" name="featured" id="featured2" value="No" <?php echo (isset($report_detail['featured']) && $report_detail['featured'] == 'No') ? "checked" : ""; ?>>
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
                                                            <input type="radio" name="status" id="status1" value="Active" <?php echo (isset($report_detail['status']) && $report_detail['status'] == 'Active') ? "checked" : ""; ?>>
                                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                            Active
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label class="padding-0">
                                                            <input type="radio" name="status" id="status2" value="Inactive" <?php echo (isset($report_detail['status']) && $report_detail['status'] == 'Inactive') ? "checked" : ""; ?>>
                                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                            Inactive
                                                        </label>
                                                    </div>
                                                    <div id="status-div"></div>
                                                </div>	
                                                
                                                  <div class="form-group">
                                                    <label>Infographics PDF</label>
                                                    <input type="file" accept="application/pdf" name="infographics" id="infographics">
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
