<?php
require_once("classes/cls-request.php");
require_once("classes/phpmailer.php");

$obj_request = new Request();
$conn = $obj_request->getConnectionObj();
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}

$reqid=$_POST['reqid'];
$meetingstarttime=$_POST['meetingstarttime'];
$meetingendtime=$_POST['meetingendtime'];
$meetingtitle=$_POST['meetingtitle'];
$meetingdescription=$_POST['meetingdescription'];
$meetingattendes=$_POST['meetingattendes'];
$assignmeeting=$_POST['assignmeeting'];
$skypedetail=$_POST['skypedetail'];

$insert_data['request_id'] = mysqli_real_escape_string($conn, $reqid);
$insert_data['meeting_title'] = mysqli_real_escape_string($conn, $meetingtitle);
$insert_data['meeting_from_time'] = mysqli_real_escape_string($conn, $meetingstarttime);
$insert_data['meeting_to_time'] = mysqli_real_escape_string($conn, $meetingendtime);
$insert_data['meeting_attendes'] = mysqli_real_escape_string($conn, $meetingattendes);
$insert_data['meeting_description'] = mysqli_real_escape_string($conn, $meetingdescription);
$insert_data['meeting_skypeid'] = mysqli_real_escape_string($conn, $skypedetail);
$insert_data['task_type'] = "Meeting";
$insert_data['task_assigned_to'] = mysqli_real_escape_string($conn, $assignmeeting);
$insert_data['created_at'] = date("Y-m-d h:i:s");
$insert_data['updated_at'] = date("Y-m-d h:i:s");
$lastinsertid = $obj_request->insertLeadsTask($insert_data, 0);
if($lastinsertid)
{
    echo "Congratulations meeting added successfully";
}

$condition1="`tbl_task`.`task_id`='". $lastinsertid ."'";
$fields1 = "`tbl_task`.*,`tbl_admin`.*,`tbl_request`.*";
$task_details = $obj_request->getFullTaskDetails($fields1, $condition1, '', '', 0);

if(!empty($task_details))
{
    foreach($task_details as $task_detail)
    {       $fetchstartdattime = $task_detail['meeting_from_time'];
            $fetchstartdattimearray = explode("T",$fetchstartdattime);
            $fulldattime = $fetchstartdattimearray[0]." ".$fetchstartdattimearray[1];
            $content = "<html>";
            $content .= "<head>";
            $content .= "<title>". $task_detail['website'] . " - " . $task_detail['request_from_page'] ." for report id ". $task_detail['report_id'] ." new ". $task_detail['task_type'] . " has been scheduled</title>";
            $content .= "</head>";
            $content .= "<body  style='font-family:Segoe UI; font-size:13px;'>";
            $content .= '<p>Dear <b>' .$task_detail['f_name'].' '.$task_detail['lname'].'</b>,</p>';
            $content .= '<p>Meeting has been scheduled for request  <strong>' . $task_detail['report_title'] . '</strong> report on ' . $fulldattime . '</p>
                             <p>Warm Regards,<br> Anuprit O. <br>' . SITETITLE . '</p>';
            $content .= "</body>";
            $content .= "</html>";

            $subject = $task_detail['website'] . " - " . $task_detail['request_from_page'] ." for report id ". $task_detail['report_id'] ." new ". $task_detail['task_type'] . " has been scheduled";
            $sent_reciept = sendUserMail($task_detail['email_id'], $subject, $content);
            
            $attendes=$task_detail['meeting_attendes'];
            $attendessplit = explode(",",$attendes);
            for($i=0;$i<count($attendessplit);$i++)
            {
                $fetchstartdattime = $task_detail['meeting_from_time'];
                $fetchstartdattimearray = explode("T",$fetchstartdattime);
                $fulldattime = $fetchstartdattimearray[0]." ".$fetchstartdattimearray[1];
                $content = "<html>";
                $content .= "<head>";
                $content .= "<title>". $task_detail['website'] . " - " . $task_detail['request_from_page'] ." for report id ". $task_detail['report_id'] ." new ". $task_detail['task_type'] . " has been scheduled</title>";
                $content .= "</head>";
                $content .= "<body  style='font-family:Segoe UI; font-size:13px;'>";
                $content .= '<p>Dear,</p>';
                $content .= '<p>Meeting has been scheduled for request  <strong>' . $task_detail['report_title'] . '</strong> report on ' . $fulldattime . '</p>
                                 <p>Warm Regards,<br> Anuprit O. <br>' . SITETITLE . '</p>';
                $content .= "</body>";
                $content .= "</html>";
    
                $subject = $task_detail['website'] . " - " . $task_detail['request_from_page'] ." for report id ". $task_detail['report_id'] ." new ". $task_detail['task_type'] . " has been scheduled";
                $sent_reciept = sendUserMail($attendessplit[$i], $subject, $content);
            }
    }        
}


?>