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
.qtype_icon_side {
    width: 23px;
    margin-right: 5px;
    margin-left: 5px;
}

.w3-container:after,.w3-container:before,.w3-panel:after,.w3-panel:before,.w3-row:after,.w3-row:before,.w3-row-padding:after,.w3-row-padding:before,.w3-cell-row:before,.w3-cell-row:after,.w3-clear:after,.w3-clear:before,.w3-bar:before,.w3-bar:after{content:"";display:table;clear:both}
.w3-col,.w3-half,.w3-third,.w3-twothird,.w3-threequarter,.w3-quarter{float:left;width:100%}
.w3-container,.w3-panel{padding:0.8rem 14px 0.8rem}.w3-panel{margin-top:16px;margin-bottom:16px}

.w3-pale-blue,.w3-hover-pale-blue:hover{color: #000!important;
background: linear-gradient(45deg, #98d7ec, transparent);
border:1px solid #000;}
.w3-leftbar{border-left:6px solid #ccc!important;}.w3-rightbar{border-right:6px solid #ccc!important}
.w3-border-blue,.w3-hover-border-blue:hover{border-color:#2196F3!important;border-radius:0.5rem;}

.star-size{ font-size:2rem;}
.opinion-mar{ margin-left:33px!important; margin-right:33px!important;}
.bool1{padding-top: 24px;font-size: 16px;}
.nobullet{list-style:none;}
</style>


<?php include('dashboard-header-menu.php')?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <?php include('dashboard-side-menubar.php')?>
        </div>
        <div class="col-md-9">
            <section class="content-wrapper">
                <div class="container-fluid">
                     <div class="row">
                        <!-- Modal -->
                        <div class="new-survey-popup" id="">
                              <div class="ps-0">
                                  <?php if(isset($all_questions) && !empty($all_questions)){ $srno=1; $srnoo=1;?>
                                  <input type="hidden" value="<?php echo count($all_questions);?>" id="totalquest">
                                  <div class="row">
                                      <div class="col-md-4 pe-0 border-end">
                                          
                                          <?php foreach($all_questions as $all_question){
                                                $fields_questtype1 = "quest_type";
                                                $condition_questtype1 = "`tbl_question_type`.`quest_type_id` =".$all_question['quest_type_id'];
                                                $all_question_types1=$obj_survey->getQuestionType($fields_questtype1, $condition_questtype1, '', '', 0);
                                                foreach($all_question_types1 as $all_question_type12){
                                                    $questiontype=$all_question_type12['quest_type'];
                                                }
                                          ?>
                                          <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                            
                                            <button class="nav-link" id="v-pills-tab-<?php echo $srno;?>" data-bs-toggle="pill" data-bs-target="#v-pills-tab-<?php echo $srno;?>" 
                                            type="button" role="tab" aria-controls="v-pills-tab-<?php echo $srno;?>" aria-selected="true" title='<?php echo (stripslashes(str_replace("'", '"', $all_question['question_title'])));?>' onclick="showtab(<?php echo $srno;?>)">
                                                <img class="qtype_icon_side" src="<?php echo SITEPATH; ?>images/qtype_icon/<?php echo $questiontype; ?>.png">Q <?php echo $all_question['sequence'];?>) <?php if($all_question['question_title']!=""){ if(strlen(stripslashes($all_question['question_title']))>25) { echo substr(stripslashes($all_question['question_title']), 0, 25) . "..."; } else { echo stripslashes($all_question['question_title']); }} else { echo "..."; } ?></button>
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
                                          
                                          <div class="tab-content" id="v-pills-tabContent-<?php echo $srnoo;?>">
                                            <div class="tab-pane fade" id="v-pills-<?php echo $srnoo;?>" role="tabpanel" aria-labelledby="v-pills-tab-<?php echo $srnoo;?>">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="tab-details-content">
                                                            <div class="justify-content-center bool1" id="nodatacss-<?php echo $all_question['question_id']?>">
                                                                <?php if($qtype == "Boolean"){?>
                                                                
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
                                                                    
                                                                    <div class="col-md-10">
                                                                        <div class="">
                                                                            <ul class="nobullet">
                                                                                <li class="w3-container w3-pale-blue w3-leftbar w3-border-blue"><?php echo $all_subpoint['question_subtitle'];?></li>
                                                                               
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <?php }?>
                                                                    
                                                                 </div>
                                                                 <div class="row" >
                                                                     <div class="col-md-4 offset-md-2 d-flex">
                                                                         <div id="piechart-<?php echo $all_question['question_id']?>"></div>
                                                            		</div>
                                                            	</div>
                                                            <?php } ?>
                                                            <?php if($qtype == "Text"){ $qstcnt=count($all_questions)*6;?>
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="row justify-content-center" style="height:<?php echo $qstcnt;?>rem;">
                                                                                <?php foreach($all_subpoints as $all_subpoint){?>
                                                                                <!--<div class="col-2 bollab  w3-container w3-pale-blue w3-leftbar w3-border-blue">-->
                                                                                <!--    <label><a href="#" data-bs-toggle="modal" data-bs-target="#result" onclick="setresponseid(<?php echo $all_question['question_id'];?>,'<?php echo $all_subpoint['question_subtitle'];?>','<?php echo $qtype;?>')"><?php echo $all_subpoint['question_subtitle'];?></a></label>-->
                                                                                <!--</div>-->
                                                                                <div class="col-md-10">
                                                                                    <div class="">
                                                                                        <ul class="" style="list-style:none;">
                                                                                            <li class="w3-container w3-pale-blue w3-leftbar w3-border-blue"><a href="#" data-bs-toggle="modal" data-bs-target="#result" onclick="setresponseid(<?php echo $all_question['question_id'];?>,'<?php echo $all_subpoint['question_subtitle'];?>','<?php echo $qtype;?>')"><?php echo $all_subpoint['question_subtitle'];?></a></li>
                                                                                           
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                                <?php }?>
                                                                             </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php } ?>
                                                            <?php if($qtype == "Rating"){?>
                                                                <div class="row justify-content-center">
                                                                    <div class="col-md-10 text-center star-size w3-container w3-pale-blue w3-leftbar w3-border-blue">
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
                                                                <div class="row" >
                                                                     <div class="col-md-4 offset-md-2 d-flex">
                                                                         <div id="piechart-<?php echo $all_question['question_id']?>"></div>
                                                            		</div>
                                                            	</div>
                                                            <?php } ?>
                                                             <?php if($qtype == "Radio"){ $radsr=1;?>
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
                                                             
                                                             <div class="col-md-10">
                                                                        <div class="">
                                                                            <ul class="nobullet">
                                                                                <li class="w3-container w3-pale-blue w3-leftbar w3-border-blue"><?php echo $all_subpoint['question_subtitle'];?></li>
                                                                               
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                            <?php $radsr++;}  ?>
                                                            </div>
                                                            <div class="row" >
                                                                     <div class="col-md-4 offset-md-2 d-flex">
                                                                         <div id="piechart-<?php echo $all_question['question_id']?>"></div>
                                                            		</div>
                                                            	</div>
                                                            <?php }?>
                                                             <?php if($qtype == "Opinion Scale"){?>
                                                              <div class="row justify-content-center opinion-mar w3-container w3-pale-blue w3-leftbar w3-border-blue">
                                                                  
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
                                                                  <div class="row" >
                                                                     <div class="col-md-4 offset-md-2 d-flex">
                                                                         <div id="piechart-<?php echo $all_question['question_id']?>"></div>
                                                            		</div>
                                                            	</div>
                                                             <?php } ?>
                                                             
                                                              <?php if($qtype == "Checkbox"){ $chksr=1;?>
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
                                                                     
                                                                      <div class="col-md-10">
                                                                        <div class="">
                                                                            <ul class="nobullet">
                                                                                <li class="w3-container w3-pale-blue w3-leftbar w3-border-blue"><?php echo $all_subpoint['question_subtitle'];?></li>
                                                                               
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                             <?php $chksr++;}  ?>
                                                             </div>
                                                             <div class="row" >
                                                                     <div class="col-md-4 offset-md-2 d-flex">
                                                                         <div id="piechart-<?php echo $all_question['question_id']?>"></div>
                                                            		</div>
                                                            	</div>
                                                             <?php }?>
                                                              <?php if($qtype == "Dropdown"){ $drpsr=1;?>
                                                               <div class="row justify-content-center">
                                                                 <?php    foreach($all_subpoints as $all_subpoint){
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
                                                                      
                                                                      <div class="col-md-10">
                                                                        <div class="">
                                                                            <ul class="nobullet">
                                                                                <li class="w3-container w3-pale-blue w3-leftbar w3-border-blue"><?php echo $all_subpoint['question_subtitle'];?></li>
                                                                               
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                             <?php $drpsr++;}  ?>
                                                             </div>
                                                             <div class="row" >
                                                                     <div class="col-md-4 offset-md-2 d-flex">
                                                                         <div id="piechart-<?php echo $all_question['question_id']?>"></div>
                                                            		</div>
                                                            	</div>
                                                              <?php }?>
                                                              <?php if($qtype == "Order"){ $ordsr=1;?>
                                                              <div class="row justify-content-center">
                                                                <?php    foreach($all_subpoints as $all_subpoint){
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
                                                                      
                                                                      <div class="col-md-10">
                                                                        <div class="">
                                                                            <ul class="nobullet">
                                                                                <li class="w3-container w3-pale-blue w3-leftbar w3-border-blue"><?php echo $all_subpoint['question_subtitle'];?></li>
                                                                               
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                             <?php $ordsr++;}  ?>
                                                             </div>
                                                             <div class="row" >
                                                                     <div class="col-md-4 offset-md-2 d-flex">
                                                                         <div id="piechart-<?php echo $all_question['question_id']?>"></div>
                                                            		</div>
                                                            	</div>
                                                             <?php }?>
                                                              <div class="row" >
                                                                     <div class="col-md-4 offset-md-2 d-flex">
                                                                         <div id="piechart-<?php echo $all_question['question_id']?>"></div>
                                                            		</div>
                                                            	</div>
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
function setresponseid(qid,subtitle,qtype)
{
    //alert(subtitle);
    //alert(qid);
            $.ajax({
				url: "<?php echo SITEPATH;?>survey-result-user.php",
				type: "GET",
				data: {
					qid : qid,subtitle:subtitle,qtype:qtype
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
   var allq=document.getElementById("totalquest").value;
//alert(allq);
    for(var k=1;k<=allq;k++)
    {
      if(n!=k)
      {
        document.getElementById("v-pills-"+k).style.display='none';
      }
      else
      {
        document.getElementById("v-pills-"+n).style.display='block';
        google.charts.setOnLoadCallback(drawChart);  
      }
    }
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
google.charts.load('visualization','1.0',{'packages':['corechart']});
//google.load('visualization', '1.0', {'packages':['corechart']});
document.getElementById("v-pills-1").style.display='block';
google.charts.setOnLoadCallback(drawChart);
var data=""; 
var chart="";
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
  var data<?php echo $all_question['question_id'];?> = google.visualization.arrayToDataTable([
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
  //alert(data['Answer Subtitle']);
   // Optional; add a title and set the width and height of the chart
  var options = {'title':'', 'width':550, 'height':400,is3D: true,'fontSize':14,'backgroundColor':'transparent'};

  // Display the chart inside the <div> element with id="piechart"
  
    if(data<?php echo $all_question['question_id'];?>.getNumberOfRows() == 0){
        $('#piechart-'+<?php echo $all_question['question_id'];?>).text("No Data");
        //$("#nodatacss").addclass();
        var qstcnt1=$("#totalquest").val()*6;
        $("#nodatacss-"+<?php echo $all_question['question_id'];?>).css({"height":qstcnt1 + "rem"});
    }
    else
    {
     
        var chart<?php echo $all_question['question_id'];?> = new google.visualization.PieChart(document.getElementById('piechart-<?php echo $all_question['question_id'];?>'));
        
        
        chart<?php echo $all_question['question_id'];?>.draw(data<?php echo $all_question['question_id'];?>, options);  
        google.visualization.events.addListener(chart<?php echo $all_question['question_id'];?>, 'select', selectHandler);
         function selectHandler() 
         {
            var selectedItem = chart<?php echo $all_question['question_id'];?>.getSelection()[0];
            if (selectedItem) {
                var fetdata = data<?php echo $all_question['question_id'];?>.getValue(selectedItem.row, 0);
                $("#result").modal('show');
                setresponseid(<?php echo $all_question['question_id'];?>,fetdata,'<?php echo $qtype;?>');
            }
            
           
         } 
    }
  
  
  <?php }?>
  
  <?php if($qtype == "Radio"){?>
  var data<?php echo $all_question['question_id'];?> = google.visualization.arrayToDataTable([
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
  
  var options = {'title':'', 'width':550, 'height':400,is3D: true,'fontSize':14,'backgroundColor':'transparent'};

  // Display the chart inside the <div> element with id="piechart"
  
    if(data<?php echo $all_question['question_id'];?>.getNumberOfRows() == 0){
        $('#piechart-'+<?php echo $all_question['question_id'];?>).text("No Data");
        var qstcnt1=$("#totalquest").val()*6;
        $("#nodatacss-"+<?php echo $all_question['question_id'];?>).css({"height":qstcnt1 + "rem"});
    }
    else
    {
     
        var chart<?php echo $all_question['question_id'];?> = new google.visualization.PieChart(document.getElementById('piechart-<?php echo $all_question['question_id'];?>'));
        
        
        chart<?php echo $all_question['question_id'];?>.draw(data<?php echo $all_question['question_id'];?>, options);  
        google.visualization.events.addListener(chart<?php echo $all_question['question_id'];?>, 'select', selectHandler);
         function selectHandler() 
         {
            var selectedItem = chart<?php echo $all_question['question_id'];?>.getSelection()[0];
            if (selectedItem) {
                var fetdata = data<?php echo $all_question['question_id'];?>.getValue(selectedItem.row, 0);
                $("#result").modal('show');
                setresponseid(<?php echo $all_question['question_id'];?>,fetdata,'<?php echo $qtype;?>');
              }
            
           
         } 
    }
  
  <?php }?>
  
  <?php if($qtype == "Checkbox"){?>
  var data<?php echo $all_question['question_id'];?> = google.visualization.arrayToDataTable([
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
  
  var options = {'title':'', 'width':550, 'height':400,is3D: true,'fontSize':14,'backgroundColor':'transparent'};

  // Display the chart inside the <div> element with id="piechart"
  
    if(data<?php echo $all_question['question_id'];?>.getNumberOfRows() == 0){
        $('#piechart-'+<?php echo $all_question['question_id'];?>).text("No Data");
        var qstcnt1=$("#totalquest").val()*6;
        $("#nodatacss-"+<?php echo $all_question['question_id'];?>).css({"height":qstcnt1 + "rem"});
    }
    else
    {
     
        var chart<?php echo $all_question['question_id'];?> = new google.visualization.PieChart(document.getElementById('piechart-<?php echo $all_question['question_id'];?>'));
        
        
        chart<?php echo $all_question['question_id'];?>.draw(data<?php echo $all_question['question_id'];?>, options);  
        google.visualization.events.addListener(chart<?php echo $all_question['question_id'];?>, 'select', selectHandler);
         function selectHandler() 
         {
            var selectedItem = chart<?php echo $all_question['question_id'];?>.getSelection()[0];
            if (selectedItem) {
                var fetdata = data<?php echo $all_question['question_id'];?>.getValue(selectedItem.row, 0);
                $("#result").modal('show');
                setresponseid(<?php echo $all_question['question_id'];?>,fetdata,'<?php echo $qtype;?>');
              }
            
           
         } 
    }  
  <?php }?>
  
  <?php if($qtype == "Dropdown"){?>
  var data<?php echo $all_question['question_id'];?> = google.visualization.arrayToDataTable([
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
  
  var options = {'title':'', 'width':550, 'height':400,is3D: true,'fontSize':14,'backgroundColor':'transparent'};

  // Display the chart inside the <div> element with id="piechart"
  
    if(data<?php echo $all_question['question_id'];?>.getNumberOfRows() == 0){
        $('#piechart-'+<?php echo $all_question['question_id'];?>).text("No Data");
        var qstcnt1=$("#totalquest").val()*6;
        $("#nodatacss-"+<?php echo $all_question['question_id'];?>).css({"height":qstcnt1 + "rem"});
    }
    else
    {
     
        var chart<?php echo $all_question['question_id'];?> = new google.visualization.PieChart(document.getElementById('piechart-<?php echo $all_question['question_id'];?>'));
        
        
        chart<?php echo $all_question['question_id'];?>.draw(data<?php echo $all_question['question_id'];?>, options);  
        google.visualization.events.addListener(chart<?php echo $all_question['question_id'];?>, 'select', selectHandler);
         function selectHandler() 
         {
            var selectedItem = chart<?php echo $all_question['question_id'];?>.getSelection()[0];
            if (selectedItem) {
                var fetdata = data<?php echo $all_question['question_id'];?>.getValue(selectedItem.row, 0);
                $("#result").modal('show');
                setresponseid(<?php echo $all_question['question_id'];?>,fetdata,'<?php echo $qtype;?>');
              }
            
           
         } 
    }
  
  <?php }?>
  
  <?php if($qtype == "Order"){?>
  var data<?php echo $all_question['question_id'];?> = google.visualization.arrayToDataTable([
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
  
    var options = {'title':'', 'width':550, 'height':400,is3D: true,'fontSize':14,'backgroundColor':'transparent'};

  // Display the chart inside the <div> element with id="piechart"
  
    if(data<?php echo $all_question['question_id'];?>.getNumberOfRows() == 0){
        $('#piechart-'+<?php echo $all_question['question_id'];?>).text("No Data");
        var qstcnt1=$("#totalquest").val()*6;
        $("#nodatacss-"+<?php echo $all_question['question_id'];?>).css({"height":qstcnt1 + "rem"});
    }
    else
    {
     
        var chart<?php echo $all_question['question_id'];?> = new google.visualization.PieChart(document.getElementById('piechart-<?php echo $all_question['question_id'];?>'));
        
        
        chart<?php echo $all_question['question_id'];?>.draw(data<?php echo $all_question['question_id'];?>, options);  
        google.visualization.events.addListener(chart<?php echo $all_question['question_id'];?>, 'select', selectHandler);
         function selectHandler() 
         {
            var selectedItem = chart<?php echo $all_question['question_id'];?>.getSelection()[0];
            if (selectedItem) {
                var fetdata = data<?php echo $all_question['question_id'];?>.getValue(selectedItem.row, 0);
                $("#result").modal('show');
                setresponseid(<?php echo $all_question['question_id'];?>,fetdata,'<?php echo $qtype;?>');
              }
            
           
         } 
    }
  
  <?php }?>
  
  <?php if($qtype == "Rating"){?>
  var data<?php echo $all_question['question_id'];?> = google.visualization.arrayToDataTable([
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
                //echo "['".$rating[$i]." Star',".$boolcnt."],";
                echo "['".$rating[$i]."',".$boolcnt."],";
              }
              $ratno++;
            }  ?>
  ]);
  
    var options = {'title':'', 'width':550, 'height':400,is3D: true,'fontSize':14,'backgroundColor':'transparent'};

  // Display the chart inside the <div> element with id="piechart"
  
    if(data<?php echo $all_question['question_id'];?>.getNumberOfRows() == 0){
        $('#piechart-'+<?php echo $all_question['question_id'];?>).text("No Data");
        var qstcnt1=$("#totalquest").val()*6;
        $("#nodatacss-"+<?php echo $all_question['question_id'];?>).css({"height":qstcnt1 + "rem"});
    }
    else
    {
     
        var chart<?php echo $all_question['question_id'];?> = new google.visualization.PieChart(document.getElementById('piechart-<?php echo $all_question['question_id'];?>'));
        
        
        chart<?php echo $all_question['question_id'];?>.draw(data<?php echo $all_question['question_id'];?>, options);  
        google.visualization.events.addListener(chart<?php echo $all_question['question_id'];?>, 'select', selectHandler);
         function selectHandler() 
         {
            var selectedItem = chart<?php echo $all_question['question_id'];?>.getSelection()[0];
            if (selectedItem) {
                var fetdata = data<?php echo $all_question['question_id'];?>.getValue(selectedItem.row, 0);
                $("#result").modal('show');
                setresponseid(<?php echo $all_question['question_id'];?>,fetdata,'<?php echo $qtype;?>');
              }
            
           
         } 
    }
  
  <?php }?>
  
  <?php if($qtype == "Opinion Scale"){?>
  var data<?php echo $all_question['question_id'];?> = google.visualization.arrayToDataTable([
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
                //echo "['".$scale[$t].",".$boolcnt."],";
                echo "['".$scale[$t]."',".$boolcnt."],";
              }
            }  ?>
  ]);
  
    var options = {'title':'', 'width':550, 'height':400,is3D: true,'fontSize':14,'backgroundColor':'transparent'};

  // Display the chart inside the <div> element with id="piechart"
  
    if(data<?php echo $all_question['question_id'];?>.getNumberOfRows() == 0){
        $('#piechart-'+<?php echo $all_question['question_id'];?>).text("No Data");
        var qstcnt1=$("#totalquest").val()*6;
        $("#nodatacss-"+<?php echo $all_question['question_id'];?>).css({"height":qstcnt1 + "rem"});
    }
    else
    {
     
        var chart<?php echo $all_question['question_id'];?> = new google.visualization.PieChart(document.getElementById('piechart-<?php echo $all_question['question_id'];?>'));
        
        
        chart<?php echo $all_question['question_id'];?>.draw(data<?php echo $all_question['question_id'];?>, options);  
        google.visualization.events.addListener(chart<?php echo $all_question['question_id'];?>, 'select', selectHandler);
         function selectHandler() 
         {
            var selectedItem = chart<?php echo $all_question['question_id'];?>.getSelection()[0];
            if (selectedItem) {
                var fetdata = data<?php echo $all_question['question_id'];?>.getValue(selectedItem.row, 0);
                $("#result").modal('show');
                setresponseid(<?php echo $all_question['question_id'];?>,fetdata,'<?php echo $qtype;?>');
              }
            
           
         } 
    }
  
  <?php }?>
 
  <?php } }?>
  
  
 
  
  
  


 
}
</script>
