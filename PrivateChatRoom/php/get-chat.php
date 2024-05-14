<?php 
    session_start(); // Start session to access session variables
    if(isset($_SESSION['unique_id'])){ // Check if user is logged in
        include_once "config.php"; // Include database configuration
        $outgoing_id = $_SESSION['unique_id']; // Get outgoing user's ID from session
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']); // Get incoming user's ID from POST request
        $output = "";

        // SQL query to fetch messages between the two users
        $sql = "SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
        $query = mysqli_query($conn, $sql); // Execute the SQL query

        // Check if there are messages
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){ // Loop through each message
                if($row['outgoing_msg_id'] === $outgoing_id){ // Check if the message is outgoing or incoming

                    // Display outgoing message
                    $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }else{

                    // Display incoming message
                    $output .= '<div class="chat incoming">
                                <img src="php/images/'.$row['img'].'" alt="">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }
            }
        }else{
            // Display message if no messages are available
            $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
        }
        // Output the messages
        echo $output;
    }else{
        header("location: ../login.php"); // Redirect to login page if user is not logged in
    }

    // This script dynamically generates HTML to display incoming or outgoing chat messages between two users, 
    // If the user is not logged in, it redirects them to the login page.
?>
