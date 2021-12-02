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
						<h4 class="font-weight-bold text-primary">Generate User</h4>
						<hr>

						<form method="post">
							<input type="text" name="gen_num" class="form-control mb-2" placeholder="Number of user" required>
							<select class="form-control" name="gen_group">
								<?php
								$loopname = mysqli_query($con, "SELECT DISTINCT groupname FROM radgroupcheck");
								while ($loop = mysqli_fetch_assoc($loopname)) { ?>
									<option value="<?php echo $loop['groupname'] ?>"><?php echo $loop['groupname'] ?></option>
								<?php } ?>
							</select>
							<hr>
							<button class="btn btn-block btn-primary" type="submit" name="gen_user">Generate User</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="col col-sm col-md">
			<div class="container-fluid">
				<?php
				if (isset($_POST['gen_user'])) {
				 	$gen_num = $_POST['gen_num'];
					$gen_group = $_POST['gen_group']; ?>
					<div class="card border-0">
						<div class="card-body">
							<h4 class="font-weight-bold text-primary">Users</h4>
							<hr>

							<div class="table-responsive">
								<table class="table table-bordered">
									<thead>
										<th>Username</th>
										<th>Password</th>
										<th>Group</th>
									</thead>
									<tbody>
										<?php
										for ($i=0; $i <$gen_num ; $i++) { 
										 	$char = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
										 	$num = "1234567890";
										 	$subC = str_shuffle($char);
										 	$subN = str_shuffle($num);
										 	$gen_name = substr($gen_group, 0, 2).substr($subC, 0, 3).substr($subN, 0, 2);
										 	$gen_pass = substr($subN, 0, 6); 
										 	$genUser = mysqli_query($con, "INSERT INTO radcheck (username, attribute, op, value) VALUES ('$gen_name', 'Cleartext-Password', ':=', '$gen_pass')");
											$genUser = mysqli_query($con, "INSERT INTO member (username) VALUES ('$gen_name')");
											$genUser = mysqli_query($con, "INSERT INTO radusergroup (username, groupname, priority) VALUES ('$gen_name', '$gen_group', '1')");
										 	?>
										 	<tr>
										 		<td><?php echo $gen_name ?></td>
												<td><?php echo $gen_pass ?></td>
												<td><?php echo $gen_group ?></td>
										 	</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

</body>
</html>
<?php } ?>