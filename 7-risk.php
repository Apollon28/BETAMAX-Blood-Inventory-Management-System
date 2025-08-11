<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "betamax";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $required_fields = [
        'q2_1', 'q2_2', 'q2_4', 'q2_5', 'q2_6', 'q2_7a', 'q2_7b', 'q2_7c', 'q2_8', 'q2_9', 'q2_10', 'q2_11'
    ];

    $all_filled = true;
    foreach ($required_fields as $field) {
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            $all_filled = false;
            break;
        }
    }

    if ($all_filled) {
        $q2_1 = $_POST['q2_1'];
        $q2_2 = $_POST['q2_2'];

        // Validate q2_3 if q2_2 is "yes"
        if ($q2_2 == 'yes') {
            if (empty($_POST['reason'])) {
                echo "Error: Please provide a reason for HIV testing.";
                exit();
            }
            $reason = $_POST['reason'];
            if ($reason == 'Other' && empty($_POST['other_reason'])) {
                echo "Error: Please specify the other reason.";
                exit();
            }
            $other_reason = isset($_POST['other_reason']) ? $_POST['other_reason'] : NULL;
        } else {
            $reason = NULL;
            $other_reason = NULL;
        }

        $q2_4 = $_POST['q2_4'];
        $q2_5 = $_POST['q2_5'];
        $q2_6 = $_POST['q2_6'];
        $q2_7a = $_POST['q2_7a'];
        $q2_7b = $_POST['q2_7b'];
        $q2_7c = $_POST['q2_7c'];
        $q2_8 = $_POST['q2_8'];
        $q2_9 = $_POST['q2_9'];
        $q2_10 = $_POST['q2_10'];
        $q2_11 = $_POST['q2_11'];

        $sql = "INSERT INTO risk (q2_1, q2_2, reason, other_reason, q2_4, q2_5, q2_6, q2_7a, q2_7b, q2_7c, q2_8, q2_9, q2_10, q2_11) 
        VALUES ('$q2_1', '$q2_2', '$reason', '$other_reason', '$q2_4', '$q2_5', '$q2_6', '$q2_7a', '$q2_7b', '$q2_7c', '$q2_8', '$q2_9', '$q2_10', '$q2_11')";

        if ($conn->query($sql) === TRUE) {
            header("Location: 8-screening.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: Please answer all the required questions.";
    }
} else {
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
        <form method="post" action="">
        <div class="container">
            <h2>RISK ASSESSMENT</h2>
            <p class="instruction">Please tick "Yes" or "No" for each question that applies to you:</p>
            <table>
                <thead>
                    <tr>
                        <th>Question</th>
                        <th>Yes / No</th> <!-- Combined column for Yes and No -->
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>[ 2.1 ] Is your reason for donating blood to undergo an HIV test?</th>
                                <td class="radio-container">
                                    <input type="radio" name="q2_1" value="yes" id="q2_1_yes" required>
                                    <label for="q2_1_yes">Yes</label>
                                    <input type="radio" name="q2_1" value="no" id="q2_1_no" required>
                                    <label for="q2_1_no">No</label>
                                </td>
                            </tr>
                            <tr>
                                <th>[ 2.2 ] Have you ever been tested for HIV?</th>
                                <td class="radio-container">
                                    <input type="radio" name="q2_2" value="yes" id="q2_2_yes" required>
                                    <label for="q2_2_yes">Yes</label>
                                    <input type="radio" name="q2_2" value="no" id="q2_2_no" required>
                                    <label for="q2_2_no">No</label>
                                </td>
                            </tr>
                            <tr>
                            <th>[ 2.3 ] If  ‘‘Yes’’  what     was  the  reason? <br>
                                <input type="radio" name="reason" value="Voluntary" id="Voluntary" required>
                                <label for="Voluntary">Voluntarily</label>
                                
                                <input type="radio" name="reason" value="Employment" id="Employment" required>
                                <label for="Employment">Employment</label>
                                
                                <input type="radio" name="reason" value="Insurance" id="Insurance" required>
                                <label for="Insurance">Insurance</label>
                                
                                <input type="radio" name="reason" value="Medical advice" id="Medical advice" required>
                                <label for="Medical advice">Medical advice</label>
                                
                                <br>
                                <label for="otherInput">Others:</label>
                                <input type="text" id="otherInput" name="other_reason" style="background-color: #f2f2f2; border: none; border-bottom: 1px solid #BF1B2C; padding: 5px;" required>
                        </th>

                        <td class="radio-container">
                            
                        </td>
                    </tr>
                    <tr>
                        <th>[ 2.4 ] Have you ever had casual, oral or anal sex with someone whose background you do not know, with or without a condom?</th>
                        <td class="radio-container">
                            <input type="radio" name="q2_4" value="yes" id="q2_4_yes" required>
                            <label for="q2_4_yes">Yes</label>
                            <input type="radio" name="q2_4" value="no" id="q2_4_no" required>
                            <label for="q2_4_no">No</label>
                        </td>
                    </tr>
                    <tr>
                        <th>[ 2.5 ] Have you ever exchanged money, drugs, goods or favours in return for sex?</th>
                        <td class="radio-container">
                            <input type="radio" name="q2_5" value="yes" id="q2_5_yes" required>
                            <label for="q2_5_yes">Yes</label>
                            <input type="radio" name="q2_5" value="no" id="q2_5_no" required>
                            <label for="q2_5_no">No</label>
                        </td>
                    </tr>
                    <tr>
                        <th>[ 2.6 ] Have you suffered from a sexually transmitted disease (STD): e.g. syphilis, gonorrhoea, genital herpes, genital ulcer, VD, or ‘drop’?</th>
                        <td class="radio-container">
                            <input type="radio" name="q2_6" value="yes" id="q2_6_yes" required>
                            <label for="q2_6_yes">Yes</label>
                            <input type="radio" name="q2_6" value="no" id="q2_6_no" required>
                            <label for="q2_6_no">No</label>
                        </td>
                    </tr>
                    <tr>
                        <th>[ 2.7 ] In the past 12 months:</th>
                        <td class="radio-container">
                        </td>
                    </tr>
                    <tr>
                        <th>a. Has there been any change in your marital status?</th>
                        <td class="radio-container">
                            <input type="radio" name="q2_7a" value="yes" id="q2_7a_yes" required>
                            <label for="q2_7a_yes">Yes</label>
                            <input type="radio" name="q2_7a" value="no" id="q2_7a_no" required>
                            <label for="q2_7a_no">No</label>
                        </td>
                    </tr>
                    <tr>
                        <th>b. If sexually active, do you think any of the above questions (2.1----2.6) may be true for your sexual partner?</th>
                        <td class="radio-container">
                            <input type="radio" name="q2_7b" value="yes" id="q2_7b_yes" required>
                            <label for="q2_7b_yes">Yes</label>
                            <input type="radio" name="q2_7b" value="no" id="q2_7b_no" required>
                            <label for="q2_7b_no">No</label>
                        </td>
                    </tr>
                    <tr>
                        <th>c. Have you been a victim of sexual abuse?</th>
                        <td class="radio-container">
                            <input type="radio" name="q2_7c" value="yes" id="q2_7c_yes" required>
                            <label for="q2_7c_yes">Yes</label>
                            <input type="radio" name="q2_7c" value="no" id="q2_7c_no" required>
                            <label for="q2_7c_no">No</label>
                        </td>
                    </tr>
                    <tr>
                        <th>[ 2.8 ] Have you or your sexual partner suffered from night sweats, unintentional weight loss, diarrhea or swollen glands?</th>
                        <td class="radio-container">
                            <input type="radio" name="q2_8" value="yes" id="q2_8_yes" required>
                            <label for="q2_8_yes">Yes</label>
                            <input type="radio" name="q2_8" value="no" id="q2_8_no" required>
                            <label for="q2_8_no">No</label>
                        </td>
                    </tr>
                    <tr>
                        <th>[ 2.9 ] Have you ever injected yourself or been injected with illegal or non-prescribed drugs including body-building drugs or cosmetics (even if this was only once or a long time ago)?</th>
                        <td class="radio-container">
                            <input type="radio" name="q2_9" value="yes" id="q2_9_yes" required>
                            <label for="q2_9_yes">Yes</label>
                            <input type="radio" name="q2_9" value="no" id="q2_9_no" required>
                            <label for="q2_9_no">No</label>
                        </td>
                    </tr>
                    <tr>
                        <th>[ 2.10 ] Have you been in contact with anyone with an infectious disease or in the last 12 months have you had any immunizations, vaccinations or jabs?</th>
                        <td class="radio-container">
                            <input type="radio" name="q2_10" value="yes" id="q2_10_yes" required>
                            <label for="q2_10_yes">Yes</label>
                            <input type="radio" name="q2_10" value="no" id="q2_10_no" required>
                            <label for="q2_10_no">No</label>
                        </td>
                    </tr>
                    <tr>
                        <th>[ 2.11 ] Have you ever been refused as a blood donor, or told not to donate blood?</th>
                        <td class="radio-container">
                            <input type="radio" name="q2_11" value="yes" id="q2_11_yes" required>
                            <label for="q2_11_yes">Yes</label>
                            <input type="radio" name="q2_11" value="no" id="q2_11_no" required>
                            <label for="q2_11_no">No</label>
                        </td>
                    </tr>
                    
                    </div>
                </div>
            </div>
        </main>
        <div class="NS" style="position: fixed; bottom: 20px; right: 20px;">
            <button type="submit" class="btn btn-primary">Next</button>
        </div>
        <script>
            document.querySelector('.NS').addEventListener('click', function() {
            });

        </script>

        </form>

</body>
</html>
<?php
        }
        $conn->close();
        ?>