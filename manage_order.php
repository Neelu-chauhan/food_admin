<?php
include('menu.php');
?>
<div class="main">
	<div class="wrapper">
		<h1>Manage Order</h1><br><br>

		<?php 
		if(isset($_SESSION['update']))
		{
			echo $_SESSION['update'];
			unset($_SESSION['update']);
		}

		?>
		<br>
		<!-- button to add admin -->
 		<a href="" class="btn-primary">Add Order</a><br><br>

 		<table class="tbl" border="2px solid black">
 			<tr>
 				<th>S.N</th>
 				<th>Food</th>
 				<th>Price</th>
 				<th>Qty.</th>
 				<th>Total</th>
 				<th>Order date</th>
 				<th>Status</th>
 				<th>Name</th>
 				<th>Contact</th>
 				<th>Email</th>
 				<th>Address</th>
 				<th>Action</th>
 			</tr>
 			<?php 
 			$select="SELECT * FROM tbl_order Order by id desc";
 			$data=mysqli_query($con,$select);
 			$count=mysqli_num_rows($data);
 			$sn=1;
 			if($count>0)
 			{
 				//oreder availble
 				while($row=mysqli_fetch_assoc($data))
 				{
 					$id=$row['id'];
 					$food=$row['food'];
 					$price=$row['price'];
 					$qty=$row['qty'];
 					$total=$row['total'];
 					$order_date=$row['order_date'];
 					$status=$row['status'];
 					$customer_name=$row['customer_name'];
 					$customer_contact=$row['customer_contact'];
 					$customer_email=$row['customer_email'];
 					$customer_address=$row['customer_address'];
 					?>
 					<tr>
 				<td><?php echo $sn++; ?>.</td>
 				<td><?php echo $food; ?></td>
 				<td><?php echo $price; ?></td>
 				<td><?php echo $qty; ?></td>
 				<td><?php echo $total; ?></td>
 				<td><?php echo $order_date; ?></td>

 				<td>
 				<?php
 				//ordered on delivery delivered cancelled
 				if($status=="ordered")
 				{
 					echo "<label>$status</lable>";
 				}
 				elseif($status=="On Delivery")
 				{
 					echo "<label style='color:orange;'>$status</lable>";


 				}
 				elseif($status=="Delivered")
 				{
 					echo "<label style='color:Green;'>$status</lable>";


 				}
 				elseif($status=="Cancelled")
 				{
 					echo "<label style='color:red;'>$status</lable>";


 				}
 				?>					
 				</td>

 				<td><?php echo $customer_name; ?></td>
 				<td><?php echo $customer_contact; ?></td>
 				<td><?php echo $customer_email ?></td>
 				<td><?php echo $customer_address ?></td>
 				<td>
 		<a href="<?php echo SITEURL;?>admin/update-order.php?id=<?php echo $id;?>" class="btn-secondary">Update Order</a>
 		<a href="" class="btn-danger">Delete Order</a>

 				</td>

 			</tr>
 			 		

 					<?php
 				}
 			}
 			else
 			{
 				echo "<tr><td colspan='12'> Order not available.</td><tr>";
 			}




 			 ?>
 		</table>

	</div>
</div>

<?php 
include('footer.php');
 ?>