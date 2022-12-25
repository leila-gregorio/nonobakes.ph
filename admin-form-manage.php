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
        <title> Form Management | Nonobakes </title>
        <!--font and icons-->
        <link rel="icon" href="images/logo.png">
        <link href="https://fonts.googleapis.com/css2?family=Cabin&family=Herr+Von+Muellerhoff&family=Poiret+One&family=Source+Sans+Pro:wght@700&display=swap"
              rel="stylesheet">
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
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"/>
        <link rel="stylesheet" href="style-admin.css">
        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    </head>
    <body>
        <!--ajax script-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <!-- Session Check -->
        <?php
        if (isset($_SESSION['username']) or !empty($_SESSION['username'])) {
            // echo "Welcome, " . $_SESSION['username'];
        } else {
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
                            <a href="admin-order-manage.php" class="nav-link link-font">Orders</a>
                        </li>
                        <li class="nav-item">
                            <a href="admin-form-manage.php" class="nav-link link-font active">Form</a>
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
            <section class="forms">
                <div class="container animate-left">
                    <div class="title text-center">
                        <h3 class="headline headline-dark">Form Editor</h3><br>
                    </div>
        </form>
        <?php
        function build_table_cakeSize($result)
        {

            if (mysqli_num_rows($result) > 0) {
                echo "<div class='field_wrapper1'>";

                echo "<br><table class='manage-form-tb'>";
                echo "<tr>";
                echo "<form action='' method='POST'>";
                echo "<th><div class='receipt-title'><label class=' manage-th'>Cake Size</label></label>";
                echo "<a href='admin-product-manage.php' class='add_btn right-float'><i class='fas fa-marker'></i></a><br><hr class='center form-hr'></th> ";

                echo "</tr></form>";


                while ($row = mysqli_fetch_array($result)) {
                    //Checks if value is not null/""
                    if (!$row['productName'] == "") {
                        echo "<tr class=''>";
                        echo "<form action='' method='POST'>";
                        echo "<td class='manage-td-form''>" . $row['productName'] . "</td>";
                        echo "</form></tr>";
                    }
                }
                echo "</table></div><br><br>";
            }
        }
        ?>
        <?php
        function build_table_cakeFlavor($result)
        {
            if (mysqli_num_rows($result) > 0) {
                echo "<div class='field_wrapper2'><table class='manage-form-tb'>";
                echo "<tr>";
                echo "<form action='' method='POST'>";
                echo "<br><th><div class='receipt-title'><label class=' manage-th'>Cake Flavor</label> <br><hr class='center form-hr'><br></th>";
                echo "<th><a href='javascript:void(0);' class=' add_button_flavor' title='Add field'><i class='fas fa-plus'></i></a></p></div></th>";
                echo "<input type='hidden' value='1' id='total_chq'>";
                echo "</tr></form>";

                while ($row = mysqli_fetch_array($result)) {
                    //Checks if value is not null/""
                    if (!$row['cakeFlavor'] == "") {
                        echo "<tr class=''>";
                        echo "<form action='' method='POST'>";
                        echo "<td class='manage-td-form'>" . $row['cakeFlavor'] . "</td>";
                        echo "<td class='manage-td-form'><div class='right-float'><a class='details' href='admin-delete-flavor.php?id=" . $row['formID'] . "'data-toggle='modal' data-target='#theModal1'><i class='fas fa-trash'></i></a></div>";
                        echo "<div class='right-float'><a  class='details' href='admin-edit-flavor.php?id=" . $row['formID'] . "'data-toggle='modal' data-target='#theModal1'><i class = 'fas fa-edit'></i></a></div></td>";
                        echo "</form></tr>";
                    }
                }
                echo "</table></div>";
            }
        }

        ?>
        <?php
        function build_table_cakeFilling($result)
        {
            if (mysqli_num_rows($result) > 0) {
                echo "<div class='field_wrapper3'><table class='manage-form-tb'>";
                echo "<tr>";
                echo "<form action='' method='POST'>";
                echo "<th><div class='receipt-title'><label class=' manage-th'>Cake Filling</label> <br><hr class='center form-hr'><br></th>";
                echo "<th><a href='javascript:void(0);' class=' add_button_filling' title='Add field'><i class='fas fa-plus'></i></a></p></div></th>";
                echo "<input type='hidden' value='1' id='total_chq'>";
                echo "</tr></form>";

                while ($row = mysqli_fetch_array($result)) {
                    //Checks if value is not null/""
                    if (!$row['cakeFilling'] == "") {
                        echo "<tr class=''>";
                        echo "<form action='' method='POST'>";
                        echo "<td class='manage-td-form'>" . $row['cakeFilling'] . "</td>";
                        echo "<td class='manage-td-form'><div class='right-float'><a class='details' href='admin-delete-filling.php?id=" . $row['formID'] . "'data-toggle='modal' data-target='#theModal1'><i class='fas fa-trash'></i></a></div>";
                        echo "<div class='right-float'><a  class='details' href='admin-edit-filling.php?id=" . $row['formID'] . "'data-toggle='modal' data-target='#theModal1'><i class = 'fas fa-edit'></i></a></div></td>";
                        echo "</form></tr>";
                    }
                }
                echo "</table></div>";
            }
        }

        ?>
        <?php
        function build_table_font($result)
        {
            if (mysqli_num_rows($result) > 0) {
                echo "<div class='field_wrapper4'><table class='manage-form-tb'>";
                echo "<tr class=''>";
                echo "<form action='' method='POST'>";
                echo "<th><div class='receipt-title'><label class=' manage-th'>Font Style</label> <br><hr class='center form-hr'><br></th>";
                echo "<th><a href='javascript:void(0);' class=' add_button_font' title='Add field'><i class='fas fa-plus'></i></a></p></div></th>";
                echo "<input type='hidden' value='1' id='total_chq'>";
                echo "</tr></form>";

                while ($row = mysqli_fetch_array($result)) {
                    //Checks if value is not null/""
                    if (!$row['fontStyle'] == "") {
                        echo "<tr class=''>";
                        echo "<form action='' method='POST'>";
                        echo "<td class='manage-td-form'>" . $row['fontStyle'] . "</td>";
                        echo "<td class='manage-td-form'><div class='right-float'><a class='details' href='admin-delete-font.php?id=" . $row['formID'] . "'data-toggle='modal' data-target='#theModal1'><i class='fas fa-trash'></i></a></div>";
                        echo "<div class='right-float'><a  class='details' href='admin-edit-font.php?id=" . $row['formID'] . "'data-toggle='modal' data-target='#theModal1'><i class = 'fas fa-edit'></i></a></div></td>";
                        echo "</form></tr>";
                    }
                }
                echo "</table></div>";
            }
        }
        ?>
        <?php
        function build_table_addons($result)
        {
            if (mysqli_num_rows($result) > 0) {
                echo "<br><br><div class='field_wrapper5'><table class='manage-form-tb'>";
                echo "<tr class=''>";
                echo "<form action='' method='POST'>";
                echo "<br><th><div class='receipt-title2'><label class=' manage-th'>Add-Ons</label> <br><hr class='center form-hr'><br></th>";
                echo "<th><div class='receipt-title2'><label class=' manage-th'>Price</label> <br><hr class='center form-hr'><br></th>";
                echo "<th><div class='receipt-title2'><label class=' manage-th'>Max</label> <br><hr class='center form-hr'><br></th>";

                echo "<th><a class='add_btn right-float' href='admin-insert-addons.php' data-toggle='modal' data-target='#theModal1'><i class='fas fa-plus'></i></a></th>";
                echo "<input type='hidden' value='1' id='total_chq'>";
                echo "</tr></form>";

                while ($row = mysqli_fetch_array($result)) {
                    //Checks if value is not null/""
                    if (!$row['name'] == "") {
                        echo "<tr class=''>";
                        echo "<form action='' method='POST'>";
                        echo "<td class='manage-td-form'>" . $row['name'] . "</td>";
                        echo "<td class='manage-td-form'>" . $row['price'] . "</td>";
                        echo "<td class='manage-td-form'>" . $row['maxQuantity'] . "</td>";

                        echo "<td class='manage-td-form'><div class='right-float'><a class='details' href='admin-delete-addons.php?id=" . $row['addID'] . "'data-toggle='modal' data-target='#theModal1'><i class='fas fa-trash'></i></a></div>";
                        echo "<div class='right-float'><a  class='details' href='admin-edit-addons.php?id=" . $row['addID'] . "'data-toggle='modal' data-target='#theModal1'><i class = 'fas fa-edit'></i></a></div></td>";
                        echo "</form></tr>";
                    }
                }
                echo "</table></div>";
            }
        }
        echo "<br>"
        ?>
    </body>
</html>
<?php
    //              TABLE LOAD              //
    //Table Load - Cake Size

    $sql = "SELECT `productID`, `productName` FROM `product` WHERE `productDescription` = ? ORDER BY productID";
    if ($stmt = mysqli_prepare($link, $sql)) {
        $description = "BENTO CAKE";
        mysqli_stmt_bind_param($stmt, "s", $description);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            build_table_cakeSize($result);
        }
    } else {
        echo "Error on form load";
    }
    //Table Load - Cake Flavor
    $sql = "SELECT formID,cakeFlavor FROM form ORDER BY formID";
    if ($stmt = mysqli_prepare($link, $sql)) {
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            build_table_cakeFlavor($result);
        }
    } else {
        echo "Error on form load";
    }
    //Table Load - Cake Filling
    $sql = "SELECT formID,cakeFilling FROM form ORDER BY formID";
    if ($stmt = mysqli_prepare($link, $sql)) {
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            build_table_cakeFilling($result);
        }
    } else {
        echo "Error on form load";
    }
    //Table Load - Font Style
    $sql = "SELECT formID,fontStyle FROM form ORDER BY formID";
    if ($stmt = mysqli_prepare($link, $sql)) {
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            build_table_font($result);
        }
    } else {
        echo "Error on form load";
    }
    //Table Load - Add Ons
    $sql = "SELECT * FROM  `add ons` ORDER BY `addID`";
    if ($stmt = mysqli_prepare($link, $sql)) {
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            build_table_addons($result);
        }
    } else {
        echo "Error on form load";
    }

    //              INSERT TO TABLE             //
    //Insert to Db -> Cake Size
    if (isset($_POST['fieldSize'])) {
        //check if the value is existing
        $sql = "SELECT * FROM form WHERE cakeSize = ?";
        if (!$_POST['fieldSize'] == "") {
            if ($stmt = mysqli_prepare($link, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $_POST['fieldSize']);
                if (mysqli_stmt_execute($stmt)) {
                    $result = mysqli_stmt_get_result($stmt);
                    if (mysqli_num_rows($result) != 1) {
                        //insert the value
                        $sql = "INSERT INTO `form`(`cakeSize`) VALUES (?);";
                        if ($stmt = mysqli_prepare($link, $sql)) {
                            mysqli_stmt_bind_param($stmt, "s", $_POST['fieldSize']);
                            if (mysqli_stmt_execute($stmt)) {
                                echo "<script type='text/javascript'>
                                alert('Successfully Added');
                            window.location='admin-form-manage.php'
                            </script>";
                            } else {
                                "<script type='text/javascript'>
                                alert('Error on insert statement');
                            window.location='admin-form-manage.php'
                            </script>";
                            }
                        }
                    } else {
                        "<script type='text/javascript'>
                                alert('Value is already existing');
                            window.location='admin-form-manage.php'
                            </script>";
                    }
                } else {
                    "<script type='text/javascript'>
                                alert('Error on select statement);
                            window.location='admin-form-manage.php'
                            </script>";
                }
            }
        }
    }
    //Insert to Db -> Cake Flavor
    if (isset($_POST['fieldFlavor'])) {
        //check if the value is existing
        $sql = "SELECT * FROM form WHERE cakeFlavor = ?";
        if (!$_POST['fieldFlavor'] == "") {
            if ($stmt = mysqli_prepare($link, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $_POST['fieldFlavor']);
                if (mysqli_stmt_execute($stmt)) {
                    $result = mysqli_stmt_get_result($stmt);
                    if (mysqli_num_rows($result) != 1) {
                        //insert the value
                        $sql = "INSERT INTO `form`(`cakeFlavor`) VALUES (?);";
                        if ($stmt = mysqli_prepare($link, $sql)) {
                            mysqli_stmt_bind_param($stmt, "s", $_POST['fieldFlavor']);
                            if (mysqli_stmt_execute($stmt)) {
                                echo "<script type='text/javascript'>
                                alert('Successfully Added');
                            window.location='admin-form-manage.php'
                            </script>";
                            } else {
                                "<script type='text/javascript'>
                                alert('Error on insert statement');
                            window.location='admin-form-manage.php'
                            </script>";
                            }
                        }
                    } else {
                        "<script type='text/javascript'>
                                alert('Value is already existing');
                            window.location='admin-form-manage.php'
                            </script>";
                    }
                } else {
                    "<script type='text/javascript'>
                                alert('Error on select statement);
                            window.location='admin-form-manage.php'
                            </script>";
                }
            }
        }
    }
    //Insert to Db -> Cake Filling
    if (isset($_POST['fieldFilling'])) {
        //check if the value is existing
        $sql = "SELECT * FROM form WHERE cakeFilling = ?";
        if (!$_POST['fieldFilling'] == "") {
            if ($stmt = mysqli_prepare($link, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $_POST['fieldFilling']);
                if (mysqli_stmt_execute($stmt)) {
                    $result = mysqli_stmt_get_result($stmt);
                    if (mysqli_num_rows($result) != 1) {
                        //insert the value
                        $sql = "INSERT INTO `form`(`cakeFilling`) VALUES (?);";
                        if ($stmt = mysqli_prepare($link, $sql)) {
                            mysqli_stmt_bind_param($stmt, "s", $_POST['fieldFilling']);
                            if (mysqli_stmt_execute($stmt)) {
                                echo "<script type='text/javascript'>
                                alert('Successfully Added');
                            window.location='admin-form-manage.php'
                            </script>";
                            } else {
                                "<script type='text/javascript'>
                                alert('Error on insert statement');
                            window.location='admin-form-manage.php'
                            </script>";
                            }
                        }
                    } else {
                        "<script type='text/javascript'>
                                alert('Value is already existing');
                            window.location='admin-form-manage.php'
                            </script>";
                    }
                } else {
                    "<script type='text/javascript'>
                                alert('Error on select statement);
                            window.location='admin-form-manage.php'
                            </script>";
                }
            }
        }
    }
    //Insert to Db -> Font Style
    if (isset($_POST['fieldFont'])) {
        //check if the value is existing
        $sql = "SELECT * FROM form WHERE fontStyle = ?";
        if (!$_POST['fieldFont'] == "") {
            if ($stmt = mysqli_prepare($link, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $_POST['fieldFont']);
                if (mysqli_stmt_execute($stmt)) {
                    $result = mysqli_stmt_get_result($stmt);
                    if (mysqli_num_rows($result) != 1) {
                        //insert the value
                        $sql = "INSERT INTO `form`(`fontStyle`) VALUES (?);";
                        if ($stmt = mysqli_prepare($link, $sql)) {
                            mysqli_stmt_bind_param($stmt, "s", $_POST['fieldFont']);
                            if (mysqli_stmt_execute($stmt)) {
                                echo "<script type='text/javascript'>
                                alert('Successfully Added');
                            window.location='admin-form-manage.php'
                            </script>";
                            } else {
                                "<script type='text/javascript'>
                                alert('Error on insert statement');
                            window.location='admin-form-manage.php'
                            </script>";
                            }
                        }
                    } else {
                        "<script type='text/javascript'>
                                alert('Value is already existing');
                            window.location='admin-form-manage.php'
                            </script>";
                    }
                } else {
                    "<script type='text/javascript'>
                                alert('Error on select statement);
                            window.location='admin-form-manage.php'
                            </script>";
                }
            }
        }
    }
?>
