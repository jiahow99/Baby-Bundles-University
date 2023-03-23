<?php
session_start();

require_once('dbcontroller.php');
$db_controller = new DBController();

if(isset($_POST['confirm'])){
    
    $user_id =$_SESSION['userid'];
    $insert = "UPDATE login_table SET username='$tempname' WHERE userid=$user_id ";
    $result = $db_controller->insertQuery($insert);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Information</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    
    <!-- Custom Css -->
    <link rel="stylesheet" href="css/account-style.css">
    <link rel="stylesheet" href="css/header-style.css">
</head>
<body class="bg-image" style="background-image: url('img/baby-background.jpg');"> 
    <?php require 'header.php' ?>
    <section id="profile">
        <div class="container bg-light bg-opacity-50 pb-4" style="width:1000px">
            <!-- image row -->
            <div class="row row-info justify-content-center py-4">
                <div class="col-3 pt-3 info mb-3 ">
                    <h3>Edit Profile</h3>
                </div>

            </div>
            <!-- info row -->
            <div class="row row-info">
                <div class="col-3 pt-3 info">
                </div>
                <div class="col">
                    <div class="row mt-3">
                        <!-- username -->
                        <div class="col-4">
                            <div class="form-group">
                                <label for="name" class="row">Username</label>
                                <input type="text" class="input row" value="<?php if(isset($_COOKIE['username'])){ echo $_COOKIE['username'];} ?>">
                            </div>
                        </div>
                        <!-- email -->
                        <div class="col-5 ms-5">
                            <div class="form-group">
                                <label for="name" class="row">Email</label>
                                <input type="text" class="input row" value="<?php if(isset($_COOKIE['email'])){ echo $_COOKIE['email'];} ?>">
                            </div>
                        </div>
                    </div>
                    <!-- Contact and Gender -->
                    <div class="row mt-3">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="name" class="row">Contact No</label>
                                <input type="text" class="input row">
                            </div>
                        </div>
                        <div class="col-2 ms-5">
                            <div class="form-group">
                                <label for="name">Gender</label>
                                <select name="" class="form-select">
                                    <option value="">select</option>
                                    <option value="male">male</option>
                                    <option value="female">female</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Street -->
                    <div class="form-group mt-3">
                        <label for="address">Street Details</label>
                        <textarea name="address" class="input row" id="address" rows="3" cols="60"></textarea>
                    </div>
                    <!-- City and Zip -->
                    <div class="row mt-3">
                        <div class="col-2 form-group px-0">
                            <label for="city">City</label>
                            <input type="text" class="input" style="width:140px;">
                        </div>
                        <div class="col-2 form-group ms-5">
                            <label for="city">Zip Code</label>
                            <input type="text" class="input" style="width:80px;">
                        </div>
                    </div>
                    <div class="row col-3 mt-3 mb-5">
                        <label for="country">Country</label>
                        <input type="text" class="input">
                    </div>
                </div>
            </div>
            <!-- password row -->
            <div class="row row-info">
                <div class="col-3 info"></div>
                <div class="col">
                    <h5 class="mt-3 mb-5">EDIT PASSWORD</h5>
                    <div class="row my-4">
                        <div class="col-3"><label for="new_password">New Password:</label></div>
                        <div class="col-4"><input type="text" class="input"></div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-3"><label for="new_password">Confirm Password:</label></div>
                        <div class="col-4"><input type="text" class="input"></div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end mt-4">
                <div class="btn btn-primary">Save</div>
            </div>
        </div>
    </section>

    <?php require 'footer.html' ?>
</body>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="js/navbar-transition.js"></script>

</html>