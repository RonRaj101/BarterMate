<?php
include('DBCONNECT.php');

$msg_content = $_GET['msg'];
$msg_to = $_GET['to'];
$msg_from = $_GET['from'];
$date_time = date('Y-m-d h:i:s');
 
$sendmessagesql = "INSERT INTO messages(`M_CONTENT`,`M_FROM`,`M_TO`,`M_TIME`) VALUES ('$msg_content','$msg_from','$msg_to','$date_time')";
$sendmessage = mysqli_query($connectionString,$sendmessagesql);

$msg_arr = array($msg_content,$msg_to,$msg_from,$date_time);

echo json_encode($msg_arr);
?>