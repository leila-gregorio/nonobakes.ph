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


setcookie('cookieID', null, 1, "/");
setcookie('cookieExpiration', null, 1, "/");
header("location:customer-index.php");

?>