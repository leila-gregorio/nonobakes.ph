<?php


?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Proof | Nonobakes</title>
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
<head>

    <section class="hero small-size-hero" id="hero">
    </section>

    <!--Payments-->


    <section class="orders">
        <div class="container">
            <div class="container">
                <div class="global-headline">
                    <h3 class="headline headline-dark">Payment</h3><br><br><br>
                </div>

                <div class ="design-page">
                    <div class="row2">
                        <div class="column2 animate-left">
                            <br>
                            <div class="description-title" >
                                <p>Upload Proof of Payment</p>
                                <br><hr class="center"><br>
                            </div>
                            <form action="customer-save-proof.php" method="POST" enctype="multipart/form-data" >
                                <div class="center">
                                    <!-- Add validation -->
                                    <input type="hidden" name="token" value="<?php echo $_GET['token']?>" required>
                                    <?php
                                    if (isset($_COOKIE['proofCookie'])) {
                                        echo "<input class='btn-upload' type='file' id='myFile'  name='productImage' onchange='preview()' value='". $_COOKIE['proofCookie']."' required>";
                                    }else{

                                        echo "<input class='btn-upload' type='file' id='myFile'  name='productImage' onchange='preview()' required><br>";


                                    }?>                                </div>
                                <div class="center">
                                    <?php
                                    if (isset($_COOKIE['proofCookie']) and $_COOKIE['proofCookie']!== "") {
                                        echo "<img src=".$_COOKIE['proofCookie']." class='order-image  form-control'>
                                         <br><input type='hidden' value='".$_COOKIE['proofCookie']."'  name='previous'>";
                                    }else{
                                        echo"<img class='order-image center form-control' id='thumb'  width='150px'/>";
                                    }
                                    ?>
                                </div>
                        </div>
                    </div>
                </div>
                        <div class="center inline">
                                    <!-- Change href to proper next page (order summary)-->
                                    <a class=" link-btn animate-left" href="customer-payments.php"><i class="fas fa-arrow-alt-circle-left"></i>Back</a>
                                    <!-- Change href to proper next page(order received alert & home)-->
                                    <button name="btnNext" class="link-btn animate-right no-bg" >Next <i class="fas fa-arrow-alt-circle-right"></i></button>
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
                        <form action="customer-contacts.php" class="newsletter-form">
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


    <!--Latest version Script-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>