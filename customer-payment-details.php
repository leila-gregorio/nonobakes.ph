<?php
//Db Connection
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

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Details | Nonobakes</title>
    <link rel="icon" href="images/logo.png">
    <script src="js/app.js" defer></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Cabin&family=Herr+Von+Muellerhoff&family=Poiret+One&family=Source+Sans+Pro:wght@700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <script src="js/reservation.js" async ></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://unpkg.com/scrollreveal"></script>
    <link rel="stylesheet" href="style-customer.css">

</head>

<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

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
<section class="orders">
    <div class="container">
        <div class="title center">
            <h3 class="headline headline-dark">Payment</h3>
        </div>
            <br><br>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">


                <div class="payment-details">

                    <?php /*
                    $size ="";
                    require_once "app/config.php";
                    $sql = "SELECT * FROM `cart` WHERE `cookieID`=?";
                    if($stmt = mysqli_prepare($link, $sql)){
                        mysqli_stmt_bind_param($stmt, "s", $_COOKIE['cookieID']);
                        if(mysqli_stmt_execute($stmt)){
                            $result = mysqli_stmt_get_result($stmt);
                            if (mysqli_num_rows($result) == 1){
                                while($fetch = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                                    $size = explode(',', $fetch['cakeSize']);
                                    ?>

                                <?php }
                            }else{
                            echo "Error on select statement";}}}


                    $sizeStr ="";

                    foreach($size as $s){
                        $sizeStr = strval($size[0]);
                    }
                    echo $sizeStr;

                    $month ="";
                    $sql = "SELECT `productCategory` FROM `product` WHERE `productName`=? ";
                    if($stmt = mysqli_prepare($link, $sql)){
                        mysqli_stmt_bind_param($stmt, "s", $sizeStr);
                         if(mysqli_stmt_execute($stmt)){
                            $result = mysqli_stmt_get_result($stmt);
                               if (mysqli_num_rows($result) == 1){
                                        while($fetch = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                                            $month = explode(',', $fetch['productCategory']);
                                            ?>

                                        <?php }
                                    }else{
                                    echo "Error on select statement";}}}
                    $monthStr ="";

                    foreach($month as $s){
                        $monthStr = strval($month[0]);
                    }
                    $newDate = date("d/m/Y", strtotime($monthStr));
*/

                    ?></div>
                <?php
                $sql = "SELECT * FROM `cart` WHERE `cookieID`=?";
                if($stmt = mysqli_prepare($link, $sql)){
                    mysqli_stmt_bind_param($stmt, "s", $_COOKIE['cookieID']);
                    if(mysqli_stmt_execute($stmt)){
                        $result = mysqli_stmt_get_result($stmt);
                        if (mysqli_num_rows($result) == 1) {
                            while($fetch = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                                $name = $fetch['name'];
                                $address = $fetch['address'];
                                $email = $fetch['email'];
                                $pinLocation = $fetch['pinLocation'];
                                $deliveryDate = $fetch['deliveryDate'];
                                $contactNumber = $fetch['contactNo'];
                                $deliveryTime = $fetch['deliveryTime'];
                                $deliveryMode = $fetch['deliveryMode'];
                            }
                            }else{
                            echo "Error on select statement";
                        }
                    }

                }
                ?>
                    <div class="design-page">
                        <div class="row2">
                            <?php


                            ?>
                            <div class="column3 animate-left">
                                <div class="input-box">
                                    <label for="name">Name:</label>
                                    <input type="text" name="name" id="name" value="<?php if (isset($name)){ echo $name;}?>" required>
                                </div>
                                <div class="input-box">
                                    <label for="address">Address:</label>
                                    <input type="text" name="address" id="address" value="<?php if (isset($address)){ echo $address;}?>" required>
                                </div>
                                <div class="input-box">
                                    <label for="email">Email:</label>
                                    <input type="text" name="email" class="email" value="<?php if (isset($email)){ echo $email;}?>" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                                </div>
                                <script> <!--Email Validation Alert -->
                                    $('.email').keyup(function() {
                                        $('span.error').remove();
                                        $('span.valid').remove();
                                        var inputVal = $(this).val();
                                        var characterReg = /^\s*[\w\-\+_]+(\.[\w\-\+_]+)*\@[\w\-\+_]+\.[\w\-\+_]+(\.[\w\-\+_]+)*\s*$/;
                                        if (!characterReg.test(inputVal)) {
                                            $(this).after('<span class="error">Please enter a valid email.</span > ');
                                        }
                                    });
                                </script>
                                <div class="input-box">
                                    <label for="pin">Pin Location:</label>
                                    <input type="text" name="pin" id="pin" value="<?php if (isset($pinLocation)){ echo $pinLocation;}?>" required>
                                </div>
                                <div class="input-box">
                                    <label for="delivery" max="">Date of Delivery:</label><br>
                                    <input  name="date" autocomplete="off" type="text" id="delivery" value="<?php if (isset($deliveryDate)){ echo $deliveryDate;}?>"
                                            onclick="checkDate()" required>
                                    <script>
                                        const mouseOnlyNumberInputField = document.getElementById("delivery");
                                        mouseOnlyNumberInputField.addEventListener("keypress", (event) => {
                                            event.preventDefault();
                                        });
                                    </script>
                                    <script>
                                        var today = new Date();
                                        var lastDate = new Date(today.getFullYear(), today.getMonth(0)+1, 31);
                                        $("#delivery").datepicker({
                                            format: "yyyy-mm-dd",
                                            startDate: '-1m',
                                            endDate: lastDate
                                        });
                                    </script>

                                    <script>
                                        function checkDate(){
                                            var p =document.getElementById("delivery").value;
                                            var vool = Boolean(document.getElementById("res").value);

                                            if (vool==true){
                                                p.appendChild('<span class="error">Date is available.</span >');
                                            }
                                            p.appendChild('<span class="error">Slots for that day is full, Please choose another date.</span >');
                                        }

                                    </script>

                                </div>
                                <div class="input-box">
                                    <label for="contact">Contact Number:</label>
                                    <input type="text" class="phone-num" value="<?php if (isset($contactNumber)){ echo $contactNumber;}?>"name="contact" id="contact" required>
                                </div>

                                <script><!--Phone Validation Alert -->
                                    $('.phone-num').keyup(function() {
                                        $('span.error').remove();
                                        $('span.valid').remove();
                                        var inputVal = $(this).val();
                                        var characterReg = /(^0|[89]\d{2}-\d{3}\-?\d{4}$)|(^0|[89]\d{2}\d{3}\d{4}$)|(^63[89]\d{2}-\d{3}-\d{4}$)|(^63[89]\d{2}\d{3}\d{4}$)|(^[+]63[89]\d{2}\d{3}\d{4}$)|(^[+]63[89]\d{2}-\d{3}-\d{4}$)/;
                                        if (!characterReg.test(inputVal)) {
                                            $(this).after('<span class="error">Please enter a valid phone number.</span > ');
                                        }
                                    });
                                </script>
                                <div class="checks ">
                                    <?php if (isset($deliveryTime)) {
                                        echo "<input id='delDate' type='hidden' value='".$deliveryTime."'>";
                                    }?>


                                    <label for="time">Time of Delivery:</label><br>
                                    <input type="radio" id="time1" name="time" value="14:00:00" required/>
                                    <label for="time1">&nbsp;&nbsp;2:00 pm</label>
                                    <input type="radio" id="time2" name="time" value="15:00:00" required/>
                                    <label for="time2">&nbsp;&nbsp;3:00 pm</label>
                                    <input type="radio" id="time3" name="time" value="16:00:00" required/>
                                    <label for="time3">&nbsp;&nbsp;4:00 pm</label>
                                    <input type="radio" id="time4" name="time" value="17:00:00" required/>
                                    <label for="time4">&nbsp;&nbsp;5:00 pm</label>
                                    <input type="radio" id="time5" name="time" value="18:00:00" required/>
                                    <label for="time5">&nbsp;&nbsp;6:00 pm</label>
                                </div>
                                <script><!--Cart Value for Time-->
                                    var e = document.getElementsByName("time");
                                    var dateInput = document.getElementById("delDate").value

                                    for(i = 0; i <= e.length; i++) {

                                        if(e[i].type="radio") {
                                            if(e[i].value == dateInput) {
                                                e[i].checked = true;
                                            }
                                        }
                                    }
                                </script>

                                <div class="input-box">
                                    <?php if (isset($deliveryMode)) {
                                        echo "<input id='delMode' type='hidden' value='".$deliveryMode."'>";
                                    }?>
                                    <label for="method">Pick-Up or Own Booking:</label><br>
                                    <input type="radio" id="pickup" name="method" value="Pick-Up" required/>
                                    <label for="pickup">&nbsp;&nbsp;Pick-Up</label>
                                    <input type="radio" id="book" name="method" value="Own Booking" required/>
                                    <label for="book">&nbsp;&nbsp;Own Booking (Grab, Lalamove, etc.)</label>
                                </div>
                            </div>
                            <script><!--Cart Value for DeliveryMode-->
                                var e = document.getElementsByName("method");
                                var dateInput = document.getElementById("delMode").value

                                for(i = 0; i <= e.length; i++) {

                                    if(e[i].type="radio") {
                                        if(e[i].value == dateInput) {
                                            e[i].checked = true;
                                        }
                                    }
                                }
                            </script>

                        </div></div>
                        <div class="center inline">
                            <!-- Change href to proper next page (upload design)
                            <a class=" link-btn animate-left" href="customer-design-upload.php" ><i class="fas fa-arrow-alt-circle-left"></i> Back</a>-->
                            <!-- Change href to proper next page (paymen method)-->
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
</body>
</html>
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

