<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/home/aviras/public_html/lib/PHPMailer/src/Exception.php';
require '/home/aviras/public_html/lib/PHPMailer/src/PHPMailer.php';
require '/home/aviras/public_html/lib/PHPMailer/src/SMTP.php';

function sendUserMail($to, $subject, $message) {
   $mail = new PHPMailer();
    /* * * SMTP * * */
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "mail.avirasurveys.com";
    $mail->Port = 587; // or 587
    $mail->IsHTML(true);
    $mail->Username = "noreply@avirasurveys.com";
    $mail->Password = "%^meUV=S7brq";
    /* * * SMTP * * */

    $mail->From = "noreply@avirasurveys.com";
    $mail->FromName = "Avira Surveys - Thank You";
     $mail->AddAddress("$to");
    //$mail->AddCC("info@alltheresearch.com");
   

    $mail->Subject = $subject;
    $mail->Body = $message;

    if (!$mail->Send()) {
       //echo "Mailer Error: " . $mail->ErrorInfo;
       // die();
        return false;
    }

    return true;
}


function sendBuildAnalystMail($subject, $message) {
   $mail = new PHPMailer();
    /* * * SMTP * * */
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "mail.avirasurveys.com";
    $mail->Port = 587; // or 587
    $mail->IsHTML(true);
    $mail->Username = "noreply@avirasurveys.com";
    $mail->Password = "%^meUV=S7brq";
    /* * * SMTP * * */

    $mail->From = "noreply@avirasurveys.com";
    $mail->FromName = "Avira Surveys";
    $mail->AddAddress("contactus@avirasurveys.com");
    // $mail->AddBCC("sumedh@leadsinfra.com");
    // $mail->AddBCC("dhananjay.doiphode@leadsinfra.com");
    // $mail->AddBCC("preeti.sakharkar@inforgrowth.com");
    // $mail->AddBCC("sumaiyya.sayyad@inforgrowth.com");
    // $mail->AddBCC("surveys@inforgrowth.com");
    // $mail->AddBCC("leads@inforgrowth.com");
    
    $mail->AddBCC("vinod.khandare@inforgrowth.com");
    $mail->AddBCC("amrita.prasad@inforgrowth.com");
    
    $mail->Subject = $subject;
    $mail->Body = $message;

    if (!$mail->Send()) {
       /*echo "Mailer Error: " . $mail->ErrorInfo;
        die();*/
        return false;
    }

    return true;
}

function sendBuildAnalystOtherMail($subject, $message) {
   $mail = new PHPMailer();
    /* * * SMTP * * */
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "mail.avirasurveys.com";
    $mail->Port = 587; // or 587
    $mail->IsHTML(true);
    $mail->Username = "noreply@avirasurveys.com";
    $mail->Password = "%^meUV=S7brq";
    /* * * SMTP * * */

    $mail->From = "noreply@avirasurveys.com";
    $mail->FromName = "Avira Surveys";
    $mail->AddAddress("contactus@avirasurveys.com");
//     $mail->AddBCC("sumaiyya.sayyad@inforgrowth.com");
//     $mail->AddBCC("dhananjay.doiphode@leadsinfra.com");
//     $mail->AddBCC("sumedh@leadsinfra.com");
//     $mail->AddBCC("vinod.khandare@inforgrowth.com");
//     $mail->AddBCC("preeti.sakharkar@inforgrowth.com");
//     $mail->AddBCC("masood@leadsinfra.com");
//     $mail->AddBCC("surveys@inforgrowth.com");
//     $mail->AddBCC("leads@inforgrowth.com");
//   $mail->AddBCC("amrita.prasad@inforgrowth.com");
   
   $mail->AddBCC("vinod.khandare@inforgrowth.com");
    $mail->AddBCC("amrita.prasad@inforgrowth.com");
    $mail->Subject = $subject;
    $mail->Body = $message;

    if (!$mail->Send()) {
       /*echo "Mailer Error: " . $mail->ErrorInfo;
        die();*/
        return false;
    }

    return true;
}

