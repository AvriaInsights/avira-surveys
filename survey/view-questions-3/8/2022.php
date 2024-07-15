<?php
require_once("classes/cls-survey.php");

$obj_survey = new Survey();

$surveyid=$_POST['surveyid'];
/**********All Questions***************/
$fields_questions = "*";
$condition_questions = "`tbl_questionBank`.`survey_id` =".$surveyid;
$orderby="`tbl_questionBank`.`sequence` ASC";
$all_questions=$obj_survey->getQuestionBank($fields_questions, $condition_questions, $orderby, '', 0);
?>
<div id="list"> 
<?php $srno=1;if(isset($all_questions) && !empty($all_questions)){
              foreach($all_questions as $all_question){
                  $fields_type = "*";
                  $condition_type = "`tbl_question_type`.`quest_type_id` =".$all_question['quest_type_id'];
                  $all_type=$obj_survey->getQuestionType($fields_type, $condition_type, '', '', 0);
                  foreach($all_type as $all_types){ $questiontype=$all_types['quest_type'];}
?>

        <div class="row leftsubbox" id="arrayorder_<?php echo $all_question['question_id']; ?>" style="cursor:move;">
            <div class="col-md-12">
                <a href="javascript:void(0);" style="text-decoration:none;" onclick="editquestion('<?php echo $questiontype;?>','<?php echo $all_question['question_id'];?>');">
                    <div class="icon-wrapper gen-icon d-flex align-items-center justify-content-between">
                        <span class="srno q-number"><?php echo $all_question['sequence'];?>.</span>
                    <img class="qtype_icon_side" src="<?php echo SITEPATH; ?>images/qtype_icon/<?php echo $questiontype; ?>.png"> <span class="padquesttext title-tip" title="<?php echo $all_question['question_title'];?>"><?php if($all_question['question_title']!=""){ if(strlen($all_question['question_title'])>27) { echo substr($all_question['question_title'], 0, 27) . "..."; } else { echo $all_question['question_title']; }} else { echo "..."; } ?> </span>
                    <span class="" id="copyquestion<?php echo $all_question['question_id'];?>" data-value="<?php echo $all_question['question_id'];?>"><a class="btn btn-light" id="copyquestion<?php echo $all_question['question_id'];?>" onclick="setquecopyid(<?php echo $all_question['question_id'];?>);"><i class="fa fa-copy"></i></a></span>                    
                    <span class="" id="deletequestion<?php echo $all_question['question_id'];?>" data-value="<?php echo $all_question['question_id'];?>"><a href="#deleteModal" class="action btn btn-danger" data-toggle="modal" id="deletequestion<?php echo $all_question['question_id'];?>" data-value="<?php echo $all_question['question_id'];?>" onclick="setdelid(<?php echo $all_question['question_id'];?>);"><i class="fa fa-close"></i></a></span>
                    </div>
                </a>
            </div>
        </div>
<?php $srno++;} }?>
</div>

<!-- Modal HTML -->
<div id="deleteModal" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header flex-column">
				<!--<div class="icon-box">-->
				<!--	<i class="material-icons">&#xE5CD;</i>-->
				<!--</div>						-->
				<h4 class="modal-title w-100">Are you sure?</h4>	
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<p>Do you really want to delete these records? This process cannot be undone.</p>
				<input type="hidden" name="delquestid" id="delquestid">
				
			</div>
			<div class="modal-footer justify-content-center">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-danger" onclick="deletequestion();" data-dismiss="modal">Delete</button>
			</div>
		</div>
	</div>
