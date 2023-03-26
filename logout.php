<?php
session_start();
if (isset($_SESSION['email']) AND isset($_SESSION['user_type']) AND isset($_SESSION['key']) ){

    // insert log info in to data base
    include ('db_connect.php');
    include('my_function.php');
    date_default_timezone_set("Asia/Dhaka");
    $out_time = date("Y-m-d h:i:sa");
    $ip_address = getenv("REMOTE_ADDR") ;
    $user_id = $_SESSION['user_id'];
    $s_id = $_SESSION['key'];
    outLog($user_id,$s_id,$ip_address,$out_time);
    // End insert log info in to data base

session_destroy();
header("location:index.php");
}else {
    header("location:index.php");

}
?>
