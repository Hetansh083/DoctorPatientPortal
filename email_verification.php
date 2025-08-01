<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Add your necessary meta tags, title, and CSS links -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">  
    <link rel="stylesheet" href="css/main.css">  
    <link rel="stylesheet" href="css/signup.css">
</head>
<body>
<div id="back-to-home">
		<a href="index.html" class="btn btn-outline btn-default">
        <svg xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/></svg>   
    </a>
	</div>
 
    <center>
    <div class="container">
        <h2>Verify Your Email</h2>
            <label for="verificationCode">Enter the verification code received in your email:</label><br>
            <input type="text" id="verificationCode" name="verificationCode" required><br>
            <input type="button" onclick="SendEmail()" value="Send OTP" class="login-btn btn-primary btn">
            <input type="button" onclick="VerifyOTP()" value="VerifyOTP" class="login-btn btn-primary btn">
        <?php echo isset($error) ? $error : ''; 
        ?>
    </div>
    </center>

    <script src="https://smtpjs.com/v3/smtp.js"> </script>
    

    <script>
        function generateOTP() {
            const otpLength = 6;
            const characters = '0123456789';
            let otp = '';
            for (let i = 0; i < otpLength; i++) {
                const randomIndex = Math.floor(Math.random() * characters.length);
                otp += characters.charAt(randomIndex);
            }
            return otp;
        }
        function SendEmail() {
        var code = document.querySelector("#verificationCode");
        var generatedOTP = generateOTP();
        
            Email.send({
            Host : "smtp.elasticemail.com",
            Username: "hetanshpatel.21.cs@iite.indusuni.ac.in",
            Password:"A9F660BE4C07568B6FFE61C3E591223D12F8",
            SecureToken : "Enter Your Security Token",
            To : 'hetanshpatel.21.cs@iite.indusuni.ac.in',
            From : "hetanshpatel.21.cs@iite.indusuni.ac.in",
            Subject : "Email Verification OTP",
            Body : `Your OTP for email verification is: ${generatedOTP}`,
        }).then(
                message => {
                    if (message === "OK") {
                        alert("OTP sent successfully. Check your email.");
                    } else {
                        alert("Failed to send OTP. Please try again later.");
                    }
                }
            );

            // Store the generated OTP in a variable
            window.generatedOTP = generatedOTP;
        }
        
        function VerifyOTP() {
            var enteredOTP = document.querySelector("#verificationCode").value;
            if (enteredOTP === window.generatedOTP) {
                alert("Verification successful. Redirect to the desired page.");
                // You can add redirection code here
                location.href = "patient/index.php";
            } else {
                alert("Wrong OTP. Please try again.");
            }
        }

           
    </script>
</body>
</html>