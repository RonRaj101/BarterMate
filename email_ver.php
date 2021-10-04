<?php

include('DBCONNECT.php');

if($_GET['id'] != null){
$u_id = $_GET['id'];

$checkuserversql = "SELECT * FROM users WHERE U_ID = '$u_id'";
$checkuserver = mysqli_query($connectionString,$checkuserversql);

$user_ver_arr = mysqli_fetch_array($checkuserver);

$u_ver = $user_ver_arr['U_VER'];
$u_ver_email_sent = $user_ver_arr['U_VER_EMAIL'];

$user_ver_code = $user_ver_arr['U_VER_CODE'];

if($u_ver_email_sent == 0){
	//send email
	$to = $user_ver_arr['U_EMAIL'];
	$subject = "Email Verification | BarterMate";
	$body = '
	<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>

  body{
    font-family:"Open Sans", sans-serif;
  }
img{
	max-width:70%;
	max-height:70%;
}

div{
    width: 750px;
    margin: 0px auto;
}


	</style>
</head>
<body>
	<br>
	<center>
		<div>
   <img src="https://i.ibb.co/tCDjkq9/BARTERMATE.png" alt="BARTERMATE" border="0">
   <hr>
   <h2><strong>Hello '.$user_ver_arr['U_NAME'].'</strong> , Welcome to BarterMate</h2>
   <h4>Your Account Has Been Created. Click Below to Verify</h4>
   <br>
   <a href="/EmailVerify.php?vkey='.$user_ver_code.'"><button style="border-radius: 0px;" class="btn btn-danger">Click Here To Verify</button></a>
   <br> <hr>
   <small>For Any Queries Email Us At: info@bartermate.com</small>
</div>
</center>
</body>
</html>';

$header = 'From: info@bartermate.com
Content-type: text/html; charset=iso-8859-1';

mail($to,$subject,$body,$header);

$alteremailsentsql = "UPDATE users SET U_VER_EMAIL = '1' WHERE U_ID = '$u_id'";
$alteremailsent = mysqli_query($connectionString,$alteremailsentsql);

echo "EMail Sent";

}
else if($u_ver_email_sent == 1){
	//Display that Email is already sent
    echo "Email has been sent previously. Check Your Inbox";
}
}
else{
	$ver_code = $_GET['ver_code'];
	$header('location:login.php');
}

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

</body>
</html>
