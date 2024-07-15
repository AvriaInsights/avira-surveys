<?php
require("classes/cls-order.php");
require("classes/cls-order-item.php");

$obj_order = new Order();
$obj_order_item = new OrderItem();
$total = 0;
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
if (isset($_GET['order_id']) && $_GET['order_id'] != "") {
    $order_id = $_GET['order_id'];
    $fields = "*";
    $condition = "`order_id` = '" . base64_decode($order_id) . "'";
    $order_detail = $obj_order->getSingleOrderDetail($fields, $condition, '`order_id` DESC', '', 0);

    if (isset($order_detail) && !empty($order_detail)) {
        $fields = "`tbl_order_item`.*, `tbl_report`.`title`, `tbl_report`.`picture`";
        $condition = "`tbl_order_item`.`order_id` = '" . base64_decode($order_id) . "'";
        $order_item_details = $obj_order_item->getFullOrderItemDetails($fields, $condition, "", 0, 0);
    } else {
        header("Location:404.php");
    }
} else {
    header("Location:404.php");
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
                        <h3 class="page-header text-primary"><i class="fa fa-shopping-cart"></i> View Order</h3>
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li><a href="manage-order.php">Manage Order</a></li>
                            <li class="active">View Order</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Order Details
                            </div>
                            <div class="table-responsive">
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="dataTable_wrapper">
                                        <dl class="dl-horizontal">
                                            <dt>#ID</dt>
                                            <dd><?php echo $order_detail['order_id']; ?></dd>
                                            <dt>#IP Address</dt>
                                            <dd><?php echo $order_detail['ip_address']; ?></dd>
                                            <dt>Sub Total</dt>
                                            <dd>$<?php echo $order_detail['subtotal']; ?></dd>
                                            <dt>Discount</dt>
                                            <dd>$<?php echo $order_detail['discount']; ?></dd>
                                            <dt>Total</dt>
                                            <dd>$<?php echo $order_detail['total']; ?></dd>
                                            <dt>Item(s)</dt>
                                            <dd><?php echo $order_detail['items']; ?></dd>
                                            <?php if($order_detail['txn_id'] != "") { ?>
                                                <dt>Transaction ID</dt>
                                                <dd><?php echo $order_detail['txn_id']; ?></dd>
                                            <?php } ?>
                                            <dt>Order Date</dt>
                                            <dd><?php echo date("F j, Y", strtotime($order_detail['order_date'])); ?></dd>
                                            <dt>Full Name</dt>
                                            <dd><?php echo ucfirst($order_detail['fname']) . " " . ucfirst($order_detail['lname']); ?></dd>
                                            <dt>Email</dt>
                                            <dd><?php echo $order_detail['email']; ?></dd>
                                            <dt>Phone</dt>
                                            <dd><?php echo $order_detail['phone']; ?></dd>
                                            <dt>Country</dt>
                                            <dd><?php echo $order_detail['country']; ?></dd>
                                            <dt>State</dt>
                                            <dd><?php echo $order_detail['state']; ?></dd>
                                            <dt>City</dt>
                                            <dd><?php echo $order_detail['city']; ?></dd>
                                            <dt>Zipcode</dt>
                                            <dd><?php echo $order_detail['zipcode']; ?></dd>
                                            <dt>Address</dt>
                                            <dd><?php echo $order_detail['address']; ?></dd>
                                            <dt>Payment Date</dt>
                                            <dd><?php echo date("F j, Y", strtotime($order_detail['payment_date'])); ?></dd>
                                            <dt>Status</dt>
                                            <dd><?php echo $order_detail['status']; ?></dd>
                                            <?php if($order_detail['error'] != "") { ?>
                                                <dt>Error</dt>
                                                <dd><?php echo $order_detail['error']; ?></dd>
                                            <?php } ?>
                                            <dt>Updated On</dt>
                                            <dd><?php echo date("F j, Y h:i A", strtotime($order_detail['updated_at'])); ?></dd>
                                            <dt>Created On</dt>
                                            <dd><?php echo date("F j, Y h:i A", strtotime($order_detail['created_at'])); ?></dd>
                                        </dl>
                                        <hr />
                                        <?php if(isset($order_item_details) && !empty($order_item_details)) { ?>
                                            <h4 class="page-header"><strong>Order Items</strong></h4>
                                            <?php foreach ($order_item_details as $order_item_detail) { ?>
                                                <dl class="dl-horizontal">
                                                    <?php if($order_item_detail['report_id']) { ?>
                                                    <dt>Report</dt>
                                                    <dd><a href="view-report.php?report_id=<?php echo base64_encode($order_item_detail['report_id']); ?>"><?php echo $order_item_detail['title']; ?></a></dd>
                                                    <?php } ?>
                                                    <dt>Price</dt>
                                                    <dd>$<?php echo $order_item_detail['price']; ?></dd>
                                                    <dt>Quantity</dt>
                                                    <dd><?php echo $order_item_detail['quantity']; ?></dd>
                                                    <dt>License</dt>
                                                    <dd><?php echo $order_item_detail['license']; ?></dd>
                                                </dl>
                                            <?php } ?>
                                        <?php } ?>
                                        <hr>
                                        <a class="btn btn-sm btn-primary" href="manage-order.php"><i class="fa fa-chevron-left"></i> Go Back</a>
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

</body>

</html>
