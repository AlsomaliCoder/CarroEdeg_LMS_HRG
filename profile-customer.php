<?php
    include_once 'functions/authentication.php';
    include_once 'functions/connection.php';
    if(!isset($_GET['id'])){
        header('Location: customers.php?type=error&message=Customer not found!');
    }
    $customer_id = $_GET['id'];
$sql = 'SELECT t.id, t.total, t.created_at, u.username, c.fullname 
    FROM transactions AS t 
    JOIN customers AS c ON t.customer_id = c.id
    JOIN users AS u ON t.user_id = u.id 
    WHERE t.status = "completed" AND customer_id = :id';
$stmt = $db->prepare($sql);
$stmt->bindParam(':id', $customer_id);
$stmt->execute();
$results = $stmt->fetchAll();

$sql = 'SELECT fullname 
        FROM customers 
        WHERE id = :id';
$stmt = $db->prepare($sql);
$stmt->bindParam(':id', $customer_id);
$stmt->execute();
$info = $stmt->fetch();
$customer_fullname = $info['fullname'];

?>

<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Profile - CarroEdeg Laundry</title>
    <link rel="shortcut icon" href="assets/img/carro-edeg-logo.png" type="image/gif">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/bs-theme-overrides.css">
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap5.min.css">
</head>
<style>
    body {
        background-color: #f3fdf4;
    }

    .navbar, .sidebar {
        background-color: #a5d6a7 !important;
    }

    .topbar {
        background-color: #e8f5e9 !important;
    }

    .text-primary {
        color: #388e3c !important;
    }

    .btn-primary {
        background-color: #4CAF50 !important;
        border-color: #4CAF50 !important;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #388e3c !important;
        transform: scale(1.02);
    }

    .card {
        border-radius: 12px;
        transition: all 0.3s ease-in-out;
    }

    .card:hover {
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        transform: translateY(-5px);
    }

    .table thead {
        background-color: #c8e6c9;
        color: #2e7d32;
    }

    table tr:hover {
        background-color: #f1f8e9;
        transition: background-color 0.2s ease;
    }

    .rounded-circle {
        border: 2px solid #4CAF50;
    }

    a.text-decoration-none {
        color: #2e7d32;
        transition: color 0.3s ease;
    }

    a.text-decoration-none:hover {
        color: #1b5e20;
    }

    .scroll-to-top {
        background-color: #81c784 !important;
        color: white !important;
    }

    .scroll-to-top:hover {
        background-color: #66bb6a !important;
    }

    .sticky-footer {
        background-color: #f1f8e9;
    }

    .dataTables_wrapper .btn-primary {
        background-color: #66bb6a !important;
        border: none;
    }

    .dataTables_wrapper .btn-primary:hover {
        background-color: #43a047 !important;
    }

    .modal-content {
        border-radius: 10px;
    }

    .form-control:focus {
        border-color: #4CAF50;
        box-shadow: 0 0 0 0.2rem rgba(76, 175, 80, 0.25);
    }
</style>


<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion p-0 toggled" style="background: var(--bs-primary-text-emphasis);">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="index.php">
                    <div class="sidebar-brand-icon rotate-n-15"><img class="rounded-circle" src="assets/img/carro-edeg-logo.png" width="60" height="60"></div>
                    <div class="sidebar-brand-text mx-3"><span>CARROEDEG Laundry</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <?php
                        include_once 'functions/views/navbar.php';
                    ?>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small">My Account</span><i class="far fa-user"></i></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="profile.php"><i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Settings</a><a class="dropdown-item <?php if($_SESSION['level'] == '1'){echo 'd-none';}?>" href="logs.php"><i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Activity log</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="functions/logout.php"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                
                <div class="container-fluid">
                    <h3 class="text-dark mb-4"><strong><?php echo $customer_fullname ?></strong> Transactions</h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Transactions</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table mt-2" role="grid" aria-describedby="dataTable_info">
                                <table class="table table-striped my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Customer</th>
                                            <th>User</th>
                                            <th>Total</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                                                                    
                                        foreach ($results as $row) {
                                            echo '<tr>';
                                            echo '<td><a class="mx-1 text-decoration-none" target="_blank" href="receipt?id='.$row['id'].'&type=view"><i class="fas fa-print" style="font-size: 20px;"></i> '.$row['id'].'</a></td>';
                                            echo '<td><img class="rounded-circle me-2" width="30" height="30" src="assets/img/profile.png">' . $row['fullname'] . '</td>';
                                            echo '<td><img class="rounded-circle me-2" width="30" height="30" src="assets/img/profile.png">' . $row['username'] . '</td>';
                                            echo '<td>$' . number_format($row['total'], 2) . '</td>';
                                            echo '<td>' . $row['created_at'] . '</td>';
                                            echo '</tr>';
                                        }
                                        
                                        ?>
                                    </tbody>
                                    <tfoot>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © CARROEDEG&nbsp;2025</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>

    <?php
        include_once 'functions/modals/transaction-modal.php';
    ?>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap5.min.js"></script>
    <script src="assets/js/dataTables.buttons.min.js"></script>
    <script src="assets/js/jszip.min.js"></script>
    <script src="assets/js/pdfmake.min.js"></script>
    <script src="assets/js/vfs_fonts.js"></script>
    <script src="assets/js/buttons.html5.min.js"></script>
    <script src="assets/js/buttons.print.min.js"></script>
    <script src="assets/js/listTable.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>
    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const type = urlParams.get('type');
        const message = urlParams.get('message');
        if (type == 'success') {
            swal("Success!", message, "success");
        } else if (type == 'error') {
            swal("Error!", message, "error");
        }
        
    </script>
</body>

</html>