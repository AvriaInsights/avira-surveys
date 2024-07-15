<?php
require_once("classes/cls-order.php");

$obj_order = new Order();

$conn = $obj_order->getConnectionObj();

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
$fields = "order_id, CONCAT(fname, ' ', lname) AS fullname, order_date, total, status";
$condition = "";
$order_details = $obj_order->getOrderDetails($fields, $condition, '`order_id` DESC', '', 0);
$order_info = array();

foreach ($order_details as $order_detail) {
    $order_data['order_id'] = htmlspecialchars($order_detail['order_id']);
    $order_data['fullname'] = ($order_detail['fullname'] != "") ? htmlspecialchars($order_detail['fullname']) : "Guest";
    $order_data['order_date'] = htmlspecialchars(date("M j, Y", strtotime($order_detail['order_date'])));
    $order_data['total'] = "$" . htmlspecialchars($order_detail['total']);
    $order_data['status'] = htmlspecialchars($order_detail['status']);
    $order_data['action'] = '<a class="btn btn-success btn-circle" title="View Order" href="view-order.php?order_id=' . base64_encode($order_detail['order_id']) . '"><i class="fa fa-list"></i></a>
                             <a class="btn btn-danger btn-circle"  data-toggle="confirmation" data-placement="top" data-original-title="" title="" data-href="delete-order.php?order_id=' . base64_encode($order_detail['order_id']) . '"><i class="fa fa-trash"></i></a>';

    $order_info[] = $order_data;
}

$results = array(
    "sEcho" => 1,
    "iTotalRecords" => count($order_info),
    "iTotalDisplayRecords" => count($order_info),
    "aaData" => $order_info);

echo json_encode($results);
?>