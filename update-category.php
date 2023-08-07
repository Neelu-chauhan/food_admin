<?php 	
include('menu.php');
 ?>

<div class="main">
	<div class="wrapper">
		<h1>Update Category	</h1><br><br>

		<?php 
    if(isset($_GET['id']))
    {
    	// echo "updated";
    	$id=$_GET['id'];
    	$select="SELECT * FROM tbl_category WHERE id='$id' ";
    	$data=mysqli_query($con,$select);
    	$count=mysqli_num_rows($data);
    	if($count==1)
    	{
    		$row=mysqli_fetch_assoc($data);
    		$title=$row['title'];
    		$current_img=$row['image_name'];
    		$featured=$row['featured'];
    		$active=$row['active'];
    	}
    	else
    	{
    		$_SESSION['no-category-found']="<div class='btn-danger'>Category not found.</div>";
    		header('Location:'.SITEURL.'admin/manage_category.php');

    	}

    }
    else{
    	header('Location:'.SITEURL.'admin/manage_category.php');
    	}
		 ?>
		<form action="" method="POST" enctype="multipart/form-data">
		<table class="tbl">
			 <tr>
				<td>Title:	</td>
				<td>
						<input type="text" name="title" value="<?php echo $title; ?>">
				</td>
			</tr>

			<tr>	
				<td>Current Image:	</td>
				<td>
					<?php 
					if($current_img!="")
					{
						?>

						<img src="<?php echo SITEURL;?>imgs/category/<?php echo $current_img; ?>"class="img-update">

						<?php
					}
					else
					{
						echo"<div class='btn-danger'>Image not Added.</div>";
					}
					 ?>
				</td>
			</tr>

			<tr>	
      <td>New Image:</td>
			   <td>	<input type="file" name="image" value="<?php echo $current_img; ?>"></td>
			</tr>
			<tr>
				<td>Featured:</td>
				<td>
					<input  <?php if($featured=='Yes'){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes

					
					<input <?php if($featured=='No'){echo "checked";} ?> type="radio" name="featured" value="No">No
				</td>
			</tr>
				<td>Active:</td>
				<td>
					<input  <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes
					<input  <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No">No
				</td>
			</tr>
			<tr>
				<td>
					<input type="hidden" name="current_img" value="<?php echo $current_img; ?>">
					<input type="hidden" name="id" value="<?php echo $id; ?>">
				<input type="submit" name="submit" class="btn-secondary" value="Update Category">
			</td>
			</tr>
		</table>
	</form>
	</div>
</div>
<?php 

if(isset($_POST['submit']))
{
// echo"clicked";
	$id=$_POST['id'];
	$title=$_POST['title'];
	$current_img=$_POST['current_img'];
	$featured=$_POST['featured'];
	$active=$_POST['active'];
	if(isset($_FILES['image']['name']))
	{
		$image_name=$_FILES['image']['name'];
		if($image_name!="")
		{
			//img availble
			//upload new img

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
			        header("Location:".SITEURL.'admin/manage_category.php');
			        //stop process
			        die();

				}
			//remove current img
				if($current_img!="")
				{
					
				$r_path="../imgs/category/".$current_img;

				$remove=unlink($r_path);
				//check img remove or not 
				if($remove==false)
				{
					$_SESSION['remove']="<div class='btn-danger'>Failed to remove current image.</div>";
					header('Location:'.SITEURL.'admin/manage_category.php');
					die();//stop 
				}
				}

		}
		else
		{
		$image_name=$current_img;

		}
	}
	else
	{
		$image_name=$current_img;
	}

	$update="UPDATE `tbl_category` SET `title`='$title',`image_name`='$image_name',`featured`='$featured',`active`='$active' WHERE id='$id'";
	$data=mysqli_query($con,$update);
	if($data)
	{
		// echo"updated";
		$_SESSION['category-update']="<div class='btn-secondary'>Category Updated Succcessfully.</div>";
		header('Location:'.SITEURL.'admin/manage_category.php');

	}
	else{
		// echo"plz check again";
				$_SESSION['category-update']="<div class='btn-danger'> Failed to Updated Category.</div>";
		    header('Location:'.SITEURL.'admin/manage_category.php');
	}
}
else
{

}

 ?>









 <?php 	
include('footer.php');
 ?>