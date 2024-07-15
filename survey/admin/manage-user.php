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
            <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header text-primary"><i class="fa fa-th-list"></i> Manage User List</h3>
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li class="active">Manage User</li>
                        </ol>
                        <?php if (isset($_SESSION['success'])) { ?>
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php
                                echo $_SESSION['success'];
                                unset($_SESSION['success']);
                                ?>
                            </div>
                        <?php } elseif (isset($_SESSION['error'])) { ?>
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php
                                echo $_SESSION['error'];
                                unset($_SESSION['error']);
                                ?>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->

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
                           
                            <div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="dataTable_wrapper">
                                        <div>
                                            <form method="post">
                                            <table id="user-data" class="table table-striped table-bordered table-hover" width="100%" cellspacing="0">
                                                 <thead>
                                                    <tr>
                                                        <th># ID</th>
                                                        <th width="150">Full Name</th>
                                                        <th width="200">Email</th>
                                                        <th width="100">Phone</th>
                                                        <th width="100">Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>

                                                <tfoot>
                                                    <tr>
                                                        <th># ID</th>
                                                        <th width="150">Full Name</th>
                                                        <th width="200">Email</th>
                                                        <th width="100">Phone</th>
                                                        <th width="100">Status</th>
                                                        <th>Action</th>
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
       
       
      
   </div>


 <?php include("footer.php"); ?>

   <script type="text/javascript">
        $(document).ready(function () {
            $('#user-data').dataTable({
                "bProcessing": true,
                "sAjaxSource": "load-user.php",
                "aoColumns": [
                    {mData: 'user_id'},
                    {mData: 'fullname'},
                    {mData: 'email'},
                    {mData: 'phone'},
                    {mData: 'status'},
                    {mData: 'action'}
                ]
            });
        });
    </script>