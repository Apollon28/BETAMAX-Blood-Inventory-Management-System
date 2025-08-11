<?php
session_start();
include 'database.php';

if (!isset($_SESSION['userID'])) {
    die(json_encode(['success' => false, 'message' => 'User not logged in']));
}

$userID = $_SESSION['userID'];

$data = json_decode(file_get_contents('php://input'), true);
$bloodType = $data['blood_type'];
$quantity = $data['quantity'];

// Ensure the cart is user-specific
if (!isset($_SESSION['cart'][$userID])) {
    $_SESSION['cart'][$userID] = [];
}

if ($quantity > 0) {
    $_SESSION['cart'][$userID][$bloodType] = $quantity;
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid quantity']);
}
?>
