<?php
require_once("classes/cls-admin.php");
$update_data=array("status"=>$_POST['status']);
$condition="admin_id = '".$_POST['admin_id']."'";
$obj_admin = new Admin();

$update_status = $obj_admin->updateAdmin($update_data,$condition,0);

if(!$update_status)
{
    $msg=array("error"=>1,"error_message"=>"Error in changing Coupon status, please try again.");
}
else
{
    $msg=array("error"=>0,"error_message"=>"0");
}
echo json_encode($msg);
?>