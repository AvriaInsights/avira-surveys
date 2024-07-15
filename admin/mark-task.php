<?php
require_once("classes/cls-request.php");

$obj_request = new Request();

$taskid=$_POST['taskid'];
$condition= "`task_id` = '" . $taskid . "'";
$insert_data12['is_completed'] = "Yes";
$obj_request->updateTask($insert_data12,$condition, 0);
?>