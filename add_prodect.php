<?php 

	include 'dashboard.php';
	$con = mysqli_connect("localhost","root","","product");

	if(isset($_GET['id'])) {
		$id  = $_GET['id'];
		$pro_select = "select * from `product` where `id`=".$id;
		$pro_res = mysqli_query($con,$pro_select);
		$pro_data = mysqli_fetch_assoc($pro_res);
	}
	$user_id = $_SESSION['username']['id'];
	$cat_select = "select * from `categery` where `user_id`=".$user_id;
	$cat_res = mysqli_query($con,$cat_select);

	if(isset($_POST['submit'])) {

		$title = $_POST['title'];
		$description = $_POST['description'];
		$pries = $_POST['pries'];
		$contity = $_POST['contity'];
		$categery = $_POST['categery'];
		$image = $_FILES['image']['name'];

		$path = "image/product/".$image;
		move_uploaded_file($_FILES['image']['tmp_name'], $path);

		if($image=="") {
			$image = $pro_data['image'];
		}


		if(isset($_GET['id'])) {
			$update = "update `product` set `title`='$title' , `description`='$description',`pries`='$pries',`contity`='$contity',`image`='$image',`cat_name`='$categery' where `id`=".$id;
			mysqli_query($con,$update);
			header("location:view_prodect.php");
		}
		else 
		{
			$insert = "insert into `product`(`title`,`description`,`pries`,`contity`,`image`,`cat_name`,`user_id`)values('$title','$description','$pries','$contity','$image','$categery','$user_id')";
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
	<form method="post" enctype="multipart/form-data">
		<table border="1">
			<tr>
				<td>Title :-</td>
				<td><input type="text" name="title" value="<?php echo @$pro_data['title']; ?>"></td>
			</tr>
			<tr>
				<td>Description	 :-</td>
				<td><input type="text" name="description" value="<?php echo @$pro_data['description']; ?>"></td>
			</tr>
			<tr>
				<td>Prics :-</td>
				<td><input type="number" min="1" name="pries" value="<?php echo @$pro_data['pries']; ?>"></td>
			</tr>
			<tr>
				<td>Quantity :-</td>
				<td><input type="number" min="1" name="contity" value="<?php echo @$pro_data['contity']; ?>"></td>
			</tr>
			<tr>
				<td>Category:-</td>
				<td>
					<select name="categery" >
						<option selected disabled >select categery</option>
<?php  
						while ($cat = mysqli_fetch_assoc($cat_res)) 
						{						
?>				
						<option value="<?php echo $cat['id']; ?>" <?php if(@$pro_data['cat_name']==@$cat['id']) { ?> selected <?php } ?>><?php echo $cat['categery']; ?></option>					
<?php  					
						}	
?>

					</select>
				</td>
			</tr>
			<tr>
				<td>Image :-</td>
				<td><input type="file" name="image" value=""><img style="width: 70px" src="image/product/<?php echo @$pro_data['image']; ?>"> </td>
			</tr>
			<tr>
				<td><input type="submit" name="submit"></td>
			</tr>

		</table>
	</form>

</body>
</html>