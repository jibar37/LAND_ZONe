<nav class="navbar navbar-dark sticky-top bg-white flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0 text-secondary font-weight-bold" href="#">LAND ZONe</a>

    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3">
        <a class="nav-link" href="#">
            <span data-feather="users"></span>
            <?php echo ($this->session->userdata('nama')); ?>
        </a>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="btn text-danger btn-outline-danger" href=<?php echo base_url("admin/signOut") ?>>Sign out</a>
            </li>
        </ul>
    </div>

</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href=<?php echo base_url("admin") ?>>
                            <span data-feather="home"></span>
                            Dashboard <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="edit"></span>
                            Edit
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="shopping-cart"></span>
                            Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="users"></span>
                            Customers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="bar-chart-2"></span>
                            Reports
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="layers"></span>
                            Integrations
                        </a>
                    </li>
                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>User Setting</span>
                    <a class="d-flex align-items-center text-muted">
                        <span data-feather="tool"></span>
                    </a>
                </h6>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link" href=<?php echo (base_url('admin/tambahUser')) ?>>
                            <span data-feather="user-plus"></span>
                            Tambah User
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href=<?php echo (base_url('admin/editUser')) ?>>
                            <span data-feather="edit"></span>
                            Edit User
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href=<?php echo (base_url('admin/deleteUser')) ?>>
                            <span data-feather="user-minus"></span>
                            Hapus User
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href=<?php echo (base_url('admin/banUser')) ?>>
                            <span data-feather="user-x"></span>
                            BAN User
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href=<?php echo (base_url('admin/unbanUser')) ?>>
                            <span data-feather="user-check"></span>
                            UNBAN User
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href=<?php echo (base_url('admin/forceLogout')) ?>>
                            <span data-feather="log-out"></span>
                            Force Logout
                        </a>
                    </li>

                </ul>
            </div>
        </nav>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                <h1 class="h2 font-weight-bold text-secondary"><?php echo $menu ?></h1>