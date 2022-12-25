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
    <title>Payment Information| Nonobakes</title>
    <link rel="icon" href="images/logo.png">
    <script src="js/app.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="js/store.js" async ></script>
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <!-- bootstrap, css design -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="style-customer.css">

</head>

<body>
<!--ajax script-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>

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
                    <a href="customer-menu.php" class="nav-link">Menu</a>
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

<section class="my-5 py-5">
    <div class="container">
        <!-- modal form -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <!-- Modal 1|Create User -->
            <div id="theModal1" class="modal text-center">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-style  modal-content modal-header" id="mod2">
                            <div id="mod1">
                                <div class="description-title"><br>
                                    <button type="button" class="btn-close inline close inline" data-dismiss="modal"><i class="fas fa-times"></i></button>
                                    <p>Order Confirmation</p>
                                    <br><hr class="center hr-style "><br>
                                </div>
                                <div>
                                    <p>Do you want to confirm your order?</p> <br>

                                </div>
                                <div class="buttons">
                                    <input type = "submit" class="button btn-save" name = "btnConfirm" value = "Submit">                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="global-headline">
            <h3 class="headline headline-dark">Payment</h3><br><br><br>
        </div>
        <div class="payment-cont animate-left">
            <div class="description-title" >
                <p>Method</p>
                <br><hr class="center" style="width:35%;"><br>
            </div>
            <?php
            $sql = "SELECT * FROM `cart` WHERE `cookieID`=?";
            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $_COOKIE['cookieID']);
                if(mysqli_stmt_execute($stmt)){
                    $result = mysqli_stmt_get_result($stmt);
                    if (mysqli_num_rows($result) == 1) {
                        while($fetch = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                            //Load Cart Payment Mode
                            if(isset($fetch['paymentMode'])) {
                                echo "<input id='payMode' type='hidden' value='" . $fetch['paymentMode'] . "'>";
                            }
                        }
                    }
                }
            }
            ?>
                <form action="customer-payments.php" method="post" id="payments-form">
                    <div class="form-group">
                        <br><br>
                        <?php


                        ?>
                           <p class="label-radio">
                                <input name="pay" id="paymode1" type="radio" class="form-check-input" style="transform: translateX(-45px);" value="BPI Bank Transfer" required>
                                <label class="class="description-title for="paymode1">Bank Transfer (BPI)</label>
                            </p><br>
                            <h3>
                                BPI Account Number: 09611575135<br>
                                BPI Account Name: Jebbie
                            </h3>
                            <br>
                            <p class="label-radio">
                                <input name="pay" id="paymode2" type="radio" class="form-check-input" style="transform: translateX(-45px);"  value="GCash" required>
                                    <label for="paymode2">GCash</label>
                                </p>
                            <h3>
                                    GCash Account Number: 09611575135<br>
                                    GCash Account Name: Jebbie
                            </h3>
                        </div><br><br><br>
                        <div class="center">
                            <button type="submit" name="pay-order" class="btn" id="place-order" >Place Order</button><br>
                        </div><br>
                        <div class="center">
                            <a href="customer-cart.php" class="btn-secondary-black">Continue Shopping</a>
                        </div>

                </form>
                <script><!--Cart Value for PaymentMode-->
                    var e = document.getElementsByName("pay");
                    var dateInput = document.getElementById("payMode").value

                    for(i = 0; i <= e.length; i++) {

                        if(e[i].type="radio") {
                            if(e[i].value == dateInput) {
                                e[i].checked = true;
                            }
                        }
                    }
                </script>


        <?php

                                 ?>
        </div>
        <div class="center">
            <a class="link-btn animate-left" href="customer-payment-details.php"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
        </div>
    </div>
</section>

<!--Insert Footer here-->

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
</body>

</html>
<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


if(isset($_POST['pay-order']) and isset($_COOKIE['cookieID'])) {
    //Post variables
    //if(isset($_POST['pay']))
    $pay = $_POST['pay'];
    $cookieID = $_COOKIE['cookieID'];

    //Insert to Cart into Db -> cart table (SET EXPIRATION)
    //check if cookie id not set
    $sql = "SELECT * FROM `cart` WHERE `cookieID` = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $cookieID);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            //If cookieID does exist in db
            if (mysqli_num_rows($result) == 1) {
                //insert the value
                $sql = "UPDATE `cart` SET paymentMode = ? WHERE `cookieID` = ?; ";

                if ($stmt = mysqli_prepare($link, $sql)) {
                    mysqli_stmt_bind_param($stmt, "ss", $pay, $cookieID);
                    if (mysqli_stmt_execute($stmt)) {

                    } else {
                        echo "<script type='text/javascript'>alert('Error on edit statement');</script>";
                    }
                }
            }
            else {
                echo "<script type='text/javascript'> alert('cookies is not set');
                       window.location.replace('customer-order.php')</script>";
            }
        }
    }
    echo     "<script>
                $(window).on('load',function(){
                    $('#theModal1').modal('show');
                });
            </script>";
}else{
    echo "<script>
                $(window).on('load',function(){
                    $('#theModal1').modal('hide');
                });
            </script>";
}


