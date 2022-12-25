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

if(isset($_POST['btnNext']) and isset($_POST['token'])){
    //check order if paymentProof is not empty
        $image_name = $_FILES['productImage']['name'];
        $image_temp = $_FILES['productImage']['tmp_name'];
        $exp = explode(".", $image_name);
        $end = end($exp);
        $name = time().".".$end;
        $path = "order/upload/receipt-".$name;
        $allowed_ext = array("gif", "jpg", "jpeg", "png");
        $token =$_POST['token'];

        if(in_array($end, $allowed_ext)){
            if(move_uploaded_file($image_temp, $path)){


                $sql2 = "UPDATE `order summary` SET  `paymentProof`= ? WHERE `orderSummaryID` = ?;";
                if($stmt = mysqli_prepare($link, $sql2)){
                    mysqli_stmt_bind_param($stmt, "ss",$path,$token);
                    if(mysqli_stmt_execute($stmt)){
                        echo "<script>alert('Image Saved in Database!')
                        window.location='customer-index.php'
                        </script>";
                    }
                    else{
                        echo $link->error;
                        echo "<script type='text/javascript'>alert('Error on update statement');
                    window.location='customer-payment-proof.php'
				</script>";
                    }
                }else{
                    echo $link->error;

                }
                setcookie( "proofCookie", $path, time() + 36000 );
                setcookie( "proofPrevious", $path, time() + 36000 );
            }else{
                echo "Not uploaded";
            }
        }else{
            echo "<script>alert('Image only')</script>";
        }

}/*else{
        $token =$_POST['token'];

        $image_name = $_FILES['productImage']['name'];
        $image_temp = $_FILES['productImage']['tmp_name'];
        $exp = explode(".", $image_name);
        $end = end($exp);
        $name = time() . "." . $end;
        $path = "order/upload/receipt-" . $name;
        $allowed_ext = array("gif", "jpg", "jpeg", "png");
        if (in_array($end, $allowed_ext)) {
            if (unlink($_COOKIE['proofPrevious'])) {
                if (move_uploaded_file($image_temp, $path)) {
                    $sql2 = "UPDATE `order summary` SET  `paymentProof`= ? WHERE `orderSummaryID` = ?;";
                    if($stmt = mysqli_prepare($link, $sql2)){
                        mysqli_stmt_bind_param($stmt, "ss",$path,$token);
                        if(mysqli_stmt_execute($stmt)){
                            echo "<script>alert('Image Saved in Database!')
                                window.location='customer-index.php'
                                </script>";
                        }
                        else{
                            echo "<script type='text/javascript'>alert('Error on update statement');window.location='customer-payment-proof.php'</script>";
                        }
                    }
                    echo "<script>alert('Previous Image Deleted!')</script>";
                    setcookie( "proofCookie", $path, time() + 36000 );
                    echo $_COOKIE['proofCookie'];
                    setcookie( "proofPrevious", $path, time() + 36000 );
                }
            }
        } else {
            echo "<script>alert('Image only')</script>";
            header("location: customer-payment-proof.php");
        }
}*/


?>