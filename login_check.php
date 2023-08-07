<?php 
//Access control
//check whether logged or not
if(!isset($_SESSION['user']))
{
	$_SESSION['no-login-messge']="<div class='btn-danger'>Please Login to access admin panel.</div>";
	header("Location:".SITEURL.'admin/login.php');

}
 ?>
