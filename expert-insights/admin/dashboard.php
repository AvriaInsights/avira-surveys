<?php 
require_once("classes/cls-leads.php");
require_once("classes/cls-leadbox.php");
require_once("classes/cls-campaign.php");
require_once("classes/cls-leadsdata.php");

$obj_leadbox = new LeadDataa();
$obj_leads = new Leads();
//$obj_leadbox = new Leadbox();
$obj_camp = new Campaign();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login");
}


if($_SESSION['ifg_admin']['role']=="superadmin")
{
   $condition="";
}
else
{
    $condition="`tbl_task`.`user_id`='".$_SESSION['ifg_admin']['admin_id']."'";
}
//echo $condition;
$fields = "`tbl_task`.status,`tbl_task`.user_id,`tbl_task`.task_id,`tbl_task`.task_datetime,`tbl_task`.meeting_from_time,`tbl_task`.meeting_to_time,`tbl_task`.task_type,`tbl_leadBox`.fname,`tbl_leadBox`.lname,`tbl_leadBox`.lead_no,`tbl_leadBox`.lead_stage,`tbl_leadBox`.lead_status";
$orderbyleadsTask="`task_id` Desc";
if($_SESSION['ifg_admin']['role']=="superadmin")
{
    $condition_task="`tbl_task`.`status` = 'Active' and (`task_type`='Call' or `task_type`='Email')";
    $condition_meeting="`tbl_task`.`status` = 'Active' and `task_type`='Meeting'";
}
else
{
    $condition_task=$condition." and `tbl_task`.`status` = 'Active' and (`task_type`='Call' or `task_type`='Email')";
    $condition_meeting=$condition." and `tbl_task`.`status` = 'Active' and `task_type`='Meeting'";
}
//echo $condition_task;
//echo $condition_meeting;
$limit ="5";
$all_tasks = $obj_leads->getFullTaskDetails($fields, $condition_task, $orderbyleadsTask, $limit,'', 0);
$all_meeting = $obj_leads->getFullTaskDetails($fields, $condition_meeting, $orderbyleadsTask, $limit,'', 0);
//print_r($all_meeting);
/********Lead stage***********/
$fields1="*";
$all_allTask_cnt=$obj_leads->getTask($fields1, $condition, $orderbyleadsTask, $limit,'', 0);
$total_records = count($all_allTask_cnt);  
$total = $total_records;

/********Campaign***********/
$fields_campaign="*";
$condition_campaign="";
$all_campaigns=$obj_camp->getCampaignDetails($fields1, $condition_campaign, '', '', 0);

include('header.php')?>

<?php include('sidebar-menu.php')?>

<style>
    .ScrollStyle{
        max-height:255px;
    }
    .bg-total-leads{
        background-color: #f5c932!important;
    }
    .bg-converted-leads{
        background-color: #fc9262!important;
    }
    .bg-wip{
        background-color: #36cee5!important;
    }
    .bg-ip{
        background-color: #5c3bc8!important;
    }
    .bg-disqualified{
        background-color: #219aa8!important;
    } 
    .bg-fresh-leads{
        background-color: #3366CC!important;
    }
    .bg-assign-leads{
        background-color: #cc3333!important;
    }
    .bg-active{
        background-color: #84a744!important;
    }
    .bg-cold{
        background-color: #988ae2!important;
    }
    .bg-warm{
        background-color: #aee158!important;
    }
    .bg-hot{
        background-color: #db9a32!important;
    }
    .bg-prospect{
        background-color: #35277f!important;
    }
    .bg-invalid{
        background-color: #dd4752!important;
    }
    .meeting-status-link1 {
        font-size: .8rem;
    }
    /*.close{color: red;*/
    /*border: 1px solid red;*/
    /*background: none;*/
    /*}*/
</style>
<div class="home-section">
   <?php include("top-bar.php"); ?>
        <section class="common-space pt-3_7">
            <div class="container">
                <div class="row d-flex align-items-center pb-3 light-bg">
                    <div class="col-md-12">
                        <h5 class="page-header">
                            <i class="icon-Dashboard"></i>
                            Dashboard
                        </h5>
                    </div>
                </div>
            </div>
        </section>
