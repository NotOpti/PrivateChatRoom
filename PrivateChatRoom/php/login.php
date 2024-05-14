<?php 
    session_start(); // Start session to access session variables
    include_once "config.php"; // Include database configuration

    // Get email and password from POST request and prevent SQL injection
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if email and password are not empty
    if(!empty($email) && !empty($password)){
        // Query database for user with the provided email
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");

        // Check if user exists
        if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql); // Fetch user data
            // Encrypt password for comparison
            $user_pass = md5($password); 
            $enc_pass = $row['password'];

            // Check if passwords match
            if($user_pass === $enc_pass){
                $status = "Active now"; // Update user status to "Active now"
                $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");

                // Check if status update was successful
                if($sql2){
                    // Set session variable for unique user ID
                    $_SESSION['unique_id'] = $row['unique_id'];
                    echo "success"; //Login success
                }else{
                    echo "Something went wrong. Please try again!"; // Error message
                }
            }else{
                echo "Email or Password is Incorrect!"; // incorrect pw
            }
        }else{
            echo "$email - This email not Exist!"; // email doesnt exist in db
        }
    }else{
        echo "All input fields are required!"; // empty email or pw
    }

    // This script validates the user's login credentials, updates their status to "Active now" if successful login
    // and sets a session variable to track their unique ID throughout their session. It also handles errors like incorrect pw etc.

?>
