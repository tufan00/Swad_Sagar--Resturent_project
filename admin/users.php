<?php
include './../includes/db_connect.php';
include 'includes/admin_header.php';

// Check if the user has the 'admin' role
checkRole('admin');

try {
    // Add a new user
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_user'])) {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $role = $_POST['role'];
        $permissions = implode(',', $_POST['permissions'] ?? []);

        $stmt = $pdo->prepare("INSERT INTO users (username, password, role, permissions) VALUES (?, ?, ?, ?)");
        $stmt->execute([$username, $password, $role, $permissions]);
        $success = "User '$username' added successfully!";
    }

    // Delete a user
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $stmt = $pdo->prepare("SELECT username FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch();

        if ($user) {
            $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
            $stmt->execute([$id]);
            $success = "User '{$user['username']}' deleted successfully!";
        } else {
            $error = "User not found.";
        }
    }

    // Fetch all users
    $stmt = $pdo->query("SELECT * FROM users");
    $users = $stmt->fetchAll();
} catch (PDOException $e) {
    $error = "Error: " . $e->getMessage();
}
?>

<section class="user-management">
    <h2>User Management</h2>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    <?php if (isset($success)): ?>
        <script>alert("<?php echo $success; ?>");</script>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <select name="role" required>
            <option value="admin">Admin</option>
            <option value="manager">Manager</option>
            <option value="staff">Staff</option>
        </select>
        <input type="checkbox" name="permissions[]" value="menu"> Menu
        <input type="checkbox" name="permissions[]" value="orders"> Orders
        <input type="checkbox" name="permissions[]" value="reservations"> Reservations
        <button type="submit" name="add_user" onclick="return confirm('Are you sure you want to add this user?')">Add User</button>
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Role</th>
            <th>Permissions</th>
            <th>Actions</th>
        </tr>
        <?php foreach($users as $user): ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['role']; ?></td>
                <td><?php echo $user['permissions'] ?: 'None'; ?></td>
                <td>
                    <a href="?delete=<?php echo $user['id']; ?>" class="delete" onclick="return confirm('Are you sure you want to delete user <?php echo $user['username']; ?>?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</section>

<?php include 'includes/admin_footer.php'; ?>