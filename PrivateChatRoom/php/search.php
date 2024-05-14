<?php
    // Start session to access session variables
    session_start();
    include_once "config.php"; // Include database configuration

    // Get the unique ID of the current user
    $outgoing_id = $_SESSION['unique_id'];
    // Get the search term from the POST request and prevent SQL injection
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

    // SQL query to search for users based on search term, without searching for the current user
    $sql = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} AND (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%') ";
    $output = ""; // Initialize output variable
    $query = mysqli_query($conn, $sql); // Execute the SQL query

    // Check if any users match the search criteria
    if(mysqli_num_rows($query) > 0){
        include_once "data.php"; // Include data.php file to display search results
    }else{
        // If no users found, display a message
        $output .= 'No user found related to your search term';
    }
    echo $output; // Output the search result or message
?>
