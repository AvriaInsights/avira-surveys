<?php
require_once("classes/cls-request.php");

$obj_request = new Request();

$reqid=$_POST['reqid'];
/***********Task detial******/
$fields_task = "*";
$condition_task = "`request_id` = '" . $reqid . "'";
$sort_by = "`tbl_task`.`task_id` DESC";
$task_details = $obj_request->getTask($fields_task, $condition_task, $sort_by, '', 0);

?>