<?php 
require_once("classes/cls-request.php");
require_once("classes/cls-template.php");

$obj_request = new Request();
$obj_template= new Template();

if (!isset($_SESSION['ifg_admin'])) {
//if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}
    
if (isset($_GET['template_id']) && $_GET['template_id'] != "") {
    $condition = "`template_id` = '" . base64_decode($_GET['template_id']) . "'";
    $template_details = $obj_template->getTemplateDetail('', $condition, '', '', 0);
    $template_detail = end($template_details);
} else {
    $template_detail['status'] = "";
}
$fields = "template_id, category_id, template_name, image_url, status";
$condition = "";
$template_details = $obj_template->getTemplateDetail($fields, $condition, '', '', 0);
$template_info = array();
// print_r($template_details);exit;
?>
 <?php include("dashboard-header-menu.php")?>
 <?php include("sidebarmenu.php")?>
<style>
   .template-list .centered-text {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
.template-title .card-text{
    font-size:14px; 
    color:black
    text-align:center;
}
</style>

<div class="wrapper">
        <!--<section class="content-wrapper">-->
        <!--    <div class="container">-->
        <!--        <div id="Template-List" class="row justify-content-around">-->
        <!--             <?php foreach ($template_details as $template_detail) { ?>-->
        <!--                <div class="col-md-4">-->
        <!--                    <div class="card" style="width: 28rem;">-->
        <!--                      <a href="preview-template.php?id=<?php echo base64_encode($template_detail['template_id']); ?>" >-->
        <!--                          <img src="<?php echo $template_detail['image_url']?>" class="card-img-top" alt="...">-->
        <!--                          <div class="card-body">-->
        <!--                            <p class="card-text" style="font-size:15px; color:black"><?php echo $template_detail['template_name'];?></p>-->
        <!--                          </div>-->
        <!--                      </a>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            <?php } ?>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</section>-->
        
        <section class="space-padding-top">
            <div class="container-fluid pse-2">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="sm-menu-question-header">
                            <strong>Template List</strong>
                        </h3>
                    </div>
                </div>
                
                <div class="row pt-4">
                    <div class="col-md-12">
                        <div id="Template-List" class="row justify-content-around">
                            <?php foreach ($template_details as $template_detail) { ?>
                                <div class="col-md-4">
                                    <div class="card">
                                      <a href="<?php echo SITEPATH; ?>preview-template/<?php echo base64_encode($template_detail['template_id']); ?>" >
                                          <img src="<?php echo SITEPATH; ?><?php echo $template_detail['image_url']?>" class="card-img-top" alt="...">
                                          <div class="card-body template-title">
                                            <p class="card-text"><?php echo $template_detail['template_name'];?></p>
                                          </div>
                                      </a>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
</div>

<?php include("footer.php"); ?>

<script>
    $(document).ready(function(){
       $('.wrapper').addClass("toggled"); 
    });
</script>