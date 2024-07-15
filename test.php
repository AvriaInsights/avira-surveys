<?php
require_once("survey/classes/cls-survey.php");
require_once("survey/classes/phpmailer.php");

$obj_survey = new Survey();
$conn = $obj_survey->getConnectionObj();
$matrowbycol="";
$rankanswer=explode("::","i::2");
print_r($rankanswer);
              echo  $rankanswer1=$rankanswer[0];
            echo  "dd".$rankansweradd=$rankanswer[1];
$answer="2466¶2468♦2466¶2469♦2467¶2468♦2467¶2469";        
$staranswer=explode("♦",$answer);
        for($t=0;$t<count($staranswer);$t++)
        {
                if(strpos($staranswer[$t], "¶") !== false){
                $matrixanswer=explode("¶",$staranswer[$t]);
                $matrow=$matrixanswer[0];
                $matcol=$matrixanswer[1];
                $fields_subquestions = "*";
                $condition_subquestions = "`tbl_questionSub`.`question_subid` ='".$matrow."'";
                $specific_subquestions=$obj_survey->getSubQuestionPoints($fields_subquestions, $condition_subquestions, '', '', 0);
                foreach($specific_subquestions as $specific_subquestion)
                {
                    $matrows=$specific_subquestion['question_subtitle'];
                }
                $condition_subquestions1 = "`tbl_questionSub`.`question_subid` ='".$matcol."'";
                $specific_subquestions1=$obj_survey->getSubQuestionPoints($fields_subquestions, $condition_subquestions1, '', '', 0);
                foreach($specific_subquestions1 as $specific_subquestion1)
                {
                    $matcols=$specific_subquestion1['question_subtitle'];
                    
                }
                 $matrowbycol.=$matrows."=>".$matcols.",";
                }
        }
        echo $matrowbycol;
?>