<?php 
require_once("classes/cls-survey.php");

$obj_survey = new Survey();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login");
}
$m="";
$limitcond = "10";
$userid=$_SESSION['ifg_admin']['client_id'];
$page = $_GET['page'];
if($page=="1")
{
   $nextoffset="0";
}
else
{
   $nextoffset=($page-1) * $limitcond;  
}
/**********All Active Survey***************/
$fields_survey = "*";
$condition_survey = "`tbl_survey`.`status` = 'Inactive' and `tbl_survey`.`user_id` ='".$userid."'";
$orderby="`tbl_survey`.`survey_id` desc";
$limit ="$nextoffset,$limitcond";
$all_active_surveys=$obj_survey->getSurveyDetail($fields_survey, $condition_survey, $orderby, $limit,'', 0);

$all_inactive_surveys_count=$obj_survey->getSurveyDetail($fields_survey, $condition_survey, $orderby,'', 0);
$total_records1 = count($all_inactive_surveys_count);  
$total_pages1 = ceil($total_records1 / $limitcond);

$total = $total_records1;
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
    <li class="pageitem1" id="'.$page_array[$count].'">
      <a class="page-link1 active1" href="#" data-id="'.$page_array[$count].'" data-sort="'.$m.'">'.$page_array[$count].' <span class="sr-only"></span></a>
    </li>
    ';
    $previous_id = $page_array[$count] - 1;
    if($previous_id > 0)
    {
      $previous_link = '<li class="pageitem1" id="'.$previous_id.'"><a class="page-link1" href="javascript:void(0)" data-id="'.$previous_id.'" data-sort="'.$m.'">Previous</a></li>';
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
      $next_link = '<li class="pageitem1" id="'.$next_id.'"><a class="page-link1" href="javascript:void(0)" data-id="'.$next_id.'" data-sort="'.$m.'">Next</a></li>';
    }
  }
  else
  {
    if($page_array[$count] == '...')
    {
      $page_link .= '
      <li class="pageitem1 disabled">
          <a class="page-link1" href="javascript:void(0)" data-sort="'.$m.'" style="pointer-events: none;cursor:pointer;">...</a>
      </li>
      ';
    }
    else
    { 
      $page_link .= '
      <li class="pageitem1" id="'.$page_array[$count].'"><a class="page-link1" href="javascript:void(0)" data-id="'.$page_array[$count].'" data-sort="'.$m.'">'.$page_array[$count].'</a></li>
      ';
      
    }
  }
}

}
/*Paging Code End*/
?>
<style>
    .active1{
        background-color:#337ab7!important;
        color:#fff!important;
        border-color:none!important;
    }
    .padtop{
        padding-top: 11px;
    }
    .padtop2{
        padding-top: 16px;
    }
    .active2{
        z-index: 3;
        color: #fff!important;
        cursor: default;
        background-color: #337ab7!important;
        border-color: #337ab7!important;
    }
</style>
<?php 
if(isset($all_active_surveys))
{
foreach($all_active_surveys as $all_active_survey){
      /**********All Active Survey***************/
        $fields_questions = "*";
        $condition_questions = "`tbl_questionBank`.`survey_id` = '".$all_active_survey['survey_id']."'";
        $all_related_survey_questions=$obj_survey->getQuestionBank($fields_questions, $condition_questions, '', '', 0);
        $cnt_que = count($all_related_survey_questions);
    /*********Response count**************/
      $condition_response = "`tbl_response_user`.`survey_id` = '".$all_active_survey['survey_id']."'";
      $all_related_survey_response=$obj_survey->getSurveyUser('', $condition_response, '', '', 0);
      $cnt_que_res = count($all_related_survey_response);
      
      $survey_id = $all_active_survey['survey_id'];
?>
 <div class="row listingbox">
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-6 listinginnerbox"><?php echo $all_active_survey['filled_by'];?> Form</div>
            <div class="col-md-9" style="padding:11px;">
                <div class="row"><div class="col-md-12 txtbold"><?php echo $all_active_survey['survey_title'];?></div></div>
                <div class="row"><div class="col-md-12">Last Modified: <?php echo $all_active_survey['updated_at'];?></div></div>
            </div>
        </div>
    </div>
    <div class="col-md-2 padtop">
        <div class="row"><div class="col-md-12 txtbold"><?php echo count($all_related_survey_questions);?></div></div>
        <div class="row"><div class="col-md-12">Questions</div></div>
    </div>
    <div class="col-md-2 padtop">
        <div class="row"><div class="col-md-12 txtbold"><?php echo count($all_related_survey_response);?></div></div>
        <div class="row"><div class="col-md-12">Responses</div></div>
    </div>
    <div class="col-md-2 padtop">
       
    </div>
    <div class="col-md-2 padtop2">
        <div class="row"><div class="col-md-12">
            <select class="form-select" style="font-size:13px;" onchange="action1('<?php echo $all_active_survey['survey_id'];?>');" name="action<?php echo $survey_id; ?>" id="action<?php echo $survey_id;?>">
                <option value="">Action</option>
                <option value="edit">Edit Survey</option>
                <option value="share" <?php if($cnt_que == "0"){echo ('disabled');}?>>Share Survey</option>
                <option value="view" <?php if($cnt_que_res == "0"){echo ('disabled');}?>>View Result</option>
                <option value="active">Active</option>
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
<script type="text/javascript">
function action1(survid)
{
    var actionstat = $("#action"+survid).val();
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
    if(actionstat=="active")
    {
        $.ajax({
              url : "<?php echo SITEPATH;?>update-survey-status-active.php",
              type : "POST",
              data : {surveyid:survid},
              success: function(dataquestion){
               swal("Survey Activated!", "", "success");
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
}

    $(document).ready(function() {
		$(".page-link1").click(function(){
			var id = $(this).attr("data-id");
			//var select_id = $(this).parent().attr("id");
			//alert(select_id);
			$.ajax({
				url: "<?php echo SITEPATH; ?>survey-pagination-close.php",
				type: "GET",
				data: {
					page : id
				},
				cache: false,
				success: function(dataResult1){
					$("#target-content-inactive").html(dataResult1);
					$(".pageitem1").removeClass("active");
					$("#close-"+id).addClass("active");
					$(window).scrollTop(0);
				}
			});
		});
	});
</script>