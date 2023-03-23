<?php
session_start();

require_once('dbcontroller.php');
$dbcontroller = new DBController();

$user_id =$_SESSION['userid'];
$result = $dbcontroller->selectUser("SELECT * FROM login_table WHERE userid='$user_id'");


if(isset($_POST['update'])){


    // inputs
    $username = $dbcontroller->sanitise($_POST['username']);
    $email = $dbcontroller->sanitise($_POST['email']);
    $contact = $dbcontroller->sanitise($_POST['contact']);
    $location = $dbcontroller->sanitise($_POST['location']);
    $gender =$dbcontroller->sanitise($_POST['gender']);
    
    // pattern
    $username_pattern = "/^[0-9a-zA-Z-'_ ]{4,10}$/";
    $password_pattern = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/"; 
    $phone_pattern = "/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{3,10}$/"; 

    // username validate
    $username_err = array();
    $username = trim($username);
    $username = $dbcontroller->sanitise($username);

    // email pattern validate 
    if(!filter_var( $email, FILTER_VALIDATE_EMAIL )){
        array_push($email_err, "Please enter a valid email");
        $_SESSION['email_err'] = $errormsg['email'] = $email_err;
    }

    if(!preg_match( $username_pattern, $username )){
        $username_err = array_push($username_err, "Only letters and digits are allowed and ATLEAST 4 MAX 10 characters");
        $errormsg['username'] = $username_err;
    }

    // contact validate
    if(!preg_match( $phone_pattern, $contact )){
        $_SESSION['contact_err'] = $errormsg['contact'] = "Please enter valid phone number";
    }

    if(!empty($errormsg)){
        $insert = "UPDATE login_table SET username='$username', email='$email', contact='$contact', location='$location', gender='$gender' WHERE userid='$userid'";
        $result = $dbcontroller->insertQuery($insert);
        if($result){
            die(header("Location:index.php"));
        }
    }
    
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
        <form class="container bg-light bg-opacity-50 pb-4" style="width:1000px" method="post">
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
                                <input type="text" class="input row" name="username" value="<?php if(isset($_COOKIE['username'])){ echo $_COOKIE['username'];} ?>">
                            </div>
                        </div>
                        <!-- email -->
                        <div class="col-5 ms-5">
                            <div class="form-group">
                                <label for="name" class="row">Email</label>
                                <input type="text" class="input row" name="email" value="<?php if(isset($_SESSION['email'])){ echo $_SESSION['email'];} ?>">
                            </div>
                        </div>
                    </div>
                    <!-- Contact and Gender -->
                    <div class="row mt-3">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="name" class="row">Contact No</label>
                                <input type="text" class="input row" name="contact" value="<?php if(isset($_SESSION['contact'])){ echo $_SESSION['contact'];} ?>">
                            </div>
                        </div>
                        <div class="col-2 ms-5">
                            <div class="form-group">
                                <label for="name">Gender</label>
                                <select name="gender" class="form-select" required>
                                    <option value="null">select</option>
                                    <option value="male" <?php if($result['gender']=="male"){ echo "selected";} ?>>male</option>
                                    <option value="female"<?php if($result['gender']=="female"){ echo "selected";} ?>>female</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Street -->
                    <div class="form-group my-3">
                        <label for="location">Location</label>
                        <textarea name="location" class="input row" id="location" rows="3" cols="60"><?php echo $result['location'] ?></textarea>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end mt-4">
                <button type="submit" name="update" class="btn btn-primary">Save</button>
            </div>
        </form>
    </section>

    <?php require 'footer.html' ?>
</body>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="js/navbar-transition.js"></script>

</html>