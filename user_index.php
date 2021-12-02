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
			<div class="col-auto col-sm-auto col-md-auto bg-dark d-none d-sm-block"><?php include 'user_menu.php'; ?></div>
			<div class="col col-sm col-md" style="padding: 0;">
				<?php include 'user_Tmenu.php'; ?>

				<div class="container-fluid">
					<div class="tab-content">
						<div class="tab-pane fade show active" id="Dashbord">
							<div class="card border-0 mt-3">
								<div class="card-body">
									<h4 class="font-weight-bold">Network Report</h4>
									<hr>

									<div class="table-responsive">
										<table class="table table-bordered text-center">
											<thead class="bg-light">
												<th>Username</th>
												<th>IP Address</th>
												<th>CISD</th>
												<th>Session</th>
												<th>Start</th>
												<th>Stop</th>
												<th>Note</th>
											</thead>
											<tbody>
												<?php
												$showdata = mysqli_query($con, "SELECT * FROM radcheck, radacct, radusergroup WHERE radcheck.username = radacct.username AND radcheck.username = radusergroup.username AND radcheck.username = '$username'");
												while ($show = mysqli_fetch_array($showdata)) { ?>
												 <tr>
													<td><?php echo $show['username'] ?></td>
													<td><?php echo $show['framedipaddress'] ?></td>
													<td><?php echo $show['callingstationid'] ?></td>
													<td><?php echo $show['acctsessiontime'] ?></td>
													<td><?php echo $show['acctstarttime'] ?></td>
													<td><?php echo $show['acctstoptime'] ?></td>
													<td><?php echo $show['acctterminatecause'] ?></td>
												 </tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="Profile">
							<div class="row m-3">
								<div class="col">
									<div class="card border-0">
										<div class="card-body">
											<h4 class="font-weight-bold">My Profile</h4>
											<hr>

											<?php
												$showP = mysqli_query($con, "SELECT * FROM radcheck, member, radusergroup WHERE radcheck.username = member.username AND radcheck.username = radusergroup.username AND radcheck.username = '$username'");
												$profile = mysqli_fetch_assoc($showP);
											?>
											<form method="post">
												<input type="text" class="form-control mb-2" value="<?php echo $profile['username'] ?>" disabled>
												<input type="text" class="form-control mb-2" value="<?php echo $profile['groupname'] ?>" disabled>
												<div class="form-row">
													<div class="col">
														<input type="text" name="up_name" value="<?php echo $profile['m_name'] ?>" class="form-control mb-2" placeholder="Name" required>
													</div>
													<div class="col">
														<input type="text" name="up_lastname" value="<?php echo $profile['m_lastname'] ?>" class="form-control mb-2" placeholder="Lastname" required>
													</div>
												</div>
												<hr>
												<button class="btn btn-block btn-warning font-weight-bold" name="up_U" type="submit">Update</button>
											</form>
											<?php
												if (isset($_POST['up_U'])) {
													$up_name = $_POST['up_name'];
													$up_lastname = $_POST['up_lastname'];

													$upUser = mysqli_query($con, "UPDATE member SET m_name = '$up_name', m_lastname = '$up_lastname', m_update = NOW(), m_who = '$username' WHERE username = '$username'");
													echo "<script>alert('Update profile successful')</script>";
													echo "<script>window.location.href='user_index.php?id=$id'</script>";
												}
											?>
										</div>
									</div>
								</div>
								<div class="col">
									<div class="card border-0">
										<div class="card-body">
											<h4 class="font-weight-bold">Change Password</h4>
											<hr>

											<form method="post">
												<form method="post">
													<input type="password" name="c_pass" class="form-control rounded-0 my-2" placeholder="Password" required>
													<input type="password" name="c_conpass" class="form-control rounded-0 my-2" placeholder="Confirm password" required>
													<hr>
													<button class="btn btn-block btn-warning font-weight-bold" type="submit" name="chang_pass">Change Password</button>
												</form>
												<?php
													if (isset($_POST['chang_pass'])) {
														$c_pass = $_POST['c_pass'];
														$c_conpass = $_POST['c_conpass'];

														if ($c_pass === $c_conpass) {
															$changpass = mysqli_query($con, "UPDATE member SET m_update = NOW(), m_who = '$username' WHERE username = '$username'");
															$changpass = mysqli_query($con, "UPDATE radcheck SET value = '$c_pass' WHERE username = '$username'");
															echo "<script>alert('Change password successful')</script>";
															echo "<script>window.location.href='user_profile.php?id=$id'</script>";
														} else {
															echo "<script>alert('Password not match!')</script>";
															echo "<script>window.location.href='user_profile.php?id=$id'</script>";
														}
													}
												?>
											</form>
										</div>
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