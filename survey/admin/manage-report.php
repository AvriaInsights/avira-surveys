<?php
require_once("classes/cls-report.php");
require_once("classes/cls-category.php");

$obj_report = new Report();
$obj_category = new Category();

$condition = "status = 'Active'";
$category_details = $obj_category->getCategoryDetails('', $condition, '', '', 0);

if (!isset($_SESSION['ifg_admin']) && ($_SESSION['ifg_admin']['role'] != "superadmin" || $_SESSION['ifg_admin']['role'] != "admin")) {
    header("Location:login.php");
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
                        <h3 class="page-header text-primary"><i class="fa fa-th-list"></i> Manage Report List</h3>
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li class="active">Manage Report</li>
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
                                <span class="pull-left">General Report List</span>
                                <span class="pull-right"><?php if ($_SESSION['ifg_admin']['role'] == "superadmin") { ?><button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-upload"></i> Import List</button> &nbsp;&nbsp;<a class="btn btn-sm btn-primary" href="export-request.php"><i class="fa fa-download"></i> Export List</a><?php } ?></span>
                                <div class="clearfix"></div>
                            </div>
                            <div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="dataTable_wrapper">
                                        <div class="">
                                            <!--
                                            <form class="form-inline">
                                                <div class="form-group">
                                                    <label class="sr-only" for="category_id">Category</label>
                                                    <select class="form-control" id="category_id" name="category_id">
                                                        <?php if (isset($category_details) && !empty($category_details)) { ?>
                                                            <?php foreach ($category_details as $category_detail) { ?>
                                                                <option value="<?php echo $category_detail['category_id'] ?>" <?php if (isset($_GET['category_id']) && $_GET['category_id'] == $category_detail['category_id']) { ?> selected="selected" <?php } ?>><?php echo $category_detail['title'] ?></option>
                                                            <?php } ?>
                                                        <?php } else { ?>
                                                            <option value="">No Results Found</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <button type="submit" id="search-btn" class="btn btn-default"><i class="fa fa-search"></i> Search</button>
                                            </form>
                                            -->
                                        </div>
                                        <hr>
                                        <div>
                                            <table id="report-data" class="table table-striped table-bordered table-hover" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th width="150">SKU</th>
                                                        <th width="150">Title</th>
                                                        <th width="100">Single User Price</th>
                                                        <th width="130">Enterprise User Price</th>
                                                        <th width="70">Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>

                                                <tfoot>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th width="150">SKU</th>
                                                        <th width="150">Title</th>
                                                        <th width="100">Single User Price</th>
                                                        <th width="130">Enterprise User Price</th>
                                                        <th width="70">Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <!-- /.table-responsive -->
                                    </div>
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
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Import Report Lists</h4>
                </div>
                <div class="modal-body">
                    <form id="import-form" action="import-report-action.php" enctype="multipart/form-data" method="post">
                        <div class="form-group">
                            <label for="csv_file">File input</label>
                            <input type="file" id="csv_file" name="csv_file" required="required">
                            <p class="help-block">Please select the csv file.</p>
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <?php include("footer.php"); ?>
    <script src="bower_components/jquery-validation/jquery.validate.js"></script>
    <script src="bower_components/jquery-validation/additional-methods.js"></script>
    <script src="js/add-report.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#report-data').dataTable({
                "processing": true,
                'order':[[0,"desc"]],
                "language": {
                    processing: '<i class="fa fa-circle-o-notch fa-spin fa-fw"></i><span class="sr-only">Loading...</span> '
                },
                "ajax": {
                    "url": "load-report.php",
                    "data": {
                            "category_id": $("#category_id").val(),
                        }
                }
            });
        });
    </script>
</body>

</html>
