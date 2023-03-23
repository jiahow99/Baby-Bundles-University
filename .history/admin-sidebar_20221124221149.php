<!-- Sidebar  -->
<nav id="sidebar">
    <div class="sidebar-header">
        <h3>Baby Bundles</h3>
        <strong>BS</strong>
    </div>

    <ul class="list-unstyled components">
        <!-- Dashboard -->
        <li id="sidebar-dashboard">
            <a href="admin-dashboard.php">
                <i class="fas fa-briefcase"></i>
                <span id="dashboardlabel">Dashboard</span>
            </a>
        </li>
        <!-- Product -->
        <li id="sidebar-product">
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="bi bi-clipboard-heart"></i>
                <span id="productlabel">PRODUCT</span>
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
        <li id="sidebar-user">
            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <i class="fas fa-solid fa-user"></i>
                <span id="userlabel">USER</span>
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
        <li id="sidebar-order">
            <a href="admin-vieworder.php">
            <i class="bi bi-bag-fill"></i>
                <span id="orderlabel">ORDER</span>
            </a>
        </li>
        <!-- Account Info -->
        <li>
            <a href="account-info.php">
                <i class="bi bi-person-square"></i>
                <span id="accountlabel">ACCOUNT INFO</span>
            </a>
        </li>
        <!-- Back to home -->
        <li>
            <a href="index.php">
                <span id="logoutlabel">BACK TO HOME</span>
            </a>
        </li>
    </ul>
</nav>

<script>

  // Add 'active' class to navigation
  function activeNav(id){
    var nav = document.getElementById(id);
    nav.classList.add('active');
  }

  var title = document.title;

  switch(title){
    case 'Admin-Product':
      activeNav('sidebar-product');
      break;
    case 'Admin-User':
      activeNav('sidebar-user');
      break;
    case 'Admin-Order':
      activeNav('sidebar-order');
      break;
    case 'Admin-Dashboard':
      activeNav('sidebar-order');
      break;
  } 
</script>