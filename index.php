<?php
	@session_start();
	include 'connect.php';
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
<body class="bg-dark d-flex justify-content-center align-items-center" style="min-height: 100vh;">


	<div class="card border-0 w-25">
		<div class="card-header bg-light">
			<div class="nav nav-tabs card-header-tabs">
				<a href="#login" class="nav-link active" data-toggle="tab">Log In</a>
				<a href="#signup" class="nav-link" data-toggle="tab">Sign Up</a>
			</div>
		</div>
		<div class="card-body">
			<div class="tab-content">
				<div class="tab-pane fade show active" id="login">
					<form method="post">
						<div class="form-group">
							<span class="text-secondary font-weight-bold">Username</span>
							<input type="text" name="l_username" class="form-control rounded-0" placeholder="Username" required>
						</div>

						<div class="form-group">
							<span class="text-secondary font-weight-bold">Password</span>
							<input type="password" name="l_pass" class="form-control rounded-0" placeholder="Password" required>
						</div>
						<hr>
						<button class="btn btn-block btn-warning font-weight-bold" type="submit" name="log_in">Log In</button>
					</form>
					<?php
						if (isset($_POST['log_in'])) {
							$login = mysqli_query($con, "SELECT * FROM radcheck WHERE username = '".trim($_POST['l_username'])."' AND value = '".trim($_POST['l_pass'])."'");
							$data = mysqli_fetch_assoc($login);

							if ($data) {
								if ($data['attribute'] === 'Cleartext-Password') {
									$id = $data['id'];
									$username = $data['username'];
									$_SESSION['id'] = $data['id'];
									$_SESSION['username'] = $data['username'];

									$loginTime = mysqli_query($con, "UPDATE member SET m_login = NOW() WHERE username = '$username'");
									if ($data['username'] === 'admin') {
										echo "<script>window.location.href='admin_index.php?id=$id'</script>";
									} else {
										echo "<script>window.location.href='user_index.php?id=$id'</script>";
									}
								} else {
									echo "<script>alert('This username has be suspended!')</script>";
									echo "<script>window.location.href='index.php'</script>";
								}
							} else {
								echo "<script>alert('Username or password not correct!')</script>";
								echo "<script>window.location.href='index.php'</script>";
							}
						}
					?>
				</div>
				<div class="tab-pane fade" id="signup">
					<form method="post">
						<div class="form-group">
							<span class="text-secondary font-weight-bold">Name</span>
							<div class="form-row">
								<div class="col">
									<input type="text" name="s_name" class="form-control rounded-0" placeholder="Name" required>
								</div>
								<div class="col">
									<input type="text" name="s_lastname" class="form-control rounded-0" placeholder="Lastname" required>
								</div>
							</div>
						</div>

						<div class="form-group">
							<span class="text-secondary font-weight-bold">Username</span>
							<input type="text" name="s_username" class="form-control rounded-0" placeholder="Username" required>
						</div>

						<div class="form-group">
							<span class="text-secondary font-weight-bold">Password</span>
							<input type="password" name="s_pass" class="form-control rounded-0" placeholder="Password" required>
						</div>

						<hr>
						<button class="btn btn-block btn-warning font-weight-bold" type="submit" name="sign_up">Sign Up</button>
					</form>
					<?php
						if (isset($_POST['sign_up'])) {
							$s_name = $_POST['s_name'];
							$s_lastname = $_POST['s_lastname'];
							$s_username = $_POST['s_username'];
							$s_pass = $_POST['s_pass'];
							$s_group = $_POST['s_group'];

							$checkname = mysqli_query($con, "SELECT * FROM radcheck WHERE username = '".trim($s_username)."'");
							$check = mysqli_num_rows($checkname);
							if ($check === 1) {
								echo "<script>alert('This username is already exists!')</script>";
								echo "<script>window.location.href='index.php'</script>";
							} else {
								$sigup = mysqli_query($con, "INSERT INTO radcheck (username, attribute, op, value) VALUES ('$s_username', 'Password', ':=', '$s_pass')");
								$sigup = mysqli_query($con, "INSERT INTO member (username, m_name, m_lastname) VALUES ('$s_username', '$s_name', '$s_lastname')");
								$sigup = mysqli_query($con, "INSERT INTO radusergroup (username, groupname, priority) VALUES ('$s_username', '$s_group', '1')");
								echo "<script>alert('Sign up successful, Please wait for approval')</script>";
								echo "<script>window.location.href='index.php'</script>";
							}
						}
					?>
				</div>
			</div>
		</div>
	</div>

</body>
</html>