<?php

require_once("classes/cls-admin.php");
require_once("classes/phpmailer.php");

$obj_admin = new Admin();
if (isset($_POST['email']) && $_POST['email'] != "") {
    $condition = "email = '" . $_POST['email'] . "'";
    $admin_details = $obj_admin->getAdminDetails('', $condition, '', '', 0);
    if (count($admin_details) > 0) {
        $admin_detail = end($admin_details);
        if ($admin_detail['status'] == "Inactive") {
            $_SESSION['error'] = "<strong>Sorry</strong> Your Account is Temporarily Blocked.";
        } else {
            $host = $_SERVER['HTTP_HOST'];
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= "From: " . SITETITLE . " <info@ " . $host . ">\n";

            $message = "<html>";
            $message .= "<head>";
            $message .= "<title>Forgot Password - " . SITETITLE . "</title>";
            $message .= "</head>";
            $message .= "<body  style='font-family:Segoe UI; font-size:13px;'>";
            $message .= '<table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td align="center" bgcolor="#eeeeee" style="padding: 40px 0 30px 0; border-radius:6px 6px 0px 0px;">
                    <h1>' . SITETITLE . ' - Forgot Password</h1>
                </td>
            </tr>
            <tr>
                <td style="padding: 10px; font-size:13px;">
                    <p>Hello ' . $admin_detail['fname'] . ',<br> We have recieved the request that you forgot the Password on ' . SITETITLE . '. Please find the below credentials to log in to your admin panel</p>
                </td>
            </tr>
            <tr>
                <td bgcolor="#f2f2f2" style="padding: 10px; font-size:13px;">
                    Username : <b> ' . $admin_detail['uname'] . '</b>
                </td>
            </tr>
            <tr>
                <td bgcolor="#f2f2f2" style="padding: 10px; font-size:13px;">
                    Password : <b> ' . base64_decode($admin_detail['password']) . '</b>
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
            $subject = "Forgot Password - " . SITETITLE . "";

            $mailsent = sendUserMail($to, $subject, $message);
            if ($mailsent) {
                $_SESSION['success'] = "<strong>Congratulations</strong> Username and Password has been sent to your Mail id <strong>" . $to . "</strong>";
            } else {
                $_SESSION['error'] = "<strong>Sorry</strong> Internal Server Error. Please try again later.";
            }
        }
    } else {
        $_SESSION['error'] = "<strong>Sorry</strong> Provided email id does not exists";
    }
}
header("location:forgot-password.php");
?>