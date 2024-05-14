// This code handles sending messages, updating the chat window, and managing user interaction with the chat box.

const form = document.querySelector(".typing-area"), // Select the form element with class "typing-area"
incoming_id = form.querySelector(".incoming_id").value, // Get the value of the hidden input field with class "incoming_id"
inputField = form.querySelector(".input-field"), // Select the input field where users type their messages
sendBtn = form.querySelector("button"),  // Select the send button
chatBox = document.querySelector(".chat-box"); // Select the chat box where messages are displayed

form.onsubmit = (e)=>{  // Prevents the default form submission to allow AJAX handling.
    e.preventDefault();
}

inputField.focus(); // Automatically focus on the input field when the script runs and toggle the send button to active.
inputField.onkeyup = ()=>{ // Check if the user has typed something in the input field
    if(inputField.value != ""){
        sendBtn.classList.add("active"); // If input field is not empty, activate the send button
    }else{
        sendBtn.classList.remove("active"); // If input field is empty, deactivate the send button
    }
}


// Sends the typed message to the server using AJAX and clears the input field upon success.
// Send the message when the send button is clicked
sendBtn.onclick = ()=>{ 
    let xhr = new XMLHttpRequest(); // Create a new XMLHttpRequest object
    xhr.open("POST", "php/insert-chat.php", true); // Initialize a POST request to insert the chat message
    xhr.onload = ()=>{ // Define what happens when the request loads
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              inputField.value = ""; // Clear the input field after the message is sent successfully
              scrollToBottom(); // Scroll to the bottom of the chat box to show the new message
          }
      }
    }
    // Create a new FormData object from the form
    let formData = new FormData(form);
    xhr.send(formData); // Send the form data
}
// Add an "active" class to the chat box when the mouse enters it
chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}
// Remove the "active" class from the chat box when the mouse leaves it
chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}
// function to update the chat box with new messages
setInterval(() =>{
    let xhr = new XMLHttpRequest(); // Create a new XMLHttpRequest object
    xhr.open("POST", "php/get-chat.php", true); // Initialize a POST request to get new chat messages
    xhr.onload = ()=>{ // Define what happens when the request loads
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            let data = xhr.response; // Get the response data (new messages)
            chatBox.innerHTML = data; // Update the chat box with the new messages

            // If the chat box is not active (mouse not hovering), scroll to the bottom
            if(!chatBox.classList.contains("active")){
                scrollToBottom();
              }
          }
      }
    }
    // Set the request header for form data
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("incoming_id="+incoming_id); // Send the incoming_id as part of the request
}, 500);

// Function to scroll the chat box to the bottom
function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
  }
  
