<?php

require_once('dbcontroller.php');

$dbcontroller = new DBController();

// Get products in the cart
$products = $dbcontroller->selectSingleProduct("SELECT * FROM shopping_cart_table WHERE userid='$userid'");

// Explode into array
$items_array = explode(',',$products['product']);

// Item quantity
$quantity = count($items_array);
$totalPrice = 0;

// Get Total Price
foreach ($items_array as $product) {
    $query = "SELECT * FROM product_table WHERE product_id='$product'";
    $product = $dbcontroller->selectSingleProduct($query);

    $totalPrice += floatval($product['price']);
}

// Convert to 2 decimal places
$totalPrice = number_format($totalPrice, 2, '.', '');

echo $totalPrice;

?>