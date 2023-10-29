<?php
    session_start();
    include('connection.php');
    $_SESSION['plant_id'];
    $pid = $_SESSION['plant_id'];
    $query='';
    $date=date('j');
    $yr=date('Y');
    $mon=date('m');
    
    $dateString;
    $weekString;
    $monthString;
    // Retrieve solar performance past and current data based on the selected plant_id 
    if (isset($_POST['day']) && !empty($_POST['day'])) {
        $dateString = $_POST['day'];
        list($year, $month,$day) = explode('-', $dateString);
        $query = "SELECT * FROM performance WHERE plant_id = $pid AND EXTRACT(DAY FROM time) = $day AND EXTRACT(MONTH FROM time)=$month AND EXTRACT(YEAR FROM time) = $year;";
   }elseif(isset($_POST['week']) && !empty($_POST['week'])){
        $weekString = $_POST['week'];
        list($year,$week) = explode('-W', $weekString);
        $query = "SELECT * FROM performance WHERE plant_id = $pid AND EXTRACT( WEEK FROM time) =$week AND EXTRACT(YEAR FROM time) = $year;";
   }elseif(isset($_POST['month']) && !empty($_POST['month'])){
        $monthString = $_POST['month'];
        list($year,$month) = explode('-', $monthString);
        $query = "SELECT * FROM performance WHERE plant_id = $pid AND EXTRACT( MONTH FROM time) =$month AND EXTRACT(YEAR FROM time) = $year;";       
   }else{
       //Default query
        $query = "SELECT * FROM performance WHERE plant_id = $pid AND EXTRACT(DAY FROM time)=$date AND EXTRACT(MONTH FROM time) = $mon AND EXTRACT(YEAR FROM time) = $yr;";
   }
    
    $result = pg_query($conn, $query);

    //Retrieving plant names
    $sql = "SELECT plant_name FROM solarpvplant WHERE plant_id = $pid";
    $res = pg_query($conn, $sql);
    // Data arrays
    $svdata = array();
    $scdata = array();
    $stdata = array();
    $lvdata = array();
    $lcdata = array();
    $socdata = array();
    $time = array();
    $plant_name = array();

    while ($row = pg_fetch_assoc($result)) {
        // Copy data to arrays
        $svdata[] = floatval($row['solar_voltage']);
        $scdata[] = floatval($row['solar_current']);
        $stdata[] = floatval($row['solar_temperature']);
        $lvdata[] = floatval($row['load_voltage']);
        $lcdata[] = floatval($row['load_current']);
        $socdata[] = floatval($row['state_of_charge']);
        $dateObj = new DateTime($row['time']);
        if (isset($dateString) && !empty($dateString)) {
            $formattedTime = $dateObj->format('H:i'); // Format for time in a day e.g 20:15
        } elseif (isset($weekString) && !empty($weekString)) {
            $formattedTime = $dateObj->format('l'); // Format for days in a week e.g Monday up to Sunday
        } elseif(isset($monthString) && !empty($monthString)) {
            $formattedTime = $dateObj->format('j'); // Format for dates in a month e.g 1 to 30/31 of that Month
        } else {
            $formattedTime = $dateObj->format('H:i'); // Default format for other today's readings
        }
        
        $time[] = $formattedTime;
        
        
    }
    while ($row = pg_fetch_assoc($res)) {
        // Copy data to arrays
        $plant_name[] = strtoupper($row['plant_name']);
     }

    // Create an associative array to hold all the data
    $data = array(
        'solar_voltage' => $svdata,
        'solar_current' => $scdata,
        'solar_temperature' => $stdata,
        'load_voltage' => $lvdata,
        'load_current' => $lcdata,
        'state_of_charge' => $socdata,
        'time' => $time,
        'site_name' => $plant_name
    );

    // Encode the entire data array as JSON
    $json_data = json_encode($data, JSON_NUMERIC_CHECK);

    header('Content-Type: application/json');

    // Output the JSON data
    echo $json_data;
?>