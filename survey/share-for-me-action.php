<?php
require_once("classes/cls-survey.php");
require_once("classes/phpmailer.php");

$obj_survey = new Survey();
$conn = $obj_survey->getConnectionObj();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}

$emailsubject=$_POST['emailsubject'];
$emailcontent=$_POST['editor1'];
$userid=$_POST['userid'];
$surveyid=$_POST['surveyid'];
$shareurl=$_POST['shareurl'];

$insert_data['email_subject'] = mysqli_real_escape_string($conn, $emailsubject);
$insert_data['email_content'] = mysqli_real_escape_string($conn, $emailcontent);
$insert_data['user_id'] = mysqli_real_escape_string($conn, $userid);
$insert_data['survey_id'] = mysqli_real_escape_string($conn, $surveyid);
$insert_data['share_url'] = mysqli_real_escape_string($conn, $shareurl);
$insert_data['status'] = "Active";
$insert_data['created_at'] = date("Y-m-d h:i:s");
$insert_data['updated_at'] = date("Y-m-d h:i:s");
$lastinsertid = $obj_survey->insertShareData($insert_data, 0);

if($lastinsertid)
{
    $fields="*";
    $condition="`tbl_client_user`.`client_id` =".$userid;
    $user_details = $obj_survey->getUserDetails($fields, $condition, '', '', 0);
    foreach($user_details as $user_detail)
    {
        $userfname=$user_detail['fname'];
        $userlname=$user_detail['lname'];
        $fullname=$userfname." ".$userlname;
    }
    $message = "<html>";
    $message .= "<head>";
    $message .= "<title>Share For Me Survey</title>";
    $message .= "</head>";
    $message .= "<body  style='font-family:Segoe UI; font-size:13px;'>";
    
    $message .= '<p>Dear Team,<br><br>'.$fullname.' has sent details to share survey. Please find the below details</p>';
    $message .= $emailcontent;            
	$message .='Share URL is: '.$shareurl;
	$message .='<table border="0" cellpadding="0" cellspacing="0" width="100%" style="padding-top:20px;"><tr>
                <td align="center" bgcolor="#00538d" style="padding: 40px 0 30px 0; color:#FFFFFF; border-radius:0px 0px 6px 6px">
                    <h4>' . SITETITLE . '</h4><small>&copy; All Rights Reserved ' . date("Y") . '</small>
                </td>
            </tr>
            </table>';
    $message .= "</body>";
    $message .= "</html>";
    //echo $message;die();
    $subject = $emailsubject;
    $mailsent = sendBuildAnalystMail($subject, $message);
    if($mailsent)
    {
         header("Location:" . SITEPATH . "thank-you.php");
    }
}
  header("Location:" . SITEPATH . "thank-you.php"); 
?>