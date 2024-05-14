// Select elements from the login form
const form = document.querySelector(".login form"), 
continueBtn = form.querySelector(".button input"),
errorText = form.querySelector(".error-text");

//Prevents the default form submission to allow AJAX handling.
form.onsubmit = (e)=>{
    e.preventDefault();
}
// When the continue button is clicked, send a login request to the server
continueBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest(); // Create a new XMLHttpRequest object
    xhr.open("POST", "php/login.php", true); // Initialize a POST request to the login PHP script

  // Define what happens when the request loads
    xhr.onload = ()=>{ 
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              let data = xhr.response; // Get the response from the server
              if(data === "success"){ // If login is successful, redirect to the chat interface
                location.href = "users.php";
              }else{
                // If login fails, display the error message
                errorText.style.display = "block"; 
                errorText.textContent = data;
              }
          }
      }
    }
    // Create a new FormData object from the form
    let formData = new FormData(form);
    xhr.send(formData); // Send the form data to the server
}

// This code sends login credentials to the server using AJAX and redirects the user to the chat interface or display an error message.
