<?php
require_once("classes/cls-category.php");

$obj_category = new Category();

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
$fields = "*";
$condition = "";
$category_details = $obj_category->getCategoryDetails($fields, $condition, '', '', 0);
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
                        <h3 class="page-header text-primary"><i class="fa fa-th-list"></i> Manage Bundle Report</h3>
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li class="active">Manage Bundle Report</li>
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
                                <span class="pull-left">General Bundle Report</span>
                                <!--<span class="pull-right"><button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-upload"></i> Import List</button> &nbsp;&nbsp;<a class="btn btn-sm btn-primary" href="export-category.php"><i class="fa fa-download"></i> Export List</a></span>-->
                                <div class="clearfix"></div>
                            </div>
                            <div>
                                <form action="delete-bundle-report.php" method="post">
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="dataTable_wrapper">
                                        <div>
                                            <table id="topic-data" class="table table-striped table-bordered table-hover" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Bundle Name</th>
                                                        <th>Report Name</th>
                                                        <th>Current year</th>
                                                        <th>Forecast size</th>
                                                    </tr>
                                                </thead>

                                                <tfoot>
                                                      <tr>
                                                        <th>ID</th>
                                                        <th>Bundle Name</th>
                                                        <th>Report Name</th>
                                                        <th>Current year</th>
                                                        <th>Forecast size</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <button type="submit" class="btn btn-primary">Delete</button>
                                        </div>
                                        <!-- /.table-responsive -->
                                    </div>
                                </div>
                                </form> 
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
                    <h4 class="modal-title" id="myModalLabel">Import Topics Lists</h4>
                </div>
                <div class="modal-body">
                    <form id="import-form" action="import_bulk_data.php" enctype="multipart/form-data" method="post">
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
    <script type="text/javascript">
        $(document).ready(function () {
            $('#topic-data').dataTable({
                "bProcessing": true,
                "sAjaxSource": "load-bundle-report.php",
                "aoColumns": [
                    {mData: 'bundle_rep_id'},
                    {mData: 'bundle_name'},
                    {mData: 'market_name'},
                    {mData: 'current_year'},
                    {mData: 'forecast_size'},
                   
                ]
            });
        });
    </script>
</body>

</html>
