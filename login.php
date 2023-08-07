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


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>LOGIN PAGE</title>
	<link rel="stylesheet" type="text/css" href="admin.css">
	<style type="text/css">
		.login{
	width: 20%;
	border: 1px solid gray;
	margin:10% auto ;
	padding: 2%;
}

.neelu1 input{
	padding: 2%;
	margin: 0.5%;
	width: 70%;
	font-weight: bold;
/*	background-color: white;*/
}

	</style>
</head>
<body>
	<div class="login">	
		<h1 class="text-center" >Login</h1>
		<?php 
		if(isset($_SESSION['login']))
		{
			echo $_SESSION['login'];
			unset ($_SESSION['login']);

		}
		if(isset($_SESSION['no-login-messge']))
		{
			echo $_SESSION['no-login-messge'];
			unset ($_SESSION['no-login-messge']);
		}


		 ?>
		 <br><br>

		<form action="" method="POST" enctype="multipart/form-data">
		<div class="neelu1">
		<label>Username:</label><br>	
			<input type="name" name="name" placeholder="Enter username" required ><br><br>
		<label>Password:</label><br>	
			<input type="Password" name="pass" placeholder="Enter your Password" required><br><br>
	</div>
	<input type="submit" name="submit" value="Login" class=" btn-primary "><br><br>





		</form>


		<p class="text-center">Created by-<a href="neeelu">Neelu</a></p>
	</div>

</body>
</html>

<?php 
if(isset($_POST['submit']))
{
	$name=$_POST['name'];
	$pass=$_POST['pass'];
	// echo $name;
	$select="SELECT * FROM tbl_admin WHERE username='$name' AND password='$pass'";
	$data=mysqli_query($con,$select);
	$count=mysqli_num_rows($data);
	if($count==1)
	{
		// //user available
			$_SESSION['login']="<div class='btn-secondary'>Login successfull.</div>";
			$_SESSION['user']=$name; //check user logged or not
			header("Location:".SITEURL.'admin/index.php');
	}
	else{

			$_SESSION['login']="<div class='btn-danger'>Username & password didn't same.</div>";
			header("Location:".SITEURL.'admin/login.php');

	}
}


 ?>