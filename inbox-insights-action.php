<?php
require_once("survey/classes/cls-request.php");
require_once("survey/classes/phpmailer.php");

$obj_request = new Request();

$conn = $obj_request->getConnectionObj();
$campaign_id = $_POST['campaign_id'];


                  if($campaign_id=="1"){
                      $camp_name = "The 7-Step Guide to Sales Acceleration for B2B Marketers";
                  }

            $message = "<html>";
            $message .= "<head>";
            $message .= "<title>The 7-Step Guide to Sales Acceleration for B2B Marketers - " . $_POST['email'] . "</title>";
            $message .= "</head>";
            $message .= "<body  style='font-family:Segoe UI; font-size:13px;'>";
            $message .= ' 
                      <table style="border-collapse:collapse;"> 
                      
                        <p><a href="'. $_POST['actual_link'] .'" target="_blank"></p>
                      
                            <tr> 
                            <th style="background-color: #6491FF; color: #fff;border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Campaign Page</th>
                            <th style="background-color: #6491FF; color: #fff;border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Campaign Name</th>
                             <th style="background-color: #6491FF; color: #fff;border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Full Name</th>
                             <th style="background-color: #6491FF; color: #fff;border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Email</th>                       

                            
                             
                            </tr>
                            
                            <tr>
                            <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;"><a href="'. $_POST['actual_link'] .'" target="_blank">Click Here..</a></td>
                            <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . $camp_name . '</td>
                             <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . $_POST['fname'] . ' ' . $_POST['lname'] . '</td>
                             <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . $_POST['email'] . '</td>  
                            </tr>
                        </table>
                       ';  
            $message .= "</body>";
            $message .= "</html>";

            $subject = "The 7-Step Guide to Sales Acceleration for B2B Marketers From - " . $_POST['email'] . "";

            $mailsent = sendBuildAnalystMail($subject, $message);
            if ($mailsent) {

             
                if($campaign_id=="1"){
                    header("Location:https://www.software-intent.com/landing-page-260123/pdf/The-7-Step-Guide-to-Sales-Acceleration-for-B2B-Marketers.pdf"); 
                  } 
                
            }
            
                /*                 * *** User Mail **** */
              


?>