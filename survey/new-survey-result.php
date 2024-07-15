<?php 
require_once("classes/cls-survey.php");

$obj_survey = new Survey();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login");
}

$userid=$_SESSION['ifg_admin']['client_id'];

if(isset($_GET['surveyid']))
{
    $surveyid=$_GET['surveyid'];
    /**********All Questions***************/
    $fields_questions = "*";
    $condition_questions = "`tbl_questionBank`.`survey_id` ='".$surveyid."'";
    $orderby="`tbl_questionBank`.`sequence` ASC";
    $all_questions=$obj_survey->getQuestionBank($fields_questions, $condition_questions, $orderby, '', 0);
}
else
{
    $surveyid="";
}


?>
<?php include('dashboard-header-menu.php')?>
<style>
    .star-size{
        font-size:40px;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <?php include('dashboard-side-menubar.php')?>
        </div>
        <div class="col-md-9">
            <section class="content-wrapper">
                <div class="container" style="height:100vh;">
                    <div class="row">
                          <div class="col-md-12">
                              <h3 class="sm-menu-question-header1">
                                  Result Dashboard
                              </h3>
                          </div>
                        </div>
                    <div id="mine">
                        <div class="row d-flex align-items-center">
                                <div class="col-md-6">
                                    <div class="sm-menu-question-sub-header1">
                                        <h4 class="fw-bold">Survey Question and Answer</h4>
                                    </div>
                                </div>
                                
                        </div>
                        <?php if(isset($all_questions) && !empty($all_questions)){?>
                        <?php foreach($all_questions as $all_question){?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row listingbox d-flex align-items-center">
                                        <div class="col-md-12 txtbold">
                                                Q <?php echo $all_question['sequence'];?>) <?php echo $all_question['question_title'];?>
                                        </div>
                                         <?php 
                                            /**********All Sub Points Questions***************/
                                            $fields_subpoints = "*";
                                            $condition_subpoints = "`tbl_questionSub`.`question_id` =".$all_question['question_id'];
                                            $all_subpoints=$obj_survey->getSubQuestionPoints($fields_subpoints, $condition_subpoints, '', '', 0);
                                            
                                            $fields_questtype = "quest_type";
                                            $condition_questtype = "`tbl_question_type`.`quest_type_id` =".$all_question['quest_type_id'];
                                            $all_question_types=$obj_survey->getQuestionType($fields_questtype, $condition_questtype, '', '', 0);
                                            foreach($all_question_types as $all_question_type){
                                                $qtype=$all_question_type['quest_type'];
                                            }
                                            
                                            $fields_subresult = "*";
                                            $condition_subresult = "`tbl_response_result`.`question_id` =".$all_question['question_id'];
                                            $all_subresults=$obj_survey->getSurveyResult($fields_subresult, $condition_subresult, '', '', 0);
                                            $questcnt=count($all_subresults);
                                         ?>   
                                        <div class="row">
                                            <div class="col-md-12">
                                            <?php if($qtype == "Boolean"){?>
                                                <div class="row justify-content-center">
                                                    <div class="col-2 yesno_box__icon-wrap">
                                                        <i class="fa fa-thumbs-up" style="font-size:100px;"></i>
                                                    </div>
                                                    <div class="col-2 yesno_box__icon-wrap" style="margin-left:10px;">
                                                        <i class="fa fa-thumbs-down" style="font-size:100px;"></i>
                                                    </div>
                                                 </div>
                                                 <div class="row justify-content-center">
                                                    <?php foreach($all_subpoints as $all_subpoint){
                                                      $fields_subresult1 = "*";
                                                      $condition_subresult1 = "`tbl_response_result`.`question_id` ='".$all_question['question_id']."' and `tbl_response_result`.`answer` ='".$all_subpoint['question_subtitle']."'";
                                                      $all_subresults1=$obj_survey->getSurveyResult($fields_subresult1, $condition_subresult1, '', '', 0);
                                                      $boolcnt=count($all_subresults1);
                                                      if($questcnt!="0")
                                                      {
                                                        $boolpercent = ($boolcnt/$questcnt)*100;
                                                      }
                                                      else
                                                      {
                                                        $boolpercent="0";
                                                      }
                                                    ?>
                                                    <div class="col-2 bollab">
                                                        <label><?php echo $all_subpoint['question_subtitle'];?></label><br>
                                                        <label><a href="#" data-bs-toggle="modal" data-bs-target="#result" onclick="setresponseid(<?php echo $all_question['question_id'];?>,'<?php echo $all_subpoint['question_subtitle'];?>')"><?php echo round($boolpercent,1)."%";?></a></label>
                                                    </div>
                                                    
                                                    <?php }?>
                                                    
                                                 </div>
                                                 <div class="row" style="margin-top:20px;">
                                                     <div class="col-md-4 offset-md-4 d-flex">
                                                         <div id="piechart-<?php echo $all_question['question_id']?>"></div>
                                            		</div>
                                            	</div>
                                            <?php } ?>
                                            <?php if($qtype == "Text"){?>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="row justify-content-center">
                                                                <?php foreach($all_subpoints as $all_subpoint){?>
                                                                <div class="col-2 bollab">
                                                                    <label><?php echo $all_subpoint['question_subtitle'];?></label>
                                                                </div>
                                                                <?php }?>
                                                             </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <?php if($qtype == "Rating"){?>
                                                <div class="row justify-content-center">
                                                    <div class="col-md-12 text-center star-size">
                                                        <?php foreach($all_subpoints as $all_subpoint){ $allrating=$all_subpoint['question_subtitle'];}
                                                          $rating=explode(",",$allrating);
                                                        ?>
                                                        <?php $ratno=1;for($i=0;$i<count($rating);$i++){
                                                              $fields_subresult1 = "*";
                                                              $condition_subresult1 = "`tbl_response_result`.`question_id` ='".$all_question['question_id']."' and `tbl_response_result`.`answer` ='".$rating[$i]."'";
                                                              $all_subresults1=$obj_survey->getSurveyResult($fields_subresult1, $condition_subresult1, '', '', 0);
                                                              $boolcnt=count($all_subresults1);
                                                              if($questcnt!="0")
                                                              {
                                                                $boolpercent = ($boolcnt/$questcnt)*100;
                                                              }
                                                              else
                                                              {
                                                                $boolpercent="0";
                                                              }
                                                        ?>
                                                        <?php echo $ratno;?><i class="fa fa-star-o"></i>
                                                        <label><a href="#" data-bs-toggle="modal" data-bs-target="#result" onclick="setresponseid(<?php echo $all_question['question_id'];?>,'<?php echo $rating[$i];?>')"><?php echo round($boolpercent,1)."%";?></a></label>
                                                        <?php $ratno++;}?>
                                                       
                                                    </div>
                                                </div>
                                                <div class="row" style="margin-top:20px;">
                                                     <div class="col-md-4 offset-md-4 d-flex">
                                                         <div id="piechart-<?php echo $all_question['question_id']?>"></div>
                                            		</div>
                                            	</div>
                                            <?php } ?>
                                             <?php if($qtype == "Radio"){ 
                                              foreach($all_subpoints as $all_subpoint){
                                                      $fields_subresult1 = "*";
                                                      $condition_subresult1 = "`tbl_response_result`.`question_id` ='".$all_question['question_id']."' and `tbl_response_result`.`answer` ='".$all_subpoint['question_subtitle']."'";
                                                      $all_subresults1=$obj_survey->getSurveyResult($fields_subresult1, $condition_subresult1, '', '', 0);
                                                      $boolcnt=count($all_subresults1);
                                                      if($questcnt!="0")
                                                      {
                                                        $boolpercent = ($boolcnt/$questcnt)*100;
                                                      }
                                                      else
                                                      {
                                                        $boolpercent="0";
                                                      }
                                             ?>
                                             <label style="margin-left:25px;"><input type="radio" disabled/><?php echo $all_subpoint['question_subtitle'];?> (<a href="#" data-bs-toggle="modal" data-bs-target="#result" onclick="setresponseid(<?php echo $all_question['question_id'];?>,'<?php echo $all_subpoint['question_subtitle'];?>')"><?php echo round($boolpercent,1)."%";?></a>)</label>
                                             
                                            <?php }  ?>
                                            <div class="row" style="margin-top:20px;">
                                                     <div class="col-md-4 offset-md-4 d-flex">
                                                         <div id="piechart-<?php echo $all_question['question_id']?>"></div>
                                            		</div>
                                            	</div>
                                            <?php }?>
                                             <?php if($qtype == "Opinion Scale"){?>
                                              <div class="row justify-content-center">
                                                   <?php foreach($all_subpoints as $all_subpoint){ $allscale=$all_subpoint['question_subtitle'];
                                                       $allopiniontext=$all_subpoint['opinion_scale_text'];
                                                   }
                                                        $scale=explode(",",$allscale);
                                                        $opiniontext=explode(",",$allopiniontext);
                                                   ?>
                                                    <?php for($t=0;$t<count($scale);$t++){
                                                          $fields_subresult1 = "*";
                                                          $condition_subresult1 = "`tbl_response_result`.`question_id` ='".$all_question['question_id']."' and `tbl_response_result`.`answer` ='".$scale[$t]."'";
                                                          $all_subresults1=$obj_survey->getSurveyResult($fields_subresult1, $condition_subresult1, '', '', 0);
                                                          $boolcnt=count($all_subresults1);
                                                          if($questcnt!="0")
                                                          {
                                                            $boolpercent = ($boolcnt/$questcnt)*100;
                                                          }
                                                          else
                                                          {
                                                            $boolpercent="0";
                                                          }
                                                    ?>
                                                       <div class="col-md-1 opcol">
                                                           
                                                           <div class="col-md-12"><span class="opiniscal"><?php echo $t;?></span></div>
                                                           <label><a href="#" data-bs-toggle="modal" data-bs-target="#result" onclick="setresponseid(<?php echo $all_question['question_id'];?>,'<?php echo $scale[$t];?>')"><?php echo round($boolpercent,1)."%";?></a></label>
                                                           <?php if($t==0){?>
                                                           <div class="col-md-12"><span class="form-label checklabel"><div id="minlabel" class="m-3"><?php echo $opiniontext[0];?></div></span></div>
                                                           <?php }?>
                                                           <?php if($t==5){?>
                                                           <div class="col-md-12"><span class="form-label checklabel"><div id="midlabel" class="m-3"><?php echo $opiniontext[1];?></div></span></div>
                                                           <?php }?>
                                                           <?php if($t==10){?>
                                                           <div class="col-md-12"><span class="form-label checklabel"><div id="highlabel" class="m-3"><?php echo $opiniontext[2];?></div></span></div>
                                                           <?php }?>
                                                           
                                                        </div>
                                                       
                                                   <?php }?>
                                                          
                                                  </div>
                                                  <div class="row" style="margin-top:20px;">
                                                     <div class="col-md-4 offset-md-4 d-flex">
                                                         <div id="piechart-<?php echo $all_question['question_id']?>"></div>
                                            		</div>
                                            	</div>
                                             <?php } ?>
                                             
                                              <?php if($qtype == "Checkbox"){ 
                                                       foreach($all_subpoints as $all_subpoint){ 
                                                          $fields_subresult1 = "*";
                                                          $condition_subresult1 = "`tbl_response_result`.`question_id` ='".$all_question['question_id']."' and `tbl_response_result`.`answer` ='".$all_subpoint['question_subtitle']."'";
                                                          $all_subresults1=$obj_survey->getSurveyResult($fields_subresult1, $condition_subresult1, '', '', 0);
                                                          $boolcnt=count($all_subresults1);
                                                          if($questcnt!="0")
                                                          {
                                                            $boolpercent = ($boolcnt/$questcnt)*100;
                                                          }
                                                          else
                                                          {
                                                            $boolpercent="0";
                                                          }
                                              ?>
                                                      <label style="margin-left:25px;"><input type="Checkbox" disabled/><?php echo $all_subpoint['question_subtitle'];?> (<a href="#" data-bs-toggle="modal" data-bs-target="#result" onclick="setresponseid(<?php echo $all_question['question_id'];?>,'<?php echo $all_subpoint['question_subtitle'];?>')"><?php echo round($boolpercent,1)."%";?></a>)</label>
                                             <?php }  ?>
                                             <div class="row" style="margin-top:20px;">
                                                     <div class="col-md-4 offset-md-4 d-flex">
                                                         <div id="piechart-<?php echo $all_question['question_id']?>"></div>
                                            		</div>
                                            	</div>
                                             <?php }?>
                                              <?php if($qtype == "Dropdown"){ 
                                                       foreach($all_subpoints as $all_subpoint){
                                                          $fields_subresult1 = "*";
                                                          $condition_subresult1 = "`tbl_response_result`.`question_id` ='".$all_question['question_id']."' and `tbl_response_result`.`answer` ='".$all_subpoint['question_subtitle']."'";
                                                          $all_subresults1=$obj_survey->getSurveyResult($fields_subresult1, $condition_subresult1, '', '', 0);
                                                          $boolcnt=count($all_subresults1);
                                                          if($questcnt!="0")
                                                          {
                                                            $boolpercent = ($boolcnt/$questcnt)*100;
                                                          }
                                                          else
                                                          {
                                                            $boolpercent="0";
                                                          }
                                              ?>
                                                      <label style="margin-left:25px;"><?php echo $all_subpoint['question_subtitle'];?> (<a href="#" data-bs-toggle="modal" data-bs-target="#result" onclick="setresponseid(<?php echo $all_question['question_id'];?>,'<?php echo $all_subpoint['question_subtitle'];?>')"><?php echo round($boolpercent,1)."%";?></a>)</label>
                                             <?php }  ?>
                                             <div class="row" style="margin-top:20px;">
                                                     <div class="col-md-4 offset-md-4 d-flex">
                                                         <div id="piechart-<?php echo $all_question['question_id']?>"></div>
                                            		</div>
                                            	</div>
                                              <?php }?>
                                              <?php if($qtype == "Order"){ 
                                                       foreach($all_subpoints as $all_subpoint){
                                                          $fields_subresult1 = "*";
                                                          $condition_subresult1 = "`tbl_response_result`.`question_id` ='".$all_question['question_id']."' and `tbl_response_result`.`answer` ='".$all_subpoint['question_subtitle']."'";
                                                          $all_subresults1=$obj_survey->getSurveyResult($fields_subresult1, $condition_subresult1, '', '', 0);
                                                          $boolcnt=count($all_subresults1);
                                                          if($questcnt!="0")
                                                          {
                                                            $boolpercent = ($boolcnt/$questcnt)*100;
                                                          }
                                                          else
                                                          {
                                                            $boolpercent="0";
                                                          }
                                              ?>
                                                      <label style="margin-left:25px;"><?php echo $all_subpoint['question_subtitle'];?> (<a href="#" data-bs-toggle="modal" data-bs-target="#result" onclick="setresponseid(<?php echo $all_question['question_id'];?>,'<?php echo $all_subpoint['question_subtitle'];?>')"><?php echo round($boolpercent,1)."%";?></a>)</label>
                                             <?php }  ?>
                                             <div class="row" style="margin-top:20px;">
                                                     <div class="col-md-4 offset-md-4 d-flex">
                                                         <div id="piechart-<?php echo $all_question['question_id']?>"></div>
                                            		</div>
                                            	</div>
                                             <?php }?>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                        <?php } else {?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row listingbox d-flex align-items-center">
                                        <div class="col-md-12 txtbold">
                                                No Question and Answer
                                        </div>
                                </div>
                            </div>
                        </div>
                        <?php }?>           
                    </div>
    
                            </div>
                        </div> 
                    </div>
                </div>
                
                     
           </section>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="result" tabindex="-1" aria-labelledby="resultLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable survey-result-modal">
    <div class="modal-content" style="max-height:80%!important;">
      <div class="modal-header">
        <h5 class="modal-title" id="resultLabel" style="font-size:15px;align-item:center;font-weight:500;">User List</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div id="questionanswer"></div>
          
        
      </div>
      
    </div>
  </div>
</div>
<?php include('footer.php'); ?>
<script type="text/javascript">
function setresponseid(qid,subtitle)
{
    //alert(subtitle);
    //alert(qid);
            $.ajax({
				url: "<?php echo SITEPATH;?>survey-result-user.php",
				type: "GET",
				data: {
					qid : qid,subtitle:subtitle
				},
				cache: false,
				success: function(ans){
					$("#questionanswer").html(ans);
				}
			});
}
</script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
<?php 
    /**********All Questions***************/
    $fields_questions = "*";
    $condition_questions = "`tbl_questionBank`.`survey_id` ='".$surveyid."'";
    $orderby="`tbl_questionBank`.`sequence` ASC";
    $all_questions=$obj_survey->getQuestionBank($fields_questions, $condition_questions, $orderby, '', 0);
    if(isset($all_questions) && !empty($all_questions)){
            foreach($all_questions as $all_question)
            {
                /**********All Sub Points Questions***************/
                $fields_subpoints = "*";
                $condition_subpoints = "`tbl_questionSub`.`question_id` =".$all_question['question_id'];
                $all_subpoints=$obj_survey->getSubQuestionPoints($fields_subpoints, $condition_subpoints, '', '', 0);
                
                $fields_questtype = "quest_type";
                $condition_questtype = "`tbl_question_type`.`quest_type_id` =".$all_question['quest_type_id'];
                $all_question_types=$obj_survey->getQuestionType($fields_questtype, $condition_questtype, '', '', 0);
                foreach($all_question_types as $all_question_type){
                    $qtype=$all_question_type['quest_type'];
                }
                
                $fields_subresult = "*";
                $condition_subresult = "`tbl_response_result`.`question_id` =".$all_question['question_id'];
                $all_subresults=$obj_survey->getSurveyResult($fields_subresult, $condition_subresult, '', '', 0);
                $questcnt=count($all_subresults);
       
                  
                
  ?>
  
  
  <?php if($qtype == "Boolean"){?>
  var data = google.visualization.arrayToDataTable([
  ['Answer Subtitle', 'Answer Count'],
    <?php    foreach($all_subpoints as $all_subpoint)
            {
              $fields_subresult1 = "*";
              $condition_subresult1 = "`tbl_response_result`.`question_id` ='".$all_question['question_id']."' and `tbl_response_result`.`answer` ='".$all_subpoint['question_subtitle']."'";
              $all_subresults1=$obj_survey->getSurveyResult($fields_subresult1, $condition_subresult1, '', '', 0);
              $boolcnt=count($all_subresults1);
               if($boolcnt!=0)
               {
                   echo "['".$all_subpoint['question_subtitle']."',".$boolcnt."],";
               }
            }  ?>
  ]);
  
   // Optional; add a title and set the width and height of the chart
  var options = {'title':'', 'width':550, 'height':400,is3D: true,};

  // Display the chart inside the <div> element with id="piechart"
  //alert(data.getNumberOfRows());
    if(data.getNumberOfRows() == 0){
        $('#piechart-'+<?php echo $all_question['question_id'];?>).append("No Data")
    }else{
        var chart = new google.visualization.PieChart(document.getElementById('piechart-<?php echo $all_question['question_id'];?>'));
      //alert(chart->options);
      chart.draw(data, options);       
    }
  
  
  <?php }?>
  
  <?php if($qtype == "Radio"){?>
  var data = google.visualization.arrayToDataTable([
  ['Answer Subtitle', 'Answer Count'],
    <?php    foreach($all_subpoints as $all_subpoint)
            {
              $fields_subresult1 = "*";
              $condition_subresult1 = "`tbl_response_result`.`question_id` ='".$all_question['question_id']."' and `tbl_response_result`.`answer` ='".$all_subpoint['question_subtitle']."'";
              $all_subresults1=$obj_survey->getSurveyResult($fields_subresult1, $condition_subresult1, '', '', 0);
              $boolcnt=count($all_subresults1);
              if($boolcnt!=0)
              {
              echo "['".$all_subpoint['question_subtitle']."',".$boolcnt."],";
              }
            }  ?>
  ]);
  
   // Optional; add a title and set the width and height of the chart
  var options = {'title':'', 'width':550, 'height':400,is3D: true,};

  // Display the chart inside the <div> element with id="piechart"
  
  if(data.getNumberOfRows() == 0){
        $('#piechart-'+<?php echo $all_question['question_id'];?>).append("No Data")
    }else{
        var chart = new google.visualization.PieChart(document.getElementById('piechart-<?php echo $all_question['question_id'];?>'));
      //alert(chart->options);
      chart.draw(data, options);       
    }
  
  <?php }?>
  
  <?php if($qtype == "Checkbox"){?>
  var data = google.visualization.arrayToDataTable([
  ['Answer Subtitle', 'Answer Count'],
    <?php    foreach($all_subpoints as $all_subpoint)
            {
              $fields_subresult1 = "*";
              $condition_subresult1 = "`tbl_response_result`.`question_id` ='".$all_question['question_id']."' and `tbl_response_result`.`answer` ='".$all_subpoint['question_subtitle']."'";
              $all_subresults1=$obj_survey->getSurveyResult($fields_subresult1, $condition_subresult1, '', '', 0);
              $boolcnt=count($all_subresults1);
              if($boolcnt!=0)
              {
              echo "['".$all_subpoint['question_subtitle']."',".$boolcnt."],";
              }
            }  ?>
  ]);
  
   // Optional; add a title and set the width and height of the chart
  var options = {'title':'', 'width':550, 'height':400,is3D: true,};

  // Display the chart inside the <div> element with id="piechart"
  
  if(data.getNumberOfRows() == 0){
        $('#piechart-'+<?php echo $all_question['question_id'];?>).append("No Data")
    }else{
        var chart = new google.visualization.PieChart(document.getElementById('piechart-<?php echo $all_question['question_id'];?>'));
      //alert(chart->options);
      chart.draw(data, options);       
    }
  
  <?php }?>
  
  <?php if($qtype == "Dropdown"){?>
  var data = google.visualization.arrayToDataTable([
  ['Answer Subtitle', 'Answer Count'],
    <?php    foreach($all_subpoints as $all_subpoint)
            {
              $fields_subresult1 = "*";
              $condition_subresult1 = "`tbl_response_result`.`question_id` ='".$all_question['question_id']."' and `tbl_response_result`.`answer` ='".$all_subpoint['question_subtitle']."'";
              $all_subresults1=$obj_survey->getSurveyResult($fields_subresult1, $condition_subresult1, '', '', 0);
              $boolcnt=count($all_subresults1);
              if($boolcnt!=0)
              {
              echo "['".$all_subpoint['question_subtitle']."',".$boolcnt."],";
              }
            }  ?>
  ]);
  
   // Optional; add a title and set the width and height of the chart
  var options = {'title':'', 'width':550, 'height':400,is3D: true,};

  // Display the chart inside the <div> element with id="piechart"
  
  if(data.getNumberOfRows() == 0){
        $('#piechart-'+<?php echo $all_question['question_id'];?>).append("No Data")
    }else{
        var chart = new google.visualization.PieChart(document.getElementById('piechart-<?php echo $all_question['question_id'];?>'));
      //alert(chart->options);
      chart.draw(data, options);       
    }
  
  <?php }?>
  
  <?php if($qtype == "Order"){?>
  var data = google.visualization.arrayToDataTable([
  ['Answer Subtitle', 'Answer Count'],
    <?php    foreach($all_subpoints as $all_subpoint)
            {
              $fields_subresult1 = "*";
              $condition_subresult1 = "`tbl_response_result`.`question_id` ='".$all_question['question_id']."' and `tbl_response_result`.`answer` ='".$all_subpoint['question_subtitle']."'";
              $all_subresults1=$obj_survey->getSurveyResult($fields_subresult1, $condition_subresult1, '', '', 0);
              $boolcnt=count($all_subresults1);
              if($boolcnt!=0)
              {
              echo "['".$all_subpoint['question_subtitle']."',".$boolcnt."],";
              }
            }  ?>
  ]);
  
   // Optional; add a title and set the width and height of the chart
  var options = {'title':'', 'width':550, 'height':400,is3D: true,};

  // Display the chart inside the <div> element with id="piechart"
  
  if(data.getNumberOfRows() == 0){
        $('#piechart-'+<?php echo $all_question['question_id'];?>).append("No Data")
    }else{
        var chart = new google.visualization.PieChart(document.getElementById('piechart-<?php echo $all_question['question_id'];?>'));
      //alert(chart->options);
      chart.draw(data, options);       
    }
  
  <?php }?>
  
  <?php if($qtype == "Rating"){?>
  var data = google.visualization.arrayToDataTable([
  ['Answer Subtitle', 'Answer Count'],
    <?php    foreach($all_subpoints as $all_subpoint)
            { $allrating=$all_subpoint['question_subtitle'];}$rating=explode(",",$allrating);
              $ratno=1;for($i=0;$i<count($rating);$i++){
              $fields_subresult1 = "*";
              $condition_subresult1 = "`tbl_response_result`.`question_id` ='".$all_question['question_id']."' and `tbl_response_result`.`answer` ='".$rating[$i]."'";
              $all_subresults1=$obj_survey->getSurveyResult($fields_subresult1, $condition_subresult1, '', '', 0);
              $boolcnt=count($all_subresults1);
              
              if($boolcnt!=0)
              {
                echo "['".$rating[$i]." Star',".$boolcnt."],";
              }
              $ratno++;
            }  ?>
  ]);
  
   // Optional; add a title and set the width and height of the chart
  var options = {'title':'', 'width':550, 'height':400,is3D: true,};

  // Display the chart inside the <div> element with id="piechart"
  
  if(data.getNumberOfRows() == 0){
        $('#piechart-'+<?php echo $all_question['question_id'];?>).append("No Data")
    }else{
        var chart = new google.visualization.PieChart(document.getElementById('piechart-<?php echo $all_question['question_id'];?>'));
      //alert(chart->options);
      chart.draw(data, options);       
    }
  
  <?php }?>
  
  <?php if($qtype == "Opinion Scale"){?>
  var data = google.visualization.arrayToDataTable([
  ['Answer Subtitle', 'Answer Count'],
    <?php    foreach($all_subpoints as $all_subpoint)
            { $allscale=$all_subpoint['question_subtitle']; }
              $scale=explode(",",$allscale);
                                                       
              for($t=0;$t<count($scale);$t++){
              $fields_subresult1 = "*";
              $condition_subresult1 = "`tbl_response_result`.`question_id` ='".$all_question['question_id']."' and `tbl_response_result`.`answer` ='".$scale[$t]."'";
              $all_subresults1=$obj_survey->getSurveyResult($fields_subresult1, $condition_subresult1, '', '', 0);
              $boolcnt=count($all_subresults1);
              if($boolcnt!=0)
              {
                echo "['".$scale[$t]." Scale',".$boolcnt."],";
              }
            }  ?>
  ]);
  
   // Optional; add a title and set the width and height of the chart
  var options = {'title':'', 'width':550, 'height':400,is3D: true,};

  // Display the chart inside the <div> element with id="piechart"
  
  if(data.getNumberOfRows() == 0){
        $('#piechart-'+<?php echo $all_question['question_id'];?>).append("No Data")
    }else{
        var chart = new google.visualization.PieChart(document.getElementById('piechart-<?php echo $all_question['question_id'];?>'));
      //alert(chart->options);
      chart.draw(data, options);       
    }
  
  <?php }?>
  <?php } }?>
  
  
 
  
  
  


 
}
</script>
