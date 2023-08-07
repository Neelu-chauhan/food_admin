<?php
include('menu.php');

?>

<div class="main">
		<div class="wrapper">
	<h1>Manage Category</h1><br><br>
			<!-- <h1>Add Category</h1><br><br> -->
		<?php 
		if(isset($_SESSION['add']))
		{
			echo $_SESSION['add'];
			unset($_SESSION['add']);
		}
			if(isset($_SESSION['remove']))
		{
			echo $_SESSION['remove'];
			unset($_SESSION['remove']);
		}
		    if(isset($_SESSION['delete']))
		{
			echo $_SESSION['delete'];
			unset($_SESSION['delete']);
		}
		    if(isset($_SESSION['no-category-found']))
		{
			echo $_SESSION['no-category-found'];
			unset($_SESSION['no-category-found']);
		}
            if(isset($_SESSION['category-update']))
		{
			echo $_SESSION['category-update'];
			unset($_SESSION['category-update']);
		}
		    if(isset($_SESSION['upload']))
		{
			echo $_SESSION['upload'];
			unset($_SESSION['upload']);
		}
		   if(isset($_SESSION['remove']))
		{
			echo $_SESSION['remove'];
			unset($_SESSION['remove']);
		}
		 ?>
		 <br><br>
	<!-- button to add admin -->
 		<a href="<?php echo SITEURL; ?>admin/add_category.php" class="btn-primary">Add Category</a><br><br>

 		<table class="tbl" border="2px solid black">
 			<tr>
 				<th>S.N.</th>
 				<th>Title</th>
 				<th>Image</th>
 				<th>Featured</th>
 				<th>Active</th>
 				<th>Action</th>

 			</tr>
 			<?php 
 			$select="SELECT * FROM tbl_category";
 			$data=mysqli_query($con,$select);
 			$count=mysqli_num_rows($data);
 			//serial no
 			$sn=1;
 			if($count>0)
 			{
 				//we hava data in db
 				//display
 				while($row=mysqli_fetch_assoc($data))
 				{
 					$id=$row['id'];
 					$title=$row['title'];
 					$image_name=$row['image_name'];
 					$featured=$row['featured'];
 					$active=$row['active'];
 					?>

 			<tr>
 				<td><?php echo $sn++; ?></td>
 				<td><?php echo $title; ?></td>

 				<td><?php 
 				//check whether  img name availbe or not
 				if($image_name!="")
 				{
 					// display pic
 					?>
 					 
 					 <img src="<?php echo SITEURL; ?>imgs/Category/<?php  echo $image_name;?>" width="80px" class="img">
 					
 					<?php
 				}
 				else
 				{
 					//display mssge
 					echo "<div class='btn-danger'>Image not Added.</div>";
 				}

 				     ?></td>

 				<td><?php echo $featured; ?></td>
 				<td><?php echo $active; ?></td>

 				<td>
 		       <a href="<?php echo SITEURL;?>admin/update-category.php?id=<?php echo $id;?>" class="btn-secondary">Update Category</a>
 		        <a href="<?php echo SITEURL;?>admin/delete-category.php?id=<?php  echo $id;?> &image_name=<?php echo $image_name;?>"onclick='return confirm("Are you sure?")' class="btn-danger">Delete Category</a>

 				</td>

 			</tr>


 					<?php
 				}

 			}
 			else
 			{
 				// we dont have data
 				//we will display mssge inside table
 				?>
 				<tr>
 					<td colspan="6"><div class="btn-danger">No Category Added.</div></td>
 				</tr>
 				<?php 
 			}

 			 ?>
 			 		
 		</table>

</div>
</div>
<?php
include('footer.php');
?>