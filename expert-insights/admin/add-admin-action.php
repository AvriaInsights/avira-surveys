<?php
require_once("classes/cls-admin.php");
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}

$obj_admin = new Admin();
$conn = $obj_admin->getConnectionObj();
// $camp_id = $_POST['campaign'];
// if(empty($camp_id))
// {
//     $cmp_id_val="";
// }
// else
// {
//     foreach($camp_id as $checkbox)
//     {
//      $cmp_id[] = $checkbox;
//     }
//     $cmp_id_val =  implode(', ', $cmp_id);
// }

//echo $_POST['region'];
$reg_id = $_POST['region'];
if($reg_id!="")
{
    $all_reg_id=implode(', ', $reg_id);
}
else
{
   $all_reg_id=""; 
}


$menu_id = $_POST['menu_list'];
//print_r($menu_id);
// foreach($menu_id as $checkboxx) {
//  $menu_id[] = $checkboxx;
// }

if(in_array(2, $menu_id)){
    $sub_menu1 = 4;
}else{
    $sub_menu="";
}

if(in_array(5, $menu_id)){
    $sub_menu2 = "7, 13";
}else{
    $sub_menu = "";
}


$child_menu = $sub_menu1.",".$sub_menu2;


$menu_id_val =  implode(', ', $menu_id);


$fields2 = "*";
$condition2 = "`tbl_admin`.`admin_id` = '".$_SESSION['ifg_admin']['admin_id']."'";
$admin_details2 = $obj_admin->getAdminDetails($fields, $condition, '', '', 0);
foreach($admin_details2 as $admin_detail2)
{
    $usercnt=$admin_detail2['user_cnt'];
   
}
$addusercnt=$usercnt+1;

if ($_POST['update_type'] == "add") {
    $insert_data['profile_image'] = SITEADMIN . "upload/default.png";
    $insert_data['f_name'] = mysqli_real_escape_string($conn, ucfirst($_POST['fname']));
    $insert_data['lname'] = mysqli_real_escape_string($conn, ucfirst($_POST['lname']));
    $insert_data['email_id'] = mysqli_real_escape_string($conn, $_POST['email']);
    $insert_data['uname'] = mysqli_real_escape_string($conn, $_POST['uname']);
    $insert_data['role'] = mysqli_real_escape_string($conn, $_POST['role']);
    // $insert_data['camp_id'] = mysqli_real_escape_string($conn, $cmp_id_val);
    $insert_data['menu_id'] = mysqli_real_escape_string($conn, $menu_id_val);
    $insert_data['sub_menu_id'] = mysqli_real_escape_string($conn, trim($child_menu,","));
    $enc_password = base64_encode($_POST['password']);
    $insert_data['password'] = $enc_password;
    $insert_data['user_cnt'] = mysqli_real_escape_string($conn, $addusercnt);
    $insert_data['region_id'] = mysqli_real_escape_string($conn, $all_reg_id);
    $insert_data['status'] = $_POST['status'];
    $insert_data['created_at'] = date("Y-m-d h:i:s");
    $insert_data['updated_at'] = date("Y-m-d h:i:s");
    $obj_admin->insertAdmin($insert_data, 0);

    $host = $_SERVER['HTTP_HOST'];
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= "From: " . SITETITLE . " <" . SITEEMAIL . ">\n";

    $message = "<html>";
    $message .= "<head>";
    $message .= "<title>New Account - " . SITETITLE . "</title>";
    $message .= "</head>";
    $message .= "<body  style='font-family:Segoe UI; font-size:13px;'>";
    $message .= '<table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td align="center" bgcolor="#eeeeee" style="padding: 40px 0 30px 0; border-radius:6px 6px 0px 0px;">
                <h1>' . SITETITLE . ' - New Account</h1>
            </td>
        </tr>
        <tr>
            <td style="padding: 10px; font-size:13px;">
                <p>Hello ' . $insert_data['f_name'] . ',<br> Congratulations your account has been setup Successfully on ' . SITETITLE . '. Please find the below credentials to log in to your admin panel</p>
            </td>
        </tr>
        <tr>
            <td bgcolor="#f2f2f2" style="padding: 10px; font-size:13px;">
                Username : <b> ' . $insert_data['uname'] . '</b>
            </td>
        </tr>
        <tr>
            <td bgcolor="#f2f2f2" style="padding: 10px; font-size:13px;">
                Password : <b> ' . base64_decode($insert_data['password']) . '</b>
            </td>
        </tr>
        <tr>
            <td style="padding: 10px; font-size:13px;">
                <p><b>Please Note</b> : <i>If you have not requested the Password. Please ignore the above mail.</i></p>
            </td>
        </tr>
        <tr>
            <td align="center" bgcolor="#00538d" style="padding: 40px 0 30px 0; color:#FFFFFF; border-radius:0px 0px 6px 6px">
                <h4>' . SITETITLE . '</h4><small>&copy; All Rights Reserved ' . date("Y") . '</small>
            </td>
        </tr>
        </table>
        </td>
        </tr>
        </table>';
    $message .= "</body>";
    $message .= "</html>";

    $to = trim($_POST['email']);
    $subject = "New Account - " . SITETITLE . "";

    $mailsent = mail($to, $subject, $message, $headers);
    $_SESSION['success'] = "<strong>Information</strong> has been added successfully";
} else {
    $condition = "`admin_id` = '" . base64_decode($_POST['admin_id']) . "'";
    $update_data['f_name'] = mysqli_real_escape_string($conn, ucfirst($_POST['fname']));
    $update_data['lname'] = mysqli_real_escape_string($conn, ucfirst($_POST['lname']));
    if (isset($_POST['uname']) && $_POST['uname'] != "") {
        $update_data['uname'] = mysqli_real_escape_string($conn, $_POST['uname']);
    }
    if (isset($_POST['email']) && $_POST['email'] != "") {
        $update_data['email_id'] = mysqli_real_escape_string($conn, $_POST['email']);
    }
    $update_data['role'] = mysqli_real_escape_string($conn, $_POST['role']);
    // $update_data['camp_id']=mysqli_real_escape_string($conn,$cmp_id_val);
    $update_data['menu_id'] = mysqli_real_escape_string($conn, $menu_id_val);
    $update_data['sub_menu_id'] = mysqli_real_escape_string($conn, trim($child_menu,","));
    $update_data['region_id'] = mysqli_real_escape_string($conn, $all_reg_id);
    $enc_password = base64_encode($_POST['password']);
    $update_data['password'] = $enc_password;
    $update_data['status'] = $_POST['status'];
    $update_data['updated_at'] = date("Y-m-d h:i:s");
    $obj_admin->updateAdmin($update_data, $condition, 0);
    $_SESSION['success'] = "<strong>Information</strong> has been updated successfully.";
}
header("Location:manage-user");
exit(0);
?>