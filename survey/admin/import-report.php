<?php
require_once("classes/cls-report.php");
require_once("classes/cls-country.php");
require_once("classes/cls-state.php");
require_once("classes/cls-city.php");
require_once("classes/cls-category.php");
require_once("classes/cls-author.php");

$obj_report = new Report();
$obj_country = new Country();
$obj_state = new State();
$obj_city = new City();
$obj_category = new Category();
$obj_author = new Author();

if (!isset($_SESSION['ifg_admin']) && ($_SESSION['ifg_admin']['role'] != "superadmin" || $_SESSION['ifg_admin']['role'] != "admin")) {
    header("Location:login.php");
}
if (isset($_GET['report_id']) && $_GET['report_id'] != "") {
    $condition = "`report_id` = '" . base64_decode($_GET['report_id']) . "'";
    $report_details = $obj_report->getReportDetails('', $condition, '', '', 0);
    $report_detail = end($report_details);

    $condition = "`state_id` = '" . $report_detail['state_id'] . "'";
    $state_details = $obj_state->getStateDetails('', $condition, '', '', 0);
    $state_detail = end($state_details);

    $condition = "`city_id` = '" . $report_detail['city_id'] . "'";
    $city_details = $obj_city->getCityDetails('', $condition, '', '', 0);
    $city_detail = end($city_details);
}
$condition = "";
$country_details = $obj_country->getCountryDetails('', $condition, '', '', 0);

$category_details = $obj_category->getCategoryDetails('', $condition, '', '', 0);

$author_details = $obj_author->getAuthorDetails('', $condition, '', '', 0);

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
                        <h3 class="page-header text-primary"><i class="fa fa-user"></i> <?php echo (isset($_GET['report_id'])) ? "Edit" : "Add"; ?> Report</h3>
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li><a href="manage-report.php">Manage Report</a></li>
                            <li class="active"><?php echo (isset($_GET['report_id'])) ? "Edit" : "Add"; ?> Report</li>
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
                            <div class="panel-heading">
                                General Report Form
                            </div>
                            <div class="table-responsive">
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h2>PHP - File upload progress bar and percentage with jquery</h2>
                                            <div style="border: 1px solid #a1a1a1;text-align: center;width: 500px;padding:30px;margin:0px auto">


                                                <form action="import-report-action.php" enctype="multipart/form-data" class="form-horizontal" method="post">


                                                    <div class="preview"></div>
                                                    <div class="progress" style="display:none">
                                                        <div class="progress-bar" role="progressbar" aria-valuenow="0"
                                                             aria-valuemin="0" aria-valuemax="100" style="width:0%">
                                                            0%
                                                        </div>
                                                    </div>


                                                    <input type="file" id="csv_file" name="csv_file" required="required">
                                                    <button class="btn btn-primary upload-image">Upload Image</button>


                                                </form>
                                            </div>
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
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <?php include("footer.php"); ?>
    <script src="bower_components/jquery-validation/jquery.validate.js"></script>
    <script src="bower_components/jquery-validation/additional-methods.js"></script>
    <script src="js/add-report.js"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script> 
    <script>
        $(document).ready(function () {


            var progressbar = $('.progress-bar');


            $(".upload-image").click(function () {
                $(".form-horizontal").ajaxForm(
                        {
                            target: '.preview',
                            beforeSend: function () {
                                $(".progress").css("display", "block");
                                progressbar.width('0%');
                                progressbar.text('0%');
                            },
                            uploadProgress: function (event, position, total, percentComplete) {
                                progressbar.width(percentComplete + '%');
                                progressbar.text(percentComplete + '%');
                            },
                        })
                        .submit();
            });


        });
    </script>

</body>

</html>
