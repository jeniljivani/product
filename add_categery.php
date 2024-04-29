<?php 

	include 'dashboard.php';
	$con = mysqli_connect("localhost","root","","product");

	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		$cat_select = "select * from `categery` where `id`=".$id;
		$cat_res = mysqli_query($con , $cat_select);
		$cat_data = mysqli_fetch_assoc($cat_res);
	}


	if(isset($_POST['submit'])) {
		$user_id = $_SESSION['username']['id'];
		$categery = $_POST['categery'];
		if(isset($_GET['id'])) {
			$update = "update `categery` set `categery`='$categery' where `id`=".$id;
			mysqli_query($con,$update);
			header("location:view_categery.php");
		}
		else
		{
			$insert = "insert into `categery`(`user_id`,`categery`)values('$user_id','$categery')";
			mysqli_query($con,$insert);
		}

	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>

	<form method="post">
		<table>
			<tr>
				<td>Category :-</td>
				<td><input type="text" name="categery" value="<?php echo @$cat_data['categery']; ?>"></td>
  <!-- "smartphones",
  "laptops",
  "fragrances",
  "skincare",
  "groceries",
  "home-decoration",
  "furniture",
  "tops",
  "womens-dresses",
  "womens-shoes",
  "mens-shirts",
  "mens-shoes",
  "mens-watches",
  "womens-watches",
  "womens-bags",
  "womens-jewellery",
  "sunglasses",
  "automotive",
  "motorcycle",
  "lighting" -->
			</tr>
			<tr>
				<td><input type="submit" name="submit"></td>
			</tr>
		</table>
	</form>

</body>
</html>