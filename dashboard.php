<?php
	session_start();
	$con = mysqli_connect("localhost","root","","product");
	if(!isset($_SESSION['username'])) {
		header("location:index.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>dashboard page</title>
	<style type="text/css">
		.link {
			text-decoration: none;
			color: black;
			padding: 5px 10px;
			margin: 0px 5px;
			background: lightgray;
			margin-bottom: 10px;
			
		}
		.link:hover {
			background: darkgray;
		}
		h1 , h2 , h3 , h4 ,h5 ,h6 {
			margin: 0px;
			padding: 0px;
		}
		.top {
			display: flex;
/*			justify-content: space-between	;*/
		}
		.info {
			margin-left: 20px;
		}

	</style>
</head>
<body>

	<div class="top">
		<div>
			<img style="width: 100px;" src="image/user_image/<?php echo @$_SESSION['username']['image']; ?>">
		</div>
		<div class="info">
			<h2><?php echo @$_SESSION['username']['name']; ?></h2>
			<h4><?php echo @$_SESSION['username']['email']; ?></h4>
		</div>
	</div>

	<div class="top">
		<a href="add_categery.php" class="link"> Add categeoy</a>
		<a href="view_categery.php" class="link"> View category</a>
		<a href="add_prodect.php" class="link">Add product</a>
		<a href="view_prodect.php" class="link">View product</a>
		<a href="logout.php" class="link">logout</a>
	</div>

</body>
</html>