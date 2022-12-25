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
if(isset($_POST['btnInsert'])) {
        //check if the value is existing
        $sql = "SELECT * FROM  `add ons` WHERE name = ?";
            if ($stmt = mysqli_prepare($link, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $_POST['insertName']);
                if (mysqli_stmt_execute($stmt)) {
                    $result = mysqli_stmt_get_result($stmt);
                    if (mysqli_num_rows($result) != 1) {
                        //insert the value
                        $sql = "INSERT INTO `add ons`(`name`,`price`,`maxQuantity`) VALUES (?,?,?);";
                        if ($stmt = mysqli_prepare($link, $sql)) {
                            $name = $_POST['insertName'];
                            $price = floatval($_POST['insertPrice']);
                            $quantity = intval($_POST['insertQuantity']);

                            mysqli_stmt_bind_param($stmt, "sss", $name ,$price,$quantity);
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
?>
<html>
<head>
    <title>Edit Filling</title>
    <!-- icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
</head>
<body>
<div class="modal-style  modal-content">
    <div class="modal-header" id="mod2">
        <div class="receipt-title"><br>
            <button type="button" class="btn-close inline close inline" data-dismiss="modal"><i class="fas fa-times"></i></button>
            <p>Add Add-Ons</p>
            <br><hr class="center form-hr "><br>
        </div>
        <div class="modal-style modal-body">
            <div class=" ">
                <div class="row ">
                    <form action = "<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method = "POST">
                        <div class="form-group cont-edit center-item">
                            <label for="editAddOns">Name</label>
                            <input type="text" class=" form-control" name="insertName" value=""/><br><br>
                        </div>
                        <div class="form-group cont-edit center-item">
                            <label for="insertQuantity">Maximum Quantity</label>
                            <input type="number" class=" form-control" name="insertQuantity" value=""/><br><br>
                        </div>
                        <div class="form-group cont-edit center-item">
                            <label for="editAddOns">Price</label>
                            <input type="text" class=" form-control" name="insertPrice" value=""/><br><br>
                        </div>
                        <input type = "submit" class="button btn-save" name = "btnInsert" value = "Submit">
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
