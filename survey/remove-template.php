<?php
require_once("classes/cls-template.php");

require_once("classes/cls-survey.php");

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}

$obj_request = new Template();

$obj_survey = new Survey();
// print_r($condition);exit;
if(!empty($_POST['question_id'])){
$questionid=$_POST['question_id'];
$condition = "`question_id` =" . $questionid;
$all_question = $obj_survey->deleteQuestion($condition, 0);
    echo $response =1;

}else{
    echo $response =2;
}
//print_r($_POST['dummy_question_id']);
 exit;
?>