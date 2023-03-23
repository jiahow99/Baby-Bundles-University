<?php 

// Admin authentication
require_once('admin_auth.php');

if(isset($_POST['upload'])){
    // inputs
    $title = $dbcontroller->sanitise($_POST['title']);
    $description = $dbcontroller->sanitise($_POST['description']);
    $category = $_POST['category'];
    $condition = $_POST['condition'];
    $price = $_POST['price'];


    // Product image
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
    

    // patterns (RM format)
    $price_pattern = "/^\d+\.?\d{0,2}$/";

    if(preg_match($price_pattern, $price)){
        // Save file to "img/$category/$name"
        // move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        // Insert Query
        $db_controller->insertQuery("INSERT INTO product_table(`title`, `category`, `description`, `condition`, `price`, `userid`, `image`) VALUES ( '$title', '$category', '$description', '$condition', '$price', '$userid', 'null')");
    }else{
        $_SESSION['price_err'] = "Please enter valid price";
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
            <?php require 'admin-topnavbar.php' ?>

            <form class="container glass" id="edit-product" method="post" enctype="multipart/form-data">
                <div class="row justify-content-center mt-4 mb-3">
                   <h1 style="color:#da3333">Add Product</h1> 
                </div>
                <div class="row mt-5">
                    <label for="" class="name text-uppercase col-12">Title</label>
                    <input class="input--style-6 col-10 ml-3" type="text" name="title" placeholder="Enter product title" required autofocus>
                </div>

                <div class="row">
                    <label for="" class="name text-uppercase col-12">Category</label>
                    <select class="form-select col-2 ml-3" aria-label="Default select example">
                        <option value="top">Top</option>
                        <option value="bottom">Bottom</option>
                        <option value="accessories">Accessories</option>
                        <option value="shoes">Shoes</option>
                        <option value="babycart">Baby Cart</option>
                        <option value="toy">Toy</option>
                        <option value="socks">Socks</option>
                    </select>
                </div>
                
                <div class="row mb-4">
                    <label for="" class="name text-uppercase col-12">Description</label>
                    <textarea name="description" class="textarea--style-6 ml-3 col-9" id="" rows="5"></textarea>
                </div>

                <div class="row">
                    <label for="" class="name text-uppercase col-12">Price</label>
                    <input class="input--style-6 col-1 ml-3" type="text" name="price" placeholder="RM" required>
                </div>
                <!-- Error Message (Price) -->
                <div class="text-danger text-sm">
                    <?php if(isset($_SESSION['price_err'])){ echo '**'.$_SESSION['price_err']; unset($_SESSION['price_err']);} ?>
                </div>

                <div class="row">
                    <!-- Product Condition -->
                    <label for="" class="name text-uppercase col-12">Condition</label>
                        <div class="value ml-3">
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


                <hr>

                <h3 style="color:#da3333;text-decoration: underline;" class="mb-3 mt-4">Product Image</h3>
                <input type="file" name="image" id="">
                <!-- Error Message (Image) -->
                <div class="text-danger pt-2 text-sm">
                    <?php if(isset($_SESSION['image_err'])){echo '** '.$_SESSION['image_err'];unset($_SESSION['image_err']);} ?>
                </div>

                <div class="row justify-content-center my-5 ">
                    <button class="btn btn-primary px-5 py-3 mr-5" type="submit" name="upload">Upload</button>
                </div>

            </form>
    </div>

    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

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