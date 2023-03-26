<?php

include ('db_connect.php');

$id=$_GET['id'];

$update=mysqli_query($con,"UPDATE products SET status=0  WHERE product_id='$id'");

if($update)
{
    // insert access log in to data base
    include('my_function.php');
    $user_email = $_SESSION['email'];
    $user_id = getIdByEmail($user_email);
    insertActivityLog($user_id,'Product Inactivated');
    // End insert access log in to data base
	echo "<script>alert('Product Inactivated!')</script>";
	echo "<script>window.open('products.php','_self')</script>";
}

else
{
	echo "<script>alert('Failed!')</script>";
	echo "<script>window.open('products.php','_self')</script>";
}


?>
