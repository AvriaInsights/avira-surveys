<?php

require_once("classes/cls-survey.php");

$obj_survey = new Survey();
$conn = $obj_survey->getConnectionObj();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login");
}

$surveytitle=$_POST['surveytitle'];
$campaign_name=$_POST['campaign_name'];
$survey_purpose=$_POST['survey_purpose'];
$surveycatid=$_POST['category'];
$surveydescription=$_POST['description'];
$take_away=$_POST['take_away'];
$userid=$_SESSION['ifg_admin']['client_id'];
$filledby=$_POST['filledby'];
$survey_status = $_POST['is_publish'];
$userformposition=$_POST['user_form_position'];

if(isset($_POST['templateid']) && !empty($_POST['templateid']))
{
    $filledby="Template";
    $insert_data['template_id'] = mysqli_real_escape_string($conn, $_POST['templateid']);
}

// Make UUID //

function guidv4($data = null) {
    // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);

    // Set version to 0100
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Set bits 6-7 to 10
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    // Output the 36 character UUID.
    $GLOBALS['uu_id'] = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
  
  //  echo $uuid;
}

guidv4();
// End UUID

$insert_data['survey_id'] = mysqli_real_escape_string($conn, $uu_id);
$insert_data['survey_title'] = mysqli_real_escape_string($conn, $surveytitle);
$insert_data['campaign_name'] = mysqli_real_escape_string($conn, $campaign_name);
$insert_data['survey_purpose'] = mysqli_real_escape_string($conn, $survey_purpose);
$insert_data['category_id'] = mysqli_real_escape_string($conn, $surveycatid);
$insert_data['user_id'] = mysqli_real_escape_string($conn, $userid);
$insert_data['filled_by'] = mysqli_real_escape_string($conn, $filledby);
$insert_data['survey_description'] = mysqli_real_escape_string($conn, $surveydescription);
$insert_data['take_away'] = mysqli_real_escape_string($conn, $take_away);
$insert_data['survey_status'] = mysqli_real_escape_string($conn, $survey_status);
$insert_data['submit_form_position'] = mysqli_real_escape_string($conn, $userformposition);
$insert_data['status'] = "Active";
$insert_data['created_at'] = date("Y-m-d h:i:s");
$insert_data['updated_at'] = date("Y-m-d h:i:s");

$lastinsertid = $obj_survey->insertSurveyTitle($insert_data, 0);

if(isset($_POST['templateid']) && !empty($_POST['templateid']))
{
    
    $fields_dummy_questions = "*";
    $condition_dummy_questions = "`tbl_dummy_questionBank`.`template_id` =".$_POST['templateid'];
    $all_dummy_questions=$obj_survey->getDummyQuestions($fields_dummy_questions, $condition_dummy_questions, '', '', 0);
    
    foreach($all_dummy_questions as $all_dummy_question)
    {
       
       $dummyquesttitle = $all_dummy_question['question_title'];
       $dummyquesttypeid = $all_dummy_question['quest_type_id'];
       $sequence = $all_dummy_question['sequence'];
       $is_required = $all_dummy_question['is_required'];
       $tooltip = $all_dummy_question['tooltip'];
       $surveyid=$uu_id;
       $insert_data1['quest_type_id'] = mysqli_real_escape_string($conn, $dummyquesttypeid);
       $insert_data1['survey_id'] = mysqli_real_escape_string($conn, $surveyid);
       $insert_data1['question_title'] = mysqli_real_escape_string($conn, $dummyquesttitle);
       $insert_data1['sequence'] = mysqli_real_escape_string($conn, $sequence);
       $insert_data1['is_required'] = mysqli_real_escape_string($conn, $is_required);
       $insert_data1['tooltip'] = mysqli_real_escape_string($conn, $tooltip);
       $insert_data1['status'] = "Active";
       $insert_data1['created_at'] = date("Y-m-d h:i:s");
       $insert_data1['updated_at'] = date("Y-m-d h:i:s");
       $lastinsertidquestion = $obj_survey->insertSurveyQuestion($insert_data1, 0);
       
       $fields_dummy_sub__points = "*";
       $condition_dummy_sub_points = "`tbl_dummy_subQuestion`.`question_id` =".$dummyquesttypeid;
       $all_dummy_sub_points=$obj_survey->getDummySubQuestionPoint($fields_dummy_sub__points, $condition_dummy_sub_points, '', '', 0);
       
       foreach($all_dummy_sub_points as $all_dummy_sub_point)
       {
           $dummyquestsubpoint = $all_dummy_sub_point['question_subtitle'];
           
           $insert_data2['question_id'] = mysqli_real_escape_string($conn, $lastinsertidquestion);
           $insert_data2['question_subtitle'] = mysqli_real_escape_string($conn, $dummyquestsubpoint);
           $insert_data2['status'] = "Active";
           $insert_data2['created_at'] = date("Y-m-d h:i:s");
           $insert_data2['updated_at'] = date("Y-m-d h:i:s");
           $lastinsertidpoints = $obj_survey->insertSurveyQuestionSubPoints($insert_data2, 0);
       }
    }
}
//header("location:https://www.software-intent.com/survey/add-survey.php?surveyid=".$lastinsertid);
if($filledby=="Manual" || $filledby=="Template")
{
header("Location:" . SITEPATH . "add-survey?surveyid=".$uu_id);
}
if($filledby=="Bulk")
{
header("Location:" . SITEPATH . "bulk-survey.php?surveyid=".$uu_id);
}
if($filledby=="CopyPaste")
{
header("Location:" . SITEPATH . "copy-paste-survey.php?surveyid=".$uu_id);
}
?>