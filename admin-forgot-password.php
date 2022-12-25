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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Forget Password | Nonobakes </title>
    <!--font and icons-->
    <link rel="icon" href="images/logo.png">

    <link href="https://fonts.googleapis.com/css2?family=Cabin&family=Herr+Von+Muellerhoff&family=Poiret+One&family=Source+Sans+Pro:wght@700&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <!--scroll reveal-->
    <script src="https://unpkg.com/scrollreveal@3.3.2/dist/scrollreveal.min.js"></script>
    <!-- js, css design -->
    <script src="js/script.js" defer></script>
    <link rel="stylesheet" href="style-admin.css">
</head>

<body>
<div class ="login-header">
    <img class="image-center" src="images/logo.png" alt="">
</div>
<div class="login-box">
    <h1>Reset Password</h1>
    <form method="post" action="">
        <div class="user-box">
            <input type="text" name="email" required="">
            <label><i class="fas fa-envelope"></i> Email</label>

        </div>
            <div class="center">
                <input type="submit" name="password-reset-token" class="button" value="Submit"><br>
            </div>
    </form>

<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

if(isset($_POST['password-reset-token']) && $_POST['email'])
{
    $emailId = $_POST['email'];

    $result = mysqli_query($link,"SELECT * FROM  `admin` WHERE email='" . $emailId . "'");

    $row= mysqli_fetch_array($result);

    if($row)
    {

        $token = md5($emailId).rand(10,9999);

        $expFormat = mktime(
            date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
        );

        $expDate = date("Y-m-d H:i:s",$expFormat);

        $update = mysqli_query($link,"UPDATE admin set   token='" . $token . "' ,expiration='" . $expDate . "' WHERE email='" . $emailId . "'");

        $link = "<a href='http://localhost/Nonobakes/admin-reset-password.php?key=".$emailId."&token=".$token."'>Click To Reset password</a>";


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
        $mail->AddAddress($emailId, 'reciever_name');
        $mail->Subject  =  'Reset Password';
        $mail->IsHTML(true);
        $mail->Body    = 'Click On This Link to Reset Password '.$link.'';
        try {
            if ($mail->Send()) {
                echo "<div class='correct error'>";
                echo "<div class='close' onclick='this.parentElement.remove()'><i class='fas fa-times-circle inline'></i></div>";
                echo "<p>Check Your Email and Click on the link sent to your email.</p>";
            } else {
                echo "<div class='bar error'>";
                echo "<div class='close' onclick='this.parentElement.remove()'><i class='fas fa-times-circle inline'></i></div>";
                echo "<p>Mail Error - >" . $mail->ErrorInfo."</p>";
            }
        } catch (phpmailerException $e) {
        }
    }else{
        echo "<div class='bar error'>";
        echo "<div class='close' onclick='this.parentElement.remove()'><i class='fas fa-times-circle inline'></i></div>";
        echo "<p>Invalid Email Address.</p>";
    }
}
?>
</div>
</body>
</html>

