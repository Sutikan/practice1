<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>

		<nav>
			<div class="nav flex-column py-2" style="min-height: 100vh;">
				<a href="<?php echo "admin_index.php?id=$id" ?>" class="nav-link mt-3 text-light" style="margin-bottom: 0;"><h4>CTC <span class="text-warning">NETWORK</span></h4></a>
				<hr width="100%" class="border-secondary">
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

</body>
</html>