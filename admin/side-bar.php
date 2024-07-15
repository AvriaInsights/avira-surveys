
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="text-left">
                    <h5><i class="fa fa-owner"></i> <strong><?php echo isset($_SESSION['ifg_admin']['fname']) ? $_SESSION['ifg_admin']['fname'] . ' ' . $_SESSION['ifg_admin']['lname'] : "Admin"; ?></strong></h5>
                </div>
            </li>
            <?php if (isset($_SESSION['ifg_admin'])) { ?>
                <?php if($_SESSION['ifg_admin']['role'] == "superadmin") { ?>
                    <li> <a href="#"><i class="fa fa-user fa-fw"></i> Manage User<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="manage-user.php"><i class="fa fa-th-list"></i> Manage User</a> </li>
                            <li> <a href="add-user.php"><i class="fa fa-user"></i> Add User</a> </li>
                        </ul>
                    </li>
                    <li> <a href="#"><i class="fa fa-th-list fa-fw"></i> Manage Category<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="manage-category.php"><i class="fa fa-th-list"></i> Manage Category</a> </li>
                            <li> <a href="add-category.php"><i class="fa fa-th-list"></i> Add Category</a> </li>
                        </ul>
                    </li>
                    <li> <a href="#"><i class="fa fa-user fa-fw"></i> Manage Author<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="manage-author.php"><i class="fa fa-th-list"></i> Manage Author</a> </li>
                            <li> <a href="add-author.php"><i class="fa fa-user"></i> Add Author</a> </li>
                        </ul>
                    </li>
                    <li> <a href="#"><i class="fa fa-flag fa-fw"></i> Manage Country<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="manage-country.php"><i class="fa fa-th-list"></i> Manage Country</a> </li>
                            <li> <a href="add-country.php"><i class="fa fa-user"></i> Add Country</a> </li>
                        </ul>
                    </li>
                    <li> <a href="#"><i class="fa fa-flag fa-fw"></i> Manage State<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="manage-state.php"><i class="fa fa-th-list"></i> Manage State</a> </li>
                            <li> <a href="add-state.php"><i class="fa fa-user"></i> Add State</a> </li>
                        </ul>
                    </li>
                    <li> <a href="#"><i class="fa fa-flag fa-fw"></i> Manage City<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="manage-city.php"><i class="fa fa-th-list"></i> Manage City</a> </li>
                            <li> <a href="add-city.php"><i class="fa fa-user"></i> Add City</a> </li>
                        </ul>
                    </li>
                    <li> <a href="#"><i class="fa fa-envelope fa-fw"></i> Manage Queries<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="manage-request.php"><i class="fa fa-th-list"></i> Manage Sample Request</a> </li>
                            <li> <a href="manage-enquiry.php"><i class="fa fa-th-list"></i> Manage Enquiry/Question</a> </li>
                            <li> <a href="manage-discount.php"><i class="fa fa-th-list"></i> Manage Customization</a> </li>
                        </ul>
                    </li>
                    <li> <a href="#"><i class="fa fa-shopping-cart fa-fw"></i> Manage Order<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="manage-order.php"><i class="fa fa-th-list"></i> Manage Order</a> </li>
                        </ul>
                    </li>
                    <li> <a href="#"><i class="fa fa-edit fa-fw"></i> Manage Report<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="manage-report.php"><i class="fa fa-th-list"></i> Manage Report</a> </li>
                             <li> <a href="bulk-report.php"><i class="fa fa-edit"></i> Bulk upload</a> </li>
                            <li> <a href="add-report.php"><i class="fa fa-edit"></i> Add Report</a> </li>
                        </ul>
                    </li>
                    <li> <a href="#"><i class="fa fa-edit fa-fw"></i> Manage White Paper<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="manage-white-paper.php"><i class="fa fa-th-list"></i> Manage Report</a> </li>
                             <li> <a href="bulk-white-paper.php"><i class="fa fa-edit"></i> Bulk upload</a> </li>
                            <li> <a href="add-white-paper.php"><i class="fa fa-edit"></i> Add White paper</a> </li>
                        </ul>
                    </li>
                    <li> <a href="#"><i class="fa fa-edit fa-fw"></i> Manage Company Profile<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="manage-company.php"><i class="fa fa-th-list"></i> Manage Company</a> </li>
                            <li> <a href="bulk-company-profile.php"><i class="fa fa-edit"></i> Bulk upload</a> </li>
                        </ul>
                    </li>
                    <li> <a href="#"><i class="fa fa-user fa-fw"></i> Manage Admin<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="manage-admin.php"><i class="fa fa-th-list"></i> Manage Admin</a> </li>
                            <li> <a href="add-admin.php"><i class="fa fa-user"></i> Add Admin</a> </li>
                        </ul>
                    </li>
                    <li> <a href="#"><i class="fa fa-th-list fa-fw"></i> Manage Page<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="manage-page.php"><i class="fa fa-th-list"></i> Manage Page</a> </li>
                        </ul>
                    </li>
                    <li> <a href="#"><i class="fa fa-th-list fa-fw"></i> Manage Blog<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="manage-blog.php"><i class="fa fa-th-list"></i> Manage Blog</a> </li>
                            <li> <a href="add-blog.php"><i class="fa fa-th-list"></i> Add Blog</a> </li>
                        </ul>
                    </li>
                    <li> <a href="#"><i class="fa fa-th-list fa-fw"></i> Manage Press Release<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="manage-press.php"><i class="fa fa-th-list"></i> Manage Press Release</a> </li>
                            <li> <a href="add-press.php"><i class="fa fa-th-list"></i> Add Press Release</a> </li>
                        </ul>
                    </li>
                    <li> <a href="#"><i class="fa fa-quote-left fa-fw"></i> Manage Testimonial<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="manage-testimonial.php"><i class="fa fa-th-list"></i> Manage Testimonial</a> </li>
                            <li> <a href="add-testimonial.php"><i class="fa fa-quote-left"></i> Add Testimonial</a> </li>
                        </ul>
                    </li>
                    
                    <li> <a href="#"><i class="fa fa-quote-left fa-fw"></i> Manage Career<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                           <li> <a href="manage-careers.php"><i class="fa fa-th-list"></i> Manage Careers</a> </li>
                            <li> <a href="add-opening.php"><i class="fa fa-quote-left"></i> Add Opening</a> </li>
                        </ul>
                    </li>
                    
					<li> <a href="#"><i class="fa fa-picture-o fa-fw"></i> Manage Images<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="manage-image.php"><i class="fa fa-th-list"></i> Manage Images</a> </li>
                            <li> <a href="add-image.php"><i class="fa fa-picture-o"></i> Add Images</a> </li>
                        </ul>
                    </li>
                    
                    <li> <a href="#"><i class="fa fa-picture-o fa-fw"></i> Manage Client Logo<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="manage-client-logo.php"><i class="fa fa-th-list"></i> Manage Client Logo</a> </li>
                            <li> <a href="add-client-logo.php"><i class="fa fa-picture-o fa-fw"></i> Add Client Logo</a> </li>
                        </ul>
                    </li>
                <?php } elseif($_SESSION['ifg_admin']['role'] == "admin") { ?>
                    <li> <a href="#"><i class="fa fa-edit fa-fw"></i> Manage Report<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="manage-report.php"><i class="fa fa-th-list"></i> Manage Report</a> </li>
                            <li> <a href="add-report.php"><i class="fa fa-edit"></i> Add Report</a> </li>
                        </ul>
                    </li>                
                <?php } ?>
            <?php } ?>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
