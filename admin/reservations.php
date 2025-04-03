<?php
include './../includes/db_connect.php';
include 'includes/admin_header.php';

// Check if the user has the 'admin' role or 'reservations' permission
checkRole('admin', 'reservations');

// Start session to manage success messages
// session_start();

// Define the allowed status progression
$status_progression = [
    'confirmed' => ['visited'],
    'visited' => ['completed'],
    'completed' => [] // No further transitions allowed
];

try {
    // Update reservation status
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reservation_id'])) {
        $reservation_id = $_POST['reservation_id'];
        $new_status = $_POST['status'];

        // Fetch the current status of the reservation
        $stmt = $pdo->prepare("SELECT status FROM reservations WHERE id = ?");
        $stmt->execute([$reservation_id]);
        $reservation = $stmt->fetch();

        if ($reservation) {
            $current_status = $reservation['status'];

            // Check if the new status is allowed
            if (in_array($new_status, $status_progression[$current_status] ?? [])) {
                // Get the current logged-in user's username (assuming it's stored in the session)
                $modified_by = $_SESSION['username'] ?? 'Unknown';

                // Update the status and modified_by
                $stmt = $pdo->prepare("UPDATE reservations SET status = ?, modified_by = ? WHERE id = ?");
                $stmt->execute([$new_status, $modified_by, $reservation_id]);

                // Set success message in session
                $_SESSION['success'] = "Reservation status updated successfully!";
            } else {
                $error = "Invalid status transition from $current_status to $new_status.";
            }
        } else {
            $error = "Reservation not found.";
        }

        // Redirect to clear POST data and prevent resubmission
        header("Location: reservations.php");
        exit;
    }

    // Fetch reservations with table information
    $stmt = $pdo->query("SELECT r.*, c.name as customer_name, t.table_number 
                         FROM reservations r 
                         LEFT JOIN customers c ON r.customer_id = c.id 
                         LEFT JOIN tables t ON r.table_id = t.id 
                         ORDER BY r.date DESC");
    $reservations = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
?>

<section class="reservations">
    <h2>Reservation Management</h2>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    <?php if (isset($_SESSION['success'])): ?>
        <script>alert("<?php echo $_SESSION['success']; ?>");</script>
        <?php unset($_SESSION['success']); // Clear the success message after displaying ?>
    <?php endif; ?>

    <table>
        <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Date</th>
            <th>Party Size</th>
            <th>Table</th>
            <th>Status</th>
            <th>Modified By</th>
            <th>Actions</th>
        </tr>
        <?php if (empty($reservations)): ?>
            <tr>
                <td colspan="8">No reservations found.</td>
            </tr>
        <?php else: ?>
            <?php foreach($reservations as $reservation): ?>
                <tr>
                    <td><?php echo $reservation['id']; ?></td>
                    <td><?php echo $reservation['customer_name'] ?? 'Guest'; ?></td>
                    <td><?php echo $reservation['date']; ?></td>
                    <td><?php echo $reservation['party_size']; ?></td>
                    <td><?php echo $reservation['table_number'] ?? 'Not Assigned'; ?></td>
                    <td><?php echo $reservation['status']; ?></td>
                    <td><?php echo $reservation['modified_by'] ?? 'N/A'; ?></td>
                    <td>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="reservation_id" value="<?php echo $reservation['id']; ?>">
                            <select name="status" onchange="this.form.submit()">
                                <option value="<?php echo $reservation['status']; ?>" selected><?php echo ucfirst($reservation['status']); ?></option>
                                <?php
                                // Only show allowed next statuses
                                $allowed_statuses = $status_progression[$reservation['status']] ?? [];
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