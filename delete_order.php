<?php
require_once 'db_config.php';

if (!isset($_GET['id'])) {
    echo "Missing order ID.";
    exit;
}

$order_id = $_GET['id'];
$sql = "DELETE FROM orders WHERE order_id = $order_id";

if ($conn->query($sql) === TRUE) {
    header("Location: view_orders.php?message=deleted");
    exit;
} else {
    echo "Error deleting order: " . $conn->error;
}
?>
