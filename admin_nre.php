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
					<a href="#user" class="nav-link active" data-toggle="pill">User</a>
					<a href="#admin" class="nav-link" data-toggle="pill">Admin</a>
				</nav>
				<div class="card border-0">
					<div class="card-body">
						<div class="tab-content">
							<div class="tab-pane fade show active" id="user">
								<h4 class="font-weight-bold">Network User</h4>
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
											$showdata = mysqli_query($con, "SELECT * FROM radcheck, radacct, radusergroup WHERE radcheck.username = radacct.username AND radcheck.username = radusergroup.username AND radcheck.username != '$username' AND attribute = 'Cleartext-Password'");
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
							<div class="tab-pane fade" id="admin">
								<h4 class="font-weight-bold">Network Admin</h4>
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
											$showdata = mysqli_query($con, "SELECT * FROM radcheck, radacct WHERE radcheck.username = radacct.username AND radcheck.username = '$username'");
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