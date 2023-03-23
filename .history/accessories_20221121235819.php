<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Product - Accessories</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/shopping-style.css" rel="stylesheet" />
        <!-- theme stylesheet-->
        <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
        <link rel="stylesheet" href="css/header-style.css">
    </head>
    <?php require 'header.php' ?>
    <body>


        <!-- Header-->
        <section class="img-fluid bg-secondary py-6" style="padding-top:150px;background-image: url(img/accessories-banner.jpg);background-position: center;background-size: cover;">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="text-lg fw-bolder text-white">Accessories</h1>
                </div>
            </div>
        </section>
        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <!-- Display Product -->
                    <?php
                    require_once('dbcontroller.php');

                    $db_controller = new DBController();
                    
                    $accessories_array = $db_controller->selectProduct("SELECT * FROM product_table WHERE category='accessories' ORDER BY product_id ASC");

                    if(!empty($accessories_array)){

                        foreach($accessories_array as $accessories){ ?>
                            <!-- Product Display -->
                            <form action="">
                                <div class="col">
                                    <div class="product card border-0" style="width:280px;">
                                        <!-- Product image-->
                                        <div class="overflow-hidden">
                                            <a href="#"><img class="card-img-top img-fluid" style="width:270px;height:290px;" src="<?php echo $accessories['image'] ?>" alt="..." /></a>
                                        </div>
                                        <!-- Product details-->
                                        <div class="card-body pt-3 pb-3" style="height:170px;">
                                            <div>
                                                <!-- Product name-->
                                                <div class="row " style="height:40px;">
                                                    <h6 class="justify-content-start col-10 "><?php echo mb_strimwidth($accessories['title'], 0, 40, "...") ?></h6>
                                                    <i class="fa fa-heart justify-content-end col-2"></i>
                                                </div>
                                                <!-- Product condition-->
                                                <div class="d-flex small mb-1 gap-1">
                                                    <?php
                                                        for ($x=0; $x<$accessories['condition']; $x++) { 
                                                            echo '<i class="bi bi-star-fill star-filled"></i>';
                                                        }

                                                        $unfill_star = 5 - $accessories['condition'];

                                                        for($y=0; $y<$unfill_star; $y++ ){
                                                            echo '<i class="bi bi-star"></i>';
                                                        }
                                                    ?>
                                                </div>
                                                <!-- Product price-->
                                                <span class="text-primary fw-bold text-lg">RM <?php echo $accessories['price'] ?></span>
                                            </div>
                                            
                                        </div>
                                        <!-- Product actions-->
                                        
                                    </div>
                                </div>
                            </form>

                        <?php }
                    }

                    ?>

                </div>
            </div>
        </section>
        <!-- Footer-->
        <?php require 'footer.html' ?>
        <script src="js/navbar-transition.js"></script>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/shopping-scripts.js"></script>
        <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    </body>
</html>
