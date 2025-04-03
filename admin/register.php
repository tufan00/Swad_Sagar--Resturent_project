<?php
// Use an absolute path relative to the project root
include './../includes/db_connect.php';
include './includes/auth.php';

// Redirect if already logged in
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $role = $_POST['role'];
    $permissions = json_encode($_POST['permissions'] ?? []); // Store permissions as JSON

    // Check if username already exists
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
    $stmt->execute([$username]);
    if ($stmt->fetchColumn() > 0) {
        $error = "Username already exists.";
    } else {
        // Insert new user into the database
        $stmt = $pdo->prepare("INSERT INTO users (username, password, role, permissions) VALUES (?, ?, ?, ?)");
        try {
            $stmt->execute([$username, $password, $role, $permissions]);
            $success = "Registration successful! You can now <a href='login.php'>log in</a>.";
        } catch (PDOException $e) {
            $error = "Registration failed: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Admin Panel</title>
    <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>
    <div class="login-container">
        <h2>Register for Admin Panel</h2>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <select name="role" required>
                <option value="">Select Role</option>
                <option value="admin">Admin</option>
                <option value="manager">Manager</option>
                <option value="staff">Staff</option>
            </select>
            <div class="permissions">
                <h4>Permissions</h4>
                <label><input type="checkbox" name="permissions[]" value="orders"> Orders</label>
                <label><input type="checkbox" name="permissions[]" value="menu"> Menu</label>
                <label><input type="checkbox" name="permissions[]" value="reservations"> Reservations</label>
                <label><input type="checkbox" name="permissions[]" value="customers"> Customers</label>
                <label><input type="checkbox" name="permissions[]" value="inventory"> Inventory</label>
                <label><input type="checkbox" name="permissions[]" value="promotions"> Promotions</label>
            </div>
            <button type="submit" name="register">Register</button>
            <p>Already have an account? <a href="login.php">Log in here</a>.</p>
        </form>
    </div>
</body>
</html>