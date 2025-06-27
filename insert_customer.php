<?php
require_once 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = $_POST['name'];
    $email   = $_POST['email'];
    $phone   = $_POST['phone'];
    $address = $_POST['address'];
    $created_at = date("Y-m-d H:i:s");

    $sql = "INSERT INTO customers (name, email, phone, address, created_at) 
            VALUES ('$name', '$email', '$phone', '$address', '$created_at')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('✅ تم إضافة العميل بنجاح!'); window.location.href='add_customer.html';</script>";
    } else {
        echo "❌ خطأ: " . $conn->error;
    }

    $conn->close();
}
?>
