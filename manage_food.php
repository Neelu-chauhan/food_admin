<?php

include('menu.php');
?>
<div class="main">
	<div class="wrapper">
		<h1>Manage Food</h1><br><br>
		<?php 
		if(isset($_SESSION['add']))
		{
			echo $_SESSION['add'];
			unset($_SESSION['add']);
		}
		if(isset($_SESSION['delete']))
		{
			echo $_SESSION['delete'];
			unset($_SESSION['delete']);
		}
		if(isset($_SESSION['upload']))
		{
			echo $_SESSION['upload'];
			unset($_SESSION['upload']);
		}
		if(isset($_SESSION['unauthorized']))
		{
			echo $_SESSION['unauthorized'];
			unset($_SESSION['unauthorized']);
		}
				
		if(isset($_SESSION['uploadd']))
		{
			echo $_SESSION['uploadd'];
			unset($_SESSION['uploadd']);
		}
		if(isset($_SESSION['removee']))
		{
			echo $_SESSION['removee'];
			unset($_SESSION['removee']);
		}
		if(isset($_SESSION['updatee']))
		{
			echo $_SESSION['updatee'];
			unset($_SESSION['updatee']);
		}
	   ?><br>
		<!-- button to add admin -->
 		<a href="<?php echo SITEURL ?>admin/add-food.php" class="btn-primary">Add Food </a><br><br>

 		<table class="tbl" border="2px solid black" align="center">
 			<tr>
 				<th>S.N</th>
 				<th>Title</th>
 				<th>Price</th>
 				<th>Image</th>
 				<th>Featured</th>
 				<th>Active</th>
 				<th>Action</th>


 			</tr>
 			<?php 
 			//get all data from db
 			$select="SELECT * FROM tbl_food";
 			$data=mysqli_query($con,$select);
 			$count=mysqli_num_rows($data);
 			$sn=1;
 			if($count>0)
 			{
 				//have food in db
 				//get food from db
 				//display
 				while($row=mysqli_fetch_assoc($data))
 				{
 					$id=$row['id'];
 					$title=$row['title'];
 					$price=$row['price'];
 					$image=$row['image_name'];
 					$featured=$row['featured'];
 					$active=$row['active'];
 					?>
 				<tr>
 				<td><?php echo $sn++; ?></td>
 				<td><?php echo $title; ?></td>
 				<td>₹<?php echo $price; ?></td>
 				<td><?php 
 					//check we have img or not
 				if($image!="")
 				{
 					// display pic
 					?>
 					 
 					 <img src="<?php echo SITEURL; ?>imgs/food/<?php  echo $image;?>" width="80px" class="img">
 					
 					<?php
 				}
 				else
 				{
 					//display mssge
 					echo "<div class='btn-danger'>Image not Added.</div>";
 				}
 				 ?></td>
 				 </td>
 				<td><?php echo $featured;?></td>
 				<td><?php echo $active; ?></td>

 				<td>
 <a href="<?php echo SITEURL;?>admin/update-food.php?id=<?php echo $id;?>" class="btn-secondary">Update Food</a>					
 <a href="<?php echo SITEURL;?>admin/delete-food.php?id=<?php  echo $id;?> &image=<?php echo $image;?>"onclick='return confirm("Are you sure?")' class="btn-danger">Delete Food</a>



 				</td>
 			</tr>
 					<?php
 				}

 			}
 			else
 			{
 				// no food in db
 				echo"<tr><td colspan='7' class='btn-danger'>FOOD NOT ADDED.</td></tr>";
 			}

 			 ?>
 			</table>

	</div>
</div>

<?php

include('footer.php');
	?>