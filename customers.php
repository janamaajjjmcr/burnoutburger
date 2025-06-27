<?php
require_once 'db_config.php';

$sql = "SELECT c.customer_id, c.name, c.email, c.phone,
        COUNT(o.order_id) AS total_orders
        FROM customers c
        LEFT JOIN orders o ON c.customer_id = o.customer_id
        GROUP BY c.customer_id
        ORDER BY c.name ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>All Customers</title>
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
      <li><a href="admin.php">Admin</a></li>
    </ul>
  </nav>
</header>

<!-- Customer Table -->
<section class="adminSection">
  <h2 class="adminTitle">👥 All Customers</h2>

  <table class="dataTable">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Total Orders</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= $row['customer_id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['phone'] ?: '—' ?></td>
            <td><?= $row['total_orders'] ?></td>
            <td>
              <a href="delete_customer.php?id=<?= $row['customer_id'] ?>" onclick="return confirm('Delete this customer?');" class="actionBtn deleteBtn">🗑️</a>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr>
          <td colspan="6" style="text-align:center;">No customers found.</td>
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
