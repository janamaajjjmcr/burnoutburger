<?php
require_once 'db_config.php';

$order_id = $_POST['order_id'];
$burger_type = $_POST['burger_type'];
$quantity = $_POST['quantity'];
$special_instructions = $_POST['special_instructions'];
$status = $_POST['status'];

$sql = "UPDATE orders SET 
            burger_type = '$burger_type', 
            quantity = $quantity, 
            special_instructions = '$special_instructions', 
            status = '$status' 
        WHERE order_id = $order_id";

if ($conn->query($sql) === TRUE) {
    header("Location: view_orders.php?message=updated");
    exit;
} else {
    echo "Error updating record: " . $conn->error;
}
?>
