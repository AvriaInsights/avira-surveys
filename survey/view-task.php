<?php
require_once("classes/cls-request.php");

$obj_request = new Request();

$reqid=$_POST['reqid'];
/***********Task detial******/
$fields_task = "*";
$condition_task = "`request_id` = '" . $reqid . "'";
$sort_by = "`tbl_task`.`task_id` DESC";
$task_details = $obj_request->getTask($fields_task, $condition_task, $sort_by, '', 0);
$number=1;
?>
<style>
    .badge {
    display: inline-block;
    min-width: 10px;
    padding: 3px 7px;
    font-size: 12px;
    font-weight: bold;
    color: white;
    line-height: 1;
    vertical-align: baseline;
    white-space: nowrap;
    text-align: center;
    background-color: #999999;
    border-radius: 10px;
}
.badge-success {
    background-color: #49bf67;
}
</style>
<?php if(isset($task_details)){?>
<?php foreach($task_details as $task_detail){ 
      $fields_assign_to = "*";
      $condition_assign_to = "`admin_id` = '" . $task_detail['task_assigned_to'] . "'";
      $assign_to_details = $obj_request->getLeadsDetails($fields_assign_to, $condition_assign_to, '', '', 0);
      
      $fetchdattime = $task_detail['task_datetime'];
      $fetchdattimearray = explode("T",$fetchdattime);
?>
<div class="col-md-12">
  
<div class="saved--note show-all filter-info">
    <div class="notes-main-div">
        <?php if($task_detail['task_type']=="Call" || $task_detail['task_type']=="Email"){?>
        <div class="comment-icon-box" style="bottom: 53px;"><i <?php if($task_detail['task_type']=="Call"){?> class="fa fa-phone" <?php } else {?> class="fa fa-envelope" <?php }?> aria-hidden="true" style="color: chocolate; position: absolute; top: 22%; font-size:32px;"></i></div>
        <div class="note--content">
            <div class="col-sm-12 no-pad">
                <div class="col-sm-6 no-pad">
                    
                    <p class="note--font" style="text-transform:capitalize"><?php echo strtoupper($task_detail['task_type']);?> <?php echo $task_detail['task_detail'];?></p>
                    <p class="date--time--font"><?php echo $fetchdattimearray[0]." ".$fetchdattimearray[1];?></p>
                    <?php foreach($assign_to_details as $assign_to_detail){?>
                    <p>Assigned To : <?php echo $assign_to_detail['f_name']." ".$assign_to_detail['lname']." - ".$assign_to_detail['role'];?></p>
                    <?php }?>
                </div>
                <div class="col-sm-6 no-pad">
                    <div class="col-sm-2" style="float:right;"><a href="javascript:void(0);" onclick="deletetask(<?php echo $task_detail['task_id'];?>);">Delete</a></div>
                    <?php if($task_detail['is_completed']=="No"){?>
                    <div class="col-sm-5" style="float:right;"><a href="javascript:void(0);" onclick="marktask(<?php echo $task_detail['task_id'];?>);">Mark as completed</a></div>
                    <?php } else {?>
                    <div class="col-sm-5" style="float:right;">Completed</div>
                    <?php }?>
                </div>   
               </div>
        </div>
        </div>
        <?php } else { 
            $num="";
            $fetchstartdattime = $task_detail['meeting_from_time'];
            $fetchstartdattimearray = explode("T",$fetchstartdattime);
            $suffix = array('th','st','nd','rd','th','th','th','th','th','th');
            if ((($number % 100) >= 11) && (($number%100) <= 13))
            {
                $num = $number. 'th';
            }
            else
            {
                $num = $number. $suffix[$number % 10];
            }
        ?>
        <div class="comment-icon-box" style="bottom: 69px;"><i class="fa fa-group" aria-hidden="true" style="color: chocolate; position: absolute; top: 22%; font-size:32px;"></i></div>
        <div class="note--content">
            <div class="col-sm-12 no-pad">
                <div class="col-sm-6 no-pad">
                    
                    <p class="note--font" style="text-transform:capitalize"><span class="badge badge-success"><?php echo $num."Meeting";?></span> <div><?php echo $task_detail['meeting_title'];?></div> <span><a target="_blank" href="skype:<?php echo $task_detail['meeting_skypeid'];?>?call"> <i class="fa fa-link" aria-hidden="true"></i></a></span></p>
                    <p class="date--time--font"><?php echo $fetchstartdattimearray[0]." ".$fetchstartdattimearray[1];?></p>
                    <?php foreach($assign_to_details as $assign_to_detail){?>
                    <p>Assigned To : <?php echo $assign_to_detail['f_name']." ".$assign_to_detail['lname']." - ".$assign_to_detail['role'];?></p>
                    <?php }?>
                </div>
                <div class="col-sm-6 no-pad">
                    <div class="col-sm-2" style="float:right;"><a href="javascript:void(0);" onclick="deletetask(<?php echo $task_detail['task_id'];?>);">Delete</a></div>
                    <?php if($task_detail['is_completed']=="No"){?>
                    <div class="col-sm-5" style="float:right;"><a href="javascript:void(0);" onclick="marktask(<?php echo $task_detail['task_id'];?>);">Mark as completed</a></div>
                    <?php } else {?>
                    <div class="col-sm-5" style="float:right;">Completed</div>
                    <?php }?>
                </div>   
               </div>
        </div>
        </div>
        <?php $number++; }?>
    </div>
</div>
 <?php } }?>
 
