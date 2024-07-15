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
$condition_c = "`status` = 'Active'";
$category_details = $obj_category->getCategoryDetails('', $condition_c, '', '', 0);

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
                        <h3 class="page-header text-primary" style="font-size: 16px; line-height: 1.8;"><i class="fa fa-user"></i> Add FAQ (<?php echo (isset($report_detail['title'])) ? $report_detail['title'] : ""; ?>)</h3>
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li><a href="manage-report.php">Manage Report</a></li>
                            <li class="active">Add FAQ</li>
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
                
<style>

    fieldset
{
    
    padding:10px;
    display:block;
    clear:both;
    margin:5px 0px;
}

.fieldwrapper
{
        border: 1px solid #c0c0c0;
    padding: 20px;
    margin: 14px 14px;
}

input.remove
{
    float: right;
    display: block;
    margin: 5px;
    background: red;
    border: 1px solid #000;
}

#add
{
        float: right;
    margin-right: 24px;
    background: blue;
    border: 1px solid;
    padding: 6px;
    color: #fff;
}

#yourform label
{
    float:left;
    clear:left;
    display:block;
    margin:5px;
}
#yourform input, #yourform textarea
{
    float:left;
    display:block;
    margin:5px;
}
</style>                
                
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
                                            <form role="form" method="POST" action="add-report-faq-action.php" enctype="multipart/form-data" name="add-form" id="add-form">
                                                <!-- hidden fields -->
                                                <input type="hidden" name="report_id" id="report_id" value="<?php echo (isset($_GET['report_id'])) ? $_GET['report_id'] : ""; ?>">
                                                <!-- / hidden fields -->
                                                
                                                <!-- Add input filed -->
                                                
                                                <fieldset id="buildyourform">
                                                   
                                                   <div class="fieldwrapper" id="field1">
                                                        <label>Title <span class="error">*</span></label>
                                                       <input type="text" name="title_1" class="fieldname form-control"><br>
                                                        <label>Content <span class="error">*</span></label>
                                                       <textarea col="5" name="content_1" class="fieldname form-control"></textarea>
                                                  </div>      
                                                 
                                                </fieldset>
                                                
                                                <input type="button" value="Add a field" class="add" id="add" />
                                              
                                                <br><br>
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


<script>
    $(document).ready(function() {
    $("#add").click(function() {
        var lastField = $("#buildyourform div:last");
        var intId = (lastField && lastField.length && lastField.data("idx") + 1) || 1;
        var sr_no = (lastField && lastField.length && lastField.data("idx") + 2) || 2;
        var fieldWrapper = $("<div class=\"fieldwrapper\" id=\"field" + intId + "\"/>");
        fieldWrapper.data("idx", intId);
        var fName = $("<label>Title "+ sr_no +"<span class='error'>*</span></label> <input type=\"text\" name=\"title_"+ sr_no +"\" class=\"fieldname form-control\" /><br>");
        var fType = $("<label>Content "+ sr_no +" <span class='error'>*</span></label> <textarea col=\"5\" name=\"content_"+ sr_no +"\" class=\"fieldname form-control\" /></textarea>");
        var removeButton = $("<input type=\"button\" class=\"remove\" value=\"-\" /><br><br>");
        removeButton.click(function() {
            $(this).parent().remove();
        });
        fieldWrapper.append(fName);
        fieldWrapper.append(fType);
        fieldWrapper.append(removeButton);
        $("#buildyourform").append(fieldWrapper);
    });
   
});
</script>

</body>

</html>
