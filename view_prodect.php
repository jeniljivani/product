<?php 
	include 'dashboard.php';
	$con = mysqli_connect("localhost","root","","product");

	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		$d_select = "select * from `product` where `id`=".$id;
		$del_res = mysqli_query($con,$d_select);
		$del_data= mysqli_fetch_assoc($del_res);
		$img = $del_data['image'];

		$delete = "delete from `product` where `id`=".$id;
		$pro_res = mysqli_query($con,$delete);

		if($img != '') {
        $img_path= "image/product/".$img;
        if(file_exists($img_path)) {
          unlink($img_path);
        }
      }
	}
	$user_id = $_SESSION['username']['id'];
	if(isset($_GET['page'])) {
		$page = $_GET['page'];
	}
	else
	{
		$page = 1;
	}

	if(isset($_GET['limit'])) {
		$limit = $_GET['limit'];
	}
	else
	{
		$limit = 4;
	}

	$start = ($page - 1) * $limit;
	if(isset($_GET['search'])) {
		$search = $_GET['search'];
		// SELECT * FROM `categery` WHERE `user_id` = 1 AND `categery` LIKE 'food' LIMIT 0,10;
		$pro_select = "select * from `product` where `user_id`='$user_id' and `title` like '%$search%' limit $start, $limit";
		$total_select = "select * from `product` where `user_id`='$user_id' and `title` like '%$search%'";
	}
	else {
		$pro_select = "select * from `product` where `user_id`='$user_id' limit $start,$limit";
		$total_select = "select * from `product` where `user_id`=".$user_id;
	}
	$total_res= mysqli_query($con ,$total_select);
	$total = mysqli_num_rows($total_res);
	if($total==0) {
		$msg = "this product is not..!";
	}
	$total_page = ceil($total/$limit);

	$pro_res = mysqli_query($con,$pro_select);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<style type="text/css">
		.page {
			padding: 5px 5px;
			background: darkgray;
		}
	</style>
</head>
<body>

	<form method="get">
		<table>
			<tr>
				<td>Data limit = </td>
				<td>
					<select name="limit">
						<option selected disabled hidden>limit select</option>
						<option value="1" <?php if($limit==1) { ?> selected <?php } ?>>1</option>
						<option value="2" <?php if($limit==2) { ?> selected <?php } ?>>2</option>
						<option value="5" <?php if($limit==5) { ?> selected <?php } ?>>5</option>
						<option value="10" <?php if($limit==10) { ?> selected <?php } ?>>10</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Search title :- </td>
				<td><input type="text" name="search" value="<?php echo @$search; ?>"></td>
			</tr>
			<tr>
				<td><input type="submit" name="submit" value="search"></td>
			</tr>
		</table>
		
		
	</form><br>
	<h3 style="color: red"><?php echo @$msg; ?></h3>
	<table border="1">
		<tr>
			<th>ID</th>
			<th>Title</th>
			<th>Description</th>
			<th>Price</th>
			<th>Quantity</th>
			<th>Category id</th>
			<th>Image</th>
			<th>Delete</th>
			<th>Update</th>
		</tr>
<?php 
		while ($pro = mysqli_fetch_assoc($pro_res)) 
		{
?>
		<tr>
			<td><?php echo @$pro['id']; ?></td>
			<td><?php echo @$pro['title']; ?></td>
			<td><?php echo @$pro['description']; ?></td>
			<td><?php echo @$pro['pries']; ?></td>
			<td><?php echo @$pro['contity']; ?></td>
			<td><?php echo @$pro['cat_name']; ?></td>
			<td>
				<img style="width: 100px; height: 100px;"  src="image/product/<?php echo @$pro['image']; ?>"> 
			</td>
			<td><a href="view_prodect.php?id=<?php echo @$pro['id']; ?>">Delete</a></td>
			<td><a href="add_prodect.php?id=<?php echo @$pro['id']; ?>">Update</a></td>
		</tr>
<?php 
		}
?>
	</table><br>
	<a class="page" href="view_prodect.php">All</a>
<?php 
		for ($i=1; $i <=$total_page ; $i++) 
		{ 
?>
				<a class="page" href="view_prodect.php?page=<?php echo @$i; if(isset($_GET['limit']) && isset($_GET['search'])) {?> &limit=<?php echo $_GET['limit']; ?>&search=<?php echo $_GET['search']; } ?>"><?php echo @$i; ?></a>	


<?php  
		}
?>
</body>
</html>