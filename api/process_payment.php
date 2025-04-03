<?php
header('Content-Type: application/json');
include '../includes/db_connect.php';

// Ensure the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method. Use POST.']);
    exit;
}

try {
    $rawData = file_get_contents('php://input');
    $data = json_decode($rawData, true);

    // Log the raw data for debugging (remove in production)
    file_put_contents('debug.log', "process_payment.php - Raw Data: $rawData\n", FILE_APPEND);

    // Validate the request data
    if (!is_array($data) || !isset($data['order_id']) || !isset($data['payment_method'])) {
        throw new Exception('Invalid request data: order_id and payment_method are required');
    }

    $orderId = $data['order_id'];
    $paymentMethod = $data['payment_method'];

    // Update order with payment status
    $stmt = $pdo->prepare("UPDATE orders SET payment_status = 'completed', status = 'processing' WHERE order_id = ?");
    $stmt->execute([$orderId]);

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>