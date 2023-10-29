<?php include('connection.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="../css/signUp.css"/>
    <title>Solarims | Registration form</title>
</head>
<body>
<div class="form-container">
        <form action="reg_user.php" method="post">
            <span id="title"><img src="../image/logo.jpg" alt="Logo">SolarIMS</span>
            <div class="input-container">
                <label for="name">Username:<p style="display:inline; color:red; font-size: small"></p></label><br>
                <input type="text" name="name" class="input" id="username" required><br>
            </div>
            <br>
            <div class="input-container">
                <label for="email">Email:<p style="display:inline; color:red"></p></label><br>
                <input type="email" name="email" class="input" id="email" required><br>
            </div>
            
            <div class="input-container">
                <label for="password">Password:<p style="display:inline; color:red"></p></label><br>
                <input type="password" name="password" class="input" id="password1" required><br>
            </div>
            
            <div class="input-container">
                <label for="Re-enter password">Re-enter password:</label><br>
                <input type="password" name="passcmp" class="input" id="password2" required><br>
            </div>
            <input type="submit" name="signUp" value="Sign up" id="submit-btn">

            <div>
                <p>Already have an account? <a href="../index.php">Sign in</a></p>
                <a id="forgot_pass" href="#">forgot password?</a>
            </div>
            
        </form>
    </div>
</body>
</html>


