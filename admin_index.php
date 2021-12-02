<?php
	@session_start();
	include 'connect.php';
	$id = $_SESSION['id'];
	$username = $_SESSION['username'];

	if (!isset($_SESSION['id'])) {
		echo "<script>window.location.href='index.php'</script>";
	} else {
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CTC NETWORK</title>
	<link rel="stylesheet" type="text/css" href="bootstrap-4.6.1-dist/css/bootstrap.css">
	<script type="text/javascript" src="jquery/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" src="bootstrap-4.6.1-dist/js/bootstrap.min.js"></script>
</head>
<body style="background-color: #eaeaea;">

<div class="container-fluid h-100">
	<div class="row h-100">
		<div class="col-auto col-sm-auto col-md-auto bg-dark d-none d-sm-block"><?php include 'admin_menu.php'; ?></div>
		<div class="col col-sm col-md" style="padding: 0;">
			<?php include 'admin_Tmenu.php'; ?>

			<div class="container-fluid">
				<nav class="nav nav-pills my-3">
					<a href="#appro" class="nav-link active" data-toggle="pill">Approval</a>
					<a href="#suspend" class="nav-link" data-toggle="pill">Suspended</a>
				</nav>
				<div class="card border-0">
					<div class="card-body">
						<div class="tab-content">
							<div class="tab-pane fade show active" id="appro">
								<h4 class="font-weight-bold">Approve User</h4>
								<hr>
								
								<div class="table-responsive">
									<table class="table table-bordered text-center">
										<thead class="bg-light">
											<th>ID</th>
											<th>Username</th>
											<th>Group</th>
											<th>Name</th>
											<th>Lastname</th>
											<th>Manage</th>
										</thead>
										<tbody>
											<?php
											$showdata = mysqli_query($con, "SELECT * FROM radcheck, member, radusergroup WHERE radcheck.username = member.username AND radcheck.username = radusergroup.username AND radcheck.username != '$username' AND attribute != 'Cleartext-Password'");
											while ($show = mysqli_fetch_array($showdata)) { ?>
											 <tr>
											 	<td><?php echo $show['id'] ?></td>
												<td><?php echo $show['username'] ?></td>
												<td><?php echo $show['groupname'] ?></td>
												<td><?php echo $show['m_name'] ?></td>
												<td><?php echo $show['m_lastname'] ?></td>
												<td>
													<button class="btn btn-block btn-sm btn-info font-weight-bold" type="button" data-toggle="modal" data-target="#appro<?php echo $show['id'] ?>">Approve</button>
												</td>
											 </tr>
											 <div class="modal fade" id="appro<?php echo $show['id'] ?>">
											 	<div class="modal-dialog modal-dialog-centered">
											 		<div class="modal-content">
											 			<form method="post">
											 				<div class="modal-header bg-info text-white">
											 					<h4 class="modal-title">Approve User</h4>
																<button class="close" data-dismiss="modal" type="button">&times;</button>
											 				</div>
											 				<div class="modal-body">
																<span>Do you want to approve <span class="text-info font-weight-bold"><?php echo $show['username'] ?></span>?</span>
															</div>
															<div class="modal-footer">
																<input type="hidden" name="a_username" value="<?php echo $show['username'] ?>">
																<button class="btn btn-sm btn-info" name="appro" type="submit">Approve</button>
																<button class="btn btn-sm btn-outline-info" data-dismiss="modal" type="button">Cancel</button>
															</div>
											 			</form>
											 			<?php
											 				if (isset($_POST['appro'])) {
											 					$a_username = $_POST['a_username'];
											 					$appoveUser = mysqli_query($con, "UPDATE radcheck SET attribute = 'Cleartext-Password' WHERE username = '$a_username'");
											 					echo "<script>alert('Approve user successful')</script>";
																echo "<script>window.location.href='admin_index.php?id=$id'</script>";
											 				}
											 			?>
											 		</div>
											 	</div>
											 </div>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
							<div class="tab-pane fade" id="suspend">
								<h4 class="font-weight-bold">Suspend User</h4>
								<hr>

								<div class="table-responsive">
									<table class="table table-bordered text-center">
										<thead class="bg-light">
											<th>ID</th>
											<th>Username</th>
											<th>Group</th>
											<th>Name</th>
											<th>Lastname</th>
											<th>Manage</th>
										</thead>
										<tbody>
											<?php
											$showdata = mysqli_query($con, "SELECT * FROM radcheck, member, radusergroup WHERE radcheck.username = member.username AND radcheck.username = radusergroup.username AND radcheck.username != '$username' AND attribute = 'Cleartext-Password'");
											while ($show = mysqli_fetch_array($showdata)) { ?>
											 <tr>
											 	<td><?php echo $show['id'] ?></td>
												<td><?php echo $show['username'] ?></td>
												<td><?php echo $show['groupname'] ?></td>
												<td><?php echo $show['m_name'] ?></td>
												<td><?php echo $show['m_lastname'] ?></td>
												<td>
													<button class="btn btn-block btn-sm btn-secondary font-weight-bold" type="button" data-toggle="modal" data-target="#sus<?php echo $show['id'] ?>">Suspend</button>
												</td>
											 </tr>
											 <div class="modal fade" id="sus<?php echo $show['id'] ?>">
											 	<div class="modal-dialog modal-dialog-centered">
											 		<div class="modal-content">
											 			<form method="post">
											 				<div class="modal-header bg-secondary text-white">
											 					<h4 class="modal-title">Suspend User</h4>
																<button class="close" data-dismiss="modal" type="button">&times;</button>
											 				</div>
											 				<div class="modal-body">
																<span>Do you want to suspend <span class="text-secondary font-weight-bold"><?php echo $show['username'] ?></span>?</span>
															</div>
															<div class="modal-footer">
																<input type="hidden" name="sus_username" value="<?php echo $show['username'] ?>">
																<button class="btn btn-sm btn-secondary" name="sus" type="submit">Suspend</button>
																<button class="btn btn-sm btn-outline-secondary" data-dismiss="modal" type="button">Cancel</button>
															</div>
											 			</form>
											 			<?php
											 				if (isset($_POST['sus'])) {
											 					$sus_username = $_POST['sus_username'];
											 					$appoveUser = mysqli_query($con, "UPDATE radcheck SET attribute = 'Password' WHERE username = '$sus_username'");
											 					echo "<script>alert('Suspend user successful')</script>";
																echo "<script>window.location.href='admin_index.php?id=$id'</script>";
											 				}
											 			?>
											 		</div>
											 	</div>
											 </div>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>	
</div>

</body>
</html>
<?php } ?>