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

<div><?php include 'admin_Tmenu.php'; ?></div>

<div class="container-fluid">
	<div class="row">
		<div class="col-auto col-sm-auto col-md-auto"><?php include 'admin_menu.php'; ?></div>
		<div class="col col-sm col-md">
			<div class="container-fluid">
				<div class="card border-0">
					<div class="card-body">
						<h4 class="font-weight-bold text-primary">Add User</h4>
						<hr>

						<form method="post">
							<div class="form-row">
								<div class="col">
									<input type="text" name="a_name" class="form-control mb-2" placeholder="Name" required>
								</div>
								<div class="col">
									<input type="text" name="a_lastname" class="form-control mb-2" placeholder="Lastname" required>
								</div>
							</div>
							<input type="text" name="a_username" class="form-control mb-2" placeholder="Username" required>
							<input type="password" name="a_pass" class="form-control mb-2" placeholder="Password" required>
							<select class="form-control" name="a_group">
								<?php
								$loopname = mysqli_query($con, "SELECT DISTINCT groupname FROM radgroupcheck");
								while ($loop = mysqli_fetch_assoc($loopname)) { ?>
									<option value="<?php echo $loop['groupname'] ?>"><?php echo $loop['groupname'] ?></option>
								<?php } ?>
							</select>
							<hr>
							<button class="btn btn-block btn-primary" type="submit" name="add_user">Add User</button>
						</form>
						<?php
							if (isset($_POST['add_user'])) {
								$a_name = $_POST['a_name'];
								$a_lastname = $_POST['a_lastname'];
								$a_username = $_POST['a_username'];
								$a_pass = $_POST['a_pass'];
								$a_group = $_POST['a_group'];

								$checkname = mysqli_query($con, "SELECT * FROM radcheck WHERE username = '".trim($a_username)."'");
								$check = mysqli_num_rows($checkname);
								if ($check === 1) {
									echo "<script>alert('This username is already exists!')</script>";
									echo "<script>window.location.href='admin_add.php?id=$id'</script>";
								} else {
									$addUser = mysqli_query($con, "INSERT INTO radcheck (username, attribute, op, value) VALUES ('$a_username', 'Cleartext-Password', ':=', '$a_pass')");
									$addUser = mysqli_query($con, "INSERT INTO member (username, m_name, m_lastname) VALUES ('$a_username', '$a_name', '$a_lastname')");
									$addUser = mysqli_query($con, "INSERT INTO radusergroup (username, groupname, priority) VALUES ('$a_username', '$a_group', '1')");
									echo "<script>alert('Add user successful')</script>";
									echo "<script>window.location.href='admin_add.php?id=$id'</script>";
								}
							}
						?>
					</div>
				</div>
			</div>
		</div>
		<div class="col col-sm col-md">
			<div class="container-fluid">
				<div class="card border-0">
					<div class="card-body">
						<h4 class="font-weight-bold text-primary">Add Group</h4>
						<hr>

						<form method="post">
							<input type="text" name="g_name" class="form-control mb-2" placeholder="Group name" required>
							<input type="text" name="g_use" class="form-control mb-2" placeholder="Simultaneous Use" required>
							<input type="text" name="g_idle" class="form-control mb-2" placeholder="Idle Timeout" required>
							<input type="text" name="g_session" class="form-control mb-2" placeholder="Session Timeout" required>
							<input type="text" name="g_down" class="form-control mb-2" placeholder="Download" required>
							<input type="text" name="g_up" class="form-control mb-2" placeholder="Upload" required>
							<hr>
							<button class="btn btn-block btn-primary" type="submit" name="add_group">Add Group</button>
						</form>
						<?php
							if (isset($_POST['add_group'])) {
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
								$addGroup = mysqli_query($con, "INSERT INTO radgroupreply (groupname, attribute, op, value) VALUES ('$g_name', 'WISPr-Bandwidth-Max-Up', ':=', '$g_up')");
								echo "<script>alert('Add group successful')</script>";
								echo "<script>window.location.href='admin_add.php?id=$id'</script>";
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

</body>
</html>
<?php } ?>