<!--Lead stage funnel chart-->
<section class="mt-4">
    <div class="container">
        <div class="row">
             <div class="col-md-12">
                <div class="shadow-lg">
                     <div class="d-flex align-items-center justify-content-between p-2 ht-3">
                           <div class="task-header d-flex">
                                <h5 class="mt-1 ps-1">
                                    <i class="fa fa-bar-chart"></i>Lead Owner </h5>
                           </div>
                       </div>
                       
                     <div class="">
                            <div class="" id="style-8">
                                <div class="force-overflow">
                                    
                                    <div id="chartdiv" class="funnel"></div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
   
</section>

<!--Lead stage bar chart-->
 <section class="mt-4">
    <div class="container">
        <div class="row">
             <div class="col-md-12">
                <div class="shadow-lg">
                     <div class="d-flex align-items-center justify-content-between p-2 ht-3">
                           <div class="task-header d-flex">
                                <h5 class="mt-1 ps-1">
                                    <i class="fa fa-bar-chart"></i>Client Wise Leads</h5>
                           </div>
                           
                       </div>
                       <!--<div>-->
                       <!--    <ul class="list-unstyled d-flex list-menu mt-3">-->
                       <!--        <li>-->
                       <!--             <span class="badge-lg badge-dot meeting-status-link1">-->
                       <!--                 <i class="bg-total-leads"></i>-->
                       <!--                 Total Leads-->
                       <!--             </span>-->
                       <!--        </li>-->
                       <!--        <li>-->
                       <!--            <span class="badge-lg badge-dot meeting-status-link1">-->
                       <!--                 <i class="bg-active"></i>-->
                       <!--                 Active-->
                       <!--             </span>-->
                       <!--        </li>-->
                       <!--        <li>-->
                       <!--            <span class="badge-lg badge-dot meeting-status-link1">-->
                       <!--                 <i class="bg-cold"></i>-->
                       <!--                 Cold-->
                       <!--             </span>-->
                       <!--        </li>-->
                       <!--        <li>-->
                       <!--             <span class="badge-lg badge-dot meeting-status-link1">-->
                       <!--                 <i class="bg-warm"></i>-->
                       <!--                 Warm-->
                       <!--             </span>-->
                       <!--        </li>-->
                       <!--        <li>-->
                       <!--             <span class="badge-lg badge-dot meeting-status-link1">-->
                       <!--                 <i class="bg-hot"></i>-->
                       <!--                 Hot-->
                       <!--             </span>-->
                       <!--        </li>-->
                       <!--        <li>-->
                       <!--             <span class="badge-lg badge-dot meeting-status-link1">-->
                       <!--                 <i class="bg-disqualified"></i>-->
                       <!--                 Disqualified-->
                       <!--             </span>-->
                       <!--        </li>-->
                       <!--        <li>-->
                       <!--             <span class="badge-lg badge-dot meeting-status-link1">-->
                       <!--                 <i class="bg-prospect"></i>-->
                       <!--                 Prospect-->
                       <!--             </span>-->
                       <!--        </li>-->
                       <!--        <li>-->
                       <!--             <span class="badge-lg badge-dot meeting-status-link1">-->
                       <!--                 <i class="bg-invalid"></i>-->
                       <!--                 Invalid-->
                       <!--             </span>-->
                       <!--        </li>-->
                       <!--        <li>-->
                       <!--             <span class="badge-lg badge-dot meeting-status-link1">-->
                       <!--                 <i class="bg-success"></i>-->
                       <!--                 Won-->
                       <!--             </span>-->
                       <!--        </li>-->
                              
                               
                       <!--    </ul>-->
                       <!--</div>-->
                     <div class="">
                            <div class="" id="style-8">
                                <div class="force-overflow">
                                    
                                    <div id="bar_chart_stage" style = "width: 100%; height: 400px; margin: 0 auto;display: flex;align-items: center;justify-content: center;">
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<!--Lead stage funnel chart-->
<section class="mt-4">
    <div class="container">
        <div class="row">
            
             <div class="col-md-12">
                <div class="shadow-lg mb-3">
                     <div class="d-flex align-items-center justify-content-between p-2 ht-3">
                           <div class="task-header d-flex">
                                <h5 class="mt-1 ps-1">
                                    <i class="fa fa-bar-chart"></i>Approved/Disqualified Leads </h5>
                           </div>
                           
                       </div>
                       
                     <div class="">
                            <div class="" id="style-8">
                                <div class="force-overflow">
                                    
                                    <div id="piechart" class="funnel"></div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
   
