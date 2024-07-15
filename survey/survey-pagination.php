<?php 
require_once("classes/cls-survey.php");

$obj_survey = new Survey();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login");
}
$m="";
$limitcond = "7";
$userid=$_SESSION['ifg_admin']['client_id'];
$page = $_GET['page'];
//echo $page; exit;
if($page=="1")
{
   $nextoffset="0";
}
else
{
   $nextoffset=($page-1) * $limitcond;  
}
/**********All Active Survey***************/
$fields_survey = "survey_id,filled_by,survey_title,updated_at,campaign_name,survey_purpose,survey_status";
if(isset($_GET['searchval']))
{
   $searchval=$_GET['searchval'];
   $condition_survey = "`tbl_survey`.`status` = 'Active' and `tbl_survey`.`user_id` ='".$userid."' and (`tbl_survey`.`survey_title` like '%".$searchval."%' or `tbl_survey`.`survey_title` like '%".$searchval."' or `tbl_survey`.`survey_title` like '".$searchval."%' or `tbl_survey`.`campaign_name` like '%".$searchval."%' or `tbl_survey`.`campaign_name` like '%".$searchval."' or `tbl_survey`.`campaign_name` like '".$searchval."%')";
}
else
{
$condition_survey = "`tbl_survey`.`status` = 'Active' and `tbl_survey`.`user_id` ='".$userid."'";
}
//echo $condition_survey;
$orderby="`tbl_survey`.`s_id` desc";
$limit ="$nextoffset,$limitcond";
$all_active_surveys=$obj_survey->getSurveyDetail($fields_survey, $condition_survey, $orderby, $limit,'', 0);

$all_active_surveys_cnt=$obj_survey->getSurveyDetail($fields_survey, $condition_survey, $orderby, '', 0);
$total_records = count($all_active_surveys_cnt);  
$total_pages = ceil($total_records / $limitcond);

$total = $total_records;
//////////////////////*Paging Code start*/////////////////////////


if($total>0)
{
$total_links=ceil($total/$limitcond);
$previous_link = '';
$next_link = '';
$page_link = '';

//echo $total_links;

if($total_links > 4)
{ 
  if($page < 5)
  {
    for($count = 1; $count <= 5; $count++)
    {
      $page_array[] = $count;
    }
    $page_array[] = '...';
    $page_array[] = $total_links;
  }
  else
  {
    $end_limit = $total_links - 5;
    if($page > $end_limit)
    {
      $page_array[] = 1;
      $page_array[] = '...';
      for($count = $end_limit; $count <= $total_links; $count++)
      {
        $page_array[] = $count;
      }
    }
    else
    {
      $page_array[] = 1;
      $page_array[] = '...';
      for($count = $page - 1; $count <= $page + 1; $count++)
      {
        $page_array[] = $count;
      }
      $page_array[] = '...';
      $page_array[] = $total_links;
    }
  }
}
else
{
  for($count = 1; $count <= $total_links; $count++)
  {
    $page_array[] = $count;
  }
}
//print_r($page_array);
for($count = 0; $count < count($page_array); $count++)
{
  if($page == $page_array[$count])
  {
    $page_link .= '
    <li class="pageitem" id="'.$page_array[$count].'">
      <a class="page-link active1" href="#" data-id="'.$page_array[$count].'" data-sort="'.$m.'">'.$page_array[$count].' <span class="sr-only"></span></a>
    </li>
    ';
    $previous_id = $page_array[$count] - 1;
    if($previous_id > 0)
    {
      $previous_link = '<li class="pageitem" id="'.$previous_id.'"><a class="page-link" href="javascript:void(0)" data-id="'.$previous_id.'" data-sort="'.$m.'">Previous</a></li>';
    }
    else
    {
      $previous_link = '';
    }
    $next_id = $page_array[$count] + 1;
    if($page_array[$count] >= $total_links)
    {
      $next_link = '';
    }
    else
    {
      $next_link = '<li class="pageitem" id="'.$next_id.'"><a class="page-link" href="javascript:void(0)" data-id="'.$next_id.'" data-sort="'.$m.'">Next</a></li>';
    }
  }
  else
  {
    if($page_array[$count] == '...')
    {
      $page_link .= '
      <li class="pageitem disabled">
          <a class="page-link" href="javascript:void(0)" data-sort="'.$m.'" style="pointer-events: none;cursor:pointer;">...</a>
      </li>
      ';
    }
    else
    { 
      $page_link .= '
      <li class="pageitem" id="'.$page_array[$count].'"><a class="page-link" href="javascript:void(0)" data-id="'.$page_array[$count].'" data-sort="'.$m.'">'.$page_array[$count].'</a></li>
      ';
      
    }
  }
}

}
/*Paging Code End*/
?>

