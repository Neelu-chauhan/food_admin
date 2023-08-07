
<?php 
include('menu.php');
 ?>
<div class="main">
	<div class="wrapper">
	<h1>Add Admin</h1><br><br>
	    <?php 
    if(isset($_SESSION['add']))
    {
      echo $_SESSION['add'];  //use to display session messge
      unset($_SESSION['add']); //use to remove session massge
    }

     ?>
     <br><br>


	<form action="" method="POST" enctype="multipart/form-data">
		
		<div>
			
			<table class="tbl-add">
				<tr>
					<td>Full Name:</td>
					<td><input type="text" name="fname" placeholder="Enter your name" required></td>
				</tr>
				<tr>
					<td>Username:</td>
					<td><input type="text" name="uname" placeholder="Enter  username" required></td>
				</tr>	
				<tr>
					<td>Password:</td>
					<td><input type="Password" name="keys" placeholder="Enter  your Password" required></td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Add Admin" class="btn-secondary" required>
					</td>
				</tr>

			</table>  
		</div>
	</form>
	</div>
</div>
 <?php 
 include('footer.php');
  ?>
  <?php 
 // process the value from form and save it in db

   if(isset($_POST['submit']))
   {
   	$fname=$_POST['fname'];
   	$uname=$_POST['uname'];
   	$password=$_POST['keys'];  //use to encryption with md5 
   	$insert="INSERT INTO tbl_admin(full_name, username, password) VALUES ('$fname','$uname','$password')";
   	$data=mysqli_query($con,$insert);
   	if($data){
   		// echo"data inserted in db";
   		$_SESSION['add']="Admin Added Successfully.";
   		//redirect page
   		header("location:".SITEURL.'admin/manage_admin.php');
   	}
   	else{
   		// echo"please check again";
   		 $_SESSION['add']=" Failed To Admin Added .";
   		//redirect page
   		header("location:".SITEURL.'admin/add_admin.php');
   	}
}
   ?>