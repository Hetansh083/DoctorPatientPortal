<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">  
    <link rel="stylesheet" href="css/main.css">  
    <link rel="stylesheet" href="css/signup.css">
</head>
<body>

<?php
// Start session
session_start();

// Database connection
$servername = "localhost";
$username = "root"; // Change if necessary
$password = ""; // Change if necessary
$dbname = "doctor_patient_portal"; // Your database name

$conn = new mysqli("localhost","root","","edoc");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $full_name = $conn->real_escape_string($_POST['full_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $user_type = $conn->real_escape_string($_POST['user_type']);
    $subject = $conn->real_escape_string($_POST['subject']);
    $message = $conn->real_escape_string($_POST['message']);

    // Insert data into database
    $sql = "INSERT INTO contact_us (full_name, email, phone, user_type, subject, message) 
            VALUES ('$full_name', '$email', '$phone', '$user_type', '$subject', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Your message has been submitted successfully!');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
<div id="back-to-home">
		<a href="index.html" class="btn btn-outline btn-default">
        <svg xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/></svg>   
    </a>
	</div>

<center>
    
    <div class="container">
        <table border="0">
            <tr>
                <td colspan="2">
                    <p class="header-text">Contact Us</p>
                    <p class="sub-text">We are here to help you. Please fill out the form below.</p>
                </td>
            </tr>
            <tr>
                <form action="" method="POST">
                    <td class="label-td" colspan="2">
                        <label for="full_name" class="form-label">Full Name:</label>
                        <input type="text" name="full_name" class="input-text" placeholder="Your Full Name" required>
                    </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" class="input-text" placeholder="Your Email" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="phone" class="form-label">Phone:</label>
                    <input type="text" name="phone" class="input-text" placeholder="Your Phone Number" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="user_type" class="form-label">You are a:</label>
                    <select name="user_type" class="input-text" required>
                        <option value="Patient">Patient</option>
                        <option value="Doctor">Doctor</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="subject" class="form-label">Subject:</label>
                    <input type="text" name="subject" class="input-text" placeholder="Subject of your message" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="message" class="form-label">Message:</label>
                    <textarea name="message" class="input-text" rows="4" placeholder="Your message here..." required></textarea>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="reset" value="Reset" class="login-btn btn-primary-soft btn">
                </td>
                <td>
                    <input type="submit" value="Submit" class="login-btn btn-primary btn">
                </td>
            </tr>
        </form>
            <tr>
                <td colspan="2">
                    <br><br><br>
                    <p class="sub-text2 footer-hashen">Web Solution by Hetansh Patel</p>
                    <br><br>
                </td>
            </tr>
        </table>
    </div>
</center>

</body>
</html>