<style>
.active{
        
        border-color:none!important;
    }
input[type="checkbox"] {
	 height: 0;
	 width: 0;
	 visibility: hidden;
}
 label {
	 cursor: pointer;
	 text-indent: -9999px;
	 width: 55px;
	 height: 25px;
	 background: #f81708;
	 display: block;
	 border-radius: 100px;
	 position: relative;
	 content: "No";
	 color:#fff;
	 margin-top: -11px;
}
 label:after {
	 content: "No";
	 position: absolute;
	 top: 3px;
	 left: 5px;
	 width: 18px;
	 height: 18px;
	 background: #fff;
	 border-radius: 90px;
	 transition: 0.3s;
}
 input:checked + label {
	 background: #34a615;
	  
}
 input:checked + label:after {
	 left: calc(100% - 5px);
	 transform: translateX(-100%);
}
 label:active:after {
	 width: 130px;
}
</style>

<?php 
if(isset($all_active_surveys) && !empty($all_active_surveys))
{
foreach($all_active_surveys as $all_active_survey){
       $cnt_que_res="";
       $cnt_que="";
      /**********All Active Survey***************/
        $fields_questions = "question_id";
        $condition_questions = "`tbl_questionBank`.`survey_id` = '".$all_active_survey['survey_id']."'";
        $all_related_survey_questions=$obj_survey->getQuestionBank($fields_questions, $condition_questions, '', '', 0);
        $cnt_que = count($all_related_survey_questions);
        /*********Response count**************/
        $field_response_user = "response_user_id";
        $condition_response = "`tbl_response_user`.`survey_id` = '".$all_active_survey['survey_id']."' and `tbl_response_user`.`survey_fill_position` ='Full'";
        $all_related_survey_response=$obj_survey->getSurveyUser($field_response_user, $condition_response, '', '', 0);
        $cnt_que_res = count($all_related_survey_response);
        
?>
 <div class="row listingbox d-flex align-items-center">
    <div class="col-md-4">
        
        <div class="row">
            <div class="col-md-6 listinginnerbox">
                <div class="">
                    <a href="<?php echo SITEPATH;?>add-survey?surveyid=<?php echo $all_active_survey['survey_id'];?>">
                        <?php echo $all_active_survey['filled_by'];?> Form
                    </a>
                </div>
            </div>
            <div class="col-md-9" style="padding:11px;">
                <div class="row">
                    <div class="col-md-12 txtbold">
                        <a href="<?php echo SITEPATH;?>add-survey?surveyid=<?php echo $all_active_survey['survey_id'];?>">
                            <?php echo $all_active_survey['survey_title'];?></a>
                        </div>
                    </div>
                <div class="row"><div class="col-md-12">Last Modified: <?php echo $all_active_survey['updated_at'];?></div></div>
                <div class="row mt-3"><div class="col-md-12">Campaign: <?php echo $all_active_survey['campaign_name'];?></div></div>
                <div class="row"><div class="col-md-12">Survey Objective: <?php echo $all_active_survey['survey_purpose'];?></div></div>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="row"><div class="col-md-12 txtbold"><?php echo $cnt_que;?></div></div>
        <div class="row"><div class="col-md-12">Questions</div></div>
    </div>
    <div class="col-md-2">
        <div class="row"><div class="col-md-12 txtbold"><?php echo $cnt_que_res;?></div></div>
        <div class="row"><div class="col-md-12">Responses</div></div>
    </div>
    
    <div class="col-md-2">
        <div class="row">
            <div class="col-md-12">Publish Survey</div></div>
        <div class="row">
            <div class="col-md-12">
                <?php $survey_status = $all_active_survey['survey_status']; ?>
                <input type="checkbox" name="switch_published" id="switch<?php echo $all_active_survey['survey_id'];?>" onclick="action_published('<?php echo $all_active_survey['survey_id'];?>');" <?php echo $survey_status == "Published" ? "checked" : "unchecked" ?> value="<?php echo $all_active_survey['survey_status'] ?>"/>
                <label for="switch<?php echo $all_active_survey['survey_id'];?>">Toggle</label>
              
             <!--	<div class="switch-field">
            		<input type="radio" id="radio-one" name="switch-one" value="Published" onclick="action_published(<?php echo $all_active_survey['survey_id'];?>);"/>
            		<label for="radio-one">Yes</label>
            		<input type="radio" id="radio-two" name="switch-one" value="Unpublished" onclick="action_published(<?php echo $all_active_survey['survey_id'];?>);"/>
            		<label for="radio-two">No</label>
            	</div>-->
            
            </div>
        </div>
    </div>
 
    <div class="col-md-2">
        <div class="row"><div class="col-md-12">
            <select name="action<?php echo $all_active_survey['survey_id'];?>" id="action<?php echo $all_active_survey['survey_id'];?>" class="form-select" style="font-size:13px;" onchange="action('<?php echo $all_active_survey['survey_id'];?>');">
                <option value="">Action</option>
                <option value="update">Edit Survey Details</option>
                <option value="edit">Edit Survey</option>
                <option value="share" <?php if($cnt_que == "0"){echo ('disabled');}?>>Share Survey</option>
                <option value="view" <?php if($cnt_que_res == "0"){echo ('disabled');}?>>View Result</option>
                <option value="close">Close</option>
            </select>
        </div></div>
    </div>
</div>
<?php  }?>
<?php if($total>0){?>
    <div class="clearfix">
        <div class="">
           <nav>
                <ul class="pagination d-flex mb-0">
                <?php echo $previous_link . $page_link . $next_link;?>
    			</ul>
           </nav>
        </div>
    </div>           
    <?php }?>    
<?php } else {?>
   <div class="col-md-12 listingbox d-flex align-items-center">
        <div class="col-md-12" style="font-size:15px;text-align:center;">
               No Survey Found
        </div>
    </div>
    <?php }
	?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$(".page-link").click(function(){
		    var searchval = $("#search-holder").val();
			var id = $(this).attr("data-id");
			var select_id = $(this).parent().attr("id");
			$(window).scrollTop(0);
			$.ajax({
				url: "<?php echo SITEPATH; ?>survey-pagination.php",
				type: "GET",
				data: {
					page : id,searchval:searchval
				},
				cache: false,
				beforeSend: function() {
                    $(".survey-loader").show();
                    $("#target-content").html("");
                },
				success: function(dataResult){
				    $(".survey-loader").hide();
					$("#target-content").html(dataResult);
					$(".pageitem").removeClass("active");
					$("#"+select_id).addClass("active");
					$(window).scrollTop(0);
				}
			});
		});
	});

