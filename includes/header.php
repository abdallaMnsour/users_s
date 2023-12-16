<?php
session_start();
require_once 'functions/connect.php';
$user_bool = false;
$home_bool = false;
$about_bool = false;
$services_bool = false;
$portfolio_bool = false;
$our_blog_bool = false;
$contact_me_bool = false;

if (isset($_COOKIE['user_login_id'])) {
  $user_bool = true;
  $query = mysqli_query($conn, "SELECT * FROM users WHERE id = '{$_COOKIE['user_login_id']}'");

  $_SESSION['user_login'] = mysqli_fetch_assoc($query);
  $user = $_SESSION['user_login'];
} else if (isset($_SESSION['user_login'])) {
  $user_bool = true;
  $query = mysqli_query($conn, "SELECT * FROM users WHERE id = '{$_SESSION['user_login']['id']}'");
  $user = mysqli_fetch_assoc($query);
}
if (isset($_GET['page'])) {
  if ($_GET['page'] == 'home') {
    $home_bool = true;
  } else if ($_GET['page'] == 'about') {
    $about_bool = true;
  } else if ($_GET['page'] == 'services') {
    $services_bool = true;
  } else if ($_GET['page'] == 'portfolio') {
    $portfolio_bool = true;
  } else if ($_GET['page'] == 'our_blog') {
    $our_blog_bool = true;
  } else if ($_GET['page'] == 'contact_me') {
    $contact_me_bool = true;
  }
}
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Rasalina - Personal Portfolio HTML Template</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
  <!-- Place favicon.ico in the root directory -->

  <!-- CSS here -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/animate.min.css">
  <link rel="stylesheet" href="assets/css/magnific-popup.css">
  <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
  <link rel="stylesheet" href="assets/css/slick.css">
  <link rel="stylesheet" href="assets/css/default.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/responsive.css">
</head>

<body>

  <!-- preloader-start -->
  <div id="preloader">
    <div class="rasalina-spin-box"></div>
  </div>
  <!-- preloader-end -->

  <!-- Scroll-top -->
  <button class="scroll-top scroll-to-target" data-target="html">
    <i class="fas fa-angle-up"></i>
  </button>
  <!-- Scroll-top-end-->

  <!-- header-area -->
  <header>
    <div id="sticky-header" class="menu__area transparent-header">
      <div class="container custom-container">
        <div class="row">
          <div class="col-12">
            <div class="mobile__nav__toggler"><i class="fas fa-bars"></i></div>
            <div class="menu__wrap">
              <nav class="menu__nav">
                <div class="logo">
                  <a href="index.php" class="logo__black"><img src="assets/img/logo/logo_black.png" alt=""></a>
                  <a href="index.php" class="logo__white"><img src="assets/img/logo/logo_white.png" alt=""></a>
                </div>
                <div class="navbar__wrap main__menu d-none d-xl-flex">
                  <ul class="navigation">
                    <li class="<?= isset($_GET['page']) ? ($home_bool ? 'active' : '') : 'active' ?>"><a href="index.php?page=home">Home</a></li>
                    <li class="<?= $about_bool ? 'active' : '' ?>"><a href="about.php?page=about">About</a></li>
                    <li class="<?= $services_bool ? 'active' : '' ?>"><a href="services-details.php?page=services">Services</a></li>
                    <li class="<?= $portfolio_bool ? 'active' : '' ?> menu-item-has-children"><a href="#">Portfolio</a>
                      <ul class="sub-menu">
                        <li><a href="portfolio.php?page=portfolio">Portfolio</a></li>
                        <li><a href="portfolio-details.php?page=portfolio">Portfolio Details</a></li>
                      </ul>
                    </li>
                    <li class="<?= $our_blog_bool ? 'active' : '' ?> menu-item-has-children"><a href="#">Our Blog</a>
                      <ul class="sub-menu">
                        <li><a href="blog.php?page=our_blog">Our News</a></li>
                        <li><a href="blog-details.php?page=our_blog">News Details</a></li>
                      </ul>
                    </li>
                    <li class="<?= $contact_me_bool ? 'active' : '' ?>"><a href="contact.php?page=contact_me">contact me</a></li>
                  </ul>
                </div>
                <?php if ($user_bool) : ?>
                  <div class="header__btn d-none d-md-block">
                    <a href="account.php" class="btn">account</a>
                    <a href="login/logout.php" class="btn">logout</a>
                  </div>
                <?php else : ?>
                  <div class="header__btn d-none d-md-block">
                    <a href="login/login.php" class="btn">Login</a>
                    <a href="login/register.php" class="btn">Register</a>
                  </div>
                <?php endif; ?>
              </nav>
            </div>
            <!-- Mobile Menu  -->
            <div class="mobile__menu">
              <nav class="menu__box">
                <div class="close__btn"><i class="fal fa-times"></i></div>
                <div class="nav-logo">
                  <a href="index.php" class="logo__black"><img src="assets/img/logo/logo_black.png" alt=""></a>
                  <a href="index.php" class="logo__white"><img src="assets/img/logo/logo_white.png" alt=""></a>
                </div>
                <div class="menu__outer">
                  <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                </div>
                <div class="social-links">
                  <ul class="clearfix">
                    <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                    <li><a href="#"><span class="fab fa-facebook-square"></span></a></li>
                    <li><a href="#"><span class="fab fa-pinterest-p"></span></a></li>
                    <li><a href="#"><span class="fab fa-instagram"></span></a></li>
                    <li><a href="#"><span class="fab fa-youtube"></span></a></li>
                  </ul>
                </div>
              </nav>
            </div>
            <div class="menu__backdrop"></div>
            <!-- End Mobile Menu -->
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- header-area-end -->