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
$payment_method=$_POST['payment_method'];
$date=$_POST['date'];
$reference=$_POST['reference'];
$amount=$_POST['amount'];
$admin_name=$_SESSION['user_name'];
$pph_id=$_POST['pph_id'];

 $get_paid_amount=getPurchasePaidAmount($purchase_id);
 $get_current_amount=getCurrentPurchaseAmount($pph_id);
 $updated_amount=$get_paid_amount-$get_current_amount+$amount;



$sql_update=mysqli_query($con,"UPDATE purchase_payment_history SET payment_method='$payment_method',amount='$amount',date='$date',reference='$reference',done_by='$admin_name' WHERE pph_id='$pph_id'");
$sql_amount_update=mysqli_query($con,"UPDATE purchase SET paid_amount='$updated_amount' WHERE purchase_id='$purchase_id'");

if($sql_update AND $sql_amount_update)
{
	saveAccessLog($admin_name. ' Update purchase payment from purchase id '.$purchase_id);

	echo "<script>alert('Payment Update Successfully!')</script>";
	echo "<script>window.open('purchase.php','_self')</script>";
}

else
{
	echo "<script>alert('Failed!')</script>";
	echo "<script>window.open('purchase.php','_self')</script>";
}


?>
