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
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <title> Feedback | Nonobakes </title>
    <!--font and icons-->
    <link rel="icon" href="images/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Cabin&family=Herr+Von+Muellerhoff&family=Poiret+One&family=Source+Sans+Pro:wght@700&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <!--scroll reveal-->
    <script src="https://unpkg.com/scrollreveal@3.3.2/dist/scrollreveal.min.js"></script>
    <!-- js, css design -->
    <script src="js/script.js" defer></script>
    <link rel="stylesheet" href="style-customer.css">

    <link rel="stylesheet" href="style-admin.css">

</head>
<body>
    <div class ="login-header">
        <img class="image-center" src="images/logo.png" alt="">
    </div>
    <div class="login-box">
        <h1>Feed back</h1>
        <?php
        if(isset($_GET['token'])){
            $orderSummaryID = $_GET['token'];
            //Order ID Validation
            $sql = "SELECT `customerName`  FROM `order summary` WHERE orderSummaryID =?";
            if ($stmt = mysqli_prepare($link, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $orderSummaryID,);
                if (mysqli_stmt_execute($stmt)) {
                    $result = mysqli_stmt_get_result($stmt);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_array($result)) {

                ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <?php echo "<p class='center'>Welcome, ".$row['customerName']."!"."</p><br>";
                ?>
                <input name="id" type="hidden" value="<?php echo $_GET['token']?>">
                <div class="textarea_style center">
                    <textarea class="textarea"  name="feedback" id="textarea"  minlength="4" placeholder="Write your feeback here" required></textarea>
                </div><br>
                <div class="center">
                    <input type="submit" name = "btnSubmit" class="button" value="Submit"><br>
                </div>
            </form>
                        <?php }
                } else {
                    echo "Sorry, your order number cannot be found";
                }
            }
        }
    }else{
        echo "Sorry, your order number cannot be found";
    }

    //Insert Data into Feedback Table
    if(isset($_POST['id']) and isset($_POST['btnSubmit'])) {
        $orderSummaryID = $_POST['id'];
        $feedback = $_POST['feedback'];
        $sql = "INSERT INTO `feedback`(`orderSummaryID`, `feedback`) VALUES (?,?);";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "ss", $orderSummaryID, $feedback);
            if (mysqli_stmt_execute($stmt)) {
                echo "<script type='text/javascript'>
                            alert('Feedback Successfully Sent');
                        </script>";
            } else {
                "<script type='text/javascript'>
            alert('Error on insert statement');
            window.location='admin-form-manage.php'
        </script>";
            }
        }
    }

?>
    </div>
</body>
</html>
