<?php
session_start();

// Include database connection
include 'connect.php'; // Assuming this file includes your database connection setup



// Check if userID is set in session
if (isset($_SESSION['userID'])) {
    $userID = $_SESSION['userID'];
} else {
    die("User ID not found.");
}



// Select query to fetch customer details
$select = "SELECT * FROM customerdetails WHERE userID = ?";
$stmt = $conn->prepare($select);
if (!$stmt) {
    die("Error: " . $conn->error);
}

$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("No data found for user ID: " . $userID);
}
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
        .customer-details {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .customer-details > div {
            width: 20%; 
            margin: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .customer-details > div:hover {
            background-color: #f0f0f0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .customer-details > div > span {
            display: block;
            margin-bottom: 10px;
        }

        .underline {
            text-decoration: underline;
        }
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
                    <img src="profile.png" alt="logo" height="40px" width="40px">
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

        <div class="customer-details">
            <?php
            if (isset($row)) {
            ?>
            <div>
                <h2 style="text-align: center; font-weight: bold; color: black;">BETAMAX BLOOD DONATION TICKET</h2>
                <span>Name: <span class="underline"><?php echo $row['customerName'];?></span></span>
                <span>Date of Birth: <span class="underline"><?php echo $row['dateofbirth'];?></span></span>
                <span>Gender: <span class="underline"><?php echo $row['gender'];?></span></span>
                <span>Occupation: <span class="underline"><?php echo $row['occupation'];?></span></span>
                <span>Current Address: <span class="underline"><?php echo $row['currentaddress'];?></span></span>
                <span>Permanent Address: <span class="underline"><?php echo $row['permanentaddress'];?></span></span>
                <span>Tel/Mob No.: <span class="underline"><?php echo $row['number'];?></span></span>
                <span>Email Address: <span class="underline"><?php echo $row['email'];?></span></span>
                <span>Donor No.: <span class="underline"><?php echo $row['donorno'];?></span></span>
            </div>
            <?php
            }
            ?>
        </div>

        <form method="POST" action="pdf.php" target="_blank" id="mainForm">
            <input type="hidden" name="action" id="action" value="">

            <div class="form-group" style="position: fixed; bottom: 20px; right: 20px;">
                <button type="button" id="PDFsaveButton">Save as PDF</button>
            </div>
        </form>

    </main>

    <script>
    document.getElementById('PDFsaveButton').addEventListener('click', function() {
        document.getElementById('action').value = 'pdf_creater';
        document.getElementById('mainForm').submit();
    });
    </script>

</body>
</html>
