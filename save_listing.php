<?php
include('DBCONNECT.php');

$p_id = $_GET['id'];
$from = $from = $_SERVER['HTTP_REFERER'];

session_start();
if($_SESSION['u_id'] == null){
  header('location:index.php');
}
else{
  $u_id = $_SESSION['u_id'];

  $savelistingsql = "INSERT INTO saved_products(S_P_ID,S_BY_U_ID) VALUES('$p_id','$u_id')";
  $savelisting = mysqli_query($connectionString,$savelistingsql);

  if($savelisting){
    if(strpos($from, 'explore.php')){
      echo "Listing Saved";
    }
    else{
    header('location:'.$from);
    }
  }



}

?>

