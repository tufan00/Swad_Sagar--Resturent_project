<?php
include './../includes/db_connect.php';
include 'includes/admin_header.php';

// Total Sales
$total_sales = $pdo->query("SELECT SUM(m.price) as total 
                            FROM orders o 
                            JOIN menu m ON o.item = m.name 
                            WHERE o.status = 'delivered'")->fetch();

// Total Orders
$total_orders = $pdo->query("SELECT COUNT(*) FROM orders")->fetchColumn();

// Popular Items
$popular_items = $pdo->query("SELECT o.item, COUNT(*) as count 
                              FROM orders o 
                              GROUP BY o.item 
                              ORDER BY count DESC 
                              LIMIT 5")->fetchAll();

// Peak Hours
$peak_hours = $pdo->query("SELECT HOUR(created_at) as hour, COUNT(*) as count 
                           FROM orders 
                           GROUP BY HOUR(created_at) 
                           ORDER BY count DESC 
                           LIMIT 3")->fetchAll();

// Export to PDF (basic implementation)
if (isset($_GET['export']) && $_GET['export'] == 'pdf') {
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="report.pdf"');
    echo "PDF Report Placeholder\n";
    echo "Total Sales: ₹" . ($total_sales['total'] ?? 0) . "\n";
    echo "Total Orders: " . $total_orders . "\n";
    exit;
}
?>

<section class="dashboard">
    <h2>Admin Dashboard</h2>
    <div class="stats">
        <div class="stat-card">
            <h3>Total Sales</h3>
            <p>₹<?php echo number_format($total_sales['total'] ?? 0, 2); ?></p>
        </div>
        <div class="stat-card">
            <h3>Total Orders</h3>
            <p><?php echo $total_orders; ?></p>
        </div>
        <div class="stat-card">
            <h3>Pending Orders</h3>
            <p><?php echo $pdo->query("SELECT COUNT(*) FROM orders WHERE status = 'pending'")->fetchColumn(); ?></p>
        </div>
        <div class="stat-card">
            <h3>Reservations Today</h3>
            <p><?php echo $pdo->query("SELECT COUNT(*) FROM reservations WHERE DATE(date) = CURDATE()")->fetchColumn(); ?></p>
        </div>
    </div>

    <div class="analytics">
        <h3>Popular Items</h3>
        <ul>
            <?php foreach($popular_items as $item): ?>
                <li><?php echo $item['item']; ?> (<?php echo $item['count']; ?> orders)</li>
            <?php endforeach; ?>
        </ul>

        <h3>Peak Hours</h3>
        <ul>
            <?php foreach($peak_hours as $hour): ?>
                <li><?php echo $hour['hour']; ?>:00 - <?php echo $hour['count']; ?> orders</li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="reports">
        <h3>Reports</h3>
        <a href="?export=pdf" class="btn">Download PDF Report</a>
        <a href="#" class="btn disabled">Download Excel Report</a>
    </div>
</section>

<?php include 'includes/admin_footer.php'; ?>