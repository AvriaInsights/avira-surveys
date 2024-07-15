<?php

require_once("classes/cls-admin.php");
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}

$obj_admin = new Admin();
$conn = $obj_admin->getConnectionObj();

if ($_POST['update_type'] == "add") {
    $insert_data['profile_image'] = SITEADMIN . "upload/default.png";
    $insert_data['f_name'] = mysqli_real_escape_string($conn, ucfirst($_POST['fname']));
    $insert_data['lname'] = mysqli_real_escape_string($conn, ucfirst($_POST['lname']));
    $insert_data['email_id'] = mysqli_real_escape_string($conn, $_POST['email']);
    $insert_data['uname'] = mysqli_real_escape_string($conn, $_POST['uname']);
    $insert_data['role'] = mysqli_real_escape_string($conn, $_POST['role']);
    $enc_password = base64_encode($_POST['password']);
    $insert_data['password'] = $enc_password;
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
    $_SESSION['success'] = "<strong>Congratulations</strong> Admin information has been inserted successfully";
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
    $enc_password = base64_encode($_POST['password']);
    $update_data['password'] = $enc_password;
    $update_data['status'] = $_POST['status'];
    $update_data['updated_at'] = date("Y-m-d h:i:s");
    $obj_admin->updateAdmin($update_data, $condition, 0);
    $_SESSION['success'] = "<strong>Congratulations</strong> Admin information has been updated successfully.";
}
header("Location:manage-admin.php");
exit(0);
?>