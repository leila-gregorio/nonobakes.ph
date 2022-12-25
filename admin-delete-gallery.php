<?php

//Session Checker
session_start();
if (!isset($_SESSION['username'])) {
    header("location:admin-login.php");
}

//Db Connection
define('DB_SERVER', '127.0.0.1');
define('DB_USERNAME', 'nonobakes');
define('DB_PASSWORD', 'nonobakes');
define('DB_NAME', 'nonobakes.ph');
error_reporting(E_ALL);
ini_set('display_errors', 1);
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
//Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if (isset($_POST['delete']) and isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM gallery WHERE galleryID = ?; ";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $id);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) == 1) {
                while ($row = mysqli_fetch_array($result)) {
                    unlink($row['productImage']);
                    $sql = "DELETE FROM gallery WHERE galleryID = ?; ";
                    if ($stmt = mysqli_prepare($link, $sql)) {
                        mysqli_stmt_bind_param($stmt, "s", $id);
                        if (mysqli_stmt_execute($stmt)) {
                            echo "<script>alert('Image deleted!')</script>";
                            header("location: admin-gallery-manage.php");
                        } else {
                            echo $link->error;
                        }
                    }else{
                        echo $link->error;
                    }
                }
            }else{
                echo $link->error;
            }
        }else{
            echo $link->error;
        }
    }
}
?>
<html>
<head>
    <title>Delete</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
</head>
<body>
<div class="modal-style  modal-content">
    <div class="receipt-title" style="text-align: center"><br>
        <button class="btn-close inline" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></button>
        <p>Delete</p>
        <br><hr class="center"><br>
    </div>
    <div class="panel-body">
        <div class="row center">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type = "hidden" name = "id" value ="<?php echo trim($_GET['id']); ?>" />
                <label>Are you sure you want to delete? </label><br>
                <button type = "submit"  name = "delete" value = "Yes" class="button btn-save">Yes</button><br><br>
            </form>
        </div>
    </div>
</div>
</body>
</html>