<?php
session_start();
if (isset($_SESSION['email']) AND isset($_SESSION['user_type']) AND isset($_SESSION['key']) )
    echo " ";
else {
    header("location:index.php");

}

include ('db_connect.php');

$id=$_GET['id'];
$sql = mysqli_query($con, "SELECT * FROM purchase WHERE purchase_id='$id'");
$data = mysqli_fetch_assoc($sql);
$num = $data['invoice_number'];

$delete=mysqli_query($con,"DELETE FROM purchase  WHERE purchase_id='$id'");
$delete_details=mysqli_query($con,"DELETE FROM purchase_details  WHERE purchase_id='$id'");
$delete_payment=mysqli_query($con,"DELETE FROM purchase_payment_history  WHERE purchase_id='$id'");

if($delete)
{
    // insert access log in to data base
    include('my_function.php');
    $user_email = $_SESSION['email'];
    $user_id = getIdByEmail($user_email);
    insertActivityLog($user_id,'Purchase Deleted ' . $num);
    // End insert access log in to data base
    echo "<script>alert('Purchase Deleted!')</script>";
    echo "<script>window.open('purchase.php','_self')</script>";
}

else
{
    echo "<script>alert('Failed!')</script>";
    echo "<script>window.open('purchase.php','_self')</script>";
}


?>
