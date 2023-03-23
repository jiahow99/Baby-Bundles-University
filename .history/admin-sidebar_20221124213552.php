<!-- Sidebar  -->
<nav id="sidebar">
<div class="sidebar-header">
    <h3>Baby Bundles</h3>
    <strong>BS</strong>
</div>

<ul class="list-unstyled components">
    <!-- Dashboard -->
    <li>
        <a href="admin-dashboard.php">
            <i class="fas fa-briefcase"></i>
            <span id="aboutlabel">Dashboard</span>
        </a>
    </li>
    <!-- Product -->
    <li>
        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <i class="fas fa-home"></i>
            <span id="homelabel">PRODUCT</span>
        </a>
        <ul class="collapse list-unstyled" id="homeSubmenu">
            <li>
                <a href="admin-addproduct.php">ADD PRODUCT</a>
            </li>
            <li>
                <a href="admin-viewproduct.php">DELETE PRODUCT</a>
            </li>
            <li>
                <a href="admin-viewproduct.php">VIEW ALL</a>
            </li>
        </ul>
    </li>
    <!-- User -->
    <li class="active">
        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <i class="fas fa-copy"></i>
            <span id="pagelabel">USER</span>
        </a>
        <ul class="collapse list-unstyled" id="pageSubmenu">
            <li>
                <a href="admin-adduser.php">ADD USER</a>
            </li>
            <li>
                <a href="admin-viewuser.php">DELETE USER</a>
            </li>
            <li>
                <a href="admin-viewuser.php">VIEW USERS</a>
            </li>
        </ul>
    </li>
    <!-- Order -->
    <li>
        <a href="admin-vieworder.php">
            <i class="fas fa-briefcase"></i>
            <span id="aboutlabel">ORDER</span>
        </a>
    </li>
    <!-- Account Info -->
    <li>
        <a href="account-info.php">
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