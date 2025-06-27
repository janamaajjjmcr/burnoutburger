<?php
// Include database configuration
require_once 'db_config.php';

// Function to update an order
function update_order($order_id, $burger_type, $quantity, $special_instructions, $status) {
    global $conn;
    
    $sql = "UPDATE orders 
            SET burger_type = ?, quantity = ?, special_instructions = ?, status = ? 
            WHERE order_id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sissi", $burger_type, $quantity, $special_instructions, $status, $order_id);
    
    return $stmt->execute();
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form data
    $errors = [];
    
    // Validate order_id
    if (!isset($_POST['order_id']) || empty($_POST['order_id'])) {
        $errors[] = "Order ID is required";
    }
    
    // Validate burger_type
    if (empty($_POST['edit_burger_type'])) {
        $errors[] = "Burger type is required";
    }
    
    // Validate quantity
    if (empty($_POST['edit_quantity']) || intval($_POST['edit_quantity']) < 1) {
        $errors[] = "Quantity must be at least 1";
    }
    
    // Validate status
    if (empty($_POST['edit_status'])) {
        $errors[] = "Status is required";
    }
    
    // If no errors, update the order
    if (empty($errors)) {
        $order_id = intval($_POST['order_id']);
        $burger_type = $_POST['edit_burger_type'];
        $quantity = intval($_POST['edit_quantity']);
        $special_instructions = isset($_POST['edit_special_instructions']) ? $_POST['edit_special_instructions'] : '';
        $status = $_POST['edit_status'];
        
        $success = update_order($order_id, $burger_type, $quantity, $special_instructions, $status);
        
        if ($success) {
            // Redirect back to admin page with success message
            header("Location: ../admin.html?success=Order updated successfully");
            exit();
        } else {
            $errors[] = "Failed to update order. Please try again.";
        }
    }
    
    // If there are errors, redirect back with errors
    if (!empty($errors)) {
        $error_string = implode("|", $errors);
        header("Location: ../admin.html?errors=" . urlencode($error_string));
        exit();
    }
}

// Process AJAX request for order update
if (isset($_GET['action']) && $_GET['action'] == 'update_order' && isset($_GET['id'])) {
    $order_id = intval($_GET['id']);
    $burger_type = $_GET['burger_type'];
    $quantity = intval($_GET['quantity']);
    $special_instructions = isset($_GET['special_instructions']) ? $_GET['special_instructions'] : '';
    $status = $_GET['status'];
    
    $success = update_order($order_id, $burger_type, $quantity, $special_instructions, $status);
    
    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode(['success' => $success]);
    exit();
}
?>
