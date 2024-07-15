<?php
require_once("classes/cls-survey.php");

$obj_survey = new Survey();
$conn = $obj_survey->getConnectionObj();

$skipid=$_POST['skipqid'];
$skipval=$_POST['skipval'];
$currquestionid=$_POST['updquestid'];
$questtype=$_POST['questtype'];
$qqid=$_POST['qqid'];
$cursequence=$_POST['cursequence'];
$valarray="";
$skipvalarray="";

$update_data12['skip_from_which_question'] = mysqli_real_escape_string($conn, $cursequence);
$condition12 = "`tbl_questionBank`.`question_id` = '" . $qqid . "'";
$obj_survey->updateSurveyQuestion($update_data12,$condition12, 0);

if($skipval == "All")
{
    $fields_subquestions_endpoint = "`tbl_questionSub`.`question_subtitle`";
    $condition_subquestion_endpoint = "`tbl_questionSub`.`question_id` =".$currquestionid;
    $all_subquestionsendpoint=$obj_survey->getSubQuestionPoints($fields_subquestions_endpoint, $condition_subquestion_endpoint, '', '', 0);
    foreach($all_subquestionsendpoint as $all_subquestionsendpoints)
    {
        $subtitleend=$all_subquestionsendpoints['question_subtitle'];
        // if($questtype == "Text" || $questtype == "Checkbox" || $questtype == "Order" || $questtype == "Dropdown" || $questtype == "Mrating" || $questtype == "Matrix" || $questtype == "Radio")
        // {
            
        //}
        if($skipid=="End")
        {
            if($questtype=="Rating" || $questtype=="Opinion Scale")
            {
                $valarray=explode(",",$subtitleend);
                
                for($k=0;$k<count($valarray);$k++)
                {
                    if($skipid=="")
                    {
                        $skipid=0;
                    }
                    $newval1.=$skipid.",";
                }
                $newval2=trim($newval1,",");
                    $update_data1['skip_question'] = mysqli_real_escape_string($conn, $newval2);
                    $condition_que_points_end = "`tbl_questionSub`.`question_subtitle` ='".$subtitleend."' and `tbl_questionSub`.`question_id` ='".$currquestionid."'";
                    $update_subpointsend=$obj_survey->updateSurveyQuestionPoints($update_data1,$condition_que_points_end, 0);
            }
            else
            {
                $update_data1['skip_question'] = mysqli_real_escape_string($conn, $skipid);
                $condition_que_points_end = "`tbl_questionSub`.`question_id` ='".$currquestionid."'";
                //echo $condition_que_points_end; exit;
                $update_subpointsend=$obj_survey->updateSurveyQuestionPoints($update_data1,$condition_que_points_end, 0);
            }
        }
        else if($skipid=="Remove")
        {
            if($questtype=="Rating" || $questtype=="Opinion Scale")
            {
                $valarray=explode(",",$subtitleend);
                
                for($k=0;$k<count($valarray);$k++)
                {
                    $newval1.="0".",";
                }
                $newval2=trim($newval1,",");
                    $update_data1['skip_question'] = mysqli_real_escape_string($conn, $newval2);
                    $condition_que_points_end = "`tbl_questionSub`.`question_subtitle` ='".$subtitleend."' and `tbl_questionSub`.`question_id` ='".$currquestionid."'";
                    $update_subpointsend=$obj_survey->updateSurveyQuestionPoints($update_data1,$condition_que_points_end, 0);
            }
            else
            {
                $update_data1['skip_question'] = mysqli_real_escape_string($conn, "");
                $condition_que_points_end = "`tbl_questionSub`.`question_id` ='".$currquestionid."'";
                //echo $condition_que_points_end; exit;
                $update_subpointsend=$obj_survey->updateSurveyQuestionPoints($update_data1,$condition_que_points_end, 0);
            }
        }
        else
        {
            if($questtype=="Rating" || $questtype=="Opinion Scale")
            {
                $valarray=explode(",",$subtitleend);
                
                for($k=0;$k<count($valarray);$k++)
                {
                    $newval1.=$skipid.",";
                }
                $newval2=trim($newval1,",");
                    $update_data1['skip_question'] = mysqli_real_escape_string($conn, $newval2);
                    $condition_que_points_end = "`tbl_questionSub`.`question_subtitle` ='".$subtitleend."' and `tbl_questionSub`.`question_id` ='".$currquestionid."'";
                    $update_subpointsend=$obj_survey->updateSurveyQuestionPoints($update_data1,$condition_que_points_end, 0);
            }
            else
            {
                $update_data1['skip_question'] = mysqli_real_escape_string($conn, $skipid);
                $condition_que_points_end = "`tbl_questionSub`.`question_id` ='".$currquestionid."'";
                //echo $condition_que_points_end; exit;
                $update_subpointsend=$obj_survey->updateSurveyQuestionPoints($update_data1,$condition_que_points_end, 0);
            }
        }
        
    }
            
}
else
{
if($skipid=="Remove")
{
   if($questtype=="Rating" || $questtype=="Opinion Scale")
    {
        $fields_subquestions = "`tbl_questionSub`.`question_subtitle`,`tbl_questionSub`.`skip_question`";
        $condition_subquestions = "`tbl_questionSub`.`question_id` =".$currquestionid;
        $all_subquestions=$obj_survey->getSubQuestionPoints($fields_subquestions, $condition_subquestions, '', '', 0);
        foreach($all_subquestions as $all_subquestion)
        {
            $subtitle=$all_subquestion['question_subtitle'];
            $skip_question=$all_subquestion['skip_question'];
        }
        if($skipid=="Remove")
        {
            $skipid=0;
        }
        $valarray=explode(",",$subtitle);
        $skipvalarray=explode(",",$skip_question);
        $skippostition = array_search($skipval,$valarray);
        $skipvalarray[$skippostition]=$skipid;
        $newval=implode(",",$skipvalarray);
        
    }
    
    /**********Update Sub Points***************/
    if($questtype=="Rating" || $questtype=="Opinion Scale")
    {
         $update_data['skip_question'] = mysqli_real_escape_string($conn, $newval);
         $condition_subpoints = "`tbl_questionSub`.`question_id` ='".$currquestionid."'";
    }
    else
    {
        $update_data['skip_question'] = mysqli_real_escape_string($conn, "");
        $condition_subpoints = "`tbl_questionSub`.`question_id` ='".$currquestionid."' and `tbl_questionSub`.`question_subtitle` ='".$skipval."'";
    }
    
    if($questtype=="Radio")
    {
        $update_data['skip_question'] = mysqli_real_escape_string($conn, "");
        $condition_subpoints = "`tbl_questionSub`.`question_subid` ='".$skipval."'";
        
    }
    
    $update_subpoints=$obj_survey->updateSurveyQuestionPoints($update_data,$condition_subpoints, 0);
    
    if($questtype == "Text" || $questtype == "Checkbox" || $questtype == "Order" || $questtype == "Dropdown" || $questtype == "Mrating" || $questtype == "Matrix")
    {
        $update_data_que['skip_question_where_to'] = mysqli_real_escape_string($conn, "");
        $condition_que_points = "`tbl_questionBank`.`question_id` ='".$currquestionid."'";
        $insert_quepoints=$obj_survey->UpdateSurveyQuestionskip($update_data_que,$condition_que_points,0);
    } 
}
else
{
    if($questtype=="Rating" || $questtype=="Opinion Scale")
    {
        $fields_subquestions = "`tbl_questionSub`.`question_subtitle`,`tbl_questionSub`.`skip_question`";
        $condition_subquestions = "`tbl_questionSub`.`question_id` =".$currquestionid;
        $all_subquestions=$obj_survey->getSubQuestionPoints($fields_subquestions, $condition_subquestions, '', '', 0);
        foreach($all_subquestions as $all_subquestion)
        {
            $subtitle=$all_subquestion['question_subtitle'];
            $skip_question=$all_subquestion['skip_question'];
        }
        if($skipid=="")
        {
            $skipid=0;
        }
        $valarray=explode(",",$subtitle);
        $skipvalarray=explode(",",$skip_question);
        $skippostition = array_search($skipval,$valarray);
        $skipvalarray[$skippostition]=$skipid;
        $newval=implode(",",$skipvalarray);
        
    }
    
    /**********Update Sub Points***************/
    if($questtype=="Rating" || $questtype=="Opinion Scale")
    {
         $update_data['skip_question'] = mysqli_real_escape_string($conn, $newval);
         $condition_subpoints = "`tbl_questionSub`.`question_id` ='".$currquestionid."'";
    }
    else
    {
        $update_data['skip_question'] = mysqli_real_escape_string($conn, $skipid);
        $condition_subpoints = "`tbl_questionSub`.`question_id` ='".$currquestionid."' and `tbl_questionSub`.`question_subtitle` ='".$skipval."'";
    }
    
    if($questtype=="Radio")
    {
        $update_data['skip_question'] = mysqli_real_escape_string($conn, $skipid);
        $condition_subpoints = "`tbl_questionSub`.`question_subid` ='".$skipval."'";
        
    }
    
    $update_subpoints=$obj_survey->updateSurveyQuestionPoints($update_data,$condition_subpoints, 0);
    
    if($questtype == "Text" || $questtype == "Checkbox" || $questtype == "Order" || $questtype == "Dropdown" || $questtype == "Mrating" || $questtype == "Matrix")
    {
        $update_data_que['skip_question_where_to'] = mysqli_real_escape_string($conn, $skipid);
        $condition_que_points = "`tbl_questionBank`.`question_id` ='".$currquestionid."'";
        $insert_quepoints=$obj_survey->UpdateSurveyQuestionskip($update_data_que,$condition_que_points,0);
    }
}
echo $update_subpoints;

}

////////
   /* */

?>
