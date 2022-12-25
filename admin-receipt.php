<?php
//Session Checker
session_start();
if(!isset($_SESSION['username'])){
    header("location:admin-login.php");
}

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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Order Receipt | Nonobakes </title>
    <link rel="icon" href="images/logo.png">
    <link
            href="https://fonts.googleapis.com/css2?family=Cabin&family=Herr+Von+Muellerhoff&family=Poiret+One&family=Source+Sans+Pro:wght@700&display=swap"
            rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <script src="js/script.js" defer></script>
    <script src="https://unpkg.com/scrollreveal"></script>
    <link rel="stylesheet" href="style-admin.css">
    <link rel="stylesheet" href="style-customer.css">

</head>
<body>

<!-- HEADER -->

<header>
    <div class="container">
        <nav class="navbar-con">
            <!-- TOGGLE MENU -->
            <div class="menu-toggle">
                <i class="fas fa-bars"></i>
                <i class="fas fa-times"></i>
            </div>
            <!-- LOGO -->
            <div class ="logo">
                <img src="images/logo.png" alt="" class="logoimg">
                <a href="admin-home.php" class="logo">Nonobakes</a>
            </div>
            <ul class="nav-list">
                <li class="nav-item">
                    <a href="admin-home.php" class="nav-link link-font">Home</a>
                </li>
                <li class="nav-item">
                    <a href="admin-feedback.php" class="nav-link link-font">Feedback</a>
                </li>
                <li class=" nav-item">
                    <a href="admin-product-manage.php" class="nav-link link-font">Products</a>
                </li>
                <li class="nav-item">
                    <a href="admin-order-manage.php" class="nav-link link-font">Orders</a>
                </li>
                <li class="nav-item">
                    <a href="admin-form-manage.php" class="nav-link link-font">Form</a>
                </li>
                <!-- EDIT for backend -->
                <li class="nav-item">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <a href="admin-logout.php"><i class="fas fa-sign-out-alt nav-link" ></i></a>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</header>


<!-- HERO SECTION -->

