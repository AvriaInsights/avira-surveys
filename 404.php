<?php
$page = "404";
$page_title = "404";
$meta_title = "";
$meta_description = "";
$meta_keywords = "";
$follow = FALSE;
include("common-header.php"); 
?>
<div id="all" class="notfount-pg">
    <div id="content">
        <div class="container">
            <div class="row">
                  <div class="col-md-12">
                <div class="text-end">
                    <img src="<?php echo SITEPATHFRONT;?>images/pattern-top.png" class="img-fluid pattern-img-right">
                </div>
            </div>
                <div class="col-md-6 offset-md-3">
                    <div class="text-center mt-5 mb-5" id="text-page">
                        <p><img src="<?php echo SITEPATHFRONT;?>images/404_page.png" class="w-100"></p>
                    </div>
                </div>
                <!-- /.col-md-12 -->
                <div class="col-md-12">
                    <div class="">
                        <img src="<?php echo SITEPATHFRONT;?>images/pattern-bottom.png" class="img-fluid pattern-bottom-img">
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container -->
    </div>
    <!-- /#content -->
</div>
<!-- /#all -->
<?php include('footer.php'); ?>