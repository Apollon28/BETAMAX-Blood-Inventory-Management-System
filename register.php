<?php
session_start();

// Ensure form data is set
if (!isset($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['password'])) {
    die("Incomplete form submission.");
}

$customerName = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = md5($_POST['password']); // Hash the entered password using md5()

// Database connection
$conn = new mysqli('localhost', 'root', '', 'betamax');
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

// Prepare and execute SQL statement for registration
$stmt = $conn->prepare("INSERT INTO accountinfo (customerName, email, number, password) VALUES (?, ?, ?, ?)");
if (!$stmt) {
    die("Error: " . $conn->error);
}

$stmt->bind_param("ssss", $customerName, $email, $phone, $password); // Bind parameters
$execval = $stmt->execute();

if ($execval) {
    // Registration successful, set session variables
    $_SESSION['customerName'] = $customerName;
    $_SESSION['email'] = $email;
    $_SESSION['phone'] = $phone;

    // Redirect to login page or dashboard after successful registration
    header("Location: 2-login.html");
    exit; // Make sure to exit to prevent further execution
} else {
    echo "Error: Unable to register. Please try again later.";
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
