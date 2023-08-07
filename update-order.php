 <?php 	
include('menu.php');
// echo "updated";
 ?>

<div class="main">
	<div class="wrapper">
		<h1>Update Order</h1><br><br>
		<?php	
		//check whether id clickor not
		if(isset($_GET['id']))
		{
			//get the order details
			$id=$_GET['id'];
			$select="SELECT * FROM tbl_order WHERE id='$id'";
			$data=mysqli_query($con,$select);
			$count=mysqli_num_rows($data);
			if($count==1)
			{
				//loop
				$row=mysqli_fetch_assoc($data);
				$food=$row['food'];
				$price=$row['price'];
				$qty=$row['qty'];
				$status=$row['status'];
				$customer_name=$row['customer_name'];
				$customer_contact=$row['customer_contact'];
				$customer_email=$row['customer_email'];
				$customer_address=$row['customer_address'];


			}
			else
			{
				header('Location:'.SITEURL.'admin/manage_order.php');
			}
		}
		else
		{
			header('Location:'.SITEURL.'admin/manage_order.php');
		}


		?>





		<form action="" method="POST" enctype="multipart/form-data">
			<table class="tbl-add">
				<tr>
					<td>Food Name:</td>
					<td><?php echo $food; ?></td>
				</tr>
				<tr>
					<td>Price:</td>
					<td><?php echo $price; ?></td>

				</tr>

				<tr>
					<td>Qty:</td>
					<td>
						<input type="number" name="qty" value="<?php echo $qty; ?>">
					</td>
				</tr>
				<tr>
					<td>Status:</td>
					<td>
						<select name="status">
							<option <?php if($status=="ordered"){ echo "selected";}?> value="ordered">Ordered</option>
							<option <?php if($status=="On Delivery"){ echo "selected";}?>value="On Delivery">On Delivery</option>
							<option <?php if($status=="Delivered"){ echo "selected";}?>value="Delivered">Delivered</option>
							<option <?php if($status=="Cancelled"){ echo "selected";}?>value="Cancelled">Cancelled</option>

					</td>
				</tr>
				<tr>
					<td>Customer Name:</td>
					<td> 
							<input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
					</td>
				</tr>
				<tr>
					<td>Customer Contact:</td>
					<td> 
							<input type="number" name="customer_contact" value="<?php echo $customer_contact; ?>">
					</td>
				</tr>
				<tr>
					<td>Customer Email:</td>
					<td> 
							<input type="email" name="customer_email" value="<?php echo $customer_email; ?>">
					</td>
				</tr>
				<tr>
					<td>Customer Address:</td>
					<td>
						<textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
					</td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<input type="hidden" name="price" value="<?php echo $price; ?>">

						<input type="submit" name="submit" value="Update Order" class="btn-secondary">
					</td>
				</tr>
			</table>
		</form>
			<?php	
				if(isset($_POST['submit']))
						{
							$id=$_POST['id'];
							$price=$_POST['price'];
							$qty=$_POST['qty'];
							$total=$price * $qty;
							$status=$_POST['status'];
							$customer_name=$_POST['customer_name'];
							$customer_contact=$_POST['customer_contact'];
							$customer_email=$_POST['customer_email'];
							$customer_address=$_POST['customer_address'];
					$update="UPDATE `tbl_order` SET `qty`='$qty',`total`='$total',`status`='$status',`customer_name`='$customer_name',`customer_contact`='$customer_contact',`customer_email`='$customer_email',`customer_address`='$customer_address' WHERE id='$id'";
					$data=mysqli_query($con,$update);
							if($data)
									{
										//data updated
						$_SESSION['update']="<div class='btn-secondary'>Order Updated Succcessfully.</div>";
						header('Location:'.SITEURL.'admin/manage_order.php');

									}
									else
									{
										//redirect
										//with mssge
						$_SESSION['update']="<div class='btn-danger'>Order failed to Updated .</div>";
						header('Location:'.SITEURL.'admin/manage_order.php');
									}

						}
			?>
















	</div>
</div>













 <?php 	
include('footer.php');
 ?>