<?php

if(!isset($_SESSION)){
    session_start();
}

// Check if product_id passed successfully
if(isset($_GET['id'])){
    require_once('dbcontroller.php');
    $dbcontroller = new DBController();

    // Set product id
    $id = $_GET['id'];

    // Get product from DB
    $query = "SELECT * FROM product_table WHERE product_id='$id'";
    $result = $dbcontroller->selectSingleProduct($query);

    // Product attributes
    $product_id = $result['product_id'];
    $seller_id = $result['userid'];
    $title = $result['title'];
    $category = ucfirst($result['category']);
    $description = $result['description'];
    $price = $result['price'];
    $condition = $result['condition'];
    $image = $result['image'];
    $user_id = $_COOKIE['userid'];



}

// Add product to cart
if(isset($_GET['action'])){

    // Check if item already in cart
    $product_row = $dbcontroller->numRows("SELECT * FROM shopping_cart_table WHERE userid='$user_id'");
    $cart = $dbcontroller->selectUser("SELECT * FROM shopping_cart_table WHERE userid='$user_id'");


    // If user has something in cart
    switch ($_GET['action']) {

        case 'add':
            // User cart empty
            if(!isset($cart['product'])){
                // Insert query
                $insert_query = "INSERT INTO shopping_cart_table(userid,product) VALUES('$user_id','$product_id')";
                $insert = $dbcontroller->insertQuery($insert_query);

                // Show Successful popup
                if($insert){
                    echo "
                    <script>
                        window.onload = function () {
                        document.getElementById('add-to-cart').click();
                        };
                    </script>";
                }

            }else{
                // Convert string to array (  "1,2,3" = array("1","2","3")  )
                $item_array = explode(',',$cart['product']);

                // Item already in cart
                if(in_array($product_id, $item_array)){
                    echo "
                    <script>
                    window.onload = function () {
                        document.getElementById('item-existed').click();
                        };
                    </script>";
                }else{
                    // Item not in cart
                    array_push($item_array, $product_id);

                    // Convert array to string (1,2,3,4)
                    $item = implode(',',$item_array);

                    if($item[0] == ','){
                        $item = substr($item, 1);
                    }
                    
                    // Insert to shopping cart
                    $query = "UPDATE shopping_cart_table SET product='$item' WHERE userid='$user_id'";
                    $update = $dbcontroller->updateCart($query);
                    if($update){
                    echo "
                    <script>
                        window.onload = function () {
                        document.getElementById('add-to-cart').click();
                        };
                    </script>";
                    }
                }
            }

            // Update cart items;
            $_SESSION['products'] = $item_array;
            break;
            
            
        
        default:
            # code...
            break;
    }
}



?>