</div>     
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">
$(document).ready(function () {

    $(function() {
          $("#list").sortable({ opacity: 0.8, cursor: 'move',animation: 150, update: function() {
            var order = $(this).sortable("serialize") + '&update=update';
            //alert(order);
            $.post("update-question-sequence.php", order, function(theResponse){
                    $.ajax({
                      url : "view-questions.php",
                      type : "POST",
                      data : {surveyid:<?php echo $surveyid;?>},
                      success: function(dataquestion){
                         // alert(dataquestion);
                            $("#allquestionlist").html(dataquestion);
                            $("#allquestionlist").slideDown('slow');
                      }
                    }); 
               });  
              
            }         
            });
    });
});
function setdelid(delid)
{
    $("#delquestid").val(delid);
}
	function deletequestion()
	{
        var currqid = $("#delquestid").val();
        
        //alert(currqid);
                  $.ajax({
                        url : "delete_question_action.php",
                        type : "POST",
                        data : {qid:currqid,survid:<?php echo $surveyid;?>},
                        success: function(data2){
                            $.ajax({
                                  url : "view-questions.php",
                                  type : "POST",
                                  data : {surveyid:<?php echo $surveyid;?>},
                                  success: function(dataquestion){
                                        $("#allquestionlist").html(dataquestion);
                                        $("#questionform").hide();
                                        $("#allquestiontype").show();
                                  }
                               }); 
                        }
                   }); 
                       
           
	}
	function editquestion(qtype12,editqid)
	{ 
	    
	    
	      $("#allquestiontype").hide();
	      $("#img-bg").hide();
	      $("#questionform").show();
	      var qt = qtype12.toLowerCase();
    	  var allquestiontype=$("#qtypearray").val();
    	  var valNew=allquestiontype.split(',');
       
          for(var i=0;i<valNew.length;i++)
          {
               var singleqtype=valNew[i];
               var singleone=singleqtype.toLowerCase();
               if(singleone=="opinion scale")
               {
                  singleone="opinion-scale"; 
               }
               $("#"+singleone).hide();
          }
          
    	   if(qt=="opinion scale")
           {
               qt="opinion-scale";
        	   $("#"+qt).show();
           }
           else
           {
                $("#"+qt).show(); 
           }
    	   $("#singleqtype").val(qtype12);
    	   var singleqtype = $("#singleqtype").val()
    	   ;
    	   $("#frmaction").val("Edit");
    	   $("#currquestionid").val(editqid);
    	   $("#insertedqid").text(editqid);
    	   
    	   $("#showdropdwnquestionoptions").hide();
    	   $("#showopinionscalequestionoptions").hide();
    	   
    	   ////////////////////////////////
    	   $.ajax({
              url : "<?php echo SITEPATH;?>logic.php",
              type : "POST",
              data : {surveyid:<?php echo $surveyid;?>,editqid:editqid,qtype:qtype12},
              success: function(logicquestion){
                    $("#logicquestions-"+qt).html(logicquestion);
                    
              }
           });
    	   /////////////////////////////////
            $.ajax({
                    url : "fetch-edit-data.php",
                    type : "POST",
                    dataType: "json",
                    data : {editqid:editqid,qtype:qtype12},
                    success: function(data2){//{"qtitle":"what is your favourate game.?","qtooltip":"","qrequired":"No"}
                        //alert(data2);
                        $("#questiontitle").val(data2.qtitle);
                        $("#questiontooltip-"+qt).val(data2.qtooltip);
                        if(data2.qrequired=="Yes")
                        {
                           $("#isrequired-"+qt).attr('checked', true);  
                        }
                        if(data2.qrequired=="No")
                        {
                           $("#isrequired-"+qt).attr('checked', false);
                        }
                        $("#fetcheditoptions").html("");
                        $("#showquestionoptions").hide();
                        $("#showopinionscalequestionoptions").hide();
                        var subtitle = data2.qsubtitle;
                        if(qtype12=="Boolean")
                        {
                            $("#showquestionoptions").show();
                            $("#showquestionoptions").html('<div class="row justify-content-center"><div class="col-2 yesno_box__icon-wrap"><i class="fa fa-thumbs-up" style="font-size:100px;"></i></div><div class="col-2 yesno_box__icon-wrap" style="margin-left:10px;"><i class="fa fa-thumbs-down" style="font-size:100px;"></i></div></div><div class="row justify-content-center"><div class="col-2 bollab"><label>YES</label></div><div class="col-2 bollab" style="margin-left:10px;"><label>NO</label></div></div>');
                        }
                        if(qtype12=="Text")
                        {  //alert(subtitle);
                           $("#showquestionoptions").show();
                           $("#showquestionoptions").html('<div class="col-md-12"><div class="row"><div class="col-md-12"><div class="main-holder"><div class="textinput-box active"><input disabled="" placeholder="Text Input" class="disabltext"></div></div></div></div></div>');
                           if(subtitle=="Text")
                           {
                               $("#texttype").val("");
                           }
                           else
                           {
                               var subtt = subtitle.split("-");
                               var texttype12 = subtt[1];
                               $("#texttype").val(texttype12);
                           }
                             
                        }
                        if(qtype12=="Rating")
                        {
                            $("#showquestionoptions").show();
                            $("#showquestionoptions").html('<div class="row justify-content-center"><div class="col-md-12 text-center star-size"><i class="fa fa-star-o"></i><i class="fa fa-star-o starpad"></i><i class="fa fa-star-o starpad"></i><i class="fa fa-star-o starpad"></i><i class="fa fa-star-o starpad"></i></div></div>');
                        }
                        if(qtype12=="Radio")
                        {
                           //alert(subtitle);
                           $("#fetcheditoptions").show();
                           $("#showcheckboxquestionoptions").html("");
                           $("#showquestionoptions").html("");
	                       $("input[name='chkname[]']").val("");
                           $("input[name='radname[]']").val("");
                           $("input[name='dropdwnname[]']").val("");
                           var newqtype = "'"+qtype12+"'";
                           if(subtitle!="::")
                           {
                                var allradiovalue = subtitle.split(",");
                                if(allradiovalue.length > 0)
                                {
                                    for(var iii = 0; iii < allradiovalue.length; iii++) 
                                    { 
                                        var radval = allradiovalue[iii].split(":");
                                        //alert(radval[0]);
                                        $("#fetcheditoptions").append('<div class="col-md-12" id="row1'+radval[1]+'"><div class="row"><div class="col-md-12"><div class="main-holder" style="font-size:17px;"><input type="radio" disabled><span style="padding-left:10px;" id="">'+radval[0]+'</span><span class="action btn btn-danger btn_remove" id="deletesubpoints'+radval[1]+'" onclick="deletesubpoints('+radval[1]+','+radval[2]+','+newqtype+');">X</span></div></div></div></div>');
                                        //alert(allradiovalue[iii]);
                                        if(radval[0]=="Other")
                                        { 
                                            $("#other-radio").prop('checked', true);
                                            $("#other-radio").attr('disabled', true);
                                        }
                                        $("#subidval").append('<option value='+radval[0]+' id="raddrop-'+radval[1]+'">'+radval[0]+'</option>');
                                       
                                    }
                                } 
                                
                           }
                           
                            $('.dynamic-addedrad').remove();
                            $('#add_rad_name')[0].reset();
                        }
                        
                        if(qtype12=="Checkbox")
                        {
                           //alert(subtitle);
                           $("#fetcheditoptions").show();
                           $("#showcheckboxquestionoptions").html("");
                           $("#showquestionoptions").html("");
                           $("input[name='chkname[]']").val("");
                           $("input[name='radname[]']").val("");
                           $("input[name='dropdwnname[]']").val("");
                           
                           var newqtype = "'"+qtype12+"'";
                           if(subtitle!="::")
                           {
                                var allcheckvalue = subtitle.split(",");
                                if(allcheckvalue.length > 0)
                                {
                                    for(var iii = 0; iii < allcheckvalue.length; iii++) 
                                    { 
                                        $checkval = allcheckvalue[iii].split(":");
                                        //alert($radval[0]);
                                        $("#fetcheditoptions").append('<div class="col-md-12" id="row1'+$checkval[1]+'"><div class="row"><div class="col-md-12"><div class="main-holder" style="font-size:17px;"><input type="checkbox" disabled><span style="padding-left:10px;" id="">'+$checkval[0]+'</span>  <span class="action btn btn-danger btn_remove" id="deletesubpoints'+$checkval[1]+'" onclick="deletesubpoints('+$checkval[1]+','+$checkval[2]+','+newqtype+');">X</span></div></div></div></div>');
                                    
                                        if($checkval[0]=="Other")
                                        { 
                                            $("#other-checkbox").prop('checked', true);
                                            $("#other-checkbox").attr('disabled', true);
                                        }
                                    }
                                } 
                           }
                            $('.dynamic-addedchk').remove();
                            $('#add_chk_name')[0].reset();
                        }
                        
                        if(qtype12=="Dropdown")
                        {
                           //alert(subtitle);
                           $("#fetcheditoptions").show();
                           $("#showdropdwnquestionoptions").show();
                           $("input[name='chkname[]']").val("");
                           $("input[name='radname[]']").val("");
                           $("input[name='dropdwnname[]']").val("");
                           var newqtype = "'"+qtype12+"'";
                           //alert(subtitle);
                           if(subtitle!="::")
                           {
                                var alldropvalue = subtitle.split(",");
                                if(alldropvalue.length > 0)
                                {
                                    for(var iii = 0; iii < alldropvalue.length; iii++) 
                                    { 
                                        $dropval = alldropvalue[iii].split(":");
                                        //alert($radval[0]);
                                        $("#fetcheditoptions").append('<div class="col-md-12" id="row1'+$dropval[1]+'"><div class="row"><div class="col-md-12"><div class="main-holder" style="font-size:17px;"><span style="padding-left:10px;" id="">'+$dropval[0]+'</span><span class="action btn btn-danger btn_remove" id="deletesubpoints'+$dropval[1]+'" onclick="deletesubpoints('+$dropval[1]+','+$dropval[2]+','+newqtype+');">X</span></div></div></div></div>');
                                    }
                                } 
                           }
                            $('.dynamic-addeddropdwn').remove();
                            $('#add_dropdwn_name')[0].reset();
                            $('#dropdwnrep').empty();
                        }
                        
                        if(qtype12=="Opinion Scale")
                        {
                            $("#showopinionscalequestionoptions").show();
                            var allscalevalue = subtitle.split(",");
                            $("#leftlabel").val(allscalevalue[0]);
                            $("#middlelabel").val(allscalevalue[1]);
                            $("#rightlabel").val(allscalevalue[2]);
                            $("#minlabel").text(allscalevalue[0]);
                            $("#midlabel").text(allscalevalue[1]);
                            $("#highlabel").text(allscalevalue[2]);
                        }
                    }
               }); 
          
	}
	function deletesubpoints(delsubpointid,qid,qtype)
	{
	    //alert(qid);
	    var qtype1 = qtype.toLowerCase();
	    //alert(qtype1);
	    $.ajax({
                  url : "delete-sub-points.php",
                  type : "POST",
                  data : {delsubpointid:delsubpointid},
                  success: function(subval){
                      //alert(subval)
                      $("#raddrop-"+delsubpointid).remove();
                      $('#row1'+delsubpointid).remove(); 
                      if(subval=="Other")
                      {  
                          
                          $("#other-"+qtype1).attr('disabled', false);
                          $("#other-"+qtype1).prop('checked', false);
                          
                      }
                  }
              }); 
	}
	
	function setquecopyid(srvcpid)
	{
        var currqueid = (srvcpid);
        alert(currqueid);
                  $.ajax({
                        url : "copy_question_action.php",
                        type : "POST",
                        data : {qid:currqueid,survid:<?php echo $surveyid;?>},
                        success: function(data2){
                            $.ajax({
                                  url : "view-questions.php",
                                  type : "POST",
                                  data : {surveyid:<?php echo $surveyid;?>},
                                  success: function(dataquestion){
                                        $("#allquestionlist").html(dataquestion);
                                        $("#questionform").hide();
                                        $("#allquestiontype").show();
                                  }
                               }); 
                        }
                   }); 
                       
           
	}
