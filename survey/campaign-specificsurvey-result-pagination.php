<?php 
require_once("classes/cls-survey.php");

$obj_survey = new Survey();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login");
}
$limitcond = "50";
$m="";
$userid=$_SESSION['ifg_admin']['client_id'];
//$page = "1";
//echo $page; exit;
if(!isset($_GET['page']))
{
   $page="1";
   $nextoffset="0";
}
else
{
   $page=$_GET['page'];
   $nextoffset=($page-1) * $limitcond;  
}
/**********All Active Survey***************/
$fields_survey_result = "`tbl_response_user`.*,`tbl_survey`.`s_id`,`tbl_survey`.`survey_id`";
if(isset($_GET['surveyid']) && !empty($_GET['surveyid']))
{
   $condition_survey_result = "`tbl_response_user`.`status` = 'Active' and `tbl_survey`.`user_id` = '".$userid."' and `tbl_response_user`.`survey_id`='".$_GET['surveyid']."' and (`tbl_response_user`.`survey_fill_position` = 'Blank' or `tbl_response_user`.`survey_fill_position` = 'Half')";
}
$orderby="`tbl_response_user`.`response_user_id` desc";
$limit ="$nextoffset,$limitcond";
$all_result_surveys=$obj_survey->getFullSurveyUser($fields_survey_result, $condition_survey_result, $orderby, $limit,'', 0);

//print_r($all_result_surveys);
$all_result_surveys_cnt=$obj_survey->getFullSurveyUser($fields_survey_result, $condition_survey_result, $orderby, '', 0);
$total_records = count($all_result_surveys_cnt);  
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
<h4>Total Result: <?php echo $total; ?></h4> 
<?php 
if(isset($all_result_surveys) && !empty($all_result_surveys))
    {
    foreach($all_result_surveys as $all_result_survey){
          /**********All Active Survey***************/
            $fields_fedbk="*";
            $condition_fedbk="`tbl_feedback`.`feed_id`='".$all_result_survey['feedback_id']."'";
            $feedbacks=$obj_survey->getFeedbackDetails($fields_fedbk, $condition_fedbk, '', '', 0);
            $feedback=end($feedbacks);
            
            $condition_camp="`tbl_campaign_user`.`camp_response_user_id`='".$all_result_survey['response_user_id']."'";
            $camps=$obj_survey->getCampaignSurveyDetails($fields_fedbk, $condition_camp, '', '', 0);
            $camp=end($camps);

?>
<style>
    .survey-result-modal{
        max-width:841px !important;
    }
</style>

 <div class="row listingbox d-flex align-items-center">
       
        <div class="col-md-2" style="word-wrap: break-word;">
             <div class="row"><div class="col-md-12 txtbold"><?php echo $all_result_survey['user_fullname'];?></div></div>
        </div>
         <div class="col-md-3" style="word-wrap: break-word;">
            <div class="row"><div class="col-md-12 txtbold"><?php echo $all_result_survey['user_email'];?></div></div>
        </div>
       
        <div class="col-md-1">
            <div class="row"><div class="col-md-12 txtbold"><?php $updat=explode(" ",$all_result_survey['created_at']);
           // echo $all_result_survey['updated_at'];
            echo date("d M Y", strtotime($updat[0]));
            
            ?></div></div>
            
        </div>
        <div class="col-md-2">
            <div class="row"><div class="col-md-12 txtbold"><?php echo $all_result_survey['survey_fill_position'];?> Survey</div></div>
            
        </div>
         <div class="col-md-1">
            <div class="row"><div class="col-md-12 txtbold"><?php echo $all_result_survey['domain'];?></div></div>
        </div>
        <div class="col-md-1">
             
            <div class="row"><div class="col-md-12 txtbold"><?php echo $camp['q_count'];?></div></div>
           <div class="row"><div class="col-md-12">Question Count</div></div>
            
        </div>
        
        <div class="col-md-2">
            <div class="row"><div class="col-md-12 txtbold" style="word-wrap: break-word;"><?php if($feedback['feed_data']!=""){echo $feedback['feed_data'];} else { echo "No Feedback";}?></div></div>
            <div class="row"><div class="col-md-12">Feedback</div></div>
        </div>
    </div>
    <?php } ?>
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
   <div class="row listingbox d-flex align-items-center">
        <div class="col-md-12" style="font-size:15px;text-align:center;">
               No Response Found
        </div>
    </div>
<?php }?>
<style>
       .loader1 {
   display:inline-block;
   font-size:0px;
   padding:0px;
}
.loader1 span {
   vertical-align:middle;
   border-radius:100%;
   display:inline-block;
   width:10px;
   height:10px;
   margin:3px 2px;
   -webkit-animation:loader1 0.8s linear infinite alternate;
   animation:loader1 0.8s linear infinite alternate;
}
.loader1 span:nth-child(1) {
   -webkit-animation-delay:-1s;
   animation-delay:-1s;
  background:rgba(245, 103, 115,0.6);
}
.loader1 span:nth-child(2) {
   -webkit-animation-delay:-0.8s;
   animation-delay:-0.8s;
  background:rgba(245, 103, 115,0.8);
}
.loader1 span:nth-child(3) {
   -webkit-animation-delay:-0.26666s;
   animation-delay:-0.26666s;
  background:rgba(245, 103, 115,1);
}
.loader1 span:nth-child(4) {
   -webkit-animation-delay:-0.8s;
   animation-delay:-0.8s;
  background:rgba(245, 103, 115,0.8);
  
}
.loader1 span:nth-child(5) {
   -webkit-animation-delay:-1s;
   animation-delay:-1s;
  background:rgba(245, 103, 115,0.4);
}

@keyframes loader1 {
   from {transform: scale(0, 0);}
   to {transform: scale(1, 1);}
}
@-webkit-keyframes loader1 {
   from {-webkit-transform: scale(0, 0);}
   to {-webkit-transform: scale(1, 1);}
}
</style>
<!-- Modal -->
<div class="modal fade" id="result" tabindex="-1" aria-labelledby="resultLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable survey-result-modal">
    <div class="modal-content" style="max-height:80%!important;">
      <div class="modal-header">
        <h5 class="modal-title" id="resultLabel" style="font-size:15px;align-item:center;font-weight:500;">Result Question and Answer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
           <div class="row text-center">
                <div class="loader1" id="loader1">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
          </div>
          <div id="questionanswer"></div>
          
        
      </div>
      
    </div>
  </div>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$(".page-link").click(function(){
			var id = $(this).attr("data-id");
			var select_id = $(this).parent().attr("id");
			<?php if(isset($_GET['surveyid'])){?>
			var survid='<?php echo $_GET['surveyid'];?>';
			<?php } else {?>
			var survid="";
			<?php }?>
			$.ajax({
				url: "<?php echo SITEPATH;?>campaign-specificsurvey-result-pagination.php",
				type: "GET",
				data: {
					page : id,surveyid:survid
				},
				cache: false,
				success: function(dataResult){
					$("#target-content").html(dataResult);
					$(".pageitem").removeClass("active");
					$("#"+select_id).addClass("active");
					$(window).scrollTop(0);
				}
			});
		});
	});

function setresponseid(resid,survid)
{
    $("#responseid").val(resid);
    $("#questionanswer").html("");
            $.ajax({
				url: "<?php echo SITEPATH;?>survey-result-qans.php",
				type: "GET",
				data: {
					resid : resid,survid:survid
				},
				cache: false,
				beforeSend: function(){
                    // Show image container
                    $('#loader1').show();
                },
				success: function(ans){
				    $('#loader1').hide();
					$("#questionanswer").html(ans);
				}
			});
}
</script>