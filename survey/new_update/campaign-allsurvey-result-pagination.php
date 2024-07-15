<?php 
require_once("classes/cls-survey.php");

$obj_survey = new Survey();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login");
}
$limitcond = "10";
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
$fields_survey_result = " DISTINCT `tbl_response_user`.survey_id,`tbl_survey`.*";
// if(isset($_GET['surveyid']) && !empty($_GET['surveyid']))
// {
//     $condition_survey_result = "`tbl_response_user`.`status` = 'Active' and `tbl_survey`.`user_id` = '".$userid."' and `tbl_response_user`.`survey_id`='".$_GET['surveyid']."'";
// }
// else
// {
//     $condition_survey_result = "`tbl_response_user`.`status` = 'Active' and `tbl_survey`.`user_id` = '".$userid."'";
// }
$condition_survey_result = "`tbl_response_user`.`user_id` = '".$userid."' and (`tbl_response_user`.`survey_fill_position`='Half' or `tbl_response_user`.`survey_fill_position`='Blank')";
$orderby_survey="`tbl_survey`.`survey_fill_at` desc";
$limit ="$nextoffset,$limitcond";
$all_result_surveys=$obj_survey->getFullSurveyUser($fields_survey_result, $condition_survey_result, $orderby_survey, $limit,'', 0);

$all_result_surveys_cnt=$obj_survey->getFullSurveyUser($fields_survey_result, $condition_survey_result, '', '', 0);
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

<?php 
if(isset($all_result_surveys) && !empty($all_result_surveys))
    {
    foreach($all_result_surveys as $all_result_survey){
          /**********All Active Survey***************/
            $condition_bhcnt = "`tbl_response_user`.`survey_id` = '".$all_result_survey['survey_id']."' and (`tbl_response_user`.`survey_fill_position`='Half' or `tbl_response_user`.`survey_fill_position`='Blank')";
            $all_bhcnt=$obj_survey->getSurveyUser('*', $condition_bhcnt, '', '', 0);
            $total_bhcnt = count($all_bhcnt);  

?>
<style>
    .survey-result-modal{
        max-width:841px !important;
    }
</style>

 <div class="row listingbox d-flex align-items-center">
        <div class="col-md-9">
            
            <div class="row">
                
                <div class="col-md-12" style="padding:11px;">
                    <div class="row">
                        <div class="col-md-12 txtbold">
                            <a href="<?php echo SITEPATH;?>campaign-specificsurvey-result.php?surveyid=<?php echo $all_result_survey['survey_id'];?>">
                                <?php echo $all_result_survey['survey_title'];?></a>
                            </div>
                        </div>
                    <div class="row"><div class="col-md-12">Date: <?php echo $all_result_survey['survey_fill_at'];?></div></div>
                </div>
            </div>
        </div>
         <div class="col-md-2">
            <div class="row"><div class="col-md-12 txtbold"><?php echo $total_bhcnt;?></div></div>
            <div class="row"><div class="col-md-12">Count of User</div></div>
        </div>
        <!--<div class="col-md-3">-->
        <!--    <div class="row"><div class="col-md-12 txtbold"><?php echo $all_result_survey['user_fullname'];?></div></div>-->
            
        <!--</div>-->
        <!--<div class="col-md-3">-->
        <!--    <div class="row"><div class="col-md-12 txtbold"><?php echo $all_result_survey['user_email'];?></div></div>-->
            
        <!--</div>-->
        
        <!--<div class="col-md-2">-->
        <!--    <div class="row"><div class="col-md-12">-->
        <!--        <a href="#" data-bs-toggle="modal" data-bs-target="#result" onclick="setresponseid(<?php echo $all_result_survey['response_user_id'];?>)">View Survey Result</a>-->
        <!--    </div></div>-->
        <!--</div>-->
        <!--<div class="col-md-2">-->
        <!--    <div class="row"><div class="col-md-12">-->
        <!--        <a href="<?php echo SITEPATH;?>view-survey-results/<?php echo $all_result_survey['survey_id'];?>/" class="view-survey-btn fs-5">View Survey Result</a>-->
        <!--    </div></div>-->
        <!--</div>-->
        <!--<div class="col-md-2">-->
        <!--    <div class="row"><div class="col-md-12">-->
        <!--        <a href="<?php echo SITEPATH;?>view-survey-result-by-user.php?surveyid=<?php echo $all_result_survey['survey_id'];?>" class="view-survey-btn fs-5">Full Result By User</a>-->
        <!--    </div></div>-->
        <!--</div>-->
        <!--<div class="col-md-2">-->
        <!--    <div class="row"><div class="col-md-12">-->
        <!--        <a href="<?php echo SITEPATH;?>view-half-survey-result-by-user.php?surveyid=<?php echo $all_result_survey['survey_id'];?>" class="view-survey-btn fs-5">Half Result By User</a>-->
        <!--    </div></div>-->
        <!--</div>-->
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
<!-- Modal -->
<div class="modal fade" id="result" tabindex="-1" aria-labelledby="resultLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable survey-result-modal">
    <div class="modal-content" style="max-height:80%!important;">
      <div class="modal-header">
        <h5 class="modal-title" id="resultLabel" style="font-size:15px;align-item:center;font-weight:500;">Result Question and Answer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
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
			
			$.ajax({
				url: "<?php echo SITEPATH;?>campaign-allsurvey-result-pagination.php",
				type: "GET",
				data: {
					page : id
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

</script>