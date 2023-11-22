<?php
$page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1);
?>

<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link <?= $page == 'index.php' ? 'active' : '' ?>" href="index.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <a class="nav-link <?= $page == 'order-create.php' ? 'active' : '' ?>" href="order-create.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-bell"></i></div>
                    Create Order
                </a>
                <a class="nav-link <?= $page == 'orders.php' ? 'active' : '' ?>" href="orders.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                    Orders
                </a>
                <div class="sb-sidenav-menu-heading">Interface</div>
                <a class="nav-link <?= ($page == 'category-create.php') || ($page == 'categories.php') ? 'collapse active' : 'collapsed' ?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCategories" aria-expanded="false" aria-controls="collapseCategories">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Categories
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse <?= ($page == 'category-create.php') || ($page == 'categories.php') ? 'show' : '' ?>" id="collapseCategories" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link <?= $page == 'category-create.php' ? 'active' : '' ?>" href="category-create.php">Add Catgeory</a>
                        <a class="nav-link <?= $page == 'categories.php' ? 'active' : '' ?>" href="categories.php">View Categories</a>
                    </nav>
                </div>

                <a class="nav-link <?= ($page == 'product-create.php') || ($page == 'products.php') ? 'collapse active' : 'collapsed' ?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProducts" aria-expanded="false" aria-controls="collapseProducts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Products
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse <?= ($page == 'product-create.php') || ($page == 'products.php') ? 'show' : '' ?>" id="collapseProducts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link <?= $page == 'product-create.php' ? 'active' : '' ?>" href="product-create.php">Add Product</a>
                        <a class="nav-link <?= $page == 'products.php' ? 'active' : '' ?>" href="products.php">View Products</a>
                    </nav>
                </div>

                <div class="sb-sidenav-menu-heading">Manage Users</div>
                <a class="nav-link <?= ($page == 'customer-create.php') || ($page == 'customers.php') ? 'collapse active' : 'collapsed' ?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCustomers" aria-expanded="false" aria-controls="collapseCustomers">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Customers
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse <?= ($page == 'customer-create.php') || ($page == 'customers.php') ? 'show' : '' ?>" id="collapseCustomers" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link <?= $page == 'customer-create.php' ? 'active' : '' ?>" href="customer-create.php">Add Customer</a>
                        <a class="nav-link <?= $page == 'customers.php' ? 'active' : '' ?>" href="customers.php">View Customers</a>
                    </nav>
                </div>

                <a class="nav-link <?= ($page == 'admin-create.php') || ($page == 'admins.php') ? 'collapse active' : 'collapsed' ?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAdmins" aria-expanded="false" aria-controls="collapseAdmins">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Admins
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse <?= ($page == 'admin-create.php') || ($page == 'admins.php') ? 'show' : '' ?>" id="collapseAdmins" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link <?= $page == 'admin-create.php' ? 'active' : '' ?>" href="admin-create.php">Add Admin</a>
                        <a class="nav-link <?= $page == 'admins.php' ? 'active' : '' ?>" href="admins.php">View Admins</a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            <?= ($_SESSION['loggedInUser']['name']) ?>
        </div>
    </nav>
</div>