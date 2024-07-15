<?php
require_once("classes/cls-request.php");

$obj_request = new Request();

$reqid=$_POST['reqid'];
/***********Task detial******/
$fields_comment = "*";
$sort_by_comm = "`tbl_comment`.`comment_id` DESC";
$condition_comment = "`request_id` = '" . $reqid . "'";
$comment_details = $obj_request->getCommentDetails($fields_comment, $condition_comment, $sort_by_comm, '', 0);
?>
<?php if(isset($comment_details)){?>
<?php foreach($comment_details as $comment_detail){ ?>
<div class="saved--note show-all filter-info" style="width:99%;">
    <div class="notes-main-div">
        <div class="comment-icon-box"><i class="fa fa-info-circle" aria-hidden="true" style="color: chocolate; position: absolute; top: 22%; font-size:32px;"></i></div>
        <div class="note--content">
            <div class="col-sm-12 no-pad">
                <div class="col-sm-6 no-pad">
                    
                    <p class="note--font" style="text-transform:capitalize">Comments</p>
                    <p class="date--time--font"><?php echo $comment_detail['created_at'];?></p>
                    <p><?php echo $comment_detail['comment'];?></p>
                    
                   
                 </div>
            </div>
        </div>
   </div>
 </div>
 <?php } }?>