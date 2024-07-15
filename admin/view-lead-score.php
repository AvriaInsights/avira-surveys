<?php
require_once("classes/cls-request.php");

$obj_request = new Request();

$reqid=$_POST['reqid'];

$fields = "*";
$condition = "`tbl_request`.`request_id` = '" . $reqid . "'";
$user_request_details = $obj_request->getRequestDetails($fields, $condition, '', '', 0);
foreach($user_request_details as $user_request_detail)
{
    /**************Code For checkbox******************/
    $company = $user_request_detail['company'];
    $fields_company = "`tbl_company`.*";
    $condition_company = "`tbl_company`.`cmp_name` = '" . $company . "'";
    $company_details = $obj_request->getCompany($fields_company, $condition_company, '', '', 0);
    
    $designation = $user_request_detail['job_title'];
    $fields_designation = "`tbl_designation`.*";
    $condition_designation = "`tbl_designation`.`designation_name` = '" . $designation . "'";
    $designation_details = $obj_request->getDesignation($fields_designation, $condition_designation, '', '', 0);
    
    $comment_array=array('Interested','required','interest','require','requirement','purchase','need','looking','call back','call','provide','provided');
    if(isset($user_request_detail['leads_comment']))
    {
        if (in_array($user_request_detail['leads_comment'], $comment_array))
        {
          $score_specific_interest=3;
        }
        /*else
        {
          if(str_word_count($user_request_detail['leads_comment'])>=5)
          {
            $score_specific_interest=2;
          }
          if(str_word_count($user_request_detail['leads_comment'])>=1 && str_word_count($_POST['leads_comment'])<5)
          {
            $score_specific_interest=1;
          }
          if(str_word_count($user_request_detail['leads_comment'])==0)
          {
            $score_specific_interest=0;
          }
        }*/
    }
    
    $mail_array=array('gmail.com','hotmail.com','yahoo.com','rediffmail.com');
    $cmpmail=explode("@",$user_request_detail['email']);
    
    if(in_array($cmpmail[1], $mail_array))
    {
        $score_mail_interest=0;
    }
    else
    {
        $score_mail_interest=3;
    }

?>

<div class="col-md-4">
  <div class="main-holder">
    <div class="form-check"><input class="form-check-input chkbx" type="checkbox" value="1" id="flexCheckDefault1" <?php if($user_request_detail['priority_percent']==10){?> disabled <?php }?> <?php if(count($company_details)>0){?> checked disabled <?php }?>><label class="form-check-label chklab" for="flexCheckDefault1">Tier 1</label></div>
    <div class="form-check"><input class="form-check-input chkbx" type="checkbox" value="2" id="flexCheckDefault2" <?php if($user_request_detail['priority_percent']==10){?> disabled <?php }?> <?php if(count($designation_details)>0){?> checked disabled <?php }?>><label class="form-check-label chklab" for="flexCheckDefault2">Good Designation</label></div>
    <div class="form-check"><input class="form-check-input chkbx" type="checkbox" value="3" id="flexCheckDefault3" disabled <?php if(in_array($user_request_detail['comment'], $comment_array)){?> checked <?php }?>><label class="form-check-label chklab" for="flexCheckDefault3">Specific Interest</label></div>
    <div class="form-check"><input class="form-check-input chkbx" type="checkbox" value="" id="flexCheckDefault4" <?php if($user_request_detail['priority_percent']==10){?> disabled <?php }?>><label class="form-check-label chklab" for="flexCheckDefault4">Block Buster Report/Ready report</label></div>
  </div>
</div>
<div class="col-md-4">
  <div class="main-holder">
    <div class="form-check"><input class="form-check-input chkbx" type="checkbox" value="" id="flexCheckDefault5" <?php if($user_request_detail['priority_percent']==10){?> disabled <?php }?>><label class="form-check-label chklab" for="flexCheckDefault5">Exisiting Client</label></div>
    <div class="form-check"><input class="form-check-input chkbx" type="checkbox" value="" id="flexCheckDefault6" <?php if($user_request_detail['priority_percent']==10){?> disabled <?php }?>><label class="form-check-label chklab" for="flexCheckDefault6">Purchase Inquiry</label></div>
    <div class="form-check"><input class="form-check-input chkbx" type="checkbox" value="" id="flexCheckDefault7" <?php if($user_request_detail['priority_percent']==10){?> disabled <?php }?>><label class="form-check-label chklab" for="flexCheckDefault7">Discount Inquiry</label></div>
    <div class="form-check"><input class="form-check-input chkbx" type="checkbox" value="3" id="flexCheckDefault8" disabled <?php if(!in_array($cmpmail[1], $mail_array)){?> checked <?php }?>><label class="form-check-label chklab" for="flexCheckDefault8">Email Lead</label></div>
  </div>
</div>
<div class="col-md-4">
  <div class="main-holder">
    <div class="form-check"><input class="form-check-input chkbx" type="checkbox" value="" id="flexCheckDefault9" <?php if($user_request_detail['priority_percent']==10){?> disabled <?php }?>><label class="form-check-label chklab" for="flexCheckDefault9">Inbound Call Lead</label></div>
    <div class="form-check"><input class="form-check-input chkbx" type="checkbox" value="" id="flexCheckDefault10" <?php if($user_request_detail['priority_percent']==10){?> disabled <?php }?>><label class="form-check-label chklab" for="flexCheckDefault10">Valid Credentials</label></div>
    <div class="form-check"><input class="form-check-input chkbx" type="checkbox" value="" id="flexCheckDefault11" <?php if($user_request_detail['priority_percent']==10){?> disabled <?php }?>><label class="form-check-label chklab" for="flexCheckDefault11">Email Campaign</label></div>
  </div>
</div>
<?php }?>