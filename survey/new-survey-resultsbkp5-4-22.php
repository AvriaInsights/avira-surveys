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
    $condition_questions = "`tbl_questionBank`.`survey_id` =".$surveyid;
    $orderby="`tbl_questionBank`.`sequence` ASC";
    $all_questions=$obj_survey->getQuestionBank($fields_questions, $condition_questions, $orderby, '', 0);
}
else
{
    $surveyid="";
}


?>
<style>
.active1{
    border-bottom:0.1rem solid #e0e0e0;
    -webkit-box-shadow: 0 0.5rem 2rem rgb(0 0 0 / 18%);
    box-shadow: 0 0.5rem 2rem rgb(0 0 0 / 18%);
    border-radius:0.5rem 0 0 0.5rem;
}
.new-survey-popup .nav-pills .nav-link {
    text-align: left;
    padding: 3rem 1rem;
    font-size: 1.7rem;
    display: flex;
    align-items: center;
    border-bottom: 0.1rem solid #e0e0e0;
    border-radius: 0;
    color: #676767;
}
.nav-pills .nav-link {
    background: 0 0;
    border: 0;
    border-radius: 0.25rem;
    height: 5rem;
    font-size:1.7rem;
    text-align: left;
}
.active-tab {
    width: 100%;
    text-align: left;
    font-size:1.7rem;
}
.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    color: #0d6efd !important;
    background-color: #fff !important;
}
.new-survey-popup .nav-pills .nav-link.active i {
    font-size: 2.2rem;
    padding-right: 1.3rem;
    color: #aabdc8;
}
.tab-details-content{
    background-color:#fff;
    
}
.opcol1 {
    text-align: center;
    /* max-width: 5%; */
    /* padding-right: 3rem!important; */
}
</style>


