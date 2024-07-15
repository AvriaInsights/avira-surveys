<?php 
require_once("classes/cls-request.php");
$obj_request = new Request();
if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login");
}

?>
<?php include('dashboard-header-menu.php')?>
<div class="wrapper">
        <section class="space-padding-top">
            <?php include("build-survey-category.php");?>
        </section>
        
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Survey Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Blank/Classic Survey</button>
                <button type="button" class="btn btn-primary">Template Survey</button>
              </div>
            </div>
          </div>
        </div>

        <div class="container-fluid">
          <div class="row">
              <div class="col-md-6">
                  <!--<div id="chartContainer" class="chart-tt" style="height: 370px; width: 100%;"></div>-->
                  <div id="chartContainer" style=""></div>
              </div>
              <div class="col-md-6"></div>
          </div>
        </div>
       
   </div>
   
<?php include("footer.php")?>

<script>
//     $(document).ready(function(){
//       $('.wrapper').addClass("toggled"); 
//     });
// </script>