<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/home/prdrchpr/public_html/precedencelogin/crm/lib/PHPMailer/src/Exception.php';
require '/home/prdrchpr/public_html/precedencelogin/crm/lib/PHPMailer/src/PHPMailer.php';
require '/home/prdrchpr/public_html/precedencelogin/crm/lib/PHPMailer/src/SMTP.php';

function sendCronMail($subject, $message) {
    $mail = new PHPMailer();
    /* * * SMTP * * */
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtpout.secureserver.net";
    $mail->Port = 587; // or 587
    $mail->IsHTML(true);
     $mail->Username = "sean.keenan@precedenceresearch.com";
    $mail->Password = "amrutapred@#11990";
    /* * * SMTP * * */

    $mail->From = "noreply@precedenceresearch.com";
    $mail->FromName = "All the Research";
    $mail->AddAddress("contactus@precedenceresearch.com", "All the Research");
    
    $mail->AddAddress("core@inforgrowth.com");
    $mail->AddAddress("contactus@inforgrowth.com");

    $mail->Subject = $subject;
    $mail->Body = $message;

    if (!$mail->Send()) {
        //echo "Mailer Error: " . $mail->ErrorInfo;
        return false;
    }

    return true;
}

function sendReportMail($subject, $message) {
    $mail = new PHPMailer();
    /* * * SMTP * * */
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtpout.secureserver.net";
    $mail->Port = 587; // or 587
    $mail->IsHTML(true);
     $mail->Username = "sean.keenan@precedenceresearch.com";
    $mail->Password = "amrutapred@#11990";
    /* * * SMTP * * */

    //$mail->From = "sales@alltheresearch.com";
    $mail->From = "noreply@precedenceresearch.com";
    $mail->FromName = "Sales";
    $mail->AddAddress("contactus@precedenceresearch.com");
    
    #BCC Email Address
    
    
       $mail->AddBCC("vinod.khandare@inforgrowth.com");
    $mail->Subject = $subject;
    $mail->Body = $message;

    if (!$mail->Send()) {
        //echo "Mailer Error: " . $mail->ErrorInfo;
        return false;
    }

    return true;
}

function sendUserMail($to, $subject, $message) {
   $mail = new PHPMailer();
    /* * * SMTP * * */
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtpout.secureserver.net";
    $mail->Port = 587; // or 587
    $mail->IsHTML(true);
    $mail->Username = "sean.keenan@precedenceresearch.com";
    $mail->Password = "amrutapred@#11990";
    /* * * SMTP * * */

    $mail->From = "noreply@precedenceresearch.com";
    $mail->FromName = "precedenceresearch";
     $mail->AddAddress("$to");
    //$mail->AddCC("info@alltheresearch.com");
   

    $mail->Subject = $subject;
    $mail->Body = $message;

    if (!$mail->Send()) {
       // echo "Mailer Error: " . $mail->ErrorInfo;
       //die();
        return false;
    }

    return true;
}

function sendUserMailtest($to, $subject, $message) {
   $mail = new PHPMailer();
    /* * * SMTP * * */
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtpout.secureserver.net";
    $mail->Port = 587; // or 587
    $mail->IsHTML(true);
    $mail->Username = "sean.keenan@precedenceresearch.com";
    $mail->Password = "amrutapred@#11990";
    /* * * SMTP * * */

    $mail->From = "alex@precedenceresearch.com";
    $mail->FromName = "Precendence Research";
     $mail->AddAddress("$to");
    //$mail->AddCC("info@alltheresearch.com");
   

    $mail->Subject = $subject;
    $mail->Body = $message;

    if (!$mail->Send()) {
      //  echo "Mailer Error: " . $mail->ErrorInfo;
       // die();
        return false;
    }

    return true;
}

