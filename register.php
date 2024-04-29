<?php 
	$con = mysqli_connect("localhost","root","","product");

	if(isset($_POST['submit'])) {	
		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$contact = $_POST['contact'];
		$address = $_POST['address'];
		$image = $_FILES['image']['name'];
		$path = "image/user_image/".$image;
		move_uploaded_file($_FILES['image']['tmp_name'], $path);

		$select = "select * from `login` where `email`='$email'";
		$res= mysqli_query($con,$select);
		$cnt = mysqli_num_rows($res); 
		// echo $cnt;
		if($cnt==0){
			$insert = "insert into `login`(`name`,`email`,`password`,`contact`,`address`,`image`)values('$name','$email','$password','$contact','$address','$image')";
			mysqli_query($con,$insert);
			header("location:index.php");
		}
		else
		{
			$msg = "this email id already store";
		}

	
	}
	
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>register page</title>
	<style type="text/css">
		.table {
			background: aliceblue ;
		}
	</style>
</head>
<body>

	<h3><?php echo @$msg; ?></h3>
	<form method="post" enctype="multipart/form-data">
		<table border="1" class="table">
			<tr>
				<td>NAME :-</td>
				<td><input type="text" name="name"></td>
			</tr>
			<tr>
				<td>EMAIL :-</td>
				<td><input type="email" name="email"></td>
			</tr>
			<tr>
				<td>PASSWORD :-</td>
				<td><input type="password" name="password"></td>
			</tr>
			<tr>
				<td>CONTACT :-</td>
				<td><input type="number" name="contact"></td>
			</tr>
			<tr>
				<td>ADDRESS :-</td>
				<td><textarea name="address"></textarea></td>
			</tr>
			<tr>
				<td>IMAGE :-</td>
				<td><input type="file" name="image"></td>
			</tr>
			<tr>
				<td><input type="submit" name="submit"></td>
			</tr>
		</table>
	</form>
	<a href="index.php">login page</a>

</body>
</html>