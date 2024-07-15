<?php
require_once("classes/cls-request.php");

$obj_request = new Request();

$taskid=$_POST['taskid'];
$condition= "`task_id` = '" . $taskid . "'";
$all_task = $obj_request->deleteTask($condition, 0);
?>