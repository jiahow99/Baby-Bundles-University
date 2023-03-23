<?

require_once('dbcontroller.php');

$db_controller = new DBController();

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Product - Top</title>
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
        <section class="img-fluid bg-secondary py-6" style="padding-top:150px;background-image: url(img/top-banner.jpg);background-position: center;background-size: cover;">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="text-lg fw-bolder text-white">Top</h1>
                </div>
            </div>
        </section>
        <!-- Section-->
        <section class="pt-5">
            <div class="container px-4 px-lg-5 mt-2">
                <div class="row gx-2 gx-lg-0 gy-lg-4 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <?php
                    require_once('dbcontroller.php');

                    $db_controller = new DBController();
                    
                    $top_array = $db_controller->selectProduct("SELECT * FROM product_table WHERE category='toy' ORDER BY product_id ASC");

                    if(!empty($top_array)){

                        foreach($top_array as $top){ ?>
                            <!-- Product Display -->
                            <form action="" class="p-0">
                                <div class="col">
                                    <div class="product card border-0" style="width:250px;">
                                        <!-- Product image-->
                                        <div class="overflow-hidden">
                                            <?php echo "<a href='product-page.php?id=".$top['product_id']."'><img class='card-img-top' style='width:250px;height:260px;' src='".$top['image']."'</a>"; ?>
                                        </div>
                                        <!-- Product details-->
                                        <div class="card-body pt-3 pb-3" style="height:120px;">
                                            <div>
                                                <!-- Product name-->
                                                <div class="row " style="height:40px;">
                                                    <h6 class="justify-content-start col-10 text-black"><?php echo mb_strimwidth($top['title'], 0, 40, "...") ?></h6>
                                                    <!-- Favourite icon -->
                                                    <i class="fa fa-heart justify-content-end col-2"></i>
                                                </div>
                                                <!-- Product condition-->
                                                <div class="d-flex small mb-1 gap-1">
                                                    <?php
                                                        for ($x=0; $x<$top['condition']; $x++) { 
                                                            echo '<i class="bi bi-star-fill star-filled"></i>';
                                                        }

                                                        // $y = 5 - $top['condition'];
                                                        $unfill_star = 5 - $top['condition'];

                                                        for($y=0; $y<$unfill_star; $y++ ){
                                                            echo '<i class="bi bi-star"></i>';
                                                        }
                                                    ?>
                                                    
                                                </div>
                                                <!-- Product price-->
                                                <div class="row">
                                                    <span class="text-primary fw-bold text-lg col-9 justify-content-start">RM <?php echo $top['price'] ?></span>
                                                </div>
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
       
    </body>
    <script src="js/navbar-transition.js"></script>

</html>
