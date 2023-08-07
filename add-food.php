<?php 
// echo"addded";
include('menu.php');
?>
 <div class="main">
 	<div class="wrapper">
 		<h1>Add Food</h1><br><br>

 		<?php 
 			if(isset($_SESSION['upload']))
		{
			echo $_SESSION['upload'];
			unset($_SESSION['upload']);
		
		}
 		?>
 		<br><br>
 		<form action="" method="POST" enctype="multipart/form-data">
 			<table class="tbl">
 				<tr>
 					<td>
 						Title:
 					</td>
 					<td>
 						<input type="text" name="title" placeholder="Title of the food" value="">
 					</td>
 				</tr>
 				<tr>
 					<td>Description:</td>
 					<td>
 						<textarea name="description" cols="30" rows="5" placeholder="Description of the food"></textarea>
 					</td>
 				</tr>
 				<tr>
 					<td>Price:</td>
 					<td>
 						<input type="number" name="price" >
 					</td>
 				</tr>
 				<tr>
 					<td>Select Image:</td>
 					<td><input type="file" name="image"></td>
 				</tr>
 				<tr>
 					<td>Category:</td>
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
 									$id=$row['id'];
 									$title=$row['title'];
 									?>
 								<option value="<?php echo $id;?>"><?php  echo $title; ?></option>


 									<?php
 								}
 							}
 							else
 							{
 								//no category
 								?>
 								<option value="0">No Category found.</option>

 								<?php
 							}
 							 ?>
						</select>
 					</td>
 				</tr>
 				<tr>
 					<td>Featured:</td>
 					<td>
 						<input type="radio" name="featured" value="Yes">Yes
 						<input type="radio" name="featured" value="No">No
 					</td>
 				</tr>
 				<tr>	
 					<td>Active:</td>
 					<td>
 						 <input type="radio" name="active" value="Yes">Yes
 						<input type="radio" name="active" value="No">No
 						</td>
 				</tr>
 				<tr>
 					<td colspan="2">
 						<input type="submit" name="submit" value="Add Food" class="btn-secondary">
 					</td>
 				</tr>
 			</table>
 		</form>
 		<?php 

 		//check the add btn click or not
 		if(isset($_POST['submit']))
 		{
 			//get data from form
 			//insert into db
 			//upload img
 			//redirect to mnge food

 			$title=$_POST['title'];
 			$description=$_POST['description'];
 			$price=$_POST['price'];
 			$category=$_POST['category'];
 			
 			//featured
 			if(isset($_POST['featured']))
 			{
 				$featured=$_POST['featured'];

 			}
 			else
 			{
 				$featured="No";
 			}

 			//active
 			if(isset($_POST['active']))
 			{
 				$active=$_POST['active'];
 			}
 			else
 			{
 				$active="No";
 			}

 		}
 		//check select img click or not upload img if it selected
 		if(isset($_FILES['image']['name']))
 		{
 			//get the detailed 
			$image_name=$_FILES['image']['name'];

 			if($image_name!="")
 			{
 				//img is selected
 				//remain img 
 				//upload img 
 				//give the extention like jpg png etc
				$text=end(explode('.',$image_name));
				//rename the img
				$image_name="Food_Name_".rand(0000,9999).'.'.$text; //new img name like food name-7654.png


				$source_path=$_FILES['image']['tmp_name'];

				$destination="../imgs/food/".$image_name;
				//upload mage
				$upload=move_uploaded_file($source_path, $destination);
				if($upload==false)
				{
					$_SESSION['upload']="<div class='btn-danger'>Failed to upload Image.</div>";
			        header("Location:".SITEURL.'admin/add_food.php');
			        //stop process
			        die();

				}
 			}
 		else
 		{
 			$image_name=""; //blank value
 		}

 		  $insert="INSERT INTO `tbl_food`(title, description, price, image_name, category_id, featured, active) VALUES ('$title','$description','$price','$image_name','$category','$featured','$active')";
 		     $data=mysqli_query($con,$insert);

 		     if($data==true)
 	     	{
 			//data inserted
 			$_SESSION['add']="<div class='btn-secondary'>Food Added Successfully.</div>";
 			header('Location:'.SITEURL.'admin/manage_food.php');
 		    }
 		   else
 		   {
 		 	//failed
 			$_SESSION['add']="<div class='btn-danger'>Failed to Added Food.</div>";
 			header('Location:'.SITEURL.'admin/manage_food.php');
 			}
 		

 		}
 		 ?>


 	</div>
 </div>
 <?php 
include('footer.php');


?>