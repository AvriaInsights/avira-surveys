<?php
$pageurl=$_SERVER['REQUEST_URI'];
$explodepgname=explode("/Avira-Leads/",$pageurl);
$pagename=$explodepgname[1];

//print_r($_SESSION);die();
$userrole=$_SESSION['ifg_admin']['role'];
?> 
<!-- Box icon CSS   -->
<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
<!-- End -->
<div class="sidebar">
    <div class="logo-details">
      <!--<i class='bx bxl-bitcoin'></i>-->
      <a href="<?php echo SITEADMIN;?>dashboard"><img src="images/Avira_Favicon_W.svg" class="img-fluid top-left-icon small-icon mt-3" id="favimg"></a>
      <span class="logo_name" id="bigimg">
          <a href="<?php echo SITEADMIN;?>dashboard"><img src="images/AviraLead_light_logo.svg" class="img-fluid c_logo"></a>
      </span>
    </div>
    <ul class="nav-links">
      <li <?php if($pagename=="dashboard"){?> class="sidebar-active" <?php }?>>
        <a href="<?php echo SITEADMIN; ?>dashboard">
          <i class='icon-Dashboard' ></i>
          <span class="link_name">Dashboard</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="<?php echo SITEADMIN;?>dashboard">Dashboard</a></li>
        </ul>
      </li>
      <li <?php if($pagename=="fresh-leads" || $pagename=="assign-leads"){?> class="sidebar-active" <?php }?>>
        <div class="icon-links">
          <a href="#">
            <i class='icon-Lead-Box'></i>
            <span class="link_name">Lead Box</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Lead Box</a></li>
          <?php if($userrole=="superadmin"){?>
          <li <?php if($pagename=="fresh-leads"){?> class="sidebar-active" <?php }?>><a href="<?php echo SITEADMIN; ?>fresh-leads">Fresh Leads</a></li>
          <?php }?>
          <li <?php if($pagename=="assign-leads"){?> class="sidebar-active" <?php }?>><a href="<?php echo SITEADMIN; ?>assign-leads">Assigned Leads</a></li>
        </ul>
      </li>
      
      <li <?php if($pagename=="research-fresh-leads" || $pagename=="research-assign-leads"){?> class="sidebar-active" <?php }?>>
        <div class="icon-links">
          <a href="#">
            <i class='icon-Lead-Box'></i>
            <span class="link_name">Research Lead Box</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Research Lead Box</a></li>
          <?php if($userrole=="superadmin"){?>
          <li <?php if($pagename=="research-fresh-leads"){?> class="sidebar-active" <?php }?>><a href="<?php echo SITEADMIN; ?>research-fresh-leads">Research Fresh Leads</a></li>
          <?php }?>
          <li <?php if($pagename=="research-assign-leads"){?> class="sidebar-active" <?php }?>><a href="<?php echo SITEADMIN; ?>research-assign-leads">Research Assigned Leads</a></li>
        </ul>
      </li>
      
      <li <?php if($pagename=="reports"){?> class="sidebar-active" <?php }?>>
        <a href="<?php echo SITEADMIN; ?>reports">
          <i class='icon-Report'></i>
          <span class="link_name">Report</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="<?php echo SITEADMIN; ?>reports">Report</a></li>
        </ul>
      </li>
      <li <?php if($pagename=="all-task"){?> class="sidebar-active" <?php }?>>
        <a href="<?php echo SITEADMIN; ?>all-task">
          <i class='icon-All-Task'></i>
          <span class="link_name">All Task</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="<?php echo SITEADMIN; ?>all-task">All Task</a></li>
        </ul>
      </li>
      <?php if($userrole=="superadmin"){?> 
      <li <?php if($pagename=="campaign-listing" || $pagename=="add-campaign"){?> class="sidebar-active" <?php }?>>
        <a href="<?php echo SITEADMIN; ?>campaign-listing">
          <i class='icon-Manage-Campaign'></i>
          <span class="link_name">Manage Campaign</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="<?php echo SITEADMIN; ?>campaign-listing">Manage Campaign</a></li>
        </ul>
      </li>
    <?php } ?>
     <?php if($userrole!="superadmin"){?> 
      <li <?php if($pagename=="user-campaign"){?> class="sidebar-active" <?php }?>>
        <a href="<?php echo SITEADMIN; ?>user-campaign">
          <i class='icon-Manage-Campaign'></i>
          <span class="link_name">Manage Campaign</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="<?php echo SITEADMIN; ?>user-campaign">Manage Campaign</a></li>
        </ul>
      </li>
    <?php } ?>
      <?php if($userrole=="superadmin"){?>
      <li <?php if($pagename=="manage-user" || $pagename=="add-user"){?> class="sidebar-active" <?php }?>>
        <a href="<?php echo SITEADMIN; ?>manage-user">
          <i class='icon-Manage-User'></i>
          <span class="link_name">Manage User</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="<?php echo SITEADMIN; ?>manage-user">Manage User</a></li>
        </ul>
      </li>
      <?php }?>
       <li <?php if($pagename=="support-box"){?> class="sidebar-active" <?php }?>>
        <a href="<?php echo SITEADMIN; ?>support-box">
          <i class='icon-Support-Box'></i>
          <span class="link_name">Support Box</span>
        </a>
        <ul class="sub-menu blank">
          <li <?php if($pagename=="support-box"){?> class="sidebar-active" <?php }?>><a class="link_name" href="<?php echo SITEADMIN; ?>support-box">Support Box</a></li>
        </ul>
      </li>
      <li>
        <a href="<?php echo SITEADMIN; ?>logout.php">
          <i class='fa fa-sign-out '></i>
          <span class="link_name">Logout</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="<?php echo SITEADMIN; ?>logout.php">Logout</a></li>
        </ul>
      </li>
    
    </ul>
  </div>
<?php include('footer.php')?>