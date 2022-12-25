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
    if (isset($_POST['btnAccept'])) {
        //Create Cookie Unique ID for user
        $cookieID =  time() . uniqid(mt_rand(), true);
        //Set Expiration Date of Cookie - 30 days
        $timestamp = time()+60*60*24*30;
        $date = new DateTime();
        $date->setTimestamp($timestamp);
        $cookieExpiration = $date->format('Y-m-d H:i:s');

        setcookie('cookieID', $cookieID, $timestamp, "/");
        setcookie('cookieExpiration', $cookieExpiration, $timestamp, "/");
        header("location:customer-order.php");
    }else {
        //echo $_COOKIE['cookieID'];
       // echo "<br>" . $_COOKIE['cookieExpiration'];

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form | Nonobakes</title>
    <script src="js/app.js" defer></script>
    <link rel="icon" href="images/logo.png">
    <link
        href="https://fonts.googleapis.com/css2?family=Cabin&family=Herr+Von+Muellerhoff&family=Poiret+One&family=Source+Sans+Pro:wght@700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="js/store.js" async ></script>
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>

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
<!-- HERO SECTION -->
<section class="hero small-size-hero" id="hero">
</section>
<section class="orders">
    <!-- Check if Cookies are set-->
    <?php
        if (isset($_COOKIE['cookieID']) and (isset($_COOKIE['cookieExpiration']))) {
            echo "<script>
                $(window).on('load',function(){
                    $('#theModal1').modal('hide');
                });
            </script>";

        } else{
            echo "<script>
                $(window).on('load',function(){
                    $('#theModal1').modal('show');
                });
            </script>";

       }?>
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
                                <p>Cookie Consent</p>
                                <br><hr class="center hr-style "><br>
                            </div>
                            <p>This website use cookies to ensure you get the best experience on our website.</p>
                            <div class="buttons">
                                <button name="btnAccept" class="btn-accept">I understand</button>
                                <a href="https://www.learn-about-cookies.com/" class="black btn-secondary-black">Learn more</a>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
    </form>


<?php
//---------Load Cart Values-------------

    $sql = "SELECT * FROM `cart` WHERE `cookieID`=?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $_COOKIE['cookieID']);
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($res) == 1) {
                while ($fetch = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                    if (isset($fetch['cakeSize'])) {
                        echo "<input id='cSize' type='hidden' value='" . $fetch['cakeSize'] . "'>";
                    }
                    if (isset($fetch['cakeFlavor'])) {
                        echo "<input id='cFlavor' type='hidden' value='" . $fetch['cakeFlavor'] . "'>";
                    }
                    if (isset($fetch['cakeFilling'])) {
                        echo "<input id='cFilling' type='hidden' value='" . $fetch['cakeFilling'] . "'>";
                    }
                    if (isset($fetch['textStyle'])) {
                        echo "<input id='cFontStyle' type='hidden' value='" . $fetch['textStyle'] . "'>";
                    }
                    $baseColor = $fetch['baseColor'];
                    $textColor = $fetch['textColor'];
                    $dedication = $fetch['dedication'];


                }
            }
        }
    }