function sendContactMail($subject, $message) {
    $mail = new PHPMailer();
    /* * * SMTP * * */
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtpout.secureserver.net";
    $mail->Port = 587; // or 587
    $mail->IsHTML(true);
    $mail->Username = "sean.keenan@precedenceresearch.com";
    $mail->Password = "amrutapred@#11990";
    /* * * SMTP * * */

    $mail->From = "noreply@alltheresearch.com";
    $mail->FromName = "Contact Us";
    $mail->AddAddress("contactus@alltheresearch.com");
   
    #BCC Email Address
     
       $mail->AddBCC("vinod.khandare@inforgrowth.com");
    
       
     $mail->AddBCC("amrita.prasad@inforgrowth.com");

    $mail->Subject = $subject;
    $mail->Body = $message;

    if (!$mail->Send()) {
        //echo "Mailer Error: " . $mail->ErrorInfo;
        return false;
    }

    return true;
}


function sendCareersMail($subject, $message, $file_tmp, $file_name) {
    $mail = new PHPMailer();
    /* * * SMTP * * */
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtpout.secureserver.net";
    $mail->Port = 587; // or 587
    $mail->IsHTML(true);
    $mail->Username = "sean.keenan@precedenceresearch.com";
    $mail->Password = "amrutapred@#11990";
    /* * * SMTP * * */

    $mail->From = "noreply@alltheresearch.com";
    $mail->FromName = "Career";
    $mail->AddAddress("contactus@alltheresearch.com");
  
       #BCC Email Address
      
       $mail->AddBCC("vinod.khandare@inforgrowth.com");
     
    
    

    if (isset($file_tmp) && !empty($file_tmp) && isset($file_name) && !empty($file_name)) {
        $mail->AddAttachment($file_tmp, $file_name);
    }
    
    $mail->Subject = $subject;
    $mail->Body = $message;

    if (!$mail->Send()) {
        //echo "Mailer Error: " . $mail->ErrorInfo;
        return false;
    }

    return true;
}

function sendReportMailCampaignDataCenter($subject, $message) {
    $mail = new PHPMailer();
    /* * * SMTP * * */
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtpout.secureserver.net";
    $mail->Port = 587; // or 587
    $mail->IsHTML(true);
    $mail->Username = "sean.keenan@precedenceresearch.com";
    $mail->Password = "amrutapred@#11990";
    /* * * SMTP * * */

    //$mail->From = "sales@alltheresearch.com";
    $mail->From = "noreply@alltheresearch.com";
    $mail->FromName = "Data World Center-Campaign";
    $mail->AddAddress("contactus@alltheresearch.com");
    
   #BCC Email Address
      
       $mail->AddBCC("vinod.khandare@inforgrowth.com");
     
     //  $mail->AddBCC("reuben.fernandes@alltheresearch.com");
       
    $mail->Subject = $subject;
    $mail->Body = $message;

    if (!$mail->Send()) {
        //echo "Mailer Error: " . $mail->ErrorInfo;
        return false;
    }

    return true;
}

function sendReportMailCampaigncyber($subject, $message) {
    $mail = new PHPMailer();
    /* * * SMTP * * */
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtpout.secureserver.net";
    $mail->Port = 587; // or 587
    $mail->IsHTML(true);
    $mail->Username = "sean.keenan@precedenceresearch.com";
    $mail->Password = "amrutapred@#11990";
    /* * * SMTP * * */

    //$mail->From = "sales@alltheresearch.com";
    $mail->From = "noreply@alltheresearch.com";
    $mail->FromName = "Cyber Security World-Campaign";
    $mail->AddAddress("contactus@alltheresearch.com");
    
   #BCC Email Address
      
       $mail->AddBCC("vinod.khandare@inforgrowth.com");
     
     //  $mail->AddBCC("reuben.fernandes@alltheresearch.com");
       
    $mail->Subject = $subject;
    $mail->Body = $message;

    if (!$mail->Send()) {
        //echo "Mailer Error: " . $mail->ErrorInfo;
        return false;
    }

    return true;
}


