<?php
require_once 'db_config.php';
$sql = "SELECT customer_id, name FROM customers";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8" />
  <title>إضافة طلب جديد</title>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/additional.css" />
</head>
<body>

<header>
  <img src="images/logo.png" alt="logo" class="logo" />
  <nav class="navigation">
    <ul>
      <li><a href="index.html">Home</a></li>
      <li><a href="about.html">About us</a></li>
      <li><a href="menu.html">Menu</a></li>
      <li><a href="contact.html">Contact</a></li>
      <li><a href="order.html">Order</a></li>
      <li><a href="customers.html">Customers</a></li>
      <li><a href="admin.php">Admin</a></li>
    </ul>
  </nav>
</header>

<hr />

<section class="formContainer">
  <h2>إضافة طلب جديد</h2>
  <form action="insert_order.php" method="POST">
    <label>اختر العميل:</label><br>
    <select name="customer_id" required>
      <option value="">-- اختر عميل --</option>
      <?php while($row = $result->fetch_assoc()) {
        echo "<option value='{$row['customer_id']}'>{$row['name']}</option>";
      } ?>
    </select><br><br>

    <label>نوع البرجر:</label><br>
    <input type="text" name="burger_type" required><br><br>

    <label>الكمية:</label><br>
    <input type="number" name="quantity" required><br><br>

    <label>ملاحظات خاصة:</label><br>
    <textarea name="special_instructions"></textarea><br><br>

    <label>حالة الطلب:</label><br>
    <select name="status" required>
      <option value="pending">جاري التحضير</option>
      <option value="completed">تم التوصيل</option>
      <option value="canceled">ملغي</option>
    </select><br><br>

    <input type="submit" value="أضف الطلب">
  </form>
</section>

<hr />
<footer>
  <p>&copy; 2025 Burn Out Burger. Built by Jana.</p>
</footer>

</body>
</html>
