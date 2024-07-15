<?php
require_once("classes/cls-menu.php");
$obj_menu = new Menu();

$fields = "*";
$condition = "(`status` = 'Active') and (`parent_menu_id`='' or `parent_menu_id` IS NULL)";
$menu_details = $obj_menu->getMenuDetails($fields, $condition, '', '', 0);

//print_r($_SERVER);
$pageurl=$_SERVER['SCRIPT_URL'];
$explodepgname=explode("/crm/",$pageurl);
//$pagename=trim($explodepgname[1],".php");
//$pg1=ucwords(str_replace("-", " ",$pagename));
$pagenameclass="nav-links-".$explodepgname[1];
//print_r($_SESSION);die();


$userrole=$_SESSION['ifg_admin']['role'];
//print_r($_SESSION);
if($userrole!="superadmin")
{
    $condition_admin3 = "`status` = 'Active' and admin_id='".$_SESSION['ifg_admin']['admin_id']."'";
    $admin_details3 = $obj_menu->getAdminDetails($fields, $condition_admin3, '', '', 0);
    foreach($admin_details3 as $admin_detail3){
        $menuid12 = $admin_detail3['menu_id'];
        $submenu12 = $admin_detail3['sub_menu_id'];
    }
    //echo $menuid12;
    $mainmenu = explode(",",$menuid12);
    $submenu = explode(",",$submenu12);
    
}
//print_r($mainmenu12);die();
?>
<!-- Box icon CSS   -->
<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
<!-- End -->
<div class="sidebar">
    <div class="logo-details">
      <!--<i class='bx bxl-bitcoin'></i>-->
      <a href="<?php echo SITEADMIN;?>dashboard"><img src="images/Precedence_Favicon_W.png" class="img-fluid top-left-icon small-icon mt-3" id="favimg"></a>
      <span class="logo_name" id="bigimg">
          <a href="<?php echo SITEADMIN;?>dashboard"><img src="images/Precedence_Favicon_W.png" class="img-fluid c_logo"></a>
      </span>
    </div>
    <ul class="nav-links">
        <?php if($userrole=="superadmin"){?>
        <?php foreach($menu_details as $menu_detail){?>
        <?php
                $fields1 = "*";
                $condition1 = "`status` = 'Active' and `parent_menu_id`='".$menu_detail['menu_id']."'";
                $sub_menu_details = $obj_menu->getMenuDetails($fields1, $condition1, '', '', 0);
        ?>
        <li id="nav-links-<?php echo trim($menu_detail['menu_htaccess_url']);?>" class="showMenu">
            <div class="icon-links">
              <a <?php if(empty($sub_menu_details)) { ?> href="<?php echo SITEADMIN.$menu_detail['menu_htaccess_url'];?>" <?php }?>>
                <i class='icon-<?php echo str_replace(" ", "-",ucfirst(trim($menu_detail['menu_name'])));?>'></i>
                <span class="link_name"><?php echo $menu_detail['menu_name'];?></span>
              </a>
              
              <?php if(isset($sub_menu_details)&&!empty($sub_menu_details)) { ?>
              <i class='bx bxs-chevron-down arrow'></i>
              <?php }?>
            </div>
            <?php if(isset($sub_menu_details)&&!empty($sub_menu_details)) { ?>
            <ul class="sub-menu">
              <li><a class="link_name" href="#"><?php echo $menu_detail['menu_name'];?></a></li>
              <?php foreach($sub_menu_details as $sub_menu_detail){?>
              <li id="nav-links-<?php echo trim($sub_menu_detail['menu_htaccess_url']);?>"><a href="<?php echo SITEADMIN.$sub_menu_detail['menu_htaccess_url'];?>" onclick="setsubmenu();"><?php echo $sub_menu_detail['menu_name'];?></a></li>
              <?php }?>
            </ul>
            <?php }?>
        </li>
        <?php }?>
        <?php } else {?>
        <?php foreach($menu_details as $menu_detail){?>
        <?php
                $fields1 = "*";
                $condition1 = "`status` = 'Active' and `parent_menu_id`='".$menu_detail['menu_id']."'";
                $sub_menu_details = $obj_menu->getMenuDetails($fields1, $condition1, '', '', 0);
                // echo $menu_detail['menu_id'];
                // print_r($mainmenu);
                if(in_array($menu_detail['menu_id'],$mainmenu))
                {
        ?>
        <li id="nav-links-<?php echo trim($menu_detail['menu_htaccess_url']);?>" class="showMenu">
            <div class="icon-links">
              <a <?php if(empty($sub_menu_details)) { ?> href="<?php echo SITEADMIN.$menu_detail['menu_htaccess_url'];?>" <?php }?>>
                <i class='icon-<?php echo str_replace(" ", "-",ucfirst(trim($menu_detail['menu_name'])));?>'></i>
                <span class="link_name"><?php echo $menu_detail['menu_name'];?></span>
              </a>
              
              <?php if(isset($sub_menu_details)&&!empty($sub_menu_details)) { ?>
              <i class='bx bxs-chevron-down arrow'></i>
              <?php }?>
            </div>
            <?php if(isset($sub_menu_details)&&!empty($sub_menu_details)) { ?>
            <ul class="sub-menu">
              <li><a class="link_name" href="#"><?php echo $menu_detail['menu_name'];?></a></li>
              <?php foreach($sub_menu_details as $sub_menu_detail){ if(in_array($sub_menu_detail['menu_id'],$submenu))
                {?>
              <li id="nav-links-<?php echo trim($sub_menu_detail['menu_htaccess_url']);?>"><a href="<?php echo SITEADMIN.$sub_menu_detail['menu_htaccess_url'];?>" onclick="setsubmenu();"><?php echo $sub_menu_detail['menu_name'];?></a></li>
              <?php } }?>
            </ul>
            <?php }?>
        </li>
        <?php } }?>
        <?php }?>
        <li>
            <a href="<?php echo SITEADMIN; ?>logout.php">
              <i class='fa fa-sign-out '></i>
              <span class="link_name">Logout</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="<?php echo SITEADMIN; ?>logout.php">Logout</a></li>
            </ul>
      ``</li>
    </ul>
    
   
  </div>

<?php include('footer.php')?>
<script>
$(document).ready(function(){
   var pg = '<?php echo $pagenameclass;?>';
   //alert(pg);
   $("#"+pg).addClass("sidebar-active");
  ar parentTag = $("#"+pg).parent().parent().get(0).tagName;
   //alert(parentTag);
 if(parentTag=="LI")
 {
     var parentparentid=$("#"+pg).parent().parent().get(0).id;
     $("#"+parentparentid).addClass("sidebar-active showMenu");
  
});
</script>
