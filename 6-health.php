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
        'q1', 'q2', 'q3', 'q4', 'q5', 'q6a', 'q6b', 'q6c', 'q6d', 'q6e', 
        'q7', 'q8a', 'q8b', 'q9', 'q9a', 'q9b', 'q9c', 'q10', 'q11', 
        'q12', 'q13', 'q13a', 'q13b', 'other'
    ];

    $all_filled = true;
    foreach ($required_fields as $field) {
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            $all_filled = false;
            break;
        }
    }

    if ($all_filled) {
        $q1 = $_POST['q1'];
        $q2 = $_POST['q2'];
        $q3 = $_POST['q3'];
        $q4 = $_POST['q4'];
        $q5 = $_POST['q5'];
        $q6a = $_POST['q6a'];
        $q6b = $_POST['q6b'];
        $q6c = $_POST['q6c'];
        $q6d = $_POST['q6d'];
        $q6e = $_POST['q6e'];
        $q7 = $_POST['q7'];
        $q8a = $_POST['q8a'];
        $q8b = $_POST['q8b'];
        $q9 = $_POST['q9'];
        $q9a = $_POST['q9a'];
        $q9b = $_POST['q9b'];
        $q9c = $_POST['q9c'];
        $q10 = $_POST['q10'];
        $q11 = $_POST['q11'];
        $q12 = $_POST['q12'];
        $q13 = $_POST['q13'];
        $q13a = $_POST['q13a'];
        $q13b = $_POST['q13b'];
        $other = $_POST['other'];

        $sql = "INSERT INTO questionnaire (q1, q2, q3, q4, q5, q6a, q6b, q6c, q6d, q6e, q7, q8a, q8b, q9, q9a, q9b, q9c, q10, q11, q12, q13, q13a, q13b, other) 
        VALUES ('$q1', '$q2', '$q3', '$q4', '$q5', '$q6a', '$q6b', '$q6c', '$q6d', '$q6e', '$q7', '$q8a', '$q8b', '$q9', '$q9a', '$q9b', '$q9c', '$q10', '$q11', '$q12', '$q13', '$q13a', '$q13b', '$other')";

        if ($conn->query($sql) === TRUE) {
            header("Location: 7-risk.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: Please answer all the questions.";
    }
} else {
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Assessment</title>
    <link rel="stylesheet" href="dash.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }

        .container {
            
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            border: 1px solid transparent;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h2 {
            color: #BF1B2C;
            font-family: 'Montserrat', sans-serif;
            margin-top: 0;
        }

        table {
            font-family: 'Montserrat', sans-serif;
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border: 2px solid red; /* Set border color of the table */
            
        }

        th{
            font-family: 'Montserrat', sans-serif;
            border: 1px solid red; /* Set border color of table cells */
            padding: 10px;
            text-align: left;
            border-color: none;
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
        th {
            color: #BF1B2C;
            font-family: 'Montserrat', sans-serif;
            background-color: #f2f2f2;
        }

        .instruction {
            color: #BF1B2C;
            font-family: 'Montserrat', sans-serif;
            font-style: italic;
            margin-bottom: 10px;
        }

        
        .radio-container , .border-me {
            display: flex;
            
            align-items: center;
            border-top: 1px solid #BF1B2C;
        }

        /* Optional: Add margin to the label text for better spacing */
        .radio-container label {
            color: #BF1B2C;
            font-family: 'Montserrat', sans-serif;
            margin-right: 10px;
            border-color: none;
        }

        .form-group {
            color: #BF1B2C;
            font-family: 'Montserrat', sans-serif;
            margin-bottom: 20px;
            position: relative;
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
                <!--<div class="form-group" style="position: fixed; bottom: 20px; right: 20px;">
                    <button type="button" id="nextButton">Next </button>
                </div> DATING BUTTON -->
            </div>
        </nav>
    </header>
    <main>
        <div class="content-container">
            <section id="faqs"><div class="form-group" style="position: fixed; bottom: 20px; right: 20px;">
   
</div>
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
    <form method="post" action="">
        <div class="container">
            <h2>HEALTH ASSESSMENT</h2>
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
                                <th>[ 1.1 ] Are you feeling well and in good health today?</th>
                                <td class="radio-container">
                                    <input type="radio" name="q1" value="yes" id="q1_yes" required> 
                                    <label for="q1_yes">Yes</label>
                                    <input type="radio" name="q1" value="no" id="q1_no" required>
                                    <label for="q1_no">No</label>
                                </td>
                            </tr>
                            <tr>
                                <th>[ 1.2 ] In the last 4 hours, have you had a meal or snack?</th>
                                <td class="radio-container">
                                    <input type="radio" name="q2" value="yes" id="q2_yes" required>
                                    <label for="q2_yes">Yes</label>
                                    <input type="radio" name="q2" value="no" id="q2_no" required>
                                    <label for="q2_no">No</label>
                                </td>
                            </tr>
                            <tr>
                                <th>[ 1.3 ] Have you already given blood in the last 16 weeks?</th>
                                <td class="radio-container">
                                    <input type="radio" name="q3" value="yes" id="q3_yes" required>
                                    <label for="q3_yes">Yes</label>
                                    <input type="radio" name="q3" value="no" id="q3_no" required>
                                    <label for="q3_no">No</label>
                                </td>
                            </tr>
                            <tr>
                                <th>[ 1.4 ] Have you got a chesty cough, sore throat or active cold sore?</th>
                                <td class="radio-container">
                                    <input type="radio" name="q4" value="yes" id="q4_yes" required>
                                    <label for="q4_yes">Yes</label>
                                    <input type="radio" name="q4" value="no" id="q4_no" required>
                                    <label for="q4_no">No</label>
                                </td>
                            </tr>
                            <tr>
                                <th>[ 1.5 ] Are you pregnant or breastfeeding?</th>
                                <td class="radio-container">
                                    <input type="radio" name="q5" value="yes" id="q5_yes" required>
                                    <label for="q5_yes">Yes</label>
                                    <input type="radio" name="q5" value="no" id="q5_no" required>
                                    <label for="q5_no">No</label>
                                </td>
                            </tr>
                            <tr>
                                <th>[ 1.6 ] Do you have or have you ever had:</th>
                                <td class="radio-container"></td>
                            </tr>
                            <tr>
                                <th>a. Chest pains, heart disease/surgery or a stroke?</th>
                                <td class="radio-container">
                                    <input type="radio" name="q6a" value="yes" id="q6a_yes" required>
                                    <label for="q6a_yes">Yes</label>
                                    <input type="radio" name="q6a" value="no" id="q6a_no" required>
                                    <label for="q6a_no">No</label>
                                </td>
                            </tr>
                            <tr>
                                <th>b. Lung disease, tuberculosis or asthma?</th>
                                <td class="radio-container">
                                    <input type="radio" name="q6b" value="yes" id="q6b_yes" required>
                                    <label for="q6b_yes">Yes</label>
                                    <input type="radio" name="q6b" value="no" id="q6b_no" required>
                                    <label for="q6b_no">No</label>
                                </td>
                            </tr>
                            <tr>
                                <th>c. Cancer, a blood disease, an abnormal bleeding disorder, or a bleeding gastric ulcer or duodenal ulcer?</th>
                                <td class="radio-container">
                                    <input type="radio" name="q6c" value="yes" id="q6c_yes" required>
                                    <label for="q6c_yes">Yes</label>
                                    <input type="radio" name="q6c" value="no" id="q6c_no" required>
                                    <label for="q6c_no">No</label>
                                </td>
                            </tr>
                            <tr>
                                <th>d. Diabetes, thyroid disease, kidney disease, epilepsy (fits)?</th>
                                <td class="radio-container">
                                    <input type="radio" name="q6d" value="yes" id="q6d_yes" required>
                                    <label for="q6d_yes">Yes</label>
                                    <input type="radio" name="q6d" value="no" id="q6d_no" required>
                                    <label for="q6d_no">No</label>
                                </td>
                            </tr>
                            <tr>
                                <th>e. Chagas disease, babesiosis, HTLVI/II or any other chronic infectious disease?</th>
                                <td class="radio-container">
                                    <input type="radio" name="q6e" value="yes" id="q6e_yes" required>
                                    <label for="q6e_yes">Yes</label>
                                    <input type="radio" name="q6e" value="no" id="q6e_no" required>
                                    <label for="q6e_no">No</label>
                                </td>
                            </tr>
                            <tr>
                                <th>[ 1.7 ] In the last 7 days, have you seen a doctor, dentist or any other healthcare professional or are you waiting to see one (except for routine screening appointments)?</th>
                                <td class="radio-container">
                                    <input type="radio" name="q7" value="yes" id="q7_yes" required>
                                    <label for="q7_yes">Yes</label>
                                    <input type="radio" name="q7" value="no" id="q7_no" required>
                                    <label for="q7_no">No</label>
                                </td>
                            </tr>
                            <tr>
                                <th>[ 1.8 ] In the past 12 months:</th>
                                <td class="radio-container"></td>
                            </tr>
                            <tr>
                                <th>a. Have you been ill, received any treatment or taken any medication?</th>
                                <td class="radio-container">
                                    <input type="radio" name="q8a" value="yes" id="q8a_yes" required>
                                    <label for="q8a_yes">Yes</label>
                                    <input type="radio" name="q8a" value="no" id="q8a_no" required>
                                    <label for="q8a_no">No</label>
                                </td>
                            </tr>
                            <tr>
                                <th>b. Have you been under a doctor’s care, undergone surgery, or a diagnostic procedure, suffered a major illness, or been involved in a serious accident?</th>
                                <td class="radio-container">
                                    <input type="radio" name="q8b" value="yes" id="q8b_yes" required>
                                    <label for="q8b_yes">Yes</label>
                                    <input type="radio" name="q8b" value="no" id="q8b_no" required>
                                    <label for="q8b_no">No</label>
                                </td>
                            </tr>
                            <tr>
                                <th>[ 1.9 ] Have you ever had yellow jaundice (excluding jaundice at birth), hepatitis or liver disease or a positive test for hepatitis?</th>
                                <td class="radio-container">
                                    <input type="radio" name="q9" value="yes" id="q9_yes" required>
                                    <label for="q9_yes">Yes</label>
                                    <input type="radio" name="q9" value="no" id="q9_no" required>
                                    <label for="q9_no">No</label>
                                </td>
                            </tr>
                            <tr>
                                <th>a. In the past 12 months, have you had close contact with a person with yellow jaundice or viral hepatitis, or have you been given a hepatitis B vaccination?</th>
                                <td class="radio-container">
                                    <input type="radio" name="q9a" value="yes" id="q9a_yes" required>
                                    <label for="q9a_yes">Yes</label>
                                    <input type="radio" name="q9a" value="no" id="q9a_no" required>
                                    <label for="q9a_no">No</label>
                                </td>
                            </tr>
                            <tr>
                                <th>b. Have you ever had hepatitis B or hepatitis C or think you may have hepatitis now?</th>
                                <td class="radio-container">
                                    <input type="radio" name="q9b" value="yes" id="q9b_yes" required>
                                    <label for="q9b_yes">Yes</label>
                                    <input type="radio" name="q9b" value="no" id="q9b_no" required>
                                    <label for="q9b_no">No</label>
                                </td>
                            </tr>
                            <tr>
                                <th>c. In the past 12 months, have you been tattooed, had ear or body piercing, acupuncture, circumcision or scarification, cosmetic treatment?</th>
                                <td class="radio-container">
                                    <input type="radio" name="q9c" value="yes" id="q9c_yes" required>
                                    <label for="q9c_yes">Yes</label>
                                    <input type="radio" name="q9c" value="no" id="q9c_no" required>
                                    <label for="q9c_no">No</label>
                                </td>
                            </tr>
                            <tr>
                                <th>[ 1.10 ] In the past 12 months, have you or your sexual partner received a blood transfusion?</th>
                                <td class="radio-container">
                                    <input type="radio" name="q10" value="yes" id="q10_yes" required>
                                    <label for="q10_yes">Yes</label>
                                    <input type="radio" name="q10" value="no" id="q10_no" required>
                                    <label for="q10_no">No</label>
                                </td>
                            </tr>
                            <tr>
                                <th>[ 1.11 ] Have you or your sexual partner been treated with human or animal blood products or clotting factors?</th>
                                <td class="radio-container">
                                    <input type="radio" name="q11" value="yes" id="q11_yes" required>
                                    <label for="q11_yes">Yes</label>
                                    <input type="radio" name="q11" value="no" id="q11_no" required>
                                    <label for="q11_no">No</label>
                                </td>
                            </tr>
                            <tr>
                                <th>[ 1.12 ] Have you ever had injections of human pituitary growth hormone, pituitary gonadotrophin (fertility medicine) or seen a neurosurgeon or neurologist?</th>
                                <td class="radio-container">
                                    <input type="radio" name="q12" value="yes" id="q12_yes" required>
                                    <label for="q12_yes">Yes</label>
                                    <input type="radio" name="q12" value="no" id="q12_no" required>
                                    <label for="q12_no">No</label>
                                </td>
                            </tr>
                            <tr>
                                <th>[ 1.13 ] Have you or close relatives had an unexplained neurological condition or been diagnosed with Creutzfeldt-Jacob Disease or ‘mad cow disease’?</th>
                                <td class="radio-container">
                                    <input type="radio" name="q13" value="yes" id="q13_yes" required>
                                    <label for="q13_yes">Yes</label>
                                    <input type="radio" name="q13" value="no" id="q13_no" required>
                                    <label for="q13_no">No</label>
                                </td>
                            </tr>
                            <tr>
                                <th>a. Ever had malaria or an unexplained fever associated with travel?</th>
                                <td class="radio-container">
                                    <input type="radio" name="q13a" value="yes" id="q13a_yes" required>
                                    <label for="q13a_yes">Yes</label>
                                    <input type="radio" name="q13a" value="no" id="q13a_no" required>
                                    <label for="q13a_no">No</label>
                                </td>
                            </tr>
                            <tr>
                                <th>b. Visited any malarial area in the last 12 months?</th>
                                <td class="radio-container">
                                    <input type="radio" name="q13b" value="yes" id="q13b_yes" required>
                                    <label for="q13b_yes">Yes</label>
                                    <input type="radio" name="q13b" value="no" id="q13b_no" required>
                                    <label for="q13b_no">No</label>
                                </td>
                            </tr>
                    <tr>
                        <th>[ 1.15 ] When did you last travel to another region or country (in months / years)?
                            <label for="otherInput"></label>
                            <input type="text" id="otherInput" name="other" style="background-color: #f2f2f2; border: none; border-bottom: 1px solid #BF1B2C; padding: 5px;" required>
                        </th>
                        <td class="border-me">
                            
                        </td>
                    </tr>
                    
                    </div>
                </div>
            </div>
        </main>
        <!--<script>
            document.getElementById('nextButton').addEventListener('click', function() {
                window.location.href = '7-risk.html';
            });

        </script> DATING BUTTON -->
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