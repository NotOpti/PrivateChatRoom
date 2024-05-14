// Selecting form elements
const form = document.querySelector(".signup form"),
continueBtn = form.querySelector(".button input"),
errorText = form.querySelector(".error-text");

//Prevents the default form submission to allow AJAX handling.
form.onsubmit = (e)=>{
    e.preventDefault();
}

// Event listener for the continue button click
continueBtn.onclick = ()=>{

  // Creating a new XMLHttpRequest object
    let xhr = new XMLHttpRequest();  // Configuring the request
    xhr.open("POST", "php/signup.php", true);
    xhr.onload = ()=>{ // Callback function when the request completes
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            // Handling the response data
              let data = xhr.response;
              if(data === "success"){
                location.href="users.php"; // Redirecting to the users.php page if signup is successful
              }else{
                // Displaying error message if signup fails
                errorText.style.display = "block";
                errorText.textContent = data;
              }
          }
      }
    }
    // Creating a FormData object and sending it with the request
    let formData = new FormData(form);
    xhr.send(formData);
}
// XMLHttpp Request allows to make HTTP requests from the browser without having to reload the page.
//It also enables client-side JavaScript code to interact with servers asynchronously (send and recieve responses without blocking the execution of other code)
