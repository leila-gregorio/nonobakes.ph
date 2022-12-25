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
    $sql = "SELECT cakeFlavor  FROM `form` WHERE formID = ?";
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

    $sql = "UPDATE form SET cakeFlavor = ? WHERE formID = ?; ";
    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "ss",$_POST['editCakeFlavor'] ,$_GET['id']);
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
    <title>Edit Flavor</title>
    <!-- icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
</head>
<body>
<div class="modal-header modal-style  modal-content" id="mod2">
     <div class="modal-header" id="mod2">
            <div class="receipt-title"><br>
                <button type="button" class="btn-close inline close inline" data-dismiss="modal"><i class="fas fa-times"></i></button>
                <p>Edit Flavor</p>
                <br><hr class="center form-hr "><br>
            </div>
            <div class="modal-style modal-body">
                <div class=" ">
                    <div class="row ">
                        <form action = "<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method = "POST">
                            <div class="form-group cont-edit center-item">
                                <label for="editCakeFlavor">Cake Flavor</label>
                                <input type="text" class="form-control" name="editCakeFlavor" value="<?php echo $row['cakeFlavor']; ?>"/><br><br>
                                <input type = "submit" class="button btn-save" name = "btnupdate" value = "Submit">
                            </div>

                    </div>

                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
