<?php
require_once '/var/www/wits.ruc.dk/db.php';



function validatePassword($password) {
    $regex = '/^(?=.*[A-Z])(?=.*\d).{8,}$/';
    return preg_match($regex, $password);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //validate user input
    $uid = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $password = $_POST['password'];

    if (empty($uid) || empty($firstname) || empty($lastname) || empty($password)) {
        echo "All fields are required.";
    } else {
        //validate password
        if (validatePassword($password)) {

            //insert into database
            add_user($uid, $firstname, $lastname, $password);

            //redirect to login page
            header("Location: login.php");
            exit();
        } else {
            echo "Password must be at least 8 characters long and contain at least one uppercase letter and one number.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <br>
</head>
<body>
<h1>Registration Form</h1>
<form method="post" action="">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>

    <label for="firstname">First name:</label>
    <input type="text" id="firstname" name="firstname" required>

    <label for="lastname">Last name:</label>
    <input type="text" id="lastname" name="lastname" required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required onkeyup="validatePassword()">

    <div id="password-validation-message"></div>

    <button type="submit">Register</button>
</form>
<script>
    function validatePassword() {
        var password = document.getElementById('password').value;
        var regex = /^(?=.*[A-Z])(?=.*\d).{8,}$/;
        var validationMessage = document.getElementById('password-validation-message');
        if (regex.test(password)) {
            validationMessage.textContent = 'Password meets the requirements.';
            document.getElementById('login-button').style.display = 'inline';
        } else {
            validationMessage.textContent = 'Password must be at least 8 characters long and contain at least one uppercase letter and one number.';
            document.getElementById('login-button').style.display = 'none';
        }
    }
</script>
</body>
</html>
