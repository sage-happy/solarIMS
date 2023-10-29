<?php
    //Connect to the database
    include('connection.php');

    //Pulling sites from database
    $sql = "SELECT plant_name FROM solarpvplant";
    $res = pg_query($conn, $sql);
    $searches = array();

    while ($row = pg_fetch_assoc($res)) {
        $searches[] = $row['plant_name'];
    }


    if(isset($_POST['suggestion'])){
        $newSearch = $_POST['suggestion'];
        $displayedCount = 0; // To keep track of displayed sites
    
        foreach($searches as $search){
            if(strpos($search, $newSearch) !== false && $displayedCount < 5){ 
                echo $search . "<br>";
                $displayedCount++;
            }
        }
    
        if ($displayedCount === 0) {
            echo "<p style='color:red; font-size: small;'>No matching sites found.</p>";
        }
        elseif ($displayedCount === 5) {
            echo "And " . (count($emails) - 5) . " more...";
        }
    }
    
?>	
	
