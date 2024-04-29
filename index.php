<?php 
	session_start();
	$con = mysqli_connect("localhost","root","","product");
	if(isset($_SESSION['username'])) {
		header("location:dashboard.php");
	}
	if(isset($_POST['submit']))
	{
		$email = $_POST['email'];
		$password = $_POST['password'];

		$login_select = "select * from `login` where `email`='$email' and `password`='$password'";
		$res = mysqli_query($con,$login_select);
		$cnt = mysqli_num_rows($res);
		// echo $cnt;
		if($cnt>=1) 
		{
			$login_data = mysqli_fetch_assoc($res);
			$_SESSION['username'] = $login_data;
			header("location:dashboard.php");
		}
		else {
			$msg = "your email and password wrong !";
		}
	}



?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>login page</title>
</head>
<body>
	<h2 style="color: red"><?php echo @$msg; ?></h2>
	<form method="post">
		<table border="1">
			<tr>
				<td>EMAIL :-</td>
				<td><input type="email" name="email"></td>
			</tr>
			<tr>
				<td>PASSWORD :-</td>
				<td><input type="password" name="password"></td>
			</tr>
			<tr>
				<td><input type="submit" name="submit"></td>
			</tr>
		</table>
	</form>
	<a href="register.php">register user</a>

</body>
</html>