<?php
require_once("classes/cls-faq.php");
$obj_faq = new Faq();

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
if (isset($_GET['faq_id']) && $_GET['faq_id'] != "") {
    $condition = "`faq_id` = '" . base64_decode($_GET['faq_id']) . "'";
    $faq_details = $obj_faq->getFAQDetails('', $condition, '', '', 0);
    $faq_detail = end($faq_details);
} else {
    $faq_detail['status'] = "";
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
                        <h3 class="page-header text-primary"><i class="fa fa-th-list"></i> <?php echo (isset($_GET['faq_id'])) ? "Edit" : "Add"; ?> FAQ</h3>
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li><a href="manage-faq.php?report_id=<?php echo base64_encode($faq_detail['report_id']);?>">Manage FAQ</a></li>
                            <li class="active"><?php echo (isset($_GET['faq_id'])) ? "Edit" : "Add"; ?> FAQ</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                General FAQ Form
                            </div>
                            <div class="table-responsive">
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form role="form" method="POST" action="add-faq-action.php" name="add-faq" id="add-faq">
                                                <!-- hidden fields -->
                                                <input type="hidden" name="update_type" id="update_type" value="<?php echo (isset($_GET['faq_id'])) ? "edit" : "add"; ?>">
                                                <input type="hidden" name="faq_id" id="faq_id" value="<?php echo (isset($_GET['faq_id'])) ? $_GET['faq_id'] : ""; ?>">
                                                <input type="hidden" name="report_id" id="report_id" value="<?php echo $faq_detail['report_id']; ?>">
                                                <!-- / hidden fields -->
                                                <div class="form-group">
                                                    <label>Question <span class="error">*</span></label>
                                                    <input type="text" class="form-control" name="question" id="question" placeholder="Question" value="<?php echo (isset($faq_detail['faq_title'])) ? $faq_detail['faq_title'] : ""; ?>">
                                                </div>
                                                
                                                 <div class="form-group">
                                                    <label>Answer <span class="error">*</span></label>
                                                    <textarea class="form-control" name="answer" id="answer" placeholder="Answer"><?php echo (isset($faq_detail['faq_content'])) ? $faq_detail['faq_content'] : ""; ?></textarea>
                                                </div>
                                               
                                                <div class="form-group">
                                                    <label>Status <span class="error">*</span></label>
                                                    <br>
                                                    <input type="radio" name="status" id="status-active" value="Active" <?php if($faq_detail['status'] == 'Active') {?> checked <?php } ?>>Active
                                                    <br>
                                                    <input type="radio" name="status" id="status-inactive" value="Inactive" <?php if($faq_detail['status'] == 'Inactive') {?> checked <?php } ?>>Inactive
                                                    
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
    <script src="js/add-faq.js"></script>

</body>

</html>
