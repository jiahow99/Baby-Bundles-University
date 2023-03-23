<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Product - Bottom</title>
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
        <header class="bg-dark py-6" style="padding-top:100px;">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Bottom</h1>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <!-- Product -->
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                            <!-- Product image-->
                            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">Special Item</h5>
                                    <!-- Product reviews-->
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                    </div>
                                    <!-- Product price-->
                                    <span class="text-muted text-decoration-line-through">$20.00</span>
                                    $18.00
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                            </div>
                        </div>
                    </div>

                    <?php
                    require_once('dbcontroller.php');

                    $db_controller = new DBController();
                    
                    $bottom_array = $db_controller->selectProduct("SELECT * FROM product_table WHERE category='bottom' ORDER BY product_id ASC");

                    if(!empty($bottom_array)){

                        foreach($bottom_array as $bottom){ ?>
                            <!-- Product Display -->
                            <form action="">
                                <div class="col">
                                    <div class="product card border-0" style="width:280px;">
                                        <!-- Product image-->
                                        <div class="overflow-hidden">
                                            <a href="#"><img class="card-img-top img-fluid" style="width:270px;height:290px;" src="<?php echo $bottom['image'] ?>" alt="..." /></a>
                                        </div>
                                        <!-- Product details-->
                                        <div class="card-body pt-3 pb-3" style="height:170px;">
                                            <div>
                                                <!-- Product name-->
                                                <div class="row " style="height:40px;">
                                                    <h6 class="justify-content-start col-10 "><?php echo mb_strimwidth($bottom['title'], 0, 40, "...") ?></h6>
                                                    <i class="fa fa-heart justify-content-end col-2"></i>
                                                </div>
                                                <!-- Product condition-->
                                                <div class="d-flex small mb-1 gap-1">
                                                    <?php
                                                        for ($x=0; $x<$bottom['condition']; $x++) { 
                                                            echo '<i class="bi bi-star-fill star-filled"></i>';
                                                        }

                                                        $unfill_star = 5 - $bottom['condition'];

                                                        for($y=0; $y<$unfill_star; $y++ ){
                                                            echo '<i class="bi bi-star"></i>';
                                                        }
                                                    ?>
                                                </div>
                                                <!-- Product price-->
                                                <span class="text-primary fw-bold text-lg">RM <?php echo $bottom['price'] ?></span>
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
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <script src="js/navbar-transition.js"></script>

    </body>
</html>
