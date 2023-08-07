<?php 
//start session
session_start();
define('SITEURL','http://localhost/php%20course/food_website/');

$host="localhost";
$user="root";
$password="";
$name="food_web1";
$con=mysqli_connect($host,$user,$password,$name);
// $data=mysqli_query($con);
if($con){
	// echo "database connected";
}
else{
	echo "please check again";
}

  ?>
<?php include('login_check.php');?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>food order website - home page</title>
	<link rel="stylesheet" type="text/css" href="admin.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.css">

	<style type="text/css">
		@media only screen and (max-width:960px){
	.main{
		width: 80%;
	}
}
	</style>
</head>
<body>
	<!-- menu section start here -->
	<div class="menu text-center">
		<div class="wrapper">
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="manage_admin.php">Admin</a></li>
			<li><a href="manage_category.php">Category</a></li>
			<li><a href="manage_food.php">Food</a></li>
			<li><a href="manage_order.php">Order</a></li>
			<li><a href="logout.php">Logout</a></li>

		</ul>
	</div>
	</div>
	<!-- menu section end here -->


</body>
</html>