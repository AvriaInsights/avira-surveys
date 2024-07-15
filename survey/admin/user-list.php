<?php 
require_once("classes/cls-user.php");
include("header.php");
if(!isset($_SESSION['ifg_admin'])) {
	header("Location:login.php");
}
 
$obj_user = new User();
$fields = "`uid`, `fname`, `lname`, `username`, `email`, `user_type`, `status`";
$condition = "`user_type` = '2'";
$user_details = $obj_user->getUserDetails($fields,$condition,'','',0);
?>

<body>

    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <?php include("top-bar.php"); ?>
            <!-- /.navbar-top-links -->

            <?php include("side-bar.php"); ?>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header text-primary"><i class="fa fa-th-list"></i> Manage User List</h3>
						<ol class="breadcrumb">
							<li><a href="index.php">Dasboard</a></li>
							<li class="active">Manage Users</li>
						</ol>
						<?php if(isset($_SESSION['success'])) { ?>
						   <div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<?php
									echo $_SESSION['success'];
									unset($_SESSION['success']);
								?>
							</div>
						<?php }	?>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-info">
							<div class="panel-heading">
								General Users List
							</div>
							<div class="table-responsive">
							<!-- /.panel-heading -->
							<div class="panel-body">
								<div class="dataTable_wrapper">
									<table class="table table-striped table-bordered table-hover" id="dataTables-example">
										<thead>
											<tr>
												<th>Name</th>
												<th>Email</th>
												<th>Username</th>
												<th>User Type</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($user_details as $user_detail) { ?>
											<tr class="odd gradeX">
												<td><?php echo $user_detail['fname']." ".$user_detail['lname'];?></td>
												<td><?php echo $user_detail['email'];?></td>
												<td><?php echo $user_detail['username'];?></td>
												<td><?php echo ($user_detail['user_type']==1)?"Admin User":"General User";?></td>
												<td><?php echo ($user_detail['status']==1)?"Active":"Inactive";?></td>
												<td class="center">
													<div class="btn-group">
													<a class="btn btn-success" href="view-user.php?uid=<?php echo base64_encode($user_detail['uid']); ?>"><i class="fa fa-eye"></i> View</a>
													<a class="btn btn-default" href="add-user.php?uid=<?php echo base64_encode($user_detail['uid']); ?>"><i class="fa fa-edit"></i> Edit</a>
													<a class="btn btn-danger" onClick="return confirmDelete();" href="delete-user.php?uid=<?php echo base64_encode($user_detail['uid']); ?>"><i class="fa fa-trash"></i> Delete</a>
													</div>
												</td>
											</tr>
											<?php } ?>
										</tbody>
										<tfoot>
											<tr>
												<th>Name</th>
												<th>Email</th>
												<th>Username</th>
												<th>User Type</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</tfoot>
									</table>
								</div>
								<!-- /.table-responsive -->
							</div>
							</div>
							<!-- /.panel-body -->
						</div>
						<!-- /.panel -->
					</div>
					<!-- /.col-lg-12 -->
				</div>
				<!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
	<?php include("footer.php"); ?>

</body>

</html>
