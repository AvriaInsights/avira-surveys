<?php
require_once("survey/classes/cls-survey.php");
require_once("survey/classes/phpmailer.php");

$obj_survey = new Survey();
$conn = $obj_survey->getConnectionObj();


$allquestionids=$_POST['allquestionids'];
$allanswers=$_POST['allanswers'];
$surveyid=$_POST['surveyid'];
$sessipaddrlastform=trim($_POST['sessipaddrlastform']);
$sessfirstform=$_POST['sessfirstform'];

$lastinsertid="238746";
if($lastinsertid)
{
    
    $fields_response_user = "*";
    $condition_response_user = "`tbl_response_user`.`response_user_id` ='".$lastinsertid."'";
    $all_response_users = $obj_survey->getSurveyUser($fields_response_user, $condition_response_user, '', '', 0);
    
    foreach($all_response_users as $all_response_user)
    {
        $fullname = $all_response_user['user_fullname'];
        $email_ids = $all_response_user['user_email'];
        $phone_nos = $all_response_user['phone_no'];
        $url_source_tab = $all_response_user['url_source'];
        $ipaddr = $all_response_user['ip_address'];
    }
    
    $fields_survey= "`survey_title`, `survey_purpose`, `campaign_name`";
    $condition_survey = "`tbl_survey`.`survey_id` = '".$surveyid."'";
    $all_surveys_details = $obj_survey->getSurveyDetail($fields_survey, $condition_survey, '', '', 0);
    foreach($all_surveys_details as $all_surveys_detail)
    {
        $surveyname = $all_surveys_detail['survey_title'];
        $survey_purpose = $all_surveys_detail['survey_purpose'];
        $campaign_name = $all_surveys_detail['campaign_name'];
        $survey_url = strtolower($all_surveys_detail['survey_title']);
        $survey_url = str_replace(' ', '-', $survey_url); 
    }
    
    $linkurl= SITEPATHFRONT."survey-view/".$surveyid."/".$survey_url;
    
    $message = "<html>";
            $message .= "<head>";
            $message .= "<title>Survey " . $email_ids . "</title>";
            $message .= "</head>";
            $message .= "<body  style='font-family:Segoe UI; font-size:13px;'>";
            $message .= "<h2>Survey Name: " . $surveyname ." </h2> <br>";
            $message .= ' 
                      <table style="border-collapse:collapse;">  
                            <tr> <th style="background-color: #17C1C8; color: #fff;border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Survey Objective</th>
                            
                            <th style="background-color: #17C1C8; color: #fff;border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Campaign Name</th>
                      
                           <th style="background-color: #17C1C8; color: #fff;border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Title of Survey</th>
                             
                            <th style="background-color: #17C1C8; color: #fff;border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Full Name</th>
                             
                             <th style="background-color: #17C1C8; color: #fff;border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Email Id</th>
                             
                             <th style="background-color: #17C1C8; color: #fff;border: 0.3px solid #0000000d; text-align: left; padding: 8px;">IP Address</th>';
            if($phone_nos!="")
            {
                $message .='  <th style="background-color: #17C1C8; color: #fff;border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Phone Number</th>';
            }   
            if($url_source_tab!="" && !empty($url_source_tab))
            {
                $message .='  <th style="background-color: #17C1C8; color: #fff;border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Source</th>';
            }   
            $message .=' </tr>
                            
                            <tr>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . $survey_purpose . '</td>
                                
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . $campaign_name . '</td>
                                
                              <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;"><a href="'.$linkurl.'" target="_blank">' . $surveyname . '</a></td>
                              
                              <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . $fullname . '</td>
                             
                              <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . $email_ids . '</td>
                              
                              <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . $ipaddr . '</td>';
            if($phone_nos!="")
            {                  
                $message .='<td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . $phone_nos . '</td>';
            }
            if($url_source_tab!="" && !empty($url_source_tab))
            {                  
                $message .='<td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . $url_source_tab . '</td>';
            }
            $message .='</tr>
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
                     if($qtype=="Order")
                    {
                        $qtype="Rank Order";
                    }
                }
                
                $fields_response_result = "*";
                $condition_response_result = "`tbl_response_result`.`response_user_id` ='".$lastinsertid."' and `tbl_response_result`.`question_id` ='".$question."'";
                $orderby_ans="`tbl_response_result`.`result_id` asc";
                $all_response_results = $obj_survey->getSurveyResult($fields_response_result, $condition_response_result, $orderby_ans, '', 0);
                //$answer="";
                if(count($all_response_results)>1)
                {    $sno="1";
                     foreach($all_response_results as $all_response_result)
                     {
                         if($all_response_result['answer_additional']!="")
                         {
                           $answer.="<br>".$sno.")".$all_response_result['answer']." :: ".stripslashes($all_response_result['answer_additional']);
                         }
                         else
                         {
                           $answer.="<br>".$sno.")".$all_response_result['answer'];  
                         }
                         $sno++;
                     }
                     
                }
                else
                {
                     foreach($all_response_results as $all_response_result)
                     {
                         if($all_response_result['answer_additional']!="")
                         {
                              $answer = $all_response_result['answer']." :: ".stripslashes($all_response_result['answer_additional']);
                         }
                         else
                         {
                             $answer = $all_response_result['answer']; 
                         }
                     }
                }
                if(strpos($answer, "=>") !== false)
                {
                    $srr=1;
                    $answer2="";
                    $answer=str_replace("=>"," &#11157; ",$answer);
                    $ansmat=explode(",",$answer);
                    for($tt=0;$tt<count($ansmat);$tt++)
                    {
                       $answer2.="<br>".$srr.") ".$ansmat[$tt]; 
                       $srr++;
                    }
                    $answer=$answer2;
                }
                $message .= '
                           <tr>
                               <td style="border: 0.3px solid #00000047; text-align: left; padding: 8px; font-size: 16px; color:red; font-style:italic;"><b>Question '.$k.') </b>' . stripslashes($question_title) . ' ('.$qtype.')</td>
                           </tr>
                           <tr>
                               <td style="border: 0.3px solid #00000047; text-align: left; padding: 8px; font-size: 16px;"><b>Answer. </b>' . stripslashes($answer) . '</td>
                           </tr>
                        ';
              $k++;
            }
           //}
           $message .= "</table>";
           $message .= "</body>";
           $message .= "</html>";
          
           
            $subject = "Feedback From - ". $email_ids." ";
            
            if($surveyid=="74d5313c-41e6-4119-9d36-072c8cd2fec9" || $surveyid=="5ca9f3aa-8940-414c-a495-a0967257067c" || $surveyid="aad4cddc-2b03-4945-8b7a-9501ce47fede" || $surveyid="4077f44b-b12f-40c3-810b-7452339f62b9" || $surveyid="9cf679b9-764c-478d-a4b0-6bf92adb4a17" || $surveyid="df5aa94e-1cc4-43a6-8407-d7f092e6b7f9" || $surveyid="f154a4db-2e92-482e-8e5c-ef998668a328" || $surveyid="fcca2f85-bca3-4fe6-9fcb-f7ea18f33641")
            {
                $mailsent = sendBuildAnalystMail($subject, $message);
            }
            else
            {
               $mailsent = sendBuildAnalystOtherMail($subject, $message); 
            }
            
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
                
    
                $to = trim($email_ids);
                $subject1 = "Avira Surveys - Thank You";
                
                $mailsent = sendUserMail($to, $subject1, $content);
            }
            
            /******************API Code For CRM*****************/
    		
    		$url=CRMSITEEMAIL.'apii.php';
            $ch = curl_init($url);
            
    		$fname=$fullname;
            $email=$email_ids;
            $userid=$lastinsertid;
            $objective = $survey_purpose;
            $camp_name = $campaign_name;
            if(isset($_POST['url_source'])){
            $url_source = $_POST['url_source'];
        }
            
            $data = array(
              "fname" => $fname,
              "email" => $email,
              "userid" => $userid,
              "source_lead" => $url_source,
              "source" => "Avira",
              "survey_purpose" => $objective,
              "campaign_name" => $camp_name
            );
        
            $dataEncoded = json_encode($data);
            
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.2; en-US; rv:1.8.1.7) Gecko/20070914 Firefox/2.0.0.7');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataEncoded);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Access-Control-Allow-Origin: *'));
            $result = curl_exec($ch);
    		/******************End API Code For CRM*****************/

}
if(isset($_POST['uid']) && !empty($_POST['uid']))
{
    echo $to."*".$fullname;
}
?>