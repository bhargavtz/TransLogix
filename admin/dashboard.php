<?php
session_start();

if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    header('location: ../login.php');
    exit;
}

require_once '../config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - TransLogix</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #667eea;
            --secondary-color: #764ba2;
            --background-light: #f8f9fa;
            --text-dark: #2d3748;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--background-light);
            color: var(--text-dark);
        }

        .navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            padding: 1rem 2rem;
        }

        .navbar-brand, .nav-link {
            color: white !important;
        }

        .dashboard-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            margin-bottom: 20px;
            overflow: hidden;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 1rem;
            font-weight: bold;
        }

        .card-body {
            padding: 1.5rem;
        }

        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: var(--primary-color);
        }

        .btn-custom {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            color: white;
        }

        @media (max-width: 768px) {
            .dashboard-card {
                margin-bottom: 15px;
            }
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 transition-colors duration-200">
    <?php include '../navbar.php'; ?>
        <a class="navbar-brand" href="#">TransLogix Admin</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Settings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <h2 class="mb-4">Welcome, <?php echo htmlspecialchars($_SESSION['admin_username']); ?>!</h2>
        
        <div class="row">
            <!-- User Management -->
            <div class="col-md-6 col-lg-4">
                <div class="dashboard-card">
                    <div class="card-header">
                        <i class="fas fa-users mr-2"></i>User Management
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <div class="stat-icon">
                                <i class="fas fa-user-cog"></i>
                            </div>
                            <h4>Total Users</h4>
                            <p class="h2 mb-4">150</p>
                            <a href="users.php" class="btn btn-custom">Manage</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shipment Tracking -->
            <div class="col-md-6 col-lg-4">
                <div class="dashboard-card">
                    <div class="card-header">
                        <i class="fas fa-shipping-fast mr-2"></i>Shipments
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <div class="stat-icon">
                                <i class="fas fa-truck"></i>
                            </div>
                            <h4>Active Shipments</h4>
                            <p class="h2 mb-4">45</p>
                            <a href="shipments.php" class="btn btn-custom">Manage</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reports -->
            <div class="col-md-6 col-lg-4">
                <div class="dashboard-card">
                    <div class="card-header">
                        <i class="fas fa-chart-bar mr-2"></i>Reports
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <div class="stat-icon">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <h4>Monthly Stats</h4>
                            <p class="mb-4">View detailed reports</p>
                            <a href="reports.php" class="btn btn-custom">View Report</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION["admin_username"]); ?>!</h2>
    
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">User Management</h5>
                    <p class="card-text">View and manage user information</p>
                    <a href="users.php" class="btn btn-primary">View Users</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tracking Management</h5>
                    <p class="card-text">Manage shipment tracking</p>
                    <a href="tracking.php" class="btn btn-primary">View Tracking</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Reports</h5>
                    <p class="card-text">Generate system reports</p>
                    <a href="reports.php" class="btn btn-primary">View Reports</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>