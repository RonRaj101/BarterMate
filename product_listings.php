<?php
include('DBCONNECT.php');
session_start();
if($_SESSION['u_id'] == null){
  header('location:index.php');
}
else{
  $u_id = $_SESSION['u_id'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Product Listings | BarterMate</title>
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

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: BarterMate - v4.3.0
  * Template URL: https://bootstrapmade.com/BarterMate-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
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
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Existing Listings</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Existing Listings</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page" style="min-height: 20rem;">
      <div class="container">
                <div class="accordion accordion-flush" id="accordionFlushExample">  
        <?php
        $getalllistingssql = "SELECT * FROM products 
        INNER JOIN product_categories ON products.P_CATEGORY = product_categories.PC_ID
        WHERE P_BY_U_ID = '$u_id'";
        $getalllistings = mysqli_query($connectionString,$getalllistingssql);

        

        while ($listing_row = mysqli_fetch_assoc($getalllistings)) {

          if($listing_row == null){
            echo "<center>
        <h3 class='text-muted'>No Listings Found!</h3>
        <br>
        </center>";
        }

        else{
        ?>

        <center><h3>Existing Listings<span class='text-muted'> (<?php echo mysqli_num_rows($getalllistings)?>)</span></h3></center><br>
        
        <?php  

          $l_id = $listing_row['P_ID'];

          $existingproductimagessql = "SELECT * FROM product_images WHERE PI_P_ID = '$l_id'";
          $existingproductimages = mysqli_query($connectionString,$existingproductimagessql);
        ?>  

        
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-heading<?php echo $l_id?>">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php echo $l_id?>" aria-expanded="false" aria-controls="flush-collapse<?php echo $l_id?>">
        <?php echo $listing_row['P_NAME']?>
      </button>
    </h2>
    <div id="flush-collapse<?php echo $l_id?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?php echo $l_id?>" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
          <div class="row mb-3">
          <?php 
          while($existing_img_row = mysqli_fetch_assoc($existingproductimages)){
          ?>
          <img class="col-2 mt-2" src="<?php echo $existing_img_row['PI_IMG_URL']?>" style="aspect-ratio:16/9;" alt="">
          <?php
          }
          ?>
          </div>
        <p><?php echo $listing_row['P_DESC']?></p>
        <p class="text-muted">Category: <?php echo $listing_row['PC_NAME']?></p>
        <p class="text-muted">Date Created: <?php echo $listing_row['P_CREATE_DATE']?></p>
        <p class="text-muted">Swap Type: <?php echo $listing_row['P_EXC_TYPE']?></p>
        </div>
    </div>
  </div>
  
  <?php
  }
}
  ?>

  

</div>
      </div>
    </section>

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

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>