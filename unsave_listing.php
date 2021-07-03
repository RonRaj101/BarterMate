<?php

include('DBCONNECT.php');

$p_id = $_GET['id'];
$from = $_SERVER['HTTP_REFERER'];

session_start();
if($_SESSION['u_id'] == null){
  header('location:index.php');
}
else{
  $u_id = $_SESSION['u_id'];

  $unsavelistingsql = "DELETE FROM saved_products WHERE S_P_ID = '$p_id' AND S_BY_U_ID = '$u_id'";
  $unsavelisting = mysqli_query($connectionString,$unsavelistingsql);

  if($unsavelisting){
  	header('location:'.$from);
  	echo "Un-Saved";
  }

}

?>