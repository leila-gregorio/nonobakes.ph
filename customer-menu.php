<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu | Nonobakes</title>
    <!--font and icons-->
    <link rel="icon" href="images/logo.png">
    <link
        href="https://fonts.googleapis.com/css2?family=Cabin&family=Herr+Von+Muellerhoff&family=Poiret+One&family=Source+Sans+Pro:wght@700&display=swap"
        rel="stylesheet">
    <!--scroll reveal-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <!--scroll reveal-->
    <script src="https://unpkg.com/scrollreveal@3.3.2/dist/scrollreveal.min.js"></script>
    <!-- js, css design -->
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="js/app.js" defer></script>
    <!-- bootstrap, css design -->
    <link rel="stylesheet" defer href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" defer />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="style-customer.css" defer>






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

    <!-- BAKERS -->
    <section class="bakers">
        <div class="container">
            <div class="global-headline">
                <h3 class="headline headline-dark">Menu</h3>
                <div class="asterisk"></i></div><br><br>
            </div>
                <div class="baker center">
                    <div class="card-deck">

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
                    }
                    $query = mysqli_query($link, "SELECT * FROM `product` WHERE `productStatus`='ACTIVE' and `productDescription`='BENTO CAKE'") or die(mysqli_error($link));
                    while($fetch = mysqli_fetch_array($query)){
                    ?>
                        <div class="col-md-4 col-12  mx-auto mt-3">
                            <div class="card mx-auto cart-cont" >
                            <img src="<?php echo $fetch['productImage']?>" class="card-img-top image-td" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $fetch['productName']?></h5>
                                <p class="card-text"><?php echo "₱".$fetch['productPrice']?></p>
                                <?php echo"<a href='customer-order.php?name=".$fetch['productName']."&price=".$fetch['productPrice']."&price=".$fetch['productPrice']."' class='btn btn-menu'>Add to Cart</a>"?>
                            </div>
                        </div>
                        </div><br>

                    <?php
                    }
                    $query2 = mysqli_query($link, "SELECT * FROM `product` WHERE `productStatus`='ACTIVE' and `productDescription`='OTHERS'") or die(mysqli_error($link));
                    while($row = mysqli_fetch_array($query2)){ ?>
                        <div class="col-md-4 col-12  mx-auto mt-3">
                            <div class="card cart-cont mx-auto " >
                                <img src="<?php echo $row['productImage']?>" class="card-img-top image-td" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row['productName']?></h5>
                                    <p class="card-text"><?php echo "₱".$row['productPrice']?></p>
                                    <?php echo"<a href='customer-order-others.php?name=".$row['productName']."&price=".$row['productPrice']."&slots=".$row['productSlots']."' class='btn btn-menu'>Add to Cart</a>"?>
                                </div>

                            </div>
                        </div>
                    <?php


                    }
            ?>



                    </div></div>

            <br>
            <div class="global-headline">
                <h3 class="headline headline-dark">Gallery</h3><br><br>
                <div class="asterisk"></div>
            </div>
            <!-- Gallery -->
            <div class="border-cont container animate-left"><br>
                <div class="card-deck mx-auto mt-3">

                <?php
                        //Table Load - Cake Flavor
                        $sql = "SELECT * FROM gallery ORDER BY galleryID;";
                        if ($stmt = mysqli_prepare($link, $sql)) {
                            if (mysqli_stmt_execute($stmt)) {
                                $result = mysqli_stmt_get_result($stmt);
                                build_gallery($result);
                            }
                        } else {
                            echo "Error on form load";
                        }
                    function build_gallery($result){
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_array($result)) {
                    ?>
                                <div class="col-md-4 col-12 mx-auto">
                                    <div class="card-cont">
                                        <img src="<?php echo $row['galleryImage']?>" class="card-img-top" alt="...">

                                    </div><br>

                                </div>
                        <?php

                        }
                    }
                }
                ?>
            </div>
            </div>
        </div>




    <section class="delight">
        <div class="container">
            <div class="row">
                <div class="description padding-right animate-left">
                    <div class="global-headline">
                        <h3 class="headline headline-dark">INTERESTED IN OUR SPECIAL BENTO CAKE?</h3>
                    </div>
                </div>
                <div class="image-group animate-right">
                    <img class="animate-top" src="images/men.png" alt="bread">
                    <img class="animate-bottom" src="images/menmen.png" alt="bread">
                </div>
            </div>
        </div>
    </section>
        </div>
    </section>



    <!-- JOIN US SECTION -->
    <section class="join-us">
        <div class="container">
            <div class="row">
                <div class="image padding-right animate-left">
                    <img src="images/about-img-1.jpeg" alt="bread">
                </div>
                <div class="description animate-right" >
                    <div class="global-headline">
                        <h3 class="headline headline-dark">Order Now</h3>
                        <a href="customer-order.php" class=" btn-secondary">Click here to order</a>
                        <div class="asterisk"></i></div>
                    </div>
                </div>
            </div>
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