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
    // Retrieve form data
    $name = $_POST['name'];
    $donorNumber = $_POST['donor-number'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $occupation = $_POST['occupation'];
    $currentAddress = $_POST['current-address'];
    $permanentAddress = $_POST['permanent-address'];
    $telephone = $_POST['telephone'];
    $phoneType = $_POST['phone-type'];
    $email = $_POST['email'];
    
   

    // Prepare SQL statement
    $sql = "INSERT INTO customerdetails (userID, customerName, donorno, dateofbirth, gender, occupation, currentaddress, permanentaddress, number, email)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error: " . $conn->error);
    }

    // Bind parameters and execute statement
    $stmt->bind_param("isssssssss", $userID, $name, $donorNumber, $dob, $gender, $occupation, $currentAddress, $permanentAddress, $telephone, $email);

    if ($stmt->execute()) {
        echo "New record created successfully";
        // Redirect to the next page after successful insertion
        header("Location: 6-health.php");
        exit();
    } else {
        // Check for duplicate entry error
        if ($conn->errno === 1062) {
            echo "Error: Duplicate entry for email address.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