</section>



<section class="form-wrapper-main form-client-info w-100" id="mySidepanel">
          <div class="text-end" style="float:right;background-color:none;">
            <i class="fa fa-times" onclick="closeNav()" style="padding-right:23px;cursor:pointer;color:red;"></i>
          </div>
         <div class="container" id="box"> </div>
 </section>
 
<?php include('footer.php')?>
<style>
    #chartdiv {
	width		: 70%;
	height		: 435px;
	font-size	: 11px;
}	
.funnel a{
    display:none!important;
}
.funnel{
    width:70%;
    text-align:center!important;
    margin:0 auto;
}
</style>
<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/funnel.js"></script>
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/alumuko/vanilla-datetimerange-picker@latest/dist/vanilla-datetimerange-picker.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $("#vn-info").hide();
  $("#vn-click").click(function(){
    $("#vn-info").slideToggle(300);
  });
});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script> 
<script>
$('.slider-for').slick({
   slidesToShow: 1,
   slidesToScroll: 1,
   arrows: false,
   fade: true,
   asNavFor: '.slider-nav',
   infinite: true
 });
 $('.slider-nav').slick({
   slidesToShow: 3,
   slidesToScroll: 1,
   //asNavFor: '.slider-for',
   dots: false,
   focusOnSelect: true,
   infinite: true
 });

 $('a[data-slide]').click(function(e) {
   e.preventDefault();
   var slideno = $(this).data('slide');
   //alert(slideno);
   $('.slider-nav').slick('slickGoTo', slideno - 1);
 });
 
</script>
 
<script>
//$("#favimg").hide();
  let arrow = document.querySelectorAll(".arrow");
for (var i = 0; i < arrow.length; i++) {
  arrow[i].addEventListener("click", (e)=>{
 let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
 arrowParent.classList.toggle("showMenu");
 
  });
}
//  $("#bigimg").show();
//   $("#favimg").hide();
let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".fa-bars");

sidebarBtn.addEventListener("click",()=>{
  sidebar.classList.toggle("close");
 // $("#bigimg").hide();
  //$("#favimg").show();
});
</script>
<script type = "text/javascript" src = "https://www.gstatic.com/charts/loader.js"></script>
<script type = "text/javascript">
         google.charts.load('current', {packages: ['corechart']});     
</script>
<!--Lead stage bar chart-->
<script language = "JavaScript">
         function drawChart() {
            // Define the chart to be drawn.
            
            <?php 
                $xx="";
                $fields_all_clients = "*";
                $condition_all_clients="";
                $clients = $obj_leadbox->getClientDetails($fields_all_clients, $condition_all_clients, '', '', 0);
                foreach($clients as $client)
                {
                  $fields_leads_bar="lead_id";
                  $condition_leads_bar="`tbl_leadData`.`client_id`='".$client['client_id']."'";
                  $leads_count_as_per_client=$obj_leadbox->getLeadDetails($fields_leads_bar, $condition_leads_bar, '', '', 0); 
                  $xx.="['".$client['client_name']."',".count($leads_count_as_per_client)."],";
                }
            ?>
            var data = google.visualization.arrayToDataTable([ 
                ['Clients', 'Lead Counts'],
                <?php echo $xx;?>
            ]);
           
           
            var options = {
                title: '',
                vAxis: { textPosition: 'none' },
                legend: { position: "none" },
                
            };
            // Instantiate and draw the chart.
            var chart = new google.visualization.ColumnChart(document.getElementById('bar_chart_stage'));
            chart.draw(data, options);
         }
         google.charts.setOnLoadCallback(drawChart);
</script>


