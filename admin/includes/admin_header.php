<?php
include 'auth.php';
checkAuth();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Restaurant</title>
    <link rel="stylesheet" href="../admin/css/admin_style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
</head>
<body>
    <header>
        <nav>
            <div class="admin-logo">Admin Panel</div>
            <ul>
                <li><a href="index.php">Dashboard</a></li>
                <li><a href="users.php">Users</a></li>
                <li><a href="menu.php">Menu</a></li>
                <li><a href="orders.php">Orders</a></li>
                <li><a href="reservations.php">Reservations</a></li>
                <li><a href="customers.php">Customers</a></li>
                <li><a href="inventory.php">Inventory</a></li>
                <li><a href="promotions.php">Promotions</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>