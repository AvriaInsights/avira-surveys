<?php 
require_once("classes/cls-survey.php");

$obj_survey = new Survey();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login");
}
$subtitle=$_GET['subtitle'];
$qid=$_GET['qid'];
$qtype=$_GET['qtype'];
$subqid=$_GET['subqid'];
$mscale=$_GET['mscale'];
$surveyid=$_GET['surveyid'];
/**********Question and answer Survey User***************/
$fields_survey_result_ans = "*";
if($qtype=="Text")
{
  $condition_survey_result_ans = "`tbl_response_result`.`question_id` ='".$qid."' and `tbl_response_result`.`survey_fill_position` ='Full'"; 
}
else
{
    if($subqid=="0")
    {
        $condition_survey_result_ans = "`tbl_response_result`.`question_id` ='".$qid."' and `tbl_response_result`.`answer` ='".$subtitle."' and `tbl_response_result`.`survey_fill_position` ='Full'";
    }
    else
    {
        if($qtype=="Mrating")
        {
            if($mscale=="Textbox"){
               $condition_survey_result_ans = "`tbl_response_result`.`question_id` ='".$qid."' and `tbl_response_result`.`question_subid` ='".$subqid."' and `tbl_response_result`.`answer_additional` !='' and `tbl_response_result`.`survey_fill_position` ='Full'";
            }
            else{
            $condition_survey_result_ans = "`tbl_response_result`.`question_id` ='".$qid."' and `tbl_response_result`.`question_subid` ='".$subqid."' and `tbl_response_result`.`answer_additional` ='".$mscale."' and `tbl_response_result`.`survey_fill_position` ='Full'";
            }
        }
        else if($qtype=="Matrix")
        {
            $condition_survey_result_ans = "`tbl_response_result`.`question_id` ='".$qid."' and `tbl_response_result`.`survey_fill_position` ='Full'";
        }
        else
        {
            $condition_survey_result_ans = "`tbl_response_result`.`question_id` ='".$qid."' and `tbl_response_result`.`question_subid` ='".$subqid."' and `tbl_response_result`.`survey_fill_position` ='Full'";
        }
    }
}

$orderby_ans="`tbl_response_result`.`result_id` asc";
$all_result_surveys_anss=$obj_survey->getSurveyResult($fields_survey_result_ans, $condition_survey_result_ans, $orderby_ans, '', 0);

?>

<?php $srno=1;
if(isset($all_result_surveys_anss) && !empty($all_result_surveys_anss))
{
foreach($all_result_surveys_anss as $all_result_surveys_ans){
    $result_user_id=$all_result_surveys_ans['response_user_id'];
    $fields_user = "*";
    $condition_user = "`tbl_response_user`.`response_user_id` ='".$result_user_id."'";
    $all_result_users=$obj_survey->getSurveyUser($fields_user, $condition_user, '', '', 0);
    foreach($all_result_users as $all_result_user)
    {
        $name=$all_result_user['user_fullname'];
        $email=$all_result_user['user_email'];
    }
    $sr=1;
?>
<div class="row">
    <div class="col-md-12">
        <div class="listingbox">
            <div class="form-group">
               <?php if($qtype=="Text"){?>
               <div class="col-md-12">
                  <?php echo $srno;?>) <?php echo $name;?> (<?php echo $email;?>)
                  <a href="#" data-bs-toggle="modal" data-bs-target="#result1" onclick="setresponseid1(<?php echo $result_user_id;?>,'<?php echo $surveyid;?>')">Click Here</a>
                
              </div>
              <div class="col-md-12">
                  <span style="font-weight:bold;">User Data : </span><?php echo stripslashes($all_result_surveys_ans['answer']);?>
              </div>
              <?php } else if($qtype=="Matrix"){ 
              
                 $ansmat=explode(",",stripslashes($all_result_surveys_ans['question_subid']));
            
              
              ?>
              <div class="col-md-12">
                  <?php echo $srno;?>) <?php echo $name;?> (<?php echo $email;?>)
                  <a href="#" data-bs-toggle="modal" data-bs-target="#result1" onclick="setresponseid1(<?php echo $result_user_id;?>,'<?php echo $surveyid;?>')">Click Here</a>

                
              </div>
              <div class="col-md-12">
                  <span style="font-weight:bold;">User Data : </span>
                  <?php for($mat=0;$mat<count($ansmat);$mat++){ $ansmatsplit=explode("=>",$ansmat[$mat]);
                            $fields_subpoints = "question_subtitle";
                            $condition_subpoints = "`tbl_questionSub`.`question_subid` =".$ansmatsplit[0];
                            $all_subpoints=$obj_survey->getSubQuestionPoints($fields_subpoints, $condition_subpoints, '', '', 0);
                            foreach($all_subpoints as $all_subpoint)
                            {
                                $matrow=$all_subpoint['question_subtitle'];
                            }
                            $condition_subpoints1 = "`tbl_questionSub`.`question_subid` =".$ansmatsplit[1];
                            $all_subpoints1=$obj_survey->getSubQuestionPoints($fields_subpoints, $condition_subpoints1, '', '', 0);
                            foreach($all_subpoints1 as $all_subpoint1)
                            {
                                $matcol=$all_subpoint1['question_subtitle'];
                            }
                            $fullmatval=$matrow." ⮕ ".$matcol;
                  echo "<br>";?>
                  <?php echo $sr;?>) <?php echo $fullmatval;?>
                  <?php $sr++;}?>
              </div>
               <?php } else {?>
               <div class="col-md-12">
                  <?php if($subtitle=="Other"){?>
                  <?php echo $srno;?>) <?php echo $name;?> (<?php echo $email;?>)
                  <a href="#" data-bs-toggle="modal" data-bs-target="#result1" onclick="setresponseid1(<?php echo $result_user_id;?>,'<?php echo $surveyid;?>')">Click Here</a>

                  <br>
                  <span style="font-weight:bold;">Other Data : </span><?php echo stripslashes($all_result_surveys_ans['answer_additional']);?>
                  <?php } else {?>
                  <?php echo $srno;?>) <?php echo $name;?> (<?php echo $email;?>)
                  <a href="#" data-bs-toggle="modal" data-bs-target="#result1" onclick="setresponseid1(<?php echo $result_user_id;?>,'<?php echo $surveyid;?>')">Click Here</a>

                  <?php }?>
              </div>
              <?php }?>
            </div>
            
        </div>
    </div>
    
</div>

<?php $srno++; } }else {?>
<div class="row">
    <div class="col-md-12">
        <div class="listingbox">
            <div class="form-group">
                No User
            </div>
            
        </div>
    </div>
    
</div>
<?php }?>

<script type="text/javascript">
	
function setresponseid1(resid,survid)
{
    //$("#resuid").val(resid);
            $.ajax({
				url: "<?php echo SITEPATH;?>get-response-user-name.php",
				type: "GET",
				data: {
					resid : resid
				},
				cache: false,
				success: function(ans_user1){
				    $("#resp-username").html(ans_user1);
				}
			});
    $("#questionanswer_user").html("");
            $.ajax({
				url: "<?php echo SITEPATH;?>survey-result-qans.php",
				type: "GET",
				data: {
					resid : resid,survid:survid
				},
				cache: false,
				beforeSend: function(){
                    // Show image container
                    $('#loader2').show();
                },
				success: function(ans_user){
				    //alert(ans);
				    $('#loader2').hide();
					$("#questionanswer_user").html(ans_user);
				}
			});
}
</script>