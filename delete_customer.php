<?php
session_start();
if (isset($_SESSION['email']) AND isset($_SESSION['user_type']) AND isset($_SESSION['key']) )
	echo " ";
else {
	header("location:index.php");

}

include ('db_connect.php');

$id=$_GET['id'];
$sql = mysqli_query($con, "SELECT * FROM customers WHERE customer_id='$id'");
$data = mysqli_fetch_assoc($sql);
$name = $data['customer_name'];

$delete=mysqli_query($con,"DELETE FROM customers  WHERE customer_id='$id'");

if($delete)
{
    // insert access log in to data base
    include('my_function.php');
    $user_email = $_SESSION['email'];
    $user_id = getIdByEmail($user_email);
    insertActivityLog($user_id,'Deleted Client ' . $name);
    // End insert access log in to data base
	echo "<script>alert('Client Deleted!')</script>";
	echo "<script>window.open('customers.php','_self')</script>";
}

else
{
	echo "<script>alert('Failed!')</script>";
	echo "<script>window.open('customers.php','_self')</script>";
}


?>
