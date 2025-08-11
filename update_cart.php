<?php
session_start();
include 'database.php'; // Include your database connection and functions

// Check if user is logged in
if (!isset($_SESSION['userID'])) {
    die(json_encode(['success' => false, 'message' => 'User not logged in']));
}

$userID = $_SESSION['userID']; // Get user ID from session

$data = json_decode(file_get_contents('php://input'), true); // Retrieve JSON data sent from client-side
$bloodType = $data['blood_type']; // Extract blood type from JSON data

// Ensure the cart is user-specific
if (!isset($_SESSION['cart'][$userID])) {
    $_SESSION['cart'][$userID] = [];
}

// Initialize blood type count in user's cart if not already set
if (!isset($_SESSION['cart'][$userID][$bloodType])) {
    $_SESSION['cart'][$userID][$bloodType] = 0;
}

// Increment the count of the specified blood type in the user's cart
$_SESSION['cart'][$userID][$bloodType] += 1;

// Update database: Decrease stock count for the selected blood type
if (updateBloodStock($bloodType, -1)) { // Assuming updateBloodStock is a function to update stock in database
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update database']);
}

// Example function to update stock in database
function updateBloodStock($bloodType, $change) {
    global $conn; // Assuming $conn is your database connection object

    // Prepare SQL statement to update stock count in blood_stock table
    $stmt = $conn->prepare("UPDATE blood_stock SET stock = stock + ? WHERE blood_type = ?");
    $stmt->bind_param("is", $change, $bloodType);

    // Execute the statement
    if ($stmt->execute()) {
        return true; // Update successful
    } else {
        return false; // Update failed
    }
}
?>
