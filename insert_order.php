<?php
require_once 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_POST['customer_id'];
    $burger_type = $_POST['burger_type'];
    $quantity = $_POST['quantity'];
    $special_instructions = $_POST['special_instructions'];
    $status = $_POST['status'];
    $order_date = date("Y-m-d H:i:s");

    $sql = "INSERT INTO orders (customer_id, burger_type, quantity, special_instructions, status, order_date)
            VALUES ('$customer_id', '$burger_type', '$quantity', '$special_instructions', '$status', '$order_date')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('✅ تم إضافة الطلب بنجاح!'); window.location.href='add_order.html';</script>";
    } else {
        echo "❌ خطأ: " . $conn->error;
    }

    $conn->close();
}
?>