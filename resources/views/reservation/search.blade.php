<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Validation</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <form id="passwordForm">
        <label for="password">Password:</label>
        <input type="password" id="password" onkeyup="validatePassword()">
        <span id="passwordLength" class="validation-tick"></span>
        <br>

        <label for="confirmPassword">Confirm Password:</label>
        <input type="password" id="confirmPassword" onkeyup="validatePassword()">
        <span id="passwordMatch" class="validation-tick"></span>
        <br>

        <span id="passwordMessage"></span>
    </form>

    <style>
        .validation-tick {
            display: inline-block;
            width: 20px;
            height: 20px;
        }
        .tick {
            background-color: green;
        }
        .cross {
            background-color: red;
        }
    </style>

    <script>
        function validatePassword() {
            var password = $("#password").val();
            var confirmPassword = $("#confirmPassword").val();
            var passwordMessage = $("#passwordMessage");
            var passwordLengthTick = $("#passwordLength");
            var passwordMatchTick = $("#passwordMatch");

            // Check if the password meets the criteria
            var isValid = true;

            if (password.length < 8) {
                isValid = false;
                passwordLengthTick.removeClass("tick").addClass("cross");
            } else {
                passwordLengthTick.removeClass("cross").addClass("tick");
            }

            if (!/[a-zA-Z]/.test(password)) {
                isValid = false;
            } else {
                passwordMatchTick.removeClass("cross").addClass("tick");
            }

            if (!/\d/.test(password)) {
                isValid = false;
            }

            if (password.toLowerCase().includes("password")) {
                isValid = false;
            }

            // Check if passwords match
            if (isValid && password !== confirmPassword) {
                isValid = false;
                passwordMatchTick.removeClass("tick").addClass("cross");
            } else {
                passwordMatchTick.removeClass("cross").addClass("tick");
            }

            // Update the message
            if (isValid) {
                passwordMessage.html("Password is valid");
                passwordMessage.removeClass("invalid").addClass("valid");
            } else {
                passwordMessage.html("Invalid password");
                passwordMessage.removeClass("valid").addClass("invalid");
            }
        }
    </script>
</body>
</html>
