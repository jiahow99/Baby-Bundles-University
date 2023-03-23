<?php

if(isset($_POST['submit'])){

    if(isset($_POST['category'])){
        require_once('dbcontroller.php');
    
        $db_controller = new DBController();
        
        // inputs
        $title = $db_controller->sanitise($_POST['title']);
        $description = $db_controller->sanitise($_POST['description']);
        $category = $_POST['category'];
        $condition = $_POST['condition'];
        $price = $_POST['price'];
        $image = "img/".$category."/".$_POST['image'];


        // Product image
        $target_dir = "img/"."$category"."/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
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
            $is_image = false;
        }

        // Save file to img/'category'/'name'
        

        // patterns (RM format)
        $price_pattern = "/^\d+\.?\d{0,2}$/";

        if(preg_match($price_pattern, $price)){
            $db_controller->insertQuery("INSERT INTO product_table(`product_id`, `title`, `category`, `description`, `condition`, `price`, `userid`, `image`) VALUES (NULL, '$title', '$category', '$description', '$condition', '$price', '1', '$image')");
        }else{
            $_SESSION['price_err'] = "Please enter valid price";
        }

        
    }else{
        $_SESSION['category_err'] = "Please choose one";
    }
    
}


?>






<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title Page-->
    <title>Sell Product</title>

    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <!-- Main CSS-->
    <link href="css/upload-product.css" rel="stylesheet">
    <link href="css/style.default.css" rel="stylesheet">
    <link href="css/header-style.css" rel="stylesheet">
</head>

<body>
    <?php require 'header.php' ?>
    
    <form method="post" class="page-wrapper upload-bg-dark p-t-100 p-b-50"  id="upload-product">
        <div class="wrapper wrapper--w900">
            <div class="upload-card card-6">
                <div class="card-heading">
                    <h2 class="title text-center my-4">Sell Your Product</h2>
                </div>
                <div class="upload-card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-row">
                            <!-- Product Title -->
                            <div class="name text-uppercase">Title</div>
                            <div class="value">
                                <input class="input--style-6" type="text" name="title" placeholder="Enter product title" required autofocus>
                            </div>
                        </div>
                        <div class="form-row">
                            <!-- Product Category -->
                            <div class="name text-uppercase">Category</div>
                            <div class="value">
                                <div class="input-group">
                                <select class="form-select" name="category" aria-label="multiple select example" required>
                                    <option value="null">Select a category</option>
                                    <option value="top">Top</option>
                                    <option value="bottom">Bottom</option>
                                    <option value="accessories">Accessories</option>
                                    <option value="shoes">Shoes</option>
                                    <option value="babycart">Baby Cart</option>
                                    <option value="toy">Toy</option>
                                    <option value="socks">Socks</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <!-- Product Description -->
                            <div class="name text-uppercase">Description</div>
                            <div class="value">
                                <div class="input-group">
                                    <textarea class="textarea--style-6" name="description" placeholder="Say something about your product"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <!-- Product Condition -->
                            <div class="name text-uppercase">Condition</div>
                                <div class="value">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="condition" id="inlineRadio1" value="1">
                                        <label class="form-check-label small" for="inlineRadio1">1 (Very Poor)</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="condition" id="inlineRadio2" value="2">
                                        <label class="form-check-label small" for="inlineRadio2">2 (Poor)</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="condition" id="inlineRadio3" value="3">
                                        <label class="form-check-label small" for="inlineRadio3">3 (Good)</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="condition" id="inlineRadio4" value="4">
                                        <label class="form-check-label small" for="inlineRadio4">4 (Very Good)</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="condition" id="inlineRadio5" value="5">
                                        <label class="form-check-label small" for="inlineRadio5">5 (Like New)</label>
                                    </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <!-- Product Price -->
                            <div class="name text-uppercase">Price</div>
                                <div class="value">
                                    <div class="d-flex">
                                        <span class="input-group-text fw-bold">RM</span>
                                        <input class="input--style-6" type="text" name="price" placeholder="0.00">
                                    </div>
                                </div>
                        </div>  
                        <div class="form-row">
                            <!-- Product Image -->
                            <div class="name text-uppercase">Media</div>
                            <div class="value">
                                <input type="file" name="image" id="file">
                                <div class="label--desc">Upload your product image.</div>
                            </div>
                        </div>
                        <div class="form-row" style="justify-content: right">
                            <button class="upload-btn btn--radius-2 btn--red" type="submit" name="submit">Save</button>
                        </div>
                    </form>

                </div>
                
            </div>
        </div>
    </form>

    <?php require 'footer.html' ?>

</body>

<script src="js/navbar-transition.js"></script>


</html>
<!-- end document-->