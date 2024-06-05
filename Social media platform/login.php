<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            background-color: white;
        }

        .container {
            background-color: #0077b5;
            margin: auto;
            padding: 20px;
            width: 100%;
        }
        .bottom {
            background-color: #0077B5;
            margin: auto;
            padding: 20px;
            width: 100%;
            position: fixed;
            bottom: 0;

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #0077b5;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }
        }

    </style>
</head>
<body>
<div class="container">

    <?php
   
    echo '<form action="secretpage.php" method="post">';
    echo '<label> Brugernavn</label>';
    echo '<input type="text" name="Brugernavn" required>';
    echo '<label> Adgangskode</label>';
    echo '<input type="password" id="password" name="Adgangskode" required>';
    echo '<br><br>';
    echo '<p id="password-validation-message"></p>';
    echo '<p id="clock"></p>';
    echo '<button type="button" id="login-button" onclick="submitForm()" style="display:none">Login</button>';
    echo '<button type="button" onclick="validatePassword()">Validate password</button>';
    echo '<br><br>';
    echo '<button type="button" id="register-button"onclick="location.href=\'register.php\'">Register new account</button>';
    echo '</form>';

    
    ?>

</div>
<div class="bottom">
    <br>
    <br>
    <br>
</div>

<img id="sunmoon" src="" alt="Sun or Moon" />

</body>
<style>
    #sunmoon{
        position: absolute;
        top: 130px;
        right: 10px;
    }
    #clock {
        position: absolute;
        top: 10px;
        right: 10px;
    }

</style>

<script>
    function updateTime() {
        var now = new Date();
        var hours = now.getHours();

        // tjek om det er dag eller nat
        var isDaytime = hours >= 6 && hours < 20;
        var sunmoonImg = document.getElementById("sunmoon");

        // sol eller måne
        if (isDaytime) {
            sunmoonImg.src = "https://i.ibb.co/f2015xT/sun.png";
        } else {
            sunmoonImg.src = "https://i.ibb.co/nsqzqTs/moon.jpg";
        }

        var minutes = now.getMinutes().toString().padStart(2, '0');
        var seconds = now.getSeconds().toString().padStart(2, '0');
        var timeString = hours + ':' + minutes + ':' + seconds;
        document.getElementById('clock').textContent = 'Current time: ' + timeString;
    }

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


    function submitForm() {
        document.forms[0].submit();
    }

    updateTime();
    setInterval(updateTime, 1000);
</script>

</html>
