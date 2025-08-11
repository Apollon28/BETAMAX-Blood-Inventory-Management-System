<?php
session_start();

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$password = md5($_POST['password']); // Hash the entered password using md5()
$number = $_POST['number'];

// Database connection
$conn = new mysqli('localhost', 'root', '', 'laundry');
if ($conn->connect_error) {
        echo "$conn->connect_error";
        die("Connection Failed: " . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO user (firstName, lastName, gender, email, password, number) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssi", $firstName, $lastName, $gender, $email, $password, $number);
        $execval = $stmt->execute();
        $stmt->close();
        $conn->close();

        if ($execval) {
            // Redirect the user to 'a-login.html' after successful insertion
            exit; // Make sure to exit to prevent further execution of PHP code
        } else {
            echo "Error: Unable to insert data into the database.";
        }
    }
if ($conn->connect_error) {
    echo "$conn->connect_error";
    die("Connection Failed: " . $conn->connect_error);
} else {
    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
    $conn->close();

    if ($user && $password === $user['password']) { // Compare hashed passwords
        // Login successful
        $_SESSION['user'] = $user;
        header("Location: dashboard.php"); // Redirect to dashboard or any other authenticated page
        exit;
    } else {
        // Login failed
        echo "Invalid email or password. Please try again.";
    }
}
?>
