<?php
require_once("classes/cls-request.php");

if(isset($_GET['priorit']))
{
    $priority_state=$_GET['priorit'];
    $condition = "`tbl_request`.`priority_wise`='".$priority_state."'";
}
else
{
    $priority_state="";
    $condition = "";
}

$obj_request = new Request();

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
$fields = "*";
$request_details = $obj_request->getRequestDetails($fields, $condition, '', '', 0);

$fields_high="`tbl_request`.`request_id`";
$condition_high="`tbl_request`.`priority_wise`='High'";
$request_high=$obj_request->getRequestDetails($fields_high, $condition_high, '', '', 0);

$fields_mid="`tbl_request`.`request_id`";
$condition_mid="`tbl_request`.`priority_wise`='Mid'";
$request_mid=$obj_request->getRequestDetails($fields_mid, $condition_mid, '', '', 0);

$fields_low="`tbl_request`.`request_id`";
$condition_low="`tbl_request`.`priority_wise`='Low'";
$request_low=$obj_request->getRequestDetails($fields_low, $condition_low, '', '', 0);

$fields_junk="`tbl_request`.`request_id`";
$condition_junk="`tbl_request`.`priority_wise`='Junk'";
$request_junk=$obj_request->getRequestDetails($fields_junk, $condition_junk, '', '', 0);

$fields_cluster_head = "*";
$condition_cluster_head = "`tbl_cluster_head`.`status` = 'Active'";
$cluster_head_details = $obj_request->getRequestClusterDetails($fields_cluster_head, $condition_cluster_head, '', '', 0);

$fields_relevance_map = "*";
$condition_relevance_map = "";
$relevance_map_details = $obj_request->getRelevanceMapping($fields_relevance_map, $condition_relevance_map, '', '', 0);

?>
 <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<style>
    .leads-count1{
        padding: 0.1rem;
    border-radius: 0.5rem;
    color: #fff;
    }
    .row1{
        margin-left:-10px;
        margin-right:-10px;
    }
    .marq{
        margin:10px;
    }

</style>
<link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
        select.input-sm {
    height: 30px;
    line-height: 22px;
    }
    div.dataTables_length label
    {
        font-size: 13px;
    }
    div.dataTables_filter label{
        font-size: 14px;
    }
    .table>:not(:first-child){
        font-size: 14px;
    }
