<?php
session_start();
include 'database.php';

if (!isset($_SESSION['userID'])) {
    die(json_encode(['success' => false, 'message' => 'User not logged in']));
}

$userID = $_SESSION['userID'];

$data = json_decode(file_get_contents('php://input'), true);
$bloodType = $data['blood_type'];

// Ensure the cart is user-specific
if (isset($_SESSION['cart'][$userID][$bloodType])) {
    unset($_SESSION['cart'][$userID][$bloodType]);
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Item not found in cart']);
}
?>
