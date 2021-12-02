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
				<a href="<?php echo "user_index.php?id=$id" ?>" class="nav-link mt-3 text-light" style="margin-bottom: 0;"><h4>CTC <span class="text-warning">NETWORK</span></h4></a>
				<hr width="100%" class="border-secondary">
				<a class="nav-link disabled text-warning font-weight-bold">Manage</a>
				<a href="#Dashbord" data-toggle="pill" class="nav-link active text-light ml-3">Dashbord</a>
				<a href="#Profile" data-toggle="pill" class="nav-link text-light ml-3">Profile</a>
				<hr width="100%" class="border-secondary"> 
				<button class="btn btn-block btn-warning font-weight-bold" data-target="#logout" data-toggle="modal" >Log Out</button>
			</div> 
		</nav>

</body>
</html>