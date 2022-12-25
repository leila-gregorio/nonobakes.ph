<?php
//Db Connection
define('DB_SERVER', '127.0.0.1');
define('DB_USERNAME', 'nonobakes');
define('DB_PASSWORD', 'nonobakes');
define('DB_NAME', 'nonobakes.ph');
error_reporting(E_ALL); ini_set('display_errors', 1);
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
//Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}//Cookie Checker
if(!isset($_COOKIE['cookieID'])){
    header("location:customer-order.php");
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order | Nonobakes</title>
    <link rel="icon" href="images/logo.png">
    <script src="js/app.js" defer></script>
    <link
            href="https://fonts.googleapis.com/css2?family=Cabin&family=Herr+Von+Muellerhoff&family=Poiret+One&family=Source+Sans+Pro:wght@700&display=swap"
            rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <script src="https://unpkg.com/scrollreveal"></script>
    <link rel="stylesheet" href="style-customer.css">
</head>

<body>
<!-- HEADER -->
<header>
    <div class="container">
        <nav class="navbar-con">
            <div class="menu-toggle">
                <i class="fas fa-bars"></i>
                <i class="fas fa-times"></i>
            </div>
            <div class ="logo">
                <img src="images/logo.png" alt="" class="logoimg">
                <a href="customer-index.php" class="logo">Nonobakes</a>
            </div>
            <ul class="nav-list">
                <li class="nav-item">
                    <a href="customer-index.php" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="customer-menu.php" class="nav-link active">Menu</a>
                </li>
                <li class="nav-item dropdown-nav ">
                    <button class="btn-drops" onclick="myFunction()">
                        About Us <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-cont" id="myDropdown">
                        <a href="about.html">About Us</a>
                        <a href="customer-contacts.php">Contact Us</a>
                        <a href="customer-faqs.php">FAQS</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="customer-cart.php" class="nav-link">Cart</a>
                </li>
            </ul>
        </nav>
    </div>
</header>

<!-- HERO SECTION -->

<section class="hero small-size-hero" id="hero">
</section>


<section class="orders">
    <div class="container">
        <div class="global-headline">
            <h3 class="headline headline-dark">Your Design</h3><br><br><br>
        </div>
        <form action="customer-place-order.php" method="POST" enctype="multipart/form-data" >

        <div class ="design-page">
            <div class="row2">
                <div class="column2 animate-left">
                    <br>
                    <div class="description-title" >
                        <p>Order Description</p>
                        <br><hr class="center"><br>
                    </div>
                    <?php

                    $sql = "SELECT * FROM `cart` WHERE `cookieID`=?";
                    if($stmt = mysqli_prepare($link, $sql)){
                        mysqli_stmt_bind_param($stmt, "s", $_COOKIE['cookieID']);
                        if(mysqli_stmt_execute($stmt)){
                            $result = mysqli_stmt_get_result($stmt);
                            if (mysqli_num_rows($result) == 1) {
                            }else{
                                echo "Error on select statement";
                            }
                        }

                    }
                    while($fetch = mysqli_fetch_array($result,MYSQLI_ASSOC)){

                    ?>
                            <div class="textarea_style center">
                                <textarea class="textarea"  name="textarea_description" id="textarea" onkeyup="charCount();" minlength="4" placeholder="Write your description here" required><?php if (isset($fetch['designDescription'])) {
                                        echo $fetch['designDescription'];
                                    }?></textarea>
                            </div>
                    <br>
                    <br><div class="description-title" >
                        <p>Your Design</p>
                        <br><hr class="center"><br>
                    </div>
                        <div class="center">
                            <?php
                            if (isset($_COOKIE['pathCookie'])) {
                                echo "<input class='btn-upload' type='file' id='myFile'  name='productImage' onchange='preview()' value='". $_COOKIE['pathCookie']."' required";
                            }else{

                            echo "<input class='btn-upload' type='file' id='myFile'  name='productImage' onchange='preview()' required>";


                            }?><br>
                        </div>
                        <div class="center">
                            <?php
                            if (isset($_COOKIE['pathCookie']) and $_COOKIE['pathCookie']!== "") {
                                echo "<img src=".$_COOKIE['pathCookie']." class='order-image  form-control'>
                                      <input type='hidden' value='".$_COOKIE['pathCookie']."'  name='previous'>";
                            }else{
                                echo"<img class='order-image center form-control' id='thumb'  width='150px'/>";
                            }
                            }
                            ?>
                        </div>

                </div>

            </div>

        </div>
        <div class="center inline ">
            <!-- Change href to proper next page (home)-->
            <a class="link-btn animate-left" href="customer-order.php"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
            <!-- Change href to proper next page (upload design image)-->
            <button  type="submit" class="link-btn animate-right no-bg"  name="btnNext">Next <i class="fas fa-arrow-alt-circle-right"></i></button>
        </div>
        </form>
    </div>
</section>



<!-- FOOTER -->
<footer>
    <div class="container">
        <div class="back-to-top">
            <a href="#hero"><i class="fas fa-chevron-up"></i></a>
        </div>
        <div class="footer__content">
            <div class="footer__content-about animate-top">
                <h4>About nonobakes.ph</h4>
                <div class="asterisk"><i class="fas fa-asterisk"></i></div>
                <p>All of our baked items were baked with love, enthusiasm, and firm commitment.</p>
            </div>
            <div class="footer__content-divider animate-bottom">
                <div class="social-media">
                    <h4>Follow Us</h4>
                    <ul class="social-icons">
                        <li>
                            <a href="https://www.facebook.com/nonobakes.ph">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/nonobakes.ph/">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="newsletter-container">
                    <h4>Newsletter</h4>
                    <form action="" class="newsletter-form">
                        <div class="newsletter-form-box">
                            <input type="text" class="newsletter-input" placeholder="Your email address...">
                            <button class="newsletter-btn" type="submit">
                                <i class="fas fa-envelope"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</footer>
</body>

</html>