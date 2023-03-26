<?php
session_start();
if (isset($_SESSION['email']) AND isset($_SESSION['user_type']) AND isset($_SESSION['key']) )
	echo " ";
else {
	header("location:index.php");

}

include ('db_connect.php');
include ('my_function.php');


$invoice_id=$_POST['invoice_id'];
$payment_method=$_POST['payment_method'];
$date=$_POST['date'];
$reference=$_POST['reference'];
$amount=$_POST['amount'];
$user_id=$_SESSION['user_id'];

$get_paid_amount=getSalesPaidAmount($invoice_id);
$updated_amount=$get_paid_amount+$amount;



$sql_insert=mysqli_query($con,"INSERT INTO sales_payment_history (invoice_id,payment_method,amount,date,reference,done_by)  VALUES ('$invoice_id','$payment_method','$amount','$date','$reference','$user_id') ");
$sql_amount_update=mysqli_query($con,"UPDATE order_list SET paid_amount='$updated_amount' WHERE invoice_id='$invoice_id'");

if($sql_insert AND $sql_amount_update)
{
    // insert access log in to data base
    $user_email = $_SESSION['email'];
    $user_id = getIdByEmail($user_email);
    insertActivityLog($user_id,'Added New Payment');
    // End insert access log in to data base
	echo "<script>alert('Payment Added Successfully!')</script>";
	echo "<script>window.open('sales_list.php','_self')</script>";
}

else
{
	echo "<script>alert('Failed!')</script>";
	echo "<script>window.open('sales_list.php','_self')</script>";
}


?>
