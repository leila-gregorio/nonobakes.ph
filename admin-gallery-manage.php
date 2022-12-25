<?php
//Session Checker
session_start();
if(!isset($_SESSION['username'])){
    header("location:admin-login.php");
}

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
    <title> Order Receipt | Nonobakes </title>
    <!--font and icons-->
    <link href="https://fonts.googleapis.com/css2?family=Cabin&family=Herr+Von+Muellerhoff&family=Poiret+One&family=Source+Sans+Pro:wght@700&display=swap"
          rel="stylesheet">
    <link rel="icon" href="images/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <!--jquery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- javascript -->
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <script src="js/script.js" defer></script>
    <script src="js/form.js" defer></script>
    <!--scroll reveal-->
    <script src="https://unpkg.com/scrollreveal@3.3.2/dist/scrollreveal.min.js"></script>
    <!-- bootstrap, css design -->
    <link rel="stylesheet" defer href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" defer />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="style-admin.css">


</head>
<body>
<!--ajax script-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
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
                    <a href="admin-order-manage.php" class="nav-link link-font">Orders</a>
                </li>
                <li class="nav-item">
                    <a href="admin-form-manage.php" class="nav-link link-font">Form</a>
                </li>
                <li class=" nav-item">
                    <a href="admin-gallery-manage.php" class="nav-link link-font active">Gallery</a>
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
<!-- modal form -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <!-- Modal 1|Create User -->
    <div id="theModal1" class="modal fade text-center">
        <div class="modal-dialog">
            <div class="modal-content">
            </div>
        </div>
    </div>
    <!-- Script to remove data in the modal-->
    <script>
        $(document).on('hidden.bs.modal', function (e) {
            $(e.target).removeData('bs.modal');
        });
    </script>
</form>
<!-- BAKERS -->
<section class="bakers" style="margin: 0 auto">

    <div class="container">
        <div class="title text-center">
            <h3 class="headline headline-dark">Gallery Editor</h3><br>
        </div>
            <div class="gallery-con">
                <div class="column border-cont animate-left">
                    <div class="receipt-title ">
                        <p>Upload Image</p>
                        <br><hr class="center" style="width: 60%;"><br>
                    </div><br>
                    <form action="admin-upload-gallery.php" method="POST" enctype="multipart/form-data" >
                        <div class="center" style="width: 60%; margin: auto">
                        </div>
                        <br>
                        <div class="center">
                            <input name="productImage" class="btn-upload" type="file" id="myFile" onchange="preview()" required>

                            <br>
                        </div>
                        <div class="center" style="width: 60%; margin: auto">
                            <img class='product-image center' id='thumb'  width='150px'/>
                        </div><br>
                        <div class="center" style="width: 40%; margin: auto" >
                            <button name="btnSave" type="submit" class="form-control btn-image no-bg" >Save</button>
                        </div>
                    </form>
            </div>
                <!-- Gallery -->
                <div class="border-cont container animate-left"><br>
                    <div class="receipt-title ">
                        <p>Gallery</p><hr class="center hr-style" style="width: 40%;"><br>
                    </div><br><br
                    <div class="row d-flex text-center text-lg-start">

            <?php
                //Table Load - Cake Flavor
                $sql = "SELECT * FROM gallery ORDER BY galleryID;";
                if ($stmt = mysqli_prepare($link, $sql)) {
                    if (mysqli_stmt_execute($stmt)) {
                        $result = mysqli_stmt_get_result($stmt);
                        build_gallery($result);
                    }
                } else {
                    echo "Error on form load";
                }
            function build_gallery($result){
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {
            ?>
                                <div class="col-md-4 col-12 mx-auto">
                                    <div class="card-cont">
                                        <img src="<?php echo $row['galleryImage']?>" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <?php echo "<a  class='btn-image inline' href='admin-delete-gallery.php?id=" . $row['galleryID'] . "' data-dismiss='modal' data-toggle='modal' data-target='#theModal1'><i class = 'fas fa-trash'></i></a>";

                                            ?>
                                        </div>
                                </div><br>

                        </div>
            <?php




                    }
                }
            }
             ?>

                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>

<?php



?>