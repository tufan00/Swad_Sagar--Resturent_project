<?php
header('Content-Type: application/json');
include '../includes/db_connect.php';

try {
    $stmt = $pdo->query("SELECT id, category, name, description, price, dietary_tags, image, order_position FROM menu ORDER BY order_position ASC");
    $menuItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // If the image field contains only the file name, prepend the base path
    foreach ($menuItems as &$item) {
        if ($item['image'] && !str_starts_with($item['image'], '/restaurant-website/')) {
            $item['image'] = '/restaurant-website/images/' . $item['image'];
        }
    }
    echo json_encode($menuItems);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>