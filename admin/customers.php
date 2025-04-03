<?php
include '../includes/db_connect.php';
include 'includes/admin_header.php';

$stmt = $pdo->query("SELECT * FROM customers");
$customers = $stmt->fetchAll();
?>

<section class="customers">
    <h2>Customer Management</h2>
    <table>
        <tr><th>ID</th><th>Name</th><th>Email</th><th>Points</th></tr>
        <?php foreach($customers as $c): ?>
            <tr>
                <td><?php echo $c['id']; ?></td>
                <td><?php echo $c['name']; ?></td>
                <td><?php echo $c['email']; ?></td>
                <td><?php echo $c['loyalty_points']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</section>
<?php include 'includes/admin_footer.php'; ?>