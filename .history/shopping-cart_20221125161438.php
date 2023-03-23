<?php
require_once('dbcontroller.php');
$db_controller = new DBController();

// Start session
if(!isset($_SESSION)){
    session_start();
}


// Get products
$listproduct = $_SESSION['products'];
$listproductstr = implode(',', $listproduct);

// Get Userid
$userid = $_COOKIE['userid'];
$dbcontroller = new DBController();

$select_cart = "SELECT * FROM shopping_cart_table WHERE userid='$userid'";

// Get products in the cart
$products = $dbcontroller->selectSingleProduct($select_cart);

$num_rows = $db_controller->numRows($select_cart);

if($num_rows > 0){
    // Explode into array
$items_array = explode(',',$products['product']);

// Item quantity
$quantity = count($items_array);
$totalPrice = 0;


// Get Total Price
if(isset($products)){
    foreach ($items_array as $product) {
        $query = "SELECT * FROM product_table WHERE product_id='$product'";
        $product = $dbcontroller->selectSingleProduct($query);
    
        $totalPrice += floatval($product['price']);
    }
}
// Convert to 2 decimal places
$totalPrice = number_format($totalPrice, 2, '.', '');
}





if(isset($_GET['action'])){

    // Get ProductID
    if(isset($_GET['id'])){
        $productid = $_GET['id'];
    }

    switch ($_GET['action']) {

        // Remove item from cart
        case 'remove':
            if(in_array($productid, $items_array)){
                // Get index
                $index = array_search($productid, $items_array);

                // Remove item from array
                unset($items_array[$index]);

                // New item array
                $new_items_array = implode(',', $items_array);

                // Update database
                $query = "UPDATE shopping_cart_table SET product='$productlist' WHERE userid='$userid'";
                $dbcontroller->updateCart($query);

                // Update cart items
                $listproduct = $_SESSION['products'];
                $listproductstr = implode(',', $listproduct);

                header("Refresh:0");
            }
            break;
        
        case 'placeorder':

            $listproduct = $_GET['item_list'];
            $insert = "INSERT INTO order_table(userid,product,total_price) VALUES('$userid','$listproduct','$totalPrice')";
            $result = $db_controller->insertQuery($insert);

            // Empty cart after place order
            $empty_cart = "DELETE FROM shopping_cart_table WHERE userid='$userid'";
            $delete_result = $dbcontroller->deleteQuery($empty_cart);

            break;
    }
}


?>



<!doctype html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>Shopping Cart</title>
        <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
        <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
        <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        
        <link rel="stylesheet" href="css/shopping-cart.css">
        <link rel="stylesheet" href="css/header-style.css">

        <!-- JQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

        <!-- Displaying all products -->
        <script>
            $(document).ready(function(){
                $.ajax({
                    url: "fetch_shopping_cart.php",
                    type: "get",
                    dataType: "JSON",
                    success:function(product)
                    {
                        var len = product.length;
                        for(i=0 ; i<len; i++){
                            var str = '<div class="row border-bottom">' + '<div class="row main align-items-center">' +
                            '<div class="col-2"><img class="img-fluid" src="' + product[i].image +  '"></div>' +
                            '<div class="col"><div class="row text-muted">' + product[i].category  +  '</div><div class="row">' + product[i].title +  '</div></div>' +
                            '<div class="col"><span>1</span></div>' + '<div class="col price-label">RM ' + product[i].price + '<a  href="shopping-cart.php?action=remove&id=' + product[i].product_id + '"class="close">&#10005;</a>' +
                            '</div></div></div>';

                            var backToHome = '<div class="back-to-shop"><a href="shopping-page.php">&leftarrow;<span class="text-muted ml-1">Back to shop</span></a></div>';
                            var totalPrice = 0;

                            $('#shopping-cart').append(str);
                        }
                        $('#shopping-cart').append(backToHome);
                    }
                });
            });
        </script>
    </head>


    <body>
    <?php require 'header.php' ?>
        
        <!-- Container -->
        <div class="card mt-6" >
            <div class="row">
                <div class="col-md-8 cart" id="shopping-cart">
                    <div class="title">
                        <!-- Header -->
                        <div class="row">
                            <div class="col"><h4><b>Shopping Cart</b></h4></div>
                            <!-- Total item quantity -->
                            <div class="col align-self-center text-right text-muted"><?php if(isset($quantity)){echo $quantity;}else{echo '0'} ?> items</div>
                        </div>
                    </div>

                    <div class="row border-top"></div>

                </div>
                <div class="col-md-4 summary">
                    <div><h5><b>Summary</b></h5></div>
                    <hr>
                    <div class="row">
                        <!-- Total Item Quantity -->
                        <div class="col text-lg">Quantity : <?php echo $quantity ?></div>
                    </div>
                    <form method="post" action="checkout.php">
                        <p>SHIPPING</p>
                        <select ><option class="text-muted">Standard-Delivery- &euro;5.00</option></select>
                        <p  style="margin-top:23px;">PROMO CODE</p>
                        <input id="code" placeholder="Enter your code">
                    </form>
                    <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                        <div class="col">TOTAL PRICE</div>
                        <div id="total-price" class="col text-right" style="font-size:20px;">RM <?php echo $totalPrice; ?></div>
                    </div>
                    <a href="shopping-cart.php?action=placeorder&item_list=<?php echo $products['product'] ?>">
                        <button type="submit" class="btnn">Place Order</button>
                    </a>
                </div>
            </div>
        </div>
        <?php require 'footer.html' ?>
    </body>
    <script src="js/navbar-transition.js"></script>

    
</html>