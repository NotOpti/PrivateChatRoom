<?php 
    session_start(); // Start session to access session variables
    if(isset($_SESSION['unique_id'])){ // Check if user is logged in
        include_once "config.php"; // Include database configuration
        $outgoing_id = $_SESSION['unique_id']; // Get outgoing user's ID from session
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']); // Get incoming user's ID from POST request
        $message = mysqli_real_escape_string($conn, $_POST['message']); // Get message from POST request and prevent SQL injection

        // Check if message is not empty
        if(!empty($message)){
            // Insert message into database
            $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$message}')") or die();
        }
    }else{
        header("location: ../login.php");  // Redirect to login page if user is not logged in
    }

// This script inserts a new message into the database.
    
?>