<!doctype html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>Product Page</title>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css' rel='stylesheet'>
        <link href='https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css' rel='stylesheet'>
        
        <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
        <script type="text/javascript" src="//code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <link rel="stylesheet" href="css/product-page.css">
        <link rel="stylesheet" href="css/header-style.css">
        <link rel="stylesheet" href="css/accordian.css">
        <!-- SweetAlert plugin -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- Jquery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        
        </head>
        <?php require 'header.php' ?>
        <section class="body">
        <body className='snippet-body'>
            <div class="container mb-5" style="padding-top:7rem;">
                <div class="card">
                    <div class="row g-0">
                    <div class="col-md-6 border-end">
                    <div class="d-flex flex-column justify-content-center">
                    
                    <!-- Main image -->
                    <div class="main_image">
                        <img src="<?php echo $image; ?>" id="main_product_image" width="350">
                    </div>
                    <!-- Thumbnail images -->
                    <div class="thumbnail_images">
                        <ul id="thumbnail">
                            <li>
                                <img onclick="changeImage(this)" src="https://i.imgur.com/TAzli1U.jpg" width="70">
                            </li>
                            <li>
                                <img onclick="changeImage(this)" src="https://i.imgur.com/w6kEctd.jpg" width="70">
                            </li>
                            <li>
                                <img onclick="changeImage(this)" src="https://i.imgur.com/L7hFD8X.jpg" width="70">
                            </li>
                            <li>
                                <img onclick="changeImage(this)" src="https://i.imgur.com/6ZufmNS.jpg" width="70">
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
                    <div class="col-md-6">
                    <div class="p-3 right-side">
                    <div class="d-flex justify-content-between align-items-center">
                    <!-- Product title -->
                    <h2 class="product-title" style="width:90%;"><?php echo $title; ?></h2>
                    <!-- Favourite icon -->
                    <span class="heart text-lg" style="position:absolute;top:30px;right:20px;">
                        <i class='bx bx-heart'></i>
                    </span>
                </div>
                <div class="text-muted" style="font-size:14px">Category: <?php echo $category ?></div>
                    <!-- Contents -->
                    <div class="mt-2 pr-3 content">
                    <p style="font-size:17px">
                    <?php echo $description; ?>
                    </p>
                </div>
                    <!-- Price -->
                    <h3>RM <?php echo $price; ?></h3>
                    <!-- Stars rating -->
                    <div class="ratings d-flex flex-row align-items-center">
                    <div class="d-flex flex-row">
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                    </div>
                    <!-- review count -->
                    <span>441 reviews</span>
                </div>
                    <!-- Buttons -->
                    <div class="buttons d-flex flex-row gap-3" style="margin-top:80px">
                        <a class="btn-add">
                            Buy Now
                        </a>
                        <a  href="product-page.php?action=add&id=<?php echo $product_id; ?>"  class="btn-outline-add" style="border-width: 3px;">
                            Add to Cart
                        </a>
                        <button hidden id="add-to-cart"></button>
                        <button hidden id="item-existed"></button>
                </div>
                
            <!-- Accordian -->
            <div class="row" style="margin-top:6rem;">
            <div class="col-lg-9 mx-auto-custom" style="width:100%">
                <!-- Accordion -->
                <div id="accordionExample" class="accordion shadow">
                    <!-- Accordion item 1 -->
                    <div class="card">
                        <div id="headingOne" class="card-header bg-white shadow-sm border-0" >
                            <h2 class="mb-0">
                                <!-- Title -->
                                <button type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="btn btn-link text-dark  text-uppercase collapsible-link" style="font-size:15px;font-weight:bold;">
                                    SIZE DETAILS
                                </button>
                            </h2>
                        </div>
                        <div id="collapseOne" aria-labelledby="headingOne" data-parent="#accordionExample" class="collapse">
                            <div class="card-body p-5">
                                <!-- Content -->
                                <p class="font-weight-light m-0">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                                </p>
                            </div>
                        </div>
                    </div><!-- End -->

                    

                    <!-- Accordion item 2 -->
                    <div class="card">
                        <div id="headingTwo" class="card-header bg-white shadow-sm border-0">
                            <h2 class="mb-0">
                                <!-- Title -->
                                <button type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link" style="font-size:15px;font-weight:bold;">
                                    DELIVERY FEE
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" aria-labelledby="headingTwo" data-parent="#accordionExample" class="collapse">
                            <div class="card-body p-5">
                                <!-- Content -->
                                <p class="font-weight-light m-0">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                                </p>
                            </div>
                        </div>
                    </div><!-- End -->

        

                    <!-- Accordion item 3 -->
                    <div class="card">
                        <div id="headingThree" class="card-header bg-white shadow-sm border-0 ">
                            <h2 class="mb-0">
                                <button type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link " style="font-size:15px;font-weight:bold;">
                                SHIPPING INFO
                            </button>
                            </h2>
                        </div>
                        <div id="collapseThree" aria-labelledby="headingThree" data-parent="#accordionExample" class="collapse">
                            <div class="card-body p-5">
                                <p class="font-weight-light m-0">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.</p>
                            </div>
                        </div>
                    </div><!-- End -->

                    <!-- Accordion item 4 -->
                    <div class="card">
                        <div id="headingTwo" class="card-header bg-white shadow-sm border-0">
                            <h2 class="mb-0">
                                <!-- Title -->
                                <button type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour" class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link" style="font-size:15px;font-weight:bold;">
                                    Collapsible Group Item #4
                                </button>
                            </h2>
                        </div>
                        <div id="collapseFour" aria-labelledby="headingFour" data-parent="#accordionExample" class="collapse">
                            <div class="card-body p-5">
                                <!-- Content -->
                                <p class="font-weight-light m-0">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                                </p>
                            </div>
                        </div>
                    </div><!-- End -->

                </div><!-- End -->
                </div>
                </div>
                <!-- End of accordian -->
                            
                    </div>	
                </div>	
            </div>	
            </div> 
            </div>
            <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js'></script>
            <script type='text/javascript'>

            // Change image
            function changeImage(element) {
                var main_prodcut_image = document.getElementById('main_product_image');
                main_prodcut_image.src = element.src;
            }

            // Buttons
            var add_cart_button = document.getElementById('add-to-cart');
            var item_existed = document.getElementById('item-existed');

                // Item Added Successfully
            add_cart_button.addEventListener('click',function(){
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Your product has been added',
                    showConfirmButton: false,
                    timer: 1500,
                    width: 500,
                    padding: '3em',
                })
                // Prevent add to cart again
                setTimeout('history.go(-1)', 1600);
            })

            // Item exist in cart
            item_existed.addEventListener('click',function(){
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'Item already in your cart',
                    showConfirmButton: false,
                    timer: 1500,
                    width: 400,
                    padding: '3em',
                })
                // Prevent add to cart again
                setTimeout('history.go(-1)', 1600);
            })
            
            </script>
                    
                    
            <?php require 'footer.html' ?>
        </body>
        </section>
        <script src="js/navbar-transition.js"></script>
    </html>