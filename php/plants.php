<?php 
    include('connection.php');

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(isset($_POST['name']) && isset($_POST['date']) && isset($_POST['capacity']) && isset($_POST['street']) && isset($_POST['district'])){
            $name=filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);        
            
            $date=$_POST['date'];
            $capacity=filter_input(INPUT_POST, 'capacity', FILTER_SANITIZE_SPECIAL_CHARS);
            $Street=filter_input(INPUT_POST, 'street', FILTER_SANITIZE_SPECIAL_CHARS);
            $district=filter_input(INPUT_POST, 'district', FILTER_SANITIZE_SPECIAL_CHARS);

            $sql="INSERT INTO solarpvplant(plant_name, installation_date, street, district, capacity) VALUES('$name', '$date', '$Street', '$district', '$capacity');";
            $res = pg_query($conn, $sql);

            if($res){
                $jsCode = <<< EOD
                setTimeout(function(){window.location.href="conclusion.php"}, 2000); //2s timeout before navigating to conclusion page
                EOD;
                echo "<script>$jsCode</script>"; 
            }
        }
    }
    pg_close($conn);

?>