<?php
require_once("classes/cls-request.php");
require_once("classes/phpmailer.php");

$obj_request = new Request();
$conn = $obj_request->getConnectionObj();
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}

$reqid=$_POST['reqid'];
$assignleadid=$_POST['assignleadid'];
$message=$_POST['message'];
$leadtype=$_POST['leadtype'];
$leadscores=$_POST['leadscores'];
$leadstage=$_POST['leadstages'];
$relid=trim($_POST['relevanceid'],",");
$relarray=explode(",",$relid);
$relpercent = count($relarray)*20;
$condition= "`request_id` = '" . $reqid . "'";
$insert_data['assigned_leads'] = mysqli_real_escape_string($conn, $assignleadid);
//$insert_data['leads_comment'] = mysqli_real_escape_string($conn, $_POST['comment_txt']."\n");
$insert_data['priority_wise'] = mysqli_real_escape_string($conn, $leadtype);
$insert_data['priority_percent'] = mysqli_real_escape_string($conn, $leadscores);
$insert_data['comment'] = mysqli_real_escape_string($conn, $message);
$insert_data['lead_stage'] = mysqli_real_escape_string($conn, $leadstage);
$insert_data['relevance_ids'] = mysqli_real_escape_string($conn, $relid);
$insert_data['relevance_percent'] = mysqli_real_escape_string($conn, $relpercent);
$resultlead =$obj_request->updateLeadsRequest($insert_data,$condition, 0);
//$_SESSION['success'] = "Congratulations lead added successfully";


$condition1="`tbl_request`.`request_id`='". $reqid ."'";
$fields1 = "`tbl_request`.*,`tbl_admin`.f_name,lname,email_id,admin_id";
$request_details = $obj_request->getFullRequestLeadsDetails($fields1, $condition1, '', '', 0);
if($resultlead)
{
    echo "Congratulations lead info updated successfully";
}
else
{
    echo "Error in processing update";
}
/*if(!empty($request_details))
{
    foreach($request_details as $request_detail)
    {
        if($request_detail['website']=="Researchcmfe")
        {
            $contact_email="contactus@researchcmfe.com";
        }
        if($request_detail['website']=="AllTheResearch")
        {
            $contact_email="contactus@alltheresearch.com";
        }
        
            $content = "<html>";
            $content .= "<head>";
            $content .= "<title>". $request_detail['website'] . " - " . $request_detail['request_from_page'] ." for report id ". $request_detail['report_id'] ." assigned you</title>";
            $content .= "</head>";
            $content .= "<body  style='font-family:Segoe UI; font-size:13px;'>";
            $content .= '<p>Dear <b>' .$request_detail['f_name'].' '.$request_detail['lname'].'</b>,</p>';
            $content .= '<p>Leads assign to you for <strong>' . $request_detail['report_title'] . '</strong> report.</p>
                             <p>Warm Regards,<br> Anuprit O. <br>' . SITETITLE . '</p>';
            $content .= "</body>";
            $content .= "</html>";

            $subject = $request_detail['website'] . " - " . $request_detail['request_from_page'] ."for report id". $request_detail['report_id'] ."assigned you";
            $sent_reciept = sendUserMail($request_detail['email_id'], $subject, $content);
    }        
}*/
?>