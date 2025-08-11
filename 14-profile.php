<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['userID'])) {
    header("Location: 2-login.html");
    exit();
}

// Prevent caching of this page
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
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
                    <h2><a href="5-donate.php">DONATE</a></h2>
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
                        <input type="file" name="profile_image">
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
                    <!-- Logout button -->
                    <div class="info-item">
                        <form action="logout.php" method="post">
                            <input type="submit" value="Logout" name="logout">
                        </form>
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
                </section>
            </div>
        </div>
    </main>
</body>
</html>
