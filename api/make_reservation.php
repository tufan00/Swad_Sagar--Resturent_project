<?php
header('Content-Type: application/json');
include '../includes/db_connect.php';

try {
    // Ensure the request method is POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method. Use POST.');
    }

    $rawData = file_get_contents('php://input');
    $data = json_decode($rawData, true);

    // Validate the request data
    if (!is_array($data) || 
        !isset($data['name']) || 
        !isset($data['email']) || 
        !isset($data['phone']) || 
        !isset($data['date']) || 
        !isset($data['time']) || 
        !isset($data['guests']) || 
        !isset($data['table_id'])) {
        throw new Exception('Invalid request data: name, email, phone, date, time, guests, and table_id are required');
    }

    $name = $data['name'];
    $email = $data['email'];
    $phone = $data['phone'];
    $date = $data['date'];
    $time = $data['time'];
    $guests = $data['guests'];
    $table_id = $data['table_id'];
    $occasion = isset($data['occasion']) ? $data['occasion'] : null;
    $special_requests = isset($data['special_requests']) ? $data['special_requests'] : null;

    // Generate reservation ID
    $stmt = $pdo->query("SELECT MAX(id) as max_id FROM reservations");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $nextId = ($result['max_id'] !== null) ? $result['max_id'] + 1 : 1;
    $reservationId = 'RES' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

    // Insert reservation
    $stmt = $pdo->prepare("
        INSERT INTO reservations (
            reservation_id, name, email, phone, date, time, party_size, table_id, occasion, special_requests, status
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending')
    ");
    $stmt->execute([
        $reservationId,
        $name,
        $email,
        $phone,
        $date,
        $time,
        $guests,
        $table_id,
        $occasion,
        $special_requests
    ]);

    echo json_encode(['success' => true, 'reservation_id' => $reservationId]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>