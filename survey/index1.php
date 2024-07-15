<?php
require_once("classes/cls-admin.php");
require_once("classes/cls-user.php");
require_once("classes/cls-report.php");
require_once("classes/cls-order.php");
require_once("classes/cls-request.php");
require_once("classes/cls-enquiry.php");
require_once("classes/cls-discount.php");

$obj_admin = new Admin();
$obj_user = new User();
$obj_report = new Report();
$obj_order = new Order();
$obj_request = new Request();
$obj_enquiry = new Enquiry();
$obj_discount = new Discount();

if (!isset($_SESSION['ifg_admin']) && ($_SESSION['ifg_admin']['role'] != "superadmin" || $_SESSION['ifg_admin']['role'] != "admin")) {
    header("Location:login.php");
}

$fields = "COUNT(user_id) as total";
$condition = "";
$user_details = $obj_user->getUserDetails($fields, $condition, '', '', 0);
$user_count = $user_details[0]['total'];

$fields = "COUNT(report_id) as total";
$condition = "";
$report_details = $obj_report->getReportDetails($fields, $condition, '', '', 0);
$report_count = $report_details[0]['total'];

$fields = "COUNT(order_id) as total";
$condition = "";
$order_details = $obj_order->getOrderDetails($fields, $condition, '', '', 0);
$order_count = $order_details[0]['total'];

$fields = "COUNT(request_id) as total";
$condition = "";
$request_details = $obj_request->getRequestDetails($fields, $condition, '', '', 0);
$request_count = $request_details[0]['total'];

$fields = "COUNT(enquiry_id) as total";
$condition = "";
$enquiry_details = $obj_enquiry->getEnquiryDetails($fields, $condition, '', '', 0);
$enquiry_count = $enquiry_details[0]['total'];

$fields = "COUNT(discount_id) as total";
$condition = "";
$discount_details = $obj_discount->getDiscountDetails($fields, $condition, '', '', 0);
$discount_count = $discount_details[0]['total'];
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
                        <h3 class="page-header text-primary"><i class="fa fa-home"></i> Dashboard</h3>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">  
                    
                    <div class="col-lg-4 col-sm-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-edit fa-4x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $report_count; ?></div>
                                        <div>Report List</div>
                                    </div>
                                </div>
                            </div>
                            <a href="manage-report.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-angle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-sm-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-shopping-cart fa-4x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $order_count; ?></div>
                                        <div>Order List</div>
                                    </div>
                                </div>
                            </div>
                            <a href="manage-order.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-angle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-sm-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-4x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $user_count; ?></div>
                                        <div>User List</div>
                                    </div>
                                </div>
                            </div>
                            <a href="manage-user.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-angle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-sm-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-th-list fa-4x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $request_count; ?></div>
                                        <div>Sample Request List</div>
                                    </div>
                                </div>
                            </div>
                            <a href="manage-request.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-angle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-sm-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-edit fa-4x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $enquiry_count; ?></div>
                                        <div>Sample Question List</div>
                                    </div>
                                </div>
                            </div>
                            <a href="manage-enquiry.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-angle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-sm-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-gift fa-4x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $discount_count; ?></div>
                                        <div>Discount List</div>
                                    </div>
                                </div>
                            </div>
                            <a href="manage-discount.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-angle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <?php include("footer.php"); ?>
</body>
</html>

