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
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script> 
    <script>
        $(document).ready(function(){
        //Handle Ajax request when user searches for data
        $("#search").keyup(function(){
            var search = $("#search").val();
            if(search !==''){ //If search bar not empty
                $.post("php/ajax.php", {
                    suggestion: search
                }, function(data, status){
                    $("#search_results").html(data).show();
                });
            }else{
                $("#search_results").hide();
            }
            });
        });    
</script>
<script>
    $(document).ready(function() {
    $("#history").on('click', '#submit',function(e) {
      // Prevent the default form submission
      e.preventDefault();
  
      // Make an Ajax request to submit the form data
      $.ajax({
        type: "POST",
        url: "php/data.php",
        data: $("#history").serialize(),
        success: function(data) {
          // Handle the response from php/data.php
          alert(data);
        }
      });
    });
  });
</script>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <span>
            <img id="logo-img" src="image/logo.jpg" alt="Logo"/>
            <p class="logo">SOLARIMS</p>
        </span>
        <ul class="nav-links">
            <li id='list1'><a href="home.php" id="nav-link1">Home</a></li>
            <li class="active" id='list2'><a href="#" id="nav-link2">Performance</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
        <img src="image/menu.png" alt="" class="menu-btn">
    </div>

    <section class="content" id="performance">
        <div class="title">
          <h1>Performance</h1>
        <div class="line"></div>
      </div>
      <div class="toggle-button">
        <button class="btn btn-warning" id="toggleSectionBtn">Chart</button>
        <button class="btn btn-warning" id="tableBtn">Table</button>
      </div>
      
      <form method="post" class="form-control" width="300px" id="history">
    <div class="container-fluid">
        <h3 style="text-align: center;">History</h3>
        <div class="row">
            <div class="col-4">
                <label for="date" class="d-flex justify-content-center">START DATE: <br>
                    <input type="date" name="start" id="date" class="input-group">
                </label>
            </div>
        <div class="col-4">
                <label for="date" class="d-flex justify-content-center">END DATE:   <br>
                    <input type="date" name="end" id="date" class="input-group">
                </label>
            </div>
            <!-- <div class="col-4">
                <label for="month" class="d-flex justify-content-center">Month: <br>
                    <input type="month" name="month" id="month" class="input-group">
                </label>
            </div>  -->
            <div class="col-4">
                    <input class="input-group" type="button" id="submit" value="Send">
            </div>
    </div>
</form>

<!-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('date').addEventListener("change", function() {
            var selectedDate = this.value;
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "php/data.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log(xhr.responseText); // Handle the response from data.php if required
                }
            };
            xhr.send("date=" + selectedDate);
        });
    });
</script> -->

        <div class="mt-3 col-3-lg col-2-sm"id="site-name">
            <h2 id="plant_name" style="text-align: center; font-weight: bold; textTransform: uppercase; text-decoration: underline; top-padding: 20px;"></h2>
        </div> 
        <div id="search-bar" style="float:right; margin-top: 20px; margin-bottom: 30px; width=100%"> 
            <form role="form" action="php/search.php" accept-charset="utf-8" method="post">
                <div class="btn-group d-flex justify-content-center ml-20px">
                <select name="selected" id="selection" class="input-group">
                        <option>Choose a site</option>
                        <option value="site A">Site A</option>
                        <option value="site B">Site B</option>
                </select>
                <input class="btn btn-primary" type="submit" value="Go">
                </div>
                <div id="search_results"></div>
            </form>
        </div>
        <!--        -->
    </section>
    <section id="chart-section">
        <div class="rendering-section">
            <div class="solar-section">
                <div class="image-div" id="svchart"></div>

                <div class="image-div" id="scchart"></div>

                <div class="image-div" id="stchart"></div>
            </div>
          
           <div class="load_section">
                <div class="image-div" id="lcchart"></div>
            
                <div class="image-div" id="lvchart"></div>
                
                <div class="image-div" id="socchart"></div>
            </div>
        </div>
      </section>
      <script>
        const menuBtn = document.querySelector('.menu-btn');
        const navlinks = document.querySelector('.nav-links');

        menuBtn.addEventListener('click',()=>{
            navlinks.classList.toggle('mobile-menu')});
    </script>

    <script src="js/charts.js"></script>
    
    <section id="table-section" style="display: none;">
        <div class="table-container" id="table">
            <?php include('php/table.php');?>
        </div>
    </section>
    <div class="download-button">
        <p id="download-link">Download Data As <i class="fas fa-download"></i></p>
        <div class="download-section">
            <ul>
                <li><a class="btn border-warning border-rounded" href="exporter/exporting_CSV.php">CSV</a></li>
                <li><a class="btn border-warning border-rounded" href="exporter/exporting_EXCEL.php">EXCEL</a></li>
                <li><a class="btn border-warning border-rounded" href="exporter/exporting_XML.php">XML</a></li>
            </ul>
        </div>
    </div>
    <!--Footer section-->
    <footer id="footer">
        <div class="footercontainer">
            <div class="socialicons">
                <a href="" target="_blank"><i class="fa-brands fa-facebook fa-3x" style="color: #2b63c5;"></i></a>
                <a href="" target="_blank"><i class="fa-brands fa-instagram fa-3x" style="color: #fb3958"></i></a>
                <a href="" target="_blank"><i class="fa-brands fa-twitter fa-3x" style="color: blue"></i></a>
                <a href="" target="_blank"><i class="fa-brands fa-youtube fa-3x" style="color: #fb3958"></i></a>
            </div>
            <div class="footernav">
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="performance.php">Performance</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </div>
        </div>
        <div class="footerBottom">
            <p>Copyright &copy;2023 Designed by Solarims</p>
        </div>
    </footer>
    <script type="text/javascript" src="js/btnSwitch.js"></script>
</body>
</html>