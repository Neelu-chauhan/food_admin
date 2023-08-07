<?php 
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

// get the id to delete the admin
$id=$_GET['id'];
$delete="DELETE FROM `tbl_admin` WHERE id='$id'";
$data=mysqli_query($con,$delete);
if($data)
{
?>
<script type="text/javascript">
	window.open("http://localhost/php%20course/food_website/admin/manage_admin.php","_self");
</script>
<?php
}
else
{
?>
	<script type="text/javascript">
	alert("Try again!");
</script>
<?php
}

 ?>