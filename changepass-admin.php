<?php 
include('menu.php');
 ?>
 <div class="main">
 <div class="wrapper">

 	<h1>Change Password</h1><br><br>


 	<?php 
 	if(isset($_GET['id']))
 	{
 		$id=$_GET['id'];

 	}
 	 ?>
 	


 	<form action="" method="POST" enctype="multipart">
 		<table class="tbl-add">
 			<tr>
 				<td>Current Password:</td>
 				<td>
 					<input type="Password" name="oldPass" value="" placeholder="Enter Current Password">
 				</td>
 			</tr>

 			<tr>
 				<td>New Password:</td>
 				<td>
 					<input type="Password" name="newPass" value="" placeholder="Enter New Password">
 				</td>
 			</tr>

 			<tr>
 				<td>Confirm Password:</td>
 				<td>
 					<input type="Password" name="confPass" value="" placeholder="Enter Confirm Password">
 				</td>
 			</tr>

 			<tr>
 				<td colspan="2">
 					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<input type="submit" name="submit" value="Change Password" class="btn-secondary">
 					
 				</td>
 			</tr>

 		</table>



 	</form>
 </div>
 </div>


 <?php 
include('footer.php')
  ?>
<?php 
if(isset($_POST['submit'])){
	// echo "clicked";
	$id=md5($_POST['id']);
	$currentp=md5($_POST['oldPass']);
	$newp=md5($_POST['newPass']);
	$confirmp=md5($_POST['confPass']);

	$select="SELECT * FROM tbl_admin WHERE id='$id' AND password='$currentp'";
	$data=mysqli_query($con,$select);
	if($data==true){
		// echo "password change"
			// echo "User found";
			if($newp==$confirmp)
			{
				$sql="UPDATE tbl_admin SET password='$newp' WHERE  id='$id'";

        $data2=mysqli_query($con,$sql);
				if($data2==true){
			$_SESSION['Password change successfully']="<div class='btn-secondary'>Password change successfully .</div>";
			header("Location:".SITEURL.'admin/manage_admin.php');

					}
				else{

			$_SESSION['Password not changed']="<div class='btn-danger'>Failed to change Password.</div>";
			header("Location:".SITEURL.'admin/manage_admin.php');
					}
						}
			else{
				//redirect the admin page
			$_SESSION['Pwd-not-match']="<div class='btn-danger'>Password didn't match.</div>";
			header("Location:".SITEURL.'admin/manage_admin.php');


			}
		}
		else{
			$_SESSION['user-not-found']="<div class='btn-danger'>User not found.</div>";
			//redirect the user
			header("Location:".SITEURL.'admin/manage_admin.php');

		}
	}
 ?>


















