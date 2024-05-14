<?php 
  session_start(); // Start the session to manage user login state

  // Check if the user is already logged in
  if(isset($_SESSION['unique_id'])){
    // Redirect to users page if user is logged in
    header("location: users.php");
  }
?>

<?php include_once "header.php"; ?> <!-- Include the header file ?> !-->
<body>
  <div class="wrapper">
    <section class="form signup">
      <header>Private Chat Room</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="name-details">
          <div class="field input">
            <label>First Name</label>
            <input type="text" name="fname" placeholder="First name" required>
          </div>
          <div class="field input">
            <label>Last Name</label>
            <input type="text" name="lname" placeholder="Last name" required>
          </div>
        </div>
        <div class="field input">
          <label>Email Address</label>
          <input type="text" name="email" placeholder="Enter your email" required>
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter new password" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field image">
          <label>Select Image</label>
          <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Continue to Chat">
        </div>
      </form>
      <div class="link">Already signed up? <a href="login.php">Login now</a></div>
    </section>
  </div>

  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/signup.js"></script>

</body>
</html>

<!--This PHP code is for the signup page of my chat application. It checks if a user is already logged in 
by verifying the session. If the user is logged in, they are redirected to the users' page. If not, the signup page is displayed. 
The form collects the users first name, last name, email, password, and a profile image, and includes JavaScript 
for additional functionalities like showing/hiding the password and handling the signup process.
