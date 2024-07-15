<?php
require_once("classes/cls-survey.php");

$obj_survey = new Survey();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}

/**********Question Bank All***************/
$surveyid=$_POST['surveyid'];
$editqid=$_POST['editqid'];
$qtype=$_POST['qtype'];
$fields_questions = "`tbl_questionBank`.`sequence`";
$condition_questions = "`tbl_questionBank`.`question_id` =".$editqid;
$all_questions=$obj_survey->getQuestionBank($fields_questions, $condition_questions, '', '', 0);
foreach($all_questions as $all_question)
{
    $sequence=$all_question['sequence'];
}

$fields_quest_bank = "`tbl_questionBank`.`sequence`,`tbl_questionBank`.`question_id`,`tbl_questionBank`.`question_title`";
$condition_quest_bank = "`tbl_questionBank`.`status` = 'Active' and `tbl_questionBank`.`survey_id`='".$surveyid."' and `tbl_questionBank`.`sequence`>".$sequence;
$orderby = "`tbl_questionBank`.`sequence` asc";
$question_bank_lists=$obj_survey->getQuestionBank($fields_quest_bank, $condition_quest_bank, $orderby, '', 0);

 
if($qtype=="Opinion Scale")
{
    $qtype12="Opinion";
}
else
{
    $qtype12=$qtype;
}
if($qtype=="Radio")
{
    $fields_radio_opt = "`tbl_questionSub`.*";
    $condition_radio_opt = "`tbl_questionSub`.`question_id`='".$editqid."'";
    $orderby_radio = "`tbl_questionSub`.`question_subid` asc";
    $radio_lists=$obj_survey->getSubQuestionPoints($fields_radio_opt, $condition_radio_opt, $orderby_radio, '', 0);
    
}   
if($qtype == "Text" || $qtype == "Checkbox" || $qtype == "Order" || $qtype == "Dropdown" || $qtype == "Mrating")
{
    $fields_skip_data_que = "`tbl_questionBank`.*";
    $condition_skip_data_que = "`tbl_questionBank`.`question_id`='".$editqid."'";
    $skip_que_data_lists=$obj_survey->getQuestionBank($fields_skip_data_que, $condition_skip_data_que, '', '', 0);
    foreach($skip_que_data_lists as $skip_que_data_list)
    {
        $que_type_id = $skip_que_data_list['quest_type_id'];
        $que_title = $skip_que_data_list['question_title'];
        $que_skip_to = $skip_que_data_list['skip_question_where_to'];
    }
}
else{
/*********Fetch skip data*************/
$fields_skip_data = "`tbl_questionSub`.*";
$condition_skip_data = "`tbl_questionSub`.`question_id`='".$editqid."'";
$orderby_skip_data = "`tbl_questionSub`.`question_subid` asc";
$skip_data_lists=$obj_survey->getSubQuestionPoints($fields_skip_data, $condition_skip_data, $orderby_skip_data, '', 0);
}
?>
<div class="col-md-12 p-3">
    <span class="float-end fs-4 text-primary" style="padding-right:6px;"><input type="button" name="removelogic" id="removelogic" onclick="removeall()" value="Remove Logic" class="btn btn-info fs-5"></span></div>
