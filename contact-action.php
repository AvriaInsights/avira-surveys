<?php
 require_once("survey/classes/cls-contact.php");
 require_once("survey/classes/phpmailer.php");
 $obj_contact = new Contact();
 $conn = $obj_contact->getConnectionObj();
 
if($_POST['fname'] == NULL || $_POST['fname'] == "") {
    $_SESSION['error'] = "Please enter First Name";
    header("Location:contact-us.php");
} 
else
{
    $fname = $_POST['fname'];
}

if($_POST['phone'] == NULL || $_POST['phone'] == "") {
    $_SESSION['error'] = "Please enter Phone Number";
    header("Location:contact-us.php");
} 
else
{
    $phone = $_POST['phone'];
}

if($_POST['email'] == NULL || $_POST['email'] == "") {
    $_SESSION['error'] = "Please enter Email Id";
    header("Location:contact-us.php");
} 
else
{
    $email = $_POST['email'];
}

if($_POST['txt_message'] == NULL || $_POST['txt_message'] == "") {
    $_SESSION['error'] = "Please Enter your Message";
    header("Location:contact-us.php");
} 
else
{
    $txt_message = $_POST['txt_message'];
}

//echo "name".$fname."lname=".$lname;exit;

if (($fname != "NULL" || $fname != '') &&($email != "NULL" || $email != '')) {
    $insert_data['first_name'] = mysqli_real_escape_string($conn, ucfirst($fname));
    $insert_data['phone'] = mysqli_real_escape_string($conn, $_POST['phone']);
    $insert_data['email'] = mysqli_real_escape_string($conn, $_POST['email']);
    $insert_data['message'] = mysqli_real_escape_string($conn, $_POST['txt_message']);
    $insert_data['created_at'] = date("Y-m-d H:i:s");
    $insert_data['updated_at'] = date("Y-m-d H:i:s");
    $user_id = $obj_contact->insertContact($insert_data, 0);
 
//Mail code ===
 $message = "<html>";
    $message .= "<head>";
    $message .= "<title>Contact Us - " . SITETITLE . "</title>";
    $message .= "</head>";
    $message .= "<body  style='font-family:Segoe UI; font-size:13px;'>";
    $message .= '<p>Dear Team,<br><br><b>' . $_POST['fname'] . '</b> has sent a message on the website.</p>
                
				 <table style="border-collapse:collapse;">  <tr> 
			        <th style="background-color:#00cfff;color:#fff;border:0.3px solid #0000000d;text-align:left;padding:8px"> 
                    Name  </th>
                    <th style="background-color:#00cfff;color:#fff;border:0.3px solid #0000000d;text-align:left;padding:8px">
                    Phone </th> 
                    
                    <th style="background-color:#00cfff;color:#fff;border:0.3px solid #0000000d;text-align:left;padding:8px">
                    Email </th> 
                   
                    <th style="background-color:#00cfff;color:#fff;border:0.3px solid #0000000d;text-align:left;padding:8px">
                    Message </th>
                    <th style="background-color:#00cfff;color:#fff;border:0.3px solid #0000000d;text-align:left;padding:8px">
                    IP Address </th>
					  </tr>
                <tr>
					<td style="border:0.3px solid #0000000d;text-align:left;padding:8px"> ' . $_POST['fname'] . ' 
                     </td>
          
              <td style="border:0.3px solid #0000000d;text-align:left;padding:8px"> ' . trim($phone) . '    </td>
           
              <td style="border:0.3px solid #0000000d;text-align:left;padding:8px"> ' . $_POST['email'] . '    </td>
             
               <td style="border:0.3px solid #0000000d;text-align:left;padding:8px">' . nl2br($_POST['txt_message']) . '    </td>
           
               <td style="border:0.3px solid #0000000d;text-align:left;padding:8px">' . $obj_contact->get_client_ip() . ' 
                </td>
            </tr> 
            </table>
				
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
                    Phone </th><td style="border:0.3px solid #0000000d;text-align:left;padding:8px"> ' . trim($phone) . '    </td>
            </tr>
         
            <tr>
               <th style="border:0.3px solid #0000000d;text-align:left;padding:8px">
                    Email </th><td style="border:0.3px solid #0000000d;text-align:left;padding:8px"> ' . $_POST['email'] . '    </td>
            </tr>
           
            <tr>
               <th style="border:0.3px solid #0000000d;text-align:left;padding:8px">
                    Message </th><td style="border:0.3px solid #0000000d;text-align:left;padding:8px">' . nl2br($_POST['txt_message']) . '    </td>
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
    $subject = "Contact Us - " . $_POST['fname'] . " - " . SITETITLE . "";
    
    $ip_add = $obj_contact->get_client_ip();
    
    if($ip_add != "176.31.253.157"){
        $mailsent = contactusSend($subject, $message);
    }else{
        echo "Sorry.... Error Processing your request. Please try again later";
        exit;
    }
    
    if ($mailsent) {
        
        /*                 * ***Contact Us User Mail **** */
        $content = "<html>";
        $content .= "<head>";
        $content .= "<title>Contact Us - " . SITETITLE . "</title>";
        $content .= "</head>";
        $content .= "<body  style='font-family:Segoe UI; font-size:13px;'>";
        $content .= '<p>Dear ' .$_POST['fname']. ',</p>';
        $content .= '<p>Your request for help has been received. We will reach out to you soon.</p>';
        $content .= '<strong>About us:</strong>';
        $content .= '<p><a href="https://www.avirasurveys.com/" target="_blank">Avira Surveys</a> was formed with the aim of making market research a significant tool for managing breakthroughs in the industry. As a leading market research provider, the firm empowers its global clients with business-critical research solutions. The outcome of our study of numerous companies that rely on market research and consulting data for their decision-making made us realise, that its not just sheer data-points, but the right analysis that creates a difference. While some clients were unhappy with the inconsistencies and inaccuracies of data, others expressed concerns over the experience in dealing with the research-firm. Also same-data-for-all-business roles was making research redundant. We identified these gaps and built AllTheResearch to raise the standards of research support.</p>';
        $content .= '<p>Contact Us,<br> Viswanath G. <br> Phone: +1 (407) 768-2028 <br>Email: contactus@avirasurveys.com </p>';            
        $content .= "</body>";
        $content .= "</html>";

        $subject2 = "Contact Us - Thank You - " . SITETITLE . "";

        $sent_reciept = sendUserContactMail($_POST['email'], $subject2, $content);
        
       

        /*                 * ***Contact Us User Mail **** */
      /*  $response["message_code"] = 1;
        $response["message"] = "<strong>Congratulations</strong> Your Request has been processes successfully";
         header("Location:" . SITEPATH . "thank-you-contact-us/");*/
        
        
    }
    else
    {
        $response["message_code"] = 0;
        $response["message"] = "<strong>Sorry</strong> Error Processing your request. Please try again later";
     //header("Location:" . SITEPATH . "contact/");
    }
    
    
}
//echo json_encode($response);
//die();
?>