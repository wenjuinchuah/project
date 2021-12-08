<?php
    session_start();

    //Declaring Variables
    $fname = $_SESSION['fname'];
    $lname = $_SESSION['lname'];
    $email = $_SESSION['email'];
    $mobile = $_SESSION['mobile'];
    $password1 = $_SESSION['password1'];
    $password2 = $_SESSION['password2'];
    $state = $_SESSION["state"];
    $gender = $_SESSION["gender"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results</title>
    <link rel="icon" type="image/x-icon" href="https://img.icons8.com/windows/32/000000/edit-user-male--v1.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            display: border-box;
        }

        /* Body */
        body {
            background-color: #364150;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
        /* Form */
        .inputForm {
            width: 340px;
            margin: 100px auto;
            padding: 10px;
            background-color: #fff;
            border-radius: 10px;
        }
        /* Title */
        h2 {
            text-align: center;
            padding: 10px;
        }

        div{
            margin: 15px 10px;
            padding-bottom: 10px;
        }

        label {
            padding: 10px 0;
        }

        small {
            font-size: 12px;
            padding-left: 5px;
            color: green;
            display: none;
        }

        input, select {
            display: block;
            width: 93%;
            height: 30px;
            padding: 0 10px;
            margin-top: 10px;
            border-radius: 5px;
            border: 1px solid green;
        }

        /* Password */
        .password-container {
            padding: 0;
            margin: 0;
        }

        /* Gender */
        .gender-container {
            margin: 0;
            padding: 0;
        }

        .gender-container input {
            display: inline-block;
            width: 15px;
        }

        .gender-container label, .checkbox-container label {
            position: relative;
            bottom: 9px;
            margin-right: 10px;
        }

        /* Button*/
        .button {
            margin: 15px 10px;
        }

        .button input {
            display: inline-block;
            height: 32px;
            border: none;
        }

        #submit {
            width: 100%;
            background-color: #2b323d;
            color: #fff;
            font-weight: bold;
        }

        #submit:hover {
            opacity: 70%;
            cursor: pointer;
        }

        /* The message box is shown when the user clicks on the password field */
        #message {
            background: #f1f1f1;
            color: #000;
            border-radius: 10px;
            margin: 10px 0 0 0;
            padding: 10px 0 0 10px;
        }

        #message p {
            padding: 5px 35px;
            font-size: 13px;
        }

        /* Add a green text color and a checkmark when the requirements are right */
        .valid {
            color: green;
        }

        .valid:before {
            position: relative;
            left: -35px;
            content: "✔";
        }

        /* Add a red text color and an "x" when the requirements are wrong */
        .invalid {
            color: red;
        }

        .invalid:before {
            position: relative;
            left: -35px;
            content: "✖";
        }
    </style>
</head>
<body>
    <div class="inputForm">
    <h2>User Account Details</h2>
        <div>
            <label>First Name</label>
            <input value="<?=$fname?>" disabled/>
            <small>No Error Detected</small>
        </div>
        <div>
            <label>Last Name</label>
            <input value="<?=$lname?>" disabled/>
            <small>No Error Detected</small>
        </div>
        <div>
            <label>Email</label>
            <input value=<?=$email?> disabled/>
            <small>No Error Detected</small>
        </div>
        <div>
            <label >Mobile</label>
            <input id="mobile" value=+60<?=$mobile?> disabled/>
            <small>No Error Detected</small>
        </div>
        <div>
            <label>Password</label>
            <div class="password-container">
                <input id="password1" value=<?=$password1?> disabled/>
                <small id="password1Error"></small>
                <div id="message">
                    <h5>Password must contain the following:</h5>
                    <p id="capital" class="valid">At least one <b>Uppercase [A-Z]</b></p>
                    <p id="letter" class="valid">At least one <b>Lowercase [a-z]</b></p>
                    <p id="number" class="valid">At least one <b>Number [0-9]</b></p>
                    <p id="specialChar" class="valid">At least one <b>Special Character</b></p>
                    <p id="length" class="valid">Minimum <b>Length of 6</b></p>
                    <p id="space" class="valid">No <b>space</b></p>
                </div>
            </div>
        </div>
        <div>
            <label>Confirm Password</label>
            <input value=<?=$password2?> disabled/>
            <small>No Error Detected</small>
        </div>
        <div>
            <label>Gender</label>
            <input value=<?=$gender?> disabled/>
            <small>No Error Detected</small>
        </div>
        <div>
            <label>State</label>
            <input value="<?=$state?>" disabled/>
            <small>No Error Detected</small>
        </div>
        <div class="button">
            <a href="registration.html"><input type="submit" id="submit" value="Back to Registration" onclick="return confirm('Redirecting back to Registration?')"></input></a>
        </div>
    </div>
    
</body>
</html>