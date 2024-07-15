<?php 
require_once("classes/cls-survey.php");

$obj_survey = new Survey();

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}

/*****Survey Title Detail************/
if(isset($_GET['surveyid']))
{
    $surveyid=$_GET['surveyid'];
    
    $fields_survey = "*";
    $condition_survey = "`tbl_survey`.`survey_id` =".$surveyid;
    $survey_list=$obj_survey->getSurveyDetail($fields_survey, $condition_survey, '', '', 0);
    foreach($survey_list as $survey_lists)
    {
        $survey_title=$survey_lists['survey_title'];
    }
    
   
}
else
{
   $surveyid=""; 
}

/***********Category Detail*************/
$fields_cat = "*";
$condition_cat = "`tbl_category`.`status` = 'Active'";
$cat_list=$obj_survey->getSurveyCategory($fields_cat, $condition_cat, '', '', 0);

/**********Question Type***************/
$fields_quest_type = "*";
$condition_quest_type = "`tbl_question_type`.`status` = 'Active'";
$question_type_list=$obj_survey->getQuestionType($fields_quest_type, $condition_quest_type, '', '', 0);



?>

<link rel="stylesheet" href="<?php echo SITEPATH;?>survey/css/survey.css">
<link rel="stylesheet" href="<?php echo SITEPATH;?>survey/css/modal-style.css">
<style>
    .card{
        height: 600px;
        overflow-y: scroll;
        transition:none!important;
    }
    .icon-wrapper{
        /*cursor:pointer;*/
        font-size:16px;
        padding-top:8px;
    }
    .padquesttext{
        padding-left:10px;
    }
    /* Create three equal columns that floats next to each other */
