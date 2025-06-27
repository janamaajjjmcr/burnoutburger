<?php
require_once 'db_config.php';

$name = $_POST['customer_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];

$customer_sql = "INSERT INTO customers (name, email, phone, address, created_at)
                 VALUES (?, ?, ?, ?, NOW())";
$stmt = $conn->prepare($customer_sql);
$stmt->bind_param("ssss", $name, $email, $phone, $address);
$stmt->execute();

$customer_id = $stmt->insert_id;
$stmt->close();

$burger_type = $_POST['burger_type'];
$quantity = $_POST['quantity'];
$special_instructions = $_POST['special_instructions'];
$status = "pending";

$order_sql = "INSERT INTO orders (customer_id, burger_type, quantity, special_instructions, status, order_date)
              VALUES (?, ?, ?, ?, ?, NOW())";
$stmt = $conn->prepare($order_sql);
$stmt->bind_param("issss", $customer_id, $burger_type, $quantity, $special_instructions, $status);
$stmt->execute();
$stmt->close();

$conn->close();

header("Location: order_confirmation.php");
exit();
?>
