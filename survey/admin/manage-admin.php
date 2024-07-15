<?php
require_once("classes/cls-admin.php");
require_once('classes/cls-pagination.php');

$obj_admin = new Admin();
$obj_pagination = new Pagination();

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
$fields = "*";
$condition = "";
$admin_details = $obj_admin->getAdminDetails($fields, $condition, '', '', 0);

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
    .ft-size{
        font-size: 15px;
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
                    <div class="col-lg-12 ft-size">
                        <h3 class="page-header text-primary"><i class="fa fa-th-list"></i> Manage Admin List</h3>
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li class="active">Manage Admin</li>
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
                            <!--    <span class="pull-left">General Admin List</span>-->
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
                                            <table id="admin-data" class="table table-striped table-bordered table-hover" width="100%" cellspacing="0">
                                                 <thead>
                                                    <tr>
                                                        <th># ID</th>
                                                        <th width="150">Full Name</th>
                                                        <th width="200">Email</th>
                                                        <th width="100">Username</th>
                                                        <th width="100">Role</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>

                                                <tfoot>
                                                    <tr>
                                                        <th># ID</th>
                                                        <th>Full Name</th>
                                                        <th>Email</th>
                                                        <th>Username</th>
                                                        <th>Role</th>
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
            $('#admin-data').dataTable({
                "bProcessing": true,
                "sAjaxSource": "load-admin.php",
                "aoColumns": [
                    {mData: 'admin_id'},
                    {mData: 'fullname'},
                    {mData: 'email'},
                    {mData: 'uname'},
                    {mData: 'role'},
                    {mData: 'action'}
                ]
            });
        });
    </script>