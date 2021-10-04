<?php
include('DBCONNECT.php');

session_start();
$u_id = $_SESSION['u_id'];
$curr_date = date("Y-m-d");

$search = $_REQUEST['s'];
$cat = $_REQUEST['cat'];
$exec = $_REQUEST['exec'];

if($cat != 0){
    $cat_str = "={$cat}";
}
else{
    $cat_str = ">0";
}

if($exec != 2){
    $exec_str = "={$exec}";
}
else{
    $exec_str = ">-1";
}

if($search != null){
    $search_term = $search;
    $getallproductssql = "SELECT * FROM products 
            INNER JOIN product_categories ON products.P_CATEGORY = product_categories.PC_ID
            WHERE P_STATUS = '1' AND P_NAME LIKE '%$search_term%' AND P_CATEGORY $cat_str AND P_EXC_TYPE $exec_str
            ORDER BY products.P_FEATURED DESC, products.P_VIEWS DESC, P_CREATE_DATE";
    $getallproducts = mysqli_query($connectionString,$getallproductssql);

}
elseif($search == null){
    $getallproductssql = "SELECT * FROM products 
            INNER JOIN product_categories ON products.P_CATEGORY = product_categories.PC_ID
            WHERE P_STATUS = '1' AND P_CATEGORY $cat_str AND P_EXC_TYPE $exec_str
            ORDER BY products.P_FEATURED DESC, products.P_VIEWS DESC, P_CREATE_DATE";
    $getallproducts = mysqli_query($connectionString,$getallproductssql);

}

$result_count = mysqli_num_rows($getallproducts);


if(mysqli_num_rows($getallproducts) == 0){
    echo "    <div style='text-align: center;'>
                <h3 class='text-muted'>No Results Found!</h3>
                </div>";
}

while($p_row = mysqli_fetch_assoc($getallproducts)){

    $p_id = $p_row['P_ID'];
    $p_cat = $p_row['P_CATEGORY'];
    $p_exec = $p_row['P_EXC_TYPE'];

    $getallproductimagessql = "SELECT PI_IMG_URL FROM product_images WHERE PI_P_ID = '$p_id' LIMIT 0,1";
    $getallproductimages = mysqli_query($connectionString,$getallproductimagessql);

    if($p_row['P_FEATURED'] == 0){
        $featured = 'hidden';
        $color = 'secondary';
    }
    else if($p_row['P_FEATURED'] == 1){
        $featured = '';
        $color = 'warning';
    }

    ?>

    <div class="card border-<?php echo $color?> p-0 m-2 border-2 cat-<?php echo $p_cat?> exec-<?php echo $p_exec?> " style="max-width: 20rem; ">

        <?php
        while ($img_row = mysqli_fetch_assoc($getallproductimages)) {
            ?>

            <img src="<?php echo $img_row['PI_IMG_URL']?>" class="card-img-top d-flex img-responsive img-fluid" style="object-fit:scale-down; background-color: black; aspect-ratio: 16 / 9;" alt="...">

            <?php
        }
        ?>


        <div class="card-body">

            <h6 class="card-title row">
                <a href="listing_details.php?id=<?php echo $p_id?>" class="col-10"><strong class="text-truncate"><?php echo $p_row['P_NAME']?></strong></a>
                <?php
                if($p_row['P_EXC_TYPE'] == 0){
                    ?>
                    <i class='ri-coin-fill ri-lg col text-warning' title='Money Preferred'></i>
                    <?php
                }
                else if($p_row['P_EXC_TYPE'] == 1){
                    ?>
                    <i class='ri-swap-line ri-lg col text-info' title='Physical Product Swap Preferred'></i>
                    <?php
                }
                ?>
            </h6>

            <div class="row mt-2">

                <span class="col">
                  <?php
                  if($p_row['P_EXC_TYPE'] == '0'){
                      ?>
                      <strong><small>PKR <span class="text-success"><?php echo $p_row['P_MONETARY_VAL']?></span></small></strong>
                      <?php
                  }
                  else if($p_row['P_EXC_TYPE'] == '1'){
                      echo "<span style='font-size:small;'>Swap Available</span>";
                  }
                  ?>
                </span>



            </div>

            <hr>

            <div class="row" style="align-items: flex-end;">

                    <span class="col-4">
                    <?php
                    $checksavedsql = "SELECT * FROM saved_products WHERE S_P_ID = '$p_id' AND S_BY_U_ID = '$u_id'";
                    $checksaved = mysqli_query($connectionString,$checksavedsql);

                    if(mysqli_num_rows($checksaved) == 0){
                        ?>
                        <a style="float: left; cursor:pointer; align-self: flex-end;" onclick="saveProduct('<?php echo $p_id?>')"><i class="ri-save-line ri-xl" style="align-self: center;" title="Save Listing"></i></a>
                        <?php
                    }
                    else{
                        ?>
                        <a style="float: left; cursor:pointer; color: #0b6623;" onclick="unsaveProduct('<?php echo $p_id?>')"><i class="ri-save-fill ri-xl" style="align-self: center;" title="Un-Save Listing"></i></a>
                        <?php
                    }
                    ?>
                   </span>

                <span class="text-muted col-8">
                      <span style=" align-self: center; float:right; font-size: small;">
                    <?php

                    $months = date('m' ,strtotime($curr_date) - strtotime($p_row['P_CREATE_DATE']));
                    $days = date('d' ,strtotime($curr_date) - strtotime($p_row['P_CREATE_DATE']));

                    if($months >= 12){
                        echo "<strong>",floor($months/12) , "</strong> Year/s Old";
                    }
                    else if($months < 12){
                        echo  "<strong>",$months , "</strong> Month/s Old";
                    }
                    ?>
                    </span>
                    </span>

            </div>


        </div>

    </div>

<?php
}
?>
