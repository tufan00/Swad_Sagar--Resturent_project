<?php
include './../includes/db_connect.php';

// Set PHP time zone
date_default_timezone_set('UTC');

// Set MySQL time zone
$pdo->exec("SET time_zone = '+00:00';");

// Function to generate a random token
function generateToken($length = 32) {
    return bin2hex(random_bytes($length));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['request_reset'])) {
    $username = $_POST['username'];

    // Check if the username exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user) {
        // Generate a reset token and set expiry (3 minutes from now)
        $token = generateToken();
        $expiry = date('Y-m-d H:i:s', strtotime('+3 minutes'));

        // Store the token and expiry in the database
        $stmt = $pdo->prepare("UPDATE users SET reset_token = ?, reset_expiry = ? WHERE username = ?");
        $stmt->execute([$token, $expiry, $username]);

        // Verify the token was saved
        $stmt = $pdo->prepare("SELECT reset_token, reset_expiry FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $updated_user = $stmt->fetch();
        if ($updated_user['reset_token'] === $token) {
            // Simulate sending an email by displaying the reset link
            $reset_link = "http://localhost/restaurant-website/admin/reset_password.php?token=$token";
            $message = "Password reset link: <a href='$reset_link'>$reset_link</a><br>";
            $message .= "Token: $token<br>Expiry: $expiry<br>";
            $message .= "Current server time: " . date('Y-m-d H:i:s');
        } else {
            $error = "Failed to save reset token.";
        }
    } else {
        $error = "Username not found.";
    }
}

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Debug: Log the token being checked
    error_log("Checking token: $token");

    // Check if the token is valid and not expired
    $stmt = $pdo->prepare("SELECT * FROM users WHERE reset_token = ? AND reset_expiry > NOW()");
    $stmt->execute([$token]);
    $user = $stmt->fetch();

    if ($user) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reset_password'])) {
            $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

            // Update the password and clear the reset token
            $stmt = $pdo->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_expiry = NULL WHERE reset_token = ?");
            $stmt->execute([$new_password, $token]);

            // Redirect to login page after successful reset
            header('Location: login.php?message=Password reset successful! Please log in.');
            exit;
        }
    } else {
        // Debug: Check why the token is invalid
        $stmt = $pdo->prepare("SELECT reset_token, reset_expiry FROM users WHERE reset_token = ?");
        $stmt->execute([$token]);
        $token_data = $stmt->fetch();
        if ($token_data) {
            $error = "Token expired. Expiry was: " . $token_data['reset_expiry'] . "<br>Current server time: " . date('Y-m-d H:i:s');
        } else {
            $error = "Invalid token. No matching token found in the database.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Admin Panel</title>
    <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>
    <div class="login-container">
        <h2>Reset Password</h2>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <?php if (isset($message)) echo "<p class='success'>$message</p>"; ?>
        <?php if (isset($_GET['message'])) echo "<p class='success'>" . htmlspecialchars($_GET['message']) . "</p>"; ?>

        <?php if (!isset($_GET['token'])): ?>
            <!-- Request Reset Form -->
            <form method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <button type="submit" name="request_reset">Request Password Reset</button>
                <p>Back to <a href="login.php">Login</a>.</p>
            </form>
        <?php elseif (isset($user)): ?>
            <!-- Reset Password Form -->
            <form method="POST">
                <input type="password" name="new_password" placeholder="New Password" required>
                <button type="submit" name="reset_password">Reset Password</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>