</style>
<div class="wrapper">
   <?php include("sidebarmenu.php")?>
        <?php include("header.php")?>
        <section class="content-wrapper">
            <div class="row mb-5">
                <div class="col-lg-3">
                  <div class="leads-count bg-1">
                      <h4 id="high" style="cursor:pointer;">High Priority Leads</h4><span style="float:right;display:none;font-size:20px;color:#fff;cursor:pointer;" id="highcross">x</span>
                      <p><?php echo count($request_high);?></p>
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="leads-count bg-2">
                      <h4 id="mid" style="cursor:pointer;">Mid Priority Leads</h4><span style="float:right;display:none;font-size:20px;color:#fff;cursor:pointer;" id="midcross">x</span>
                      <p><?php echo count($request_mid);?></p>
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="leads-count bg-3">
                      <h4 id="low" style="cursor:pointer;">Low Priority Leads</h4><span style="float:right;display:none;font-size:20px;color:#fff;cursor:pointer;" id="lowcross">x</span>
                      <p><?php echo count($request_low);?></p>
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="leads-count bg-4">
                      <h4 id="junk" style="cursor:pointer;">Junk Leads</h4><span style="float:right;display:none;font-size:20px;color:#fff;cursor:pointer;" id="junkcross">x</span>
                      <p><?php echo count($request_junk);?></p>
                      
                  </div>
                </div>
              </div>
             <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <!--<div class="panel-heading">-->
                            <!--    <span class="pull-left">General Request List</span>-->
                            <!--    <div class="clearfix"></div>-->
                            <!--</div>-->
                            <?php if (isset($_SESSION['success'])) { ?>
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php
                                echo $_SESSION['success'];
                                unset($_SESSION['success']);
                                ?>
                            </div>
                            <?php }?>
                            <?php if(count($request_details)>0){?>
                            <div class="panel-heading">
                            <?php if(isset($_GET['priorit'])){?>
                            <?php if($_GET['priorit']=="High"){?><span style="color:#DB1F35;font-size:18px;font-weight:600;"><?php echo $_GET['priorit'];?> Priority Leads</span><?php }?>
                            <?php if($_GET['priorit']=="Mid"){?><span style="color:#244BB9;font-size:18px;font-weight:600;"><?php echo $_GET['priorit'];?> Priority Leads</span><?php }?>
                            <?php if($_GET['priorit']=="Low"){?><span style="color:#FF884B;font-size:18px;font-weight:600;"><?php echo $_GET['priorit'];?> Priority Leads</span><?php }?>
                            <?php if($_GET['priorit']=="Junk"){?><span style="color:#2AA40D;font-size:18px;font-weight:600;"><?php echo $_GET['priorit'];?> Priority Leads</span><?php }?>
                            <?php }?>
                            
                            <span class="pull-right">
                                <a style="font-size:1.5rem;" class="btn btn-sm btn-primary" href="javascript:void(0);" id="filterby"><i class="fa fa-filter"></i> Filter by</a>
                                <a style="font-size:1.5rem;" class="btn btn-sm btn-primary" href="export-leads-date.php"><i class="fa fa-download"></i> Export By Date</a>
                                <?php if ($_SESSION['ifg_admin']['role'] == "superadmin") { ?><a style="font-size:1.5rem;" class="btn btn-sm btn-primary" href="export-leads.php?prio=<?php echo $priority_state;?>"><i class="fa fa-download"></i> Export List</a><?php } ?></span>
                             <div class="clearfix"></div>
                            </div>
                            <?php }?>
                            <div id="filtersection" class="panel-heading" style="background-color:#F5FAFE;">
                                <div class="row"><div class="col-md-12 text-center"><h1 style="font-weight:600;">Leads Filter</h1></div></div>
                                <div class="row">
                                    <div class="col-md-8 offset-md-2 text-center">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <select name="filtby" id="filtby" class="form-select" style="width:auto;height:35px;font-size:16px;margin-top: 27px;margin-left: 227px;margin-bottom: 27px;">
                                                    <option value="">Filter by</option>
                                                    <option value="created_date">Created Date</option>
                                                    <option value="cluster_head">Cluster Head</option>
                                                    <option value="form_type">Form Type</option>
                                                    <option value="website">Website</option>
                                                    <option value="relevance_map">Relevance Mapping</option>
                                                    <option value="lead_stage">Lead Stage</option>
                                                    <option value="name">Name</option>
                                                    <option value="email">Email Id</option>
                                                    <option value="phone">Phone Number</option>
                                                    <option value="company">Company Name</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <div id="created-date" style="display:none;" class="col-md-6">
                                                    <input id="datepicker" name="datepicker" value="" class="form-control" placeholder="Created Date" style="width:auto;height:35px;font-size:16px;margin-top: 27px;margin-bottom: 27px;" /> 
                                                </div>
                                                <div id="cluster-head" style="display:none;" class="col-md-6">
                                                    <select name="clustertype" id="clustertype" class="form-select" style="width:auto;height:35px;font-size:16px;margin-top: 27px;margin-bottom: 27px;">
                                                        <option value="">Cluster Head</option>
                                                        <?php if(isset($cluster_head_details)) {  foreach($cluster_head_details as $cluster_head_detail){  ?>
                                                        <option value="<?php echo $cluster_head_detail['cluster_head_id'];?>"><?php echo $cluster_head_detail['cluster_head_name'];?></option>
                                                        <?php } }?>
                                                    </select>
                                                </div>
                                                <div id="form-type" style="display:none;" class="col-md-6">
                                                    <select name="formtype" id="formtype" class="form-select" style="width:auto;height:35px;font-size:16px;margin-top: 27px;margin-bottom: 27px;">
                                                        <option value="">Form Type</option>
                                                        <option value="AllTheResearch-Customization">AllTheResearch - Customization</option>
                                                        <option value="AllTheResearch-Sample Request">AllTheResearch - Sample Request</option>
                                                        <option value="AllTheResearch-Speak to Analyst">AllTheResearch - Speak to Analyst</option>
                                                        <option value="ResearchCMFE-Customization">ResearchCMFE - Customization</option>
                                                        <option value="ResearchCMFE-Sample Request">ResearchCMFE - Sample Request</option>
                                                        <option value="ResearchCMFE-Speak to Analyst">ResearchCMFE - Speak to Analyst</option>
                                                    </select>
                                                </div>
                                                <div id="website" style="display:none;" class="col-md-6">
                                                    <select name="websitename" id="websitename" class="form-select" style="width:auto;height:35px;font-size:16px;margin-top: 27px;margin-bottom: 27px;">
                                                        <option value="">Website</option>
                                                        <option value="AllTheResearch">AllTheResearch</option>
                                                        <option value="ResearchCMFE">ResearchCMFE</option>
                                                    </select>
                                                </div>
                                                <div id="relevance" style="display:none;" class="col-md-6">
                                                    <select name="relevancetype" id="relevancetype" class="form-select" style="width:auto;height:35px;font-size:16px;margin-top: 27px;margin-bottom: 27px;">
                                                        <option value="">Relevance Mapping</option>
                                                        <?php if(isset($relevance_map_details)) {  foreach($relevance_map_details as $relevance_map_detail){  ?>
                                                        <option value="<?php echo $relevance_map_detail['rel_id'];?>"><?php echo $relevance_map_detail['rel_title'];?></option>
                                                        <?php } }?>
                                                    </select>
                                                </div>
                                                <div id="leadstage" style="display:none;" class="col-md-6">
                                                    <select name="leadstagename" id="leadstagename" class="form-select" style="width:auto;height:35px;font-size:16px;margin-top: 27px;margin-bottom: 27px;">
                                                        <option value="">Lead Stage</option>
                                                        <option value="Active">Active</option>
                                                        <option value="Warm">Warm</option>
                                                        <option value="Pipeline">Pipeline</option>
                                                        <option value="Cold">Cold</option>
                                                        <option value="Disqualified">Disqualified</option>
                                                        <option value="Invalid">Invalid</option>
                                                        <option value="Prospect">Prospect</option>
                                                    </select>
                                                </div>
                                                <div id="name" style="display:none;" class="col-md-6">
                                                    <input type="text" class="form-control" name="fname" id="fname" placeholder="Full Name" value="" style="width:26rem;height:35px;font-size:16px;margin-top: 27px;margin-bottom: 27px;">
                                                </div>
                                                <div id="email" style="display:none;" class="col-md-6">
                                                    <input type="text" class="form-control" name="emailid" id="emailid" placeholder="Email ID" value="" style="width:26rem;height:35px;font-size:16px;margin-top: 27px;margin-bottom: 27px;">
                                                </div>
                                                <div id="phone" style="display:none;" class="col-md-6">
                                                    <input type="text" class="form-control" name="contactno" id="contactno" placeholder="Phone Number" value="" style="width:26rem;height:35px;font-size:16px;margin-top: 27px;margin-bottom: 27px;">
                                                </div>
                                                <div id="company" style="display:none;" class="col-md-6">
                                                    <input type="text" class="form-control" name="companyname" id="companyname" placeholder="Company" value="" style="width:26rem;height:35px;font-size:16px;margin-top: 27px;margin-bottom: 27px;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                <div class="clearfix"></div>
                            </div>
                            <div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="dataTable_wrapper">
                                        <div>
                                            <form method="post">
                                            <table id="request-data" class="table table-bordered table-hover" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th width="100">Created At</th>
                                                        <th width="100">Full Name</th>
                                                        <th width="100">Lead Owner</th>
                                                        <th width="200">Form Type</th>
                                                        <th width="50">Lead Score</th>
                                                        <th width="50">Lead Type</th>
                                                        
                                                    </tr>
                                                </thead>

                                                <tfoot>
                                                    <tr>
                                                        <th width="100">Created At</th>
                                                        <th width="100">Full Name</th>
                                                        <th width="100">Lead Owner</th>
                                                        <th width="200">Form Type</th>
                                                        <th width="50">Lead Score</th>
                                                        <th width="50">Lead Type</th>
                                                       
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            </form>
                                        </div>
                                        <!-- /.table-responsive -->
                                    </div>
                                </div>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
            
       </section>
       
       
       <section class="form-wrapper-main" id="mySidepanel">
          <div class="text-end" style="float:right;">
            <i class="fa fa-times" onclick="closeNav()"></i>
          </div>
         <div class="container" id="box" style="height:800px;"> </div>
         </section>
   </div>


 <?php include("footer.php"); ?>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#request-data').dataTable({
                "bProcessing": true,
                ajax: {
                      "url": "load-request.php",
                      "type": 'POST',
                      "data": {priority :'<?php echo $priority_state;?>'}
                },
                "aoColumns": [
                    {mData: 'created_at'},
                    {mData: 'fname'},
                    {mData: 'lead_owner'},
                    {mData: 'form_type'},
                    {mData: 'lead_score'},
                    {mData: 'lead_type'}
                ],
                "order": []
            });
            
            $("#filtersection").css("display","none");
            var prioritype='<?php echo $priority_state;?>';
            if(prioritype=="High")
            {
                $("#highcross").css("display","block");
            }
            else if(prioritype=="Mid")
            {
                $("#midcross").css("display","block");
            }
            else if(prioritype=="Low")
            {
                $("#lowcross").css("display","block");
            }
            else if(prioritype=="Junk")
            {
                $("#junkcross").css("display","block");
            }
            
            $('#highcross').click(function(){
                var x="<?php echo SITEPATH;?>admin/manage-request.php";
                window.location=x;
            });
            
            $('#midcross').click(function(){
                var x="<?php echo SITEPATH;?>admin/manage-request.php";
                window.location=x;
            });
            
            $('#lowcross').click(function(){
                var x="<?php echo SITEPATH;?>admin/manage-request.php";
                window.location=x;
            });
            
            $('#junkcross').click(function(){
                var x="<?php echo SITEPATH;?>admin/manage-request.php";
                window.location=x;
            });
            
            
            $('#high').click(function(){
                var form_score="High";
                
                var x="<?php echo SITEPATH;?>admin/manage-request.php?priorit="+form_score;
                window.location=x;
            
            });
            
            $('#mid').click(function(){
                var form_score="Mid";
                
                var x="<?php echo SITEPATH;?>admin/manage-request.php?priorit="+form_score;
                window.location=x;
            
            });
            
            $('#low').click(function(){
                var form_score="Low";
                
                var x="<?php echo SITEPATH;?>admin/manage-request.php?priorit="+form_score;
                window.location=x;
            
            });
            
            $('#junk').click(function(){
                var form_score="Junk";
                
                var x="<?php echo SITEPATH;?>admin/manage-request.php?priorit="+form_score;
                window.location=x;
            
            });
            
            $('#formtype').change(function(){
                var form_type=$(this).val();
                //alert(form_type);
                var pri = '<?php echo $priority_state;?>';
                //alert(pri);
                $('#request-data').DataTable().clear().destroy();
                $('#request-data').dataTable({
                    "bProcessing": true,
                    ajax: {
                          "url": "load-request.php",
                          "type": 'POST',
                          "data": {frm_type :form_type,priority :pri}
                    },
                    "aoColumns": [
                        {mData: 'created_at'},
                        {mData: 'fname'},
                        {mData: 'lead_owner'},
                        {mData: 'form_type'},
                        {mData: 'lead_score'},
                        {mData: 'lead_type'}
                    ],
                    "order": []
               });
            });
            
            
            $("#filterby").click(function(){
                $("#filtersection").slideToggle();
            });
            
            $("#filtby").change(function(){
                var filtby = $(this).val();
                if(filtby=="")
                {
                   $("#created-date").css("display","none"); 
                   $("#cluster-head").css("display","none");
                   $("#form-type").css("display","none");
                   $("#website").css("display","none");
                   $("#leadstage").css("display","none");
                   $("#name").css("display","none");
                   $("#email").css("display","none");
                   $("#phone").css("display","none");
                   $("#company").css("display","none");
                   $("#relevance").css("display","none");
                    var pri = '<?php echo $priority_state;?>';
                    //alert(pri);
                    $('#request-data').DataTable().clear().destroy();
                    $('#request-data').dataTable({
                        "bProcessing": true,
                        ajax: {
                              "url": "load-request.php",
                              "type": 'POST',
                              "data": {priority :pri}
                        },
                        "aoColumns": [
                            {mData: 'created_at'},
                            {mData: 'fname'},
                            {mData: 'lead_owner'},
                            {mData: 'form_type'},
                            {mData: 'lead_score'},
                            {mData: 'lead_type'}
                        ],
                        "order": []
                   });
                }
                if(filtby=="created_date")
                {
                   $("#created-date").css("display","block"); 
                   $("#cluster-head").css("display","none");
                   $("#form-type").css("display","none");
                   $("#website").css("display","none");
                   $("#leadstage").css("display","none");
                   $("#name").css("display","none");
                   $("#email").css("display","none");
                   $("#phone").css("display","none");
                   $("#company").css("display","none");
                   $("#relevance").css("display","none");
                }
                if(filtby=="cluster_head")
                {
                   $("#cluster-head").css("display","block");
                   $("#created-date").css("display","none");
                   $("#form-type").css("display","none");
                   $("#website").css("display","none");
                   $("#leadstage").css("display","none");
                   $("#name").css("display","none");
                   $("#email").css("display","none");
                   $("#phone").css("display","none");
                   $("#company").css("display","none");
                   $("#relevance").css("display","none");
                }
                if(filtby=="form_type")
                {
                   $("#form-type").css("display","block");
                   $("#created-date").css("display","none");
                   $("#cluster-head").css("display","none");
                   $("#website").css("display","none");
                   $("#leadstage").css("display","none");
                   $("#name").css("display","none");
                   $("#email").css("display","none");
                   $("#phone").css("display","none");
                   $("#company").css("display","none");
                   $("#relevance").css("display","none");
                }
                if(filtby=="website")
                {
                   $("#website").css("display","block");
                   $("#form-type").css("display","none");
                   $("#created-date").css("display","none");
                   $("#cluster-head").css("display","none");
                   $("#leadstage").css("display","none");
                   $("#name").css("display","none");
                   $("#email").css("display","none");
                   $("#phone").css("display","none");
                   $("#company").css("display","none");
                   $("#relevance").css("display","none");
                }
                if(filtby=="lead_stage")
                {
                   $("#leadstage").css("display","block");
                   $("#website").css("display","none");
                   $("#form-type").css("display","none");
                   $("#created-date").css("display","none");
                   $("#cluster-head").css("display","none");
                   $("#name").css("display","none");
                   $("#email").css("display","none");
                   $("#phone").css("display","none");
                   $("#company").css("display","none");
                   $("#relevance").css("display","none");
                }
                if(filtby=="name")
                {
                   $("#name").css("display","block");
                   $("#leadstage").css("display","none");
                   $("#website").css("display","none");
                   $("#form-type").css("display","none");
                   $("#created-date").css("display","none");
                   $("#cluster-head").css("display","none");
                   $("#email").css("display","none");
                   $("#phone").css("display","none");
                   $("#company").css("display","none");
                   $("#relevance").css("display","none");
                }
                if(filtby=="email")
                {
                   $("#email").css("display","block");
                   $("#name").css("display","none");
                   $("#leadstage").css("display","none");
                   $("#website").css("display","none");
                   $("#form-type").css("display","none");
                   $("#created-date").css("display","none");
                   $("#cluster-head").css("display","none");
                   $("#phone").css("display","none");
                   $("#company").css("display","none");
                   $("#relevance").css("display","none");
                }
                if(filtby=="phone")
                {
                   $("#phone").css("display","block");
                   $("#email").css("display","none");
                   $("#name").css("display","none");
                   $("#leadstage").css("display","none");
                   $("#website").css("display","none");
                   $("#form-type").css("display","none");
                   $("#created-date").css("display","none");
                   $("#cluster-head").css("display","none");
                   $("#company").css("display","none");
                   $("#relevance").css("display","none");
                }
                if(filtby=="company")
                {
                   $("#company").css("display","block");
                   $("#phone").css("display","none");
                   $("#email").css("display","none");
                   $("#name").css("display","none");
                   $("#leadstage").css("display","none");
                   $("#website").css("display","none");
                   $("#form-type").css("display","none");
                   $("#created-date").css("display","none");
                   $("#cluster-head").css("display","none");
                   $("#relevance").css("display","none");
                }
                if(filtby=="relevance_map")
                {
                   $("#relevance").css("display","block");
                   $("#phone").css("display","none");
                   $("#email").css("display","none");
                   $("#name").css("display","none");
                   $("#leadstage").css("display","none");
                   $("#website").css("display","none");
                   $("#form-type").css("display","none");
                   $("#created-date").css("display","none");
                   $("#cluster-head").css("display","none");
                   $("#company").css("display","none");
                }
            });
            
            $('#clustertype').change(function(){
                var cluster_type=$(this).val();
                
                var pri = '<?php echo $priority_state;?>';
                
                $('#request-data').DataTable().clear().destroy();
                $('#request-data').dataTable({
                    "bProcessing": true,
                    ajax: {
                          "url": "load-request.php",
                          "type": 'POST',
                          "data": {cluster_type :cluster_type,priority :pri}
                    },
                    "aoColumns": [
                        {mData: 'created_at'},
                        {mData: 'fname'},
                        {mData: 'lead_owner'},
                        {mData: 'form_type'},
                        {mData: 'lead_score'},
                        {mData: 'lead_type'}
                    ],
                    "order": []
               });
            });
            
            $('#websitename').change(function(){
                var websitename=$(this).val();
                
                var pri = '<?php echo $priority_state;?>';
                
                $('#request-data').DataTable().clear().destroy();
                $('#request-data').dataTable({
                    "bProcessing": true,
                    ajax: {
                          "url": "load-request.php",
                          "type": 'POST',
                          "data": {websitename :websitename,priority :pri}
                    },
                    "aoColumns": [
                        {mData: 'created_at'},
                        {mData: 'fname'},
                        {mData: 'lead_owner'},
                        {mData: 'form_type'},
                        {mData: 'lead_score'},
                        {mData: 'lead_type'}
                    ],
                    "order": []
               });
            });
            
            
            $('#relevancetype').change(function(){
                var relevancemap=$(this).val();
                
                var pri = '<?php echo $priority_state;?>';
                
                $('#request-data').DataTable().clear().destroy();
                $('#request-data').dataTable({
                    "bProcessing": true,
                    ajax: {
                          "url": "load-request.php",
                          "type": 'POST',
                          "data": {relevancemap :relevancemap,priority :pri}
                    },
                    "aoColumns": [
                        {mData: 'created_at'},
                        {mData: 'fname'},
                        {mData: 'lead_owner'},
                        {mData: 'form_type'},
                        {mData: 'lead_score'},
                        {mData: 'lead_type'}
                    ],
                    "order": []
               });
            });
            
            $('#fname').bind("keyup", function(){
                var fullname=$(this).val();
                //alert(fullname);
                var pri = '<?php echo $priority_state;?>';
                
                $('#request-data').DataTable().clear().destroy();
                $('#request-data').dataTable({
                    "bProcessing": true,
                    ajax: {
                          "url": "load-request.php",
                          "type": 'POST',
                          "data": {fullname :fullname,priority :pri}
                    },
                    "aoColumns": [
                        {mData: 'created_at'},
                        {mData: 'fname'},
                        {mData: 'lead_owner'},
                        {mData: 'form_type'},
                        {mData: 'lead_score'},
                        {mData: 'lead_type'}
                    ],
                    "order": []
               });
            });
            
            $('#emailid').bind("keyup", function(){
                var emailid=$(this).val();
                //alert(fullname);
                var pri = '<?php echo $priority_state;?>';
                
                $('#request-data').DataTable().clear().destroy();
                $('#request-data').dataTable({
                    "bProcessing": true,
                    ajax: {
                          "url": "load-request.php",
                          "type": 'POST',
                          "data": {emailid :emailid,priority :pri}
                    },
                    "aoColumns": [
                        {mData: 'created_at'},
                        {mData: 'fname'},
                        {mData: 'lead_owner'},
                        {mData: 'form_type'},
                        {mData: 'lead_score'},
                        {mData: 'lead_type'}
                    ],
                    "order": []
               });
            });
            
            $('#contactno').bind("keyup", function(){
                var contactno=$(this).val();
                //alert(fullname);
                var pri = '<?php echo $priority_state;?>';
                
                $('#request-data').DataTable().clear().destroy();
                $('#request-data').dataTable({
                    "bProcessing": true,
                    ajax: {
                          "url": "load-request.php",
                          "type": 'POST',
                          "data": {contactno :contactno,priority :pri}
                    },
                    "aoColumns": [
                        {mData: 'created_at'},
                        {mData: 'fname'},
                        {mData: 'lead_owner'},
                        {mData: 'form_type'},
                        {mData: 'lead_score'},
                        {mData: 'lead_type'}
                    ],
                    "order": []
               });
            });
            
            $('#companyname').bind("keyup", function(){
                var companyname=$(this).val();
                //alert(fullname);
                var pri = '<?php echo $priority_state;?>';
                
                $('#request-data').DataTable().clear().destroy();
                $('#request-data').dataTable({
                    "bProcessing": true,
                    ajax: {
                          "url": "load-request.php",
                          "type": 'POST',
                          "data": {companyname :companyname,priority :pri}
                    },
                    "aoColumns": [
                        {mData: 'created_at'},
                        {mData: 'fname'},
                        {mData: 'lead_owner'},
                        {mData: 'form_type'},
                        {mData: 'lead_score'},
                        {mData: 'lead_type'}
                    ],
                    "order": []
               });
            });
            
            $('#datepicker').change(function(){
                var datepicker=$(this).val();
                //alert(datepicker);
                var pri = '<?php echo $priority_state;?>';
                
                $('#request-data').DataTable().clear().destroy();
                $('#request-data').dataTable({
                    "bProcessing": true,
                    ajax: {
                          "url": "load-request.php",
                          "type": 'POST',
                          "data": {datepicker :datepicker,priority :pri}
                    },
                    "aoColumns": [
                        {mData: 'created_at'},
                        {mData: 'fname'},
                        {mData: 'lead_owner'},
                        {mData: 'form_type'},
                        {mData: 'lead_score'},
                        {mData: 'lead_type'}
                    ],
                    "order": []
               });
            });
            
            $('#leadstagename').change(function(){
                var leadstagename=$(this).val();
                //alert(datepicker);
                var pri = '<?php echo $priority_state;?>';
                
                $('#request-data').DataTable().clear().destroy();
                $('#request-data').dataTable({
                    "bProcessing": true,
                    ajax: {
                          "url": "load-request.php",
                          "type": 'POST',
                          "data": {leadstagename :leadstagename,priority :pri}
                    },
                    "aoColumns": [
                        {mData: 'created_at'},
                        {mData: 'fname'},
                        {mData: 'lead_owner'},
                        {mData: 'form_type'},
                        {mData: 'lead_score'},
                        {mData: 'lead_type'}
                    ],
                    "order": []
               });
            });
        });
        
        
        function sendid(n){  
         //alert(n);
         $.ajax({
                url : "modal.php",
                type : "POST",
                data : {requestid:n},
                success: function(data){ //alert(data);
                    $("#box").html(data);
                }
           }); 
        }
    </script>
    
    <script>
        $( "#datepicker" ).datepicker({
            showAnim: "fold",
            dateFormat: "yy-mm-dd"
        });
    </script>