<?php
include('DBCONNECT.php');
session_start();
$u_id = $_SESSION['u_id'];
$pfor = $_REQUEST['pf'];

$addproductswapsql = "INSERT INTO product_swaps(`PS_P_FOR`,`PS_BY`) VALUES('$pfor','$u_id')";
$addproductswap = mysqli_query($connectionString,$addproductswapsql);

$swap_id = mysqli_insert_id($connectionString);

for ($x=0;$x<3;$x++){

    $curr_p_id = $_REQUEST['p'.$x];

    $addproductoffersql = "INSERT INTO product_swap_offers(`SO_PS_ID`,`SO_P_ID`) VALUES('$swap_id','$curr_p_id')";
    $addproductoffer = mysqli_query($connectionString,$addproductoffersql);

}
?>
