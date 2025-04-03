<?php
header('Content-Type: application/json');
include '../includes/db_connect.php';

try {
    $stmt = $pdo->query("SELECT * FROM reservations ORDER BY created_at DESC");
    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($reservations);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>