</script>
<style>
    .modal-confirm {		
	color: #636363;
	width: 400px;
}
.modal-title{
    color:#01C3FF;
}
.modal-confirm .modal-content {
	padding: 20px;
	border-radius: 5px;
	border: none;
	text-align: center;
	font-size: 14px;
}
.modal-confirm .modal-header {
	border-bottom: none;   
	position: relative;
}
.modal-confirm h4 {
	text-align: center;
	font-size: 26px;
	margin: 30px 0 -10px;
}
.modal-confirm .close {
	position: absolute;
	top: -5px;
	right: -2px;
	font-size: 18px;
    color: red;
    opacity: 1;
}
.modal-confirm .modal-body {
	color: #000;
	font-weight:500;
}
.modal-confirm .modal-footer {
	border: none;
	text-align: center;		
	border-radius: 5px;
	font-size: 13px;
	padding: 10px 15px 25px;
}
.modal-confirm .modal-footer a {
	color: #999;
}		
.modal-confirm .icon-box {
	width: 80px;
	height: 80px;
	margin: 0 auto;
	border-radius: 50%;
	z-index: 9;
	text-align: center;
	border: 3px solid #01C3FF;
}
.modal-confirm .icon-box i {
	color: #01C3FF;
	font-size: 46px;
	display: inline-block;
	margin-top: 13px;
}
.modal-confirm .btn, .modal-confirm .btn:active {
	color: #fff;
	border-radius: 4px;
	background: #60c7c1;
	text-decoration: none;
	transition: all 0.4s;
	line-height: normal;
	min-width: 120px;
	border: none;
	min-height: 40px;
	border-radius: 3px;
	margin: 0 5px;
	font-size:15px;
}
.modal-confirm .btn-secondary {
	background: #c1c1c1;
}
.modal-confirm .btn-secondary:hover, .modal-confirm .btn-secondary:focus {
	background: #a8a8a8;
}
.modal-confirm .btn-danger {
	background: #01C3FF;
}
.modal-confirm .btn-danger:hover, .modal-confirm .btn-danger:focus {
	background: #c1c1c1;
}
.trigger-btn {
	display: inline-block;
	margin: 100px auto;
}
.btn_cpy{    
    margin-left: 50%;
}
</style>
