<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>

	<nav>
		<div class="nav flex-column bg-white px-2 py-2" style="height: 910px;">
			<a href="<?php echo "admin_index.php?id=$id" ?>" class="nav-link mt-2" style="margin-bottom: 0;"><h3>CTC NETWORK</h3></a>
			<hr width="90%">
			<a href="<?php echo "admin_profile.php?id=$id" ?>" class="nav-link" style="margin-bottom: 0;"><span class="font-weight-bold">Username : </span><?php echo $username ?></a>
			<hr width="90%">
			<a href="<?php echo "admin_add.php?id=$id" ?>" class="nav-link">Add User/Group</a>
			<a href="<?php echo "admin_gen.php?id=$id" ?>" class="nav-link">Generate User</a>
			<hr width="90%">
			<a href="<?php echo "admin_nre.php?id=$id" ?>" class="nav-link">Network Report</a>
			<a href="<?php echo "admin_ure.php?id=$id" ?>" class="nav-link">User Report</a>
			<hr width="90%">
			<a href="#logout" data-toggle="modal" class="nav-link">Log out</a>
		</div>
	</nav>

</body>
</html>