<?php
require_once('dbcontroller.php');

$dbcontroller = new DBController();

// Userid
$userid = $_COOKIE['userid'];

// Select Current User
$user = $dbcontroller->selectUser("SELECT * FROM login_table WHERE userid='$userid'");

// Admin auth
if(!$dbcontroller->admin_auth($user)){
    die(header("Location:index.php"));
}

?>