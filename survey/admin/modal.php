<?php
require_once("classes/cls-request.php");

$obj_request = new Request();

//$requestid=$_POST['requestid'];
$fields = "*";
$condition = "`tbl_request`.`request_id` = '" . $_POST['requestid'] . "'";
$user_request_details = $obj_request->getRequestDetails($fields, $condition, '', '', 0);

$fields1 = "*";
$condition1 = "`tbl_admin`.`role` != 'superadmin' AND `tbl_admin`.`role` != 'admin'";
$lead_details = $obj_request->getLeadsDetails($fields1, $condition1, '', '', 0);


$fields_relevance = "*";
$condition_relevance = "";
$relevance_details = $obj_request->getRelevanceMapping($fields_relevance, $condition_relevance, '', '', 0);

$fields_comment = "*";
$condition_comment = "`request_id` = '" . $_POST['requestid'] . "'";
$comment_details = $obj_request->getCommentDetails($fields_comment, $condition_comment, '', '', 0);



foreach($user_request_details as $user_request_detail)
{
    $product_title = $user_request_detail['report_title'];
    
    if (strpos($product_title, 'Market') !== false) 
    {
        $prod_title = strstr($product_title, 'Market', true);
        $prod_title = substr_replace($prod_title, " Market", -1);
        $link1=str_replace("Global","",$prod_title);
        $link2=str_replace(' ', '-',trim($link1));
    }
    if($user_request_detail['website']=="AllTheResearch")
    {
       $report_url="https://www.alltheresearch.com/alpha/report/".$user_request_detail['report_id']."/".strtolower($link2);
    }
    if($user_request_detail['website']=="ResearchCMFE")
    {
       $report_url="https://www.researchcmfe.com/beta/report/".$user_request_detail['report_id']."/".strtolower($link2);
    }
    
    $fields2 = "*";
    $condition2 = "`tbl_cluster_head`.`cluster_head_id` = '" . $user_request_detail['cluster_head_id'] . "'";
    $cluster_head_details = $obj_request->getRequestClusterDetails($fields2, $condition2, '', '', 0);
    foreach($cluster_head_details as $cluster_head_detail)
    {
        $cluster_head_name = $cluster_head_detail['cluster_head_name'];
    }
    
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
    
    $relids=$user_request_detail['relevance_ids'];
    $allrelid=explode(",",$relids);
    
    
    
?>
<link rel="stylesheet" href="<?php echo SITEPATH;?>admin/css/modal-style.css">
  <div class="row">
                   <div class="col-md-10">
                       <h2>Leads Info</h2>
                   </div>
               </div>
               <div class="row">
                   <div class="col-md-3">
                       <div class="user-info mb-3">
                           <div class="user-pic">
                             <img src="images/default-avatar.png" alt="user-pic" class="img-fluid">
                           </div>
                           <div class="users-details">
                               <h3><?php echo $user_request_detail['fname'];?></h3>
                               <h4 class="fw-bold">ID:<?php echo $user_request_detail['lead_no'];?></h4>
                           </div>
                       </div>
                       <div class="all-user-data">
                           <div class="mb-4">
                               <p>Mobile</p>
                               <span><?php echo $user_request_detail['phone'];?></span>
                           </div>
                           <div class="mb-4">
                               <p>Email</p>
                               <span><?php echo $user_request_detail['email'];?></span>
                           </div>
                           <div class="mb-4">
                               <p>Leads Score</p>
                               <span><?php echo $user_request_detail['priority_percent'];?></span>
                           </div>
                           <div class="mb-4">
                               <p>Cluster Head : <span><?php echo $cluster_head_name;?></span></p>
                           </div>
                          <!--<div class="mb-4">
                              <p>Lead Referred By:Abc<p>
                          </div> -->
                           
                       </div>
                   </div>
                   <div class="col-md-9">
                       <div class="user-form-details">
                           	<div class="tabs effect-2">
                        			<!-- tab-title -->
                        			<input type="radio" id="tab-1" name="tabs effect-2" checked="checked">
                        			<span>
                        				<i class="fa fa-info" aria-hidden="true"></i><span style="font-size:12px;">INFO</span>
                        			</span>
                        
                        			<input type="radio" id="tab-2" name="tabs effect-2">
                        			<span>
                        				<i class="fa fa-plus" aria-hidden="true"></i><span style="font-size:12px;">ACTIVITY</span>
                        			</span>
                        
                        			<input type="radio" id="tab-3" name="tabs effect-2">
                        			<span>
                        				<i class="fa fa-tasks" aria-hidden="true"></i><span style="font-size:12px;">TASK</span>
                        			</span>
                        
                        			<input type="radio" id="tab-4" name="tabs effect-2">
                        			<span>
                        				<i class="fa fa-group" aria-hidden="true"></i><span style="font-size:12px;">MEETING</span>
                        			</span>
                        			
                        			<!--<input type="radio" id="tab-5" name="tab-effect-3">
                        			<span>
                        				<i class="fa fa-cog"></i><span>Settings</span>
                        			</span>-->
                        
                        			<div class="line ease"></div>
                       
                        			<!-- tab-content -->
                        			<div class="tab-content">
                        				<section id="tab-item-1">
                        					<div class="tabset">
                                              <!-- Tab 1 -->
                                              <input type="radio" name="tabset" id="tab1" aria-controls="marzen" checked>
                                              <label for="tab1">Lead Info</label>
                                              <!-- Tab 2 -->
                                              <input type="radio" name="tabset" id="tab2" aria-controls="rauchbier">
                                              <label for="tab2">Comment</label>
                                               <!-- Tab 3 -->
                                              <input type="radio" name="tabset" id="tab3" aria-controls="rauchbier">
                                              <label for="tab3">Lead Score</label>
                                              
                                              <div class="tab-panels">
                                                <section id="lead-info" class="tab-panel">
                                                    <form class="row">
                                                    <div style="background-color:#f8f8ff;padding:10px;border-radius:0.5rem;border: 1px solid #c7c7c7;width: 83rem; margin-left: 7px;">
                                                       <div class="col-md-6">
                                                           <div class="main-holder">
                                                                <label class="form-label">Business Email</label>
                                                                <input type="email" class="form-control" name="email" value="<?php echo $user_request_detail['email'];?>" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                           <div class="main-holder">
                                                                <label class="form-label">Form Type</label>
                                                                <input type="text" class="form-control" name="form_type" value="<?php echo $user_request_detail['website']." - ".$user_request_detail['request_from_page'];?>" disabled>
                                                            </div>
                                                        </div>
                                                      <div class="col-md-6">
                                                          <div class="main-holder">
                                                            <label class="form-label">Full Name</label>
                                                            <input type="text" class="form-control" name="fname" value="<?php echo $user_request_detail['fname'];?>" disabled>
                                                          </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                          <div class="main-holder">
                                                            <label  class="form-label">Phone Number</label>
                                                            <input type="text" class="form-control" name="phone" value="<?php echo $user_request_detail['phone'];?>" disabled>
                                                          </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                          <div class="main-holder">
                                                            <label  class="form-label">Company</label>
                                                            <input type="text" class="form-control" name="company" value="<?php echo $user_request_detail['company'];?>" disabled>
                                                           </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                          <div class="main-holder">
                                                            <label class="form-label">Designation</label>
                                                            <input type="text" class="form-control" name="designation" value="<?php echo $user_request_detail['job_title'];?>" disabled>
                                                           </div>
                                                      </div>
                                                      
                                                     <div class="col-md-6">
                                                          <div class="main-holder">
                                                            <label class="form-label">Category</label>
                                                            <input type="text" class="form-control" name="catgeory" value="<?php echo $user_request_detail['report_category'];?>" disabled>
                                                           </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                          <div class="main-holder">
                                                            <label class="form-label">Report Title</label>
                                                            <input type="text" class="form-control" name="rep_title" value="<?php echo $user_request_detail['report_title'];?>" disabled>
                                                           </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                          <div class="main-holder">
                                                            <label class="form-label">Report ID</label>
                                                            <input type="text" class="form-control" name="catgeory" value="<?php echo $user_request_detail['report_id'];?>" disabled>
                                                           </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                          <div class="main-holder">
                                                            <label class="form-label">Report URL</label>
                                                            <input type="text" class="form-control" name="rep_title" value="<?php echo $report_url;?>" disabled>
                                                           </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                          <div class="main-holder">
                                                            <label class="form-label">Lead Score<span style="font-size:10px;padding-left:6px;font-weight:100;">1 to 3(Low);4 to 6(Mid);7 to 10(High)</span></label>
                                                            <select name="leadscore" id="leadscore" class="form-select" style="height:34px;font-size:15px;">
                                                                <?php for($i=0;$i<=10;$i++){?>
                                                                <option value="<?php echo $i;?>" <?php if($i==$user_request_detail['priority_percent']){?> selected <?php }?>><?php echo $i;?></option>
                                                                <?php }?>
                                                            </select>
                                                           </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                          <div class="main-holder">
                                                            <label class="form-label">Lead Type</label>
                                                            <select name="leadtype" id="leadtype" class="form-select" style="height:34px;font-size:15px;">
                                                                <option value="HIGH" <?php if($user_request_detail['priority_wise']=="HIGH"){?> selected <?php }?>>HIGH</option>
                                                                <option value="MID" <?php if($user_request_detail['priority_wise']=="MID"){?> selected <?php }?>>MID</option>
                                                                <option value="LOW" <?php if($user_request_detail['priority_wise']=="LOW"){?> selected <?php }?>>LOW</option>
                                                                <option value="JUNK" <?php if($user_request_detail['priority_wise']=="JUNK"){?> selected <?php }?>>JUNK</option>
                                                            </select>
                                                           </div>
                                                      </div>
                                                       <div class="col-md-12">
                                                          
                                                          <div class="main-holder">
                                                            <label class="form-label">Assign Leads</label>
                                                            <select name="assignlead" id="assignlead" class="form-select" style="height:34px;font-size:15px;width:48%;">
                                                                <option value="">Assign Leads</option>
                                                                <?php foreach($lead_details as $lead_detail){?>
                                                                <option value="<?php echo $lead_detail['admin_id'];?>" <?php if($lead_detail['admin_id']==$user_request_detail['assigned_leads']){?> selected <?php }?>><?php echo $lead_detail['f_name']." ".$lead_detail['lname']." - ".$lead_detail['role'];?></option>
                                                                <?php }?>
                                                            </select>
                                                            <div style="color:red;font-size:14px;" id="leads_error_message"></div>
                                                         </div>
                                                         
                                                      </div>
                                                      </div>
                                                      
                                                      <div style="background-color:#f8f8ff;padding:10px;border-radius:0.5rem;margin-top:10px;border: 1px solid #c7c7c7;width: 83rem; margin-left: 7px;">
                                                          <div class="col-md-12"><div class="main-holder" style="font-weight:500;">Relevance Mapping</div></div>
                                                          <div class="col-md-12">
                                                              <div class="main-holder">
                                                                <?php foreach($relevance_details as $relevance_detail){?>
                                                                <div class="form-check"><input class="form-check-input chkbx" type="checkbox" value="<?php echo $relevance_detail['rel_id']?>" id="relevance" name="relevance" <?php if(in_array($relevance_detail['rel_id'], $allrelid)){?> checked <?php }?>><label class="form-check-label chklab" for="relevance"><?php echo $relevance_detail['rel_title']?></label></div>
                                                                <?php }?>
                                                                </div>
                                                          </div>
                                                      </div>
                                                      
                                                      <div style="background-color:#f8f8ff;padding:10px;border-radius:0.5rem;margin-top:10px;border: 1px solid #c7c7c7;width: 83rem; margin-left: 7px;">
                                                      <div class="col-md-6">
                                                          <div class="main-holder">
                                                            <label class="form-label">Message</label>
                                                            <textarea row="9" cols="20" class="form-control" id="message" name="message"><?php echo $user_request_detail['comment'];?></textarea>
                                                          </div>
                                                      </div>
                                                      <?php //if($_SESSION['ifg_admin']['role']!="sales") {?>
                                                      <form role="form" method="POST" name="add-form" id="add-form">
                                                      
                                                      <div class="col-md-6">
                                                          <div class="main-holder">
                                                            <label class="form-label">Lead Stage</label>
                                                            <select name="leadstage1" id="leadstage1" class="form-select" style="height:34px;font-size:15px;">
                                                                <option value="">Lead Stage</option>
                                                                <option value="Active" <?php if($user_request_detail['lead_stage']=="Active"){?> selected <?php }?>>Active</option>
                                                                <option value="Warm" <?php if($user_request_detail['lead_stage']=="Warm"){?> selected <?php }?>>Warm</option>
                                                                <option value="Pipeline" <?php if($user_request_detail['lead_stage']=="Pipeline"){?> selected <?php }?>>Pipeline</option>
                                                                <option value="Cold" <?php if($user_request_detail['lead_stage']=="Cold"){?> selected <?php }?>>Cold</option>
                                                                <option value="Disqualified" <?php if($user_request_detail['lead_stage']=="Disqualified"){?> selected <?php }?>>Disqualified</option>
                                                                <option value="Invalid" <?php if($user_request_detail['lead_stage']=="Invalid"){?> selected <?php }?>>Invalid</option>
                                                                <option value="Prospect" <?php if($user_request_detail['lead_stage']=="Prospect"){?> selected <?php }?>>Prospect</option>
                                                            </select>
                                                           </div>
                                                      </div>
                                                     
                                                      </div>
                                                      <div class="col-md-12" style="margin-top:10px;">
                                                          <div class="text-center">
                                                            <button type="button" id="update" class="btn btn-primary">Update</button>
                                                          </div>
                                                      </div>
                                                    </form>
                                                    
                                                </section>
                                                
                                                
                                                <section id="description" class="tab-panel">
                                                     <div class="col-md-6">
                                                          <div class="main-holder">
                                                            <label class="form-label">Add Comment</label>
                                                            <textarea row="15" cols="20" class="form-control" id="lead_comment" style="height:20rem;width:60rem;"><?php //echo date("d-m-Y h:i:sa");?></textarea>
                                                          </div>
                                                      </div>
                                                      <div class="col-md-12" style="margin-top:10px;">
                                                          <div class="text-center">
                                                            <button type="button" id="update_comment" class="btn btn-primary">Update</button>
                                                          </div>
                                                      </div>
                                                </section>
                                                
                                                <section id="leadscore" class="tab-panel">
                                                    
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
                                                      <div class="col-md-12" style="margin-top:10px;">
                                                          <div class="text-center">
                                                            <button type="button" id="update_lead_type" class="btn btn-primary">Update</button>
                                                          </div>
                                                      </div>
                                                      
                                                </section>
                                                
                                             </div>
                                              
                                            </div>
                                            
                        				</section>
                        				
                        				<section id="tab-item-2" style=" height: 500px; overflow-y: scroll; overflow-x: hidden;">
                        				    <div id="allcommentlist"></div>
                        				</section>
                        				
                        				<section id="tab-item-3" style=" height: 500px; overflow-y: scroll; overflow-x: hidden;">
                        				    <div class="col-md-12" style="background-color:#f8f8ff;padding:10px;border-radius:0.5rem;border: 1px solid #c7c7c7;width: 83rem;">
                            					<div class="col-md-4">
                            					    <div class="main-holder">
                            					        <div class="row">
                            					            <div class="col-md-2"><label class="form-label">When </label></div>
                                                            <div class="col-md-2"><i class="fa fa-clock-o" aria-hidden="true"></i></div>
                                                            <div style="color:red;font-size:14px;" id="leads_error_message_task"></div>
                                                        </div>
                                                       
                                                       <input type="datetime-local" value="" id="datetime1" name="datetime1" class="form-control" style="width:26.4rem;">
                                                    </div>
                                                </div>
                                                <div class="col-md-4" style="padding-left:8rem;">
                            					    <div class="main-holder">
                                                        <label class="form-label">Task Type</label>
                                                        <div><input class="form-check-input chkbx" type="radio" value="Call" id="tasktype" name="tasktype" checked><label class="form-check-label chklab" for="calltask">Call</label></div>
                                                        <div><input class="form-check-input chkbx" type="radio" value="Email" id="tasktype" name="tasktype"><label class="form-check-label chklab" for="emailtask">Email</label></div>
                                                    
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="main-holder">
                                                        <label class="form-label">Task To</label>
                                                        <select name="assigntask" id="assigntask" class="form-select" style="height:34px;font-size:15px;">
                                                            <?php foreach($lead_details as $lead_detail){?>
                                                            <option value="<?php echo $lead_detail['admin_id'];?>" <?php //if($lead_detail['admin_id']==$user_request_detail['assigned_leads']){?> <?php //}?>><?php echo $lead_detail['f_name']." ".$lead_detail['lname']." - ".$lead_detail['role'];?></option>
                                                            <?php }?>
                                                        </select>
                                                        
                                                    </div>
                            					</div>
                                            </div>
                                            <div class="col-md-12" style="background-color:#f8f8ff;padding:10px;border-radius:0.5rem;border: 1px solid #c7c7c7;width: 83rem; margin-top:10px;">
                                                   <div class="col-md-4">
                                                     <div class="main-holder">
                        					            <label class="form-label">Enter the task details here....</label>
                                                        <textarea row="9" cols="20" class="form-control" id="taskdetail" name="taskdetail" style="width:26.6rem;"></textarea>
                                                     </div>
                                                   </div>
                                            </div>
                                            
                                            <div class="col-md-12" style="margin-top:10px;">
                                                <div class="text-center">
                                                    <button type="button" id="add_task" class="btn btn-primary">Save</button>
                                                </div>
                                            </div>
                                            <div id='loader1' style='display: none;' class="text-center">
                                                <img src='<?php echo SITEPATH; ?>admin/images/loader.gif' height="100px" width="100px">
                                            </div>
                                            <div id="alltasklist"></div>
                                            
                        				</section>
                        				
                        				<section id="tab-item-4" style=" height: 500px; overflow-y: scroll; overflow-x: hidden;">
                        				    
                        				    <div class="col-md-6">
                        				        
                        				        <div class="main-holder">
                        					        <label class="form-label">Title</label>
                                                    <input type="text" class="form-control" name="meeting_title" id="meeting_title" value="">
                                                </div>
                                                <div class="row"><div id="leads_error_message_meeting_invalid" style="color:red;font-size:14px;"></div></div>
                        				        <div class="main-holder">
                            					        <div class="row">
                                                            <div class="col-md-6"><label class="form-label">From <i class="fa fa-clock-o" aria-hidden="true" style="right:14.5rem;"></i></label> <input type="datetime-local" value="" id="meetingstarttime" name="meetingstarttime" class="form-control" style="width:20rem;"></div>
                                                        </div>
                                                        <div class="row"><div id="leads_error_message_meeting_from" style="color:red;font-size:14px;"></div></div>
                                                        <div class="row">
                                                            <div class="col-md-6" style="padding-top:10px;"><label class="form-label">To <i class="fa fa-clock-o" aria-hidden="true" style="right:14.5rem;"></i></label>  <input type="datetime-local" value="" id="meetingendtime" name="meetingendtime" class="form-control" style="width:20rem;"></div>
                                                        </div>
                                                        <div class="row"><div id="leads_error_message_meeting_to" style="color:red;font-size:14px;"></div></div>
                                                </div>
                        				        <div class="main-holder">
                                                        <label class="form-label">Assigned To</label>
                                                        <select name="assignmeeting" id="assignmeeting" class="form-select" style="height:34px;font-size:15px;">
                                                            <?php foreach($lead_details as $lead_detail){?>
                                                            <option value="<?php echo $lead_detail['admin_id'];?>" <?php //if($lead_detail['admin_id']==$user_request_detail['assigned_leads']){?> <?php //}?>><?php echo $lead_detail['f_name']." ".$lead_detail['lname']." - ".$lead_detail['role'];?></option>
                                                            <?php }?>
                                                        </select>
                                                </div>
                        				        <div class="main-holder">
                        					        <label class="form-label">Attendees<span style="font-size:10px;padding-left:6px;font-weight:100;">(Comma separated emailids)</span></label>
                                                    <textarea row="9" cols="20" class="form-control" id="meetingattendes" name="meetingattendes" style="width:26.6rem;" placeholder="Type EmailIds of attendees..."></textarea>
                                                </div>
                        				       
                        				    </div>
                        				    <div class="col-md-1"><div class="vl"></div></div>
                        				    
                        				    <div class="col-md-5" style="margin-top:18px;">
                        				         
                                                
                        				        <div class="main-holder">
                        					        <label class="form-label">Description</label>
                                                    <textarea row="9" cols="20" class="form-control" id="meetingdetail" name="meetingdetail" style="width:26.6rem;" placeholder="Meeting details goes here..."></textarea>
                                                </div>
                        				        
                        				        
                        				        <div class="main-holder">
                        				            <label class="form-label">Skype ID</label>
                                                    <textarea row="9" cols="20" class="form-control" id="skypedetail" name="skypedetail" style="width:26.6rem;height:189px;" placeholder="Skype details goes here..."></textarea>
                        				        </div>
                        				        <div class="row"><div id="leads_error_message_meeting_skype" style="color:red;font-size:14px;"></div></div>
                        				    </div>
                        				    
                        				    <div class="col-md-12" style="margin-left:20px;">
                                                <div class="text-center">
                                                    <button type="button" id="add_meeting" class="btn btn-primary">Save</button>
                                                </div>
                                            </div>
                        				</section>
                        				
                        			<!--<section id="tab-item-4">
                        					<h1>Four</h1>
                        				</section>
                        				
                        				<section id="tab-item-5">
                        					<h1>Five</h1>
                        				</section>-->
                        			</div>
                        		</div>
                           
                       </div>
                   </div>
               </div>
<?php }?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 <script type="text/javascript">
        $(document).ready(function () {
            $.ajax({
                  url : "view-task.php",
                  type : "POST",
                  data : {reqid:<?php echo $_POST['requestid'];?>},
                  success: function(datatask){
                        $("#alltasklist").html(datatask);
                  }
               }); 
             
             $.ajax({
                  url : "view-comment.php",
                  type : "POST",
                  data : {reqid:<?php echo $_POST['requestid'];?>},
                  success: function(datacomment){
                        $("#allcommentlist").html(datacomment);
                        
                  }
               });    
               
            $("#usernamesignup_error_message").hide();
            $("#leads_error_message_task").hide();
            var leads_error_message = false;
            
            function check_leads()
            {
                var assignlead= $("#assignlead").val();
                if(assignlead == '')
                {
                    $("#leads_error_message").show();
                    $("#leads_error_message").html("Please select leads");
                    leads_error_message = true;
                }
                else
                {
                    $("#leads_error_message").hide();
                    leads_error_message = false;
                } 
            }
            var flag=0;
            var flag1=0;
            $('#add_task').click(function(){
                
                var seldattime = $("#datetime1").val();
                var tasktype = $("#tasktype:checked").val();
                //alert(tasktype);
                var assigntask = $("#assigntask").val();
                var taskdetails = $("#taskdetail").val();
                if(seldattime=="")
                {
                    $("#leads_error_message_task").show();
                    $("#leads_error_message_task").html("Select date of task");
                    flag=1;
                }
                else
                {
                    var g1 = new Date($("#datetime1").val());
                    var currentdate = dateFormat(new Date(), "yyyy-mm-dd'T'HH:MM");
                    var g2 = new Date(currentdate);
                   
                    if (g1.getTime() < g2.getTime())
                    {
                        $("#leads_error_message_task").show();
                        $("#leads_error_message_task").html("Date is expired");
                        flag=1;
                    }    
                    else if (g1.getTime() > g2.getTime())
                    {
                        $("#leads_error_message_task").hide();
                        $("#leads_error_message_task").html("");
                        flag=0;
                    }
                    else
                    {
                        $("#leads_error_message_task").show();
                        $("#leads_error_message_task").html("Date is expired");
                        flag=1;
                    }
                }
                
                if(flag==0)
                {
                    $.ajax({
                          url : "insert_task_action.php",
                          type : "POST",
                          data : {reqid:<?php echo $_POST['requestid'];?>,taskdate:seldattime,tasktype:tasktype,taskassigned:assigntask,taskdetails:taskdetails},
                          success: function(data1){
                               $.ajax({
                                      url : "view-task.php",
                                      type : "POST",
                                      data : {reqid:<?php echo $_POST['requestid'];?>},
                                      beforeSend: function() {
                                            $("#loader1").show();
                                            $("#alltasklist").html("");
                                      },
                                      success: function(datatask){
                                            $("#loader1").hide();
                                            $("#alltasklist").html(datatask);
                                            $("#datetime1").val("");
                                            $("#taskdetail").val("");
                                      }
                                   });  
                          }
                       });   
                }
                
            });
             
            
            
            $('#update_lead_type').click(function(){
                var x="<?php echo SITEPATH;?>admin/manage-request.php";
                /**********Code for leads******/
                if($("#flexCheckDefault1").is(":checked"))
                {
                    var tier = $("#flexCheckDefault1").val();
                }
                else
                {
                    var tier = "0";
                }
                if($("#flexCheckDefault2").is(":checked"))
                {
                    var designation = $("#flexCheckDefault2").val();
                }
                else
                {
                    var designation = "0";
                }
                /*if($("#flexCheckDefault3").is(":checked"))
                {
                    var interest = $("#flexCheckDefault3").val();
                }
                else
                {
                    var interest = "0";
                }*/
                
                //alert(tier);
                //alert(designation);
                /******************************/
                $.ajax({
                          url : "update_lead_type_action.php",
                          type : "POST",
                          data : {reqid:<?php echo $_POST['requestid'];?>,tier:tier,designation:designation},
                          success: function(data1){
                              swal(data1);
                               // alert(data1);
                                 //$("#successmsg").html(data1);
                                // window.location = x;
                          }
                       });   
            });
            
            $('#update').click(function(){
                leads_error_message = false;
                //check_leads();
                var x="<?php echo SITEPATH;?>admin/manage-request.php";
                if(leads_error_message === false)
                {
                    var leadid=$("#assignlead").val();
                    //var comment=$("#lead_comment").val();
                    var leadscores=$("#leadscore").val();
                    var leadtype=$("#leadtype").val();
                    var message=$("#message").val();
                    var leadstages=$("#leadstage1").val();
                    
                    
                    var array22 = [];
                    $("input:checkbox[name=relevance]:checked").each(function() {
                        array22+=$(this).val()+",";
                    });
                    
                    $.ajax({
                            url : "update_assign_leads_action.php",
                            type : "POST",
                            data : {reqid:<?php echo $_POST['requestid'];?>,assignleadid:leadid,leadscores:leadscores,leadtype:leadtype,message:message,leadstages:leadstages,relevanceid:array22},
                            success: function(data1){
                                swal(data1);
                                //alert(data1);
                                 //$("#successmsg").html(data1);
                                // window.location = x;
                            }
                       });   
                }
                
            
            });
            
            $('#update_comment').click(function(){
                leads_error_message = false;
                //check_leads();
                var x="<?php echo SITEPATH;?>admin/manage-request.php";
                if(leads_error_message === false)
                {
                    
                    var comment=$("#lead_comment").val();
                    
                    $.ajax({
                            url : "update_assign_leads_comment_action.php",
                            type : "POST",
                            data : {reqid:<?php echo $_POST['requestid'];?>,comment_txt:comment},
                            success: function(data2){
                                swal(data2);
                                $.ajax({
                                      url : "view-comment.php",
                                      type : "POST",
                                      data : {reqid:<?php echo $_POST['requestid'];?>},
                                      success: function(datacomment){
                                            $("#allcommentlist").html(datacomment);
                                            $("lead_comment").val("");
                                      }
                                   });  
                            }
                       });   
                }
                
            
            });
            
            $('#leadscore').change(function(){
                var leadscores=$(this).val();
                if(leadscores==0)
                {    
                    $("#leadtype option[value=JUNK]").attr('selected', 'selected');
                    $("#leadtype option[value=LOW]").removeAttr('selected', 'selected');
                    $("#leadtype option[value=MID]").removeAttr('selected', 'selected');
                    $("#leadtype option[value=HIGH]").removeAttr('selected', 'selected');
                }
                if(leadscores>=1 && leadscores<=3)
                {
                    $("#leadtype option[value=LOW]").attr('selected', 'selected');
                    $("#leadtype option[value=MID]").removeAttr('selected', 'selected');
                    $("#leadtype option[value=HIGH]").removeAttr('selected', 'selected');
                    $("#leadtype option[value=JUNK]").removeAttr('selected', 'selected');
                }
                if(leadscores>=4 && leadscores<=6)
                {
                    $("#leadtype option[value=MID]").attr('selected', 'selected');
                    $("#leadtype option[value=LOW]").removeAttr('selected', 'selected');
                    $("#leadtype option[value=HIGH]").removeAttr('selected', 'selected');
                    $("#leadtype option[value=JUNK]").removeAttr('selected', 'selected');
                }
                if(leadscores>=7 && leadscores<=10)
                {
                    $("#leadtype option[value=HIGH]").attr('selected', 'selected');
                    $("#leadtype option[value=MID]").removeAttr('selected', 'selected');
                    $("#leadtype option[value=LOW]").removeAttr('selected', 'selected');
                    $("#leadtype option[value=JUNK]").removeAttr('selected', 'selected');
                }
            });
            
            $('#add_meeting').click(function(){
                var leads_error_message_meeting_from = false;
                var leads_error_message_meeting_to = false;
                var leads_error_message_meeting_skype = false;
                var leads_error_message_meeting_invalid = false;
                
                var meetingstarttime = $("#meetingstarttime").val();
                var meetingendtime = $("#meetingendtime").val();
                var meetingtitle = $("#meeting_title").val();
                var meetingdescription = $("#meetingdetail").val();
                var meetingattendes = $("#meetingattendes").val();
                var assignmeeting = $("#assignmeeting").val();
                var skypedetail = $("#skypedetail").val();
                
                if(meetingstarttime=="")
                {
                    $("#leads_error_message_meeting_from").show();
                    $("#leads_error_message_meeting_from").html("Select from date");
                    leads_error_message_meeting_from = true;
                }
                else
                {
                    $("#leads_error_message_meeting_from").hide();
                    $("#leads_error_message_meeting_from").html("");
                    leads_error_message_meeting_from = false;
                }
                if(meetingendtime=="")
                {
                    $("#leads_error_message_meeting_to").show();
                    $("#leads_error_message_meeting_to").html("Select to date");
                    leads_error_message_meeting_to = true;
                }
                else
                {
                    $("#leads_error_message_meeting_to").hide();
                    $("#leads_error_message_meeting_to").html("");
                    leads_error_message_meeting_to = false;
                }
                if(skypedetail=="")
                {
                    $("#leads_error_message_meeting_skype").show();
                    $("#leads_error_message_meeting_skype").html("Add skype detail");
                    leads_error_message_meeting_skype = true;
                }
                else
                {
                    $("#leads_error_message_meeting_skype").hide();
                    $("#leads_error_message_meeting_skype").html("");
                    leads_error_message_meeting_skype = false;
                }
                if(meetingstarttime!="" && meetingendtime!="")
                {
                    var g3 = new Date($("#meetingstarttime").val());
                    var g4 = new Date($("#meetingendtime").val());
                    var currentdate = dateFormat(new Date(), "yyyy-mm-dd'T'HH:MM");
                    var g5 = new Date(currentdate);
                    
                    if (g3.getTime() < g5.getTime())
                    {
                        $("#leads_error_message_meeting_invalid").show();
                        $("#leads_error_message_meeting_invalid").html("Date is expired");
                        leads_error_message_meeting_invalid = true;
                    }    
                    else if (g3.getTime() > g5.getTime())
                    {
                        $("#leads_error_message_meeting_invalid").hide();
                        $("#leads_error_message_meeting_invalid").html("");
                        leads_error_message_meeting_invalid = false;
                    }
                    else
                    {
                        $("#leads_error_message_meeting_invalid").show();
                        $("#leads_error_message_meeting_invalid").html("Date is expired");
                        leads_error_message_meeting_invalid = true;
                    }
                    
                    if (g4.getTime() < g5.getTime())
                    {
                        $("#leads_error_message_meeting_invalid").show();
                        $("#leads_error_message_meeting_invalid").html("Date is expired");
                        leads_error_message_meeting_invalid = true;
                    }    
                    else if (g4.getTime() > g5.getTime())
                    {
                        $("#leads_error_message_meeting_invalid").hide();
                        $("#leads_error_message_meeting_invalid").html("");
                        leads_error_message_meeting_invalid = false;
                    }
                    else
                    {
                        $("#leads_error_message_meeting_invalid").show();
                        $("#leads_error_message_meeting_invalid").html("Date is expired");
                        leads_error_message_meeting_invalid = true;
                    }
                    
                    if (g4.getTime() < g3.getTime())
                    {
                        $("#leads_error_message_meeting_invalid").show();
                        $("#leads_error_message_meeting_invalid").html("Date is expired");
                        leads_error_message_meeting_invalid = true;
                    }    
                    else if (g4.getTime() > g3.getTime())
                    {
                        $("#leads_error_message_meeting_invalid").hide();
                        $("#leads_error_message_meeting_invalid").html("");
                        leads_error_message_meeting_invalid = false;
                    }
                    else
                    {
                        $("#leads_error_message_meeting_invalid").show();
                        $("#leads_error_message_meeting_invalid").html("Date is expired");
                        leads_error_message_meeting_invalid = true;
                    }
                }
                
                if(leads_error_message_meeting_from === false && leads_error_message_meeting_to === false && leads_error_message_meeting_skype === false && leads_error_message_meeting_invalid === false)
                {
                    $.ajax({
                          url : "insert_meeting_action.php",
                          type : "POST",
                          data : {reqid:<?php echo $_POST['requestid'];?>,meetingstarttime:meetingstarttime,meetingendtime:meetingendtime,meetingtitle:meetingtitle,meetingdescription:meetingdescription,meetingattendes:meetingattendes,assignmeeting:assignmeeting,skypedetail:skypedetail},
                          success: function(data1){
                               swal(data1);
                               $.ajax({
                                      url : "view-task.php",
                                      type : "POST",
                                      data : {reqid:<?php echo $_POST['requestid'];?>},
                                      success: function(datatask){
                                            $("#alltasklist").html(datatask);
                                            $("#meetingstarttime").val("");
                                            $("#meetingendtime").val("");
                                            $("#meeting_title").val("");
                                            $("#meetingdetail").val("");
                                            $("#meetingattendes").val("");
                                            $("#skypedetail").val("");
                                      }
                                   });  
                          }
                       });   
                }
                
            });
           /*
             * Date Format 1.2.3
             * (c) 2007-2009 Steven Levithan <stevenlevithan.com>
             * MIT license
             *
             * Includes enhancements by Scott Trenda <scott.trenda.net>
             * and Kris Kowal <cixar.com/~kris.kowal/>
             *
             * Accepts a date, a mask, or a date and a mask.
             * Returns a formatted version of the given date.
             * The date defaults to the current date/time.
             * The mask defaults to dateFormat.masks.default.
             */
            
            var dateFormat = function () {
            	var	token = /d{1,4}|m{1,4}|yy(?:yy)?|([HhMsTt])\1?|[LloSZ]|"[^"]*"|'[^']*'/g,
            		timezone = /\b(?:[PMCEA][SDP]T|(?:Pacific|Mountain|Central|Eastern|Atlantic) (?:Standard|Daylight|Prevailing) Time|(?:GMT|UTC)(?:[-+]\d{4})?)\b/g,
            		timezoneClip = /[^-+\dA-Z]/g,
            		pad = function (val, len) {
            			val = String(val);
            			len = len || 2;
            			while (val.length < len) val = "0" + val;
            			return val;
            		};
            
            	// Regexes and supporting functions are cached through closure
            	return function (date, mask, utc) {
            		var dF = dateFormat;
            
            		// You can't provide utc if you skip other args (use the "UTC:" mask prefix)
            		if (arguments.length == 1 && Object.prototype.toString.call(date) == "[object String]" && !/\d/.test(date)) {
            			mask = date;
            			date = undefined;
            		}
            
            		// Passing date through Date applies Date.parse, if necessary
            		date = date ? new Date(date) : new Date;
            		if (isNaN(date)) throw SyntaxError("invalid date");
            
            		mask = String(dF.masks[mask] || mask || dF.masks["default"]);
            
            		// Allow setting the utc argument via the mask
            		if (mask.slice(0, 4) == "UTC:") {
            			mask = mask.slice(4);
            			utc = true;
            		}
            
            		var	_ = utc ? "getUTC" : "get",
            			d = date[_ + "Date"](),
            			D = date[_ + "Day"](),
            			m = date[_ + "Month"](),
            			y = date[_ + "FullYear"](),
            			H = date[_ + "Hours"](),
            			M = date[_ + "Minutes"](),
            			s = date[_ + "Seconds"](),
            			L = date[_ + "Milliseconds"](),
            			o = utc ? 0 : date.getTimezoneOffset(),
            			flags = {
            				d:    d,
            				dd:   pad(d),
            				ddd:  dF.i18n.dayNames[D],
            				dddd: dF.i18n.dayNames[D + 7],
            				m:    m + 1,
            				mm:   pad(m + 1),
            				mmm:  dF.i18n.monthNames[m],
            				mmmm: dF.i18n.monthNames[m + 12],
            				yy:   String(y).slice(2),
            				yyyy: y,
            				h:    H % 12 || 12,
            				hh:   pad(H % 12 || 12),
            				H:    H,
            				HH:   pad(H),
            				M:    M,
            				MM:   pad(M),
            				s:    s,
            				ss:   pad(s),
            				l:    pad(L, 3),
            				L:    pad(L > 99 ? Math.round(L / 10) : L),
            				t:    H < 12 ? "a"  : "p",
            				tt:   H < 12 ? "am" : "pm",
            				T:    H < 12 ? "A"  : "P",
            				TT:   H < 12 ? "AM" : "PM",
            				Z:    utc ? "UTC" : (String(date).match(timezone) || [""]).pop().replace(timezoneClip, ""),
            				o:    (o > 0 ? "-" : "+") + pad(Math.floor(Math.abs(o) / 60) * 100 + Math.abs(o) % 60, 4),
            				S:    ["th", "st", "nd", "rd"][d % 10 > 3 ? 0 : (d % 100 - d % 10 != 10) * d % 10]
            			};
            
            		return mask.replace(token, function ($0) {
            			return $0 in flags ? flags[$0] : $0.slice(1, $0.length - 1);
            		});
            	};
            }();
            
            // Some common format strings
            dateFormat.masks = {
            	"default":      "ddd mmm dd yyyy HH:MM:ss",
            	shortDate:      "m/d/yy",
            	mediumDate:     "mmm d, yyyy",
            	longDate:       "mmmm d, yyyy",
            	fullDate:       "dddd, mmmm d, yyyy",
            	shortTime:      "h:MM TT",
            	mediumTime:     "h:MM:ss TT",
            	longTime:       "h:MM:ss TT Z",
            	isoDate:        "yyyy-mm-dd",
            	isoTime:        "HH:MM:ss",
            	isoDateTime:    "yyyy-mm-dd'T'HH:MM:ss",
            	isoUtcDateTime: "UTC:yyyy-mm-dd'T'HH:MM:ss'Z'"
            };
            
            // Internationalization strings
            dateFormat.i18n = {
            	dayNames: [
            		"Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat",
            		"Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"
            	],
            	monthNames: [
            		"Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec",
            		"January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
            	]
            };
            
            // For convenience...
            Date.prototype.format = function (mask, utc) {
            	return dateFormat(this, mask, utc);
            };
            
        });

 /*****************************Code for delete and mark task*****************/
       function deletetask(taskid)
       {
           $.ajax({
                  url : "delete-task.php",
                  type : "POST",
                  data : {taskid:taskid},
                  success: function(datatask){
                        $.ajax({
                                      url : "view-task.php",
                                      type : "POST",
                                      data : {reqid:<?php echo $_POST['requestid'];?>},
                                      success: function(datatask){
                                            $("#alltasklist").html(datatask);
                                            
                                      }
                               });  
                  }
            }); 
       }
       
       function marktask(taskid)
       {
           $.ajax({
                  url : "mark-task.php",
                  type : "POST",
                  data : {taskid:taskid},
                  success: function(datatask){
                        $.ajax({
                                      url : "view-task.php",
                                      type : "POST",
                                      data : {reqid:<?php echo $_POST['requestid'];?>},
                                      success: function(datatask){
                                            $("#alltasklist").html(datatask);
                                            
                                      }
                               });  
                  }
            }); 
       }
       /******************************End Code for delete and mark task*****************/        
        
</script>

      