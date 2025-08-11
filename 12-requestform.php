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

// Assuming the logged-in user's ID is stored in the session as 'userID'
$userID = $_SESSION['userID'];

// Fetch user data from accountinfo table
$sql = "SELECT customerName, email, number FROM accountinfo WHERE userID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Store fetched data in session variables
if ($user) {
    $_SESSION['customerName'] = $user['customerName'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['number'] = $user['number'];
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Betamax: Donate</title>
    <link rel="stylesheet" href="dash.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 15px auto;
            padding: 15px;
            background-color: #fff;
            border: 1px solid transparent;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color: #BF1B2C;
            font-family: 'Montserrat', sans-serif;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
            font-family: 'Montserrat', sans-serif;
        }

        label {
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 14px;
            color: #999;
            transition: top 0.3s ease, left 0.3s ease, font-size 0.3s ease;
            pointer-events: none;
            font-family: 'Montserrat', sans-serif;
        }

        input[type="text"],
        input[type="tel"],
        input[type="email"],
        select,
        input[type="date"],
        input[type="time"] {
        width: calc(100% - 20px);
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 20px; /* Rounded edges */
        box-sizing: border-box;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        font-family: 'Montserrat', sans-serif;
        }

        input[type="text"]:focus,
        input[type="tel"]:focus,
        input[type="email"]:focus,
        select:focus,
        input[type="date"]:focus,
        input[type="time"]:focus {
        outline: none;
        border-color: red;
        box-shadow: 0 0 5px red;
        font-family: 'Montserrat', sans-serif;
        }

        input:focus + label,
        input:not(:placeholder-shown) + label,
        select:focus + label,
        select:not(:placeholder-shown) + label {
        top: -15px;
        left: 10px;
        font-size: 12px;
        color: red;
        font-family: 'Montserrat', sans-serif;
        }

        button {
            background-color: #BF1B2C;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            float: right; 
            border-radius: 20px;
            font-family: 'Montserrat', sans-serif;
        }

        button:hover {
            background-color: darkred;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            font-family: 'Montserrat', sans-serif;
        }

        .form-group-select {
            position: relative;
        }

        .form-group-select select {
            width: calc(100% - 20px);
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 20px; 
            box-sizing: border-box;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            font-family: 'Montserrat', sans-serif;
        }

        .form-group-select label {
            top: 10px;
            left: 10px;
            font-size: 14px;
            color: #999;
            position: absolute;
            transition: top 0.3s ease, left 0.3s ease, font-size 0.3s ease;
            pointer-events: none;
            font-family: 'Montserrat', sans-serif;
        }

        .form-group-select select:focus + label,
        .form-group-select select:not(:placeholder-shown) + label {
            top: -15px;
            left: 10px;
            font-size: 12px;
            color: red;
            font-family: 'Montserrat', sans-serif;
        }

        @media (max-width: 600px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
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
                    <a href="6-donate.html"><h2>DONATE</h2></a>
                </section>
                <section id="request">
                    <h2><a href="10-request.html">REQUEST</a></h2>
                </section>
            </div>
        </div>
        <div class="container">
            <h2>Blood Request Form</h2>
            <h3>Patient Information</h3>
            <form action="requestprocess.php" method="post" onsubmit="return validateForm()">
                <div class="form-grid">
                    <div class="form-group">
                        <input type="text" id="name" name="name" value="<?php echo isset($_SESSION['customerName']) ? $_SESSION['customerName'] : ''; ?>" required>
                        <label for="name">Name</label>
                    </div>
                    <div class="form-group">
                        <input type="text" id="req-number" name="req-number" value="<?php echo isset($_SESSION['userID']) ? $_SESSION['userID'] : ''; ?>" required>
                        <label for="req-number">Request No.</label>
                    </div>
                    <div class="form-group">
                        <input type="date" id="dob" name="dob" required>
                        <label for="dob">Date of Birth</label>
                    </div>
                    <div class="form-group-select">
                        <select id="gender" name="gender" required>
                            <option value="" disabled selected hidden>Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                        <label for="gender">Gender</label>
                    </div>
                    <div class="form-group" style="grid-column: span 2;">
                        <input type="text" id="medicalcon" name="medicalcon" required>
                        <label for="medicalcon">Medical Condition</label>
                    </div>
                    <h3>Hospital/Clinic Details</h3>
                    <div class="form-group" style="grid-column: span 2;">
                        <input type="text" id="hosname" name="hosname" required>
                        <label for="hosname">Name of Hospital/Clinic</label>
                    </div>
                    <div class="form-group" style="grid-column: span 2;">
                        <input type="text" id="hos-address" name="hos-address" required>
                        <label for="hos-address">Hospital/Clinic Address</label>
                    </div>
                    <h3>Preferred Date and Time</h3>
                    <br>
                    <div class="form-group">
                        <input type="date" id="prefd" name="prefd" required>
                        <label for="prefd">Date</label>
                    </div>
                    <div class="form-group">
                        <input type="time" id="preft" name="preft" required>
                        <label for="preft">Time</label>
                    </div>
                    <h3>Contact Details</h3>
                    <br>
                    <div class="form-group" style="grid-column: span 2;">
                        <input type="tel" id="contact" name="contact" value="<?php echo isset($_SESSION['number']) ? $_SESSION['number'] : ''; ?>" required>
                        <label for="contact">Contact Number</label>
                    </div>
                    <div class="form-group" style="grid-column: span 2;">
                        <input type="email" id="email" name="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" required>
                        <label for="email">Email Address</label>
                    </div>
                    <div class="form-group" style="grid-column: span 2; text-align: right;">
                        <button type="submit" id="submitButton">Submit Request</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <script>
        function validateForm() {
            // Basic validation example
            var name = document.getElementById('name').value;
            var reqNumber = document.getElementById('req-number').value;
            var dob = document.getElementById('dob').value;
            var gender = document.getElementById('gender').value;
            var medicalcon = document.getElementById('medicalcon').value;
            var hosname = document.getElementById('hosname').value;
            var hosAddress = document.getElementById('hos-address').value;
            var prefd = document.getElementById('prefd').value;
            var preft = document.getElementById('preft').value;
            var contact = document.getElementById('contact').value;
            var email = document.getElementById('email').value;

            if (name === '' || reqNumber === '' || dob === '' || gender === '' || medicalcon === '' ||
                hosname === '' || hosAddress === '' || prefd === '' || preft === '' || contact === '' || email === '') {
                alert('Please fill out all required fields.');
                return false;
            }

            return true;
        }

        
    </script>
</body>
</html>
