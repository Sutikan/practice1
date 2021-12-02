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
				<div class="row mt-3">
					<div class="col col-sm col-md mb-2">
						
							<div class="card border-0" style="">
								<div class="card-body">
									<h4 class="font-weight-bold text-dark">Generate Group</h4>
									<hr>

									<form method="post">
										<div class="form-group">
											<span class="font-weight-bold text-secondary">Group Name</span>
											<input type="text" name="g_name" class="form-control my-2 rounded-0" placeholder="Group name" required>
										</div>
										<div class="form-group">
											<span class="font-weight-bold text-secondary">Simultaneous Use</span>
											<input type="text" name="g_use" class="form-control my-2 rounded-0" placeholder="Simultaneous Use" required>
										</div>
										<div class="form-group">
											<span class="font-weight-bold text-secondary">Idle Timeout</span>
											<input type="text" name="g_idle" class="form-control my-2 rounded-0" placeholder="Idle Timeout" required>
										</div>
										<div class="form-group">
											<span class="font-weight-bold text-secondary">Session Timeout</span>
											<input type="text" name="g_session" class="form-control my-2 rounded-0" placeholder="Session Timeout" required>
										</div>
										<div class="form-group">
											<span class="font-weight-bold text-secondary">Download</span>
											<input type="text" name="g_down" class="form-control my-2 rounded-0" placeholder="Download" required>
										</div>
										<div class="form-group">
											<span class="font-weight-bold text-secondary">Upload</span>
											<input type="text" name="g_up" class="form-control my-2 rounded-0" placeholder="Upload" required>
										</div>
										
										<hr>
										<button class="btn btn-block btn-warning font-weight-bold" type="submit" name="add_group">Generate Group</button>
									</form>
								</div>
							</div>
					</div>
					<div class="col col-sm col-md mb-2">
						
							<?php
								if (isset($_POST['add_group'])) { ?>
									<div class="card border-0">
										<div class="card-body">
											<h4 class="font-weight-bold text-dark">Group</h4>
											<hr>

											<div class="table-responsive">
												<table class="table table-bordered">
													<thead>
														<th>Group</th>
														<th>Simultaneous Use</th>
														<th>Idle Timeout</th>
														<th>Session Timeout</th>
														<th>Download</th>
														<th>Upload</th>
													</thead>
													<tbody>
														<?php
														$g_name = $_POST['g_name'];
														$g_use = $_POST['g_use'];
														$g_idle = $_POST['g_idle'];
														$g_session = $_POST['g_session'];
														$g_down = $_POST['g_down'];
														$g_up = $_POST['g_up'];

														$addGroup = mysqli_query($con, "INSERT INTO radgroupcheck (groupname, attribute, op, value) VALUES ('$g_name', 'Auth-Type', ':=', 'Local')");
														$addGroup = mysqli_query($con, "INSERT INTO radgroupcheck (groupname, attribute, op, value) VALUES ('$g_name', 'Simultaneous-Use', ':=', '$g_use')");
														$addGroup = mysqli_query($con, "INSERT INTO radgroupreply (groupname, attribute, op, value) VALUES ('$g_name', 'Acct-Interim-Interval', ':=', '60')");
														$addGroup = mysqli_query($con, "INSERT INTO radgroupreply (groupname, attribute, op, value) VALUES ('$g_name', 'Idle-Timeout', ':=', '$g_idle')");
														$addGroup = mysqli_query($con, "INSERT INTO radgroupreply (groupname, attribute, op, value) VALUES ('$g_name', 'Session-Timeout', ':=', '$g_session')");
														$addGroup = mysqli_query($con, "INSERT INTO radgroupreply (groupname, attribute, op, value) VALUES ('$g_name', 'WISPr-Bandwidth-Max-Down', ':=', '$g_down')");
														$addGroup = mysqli_query($con, "INSERT INTO radgroupreply (groupname, attribute, op, value) VALUES ('$g_name', 'WISPr-Bandwidth-Max-Up', ':=', '$g_up')"); ?>
															<tr>
														 		<td><?php echo $g_name ?></td>
																<td><?php echo $g_use ?></td>
																<td><?php echo $g_idle ?></td>
																<td><?php echo $g_session ?></td>
																<td><?php echo $g_down ?></td>
																<td><?php echo $g_up ?></td>
														 	</tr>
													</tbody>
												</table>
												<div class="alert alert-info font-weight-bold text-center">Generate group successful</div>
											</div>
										</div>
									</div>
								<?php } ?>
						
					</div>
				</div>
			</div>

		</div>
	</div>	
</div>

</body>
</html>
<?php } ?>