<?php include('common-header.php'); ?>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Launch static backdrop modal
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog new-survey-popup modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body ps-0">
          <div class="row">
              <div class="col-md-3 pe-0 border-end">
                  <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link active" id="v-pills-manual-tab" data-bs-toggle="pill" data-bs-target="#v-pills-manual" 
                    type="button" role="tab" aria-controls="v-pills-manual" aria-selected="true">
                        <i class="fa fa-folder"></i>Manual</button>
                    <button class="nav-link" id="v-pills-bulk-upload-tab" data-bs-toggle="pill" data-bs-target="#v-pills-bulk-upload" type="button" 
                    role="tab" aria-controls="v-pills-bulk-upload" aria-selected="false">
                        <i class="fa fa-upload"></i>
                        Bulk Upload</button>
                    <button class="nav-link" id="v-pills-copy-paste-tab" data-bs-toggle="pill" data-bs-target="#v-pills-copy-paste" type="button" 
                    role="tab" aria-controls="v-pills-copy-paste" aria-selected="false">
                        <i class="fa fa-copy"></i>Copy Paste</button>
                    <button class="nav-link" id="v-pills-analyst-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" 
                    role="tab" aria-controls="v-pills-messages" aria-selected="false">
                        <i class="fa fa-file"></i>Analyst
                    </button>
                   
                  </div>
              </div>
              <div class="col-md-9 ps-0">
                  <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-manual" role="tabpanel" aria-labelledby="v-pills-manual-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="tab-details-content">
                                    <h2 class="text-center">Manual Survey</h2>
                                    <img src="images/survey-bg.jpg" class="img-fluid" >
                                    <div class="survey-cta-btn text-center">
                                        <a href="#" class="start-survey-btn">Start Survey</a>
                                        <p class="mb-0">Or</p>
                                        <a href="#" class="browse-btn">Browse Templates</a>
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
                                    <img src="images/survey-bg.jpg" class="img-fluid" >
                                    <div class="survey-cta-btn text-center">
                                        <a href="#" class="start-survey-btn">Start Survey</a>
                                        <p class="mb-0">Or</p>
                                        <a href="#" class="browse-btn">Browse Templates</a>
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
                                    <img src="images/survey-bg.jpg" class="img-fluid" >
                                    <div class="survey-cta-btn text-center">
                                        <a href="#" class="start-survey-btn">Start Survey</a>
                                        <p class="mb-0">Or</p>
                                        <a href="#" class="browse-btn">Browse Templates</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-analyst" role="tabpanel" aria-labelledby="v-pills-analyst-tab">
                         <div class="row">
                            <div class="col-md-12">
                                <div class="tab-details-content">
                                    <h2 class="text-center">Analyst</h2>
                                    <img src="images/survey-bg.jpg" class="img-fluid" >
                                    <div class="survey-cta-btn text-center">
                                        <a href="#" class="start-survey-btn">Start Survey</a>
                                        <p class="mb-0">Or</p>
                                        <a href="#" class="browse-btn">Browse Templates</a>
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



<?php include("footer.php");?>