<div class="col-md-3 skipfont">
   
    <?php if($qtype=="Boolean"){?>
    <select name="subidval-Boolean" id="subidval-Boolean" class="form-select" onchange="setval();">
        <option value="">Select Option</option> 
        <option value="Yes">Yes</option> 
        <option value="No">No</option>
        <option value="All">Select All Options</option>
    </select>
    <?php }?>
    <?php if($qtype=="Rating"){?>
    <select name="subidval-Rating" id="subidval-Rating" class="form-select" onchange="setval();">
        <option value="">Select Option</option>
        <?php for($i=1;$i<=5;$i++){?>
        <option value="<?php echo $i;?>">Star <?php echo $i;?></option>
        <?php }?>
        <option value="All">Select All Options</option>
    </select>
    <?php }?>
    <?php if($qtype=="Opinion Scale"){?>
    <select name="subidval-Opinion" id="subidval-Opinion" class="form-select" onchange="setval();">
        <option value="">Select Option</option> 
        <?php for($j=0;$j<=10;$j++){?>
        <option value="<?php echo $j;?>">Scale <?php echo $j;?></option>
        <?php }?>
        <option value="All">Select All Options</option>
    </select>
    <?php }?>
    <?php if($qtype=="Radio"){
    
    ?>
    <select name="subidval-Radio" id="subidval-Radio" class="form-select" onchange="setval();">
        <option value="">Select Option</option> 
        <?php if(isset($radio_lists) && !empty($radio_lists)){ foreach($radio_lists as $radio_list){?>
        <option value="<?php echo $radio_list['question_subid'];?>" id="raddrop<?php echo $radio_list['question_subid'];?>"><?php echo $radio_list['question_subtitle'];?></option> 
        <?php }}?>
        <option value="All">Select All Options</option>
    </select>
    <?php }?>
    <span class="spinner-border spinner-border-md mt-4" role="status" aria-hidden="true" id="span_loader1" style="display:none;"></span>
</div>
<div class="col-md-2">
    <div class="skip-txt">
        skip to
        <i class="fa fa-long-arrow-right"></i>
    </div>
</div>

<div class="col-md-7" id="logicquestions">
    <input type="hidden" name="setsubvalue" id="setsubvalue" value="">
    <select name="skip-<?php echo $qtype12;?>" id="skip-<?php echo $qtype12;?>" class="form-select select-que-font" onchange="skipquest();">
      <option value="">Select Question</option>
       <?php foreach($question_bank_lists as $question_bank_list){?>
       <option value="<?php echo $question_bank_list['sequence']."*".$question_bank_list['question_id'];?>" title="<?php echo "Q".$question_bank_list['sequence']."-".stripslashes($question_bank_list['question_title']);?>">
           <?php $str_replace = stripslashes($question_bank_list['question_title']); 
           if(strlen(stripslashes($question_bank_list['question_title']))>60) { 
                echo "Q".$question_bank_list['sequence']."-".substr(stripslashes($question_bank_list['question_title']), 0, 60) . "..."; } 
               else { echo "Q".$question_bank_list['sequence']."-".stripslashes($question_bank_list['question_title']); }
          ?></option>
       <?php }?>
         <option value="End">End Survey</option>
         <option value="Remove">Remove Logic</option>
    </select>
    <span class="spinner-border spinner-border-md mt-4" role="status" aria-hidden="true" id="span_loader" style="display:none;"></span>
</div>

