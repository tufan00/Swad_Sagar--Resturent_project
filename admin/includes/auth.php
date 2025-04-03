<?php
session_start();
include './../includes/db_connect.php';
function checkAuth() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }
}

function checkRole($required_role) {
    checkAuth();
    if ($_SESSION['role'] !== $required_role) {
        die("Access denied.");
    }
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        header('Location: index.php');
    } else {
        $error = "Invalid credentials";
    }
}
?>