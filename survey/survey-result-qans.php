<?php 
require_once("classes/cls-survey.php");

$obj_survey = new Survey();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login");
}
$responseid=$_GET['resid'];
$userid=$_SESSION['ifg_admin']['client_id'];

/**********Question and answer Survey***************/
$fields_survey_result_ans = "DISTINCT `question_id`";
$condition_survey_result_ans = "`tbl_response_result`.`response_user_id` = '".$responseid."'";
//$orderby_ans="`tbl_response_result`.`result_id` asc";
$all_result_surveys_anss=$obj_survey->getSurveyResult($fields_survey_result_ans, $condition_survey_result_ans, '', '', 0);

?>

<?php $srno=1;
if(isset($all_result_surveys_anss) && !empty($all_result_surveys_anss))
{
foreach($all_result_surveys_anss as $all_result_surveys_ans){
    
    /**********All Questions***************/
    $fields_questions = "*";
    $condition_questions = "`tbl_questionBank`.`question_id` ='".$all_result_surveys_ans['question_id']."'";
    $orderby="`tbl_questionBank`.`sequence` ASC";
    $all_questions=$obj_survey->getQuestionBank($fields_questions, $condition_questions, $orderby, '', 0);
    foreach($all_questions as $all_question)
    {
        $allqtypeid=$all_question['quest_type_id'];
    }
    /*************Question Type*****************/
    $fields_questtype = "quest_type";
    $condition_questtype = "`tbl_question_type`.`quest_type_id` =".$allqtypeid;
    $all_question_types=$obj_survey->getQuestionType($fields_questtype, $condition_questtype, '', '', 0);
    foreach($all_question_types as $all_question_type){
        $qtype=$all_question_type['quest_type'];
    }
    if($qtype=="Mrating")
    {
        $qtypedis="Multiple Rating";
    }
    else
    {
        $qtypedis=$qtype;
    }
    /******************************/
  $answer="";
  $fields_survey_result_ans1 = "*";
  $condition_survey_result_ans1 = "`tbl_response_result`.`response_user_id` = '".$responseid."' and `tbl_response_result`.`question_id` = '".$all_result_surveys_ans['question_id']."'";
  $all_result_surveys_anss1=$obj_survey->getSurveyResult($fields_survey_result_ans1, $condition_survey_result_ans1, '', '', 0);
  foreach($all_result_surveys_anss1 as $all_result_surveys_anss12)
  {
      $qtitle=stripslashes($all_result_surveys_anss12['question_title']);
      if(count($all_result_surveys_anss1)>1)
      {
          if($all_result_surveys_anss12['answer_additional']!="")
          {
            $answer.=stripslashes($all_result_surveys_anss12['answer'])." :: ".stripslashes($all_result_surveys_anss12['answer_additional'])."§";
          }
          else
          {
             $answer.=stripslashes($all_result_surveys_anss12['answer'])."§"; 
          }
      }
      else
      {
         if($all_result_surveys_anss12['answer_additional']!="")
         {
            $answer=stripslashes($all_result_surveys_anss12['answer'])." :: ".stripslashes($all_result_surveys_anss12['answer_additional']);
         }
         else
         {
             $answer=stripslashes($all_result_surveys_anss12['answer']);
         }
      }
  }
  $answer1=trim($answer,"§");
?>
<div class="row">
    <div class="col-md-12">
        <div class="listingbox">
            <div class="form-group">
               <div class="col-md-12">
                  <span class="txtbold">Question <?php echo $srno;?>:</span> <?php echo $qtitle;?><span class="txtbold"> (<?php echo $qtypedis;?>)</span>
                
              </div>
            </div>
            <div class="form-group">
              
              <div class="col-md-12">   
                  <span class="txtbold">Answer:</span> 
                  <?php $sr=1;if(strpos($answer1, "§") !== false)
                        { $ansexp=explode("§",$answer1); 
                          for($t=0;$t<count($ansexp);$t++)
                          {
                              if(strpos($ansexp[$t], "=>") !== false)
                              {
                                  echo "<br>&nbsp;&nbsp;&nbsp;".$sr.") ".str_replace("=>"," ⮕ ",$ansexp[$t]);
                              }
                              else
                              {
                                echo "<br>&nbsp;&nbsp;&nbsp;".$sr.") ".$ansexp[$t];
                              }
                              $sr++;
                          }
                        } 
                        else 
                        {
                            if(strpos($answer1, "=>") !== false)
                            {
                                $srr=1;
                                $answer2=str_replace("=>"," ⮕ ",$answer1); 
                                $ansmat=explode(",",$answer2);
                                for($tt=0;$tt<count($ansmat);$tt++)
                                {
                                   echo "<br>&nbsp;&nbsp;&nbsp;".$srr.") ".$ansmat[$tt]; 
                                   $srr++;
                                }
                            }
                            else
                            {
                                echo $answer1; 
                            }
                                
                        }
                  ?>
              </div>
            </div>
        </div>
    </div>
    
</div>

<?php $srno++; } }else {?>
<div class="row">
    <div class="col-md-12">
        <div class="listingbox">
            <div class="form-group">
                No Question And Answer
            </div>
            
        </div>
    </div>
    
</div>
<?php }?>