<?php

include ('db_connect.php');

$id=$_GET['id'];

$update=mysqli_query($con,"UPDATE products SET status=1  WHERE product_id='$id'");

if($update)
{
	echo "<script>alert('Product Activated!')</script>";
	echo "<script>window.open('products.php','_self')</script>";
}

else
{
	echo "<script>alert('Failed!')</script>";
	echo "<script>window.open('products.php','_self')</script>";
}


?>
