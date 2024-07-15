<?php
require_once("survey/classes/cls-survey.php");
require_once("survey/classes/phpmailer.php");

$obj_survey = new Survey();
$conn = $obj_survey->getConnectionObj();

    $fields_response_user = "*";
    $condition_response_user = "`tbl_response_user`.`survey_fill_position` ='Half'";
    $all_response_users = $obj_survey->getSurveyUser($fields_response_user, $condition_response_user, '', '', 0);
    
    foreach($all_response_users as $all_response_user)
    {
        $fullname = $all_response_user['user_fullname'];
        $email_ids = $all_response_user['user_email'];
        $phone_nos = $all_response_user['phone_no'];
        $url_source_tab = $all_response_user['url_source'];
        $ipaddr = $all_response_user['ip_address'];
        $surveyid = $all_response_user['survey_id'];
        $userid = $all_response_user['response_user_id'];
        $mail_cnt = $all_response_user['mail_cnt'];
        
        if($mail_cnt<3)
        {
            $fields_survey= "`survey_title`";
            $condition_survey = "`tbl_survey`.`survey_id` = '".$surveyid."'";
            $all_surveys_details = $obj_survey->getSurveyDetail($fields_survey, $condition_survey, '', '', 0);
            foreach($all_surveys_details as $all_surveys_detail)
            {
                $surveyname = $all_surveys_detail['survey_title'];
                $survey_url = strtolower($all_surveys_detail['survey_title']);
                $survey_url = str_replace(' ', '-', $survey_url); 
            }
            
            $linkurl= SITEPATHFRONT."survey-view/".$surveyid."/".$survey_url."?uid=".base64_encode($userid);
        
            
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= "From: " . SITETITLE . "";
    
            $content = "<html>";
            $content .= "<head>";
            $content .= "<title>" . SITETITLE . " Received Your Survey</title>";
            $content .= "</head>";
            $content .= "<body style='font-family:Segoe UI; font-size:13px;'>";
            $content .= '<p>Dear ' .$fullname.',</p>';
            $content .= '<p>We noticed you left midway through the survey <strong><a href="'.$linkurl.'" target="_blank">' . $surveyname . '</a></strong></p>
            <p>Presuming you are busy, we request you to please continue with the survey and complete the same to receive a complementary research report from our end.</p>
            <p>In case of any technical difficulties, please feel free to reach out to <strong>contactus@avirasurveys.com</strong>.</p>
            <p>Appreciate your participation.</p>
            <p>Have a great rest of the day ahead.</p>
            <p>Warm Regards,<br> Neha <br> neha@alltheresearch.com <br> Customer Support Team <br>'.SITETITLE.'</p>';
            $content .= "</body>";
            $content .= "</html>";
            //echo $content;
    
            $to = trim($email_ids);
            $subject = "Your Response to this Avira Survey is Vital";
    
            $mailsent = sendUserMail($to, $subject, $content);
            if($mailsent)
            {
                $mail_cnt_upd=$mail_cnt+1;
                $update_data['mail_cnt'] = $mail_cnt_upd;
                $condition = "`tbl_response_user`.`response_user_id` = '" . $userid . "'";
                $lastupdateidsurvey = $obj_survey->UpdateResponseUser($update_data,$condition, 0);
            }
        }
    }

?>