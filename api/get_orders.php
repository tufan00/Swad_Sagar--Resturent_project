<?php
header('Content-Type: application/json');
include '../includes/db_connect.php';

try {
    $stmt = $pdo->query("SELECT * FROM orders ORDER BY created_at DESC");
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($orders);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>