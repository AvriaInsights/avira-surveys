<?php
require_once("classes/cls-survey.php");
require_once("classes/phpmailer.php");

$obj_survey = new Survey();
$conn = $obj_survey->getConnectionObj();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}

$fname=$_POST['fname'];
$fromname=$_POST['fromname'];
$subject=$_POST['subject'];
$content=$_POST['content'];
$contact=$_POST['contact'];
$scheduleday=$_POST['scheduleday'];
$arr="";
if(is_uploaded_file($_FILES['contactcsv']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['contactcsv']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            $insert_dataa1['user_id'] = mysqli_real_escape_string($conn, $_POST['userid']);
            $insert_dataa1['survey_id'] = mysqli_real_escape_string($conn, $_POST['surveyid']);
            $insert_dataa1['email_subject'] = mysqli_real_escape_string($conn, $_POST['subject']);
            $insert_dataa1['email_content'] = mysqli_real_escape_string($conn, $_POST['content']);
            $insert_dataa1['name'] = mysqli_real_escape_string($conn, $_POST['fname']);
            $insert_dataa1['from_name'] = mysqli_real_escape_string($conn, $_POST['fromname']);
            $insert_dataa1['share_url'] = mysqli_real_escape_string($conn, $_POST['shareurl']);
            $insert_dataa1['created_at'] = date("Y-m-d H:i:s");
            $lastinsertid=$obj_survey->insertShareData($insert_dataa1, 0);
            
            while(($line = fgetcsv($csvFile)) !== FALSE){
                
                // Get row data
                $email   = $line[0];
                $arr.=$email.",";
                
                if($scheduleday=="Send Now")
                {
                    $message = $_POST['content'];
                    $message .='Share URL is: '.$_POST['shareurl'];
                    $subject = $_POST['subject'];
                    $sent_reciept = sendUserMail($email, $subject, $message);
                }
                if($scheduleday=="Schedule Later")
                {
                    $insert_dataa['share_id'] = mysqli_real_escape_string($conn, $lastinsertid);
                    $insert_dataa['temp_email'] = mysqli_real_escape_string($conn, $email);
                    $insert_dataa['later_datetime'] = mysqli_real_escape_string($conn, $_POST['latertime']);
                    $insert_dataa['created_at'] = date("Y-m-d H:i:s");
                    $obj_survey->insertShareTempData($insert_dataa, 0);
                }
            }
            
            $arrall=trim($arr,",");
            $update_data['all_emails'] = mysqli_real_escape_string($conn, $arrall);
            $condition = "`tbl_share_content`.`share_id` = '" . $lastinsertid . "'";
            $lastupdateid = $obj_survey->updateShareData($update_data,$condition, 0);
            
}
else
{
            $insert_dataa1['user_id'] = mysqli_real_escape_string($conn, $_POST['userid']);
            $insert_dataa1['survey_id'] = mysqli_real_escape_string($conn, $_POST['surveyid']);
            $insert_dataa1['email_subject'] = mysqli_real_escape_string($conn, $_POST['subject']);
            $insert_dataa1['email_content'] = mysqli_real_escape_string($conn, $_POST['content']);
            $insert_dataa1['name'] = mysqli_real_escape_string($conn, $_POST['fname']);
            $insert_dataa1['from_name'] = mysqli_real_escape_string($conn, $_POST['fromname']);
            $insert_dataa1['share_url'] = mysqli_real_escape_string($conn, $_POST['shareurl']);
            $insert_dataa1['all_emails'] = mysqli_real_escape_string($conn, $_POST['contact']);
            $insert_dataa1['created_at'] = date("Y-m-d H:i:s");
            $lastinsertid=$obj_survey->insertShareData($insert_dataa1, 0);
            
            $alltextcontact=$_POST['contact'];
            $allcontact=explode(",",$alltextcontact);

            if($scheduleday=="Send Now")
            {
                for($i=0;$i<count($allcontact);$i++)
                {
                    $email=$allcontact[$i];
                    $message = $_POST['content'];
                    $message .='Share URL is: '.$_POST['shareurl'];
                    $subject = $_POST['subject'];
                    $sent_reciept = sendUserMail($email, $subject, $message);
                }
            }
            if($scheduleday=="Schedule Later")
            {
                for($i=0;$i<count($allcontact);$i++)
                {
                    $email=$allcontact[$i];
                    $insert_dataa['share_id'] = mysqli_real_escape_string($conn, $lastinsertid);
                    $insert_dataa['temp_email'] = mysqli_real_escape_string($conn, $email);
                    $insert_dataa['later_datetime'] = mysqli_real_escape_string($conn, $_POST['latertime']);
                    $insert_dataa['created_at'] = date("Y-m-d H:i:s");
                    $obj_survey->insertShareTempData($insert_dataa, 0);
                }
            }
                        
}

header("Location:" . SITEPATH . "thank-you.php"); 
?>