if(isset($_POST['btnConfirm'])){
    $cookieID = $_COOKIE['cookieID'];

    $sql = "SELECT * FROM `cart` WHERE `cookieID` = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $cookieID);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            //If cookieID does exist in db
            if (mysqli_num_rows($result) == 1) {

            }
            else {
                echo "<script type='text/javascript'> alert('cookies is not set');
                       window.location.replace('customer-order.php')</script>";
            }
            saveToOrder($result, $link);
        }
    }

}
    function saveToOrder($result, $link)
    {
        if (mysqli_num_rows($result) <= 1) {
            while ($row = mysqli_fetch_array($result)) {
                $baseColor = $row['baseColor'];
                $flavor = $row['cakeFlavor'];
                $dedication = $row['dedication'];
                $filling = $row['cakeFilling'];
                $description = $row['designDescription'];
                $font = $row['textStyle'];
                $designImage = $row['designPicture'];
                $textColor = $row['textColor'];
                $items = $row['cartItems'];
                $prices = $row['cartPrice'];
                $quantity = $row['cartQuantity'];
                $cookieID = $_COOKIE['cookieID'];
                $size = explode(',', $row['cakeSize']);
                 $total= $row['totalPrice'];


                //Copy and assign image from cart to a new folder
                $file = $designImage;
                $newfile = "order/".$designImage;

                if (!copy($file, $newfile)) {
                    echo "failed to copy $file...\n";
                }


                $sql = "INSERT INTO  `order`(`orderId`, `orderBase`, `orderFlavor`, `orderText`, `orderFilling`, `orderInformation`, `orderFont`, `orderImage`, `orderTextColor`, `orderItems`, `orderPrices`, `orderQuantity`)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
                if ($stmt = mysqli_prepare($link, $sql)) {
                    mysqli_stmt_bind_param($stmt, "ssssssssssss", $cookieID, $baseColor, $flavor, $dedication, $filling, $description, $font, $newfile, $textColor, $items, $prices, $quantity);
                    if (mysqli_stmt_execute($stmt)) {
                        //MODIFY SLOTS  in product table
                        modifySlot($size,$link);
                    } else {
                        echo "<script type='text/javascript'>alert('Error on insert statement');</script>";
                        echo $link->error;

                    }
                } else {

                    echo "<script type='text/javascript'> alert('An error occured.');</script>";
                }
                //Save to Order Summary Table
                saveToOrderSummary($row, $link,$filling,$total);
            }
        }
    }
    function modifySlot($size, $link){
        $sizeStr ="";
        foreach($size as $s){
            $sizeStr = strval($size[0]);
        }
        echo $sizeStr;
        $sql = "SELECT * FROM `product` WHERE `productName` = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $sizeStr);
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                //If cookieID does exist in db
                if (mysqli_num_rows($result) <= 1) {
                    while ($row = mysqli_fetch_array($result)) {
                        $slot = $row['productSlots'];
                        $productID = $row['productID'];

                        echo "<script type='text/javascript'>alert('" . $slot . "');</script>";
                        //Updates Slot
                        $slot = intval($slot) - 1;
                        //If Slot == 0, set status to INACTIVE
                        if ($slot == 0) {
                            $sql = "UPDATE `product` SET `productSlots` = ?,  `productStatus` = 'INACTIVE' WHERE `productID` = ?; ";
                            if ($stmt = mysqli_prepare($link, $sql)) {
                                mysqli_stmt_bind_param($stmt, "ss", $slot, $productID);
                                if (mysqli_stmt_execute($stmt)) {
                                    //MODIFY product status if slots = 0
                                    echo "<script type='text/javascript'>alert('Slot Reservation Success');</script>";
                                } else {
                                    echo $link->error;
                                    echo "<script type='text/javascript'>alert('Error on edit statement');</script>";
                                }
                            } else {
                                echo $link->error;
                            }
                        }else{
                            $sql = "UPDATE `product` SET `productSlots` = ? WHERE `productID` = ?; ";
                            if ($stmt = mysqli_prepare($link, $sql)) {
                                mysqli_stmt_bind_param($stmt, "ss", $slot, $productID);
                                if (mysqli_stmt_execute($stmt)) {
                                    //MODIFY product status if slots = 0
                                    echo "<script type='text/javascript'>alert('Slot Reservation Success');</script>";
                                } else {
                                    echo $link->error;
                                    echo "<script type='text/javascript'>alert('Error on edit statement');</script>";
                                }
                            } else {
                                echo $link->error;
                            }
                        }
                    }
                }else{
                    echo $link->error;
                }
             } else {
                echo $link->error;
                }
        }
}
    //Save to order summary table
    function saveToOrderSummary($row, $link,$filling,$total){
       // $total = $row['totalPrice'];
        $status = "PENDING";
        $time = $row['deliveryTime'];
        $deliveryMode = $row['deliveryMode'];
        $paymentMode = $row['paymentMode'];
        $name = $row['name'];
        $address = $row['address'];
        $email = $row['email'];
        $number = $row['contactNo'];
        $pin = $row['pinLocation'];
        $deliveryDate = $row['deliveryDate'];
        $cookieID = $_COOKIE['cookieID'];
        $paymentProof = "";





        $sql = "INSERT INTO `order summary`(`orderSummaryID`, `totalPrice`, `status`, `deliveryTime`, `deliveryMode`, `paymentMode`, `customerName`, `customerAddress`, `email`, `contactNumber`, `pinLocation`, `deliveryDate`, `paymentProof`) 
                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?);";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssssssssssss", $cookieID, $total, $status, $time, $deliveryMode, $paymentMode, $name, $address, $email, $number, $pin, $deliveryDate,$paymentProof);
            if (mysqli_stmt_execute($stmt)) {
                //Send Email For Tracking
                sendTracking($email,$name,$_COOKIE['cookieID'],$link,$filling);

            } else {
                echo $link->error;
                echo "<script type='text/javascript'>alert('Error on insert statement');</script>";
            }
        } else {
            echo "<script type='text/javascript'> alert('An error occured.');</script>";
        }
    }


    //Send Email to customer's email
    function sendTracking($email,$name,$token,$link,$filling)
    {
        //Load Composer's autoloader
        require 'vendor/autoload.php';
        $proof = "<a href='http://localhost/Nonobakes/customer-payment-proof.php?token=".$token."'>here.</a>";
        if(!is_null($filling) ) {

            $click = "<a href='http://localhost/Nonobakes/customer-order-receipt.php?token=" . $token . "'>Click to track your order.</a>";
        }else{
            $click = "<a href='http://localhost/Nonobakes/customer-order-receipt-others.php?token=" . $token . "'>Click to track your order.</a>";

        }
        $mail = new PHPMailer();

        $mail->CharSet =  "utf-8";
        $mail->IsSMTP();
        // enable SMTP authentication
        $mail->SMTPAuth = true;
        // GMAIL username
        $mail->Username = "nonobakes.ph.2@gmail.com";
        // GMAIL password
        $mail->Password = "Nonobakes.ph123";
        $mail->SMTPSecure = "ssl";
        // sets GMAIL as the SMTP server
        $mail->Host = "smtp.gmail.com";
        // set the SMTP port for the GMAIL server
        $mail->Port = "465";
        $mail->From='nonobakes.ph.2@gmail.com';
        $mail->FromName='Nonobakes.ph';
        $mail->AddAddress($email, $name);
        $mail->Subject  =  'nonobakes.ph | Order Tracking';
        $mail->IsHTML(true);
        $mail->Body    = 'Thank you for choosing nonobakes.ph! <br> Please Upload you proof of payment '.$proof.' <br> '.$click.'<br>';
        try {
            if ($mail->Send()) {
                echo "<div class='correct error'>";
                echo "<div class='close' onclick='this.parentElement.remove()'><i class='fas fa-times-circle inline'></i></div>";
                echo "<p>Check Your Email to track your order.</p>";

                //After Placing order delete from cart & unset cookies & create a new session
                $sql = "DELETE FROM `cart` WHERE cookieID = ?; ";
                if($stmt = mysqli_prepare($link, $sql)){
                    mysqli_stmt_bind_param($stmt, "s", $token);
                    if(mysqli_stmt_execute($stmt)){
                        echo "<script type='text/javascript'>
                                ;window.location='customer-unset-cookies.php'
                              </script>";
                    }
                    else{
                        echo "<script type='text/javascript'>alert('Error on delete statement');
                                     //window.location.replace='admin-form-manage.php'
                                 </script>";
                    }
                }
            } else {
                echo "<div class='bar error'>";
                echo "<div class='close' onclick='this.parentElement.remove()'><i class='fas fa-times-circle inline'></i></div>";
                echo "<p>Mail Error - >" . $mail->ErrorInfo."</p>";
            }
        } catch (phpmailerException $e) {
            echo "<div class='bar error'>";
            echo "<div class='close' onclick='this.parentElement.remove()'><i class='fas fa-times-circle inline'></i></div>";
            echo "<p>Invalid Email Address.</p>";
        }
}

?>