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

if(isset($_GET['id']) && !empty(trim($_GET['id']))){
    $sql = "SELECT *  FROM `add ons` WHERE addID = ?";
    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "s", $_GET['id']);
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            }
            else{
                header("location: error.php");
                exit();
            }
        }
        else{
            echo "Error on select statement";
        }
    }

}
if(isset($_POST['btnupdate'])){

    $sql = "UPDATE `add ons` SET name = ?, price = ? WHERE addID = ?; ";
    if($stmt = mysqli_prepare($link, $sql)){
        $price =floatval($_POST['editPrice']);
        mysqli_stmt_bind_param($stmt, "sss",$_POST['editName'] ,$price,$_GET['id']);
        if(mysqli_stmt_execute($stmt)){
            echo "<script type='text/javascript'>alert('Successfully Edited');
                    window.location='admin-form-manage.php'
				</script>";
        }
        else{
            echo "<script type='text/javascript'>alert('Error on update statement');
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
        <p>Edit Add-Ons</p>
        <br><hr class="center form-hr "><br>
</div>
<div class="modal-style modal-body">
    <div class=" ">
            <div class="row ">
                <form action = "<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method = "POST">
                        <div class="form-group cont-edit center-item">
                            <label for="editAddOns">Name</label>
                            <input type="text" class=" form-control" name="editName" value="<?php echo $row['name']; ?>"/><br><br>
                        </div>
                        <div class="form-group cont-edit center-item">
                            <label for="editAddOns">Price</label>
                            <input type="text" class=" form-control" name="editPrice" value="<?php echo $row['price']; ?>"/><br><br>
                        </div>
                    <input type = "submit" class="button btn-save" name = "btnupdate" value = "Submit">
            </div>
            </form>
        </div>
    </div>
</div>
</div>
</body>
</html>
