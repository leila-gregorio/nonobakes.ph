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

	if(ISSET($_POST['edit'])) {
        $productID = $_POST['productID'];
        $productType= $_POST['productType'];

        $image_name = $_FILES['productImage']['name'];
        $image_temp = $_FILES['productImage']['tmp_name'];
        $productName = $_POST['productName'];
        $productCategory = $_POST['productCategory'];
        $productPrice = $_POST['productPrice'];
        $productSlots = $_POST['productSlots'];
        $productStatus = strtoupper($_POST['productStatus']);
        $previous = $_POST['previous'];
        $exp = explode(".", $image_name);
        $end = end($exp);
        $name = time() . "." . $end;
        $path = "upload/" . $name;
        $allowed_ext = array("gif", "jpg", "jpeg", "png");
        if (in_array($end, $allowed_ext)) {
            if (unlink($previous)) {
                if (move_uploaded_file($image_temp, $path)) {
                    mysqli_query($link, "UPDATE `product` set `productName` = '$productName',`productDescription` ='$productType', `productPrice` = '$productPrice', `productCategory` = '$productCategory', `productSlots` = '$productSlots' ,`productImage` = '$path',`productStatus` = '$productStatus' WHERE `productID` = '$productID'") or die(mysqli_error($link));
                    echo "<script>alert('User account updated!')</script>";
                    header("location: admin-product-manage.php");
                }
            }
        } else {
            echo "<script>alert('Image only')</script>";
        }
    }
?>