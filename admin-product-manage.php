<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Product Management | Nonobakes </title>
    <!--font and icons-->
    <link rel="icon" href="images/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Cabin&family=Herr+Von+Muellerhoff&family=Poiret+One&family=Source+Sans+Pro:wght@700&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <!--javascript-->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" defer />

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
                    <a href="admin-product-manage.php" class="nav-link link-font active">Products</a>
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


<!-- HERO SECTION -->

<section class="hero small-size-hero" id="hero">

</section>
<!-- Product Management -->
<section class="products ">
    <div class="container">
        <div class="title">
            <h3 class="headline headline-dark">Products</h3>
        </div>
    </div>
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

<div class="center ">
    <div class="product-cont animate-left col-md-6 " >
        <br /><br />
        <table class="manage-tb">
            <tr class="manage-tr">
                <th class="manage-th"><button class="btn details" type="button" data-toggle="modal" data-target="#form_modal"><span class="glyphicon glyphicon-plus"></span></button></th>
                <th class="manage-th"></th>
                <th class="manage-th">Name</th>
                <th class="manage-th">Category</th>
                <th class="manage-th">Price</th>
                <th class="manage-th">Type</th>
                <th class="manage-th">Status</th>
                <th class="manage-th">Slots</th>
                <th class="manage-th right-float"><div>Action</div></th>
            </tr>
            <tbody>
            <?php
            define('DB_SERVER', '127.0.0.1');
            define('DB_USERNAME', 'nonobakes');
            define('DB_PASSWORD', 'nonobakes');
            define('DB_NAME', 'nonobakes.ph');
            error_reporting(E_ALL); ini_set('display_errors', 1);
            $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
            $query = mysqli_query($link, "SELECT * FROM `product`") or die(mysqli_error($link));
            while($fetch = mysqli_fetch_array($query)){
                ?>
                <tr class="manage-tr">
                    <td class="image-td"><img src="<?php echo $fetch['productImage']?>"/></td>
                    <td class="manage-td" style="visibility: hidden;"><?php echo $fetch['productID']?></td>
                    <td class="manage-td"><?php echo $fetch['productName']?></td>
                    <td class="manage-td"><?php echo ucwords(strtolower($fetch['productCategory']))?></td>
                    <td class="manage-td"><?php echo $fetch['productPrice']?></td>
                    <td class="manage-td"><?php echo ucwords(strtolower($fetch['productDescription']))?></td>
                    <td class="manage-td"><?php echo ucwords(strtolower($fetch['productStatus']))?></td>
                    <td class="manage-td"><?php echo $fetch['productSlots']?></td>
                    <td class="manage-td-form">
                        <div class='right-float'><a  type="button" class="btn-save" data-toggle="modal" data-target="#delete<?php echo $fetch['productID']?>"><i class="fas fa-trash"></i></a></div>
                        <div class='right-float'><a  type="button" class="btn-save" data-toggle="modal" data-target="#edit<?php echo $fetch['productID']?>"><i class="fas fa-edit"></div></td>
                </tr>

                <div class=" modal fade" id="edit<?php echo $fetch['productID']?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class=" modal-style modal-content">
                            <form method="POST" enctype="multipart/form-data" action="admin-edit-product.php"><br><br>
                                <div class="receipt-title"><br>
                                    <button class="btn-close inline" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></button>

                                    <p>Edit Product</p>

                                    <br><hr class="center"><br>

                                </div>
                                <div class="modal-body">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <img src="<?php echo $fetch['productImage']?>" class="image-edit"/>
                                            <input type="hidden" name="previous" value="<?php echo $fetch['productImage']?>"/>
                                            <div class="center-item">
                                                <input type="file" class="center-item" name="productImage" value="<?php echo htmlspecialchars($fetch['productImage'])?>" required="required"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Product Name</label>
                                            <input type="hidden" value="<?php echo $fetch['productID']?>" name="productID"/>
                                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($fetch['productName'])?>" name="productName" required="required"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Product Category</label>
                                            <input type="month" class="form-control" value="<?php echo $fetch['productCategory']?>" name="productCategory" required="required"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Product Price</label>
                                            <input type="text" class="form-control" value="<?php echo $fetch['productPrice']?>" name="productPrice" required="required"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="type">Type</label>
                                            <select name="productType" id="type" class="form-control">
                                                <option class="status-sample"  value="<?php echo $fetch['productDescription']?>" hidden  selected ><?php echo $fetch['productDescription']?></option>
                                                <option class='status-option' value="BENTO CAKE">Bento Cake</option>
                                                <option value="OTHERS">Others</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Product Status</label>
                                            <input type="text" class="form-control" value="<?php echo $fetch['productStatus']?>" name="productStatus" required="required"/>
                                        </div>

                                        <div class="form-group">
                                            <label>Product Slots</label>
                                            <input type="text" class="form-control" value="<?php echo $fetch['productSlots']?>" name="productSlots" required="required"/>
                                        </div>
                                    </div>
                                </div>
                                <br style="clear:both;"/>
                                <div class="modal-footer center-item">
                                    <button class="btn-save" name="edit"><span class="glyphicon glyphicon-save"></span> Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class=" modal fade" id="delete<?php echo $fetch['productID']?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class=" modal-style modal-content">
                            <form method="POST" enctype="multipart/form-data" action="admin-delete-product.php"><br><br>
                                <input type="hidden" value="<?php echo $fetch['productID']?>" name="id">
                                <div class="receipt-title" style="text-align: center"><br>
                                    <button class="btn-close inline" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></button>
                                    <p>Delete Product</p>
                                    <br><hr class="center"><br>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8">
                                        <div class="center">
                                            <label>Do you want to delete this product?</label>
                                        </div>
                                    </div>
                                    <br style="clear:both;"/>
                                    <div class="modal-footer center-item">
                                        <button class="btn-save" name="delete"><span class="glyphicon glyphicon-trash"></span> Delete</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="form_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-style modal-content">
            <form method="POST" action="save-product.php" enctype="multipart/form-data">
                <div class="receipt-title"><br>
                    <button class="btn-close inline" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></button>

                    <p>Add Product</p>

                    <br><hr class="center"><br>

                </div>
                <div class="modal-body">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <input type="file" class="" name="productImage" required="required"/>
                        </div>
                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" class="form-control" name="productName" required="required"/>
                        </div>
                        <div class="form-group">
                            <label>Product Price</label>
                            <input type="text" class="form-control" name="productPrice" required="required"/>
                        </div>
                        <div class="form-group">
                            <label>Product Category</label>
                            <input type="month" class="form-control" name="productCategory" required="required"/>
                        </div>
                        <div class="form-group">
                            <label for="type">Type</label>
                            <select name="productType" id="type" class="form-control">
                                <option class="status-sample" hidden disabled selected></option>
                                <option class='status-option' value="BENTO CAKE">Bento Cake</option>
                                <option value="OTHERS">Others</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Product Status</label>
                            <input type="text" class="form-control" name="productStatus" required="required"/>
                        </div>
                        <div class="form-group">
                            <label>Product Slots</label>
                            <input type="text" class="form-control" name="productSlots" required="required"/>
                        </div>
                    </div>
                </div>
                <br style="clear:both;"/>
                <div class="modal-footer center-item">
                    <button class="btn-save" name="save"><span class="glyphicon glyphicon-save"></span> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>
<?php


?>

