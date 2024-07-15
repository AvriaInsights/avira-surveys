<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'lib/PHPMailer/src/Exception.php';
require 'lib/PHPMailer/src/PHPMailer.php';
require 'lib/PHPMailer/src/SMTP.php';

function sendCronMail($subject, $message) {
    $mail = new PHPMailer();
    /* * * SMTP * * */
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "mail.researchandtrends.com";
    $mail->Port = 587; // or 587
    $mail->IsHTML(true);
     $mail->Username = "noreply@researchandtrends.com";
    $mail->Password = "1*B{R37S;_z[";
    /* * * SMTP * * */

    $mail->From = "noreply@researchandtrends.com";
    $mail->FromName = "All the Research";
    $mail->AddAddress("contactus@researchandtrends.com", "All the Research");
    
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
    $mail->Host = "mail.researchandtrends.com";
    $mail->Port = 587; // or 587
    $mail->IsHTML(true);
     $mail->Username = "noreply@researchandtrends.com";
    $mail->Password = "1*B{R37S;_z[";
    /* * * SMTP * * */

    //$mail->From = "sales@alltheresearch.com";
    $mail->From = "noreply@researchandtrends.com";
    $mail->FromName = "Sales";
    $mail->AddAddress("contactus@researchandtrends.com");
    
    #BCC Email Address
    
    $mail->AddBCC("farhan.s@avirainsights.com");
    //$mail->AddBCC("vinod.khandare@inforgrowth.com");
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
    $mail->Host = "mail.researchandtrends.com";
    $mail->Port = 587; // or 587
    $mail->IsHTML(true);
    $mail->Username = "noreply@researchandtrends.com";
    $mail->Password = "1*B{R37S;_z[";
    /* * * SMTP * * */

    $mail->From = "noreply@researchandtrends.co";
    $mail->FromName = "Researchandtrends";
     $mail->AddAddress("$to");
    //$mail->AddCC("info@alltheresearch.com");
    $mail->AddBCC("farhan.s@avirainsights.com");
   

    $mail->Subject = $subject;
    $mail->Body = $message;

    if (!$mail->Send()) {
      //  echo "Mailer Error: " . $mail->ErrorInfo;
        die();
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
    $mail->Host = "mail.alltheresearch.com";
    $mail->Port = 587; // or 587
    $mail->IsHTML(true);
    $mail->Username = "noreply@alltheresearch.com";
    $mail->Password = "EFe6BUp*D}s-";
    /* * * SMTP * * */

    $mail->From = "noreply@alltheresearch.com";
    $mail->FromName = "Contact Us";
    $mail->AddAddress("contactus@alltheresearch.com");
   
    #BCC Email Address
    $mail->AddBCC("farhan.s@avirainsights.com");


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
    $mail->Host = "mail.alltheresearch.com";
    $mail->Port = 587; // or 587
    $mail->IsHTML(true);
    $mail->Username = "noreply@alltheresearch.com";
    $mail->Password = "EFe6BUp*D}s-";
    /* * * SMTP * * */

    $mail->From = "noreply@alltheresearch.com";
    $mail->FromName = "Career";
    $mail->AddAddress("contactus@alltheresearch.com");
  
       #BCC Email Address
        
        $mail->AddBCC("farhan.s@avirainsights.com");
    
    

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
    $mail->Host = "mail.alltheresearch.com";
    $mail->Port = 587; // or 587
    $mail->IsHTML(true);
    $mail->Username = "noreply@alltheresearch.com";
    $mail->Password = "EFe6BUp*D}s-";
    /* * * SMTP * * */

    //$mail->From = "sales@alltheresearch.com";
    $mail->From = "noreply@alltheresearch.com";
    $mail->FromName = "Data World Center-Campaign";
    $mail->AddAddress("contactus@alltheresearch.com");
    
   #BCC Email Address
    $mail->AddBCC("farhan.s@avirainsights.com");
     
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
    $mail->Host = "mail.alltheresearch.com";
    $mail->Port = 587; // or 587
    $mail->IsHTML(true);
    $mail->Username = "noreply@alltheresearch.com";
    $mail->Password = "EFe6BUp*D}s-";
    /* * * SMTP * * */

    //$mail->From = "sales@alltheresearch.com";
    $mail->From = "noreply@alltheresearch.com";
    $mail->FromName = "Cyber Security World-Campaign";
    $mail->AddAddress("contactus@alltheresearch.com");
    
   #BCC Email Address
     $mail->AddBCC("farhan.s@avirainsights.com");
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
    $mail->Host = "mail.alltheresearch.com";
    $mail->Port = 587; // or 587
    $mail->IsHTML(true);
    $mail->Username = "noreply@alltheresearch.com";
    $mail->Password = "EFe6BUp*D}s-";
    /* * * SMTP * * */

    //$mail->From = "sales@alltheresearch.com";
    $mail->From = "noreply@alltheresearch.com";
    $mail->FromName = "White Paper-Campaign";
    $mail->AddAddress("contactus@alltheresearch.com");
    
   #BCC Email Address
    $mail->AddBCC("farhan.s@avirainsights.com");
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
    $mail->Host = "mail.alltheresearch.com";
    $mail->Port = 587; // or 587
    $mail->IsHTML(true);
    $mail->Username = "noreply@alltheresearch.com";
    $mail->Password = "EFe6BUp*D}s-";
    /* * * SMTP * * */

    //$mail->From = "sales@alltheresearch.com";
    $mail->From = "noreply@alltheresearch.com";
    $mail->FromName = "White Paper-Email Campaign";
    $mail->AddAddress("contactus@alltheresearch.com");
    
   #BCC Email Address
    $mail->AddBCC("farhan.s@avirainsights.com");
       
    $mail->Subject = $subject;
    $mail->Body = $message;

    if (!$mail->Send()) {
        //echo "Mailer Error: " . $mail->ErrorInfo;
        return false;
    }

    return true;
}

?>
