<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Home | Nonobakes </title>
    <!--font and icons-->
    <link rel="icon" href="images/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Cabin&family=Herr+Von+Muellerhoff&family=Poiret+One&family=Source+Sans+Pro:wght@700&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <!--javascript-->
    <script src="js/script.js" defer></script>
    <!--scroll reveal & css-->
    <script src="https://unpkg.com/scrollreveal@3.3.2/dist/scrollreveal.min.js"></script>
    <link rel="stylesheet" href="style_manage.css">
</head>
<body>


<!-- HERO SECTION -->

<section class="hero small-size-hero" id="hero">

</section>
<!-- Session Check -->
<?php
//Session Checker
session_start();
if(!isset($_SESSION['username'])){
    header("location:admin-login.php");
}
?>
<!-- HEADER -->

<header>
    <div class="container">
        <nav class="navbar">
            <!-- TOGGLE MENU -->
            <div class="menu-toggle">
                <i class="fas fa-bars"></i>
                <i class="fas fa-times"></i>
            </div>
            <!-- LOGO -->
            <div class ="logo">
                <img src="images/logo.png" alt="" class="logoimg">
                <a href="admin-home.php" class="logo">nonobakes</a>
            </div>
            <ul class="nav-list">
                <li class="nav-item">
                    <a href="admin-home.php" class="nav-link link-font active">Home</a>
                </li>
                <li class="nav-item">
                    <a href="admin-feedback.php" class="nav-link link-font">Feedback</a>
                </li>
                <li class=" nav-item">
                    <a href="admin-product-manage.php" class="nav-link link-font">Products</a>
                </li>
                <li class="nav-item">
                    <a href="admin-order-manage.php" class="nav-link link-font">Orders</a>
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


<!-- Product Management -->
<section class="products">
    <div class="container">
        <div class="title">
            <h3 class="headline headline-dark">Welcome, Admin!</h3>
        </div>
        <br><br><br><br><div>
        <?php
        /* Database credentials.*/
        define('DB_SERVER', '127.0.0.1');
        define('DB_USERNAME', 'nonobakes');
        define('DB_PASSWORD', 'nonobakes');
        define('DB_NAME', 'nonobakes.ph');
        error_reporting(E_ALL); ini_set('display_errors', 1);
        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $sql = "SELECT COUNT(*) as pending FROM `order summary` WHERE `status`= 'PENDING' ORDER BY status";

        if ($stmt = mysqli_prepare($link, $sql)) {

            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);
                if (mysqli_num_rows($result) > 0) {
                    echo "<table class='manage-tb'>";
                    echo "<tr class='manage-tr'>";
                    echo "<th class='manage-th'>Pending Order</th>";
                    echo "<th class='manage-th'>On-Going Order</th>";
                    echo "<th class='manage-th'>Delivered Order</th>";
                    echo "<th class='manage-th'>Complete Order</th>";

                    echo "</tr>";

                    while ($row = mysqli_fetch_array($result)) {
                        //Checks if value is not null/""
                        echo "<tr class='manage-tr'>";
                        echo "<form action='' method='POST'>";
                        echo "<td class='manage-td'>" . $row['pending'] . "</td>";
                    }
                } else {
                    echo $link->error;
                    echo "Error on form load";
                }
            }
        }
        $sql = "SELECT COUNT(*) as ongoing FROM `order summary` WHERE `status`= 'ON-GOING' ORDER BY status";
        if ($stmt = mysqli_prepare($link, $sql)) {

            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {

                        echo "<td class='manage-td'>" . $row['ongoing'] . "</td>";
                    }
                }
            }
        } else {
            echo $link->error;
            echo "Error on form load";
        }
        $sql = "SELECT COUNT(*) as delivered FROM `order summary` WHERE `status`= 'DELIVERED' ORDER BY status";
        if ($stmt = mysqli_prepare($link, $sql)) {

            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {

                        echo "<td class='manage-td'>" . $row['delivered'] . "</td>";
                    }
                }
            }
        } else {
            echo $link->error;
            echo "Error on form load";
        }
        $sql = "SELECT COUNT(*) as complete FROM `order summary` WHERE `status`= 'COMPLETE' ORDER BY status";
        if ($stmt = mysqli_prepare($link, $sql)) {

            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {

                        echo "<td class='manage-td'>" . $row['complete'] . "</td>";
                    }
                }
            }
        } else {
            echo $link->error;
            echo "Error on form load";
        }

        ?></div>
</section>
</body>
</html>

