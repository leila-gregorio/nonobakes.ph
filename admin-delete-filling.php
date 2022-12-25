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

if(isset($_POST['btnsubmit'])){

    $sql = "UPDATE form SET cakeFilling = '' WHERE formID = ?; ";
    if($stmt = mysqli_prepare($link, $sql)){
        $ID= intval($_POST['id']);
        mysqli_stmt_bind_param($stmt, "s", $ID);
        if(mysqli_stmt_execute($stmt)){
            echo "<script type='text/javascript'>alert('Successfully Deleted');
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
    <title>Delete</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
</head>
<body><div class="modal-style  modal-content">
    <div class="modal-header" id="mod1">
        <div class="receipt-title"><br>
            <button type="button" class="btn-close inline close inline" data-dismiss="modal"><i class="fas fa-times"></i></button>
            <p>Delete Filling</p>
            <br><hr class="center form-hr "><br>
        </div>
    </div>
    <div class="modal-body">
    </div>
    <div class="panel-body">
        <div class="row">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type = "hidden" name = "id" value ="<?php echo trim($_GET['id']); ?>" />
                <h5>Are you sure you want to delete? </h5><br>
                <button type = "submit"  name = "btnsubmit" value = "Yes" class="button btn-save">Yes</button><br><br>
            </form>
        </div>
    </div>
</div>
</body>
</html>
