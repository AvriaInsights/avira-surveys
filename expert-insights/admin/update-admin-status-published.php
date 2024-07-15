<?php
require_once("classes/cls-admin.php");

$obj_admin = new Admin();
$conn = $obj_admin->getConnectionObj();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}

$adminid=$_POST['adminid'];

/**********Camoagin All***************/

$fields = "*";
$condition = "`tbl_admin`.`admin_id`='".$adminid."'";
$admin_details = $obj_admin->getAdminDetails($fields, $condition, '', '', 0);

foreach($admin_details as $admin_detail)
{
    $adminstatus=$admin_detail['status'];
}
    if($adminstatus=='Active')
    {
        $adminstatus1='Inactive';
    }
    if($adminstatus=='Inactive')
    {
        $adminstatus1='Active';
    }
        $update_data['status'] = $adminstatus1;
        $update_data['updated_at'] = date("Y-m-d h:i:s");
        $condition = "`tbl_admin`.`admin_id` = '" . $adminid . "'";
        $lastupdateid = $obj_admin->updateAdmin($update_data,$condition, 0);
        echo $lastupdateid;
//echo $lastupdateid;
?>
