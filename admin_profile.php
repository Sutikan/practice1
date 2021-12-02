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
									<h4 class="font-weight-bold text-dark">My Profile</h4>
									<hr>

									<?php
										$showP = mysqli_query($con, "SELECT * FROM member WHERE username = '$username'");
										$profile = mysqli_fetch_assoc($showP);
									?>

									<form method="post">
										<div class="form-group">
											<span class="font-weight-bold text-secondary">Username</span>
											<input type="text" class="form-control rounded-0 my-2" value="<?php echo $username ?>" disabled>
										</div>
										<div class="form-group">
											<span class="font-weight-bold text-secondary">Name</span>
											<div class="form-row">
												<div class="col">
													<input type="text" name="p_name" value="<?php echo $profile['m_name'] ?>" class="form-control rounded-0 my-2" placeholder="Name" required>
												</div>
												<div class="col">
													<input type="text" name="p_lastname" value="<?php echo $profile['m_lastname'] ?>" class="form-control rounded-0 my-2" placeholder="Lastname" required>
												</div>
											</div>
										</div>
										<hr>
										<button class="btn btn-block btn-warning font-weight-bold" type="submit" name="up_pro">Update Profile</button>
									</form>
									<?php
										if (isset($_POST['up_pro'])) {
											$p_name = $_POST['p_name'];
											$p_lastname = $_POST['p_lastname'];

											$upPro = mysqli_query($con, "UPDATE member SET m_name = '$p_name', m_lastname = '$p_lastname', m_update = NOW(), m_who = '$username' WHERE username = '$username'");
											echo "<script>alert('Update profile successful')</script>";
											echo "<script>window.location.href='admin_profile.php?id=$id'</script>";
										}
									?>
								</div>
							</div>
					</div>
					<div class="col col-sm col-md mb-2">
						
							<div class="card border-0">
								<div class="card-body">
									<h4 class="font-weight-bold text-dark">Change Password</h4>
									<hr>

									<form method="post">
										<div class="form-group">
											<span class="font-weight-bold text-secondary">Password</span>
											<input type="password" name="c_pass" class="form-control rounded-0 my-2" placeholder="Password" required>
										</div>
										<div class="form-group">
											<span class="font-weight-bold text-secondary">Confirm Password</span>
											<input type="password" name="c_conpass" class="form-control rounded-0 my-2" placeholder="Confirm password" required>
										</div>
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
												echo "<script>window.location.href='admin_profile.php?id=$id'</script>";
											} else {
												echo "<script>alert('Password not match!')</script>";
												echo "<script>window.location.href='admin_profile.php?id=$id'</script>";
											}
										}
									?>
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