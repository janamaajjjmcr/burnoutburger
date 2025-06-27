<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "burnoutburger";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("❌ فشل الاتصال: " . $conn->connect_error);
} else {
    echo "✅ تم الاتصال بقاعدة البيانات بنجاح!";
}

$conn->close();
?>
