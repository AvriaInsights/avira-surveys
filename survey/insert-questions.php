<?php
require_once("classes/cls-survey.php");

$obj_survey = new Survey();
$conn = $obj_survey->getConnectionObj();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}

$qtypeid=$_POST['qtypeid'];
$survid=$_POST['survid'];
$singleqtype= $_POST['singleqtype'];
$allrating="";
$allscale="";
$allskipval1="";
$allskipval2="";
$sequence="";

$fields_questions = "max(sequence)";
$condition_questions = "`tbl_questionBank`.`survey_id` ='".$survid."'";
$all_questions=$obj_survey->getQuestionBank($fields_questions, $condition_questions, '', 0, 0);
if(isset($all_questions) && !empty($all_questions))
{
    foreach($all_questions as $all_question)
    {
        $sequence1=$all_question['max(sequence)'];
        $sequence=$sequence1+1;
    }
}
else
{
    $sequence="1";
}

$insert_data['quest_type_id'] = mysqli_real_escape_string($conn, $qtypeid);
$insert_data['survey_id'] = mysqli_real_escape_string($conn, $survid);
$insert_data['sequence'] = mysqli_real_escape_string($conn, $sequence);
$insert_data['is_required'] = "No";
$insert_data['status'] = "Active";
$insert_data['created_at'] = date("Y-m-d h:i:s");
$insert_data['updated_at'] = date("Y-m-d h:i:s");
$lastinsertid = $obj_survey->insertSurveyQuestion($insert_data, 0);


if($singleqtype=="Boolean")
{
$insert_data1['question_id'] = mysqli_real_escape_string($conn, $lastinsertid);
$insert_data1['question_subtitle'] = "Yes";
$insert_data1['status'] = "Active";
$insert_data1['created_at'] = date("Y-m-d h:i:s");
$insert_data1['updated_at'] = date("Y-m-d h:i:s");
$obj_survey->insertSurveyQuestionSubPoints($insert_data1, 0);

$insert_data2['question_id'] = mysqli_real_escape_string($conn, $lastinsertid);
$insert_data2['question_subtitle'] = "No";
$insert_data2['status'] = "Active";
$insert_data2['created_at'] = date("Y-m-d h:i:s");
$insert_data2['updated_at'] = date("Y-m-d h:i:s");
$obj_survey->insertSurveyQuestionSubPoints($insert_data2, 0);
}

if($singleqtype=="Opinion Scale")
{
$mintext="Least Likely";
$midtext="Neutral";
$maxtext="Most Likely";
$alllevel=$mintext.",".$midtext.",".$maxtext;

for($t=0;$t<=10;$t++)
{
    $allscale.=$t.",";
    $allskipval1.="0".",";
}
$scale = trim($allscale,",");
$skipval1=trim($allskipval1,",");
$insert_data3['question_id'] = mysqli_real_escape_string($conn, $lastinsertid);
$insert_data3['question_subtitle'] = mysqli_real_escape_string($conn, $scale);
$insert_data3['skip_question'] = mysqli_real_escape_string($conn, $skipval1);
$insert_data3['opinion_scale_text'] = mysqli_real_escape_string($conn, $alllevel);
$insert_data3['status'] = "Active";
$insert_data3['created_at'] = date("Y-m-d h:i:s");
$insert_data3['updated_at'] = date("Y-m-d h:i:s");
$obj_survey->insertSurveyQuestionSubPoints($insert_data3, 0);

}

if($singleqtype=="Rating")
{

    for($k=1;$k<=5;$k++)
    {
        $allrating.= $k.",";
        $allskipval2.="0".",";
    }
    $rating = trim($allrating,",");
    $skipval2=trim($allskipval2,",");
    $insert_data4['question_id'] = mysqli_real_escape_string($conn, $lastinsertid);
    $insert_data4['question_subtitle'] = mysqli_real_escape_string($conn, $rating);
    $insert_data4['skip_question'] = mysqli_real_escape_string($conn, $skipval2);
    $insert_data4['status'] = "Active";
    $insert_data4['created_at'] = date("Y-m-d h:i:s");
    $insert_data4['updated_at'] = date("Y-m-d h:i:s");
    $obj_survey->insertSurveyQuestionSubPoints($insert_data4, 0);
}


if($singleqtype=="Matrix")
{
    $matrixarray=array("statement 1"=>"row","statement 2"=>"row","Scale Point 1"=>"column","Scale Point 2"=>"column","Scale Point 3"=>"column");
    foreach($matrixarray as $key => $value)
    {
        $insert_data5['question_id'] = mysqli_real_escape_string($conn, $lastinsertid);
        $insert_data5['question_subtitle'] = mysqli_real_escape_string($conn, $key);
        $insert_data5['matrix_type'] = mysqli_real_escape_string($conn, $value);
        $insert_data5['status'] = "Active";
        $insert_data5['created_at'] = date("Y-m-d h:i:s");
        $insert_data5['updated_at'] = date("Y-m-d h:i:s");
        $tt=$obj_survey->insertSurveyQuestionSubPoints($insert_data5, 0);
    }
    
}

$fields_questions = "*";
$condition_questions = "`tbl_questionBank`.`question_id` =".$lastinsertid;
$all_questions_seq=$obj_survey->getQuestionBank($fields_questions, $condition_questions, '', '', 0);
foreach($all_questions_seq as $all_questions_seqs)
{
    $seq = $all_questions_seqs['sequence'];
}
echo $lastinsertid."*".$seq;

//header("location:https://www.software-intent.com/survey/add-survey.php?surveyid=".$lastinsertid);

//header("Location:" . SITEPATH . "survey/add-survey.php?surveyid=".$lastinsertid);
?>