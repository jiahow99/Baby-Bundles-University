<nav class="navbar navbar-expand-lg navbar-light bg-admin">
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
                    <a href="#" class="nav-link dropdown-toggle user-account text-white" id="userDropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php  
                    // Username
                    if(isset($_COOKIE['username'])){
                        echo $_COOKIE['username'];
                    }
                    ?>
                    </a>
                    <div class="dropdown-menu text-sm" style="z-index:1000;position:absolute" aria-labelledby="userDropdownMenuLink">
                        <a href="account-info.php" class="dropdown-item">Account</a>
                        <a href="index.php" class="dropdown-item">Back to home</a>
                        <a href="logout.php" class="dropdown-item">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>