function loginvalidate() {
  var flag = true;

  // Clear previous error messages
 
  document.getElementById("loginpasswordError").innerHTML = "";

  

   // Username Validation
   var username = document.getElementById("user").value;
   var pattern4 = /^[a-zA-Z0-9]{7,20}$/;
 
   if (!username) {
     document.getElementById("loginusernameError").innerHTML = "Please fill in the username";
     flag = false;
   } else if (!pattern4.test(username)) {
     document.getElementById("loginusernameErrormatch").innerHTML = "Fill the username with a minimum of 7 to a maximum of 20 characters";
     flag = false;
   } else {
     document.getElementById("loginusernameError").innerHTML = ""; // Clear error message
     document.getElementById("loginusernameErrormatch").innerHTML = ""; // Clear error message
   }

  // Password validation
  var password = document.getElementById("loginPass").value;
  var pattern5 = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@.#$!%*?&])[A-Za-z\d@.#$!^%*?&]{8,}$/;

  if (!password) {
      document.getElementById("loginpasswordError").innerHTML = "Please fill in the password";
      flag = false;
  } else if (!pattern5.test(password)) {
      document.getElementById("loginpasswordError").innerHTML = "<br>Password must be at least 8 characters long and include a mix of uppercase, lowercase, numbers, and symbols.";
      flag = false;
  }

  return flag;
}