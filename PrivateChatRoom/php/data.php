<?php
    //This code creates a list of clickable user previews for my app, showing the user's profile picture, name, last message, and online status.


    // Loop through each row of user data fetched from the database
    while($row = mysqli_fetch_assoc($query)){
        // SQL query to retrieve the last message exchanged with the current user
        $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
                OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} 
                OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
        $query2 = mysqli_query($conn, $sql2); // Execute the SQL query
        $row2 = mysqli_fetch_assoc($query2); // Fetch the result row

        // If there is a message, store it in $result, otherwise set $result to a default message
        (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result ="No message available";

        // Shorten the message to 28 characters and add ellipsis if it's longer
        (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;

        // Determine if the message was sent by the current user ("You") or the other user
        if(isset($row2['outgoing_msg_id'])){
            ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
        }else{
            $you = "";
        }
        // Determine the online status of the user and set CSS class accordingly
        ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";
        // Hide the current user's own profile from the chat preview
        ($outgoing_id == $row['unique_id']) ? $hid_me = "hide" : $hid_me = "";


        / Generate HTML output for each user, including profile picture, name, last message, and online status
        $output .= '<a href="chat.php?user_id='. $row['unique_id'] .'">
                    <div class="content">
                    <img src="php/images/'. $row['img'] .'" alt="">
                    <div class="details">
                        <span>'. $row['fname']. " " . $row['lname'] .'</span>
                        <p>'. $you . $msg .'</p>
                    </div>
                    </div>
                    <div class="status-dot '. $offline .'"><i class="fas fa-circle"></i></div>
                </a>';
    }
?>
