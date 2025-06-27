<?php require_once 'db_config.php'; ?>
<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8" />
  <title>إضافة عميل جديد</title>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/additional.css" />
</head>
<body>

<!-- Header -->
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

<!-- Form -->
<section class="formContainer">
  <h2>إضافة عميل جديد</h2>
  <form action="insert_customer.php" method="POST">
    <label>الاسم:</label><br>
    <input type="text" name="name" required><br><br>

    <label>البريد الإلكتروني:</label><br>
    <input type="email" name="email" required><br><br>

    <label>رقم الهاتف:</label><br>
    <input type="text" name="phone" required><br><br>

    <label>العنوان:</label><br>
    <input type="text" name="address" required><br><br>

    <input type="submit" value="إضافة العميل">
  </form>
</section>

<hr />
<footer>
  <p>&copy; 2025 Burn Out Burger. Built by Jana.</p>
</footer>

</body>
</html>
