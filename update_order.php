<?php
require_once 'db_config.php';

if (!isset($_GET['id'])) {
    echo "Missing order ID.";
    exit;
}

$order_id = $_GET['id'];
$sql = "SELECT * FROM orders WHERE order_id = $order_id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "Order not found.";
    exit;
}

$order = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Order</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <div class="container">
        <h2>Update Order</h2>
        <form action="update_order_process.php" method="POST">
            <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">

            <label>Burger Type:</label>
            <input type="text" name="burger_type" value="<?= $order['burger_type'] ?>" required>

            <label>Quantity:</label>
            <input type="number" name="quantity" value="<?= $order['quantity'] ?>" required>

            <label>Special Instructions:</label>
            <textarea name="special_instructions"><?= $order['special_instructions'] ?></textarea>

            <label>Status:</label>
            <select name="status">
                <option value="pending" <?= $order['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                <option value="completed" <?= $order['status'] == 'completed' ? 'selected' : '' ?>>Completed</option>
                <option value="canceled" <?= $order['status'] == 'canceled' ? 'selected' : '' ?>>Canceled</option>
            </select>

            <input type="submit" value="Update Order">
        </form>
    </div>
</body>
</html>
