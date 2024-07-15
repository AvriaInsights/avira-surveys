<?php
require_once("classes/cls-company.php");
//require_once("classes/cls-category.php");

$obj_company = new Company();
//$obj_category = new Category();


if (!isset($_SESSION['ifg_admin']) && ($_SESSION['ifg_admin']['role'] != "superadmin" || $_SESSION['ifg_admin']['role'] != "admin")) {
    header("Location:login.php");
}
include("header.php");
?>

<body>

    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <?php include("top-bar.php"); ?>
            <!-- /.navbar-top-links -->

            <?php include("side-bar.php"); ?>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header text-primary"><i class="fa fa-th-list"></i> Manage Company List</h3>
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li class="active">Manage Company</li>
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
                        <!--<div class="panel panel-default">
                            <div class="panel-heading">
                                <span class="pull-left">General Company List</span>
                                <span class="pull-right"><?php if ($_SESSION['ifg_admin']['role'] == "superadmin") { ?><button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-upload"></i> Import List</button> &nbsp;&nbsp;<a class="btn btn-sm btn-primary" href="export-request.php"><i class="fa fa-download"></i> Export List</a><?php } ?></span>
                                <div class="clearfix"></div>
                            </div>
                            <div>-->
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="dataTable_wrapper">
                                        <div class="">
                                            
                                        <hr>
                                        <div>
                                            <table id="company-data" class="table table-striped table-bordered table-hover" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th width="5%">ID</th>
                                                        <th width="50%">Company Name</th>
                                                        <th width="10%">Email Address</th>
                                                        <th width="30%">Website</th>
                                                        <th width="7%">Status</th>
                                                        <th width="30%">Action</th>
                                                    </tr>
                                                </thead>

                                                <tfoot>
                                                    <tr>
                                                         <th width="5%">ID</th>
                                                        <th width="50%">Company Name</th>
                                                        <th width="10%">Email Address</th>
                                                        <th width="30%">Website</th>
                                                        <th width="7%">Status</th>
                                                        <th width="30%">Action</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
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
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <!-- Modal -->
    <!--<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Import Report Lists</h4>
                </div>
                <div class="modal-body">
                    <form id="import-form" action="import-report-action.php" enctype="multipart/form-data" method="post">
                        <div class="form-group">
                            <label for="csv_file">File input</label>
                            <input type="file" id="csv_file" name="csv_file" required="required">
                            <p class="help-block">Please select the csv file.</p>
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>-->
    <!-- Modal -->
    <!-- The Modal -->
    <div id="myModal" class="modal">
    
      <!-- Modal content -->
      <div class="modal-content">
        <span class="close">&times;</span>
        <p id="companydetail"></p>
      </div>
    
    </div>
  
    <?php include("footer.php"); ?>
<style>
/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>
    <script src="bower_components/jquery-validation/jquery.validate.js"></script>
    <script src="bower_components/jquery-validation/additional-methods.js"></script>
    <script src="js/add-company.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#company-data').dataTable({
                "processing": true,
                'order':[[0,"desc"]],
                "language": {
                    processing: '<i class="fa fa-circle-o-notch fa-spin fa-fw"></i><span class="sr-only">Loading...</span> '
                },
                "ajax": {
                    url: "load-company.php"
                }
            });
         
         
        });
        
    </script>
    <script>
    function myFunction(id) {
      $("#myModal").show();
      //$("#companydetail").html(id);
      $.ajax({
            url : "ajax-company-details.php",
            type : "POST",
            data : {cmpid:id},
            success: function(data){
                $("#companydetail").html(data);
                
            }
        });
      
    }
    
    function financialFunction(id) {
      $("#myModal").show();
      //$("#companydetail").html(id);
      $.ajax({
            url : "ajax-company-financial-details.php",
            type : "POST",
            data : {cmpid:id},
            success: function(data){
                $("#companydetail").html(data);
                
            }
        });
      
    }
    
    $(".close").click(function(){
        $("#myModal").hide();
    });
    
    
    </script>
</body>

</html>
