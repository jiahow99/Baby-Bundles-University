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
                            <a href="#">ADD PRODUCT</a>
                        </li>
                        <li>
                            <a href="#">DELETE PRODUCT</a>
                        </li>
                        <li>
                            <a href="#">VIEW ALL</a>
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
                    <a href="#">
                        <i class="fas fa-image"></i>
                        <span id="portfoliolabel">LOGOUT</span>
                    </a>
                </li>
            </ul>

            
        </nav>

        <!-- Page Content  -->
        <div id="content" style="background-color:#F2F2F2">
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
                            <li class="nav-item active">
                                <a class="nav-link" href="#">Page</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Page</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Page</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Page</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <form class="container glass" id="edit-product">
                <div class="row justify-content-center">
                    <img src="img/top/top01.jpg" alt="" width="280px" class="rounded my-3">
                </div>
                <hr>
            </form>
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