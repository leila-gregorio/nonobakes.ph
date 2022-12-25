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

if(isset($_POST['btnSave'])){
    $image_name = $_FILES['productImage']['name'];
    $image_temp = $_FILES['productImage']['tmp_name'];
    $exp = explode(".", $image_name);
    $end = end($exp);
    $name = time().".".$end;
    $path = "gallery/".$name;
    $allowed_ext = array("gif", "jpg", "jpeg", "png");
    if(in_array($end, $allowed_ext)){
        echo $path;

        if(move_uploaded_file($image_temp, $path)){
            echo $path;
            mysqli_query($link, "INSERT INTO `gallery`(`galleryImage`) 
                VALUES( '$path')") or die(mysqli_error($link));
                header("location: admin-gallery-manage.php");
        }
    }else{
        echo "<script>alert('Image only')</script>";
    }
}
?>