<?php include('dashboard-header-menu.php')?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <?php include('dashboard-side-menubar.php')?>
        </div>
        <div class="col-md-9">
            <section class="content-wrapper ht-100vh">
                <div class="container-fluid">
                     <div class="row">
                        <!-- Modal -->
                        <div class="new-survey-popup result-page-table" id="">
                              <div class="ps-0">
                                  <?php if(isset($all_questions) && !empty($all_questions)){ $srno=1; $srnoo=1;?>
                                  
                                  <div class="row">
                                      <div class="col-md-4 pe-0 border-end">
                                          <?php foreach($all_questions as $all_question){?>
                                          <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                            
                                            <button class="nav-link" id="v-pills-tab-<?php echo $srno;?>" data-bs-toggle="pill" data-bs-target="#v-pills-tab-<?php echo $srno;?>" 
                                            type="button" role="tab" aria-controls="v-pills-tab-<?php echo $srno;?>" aria-selected="true" title='<?php echo (stripslashes(str_replace("'", '"', $all_question['question_title'])));?>' onclick="showtab(<?php echo $srno;?>)">
                                                <i class="fa fa-folder"></i>Q <?php echo $all_question['sequence'];?>) <?php if($all_question['question_title']!=""){ if(strlen(stripslashes($all_question['question_title']))>25) { echo substr(stripslashes($all_question['question_title']), 0, 25) . "..."; } else { echo stripslashes($all_question['question_title']); }} else { echo "..."; } ?></button>
                                          </div>
                                          <?php $srno++;}?>
                                      </div>
                                     
                                      <div class="col-md-8 ps-0">
                                           <?php 
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
                                          <?php //if($qtype == "Boolean"){?>
                                          <div class="tab-content" id="v-pills-tabContent-<?php echo $srnoo;?>">
                                            <div class="tab-pane fade" id="v-pills-<?php echo $srnoo;?>" role="tabpanel" aria-labelledby="v-pills-tab-<?php echo $srnoo;?>">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="tab-details-content">
                                                            <div class="justify-content-center" style="padding-top: 24px;font-size: 20px;">
                                                                <?php if($qtype == "Boolean"){?>
                                                                <div class="row justify-content-center">
                                                                    
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
                                                                    <!--<div class="col-2 bollab">-->
                                                                    <!--    <label><?php echo $all_subpoint['question_subtitle'];?></label><br>-->
                                                                    <!--    <label><a href="#" data-bs-toggle="modal" data-bs-target="#result" onclick="setresponseid(<?php echo $all_question['question_id'];?>,'<?php echo $all_subpoint['question_subtitle'];?>')"><?php echo round($boolpercent,1)."%";?></a></label>-->
                                                                    <!--</div>-->
                                                                    
                                                                    
                                                                    <?php }?>
                                                                    
                                                                    <div class="col-md-10 offset-md-1">
                                                                        <div class="result-list">
                                                                            <ul class="">
                                                                                <li>Yes</li>
                                                                                <li>No</li>
                                                                                <li>Other</li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                 </div>
                                                                 <div class="row">
                                                                     <div class="col-md-4 offset-md-2 d-flex">
                                                                         <div class="m-top-10">
                                                                            <div id="piechart-<?php echo $all_question['question_id']?>"></div>
                                                                        </div>
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
                                                                        
                                                                        <?php $ratno++;}?>
                                                                       
                                                                    </div>
                                                                </div>
                                                                <div class="row" style="margin-top:20px;">
                                                                     <div class="col-md-4 offset-md-2 d-flex">
                                                                         <div id="piechart-<?php echo $all_question['question_id']?>"></div>
                                                            		</div>
                                                            	</div>
                                                            <?php } ?>
                                                             <?php if($qtype == "Radio"){ $radsr=1;
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
                                                             <label style="margin-left:25px;"><?php echo $radsr;?>)&nbsp;<?php echo $all_subpoint['question_subtitle'];?></label>
                                                             
                                                            <?php $radsr++;}  ?>
                                                            <div class="row" style="margin-top:20px;">
                                                                     <div class="col-md-4 offset-md-2 d-flex">
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
                                                                       <div class="col-md-1 opcol1">
                                                                           
                                                                           <div class="col-md-12"><span class="opiniscal"><?php echo $t;?></span></div>
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
                                                                     <div class="col-md-4 offset-md-2 d-flex">
                                                                         <div id="piechart-<?php echo $all_question['question_id']?>"></div>
                                                            		</div>
                                                            	</div>
                                                             <?php } ?>
                                                             
                                                              <?php if($qtype == "Checkbox"){ $chksr=1;
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
                                                                      <label style="margin-left:25px;"><?php echo $chksr;?>)&nbsp;<?php echo $all_subpoint['question_subtitle'];?></label>
                                                             <?php $chksr++;}  ?>
                                                             <div class="row" style="margin-top:20px;">
                                                                     <div class="col-md-4 offset-md-2 d-flex">
                                                                         <div id="piechart-<?php echo $all_question['question_id']?>"></div>
                                                            		</div>
                                                            	</div>
                                                             <?php }?>
                                                              <?php if($qtype == "Dropdown"){ $drpsr=1;
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
                                                                      <label style="margin-left:25px;"><?php echo $drpsr;?>)&nbsp;<?php echo $all_subpoint['question_subtitle'];?></label>
                                                             <?php $drpsr++;}  ?>
                                                             <div class="row" style="margin-top:20px;">
                                                                     <div class="col-md-4 offset-md-2 d-flex">
                                                                         <div id="piechart-<?php echo $all_question['question_id']?>"></div>
                                                            		</div>
                                                            	</div>
                                                              <?php }?>
                                                              <?php if($qtype == "Order"){ $ordsr=1;
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
                                                                      <label style="margin-left:25px;"><?php echo $ordsr;?>)&nbsp;<?php echo $all_subpoint['question_subtitle'];?></label>
                                                             <?php $ordsr++;}  ?>
                                                             <div class="row" style="margin-top:20px;">
                                                                     <div class="col-md-4 offset-md-2 d-flex">
                                                                         <div id="piechart-<?php echo $all_question['question_id']?>"></div>
                                                            		</div>
                                                            	</div>
                                                             <?php }?>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php //}?>
                                            
                                            
                                            
                                          </div>
                                         <?php $srnoo++;}?>
                                      </div>
                                  </div>
                                  
                                 <?php } ?>
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


$("#v-pills-tab-1").addClass("active active-tab active1");
$("#v-pills-1").addClass("show active active1");
window.scrollTo(0, 0);
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

function showtab(n)
{  //$($(this).attr("data-target")).modal("show");
   //$(".nav-link").attr("data-bs-toggle").removeClass("active active-tab");
   $('.nav-link').removeClass("active active-tab active1");
   $('.tab-pane').removeClass("show active active1");
   $("#v-pills-tab-"+n).addClass("active active-tab active1");
   $("#v-pills-"+n).addClass("show active active1");
   window.scrollTo(0, 0);
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
    $condition_questions = "`tbl_questionBank`.`survey_id` =".$surveyid;
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
  var options = {'title':'', 'width':550, dataLabels: { enabled: true, textAnchor: 'middle' }, 'height':400,is3D: true,'fontSize':14,'backgroundColor':'transparent'};

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
  var options = {'title':'', 'width':550, 'height':400,is3D: true,'fontSize':14};

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
  var options = {'title':'', 'width':550, 'height':400,is3D: true,'fontSize':14};

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
  var options = {'title':'', 'width':550, 'height':400,is3D: true,'fontSize':14};

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
  var options = {'title':'', 'width':550, 'height':400,is3D: true,'fontSize':14};

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
  var options = {'title':'', 'width':550, 'height':400,is3D: true,'fontSize':14};

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
  var options = {'title':'', 'width':550, 'height':400,is3D: true,'fontSize':14};

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
