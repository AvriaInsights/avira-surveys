<?php
require_once("classes/cls-press.php");

$obj_press = new Press();

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
$fields = "*";
$condition = "";
$press_details = $obj_press->getPressDetails($fields, $condition, '', '', 0);
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
                        <h3 class="page-header text-primary"><i class="fa fa-th-list"></i> Manage Press Release List</h3>
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li class="active">Manage Press Release</li>
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
                                General Press Release List
                            </div>
                            <div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="dataTable_wrapper">
                                        <div>
                                            <table id="press-data" class="table table-striped table-bordered table-hover" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th># ID</th>
                                                        <th>Title</th>
                                                        <th>Created On</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>

                                                <tfoot>
                                                    <tr>
                                                        <th># ID</th>
                                                        <th>Title</th>
                                                        <th>Created On</th>
                                                        <th>Status</th>
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
    <?php include("footer.php"); ?>
    <script src="bower_components/jquery-validation/jquery.validate.js"></script>
    <script src="bower_components/jquery-validation/additional-methods.js"></script>
    <script src="js/add-press.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#press-data').dataTable({
                "bProcessing": true,
                'order':[[0,"desc"]],
                "sAjaxSource": "load-press.php",
                "aoColumns": [
                    {mData: 'press_id'},
                    {mData: 'title'},
                    {mData: 'created_at'},
                    {mData: 'status'},
                    {mData: 'action'}
                ]
            });
        });
    </script>
</body>

</html>
