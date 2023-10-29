<?php
    session_start();
    include('../php/connection.php');

    $query = "SELECT * FROM public.performance WHERE plant_id = {$_SESSION['plant_id']};";
    $result = pg_query($conn, $query);
    if (!$result) {
        echo "Failed to fetch data.<br>";
    }

    // Set the HTTP response headers to indicate a CSV file download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="Solar_performance.xls"');

    // Create a file pointer connected to the output stream
    $output = fopen('php://output', 'w');

    $columnCount = pg_num_fields($result);
    $columnHeaders = array();

    for ($i = 0; $i < $columnCount; $i++) {
        $columnHeaders[] = pg_field_name($result, $i);
    }

    // Output the CSV column headers
    fputcsv($output, $columnHeaders);

    // Output the data rows
    while ($row = pg_fetch_assoc($result)) {
        fputcsv($output, $row);
    }

    // Close the file pointer and the database connection
    fclose($output);
    pg_close($conn);
    exit();
?>