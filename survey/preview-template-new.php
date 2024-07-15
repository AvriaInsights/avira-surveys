<?php 
require_once("classes/cls-request.php");
require_once("classes/cls-template.php");

$obj_request = new Request();
$obj_template= new Template();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}

if(isset($_GET['id'])){
    $fields = "template_id, category_id, template_name, image_url, status";
    $condition = "`template_id` = '" . base64_decode($_GET['id']) . "'";
    $template_details = $obj_template->getTemplateDetail($fields, $condition, '', '', 0);
    print_r($template_details);exit();
}else{
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
?>
<style>
.a{
    margin-bottom: 16px;
    color: #63686F;
}
</style>
<div class="wrapper">
   <?php include("sidebarmenu.php")?>
        <?php include("header.php")?>
        <section class="content-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-sm-9 bg-light p-3 border">
                    </div>
                    
                    
                    <div class="col-sm-3 bg-light p-3 border">
                         <?php foreach ($template_details as $template_detail) { ?>
                        <div class="back-cursor">
                            <div class="back-cusor-link">
                                <a href="template-list.php"style="color:black"><i class="fa fa-arrow-left" aria-hidden="true"></i>  back to template</a>
                            </div>
                            <h4><strong><?php echo $template_detail['template_name'];?></strong></h4>
                            <p>Find out the views of your customers with this Customer Satisfaction Survey.</p>
                        </div>
                        <?php } ?>
                        <div class="view-button-template">
                            <a class="btn btn-outline-primary" href="edit-template.php?id=<?php echo $_GET['id']; ?>">Choose Template </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
</div>

<?php include("footer.php")?>