<?php
require_once("classes/cls-discount.php");

$obj_discount = new Discount();

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
$fields = "*";
$condition = "";
$discount_details = $obj_discount->getDiscountDetails($fields, $condition, '', '', 0);
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
                        <h3 class="page-header text-primary"><i class="fa fa-th-list"></i> Manage Discount List</h3>
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li class="active">Manage Discount List</li>
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
                                <span class="pull-left">General Discount List</span>
                                <span class="pull-right"><?php if ($_SESSION['ifg_admin']['role'] == "superadmin") { ?> <a class="btn btn-sm btn-primary" href="export-discount.php"><i class="fa fa-download"></i> Export List</a><?php } ?></span>
                                 <div class="clearfix"></div>
                            </div>
                            <div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="dataTable_wrapper">
                                        <div>
                                            <table id="discount-data" class="table table-striped table-bordered table-hover" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Report</th>
                                                        <th width="150">Full Name</th>
                                                        <th width="200">Email</th>
                                                        <th width="100">Phone</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>

                                                <tfoot>
                                                    <tr>
                                                        <th>Report</th>
                                                        <th width="150">Full Name</th>
                                                        <th width="200">Email</th>
                                                        <th width="100">Phone</th>
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
    <?php include("footer.php"); ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#discount-data').dataTable({
                "bProcessing": true,
                "sAjaxSource": "load-discount.php",
                "aoColumns": [
                    {mData: 'title'},
                    {mData: 'fullname'},
                    {mData: 'email'},
                    {mData: 'phone'},
                    {mData: 'action'}
                ],
                "order": []
            });
        });
    </script>
</body>

</html>
