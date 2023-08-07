<?php 
include('menu.php');

 ?>


<div class="main">
	<div class="wrapper">	
		<h1>Add Category</h1><br><br>
		<?php 
		if(isset($_SESSION['add']))
		{
			echo $_SESSION['add'];
			unset($_SESSION['add']);
		}

		if(isset($_SESSION['upload']))
		{
			echo $_SESSION['upload'];
			unset($_SESSION['upload']);
		
		}

		 ?><br><br>
		<!-- Add form start -->
		<form action="" method="POST" enctype="multipart/form-data">
			<table class="tbl-add">
				<tr>
					<td>Title:</td>
					<td>
						<input type="text" name="title" placeholder="Category Title">
					</td>
				</tr>
				<tr>
					<td>Select Image:</td>
					<td>
						<input type="file" name="image">
					</td>
				</tr>
				<tr>
					<td>Featured:</td>
					<td>
						<input type="radio" name="Featured" value="yes">Yes
						<input type="radio" name="Featured" value="No">No

					</td>
				</tr>
				<tr>
					<td>Active</td>
					<td>
						<input type="radio" name="active" value="yes">Yes
						<input type="radio" name="active" value="NO">No
						
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Add Category" class="btn-secondary">
					</td>
				</tr>
			</table>



		</form>

		<!-- Add form end-->


		<?php 
		if(isset($_POST['submit']))
		{
			$title=$_POST['title'];
		//for radio input type we need to check the button selected or not
			if(isset($_POST['Featured']))
			{
				//get the value
				$feature=$_POST['Featured'];
			}
			else
			{
				//set default value
				$feature="No";
			}

			//for active

			if(isset($_POST['active']))
			{
				$active=$_POST['active'];
			}
			else
			{
				$active="No";
			}
		//image

			// print_r($_FILES['image']);
			// die(); //break the code here 
			if(isset($_FILES['image']['name']))
			{
				//upload 
				//source path destination path
				$image_name=$_FILES['image']['name'];

				if($image_name!="")
				{




				//for extension of img
				$text=end(explode('.',$image_name));
				//rename the img
				$image_name="Food_category_".rand(000,999).'.'.$text; 


				$source_path=$_FILES['image']['tmp_name'];

				$destination="../imgs/category/".$image_name;
				//upload mage
				$upload=move_uploaded_file($source_path, $destination);
				if($upload==false)
				{
					$_SESSION['upload']="<div class='btn-danger'>Failed to upload Image.</div>";
			        header("Location:".SITEURL.'admin/add_category.php');
			        //stop process
			        die();

				}
			}

		}
			else{
				//dont upload
				$image_name="";
			}

		

		$insert="INSERT INTO tbl_category SET title='$title',image_name='$image_name' ,featured='$feature', active='$active'"; 
		// $insert="INSERT INTO `tbl_category`(title,featured, active) VALUES ('$title','$feature','$active')";

		$data=mysqli_query($con,$insert);
		if($data)
		{
			// echo"data are inserted";

			$_SESSION['add']="<div class='btn-secondary'>Category Added Successfully.</div>";
			header("Location:".SITEURL.'admin/manage_category.php');
		}
		else
		{
			echo"Failed!!!!";

			$_SESSION['add']="<div class='btn-danger'>Failed to Add Category .</div>";
			header("Location:".SITEURL.'admin/manage_category.php');
		}
}

		 ?>


	</div>
</div>




 <?php 
include('footer.php');

 ?>