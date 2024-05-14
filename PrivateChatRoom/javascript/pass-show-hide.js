// Selecting the password field and the toggle icon
const pswrdField = document.querySelector(".form input[type='password']"),
toggleIcon = document.querySelector(".form .field i");

// Event listener for the toggle icon click
toggleIcon.onclick = () =>{
  // Toggles the visibility of the password field and the appearance of the toggle icon
  if(pswrdField.type === "password"){
    pswrdField.type = "text";
    toggleIcon.classList.add("active");
  }else{
    pswrdField.type = "password";
    toggleIcon.classList.remove("active");
  }
}

// This code enables toggling between the password field being visible or hidden.
