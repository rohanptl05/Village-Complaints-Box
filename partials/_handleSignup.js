function validate() {
  var flag = true;

  // First Name Validation
  var fn = document.getElementById("fname").value;
  if (!fn) {
    document.getElementById("fnameError").innerHTML = "Enter first name";
    flag = false;
  } else {
    document.getElementById("fnameError").innerHTML = ""; // Clear error message
  }

  // Last Name Validation
  var ln = document.getElementById("lname").value;
  if (!ln) {
    document.getElementById("lnameerror").innerHTML = "Fill the Last Name";
    flag = false;
  } else {
    document.getElementById("lnameerror").innerHTML = ""; // Clear error message
  }

  // Gender Validation
  var options = document.getElementsByName("gender");
  var selected = false;

  for (var i = 0; i < options.length; i++) {
    if (options[i].checked) {
      selected = true;
      break;
    }
  }

  if (!selected) {
    document.getElementById("genderError").innerHTML = "Please Select Your Gender";
    flag = false;
  } else {
    document.getElementById("genderError").innerHTML = ""; // Clear error message
  }

  // Date of Birth Validation
  var dob = document.getElementById("dob").value;
  if (!dob) {
    document.getElementById("dobError").innerHTML = "Fill the birth of date";
    flag = false;
  } else {
    document.getElementById("dobError").innerHTML = ""; // Clear error message
  }

  // Email Validation
  var email = document.getElementById("Email").value;
  if (!email) {
    document.getElementById("EmailError").innerHTML = "Fill the Email";
    flag = false;
  } else {
    document.getElementById("EmailError").innerHTML = ""; // Clear error message
  }

  // Mobile Number Validation
  var mbl = document.getElementById("mbl").value;
  var pattern3 = /^[0-9]{10}$/;

  if (!mbl) {
    document.getElementById("mblError").innerHTML = "Please fill in the Mobile number";
    flag = false;
  } else if (!pattern3.test(mbl)) {
    document.getElementById("mblmacth").innerHTML = "Enter Mobile number with exactly 10 digits";
    flag = false;
  } else {
    document.getElementById("mblError").innerHTML = ""; // Clear error message
    document.getElementById("mblmacth").innerHTML = ""; // Clear error message
  }

  // Username Validation
  var username = document.getElementById("username").value;
  var pattern4 = /^[a-zA-Z0-9]{7,20}$/;

  if (!username) {
    document.getElementById("usernameError").innerHTML = "Please fill in the username";
    flag = false;
  } else if (!pattern4.test(username)) {
    document.getElementById("usernameErrormatch").innerHTML = "Fill the username with a minimum of 7 to a maximum of 20 characters";
    flag = false;
  } else {
    document.getElementById("usernameError").innerHTML = ""; // Clear error message
    document.getElementById("usernameErrormatch").innerHTML = ""; // Clear error message
  }

  // Password Validation
  var password = document.getElementById("password").value;
  var pattern5 = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@.#$!%*?&])[A-Za-z\d@.#$!^%*?&]{8,}$/;

  if (!password) {
    document.getElementById("passwordError").innerHTML = "Please fill in the password";
    flag = false;
  } else if (!pattern5.test(password)) {
    document.getElementById("passwordError").innerHTML = "Fill the password with a minimum of 8 characters, including symbols and numbers";
    flag = false;
  } else {
    document.getElementById("passwordError").innerHTML = ""; // Clear error message
  }

  // Confirm Password Validation
  var cpassword = document.getElementById("cpassword").value;
  if (!cpassword) {
    document.getElementById("passwordErrormatch").innerHTML = "Please fill in the confirm password";
    flag = false;
  } else if (password !== cpassword) {
    document.getElementById("passwordErrormatch").innerHTML = "Passwords do not match";
    flag = false;
  } else {
    document.getElementById("passwordErrormatch").innerHTML = ""; // Clear error message
  }

  return flag;
}
