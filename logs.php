<?php
    include_once 'functions/authentication.php';
    if ($_SESSION['level'] == 1){
        header('Location: index.php?type=error&message=You are not allowed to access this page.');
    }
?>

<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Logs - CarroEdeg Laundry</title>
    <link rel="shortcut icon" href="assets/img/carro-edeg-logo.png" type="image/gif">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="assets/css/custom.css">
</head>
<style>
    body {
        background-color: #f4fbf4;
    }

    .sidebar {
        background-color: #81c784 !important;
    }

    .sidebar .nav-link,
    .sidebar .navbar-brand {
        color: #ffffff !important;
    }

    .sidebar .nav-link.active {
        background-color: #66bb6a !important;
    }

    .navbar {
        background-color: #e8f5e9 !important;
    }

    .topbar {
        background-color: #c8e6c9 !important;
    }

    .topbar .nav-link,
    .topbar .dropdown-menu {
        color: #2e7d32 !important;
    }

    .dropdown-menu {
        border-radius: 0.5rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .dropdown-item:hover {
        background-color: #a5d6a7 !important;
    }

    .btn-primary {
        background-color: #4caf50 !important;
        border-color: #4caf50 !important;
        transition: all 0.3s ease-in-out;
    }

    .btn-primary:hover {
        background-color: #388e3c !important;
        transform: scale(1.03);
    }

    .card {
        border-radius: 12px;
        border: none;
    }

    .card-header.bg-primary {
        background-color: #4caf50 !important;
    }

    .table thead.table-dark {
        background-color: #2e7d32 !important;
        color: #ffffff;
    }

    .table-hover tbody tr:hover {
        background-color: #e8f5e9;
    }

    .table td,
    .table th {
        vertical-align: middle;
    }

    .sticky-footer {
        background-color: #e8f5e9;
        color: #2e7d32;
        font-weight: 500;
    }

    .scroll-to-top {
        background-color: #66bb6a !important;
        color: white !important;
    }

    .scroll-to-top:hover {
        background-color: #43a047 !important;
    }

    .swal-button {
        background-color: #4caf50 !important;
    }

    .swal-button:hover {
        background-color: #388e3c !important;
    }
</style>


<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark sidebar sidebar-dark accordion p-0 toggled bg-primary">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex align-items-center m-0 p-3" href="index.php">
                    <img class="rounded-circle" src="assets/img/carro-edeg-logo.png" width="50" height="50">
                    <span class="fw-bold ms-2 text-light">CarroEdeg Laundry </span>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light">
                    <?php include_once 'functions/views/navbar.php'; ?>
                </ul>
                <div class="text-center d-none d-md-inline">
                    <button class="btn btn-outline-light rounded-circle border-0" id="sidebarToggle" type="button"><i class="fa fa-bars"></i></button>
                </div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid">
                        <button class="btn btn-primary d-md-none rounded-circle me-3" id="sidebarToggleTop"><i class="fas fa-bars"></i></button>
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                    <span class="text-gray-600">My Account</span> <i class="far fa-user"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="profile.php"><i class="fas fa-cogs me-2"></i> Settings</a>
                                    <a class="dropdown-item <?php if($_SESSION['level'] == '1'){echo 'd-none';}?>" href="logs.php"><i class="fas fa-list me-2"></i> Activity Log</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="functions/logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Activity Logs</h3>
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white">
                            <h5 class="m-0 fw-bold">Transactions</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped" id="dataTable">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>User</th>
                                            <th>Type</th>
                                            <th>Logs</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php include_once 'functions/views/activity.php'; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer text-center py-3">
                <span>Copyright &copy; CARROEDEG 2025</span>
            </footer>
        </div>
    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap5.min.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "paging": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
        });

        const urlParams = new URLSearchParams(window.location.search);
        const type = urlParams.get('type');
        const message = urlParams.get('message');
        if (type && message) {
            swal({
                title: type.charAt(0).toUpperCase() + type.slice(1) + "!",
                text: message,
                icon: type,
                button: "OK",
            });
        }
    </script>
</body>

</html>
