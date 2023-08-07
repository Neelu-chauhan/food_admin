<?php
include('menu.php')
?>

	<!-- main content section -->
	<div class="main">
		<div class="wrapper">
	<h1>DASHBOARD</h1>
	<br><br>
	<?php 
		if(isset($_SESSION['login']))
		{
			echo $_SESSION['login'];
			unset ($_SESSION['login']);

		}
		?>
		<br><br>
	<div class="col-4 text-center">
		<?php  

			$select="SELECT * FROM tbl_category";
			$data=mysqli_query($con,$select);
			$count=mysqli_num_rows($data);

		 ?>
		<h1><?php echo $count;?></h1><br>
		categories
	</div>
		<div class="col-4 text-center">
		<?php  

			$select="SELECT * FROM tbl_food";
			$data=mysqli_query($con,$select);
			$count=mysqli_num_rows($data);

		 ?>
		<h1><?php echo $count;?></h1><br>
		Foods
	</div>
		<div class="col-4 text-center">
			<?php  

			$select="SELECT * FROM tbl_order";
			$data=mysqli_query($con,$select);
			$count=mysqli_num_rows($data);

		 ?>
		<h1><?php echo $count;?></h1><br>
		Total Orders
	</div>
		<div class="col-4 text-center">
			<?php
				$select="SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";
				$data=mysqli_query($con,$select);
				$row=mysqli_fetch_assoc($data);
				//get the total revenue
				$total_revenue=$row['Total'];
			?>
		<h1>₹<?php echo $total_revenue; ?></h1><br>
			Revenue Generated
	</div>
	<div class="clearfix"></div>
	</div>
	</div>
	<!-- main content section  end-->

<?php
include('footer.php')

?>