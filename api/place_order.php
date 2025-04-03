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
    file_put_contents('debug.log', "place_order.php - Raw Data: $rawData\n", FILE_APPEND);

    // Validate the request data
    if (!is_array($data) || 
        !isset($data['order_type']) || 
        !isset($data['name']) || 
        !isset($data['items']) || 
        !is_array($data['items']) || 
        !isset($data['total_amount'])) {
        throw new Exception('Invalid request data: order_type, name, items (array), and total_amount are required');
    }

    $orderType = $data['order_type'];
    $name = $data['name'];
    $items = $data['items'];
    $totalAmount = $data['total_amount'];
    $deliveryAddress = isset($data['delivery_address']) ? $data['delivery_address'] : null;

    // Insert customer
    $stmt = $pdo->prepare("INSERT INTO customers (name) VALUES (?)");
    $stmt->execute([$name]);
    $customerId = $pdo->lastInsertId();

    // Generate order ID
    $stmt = $pdo->query("SELECT MAX(id) as max_id FROM orders");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $nextId = ($result['max_id'] !== null) ? $result['max_id'] + 1 : 1;
    $orderId = 'ORD' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

    // Insert order
    $itemNames = array_map(function($item) { return $item['name'] . ' (x' . $item['quantity'] . ')'; }, $items);
    $itemList = implode(', ', $itemNames);
    $stmt = $pdo->prepare("INSERT INTO orders (order_id, customer_id, item, type, total_amount, delivery_address) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$orderId, $customerId, $itemList, $orderType, $totalAmount, $deliveryAddress]);

    echo json_encode(['success' => true, 'order_id' => $orderId]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>