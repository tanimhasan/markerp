<?php
session_start();
if (isset($_SESSION['email']) AND isset($_SESSION['user_type']) AND isset($_SESSION['key']) )
    echo " ";
else {
    header("location:index.php");

}

include ('db_connect.php');
$id=$_GET['id'];
$pre_date=$_GET['pre_date'];

if (isset($id) AND isset($pre_date)) {
    $result = mysqli_query($con, "SELECT * FROM attendance WHERE emp_id='$id' AND att_date='$pre_date'");
    $num_rows = mysqli_num_rows($result);

    if ($num_rows > 0) {
        echo "<script>alert('Attendance Already Taken Today!')</script>";
        echo "<script>window.open('attendance.php','_self')</script>";
    }else{
        $insert=mysqli_query($con,"INSERT INTO attendance (`emp_id`,`attendance`,`att_date`) VALUE ('$id','Absent','$pre_date')");
// insert access log in to data base
        /*include 'my_function.php';
        $user_id = getIdByEmail($_SESSION['email']);
        insertActivityLog($user_id,'Added Attendance in Absent');*/
// End insert access log in to data base
        /*echo "<script>alert('Attendance Added!')</script>";*/
        echo "<script>window.open('give_attendance.php?att_date=$pre_date','_self')</script>";
    }
}

?>
