<?php
include('DBCONNECT.php');
session_start();

if($_SESSION['u_id'] == null){
  header('location:index.php');
}
else{
  $u_id = $_SESSION['u_id'];
}

$p_id = $_GET['id'];

$getallproductinfosql = "SELECT * FROM products
INNER JOIN product_categories ON products.P_CATEGORY = product_categories.PC_ID
INNER JOIN users ON products.P_BY_U_ID = users.U_ID
WHERE products.P_ID = '$p_id'";
$getallproductinfo = mysqli_query($connectionString,$getallproductinfosql);

$product_info_array = mysqli_fetch_array($getallproductinfo);

//--//

$getproductssql = "SELECT * FROM products INNER JOIN product_categories ON products.P_CATEGORY = product_categories.PC_ID 
INNER JOIN users ON products.P_BY_U_ID = users.U_ID
ORDER BY P_VIEWS ASC; 
";
$getproducts = mysqli_query($connectionString,$getproductssql);

$curr_date = date("Y-m-d");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Listing Details | BarterMate</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/owlcarousel/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/owlcarousel/assets/owl.theme.default.min.css">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: BarterMate - v4.3.0
  * Template URL: https://bootstrapmade.com/BarterMate-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

  <style>
#owl-demo .item{
  color: black;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  text-align: center;
}

.card-body:hover{
  opacity: 80%;
}


</style>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center ">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <h1><a href="index.php">BarterMate</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.php"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="index.php">Home</a></li>
          <li><a class="nav-link scrollto" href="explore.php">Explore</a></li>
          <li><a class="nav-link scrollto" href="store.php"> <i style="margin-left: 0px !important;" class='bx bx-coin bx-sm'> </i> 100</a></li>
          <li><a class="nav-link scrollto" href="logout.php">Logout</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Listing Details</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Listing Details</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-8">

            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
               <div class="carousel-inner">
                <?php
                $getallimagessql = "SELECT * FROM product_images WHERE PI_P_ID = '$p_id'";
                $getallimages = mysqli_query($connectionString,$getallimagessql);

                $first_active = 'active';

                while($image_row = mysqli_fetch_assoc($getallimages)){
                ?>

                <div class="carousel-item <?php echo $first_active?>">
                  <img src="<?php echo $image_row['PI_IMG_URL'] ?>" class="d-block w-100" style="max-height:40rem;" alt="">
                </div>

                <?php
                $first_active = ' ';
                }
                ?>
          </div>
           <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              
            </div>

            <br> 

            <div class="other-info">
              Lorem ipsum dolor sit amet consectetur adipisicing, elit. Laboriosam alias non fugiat distinctio sapiente et magnam, inventore numquam odio nobis quis accusantium temporibus iste earum pariatur at atque beatae minima?
              Deleniti quidem et recusandae vel eveniet quae nisi reiciendis nesciunt voluptatibus rerum, sit. Enim, quibusdam labore ipsam cupiditate nulla sunt deserunt dignissimos dolorum eligendi libero illo omnis minus laudantium ratione!
              Natus dicta esse soluta, nesciunt, debitis quidem quis. Iure amet recusandae pariatur facere aspernatur maiores, exercitationem, magnam consequatur, fugiat cum adipisci, dicta perspiciatis? Corporis explicabo autem laborum eligendi enim libero?
              Earum, aspernatur. Quod a explicabo atque dolores maiores, saepe non porro nihil ipsam, architecto nostrum quia ipsum reiciendis aliquam! Beatae, aspernatur. Quisquam eum aliquid et quis, commodi! Eos, voluptatem praesentium?
              Ut aliquam quam vitae iure sint illo voluptate eius assumenda aspernatur quia, aperiam est a, odio, iste nisi, eveniet inventore? Totam repudiandae quaerat doloremque. Laborum ullam molestiae, reiciendis autem officia!
            </div>

          </div>

          <div class="col-lg-4 ml-3">
            
             <div class="portfolio-description p-2" >
              <h2><?php echo $product_info_array['P_NAME'] ?></h2>
              <p>
                <?php echo $product_info_array['P_DESC'] ?>
              </p>
            </div>
            <br>

             <div class="portfolio-info p-4" >
              <h3>Product Information</h3>
              <ul>
                <li><strong>Category</strong>: <?php echo $product_info_array['PC_NAME']?></li>
                <li><strong>Owner</strong>: <a href="profile_info.php?id=<?php echo $product_info_array['P_BY_U_ID']?>"><?php echo $product_info_array['U_NAME']?></a></li>
                <li><strong>Date Posted</strong>: <?php echo date('d-m-Y',strtotime($product_info_array['P_CREATE_DATE'])) ?>
                </li>
                <li><strong>Swap Type</strong>: 
              <?php 
              if($product_info_array['P_EXC_TYPE'] == 0){
              ?>
              Money Preferred
              <?php
              }
              else if($product_info_array['P_EXC_TYPE'] == 1){
              ?>
              Product Swap Preferred
              <?php
              }
            ?>
                </li>
              </ul>
            </div>
           
          </div>

        </div>

        <br>

