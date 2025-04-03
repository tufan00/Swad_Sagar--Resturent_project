<?php
include '../includes/db_connect.php';
include 'includes/admin_header.php';

// Filter and search functionality
$filter = isset($_GET['filter']) ? $_GET['filter'] : '';

// Query to fetch items
$query = "SELECT i.*, s.name as supplier FROM inventory i LEFT JOIN suppliers s ON i.supplier_id = s.id WHERE i.ingredient LIKE :filter";
$stmt = $pdo->prepare($query);
$stmt->execute(['filter' => '%' . $filter . '%']);
$items = $stmt->fetchAll();

// Handle adding or removing stock
if (isset($_POST['update_stock'])) {
    $id = $_POST['id'];
    $stock_change = $_POST['stock_change'];
    $new_quantity = $_POST['current_stock'] + $stock_change;

    // Only update stock if a valid change is made
    if ($new_quantity >= 0) {
        $stmt = $pdo->prepare("UPDATE inventory SET stock_level = :new_quantity WHERE id = :id");
        $stmt->execute(['new_quantity' => $new_quantity, 'id' => $id]);
    }

    header('Location: inventory.php'); // Refresh the page after updating
    exit;
}

// Handle adding new stock
if (isset($_POST['add_new_stock'])) {
    $ingredient = $_POST['ingredient'];
    $stock = $_POST['stock'];
    $supplier_id = $_POST['supplier_id']; // Supplier ID from dropdown

    // Insert the new stock with the selected supplier
    $stmt = $pdo->prepare("INSERT INTO inventory (ingredient, stock_level, supplier_id) 
                           VALUES (:ingredient, :stock, :supplier_id)");
    $stmt->execute([
        'ingredient' => $ingredient,
        'stock' => $stock,
        'supplier_id' => $supplier_id
    ]);

    header('Location: inventory.php'); // Refresh after adding new stock
    exit;
}

// Handle deleting stock
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $stmt = $pdo->prepare("DELETE FROM inventory WHERE id = :id");
    $stmt->execute(['id' => $delete_id]);

    header('Location: inventory.php'); // Refresh after deleting
    exit;
}

// Fetch all suppliers for the 'Add New Stock' form dropdown
$suppliers_stmt = $pdo->query("SELECT * FROM suppliers");
$suppliers = $suppliers_stmt->fetchAll();
?>

<section class="inventory">
    <h2>Inventory</h2>

    <!-- Add New Stock Form (Moved to the top) -->
    <h3>Add New Stock</h3>
    <form method="POST" style="display: flex; gap: 10px; margin-bottom: 20px;">
        <input type="text" name="ingredient" placeholder="Ingredient" required style="padding: 5px;">
        <input type="number" name="stock" placeholder="Stock" required style="padding: 5px;">
        
        <!-- Supplier Dropdown -->
        <select name="supplier_id" required style="padding: 5px;">
            <option value="" disabled selected>Select Supplier</option>
            <?php foreach ($suppliers as $supplier): ?>
                <option value="<?php echo $supplier['id']; ?>"><?php echo $supplier['name']; ?></option>
            <?php endforeach; ?>
        </select>
        
        <button type="submit" name="add_new_stock" style="padding: 5px;">Add Stock</button>
    </form>

    <!-- Filter Section -->
    <form method="GET" style="margin-bottom: 20px;">
        <input type="text" name="filter" value="<?php echo htmlspecialchars($filter); ?>" placeholder="Search for stock" style="padding: 5px;">
        <button type="submit" style="padding: 5px;">Filter</button>
    </form>

    <table>
        <tr><th>ID</th><th>Ingredient</th><th>Stock</th><th>Supplier</th><th>Action</th></tr>
        <?php foreach($items as $i): ?>
            <tr <?php if($i['stock_level'] < $i['low_stock_threshold']) echo 'class="low-stock"'; ?>>
                <td><?php echo $i['id']; ?></td>
                <td><?php echo $i['ingredient']; ?></td>
                <td><?php echo $i['stock_level']; ?></td>
                <td><?php echo $i['supplier']; ?></td>
                <td>
                    <!-- Action buttons on a single row (Flex layout) -->
                    <div style="display: flex; gap: 10px; align-items: center;">
                        <!-- Update Stock Form -->
                        <form method="POST" style="display: flex; gap: 10px;">
                            <input type="hidden" name="id" value="<?php echo $i['id']; ?>">
                            <input type="number" name="stock_change" value="0" min="-100" max="100" placeholder="Quantity" style="padding: 5px;">
                            <button type="submit" name="update_stock" style="padding: 5px;">Update Stock</button>
                            <input type="hidden" name="current_stock" value="<?php echo $i['stock_level']; ?>">
                        </form>

                        <!-- Delete Button -->
                        <a href="inventory.php?delete_id=<?php echo $i['id']; ?>" onclick="return confirm('Are you sure you want to delete this item?')" style="padding: 5px; background-color: red; color: white; text-decoration: none; border-radius: 4px;">Delete</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</section>

<?php include 'includes/admin_footer.php'; ?>