?>
        <div class="global-headline">
            <h3 class="headline headline-dark">ORDER</h3><br><br><br>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"   method="POST">
            <div class="radio-cont animate-left">
               <?php
               echo "<div class='''><br>";
               $total = 0;
               //              cake size radio              //
               $sql = "SELECT * FROM `product` WHERE `productDescription`= 'BENTO CAKE' and `productStatus` ='ACTIVE' ORDER BY productID";
               if ($stmt = mysqli_prepare($link, $sql)) {
                   if (mysqli_stmt_execute($stmt)) {
                       $result = mysqli_stmt_get_result($stmt);
                       if (mysqli_num_rows($result) > 0) {


                           echo "<div class='form-radio'>";

                           echo "<label class='description-title'>Cake Size</label>";
                           while ($row = mysqli_fetch_array($result)) {
                               if(isset($_GET['name']) and $_GET['name']==$row['productName'] ){
                                   $checked='checked';
                               }else{
                                   $checked='';
                               }
                               //Checks if value is not null/""
                               if (!$row['productName'] == "") {
                                   /*  ?>
                                 /*  <div class="shop-item ">
                                       <span class="shop-item-title radio-label"><?php echo $row['productName'] ?></span>
                                       <div class="center-item shop-item-details">
                                           <span class=" shop-item-quantity">1</span>
                                           <span class="shop-item-price"><?php echo "₱".$row['productPrice'] ?></span>
                                           <input  name='size' id="<?php echo $row['productID'] ?>" class="btn btn-primary shop-item-button" type="radio"><i class='fas fa-shopping-cart'></i>ADD TO CART</input>
                                       </div></div> */
                                   echo "<br><input id='size".$row['productID']."' type='radio' class='shop-item-button form-check-input size' name='size' value='".ucwords($row['productName']).",".$row['productPrice']."' onclick='displayRadioValue()' ".$checked.">";
                                   echo "<label class='radio-label' for='size".$row['productID']."'>". ucwords($row['productName'])."</label>";
                               }
                               echo "<script>window.addEventListener('load', (event) => {
                                    displayRadioValue()})
                                    </script>";
                           }
                           echo "</div>";
                       }                   }
               } else {
                   echo "Error on load";
               }?>
                <script><!--Cart Value for cakeSize-->
                    var e = document.getElementsByName("size");
                    var input = document.getElementById("cSize").value
                    for(i = 0; i <= e.length; i++) {
                        if(e[i].type="radio") {
                            if(e[i].value == input) {
                                e[i].checked = true;
                            }
                        }
                    }
                </script>
                <?php
                //              cake flavor radio              //
                $sql = "SELECT formID,cakeFlavor FROM form ORDER BY formID";
                if ($stmt = mysqli_prepare($link, $sql)) {
                    if (mysqli_stmt_execute($stmt)) {
                        $result = mysqli_stmt_get_result($stmt);
                        //radio_cakeFlavor($result);
                         if (mysqli_num_rows($result) > 0) {
                        echo "<div class='form-radio'>";
                        echo "<label class='description-title' style='margin-bottom: -30%;'>Cake Flavor</label>";

                        while ($row = mysqli_fetch_array($result)) {
                            //Checks if value is not null/""
                            if (!$row['cakeFlavor'] == "") {
                                if (isset($_COOKIE['flavor']) and $_COOKIE['flavor'] ==$row['cakeFlavor']) {
                                    echo "<br><input id='flavor".$row['formID']."' type='radio' class='form-check-input' name='flavor' value='".htmlspecialchars($row['cakeFlavor'])."' required ='required' checked>";
                                }else
                                    echo "<br><input id='flavor".$row['formID']."' type='radio' class='form-check-input' name='flavor' value='".htmlspecialchars($row['cakeFlavor'])."' required ='required'>";
                                }
                                echo "<label class='radio-label' for='flavor".$row['formID']."'>". $row['cakeFlavor']."</label>";
                            }
                        }
                        echo "</div>";
                    }
                } else {
                    echo "Error on load";
                }
                ?>
                <script><!--Cart Value for cakeFlavor-->
                    var e = document.getElementsByName("flavor");
                    var input = document.getElementById("cFlavor").value
                    for(i = 0; i <= e.length; i++) {
                        if(e[i].type="radio") {
                            if(e[i].value == input) {
                                e[i].checked = true;
                            }
                        }
                    }
                </script>
                <?php
               // LOAD DYNAMIC CAKE FILLING
               $sql = "SELECT formID,cakeFilling FROM form ORDER BY formID";
               if ($stmt = mysqli_prepare($link, $sql)) {
                   if (mysqli_stmt_execute($stmt)) {
                       $result = mysqli_stmt_get_result($stmt);
                       if (mysqli_num_rows($result) > 0) {
                           echo "<div class='form-radio'>";
                           echo "<label class='description-title'>Cake Filling</label>";

                           while ($row = mysqli_fetch_array($result)) {
                               //Checks if value is not null/""
                               if (!$row['cakeFilling'] == "") {
                                   if (isset($_COOKIE['filling']) and $_COOKIE['filling'] == $row['cakeFilling']) {
                                       echo "<br><input id='filling" . $row['formID'] . "' type='radio' class='form-check-input' name='filling' value='" . htmlspecialchars($row['cakeFilling']) . "'required ='required' checked>";
                                   } else {
                                       echo "<br><input id='filling" . $row['formID'] . "' type='radio' class='form-check-input' name='filling' value='" . htmlspecialchars($row['cakeFilling']) . "'required ='required'>";
                                   }
                                   echo "<label class='radio-label' for='filling" . $row['formID'] . "'>" . $row['cakeFilling'] . "</label>";
                               }
                           }
                           echo "</div>";
                       }
                   }
               } else {
                   echo "Error on load";
               }
               ?>
                <script><!--Cart Value for cakeFilling-->
                    var e = document.getElementsByName("filling");
                    var input = document.getElementById("cFilling").value
                    for(i = 0; i <= e.length; i++) {
                        if(e[i].type="radio") {
                            if(e[i].value == input) {
                                e[i].checked = true;
                            }
                        }
                    }
                </script>
                <div class="input-box">
                    <label for="baseColor" class="radio-label">Base Color</label>
                    <input type="text" name="baseColor" id="baseColor" value="<?php if(isset($baseColor)){echo $baseColor;}?>" required ="required">
                </div>
                <div class="input-box">
                    <label for="textColor" class="radio-label">Text Color</label>
                    <input type="text" name="textColor" id="textColor"  value="<?php if(isset($textColor)){echo $textColor;}?>" required ="required">
                </div>
                <div class="text-box">
                    <label for="dedication" class="radio-label">Short Dedication</label>
                    <textarea id="dedication" name="dedication" rows="2" cols="50" required="required"><?php if(isset($dedication)){ echo $dedication;}?></textarea>
                </div>
                <?php
               echo "</div><div class=''><br>";
                // LOAD DYNAMIC CAKE FONT STYLE
               $sql = "SELECT formID,fontStyle FROM form ORDER BY formID";
               if ($stmt = mysqli_prepare($link, $sql)) {
                   if (mysqli_stmt_execute($stmt)) {
                       $result = mysqli_stmt_get_result($stmt);
                       if (mysqli_num_rows($result) > 0) {
                           echo "<div class='form-radio'>";

                           echo "<label class='description-title'>Font Style</label>";

                           while ($row = mysqli_fetch_array($result)) {
                               //Checks if value is not null/""
                               if (!$row['fontStyle'] == "") {
                                   if (isset($_COOKIE['fontStyle']) and $_COOKIE['fontStyle'] ==$row['fontStyle']) {
                                       echo "<br><input id='font".$row['formID']."' type='radio' class='btn-danger form-check-input' name='fontStyle' value='".htmlspecialchars($row['fontStyle'])."' required ='required' checked>";

                                   }else{
                                       echo "<br><input id='font".$row['formID']."' type='radio' class='form-check-input' name='fontStyle' value='".htmlspecialchars($row['fontStyle'])."' required ='required'>";

                                   }
                                   echo "<label class='radio-label' for='font".$row['formID']."'>". $row['fontStyle']."</label>";
                               }
                           }
                           echo "</div><br><br>";


                       }                   }
               } else {
                   echo "Error on load";
               }
  ?>
                <script><!--Cart Value for fontStyle-->
                    var e = document.getElementsByName("fontStyle");
                    var input = document.getElementById("cFontStyle").value

                    for(i = 0; i <= e.length; i++) {

                        if(e[i].type="radio") {
                            if(e[i].value == input) {
                                e[i].checked = true;
                            }
                        }
                    }
                </script>


                <?php // LOAD DYNAMIC ADD ONS
               $sql = "SELECT addID,name,price, maxQuantity FROM `add ons` ORDER BY addID";
               if ($stmt = mysqli_prepare($link, $sql)) {
                   if (mysqli_stmt_execute($stmt)) {
                       $result = mysqli_stmt_get_result($stmt);
                       if (mysqli_num_rows($result) > 0) {
                           echo "<label class='description-title'>Add Ons</label>";
                           echo "<br>";

                           while ($row = mysqli_fetch_array($result)) {
                               //Checks if value is not null/""
                               if (!$row['name'] == "") {
                                   $name = $row['name'];
                                   $id = $row['addID'];

                                   $price =  $row['price'];
                                   $quantity = $row['maxQuantity'];
                                   ?>
                                   <div class="shop-item ">
                                       <span class="shop-item-title"><?php echo ucwords($name) ?></span>
                                       <div class="center-item shop-item-details">
                                           <span class="shop-item-quantity"><?php echo $quantity ?></span>

                                           <span class="shop-item-price"><?php echo "₱".$price ?></span>
                                           <button class="btn btn-primary shop-item-button" type="button"><i class='fas fa-shopping-cart'></i>ADD TO CART</button>
                                       </div>
                                   </div>
                                   <?php
                               }
                           }

                           echo "</table>";

                       }                   }
               } else {
                   echo "Error on load";
               }


                ?>
            </div>

            <div class="container content-section">
                <h2 class="section-header description-title">Cart</h2><hr class="hr-style" style="width:90%; margin: 10px;">
                <div class="cart-row">
                    <span class="cart-item cart-header cart-column">ADD ONS</span>
                    <span class="cart-price cart-header cart-column">PRICE</span>
                    <span class="cart-quantity cart-header cart-column">QUANTITY</span>
                </div>
                <div class="cart-items">

                <?php
                $sql = "SELECT * FROM `cart` WHERE `cookieID`=?";
                if ($stmt = mysqli_prepare($link, $sql)) {
                    mysqli_stmt_bind_param($stmt, "s", $_COOKIE['cookieID']);
                    if (mysqli_stmt_execute($stmt)) {
                        $res = mysqli_stmt_get_result($stmt);
                        if (mysqli_num_rows($res) == 1) {
                            while ($fetch = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                                $price = json_decode($fetch['cartPrice']);
                                $items = json_decode($fetch['cartItems']);
                                $quantity = json_decode($fetch['cartQuantity']);
                                $total = $fetch['totalPrice'];
                                $count = 1;
                                $quantityArr = [];
                                $quantityArr[0] = 1;

                            }
                        }

                    if(isset($quantity) and is_array($quantity)) {
                        foreach ($quantity as $q) {
                            $quantityArr[$count] = $q;
                            $count = $count + 1;
                        }
                    }
                    $count = 0;
                    if(isset($items)) {
                        foreach ($items as $s) {?>
                            <div class="cart-row">
                                <div class="cart-item cart-column">
                                    <input type="hidden" name="cartItem[]" id="cartItem" value="<?php if(isset($items[$count])) { echo $items[$count];}?>">
                                    <span class="cart-item-title"  id="item-title"><?php  if(isset($items[$count])) { echo $items[$count];}?></span>
                                </div>
                                <input type="hidden" name="cartPrice[]" id="cartPrice"  value="<?php echo $price[$count];?>" >
                                <span class="cart-price cart-column" id="result"><?php echo $price[$count];?></span>
                                <div class="cart-quantity cart-column counter">
                                    <input class="cart-quantity-input" name="cartQuantity[]" id="disable" type="number" value="<?php echo $quantityArr[$count] ?>" onclick="disable()">
                                    <button class="btn btn-danger" type="button">REMOVE</button>
                                </div></div><?php
                            $count = $count + 1;
                        }
                     } else{?>
                        <div class="cart-row">
                            <div class="cart-item cart-column">
                            <input type="hidden" name="cartItem[]" id="cartItem" value="<?php if(isset($_GET['name'])){echo htmlspecialchars($_GET['name']);}?>" >
                            <span class="cart-item-title"  id="item-title"><?php if(isset($_GET['name'])) {echo htmlspecialchars($_GET['name']);}?></span>
                        </div>

                        <input type="hidden" name="cartPrice[]" id="cartPrice"  value="<?php if(isset($_GET['price'])){echo $_GET['price'];}?>" >
                        <span class="cart-price cart-column" id="result">₱<?php if(isset($_GET['price'])){echo $_GET['price'];}?></span>
                        <div class="cart-quantity cart-column counter">
                            <input class="cart-quantity-input" name="cartQuantity[]" id="disable" type="number" value="1" disabled >
                        </div></div>

                    <?php
                    }
                        ?>
                        </div>
                    </div>
                    <br><br>
                    <h2 class="section-header description-title">Total</h2><hr class="hr-style" style="width:40%;">

                    <div class="cart-total center">
                        <strong class="cart-total-title description-title"></strong>
                        <input id="cartTotal" type="hidden" name="cartTotal"   value=''>

                        <span class="cart-total-price description-title"><?php if(isset($total)){
                            echo "₱".$total;}else{
                            echo "₱0";
                            }
                            }
                        }
                        ?></span>
                        <?
                        ?>
                </div>
            </div></div></div>
            <div class="center inline">
                <!-- Change href to proper next page (home)-->
                <a class="link-btn animate-left" href="customer-index.php"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
                <!-- Change href to proper next page (upload design image)-->
                <button name="btnNextPage" type="submit" class="link-btn animate-right no-bg" >Next <i class="fas fa-arrow-alt-circle-right"></i></button>
            </div>
               <!-- <button class=" btn-purchase" type="button">Order</button>-->
        </form>
            </section>

        </form>
            <br>
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
<?php
    if(isset($_POST['btnNextPage'])) {
        // unset($_COOKIE['cookieID']);
        //unset($_COOKIE['cookieExpiration']);
        //Post variables
        $size = urldecode($_POST['size']);
        $flavor = $_POST['flavor'];
        $filling = $_POST['filling'];
        $fontStyle = $_POST['fontStyle'];
        $dedication = $_POST['dedication'];
        $baseColor = $_POST['baseColor'];
        $textColor = $_POST['textColor'];
        $cartQuantity = json_encode($_POST['cartQuantity']);
        $cartPrice = json_encode($_POST['cartPrice']);
        $cartItem = json_encode($_POST['cartItem']);
        $cartTotal = floatval($_POST['cartTotal']);

        //Insert to Cart into Db -> cart table (SET EXPIRATION)
        //check if cookie id not set
        $sql = "SELECT * FROM `cart` WHERE `cookieID` = ?";
        $cookieID = $_COOKIE['cookieID'];
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $cookieID);
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);
                //If cookieID does not exist in db and cookies is not set
                if (mysqli_num_rows($result) < 1 ) {
                    //insert the value
                    $sql = "INSERT INTO `cart` (`cakeSize`, `cakeFlavor`,`textStyle` ,`cakeFilling`, `baseColor`, `textColor`, `dedication`, `totalPrice`,  `cookieExpiration`, `cookieID`, `cartPrice`, `cartItems`, `cartQuantity`) 
                                    VALUES (?, ?, ?, ?,?, ?, ?, ?, ?, ?, ?, ?, ?);";
                    if ($stmt = mysqli_prepare($link, $sql)) {
                        mysqli_stmt_bind_param($stmt, "sssssssssssss", $size, $flavor,$fontStyle, $filling, $baseColor, $textColor, $dedication, $cartTotal, $_COOKIE['cookieExpiration'], $cookieID, $cartPrice, $cartItem, $cartQuantity);
                        if (mysqli_stmt_execute($stmt)) {
                            echo "<script type='text/javascript'> alert('Successfully Added');window.location='customer-design-upload.php'</script>";
                        } else {
                            echo "<script type='text/javascript'>alert('Error on insert statement');</script>";
                        }
                    } else {
                        echo "<script type='text/javascript'> alert('An error occured.');</script>";
                    }
                } else {
                    $sql = "UPDATE `cart`  SET cakeSize = ?, `cakeFlavor` = ?,`textStyle`=?,`cakeFilling`=?, `baseColor`=?, `textColor`=?, `dedication`=?,`totalPrice`=?  , `cartPrice`=?, `cartItems`=?, `cartQuantity`=?
                            WHERE `cookieID` = ?; ";

                    if($stmt = mysqli_prepare($link, $sql)){
                        mysqli_stmt_bind_param($stmt, "ssssssssssss", $size, $flavor,$fontStyle ,$filling, $baseColor, $textColor, $dedication, $cartTotal,$cartPrice, $cartItem, $cartQuantity,$cookieID);
                        if(mysqli_stmt_execute($stmt)){
                            echo "<script type='text/javascript'> alert('Successfully Edited');window.location='customer-design-upload.php'</script>";
                        }
                        else{
                            echo "<script type='text/javascript'>alert('Error on edit statement');</script>";
                        }
                    }
                }
            }
        }
    }
?>