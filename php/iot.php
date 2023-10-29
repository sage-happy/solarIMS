<?php
    include('connection.php');
    $solar_volt = $_GET['solar_voltage'];
    $solar_current = $_GET['solar_current'];
    $solar_temp = $_GET['solar_temperature'];
    $load_voltage = $_GET['load_voltage'];
    $load_current = $_GET['load_current'];
    $battery_voltage = $_GET['battery_voltage'];
    
    $sql = "INSERT INTO performance(solar_voltage, solar_current,solar_temperature,load_voltage,load_current,state_of_charge) VALUES($solar_volt, $solar_current, $solar_temp, $load_voltage,$load_current,$battery_voltage);";
    if (pg_query($conn, $sql)) {
        echo "New record created successfully";
     } else {
       echo "Error: " .pg_last_error($conn);
     }
    pg_close($conn);  
  ?>