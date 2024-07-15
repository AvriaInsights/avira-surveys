<?php
require_once("survey/classes/cls-admin.php");
 $obj_admin = new Admin();
 $conn = $obj_admin->getConnectionObj();

$userid = $_POST['duid'];
$resetpass_text = base64_encode($_POST['password']);

if($userid!="" && $resetpass_text!="")
{
    $condition1 = "`tbl_client_user`.`client_id` = '$userid'";
    $fields1 = "`tbl_client_user`.*";
    $user_details = $obj_admin->getAdminDetails($fields1, $condition1,'','', 0);
    $total = count($user_details);
    if($total>0)
    {
        $condition = "`tbl_client_user`.`client_id` = '$userid'";
        $update_data['password'] = mysqli_real_escape_string($conn, $resetpass_text);
        $result=$obj_admin->updateAdmin($update_data, $condition,0);
    }
    else
    {
        echo $message="Invalid user";;
    }
}
else
{
    echo $message="";
}

?>