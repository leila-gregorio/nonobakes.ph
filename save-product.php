<?php
//Session Checker
session_start();
if(!isset($_SESSION['username'])){
    header("location:admin-login.php");
}
//Db Connection
/* Database credentials.*/
define('DB_SERVER', '127.0.0.1');
define('DB_USERNAME', 'nonobakes');
define('DB_PASSWORD', 'nonobakes');
define('DB_NAME', 'nonobakes.ph');
error_reporting(E_ALL); ini_set('display_errors', 1);
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


	if(ISSET($_POST['save'])){
		$image_name = $_FILES['productImage']['name'];
		$image_temp = $_FILES['productImage']['tmp_name'];
        $productType= $_POST['productType'];
        $productName = $_POST['productName'];
        $productCategory = $_POST['productCategory'];
        $productPrice = $_POST['productPrice'];
        $productSlots = $_POST['productSlots'];
        $productStatus = strtoupper($_POST['productStatus']);
		$exp = explode(".", $image_name);
		$end = end($exp);
		$name = time().".".$end;
		$path = "upload/".$name;
		$allowed_ext = array("gif", "jpg", "jpeg", "png");
		if(in_array($end, $allowed_ext)){
			if(move_uploaded_file($image_temp, $path)){
				mysqli_query($link, "INSERT INTO `product`(`productName`,`productPrice`,`productDescription`,`productCategory`, `productSlots`,`productImage`,`productStatus`)
                VALUES('$productName', '$productPrice', '$productType','$productCategory', '$productSlots' ,'$path','$productStatus')") or die(mysqli_error($link));
				echo "<script>alert('User account saved!')</script>";
				header("location: admin-product-manage.php");
			}
		}else{
			echo "<script>alert('Image only')</script>";
		}
	}
?>