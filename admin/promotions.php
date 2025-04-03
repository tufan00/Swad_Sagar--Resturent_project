<?php
include '../includes/db_connect.php';
include 'includes/admin_header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_promo'])) {
    $stmt = $pdo->prepare("INSERT INTO promotions (title, description, code, discount, start_date, end_date, type) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$_POST['title'], $_POST['description'], $_POST['code'], $_POST['discount'], $_POST['start_date'], $_POST['end_date'], $_POST['type']]);
}

$stmt = $pdo->query("SELECT * FROM promotions");
$promos = $stmt->fetchAll();
?>

<section class="promotions">
    <h2>Promotions</h2>
    <form method="POST">
        <input type="text" name="title" placeholder="Title" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <input type="text" name="code" placeholder="Code" required>
        <input type="number" name="discount" step="0.01" required>
        <input type="datetime-local" name="start_date" required>
        <input type="datetime-local" name="end_date" required>
        <select name="type">
            <option value="discount">Discount</option>
            <option value="coupon">Coupon</option>
            <option value="referral">Referral</option>
        </select>
        <button type="submit" name="add_promo">Add Promo</button>
    </form>
    <table>
        <tr><th>ID</th><th>Title</th><th>Code</th><th>Discount</th></tr>
        <?php foreach($promos as $p): ?>
            <tr>
                <td><?php echo $p['id']; ?></td>
                <td><?php echo $p['title']; ?></td>
                <td><?php echo $p['code']; ?></td>
                <td><?php echo $p['discount']; ?>%</td>
            </tr>
        <?php endforeach; ?>
    </table>
</section>
<?php include 'includes/admin_footer.php'; ?>