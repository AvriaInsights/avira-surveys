<?php 
require_once("classes/cls-survey.php");

$obj_survey = new Survey();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}
$limitcond = "6";
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
$fields_survey_analyst = "*";
$condition_survey_analyst = "`tbl_buildAnalyst`.`status` = 'Active' and `tbl_buildAnalyst`.`user_id` ='".$userid."'";
$orderby="`tbl_buildAnalyst`.`analyst_id` desc";
$limit ="$nextoffset,$limitcond";
$all_analyst_surveys=$obj_survey->getAnalystDetail($fields_survey_analyst, $condition_survey_analyst, $orderby, $limit,'', 0);

$all_analyst_surveys_count=$obj_survey->getAnalystDetail($fields_survey_analyst, $condition_survey_analyst, $orderby,'', 0);
$total_records2 = count($all_analyst_surveys_count);  
$total_pages2 = ceil($total_records2 / $limitcond);
?>
<style>
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
    .disabled {
        opacity: 0.5;
        cursor: not-allowed;
        text-decoration:none!important;
    }
</style>
<?php 
if(isset($all_analyst_surveys))
{
foreach($all_analyst_surveys as $all_analyst_survey){
     
?>
 <div class="row listingbox">
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-6 listinginnerbox">Analyst Form</div>
            <div class="col-md-9" style="padding:11px;">
                <div class="row"><div class="col-md-12 txtbold"><?php echo $all_analyst_survey['survey_title'];?></div></div>
                <div class="row"><div class="col-md-12">Last Modified: <?php echo $all_analyst_survey['updated_at'];?></div></div>
            </div>
        </div>
    </div>
    <div class="col-md-2 padtop">
        <div class="row"><div class="col-md-12 txtbold">0</div></div>
        <div class="row"><div class="col-md-12">Questions</div></div>
    </div>
    <div class="col-md-2 padtop">
        <div class="row"><div class="col-md-12 txtbold">0</div></div>
        <div class="row"><div class="col-md-12">Responses</div></div>
    </div>
    <div class="col-md-2 padtop">
        <div class="row"><div class="col-md-12 txtbold">----</div></div>
        <div class="row"><div class="col-md-12">Completion Rate</div></div>
    </div>
    <div class="col-md-2 padtop2">
        <div class="row"><div class="col-md-12">
            <select name="action" id="action" class="form-select disabled" style="font-size:13px;" disabled>
                <option value="">Action</option>
            </select>
        </div></div>
    </div>
</div>
<?php } }?>
<div class="clearfix">
   	<ul class="pagination2 d-flex justify-content-end mb-0">
        <?php 
		if(!empty($total_pages2)){
			for($k=1; $k<=$total_pages2; $k++){
					if($k == 1){
						?>
					<li class="pageitem2 active" id="analyst-<?php echo $k;?>"><a href="JavaScript:Void(0);" data-id="<?php echo $k;?>" class="page-link2 active" ><?php echo $k;?></a></li>
												
					<?php 
					}
					else{
						?>
					<li class="pageitem2" id="analyst-<?php echo $k;?>"><a href="JavaScript:Void(0);" class="page-link2" data-id="<?php echo $k;?>"><?php echo $k;?></a></li>
					<?php
					}
			}
		}
					?>
		</ul>
   </ul>
</div>
<script type="text/javascript">

    $(document).ready(function() {
		$(".page-link2").click(function(){
			var id = $(this).attr("data-id");
			//var select_id = $(this).parent().attr("id");
			//alert(select_id);
			$.ajax({
				url: "<?php echo SITEPATH; ?>survey-analyst-pagination.php",
				type: "GET",
				data: {
					page : id
				},
				cache: false,
				success: function(dataResult){
					$("#target-analyst-content").html(dataResult);
					$(".pageitem2").removeClass("active");
					$("#analyst-"+id).addClass("active");
					$(window).scrollTop(0);
				}
			});
		});
	});
</script>