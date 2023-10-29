<?php
session_start();
$_SESSION['plant_id']=1; //Default plant id
include('connection.php');

// Initialize variables
$pid = $_SESSION['plant_id'];
$search = '';
$_SESSION['search'] = 'site A'; //Default site

//Retrieving plant_id data from database using text entered
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a search parameter is provided
    if (isset($_POST['selected']) && !empty($_POST['selected'])) {
        $search = $_POST['selected']; // Sanitize the input
        echo $search;
        $_SESSION['search']=$search;
        // Query the database to get the plant_id based on the search input
        $query = "SELECT plant_id FROM solarpvplant WHERE plant_name LIKE '%$search%';";
        $res = pg_query($conn, $query);

        if ($res && pg_num_rows($res) > 0) {
            // Get the plant_id from the search results
            $row = pg_fetch_assoc($res);
            $pid = $row['plant_id'];
        } else {
            echo "No matching site found.";
            exit;
        }
    }
}

$_SESSION['plant_id'] = $pid;
header("Location: ../performance.php");
?>


