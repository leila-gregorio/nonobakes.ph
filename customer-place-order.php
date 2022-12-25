
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
}//Cookie Checker
if(!isset($_COOKIE['cookieID'])){
    header("location:customer-order.php");
}
if(isset($_POST['btnNext']) and !isset($_COOKIE['pathCookie'])){


    $description =  $_POST['textarea_description'];
    $image_name = $_FILES['productImage']['name'];
    $image_temp = $_FILES['productImage']['tmp_name'];
    $exp = explode(".", $image_name);
    $end = end($exp);
    $name = time().".".$end;
    $path = "upload/".$name;
    $allowed_ext = array("gif", "jpg", "jpeg", "png");

    if(in_array($end, $allowed_ext)){
        if(move_uploaded_file($image_temp, $path)){
            $sql = "UPDATE `cart`  SET `designDescription`=?, `designPicture`= ? WHERE `cookieID` = ?;";
            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "sss",$description,$path,$_COOKIE['cookieID']);
                if(mysqli_stmt_execute($stmt)){
                    echo "<script>alert('Image Saved!')</script>";
                }
                else{
                    echo "<script type='text/javascript'>alert('Error on update statement');
                    window.location='admin-form-manage.php'
				</script>";
                }
            }
            setcookie( "pathCookie", $path, time() + 36000 );
            echo $_COOKIE['pathCookie'];
            setcookie( "previous", $path, time() + 36000 );
            header("location: customer-payment-details.php");
        }
    }else{
        echo "<script>alert('Image only')</script>";
        header("location: customer-design-upload.php");

    }
}else{
        $description =  $_POST['textarea_description'];

    $image_name = $_FILES['productImage']['name'];
    $image_temp = $_FILES['productImage']['tmp_name'];
    $exp = explode(".", $image_name);
    $end = end($exp);
    $name = time() . "." . $end;
    $path = "upload/" . $name;
    $allowed_ext = array("gif", "jpg", "jpeg", "png");
        if (in_array($end, $allowed_ext)) {
            if (unlink($_COOKIE['previous'])) {
                if (move_uploaded_file($image_temp, $path)) {

                    $sql = "UPDATE `cart`  SET `designDescription`=?, `designPicture`= ? WHERE `cookieID` = ?;";
                    if($stmt = mysqli_prepare($link, $sql)){
                        mysqli_stmt_bind_param($stmt, "sss",$description,$path,$_COOKIE['cookieID']);
                        if(mysqli_stmt_execute($stmt)){
                            echo "<script>alert('Image Saved!')</script>";
                        }
                        else{
                            echo "<script type='text/javascript'>alert('Error on update statement');window.location='admin-form-manage.php'</script>";
                        }
                    }
                    echo "<script>alert('Previous Image Deleted!')</script>";
                    setcookie( "pathCookie", $path, time() + 36000 );
                    echo $_COOKIE['pathCookie'];
                    setcookie( "previous", $path, time() + 36000 );
                    header("location: customer-payment-details.php");


                }
            }
        } else {
            echo "<script>alert('Image only')</script>";
            header("location: customer-design-upload.php");
        }
    }
?>