<section class="hero small-size-hero" id="hero">
</section>

    <!-- BAKERS -->
    <section class="bakers" style="margin: 0 auto">
        <div class="container">
            <div class="global-headline">
                <h3 class="headline headline-dark">Order Receipt</h3><br>
                <div class="container">
                    <div class="row">
                        <div class='description animate-left'><div>

                                <?php
                                $sql = "SELECT * FROM `order` WHERE `orderId` = ?";
                                if ($stmt = mysqli_prepare($link, $sql)) {
                                    mysqli_stmt_bind_param($stmt, "s", $_GET['orderID']);
                                    if (mysqli_stmt_execute($stmt)) {
                                        $result = mysqli_stmt_get_result($stmt);
                                        build_table_cakeSize($result);
                                    }
                                } else {
                                    echo "Error on form load";
                                }
                                function build_table_cakeSize($result)
                                {

                                if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_array($result)) {
                                $items = json_decode($row['orderItems']);
                                $price = json_decode($row['orderPrices']);
                                $quantity = json_decode($row['orderQuantity']);

                                $size ="";
                                $count = 0;
                                foreach($items as $s){
                                    $size = strval($items[0]);
                                    $count = $count + 1;
                                }
                                echo "<div class='description-title text-center' style='text-indent: 1%;'><p>Order Information</p></div>
                                    <div class='column center animate-left'>
                                    <table>
                                    <tr><td><h3>Cake Size</h3>
                                        <p>".$size."</p></td>
                                        <td><h3>Cake Flavor</h3>
                                        <p>".$row['orderFlavor']."</p>
                                    </td></tr>
                                    <tr><td><h3>Cake Filling</h3>
                                        <p>".$row['orderFilling']."</p></td>
                                        <td><h3>Base Color</h3>
                                        <p>".$row['orderBase']."</p>
                                    </td></tr>

                                    <tr><td><h3>Text Color</h3>
                                        <p>".$row['orderTextColor']."</p></td>
                                        <td><h3>Short Dedication</h3>
                                        <p>".$row['orderText']."</p></td></tr>

                                    <tr><td><h3>Font Style</h3>
                                         <p>".$row['orderFont']."</p></td>
                                         
                                         <br></table></div></div></div>";



                                ?>
                                <div class="card" >
                                    <img  class="order-image animate-right"  src="<?php echo $row['orderImage']?>" alt="bread">
                                </div>
                            </div>
                        </div>
                    </div></div>

                <?php

                $count = 1;
                $quantityArr = [];
                $quantityArr[0] = 1;
                if (is_array($quantity) || is_object($quantity)) {

                    foreach ($quantity as $q) {
                        $quantityArr[$count] = $q;
                        $count = $count + 1;
                    }
                }
                $count = 0;
                echo "<div class='border row center-tb animate-right'><table class=' add-ons-tb' >
                                   <tr><th>Name</th><th>Price</th><th>Quantity</th></tr>";
                if (is_array($items) || is_object($items)) {
                    foreach ($items as $s) {
                        echo "<tr>
                                            <td>" . $items[$count] . "</td>
                                            <td>" . $price[$count] . "</td>
                                            <td> " . $quantityArr[$count] . " </td></tr>";
                        $count = $count + 1;
                    }
                    echo "</table>";
                }
                }
                }
                }

                $sql = "SELECT * FROM `order summary` WHERE `orderSummaryID` = ?";
                if ($stmt2 = mysqli_prepare($link, $sql)) {
                    mysqli_stmt_bind_param($stmt2, "s", $_GET['orderID']);
                    if (mysqli_stmt_execute($stmt2)) {
                        $result2 = mysqli_stmt_get_result($stmt2);
                        build_table_summary($result2);
                    }
                } else {
                    echo "Error on form load";
                }
                function build_table_summary($result2)
                {
                if (mysqli_num_rows($result2) > 0) {
                while ($row2 = mysqli_fetch_array($result2)) {
                $time = new DateTime($row2['deliveryTime']);
                $time = date_format($time, 'g:i A');

                $date = new DateTime($row2['deliveryDate']);
                $date = date_format($date, 'jS F Y | D');
                echo "<br><h2 style='text-indent: 10%'>Total :₱". $row2['totalPrice'] . "</h2></div></div></div></div>";

                echo "<br><br><br><br><div class='row center'><div class='description animate-left'><div><div class='description-title text-center';'><p>Delivery Information</p></div>
                                    <div class='column center animate-left'>
                                    <table class='tb-receipt' >
                                    <tr><td><h3>Name</h3>
                                        <p>".$row2['customerName']."</p></td>
                                        <td><h3>Address</h3>
                                        <p>".$row2['customerAddress']."</p>
                                    </td></tr>
                                    <tr><td><h3>Contact No.</h3>
                                        <p>".$row2['contactNumber']."</p></td>
                                        <td><h3>Email</h3>
                                        <p>".$row2['email']."</p>
                                    </td></tr>
                                    <tr><td><h3>Pin Location</h3>
                                        <p>".$row2['pinLocation']."</p></td>
                                        <td><h3>Delivery Date</h3>
                                        <p>".$date."</p></td></tr>
                                    <tr><td><h3>Delivery Time</h3>
                                         <p>".$time."</p></td>
                                         <td><h3>Delivery Mode</h3>
                                         <p>".$row2['deliveryMode']."</p></td></tr>
                                    <tr><td><h3>Payment Mode</h3>
                                         <p>".$row2['paymentMode']."</p></td>
                                         <td><h3>Order Status</h3>
                                         <p>".$row2['status']."</p></td></tr>
                                         
                                         <br></table>";
                ?>

            </div></div>
        <div class=' card-receipt animate-left'>
            <div class=" card-receipt card">
                <img class="order-image"  src="<?php echo $row2['paymentProof']?>">
            </div>
        </div>
        <?php

        }
        }
        }

        ?>
    </section>
</body>
</html>

