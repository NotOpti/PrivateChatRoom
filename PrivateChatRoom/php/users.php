<?php
    session_start(); // Start session to access session variables
    include_once "config.php"; // Include database configuration

    // Get the unique ID of the currently logged-in user
    $outgoing_id = $_SESSION['unique_id'];

    // SQL query to select users except the currently logged-in user, ordered by user_id in descending order
    $sql = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} ORDER BY user_id DESC";
    $query = mysqli_query($conn, $sql); // Execute the query
    $output = ""; // Initialize output variable

    // Check if there are no users available
    if(mysqli_num_rows($query) == 0){
        $output .= "No users are available to chat";
    // Check if there are users available
    }elseif(mysqli_num_rows($query) > 0){
        include_once "data.php"; // Include additional data (possibly HTML) from 'data.php'
    }
    echo $output;

    // This script retrieves a list of users from the database except for the currently logged-in user.
?>
