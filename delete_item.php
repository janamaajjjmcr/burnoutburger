<?php
// Include database configuration
require_once 'db_config.php';

// Function to delete an order
function delete_order($order_id) {
    global $conn;
    
    $sql = "DELETE FROM orders WHERE order_id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $order_id);
    
    return $stmt->execute();
}

// Function to delete a customer
function delete_customer($customer_id) {
    global $conn;
    
    // First check if customer has any orders
    $stmt = $conn->prepare("SELECT COUNT(*) as order_count FROM orders WHERE customer_id = ?");
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    if ($row['order_count'] > 0) {
        // Delete all orders for this customer first
        $stmt = $conn->prepare("DELETE FROM orders WHERE customer_id = ?");
        $stmt->bind_param("i", $customer_id);
        $stmt->execute();
    }
    
    // Now delete the customer
    $sql = "DELETE FROM customers WHERE customer_id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $customer_id);
    
    return $stmt->execute();
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if we're deleting an order or a customer
    if (isset($_POST['delete_type']) && isset($_POST['delete_id'])) {
        $delete_type = $_POST['delete_type'];
        $delete_id = intval($_POST['delete_id']);
        
        if ($delete_type === 'order') {
            $success = delete_order($delete_id);
            $redirect_url = "../admin.html?success=Order deleted successfully";
        } elseif ($delete_type === 'customer') {
            $success = delete_customer($delete_id);
            $redirect_url = "../admin.html?success=Customer deleted successfully";
        } else {
            $success = false;
            $redirect_url = "../admin.html?errors=Invalid delete type";
        }
        
        if ($success) {
            header("Location: " . $redirect_url);
            exit();
        } else {
            header("Location: ../admin.html?errors=Failed to delete. Please try again.");
            exit();
        }
    } else {
        header("Location: ../admin.html?errors=Missing required parameters");
        exit();
    }
}

// Process AJAX request for deletion
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $delete_type = $_GET['type'];
    $delete_id = intval($_GET['id']);
    
    if ($delete_type === 'order') {
        $success = delete_order($delete_id);
    } elseif ($delete_type === 'customer') {
        $success = delete_customer($delete_id);
    } else {
        $success = false;
    }
    
    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode(['success' => $success]);
    exit();
}
?>
