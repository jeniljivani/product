<?php 
	
	include 'dashboard.php';
	$con = mysqli_connect("localhost","root","","product");

	if(isset($_GET['id'])) 
	{
		$id = $_GET['id'];
		$update = "update `product` set `cat_name`='No category' where `cat_name`=".$id;
		$delete = "delete from `categery` where `id`=".$id;
		mysqli_query($con,$update);
		$cat_res = mysqli_query($con,$delete);
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
		$limit = 5;
	}

	$start = ($page - 1) * $limit;
	if(isset($_GET['search'])) {
		$search = $_GET['search'];
		$categert_select = "select * from `categery` where `user_id`='$user_id' and `categery` like '%$search%' limit $start, $limit";
		$total_select = "select * from `categery` where `user_id`='$user_id' and `categery` like '%$search%'";
	}
	else {
		$categert_select = "select * from `categery` where `user_id`='$user_id' limit $start,$limit";
		$total_select = "select * from `categery` where `user_id`=".$user_id;
	}
	$total_res= mysqli_query($con ,$total_select);
	$total = mysqli_num_rows($total_res);
	$total_page = ceil($total/$limit);

	$cat_res = mysqli_query($con,$categert_select);
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
				<td>Search category :-</td>
				<td><input type="text" name="search" value="<?php echo @$search; ?>"></td>
			</tr>
			<tr>
				<td><input type="submit" name="submit" value="search"></td>
			</tr>
		</table>
		<!-- <input type="number" max="<?php echo @$total; ?>" name="limit" value="<?php echo @$limit; ?>"> 
		Search category :- <input type="text" name="search" value="<?php echo @$search; ?>">
		<input type="submit" name="submit" value="search"> -->
	</form><br>

<table border="1">
	<tr>
		<th>ID</th>
		<th>NAME</th>
		<th>Delete</th>
		<th>Update</th>
	</tr>
<?php 
	while($data = mysqli_fetch_assoc($cat_res))
	{
?>
	<tr>
		<td><?php echo @$data['id']; ?></td>
		<td><?php echo @$data['categery']; ?></td>
		<td><a href="view_categery.php?id=<?php echo @$data['id']; ?>">Delete</a></td>
		<td><a href="add_categery.php?id=<?php echo @$data['id']; ?>">Update</a></td>
	</tr>
<?php } ?>
</table><br>
	<a class="page" href="view_categery.php">All</a>
<?php 
	
	for ($i=1; $i<=$total_page ; $i++) 
	{ 
?>
	<a class="page" href="view_categery.php?page=<?php echo @$i; if(isset($_GET['limit']) && isset($_GET['search'])) {?> &limit=<?php echo $_GET['limit']; ?>&search=<?php echo $_GET['search']; } ?>"><?php echo @$i; ?></a>	

<?php 
	}

?>

</body>
</html>