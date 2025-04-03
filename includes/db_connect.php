<?php
$host = "localhost";
$dbname = "restaurant_db"; // Ensure this matches your database name
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected to database successfully.";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}
?>