<?php
require_once("classes/cls-survey.php");

$obj_survey = new Survey();


if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login");
}
$surveyid=$_GET['surveyid'];
$condition = "`tbl_response_user`.`status` = 'Active' and `tbl_response_user`.`survey_id`='".$_GET['surveyid']."' and (`tbl_response_user`.`survey_fill_position` = 'Blank' or `tbl_response_user`.`survey_fill_position` = 'Half')";

if(isset($_GET['daterange']))
{
    $daterange=$_GET['daterange'];
}
else
{
    $daterange="";
}

if($daterange!="")
{  //05/12/2022 - 06/21/2022
   $fulldate=explode("-",$daterange);
   $fromdate=$fulldate[0];
   $splitfrom=explode("/",$fromdate);
   $newfromdate=trim($splitfrom[2]).":".trim($splitfrom[0]).":".trim($splitfrom[1]);
   $todate=$fulldate[1];
   $splitto=explode("/",$todate);
   $newtodate=trim($splitto[2])."-".trim($splitto[0])."-".trim($splitto[1]);
   //echo $todat=date_create('.$newtodate.');
  // $todat=date_format($todat33,"Y:m:d");
   //die();
   $newplustodate=date('Y:m:d', strtotime($newtodate.'+1 days'));
   $condition.=" and (`tbl_response_user`.`created_at` BETWEEN '".$newfromdate."' and '".$newplustodate."')";
}
$orderby="`tbl_response_user`.`response_user_id` desc";
$fields = "*";
$campaign_survey_details = $obj_survey->getSurveyUser($fields, $condition, $orderby,'', 0);

/**********Survey Details***********/
$condition_survey="`tbl_survey`.`survey_id`='".$_GET['surveyid']."'";
$survey_details = $obj_survey->getSurveyDetail($fields, $condition_survey, '','', 0);
$survey_detail=end($survey_details);
$survey_title=$survey_detail['survey_title'];
$survey_url = strtolower($survey_detail['survey_title']);
$survey_url = str_replace(' ', '-', $survey_url); 

$survey_url=SITEPATHFRONT."survey-view/".$survey_detail['survey_id']."/".$survey_url;
/***********End Survey Details*********/

if (isset($campaign_survey_details) && !empty($campaign_survey_details)) {
    $delimiter = ",";
    $filename = "campaign-survey-list-" . time() . ".csv";

    $f = fopen('php://memory', 'w');

    $header = array('Sr. No', 'Survey ID','Survey Title','Survey URL','Fullname','Email ID','IP Address', 'Survey Status','Question Count','Last Question Attempted' ,'Feedback','Created Date');
    fputcsv($f, $header, $delimiter);
    $i=1;
    
    foreach ($campaign_survey_details as $campaign_survey_detail) {
        $fullname=$campaign_survey_detail['user_fullname'];
        $email=$campaign_survey_detail['user_email'];
        $ipaddress=$campaign_survey_detail['ip_address'];
        $survey_fill_post=$campaign_survey_detail['survey_fill_position'];
        $createddate=$campaign_survey_detail['created_at'];
        
        /*******Campaign Detail*********/
            $condition_camp="`tbl_campaign_user`.`camp_response_user_id`='".$campaign_survey_detail['response_user_id']."'";
            $camps=$obj_survey->getCampaignSurveyDetails($fields, $condition_camp, '', '', 0);
            $camp=end($camps);
            $question_cnt=$camp['q_count'];
            $last_attempted_question=$camp['q_last_attempt_qno'];
        /*******End Campaign Detail*********/
        
        /*******Feedback Detail********/
            $condition_fedbk="`tbl_feedback`.`feed_id`='".$campaign_survey_detail['feedback_id']."'";
            $feedbacks=$obj_survey->getFeedbackDetails($fields, $condition_fedbk, '', '', 0);
            $feedback=end($feedbacks);
            $feedbackdata=$feedback['feed_data'];
        /******End Campaign Detail********/
        
        $survey_counts = array("$i,$surveyid,$survey_title,$survey_url,$fullname,$email,$ipaddress,$survey_fill_post,$question_cnt,$last_attempted_question,$feedbackdata,$createddate");  
        
    
        foreach ($survey_counts as $survey_count) {
            fputcsv($f, explode(',',$survey_count));
        }
        $i++;
    }

    fseek($f, 0);

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    fpassthru($f);
}
?>
