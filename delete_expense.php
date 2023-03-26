<?php
session_start();
if (isset($_SESSION['email']) AND isset($_SESSION['user_type']) AND isset($_SESSION['key']) )
	echo " ";
else {
	header("location:index.php");

}

include ('db_connect.php');

$id=$_GET['id'];
$sql = mysqli_query($con, "SELECT * FROM expense WHERE expense_id='$id'");
$data = mysqli_fetch_assoc($sql);
$name = $data['expense_name'];

$delete=mysqli_query($con,"DELETE FROM expense WHERE expense_id='$id'");

if($delete)
{
    // insert access log in to data base
    include('my_function.php');
    $user_email = $_SESSION['email'];
    $user_id = getIdByEmail($user_email);
    insertActivityLog($user_id,'Expense Deleted ' . $name);
    // End insert access log in to data base
	echo "<script>alert('Expense Deleted!')</script>";
	echo "<script>window.open('expense_list.php','_self')</script>";
}

else
{
	echo "<script>alert('Failed!')</script>";
	echo "<script>window.open('expense_list.php','_self')</script>";
}


?>
