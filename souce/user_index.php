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
<body class="bg-light">

<div><?php include 'user_Tmenu.php'; ?></div>

<div class="container-fluid">
	<div class="row">
		<div class="col-auto col-sm-auto col-md-auto">
			<div class="card border-0">
				<div class="card-body">
					<h4 class="font-weight-bold">My Profile</h4>
					<hr>

					<?php
						$showP = mysqli_query($con, "SELECT * FROM radcheck, member, radusergroup WHERE radcheck.username = member.username AND radcheck.username = radusergroup.username AND radcheck.username = '$username'");
						$profile = mysqli_fetch_assoc($showP);
					?>
					<span class="font-weight-bold">Username: </span> <?php echo $username ?> <br>
					<span class="font-weight-bold">Name: </span> <?php echo $profile['m_name'] ?> <?php echo $profile['m_lastname'] ?> <br>
					<span class="font-weight-bold">Group: </span> <?php echo $profile['groupname'] ?> <br>
					<hr>
					<button class="btn btn-block btn-primary" type="button" data-toggle="modal" data-target="#upPro<?php echo $profile['id'] ?>">Update Profile</button>

					<div class="modal fade" id="upPro<?php echo $profile['id'] ?>">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<form method="post">
									<div class="modal-header bg-info text-white">
										<h4 class="modal-title">Update User</h4>
										<button class="close" data-dismiss="modal" type="button">&times;</button>
									</div>
									<div class="modal-body">
										<input type="text" class="form-control mb-2" value="<?php echo $profile['username'] ?>" disabled>
										<div class="form-row">
											<div class="col">
												<input type="text" name="up_name" value="<?php echo $profile['m_name'] ?>" class="form-control mb-2" placeholder="Name" required>
											</div>
											<div class="col">
												<input type="text" name="up_lastname" value="<?php echo $profile['m_lastname'] ?>" class="form-control mb-2" placeholder="Lastname" required>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button class="btn btn-sm btn-info" name="up_U" type="submit">Update</button>
										<button class="btn btn-sm btn-outline-info" data-dismiss="modal" type="button">Cancel</button>
									</div>
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
				</div>
			</div>
		</div>
		<div class="col col-sm col-md">
			<div class="container-fluid">
				<div class="card border-0">
					<div class="card-header bg-light">
						<div class="nav nav-pills card-header-pills">
							<a href="#Network" class="nav-link active" data-toggle="pill">Network</a>
							<a href="#time" class="nav-link" data-toggle="pill">Time</a>
						</div>
					</div>
					<div class="card-body">
						<div class="tab-content">
							<div class="tab-pane fade show active" id="Network">
								<h4 class="font-weight-bold">Network Report</h4>
								<hr>
								
								<div class="table-responsive">
									<table class="table table-bordered text-center">
										<thead class="bg-light">
											<th>ID</th>
											<th>Username</th>
											<th>Group</th>
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
											 	<td><?php echo $show['id'] ?></td>
												<td><?php echo $show['username'] ?></td>
												<td><?php echo $show['groupname'] ?></td>
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
							<div class="tab-pane fade" id="time">
								<h4 class="font-weight-bold">Network Admin</h4>
								<hr>

								<div class="table-responsive">
									<table class="table table-bordered text-center">
										<thead class="bg-light">
											<th>ID</th>
											<th>Username</th>
											<th>Group</th>
											<th>Log In</th>
											<th>Log Out</th>
											<th>Update</th>
											<th>By</th>
										</thead>
										<tbody>
											<?php
											$showdata = mysqli_query($con, "SELECT * FROM radcheck, member, radusergroup WHERE radcheck.username = member.username AND radcheck.username = radusergroup.username AND radcheck.username = '$username'");
											while ($show = mysqli_fetch_array($showdata)) { ?>
											 <tr>
											 	<td><?php echo $show['id'] ?></td>
												<td><?php echo $show['username'] ?></td>
												<td><?php echo $show['groupname'] ?></td>
												<td><?php echo $show['m_login'] ?></td>
												<td><?php echo $show['m_logout'] ?></td>
												<td><?php echo $show['m_update'] ?></td>
												<td><?php echo $show['m_who'] ?></td>
											 </tr>
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