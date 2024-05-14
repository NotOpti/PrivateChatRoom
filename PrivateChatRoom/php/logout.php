<?php
    session_start(); // Start session to access session variables

    // Check if user is logged in
    if(isset($_SESSION['unique_id'])){
        // Include database configuratio
        include_once "config.php";

        // Get logout ID from GET request and prevent SQL injection
        $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);
        // Check if logout ID is set
        if(isset($logout_id)){
            $status = "Offline now"; // Set user status to "Offline now"
            $sql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id={$_GET['logout_id']}");

            // Check if status update was successful
            if($sql){
                session_unset(); // Unset all session variables
                session_destroy(); // Destroy the session
                header("location: ../login.php"); // Redirect user to login page
            }
        }else{
            // If logout ID is not set, redirect user to users page
            header("location: ../users.php");
        }
    }else{  
        header("location: ../login.php"); // If user is not logged in, redirect user to login page
    }
    // This script handles user logout functionality by updating their status to "Offline now" in the database and destroying the session.
?>
