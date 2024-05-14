// This code allows users to search for other users in the app by sending requests to the server 
//asynchronously and updating the user list dynamically based on the search term entered by the user.


// Selecting necessary elements
const searchBar = document.querySelector(".search input"),
searchIcon = document.querySelector(".search button"),
usersList = document.querySelector(".users-list");

// Event listener for the search icon click
searchIcon.onclick = ()=>{
  // Toggles visibility of the search bar and changes the icon's state
  searchBar.classList.toggle("show");
  searchIcon.classList.toggle("active");
  searchBar.focus(); // Focuses on the search bar
  // Resets the search bar if already active
  if(searchBar.classList.contains("active")){
    searchBar.value = "";
    searchBar.classList.remove("active");
  }
}
// Event listener for the search bar keyup event
searchBar.onkeyup = ()=>{
  let searchTerm = searchBar.value; // Retrieves the search term from the input

  // Adds or removes 'active' class based on whether the search term is empty or not
  if(searchTerm != ""){
    searchBar.classList.add("active");
  }else{
    searchBar.classList.remove("active");
  }

  // Sends a POST request to the server with the search term
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/search.php", true);
  xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
          let data = xhr.response;
          usersList.innerHTML = data; // Updates the user list with search results
        }
    }
  }
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("searchTerm=" + searchTerm); // Sends the search term as data
}

// fetches the list of users from the server
setInterval(() =>{
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "php/users.php", true);
  xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
          let data = xhr.response;
          // Updates the user list only if search bar is not active
          if(!searchBar.classList.contains("active")){
            usersList.innerHTML = data;
          }
        }
    }
  }
  xhr.send(); // Sends the request
}, 500); // Refreshes every 0.5 seconds

