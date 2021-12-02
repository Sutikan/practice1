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
									<h4 class="font-weight-bold text-dark">Generate User</h4>
									<hr>

									<form method="post">
										<div class="form-group">
											<span class="font-weight-bold text-secondary">Number of user</span>
											<input type="text" name="gen_num" class="form-control my-2 rounded-0" placeholder="Number of user" required>
										</div>
										<div class="form-group">
											<span class="font-weight-bold text-secondary">Group</span>
											<select class="form-control my-2 rounded-0" name="gen_group">
												<?php
												$loopname = mysqli_query($con, "SELECT DISTINCT groupname FROM radgroupcheck");
												while ($loop = mysqli_fetch_assoc($loopname)) { ?>
													<option value="<?php echo $loop['groupname'] ?>"><?php echo $loop['groupname'] ?></option>
												<?php } ?>
											</select>
										</div>
										<hr>
										<button class="btn btn-block btn-warning font-weight-bold" type="submit" name="gen_user">Generate User</button>
									</form>
								</div>
							</div>
					</div>
					<div class="col col-sm col-md mb-2">
						
							<?php
								if (isset($_POST['gen_user'])) {
								 	$gen_num = $_POST['gen_num'];
									$gen_group = $_POST['gen_group']; ?>
									<div class="card border-0">
										<div class="card-body">
											<h4 class="font-weight-bold text-dark">Users</h4>
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

												<div class="alert alert-info font-weight-bold text-center">Generate user successful</div>

											</div>
										</div>
									</div>
								<?php } ?>
						
					</div>
				</div>

				<div class="row mt-3">
					<div class="col col-sm col-md mb-2">
						
							<div class="card border-0" style="">
								<div class="card-body">
									<h4 class="font-weight-bold text-dark">Generate Single User</h4>
									<hr>

									<form method="post">
										<div class="form-group">
											<span class="font-weight-bold text-secondary">Name</span>
											<div class="form-row">
												<div class="col">
													<input type="text" name="a_name" class="form-control my-2 rounded-0" placeholder="Name" required>
												</div>
												<div class="col">
													<input type="text" name="a_lastname" class="form-control my-2 rounded-0" placeholder="Lastname" required>
												</div>
											</div>
										</div>
										<div class="form-group">
											<span class="font-weight-bold text-secondary">Username</span>
											<input type="text" name="a_username" class="form-control my-2 rounded-0" placeholder="Username" required>
										</div>
										<div class="form-group">
											<span class="font-weight-bold text-secondary">Password</span>
											<input type="password" name="a_pass" class="form-control my-2 rounded-0" placeholder="Password" required>
										</div>
										<div class="form-group">
											<span class="font-weight-bold text-secondary">Group</span>
											<select class="form-control my-2 rounded-0" name="a_group">
												<?php
												$loopname = mysqli_query($con, "SELECT DISTINCT groupname FROM radgroupcheck");
												while ($loop = mysqli_fetch_assoc($loopname)) { ?>
													<option value="<?php echo $loop['groupname'] ?>"><?php echo $loop['groupname'] ?></option>
												<?php } ?>
											</select>
										</div>
										
										<hr>
										<button class="btn btn-block btn-warning font-weight-bold" type="submit" name="add_user">Generate Single User</button>
									</form>
								</div>
							</div>
					</div>
					<div class="col col-sm col-md mb-2">
						
							<?php
								if (isset($_POST['add_user'])) { ?>
									<div class="card border-0">
										<div class="card-body">
											<h4 class="font-weight-bold text-dark">User</h4>
											<hr>

											<div class="table-responsive">
												<table class="table table-bordered">
													<thead>
														<th>Username</th>
														<th>Name</th>
														<th>Lastname</th>
														<th>Password</th>
														<th>Group</th>
													</thead>
													<tbody>
														<?php
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
															$addUser = mysqli_query($con, "INSERT INTO radusergroup (username, groupname, priority) VALUES ('$a_username', '$a_group', '1')"); ?>
															<tr>
														 		<td><?php echo $a_username ?></td>
																<td><?php echo $a_name ?></td>
																<td><?php echo $a_lastname ?></td>
																<td><?php echo $a_pass ?></td>
																<td><?php echo $a_group ?></td>
														 	</tr>
														<?php } ?>
														 	
													</tbody>
												</table>
												<div class="alert alert-info font-weight-bold text-center">Generate single user successful</div>
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