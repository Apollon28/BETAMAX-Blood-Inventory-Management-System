<?php
session_start();
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
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        label {
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 14px;
            color: #999;
            transition: top 0.3s ease, left 0.3s ease, font-size 0.3s ease;
            pointer-events: none;
        }

        input[type="text"],
        input[type="tel"],
        input[type="email"],
        select,
        input[type="date"] {
            width: calc(100% - 20px);
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 20px; /* Rounded edges */
            box-sizing: border-box;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="tel"]:focus,
        input[type="email"]:focus,
        select:focus,
        input[type="date"]:focus {
            outline: none;
            border-color: red;
            box-shadow: 0 0 5px red;
        }

        input:focus + label,
        input:not(:placeholder-shown) + label,
        select:focus + label,
        select:not(:placeholder-shown) + label {
            top: -15px;
            left: 10px;
            font-size: 12px;
            color: red;
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
        }

        button:hover {
            background-color: darkred;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group-select {
            position: relative;
        }

        .form-group-select select {
            width: calc(100% - 20px);
            padding: 5px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 20px; 
            box-sizing: border-box;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-group-select label {
            top: 10px;
            left: 10px;
            font-size: 14px;
            color: #999;
            position: absolute;
            transition: top 1s ease, left 1s ease, font-size 0.3s ease;
            pointer-events: none;
        }

        .form-group-select select:focus + label,
        .form-group-select select:not(:placeholder-shown) + label {
            top: -15px;
            left: 10px;
            font-size: 12px;
            color: red;
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
            <h2>Donor's General Information</h2>
            <form action="donateprocess.php" method="post">
                <div class="form-grid">
                    <div class="form-group">
                        <input type="text" id="name" name="name" value="<?php echo isset($_SESSION['customerName']) ? $_SESSION['customerName'] : ''; ?>">
                        <label for="name">Name</label>
                    </div>
                    <div class="form-group">
                        <input type="text" id="donor-number" name="donor-number" value="<?php echo isset($_SESSION['userID']) ? $_SESSION['userID'] : ''; ?>">
                        <label for="donor-number">Donor No.</label>
                    </div>
                    <div class="form-group">
                        <input type="date" id="dob" name="dob">
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
                        <input type="text" id="occupation" name="occupation">
                        <label for="occupation">Occupation</label>
                    </div>
                    <div class="form-group" style="grid-column: span 2;">
                        <input type="text" id="current-address" name="current-address">
                        <label for="current-address">Current Address</label>
                    </div>
                    <div class="form-group" style="grid-column: span 2;">
                        <input type="text" id="permanent-address" name="permanent-address">
                        <label for="permanent-address">Permanent Address</label>
                    </div>
                    <div class="form-group">
                        <input type="tel" id="telephone" name="telephone" value="<?php echo isset($_SESSION['phone']) ? $_SESSION['phone'] : ''; ?>">
                        <label for="telephone">Telephone/Mobile No.</label>
                    </div>
                    <div class="form-group-select">
                        <select id="phone-type" name="phone-type">
                            <option value="home">Home</option>
                            <option value="work">Work</option>
                        </select>
                        <label for="phone-type">Phone Type</label>
                    </div>
                    <div class="form-group" style="grid-column: span 2;">
                        <input type="email" id="email" name="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>">
                        <label for="email">Email Address</label>
                    </div>
                    <div class="form-group" style="grid-column: span 2; text-align: right;">
                        <button type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