.column {
  float: left;
  width: 33.33%;
  padding: 10px;
  height: 300px; /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
.paddqtype{
    padding-top:20px;
}
.cardt{
    font-size:21px!important;
}
.questyp{
    font-size:16px;
    cursor:pointer;
}
.leftsubbox{
    border:1px solid #000;
    border-radius:3px;
    margin:20px;
}
.srno{
    font-weight:600;
}
.action{
    font-weight:600;
    float:right;
    cursor:pointer;
}
.formsize{
    font-size:1.5rem!important;
}
.checklabel{
    font-size:15px!important;
    font-weight:100!important;
    vertical-align:super;
}
.largerCheckbox {
            width: 20px;
            height: 20px;
        }
.qidflt{
    float: right;
    padding-right: 77px;
}
.textinput-container .textinput-box.active {
    background-color: #F6F6F6;
}
</style>
<div class="wrapper">
   <?php include("sidebarmenu.php")?>
        <?php include("header.php")?>
        <section class="content-wrapper">
            <div class="container">
                
                  <div class="row row-cols-1 row-cols-md-2 g-4">
                      <div class="col-md-5">
                        <div class="card" style="width:440px">
                          
                          <div class="card-body">
                            <?php if(isset($_GET['surveyid'])){?><h2 class="card-title cardt">SURVEY : <?php echo $survey_title;?></h2><?php }?>
                            <div id="allquestionlist"></div>
                            
                            <div class="row leftsubbox">
                                <div class="col-md-12">
                                    <div class="icon-wrapper"><i class="fa fa-plus" aria-hidden="true" style="cursor:pointer;" id="addnewquestion"></i><span class="padquesttext">Add Question</span></div><p></p>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-7">
                        <div class="card">
                          
                          <div class="card-body">
                            <div id="allquestiontype">
                                <h2 class="card-title cardt">Choose Question Type</h2>
                                
                                <div class="row">
                                <?php $allquestiontype="";foreach($question_type_list as $question_type_lists){?>
                                      <div class="col-md-4 paddqtype">
                                        <span class="questyp" id="questyp<?php echo $question_type_lists['quest_type_id'];?>" 
                                        onclick="fetchquesttype('<?php echo $question_type_lists['quest_type'];?>','<?php echo $question_type_lists['quest_type_id'];?>')"><?php echo $question_type_lists['quest_type'];?></span>
                                        <!--<p>Some text..</p>-->
                                        
                                      </div>
                                <?php $allquestiontype.= $question_type_lists['quest_type'].",";}?>
                                <input type="hidden" name="qtypearray" id="qtypearray" value="<?php echo trim($allquestiontype,",");?>">
                                </div>
                                
                            </div>
                            <!--Question Form Start-->
                            <div id="questionform" style="display:none;">
                                <h2 class="card-title cardt">Edit</h2>
                                    <div class="row">
                                
                                      <div class="col-md-12 paddqtype">
                                        <form class="row">
                                                    <div style="background-color:#f8f8ff;padding:10px;border-radius:0.5rem;border: 1px solid #c7c7c7;width: 83rem; margin-left: 7px;">
                                                       <div class="col-md-12">
                                                              <div class="main-holder">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control formsize" name="questiontitle" id="questiontitle" placeholder="Start Typing Question">
                                                                    </div>
                                                              </div>
                                                        </div>
                                                        
                                                        <div class="col-md-12">
                                                              <div class="main-holder">
                                                                    <div class="form-group">
                                                                       <input type="text" class="form-control formsize" name="questiontooltip" id="questiontooltip" placeholder="Tooltip">
                                                                    </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-12"><hr></div>
                                                        <div class="col-md-12">
                                                              <div class="main-holder">
                                                                    <div class="form-group">
                                                                       <input type="checkbox" class="largerCheckbox" name="isrequired" id="isrequired">
                                                                       <label class="form-label checklabel">Required</label>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="singleqtype" id="singleqtype" value="">
                                                      </div>
                                                      	
                                        			
                                                              
                                                      <div style="background-color:#f8f8ff;padding:10px;border-radius:0.5rem;margin-top:10px;border: 1px solid #c7c7c7;width: 83rem; margin-left: 7px;">
                                                          	<div class="tabset">
                                                              <!-- Tab 1 -->
                                                              <input type="radio" name="tabset" id="tab1" aria-controls="options" checked>
                                                              <label for="tab1">Options</label>
                                                              <!-- Tab 2 -->
                                                              <input type="radio" name="tabset" id="tab2" aria-controls="logic">
                                                              <label for="tab2">Logic</label>
                                                              
                                                              <!--Boolean section-->
                                                              <div class="tab-panels" style="display:none;" id="boolean">
                                                                <section id="options" class="tab-panel">
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                       <div class="main-holder"><i class="fa fa-thumbs-up"></i>
                                                                            <label class="form-label">Yes</label>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                       <div class="main-holder"><i class="fa fa-thumbs-down"></i>
                                                                            <label class="form-label">No</label>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12"><hr></div>
                                                                </section>
                                                                
                                                                
                                                                <section id="logic" class="tab-panel">
                                                                  
                                                                </section>
                                                                
                                                              </div>
                                                              <!--Rating section-->
                                                              <div class="tab-panels" id="rating" style="display:none;">
                                                                <section id="options" class="tab-panel">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                       <div class="main-holder">
                                                                       <?php for($k=0;$k<5;$k++){?>
                                                                       <i class="fa fa-star-o"></i>
                                                                       <?php }?>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </div>
                                                                <div class="row"><div class="col-md-12"><hr></div></div>
                                                                
                                                                </section>
                                                                
                                                                
                                                                <section id="logic" class="tab-panel">
                                                                  
                                                                </section>
                                                                
                                                              </div>
                                                              <!--Text Section-->
                                                              
                                                               <div class="tab-panels" id="text" style="display:none;">
                                                                <section id="options" class="tab-panel">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                       <div class="main-holder">
                                                                       <div class="textinput-box active"><input disabled="" placeholder="Text Input"></div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                       <div class="main-holder">
                                                                       <label class="form-label">Type</label>
                                                                       <select class="form-select" id="texttype" name="texttype">
                                                                           <option value="text">Single Line</option>
                                                                           <option value="textarea">Multiple Line</option>
                                                                       </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row"><div class="col-md-12"><hr></div></div>
                                                                
                                                                </section>
                                                                
                                                                
                                                                <section id="logic" class="tab-panel">
                                                                  
                                                                </section>
                                                                
                                                              </div>
                                                            </div>
                                                            <div class="row">
                                                              <div class="col-md-6">
                                                                  <div class="main-holder">
                                                                    <button type="button" class="btn btn-primary formsize" id="editcurrentquestion">Add Next Question</button>
                                                                    </div>
                                                              </div>
                                                              <div class="col-md-6">
                                                                  <div class="main-holder qidflt">
                                                                    <label class="form-label checklabel">Question ID : <span id="insertedqid"> </span></label>
                                                                    </div>
                                                              </div>
                                                              <input type="hidden" name="currquestionid" id="currquestionid" value="">
                                                            </div>
                                                      </div>
                                                    </form>
                                                </section>
                                    </div>
                                </div>
                            </div>
                            <!--End Boolean Section-->
                            
                            
                            
                          </div>
                        </div>
                      </div>
                     
                    </div>  
            
            </div>
              
       </section>
       
       
       
   </div>


<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">CREATE A NEW SURVEY</h5>
            </div>
            <div class="modal-body">
				
                <form id="request-form" action="<?php echo SITEPATH; ?>survey/add-survey-title-action.php" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control formsize" name="surveytitle" id="surveytitle" placeholder="Survey Title">
                    </div>
                    <div class="form-group">
                        <select name="category" id="category" class="form-select formsize">
                            <option value="">Select Category</option>
                            <?php foreach($cat_list as $cat_lists){?>
                            <option value="<?php echo $cat_lists['category_id'];?>"><?php echo $cat_lists['title'];?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control formsize message-box-ht" id="description" name="description" placeholder="Survey Description" style="height:83px;"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary formsize">Create Survey</button>
                </form>
            </div>
        </div>
    </div>
</div>


<style>
    .modal{
    pointer-events: none;
}

.modal-dialog{
    pointer-events: all;
 }
</style>
<?php include("footer.php")?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script type="text/javascript">
	 $(document).ready(function () {
	    var survid = "<?php echo $surveyid;?>";
	    if(survid=="")
	    {
		  $("#myModal").modal('show');
		  $("#allquestionlist").hide();
	    }
	    
        $.ajax({
              url : "view-questions.php",
              type : "POST",
              data : {surveyid:survid},
              success: function(dataquestion){
                    $("#allquestionlist").html(dataquestion);
              }
           });
	    
	    
	    $("#allquestiontype").hide();
	    
	    // Click + icon to show question type
	    $("#addnewquestion").click(function(){
          $("#allquestiontype").show();
          $("#questionform").hide();
        });
        
        // Edit question and show question type
        $("#editcurrentquestion").click(function(){
            //Insert question code
            var questiontitle = $("#questiontitle").val();
            var questiontooltip = $("#questiontooltip").val();
            var isrequired = $('#isrequired').is(':checked');
            var updquestid = $("#currquestionid").val();
            var singleqtype = $("#singleqtype").val();
            $.ajax({
                  url : "update-question.php",
                  type : "POST",
                  data : {questiontitle:questiontitle,questiontooltip:questiontooltip,isrequired:isrequired,updquestid:updquestid,singleqtype:singleqtype},
                  success: function(dataquestion){
                        $("#questiontitle").val("");
                        $("#questiontooltip").val("");
                        $('#isrequired').val("");
                        $.ajax({
                          url : "view-questions.php",
                          type : "POST",
                          data : {surveyid:survid},
                          success: function(dataquestion){
                                $("#allquestionlist").html(dataquestion);
                          }
                      });
                  }
              });
       });
	});
	
	
	function fetchquesttype(qtype12,qtypeid)
	{ 
	    var survid = "<?php echo $surveyid;?>";
	    $("#allquestiontype").hide();
	    $("#questionform").show();
	    var qt = qtype12.toLowerCase();
	    var allquestiontype=$("#qtypearray").val();
	    var valNew=allquestiontype.split(',');

        for(var i=0;i<valNew.length;i++)
        {
           var singleqtype=valNew[i];
           var singleone=singleqtype.toLowerCase();
           $("#"+singleone).hide();
           
        }
	   $("#"+qt).show();
	   $("#singleqtype").val(qtype12);
	   
	   //alert(qtypeid);
	   //alert(survid);
	   $.ajax({
              url : "insert-questions.php",
              type : "POST",
              data : {qtypeid:qtypeid,survid:survid},
              success: function(dataquestionid){
                   $("#insertedqid").text(dataquestionid);
                   $("#currquestionid").val(dataquestionid);
                    $.ajax({
                          url : "view-questions.php",
                          type : "POST",
                          data : {surveyid:survid},
                          success: function(dataquestion){
                                $("#allquestionlist").html(dataquestion);
                          }
                       });
              }
          });
	}
	
</script>
<script src="<?php echo SITEPATH; ?>js/jquery.validate.js"></script>
<script src="<?php echo SITEPATH; ?>js/requestpopup.js"></script>
