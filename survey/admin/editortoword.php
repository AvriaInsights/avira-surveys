<?php
require_once("classes/cls-admin.php");
$obj_admin = new Admin();
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
if (isset($_GET['admin_id']) && $_GET['admin_id'] != "") {
    $condition = "`admin_id` = '" . base64_decode($_GET['admin_id']) . "'";
    $admin_details = $obj_admin->getAdminDetails('', $condition, '', '', 0);
    $admin_detail = end($admin_details);
} else {
    $admin_detail['status'] = "";
}

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
    .ft-size{
        font-size: 15px;
    }
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           
   <script src="ckeditor/ckeditor.js" ></script>       
<div class="wrapper">
   <?php include("sidebarmenu.php")?>
        <?php include("header.php")?>
        <section class="content-wrapper">
            <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
             <div class="row">
                    <div class="col-lg-12 ft-size">
                        <h3 class="page-header text-primary"><i class="fa fa-user"></i> <?php echo (isset($_GET['admin_id'])) ? "Edit" : "Add"; ?> Admin</h3>
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li><a href="manage-admin.php">Manage Admin</a></li>
                            <li class="active"><?php echo (isset($_GET['admin_id'])) ? "Edit" : "Add"; ?> Admin</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
             <div class="row">
                    <div class="col-lg-12 ft-size">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                General Admin Form
                            </div>
                            <div class="table-responsive">
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form role="form" method="POST" action="expor.php" name="add-form" id="add-form">
                                                
                                               <div class="form-group">
                                                    <label>Description </label>
                                                    <textarea class="form-control" name="description" id="description" placeholder="Description"></textarea>
                                                </div>

                                                 <hr>
                                                <button type="submit" class="btn-default">Submit</button>
                                                <button type="reset" class="btn-default">Reset</button>
                                            </form>
                                        </div>
                                        <!-- /.col-lg-6 (nested) -->
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div></div>
       </section>
       
       
      
   </div>


 <?php include("footer.php"); ?>

   <script src="bower_components/jquery-validation/jquery.validate.js"></script>
    <script src="js/add-admin.js"></script>
    <script>
        //CKEDITOR.replace( 'description' );
          //CKEDITOR.replace( 'toc' );
            //CKEDITOR.replace( 'tnf' );
             CKEDITOR.replace('description', {
        filebrowserUploadUrl: 'ckeditor/ck_upload.php',
        filebrowserUploadMethod: 'form'
    });
    CKEDITOR.replace('toc', {
        filebrowserUploadUrl: 'ckeditor/ck_upload.php',
        filebrowserUploadMethod: 'form'
    });
    CKEDITOR.replace('tnf', {
        filebrowserUploadUrl: 'ckeditor/ck_upload.php',
        filebrowserUploadMethod: 'form'
    });
</script>
    </body>

</html>
