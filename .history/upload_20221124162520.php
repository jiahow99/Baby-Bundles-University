<?php


echo basename($_FILES['product_image']['name']);

echo "123";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <input type="file" name="product_image" id="product_image">
        <button type="submit">SUbmit</button>
    </form>
</body>
</html>