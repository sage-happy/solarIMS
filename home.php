<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solarims</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="navbar">
        <span>
            <img id="logo-img" src="image/logo.jpg" alt="Logo"/>
            <p class="logo">SOLARIMS</p>
        </span>
        <ul class="nav-links">
            <li class="active" id='list1'><a href="#" id="nav-link1">Home</a></li>
            <li id='list2'><a href="performance.php" id="nav-link2">Performance</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
        <img src="image/menu.png" alt="" class="menu-btn">
    </div>
    <header id="home">
        <div class="header-content">
            <h2 class="bg-primary text-light d-inline p-2">A World Full of Possibilities</h2>
            <div class="line mt-3"></div>
            <h1>SolarIMS</h1>
        </div>
    </header>
    <script>
        const menuBtn = document.querySelector('.menu-btn');
        const navlinks = document.querySelector('.nav-links');

        menuBtn.addEventListener('click',()=>{
            navlinks.classList.toggle('mobile-menu')});
    </script>
    
    <script>
        var firstChild = document.getElementById('list1');
        var secondChild = document.getElementById('list2');

        setTimeout(function(){
            window.location.href = "performance.php";
            secondChild.classList.add('active');
            firstChild.classList.remove('active');
            document.getElementById('performance').style.display='block';
            document.getElementById('footer').style.display='block';
            document.getElementById('home').style.display='none';
        }, 5000);
    </script>
    <script src="js/charts.js"></script>
    <?php ?>
</body>
</html>
