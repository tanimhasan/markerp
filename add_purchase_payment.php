<?php
session_start();
if (isset($_SESSION['email']) AND isset($_SESSION['user_type']) AND isset($_SESSION['key']) )
	echo " ";
else {
	header("location:index.php");

}

include ('db_connect.php');
include ('my_function.php');


$purchase_id=$_POST['purchase_id'];
$supplier_id=$_POST['supplier_id'];
$payment_method=$_POST['payment_method'];
$date=$_POST['date'];
$reference=$_POST['reference'];
$amount=$_POST['amount'];
$done_by=$_SESSION['user_name'];

$get_paid_amount=getPaidAmount($purchase_id);
$updated_amount=$get_paid_amount+$amount;



$sql_insert=mysqli_query($con,"INSERT INTO purchase_payment_history (purchase_id,supplier_id,payment_method,amount,date,reference,done_by)  VALUES ('$purchase_id','$supplier_id','$payment_method','$amount','$date','$reference','$done_by') ");
$sql_amount_update=mysqli_query($con,"UPDATE purchase SET paid_amount='$updated_amount' WHERE purchase_id='$purchase_id'");

if($sql_insert AND $sql_amount_update)
{
	echo "<script>alert('Payment Added Successfully!')</script>";
	echo "<script>window.open('purchase.php','_self')</script>";
}

else
{
	echo "<script>alert('Failed!')</script>";
	echo "<script>window.open('purchase.php','_self')</script>";
}


?>
