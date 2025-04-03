<?php
include './../includes/db_connect.php';
include 'includes/admin_header.php';

// Check if the user has the 'admin' role or 'menu' permission
checkRole('admin', 'menu');

try {
    // Add a new menu item
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_item'])) {
        $category = $_POST['category'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $dietary_tags = implode(',', $_POST['dietary_tags'] ?? []);
        $image = $_FILES['image']['name'] ?? null;

        if ($image) {
            $target_dir = "../images/";
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0755, true);
            }
            $target_file = $target_dir . basename($image);
            move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
        }

        // Get the next order_position
        $stmt = $pdo->query("SELECT MAX(order_position) as max_position FROM menu");
        $result = $stmt->fetch();
        $order_position = ($result['max_position'] ?? 0) + 1;

        $stmt = $pdo->prepare("INSERT INTO menu (category, name, description, price, dietary_tags, image, order_position) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$category, $name, $description, $price, $dietary_tags, $image, $order_position]);
    }

    // Delete a menu item
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $stmt = $pdo->prepare("DELETE FROM menu WHERE id = ?");
        $stmt->execute([$id]);
    }

    // Update the order of menu items
    if (isset($_POST['update_order'])) {
        $order = json_decode($_POST['order']);
        foreach ($order as $index => $id) {
            $stmt = $pdo->prepare("UPDATE menu SET order_position = ? WHERE id = ?");
            $stmt->execute([$index, $id]);
        }
    }

    // Fetch all menu items
    $stmt = $pdo->query("SELECT * FROM menu ORDER BY order_position");
    $items = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
?>

<section class="menu-management">
    <h2>Menu Management</h2>
    <form method="POST" enctype="multipart/form-data">
        <select name="category" required>
            <option value="Main Courses">Main Courses</option>
            <option value="Veg Starters">Veg Starters</option>
            <option value="Combos">Combos</option>
            <option value="Salads">Salads</option>
        </select>
        <input type="text" name="name" placeholder="Name" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <input type="number" name="price" step="0.01" required placeholder="Price in INR">
        <input type="checkbox" name="dietary_tags[]" value="vegan"> Vegan
        <input type="checkbox" name="dietary_tags[]" value="gluten-free"> Gluten-Free
        <input type="file" name="image" accept="image/*">
        <button type="submit" name="add_item">Add Item</button>
    </form>
    <div id="sortable">
        <?php foreach($items as $item): ?>
            <div class="menu-item" data-id="<?php echo $item['id']; ?>">
                <?php echo $item['name']; ?> - ₹<?php echo number_format($item['price'], 2); ?>
                <?php if ($item['dietary_tags']) echo " (Tags: " . $item['dietary_tags'] . ")"; ?>
                <?php if ($item['image']) echo " <img src='../images/{$item['image']}' width='50'>"; ?>
                <a href="?delete=<?php echo $item['id']; ?>" class="delete" onclick="return confirm('Are you sure?')">Delete</a>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<script>
$(document).ready(function(){
    $("#sortable").sortable({
        update: function() {
            var order = [];
            $('.menu-item').each(function(){ order.push($(this).data('id')); });
            $.post('menu.php', { update_order: true, order: JSON.stringify(order) });
        }
    });
});
</script>
<?php include 'includes/admin_footer.php'; ?>