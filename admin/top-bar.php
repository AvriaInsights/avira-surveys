<?php

require_once("classes/cls-enquiry.php");
require_once("classes/cls-request.php");
require_once("classes/cls-discount.php");

$obj_enquiry = new Enquiry();
$obj_request = new Request();
$obj_discount = new Discount();

/*$fields = "`tbl_enquiry`.`enquiry_id`, `tbl_enquiry`.`created_at`, `tbl_report`.`title`";
$condition = "`tbl_enquiry`.`status` = 'Unseen'";
$enquiry_infos = $obj_enquiry->getFullEnquiryDetails($fields, $condition, '`tbl_enquiry`.`enquiry_id` DESC', 2, 0);

$fields = "`tbl_request`.`request_id`, `tbl_request`.`created_at`, `tbl_report`.`title`";
$condition = "`tbl_request`.`status` = 'Unseen'";
$request_infos = $obj_request->getFullRequestDetails($fields, $condition, '`tbl_request`.`request_id` DESC', 2, 0);

$fields = "`tbl_discount`.`discount_id`, `tbl_discount`.`created_at`, `tbl_report`.`title`";
$condition = "`tbl_discount`.`status` = 'Unseen'";
$discount_infos = $obj_discount->getFullDiscountDetails($fields, $condition, '`tbl_discount`.`discount_id` DESC', 2, 0);*/
?>
<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="index.php"><?php echo SITETITLE; ?> - Admin Panel</a>
</div>
<!-- /.navbar-header -->

<ul class="nav navbar-top-links navbar-right"> 
    <?php if (isset($_SESSION['ifg_admin']) && $_SESSION['ifg_admin']['role'] == "superadmin") { ?>
        <?php if((isset($request_infos) && !empty($request_infos)) || isset($discount_infos) && !empty($discount_infos) || isset($enquiry_infos) && !empty($enquiry_infos)) { ?>
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-alerts">
                <?php foreach ($request_infos as $request_info) { ?>
                    <li>
                        <a href="view-request.php?request_id=<?php echo base64_encode($request_info['request_id']); ?>">
                            <div>
                                <i class="fa fa-envelope fa-fw"></i> <?php echo $request_info['title']; ?>
                                <span class="pull-right text-muted small"><?php echo $obj_request->timesAgo($request_info['created_at']); ?></span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                <?php } ?>
                <?php foreach ($discount_infos as $discount_info) { ?>
                    <li>
                        <a href="view-discount.php?discount_id=<?php echo base64_encode($discount_info['discount_id']); ?>">
                            <div>
                                <i class="fa fa-gift fa-fw"></i> <?php echo $discount_info['title']; ?>
                                <span class="pull-right text-muted small"><?php echo $obj_discount->timesAgo($discount_info['created_at']); ?></span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                <?php } ?>
                <?php foreach ($enquiry_infos as $enquiry_info) { ?>
                    <li>
                        <a href="view-enquiry.php?enquiry_id=<?php echo base64_encode($enquiry_info['enquiry_id']); ?>">
                            <div>
                                <i class="fa fa-question fa-fw"></i> <?php echo $enquiry_info['title']; ?>
                                <span class="pull-right text-muted small"><?php echo $obj_enquiry->timesAgo($enquiry_info['created_at']); ?></span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                <?php } ?>
            </ul>
            <!-- /.dropdown-alerts -->
        </li>
        <!-- /.dropdown -->
        <?php } ?>
    <?php } ?>
    <!-- /.dropdown -->
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i>  <?php echo isset($_SESSION['admin']['fname']) ? $_SESSION['admin']['fname'] : "Admin"; ?> <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li><a href="view-profile.php"><i class="fa fa-user fa-fw"></i> User Profile</a></li>
            <li class="divider"></li>
            <li><a href="update-profile.php"><i class="fa fa-gear fa-fw"></i> Settings</a></li>
            <li class="divider"></li>
            <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
        </ul>
        <!-- /.dropdown-user -->
    </li>
    <!-- /.dropdown -->
</ul>