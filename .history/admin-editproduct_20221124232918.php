<?php

if(isset($_SESSION)){
    session_start();
}

require_once('dbcontroller.php');

$dbcontroller = new DBController();

// Product ID
$productid = $_GET['productid'];

// Get the product
$query = "SELECT * FROM product_table WHERE product_id='$productid'";
$result = $dbcontroller->selectSingleProduct($query);

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

            <form class="container glass" id="edit-product">
                <div class="row justify-content-center">
                    <img src="<?php if(isset($result)){echo $result['image'];} ?>" alt="" width="280px" class="rounded mt-4 mb-3">
                </div>
                <hr>
                <div class="row">
                    <label for="" class="name text-uppercase col-12">Title</label>
                    <input class="input--style-6 col-10 ml-3" type="text" name="title" placeholder="Enter product title" required autofocus>
                </div>

                <div class="row">
                    <label for="" class="name text-uppercase col-12">Price</label>
                    <input class="input--style-6 col-1 ml-3" type="text" name="title" placeholder="" required>
                </div>

                <div class="row mb-4">
                    <label for="" class="name text-uppercase col-12">Description</label>
                    <textarea name="description" class="textarea--style-6 ml-3 col-9" id="" rows="5"></textarea>
                </div>

                <hr>

                <h3 style="color:#da3333;text-decoration: underline;" class="">Seller Information</h3>
                <div class="form-group align-items-center">
                <label for="" class="name text-uppercase col-2">Name</label>
                <input class="input--style-6 ml-3" type="text" name="title"  >
                </div>

                <div class="form-group ">
                <label for="" class="name text-uppercase col-2">Contact No</label>
                <input class="input--style-6 ml-3" type="text" name="title"  >
                </div>

                <div class="form-group">
                <label for="" class="name text-uppercase col-2">Email Address</label>
                <input class="input--style-6 ml-3" type="email" name="title"  >
                </div>

                <div class="row justify-content-center my-5 ">
                    <button class="btn btn-primary px-5 py-3 mr-5" type="submit">Delete</button>
                    <button class="btn btn-primary px-5 py-3" type="submit">Update</button>
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