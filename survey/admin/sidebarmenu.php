<?php //print_r($_SERVER);
$pageurl=$_SERVER['REQUEST_URI'];
$explodepgname=explode("/admin/",$pageurl);
$pagename=$explodepgname[1];
?> 
   <aside class="sidebar-wrapper">
        <div class="sidebar-brand">
          <h2>Leads Junction</h2>
        </div>
        <ul class="sidebar-nav">
      
      <li <?php if($pagename=="index.php"){?> class="active" <?php }?>>
        <a href="index.php">
            <i class="fa fa-home left-side-menu-icon"></i>Dashboard</a>
      </li>
      <li <?php if($pagename=="manage-request.php"){?> class="active" <?php }?>>
        <a href="manage-request.php">
            <i class="fa fa-plug left-side-menu-icon"></i>Lead Box</a>
      </li>
      <li>
        <a href="#" data-bs-toggle="collapse" data-bs-target="#components-collapse" aria-expanded="true" aria-current="true">
            <i class="fa fa-user left-side-menu-icon"></i>Resources
            <i class="fa fa-chevron-right next-arrow"></i>
        </a>
        <ul class="list-unstyled collapse submenu" id="components-collapse">
            <li>
                <a href="#">Lead Dashboard</a>
            </li>
            <li>
                <a href="#">Marketing Report</a>
            </li>
            <li>
                <a href="#">Productivity Report </a>
            </li>
        </ul>
      </li>
      <li>
        <a href="#" data-bs-toggle="collapse" data-bs-target="#components-collapse1" <?php if($pagename=="manage-admin.php" || $pagename=="add-admin.php"){?>aria-expanded="true" <?php }?>  aria-current="true">
            <i class="fa fa-user left-side-menu-icon"></i>Manage Admin
            <i class="fa fa-chevron-right next-arrow"></i>
        </a>
        <ul <?php if($pagename=="manage-admin.php" || $pagename=="add-admin.php"){?> class="list-unstyled collapse submenu show" <?php } else {?> class="list-unstyled collapse submenu"<?php }?>id="components-collapse1">
            <li <?php if($pagename=="manage-admin.php"){?> class="subactive" <?php }?>>
                <a href="manage-admin.php">Manage Admin</a>
            </li>
            <li <?php if($pagename=="add-admin.php"){?> class="subactive" <?php }?>>
                <a href="add-admin.php">Add Admin</a>
            </li>
        </ul>
      </li>
    </ul>
    </aside>
   