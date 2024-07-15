
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-popup-main ask-analyst-popup-modal" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Start a Classic Survey</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0">
          
            <form class="bg-gray p-5 p-7 report-form contact-form" id="request-form" action="<?php echo SITEPATH; ?>key-report-popup-action.php" method="post">
                        
                        <div class="row">
                          <div class="form-group col-md-6">
                            <label>Full Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="fname" required="">
                          </div>
                          
                          
                          <div class="form-group col-md-12">
                                <label>Message</label>
                               <textarea class="form-control message-box-ht" id="message" name="message"></textarea>
                          </div>
                           
                                      
                          <div class="col-md-12 btn-pad1 text-center" style="padding-top:20px;">
                               <button type="submit" class="btn sample-report-btn-1" id="request-btn" id="contact-btn">Submit</button>
                          </div>
                            
                            
                            <div id="response"></div>
                      </div>
                      
                    </form>
      </div>
     </div>
  </div>
</div>

  
<script type="text/javascript" src="<?php echo SITEPATH; ?>js/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