function action(survid)
{
    //alert(survid);
    var actionstat = $("#action"+survid).val();
    //alert(actionstat);
    if(actionstat=="edit")
    {
        window.location.href = "<?php echo SITEPATH;?>add-survey?surveyid="+survid;
    }
    if(actionstat=="share")
    {
        window.location.href = "<?php echo SITEPATH;?>share?surveyid="+survid;
    }
    if(actionstat=="view")
    {
        window.location.href = "<?php echo SITEPATH;?>view-survey-results/"+survid+"/";
    }
    if(actionstat=="update")
    {
        window.location.href = "<?php echo SITEPATH;?>update-survey-title/"+survid+"/";
    }
    if(actionstat=="close")
    {
        $.ajax({
              url : "<?php echo SITEPATH; ?>update-suvery-status.php",
              type : "POST",
              data : {surveyid:survid},
              success: function(dataquestion){
                
                    //$("#allquestionlist").html(dataquestion);
                    swal("Survey Closed!", "", "success");
                    $.ajax({
            				url: "<?php echo SITEPATH; ?>survey-pagination.php",
            				type: "GET",
            				data: {
            					page : "1"
            				},
            				cache: false,
            				success: function(dataResult){
            				    //alert(dataResult);
            					$("#target-content").html(dataResult);
            					$(".pageitem").removeClass("active");
            					$("#1").addClass("active");
            					
            				}
            			});
            		
            		$.ajax({
            				url: "<?php echo SITEPATH; ?>survey-pagination-close.php",
            				type: "GET",
            				data: {
            					page : "1"
            				},
            				cache: false,
            				success: function(dataResult){
            				    //alert(dataResult);
            					$("#target-content-inactive").html(dataResult);
            					$(".pageitem1").removeClass("active");
            					$("#1").addClass("active");
            					
            				}
            			});
              }
        });
    }
    
}

function action_published(survid)
{

    var survid =(survid);

    var chk_publish =  $('#switch'+survid).val();
    //alert(chk_publish);
        $.ajax({
              url : "<?php echo SITEPATH; ?>update-survey-status-published.php",
              type : "POST",
              data : {surveyid:survid,chk_publish:chk_publish},
              success: function(dataquestion){
                  //alert(dataquestion);
                    if(dataquestion !="1")
                    {
                       swal("Oops...Empty Survey!!!","Please Add Questions.", "error");
                    }
                    //$("#allquestionlist").html(dataquestion);
                    $.ajax({
            				url: "<?php echo SITEPATH; ?>survey-pagination.php",
            				type: "GET",
            				data: {
            					page : "1"
            				},
            				cache: false,
            				success: function(dataResult){
            				    //alert(dataResult);
            					$("#target-content").html(dataResult);
            					$(".pageitem").removeClass("active");
            					$("#1").addClass("active");
            					
            				}
            			});

              }
              
        });
    }
    



</script>