<hr>
        <div class="row">

        <h3>Browse</h3>
        <h5>Related Products</h5>

          <div id="owl-demo" class="owl-carousel owl-theme row mt-3">
     <?php
      while($p_row = mysqli_fetch_assoc($getproducts)){

        $p_id = $p_row['P_ID'];


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
          
  <div class="item">

    
    <div class="card border-<?php echo $color?> p-0" style="">

      <span class="badge rounded-pill bg-warning text-dark col-12 m-0 p-1" style="border-radius: 0px !important;" <?php echo $featured?> >Featured</span>

        <div class="row mt-2">

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



             <span class="col">
               <a href=""><i class="ri-save-line ri-xl" style="align-self: center;" title="Save Listing"></i></a>
             </span>
             

        </div>
        

    <a href="listing_details.php?id=<?php echo $p_id?>" style="color:black !important;">
       
    <?php 
    while ($img_row = mysqli_fetch_assoc($getallproductimages)) {
    ?>

      
        <img src="<?php echo $img_row['PI_IMG_URL']?>" class="d-block img-responsive img-fluid" style="object-fit:scale-down; aspect-ratio: 16 / 9;" alt="...">
      

    <?php    
    }
    ?>



      <div class="card-body">

        <p class="card-text d-flex" style="justify-content: center; font-size:small; ">
            <u><strong><?php echo $p_row['P_NAME']?></strong></u>
        </p>

        <p class="text-success muted"><em></em></p>
        <hr>
        <div class="row">
            <span class="col text-muted " style="font-size: x-small; align-self: center;
">
               
                
                <?php 

                $months = date('m' ,strtotime($curr_date) - strtotime($p_row['P_CREATE_DATE']));
                $days = date('d' ,strtotime($curr_date) - strtotime($p_row['P_CREATE_DATE']));

                if($months >= 12){
                  echo "<strong>",floor($months/12) , "</strong> Years Ago";
                }
                else if($months < 12){
                  echo  "<strong>",$months , "</strong> Months Ago";
                }

                ?>
               
            </span>

            <span class="col-2">|</span>

            <span class="col">
              <?php
                if($p_row['P_EXC_TYPE'] == '0'){
              ?>
              <strong><small>PKR <span class="text-success"><?php echo $p_row['P_MONETARY_VAL']?></span></small></strong>
              <?php
              }
              else if($p_row['P_EXC_TYPE'] == '1'){
                echo "<span style='font-size:x-small;'>Swap Available</span>";
              }
              ?>
            </span>

        </div>
        
      </div>

      </a>
     
    </div>
    </a>

  </div>


  <?php 
  }
  ?>
        </div>

      </div>
    </section><!-- End Portfolio Details Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <h3>BarterMate</h3>
      <p>Solving the Problem of Physical Waste by Providing an Item Exchange Platform</p>
      <div class="social-links">
        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
      <div class="copyright">
        &copy; Copyright <strong><span>BarterMate</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/BarterMate-bootstrap-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="assets/owlcarousel/owl.carousel.min.js"></script>


  <script>



 $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    responsiveClass:true,
    responsive:{
        0:{
            items:2,
            nav:true
        },
        600:{
            items:3,
            nav:false
        },
        1000:{
            items:5,
            nav:true,
            loop:false
        }
    }
})
  </script>

</body>

</html>