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


?>

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
                            <select name="formtype" id="formtype">
                                <option value="">Form Type</option>
                                <option value="AllTheResearch-Customization">AllTheResearch - Customization</option>
                                <option value="AllTheResearch-Sample Request">AllTheResearch - Sample Request</option>
                                <option value="AllTheResearch-Speak to Analyst">AllTheResearch - Speak to Analyst</option>
                                <option value="ResearchCMFE-Customization">ResearchCMFE - Customization</option>
                                <option value="ResearchCMFE-Sample Request">ResearchCMFE - Sample Request</option>
                                <option value="ResearchCMFE-Speak to Analyst">ResearchCMFE - Speak to Analyst</option>
                            </select>
                            <span class="pull-right"><?php if ($_SESSION['ifg_admin']['role'] == "superadmin") { ?><a style="font-size:1.5rem;" class="btn btn-sm btn-primary" href="export-leads.php?prio=<?php echo $priority_state;?>"><i class="fa fa-download"></i> Export List</a><?php } ?></span>
                            <div class="clearfix"></div>
                            </div>
                            <?php }?>
                            <div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="dataTable_wrapper">
                                        <div>
                                            <form method="post">
                                            <table id="request-data" class="table table-striped table-bordered table-hover" width="100%" cellspacing="0">
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
         <div class="container" id="box"> </div>
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
                $('#request-data').DataTable().clear().destroy();
                $('#request-data').dataTable({
                    "bProcessing": true,
                    ajax: {
                          "url": "load-request.php",
                          "type": 'POST',
                          "data": {frm_type :form_type}
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