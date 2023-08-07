<?php 

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
<script type="text/javascript">
    function checkdata(){
        return confirm('Are You Sure?');
    }
</script>

<?php 	
  //check whether id & img value is set or not
if(isset($_GET['id']) AND isset($_GET['image_name']))
{
//delete
	// echo"get value";
	$id=$_GET['id'];
	$image_name=$_GET['image_name'];

	//delete physical img 
	if($image_name!="")
	{
		$path="../imgs/category/".$image_name;
		//remove the image
		$remove=unlink($path);
		if($remove==false)
		{
			$_SESSION['remove']="<div class='btn-danger'>Failed to remove img</div>";
           header('Location:'.SITEURL.'admin/manage_category.php');

			 die();
		}
	}
	$delete="DELETE FROM tbl_category WHERE id=$id";
	$data=mysqli_query($con,$delete);
	if($data)
	{
		echo "data deleted";
					$_SESSION['delete']="<div class='btn-secondary'>category deleted successfully.</div>";
           header('Location:'.SITEURL.'admin/manage_category.php');

	}
	else
	{
		echo "please check again";
					$_SESSION['delete']="<div class='btn-danger'>Failed to Delete category.</div>";
           header('Location:'.SITEURL.'admin/manage_category.php');
	}

}
else
{
header('Location:'.SITEURL.'admin/manage_category.php');
}



 ?>
