<?php 
 require_once("survey/classes/cls-contact.php");
 require_once("survey/classes/phpmailer.php");
 $obj_contact = new Contact();
 $conn = $obj_contact->getConnectionObj();
 
$report_title = $_POST['report_title'];
$fname = $_POST['fname'];
$email = $_POST['email'];

if(isset($report_title) || $fnam!=""){
       
       //Mail code ===
 $message = "<html>";
    $message .= "<head>";
    $message .= "<title>".$report_title." - " . SITETITLE . "</title>";
    $message .= "</head>";
    $message .= "<body  style='font-family:Segoe UI; font-size:13px;'>";
    $message .= '<p>Dear Team,<br><br><b>' . $_POST['fname'] . '</b> has sent a message on the website.</p>
				<table style="border-collapse:collapse;">  <tr> 
			<th style="background-color:#00cfff;color:#fff;border:0.3px solid #0000000d;text-align:left;padding:8px">Item </th>
			<th style="background-color:#00cfff;color:#fff;border:0.3px solid #0000000d;text-align:left;padding:8px">Client Details </th>
			</tr>
        <tr>   <th style="border:0.3px solid #0000000d;text-align:left;padding:8px">
                    Name  </th><td style="border:0.3px solid #0000000d;text-align:left;padding:8px"> ' . $_POST['fname'] . ' 
                </td>
            </tr>
            <tr>
               <th style="border:0.3px solid #0000000d;text-align:left;padding:8px">
                    Email </th><td style="border:0.3px solid #0000000d;text-align:left;padding:8px"> ' . $_POST['email'] . '    </td>
            </tr>
            <tr>
               <th style="border:0.3px solid #0000000d;text-align:left;padding:8px">
                    Report Title </th><td style="border:0.3px solid #0000000d;text-align:left;padding:8px"> ' . $report_title . '    </td>
            </tr>
            <tr>
               <th style="border:0.3px solid #0000000d;text-align:left;padding:8px">
                    IP Address </th><td style="border:0.3px solid #0000000d;text-align:left;padding:8px">' . $obj_contact->get_client_ip() . '</b>
                </td>
            </tr> 
            </table>';
    $message .= "</body>";
    $message .= "</html>";
    //echo $message;exit();
    $subject = "AviraSurvey - Report Download - " . $_POST['fname'] . " - " . SITETITLE . "";
    
    $ip_add = $obj_contact->get_client_ip();
    
    if($ip_add != "176.31.253.157"){
        $mailsent = contactusSend($subject, $message);
        echo $_POST['fname'];
    }else{
        echo "Sorry.... Error Processing your request. Please try again later";
        exit;
    }
       
       
}




?>