if(isset($_POST['btnNext']) and isset($_COOKIE['cookieID'])) {
    //checks order table
    //if reserved delivery dates
    $sql = "SELECT * FROM `order summary` WHERE `deliveryDate` = ?";
    if ($stmt2 = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt2, "s", $_POST['date']);
        if (mysqli_stmt_execute($stmt2)) {
            $result2 = mysqli_stmt_get_result($stmt2);
            if (mysqli_num_rows($result2) < 2) {
                echo "<script type='text/javascript'> alert('Date is available');</script>";
            } else {
                echo "<script type='text/javascript'> alert('Slots for that day is full, Please choose another date.');window.location='customer-payment-details.php'</script>";
            }
        } else {
            echo $link->error;
        }
    } else {
        echo $link->error;

    }
        //Post variables
        $name = urldecode($_POST['name']);
        $address = $_POST['address'];
        $email = $_POST['email'];

        $pin = $_POST['pin'];
        $delivery = $_POST['date'];
        $time = $_POST['time'];
        $contact = $_POST['contact'];
        $method = $_POST['method'];
        //Insert to Cart into Db -> cart table (SET EXPIRATION)
        //check if cookie id not set
        $sql = "SELECT * FROM `cart` WHERE `cookieID` = ?";
        $cookieID = $_COOKIE['cookieID'];
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $cookieID);
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);
                //If cookieID does exist in db
                if (mysqli_num_rows($result) == 1) {
                    //insert the value
                    $sql = "UPDATE `cart`  SET name = ?, `address` = ?,`email`=?,`pinLocation`=?,`deliveryTime`=?, `deliveryDate`=?, `deliveryMode`=?, `contactNo`=?
                            WHERE `cookieID` = ?; ";

                    if($stmt = mysqli_prepare($link, $sql)){
                        mysqli_stmt_bind_param($stmt, "sssssssss", $name, $address, $email, $pin,$time, $delivery, $method , $contact, $cookieID);
                        if(mysqli_stmt_execute($stmt)){
                            echo "<script type='text/javascript'> alert('Successfully Edited');window.location='customer-payments.php'</script>";
                        }
                        else{
                            echo "<script type='text/javascript'>alert('Error on edit statement');</script>";
                        }
                    }
                } else {
                    echo "<script type='text/javascript'> alert('cookies is not set');window.location='customer-order.php'</script>";
                }
            }else{
                echo $link->error;
            }
        }else{
            echo $link->error;
        }
}

?>