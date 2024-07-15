<?php
require_once("classes/cls-request.php");
require_once("classes/phpmailer.php");

$obj_request = new Request();
$conn = $obj_request->getConnectionObj();
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}

$reqid=$_POST['reqid'];
$condition= "";
$insert_data['request_id'] = mysqli_real_escape_string($conn, $reqid);
$insert_data['comment'] = mysqli_real_escape_string($conn, $_POST['comment_txt']);
$insert_data['created_at'] = date("Y-m-d H:i:s");
$insert_data['updated_at'] = date("Y-m-d H:i:s");
$inscmt= $obj_request->insertComment($insert_data,$condition, 0);
$_SESSION['success'] = "Congratulations comment added successfully";


$condition1="`tbl_request`.`request_id`='". $reqid ."'";
$fields1 = "`tbl_request`.*,`tbl_admin`.f_name,lname,email_id,admin_id";
$request_details = $obj_request->getFullRequestLeadsDetails($fields1, $condition1, '', '', 0);
if($inscmt)
{
  $message="Comment added successfully";
}
else
{
  $message="Erro while adding comment";  
}
echo $message;
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