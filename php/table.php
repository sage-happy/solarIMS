<?php
    session_start();
    include("connection.php");
    $pid = 2;//$_SESSION['plant_id'];
    $sql = "SELECT time, solar_voltage, solar_current, solar_temperature, load_voltage, load_current, state_of_charge FROM performance WHERE plant_id ={$pid};";
    $result = pg_query($conn, $sql);

    //Rendering the table headers first
    echo "<table><thead></thead><tbody><tr><td>Time</td><td>PV Voltage</td><td>PV charging Current</td><td>PV Temperature</td><td>Load Voltage</td><td>Load Current</td><td>Battery level"."</td></tr>";
     while($row=pg_fetch_assoc($result)){
        $dateObj = new DateTime($row['time']);
        $time = $dateObj->format('H:i');
        echo "<tr><td>{$time}</td><td>{$row['solar_voltage']}</td><td>{$row['solar_current']}</td><td>{$row['solar_temperature']}</td><td>{$row['load_voltage']}</td><td>{$row['load_current']}</td><td>{$row['state_of_charge']}</td></tr>";
     }
     echo "</tbody></table>";
    pg_close($conn);
?>