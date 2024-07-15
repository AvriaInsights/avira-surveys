<?php
require_once("classes/cls-survey.php");
require_once("classes/phpmailer.php");

$obj_survey = new Survey();
$conn = $obj_survey->getConnectionObj();

$currentdatetime = date("Y-m-d G:i"); 
$newtimestamp = strtotime($currentdatetime.'+ 1 minute');
$next15mindatetime = date('Y-m-d G:i', $newtimestamp);

$repcurrentdatetime = str_replace(" ","T",$currentdatetime);
$repnext15mindatetime = str_replace(" ","T",$next15mindatetime);


$fields_share = "*";
$condition_share = "`tbl_temp_share`.`later_datetime` Between '".$repcurrentdatetime."' and '".$repnext15mindatetime."'";
$share_lists=$obj_survey->getTempShareEmail($fields_share, $condition_share, '', '', 0);

foreach($share_lists as $share_list)
{
    $email=$share_list['temp_email'];
    $shareid=$share_list['share_id'];
    $tempid=$share_list['temp_id'];
    
    $fields_share_content = "*";
    $condition_share_content = "`tbl_share_content`.`share_id` ='".$shareid."'";
    $share_contents=$obj_survey->getShareContent($fields_share_content, $condition_share_content, '', '', 0);
    
    foreach($share_contents as $share_content)
    {
        $emailsubject = $share_content['email_subject'];
        $emailbody = $share_content['email_content'];
        $fromname = $share_content['from_name'];
        $shareurl = $share_content['share_url'];
    }
    
    $message = $emailbody;
    $message .='Share URL is: '.$shareurl;
    $subject = $emailsubject;
    $sent_reciept = sendMailByClient($fromname,$email, $subject, $message);
    
    if($sent_reciept)
    {
        $condition = "`tbl_temp_share`.`temp_id` =".$tempid;
        $obj_survey->deleteTempShareEmail($condition, 0);
    }
    
}

 //$sent_reciept = sendMailByClient("test","amrita.prasad@12thwonder.com", "Intel", "Hello");
?>