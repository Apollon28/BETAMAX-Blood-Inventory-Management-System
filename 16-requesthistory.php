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

// Query to get request history (assuming all records for now)
$sql = "SELECT customerName, date, hospitalname, hospitaladdress FROM requestform WHERE customerName = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION['customerName']);
$stmt->execute();
$result = $stmt->get_result();

$request_history = [];
while ($row = $result->fetch_assoc()) {
    $request_history[] = $row;
}

$stmt->close();

// Handle profile picture upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["profile_image"])) {
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["profile_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["profile_image"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["profile_image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Sorry, only JPG, JPEG, PNG files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $targetFile)) {
            echo "The file " . htmlspecialchars(basename($_FILES["profile_image"]["name"])) . " has been uploaded.";
            // Update database with new profile image path if needed
            // Example: $profileImagePath = $targetFile;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
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
    <style>
        /* Add any additional CSS styles here */
    </style>
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
                    <a href="14-profile.php">
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
        <div>
            <div class="info-container">
                <div class="profile-image">
                <?php if (isset($_SESSION['profileImage'])): ?>
                        <img src="<?php echo $_SESSION['profileImage']; ?>" alt="Profile Picture" height="200px">
                    <?php else: ?>
                        <img src="profile.png" alt="Default Profile Picture" height="200px">
                    <?php endif; ?>
                    <br>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                        <input type="file" name="profileImage">
                        <input type="submit" value="Upload Image" name="submit">
                    </form>
                </div>
                <div class="profile-info">
                    <div class="info-item">
                        <br>
                        <div class="info-value"><?php echo isset($_SESSION['customerName']) ? $_SESSION['customerName'] : ''; ?></div>
                        <div class="info-label">NAME</div>
                    </div>
                    <div class="info-item">
                        <div class="info-value"><?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?></div>
                        <div class="info-label">EMAIL ADDRESS</div>
                    </div>
                    <div class="info-item">
                        <div class="info-value"><?php echo isset($_SESSION['phone']) ? $_SESSION['phone'] : ''; ?></div>
                        <div class="info-label">MOBILE NUMBER</div>
                    </div>
                </div>
            </div>
            <div class="profile-container">
                <section id="tracker">
                    <h2-profile1><a href="14-profile.php">BLOOD REQUEST TRACKER</a></h2-profile1>
                    <div class="tracker-image">
                        <img src="tracker.png" alt="Image"><br>
                    </div>
                </section>
                <section id="donate history">
                    <h2-profile1><a href="15-donatehistory.php">DONATION HISTORY</a></h2-profile1>
                </section>
                <section id="request history">
                    <h2-profile1><a href="16-requesthistory.php">BLOOD REQUEST HISTORY</a></h2-profile1>
                    <?php if (empty($request_history)): ?>
                        <p>No request history.</p>
                        <p>Would you like to <a href="10-request.html" style="text-decoration: underline; font-weight: bold;">REQUEST</a>?</p>
                    <?php else: ?>
                        <ul>
                            <?php foreach ($request_history as $request): ?>
                                <li>
                                    <strong>Date:</strong> <?php echo date('Y-m-d', strtotime($request['date'])); ?><br>
                                    <strong>Hospital Name:</strong> <?php echo htmlspecialchars($request['hospitalname']); ?><br>
                                    <strong>Hospital Address:</strong> <?php echo htmlspecialchars($request['hospitaladdress']); ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </section>
            </div>
        </div>
    </main>
</body>
</html>
