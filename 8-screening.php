<?php
session_start();

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $required_fields = ['location', 'date', 'Time'];
    $all_filled = true;

    foreach ($required_fields as $field) {
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            $all_filled = false;
            break;
        }
    }

    // Ensure session variable 'id' is set
    if (!isset($_SESSION['userID'])) {
        die("Error: User ID is not set in the session.");
    }

    $userID = $_SESSION['userID'];

    if ($all_filled) {
        $location = $conn->real_escape_string($_POST['location']);
        $date = $conn->real_escape_string($_POST['date']);
        $time = $conn->real_escape_string($_POST['Time']);

        // Include userID in the SQL statement
        $sql = "INSERT INTO screening (userID, location, date, time) VALUES (?, ?, ?, ?)";

        // Prepare and execute the SQL statement
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isss", $userID, $location, $date, $time);

        if ($stmt->execute()) {
            header("Location: 9-ticketing.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error: Please answer all the required fields.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Betamax: Blood Management System</title>
    <link rel="stylesheet" href="dash.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <nav>
        <div class="nav-container">
            <div class="left">
                <a href="4-dash.html">
                    <img src="logo_notext.png" alt="logo" height="65px" width="65px">
                </a>
            </div>
            <div class="center">
                <a href="4-dash.html">
                    <img src="textlogo.png" alt="logo" height="80px">
                </a>
            </div>
            <div class="right">
                <a href="14-profile.html">
                    <img src="profile.png" alt="logo" height="40px" width="40px">
                </a>
            </div>
        </div>
    </nav>
</header>
<main>
    <div class="content-container">
        <section id="faqs">
            <h2><a href="13-faqs.html">FAQs</a></h2>
        </section>
        <div class="right-content">
            <section id="donate">
                <h2><a href="5-donate.html">DONATE</a></h2>
            </section>
            <section id="request">
                <h2><a href="10-request.html">REQUEST</a></h2>
            </section>
        </div>
    </div>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div>
            <h2-screening>SCREENING PROCESS SCHEDULE</h2-screening>
            <div class="form-group5">
                <input type="text" id="location" name="location" placeholder="Location: " required>
            </div>
            <div class="form-group5">
                <input type="date" id="date" name="date" placeholder="Date: " required>
            </div>
            <div class="form-group5">
                <input type="Time" id="Time" name="Time" placeholder="Time: " required>
            </div>
        </div>
        <div class="NS" style="position: fixed; bottom: 20px; right: 20px;">
            <button type="submit" name="schedule" class="btn btn-primary">Schedule</button>
        </div>
    </form>
</main>
</body>
</html>
