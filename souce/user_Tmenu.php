<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>

	<div class="navbar navbar-dark bg-primary navbar-expand">
		<div class="container-fluid">
			<a href="<?php echo "user_index.php?id=$id" ?>" class="navbar-brand font-weight-bold">CTC</a>

			<div class="ml-auto">
				<a href="#logout" data-toggle="modal" class="nav-link text-light">Log out</a>
			</div>
		</div>
	</div>

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