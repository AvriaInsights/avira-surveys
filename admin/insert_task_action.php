<?php
require_once("classes/cls-request.php");
require_once("classes/phpmailer.php");

$obj_request = new Request();
$conn = $obj_request->getConnectionObj();
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}

$reqid=$_POST['reqid'];
$taskdate=$_POST['taskdate'];
$tasktype=$_POST['tasktype'];
$taskassigned=$_POST['taskassigned'];
$taskdetails=$_POST['taskdetails'];
$insert_data['request_id'] = mysqli_real_escape_string($conn, $reqid);
$insert_data['task_type'] = mysqli_real_escape_string($conn, $tasktype);
$insert_data['task_assigned_to'] = mysqli_real_escape_string($conn, $taskassigned);
$insert_data['task_datetime'] = mysqli_real_escape_string($conn, $taskdate);
$insert_data['task_detail'] = mysqli_real_escape_string($conn, $taskdetails);
$insert_data['created_at'] = date("Y-m-d h:i:s");
$insert_data['updated_at'] = date("Y-m-d h:i:s");
$lastinsertid = $obj_request->insertLeadsTask($insert_data, 0);
$_SESSION['success'] = "Congratulations task added successfully";



$condition1="`tbl_task`.`task_id`='". $lastinsertid ."'";
$fields1 = "`tbl_task`.*,`tbl_admin`.*,`tbl_request`.*";
$task_details = $obj_request->getFullTaskDetails($fields1, $condition1, '', '', 0);

if(!empty($task_details))
{
    foreach($task_details as $task_detail)
    {       $fetchtaskdattime = $task_detail['task_datetime'];
            $fetchtaskdattime1 = explode("T",$fetchtaskdattime);
            $fulldattime = $fetchtaskdattime1[0]." ".$fetchtaskdattime1[1];
            $content = "<html>";
            $content .= "<head>";
            $content .= "<title>". $task_detail['website'] . " - " . $task_detail['request_from_page'] ." for report id ". $task_detail['report_id'] ." new ". $task_detail['task_type'] . "task assigned you</title>";
            $content .= "</head>";
            $content .= "<body  style='font-family:Segoe UI; font-size:13px;'>";
            $content .= '<p>Dear <b>' .$task_detail['f_name'].' '.$task_detail['lname'].'</b>,</p>';
            $content .= '<p>Task is assigned for request  <strong>' . $task_detail['report_title'] . '</strong> report on ' . $fulldattime . '</p>
                             <p>Warm Regards,<br> Anuprit O. <br>' . SITETITLE . '</p>';
            $content .= "</body>";
            $content .= "</html>";

            $subject = $task_detail['website'] . " - " . $task_detail['request_from_page'] ." for report id ". $task_detail['report_id'] ." new ". $task_detail['task_type'] . " task assigned you";
            $sent_reciept = sendUserMail($task_detail['email_id'], $subject, $content);
    }        
}
?>