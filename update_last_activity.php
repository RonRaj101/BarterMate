<?php
include('DBCONNECT.php');

$u_id = $_GET['id'];

session_start();
$update_activity_sql = "UPDATE users SET U_LAST_ACTIVITY = now() WHERE U_ID = '$u_id' ";
$update_activity = mysqli_query($connectionString,$update_activity_sql);


?>