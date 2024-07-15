<?php
require_once("classes/cls-report.php");
require_once("classes/cls-category.php");

$obj_report = new Report();
$obj_category = new Category();

$category_details=$obj_category->getCategoryDetails('*', '', '', '', 0);

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
                        <h3 class="page-header text-primary"><i class="fa fa-user"></i> <?php echo (isset($_GET['report_id'])) ? "Edit" : "Add"; ?> Bundle Report</h3>
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li><a href="manage-bundle-report.php">Manage Bundle Report</a></li>
                            <li class="active"><?php echo (isset($_GET['report_id'])) ? "Edit" : "Add"; ?> Bundle Report</li>
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
                                General Bundle Report Form
                            </div>
                            <div class="table-responsive">
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form role="form" action="import_bundle_data.php" method="post" enctype="multipart/form-data" name="add-form" id="add-form">
                                               
                                               <!-- <div class="form-group">
                                                    <label>Category <span class="error">*</span></label>
                                                    
                                                   <select name="cat" id="cat" class="form-control">
                                                       <option value="">Select Category</option>
                                                       <?php foreach($category_details as $category_detail){ ?>
                                                       <option value="<?php echo $category_detail['category_id'];?>"><?php echo $category_detail['title'];?></option>
                                                       <?php }?>
                                                   </select>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Topics <span class="error">*</span></label>
                                                    <select class="form-control" id="topic" name="topic">
                                                    <option value="">Select Topic</option>
                                                    </select>
                                                </div> -->
                                                
                                                    
                                                
                                                <div class="form-group">
                                                    <label>CSV file <span class="error">*</span></label>
                                                   <input type="file" name="file"/>
                                                </div>
                                                
                                               
                                                <hr>
                                                
                                                <button type="submit" class="btn btn-default" name="importSubmit" value="IMPORT">Submit</button>
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
    <script src="js/add-topic.js"></script>

</body>

</html>
