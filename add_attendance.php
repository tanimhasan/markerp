<?php
session_start();
if (isset($_SESSION['email']) AND isset($_SESSION['user_type']) AND isset($_SESSION['key']) )
    echo " ";
else {
    header("location:index.php");
}

include ('db_connect.php');
$id=$_GET['id'];
$date=$_GET['cur_date'];
if (isset($id) AND isset($date)) {
    $result = mysqli_query($con, "SELECT * FROM attendance WHERE emp_id='$id' AND att_date='$date'");
    $num_rows = mysqli_num_rows($result);

    if ($num_rows > 0) {
        echo "<script>alert('Attendance Already Taken Today!')</script>";
        echo "<script>window.open('attendance.php','_self')</script>";
    }else{
        $insert=mysqli_query($con,"INSERT INTO attendance (`emp_id`,`attendance`,`att_date`) VALUE ('$id','Present','$date')");
        // insert access log in to data base
        include('my_function.php');
        $user_email = $_SESSION['email'];
        $user_id = getIdByEmail($user_email);
        insertActivityLog($user_id,'Added Attendance');
        // End insert access log in to data base
        echo "<script>window.open('attendance.php','_self')</script>";
    }
}

?>
