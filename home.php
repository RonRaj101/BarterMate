<?php
include('DBCONNECT.php');
error_reporting(0);
session_start();

if($_SESSION['u_id'] == null){
  header('location:index.php');
}
else{
  $u_id = $_SESSION['u_id'];
}

$getuserdetailssql = "SELECT * FROM users WHERE U_ID = '$u_id'";
$getuserdetails = mysqli_query($connectionString,$getuserdetailssql);

$userdetailsarr = mysqli_fetch_array($getuserdetails);

$user_name = $userdetailsarr['U_NAME'];
$user_ver_state = $userdetailsarr['U_VER'];


$getproductssql = "SELECT * FROM products INNER JOIN product_categories ON products.P_CATEGORY = product_categories.PC_ID 
INNER JOIN users ON products.P_BY_U_ID = users.U_ID
ORDER BY P_VIEWS ASC; 
";
$getproducts = mysqli_query($connectionString,$getproductssql);

$curr_date = date("Y-m-d");

$getalllistingssql = "SELECT * FROM products WHERE P_BY_U_ID = '$u_id'";
$getalllistings = mysqli_query($connectionString,$getalllistingssql);

$num_of_listings = mysqli_num_rows($getalllistings);
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Home | BarterMate</title>
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



</head>

<style>
#owl-demo .item{
  color: black;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  text-align: center;
}

.carousel-control-prev-icon, .carousel-control-next-icon{
  background-color: black;
}


</style>
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
          <li><a class="nav-link scrollto active" href="index.php">Home</a></li>
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
          <h2>Home</h2>
          <ol>
            <li>Welcome, <?php echo $user_name?></li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->


    <section class="inner-page">
      <div class="container">
        
        <div class="row">

      
      <div class="card border-success text-success mb-3 p-0 m-2 col-sm-10 col-md col-lg">
        <a href="add_listing.php">  
        <div class="card-header"><i class="ri-add-line ri-md"></i></div>
        <div class="card-body text-dark">
          <h5 class="card-title">Add New Listing</h5>
          <p class="card-text text-muted">Add A New Product For <strong class="text-success">Sale</strong> or <strong class="text-primary">Swap</strong></p>
        </div>
        </a>
      </div>
      

      <div class="card border-info text-info mb-3 p-0 m-2 col-sm-10 col-md col-lg">
        <a href="product_listings.php"> 
         <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-info">
              <?php echo $num_of_listings?>
              <span class="visually-hidden">unread messages</span>
          </span> 
        <div class="card-header"><i class="ri-list-check ri-md"></i></div>
        <div class="card-body text-dark">
          <h5 class="card-title">Manage Listings</h5>
          <p class="card-text text-muted"><strong class="text-info">Edit</strong> or <strong class="text-danger">Delete</strong> Your Previous Listings</p>
        </div>
        </a>
      </div>

      <div class="card border-warning text-warning mb-3 p-0 m-2 col-sm-10 col-md col-lg">
        <a href="saved_listings.php">
           <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning">
              1+
              <span class="visually-hidden">unread messages</span>
            </span>
        <div class="card-header"><i class="ri-save-3-fill ri-md"></i></i></div>
        <div class="card-body text-dark">
          <h5 class="card-title">Saved Listings</h5>
          <p class="card-text text-muted">Manage Saved Listings </p>
        </div>
        </a>
      </div>

        </div>  


        
        <hr>
        <a href="explore.php"><h3>Browse</h3></a>
        <h5>Most-Viewed Products</h5>

<br>
       
    <div id="owl-demo" class="owl-carousel owl-theme row">
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

      
        <img src="<?php echo $img_row['PI_IMG_URL']?>" class="d-block img-responsive img-fluid" style="object-fit:scale-down; aspect-ratio: 2 / 1;" alt="...">
      

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

  <div class="item ">
    <div class="card" >
      <img src="assets/img/features-2.png" class="card-img-top" alt="...">
      <div class="card-body">
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
      </div>
    </div>
  </div>

  <div class="item">
   <div class="card" >
      <img src="assets/img/features-3.png" class="card-img-top" alt="...">
      <div class="card-body">
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
      </div>
    </div>
  </div>

  <div class="item ">
   <div class="card" >
      <img src="assets/img/features-4.png" class="card-img-top" alt="...">
      <div class="card-body">
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
      </div>
    </div>
  </div>

  <div class="item ">
    <div class="card" >
      <img src="assets/img/features-3.png" class="card-img-top" alt="...">
      <div class="card-body">
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
      </div>
    </div>
  </div>

  <div class="item ">
    <div class="card" >
      <img src="assets/img/features-2.png" class="card-img-top" alt="...">
      <div class="card-body">
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
      </div>
    </div>
  </div>

  <div class="item ">
    <div class="card" >
      <img src="assets/img/features-4.png" class="card-img-top" alt="...">
      <div class="card-body">
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
      </div>
    </div>
  </div>

  <div class="item ">
    <div class="card" >
      <img src="assets/img/features-1.png" class="card-img-top" alt="...">
      <div class="card-body">
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
      </div>
    </div>
  </div>
 
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
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
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