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
<body style="background-color: #eaeaea;" class="float-none">

<div class="container-fluid h-100">
	<div class="row h-100">
		<div class="col-auto col-sm-auto col-md-auto bg-dark d-none d-lg-block"><?php include 'admin_menu.php'; ?></div>
		<div class="col col-sm col-md" style="padding: 0;">
			<?php include 'admin_Tmenu.php'; ?>

			<div class="container-fluid">
				<div class="card border-0 mt-3">
					<div class="card-body">
						<div class="tab-content">
							<div class="tab-pane fade show active" id="user">
								<h4 class="font-weight-bold">Users Report</h4>
								<hr>
								
								<div class="table-responsive-lg">
									<table class="table table-bordered text-center">
										<thead class="bg-light">
											<th>ID</th>
											<th>Username</th>
											<th>Group</th>
											<th>Name</th>
											<th>Lastname</th>
											<th>Update</th>
											<th>By</th>
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
														<td><?php echo $show['m_update'] ?></td>
														<td><?php echo $show['m_who'] ?></td>
														<td>
															<button class="btn btn-block btn-sm btn-warning font-weight-bold" type="button" data-toggle="modal" data-target="#upU<?php echo $show['id'] ?>">Update</button>
															<button class="btn btn-block btn-sm btn-secondary font-weight-bold" type="button" data-toggle="modal" data-target="#delU<?php echo $show['id'] ?>">Delete</button>
														</td>
													</tr>
													<div class="modal fade" id="upU<?php echo $show['id'] ?>">
													 	<div class="modal-dialog modal-dialog-centered">
													 		<div class="modal-content">
													 			<form method="post">
													 				<div class="modal-header bg-warning text-white">
													 					<h4 class="modal-title">Update User</h4>
																		<button class="close" data-dismiss="modal" type="button">&times;</button>
													 				</div>
													 				<div class="modal-body">
																		<input type="text" class="form-control mb-2" value="<?php echo $show['username'] ?>" disabled>
																		<div class="form-row">
																			<div class="col">
																				<input type="text" name="up_name" value="<?php echo $show['m_name'] ?>" class="form-control mb-2" placeholder="Name" required>
																			</div>
																			<div class="col">
																				<input type="text" name="up_lastname" value="<?php echo $show['m_lastname'] ?>" class="form-control mb-2" placeholder="Lastname" required>
																			</div>
																		</div>
																		<select class="form-control" name="up_group">
																			<option value="<?php echo $show['groupname'] ?>"><?php echo $show['groupname'] ?></option>
																			<?php
																				$loopname = mysqli_query($con, "SELECT DISTINCT groupname FROM radgroupcheck");
																				while ($loop = mysqli_fetch_assoc($loopname)) { ?>
																					<option value="<?php echo $loop['groupname'] ?>"><?php echo $loop['groupname'] ?></option>
																			<?php } ?>
																		</select>
																	</div>
																	<div class="modal-footer">
																		<input type="hidden" name="up_username" value="<?php echo $show['username'] ?>">
																		<button class="btn btn-sm btn-warning" name="up_U" type="submit">Update</button>
																		<button class="btn btn-sm btn-outline-info" data-dismiss="modal" type="button">Cancel</button>
																	</div>
													 			</form>
													 			<?php
													 				if (isset($_POST['up_U'])) {
													 					$up_username = $_POST['up_username'];
													 					$up_name = $_POST['up_name'];
																		$up_lastname = $_POST['up_lastname'];
																		$up_group = $_POST['up_group'];

													 					$upUser = mysqli_query($con, "UPDATE member SET m_name = '$up_name', m_lastname = '$up_lastname', m_update = NOW(), m_who = '$username' WHERE username = '$up_username'");
													 					$upUser = mysqli_query($con, "UPDATE radusergroup SET groupname = '$up_group' WHERE username = '$up_username'");
													 					echo "<script>alert('Update user successful')</script>";
																		echo "<script>window.location.href='admin_ure.php?id=$id'</script>";
													 				}
													 			?>
													 		</div>
													 	</div>
													 </div>
													<div class="modal fade" id="delU<?php echo $show['id'] ?>">
													 	<div class="modal-dialog modal-dialog-centered">
													 		<div class="modal-content">
													 			<form method="post">
													 				<div class="modal-header bg-secondary text-white">
													 					<h4 class="modal-title">Delete User</h4>
																		<button class="close" data-dismiss="modal" type="button">&times;</button>
													 				</div>
													 				<div class="modal-body">
																		<span>Do you want to delete <span class="text-secondary font-weight-bold"><?php echo $show['username'] ?></span>?</span>
																	</div>
																	<div class="modal-footer">
																		<input type="hidden" name="del_username" value="<?php echo $show['username'] ?>">
																		<button class="btn btn-sm btn-secondary" name="appro" type="submit">Delete</button>
																		<button class="btn btn-sm btn-outline-secondary" data-dismiss="modal" type="button">Cancel</button>
																	</div>
													 			</form>
													 			<?php
													 				if (isset($_POST['appro'])) {
													 					$del_username = $_POST['del_username'];
													 					$delUser = mysqli_query($con, "DELETE FROM radcheck WHERE username = '$del_username'");
													 					$delUser = mysqli_query($con, "DELETE FROM member WHERE username = '$del_username'");
													 					$delUser = mysqli_query($con, "DELETE FROM radusergroup WHERE username = '$del_username'");
													 					echo "<script>alert('Delete user successful')</script>";
																		echo "<script>window.location.href='admin_ure.php?id=$id'</script>";
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