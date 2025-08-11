<?php
session_start();

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "betamax";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data (sanitize input if necessary)
    $customerName = $_POST['name'] ?? '';
    $dateOfBirth = $_POST['dob'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $medicalCondition = $_POST['medicalcon'] ?? '';
    $hospitalName = $_POST['hosname'] ?? '';
    $hospitalAddress = $_POST['hos-address'] ?? '';
    $date = $_POST['prefd'] ?? '';
    $time = $_POST['preft'] ?? '';
    $phone = $_POST['contact'] ?? '';
    $email = $_POST['email'] ?? '';

    // Prepare SQL statement
    $sql = "INSERT INTO requestform (customerName, dateofbirth, gender, medicalcondition, hospitalname, hospitaladdress, date, time, phone, email)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error: " . $conn->error);
    }

    // Bind parameters and execute statement
    $stmt->bind_param("ssssssssss", $customerName, $dateOfBirth, $gender, $medicalCondition, $hospitalName, $hospitalAddress, $date, $time, $phone, $email);

    if ($stmt->execute()) {
        echo "New record created successfully";
        // Redirect to the next page after successful insertion
        header("Location: 4-dash.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
