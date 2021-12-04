<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark d-block">
		<div class="container-fluid">
			<a href="" class="navbar-brand d-md-none">CTC <span class="text-warning font-weight-bold">NETWORK</span></a>

			<button class="navbar-toggler d-block d-md-none" type="button" data-toggle="collapse" data-target="#sideMenu"><span class="navbar-toggler-icon"></span></button>
			<div class="collapse navbar-collapse" id="sideMenu">
				<nav class="d-lg-none">
					<div class="nav flex-column py-2" style="min-height: 100vh;">
						<a class="nav-link disabled text-warning font-weight-bold">Manage</a>
						<a href="<?php echo "admin_index.php?id=$id" ?>" class="nav-link text-light ml-3">Dashbord</a>
						<a href="<?php echo "admin_profile.php?id=$id" ?>" class="nav-link text-light ml-3">Profile</a>
						<a class="nav-link disabled text-warning font-weight-bold">Generate</a>
						<a href="<?php echo "admin_gen.php?id=$id" ?>" class="nav-link text-light ml-3">Generate User</a>
						<a href="<?php echo "admin_add.php?id=$id" ?>" class="nav-link text-light ml-3">Generate Group</a>
						<a class="nav-link disabled text-warning font-weight-bold">Report</a>
						<a href="<?php echo "admin_nre.php?id=$id" ?>" class="nav-link text-light ml-3">Network</a>
						<a href="<?php echo "admin_ure.php?id=$id" ?>" class="nav-link text-light ml-3">User</a>
						<hr width="100%" class="border-secondary"> 
						<button class="btn btn-block btn-warning font-weight-bold" data-target="#logout" data-toggle="modal" >Log Out</button>
					</div> 
				</nav>
			</div>
			<div class="ml-auto d-none d-md-block">
				<button class="btn btn-sm btn-warning font-weight-bold" data-target="#logout" data-toggle="modal" >Log Out</button>
			</div>
		</div>
	</nav>

	<div class="modal fade" id="logout">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<form method="post">
					<div class="modal-header bg-danger text-white">
						<h4 class="modal-title">Log Out</h4>
						<button class="close" data-dismiss="modal" type="button">&times;</button>
					</div>
					<div class="modal-body">
						<span>Do you want to <span class="text-danger font-weight-bold">Log Out</span>?</span>
					</div>
					<div class="modal-footer">
						<button class="btn btn-sm btn-danger" name="log_out" type="submit">Log Out</button>
						<button class="btn btn-sm btn-outline-danger" data-dismiss="modal" type="button">Cancel</button>
					</div>
				</form>
				<?php
					if (isset($_POST['log_out'])) {
						$logoutTime = mysqli_query($con, "UPDATE member SET m_logout = NOW() WHERE username = '$username'");
						session_destroy();
						echo "<script>window.location.href='index.php'</script>";
					}
				?>
			</div>
		</div>
	</div>

</body>
</html>