<?php if(isset($skip_data_lists) && !empty($skip_data_lists)){?>
<div class="col-md-12" id="currentlogicstatus<?php echo $editqid; ?>">
    <table>
        <tr>
            <th>Options</th>
            <th>Skip To Question</th>
        </tr>
        <?php foreach($skip_data_lists as $skip_data_list){ if($skip_data_list['skip_question']!=""){?>
        <tr>
            <td><?php echo $skip_data_list['question_subtitle'];?></td>
            <td>Question <?php echo $skip_data_list['skip_question'];?></td>
        </tr>
        <?php }}?>
    </table>
    
</div>
<?php }?>
<?php if(isset($que_skip_to) && !empty($que_skip_to)){?>
<div class="col-md-12" id="currentlogicstatus<?php echo $editqid; ?>">
    <table>
        <tr>
            <th>Question Title</th>
            <th>Skip To Question</th>
        </tr>
        <?php if($que_skip_to!=""){?>
        <tr>
            <td><?php echo $que_title;?></td>
            <td>Question <?php echo $que_skip_to;?></td>
        </tr>
        <?php }?>
    </table>
    
</div>
<?php }?>
<div class="col-md-12" id="nowlogicstatus<?php echo $editqid; ?>"></div>
<script type="text/javascript">

    function skipquest()
    {
      var questtype12 = '<?php echo $qtype12;?>';
      var seq_qid="";
      var qqid="";
      var skipqid="";
      var spltseq_qid="";
      var seq_qid = $("#skip-"+questtype12).val();
      //alert(seq_qid);
      var spltseq_qid = seq_qid.split('*');
      var skipqid=spltseq_qid[0];
      var qqid=spltseq_qid[1];
      //alert(qqid);
      var cursequence = "<?php echo $sequence;?>";
      //alert(cursequence);
      var updquestid = $("#currquestionid").val();
      var skipval = $("#setsubvalue").val();
      var questtype = '<?php echo $qtype;?>';
            $.ajax({
                  url : "<?php echo SITEPATH;?>skipsurvey.php",
                  type : "POST",
                  data : {updquestid:updquestid,skipqid:skipqid,skipval:skipval,questtype:questtype,qqid:qqid,cursequence:cursequence},
                  beforeSend: function(){
                            // Show image container
                            $('#span_loader').show();
                  },
                  success: function(skipqt){
                     //alert(skipqt);
                      $('#span_loader').hide();
                      $('#currentlogicstatus'+<?php echo $editqid;?>).hide();
                      $.ajax({
                            url : "<?php echo SITEPATH;?>showskipoption.php",
                            type : "POST",
                            data : {editqid:'<?php echo $editqid;?>'},
                            success: function(skipoption){
                                //alert(skipoption);
                                $('#nowlogicstatus'+<?php echo $editqid;?>).html(skipoption);
                                $("#skip-"+questtype12).val("");
                                $("#subidval-"+questtype12).val("");
                            }
                      });
                  }
            });
    }
    
    function setval()
    {
        var qtype='<?php echo $qtype;?>';
        if(qtype=="Opinion Scale")
        {
            var qt="Opinion";
        }
        else
        {
            var qt=qtype;
        }
        var subval=$("#subidval-"+qt).val();
        $("#setsubvalue").val(subval);
    }
    
    function removeall()
    {
        var updquestid = $("#currquestionid").val();
            //alert(updquestid);
            var questtype = '<?php echo $qtype;?>';
            //alert(questtype);
            $.ajax({
                  url : "<?php echo SITEPATH;?>removelogiconbutton.php",
                  type : "POST",
                  data : {updquestid:updquestid,questtype:questtype},
                  beforeSend: function(){
                            // Show image container
                            $('#span_loader').show();
                  },
                  success: function(skipqt){
                     //alert(skipqt);
                      $('#span_loader').hide();
                      $('#currentlogicstatus'+<?php echo $editqid;?>).hide();
                      $.ajax({
                            url : "<?php echo SITEPATH;?>showskipoption.php",
                            type : "POST",
                            data : {editqid:'<?php echo $editqid;?>'},
                            success: function(skipoption){
                                //alert(skipoption);
                                $('#nowlogicstatus'+<?php echo $editqid;?>).html(skipoption);
                            }
                      });
                  }
            });
    }
    
</script>
<style>
    table { 
	width: 750px; 
	border-collapse: collapse; 
	margin:19px auto;
	}

/* Zebra striping */
tr:nth-of-type(odd) { 
	background: #eee; 
	}

th { 
	background: #3498db; 
	color: white; 
	font-weight: bold; 
	}

td, th { 
	padding: 5px; 
	border: 1px solid #ccc; 
	text-align: left; 
	font-size: 12px;
	}

/* 
Max width before this PARTICULAR table gets nasty
This query will take effect for any screen smaller than 760px
and also iPads specifically.
*/
@media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

	table { 
	  	width: 100%; 
	}

	/* Force table to not be like tables anymore */
	table, thead, tbody, th, td, tr { 
		display: block; 
	}
	
	/* Hide table headers (but not display: none;, for accessibility) */
	thead tr { 
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
	
	tr { border: 1px solid #ccc; }
	
	td { 
		/* Behave  like a "row" */
		border: none;
		border-bottom: 1px solid #eee; 
		position: relative;
		padding-left: 50%; 
	}

	td:before { 
		/* Now like a table header */
		position: absolute;
		/* Top/left values mimic padding */
		top: 6px;
		left: 6px;
		width: 45%; 
		padding-right: 10px; 
		white-space: nowrap;
		/* Label the data */
		content: attr(data-column);

		color: #000;
		font-weight: bold;
	}

}
</style>