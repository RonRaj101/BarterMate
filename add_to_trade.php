<?php
include('DBCONNECT.php');

   $my = $_REQUEST['p'];

    $productsql = "SELECT P_ID,P_NAME,product_images.PI_IMG_URL FROM products
       INNER JOIN product_images ON product_images.PI_P_ID = products.P_ID
        WHERE P_ID = '$my' ";
    $product = mysqli_query($connectionString, $productsql);

    $p_row = mysqli_fetch_array($product);

    $p_img = $p_row["PI_IMG_URL"];
    $p_name = $p_row['P_NAME'];


    echo '<div class="card border-0 col-lg-6 col-md-10 col-sm-12 col-12 p-2">
        <figure class="figure">
            <img id="myproducts-img" style="object-fit: scale-down; background-color: black; aspect-ratio: 4/3;" src="'.$p_img.'" class="figure-img img-fluid rounded" alt="...">
            <figcaption class="figure-caption text-truncate text-center">'.$p_name.'</figcaption>
        </figure>
</div>';

    ?>


