<?php
 define('HOST','localhost');         //hostname
 define('USER','tanimha1_markerp');     //username
 define('PASS','tanimha1_markerp');        //user password
 define('DB','tanimha1_markerp');  //database name

 date_default_timezone_set('Asia/Dhaka');
 $con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect');

?>