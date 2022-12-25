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

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


//update order status
if(isset($_POST['btnStatus'] ) and isset($_POST['intID']) and isset($_POST['cmbStatus']))
{
    $id = $_POST['intID'];

    $sql = "UPDATE `order summary` SET `status` = ? WHERE orderSummaryID = ?";
    if($stmt = mysqli_prepare($link, $sql)){
        $status = $_POST['cmbStatus'];
        mysqli_stmt_bind_param($stmt, "ss", $status, $id);
        if(mysqli_stmt_execute($stmt)){
            //if order status is set as COMPLETE, check order table
                checkOrderStatus($id, $link);
            echo "<script type='text/javascript'>
                    alert('Successfully Updated');
			</script>";
        }
        else{echo $link->error;
           echo "<script type='text/javascript'>alert('Error');
		    </script>";
        }
    }else{
        echo $link->error;

    }
}
//Check order table
function checkOrderStatus($id, $link){
    $sql = "SELECT * FROM `order summary` WHERE `orderSummaryID`= ? AND `status`='COMPLETE';";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "s",$id);
        if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);
                if (mysqli_num_rows($result) == 1) {
                    while ($row = mysqli_fetch_array($result)) {
                        $email = $row['email'];
                        $name = $row['customerName'];
                        sendFeedbackForm($email,$id,$name);
                    }
            }
        } else {
            echo $link->error;
            echo "<script type='text/javascript'>alert('Error on insert statement');</script>";
        }
    } else {
        echo "<script type='text/javascript'> alert('An error occured.');</script>";
    }
}
//Send Email to customer's email
function sendFeedbackForm($email, $id, $name)
{
    //Load Composer's autoloader
    require 'vendor/autoload.php';
    $feedback = "<a href='http://localhost/Nonobakes/customer-feedback.php?token=".$id."'>Click here to write a review.</a>";

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
    $mail->AddAddress($email, $name);
    $mail->Subject  =  'nonobakes.ph | Feedback';
    $mail->IsHTML(true);
    $mail->Body    = 'Thank you for choosing nonobakes.ph!<br> 
                      We would appreciate if you could send us your regarding your order.<br>'.$feedback.'';
    try {
        if ($mail->Send()) {
            echo "<script type='text/javascript'>alert('Feedback Email Sent');</script>";
        } else {
            echo "<script type='text/javascript'>alert('" . $mail->ErrorInfo."');</script>";
        }
    } catch (phpmailerException $e) {
        echo "<script type='text/javascript'>alert('Invalid Email Address');</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Order Management | Nonobakes </title>
    <!--font and icons-->
    <link rel="icon" href="images/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Cabin&family=Herr+Von+Muellerhoff&family=Poiret+One&family=Source+Sans+Pro:wght@700&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <!--javascript-->
    <script src="js/script.js" defer></script>
    <!--scroll reveal & css-->
    <script src="https://unpkg.com/scrollreveal@3.3.2/dist/scrollreveal.min.js"></script>
    <link rel="stylesheet" href="style-admin.css">
</head>
<body>
<!-- Session Check -->
    <?php
    //Session Checker
    session_start();
    if(!isset($_SESSION['username'])){
        header("location:admin-login.php");
    }
    if(isset($_SESSION['username']) OR !empty($_SESSION['username'])){
            // echo "Welcome, " . $_SESSION['username'];
        }
        else{
            header("admin-login.php");
        }
    ?>
<!-- HEADER -->
<header>
    <div class="container">
        <nav class="navbar-con">
            <!-- TOGGLE MENU -->
            <div class="menu-toggle">
                <i class="fas fa-bars"></i>
                <i class="fas fa-times"></i>
            </div>
            <!-- LOGO -->
            <div class ="logo">
                <img src="images/logo.png" alt="" class="logoimg">
                <a href="admin-home.php" class="logo">Nonobakes</a>
            </div>
            <ul class="nav-list">
                <li class="nav-item">
                    <a href="admin-home.php" class="nav-link link-font">Home</a>
                </li>
                <li class="nav-item">
                    <a href="admin-feedback.php" class="nav-link link-font">Feedback</a>
                </li>
                <li class=" nav-item">
                    <a href="admin-product-manage.php" class="nav-link link-font">Products</a>
                </li>
                <li class="nav-item">
                    <a href="admin-order-manage.php" class="nav-link link-font active">Orders</a>
                </li>
                <li class="nav-item">
                    <a href="admin-form-manage.php" class="nav-link link-font">Form</a>
                </li>
                <li class=" nav-item">
                    <a href="admin-gallery-manage.php" class="nav-link link-font">Gallery</a>
                </li>
                <!-- EDIT for backend -->
                <li class="nav-item">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <a href="admin-logout.php"><i class="fas fa-sign-out-alt nav-link" ></i></a>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</header>


<!-- HERO SECTION -->

<section class="hero small-size-hero" id="hero">
</section>

<!-- ORDERS -->
<section class="orders">
    <div class="container">
        <div class="title center">
            <h3 class="headline headline-dark">Orders</h3>
        </div>
        <form action="" method = "GET">

        <div class="order-manage animate-left">
            <div class="box">
                    <input type="text" class="input" name="txtsearch"
                           onmouseout="document.search.txt.value = ''">
                <i class="inline fas fa-search search-icon1"></i>
                <button type='submit' name='btnSearch' class='inline btn btn-primary btn-search'>
                    <i class='fas fas fa-search search-icon2' ></i> </button>
            </div>
        </form>
        </div>

            <?php
                function build_table($result)
                {
                    if (mysqli_num_rows($result) > 0) {
                        echo "<div class='order-cont animate-left center'>";

                        echo "<table class='manage-tb order-tb'>";
                        ?>
                        <tr>
                            <form>
                                <td><input style="width: 40%" class="status-select" type="month" name="filterMonth">
                                <input style="width: 20%"class="status-select" type="number" name="filterDay" min="0" max="31">
                                <button  class="btn-save" type="submit" name="btnFilter"><i class="fas fa-filter"></i></button></td>
                            </form>
                        </tr>
                        <?php
                        echo "<tr class='manage-tr order-tr'>";
                        echo "<th class='manage-th'>Name</th>";
                        echo "<th class='manage-th'>Contact No</th>";
                        echo "<th class='manage-th'>Delivery Date</th>";
                        echo "<th class='manage-th'>Delivery Time</th>";
                        echo "<th class='manage-th'>Total Price</th>";
                        echo "<th class='manage-th'>Order Status</th>";
                        echo "</tr>";
                        //table data (loop each row of the result)
                        while ($row = mysqli_fetch_array($result)) {
                            $time = new DateTime($row['deliveryTime']);
                            $time = date_format($time, 'g:i A');

                            $date = new DateTime($row['deliveryDate']);
                            $date = date_format($date, 'jS F Y | D');


                            echo "<tr class='manage-tr order-tr'>";
                            echo "<form action='' method='POST'>";
                            echo "<tr class='manage-td order-td'>";
                            echo "<td class='manage-td order-td'> " . $row['customerName'] . "</td>";
                            echo "<td class='manage-td order-td'>" . $row['contactNumber'] . "</td>";
                            echo "<td class='manage-td order-td'>" . $date . "</td>";
                            echo "<td class='manage-td order-td'>" . $time. "</td>";
                            echo "<td class='manage-td order-td'>" . $row['totalPrice'] . "</td>";

                            echo "<td class='manage-td order-td'>";
                            echo"<input type='text' class='hidden' name='intID' value='".$row['orderSummaryID']."'> </input>";
                            echo"<select id='cmbStatus' name='cmbStatus'class='inline status-select'><option class='status-sample' hidden disabled selected>".$row['status']."</option>
                                        <option class='status-option'value='PENDING'>PENDING</option>
                                        <option class='status-option' value='ON-GOING'>ON-GOING</option>
                                        <option class='status-option' value='DELIVERED'>DELIVERED</option>
                                        <option class='status-option' value='COMPLETE'>COMPLETE</option>
                                    </select>";
                            echo "<button type='submit' name='btnStatus' class='inline btn btn-primary btn-check'><i class='fas fa-check check-icon' ></i> </button>";
                            echo "</td>";
                            echo "<td class='manage-td'>";
                            echo "<a class='details' href='admin-receipt.php?orderID=" . urlencode($row['orderSummaryID']) . "'><i class='fas fa-ellipsis-h others-icon'></i></a>";
                            echo "</td>";
                            echo "</form>";
                            echo "</tr>";
                        }
                    }
                }
                ?>
    </table><br><br>
</section>
</body>
</html>

<?php
if(isset($_GET['btnFilter'])){
    $sql = "SELECT * FROM `order summary` WHERE deliveryDate LIKE ? ORDER BY deliveryDate";

    if($stmt = mysqli_prepare($link, $sql)){
        $search = '%' . $_GET['filterMonth'] . '-'.$_GET['filterDay'] .'%';
        mysqli_stmt_bind_param($stmt, "s",  $search);
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            build_table($result);

        }
        else{
            echo "<script type='text/javascript'>alert('Error on search button');
				</script>";
        }
    }
}
elseif(isset($_GET['btnSearch'])){
    $sql = "SELECT * FROM `order summary` WHERE orderSummaryID LIKE ? OR customerName LIKE ?  OR contactNumber LIKE ?   OR status LIKE ?  ORDER BY deliveryDate";

    if($stmt = mysqli_prepare($link, $sql)){
        $search = '%' . $_GET['txtsearch'] . '%';
        mysqli_stmt_bind_param($stmt, "sssss",  $month,$search,$search, $search,  $search);
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            build_table($result);

        }
        else{
            echo "<script type='text/javascript'>alert('Error on search button');
				</script>";
        }
    }
}
else {
    $sql = "SELECT * FROM `order summary`";
    if ($stmt = mysqli_prepare($link, $sql)) {
        //mysqli_stmt_bind_param($stmt);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            build_table($result);

        } else {
            echo "<script type='text/javascript'>alert('Error on form load');
    </script>";
        }
    }
}
?>