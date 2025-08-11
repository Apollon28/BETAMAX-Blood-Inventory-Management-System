<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure form data is set
    if (!isset($_POST['username'], $_POST['password'])) {
        die("Incomplete form submission.");
    }

    $username = $_POST['username']; // Use email as username
    $password = md5($_POST['password']); // Hash the entered password using md5

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'betamax');
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }

    // Prepare and execute SQL statement for login
    $stmt = $conn->prepare("SELECT userID, customerName, email, number, password FROM accountinfo WHERE email = ?");
    if (!$stmt) {
        die("Error: " . $conn->error);
    }

    $stmt->bind_param("s", $username); // Bind email as userID
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($userID, $customerName, $email, $phone, $hashed_password);
        $stmt->fetch();

        if ($password === $hashed_password) {
            // Password is correct, start a new session
            $_SESSION['userID'] = $userID;
            $_SESSION['customerName'] = $customerName;
            $_SESSION['email'] = $email;
            $_SESSION['phone'] = $phone;

            // Reset login attempts on successful login
            unset($_SESSION['login_attempts']);
            unset($_SESSION['last_login_attempt_time']);

            // Redirect to dashboard or any other secure page
            header("Location: 4-dash.html");
            exit;
        } else {
            if (!isset($_SESSION['login_attempts'])) {
                $_SESSION['login_attempts'] = 1;
                $_SESSION['last_login_attempt_time'] = time();
                $_SESSION['timeout_period'] = 20; // Initial timeout period in seconds
            } else {
                $_SESSION['login_attempts']++;
                if ($_SESSION['login_attempts'] > 3) {
                    // Check if timeout period has expired
                    if (time() - $_SESSION['last_login_attempt_time'] < $_SESSION['timeout_period']) {
                        // Display alert and exit
                        echo "<script>alert('Maximum login attempts reached. Please try again after {$_SESSION['timeout_period']} seconds.')</script>";
                        exit();
                    } else {
                        // Reset login attempts counter, last login attempt time, and increase timeout period
                        $_SESSION['login_attempts'] = 1;
                        $_SESSION['last_login_attempt_time'] = time();
                        $_SESSION['timeout_period'] += 5; // Increase timeout period by 5 seconds
                    }
                }
            }

            // Redirect back to login page
            header("Location: 2-login.html?error=1");
            exit(); // Exit after redirection
        }
    } else {
        // Email not found
        echo "Invalid email or password.";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    die("Method not allowed.");
}
?>
