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
$admin_name=$_SESSION['admin_name'];
$sph_id=$_POST['sph_id'];

$get_paid_amount=getSalesPaidAmount($invoice_id);
$get_current_amount=getCurrentAmount($sph_id);
$updated_amount=$get_paid_amount-$get_current_amount+$amount;



$sql_update=mysqli_query($con,"UPDATE sales_payment_history SET payment_method='$payment_method',amount='$amount',date='$date',reference='$reference',done_by='$admin_name'");
$sql_amount_update=mysqli_query($con,"UPDATE order_list SET paid_amount='$updated_amount' WHERE invoice_id='$invoice_id'");

if($sql_update AND $sql_amount_update)
{
	saveAccessLog($admin_name. ' Update sales payment from invoice '.$invoice_id);

	echo "<script>alert('Payment Update Successfully!')</script>";
	echo "<script>window.open('sales_list.php','_self')</script>";
}

else
{
	echo "<script>alert('Failed!')</script>";
	echo "<script>window.open('sales_list.php','_self')</script>";
}


?>
