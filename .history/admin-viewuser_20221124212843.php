<?php

// Start session
if(!isset($_SESSION)){
    session_start();
}

// Userid
if(isset($_GET['userid'])){
    $userid = $_GET['userid'];
}

// If button is pressed (edit/remove)
if(isset($_GET['action'])){

    switch ($_GET['action']) {
        // Edit User
        case 'edit':
            # Edit user goes here ...
            break;
        
        // Remove User
        case 'remove':
            # Remove user goes here ...
            break;
    }

}


?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Admin</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/admin.style.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" integrity="sha384-xeJqLiuOvjUBq3iGOjvSQSIlwrpqjSHXpduPd6rQpuiM3f5/ijby8pCsnbu5S81n" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    
    <!-- AJAX display all users -->
    <script>
            $(document).ready(function(){
                $.ajax({
                    url: "fetch_user.php",
                    type: "get",
                    dataType: "JSON",
                    success:function(user)
                    {
                        var len = user.length;
                        for(i=0 ; i<len; i++){
                            var str = '<div class="row bg-transparent rounded py-2 mb-2 user-row align-items-center">' +
                            '<div class="col-2 user">' + user[i].userid + '</div>' +
                            '<div class="col-2 user">' + user[i].username + '</div>' +
                            '<div class="col-4 user">+' + user[i].contact + '</div>' +
                            '<div class="col-4 user">' +
                            '<a href="admin-viewuser.php?action=edit&userid=' + user[i].userid + '" class="btn btn-primary mr-2">EDIT</a>' +
                            '<a href="admin-viewuser.php?action=remove&userid=' + user[i].userid + '" class="btn btn-primary">DELETE</a>' +
                            '</div></div>';

                            $('#users').append(str);
                        }
                    }
                });
            });

    </script>


</head>

<body>

    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Baby Bundles</h3>
                <strong>BS</strong>
            </div>

            <ul class="list-unstyled components">
                <!-- Dashboard -->
                <li>
                    <a href="#">
                        <i class="fas fa-briefcase"></i>
                        <span id="aboutlabel">Dashboard</span>
                    </a>
                </li>
                <!-- Product -->
                <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-home"></i>
                        <span id="homelabel">PRODUCT</span>
                    </a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="admin-addproduct.php">ADD PRODUCT</a>
                        </li>
                        <li>
                            <a href="admin-editproduct.php">DELETE PRODUCT</a>
                        </li>
                        <li>
                            <a href="admin-viewproduct.php">VIEW ALL</a>
                        </li>
                    </ul>
                </li>
                <!-- User -->
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-copy"></i>
                        <span id="pagelabel">USER</span>
                    </a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="#">ADD USER</a>
                        </li>
                        <li>
                            <a href="#">DELETE USER</a>
                        </li>
                        <li>
                            <a href="#">VIEW ALL</a>
                        </li>
                    </ul>
                </li>
                <!-- Order -->
                <li>
                    <a href="#">
                        <i class="fas fa-briefcase"></i>
                        <span id="aboutlabel">ORDER</span>
                    </a>
                </li>
                <!-- Account Info -->
                <li>
                    <a href="#">
                        <i class="fas fa-briefcase"></i>
                        <span id="aboutlabel">ACCOUNT INFO</span>
                    </a>
                </li>
                <!-- Log out -->
                <li>
                    <a href="logout.php">
                        <i class="fas fa-image"></i>
                        <span id="portfoliolabel">LOGOUT</span>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content" style="background-color:#F2F2F2">

            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid pl-0">

                    <button type="button" id="sidebarCollapse" class="btn-lg btn-primary">
                        <i class="fas fa-align-justify"></i>
                        <!-- <span>Toggle Sidebar</span> -->
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item dropdown mx-lg-3 col-2 col-lg-1" >
                                <a href="#" class="nav-link dropdown-toggle user-account text-black" id="userDropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php  
                                // Username
                                if(isset($_COOKIE['username'])){
                                    echo $_COOKIE['username'];
                                }
                                ?>
                                </a>
                                <div class="dropdown-menu text-sm " aria-labelledby="userDropdownMenuLink">
                                    <a href="account-info.php" class="dropdown-item">Account</a>
                                    <a href="index.php" class="dropdown-item">Back to home</a>
                                    <a href="logout.php" class="dropdown-item">Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Users Container -->
            <div class="container" id="users">
                <!-- Header -->
                <div class="row bg-secondary rounded py-3 mb-3">
                    <div class="col-2 text-white">ID</div>
                    <div class="col-2 text-white">Name</div>
                    <div class="col-4 text-white">Contact No</div>
                    <div class="col-4 text-white">Action</div>
                </div>

                <!-- Users Goes here (AJAX) -->
                
            </div>
            
    </div>

    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $('#homelabel').toggleClass('d-none');
                $('#aboutlabel').toggleClass('d-none');
                $('#pagelabel').toggleClass('d-none');
                $('#portfoliolabel').toggleClass('d-none');
                $('#faqlabel').toggleClass('d-none');
                $('#contactlabel').toggleClass('d-none');
            });
        });
    </script>
</body>

</html>