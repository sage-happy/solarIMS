<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css"/>
    <title>Solarims | Add Sites</title>
</head>
<body>
    <div class="form-container">
        <form action="php/plants.php" method="post">
            <span id="title"><img src="image/logo.jpg" alt="Logo">SolarIMS</span>
            <div class="wrapper">
            <div class="input-container">
                <label for="name">Plant Name:</label><br>
                <input type="text" name="name" class="input" id="username" required><br>
            </div>

            <div class="input-container">
                <label for="Date">Installation Date:</label><br>
                <input type="date" name="date" class="input" id="date" required><br>
            </div>
            
            <div class="input-container">
                <label for="Street">Street:</label><br>
                <input type="text" name="street" class="input" id="street" required><br>
            </div>
            
            <div class="input-container">
                <label for="District">District:</label><br>
                <input type="text" name="district" class="input" id="district" required><br>
            </div>

            <div class="input-container">
                <label for="Capacity">Capacity(W):</label><br>
                <input type="text" name="capacity" class="input" id="capacity" required><br>
            </div>
            <input type="submit" name="addplant" value="Add Plant" id="submit-btn">
            </div>            
        </form>
    </div>

</body>
</html>
