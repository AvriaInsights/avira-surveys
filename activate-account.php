<?php 
require_once("survey/classes/cls-user.php");
$obj_user = new User();
$conn = $obj_user->getConnectionObj();
$uname = $_GET['uname'];
if($_GET['uname'] != NULL || $_GET['uname'] != "") 
{
    $update_data['status'] = "Active";
    $update_data['updated_at'] = date("Y-m-d H:i:s");
    $condition = "`tbl_client_user`.`email` = '" . $uname . "'";
    $update_status = $obj_user->updateAdminUser($update_data,$condition, 0); 
    if($update_status != "" || $update_status != NULL)
    {
        $_SESSION['success'] = "<strong>Account Activated Successfully...!<strong>";
        header("location:../survey/login.php");
    }
    else
    {
        $_SESSION['error'] = "<strong>Somthing went wrong please try again..!<strong>";
        header("location:../survey/login.php");
    }
}
else
{
   echo "Somthing Went Wrong Please Contact to Administrator"; exit;
}
?>