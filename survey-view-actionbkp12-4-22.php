<?php
require_once("survey/classes/cls-survey.php");
require_once("survey/classes/phpmailer.php");

$obj_survey = new Survey();
$conn = $obj_survey->getConnectionObj();


$allquestionids=$_POST['allquestionids'];
$allanswers=$_POST['allanswers'];
$fname=$_POST['fname'];
$email=$_POST['email'];
$surveyid=$_POST['surveyid'];
$userid=$_POST['userid'];


$insert_data['survey_id'] = mysqli_real_escape_string($conn, $surveyid);
$insert_data['user_id'] = mysqli_real_escape_string($conn, $userid);
$insert_data['user_fullname'] = mysqli_real_escape_string($conn, $fname);
$insert_data['user_email'] = mysqli_real_escape_string($conn, $email);
$insert_data['status'] = "Active";
$insert_data['created_at'] = date("Y-m-d h:i:s");
$insert_data['updated_at'] = date("Y-m-d h:i:s");
$lastinsertid = $obj_survey->insertResponseUser($insert_data, 0);


$allquest = explode(";",$allquestionids);
$allans = explode(";",$allanswers);
for($i=0;$i<count($allquest);$i++)
{   $answer="";
    $question=$allquest[$i];
    $answer=$allans[$i];
    $fields_questions = "question_title";
    $condition_questions = "`tbl_questionBank`.`survey_id` ='".$surveyid."' and `tbl_questionBank`.`question_id` ='".$question."'";
    $all_questions=$obj_survey->getQuestionBank($fields_questions, $condition_questions, '', '', 0);
    foreach($all_questions as $all_question)
    {
        $question_title = $all_question['question_title'];
    }
    
     if(strpos($answer, "*") !== false)
     {
        $staranswer=explode("*",$answer);
        for($t=0;$t<count($staranswer);$t++)
        {
            if(strpos($staranswer[$t], "::") !== false)
            {
                $rankanswer=explode("::",$staranswer[$t]);
                $rankanswerdb=$rankanswer[0];
                $rankansweradd=$rankanswer[1];
                
                    $insert_data1['response_user_id'] = mysqli_real_escape_string($conn, $lastinsertid);
                    $insert_data1['question_id'] = mysqli_real_escape_string($conn, $question);
                    $insert_data1['question_title'] = mysqli_real_escape_string($conn, $question_title);
                    $insert_data1['answer'] = mysqli_real_escape_string($conn, $rankanswerdb);
                    $insert_data1['answer_additional'] = mysqli_real_escape_string($conn, $rankansweradd);
                    $obj_survey->insertResponseResult($insert_data1, 0);
                
            }
            else
            {
                if(strpos($staranswer[$t], "Other") !== false)
                {
                    $otheranswerchk=explode("(",$staranswer[$t]);
                    $otanschk=$otheranswerchk[0];
                    $otheransweraddchk=trim($otheranswerchk[1],")");
                    $insert_data1['response_user_id'] = mysqli_real_escape_string($conn, $lastinsertid);
                    $insert_data1['question_id'] = mysqli_real_escape_string($conn, $question);
                    $insert_data1['question_title'] = mysqli_real_escape_string($conn, $question_title);
                    $insert_data1['answer'] = mysqli_real_escape_string($conn, $otanschk);
                    $insert_data1['answer_additional'] = mysqli_real_escape_string($conn, $otheransweraddchk);
                    $obj_survey->insertResponseResult($insert_data1, 0);
                }
                else
                {
                    $insert_data1['response_user_id'] = mysqli_real_escape_string($conn, $lastinsertid);
                    $insert_data1['question_id'] = mysqli_real_escape_string($conn, $question);
                    $insert_data1['question_title'] = mysqli_real_escape_string($conn, $question_title);
                    $insert_data1['answer'] = mysqli_real_escape_string($conn, $staranswer[$t]);
                    $insert_data1['answer_additional'] = mysqli_real_escape_string($conn, "");
                    $obj_survey->insertResponseResult($insert_data1, 0);
                }
            }
            
        }
     }
     else
     {
        if(strpos($answer, "Other") !== false)
        {
            $otheranswer=explode("(",$answer);
            $otans=$otheranswer[0];
            $otheransweradd=trim($otheranswer[1],")");
            $insert_data1['response_user_id'] = mysqli_real_escape_string($conn, $lastinsertid);
            $insert_data1['question_id'] = mysqli_real_escape_string($conn, $question);
            $insert_data1['question_title'] = mysqli_real_escape_string($conn, $question_title);
            $insert_data1['answer'] = mysqli_real_escape_string($conn, $otans);
            $insert_data1['answer_additional'] = mysqli_real_escape_string($conn, $otheransweradd);
            $obj_survey->insertResponseResult($insert_data1, 0);
        }
        else
        {
            $insert_data1['response_user_id'] = mysqli_real_escape_string($conn, $lastinsertid);
            $insert_data1['question_id'] = mysqli_real_escape_string($conn, $question);
            $insert_data1['question_title'] = mysqli_real_escape_string($conn, $question_title);
            $insert_data1['answer'] = mysqli_real_escape_string($conn, $answer);
             $insert_data1['answer_additional'] = mysqli_real_escape_string($conn, "");
            $obj_survey->insertResponseResult($insert_data1, 0);
        }
     }
    
}

