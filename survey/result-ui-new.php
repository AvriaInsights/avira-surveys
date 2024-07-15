<?php 
require_once("classes/cls-survey.php");

$obj_survey = new Survey();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login");
}

$userid=$_SESSION['ifg_admin']['client_id'];

if(isset($_GET['surveyid']))
{
    $surveyid=$_GET['surveyid'];
}
else
{
    $surveyid="";
}
?>
<style>
.new-survey-popup .nav-pills .nav-link {
    text-align: left;
    padding: 3rem 1rem;
    font-size: 1.7rem;
    display: flex;
    align-items: center;
    border-bottom: 0.1rem solid #e0e0e0;
    border-radius: 0;
    color: #676767;
}
.nav-pills .nav-link {
    background: 0 0;
    border: 0;
    border-radius: 0.25rem;
    height: 5rem;
    font-size:1.7rem;
    text-align: left;
}
.active-tab {
    width: 100%;
    text-align: left;
    font-size:1.7rem;
}
.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    color: #0d6efd !important;
    background-color: #fff !important;
}
.new-survey-popup .nav-pills .nav-link.active i {
    font-size: 2.2rem;
    padding-right: 1.3rem;
    color: #aabdc8;
}
.tab-details-content{
    background-color:#fff;
    
}
</style>


<?php include('dashboard-header-menu.php')?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <?php include('dashboard-side-menubar.php')?>
        </div>
        <div class="col-md-9">
            <section class="content-wrapper">
                <div class="container-fluid">
                     <div class="row">
                        <!-- Modal -->
                        <div class="new-survey-popup" id="">
                              <div class="ps-0">
                                  <div class="row">
                                      <div class="col-md-4 pe-0 border-end">
                                          <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                            <button class="nav-link active active-tab" id="v-pills-manual-tab" data-bs-toggle="pill" data-bs-target="#v-pills-manual1" 
                                            type="button" role="tab" aria-controls="v-pills-manual" aria-selected="true">
                                                <i class="fa fa-folder"></i>Start Manual</button>
                                            <button class="nav-link" id="v-pills-analyst-tab" data-bs-toggle="pill" data-bs-target="#v-pills-analyst1" type="button" 
                                            role="tab" aria-controls="v-pills-analyst" aria-selected="false">
                                                <i class="fa fa-file"></i>Send to Analyst
                                            </button>
                                          </div>
                                      </div>
                                      <div class="col-md-8 ps-0">
                                          <div class="tab-content" id="v-pills-tabContent">
                                            <div class="tab-pane fade show active" id="v-pills-manual1" role="tabpanel" aria-labelledby="v-pills-manual-tab">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="tab-details-content">
                                                            <h2 class="text-center">Manual Survey</h2>
                                                            <img src="<?php echo SITEPATH; ?>images/Manual.png" class="img-fluid" >
                                                            <div class="survey-cta-btn text-center">
                                                                <a href="<?php echo SITEPATH;?>add-survey" class="start-survey-btn">Start Survey</a>
                                                                <p class="mb-0">Or</p>
                                                                <a href="<?php echo SITEPATH;?>template-list" class="browse-btn">Browse Templates</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-bulk-upload" role="tabpanel" aria-labelledby="v-pills-bulk-upload-tab">
                                                 <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="tab-details-content">
                                                            <h2 class="text-center">Bulk Upload</h2>
                                                            <img src="<?php echo SITEPATH; ?>images/bulk upload.png" class="img-fluid" >
                                                            <div class="survey-cta-btn text-center">
                                                                <a href="<?php echo SITEPATH;?>bulk-survey.php" class="start-survey-btn">Bulk Upload</a>
                                                                <!--<p class="mb-0">Or</p>-->
                                                                <!--<a href="#" class="browse-btn">Browse Templates</a>-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-copy-paste" role="tabpanel" aria-labelledby="v-pills-copy-paste-tab">
                                                 <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="tab-details-content">
                                                            <h2 class="text-center">Copy Paste</h2>
                                                            <img src="<?php echo SITEPATH; ?>images/Copy Paste.png" class="img-fluid" >
                                                            <div class="survey-cta-btn text-center">
                                                                <a href="<?php echo SITEPATH;?>copy-paste-survey.php" class="start-survey-btn">Copy Paste</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-analyst1" role="tabpanel" aria-labelledby="v-pills-analyst-tab">
                                                 <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="tab-details-content">
                                                            <h2 class="text-center">Analyst</h2>
                                                            <img src="<?php echo SITEPATH; ?>images/Analyst.png" class="img-fluid" >
                                                            <div class="survey-cta-btn text-center">
                                                                <a href="<?php echo SITEPATH;?>build-with-analyst.php" class="start-survey-btn">Build With Analyst</a>
                                                                <!--<p class="mb-0">Or</p>-->
                                                                <!--<a href="#" class="browse-btn">Browse Templates</a>-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                      </div>
                                  </div>
                          </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>