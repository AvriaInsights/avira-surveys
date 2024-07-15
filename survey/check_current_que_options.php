<?php 
    require_once("classes/cls-survey.php");
    $obj_survey = new Survey();
    $updateqid = $_POST['updquestid'];
    $fields_questions = "`tbl_questionSub`.`question_subtitle`";
    $condition_questions = "`tbl_questionSub`.`question_id` =".$updateqid;
    $all_questions=$obj_survey->getSubQuestionPoints($fields_questions, $condition_questions, '', '', 0);
    $qcount = count($all_questions);
    echo json_encode($qcount);
?>