function sendMailByClient($from,$to, $subject, $message) {
   $mail = new PHPMailer();
    /* * * SMTP * * */
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "mail.avirasurveys.com";
    $mail->Port = 587; // or 587
    $mail->IsHTML(true);
    $mail->Username = "noreply@avirasurveys.com";
    $mail->Password = "%^meUV=S7brq";
    /* * * SMTP * * */

    $mail->From = "noreply@avirasurveys.com";
    $mail->FromName = $from;
     $mail->AddAddress("$to");
    //$mail->AddCC("info@alltheresearch.com");
   

    $mail->Subject = $subject;
    $mail->Body = $message;

    if (!$mail->Send()) {
      //  echo "Mailer Error: " . $mail->ErrorInfo;
        die();
        return false;
    }

    return true;
}


function contactusSend($subject, $message) {
    $mail = new PHPMailer();
    /* * * SMTP * * */
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "mail.avirasurveys.com";
    $mail->Port = 587; // or 587
    $mail->IsHTML(true);
    $mail->Username = "noreply@avirasurveys.com";
    $mail->Password = "%^meUV=S7brq";
    /* * * SMTP * * */

    $mail->From = "noreply@avirasurveys.com";
    $mail->FromName = "Avira Surveys";
    $mail->AddAddress("contactus@avirasurveys.com");
    //$mail->AddCC("info@alltheresearch.com");
    
    #BCC Email Address
    
    // $mail->AddBCC("leads@inforgrowth.com");
    //   $mail->AddBCC("sumaiyya.sayyad@inforgrowth.com");
    //   $mail->AddBCC("preeti.sakharkar@inforgrowth.com");
    //   $mail->AddBCC("vinod.khandare@inforgrowth.com");
    //   $mail->AddBCC("sumedh@leadsinfra.com");
    //   $mail->AddBCC("dhananjay.doiphode@leadsinfra.com");
    //   $mail->AddBCC("amrita.prasad@inforgrowth.com");
      
      $mail->AddBCC("vinod.khandare@inforgrowth.com");
    $mail->AddBCC("amrita.prasad@inforgrowth.com");
   // $mail->AddBCC("pwsneha@gmail.com");
   // 
    
    //  $mail->AddBCC("leads@inforgrowth.com");
    //   $mail->AddBCC("sumaiyya.sayyad@inforgrowth.com");
    //   $mail->AddBCC("nitish.pande@inforgrowth.com");
    //   $mail->AddBCC("sumedh@leadsinfra.com");
    //     
        $mail->Subject = $subject;
        $mail->Body = $message;

    if (!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
        die();
        return false;
    }

    return true;
}

function sendUserContactMail($to, $subject2, $content) {
   $mail = new PHPMailer();
    /* * * SMTP * * */
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "mail.avirasurveys.com";
    $mail->Port = 587; // or 587
    $mail->IsHTML(true);
    $mail->Username = "noreply@avirasurveys.com";
    $mail->Password = "%^meUV=S7brq";
    /* * * SMTP * * */

    $mail->From = "noreply@avirasurveys.com";
    $mail->FromName = "Avira Surveys";
    $mail->AddAddress("contactus@avirasurveys.com");
   

    $mail->Subject = $subject2;
    $mail->Body = $content;

    if (!$mail->Send()) {
      echo "Mailer Error: " . $mail->ErrorInfo;
        die();
        return false;
    }

    return true;
}


function sendUserRegistrationMail($to, $subject, $content) {
   $mail = new PHPMailer();
    /* * * SMTP * * */
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "mail.avirasurveys.com";
    $mail->Port = 587; // or 587
    $mail->IsHTML(true);
    $mail->Username = "noreply@avirasurveys.com";
    $mail->Password = "%^meUV=S7brq";
    /* * * SMTP * * */

    $mail->From = "noreply@avirasurveys.com";
    $mail->FromName = "Avira Survey";
    $mail->AddAddress("$to");
    //$mail->AddCC("info@alltheresearch.com");
   
    $mail->Subject = $subject;
    $mail->Body = $content;

    if (!$mail->Send()) {
      echo "Mailer Error: " . $mail->ErrorInfo;
      die();
      return false;
    }

    return true;
}

?>