function sendReportMailCampaign($subject, $message) {
    $mail = new PHPMailer();
    /* * * SMTP * * */
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtpout.secureserver.net";
    $mail->Port = 587; // or 587
    $mail->IsHTML(true);
    $mail->Username = "sean.keenan@precedenceresearch.com";
    $mail->Password = "amrutapred@#11990";
    /* * * SMTP * * */

    //$mail->From = "sales@alltheresearch.com";
    $mail->From = "sean.keenan@precedenceresearch.com";
    $mail->FromName = "White Paper-Campaign";
    $mail->AddAddress("contactus@alltheresearch.com");
    
   #BCC Email Address
      
       $mail->AddBCC("vinod.khandare@inforgrowth.com");
     
     //  $mail->AddBCC("reuben.fernandes@alltheresearch.com");
       
    $mail->Subject = $subject;
    $mail->Body = $message;

    if (!$mail->Send()) {
        //echo "Mailer Error: " . $mail->ErrorInfo;
        return false;
    }

    return true;
}


function sendReportMailCampaignBrightcove($subject, $message) {
    $mail = new PHPMailer();
    /* * * SMTP * * */
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtpout.secureserver.net";
    $mail->Port = 587; // or 587
    $mail->IsHTML(true);
    $mail->Username = "sean.keenan@precedenceresearch.com";
    $mail->Password = "amrutapred@#11990";
    /* * * SMTP * * */

    //$mail->From = "sales@alltheresearch.com";
    $mail->From = "noreply@alltheresearch.com";
    $mail->FromName = "White Paper-Email Campaign";
    $mail->AddAddress("contactus@alltheresearch.com");
    
   #BCC Email Address
      
       $mail->AddBCC("vinod.khandare@inforgrowth.com");
      // $mail->AddBCC("suraj.ukarde@inforgrowth.com");
      // $mail->AddBCC("vinod.khandare@inforgrowth.com");
     //  $mail->AddBCC("reuben.fernandes@alltheresearch.com");
       
    $mail->Subject = $subject;
    $mail->Body = $message;

    if (!$mail->Send()) {
        //echo "Mailer Error: " . $mail->ErrorInfo;
        return false;
    }

    return true;
}



function SendSupportMail($subject, $message) {
    $mail = new PHPMailer();
    /* * * SMTP * * */
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtpout.secureserver.net";
    $mail->Port = 587; // or 587
    $mail->IsHTML(true);
    $mail->Username = "sean.keenan@precedenceresearch.com";
    $mail->Password = "amrutapred@#11990";
    /* * * SMTP * * */

    $mail->From = "noreply@precedenceresearch.com";
    $mail->FromName = "Precedence Leads";
    $mail->AddAddress("contactus@precedenceresearch.com");
    //$mail->AddBCC("akkhijadhav22@gmail.com");

    $mail->Subject = $subject;
    $mail->Body = $message;

    if (!$mail->Send()) {
       // echo "Mailer Error: " . $mail->ErrorInfo;
        return false;
    }

    return true;
}

function sendLeadMail($subject, $message) {
    $mail = new PHPMailer();
    /* * * SMTP * * */
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtpout.secureserver.net";
    $mail->Port = 587; // or 587
    $mail->IsHTML(true);
     $mail->Username = "sean.keenan@precedenceresearch.com";
    $mail->Password = "amrutapred@#11990";
    /* * * SMTP * * */

    $mail->From = "noreply@precedenceresearch.com";
    $mail->FromName = "Precedence Leads";
    $mail->AddAddress("contactus@precedenceresearch.com");
       $mail->AddBCC("vinod.khandare@inforgrowth.com");
       
//$mail->AddBCC("akkhijadhav22@gmail.com");
    $mail->Subject = $subject;
    $mail->Body = $message;

    if (!$mail->Send()) {
       // echo "Mailer Error: " . $mail->ErrorInfo;
        return false;
    }

    return true;
}

?>
