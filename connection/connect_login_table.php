<?php 
$host = 'localhost';
$db = 'babybundles_database';
$user= 'root';
$pass = '';
$attr = "mysql:host=$host;dbname=$db";
$table = 'login_table';
$opts =
[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
]

?>