<!--Campaign wise pie chart-->
<?php //if($_SESSION['ifg_admin']['role']=="superadmin") {?>
<?php /*foreach($all_campaigns as $all_campaign){
        $fields_leadbox = "*";
        $condition_leadbox_fresh = "`tbl_leadBox`.`campaign_id`='".$all_campaign['camp_id']."' and (`tbl_leadBox`.`user_id` IS NULL or `tbl_leadBox`.`user_id`='')";
        $all_leadbox_fresh= $obj_leadbox->getLeadDetails($fields_leadbox, $condition_leadbox_fresh, '', '', 0);
        $freshleads_cnt=count($all_leadbox_fresh);
        
        $condition_leadbox_assign = "`tbl_leadBox`.`campaign_id`='".$all_campaign['camp_id']."' and `tbl_leadBox`.`user_id`!=''";
        $all_leadbox_assign= $obj_leadbox->getLeadDetails($fields_leadbox, $condition_leadbox_assign, '', '', 0);
        $assignleads_cnt=count($all_leadbox_assign);
        if($freshleads_cnt!="0" && $assignleads_cnt=="0" || $freshleads_cnt=="0" && $assignleads_cnt!="0" || $freshleads_cnt!="0" && $assignleads_cnt!="0"){*/
?>
<!--<script type="text/javascript">-->

<!--      google.charts.load("current", {packages:["corechart"]});-->
<!--      google.charts.setOnLoadCallback(drawChart);-->
<!--      function drawChart() {-->
<!--                var data = google.visualization.arrayToDataTable([-->
<!--                ['Leads', 'Hours per Day'],-->
            
              <?php 
                 //echo "['Fresh Leads',".$freshleads_cnt."],";
                 //echo "['Assign Leads',".$assignleads_cnt."]";
                
             ?>
<!--        ]);-->

<!--            var options = {-->
<!--              title: '<?php //echo $all_campaign['company_name']."-".$all_campaign['camp_name']?>',-->
<!--              pieHole: 0.4,-->
<!--              legend: { position: "none" },-->
<!--              titleTextStyle: {-->
                    <!--color: '#cc00cc',    // any HTML string color ('red', '#cc00cc')-->
                    <!--fontName: 'Circular Std', // i.e. 'Times New Roman'-->
                    <!--fontSize: '14', // 12, 18 whatever you want (don't specify px)-->
                    <!--bold: 'true',    // true or false-->
                    <!--italic: 'false'   // true of false-->
<!--                },-->
<!--             };-->
        
           
<!--            var chart = new google.visualization.PieChart(document.getElementById('donutchart<?php echo $all_campaign['camp_id'];?>'));-->
<!--            chart.draw(data, options);-->
<!--      }-->

<!--</script>-->
<?php //} } ?>
<?php //}?>

<script>
$(document).ready(function() {
            $.ajax({
				url: "<?php echo SITEADMIN; ?>dashboard-priority-leads-pagination.php",
				type: "GET",
				data: {
					page : "1"
				},
				cache: false,
			    beforeSend: function(){
                   // Show image container
                    //$("#loader1").show();
                   
                },
				success: function(dataResult){
				    //alert(dataResult);
				    //$("#loader1").hide();
					$("#target-content").html(dataResult);
					$(".pageitem").removeClass("active");
					$("#1").addClass("active");
				}
			});
			
			$.ajax({
				url: "<?php echo SITEADMIN; ?>dashboard-task-section.php",
				beforeSend: function(){
                   // Show image container
                    //$("#loader1").show();
                   
                },
				success: function(dataResult){
				    //alert(dataResult);
				    //$("#loader1").hide();
					$("#task-section").html(dataResult);
					
				}
			});
});

        function clickClientInfo(n){
	     $('#mySidepanel').toggle();
         $.ajax({
                url : "dashboard-research-assignleadbox-info.php",
                type : "POST",
                data : {leadid:n},
                success: function(data){ //alert(data);
                    $("#box").html(data);
                }
           }); 
        } 	
</script>

