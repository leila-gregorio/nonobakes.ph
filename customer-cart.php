
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
//Cookie Checker
if(!isset($_COOKIE['cookieID'])){
    header("location:customer-order.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart | Nonobakes</title>
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
                    <a href="customer-menu.php" class="nav-link ">Menu</a>
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
                    <a href="customer-cart.php" class="nav-link active">Cart</a>
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
            <h3 class="headline headline-dark">Your Cart</h3><br>
                <div class="container">
                    <div class="row">

                        <div class="description padding-right animate-left">
                            <div>
                                <br>
                            </div>


                                <?php

                                $sql = "SELECT * FROM `cart` WHERE `cookieID` = ?";
                                if ($stmt = mysqli_prepare($link, $sql)) {
                                    mysqli_stmt_bind_param($stmt, "s", $_COOKIE['cookieID']);
                                    if (mysqli_stmt_execute($stmt)) {
                                        $result = mysqli_stmt_get_result($stmt);
                                        //If cookieID does exist in db
                                        if (mysqli_num_rows($result) == 1) {

                                            while ($row = mysqli_fetch_array($result)) {
                                                if(!is_null($row['cakeFilling']) ) {
                                                    $size = "";
                                                    $items = explode(',', $row['cakeSize']);
                                                    foreach ($items as $s) {
                                                        $size = strval($items[0]);
                                                    }

                                                    echo "<div class='cart-cont animate-left'><div class=' description-title text-center' style='text-indent: 1%;'><h2>Order Information</h2></div>
                                                      <br><table class='center'><tr><td><h2>Cake Size</h2>
                                                      <p>" . $size . "</p></td>
                                                      <td><h2>Cake Flavor</h2>
                                                      <p>" . $row['cakeFlavor'] . "</p></td></tr>
                                                      <tr><td><h2>Cake Filling</h2>
                                                      <p>" . $row['cakeFilling'] . "</p></td>
                                                      <td><h2>Base Color</h2>
                                                      <p>" . $row['baseColor'] . "</p></td></tr>
                                                      <tr><td><h2>Text Color</h2>
                                                      <p>" . $row['textColor'] . "</p></td>
                                                      <td></tf><h2>Short Dedication</h2>
                                                      <p>" . $row['dedication'] . "</p></td></tr>
                                                      <tr><td><h2>Font Style</h2>
                                                      <p>" . $row['textStyle'] . "</p></td>
                                                      <td><h2>Design Description</h2>
                                                      <p>" . $row['designDescription'] . "</p></td></tr></table></div>
 
                                                                            ";
                                                }
                                                ?>


                            <div class="cart-cont animate-left">
                                <?php
                                $time = new DateTime($row['deliveryTime']);
                                $time = date_format($time, 'g:i A');

                                $date = new DateTime($row['deliveryDate']);
                                $date = date_format($date, 'jS F Y | D');

                                echo "<div class=' description-title text-center' style='text-indent: 1%;'><h2>Deliver Information</h2></div>
                                        <table  class='center'><tr><td><h2>Name</h2>
                                        <p>".$row['name']."</p></td>
                                        <td><h2>Address</h2>
                                        <p>".$row['address']."</p>
                                    </td></tr>
                                    <tr><td><h2>Contact No.</h2>
                                        <p>".$row['contactNo']."</p></td>
                                        <td><h2>Email</h2>
                                        <p>".$row['email']."</p>
                                    </td></tr>
                                    <tr><td><h2>Pin Location</h2>
                                        <p>".$row['pinLocation']."</p></td>
                                        <td><h2>Delivery Date</h2>
                                        <p>".$date."</p></td></tr>
                                    <tr><td><h2>Delivery Time</h2>
                                         <p>".$time."</p></td>
                                         <td><h2>Delivery Mode</h2>
                                         <p>".$row['deliveryMode']."</p></td></tr>
                                    <tr><td><h2>Payment Mode</h2>
                                         <p>".$row['paymentMode']."</p></td>
                                       </tr>
                                         
                                         <br></table></div>";

                             ?>
                            </div>
                        <div class="image animate-right">
                            <?php
                            if (isset($_COOKIE['pathCookie']) and $_COOKIE['pathCookie']!== "") {
                                echo "<img src=".$_COOKIE['pathCookie']." class='order-image  form-control'>
                                      <input type='hidden' value='".$_COOKIE['pathCookie']."'  name='previous'>";
                            }
                            ?><br>
                            <img class="order-image" src="images/ty.png" alt="bread">
                             <?php if(is_null($row['cakeFilling']) ) {
                                 echo "<a href='customer-order-others.php' class='btn btn-secondary margin-10'>EDIT ORDER</a><br>";
                                }else{
                                 echo "<a href='customer-order.php' class='btn btn-secondary margin-10'>EDIT ORDER</a><br>";
                             }
                            ?>
                            <a href="customer-payments.php" class="btn btn-secondary margin-10">CHECKOUT NOW</a>

                        </div>
                    </div>
                    <?php
                    if(isset($row['cartQuantity']) and isset($row['cartItems']) and isset($row['cartPrice'])){
                    $quantity = json_decode($row['cartQuantity']);
                    $items = json_decode($row['cartItems']);
                    $price = json_decode($row['cartPrice']);
                    $count = 1;
                    $quantityArr = [];
                    $quantityArr[0] = 1;

                    foreach ($quantity as $q) {
                        $quantityArr[$count] = $q;
                        $count = $count + 1;
                    }
                    $count = 0;
                    echo "<br><div style='border: 2px solid var(--dark-brown);background: var(--beige);border-radius: 4px;'class='row center-tb animate-left'><table class=' add-ons-tb' >
                                   <tr><th>Name</th><th>Price</th><th>Quantity</th></tr>";

                    foreach ($items as $s) {
                        echo "<tr>
                                            <td>" . $items[$count] . "</td>
                                            <td>" . $price[$count] . "</td>
                                            <td> " . $quantityArr[$count] . " </td></tr>";
                        $count = $count + 1;
                    }
                    echo "</table>";
                    echo "<br><h2 style='text-indent: 10%'>Total :₱". $row['totalPrice'] . "</h2></div></div></div></div>";

                    }
                    }
                    }
                    }
                    }



                    ?>
                    </div>
            <section class="our-story">
                <div class="container">
                    <div class="row">
                        <div class="description padding-right animate-left">

                        </div>
                    </div>
                </div>
            </section>

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