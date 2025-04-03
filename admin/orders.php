<?php
include './../includes/db_connect.php';
include 'includes/admin_header.php';


// Check if the user has the 'admin' role or 'orders' permission
checkRole('admin', 'orders');

// Define the allowed status progression
$status_progression = [
    'pending' => ['accepted'],
    'accepted' => ['processing'],
    'processing' => ['delivered'],
    'delivered' => []
];

try {
    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_id'])) {
        $order_id = $_POST['order_id'];
        $new_status = $_POST['status'];
        $delivery_tracking = $_POST['delivery_tracking'] ?? null;

        // Fetch the current order to get its status and type
        $stmt = $pdo->prepare("SELECT status, type FROM orders WHERE id = ?");
        $stmt->execute([$order_id]);
        $order = $stmt->fetch();

        if ($order) {
            $current_status = $order['status'];
            $order_type = $order['type'];

            // Update status if it has changed and is a valid transition
            if ($new_status !== $current_status) {
                if (in_array($new_status, $status_progression[$current_status] ?? [])) {
                    $stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
                    $stmt->execute([$new_status, $order_id]);
                    $_SESSION['success'] = "Order status updated successfully!";
                } else {
                    $error = "Invalid status transition from $current_status to $new_status.";
                }
            }

            // Update delivery tracking if provided (for delivery orders only)
            if ($order_type === 'delivery' && $current_status !== 'delivered' && isset($_POST['delivery_tracking'])) {
                $stmt = $pdo->prepare("UPDATE orders SET delivery_tracking = ? WHERE id = ?");
                $stmt->execute([$delivery_tracking, $order_id]);
                $_SESSION['success'] = $_SESSION['success'] ?? "Delivery tracking updated successfully!";
            }
        } else {
            $error = "Order not found.";
        }

        // Redirect to clear POST data and prevent resubmission
        header("Location: orders.php" . ($filter ? "?filter=$filter" : ""));
        exit;
    }

    // Fetch orders with filtering
    $filter = isset($_GET['filter']) ? $_GET['filter'] : '';
    $query = "SELECT o.*, c.name as customer_name, m.price as item_price 
              FROM orders o 
              LEFT JOIN customers c ON o.customer_id = c.id 
              LEFT JOIN menu m ON o.item = m.name";
    if ($filter) {
        $query .= " WHERE o.status = :status";
    }
    $query .= " ORDER BY o.created_at DESC";
    $stmt = $pdo->prepare($query);
    if ($filter) {
        $stmt->bindParam(':status', $filter);
    }
    $stmt->execute();
    $orders = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
?>

<section class="orders">
    <h2>Order Management</h2>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    <?php if (isset($_SESSION['success'])): ?>
        <script>alert("<?php echo $_SESSION['success']; ?>");</script>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <select onchange="window.location='?filter='+this.value">
        <option value="">All</option>
        <option value="pending" <?php echo $filter == 'pending' ? 'selected' : ''; ?>>Pending</option>
        <option value="accepted" <?php echo $filter == 'accepted' ? 'selected' : ''; ?>>Accepted</option>
        <option value="processing" <?php echo $filter == 'processing' ? 'selected' : ''; ?>>Processing</option>
        <option value="delivered" <?php echo $filter == 'delivered' ? 'selected' : ''; ?>>Delivered</option>
    </select>
    <table>
        <tr>
            <th>Order ID</th>
            <th>Order Time</th>
            <th>Item</th>
            <th>Price (INR)</th>
            <th>Type</th>
            <th>Customer</th>
            <th>Status</th>
            <th>Delivery Tracking</th>
            <th>Actions</th>
        </tr>
        <?php if (empty($orders)): ?>
            <tr>
                <td colspan="9">No orders found.</td>
            </tr>
        <?php else: ?>
            <?php foreach($orders as $order): ?>
                <tr>
                    <td><?php echo $order['order_id']; ?></td>
                    <td><?php echo $order['created_at']; ?></td>
                    <td><?php echo $order['item']; ?></td>
                    <td>₹<?php echo number_format($order['item_price'] ?? 0, 2); ?></td>
                    <td><?php echo $order['type']; ?></td>
                    <td><?php echo $order['customer_name'] ?? 'Guest'; ?></td>
                    <td><?php echo $order['status']; ?></td>
                    <td>
                        <?php if ($order['type'] == 'delivery' && $order['status'] != 'delivered'): ?>
                            <?php if (empty($order['delivery_tracking'])): ?>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                    <input type="text" name="delivery_tracking" value="<?php echo $order['delivery_tracking'] ?? ''; ?>" placeholder="Tracking Info">
                                    <input type="hidden" name="status" value="<?php echo $order['status']; ?>">
                                    <button type="submit">Update</button>
                                </form>
                            <?php else: ?>
                                <span><?php echo $order['delivery_tracking']; ?></span>
                            <?php endif; ?>
                        <?php else: ?>
                            <span><?php echo $order['status'] == 'delivered' ? ($order['delivery_tracking'] ?? 'N/A') : 'N/A (Dine-In)'; ?></span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                            <select name="status" onchange="this.form.submit()">
                                <option value="<?php echo $order['status']; ?>" selected><?php echo ucfirst($order['status']); ?></option>
                                <?php
                                $allowed_statuses = $status_progression[$order['status']] ?? [];
                                foreach ($allowed_statuses as $next_status):
                                ?>
                                    <option value="<?php echo $next_status; ?>"><?php echo ucfirst($next_status); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</section>

<?php include 'includes/admin_footer.php'; ?>