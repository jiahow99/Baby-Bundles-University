<?php

// Admin authentication
require_once('admin_auth.php');

if(!isset($_SESSION)){
    session_start();
}

require_once('dbcontroller.php');

$dbcontroller = new DBController();

// Product ID
$productid = $_GET['productid'];

// Get the product
$product_query = "SELECT * FROM product_table WHERE product_id='$productid'";
$result = $dbcontroller->selectSingleProduct($product_query);

// Seller ID
$sellerid = $result['userid'];

// Get the seller info
$user_query = "SELECT * FROM login_table WHERE userid='$sellerid'";
$seller = $dbcontroller->selectUser($user_query);


// Update Product
if(isset($_POST['update'])){
    $new_title = $_POST['title'];
    $new_price = $_POST['price'];
    $new_description = $_POST['description'];

    // Product image
    if(isset($_FILES["image"])){
        $target_dir = "img/"."$category"."/";
        $target_file = $target_dir.basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


        // Check is a image or not
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            $is_image = true;
        } else {
            $is_image = false;
        }

        
        // Allow image type
        $allowed_type = array("jpg", "png", "jpeg", "gif", "wbep");
        if( !in_array($imageFileType, $allowed_type) ) {
            $_SESSION['image_err'] = "Only JPG, PNG, JPEG, GIF, WBEP are allowed";
            $is_image = false;
        }else{
            $is_image = true;
        }

        
    }else{
        $target_file = $result['image'];
        $is_image = true;
    }

    // Update product
    // Save image
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    $update = "UPDATE product_table SET title='$new_title', price='$new_price', description='$new_description', image='$target_file' WHERE product_id='$productid'";
    $result = $dbcontroller->updateProduct($update);

    

    if($result){
        $_SESSION['update_successful'] = true;
        echo header("Location:admin-viewproduct.php");
    }
    
}


// Delete Product
if(isset($_POST['delete'])){
    $delete_query = "DELETE FROM product_table WHERE product_id='$productid'";
    $result = $dbcontroller->deleteQuery($delete_query);

    if($result){
        if($result){
            $_SESSION['delete_successful'] = true;
            echo header("Location:admin-viewproduct.php");
        }
    }
}

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Admin-Product</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/admin.style.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" integrity="sha384-xeJqLiuOvjUBq3iGOjvSQSIlwrpqjSHXpduPd6rQpuiM3f5/ijby8pCsnbu5S81n" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"  type='text/css'>



</head>

<body>

    <div class="wrapper">
        <!-- Sidebar  -->
        <?php require 'admin-sidebar.php' ?>

        <!-- Page Content  -->
        <div id="content" style="background-color:#F2F2F2">

            <!-- Top Nav Bar -->
            <?php require 'admin-topnavbar.php' ?>

            <form class="container glass" id="edit-product" method="post" enctype="multipart/form-data">
                <!-- Product Image Display -->
                <div class="row justify-content-center">
                    <img src="<?php if(isset($result)){echo $result['image'];} ?>" alt="" width="280px" class="rounded mt-4 mb-3">
                </div>
                <hr>
                <!-- Product image -->
                <div class="row">
                    <label for="" class="name text-uppercase col-12">Image</label>
                    <input type="file" name="image" id="image" class="ml-3">
                </div>
                <!-- Product Title -->
                <div class="row">
                    <label for="" class="name text-uppercase col-12">Title</label>
                    <input class="input--style-6 col-10 ml-3" type="text" name="title" value="<?php if(isset($result)){echo $result['title'];} ?>" placeholder="Enter product title" required>
                </div>
                <!-- Product Category -->
                <div class="row">
                    <label for="" class="name text-uppercase col-12">Categories</label>
                    <select name="category" id="category" class="ml-3">
                        <option value="top" <?php if($result['category']=='top'){echo "selected";} ?>>Top</option>
                        <option value="bottom" <?php if($result['category']=='bottom'){echo "selected";} ?> >Bottom</option>
                        <option value="socks" <?php if($result['category']=='socks'){echo "selected";} ?>>Socks</option>
                        <option value="toy" <?php if($result['category']=='toy'){echo "selected";} ?> >Toy</option>
                        <option value="babycart" <?php if($result['category']=='babycart'){echo "selected";} ?> >Baby Cart</option>
                        <option value="accessories" <?php if($result['category']=='accessories'){echo "selected";} ?>>Accessories</option>
                    </select>
                </div>
                <!-- Product Price -->
                <div class="row">
                    <label for="" class="name text-uppercase col-12">Price (RM)</label>
                    <input class="input--style-6 col-2 ml-3" type="text" name="price" value="<?php if(isset($result)){echo $result['price'];} ?>" placeholder="RM" required>
                </div>
                <!-- Product Description -->
                <div class="row mb-4">
                    <label for="" class="name text-uppercase col-12">Description</label>
                    <textarea name="description" class="textarea--style-6 ml-3 col-9" rows="5"><?php if(isset($result)){echo $result['description'];} ?></textarea>
                </div>
                <hr>
                <h3 style="color:#da3333;text-decoration: underline;" class="">Seller Information</h3>
                <!-- Seller Name -->
                <div class="form-group align-items-center">
                    <label for="" class="name text-uppercase col-2">Name :</label>
                    <input class="input--style-6 ml-3" type="text" name="username" value="<?php if(isset($seller)){echo $seller['username'];} ?>" disabled >
                </div>
                <!-- Seller Contact -->
                <div class="form-group ">
                <label for="" class="name text-uppercase col-2">Contact No :</label>
                <input class="input--style-6 ml-3" type="text" name="contact"  value="<?php if(isset($seller)){echo $seller['contact'];} ?>" disabled>
                </div>
                <!-- Seller Email -->
                <div class="form-group">
                <label for="" class="name text-uppercase col-2">Email Address :</label>
                <input class="input--style-6 ml-3" type="email" name="email" value="<?php if(isset($seller)){echo $seller['email'];} ?>" disabled>
                </div>
                <!-- Action -->
                <div class="row justify-content-center my-5 ">
                    <button class="btn btn-primary px-5 py-3 mr-5" type="submit" name="delete" id="delete">Delete</button>
                    <button class="btn btn-primary px-5 py-3" type="submit" name="update" id="update">Update</button>
                </div>

            </form>
    </div>

    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <!-- Sidebar active class -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $('#dashboardlabel').toggleClass('d-none');
                $('#userlabel').toggleClass('d-none');
                $('#productlabel').toggleClass('d-none');
                $('#orderlabel').toggleClass('d-none');
                $('#accountlabel').toggleClass('d-none');
                $('#logoutlabel').toggleClass('d-none');
            });
        });

    </script>
</body>

</html>