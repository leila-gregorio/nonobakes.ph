<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" >
        <title> Reset Password | Nonobakes </title>
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
        <a style="width:60%; float: left; margin-bottom: 0" class="center-item link animate-left" href="admin-login.php"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>

        <br><br><br><br><br>
        <div class="login-box">
            <h1>Reset Password</h1>
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

                    if(isset($_GET['key']) && isset($_GET['token'])) {
                        $email = $_GET['key'];
                        $token = $_GET['token'];
                        $query = mysqli_query($link, "SELECT * FROM `admin` WHERE `token`='".$token."' and `email`='".$email."';"
                                );
                        $curDate = date("Y-m-d H:i:s");
                        if (mysqli_num_rows($query) > 0) {
                            $row= mysqli_fetch_array($query);
                            if($row['expiration'] >= $curDate){ ?>


                    <form action="" method="post">
                        <input type="hidden" name="email" value="<?php echo $email;?>">
                        <input type="hidden" name="reset_link_token" value="<?php echo $token;?>">

                        <div class="user-box">
                            <div class ="input-toggle">
                                <input type="password" name='password' class="form-control" required id="pass">
                                <label><i class="fas fa-key"></i> Password</label>
                            </div>
                        </div>
                        <div class="user-box">

                            <div class ="input-toggle">
                                <input type="password" name="cpassword" class="form-control" required id="cpass">

                                <label><i class="fas fa-key"></i> Confirm Password</label>
                            </div>
                        </div>
                        <div class="center">
                            <input type="submit" name="new-password" class=" button">

                        </div>
                    </form>
                    <?php }
                        }
                        else{ ?>
                        <p>This forget password link has been expired</p>
                        <?php }
                      }else{?>
                        <p>Sorry, you've made an invalid request. Please
                        <a href="admin-login.php">go back</a> and try again.</p>
                    <?php
                    }
                    ?>

<?php
if(isset($_POST['password']) && $_POST['reset_link_token'] && $_POST['email'])
{
    $emailId = $_POST['email'];
    $token = $_POST['reset_link_token'];
    $password = md5($_POST['password']);

    //Password Validation (8 Characters, 1 Number, 1 Uppercase, 1 Special Character)


    $number = preg_match('@[0-9]@', $_POST['password']);
    $uppercase = preg_match('@[A-Z]@', $_POST['password']);
    $specialChars = preg_match('@[^\w]@', $_POST['password']);
    if ($_POST['password'] == $_POST['cpassword'] ) {
        if (strlen($password) < 8 || !$number || !$uppercase || !$specialChars) {
            echo "<div class='bar error'>";
            echo "<div class='close' onclick='this.parentElement.remove()'><i class='fas fa-times-circle inline'></i></div>";
            echo "Must contain 8 characters, 1 number, 1 upper case, and 1 special character.";
        } else {
            $query = mysqli_query($link, "SELECT * FROM `admin` WHERE `token`='" . $token . "' and `email`='" . $emailId . "'");
            $row = mysqli_num_rows($query);
            if ($row) {
                mysqli_query($link, "UPDATE `admin` set  password='" . $password . "', token='" . NULL . "' ,expiration='" . NULL . "' WHERE email='" . $emailId . "'");
                echo "<div class='correct error'>";
                echo "<div class='close' onclick='this.parentElement.remove()'><i class='fas fa-times-circle inline'></i></div>";
                echo '<p>Congratulations! Your password has been updated successfully.</p>';
            } else {
                echo "<div class='bar error'>";
                echo "<div class='close' onclick='this.parentElement.remove()'><i class='fas fa-times-circle inline'></i></div>";
                echo "<p>Something goes wrong. Please try again</p>";
            }
        }
    }else{
        echo "<div class='bar error'>";
        echo "<div class='close' onclick='this.parentElement.remove()'><i class='fas fa-times-circle inline'></i></div>";
        echo "<p>Password entered does not match.</p>";

    }

}
?>
        </div>
        </div>
    </body>
</html>
