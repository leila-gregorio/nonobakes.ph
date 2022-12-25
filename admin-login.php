
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Admin Login | Nonobakes </title>
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
    <h1>Welcome Admin</h1>
    <form class ="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="user-box">
            <input type="text" name="txtusername" required="">
            <label><i class="fas fa-user"></i> Username</label>
        </div>
        <div class="user-box">
            <div class ="input-toggle">
                <input type="password" name="txtpassword" required id="pass">
                <label><i class="fas fa-key"></i> Password</label>
                <i id="pass-status" class="fa fa-eye" aria-hidden="true" onClick="Toggle()"></i>
            </div>
        </div>
        <div class="center">
            <input type="submit" name = "btnSubmit" class="button" value="Submit"><br>
        </div>
        <br>
        <a class ='forgot-link center' href="admin-forgot-password.php">Forgot Password?</a>

    </form>

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
if(isset($_POST['btnSubmit'])){
    $sql = "SELECT * FROM admin WHERE username = ? and password = ? and status = 1";
    if($stmt = mysqli_prepare($link, $sql)){
        $encrypt = md5($_POST['txtpassword']);
        mysqli_stmt_bind_param($stmt, "ss", $_POST['txtusername'], $encrypt);
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                if ($encrypt == $row['password']){
                    session_start();
                    $_SESSION['username'] = $_POST['txtusername'];
                    //Link to Admin Home Page
                    header("Location: admin-home.php");
                }

            }
            else{
                echo "<div class='bar error'>";
                echo "<div class='close' onclick='this.parentElement.remove()'><i class='fas fa-times-circle inline'></i></div>";
                echo "Invalid username or password.";
            }
        }
    }
    else{
        echo "<script type='text/javascript'>alert('Error on select statement')</script>";

    }
}
?>
</div>
</body>
</html>
