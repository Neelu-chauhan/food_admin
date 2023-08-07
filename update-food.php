 <?php 	
include('menu.php');
// echo "updated";
 ?>

<div class="main">
	<div class="wrapper">
		<h1>Update Food	</h1><br><br>

		<?php 
    if(isset($_GET['id']))
    {
    	// echo "updated";
    	$id=$_GET['id'];
    	$select="SELECT * FROM tbl_food WHERE id='$id' ";
    	$data=mysqli_query($con,$select);
    	$count=mysqli_num_rows($data);
    	if($count==1)
    	{
    		$row=mysqli_fetch_assoc($data);
    		$title=$row['title'];
    		$description=$row['description'];
    		$price=$row['price'];
    		$current_img=$row['image_name'];
    		$current_category=$row['category_id'];
    		$featured=$row['featured'];
    		$active=$row['active'];
    	}
    	else
    	{
    		$_SESSION['no-category-found']="<div class='btn-danger'>Category not found.</div>";
    		header('Location:'.SITEURL.'admin/manage_food.php');

    	}

    }
    else{
    	header('Location:'.SITEURL.'admin/manage_food.php');
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
				<td>:description</td>
				<td>
					<textarea name="description" cols="30" rows="5" value=""> <?php echo $description; ?></textarea>
				</td>
			</tr>
		     <tr>
				<td>Price:	</td>
				<td>
						<input type="text" name="price" value="<?php echo $price; ?>">
				</td>
			</tr>

			<tr>	
				<td>Current Image:	</td>
				<td>
					<?php 
					if($current_img!="")
					{
						?>

						<img src="<?php echo SITEURL;?>imgs/food/<?php echo $current_img; ?>"class="img-update">

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
			<td>Current Category:</td>
 					<td>
 						<select name="category">
 							<?php 
 							//display category from db
 							$select="SELECT * FROM tbl_category WHERE active='Yes'";
 							$data=mysqli_query($con,$select);
 							$count=mysqli_num_rows($data);
 							if($count>0)
 							{
 								//have category
 								while($row=mysqli_fetch_assoc($data))
 								{
 									//get the value
 									$idd=$row['id'];
 									$title=$row['title'];
 									?>


 								<option <?php if($current_category==$idd){ echo "selected";} ?> value="<?php echo $idd;?>"><?php  echo $title; ?></option>
 									<?php
 								}
 							}
 							else
 							{
 								//no category
 								echo "<option value='0'>Category not available.</option>";
 								?>

 								<?php
 							}
 							 ?>
 								<option value="0">Test Category.</option>
						</select>
 					</td>
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
    $description=$_POST['description'];
	$price=$_POST['price'];
	$current_img=$_POST['current_img'];
	$category=$_POST['category'];


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
				$image_name="Food_name_".rand(0000,9999).'.'.$text; 

//upload img to get src path and dstntion path
				$source_path=$_FILES['image']['tmp_name'];

				$destination="../imgs/food/".$image_name;
				//upload mage
				$upload=move_uploaded_file($source_path, $destination);
				if($upload==false)//check img upload or not
				{
					$_SESSION['uploadd']="<div class='btn-danger'>Failed to upload Image.</div>";
			        header("Location:".SITEURL.'admin/manage_food.php');
			        //stop process
			        die();

				}
			//remove current img
				if($current_img!="")
				{
					//img availble
				$r_path="../imgs/food/".$current_img;

				$remove=unlink($r_path);
				//check img remove or not 
				if($remove==false)
				{
					$_SESSION['removee']="<div class='btn-danger'>Failed to remove current image.</div>";
					header('Location:'.SITEURL.'admin/manage_food.php');
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
			

	
	

	$update="UPDATE `tbl_food` SET title='$title',description='$description',price=$price,image_name='$image_name',category_id='$category',featured='$featured',active='$active' WHERE id='$id'";
	echo $update;

	$data=mysqli_query($con,$update);
	if($data)
	{
		// echo"updated";
		$_SESSION['updatee']="<div class='btn-secondary'>Food updated successfully.</div>";
		echo "done";
		header('Location:'.SITEURL.'admin/manage_food.php');

	}
	else{
		// echo"plz check again";
		echo mysqli_error($con);
				$_SESSION['updatee']='<div class="btn-danger">Failed to Updated Foood.</div>'.mysqli_error($con);
		    header('Location:'.SITEURL.'admin/manage_food.php');
	}

}

 ?>
 <?php 	
include('footer.php');
 ?>