<?php

?>

<nav id="navbar" class="navbar">
    <ul>
        <li><a class="nav-link scrollto" href="index.php">Home</a></li>
        <li><a class="nav-link scrollto" href="explore.php">Explore</a></li>
       <!-- <li><a class="nav-link scrollto" href="store.php"> <i style="margin-left: 0px !important;" class='bx bx-coin bx-sm'> </i> </a></li> -->
        <li class="position-relative"><a class="nav-link scrollto" href="offers.php">Offers</a></li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="<?php echo $user_img?>" style="width: 32px; border-radius: 2rem; height: 32px; object-fit: scale-down; background-color: white; aspect-ratio: 4/3;" class="img-fluid" alt="">
            </a>
            <ul class="dropdown-menu text-dark" aria-labelledby="navbarDarkDropdownMenuLink1">
                <li><a class="dropdown-item" style="color: black!important;"  href="profile.php?id=<?php echo $u_id?>">Profile Settings</a></li>
                <li><a class="dropdown-item" style="color: black!important;"  href="logout.php">Logout</a></li>
            </ul>
        </li>
    </ul>
    <i class="bi bi-list mobile-nav-toggle"></i>
</nav><!-- .navbar -->

<?php

?>