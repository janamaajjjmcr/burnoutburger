<?php
// Include database configuration
require_once 'db_config.php';

// Function to get all orders
function get_all_orders($limit = 10, $offset = 0) {
    global $conn;
    
    $sql = "SELECT o.*, c.name, c.email, c.phone 
            FROM orders o 
            JOIN customers c ON o.customer_id = c.customer_id 
            ORDER BY o.order_date DESC 
            LIMIT ? OFFSET ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $limit, $offset);
    $stmt->execute();
    
    return $stmt->get_result();
}

// Function to get a specific order by ID
function get_order_by_id($order_id) {
    global $conn;
    
    $sql = "SELECT o.*, c.name, c.email, c.phone, c.address 
            FROM orders o 
            JOIN customers c ON o.customer_id = c.customer_id 
            WHERE o.order_id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    
    return $stmt->get_result()->fetch_assoc();
}

// Function to get orders by customer ID
function get_orders_by_customer($customer_id) {
    global $conn;
    
    $sql = "SELECT * FROM orders WHERE customer_id = ? ORDER BY order_date DESC";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    
    return $stmt->get_result();
}

// Function to search orders
function search_orders($search_term) {
    global $conn;
    
    $search_term = "%$search_term%";
    
    $sql = "SELECT o.*, c.name, c.email, c.phone 
            FROM orders o 
            JOIN customers c ON o.customer_id = c.customer_id 
            WHERE c.name LIKE ? 
            OR c.email LIKE ? 
            OR o.burger_type LIKE ? 
            OR o.status LIKE ? 
            ORDER BY o.order_date DESC";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $search_term, $search_term, $search_term, $search_term);
    $stmt->execute();
    
    return $stmt->get_result();
}

// Process AJAX request for orders data
if (isset($_GET['action']) && $_GET['action'] == 'get_orders') {
    $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
    $offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
    
    $result = get_all_orders($limit, $offset);
    
    $orders = array();
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
    
    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($orders);
    exit();
}

// Process AJAX request for specific order
if (isset($_GET['action']) && $_GET['action'] == 'get_order' && isset($_GET['id'])) {
    $order_id = intval($_GET['id']);
    $order = get_order_by_id($order_id);
    
    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($order);
    exit();
}

// Process AJAX request for search
if (isset($_GET['action']) && $_GET['action'] == 'search' && isset($_GET['term'])) {
    $search_term = $_GET['term'];
    $result = search_orders($search_term);
    
    $orders = array();
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
    
    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($orders);
    exit();
}
?>