<script>
    <?php 
        $newarray=array(); 
        $fields_leads="*";
        $condition_leads="status='Active'";
        $all_leads=$obj_leadbox->getLeadsOwnerDetails($fields_leads, $condition_leads, '', '', 0);
        foreach($all_leads as $all_lead)
        {
            $fullname=$all_lead['f_name']." ".$all_lead['lname'];
            $fields_leads_count="lead_id";
            $condition_leads_count="`tbl_leadData`.`sales_user`='".$all_lead['admin_id']."'";
            $leads_count_as_per_owner=$obj_leadbox->getLeadDetails($fields_leads_count, $condition_leads_count, '', '', 0);
            array_push($newarray,array($fullname=>count($leads_count_as_per_owner)));
            
            //$newarray=array("Warm"=>count($warm_leads),"Hot"=>count($hot_leads),"Cold"=>count($cold_leads));
        }
        //print_r($newarray);die()
        
        foreach($newarray as $newarrays) 
        {
                 foreach($newarrays as $x => $x_value) 
                 {
                 
                    //array_push($newarray1,array($x => $x_value)); 
                    //$newarray1=array($x => $x_value);
                    $newarray1[$x] = $x_value;
                 }
            
        }
        arsort($newarray1);
    ?>          
               
  var chart = AmCharts.makeChart( "chartdiv", {
  "type": "funnel",
  "theme": "light",
  "dataProvider": [ 
  <?php  foreach($newarray1 as $x => $x_value) {
                 
  ?>
  {
    "title": "<?php echo $x;?>",
    "value": <?php echo $x_value;?>
  },<?php  }?> ],
  "balloon": {
    "fixedPosition": true
  },
  "valueField": "value",
  "titleField": "title",
  "marginRight": 240,
  "marginLeft": 50,
  "startX": 500,
  "depth3D": 100,
  "angle": 40,
  "outlineAlpha": 1,
  "outlineColor": "#FFFFFF",
  "outlineThickness": 2,
  "labelPosition": "right",
  "balloonText": "[[title]]: [[value]]n[[description]]",
  "export": {
    "enabled": true
  }
} );
jQuery( '.chart-input' ).off().on( 'input change', function() {
  var property = jQuery( this ).data( 'property' );
  var target = chart;
  var value = Number( this.value );
  chart.startDuration = 0;

  if ( property == 'innerRadius' ) {
    value += "%";
  }

  target[ property ] = value;
  chart.validateNow();
} );
</script>

<!--Pie Chart-->
<script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
<?php 
    if($_SESSION['ifg_admin']['role']=="superadmin") 
    {
         $fields_subresult1 = "lead_id";
         $condition_subresult1 = "`tbl_LeadDelivery`.`lead_result`='Approved'";
         $all_subresults1=$obj_leadbox->getFullRequestDetails($fields_subresult1, $condition_subresult1, '', '', 0);
         $approved_count=count($all_subresults1);
         
         $condition_subresult2 = "`tbl_LeadDelivery`.`lead_result`='Disqualified'";
         $all_subresults2=$obj_leadbox->getFullRequestDetails($fields_subresult1, $condition_subresult2, '', '', 0);
         $disqualified_count=count($all_subresults2);
    }
    else
    {
         $fields_subresult1 = "lead_id";
         $condition_subresult1 = "`tbl_LeadDelivery`.`lead_result`='Approved' and `tbl_LeadDelivery`.`admin_user`='".$_SESSION['ifg_admin']['admin_id']."'";
         $all_subresults1=$obj_leadbox->getFullRequestDetails($fields_subresult1, $condition_subresult1, '', '', 0);
         $approved_count=count($all_subresults1);
         
         $condition_subresult2 = "`tbl_LeadDelivery`.`lead_result`='Disqualified' and `tbl_LeadDelivery`.`admin_user`='".$_SESSION['ifg_admin']['admin_id']."'";
         $all_subresults2=$obj_leadbox->getFullRequestDetails($fields_subresult1, $condition_subresult2, '', '', 0);
         $disqualified_count=count($all_subresults2);
    }
 ?>
 
  var data = google.visualization.arrayToDataTable([
  ['Lead status', 'Lead Count'],
  <?php if($approved_count!=0){?>
  ['Approved', <?php echo $approved_count;?>],
  <?php }?>
  <?php if($disqualified_count!=0){?>
  ['Disqualifed', <?php echo $disqualified_count;?>]
  <?php }?>
  ]);
  
   // Optional; add a title and set the width and height of the chart
  var options = {'title':'', 'width':800, 'height':500,is3D: true,};
 
  // Display the chart inside the <div> element with id="piechart"
  //alert(data.getNumberOfRows());
    if(data.getNumberOfRows() == 0){
        $('#piechart').append("No Data")
    }else{
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
      //alert(chart->options);
      chart.draw(data, options);       
    }
  
  
  <?php ?>
 
}
</script>