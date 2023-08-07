<?php 	
// echo "delete food";<?php 

// //start session
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
<?php 
if(isset($_GET['id'])&& isset($_GET['image']))//&&=AND
{
//delete
	// echo "process to delete";
	//1.get id and img name
	$id=$_GET['id'];
	$image=$_GET['image'];

	//2.remove the img if availble
	if($image!="")
	{
		//it hasimg
		$path="../imgs/food/".$image;
		//remove img file from folder
		$remove=unlink($path);
		if($remove==false)
		{
			//failed to remove
    $_SESSION['upload']="<div class='btn-danger'>Failed to remove image.</div>";
	header('Location:'.SITEURL.'admin/manage_food.php');
	die();

		}
	}
	//3.delete food from database
	$delete="DELETE FROM tbl_food WHERE id=$id";
	$data=mysqli_query($con,$delete);
	//4.redirect
	if($data==true)
	{
		//foood deleted
	$_SESSION['delete']="<div class='btn-secondary'>Food delete successfully.</div>";
	header('Location:'.SITEURL.'admin/manage_food.php');


	}
	else
	{
		//failed
	$_SESSION['delete']="<div class='btn-danger'>Failed to Delete food.</div>";
	header('Location:'.SITEURL.'admin/manage_food.php');
	}


}
else
{
//redirect
	// echo "Redirect";
	$_SESSION['unauthorized']="<div class='btn-danger'>Unauthorized Access.</div>";
	header('Location:'.SITEURL.'admin/manage_food.php');

}



 ?>