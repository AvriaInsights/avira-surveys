<?php
require_once("classes/cls-request.php");
require_once("classes/phpmailer.php");

$obj_request = new Request();

$condition="`tbl_request`.`assigned_leads`=' ' OR `tbl_request`.`assigned_leads` IS NULL";
$fields = "*";
$request_details = $obj_request->getRequestDetails($fields, $condition, '', '', 0);
//print_r($request_details);
if(!empty($request_details))
{
    foreach($request_details as $request_detail)
    {
        if($request_detail['website']=="Researchcmfe")
        {
            $contact_email="contactus@researchcmfe.com";
        }
        if($request_detail['website']=="AllTheResearch")
        {
            $contact_email="contactus@alltheresearch.com";
        }
        
            $content = "<html>";
            $content .= "<head>";
            $content .= "<title>". $request_detail['website'] . " - " . $request_detail['request_from_page'] . " Request on ".$request_detail['created_at']."</title>";
            $content .= "</head>";
            $content .= "<body  style='font-family:Segoe UI; font-size:13px;'>";
            $content .= '<p>Dear <b>' .$request_detail['fname'].'</b>,</p>';
            $content .= '<p>This is with reference to your interest in the <strong>' . $request_detail['report_title'] . '</strong> report.</p>
                             <p>We have done some extensive, granular level research and have a strong Analyst base that can handle any Research queries around this topic.</p>
                             <p>Given the current market scenario and its influence on the global economies, the current market data numbers are revised and updated. Also, we have included an additional chapter to highlight the impact of COVID-19 on this market.</p>
                             <p>Let us know a convenient time for a quick call to better understand and cater to your requirement most appropriately.</p>
                             <p>You can also email me about specific aspects that you are looking for or contact us at <strong>' .$contact_email. '</strong> OR <strong>+1 (407) 768-2028</strong>.</p>
                             <p>Looking forward to hearing from you.</p>
                             <p>Warm Regards,<br> Anuprit O. <br>' . SITETITLE . '</p>';
            $content .= "</body>";
            $content .= "</html>";

            $subject = $request_detail['website'] . " - " . $request_detail['request_from_page'] . " Request on ".$request_detail['created_at'];

            $sent_reciept = sendUserMail($request_detail['email'], $subject, $content);
    }        
}
?>