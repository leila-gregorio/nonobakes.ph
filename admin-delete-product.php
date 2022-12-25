<?php

//Session Checker
session_start();
if (!isset($_SESSION['username'])) {
    header("location:admin-login.php");
}

//Db Connection
define('DB_SERVER', '127.0.0.1');
define('DB_USERNAME', 'nonobakes');
define('DB_PASSWORD', 'nonobakes');
define('DB_NAME', 'nonobakes.ph');
error_reporting(E_ALL);
ini_set('display_errors', 1);
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
//Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if (isset($_POST['delete']) and isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "SELECT productImage FROM product WHERE productID = ?; ";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $id);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) == 1) {
                while ($row = mysqli_fetch_array($result)) {
                    unlink($row['productImage']);
                    $sql = "DELETE FROM product WHERE productID = ?; ";
                    if ($stmt = mysqli_prepare($link, $sql)) {
                        mysqli_stmt_bind_param($stmt, "s", $id);
                        if (mysqli_stmt_execute($stmt)) {
                            echo "<script>alert('Product deleted!')</script>";
                            header("location: admin-product-manage.php");
                        } else {
                            echo $link->error;
                        }
                    }else{
                        echo $link->error;
                    }
                }
            }else{
                echo $link->error;
            }
        }else{
            echo $link->error;
        }
    }
}
?>
