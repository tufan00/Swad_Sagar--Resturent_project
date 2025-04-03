<?php
// Include your database connection
include '../includes/db_connect.php';

// Fetch menu items from the database
$stmt = $pdo->prepare("SELECT * FROM menu");
$stmt->execute();
$items = $stmt->fetchAll();

foreach ($items as $item) {
    $imageId = $item['id'];  // Get the ID of the item to pass to the image-serving script

    echo "<div class='menu-item'>";
    echo "<h4>" . htmlspecialchars($item['name']) . "</h4>";
    echo "<p>" . htmlspecialchars($item['description']) . "</p>";
    echo "<span>$" . htmlspecialchars($item['price']) . "</span>";

    // Display the image dynamically using the get_image.php endpoint
    echo "<img src='get_image.php?image_id=" . $imageId . "' alt='" . htmlspecialchars($item['name']) . "' />";

    echo "</div>";
}
?>
