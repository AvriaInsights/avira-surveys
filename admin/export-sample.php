<?php
require_once("classes/cls-report.php");
require_once("classes/cls-category.php");

$obj_report = new Report();
$obj_category = new Category();

$condition = "status = 'Active'";
$category_details = $obj_category->getCategoryDetails('', $condition, '', '', 0);
$price_details=$obj_report->getCatReportDetails('DISTINCT price',"",'','',0);
if (!isset($_SESSION['ifg_admin']) && ($_SESSION['ifg_admin']['role'] != "superadmin" || $_SESSION['ifg_admin']['role'] != "admin")) {
    header("Location:login.php");
}
include("header.php");
?>
<style>
.custom-panel-control{
    color:#000 !important;
}
.custom-panel-label{
    padding-right:15px;
}
</style>

<body>

    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <?php include("top-bar.php"); ?>
            <!-- /.navbar-top-links -->

            <?php include("side-bar.php"); ?>
            <!-- /.navbar-static-side -->
        </nav>
    </div>
    <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header text-primary"><i class="fa fa-th-list"></i>Manage Export request</h3>
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li> <a href="manage-request.php">Manage Request</a></li>
                            <li class="active">Export Request</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <span class="pull-left">Export Request Details</span>
                                <div class="clearfix"></div>
                                <div class="clearfix"></div>
                            </div>
                <div class="table-responsive">
                                <!-- /.panel-heading -->
                        <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <!-- /.panel-heading -->
                                <form role="form" method="POST" action="export-sample-request.php" enctype="multipart/form-data" name="export-request-form" id="export-request-form">
                                       <div class="analyst-form">
                                        <!--    <div class="form-group" >
                                               <label for="e_price">Price</label>
                                                      <select class="form-control" id="e_price" name="e_price">
                                                      <option value="all">All Price</option>
                                                         <?php foreach ($price_details as $price_detail) { ?>
                                                            <option value="<?php echo ($price_detail['price']); ?>"><?php echo $price_detail['price']; ?></option>
                                                        <?php } ?> 
                                                     </select>
                                            </div>
                                           
                                            <div class="form-group">
                                               <label for="e_category">Category</label>
                                                      <select class="form-control" id="e_category" name="e_category[]" multiple="multiple">
                                                      <option value="all" selected="selected" >All Categories</option>
                                                        <?php foreach ($category_details as $category_detail) { ?>
                                                            <option value="<?php echo strtolower($category_detail['shortcode']); ?>"><?php echo $category_detail['title']; ?></option>
                                                        <?php } ?>
                                                     </select>
                                            </div>
                                        -->     
                                            <div class="form-group">
                                                <label>From Date <span class="error"></span></label>
                                                <input type="text" class="form-control custom-panel-control" name="e_fromdate" id="e_fromdate" placeholder="From Date" value="">      
                                            </div>
                                            <div class="form-group">
                                               <label>To Date <span class="error"></span></label>
                                               <input type="text" class="form-control custom-panel-control" name="e_todate" id="e_todate" placeholder="To Date" value="">      
                                            </div>
                                        <!--    <div class="form-group">
                                               <label for="e_range">Range</label>
                                                <select class="form-control" id="e_range" name="e_range">
                                                <option value="all">All Range</option>
                                                <option value="0-500">0 - 500</option>
                                                <option value="501-1000">501 - 1000</option>
                                                <option value="1001-1500">1001 - 1500</option>
                                                <option value="1501-2000">1501 - 2000</option>
                                                <option value="2001-2500">2000 - 2500</option>
                                                <option value="2501-3000">2500 - 3000</option>
                                                </select>  
                                            </div>
                                            <div Id="status-div" class="form-group">
                                            <label>Report Headers</label></br>
                                            <label class="custom-panel-label"><input type="checkbox" name="e_headerCheck_list[]" value="description"> Description </label>
                                            <label class="custom-panel-label"><input type="checkbox" name="e_headerCheck_list[]" value="toc"> TOC </label>
                                            <label class="custom-panel-label"><input type="checkbox" name="e_headerCheck_list[]" value="tnf"> TNF </label>
                                            <label class="custom-panel-label"><input type="checkbox" name="e_headerCheck_list[]" value="url_keywords"> Keywords </label>
                                            <label class="custom-panel-label"><input type="checkbox" name="e_headerCheck_list[]" value="price"> Single User Price </label>
                                            <label class="custom-panel-label"><input type="checkbox" name="e_headerCheck_list[]" value="eprice"> Enterprise User Price </label>
                                            </div>
                                        -->    
                                            <hr>
                                                <button type="submit" class="btn btn-default">Submit</button>
                                                <button type="reset" class="btn btn-default">Reset</button>
                                        </div>
                                </form> 
                            </div> 
                        </div>
                    </div>
                </div>
            </div>          
            </div>
        </div>    
    </div> 
</div>
    <?php include("footer.php"); ?>
    <script src="bower_components/jquery-validation/jquery.validate.js"></script>
    <script src="bower_components/jquery-validation/additional-methods.js"></script>
    <script src="js/export-report.js"></script>
</body>
</html>                