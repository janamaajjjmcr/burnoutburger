<?php
require_once 'db_config.php';

$sql = "SELECT o.order_id, c.name AS customer_name, o.burger_type, o.quantity, o.special_instructions, o.status, o.order_date
        FROM orders o
        JOIN customers c ON o.customer_id = c.customer_id
        ORDER BY o.order_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>All Orders</title>
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

<!-- Order Table -->
<section class="adminSection">
  <h2 class="adminTitle">📦 All Orders</h2>

  <table class="dataTable">
    <thead>
      <tr>
        <th>Order ID</th>
        <th>Customer</th>
        <th>Burger</th>
        <th>Qty</th>
        <th>Instructions</th>
        <th>Status</th>
        <th>Date</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= $row['order_id'] ?></td>
            <td><?= $row['customer_name'] ?></td>
            <td><?= $row['burger_type'] ?></td>
            <td><?= $row['quantity'] ?></td>
            <td><?= $row['special_instructions'] ?></td>
            <td><?= ucfirst($row['status']) ?></td>
            <td><?= $row['order_date'] ?></td>
            <td>
              <a href="update_order.php?id=<?= $row['order_id'] ?>" class="actionBtn editBtn">✏️</a>
              <a href="delete_order.php?id=<?= $row['order_id'] ?>" onclick="return confirm('Are you sure?');" class="actionBtn deleteBtn">🗑️</a>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr>
          <td colspan="8" style="text-align:center;">No orders found.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</section>

<!-- Footer -->
<footer>
  <p>&copy; 2025 Burn Out Burger. Built by Jana.</p>
</footer>

</body>
</html>