if($lastinsertid)
{
    $fields_response_user = "*";
    $condition_response_user = "`tbl_response_user`.`response_user_id` ='".$lastinsertid."'";
    $all_response_users = $obj_survey->getSurveyUser($fields_response_user, $condition_response_user, '', '', 0);
    
    foreach($all_response_users as $all_response_user)
    {
        $fullname = $all_response_user['user_fullname'];
        $email_ids = $all_response_user['user_email'];
        
    }
    
    $fields_survey= "`survey_title`";
    $condition_survey = "`tbl_survey`.`survey_id` = '".$surveyid."'";
    $all_surveys_details = $obj_survey->getSurveyDetail($fields_survey, $condition_survey, '', '', 0);
    foreach($all_surveys_details as $all_surveys_detail)
    {
        $surveyname = $all_surveys_detail['survey_title'];
    }
    
    $fields_response_result = "*";
    $condition_response_result = "`tbl_response_result`.`response_user_id` ='".$lastinsertid."'";
    $orderby_ans="`tbl_response_result`.`result_id` asc";
    $all_response_results = $obj_survey->getSurveyResult($fields_response_result, $condition_response_result, $orderby_ans, '', 0);
    
    $message = "<html>";
            $message .= "<head>";
            $message .= "<title>Survey " . $email_ids . "</title>";
            $message .= "</head>";
            $message .= "<body  style='font-family:Segoe UI; font-size:13px;'>";
            $message .= "<h2>Survey Name: " . $surveyname ." </h2> <br>";
            $message .= ' 
                      <table style="border-collapse:collapse;">  
                      
                            <tr> <th style="background-color: #17C1C8; color: #fff;border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Title of Survey</th>
                             
                            <th style="background-color: #17C1C8; color: #fff;border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Full Name</th>
                             
                             <th style="background-color: #17C1C8; color: #fff;border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Email Id</th>
                             
                            </tr>
                            
                            <tr>
                              <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . $surveyname . '</td>
                              
                              <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . $fullname . '</td>
                             
                              <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . $email_ids . '</td>
                            </tr>
                        </table>
                       <br/>
                       ';
            $message .= "<table style='border-collapse:collapse'>";
           //if(isset($all_response_results) && !empty($all_response_results))
           //{
               
            $message .= '  <tr>
                             <th style="background-color: #17C1C8; color: #fff;border: 0.3px solid #00000047; text-align: left; padding: 8px; width: 50%;">Question and Answer</td>
                           </tr>';
            $k=1;
            for($i=0;$i<count($allquest);$i++)
            {
                $answer="";
                $question=$allquest[$i];
                //$answer=$allans[$i];
                $fields_questions = "question_title,quest_type_id";
                $condition_questions = "`tbl_questionBank`.`survey_id` ='".$surveyid."' and `tbl_questionBank`.`question_id` ='".$question."'";
                $all_questions=$obj_survey->getQuestionBank($fields_questions, $condition_questions, '', '', 0);
                foreach($all_questions as $all_question)
                {
                    $question_title = $all_question['question_title'];
                    $quest_type_id = $all_question['quest_type_id'];
                }
                
                $fields_questtype = "quest_type";
                $condition_questtype = "`tbl_question_type`.`quest_type_id` =".$quest_type_id;
                $all_question_types=$obj_survey->getQuestionType($fields_questtype, $condition_questtype, '', '', 0);
                foreach($all_question_types as $all_question_type){
                    $qtype=$all_question_type['quest_type'];
                    if($qtype=="Mrating")
                    {
                        $qtype="Multiple Rating";
                    }
                }

                //$answer="";
                if(strpos($allans[$i], "*") !== false)
                {
                     
                     $ansarray=explode("*",$allans[$i]);
                     $sno="1";
                     for($kk=0;$kk<count($ansarray);$kk++)
                     {
                         $answer.="<br>".$sno.")".$ansarray[$kk];
                         $sno++;
                     }
                }
                else
                {
                     $answer = $allans[$i];
                }
                $message .= '
                           <tr>
                               <td style="border: 0.3px solid #00000047; text-align: left; padding: 8px; font-size: 16px; color:red;"><b>Question '.$k.') </b>' . stripslashes($question_title) . ' ('.$qtype.')</td>
                           </tr>
                           <tr>
                               <td style="border: 0.3px solid #00000047; text-align: left; padding: 8px; font-size: 16px;"><b>Answer. </b>' . $answer . '</td>
                           </tr>
                        ';
              $k++;
            }
           //}
           $message .= "</table>";
           $message .= "</body>";
           $message .= "</html>";
          
           
            $subject = "Feedback From - ". $email_ids." ";
            
            $mailsent = sendBuildAnalystMail($subject, $message);
            
            if($mailsent)
            {
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= "From: " . SITETITLE . "";

            $content = "<html>";
            $content .= "<head>";
            $content .= "<title>" . SITETITLE . " Received Your Survey</title>";
            $content .= "</head>";
            $content .= "<body style='font-family:Segoe UI; font-size:13px;'>";
            $content .= '<p>Dear ' .$fullname.',</p>';
            $content .= '<p>Thanks for your participation in <strong>' . $surveyname . '</strong>.</p>
            <p>We appreciate your opinions and perspectives, and as a token of appreciation, we will be sharing our key insights once this research survey is concluded.</p>
            <p>Our analysts love interacting and sharing coffee with industry veterans and subject matter experts. Sharing a coffee could be too much to ask in the current scenario, so we propose a quick chat over Microsoft Teams/Zoom.</p>
            <p>Please share a convenient time and we will share an invite.</p>
            <p>We are 24x7 reachable at <strong>contactus@avirasurveys.com</strong></p>
            <p>Warm Regards,<br> Vishwanath G.</p>';
            $content .= "</body>";
            $content .= "</html>";
            

            $to = trim($_POST['email']);
            $subject = "Avira Surveys - " . SITETITLE . "";

            $mailsent = sendUserMail($to, $subject, $content);
            }

}

?>