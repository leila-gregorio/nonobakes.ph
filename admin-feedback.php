<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Feedbacks | Nonobakes </title>
    <!--font and icons-->
    <link href="https://fonts.googleapis.com/css2?family=Cabin&family=Herr+Von+Muellerhoff&family=Poiret+One&family=Source+Sans+Pro:wght@700&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <!--javascript-->
    <link rel="icon" href="images/logo.png">
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
                    <a href="admin-home.php" class="nav-link link-font">Home</a>
                </li>
                <li class="nav-item">
                    <a href="admin-feedback.php" class="nav-link link-font active">Feedback</a>
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
            <h3 class="headline headline-dark">Feedback/s</h3>
        </div>
        <!-- Search -->
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
    /* Database credentials.*/
    define('DB_SERVER', '127.0.0.1');
    define('DB_USERNAME', 'nonobakes');
    define('DB_PASSWORD', 'nonobakes');
    define('DB_NAME', 'nonobakes.ph');
    error_reporting(E_ALL); ini_set('display_errors', 1);
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    function build_table($result)
    {

        if (mysqli_num_rows($result) > 0) {
            echo "<table class='manage-tb'>";
            echo "<tr class='manage-tr'>";
            echo "<th class='manage-th'>Feedback ID</th>";
            echo "<th class='manage-th'>Name</th>";
            echo "<th class='manage-th'>Feedback</th>";
            echo "</tr>";

            while ($row = mysqli_fetch_array($result)) {
                //Checks if value is not null/""
                echo "<tr class='manage-tr'>";
                echo "<form action='' method='POST'>";
                echo "<td class='manage-td'>" . $row['feedbackID'] . "</td>";
                echo "<td class='manage-td'>" . $row['customerName'] . "</td>";
                echo "<td class='manage-td'>" . $row['feedback'] . "</td>";



                echo "</form></tr>";
            }
        }
        echo "</table></div><br><br>";
    }
    ?>
</section>
</body>
</html>
<?php

//search button NOT YET
if(isset($_GET['btnSearch'])){
    $sql = "SELECT * FROM feedback INNER JOIN `order summary` ON feedback.orderSummaryID = `order summary`.orderSummaryID WHERE feedbackID LIKE ? OR customerName LIKE ?  OR feedback LIKE ?  ORDER BY feedbackID";
    if($stmt = mysqli_prepare($link, $sql)){
        $search = '%' . $_GET['txtsearch'] . '%';
        mysqli_stmt_bind_param($stmt, "sss",  $search,$search,  $search);
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
    $sql = "SELECT * FROM feedback INNER JOIN `order summary` ON feedback.orderSummaryID = `order summary`.orderSummaryID ORDER BY feedbackID";
    if ($stmt = mysqli_prepare($link, $sql)) {
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            build_table($result);
        }
    } else {
        echo $link->error;
        echo "Error on form load";
    }
}
?>
