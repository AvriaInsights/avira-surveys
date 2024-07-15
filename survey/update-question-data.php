<?php
require_once("classes/cls-survey.php");

$obj_survey = new Survey();
$conn = $obj_survey->getConnectionObj();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}

$updquestid=$_POST['updquestid'];
$questiontitle=$_POST['questiontitle'];
$questiontooltip=$_POST['questiontooltip'];
$isrequired=$_POST['isrequired'];
$singleqtype= $_POST['singleqtype'];
$texttype=$_POST['texttype'];
$checkboxoptions=$_POST['checkboxoptions'];
$radoptions=$_POST['radoptions'];
$rankoptions=$_POST['rankoptions'];
$dropdownval=$_POST['dropdownval'];
$mratingoptions=$_POST['mratingoptions'];
$mratingoptiontype=$_POST['mratingoptiontype'];
if($mratingoptiontype == 'textbox')
{
$mrating_range = "";
}
else
{
$mrating_range = $_POST['mrating_range'];
}
$other=$_POST['other'];
$mintext=$_POST['mintext'];
$midtext=$_POST['midtext'];
$maxtext=$_POST['maxtext'];
$dynamic=$_POST['dynamicchk'];

$update_data['question_title'] = mysqli_real_escape_string($conn, str_replace(array(';','”','’','‟','‛'),array("",'"',"'",'"',"'"),addslashes($questiontitle)));
$update_data['tooltip'] = mysqli_real_escape_string($conn, addslashes($questiontooltip));
$update_data['is_required'] = mysqli_real_escape_string($conn, $isrequired);
$update_data['mrating_range'] = mysqli_real_escape_string($conn, $mrating_range);
$update_data['mrating_option_type'] = mysqli_real_escape_string($conn, $mratingoptiontype);
$update_data['is_dynamic'] = mysqli_real_escape_string($conn, $dynamic);
$update_data['updated_at'] = date("Y-m-d h:i:s");
$condition = "`tbl_questionBank`.`question_id` = '" . $updquestid . "'";
$lastupdateid = $obj_survey->updateSurveyQuestion($update_data,$condition, 0);


/**********All Sub Questions***************/
$fields_questions = "*";
$condition_questions = "`tbl_questionSub`.`question_id`='" . $updquestid ."'";
$orderby="`tbl_questionSub`.`rank_order_sequence` DESC";
$rank_questions_count=$obj_survey->getSubQuestionPoints($fields_questions, $condition_questions, $orderby, 1, 0);
if(isset($rank_questions_count) && !empty($rank_questions_count))
{
    foreach($rank_questions_count as $rank_questions_counts)
    {
        $rank_sequence1 =$rank_questions_counts['rank_order_sequence'];
        $rank_sequence=$rank_sequence1+1;
    }
}
else
{
    $rank_sequence="1";
}




if($singleqtype=="Text")
{

    $condition1 = "`tbl_questionSub`.`question_id` = '" . $updquestid . "'";
    if($texttype=="")
    {
       $update_data1['question_subtitle'] = "Text";
    }
    else
    {
       $update_data1['question_subtitle'] = "Text"."-".$texttype;
    }
    
    $update_data1['updated_at'] = date("Y-m-d h:i:s");
    $updid = $obj_survey->updateSurveyQuestionPoints($update_data1,$condition1, 0);

}

if($singleqtype=="Radio" && !empty($radoptions))
{
    
    // for($i=0;$i<count($radoptions);$i++)
    // {
    //     $insert_data['question_id'] = mysqli_real_escape_string($conn, $updquestid);
    //     $insert_data['question_subtitle'] = mysqli_real_escape_string($conn, $radoptions[$i]);
    //     $insert_data['status'] = "Active";
    //     $insert_data['created_at'] = date("Y-m-d h:i:s");
    //     $insert_data['updated_at'] = date("Y-m-d h:i:s");
    //     $lastinsertid = $obj_survey->insertSurveyQuestionSubPoints($insert_data, 0);
    // }
}
if($singleqtype=="Order" && !empty($rankoptions))
{
    
     for($i=0;$i<count($rankoptions);$i++)
     {
        if($rankoptions[$i]!="")
        {
             $rankopt = str_replace(array(':','*'),'',$rankoptions[$i]);
             $insert_data['question_id'] = mysqli_real_escape_string($conn, $updquestid);
             $insert_data['question_subtitle'] = mysqli_real_escape_string($conn, addslashes(trim($rankopt)));
             $insert_data['status'] = "Active";
             $insert_data['rank_order_sequence'] = mysqli_real_escape_string($conn, $rank_sequence+$i);
             $insert_data['created_at'] = date("Y-m-d h:i:s");
             $insert_data['updated_at'] = date("Y-m-d h:i:s");
             $lastinsertid = $obj_survey->insertSurveyQuestionSubPoints($insert_data, 0);
        }
     }
}
if($singleqtype=="Radio" && !empty($other))
{
    
        $insert_data['question_id'] = mysqli_real_escape_string($conn, $updquestid);
        $insert_data['question_subtitle'] = mysqli_real_escape_string($conn, $other);
        $insert_data['status'] = "Active";
        $insert_data['created_at'] = date("Y-m-d h:i:s");
        $insert_data['updated_at'] = date("Y-m-d h:i:s");
        $lastinsertid = $obj_survey->insertSurveyQuestionSubPoints($insert_data, 0);
    
}

