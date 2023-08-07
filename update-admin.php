<?php 
include('menu.php');
 ?>

<div class="main">
	<div class="wrapper">
<h1>Upadte Admin</h1><br><br>

<?php 
$id=$_GET['id'];
$select="SELECT * FROM tbl_admin WHERE id='$id'";
$data=mysqli_query($con,$select);

		$row=mysqli_fetch_assoc($data);
		$full_name=$row['full_name'];
		$username=$row['username'];

 ?>


<form action="" method="POST" enctype="multipart/form-data">


	<table class="tbl-add">
		
		<tr>
			<td>Full Name:</td>
			<td><input type="text"name="name" value="<?php echo $full_name?>"></td>
		</tr>
		<tr>
			<td>Username:</td>
			<td><input type="text"name="uname" value="<?php echo $username?>"></td>
		</tr>

			<tr>
				<td colspan="2">
					<input type="hidden" name="id" value="<?php echo $id;?>">
					<input type="submit" name="submit" value="update Admin" class="btn-secondary">
				</td>
			</tr>





	</table>

</form>
	</div>
</div>
 <?php 
include('footer.php');
  ?>

  <?php 
//check whether the submit button is click or not.
  if(isset($_POST['submit'])){
  	$name=$_POST['name'];
  	$user=$_POST['uname'];
  	$update="UPDATE tbl_admin SET full_name='$name',username='$user' WHERE id='$id'";
    $data=mysqli_query($con,$update);
  if($data){

  			$_SESSION['update']="<div class='btn-secondary'>Admin Updated Succcessfully.</div>";

   		header("location:".SITEURL.'admin/manage_admin.php');  //redirect the page
  		
  		}
  		else
  		{
  			// echo"plz check again";

  			$_SESSION['update']="<div class='btn-danger'>Failed to Delete Admin .</div>";

   		header("location:".SITEURL.'admin/manage_admin.php');  //redirect the page
  		}
  	}




  


   ?>