if($singleqtype=="Checkbox" && !empty($checkboxoptions))
{
    for($i=0;$i<count($checkboxoptions);$i++)
    {
        if($checkboxoptions[$i]!="")
        {
            $checkopt = str_replace(array(':','*'),'',$checkboxoptions[$i]);
            $insert_data['question_id'] = mysqli_real_escape_string($conn, $updquestid);
            $insert_data['question_subtitle'] = mysqli_real_escape_string($conn, addslashes(trim($checkopt)));
            $insert_data['status'] = "Active";
            $insert_data['created_at'] = date("Y-m-d h:i:s");
            $insert_data['updated_at'] = date("Y-m-d h:i:s");
            $lastinsertid = $obj_survey->insertSurveyQuestionSubPoints($insert_data, 0);
        }
    }
}
if($singleqtype=="Checkbox" && !empty($other))
{
    
        $insert_data['question_id'] = mysqli_real_escape_string($conn, $updquestid);
        $insert_data['question_subtitle'] = mysqli_real_escape_string($conn, $other);
        $insert_data['status'] = "Active";
        $insert_data['created_at'] = date("Y-m-d h:i:s");
        $insert_data['updated_at'] = date("Y-m-d h:i:s");
        $lastinsertid = $obj_survey->insertSurveyQuestionSubPoints($insert_data, 0);
    
}

if($singleqtype=="Mrating" && !empty($mratingoptions))
{
    for($i=0;$i<count($mratingoptions);$i++)
    {
        if($mratingoptions[$i]!="")
        {
            $mratingopt = str_replace(array(':','*'),'',$mratingoptions[$i]);
            $insert_data['question_id'] = mysqli_real_escape_string($conn, $updquestid);
            $insert_data['question_subtitle'] = mysqli_real_escape_string($conn, addslashes(trim($mratingopt)));
            $insert_data['status'] = "Active";
            $insert_data['created_at'] = date("Y-m-d h:i:s");
            $insert_data['updated_at'] = date("Y-m-d h:i:s");
            $lastinsertid = $obj_survey->insertSurveyQuestionSubPoints($insert_data, 0);
        }
    }
}
if($singleqtype=="Mrating" && !empty($other))
{
    
        $insert_data['question_id'] = mysqli_real_escape_string($conn, $updquestid);
        $insert_data['question_subtitle'] = mysqli_real_escape_string($conn, $other);
        $insert_data['status'] = "Active";
        $insert_data['created_at'] = date("Y-m-d h:i:s");
        $insert_data['updated_at'] = date("Y-m-d h:i:s");
        $lastinsertid = $obj_survey->insertSurveyQuestionSubPoints($insert_data, 0);
    
}

if($singleqtype=="Dropdown" && !empty($dropdownval))
{
    for($i=0;$i<count($dropdownval);$i++)
    {
        if($dropdownval[$i]!="")
        {
            $dropopt = str_replace(array(':','*'),'',$dropdownval[$i]);
            $insert_data['question_id'] = mysqli_real_escape_string($conn, $updquestid);
            $insert_data['question_subtitle'] = mysqli_real_escape_string($conn, addslashes(trim($dropopt)));
            $insert_data['status'] = "Active";
            $insert_data['created_at'] = date("Y-m-d h:i:s");
            $insert_data['updated_at'] = date("Y-m-d h:i:s");
            $lastinsertid = $obj_survey->insertSurveyQuestionSubPoints($insert_data, 0);
        }
    }
}

if($singleqtype=="Opinion Scale")
{
$condition3 = "`tbl_questionSub`.`question_id` = '" . $updquestid . "'";
if($mintext==""){ $mintext=" ";}
if($midtext==""){ $midtext=" ";}
if($maxtext==""){ $maxtext=" ";}
$alllevel=$mintext.",".$midtext.",".$maxtext;
//if($mintext){}
$update_data3['opinion_scale_text'] = mysqli_real_escape_string($conn, $alllevel);
$update_data3['updated_at'] = date("Y-m-d h:i:s");
$updid = $obj_survey->updateSurveyQuestionPoints($update_data3,$condition3, 0);

}
//echo $condition1;
?>
